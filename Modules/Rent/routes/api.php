<?php

use Illuminate\Support\Facades\Route;
use Modules\Rent\Http\Controllers\RentLandingController;

/*
|--------------------------------------------------------------------------
| Rent Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Serves headless JSON payloads for React 19 web app and Flutter mobile apps.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/rent/landing', [RentLandingController::class, 'data'])->name('api.v1.rent.landing');
    Route::get('/rent', [RentLandingController::class, 'data'])->name('api.v1.rent');
});
