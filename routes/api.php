<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes (Active: Master, Social, School, POS, Law, Civil, NGO & Rent)
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
