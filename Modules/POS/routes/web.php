<?php

use Illuminate\Support\Facades\Route;
use Modules\POS\Http\Controllers\POSLandingController;

/*
|--------------------------------------------------------------------------
| POS Module Web Routes (Subdomain Architecture: pos.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy POS & Retail ERP Landing Page at pos.zengfy.top.
| All legacy incomplete sub-routes have been cleanly pruned
| in accordance with the single-module clean landing plan.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: pos.zengfy.top:8000
Route::domain('pos.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 White Glassmorphic POS Landing Page
    Route::get('/', [POSLandingController::class, 'index'])->name('pos.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://pos.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('pos.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://pos.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('pos.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('pos.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/pos -> http://pos.zengfy.top:8000/)
Route::get('/pos', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://pos.{$baseDomain}{$portSuffix}/");
})->name('pos.redirect');
