<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Single-Module Isolation: Master, Social, School, POS, Law, Civil, NGO, Rent, Hotel, Shop & Skill)
|--------------------------------------------------------------------------
|
| Retain ONLY the verified active Landing modules.
| All legacy incomplete application routes remain detached.
|
*/

// Multilingual Locale Switcher (Shared Utility)
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// 1. Social Subdomain Landing Module (social.zengfy.top:8000)
require base_path('Modules/Social/routes/web.php');

// 2. School Subdomain Landing Module (school.zengfy.top:8000)
require base_path('Modules/School/routes/web.php');

// 3. POS Subdomain Landing Module (pos.zengfy.top:8000)
require base_path('Modules/POS/routes/web.php');

// 4. Law Subdomain Landing Module (law.zengfy.top:8000)
require base_path('Modules/Law/routes/web.php');

// 5. Civil Subdomain Landing Module (civil.zengfy.top:8000)
require base_path('Modules/Civil/routes/web.php');

// 6. NGO Subdomain Landing Module (ngo.zengfy.top:8000)
require base_path('Modules/NGO/routes/web.php');

// 7. Rent Subdomain Landing Module (rent.zengfy.top:8000)
require base_path('Modules/Rent/routes/web.php');

// 8. Hotel Subdomain Landing Module (hotel.zengfy.top:8000)
require base_path('Modules/Hotel/routes/web.php');

// 9. Shop Subdomain Landing Module (shop.zengfy.top:8000)
require base_path('Modules/Shop/routes/web.php');

// 10. Skill Subdomain Landing Module (skill.zengfy.top:8000)
require base_path('Modules/Skill/routes/web.php');

// 11. Journal Subdomain Landing Module (journal.zengfy.top:8000)
require base_path('Modules/Journal/routes/web.php');

// 12. Habit Subdomain Landing Module (habit.zengfy.top:8000)
require base_path('Modules/Habit/routes/web.php');

// 13. Schedule Subdomain Landing Module (schedule.zengfy.top:8000)
require base_path('Modules/Schedule/routes/web.php');

// 14. Ecommerce Subdomain Landing Module (ecommerce.zengfy.top:8000)
require base_path('Modules/Ecommerce/routes/web.php');

// 15. Central Sovereign Auth & Identity Module
require base_path('Modules/Auth/routes/web.php');

require base_path('Modules/Landing/routes/web.php');

// 16. Ecosystem Informational & Legal Pages
Route::view('/terms', 'terms')->name('terms');
Route::view('/faq', 'faq')->name('faq');
Route::view('/pricing', 'pricing')->name('pricing');
Route::view('/company', 'company')->name('company');
Route::view('/products', 'products')->name('products');
Route::view('/services', 'services')->name('services');
