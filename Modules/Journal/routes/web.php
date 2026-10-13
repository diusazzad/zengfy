<?php

use Illuminate\Support\Facades\Route;
use Modules\Journal\Http\Controllers\JournalLandingController;

/*
|--------------------------------------------------------------------------
| Journal Module Web Routes (Subdomain Architecture: journal.zengfy.test)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Journal Landing Page at journal.zengfy.test.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));

// 1. Dedicated Subdomain: journal.zengfy.test:8000
Route::domain('journal.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Electric Cobalt Blue & Neon Cyan Journal Landing Page
    Route::get('/', [JournalLandingController::class, 'index'])->name('journal.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://journal.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('journal.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://journal.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('journal.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('journal.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.test:8000/journal -> http://journal.zengfy.test:8000/)
Route::get('/journal', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://journal.{$baseDomain}{$portSuffix}/");
})->name('journal.redirect');
