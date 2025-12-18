<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login'); // mapped to /auth
    Route::get('/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [LoginController::class, 'handleGoogleCallback']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Since user wants /login to work as well, we can add a root route specific for login redirect or alias
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.page');
