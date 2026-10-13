<?php

use Illuminate\Support\Facades\Route;
use Modules\Social\Http\Controllers\SocialLandingController;

/*
|--------------------------------------------------------------------------
| Social Module Web Routes (Subdomain Architecture: social.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Social Landing Page at social.zengfy.top.
| All complex unauthenticated sub-routes have been cleanly pruned
| in accordance with the single-module clean landing plan.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: social.zengfy.top:8000
Route::domain('social.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 White Glassmorphic Social Landing Page
    Route::get('/', [SocialLandingController::class, 'index'])->name('social.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('social.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('social.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('social.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/social -> http://social.zengfy.top:8000/)
Route::get('/social', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://social.{$baseDomain}{$portSuffix}/");
})->name('social.redirect');
