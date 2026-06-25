<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Modules\Team\Http\Controllers\TeamLoginController;
use Modules\Team\Http\Controllers\TeamAdminController;
use Modules\Team\Models\Team;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Team Page
Route::get('/team', function () {
    $team = Team::where('status', 'active')->orderBy('order')->get();
    return View('team::public', compact('team'));
})->name('team.public');

Route::get('/team-alias', function () {
    return redirect()->route('team.public');
})->name('team');

// Standalone Team Login
Route::prefix('team')->name('team.')->group(function () {
    Route::get('/login', [TeamLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [TeamLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [TeamLoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [TeamLoginController::class, 'logout'])->name('logout.get');

    // Protected Admin Routes using dedicated 'team' guard
    Route::middleware(['auth:team'])->group(function () {
        // Simple resource mapping for admin operations
        Route::resource('admin', TeamAdminController::class);
    });
});
