<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Models\AuthDevice;
use Modules\Auth\Services\BruteForceProtectionService;

class AuthController extends Controller
{
    protected BruteForceProtectionService $bruteForceService;

    public function __construct(BruteForceProtectionService $bruteForceService)
    {
        $this->bruteForceService = $bruteForceService;
    }

    /**
     * Handle user registration with idempotency and transaction safety.
     */
    public function register(Request $request): JsonResponse
    {
        // 1. Idempotency Check
        $idempotencyKey = $request->header('X-Idempotency-Key');
        if ($idempotencyKey) {
            $cachedResponse = Cache::get("idempotency:register:{$idempotencyKey}");
            if ($cachedResponse) {
                return response()->json($cachedResponse, 200);
            }
        }

        // 2. Input Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'device_name' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        // 3. Atomic Database Transaction
        $result = DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $deviceName = $request->input('device_name') ?? $this->detectDeviceName($request);

            $device = AuthDevice::create([
                'user_id' => $user->id,
                'device_name' => $deviceName,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'last_active_at' => now(),
            ]);

            $token = $user->createToken($deviceName)->plainTextToken;

            if ($request->hasSession()) {
                Auth::login($user);
            }

            event(new \App\Events\UserRegistered($user));

            return [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'token' => $token,
                'device' => [
                    'id' => $device->id,
                    'device_name' => $device->device_name,
                    'last_active_at' => $device->last_active_at,
                ],
            ];
        });

        // 4. Cache response for idempotency replay
        if ($idempotencyKey) {
            Cache::put("idempotency:register:{$idempotencyKey}", [
                'success' => true,
                'message' => 'User registered successfully (idempotent replay)',
                'data' => $result,
            ], now()->addMinutes(10));
        }

        return ApiResponse::created($result, 'User registered successfully');
    }

    /**
     * Handle user authentication and device session creation.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'device_name' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        // 1. Check for Active Lockout (Account or IP)
        $lockout = $this->bruteForceService->checkLockout($request->email, $request->ip());
        if ($lockout) {
            return ApiResponse::rateLimited(
                $lockout['message'],
                $lockout['retry_after'],
                ['reason' => $lockout['reason'], 'level' => $lockout['level']]
            );
        }

        // 2. Validate Credentials
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $attemptResult = $this->bruteForceService->recordFailedAttempt($request->email, $request->ip());

            if ($attemptResult['locked']) {
                return ApiResponse::rateLimited(
                    $attemptResult['message'],
                    $attemptResult['retry_after'],
                    ['level' => $attemptResult['level']]
                );
            }

            return ApiResponse::unauthorized('Invalid email or password.');
        }

        // 3. Clear failed attempts on successful credentials match
        $this->bruteForceService->clearAttempts($request->email, $request->ip());

        $deviceName = $request->input('device_name') ?? $this->detectDeviceName($request);

        // Record or update device session
        $device = AuthDevice::updateOrCreate(
            [
                'user_id' => $user->id,
                'user_agent' => $request->userAgent(),
            ],
            [
                'device_name' => $deviceName,
                'ip_address' => $request->ip(),
                'last_active_at' => now(),
            ]
        );

        $token = $user->createToken($deviceName)->plainTextToken;

        if ($request->hasSession()) {
            Auth::login($user, $request->boolean('remember', true));
        }

        return ApiResponse::success([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $token,
            'device' => [
                'id' => $device->id,
                'device_name' => $device->device_name,
                'last_active_at' => $device->last_active_at,
            ],
        ], 'Login successful');
    }

    /**
     * Return authenticated user profile and active device sessions.
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        $activeDevices = AuthDevice::where('user_id', $user->id)
            ->orderBy('last_active_at', 'desc')
            ->take(10)
            ->get(['id', 'device_name', 'ip_address', 'last_active_at', 'created_at']);

        return ApiResponse::success([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'active_devices' => $activeDevices,
        ], 'User profile retrieved successfully');
    }

    /**
     * Revoke current session token.
     */
    public function logout(Request $request): JsonResponse
    {
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        if ($request->hasSession()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return ApiResponse::success(null, 'Successfully logged out from current device.');
    }

    /**
     * Revoke all session tokens across all devices (Logout Everywhere).
     */
    public function logoutAll(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->delete();

        AuthDevice::where('user_id', $user->id)->delete();

        return ApiResponse::success(null, 'Successfully logged out from all devices.');
    }

    /**
     * Helper to detect simple device string from user-agent.
     */
    protected function detectDeviceName(Request $request): string
    {
        $userAgent = $request->userAgent() ?? '';

        if (str_contains($userAgent, 'Windows')) {
            return 'Chrome on Windows';
        } elseif (str_contains($userAgent, 'Macintosh')) {
            return 'Safari on macOS';
        } elseif (str_contains($userAgent, 'Android')) {
            return 'Mobile Android App';
        } elseif (str_contains($userAgent, 'iPhone')) {
            return 'iOS Mobile App';
        }

        return 'Web Client';
    }
}
