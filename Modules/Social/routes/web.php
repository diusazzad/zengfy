<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Social\Http\Controllers\SocialLandingController;

/*
|--------------------------------------------------------------------------
| Social Module Web Routes (Subdomain Architecture: social.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Social Subdomain at social.zengfy.top.
| Automatically routes authenticated citizens directly to their Social Feed,
| while guest visitors are presented with the Social Showcase Landing Page.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: social.zengfy.top:8000
Route::domain('social.' . $baseDomain)->group(function () use ($baseDomain) {
    // Intelligent Root: If logged in -> Feed; If guest -> Landing Page
    Route::get('/', function () {
        if (Auth::guard('web')->check()) {
            return app(PageController::class)->showFeed();
        }
        return app(SocialLandingController::class)->index(request());
    })->name('social.home');

    // Explicit Feed Route (Protected)
    Route::get('/feed', function () use ($baseDomain) {
        if (!Auth::guard('web')->check()) {
            $scheme = request()->getScheme();
            $port = request()->getPort();
            $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
            $continue = request()->fullUrl();
            return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
        }
        return app(PageController::class)->showFeed();
    })->name('social.feed');

    // Explicit Landing Showcase Page
    Route::get('/landing', [SocialLandingController::class, 'index'])->name('social.landing');

    // Citizen Profile Route
    Route::get('/profile/{handle}', [PageController::class, 'showProfile'])->name('social.profile');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('social.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('social.register');

    // Central Sovereign Logout Forwarder (Single Sign-Out)
    Route::match(['GET', 'POST'], '/logout', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/logout?continue=" . urlencode($continue));
    })->name('social.logout');

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
