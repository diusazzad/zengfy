<?php

use Illuminate\Support\Facades\Route;
use Modules\Landing\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Ecosystem Master Landing Web Routes
|--------------------------------------------------------------------------
|
| Entry point for Zengfy Ecosystem Landing (http://zengfy.top:8000/).
|
*/

// Root Landing Page (Renders React 19 White Glassmorphic App Shell)
Route::get('/', [LandingController::class, 'index'])->name('welcome');

// Direct Mobile APK Download
Route::get('/download', function () {
    return redirect()->away('https://github.com/diusazzad/zengfy/releases');
})->name('download.app');

// Central login & register handled by Modules/Auth
