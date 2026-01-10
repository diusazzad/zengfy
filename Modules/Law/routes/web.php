<?php

use Illuminate\Support\Facades\Route;
use Modules\Law\Http\Controllers\BillingController;
use Modules\Law\Http\Controllers\AdminController;
use Modules\Law\Http\Controllers\DashboardController;
use Modules\Law\Http\Controllers\CaseController;
use Modules\Law\Http\Controllers\Auth\GoogleController;

Route::get('/login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('login.google.callback');

Route::middleware('auth')->group(function () {
    // Billing
    Route::get('/billing/checkout', [BillingController::class, 'checkout'])->name('billing.checkout');
    Route::post('/billing/checkout/complete', [BillingController::class, 'complete'])->name('billing.complete');

    Route::middleware('account.active')->group(function () {
        // Admin
        Route::prefix('admin')->name('admin.')->middleware('admin.only')->group(function () {
            Route::get('/users', [AdminController::class, 'index'])->name('users.index');
            Route::get('/users/create', [AdminController::class, 'create'])->name('users.create');
            Route::post('/users', [AdminController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
        });

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Widget routes
        Route::get('/cases/today', [DashboardController::class, 'todayCases'])->name('cases.today');
        Route::get('/cases/tomorrow', [DashboardController::class, 'tomorrowCases'])->name('cases.tomorrow');
        Route::get('/cases/week', [DashboardController::class, 'weekCases'])->name('cases.week');
        Route::get('/cases/month', [DashboardController::class, 'monthCases'])->name('cases.month');
        Route::get('/cases/active', [DashboardController::class, 'activeCases'])->name('cases.active');
        Route::get('/cases/pending', [DashboardController::class, 'pendingCases'])->name('cases.pending');
        Route::get('/cases/total', [DashboardController::class, 'totalCases'])->name('cases.total');

        // Profile routes
        Route::get('/profile', [DashboardController::class, 'showProfile'])->name('profile.show');
        Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile/change-password', [DashboardController::class, 'showChangePassword'])->name('profile.change-password');
        Route::put('/profile/change-password', [DashboardController::class, 'updatePassword'])->name('profile.update-password');

        // Case Print
        Route::get('/cases/{case}/print', [DashboardController::class, 'casePrint'])->name('cases.print');
        // Case Calender
        Route::get('/cases/calendar', [DashboardController::class, 'caseCalendar'])->name('cases.calendar');
        Route::get('/cases/index', [DashboardController::class, 'caseIndex'])->name('cases.index');
        Route::get('/cases/create', [DashboardController::class, 'caseCreate'])->name('cases.create');
        Route::post('/cases', [DashboardController::class, 'caseStore'])->name('cases.store');
        Route::get('/cases/{case}/edit', [DashboardController::class, 'caseEdit'])->name('cases.edit');
        Route::put('/cases/{case}', [DashboardController::class, 'caseUpdate'])->name('cases.update');
        Route::delete('/cases/{case}', [DashboardController::class, 'caseDestroy'])->name('cases.destroy');

        // Case Type Routes
        Route::get('/case-types/search', [DashboardController::class, 'searchCaseTypes'])->name('case-types.search');
        Route::post('/case-types/add', [DashboardController::class, 'addCaseType'])->name('case-types.add');

        // Case Stage Routes
        Route::get('/case-stages/search', [DashboardController::class, 'searchCaseStages'])->name('case-stages.search');
        Route::post('/case-stages/add', [DashboardController::class, 'addCaseStage'])->name('case-stages.add');

        // Court Routes
        Route::get('/courts/search', [DashboardController::class, 'searchCourts'])->name('courts.search');
        Route::post('/courts/add', [DashboardController::class, 'addCourt'])->name('courts.add');

        // Case Recycle Bin Routes
        Route::get('/cases/recycle-bin', [DashboardController::class, 'recycleBin'])->name('cases.recycle-bin');
        Route::post('/cases/{id}/restore', [DashboardController::class, 'restoreCase'])->name('cases.restore');
        Route::delete('/cases/{id}/permanent-delete', [DashboardController::class, 'permanentDelete'])->name('cases.permanent-delete');

        // Case View Page Routes
        Route::get('/cases/{id}', [DashboardController::class, 'caseShow'])->name('cases.show');
        Route::get('/cases/{case}/download', [DashboardController::class, 'caseDownload'])->name('cases.download');
        // case share 
        Route::get('/cases/share/{token}', [DashboardController::class, 'caseShare'])->name('cases.share.public');
        Route::get('/cases/{case}/history', [DashboardController::class, 'caseHistory'])->name('cases.history');

        // Case Attachment Routes
        Route::post('/cases/{case}/attachments', [DashboardController::class, 'storeAttachment'])->name('cases.attachments.store');
        Route::delete('/cases/attachments/{attachment}', [DashboardController::class, 'destroyAttachment'])->name('cases.attachments.destroy');

        // Case Notes Routes
        Route::post('/cases/{case}/notes', [DashboardController::class, 'storeNote'])->name('cases.notes.store');
        Route::delete('/cases/notes/{note}', [DashboardController::class, 'destroyNote'])->name('cases.notes.destroy');
    });
});
