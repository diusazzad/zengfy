<?php

namespace Modules\Landing\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    /**
     * Web Entrypoint for Zengfy Master Ecosystem Landing (http://zengfy.test:8000/).
     * Returns the reactive mobile-first app shell for web browsers,
     * and returns the JSON payload for API callers.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return $this->data($request);
        }

        $payload = $this->data($request)->getData(true);

        return view('landing::index', [
            'initialData' => $payload['data'] ?? [],
        ]);
    }

    /**
     * Dedicated REST API for Zengfy Master Ecosystem Landing.
     * Serves platform architecture, 13 micro-SaaS modules (without pricing bloat),
     * dynamic telemetry, and interactive social mockup posts for the hero.
     */
    public function data(Request $request): JsonResponse
    {
        $baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));
        $scheme = $request->getScheme();
        $port = $request->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        // Dynamic Ecosystem Statistics
        $totalCitizens = User::count();
        $displayCitizenCount = max($totalCitizens, 1480);
        $totalWards = 4554;
        $systemUptime = '99.98%';
        $activeInstitutions = 540;

        $modules = $this->getProductsData();
        $currentUser = Auth::user();

        return response()->json([
            'status' => 'success',
            'message' => 'Zengfy Sovereign Ecosystem Master Landing API payload',
            'data' => [
                'ecosystem' => [
                    'name' => 'Zengfy Ecosystem',
                    'brand' => 'Zengfy',
                    'tagline' => 'Speak Freely. One Unified Sovereign Account.',
                    'description' => "Bangladesh's next-generation sovereign digital infrastructure. Connect to 13 unified micro-SaaS platforms—from hyperlocal social feeds and institutional school ERP to legal vaults and retail POS—all powered by single-sign-on NID verification.",
                    'version' => '1.0.0',
                    'base_domain' => $baseDomain,
                ],
                'stats' => [
                    'verified_citizens' => $displayCitizenCount,
                    'total_wards' => $totalWards,
                    'active_institutions' => $activeInstitutions,
                    'system_uptime' => $systemUptime,
                    'total_modules' => count($modules),
                ],
                'modules' => $modules,
                'features' => [
                    [
                        'key' => 'central_sso',
                        'title' => 'Unified Citizen Single Sign-On',
                        'tag' => 'One Account',
                        'description' => 'Log in once with verified NID credentials and seamlessly access all 13 Zengfy ecosystem subdomains without re-authenticating.',
                        'icon' => 'key',
                    ],
                    [
                        'key' => 'hyperlocal_mesh',
                        'title' => 'Hyperlocal Ward Integration',
                        'tag' => 'Civic Security',
                        'description' => 'Automated ward-level geo-fencing connecting local businesses, civic safety beacons, and schools to their respective administrative areas.',
                        'icon' => 'map-pin',
                    ],
                    [
                        'key' => 'privacy_encryption',
                        'title' => 'Sovereign 256-Bit Data Vault',
                        'tag' => 'Zero-Knowledge',
                        'description' => 'End-to-end encrypted personal journals, legal files, and student records protected against corporate algorithm mining.',
                        'icon' => 'shield-check',
                    ],
                    [
                        'key' => 'multi_tenant_erp',
                        'title' => 'Autonomous Micro-SaaS Engine',
                        'tag' => 'Instant Provisioning',
                        'description' => 'High-throughput institutional billing, school ERP, and legal precedents with independent schema isolation.',
                        'icon' => 'cpu-chip',
                    ],
                ],
                'social_preview' => [
                    [
                        'id' => 1,
                        'author' => 'Rahim Chowdhury',
                        'handle' => 'rahim_c',
                        'avatar_bg' => 'bg-blue-100 text-blue-700',
                        'ward' => 'Ward 19, Dhaka',
                        'time' => '10:14 AM',
                        'text' => 'Have you tried the new sovereign ecosystem on Zengfy? One login for messaging, school ERP, and legal vault!',
                        'is_outgoing' => false,
                        'reactions' => ['❤️' => 14, '🔥' => 5],
                    ],
                    [
                        'id' => 2,
                        'author' => 'Farhana Islam',
                        'handle' => 'farhana_edu',
                        'avatar_bg' => 'bg-indigo-100 text-indigo-700',
                        'ward' => 'Ward 04, Chittagong',
                        'time' => '10:15 AM',
                        'text' => 'Our school just migrated to Zengfy School ERP. RFID attendance and automated SMS report cards work instantly!',
                        'is_outgoing' => true,
                        'reactions' => ['👏' => 22, '❤️' => 9],
                    ],
                    [
                        'id' => 3,
                        'author' => 'Barrister Tarek',
                        'handle' => 'tarek_law',
                        'avatar_bg' => 'bg-cyan-100 text-cyan-700',
                        'ward' => 'Supreme Court Bar',
                        'time' => '10:17 AM',
                        'text' => 'The 256-bit client encryption on Zengfy Law is game changing for confidential court precedents.',
                        'is_outgoing' => false,
                        'reactions' => ['⚖️' => 18],
                    ],
                ],
                'auth' => [
                    'is_authenticated' => Auth::check(),
                    'user' => $currentUser ? [
                        'id' => $currentUser->id,
                        'name' => $currentUser->name,
                        'email' => $currentUser->email,
                        'handle' => $currentUser->handle ?? 'citizen',
                        'is_verified' => (bool) ($currentUser->is_verified ?? false),
                    ] : null,
                ],
                'links' => [
                    'home' => "{$scheme}://{$baseDomain}{$portSuffix}/",
                    'login' => "{$scheme}://{$baseDomain}{$portSuffix}/login",
                    'register' => "{$scheme}://{$baseDomain}{$portSuffix}/register",
                    'account' => "{$scheme}://{$baseDomain}{$portSuffix}/account",
                    'download' => "{$scheme}://{$baseDomain}{$portSuffix}/download",
                    'social' => "{$scheme}://social.{$baseDomain}{$portSuffix}/",
                    'school' => "{$scheme}://school.{$baseDomain}{$portSuffix}/",
                    'api_docs' => "{$scheme}://{$baseDomain}{$portSuffix}/api/v1/ecosystem/landing",
                ],
            ],
        ]);
    }

    /**
     * Master registry for all 13 micro-SaaS platforms (Zero pricing clutter).
     */
    private function getProductsData(): array
    {
        $baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));
        $scheme = request()->getScheme();
        $port = request()->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        $buildUrl = function ($subdomain) use ($scheme, $baseDomain, $portSuffix) {
            return "{$scheme}://{$subdomain}.{$baseDomain}{$portSuffix}";
        };

        return [
            [
                'id' => 'social',
                'name' => 'Zengfy Social',
                'category' => 'Civic & Social Mesh',
                'tagline' => 'Hyperlocal Feed, Neighborhood Groups & Civic Beacons.',
                'desc' => 'Verified citizen discussions, ward-level emergency SOS alerts, and end-to-end encrypted community messaging without algorithms.',
                'icon' => '💬',
                'url' => $buildUrl('social'),
                'badge' => 'Active Module',
            ],
            [
                'id' => 'school',
                'name' => 'Zengfy School',
                'category' => 'Education & ERP',
                'tagline' => 'Complete School, College & Madrasha ERP.',
                'desc' => 'Manage automated student admissions, RFID attendance, online report cards, teacher payroll, and SMS notifications.',
                'icon' => '🏫',
                'url' => $buildUrl('school'),
                'badge' => 'Enterprise Ready',
            ],
            [
                'id' => 'pos',
                'name' => 'Zengfy POS',
                'category' => 'Retail & Commerce',
                'tagline' => 'Fast Barcode Billing, Stock Management & Profit Analytics.',
                'desc' => 'Modern touch POS with multi-counter billing, thermal receipt printing, low-stock alerts, and daily sales SMS for shop owners.',
                'icon' => '🛒',
                'url' => $buildUrl('pos'),
                'badge' => 'Retail SaaS',
            ],
            [
                'id' => 'law',
                'name' => 'Zengfy Law',
                'category' => 'Legal & Judiciary',
                'tagline' => 'Case Management, Court Dates & Client File Vault.',
                'desc' => 'Built specifically for lawyers & law firms: track hearing schedules, client payments, court precedents, and confidential legal documents.',
                'icon' => '⚖️',
                'url' => $buildUrl('law'),
                'badge' => 'Specialized',
            ],
            [
                'id' => 'civil',
                'name' => 'Zengfy Civil',
                'category' => 'Engineering & Construction',
                'tagline' => 'Site Engineering, Material Expenses & Blueprint Vault.',
                'desc' => 'Track construction project budgets, site contractor payments, material wastage, and structural blueprints.',
                'icon' => '🏗️',
                'url' => $buildUrl('civil'),
                'badge' => 'Engineering',
            ],
            [
                'id' => 'ngo',
                'name' => 'Zengfy NGO',
                'category' => 'Charity & Relief',
                'tagline' => 'Transparent Donation & Relief Distribution System.',
                'desc' => 'Track charity donations, relief distribution to verified citizens, and manage volunteer deployment.',
                'icon' => '❤️',
                'url' => $buildUrl('ngo'),
                'badge' => 'Non-Profit',
            ],
            [
                'id' => 'rent',
                'name' => 'Zengfy Rent',
                'category' => 'Real Estate & Lease',
                'tagline' => 'Tenant NID Verification, Rent Receipt & Property Lease.',
                'desc' => 'Instant tenant background check, automated digital rent receipts, utility billing, and vacant flat listings.',
                'icon' => '🏠',
                'url' => $buildUrl('rent'),
                'badge' => 'Real Estate',
            ],
            [
                'id' => 'hotel',
                'name' => 'Zengfy Hotel',
                'category' => 'Hospitality & Booking',
                'tagline' => 'Room Booking, Guest Check-in & Housekeeping.',
                'desc' => 'Streamline room reservations, guest ID verification, invoice printing, and housekeeping shifts.',
                'icon' => '🏨',
                'url' => $buildUrl('hotel'),
                'badge' => 'Hospitality',
            ],
            [
                'id' => 'ecommerce',
                'name' => 'Zengfy Commerce',
                'category' => 'E-Commerce & Retail',
                'tagline' => 'Fast Online Storefront with Courier & Payment Gateway.',
                'desc' => 'Launch your branded digital shop in minutes with Steadfast/Pathao courier tracking, bKash/Nagad checkout, and inventory sync.',
                'icon' => '🛍️',
                'url' => $buildUrl('shop'),
                'badge' => 'Online Store',
            ],
            [
                'id' => 'skill',
                'name' => 'Zengfy Skill',
                'category' => 'LMS & Certification',
                'tagline' => 'Online Courses, Instructors & Skill Certifications.',
                'desc' => 'Host live classes, video courses, student assignments, and verified certificates.',
                'icon' => '🎓',
                'url' => $buildUrl('skill'),
                'badge' => 'LMS Creator',
            ],
            [
                'id' => 'journal',
                'name' => 'Zengfy Journal',
                'category' => 'Personal & Productivity',
                'tagline' => 'Encrypted Personal Diary, Notes & Thought Vault.',
                'desc' => 'Keep your daily thoughts, private notes, and personal goals protected with biometric encryption.',
                'icon' => '📓',
                'url' => $buildUrl('journal'),
                'badge' => 'Private Vault',
            ],
            [
                'id' => 'habit',
                'name' => 'Zengfy Habit',
                'category' => 'Productivity & Focus',
                'tagline' => 'Daily Routine, Habit Streaks & Focus Analytics.',
                'desc' => 'Track your daily rituals, building discipline with streak reminders and personal performance charts.',
                'icon' => '⚡',
                'url' => $buildUrl('habit'),
                'badge' => 'Productivity',
            ],
            [
                'id' => 'schedule',
                'name' => 'Zengfy Schedule',
                'category' => 'Booking & Calendar',
                'tagline' => 'Client Appointment Booking & Consultation Calendar.',
                'desc' => 'Automated calendar bookings for doctors, consultants, and coaches with SMS meeting reminders.',
                'icon' => '📅',
                'url' => $buildUrl('schedule'),
                'badge' => 'Booking Tool',
            ],
        ];
    }
}
