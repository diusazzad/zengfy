<?php

use Illuminate\Support\Facades\Route;
use Modules\School\Http\Controllers\SchoolLandingController;

/*
|--------------------------------------------------------------------------
| School Module Web Routes (Subdomain Architecture: school.zengfy.test)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy School Landing Page at school.zengfy.test.
| All legacy incomplete sub-routes have been cleanly pruned
| in accordance with the single-module clean landing plan.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));

// 1. Dedicated Subdomain: school.zengfy.test:8000
Route::domain('school.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 White Glassmorphic School Landing Page
    Route::get('/', [SchoolLandingController::class, 'index'])->name('school.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://school.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('school.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://school.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('school.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('school.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.test:8000/school -> http://school.zengfy.test:8000/)
Route::get('/school', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://school.{$baseDomain}{$portSuffix}/");
})->name('school.redirect');
