<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    // API routes for Team module
    // Route::apiResource('teams', TeamController::class)->names('team');
});
