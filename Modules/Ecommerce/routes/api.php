<?php

use Illuminate\Support\Facades\Route;
use Modules\Ecommerce\Http\Controllers\EcommerceMarketplaceController;

/*
|--------------------------------------------------------------------------
| Ecommerce Module API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1/ecommerce')->group(function () {
    Route::get('/landing', [EcommerceMarketplaceController::class, 'getLandingData'])->name('api.ecommerce.landing');
});
