<?php

use Illuminate\Support\Facades\Route;
use Modules\POS\Http\Controllers\POSLandingController;

/*
|--------------------------------------------------------------------------
| POS Module Public REST API Routes (v1)
|--------------------------------------------------------------------------
|
| Serves fashion retail & boutique telemetry, barcode demo inventory items,
| thermal bill specs, and 3-tier commercial packages for Bangladesh stores.
| Publicly accessible to both the React 19 Web Landing and the Flutter Mobile App.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/pos/landing', [POSLandingController::class, 'data'])
        ->name('api.v1.pos.landing');

    Route::get('/pos', [POSLandingController::class, 'data'])
        ->name('api.v1.pos');
});