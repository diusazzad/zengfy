<?php

use Illuminate\Support\Facades\Route;
use Modules\Law\Http\Controllers\LawLandingController;

/*
|--------------------------------------------------------------------------
| Law Module Public REST API Routes (v1)
|--------------------------------------------------------------------------
|
| Serves legal chamber telemetry, cause list sample case, 4 stakeholder journeys,
| 4 legal pillars, 3-tier commercial packages, and SSO links.
| Publicly accessible to both the React 19 Web Landing and the Flutter Mobile App.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/law/landing', [LawLandingController::class, 'data'])
        ->name('api.v1.law.landing');

    Route::get('/law', [LawLandingController::class, 'data'])
        ->name('api.v1.law');
});