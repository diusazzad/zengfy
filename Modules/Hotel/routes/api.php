<?php

use Illuminate\Support\Facades\Route;
use Modules\Hotel\Http\Controllers\HotelLandingController;

/*
|--------------------------------------------------------------------------
| Hotel Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Serves headless JSON payloads for React 19 web app and Flutter mobile apps.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/hotel/landing', [HotelLandingController::class, 'data'])->name('api.v1.hotel.landing');
    Route::get('/hotel', [HotelLandingController::class, 'data'])->name('api.v1.hotel');
});
