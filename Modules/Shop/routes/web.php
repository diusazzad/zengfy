<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\ShopLandingController;

/*
|--------------------------------------------------------------------------
| Shop Module Web Routes (shop.zengfy.top)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Atelier / Clothing Brand Storefront
| strictly on shop.zengfy.top.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));

Route::domain('shop.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Fashion D2C Clothing Brand Storefront
    Route::get('/', [ShopLandingController::class, 'index'])->name('shop.landing');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://shop.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode($continue));
    })->name('shop.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";
        $continue = request()->query('continue') ?? "{$scheme}://shop.{$baseDomain}{$portSuffix}/";
        return redirect("{$scheme}://accounts.{$baseDomain}{$portSuffix}/register?continue=" . urlencode($continue));
    })->name('shop.register');

    // Direct Lookbook / Size Guide Route
    Route::get('/size-guide', [ShopLandingController::class, 'index'])->name('shop.size_guide');
});

// Direct Fallback Route for /shop on any domain/subdomain
Route::get('/shop', [ShopLandingController::class, 'index'])->name('shop.fallback');
