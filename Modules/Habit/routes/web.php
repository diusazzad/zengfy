<?php

use Illuminate\Support\Facades\Route;
use Modules\Habit\Http\Controllers\HabitLandingController;

/*
|--------------------------------------------------------------------------
| Habit Module Web Routes (Subdomain Architecture: habit.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Habit Landing Page at habit.zengfy.top.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: habit.zengfy.top:8000
Route::domain('habit.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Vitality Emerald & Sunrise Amber Habit Landing Page
    Route::get('/', [HabitLandingController::class, 'index'])->name('habit.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://habit.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('habit.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://habit.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('habit.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('habit.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/habit -> http://habit.zengfy.top:8000/)
Route::get('/habit', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://habit.{$baseDomain}{$portSuffix}/");
})->name('habit.redirect');
