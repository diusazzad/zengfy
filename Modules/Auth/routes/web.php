<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Web\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Protected Routes
});
