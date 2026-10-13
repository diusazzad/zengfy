<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes (Active: Master, Social, School, POS, Law, Civil, NGO, Rent, Hotel, Shop & Skill)
|--------------------------------------------------------------------------
|
| Public REST API endpoints consumed by React 19 Web Apps and Flutter Mobile App.
|
*/

// 1. Ecosystem Master Landing API (v1)
require base_path('Modules/Landing/routes/api.php');

// 2. Social Subdomain Landing API (v1)
require base_path('Modules/Social/routes/api.php');

// 3. School Subdomain Landing API (v1)
require base_path('Modules/School/routes/api.php');

// 4. POS Subdomain Landing API (v1)
require base_path('Modules/POS/routes/api.php');

// 5. Law Subdomain Landing API (v1)
require base_path('Modules/Law/routes/api.php');

// 6. Civil Subdomain Landing API (v1)
require base_path('Modules/Civil/routes/api.php');

// 7. NGO Subdomain Landing API (v1)
require base_path('Modules/NGO/routes/api.php');

// 8. Rent Subdomain Landing API (v1)
require base_path('Modules/Rent/routes/api.php');

// 9. Hotel Subdomain Landing API (v1)
require base_path('Modules/Hotel/routes/api.php');

// 10. Shop Subdomain Landing API (v1)
require base_path('Modules/Shop/routes/api.php');

// 11. Skill Subdomain Landing API (v1)
require base_path('Modules/Skill/routes/api.php');

// 12. Journal Subdomain Landing API (v1)
require base_path('Modules/Journal/routes/api.php');

// 13. Habit Subdomain Landing API (v1)
require base_path('Modules/Habit/routes/api.php');

// 14. Schedule Subdomain Landing API (v1)
require base_path('Modules/Schedule/routes/api.php');

// 15. Ecommerce Subdomain Landing API (v1)
require base_path('Modules/Ecommerce/routes/api.php');
