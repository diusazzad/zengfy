<?php

use Illuminate\Support\Facades\Route;
use Modules\Rent\Http\Controllers\RentLandingController;

/*
|--------------------------------------------------------------------------
| Rent Module Web Routes (Subdomain Architecture: rent.zengfy.test)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Rent Landing Page at rent.zengfy.test.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));

// 1. Dedicated Subdomain: rent.zengfy.test:8000
Route::domain('rent.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Hyperlocal Indigo & GPS Emerald Rent Landing Page
    Route::get('/', [RentLandingController::class, 'index'])->name('rent.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://rent.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('rent.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://rent.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('rent.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('rent.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.test:8000/rent -> http://rent.zengfy.test:8000/)
Route::get('/rent', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://rent.{$baseDomain}{$portSuffix}/");
})->name('rent.redirect');
