<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SubdomainLandingController;
use Illuminate\Support\Facades\Route;

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Core Application & Public Web Routes
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'welcome')->name('welcome');
    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegister')->name('register');
    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
    Route::get('/reset-password/{token?}', fn() => view('auth.forgot-password'))->name('password.reset');

    // Social & Profile Hub
    Route::get('/feed', 'showFeed')->name('social.feed');
    Route::get('/u/{handle}', 'showProfile')->name('social.profile');

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

// Authenticated Sovereign Account Hub & Device Management
Route::controller(AccountController::class)->middleware(['auth'])->group(function () {
    Route::get('/account', 'dashboard')->name('account');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/account/profile', 'updateProfile')->name('account.profile');
    Route::post('/account/password', 'changePassword')->name('account.password');
    Route::post('/account/device/{id}/revoke', 'revokeDevice')->name('account.device.revoke');
    Route::post('/account/devices/revoke-all', 'revokeAllOtherDevices')->name('account.devices.revoke-all');
});

// Web Logout (POST preferred, GET supported for user convenience)
Route::match(['GET', 'POST'], '/logout', [AccountController::class, 'logout'])->name('logout');

// Wildcard Subdomain Landing Engine (e.g. school.zengfy.test, pos.zengfy.test)
Route::domain('{subdomain}.' . env('APP_BASE_DOMAIN', 'zengfy.test'))->group(function () {
    Route::get('/', [SubdomainLandingController::class, 'show'])->name('subdomain.landing');
});
