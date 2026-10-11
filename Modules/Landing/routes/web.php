<?php

use Illuminate\Support\Facades\Route;
use Modules\Landing\Http\Controllers\LandingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubdomainLandingController;

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));

/*
|--------------------------------------------------------------------------
| Landing & Ecosystem Marketing Routes
|--------------------------------------------------------------------------
*/

// 1. Root Landing Page
Route::get('/', [LandingController::class, 'index'])->name('welcome');

// 2. Informational & Legal Pages
Route::controller(PageController::class)->group(function () {
    Route::get('/products', 'products')->name('products');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/company', 'company')->name('company');
    Route::get('/team', fn() => redirect()->route('company'))->name('team');
    Route::get('/download', 'downloadApp')->name('download.app');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/policy/workplace', 'workplacePolicy')->name('policy.workplace');
    Route::get('/faq', 'faq')->name('faq');
    Route::post('/faq', 'submitQuestion')->name('faq.submit');

    // Traffic Safeguards / Error Previews
    Route::get('/429', fn() => response()->view('errors.429', [], 429));
    Route::get('/503', fn() => response()->view('errors.503', [], 503));
});

// 3. Wildcard Subdomain Landing Engine (e.g. pos.zengfy.test, law.zengfy.test, hotel.zengfy.test)
// Excludes 'social', 'school', and 'www' which have their own dedicated handlers
Route::domain('{subdomain}.' . $baseDomain)
    ->where(['subdomain' => '^(?!social$|school$|www$).*'])
    ->group(function () use ($baseDomain) {
        Route::get('/', [SubdomainLandingController::class, 'show'])->name('subdomain.landing');

        // Central Sovereign Login & Register Forwarders for wildcard subdomains
        Route::get('/login', function ($subdomain) use ($baseDomain) {
            $scheme = request()->getScheme();
            $port = request()->getPort();
            $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
            $originUrl = request()->query('continue') ?? "{$scheme}://{$subdomain}.{$baseDomain}{$portSuffix}/";
            return redirect("{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode($originUrl));
        })->name('subdomain.login');

        Route::get('/register', function ($subdomain) use ($baseDomain) {
            $scheme = request()->getScheme();
            $port = request()->getPort();
            $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
            $originUrl = request()->query('continue') ?? "{$scheme}://{$subdomain}.{$baseDomain}{$portSuffix}/";
            return redirect("{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode($originUrl));
        })->name('subdomain.register');
    });
