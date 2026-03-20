<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\MainController;
use Modules\Main\Http\Controllers\AccountController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;

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

// Authentication Redirect Route
Route::get('/login', function () {
    return redirect()->route('team.login');
})->name('login');

Route::match(['get', 'post'], '/logout', [Modules\Team\Http\Controllers\TeamLoginController::class, 'logout'])->name('logout');

// Public Page Routes
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/policy/workplace', [PageController::class, 'workplacePolicy'])->name('policy.workplace');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::post('/sos/trigger', [PageController::class, 'triggerSOS'])->name('sos.trigger');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/download-app', [PageController::class, 'downloadApp'])->name('download.app');
Route::post('/faq/submit', [PageController::class, 'submitQuestion'])->name('faq.submit');

// Secured Main Module Routes
/* Disabled for landing-only focus
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});
*/

// Admin Management Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Other admin routes...
});

// Blog Routes (Kept as stubs)
Route::prefix('blog')->group(function () {
    Route::get('/', function () {
        return "Zengfy Blog - Coming Soon";
    })->name('blog.index');
    /* Disabled for landing-only focus
    Route::get('/{slug}', function ($slug) {
        return "Blog Post: " . $slug;
    })->name('blog.show');
    */
});

// Auth routes are loaded from Modules/Auth/Routes/web.php