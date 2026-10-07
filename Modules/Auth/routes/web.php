<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Auth Module Web Routes
|--------------------------------------------------------------------------
|
| Handles authentication views, user onboarding, password recovery,
| and sovereign session termination for web browser clients.
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegister')->name('register');
    Route::get('/forgot-password', 'showForgotPassword')->name('password.request');
    Route::get('/reset-password/{token?}', 'showResetPassword')->name('password.reset');

    // Web Logout (POST preferred, GET supported for browser convenience)
    Route::match(['GET', 'POST'], '/logout', 'webLogout')->name('logout');
});
