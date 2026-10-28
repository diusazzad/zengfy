<?php

use Illuminate\Support\Facades\Route;
use Modules\Habit\Http\Controllers\HabitLandingController;

/*
|--------------------------------------------------------------------------
| Habit Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Exposes /api/v1/habit/landing and /api/v1/habit for client hydration.
|
*/

Route::prefix('v1/habit')->group(function () {
    Route::get('/landing', [HabitLandingController::class, 'data'])->name('api.v1.habit.landing');
    Route::get('/', [HabitLandingController::class, 'data'])->name('api.v1.habit');
});
