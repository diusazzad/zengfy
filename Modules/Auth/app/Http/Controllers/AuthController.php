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
            $baseHandle = \Illuminate\Support\Str::slug(explode('@', $request->email)[0], '_');
            $uniqueHandle = $baseHandle;
            $counter = 1;
            while (User::where('handle', $uniqueHandle)->exists()) {
                $uniqueHandle = $baseHandle . '_' . $counter++;
            }

            $user = User::create([
                'name' => $request->name,
                'handle' => $uniqueHandle,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($request->name) . '&background=2563eb&color=fff',
                'user_type' => 'citizen',
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
                Auth::guard('web')->login($user, true);
                $request->session()->regenerate();
            }

            event(new \App\Events\UserRegistered($user));

            return [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'handle' => $user->handle,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
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
            Auth::guard('web')->login($user, $request->boolean('remember', true));
            $request->session()->regenerate();
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
     * Check current authentication status for API/SPA/Mobile clients.
     */
    public function check(Request $request): JsonResponse
    {
        $user = $request->user('sanctum') ?? Auth::guard('web')->user() ?? Auth::user();

        if ($user) {
            return ApiResponse::success([
                'authenticated' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'handle' => $user->handle,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'user_type' => $user->user_type ?? 'citizen',
                    'nid_verified' => (bool) $user->nid_verified,
                    'verified_badge' => (bool) $user->verified_badge,
                ],
            ], 'User is authenticated');
        }

        return ApiResponse::success([
            'authenticated' => false,
            'user' => null,
        ], 'User is guest');
    }

    /**
     * Show the user login portal (Google-style Central SSO Gateway).
     * If user is already authenticated:
     * - Immediately redirect to the requested continue/redirect_uri destination, or fallback to /account.
     * If guest:
     * - Display the central login view with contextual target app badge.
     */
    public function showLogin(?Request $request = null)
    {
        $request = $request ?? request();
        $redirectUrl = $request->query('continue') ?? $request->query('redirect_uri') ?? $request->query('redirect_to');

        // Google-style SSO: If requested on any subdomain, forward directly to Central Base Gateway
        $currentHost = $request->getHost();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        if ($currentHost !== $baseDomain && ! in_array($currentHost, ['localhost', '127.0.0.1'])) {
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            $continue = $redirectUrl ?? "{$scheme}://{$currentHost}{$portSuffix}/";
            return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
        }

        if (Auth::guard('web')->check()) {
            if ($redirectUrl && $this->isValidRedirectUrl($redirectUrl)) {
                return redirect()->away($redirectUrl);
            }
            return redirect()->route('account');
        }

        $targetAppName = $this->resolveTargetAppName($redirectUrl);

        $viewName = view()->exists('auth::login') ? 'auth::login' : 'auth.login';
        return view($viewName, compact('redirectUrl', 'targetAppName'));
    }

    /**
     * Show the user registration portal (Google-style Central SSO Gateway).
     */
    public function showRegister(?Request $request = null)
    {
        $request = $request ?? request();
        $redirectUrl = $request->query('continue') ?? $request->query('redirect_uri') ?? $request->query('redirect_to');

        // Google-style SSO: If requested on any subdomain, forward directly to Central Base Gateway
        $currentHost = $request->getHost();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        if ($currentHost !== $baseDomain && ! in_array($currentHost, ['localhost', '127.0.0.1'])) {
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            $continue = $redirectUrl ?? "{$scheme}://{$currentHost}{$portSuffix}/";
            return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
        }

        if (Auth::guard('web')->check()) {
            if ($redirectUrl && $this->isValidRedirectUrl($redirectUrl)) {
                return redirect()->away($redirectUrl);
            }
            return redirect()->route('account');
        }

        $targetAppName = $this->resolveTargetAppName($redirectUrl);

        $viewName = view()->exists('auth::register') ? 'auth::register' : 'auth.register';
        return view($viewName, compact('redirectUrl', 'targetAppName'));
    }

    /**
     * Show the forgot password recovery page.
     */
    public function showForgotPassword(?Request $request = null)
    {
        $request = $request ?? request();
        $redirectUrl = $request->query('continue') ?? $request->query('redirect_uri') ?? $request->query('redirect_to');

        // Google-style SSO: If requested on any subdomain, forward directly to Central Base Gateway
        $currentHost = $request->getHost();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        if ($currentHost !== $baseDomain && ! in_array($currentHost, ['localhost', '127.0.0.1'])) {
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            $continue = $redirectUrl ?? "{$scheme}://{$currentHost}{$portSuffix}/";
            return redirect("{$scheme}://{$baseDomain}{$portSuffix}/forgot-password?continue=" . urlencode($continue));
        }

        if (Auth::guard('web')->check()) {
            if ($redirectUrl && $this->isValidRedirectUrl($redirectUrl)) {
                return redirect()->away($redirectUrl);
            }
            return redirect()->route('account');
        }

        $targetAppName = $this->resolveTargetAppName($redirectUrl);

        return view()->exists('auth::forgot-password')
            ? view('auth::forgot-password', compact('redirectUrl', 'targetAppName'))
            : view('auth.forgot-password', compact('redirectUrl', 'targetAppName'));
    }

    /**
     * Show the password reset page with optional reset token.
     */
    public function showResetPassword(Request $request, ?string $token = null)
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('account');
        }

        return view()->exists('auth::forgot-password')
            ? view('auth::forgot-password', ['token' => $token])
            : view('auth.forgot-password', ['token' => $token]);
    }

    /**
     * Handle Web session logout with cross-domain SSO cookie cleanup.
     */
    public function webLogout(Request $request)
    {
        $user = Auth::guard('web')->user() ?? Auth::user();

        if ($user) {
            $user->tokens()->delete();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $cookieDomain = config('session.domain');
        $sessionCookie = config('session.cookie', 'laravel_session');
        $recallerName = method_exists(Auth::guard('web'), 'getRecallerName')
            ? Auth::guard('web')->getRecallerName()
            : 'remember_web';

        $forgetSession = cookie()->forget($sessionCookie, '/', $cookieDomain);
        $forgetRemember = cookie()->forget($recallerName, '/', $cookieDomain);

        $continue = $request->query('continue') ?? $request->query('redirect_uri');
        $redirectTarget = ($continue && $this->isValidRedirectUrl($continue)) ? $continue : route('login');

        return redirect($redirectTarget)
            ->with('success', 'You have been safely signed out.')
            ->withCookie($forgetSession)
            ->withCookie($forgetRemember)
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => 'Sun, 02 Jan 1990 00:00:00 GMT',
            ]);
    }

    /**
     * Validate redirect target to prevent open redirect vulnerabilities.
     * Only permits relative URLs or domains ending in the ecosystem base domain.
     */
    protected function isValidRedirectUrl(?string $url): bool
    {
        if (! $url) {
            return false;
        }

        if (str_starts_with($url, '/') && ! str_starts_with($url, '//')) {
            return true;
        }

        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        $parsed = parse_url($url);

        if (! isset($parsed['host'])) {
            return false;
        }

        $host = strtolower($parsed['host']);
        return $host === $baseDomain
            || str_ends_with($host, '.' . $baseDomain)
            || str_ends_with($host, '.zengfy.test')
            || str_ends_with($host, '.zengfy.top')
            || in_array($host, ['localhost', '127.0.0.1']);
    }

    /**
     * Resolve user-friendly product name from destination URL.
     */
    protected function resolveTargetAppName(?string $url): string
    {
        if (! $url) {
            return 'Zengfy Sovereign Hub';
        }

        $lower = strtolower($url);

        if (str_contains($lower, 'social.') || str_contains($lower, '/feed') || str_contains($lower, '/posts')) {
            return 'Zengfy Social';
        }
        if (str_contains($lower, 'school.')) {
            return 'Zengfy School ERP';
        }
        if (str_contains($lower, 'pos.')) {
            return 'Zengfy Retail POS';
        }
        if (str_contains($lower, 'law.')) {
            return 'Zengfy Law Vault';
        }
        if (str_contains($lower, 'skill.')) {
            return 'Zengfy Skill LMS';
        }
        if (str_contains($lower, 'journal.')) {
            return 'Zengfy Journal';
        }
        if (str_contains($lower, 'download')) {
            return 'Zengfy Mobile App';
        }

        return 'Zengfy Ecosystem';
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
