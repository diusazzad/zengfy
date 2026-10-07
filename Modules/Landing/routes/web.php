<?php

use Illuminate\Support\Facades\Route;
use Modules\Landing\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Web Routes for Landing Module
|--------------------------------------------------------------------------
|
| Handles the root landing page with a separate dedicated LandingController.
|
*/

Route::get('/', [LandingController::class, 'index'])->name('welcome');
