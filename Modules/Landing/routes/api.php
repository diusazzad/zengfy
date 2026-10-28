<?php

use Illuminate\Support\Facades\Route;
use Modules\Landing\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Ecosystem Master Landing API Routes (v1) - Public
|--------------------------------------------------------------------------
|
| Serves platform architecture, 13 micro-SaaS modules, stats, and SSO links.
| Accessible publicly by both the React Web Portal and the Flutter Android App.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/ecosystem/landing', [LandingController::class, 'data'])
        ->name('api.v1.ecosystem.landing');

    Route::get('/ecosystem', [LandingController::class, 'data'])
        ->name('api.v1.ecosystem');
});
