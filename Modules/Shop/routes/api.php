<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\ShopLandingController;

/*
|--------------------------------------------------------------------------
| Shop / Atelier Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Exposes /api/v1/shop/landing and /api/v1/shop/catalog.
|
*/

Route::prefix('v1/shop')->group(function () {
    Route::get('/landing', [ShopLandingController::class, 'data'])->name('api.shop.landing');
    Route::get('/catalog', [ShopLandingController::class, 'data'])->name('api.shop.catalog');
    Route::get('/', [ShopLandingController::class, 'data'])->name('api.shop');
});
