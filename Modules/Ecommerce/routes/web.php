<?php

use Illuminate\Support\Facades\Route;
use Modules\Ecommerce\Http\Controllers\EcommerceMarketplaceController;

/*
|--------------------------------------------------------------------------
| Ecommerce Module Web Routes (ecommerce.zengfy.test)
|--------------------------------------------------------------------------
|
| Handles the dedicated Zengfy Multi-Vendor Marketplace Home Feed
| strictly on ecommerce.zengfy.test.
|
*/

$baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));

Route::domain('ecommerce.' . $baseDomain)->group(function () use ($baseDomain) {
    // Dedicated React 19 Daraz-style Simple & Clean Marketplace Home Feed
    Route::get('/', [EcommerceMarketplaceController::class, 'index'])->name('ecommerce.marketplace');

    // Central Identity Single Sign-On Forwarders
    Route::get('/login', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : '';
        return redirect()->away("{$scheme}://auth.{$baseDomain}{$portSuffix}/login?return_to=" . urlencode(url()->current()));
    })->name('ecommerce.login');

    Route::get('/register', function () use ($baseDomain) {
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : '';
        return redirect()->away("{$scheme}://auth.{$baseDomain}{$portSuffix}/register?intent=merchant&return_to=" . urlencode(url()->current()));
    })->name('ecommerce.register');
});

// Direct Fallback Route for /ecommerce and /marketplace on any domain/subdomain
Route::get('/ecommerce', [EcommerceMarketplaceController::class, 'index'])->name('ecommerce.fallback');
Route::get('/marketplace', [EcommerceMarketplaceController::class, 'index'])->name('ecommerce.marketplace.fallback');
