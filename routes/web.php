<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes (Master Modular Registry)
|--------------------------------------------------------------------------
|
| This file serves as the clean master registry orchestrating domain modules.
| Specific route implementations are encapsulated inside their respective Modules.
|
*/

// 1. Global Language Switcher & SEO Sitemap
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// 2. Subdomain Domain Modules (Registered First!)
require base_path('Modules/Social/routes/web.php');
require base_path('Modules/School/routes/web.php');

// 3. Central Identity & Sovereign Account Hub
require base_path('Modules/Auth/routes/web.php');

// 4. Root Landing, Marketing Pages & Wildcard Subdomain Engine
require base_path('Modules/Landing/routes/web.php');
