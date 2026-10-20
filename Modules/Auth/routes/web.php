<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Auth & Sovereign Identity Module Web Routes (Central Gateway: accounts.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles centralized Single Sign-On (SSO) on accounts.zengfy.top.
| Requests accessing /login or /register on zengfy.top or subdomains
| are seamlessly forwarded here with their contextual `continue` target.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Central Identity Subdomain (accounts.zengfy.top:8000)
Route::domain('accounts.' . $baseDomain)->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('accounts.login');
        Route::get('/register', 'showRegister')->name('accounts.register');
        Route::get('/forgot-password', 'showForgotPassword')->name('accounts.password.request');
        Route::get('/reset-password/{token?}', 'showResetPassword')->name('accounts.password.reset');
        Route::match(['GET', 'POST'], '/logout', 'webLogout')->name('accounts.logout');
    });

    Route::controller(AccountController::class)->middleware(['auth'])->group(function () {
        Route::get('/', 'dashboard')->name('accounts.home');
        Route::get('/account', 'dashboard')->name('accounts.account');
        Route::get('/dashboard', 'dashboard')->name('accounts.dashboard');

        // Canonical route names matching resources/views/account/dashboard.blade.php
        Route::post('/account/profile', 'updateProfile')->name('account.profile');
        Route::post('/account/avatar', 'updateAvatar')->name('account.avatar');
        Route::delete('/account/avatar', 'removeAvatar')->name('account.avatar.remove');
        Route::post('/account/password', 'changePassword')->name('account.password');
        Route::post('/account/device/{id}/revoke', 'revokeDevice')->name('account.device.revoke');
        Route::post('/account/devices/revoke-all', 'revokeAllOtherDevices')->name('account.devices.revoke-all');

        // Legacy / Namespaced aliases for accounts.*
        Route::post('/accounts/profile', 'updateProfile')->name('accounts.account.profile');
        Route::post('/accounts/avatar', 'updateAvatar')->name('accounts.account.avatar');
        Route::delete('/accounts/avatar', 'removeAvatar')->name('accounts.account.avatar.remove');
        Route::post('/accounts/password', 'changePassword')->name('accounts.account.password');
        Route::post('/accounts/device/{id}/revoke', 'revokeDevice')->name('accounts.device.revoke');
        Route::post('/accounts/devices/revoke-all', 'revokeAllOtherDevices')->name('accounts.devices.revoke-all');
    });
});

// 2. Global / Root Fallback Routes (Directs anyone hitting /login on zengfy.top to accounts.zengfy.top)
Route::controller(AuthController::class)->group(function () use ($baseDomain) {
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        // If user is already authenticated on .zengfy.top, direct straight to accounts dashboard
        if (Auth::guard('web')->check() && !request()->has('prompt') && !request()->has('switch')) {
            return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/");
        }

        $continue = request()->query('continue') ?? request()->query('redirect_uri') ?? "{$scheme}://{$baseDomain}{$portSuffix}/";
        $extraParams = request()->has('switch') ? '&switch=1' : (request()->has('prompt') ? '&prompt=' . request()->query('prompt') : '');
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue) . $extraParams);
    })->name('login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? request()->query('redirect_uri') ?? "{$scheme}://{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('register');

    Route::get('/forgot-password', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? request()->query('redirect_uri') ?? "{$scheme}://{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/forgot-password?continue=" . urlencode($continue));
    })->name('password.request');

    Route::get('/reset-password/{token?}', function ($token = null) use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $url = "{$scheme}://accounts.{$baseDomain}{$portSuffix}/reset-password" . ($token ? "/{$token}" : "");
        return redirect($url);
    })->name('password.reset');

    Route::match(['GET', 'POST'], '/logout', 'webLogout')->name('logout');
});

// 3. Authenticated Sovereign Account Hub on Base Domain (redirects to accounts.zengfy.top)
Route::get('/account', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/");
})->name('account');

Route::get('/dashboard', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/");
})->name('dashboard');
