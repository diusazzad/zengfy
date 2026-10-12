<?php

use Illuminate\Support\Facades\Route;
use Modules\Civil\Http\Controllers\CivilLandingController;

/*
|--------------------------------------------------------------------------
| Civil Module Web Routes (Subdomain Architecture: civil.zengfy.test)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Civil Landing Page at civil.zengfy.test.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));

// 1. Dedicated Subdomain: civil.zengfy.test:8000
Route::domain('civil.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Blueprint Cyan Civil Landing Page
    Route::get('/', [CivilLandingController::class, 'index'])->name('civil.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://civil.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('civil.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://civil.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('civil.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('civil.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.test:8000/civil -> http://civil.zengfy.test:8000/)
Route::get('/civil', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://civil.{$baseDomain}{$portSuffix}/");
})->name('civil.redirect');
