<?php

use Illuminate\Support\Facades\Route;
use Modules\Skill\Http\Controllers\SkillLandingController;

/*
|--------------------------------------------------------------------------
| Skill Module Public REST API Routes
|--------------------------------------------------------------------------
|
| Serves headless JSON payloads for React 19 web app and Flutter mobile apps.
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/skill/landing', [SkillLandingController::class, 'data'])->name('api.v1.skill.landing');
    Route::get('/skill', [SkillLandingController::class, 'data'])->name('api.v1.skill');
});
