<?php

use Illuminate\Support\Facades\Route;
use Modules\School\Http\Controllers\SchoolController;


// only for school.zengfy.top domain
Route::domain('school.' . env('APP_BASE_DOMAIN', 'zengfy.top'))->group(function () {

    // School Landing Page
    Route::get('/', [SchoolController::class, 'index'])->name('school.home');

    // School Demo Request / Waitlist (Phase 1)
    Route::get('/request-access', [SchoolController::class, 'requestAccess'])->name('school.request');

});
