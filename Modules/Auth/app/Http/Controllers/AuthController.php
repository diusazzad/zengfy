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
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Models\AuthDevice;
use Modules\Auth\Services\BruteForceProtectionService;

class AuthController extends Controller
{
    protected BruteForceProtectionService $bruteForceService;

    /**
     * List of banned disposable/temporary email provider domains.
     */
    protected static array $blockedEmailDomains = [
        '10minutemail.com', 'tempmail.com', 'mailinator.com', 'yopmail.com',
        'guerrillamail.com', 'sharklasers.com', 'dispostable.com', 'getairmail.com',
        'throwawaymail.com', 'trashmail.com', 'maildrop.cc', 'inboxkitten.com',
        'fakeinbox.com', 'burnermail.io', 'temp-mail.org', 'crazymailing.com',
        'tempmailo.com', 'emailondeck.com', 'mohmal.com', 'mytemp.email',
    ];

    public function __construct(BruteForceProtectionService $bruteForceService)
    {
        $this->bruteForceService = $bruteForceService;
    }

    /**
     * Handle user registration with idempotency, anti-bot honeypot,
     * input sanitization, disposable email rejection, and transaction safety.
     */
    public function register(Request $request): JsonResponse
    {
        // 0. Anti-Bot Honeypot Protection
        if ($request->filled('website') || $request->filled('company_url')) {
            // Silently reject automated bot registrations
            return ApiResponse::validationError(['name' => ['Spam registration detected.']]);
        }

        // 1. Idempotency Check
        $idempotencyKey = $request->header('X-Idempotency-Key');
        if ($idempotencyKey) {
            $cachedResponse = Cache::get("idempotency:register:{$idempotencyKey}");
            if ($cachedResponse) {
                return response()->json($cachedResponse, 200);
            }
        }

        // 2. Input Sanitization & Normalization
        $rawEmail = strtolower(trim((string) $request->input('email', '')));
        $cleanName = trim(strip_tags((string) $request->input('name', '')));
        $request->merge([
            'name' => $cleanName,
            'email' => $rawEmail,
        ]);

        // 3. Disposable Email Blocking (DEA)
        $emailParts = explode('@', $rawEmail);
        $emailDomain = count($emailParts) === 2 ? strtolower($emailParts[1]) : '';
        if (in_array($emailDomain, self::$blockedEmailDomains, true)) {
            return ApiResponse::validationError([
                'email' => ['অস্থায়ী বা ডিসপোজেবল ইমেইল ঠিকানা গ্রহণযোগ্য নয় (Disposable email addresses are blocked).'],
            ]);
        }

        // 4. Strict Security Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|string|in:male,female,other',
            'email' => 'required|string|email|max:255',
            'password' => ['required', 'string', Password::min(8)->letters()->numbers()],
            'device_name' => 'nullable|string|max:100',
        ], [
            'name.min' => 'নাম কমপক্ষে ২ অক্ষরের হতে হবে।',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $existingUser = User::where('email', $rawEmail)->first();
        if ($existingUser && $existingUser->email_verified_at !== null) {
            return ApiResponse::validationError([
                'email' => ['এই ইমেইল ঠিকানাটি দিয়ে ইতোমধ্যে একটি সক্রিয় অ্যাকাউন্ট রয়েছে। অনুগ্রহ করে লগইন করুন।'],
            ]);
        }

        // 5. Atomic Database Transaction with Race-Condition Safe Unique Handle & 6-digit OTP
        $result = DB::transaction(function () use ($request, $cleanName, $rawEmail, $existingUser) {
            if ($existingUser && $existingUser->email_verified_at === null) {
                $user = $existingUser;
                $user->name = $cleanName;
                $user->date_of_birth = $request->input('date_of_birth');
                $user->gender = $request->input('gender');
                $user->password = Hash::make($request->password);
                $user->registration_ip = $request->ip();
                $user->save();
            } else {
                $emailPrefix = explode('@', $rawEmail)[0] ?? 'citizen';
                $baseHandle = \Illuminate\Support\Str::slug($emailPrefix, '_');
                if (empty($baseHandle) || strlen($baseHandle) < 2) {
                    $baseHandle = 'citizen_' . strtolower(\Illuminate\Support\Str::random(6));
                }

                $uniqueHandle = $baseHandle;
                $counter = 1;
                while (User::where('handle', $uniqueHandle)->exists()) {
                    $uniqueHandle = $baseHandle . '_' . $counter++;
                }

                $user = User::create([
                    'name' => $cleanName,
                    'handle' => $uniqueHandle,
                    'email' => $rawEmail,
                    'date_of_birth' => $request->input('date_of_birth'),
                    'gender' => $request->input('gender'),
                    'password' => Hash::make($request->password),
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($cleanName) . '&background=2563eb&color=fff',
                    'user_type' => 'citizen',
                    'registration_ip' => $request->ip(),
                    'email_verified_at' => null,
                ]);
            }

            // Generate 6-Digit Email Verification Code
            $otp = (string) random_int(100000, 999999);

            Cache::put("email_otp:{$user->id}", [
                'user_id' => $user->id,
                'code' => $otp,
                'email' => $user->email,
                'attempts' => 0,
            ], now()->addMinutes(10));

            try {
                \Illuminate\Support\Facades\Mail::raw(
                    "আপনার Zengfy সার্বভৌমিক অ্যাকাউন্ট যাচাইকরণ কোড হলো: {$otp}\n\nএই কোডটি আগামী ১০ মিনিটের জন্য বৈধ। কাউকে এই কোডটি দেবেন না।\n\n-- Zengfy Sovereign Identity Team",
                    function ($message) use ($user, $otp) {
                        $message->to($user->email)
                            ->subject("Zengfy Email Verification Code: {$otp}");
                    }
                );
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning("Email dispatch failed: " . $e->getMessage());
            }
            \Illuminate\Support\Facades\Log::info("Zengfy Email Verification OTP for [{$user->email}] is: {$otp}");

            return [
                'requires_verification' => true,
                'user_id' => $user->id,
                'email' => $user->email,
                'expires_in_seconds' => 600,
                'dev_code' => (config('app.debug') || app()->environment('local')) ? $otp : null,
            ];
        });

        // 6. Cache response for idempotency replay
        if ($idempotencyKey) {
            Cache::put("idempotency:register:{$idempotencyKey}", [
                'success' => true,
                'message' => 'Verification code dispatched (idempotent replay)',
                'data' => $result,
            ], now()->addMinutes(10));
        }

        return ApiResponse::success($result, 'রেজিস্ট্রেশন তথ্য গৃহীত হয়েছে! আপনার ইমেইলে ৬-ডিজিটের ভেরিফিকেশন কোড পাঠানো হয়েছে।');
    }

    /**
     * Verify 6-digit email OTP and activate user account.
     */
    public function verifyEmailOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'otp' => 'required|string|size:6',
            'device_name' => 'nullable|string|max:100',
        ], [
            'otp.required' => 'অনুগ্রহ করে ৬ ডিজিটের ওটিপি কোড প্রদান করুন।',
            'otp.size' => 'ওটিপি কোড অবশ্যই ৬ ডিজিটের হতে হবে।',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $user = User::find($request->user_id);
        if (! $user && $request->filled('email')) {
            $user = User::where('email', strtolower(trim($request->email)))->first();
        }

        if (! $user) {
            return ApiResponse::notFound('ব্যবহারকারীর অ্যাকাউন্ট পাওয়া যায়নি।');
        }

        if ($user->email_verified_at !== null) {
            if ($request->hasSession()) {
                Auth::guard('web')->login($user, true);
                $request->session()->regenerate();
            }
            $token = $user->createToken('web_browser')->plainTextToken;
            return ApiResponse::success([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'handle' => $user->handle,
                    'email_verified' => true,
                ],
                'token' => $token,
            ], 'আপনার ইমেইল ইতোমধ্যে যাচাইকৃত! ড্যাশবোর্ডে প্রবেশ করা হচ্ছে...');
        }

        $cached = Cache::get("email_otp:{$user->id}");

        if (! $cached) {
            return ApiResponse::unauthorized('ভেরিফিকেশন কোডের মেয়াদ শেষ হয়ে গেছে বা পাওয়া যায়নি। অনুগ্রহ করে পুনরায় কোড পাঠান।');
        }

        if (($cached['attempts'] ?? 0) >= 5) {
            Cache::forget("email_otp:{$user->id}");
            return ApiResponse::rateLimited('অতিরিক্ত ভুল চেষ্টার কারণে কোডটি বাতিল করা হয়েছে। নতুন কোড পাঠান।');
        }

        $inputOtp = trim((string) $request->otp);
        if ($inputOtp !== (string) $cached['code']) {
            $cached['attempts'] = ($cached['attempts'] ?? 0) + 1;
            Cache::put("email_otp:{$user->id}", $cached, now()->addMinutes(10));
            $remaining = 5 - $cached['attempts'];
            return ApiResponse::validationError([
                'otp' => ["ভুল ওটিপি কোড। আপনার আর {$remaining} বার চেষ্টা করার সুযোগ রয়েছে।"],
            ]);
        }

        // OTP is correct! Mark email as verified
        $user->email_verified_at = now();
        $user->save();

        Cache::forget("email_otp:{$user->id}");
        Cache::forget("email_otp_resend_lock:{$user->id}");

        $deviceName = $request->input('device_name') ?? $this->detectDeviceName($request);

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
            Auth::guard('web')->login($user, true);
            $request->session()->regenerate();
        }

        event(new \App\Events\UserRegistered($user));

        return ApiResponse::success([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'handle' => $user->handle,
                'email_verified' => true,
            ],
            'token' => $token,
            'device' => [
                'id' => $device->id,
                'device_name' => $device->device_name,
            ],
        ], 'ইমেইল সফলভাবে যাচাই করা হয়েছে! ড্যাশবোর্ডে প্রবেশ করা হচ্ছে...');
    }

    /**
     * Resend 6-digit email OTP.
     */
    public function resendEmailOtp(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $user = User::find($request->user_id);
        if (! $user && $request->filled('email')) {
            $user = User::where('email', strtolower(trim($request->email)))->first();
        }

        if (! $user) {
            return ApiResponse::notFound('ব্যবহারকারী পাওয়া যায়নি।');
        }

        if ($user->email_verified_at !== null) {
            return ApiResponse::success(null, 'আপনার অ্যাকাউন্ট ইতোমধ্যে যাচাইকৃত।');
        }

        if (Cache::has("email_otp_resend_lock:{$user->id}")) {
            return ApiResponse::rateLimited('অনুগ্রহ করে ৬০ সেকেন্ড অপেক্ষা করুন এবং তারপর আবার চেষ্টা করুন।');
        }

        $otp = (string) random_int(100000, 999999);

        Cache::put("email_otp:{$user->id}", [
            'user_id' => $user->id,
            'code' => $otp,
            'email' => $user->email,
            'attempts' => 0,
        ], now()->addMinutes(10));

        Cache::put("email_otp_resend_lock:{$user->id}", true, now()->addSeconds(60));

        try {
            \Illuminate\Support\Facades\Mail::raw(
                "আপনার Zengfy সার্বভৌমিক অ্যাকাউন্ট যাচাইকরণ কোড হলো: {$otp}\n\nএই কোডটি আগামী ১০ মিনিটের জন্য বৈধ। কাউকে এই কোডটি দেবেন না।\n\n-- Zengfy Sovereign Identity Team",
                function ($message) use ($user, $otp) {
                    $message->to($user->email)
                        ->subject("Zengfy Email Verification Code: {$otp}");
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning("Email dispatch failed: " . $e->getMessage());
        }
        \Illuminate\Support\Facades\Log::info("Zengfy Email Verification OTP (Resent) for [{$user->email}] is: {$otp}");

        return ApiResponse::success([
            'email' => $user->email,
            'expires_in_seconds' => 600,
            'dev_code' => (config('app.debug') || app()->environment('local')) ? $otp : null,
        ], 'নতুন ভেরিফিকেশন কোড পাঠানো হয়েছে।');
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
     * Hosted on accounts.{baseDomain}.
     */
    public function showLogin(?Request $request = null)
    {
        $request = $request ?? request();
        $redirectUrl = $request->query('continue') ?? $request->query('redirect_uri') ?? $request->query('redirect_to');

        // Central Sovereign Identity: Login portal is hosted strictly on accounts.{baseDomain}
        $currentHost = $request->getHost();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $centralAuthHost = 'accounts.' . $baseDomain;

        if ($currentHost !== $centralAuthHost && ! in_array($currentHost, ['localhost', '127.0.0.1'])) {
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            $continue = $redirectUrl ?? "{$scheme}://{$currentHost}{$portSuffix}/";
            return redirect("{$scheme}://{$centralAuthHost}{$portSuffix}/login?continue=" . urlencode($continue));
        }

        // Allow explicit account switching or forced login display via prompt=login or switch=1
        if ($request->boolean('switch') || $request->query('prompt') === 'login' || $request->boolean('logout')) {
            $user = Auth::guard('web')->user() ?? Auth::user();
            if ($user) {
                $user->tokens()->delete();
            }
            Auth::guard('web')->logout();
            if ($request->hasSession()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
        } elseif (Auth::guard('web')->check()) {
            if ($redirectUrl && $this->isValidRedirectUrl($redirectUrl)) {
                $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
                $parsed = parse_url($redirectUrl);
                $host = strtolower($parsed['host'] ?? '');
                $path = $parsed['path'] ?? '/';

                // Prevent dead bounce back to public landing page when already authenticated
                $isLanding = ($host === $baseDomain || $host === 'localhost' || $host === '127.0.0.1')
                    && ($path === '/' || $path === '');

                if (! $isLanding) {
                    return redirect()->away($redirectUrl);
                }
            }
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            return redirect("{$scheme}://{$centralAuthHost}{$portSuffix}/");
        }

        $targetAppName = $this->resolveTargetAppName($redirectUrl);

        $viewName = view()->exists('auth::login') ? 'auth::login' : 'auth.login';
        return view($viewName, compact('redirectUrl', 'targetAppName'));
    }

    /**
     * Show the user registration portal (Google-style Central SSO Gateway).
     * Hosted on accounts.{baseDomain}.
     */
    public function showRegister(?Request $request = null)
    {
        $request = $request ?? request();
        $redirectUrl = $request->query('continue') ?? $request->query('redirect_uri') ?? $request->query('redirect_to');

        // Central Sovereign Identity: Registration portal is hosted strictly on accounts.{baseDomain}
        $currentHost = $request->getHost();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $centralAuthHost = 'accounts.' . $baseDomain;

        if ($currentHost !== $centralAuthHost && ! in_array($currentHost, ['localhost', '127.0.0.1'])) {
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            $continue = $redirectUrl ?? "{$scheme}://{$currentHost}{$portSuffix}/";
            return redirect("{$scheme}://{$centralAuthHost}{$portSuffix}/register?continue=" . urlencode($continue));
        }

        if (Auth::guard('web')->check()) {
            if ($redirectUrl && $this->isValidRedirectUrl($redirectUrl)) {
                return redirect()->away($redirectUrl);
            }
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            return redirect("{$scheme}://{$centralAuthHost}{$portSuffix}/");
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

        $currentHost = $request->getHost();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $centralAuthHost = 'accounts.' . $baseDomain;

        if ($currentHost !== $centralAuthHost && ! in_array($currentHost, ['localhost', '127.0.0.1'])) {
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            $continue = $redirectUrl ?? "{$scheme}://{$currentHost}{$portSuffix}/";
            return redirect("{$scheme}://{$centralAuthHost}{$portSuffix}/forgot-password?continue=" . urlencode($continue));
        }

        if (Auth::guard('web')->check()) {
            if ($redirectUrl && $this->isValidRedirectUrl($redirectUrl)) {
                return redirect()->away($redirectUrl);
            }
            $scheme = $request->getScheme();
            $port = $request->getPort();
            $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
            return redirect("{$scheme}://{$centralAuthHost}{$portSuffix}/");
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
        $scheme = $request->getScheme();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $port = $request->getPort();
        $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";

        if (Auth::guard('web')->check()) {
            return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/");
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
        $scheme = $request->getScheme();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $port = $request->getPort();
        $portSuffix = ($port && ! in_array($port, [80, 443])) ? ":{$port}" : "";
        $defaultLogin = "{$scheme}://accounts.{$baseDomain}{$portSuffix}/login";
        $redirectTarget = ($continue && $this->isValidRedirectUrl($continue)) ? $continue : $defaultLogin;

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

        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $parsed = parse_url($url);

        if (! isset($parsed['host'])) {
            return false;
        }

        $host = strtolower($parsed['host']);
        return $host === $baseDomain
            || str_ends_with($host, '.' . $baseDomain)
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
        if (str_contains($lower, 'civil.')) {
            return 'Zengfy Civil Engine';
        }
        if (str_contains($lower, 'ngo.')) {
            return 'Zengfy NGO';
        }
        if (str_contains($lower, 'rent.')) {
            return 'Zengfy Rent';
        }
        if (str_contains($lower, 'hotel.')) {
            return 'Zengfy Hotel';
        }
        if (str_contains($lower, 'shop.')) {
            return 'Zengfy Shop';
        }
        if (str_contains($lower, 'ecommerce.')) {
            return 'Zengfy Commerce';
        }
        if (str_contains($lower, 'skill.')) {
            return 'Zengfy Skill LMS';
        }
        if (str_contains($lower, 'journal.')) {
            return 'Zengfy Journal';
        }
        if (str_contains($lower, 'habit.')) {
            return 'Zengfy Habit';
        }
        if (str_contains($lower, 'schedule.')) {
            return 'Zengfy Schedule';
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
