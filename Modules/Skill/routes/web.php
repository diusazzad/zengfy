<?php

use Illuminate\Support\Facades\Route;
use Modules\Skill\Http\Controllers\SkillLandingController;

/*
|--------------------------------------------------------------------------
| Skill Module Web Routes (Subdomain Architecture: skill.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Skill Landing Page at skill.zengfy.top.
| Follows the strict single-module isolated landing architecture.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

// 1. Dedicated Subdomain: skill.zengfy.top:8000
Route::domain('skill.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Electric Cobalt Blue & Neon Cyan Skill Landing Page
    Route::get('/', [SkillLandingController::class, 'index'])->name('skill.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://skill.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('skill.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://skill.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('skill.register');

    // Android APK Direct Download
    Route::get('/download', function () {
        return redirect()->away('https://github.com/diusazzad/zengfy/releases');
    })->name('skill.download');
});

// 2. Base Domain Forwarder (e.g. http://zengfy.top:8000/skill -> http://skill.zengfy.top:8000/)
Route::get('/skill', function () use ($baseDomain) {
    $scheme = request()->getScheme();
    $port = request()->getPort();
    $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
    return redirect("{$scheme}://skill.{$baseDomain}{$portSuffix}/");
})->name('skill.redirect');
