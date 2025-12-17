<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\MainController;
use Modules\Main\Http\Controllers\AccountController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('mains', MainController::class)->names('main');

    Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});
