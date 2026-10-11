<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Auth & Sovereign Identity Module Web Routes
|--------------------------------------------------------------------------
*/

// 1. Guest Authentication & Session Management
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegister')->name('register');
    Route::get('/forgot-password', 'showForgotPassword')->name('password.request');
    Route::get('/reset-password/{token?}', 'showResetPassword')->name('password.reset');

    // Web Logout (POST preferred, GET supported for browser convenience)
    Route::match(['GET', 'POST'], '/logout', 'webLogout')->name('logout');
});

// 2. Authenticated Sovereign Account Hub & Device Management
Route::controller(AccountController::class)->middleware(['auth'])->group(function () {
    Route::get('/account', 'dashboard')->name('account');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/account/profile', 'updateProfile')->name('account.profile');
    Route::post('/account/avatar', 'updateAvatar')->name('account.avatar');
    Route::delete('/account/avatar', 'removeAvatar')->name('account.avatar.remove');
    Route::post('/account/password', 'changePassword')->name('account.password');
    Route::post('/account/device/{id}/revoke', 'revokeDevice')->name('account.device.revoke');
    Route::post('/account/devices/revoke-all', 'revokeAllOtherDevices')->name('account.devices.revoke-all');
});
