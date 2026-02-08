<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\MainController;
use Modules\Main\Http\Controllers\AccountController;
use App\Http\Controllers\PageController;

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

// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Public Page Routes
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::post('/sos/trigger', [PageController::class, 'triggerSOS'])->name('sos.trigger');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/download-app', [PageController::class, 'downloadApp'])->name('download.app');
Route::post('/faq/submit', [PageController::class, 'submitQuestion'])->name('faq.submit');

// Secured Main Module Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('mains', MainController::class)->names('main');
    Route::get('/dashboard', function () {
        return redirect()->route('welcome');
    })->name('dashboard');
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});


// Auth routes are loaded from Modules/Auth/Routes/web.php