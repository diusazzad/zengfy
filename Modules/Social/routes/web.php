<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use Modules\Social\Http\Controllers\FollowController;
use Modules\Social\Http\Controllers\PostController;
use Modules\Social\Http\Controllers\SocialLandingController;

/*
|--------------------------------------------------------------------------
| Social Module Web Routes (Subdomain Architecture: social.zengfy.top / social.zengfy.test)
|--------------------------------------------------------------------------
|
| Handles Social Product Landing Page, Hyperlocal Feed, Citizen Profiles,
| Post Reactions/Interactions, and User Following/Followers operations for:
| - social.zengfy.test (Local Development)
| - social.zengfy.top (Production)
| - zengfy.test / zengfy.top (Seamless Auto-Redirects & Fallbacks)
|
*/

$baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');

// =========================================================================
// 1. Dedicated Subdomain Group: social.zengfy.test / social.zengfy.top
// =========================================================================
Route::domain('social.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated Social Landing Page (unauthenticated) or Auto-Feed (authenticated)
    Route::get('/', [SocialLandingController::class, 'index'])->name('social.landing');
    Route::get('/feed', [PageController::class, 'showFeed'])->name('social.feed');
    Route::get('/about', [SocialLandingController::class, 'index'])->name('social.about');
    Route::get('/u/{handle}', [PageController::class, 'showProfile'])->name('social.profile');

    // Google-style Central SSO: Subdomain Login & Register Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/feed";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('social.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://social.{$baseDomain}{$portSuffix}/feed";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('social.register');

    // Authenticated Social Post Operations
    Route::controller(PostController::class)->middleware(['auth'])->group(function () {
        Route::post('/posts', 'store')->name('social.posts.store');
        Route::delete('/posts/{id}', 'destroy')->name('social.posts.destroy');
        Route::post('/posts/{id}/like', 'toggleLike')->name('social.posts.like');
    });

    // Authenticated Social Follow/Unfollow Operations
    Route::controller(FollowController::class)->middleware(['auth'])->group(function () {
        Route::post('/users/{id}/follow', 'follow')->name('social.users.follow');
        Route::post('/users/{id}/unfollow', 'unfollow')->name('social.users.unfollow');
    });
});

// =========================================================================
// 2. Base Domain Forwarder & Graceful Fallback (e.g. zengfy.test:7000/feed)
// =========================================================================
Route::controller(PageController::class)->group(function () {
    Route::get('/social', function () {
        $scheme = request()->getScheme();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        return redirect("{$scheme}://social.{$baseDomain}{$portSuffix}/");
    })->name('social.redirect');

    Route::get('/feed', function () {
        $host = request()->getHost();
        $scheme = request()->getScheme();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        // If accessed directly via localhost or IP without hosts mapping, render directly
        if (in_array($host, ['127.0.0.1', 'localhost'])) {
            return app(PageController::class)->showFeed();
        }

        // Redirect to the dedicated subdomain feed
        return redirect("{$scheme}://social.{$baseDomain}{$portSuffix}/feed");
    })->name('feed.redirect');

    Route::get('/u/{handle}', function ($handle) {
        $host = request()->getHost();
        $scheme = request()->getScheme();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.test');
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        if (in_array($host, ['127.0.0.1', 'localhost'])) {
            return app(PageController::class)->showProfile($handle);
        }

        return redirect("{$scheme}://social.{$baseDomain}{$portSuffix}/u/{$handle}");
    })->name('profile.redirect');
});

// Authenticated Social Post & Follow Operations on Base Domain (backward compatibility)
Route::controller(PostController::class)->middleware(['auth'])->group(function () {
    Route::post('/posts', 'store')->name('web.posts.store');
    Route::delete('/posts/{id}', 'destroy')->name('web.posts.destroy');
    Route::post('/posts/{id}/like', 'toggleLike')->name('web.posts.like');
});

Route::controller(FollowController::class)->middleware(['auth'])->group(function () {
    Route::post('/users/{id}/follow', 'follow')->name('web.users.follow');
    Route::post('/users/{id}/unfollow', 'unfollow')->name('web.users.unfollow');
});
