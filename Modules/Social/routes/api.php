<?php

use Illuminate\Support\Facades\Route;
use Modules\Social\Http\Controllers\SocialLandingController;

/*
|--------------------------------------------------------------------------
| Social Module Public REST API Routes (v1)
|--------------------------------------------------------------------------
|
| Serves social feeds, telemetry, SOS radar metrics, and ecosystem links.
| Publicly accessible to both the React 19 Web Landing and the Flutter Mobile App.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/social/landing', [SocialLandingController::class, 'data'])
        ->name('api.v1.social.landing');

    Route::get('/social', [SocialLandingController::class, 'data'])
        ->name('api.v1.social');
});
