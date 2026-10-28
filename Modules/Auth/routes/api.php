<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\NidVerificationController;
use Modules\Auth\Http\Controllers\PasswordResetController;
use Modules\Auth\Http\Controllers\SsoController;

/*
|--------------------------------------------------------------------------
| Auth Module API Routes (v1)
|--------------------------------------------------------------------------
|
| Central Identity & Authentication Endpoints including Registration,
| Multi-device Session Management, SSO Ticket Exchange, and NID Verification.
|
*/

Route::prefix('v1/auth')->middleware([
    \Illuminate\Cookie\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
])->group(function () {
    Route::get('/check', [AuthController::class, 'check'])
        ->name('api.v1.auth.check');

    Route::post('/register', [AuthController::class, 'register'])
        ->middleware(['throttle:registration'])
        ->name('api.v1.auth.register');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware(['throttle:60,1'])
        ->name('api.v1.auth.login');

    Route::post('/sso/exchange', [SsoController::class, 'exchangeTicket'])
        ->middleware(['throttle:30,1'])
        ->name('api.v1.auth.sso.exchange');

    // Email OTP Verification & Resend
    Route::post('/email/verify-otp', [AuthController::class, 'verifyEmailOtp'])
        ->middleware(['throttle:15,1'])
        ->name('api.v1.auth.email.verify-otp');

    Route::post('/email/resend-otp', [AuthController::class, 'resendEmailOtp'])
        ->middleware(['throttle:6,1'])
        ->name('api.v1.auth.email.resend-otp');

    // Password Reset & Recovery
    Route::post('/password/forgot', [PasswordResetController::class, 'forgotPassword'])
        ->middleware(['throttle:6,1'])
        ->name('api.v1.auth.password.forgot');

    Route::post('/password/verify-code', [PasswordResetController::class, 'verifyCode'])
        ->middleware(['throttle:10,1'])
        ->name('api.v1.auth.password.verify');

    Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])
        ->middleware(['throttle:6,1'])
        ->name('api.v1.auth.password.reset');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])
            ->name('api.v1.auth.me');

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('api.v1.auth.logout');

        Route::post('/logout-all', [AuthController::class, 'logoutAll'])
            ->name('api.v1.auth.logout-all');

        Route::post('/sso/ticket', [SsoController::class, 'generateTicket'])
            ->middleware(['throttle:15,1'])
            ->name('api.v1.auth.sso.ticket');

        Route::post('/nid/verify', [NidVerificationController::class, 'verify'])
            ->middleware(['throttle:10,1'])
            ->name('api.v1.auth.nid.verify');

        Route::get('/nid/status', [NidVerificationController::class, 'status'])
            ->name('api.v1.auth.nid.status');
    });
});
