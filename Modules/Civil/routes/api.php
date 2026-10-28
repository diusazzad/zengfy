<?php

use Illuminate\Support\Facades\Route;
use Modules\Civil\Http\Controllers\CivilLandingController;

/*
|--------------------------------------------------------------------------
| Civil Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Serves headless JSON payloads for React 19 web app and Flutter mobile apps.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/civil/landing', [CivilLandingController::class, 'data'])->name('api.v1.civil.landing');
    Route::get('/civil', [CivilLandingController::class, 'data'])->name('api.v1.civil');
});
