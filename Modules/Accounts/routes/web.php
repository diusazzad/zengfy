<?php

use Illuminate\Support\Facades\Route;
use Modules\Accounts\Http\Controllers\AccountsDashboardController;

/*
|--------------------------------------------------------------------------
| Central Sovereign Account Hub (accounts.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles centralized Profile Management, 2FA, Security, and Active Sessions
| for Zengfy Sovereign Identity in a clean Google-Account style interface.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

Route::domain('accounts.' . $baseDomain)->middleware(['web', 'auth'])->group(function () use ($baseDomain) {
    Route::controller(AccountsDashboardController::class)->group(function () {
        // Dashboard Home
        Route::get('/', 'dashboard')->name('accounts.home');
        Route::get('/dashboard', 'dashboard')->name('accounts.dashboard');
        Route::get('/account', 'dashboard')->name('accounts.account');

        // Profile & Photo
        Route::post('/account/profile', 'updateProfile')->name('account.profile');
        Route::post('/account/avatar', 'updateAvatar')->name('account.avatar');
        Route::delete('/account/avatar', 'removeAvatar')->name('account.avatar.remove');

        // Security & 2FA
        Route::post('/account/password', 'changePassword')->name('account.password');
        Route::post('/account/2fa/toggle', 'toggleTwoFactor')->name('account.2fa.toggle');

        // Device Session Management
        Route::post('/account/device/{id}/revoke', 'revokeDevice')->name('account.device.revoke');
        Route::post('/account/devices/revoke-all', 'revokeAllOtherDevices')->name('account.devices.revoke-all');

        // Central Billing & Subscriptions
        Route::post('/account/billing/subscribe', 'simulateSubscribe')->name('account.billing.subscribe');

        // Backward compatibility aliases
        Route::post('/accounts/profile', 'updateProfile')->name('accounts.account.profile');
        Route::post('/accounts/avatar', 'updateAvatar')->name('accounts.account.avatar');
        Route::delete('/accounts/avatar', 'removeAvatar')->name('accounts.account.avatar.remove');
        Route::post('/accounts/password', 'changePassword')->name('accounts.account.password');
        Route::post('/accounts/device/{id}/revoke', 'revokeDevice')->name('accounts.device.revoke');
        Route::post('/accounts/devices/revoke-all', 'revokeAllOtherDevices')->name('accounts.devices.revoke-all');
    });
});