<?php

use Illuminate\Support\Facades\Route;
use Modules\NGO\Http\Controllers\NGOLandingController;

/*
|--------------------------------------------------------------------------
| NGO Module Web Routes (Subdomain Architecture: ngo.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy NGO Landing Page at ngo.zengfy.top.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: ngo.zengfy.top:8000
Route::domain('ngo.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Humanitarian Teal NGO Landing Page
    Route::get('/', [NGOLandingController::class, 'index'])->name('ngo.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://ngo.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('ngo.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://ngo.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('ngo.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('ngo.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/ngo -> http://ngo.zengfy.top:8000/)
Route::get('/ngo', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://ngo.{$baseDomain}{$portSuffix}/");
})->name('ngo.redirect');
