<?php

use Illuminate\Support\Facades\Route;
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

Route::middleware('web')->group(function () {
    // Public Team Page
    Route::get('/team', function () {
        $team = Team::where('status', 'active')->orderBy('order')->get();
        return view('team::public', compact('team'));
    })->name('team.public');

    // Standalone Team Login
    Route::prefix('team')->name('team.')->group(function () {
        Route::get('/login', [TeamLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [TeamLoginController::class, 'login'])->name('login.submit');
        Route::post('/logout', [TeamLoginController::class, 'logout'])->name('logout');

        // Protected Admin Routes
        Route::middleware(['auth'])->prefix('admin')->group(function () {
            Route::get('/', [TeamAdminController::class, 'index'])->name('admin.index');
            Route::get('/create', [TeamAdminController::class, 'create'])->name('admin.create');
            Route::post('/store', [TeamAdminController::class, 'store'])->name('admin.store');
            Route::get('/{team}/edit', [TeamAdminController::class, 'edit'])->name('admin.edit');
            Route::put('/{team}', [TeamAdminController::class, 'update'])->name('admin.update');
            Route::delete('/{team}', [TeamAdminController::class, 'destroy'])->name('admin.destroy');
        });
    });
});
