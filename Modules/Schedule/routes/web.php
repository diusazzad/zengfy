<?php

use Illuminate\Support\Facades\Route;
use Modules\Schedule\Http\Controllers\ScheduleLandingController;

/*
|--------------------------------------------------------------------------
| Schedule Module Web Routes (Subdomain Architecture: schedule.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Schedule Landing Page at schedule.zengfy.top.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: schedule.zengfy.top:8000
Route::domain('schedule.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Royal Indigo & Electric Cyan Schedule Landing Page
    Route::get('/', [ScheduleLandingController::class, 'index'])->name('schedule.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://schedule.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('schedule.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://schedule.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('schedule.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('schedule.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/schedule -> http://schedule.zengfy.top:8000/)
Route::get('/schedule', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://schedule.{$baseDomain}{$portSuffix}/");
})->name('schedule.redirect');
