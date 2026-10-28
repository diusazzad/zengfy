<?php

use Illuminate\Support\Facades\Route;
use Modules\Journal\Http\Controllers\JournalLandingController;

Route::prefix('v1')->group(function () {
    Route::get('/journal/landing', [JournalLandingController::class, 'data'])->name('api.v1.journal.landing');
    Route::get('/journal', [JournalLandingController::class, 'data'])->name('api.v1.journal');
});
