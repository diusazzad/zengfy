<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Alias routes for cleaner URLs
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.page');
Route::get('/signup', [AuthController::class, 'showSignup']);
