<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::prefix('v1/auth')->group(function () {
    // 5 attempts per minute per IP to protect from bot army
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:5,1');
});
