<?php

use Illuminate\Support\Facades\Route;
use Modules\Schedule\Http\Controllers\ScheduleLandingController;

/*
|--------------------------------------------------------------------------
| Schedule Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Exposes /api/v1/schedule/landing and /api/v1/schedule for client hydration.
|
*/

Route::prefix('v1/schedule')->group(function () {
    Route::get('/landing', [ScheduleLandingController::class, 'data'])->name('api.v1.schedule.landing');
    Route::get('/', [ScheduleLandingController::class, 'data'])->name('api.v1.schedule');
});
