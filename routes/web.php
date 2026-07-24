<?php

use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubdomainLandingController;

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/sitemap.xml', [SitemapController::class, 'index']);


// Public Page Routes
Route::domain(env('APP_BASE_DOMAIN', 'zengfy.top'))->controller(PageController::class)->group(function () {
    Route::get('/', 'welcome')->name('welcome');
    Route::get('/products', 'products')->name('products');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/company', 'company')->name('company');
    Route::get('/policy/workplace', 'workplacePolicy')->name('policy.workplace');
    Route::get('/faq', 'faq')->name('faq');
    Route::post('/sos/trigger', 'triggerSOS')->name('sos.trigger');
    Route::get('/services', 'services')->name('services');
    Route::get('/download-app', 'downloadApp')->name('download.app');
    Route::post('/faq/submit', 'submitQuestion')->name('faq.submit');
});


// Wildcard Subdomain Landing Engine
Route::domain('{subdomain}.' . env('APP_BASE_DOMAIN', 'zengfy.top'))->group(function () {
    Route::get('/', [SubdomainLandingController::class, 'show'])->name('subdomain.landing');
});
