<?php

use Illuminate\Support\Facades\Route;
use Modules\School\Http\Controllers\SchoolLandingController;

/*
|--------------------------------------------------------------------------
| School Module Public REST API Routes (v1)
|--------------------------------------------------------------------------
|
| Serves institutional telemetry, RFID demo student profiles, grading specs,
| and 3-tier commercial packages for Bangladesh schools, colleges & madrasahs.
| Publicly accessible to both the React 19 Web Landing and the Flutter Mobile App.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/school/landing', [SchoolLandingController::class, 'data'])
        ->name('api.v1.school.landing');

    Route::get('/school', [SchoolLandingController::class, 'data'])
        ->name('api.v1.school');
});
