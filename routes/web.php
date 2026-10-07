<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SubdomainLandingController;
use Illuminate\Support\Facades\Route;

$baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// =========================================================================
// 1. Modular Subdomain Routes (Social Module: social.zengfy.test / social.zengfy.top)
// Registered FIRST so social.* subdomain requests match specific handlers!
// =========================================================================
require base_path('Modules/Social/routes/web.php');

// =========================================================================
// 1.1 Dedicated Landing Module Web Routes (Route: /)
// Managed via Modules/Landing/app/Http/Controllers/LandingController.php
// =========================================================================
require base_path('Modules/Landing/routes/web.php');

// =========================================================================
// 1.2 Dedicated Auth Module Web Routes (Login, Register, Password Reset, Logout)
// Managed via Modules/Auth/app/Http/Controllers/AuthController.php
// =========================================================================
require base_path('Modules/Auth/routes/web.php');

// =========================================================================
// 2. Wildcard Subdomain Landing Engine (e.g. school.zengfy.test, pos.zengfy.test)
// Excludes 'social' and 'www' so they are never intercepted by wildcard
// =========================================================================
Route::domain('{subdomain}.' . $baseDomain)
    ->where(['subdomain' => '^(?!social$|www$).*'])
    ->group(function () use ($baseDomain) {
        Route::get('/', [SubdomainLandingController::class, 'show'])->name('subdomain.landing');

        // Central Sovereign Login & Register Forwarders for all wildcard subdomains (school, pos, law, etc.)
        Route::get('/login', function ($subdomain) use ($baseDomain) {
            $scheme = request()->getScheme();
            $port = request()->getPort();
            $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
            $originUrl = request()->query('continue') ?? "{$scheme}://{$subdomain}.{$baseDomain}{$portSuffix}/";
            return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($originUrl));
        })->name('subdomain.login');

        Route::get('/register', function ($subdomain) use ($baseDomain) {
            $scheme = request()->getScheme();
            $port = request()->getPort();
            $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
            $originUrl = request()->query('continue') ?? "{$scheme}://{$subdomain}.{$baseDomain}{$portSuffix}/";
            return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($originUrl));
        })->name('subdomain.register');
    });

// =========================================================================
// 3. Authenticated Sovereign Account Hub & Device Management
// =========================================================================
Route::controller(AccountController::class)->middleware(['auth'])->group(function () {
    Route::get('/account', 'dashboard')->name('account');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/account/profile', 'updateProfile')->name('account.profile');
    Route::post('/account/avatar', 'updateAvatar')->name('account.avatar');
    Route::delete('/account/avatar', 'removeAvatar')->name('account.avatar.remove');
    Route::post('/account/password', 'changePassword')->name('account.password');
    Route::post('/account/device/{id}/revoke', 'revokeDevice')->name('account.device.revoke');
    Route::post('/account/devices/revoke-all', 'revokeAllOtherDevices')->name('account.devices.revoke-all');
});

// =========================================================================
// 4. Core Application & Public Web Routes (Base Domain: zengfy.test / zengfy.top)
// =========================================================================
Route::controller(PageController::class)->group(function () {
    // Ecosystem Informational Pages
    Route::get('/products', 'products')->name('products');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/company', 'company')->name('company');
    Route::get('/team', fn() => redirect()->route('company'))->name('team');
    Route::get('/download', 'downloadApp')->name('download.app');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/policy/workplace', 'workplacePolicy')->name('policy.workplace');
    Route::get('/faq', 'faq')->name('faq');
    Route::post('/faq', 'submitQuestion')->name('faq.submit');

    // Traffic Safeguard & Error Waiting Room Preview Routes
    Route::get('/429', fn() => response()->view('errors.429', [], 429));
    Route::get('/503', fn() => response()->view('errors.503', [], 503));
});
