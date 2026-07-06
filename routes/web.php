<?php

use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;
use Modules\Main\Http\Controllers\MainController;
use Modules\Main\Http\Controllers\AccountController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Modules\Team\Http\Controllers\TeamLoginController;



// Language Switcher Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::match(['get', 'post'], '/logout', [TeamLoginController::class, 'logout'])->name('logout');

// Public Page Routes
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/policy/workplace', [PageController::class, 'workplacePolicy'])->name('policy.workplace');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::post('/sos/trigger', [PageController::class, 'triggerSOS'])->name('sos.trigger');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/download-app', [PageController::class, 'downloadApp'])->name('download.app');
Route::post('/faq/submit', [PageController::class, 'submitQuestion'])->name('faq.submit');

// Blog Routes (Kept as stubs)
Route::prefix('blog')->group(function () {
    Route::get('/', function () {
        return "Zengfy Blog - Coming Soon";
    })->name('blog.index');
});


