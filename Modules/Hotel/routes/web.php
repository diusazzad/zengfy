<?php

use Illuminate\Support\Facades\Route;
use Modules\Hotel\Http\Controllers\HotelLandingController;

/*
|--------------------------------------------------------------------------
| Hotel Module Web Routes (Subdomain Architecture: hotel.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Hotel Landing Page at hotel.zengfy.top.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: hotel.zengfy.top:8000
Route::domain('hotel.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Luxury Champagne Gold Hotel Landing Page
    Route::get('/', [HotelLandingController::class, 'index'])->name('hotel.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://hotel.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('hotel.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://hotel.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('hotel.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('hotel.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/hotel -> http://hotel.zengfy.top:8000/)
Route::get('/hotel', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://hotel.{$baseDomain}{$portSuffix}/");
})->name('hotel.redirect');
