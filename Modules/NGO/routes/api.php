<?php

use Illuminate\Support\Facades\Route;
use Modules\NGO\Http\Controllers\NGOLandingController;

/*
|--------------------------------------------------------------------------
| NGO Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Serves headless JSON payloads for React 19 web app and Flutter mobile apps.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/ngo/landing', [NGOLandingController::class, 'data'])->name('api.v1.ngo.landing');
    Route::get('/ngo', [NGOLandingController::class, 'data'])->name('api.v1.ngo');
});
