<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\MainController;
use Modules\Main\Http\Controllers\AccountController;
use Modules\Main\Http\Controllers\AdminVerificationController;
use Modules\Main\Http\Controllers\ProfileController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('mains', MainController::class)->names('main');

    Route::get('/dashboard', function () {
        return redirect()->route('welcome');
    })->name('dashboard');
    Route::post('/posts/{post}/like', [MainController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comment', [MainController::class, 'storeComment'])->name('posts.comment');

    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile');

    // Admin Verification Hub
    Route::middleware(['admin.only'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/verifications', [AdminVerificationController::class, 'index'])->name('verifications.index');
        Route::post('/verifications/{user}/verify', [AdminVerificationController::class, 'verify'])->name('verifications.verify');
        Route::post('/verifications/{user}/reject', [AdminVerificationController::class, 'reject'])->name('verifications.reject');
    });
});
