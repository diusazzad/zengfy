<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\v1\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1/auth')->group(function () {
    // Public Routes
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // Protected Routes
});
