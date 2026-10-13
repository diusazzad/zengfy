<?php

use Illuminate\Support\Facades\Route;
use Modules\Law\Http\Controllers\LawLandingController;

/*
|--------------------------------------------------------------------------
| Law Module Web Routes (Subdomain Architecture: law.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Law Landing Page at law.zengfy.top.
| All legacy incomplete sub-routes have been cleanly pruned
| in accordance with the single-module clean landing plan.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: law.zengfy.top:8000
Route::domain('law.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 White Glassmorphic Law Landing Page
    Route::get('/', [LawLandingController::class, 'index'])->name('law.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://law.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('law.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://law.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('law.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('law.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/law -> http://law.zengfy.top:8000/)
Route::get('/law', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://law.{$baseDomain}{$portSuffix}/");
})->name('law.redirect');