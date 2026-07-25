<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class PageController extends Controller
{

    /**
     * Master Products & Pricing Data Dictionary for Zengfy Ecosystem
     */
    public static function getProductsData()
    {
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $scheme = env('APP_URL_SCHEME', 'https');
        $port = env('APP_ENV') === 'local' ? ':7000' : '';

        return [
            [
                'id' => 'social',
                'name' => 'Zengfy Social',
                'category' => 'Community & Identity',
                'tagline' => 'Verified Social Network for Real Connections.',
                'desc' => 'Connect, share, and build real community trust with zero fake profiles or bots.',
                'img' => 'images/services/webP/civil.webp', // fallback/icon
                'icon' => '🌐',
                'url' => "{$scheme}://social.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => 'Full Free',
                    'period' => 'per account',
                    'badge' => '100% Free',
                    'highlight' => 'Free Forever for all verified Bangladeshi citizens.',
                ],
            ],
            [
                'id' => 'school',
                'name' => 'Zengfy School',
                'category' => 'Education & ERP',
                'tagline' => 'Complete Academic & Administrative Management.',
                'desc' => 'Automate student attendance, exam report cards, tuition fee collection, and parent SMS.',
                'img' => 'images/services/webP/school.jpg',
                'icon' => '🏫',
                'url' => "{$scheme}://school.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => '৳3,000',
                    'period' => '/ month',
                    'badge' => 'Institutional',
                    'highlight' => 'Includes unlimited students, teachers, and parent portal access.',
                ],
            ],
            [
                'id' => 'law',
                'name' => 'Zengfy Law',
                'category' => 'Legal Practice & Vault',
                'tagline' => 'Court Schedules, Client Records & Encrypted Vault.',
                'desc' => 'Organize case dates, client documents, and legal billing in an encrypted vault.',
                'img' => 'images/services/webP/law.jpg',
                'icon' => '⚖️',
                'url' => "{$scheme}://law.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => '৳500',
                    'period' => '/ month',
                    'badge' => 'Legal Practice',
                    'highlight' => 'Encrypted document vault and automated court hearing reminders.',
                ],
            ],
            [
                'id' => 'pos',
                'name' => 'Zengfy POS',
                'category' => 'Commerce & Retail',
                'tagline' => 'Point of Sale, Stock Inventory & bKash Billing.',
                'desc' => 'Manage multi-store inventory, barcode scanning, bKash payments, and daily profit/loss.',
                'img' => 'images/services/webP/pos.jpg',
                'icon' => '🛒',
                'url' => "{$scheme}://pos.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => '৳40,000',
                    'period' => 'One-time (৳8,000/yr maint.)',
                    'badge' => 'Lifetime Ownership',
                    'highlight' => 'One-time setup with ৳8k yearly maintenance & support.',
                ],
            ],
            [
                'id' => 'rent',
                'name' => 'Zengfy Rent',
                'category' => 'Property & Rental',
                'tagline' => 'Automated Rental Property & Tenant Verification.',
                'desc' => 'Manage apartments, commercial spaces, tenant agreements, and search detailed reports.',
                'img' => 'images/services/webP/rent.jpg',
                'icon' => '🔑',
                'url' => "{$scheme}://rent.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => '৳30',
                    'period' => 'per search detail',
                    'badge' => 'Pay As You Go',
                    'highlight' => 'Instant tenant background & property search reports.',
                ],
            ],
            [
                'id' => 'hotel',
                'name' => 'Zengfy Hotel',
                'category' => 'Hospitality & Booking',
                'tagline' => 'Room Booking, Guest Check-in & Housekeeping.',
                'desc' => 'Streamline room reservations, guest ID verification, invoice printing, and staff shifts.',
                'img' => 'images/services/webP/hotel.jpg',
                'icon' => '🏨',
                'url' => "{$scheme}://hotel.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => '৳1,200',
                    'period' => '/ month',
                    'badge' => 'Hospitality',
                    'highlight' => 'Unlimited room management, guest check-ins, and POS integration.',
                ],
            ],
            [
                'id' => 'ngo',
                'name' => 'Zengfy NGO',
                'category' => 'Charity & Social Cause',
                'tagline' => 'Transparent Donation & Relief Distribution System.',
                'desc' => 'Track charity funds, relief distribution to the poor, and verified volunteer teams.',
                'img' => 'images/services/webP/ngo.jpg',
                'icon' => '❤️',
                'url' => "{$scheme}://ngo.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => 'Free / Donation',
                    'period' => 'for poor & welfare',
                    'badge' => 'Non-Profit Support',
                    'highlight' => '100% free software for verified non-profit organizations.',
                ],
            ],
            [
                'id' => 'civil',
                'name' => 'Zengfy Civil',
                'category' => 'Engineering & Construction',
                'tagline' => 'Site Engineering, Material Expenses & Blueprint Vault.',
                'desc' => 'Track construction project budgets, site contractor payments, and structural blueprints.',
                'img' => 'images/services/webP/civil.webp',
                'icon' => '🏗️',
                'url' => "{$scheme}://civil.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => '৳700',
                    'period' => '/ month',
                    'badge' => 'Engineering',
                    'highlight' => 'Project tracking, site expense logs, and blueprint storage.',
                ],
            ],
            [
                'id' => 'skill',
                'name' => 'Zengfy Skill',
                'category' => 'LMS & Training',
                'tagline' => 'Online Courses, Instructors & Skill Certifications.',
                'desc' => 'Host live classes, video courses, student assignments, and verified certificates.',
                'img' => 'images/services/webP/skill.jpg',
                'icon' => '🎓',
                'url' => "{$scheme}://skill.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => 'Flexible Rate',
                    'period' => 'based on teacher/course',
                    'badge' => 'LMS Creator',
                    'highlight' => 'Custom commission and subscription rates set by instructors.',
                ],
            ],
            [
                'id' => 'journal',
                'name' => 'Zengfy Journal',
                'category' => 'Personal & Productivity',
                'tagline' => 'Encrypted Personal Diary, Notes & Thought Log.',
                'desc' => 'Keep your daily thoughts, private notes, and personal goals protected with biometric encryption.',
                'img' => 'images/services/webP/journal.jpg',
                'icon' => '📓',
                'url' => "{$scheme}://journal.{$baseDomain}{$port}",
                'pricing' => [
                    'amount' => '৳300',
                    'period' => '/ month',
                    'badge' => 'Personal Vault',
                    'highlight' => '256-bit encrypted personal diary & unlimited cloud sync.',
                ],
            ],
        ];
    }

    public function welcome()
    {
        $services = self::getProductsData();

        $features = [
            [
                'icon' => '💰',
                'title' => __('welcome.features.items.pricing.title'),
                'desc' => __('welcome.features.items.pricing.desc'),
                'bg' => 'bg-blue-50'
            ],
            [
                'icon' => '🚀',
                'title' => __('welcome.features.items.setup.title'),
                'desc' => __('welcome.features.items.setup.desc'),
                'bg' => 'bg-green-50'
            ],
            [
                'icon' => '🛡️',
                'title' => __('welcome.features.items.security.title'),
                'desc' => __('welcome.features.items.security.desc'),
                'bg' => 'bg-indigo-50'
            ],
        ];

        return view('welcome', compact('services', 'features'));
    }

    public function products()
    {
        $products = self::getProductsData();
        return view('products', compact('products'));
    }

    public function pricing()
    {
        $products = self::getProductsData();
        return view('pricing', compact('products'));
    }

    public function company()
    {
        $teamMembers = [
            [
                'name' => 'Sazzad Hossain',
                'role' => 'Founder & Chief Systems Architect',
                'badge' => 'Founder & CEO',
                'initials' => 'SH',
                'bio' => 'Visionary engineer driving Bangladesh\'s sovereign digital infrastructure, unified SSO architecture, and enterprise identity layer.',
                'social' => [
                    'linkedin' => 'https://linkedin.com/company/zengfy',
                    'github' => 'https://github.com/diusazzad',
                ]
            ],
            [
                'name' => 'Kazi Naimur Rahman',
                'role' => 'Head of Product & UX Engineering',
                'badge' => 'VP of Design',
                'initials' => 'KN',
                'bio' => 'Master of modern UI/UX design systems, micro-interactions, and high-performance frontend web architectures.',
                'social' => [
                    'linkedin' => 'https://linkedin.com/company/zengfy',
                ]
            ],
            [
                'name' => 'Dr. Farhana Rahman',
                'role' => 'Lead Security & Compliance Officer',
                'badge' => 'Chief Security Officer',
                'initials' => 'FR',
                'bio' => 'Specialist in 256-bit cloud encryption, data privacy compliance, and high-availability server resilience.',
                'social' => [
                    'linkedin' => 'https://linkedin.com/company/zengfy',
                ]
            ],
            [
                'name' => 'Tariqul Islam',
                'role' => 'Head of Enterprise Growth',
                'badge' => 'VP of Institutional ERP',
                'initials' => 'TI',
                'bio' => 'Empowering 500+ educational institutions, retail merchants, and law firms with automated digital workflows.',
                'social' => [
                    'linkedin' => 'https://linkedin.com/company/zengfy',
                ]
            ],
        ];

        return view('company', compact('teamMembers'));
    }

    public function terms()
    {
        $termsSections = [
            [
                'title' => '1. Enterprise Identity Verification & User Integrity Policy',
                'desc' => 'Zengfy Ecosystem uses multi-factor identity verification to ensure authentic human identities across all sub-applications. Users agree to provide genuine verification details. Impersonation, fake profiles, or identity theft will result in immediate permanent account termination and reporting to cyber authorities.'
            ],
            [
                'title' => '2. Ecosystem Single Sign-On (SSO) & Multi-Tenant Access',
                'desc' => 'Your verified Zengfy Unified Account grants access across all 15 sub-applications (School, POS, Law, Social, Rent, etc.). Users are responsible for maintaining account confidentiality and multi-factor authentication credentials.'
            ],
            [
                'title' => '3. Data Privacy & 256-Bit Encryption Standards',
                'desc' => 'All confidential documents, institutional records, and financial transaction logs uploaded to Zengfy Law, School, and POS modules are encrypted using 256-bit AES cloud security standards. Zengfy will never sell user data to third-party ad networks.'
            ],
            [
                'title' => '4. Subscription Billing, Payments & Maintenance Rates',
                'desc' => 'Module pricing (e.g. School ERP ৳3,000/mo, Law ৳500/mo, POS ৳40,000 one-time with ৳8,000/yr maintenance) is clearly stated prior to activation. Payments are processed via secure Bangladeshi gateways (bKash, Nagad, Cards). Refunds are governed by our 14-day service SLA policy.'
            ],
            [
                'title' => '5. Acceptable Platform Usage & Cyber Safety Guidelines',
                'desc' => 'Users must not use Zengfy services for fraudulent billing, spamming, illegal content distribution, or attempting unauthorized system intrusion. Violations are subject to automated rate limiting and security bans.'
            ],
        ];

        return view('terms', compact('termsSections'));
    }


    public function downloadApp()
    {
        return view('download');
    }

    public function faq()
    {
        return view('faq');
    }

    public function submitQuestion(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'question' => 'required|string',
        ]);

        // Logic to save question or send email would go here.
        // For now, we simulate success.

        return redirect()->back()->with('success', 'আপনার প্রশ্নটি জমা দেওয়া হয়েছে। আমরা শীঘ্রই যোগাযোগ করব।');
    }

    public function dashboard()
    {
        $services = [
            [
                'name' => 'Ecommerce',
                'status' => 'active',
                'cta' => 'Open store',
                'url' => 'https://ecommerce.zengfy.top',
                'meta' => 'Orders, catalog, payments',
            ],
            [
                'name' => 'School ERP',
                'status' => 'active',
                'cta' => 'Open ERP',
                'url' => 'https://school.zengfy.top',
                'meta' => 'Attendance, result, fees',
            ],
            [
                'name' => 'POS',
                'status' => 'trial',
                'cta' => 'Start trial',
                'url' => 'https://pos.zengfy.top',
                'meta' => 'Billing and inventory',
            ],
            [
                'name' => 'Legal',
                'status' => 'locked',
                'cta' => 'Explore',
                'url' => 'https://law.zengfy.top',
                'meta' => 'Cases and schedule',
            ],
            [
                'name' => 'Hotel',
                'status' => 'locked',
                'cta' => 'Explore',
                'url' => 'https://hotel.zengfy.top',
                'meta' => 'Rooms and bookings',
            ],
            [
                'name' => 'AI Assistant',
                'status' => 'trial',
                'cta' => 'Enable',
                'url' => 'https://smartai.zengfy.top',
                'meta' => 'Workflows, SMS/Email',
            ],
        ];

        $notifications = [
            ['title' => 'New order received', 'meta' => 'Ecommerce · 5m ago'],
            ['title' => 'Attendance sync completed', 'meta' => 'School ERP · 18m ago'],
            ['title' => 'POS trial expires in 3 days', 'meta' => 'POS · Reminder'],
            ['title' => 'AI Assistant is ready to connect webhooks', 'meta' => 'Automation · 1h ago'],
        ];

        $tasks = [
            ['label' => 'Add 5 new products to your store', 'priority' => 'High'],
            ['label' => 'Review today’s attendance summary', 'priority' => 'Medium'],
            ['label' => 'Connect payment gateway for POS', 'priority' => 'High'],
            ['label' => 'Invite teammates to dashboard', 'priority' => 'Low'],
        ];

        $quickLinks = [
            ['label' => 'Profile', 'url' => '#'],
            ['label' => 'Manage subscription', 'url' => '#'],
            ['label' => 'Support', 'url' => '#'],
            ['label' => 'Billing', 'url' => '#'],
        ];

        return view('dashboard', compact('services', 'notifications', 'tasks', 'quickLinks'));
    }

    //     public function getDashboardVideos()
// {
//     $files = Storage::files('public/videos');

    //     return collect($files)->take(10)->map(function ($file) {
//         return [
//             'name' => basename($file),
//             'url' => asset(str_replace('public/', 'storage/', $file)),
//         ];
//     });
// }

    public function services()
    {
        $services = [
            [
                'name' => 'Ecommerce',
                'status' => 'active',
                'cta' => 'Open store',
                'url' => 'https://ecommerce.zengfy.top',
                'meta' => 'Orders, catalog, payments',
            ],
            [
                'name' => 'School ERP',
                'status' => 'active',
                'cta' => 'Open ERP',
                'url' => 'https://school.zengfy.top',
                'meta' => 'Attendance, result, fees',
            ],
            [
                'name' => 'POS',
                'status' => 'active',
                'cta' => 'Open POS',
                'url' => 'https://pos.zengfy.top',
                'meta' => 'Billing and inventory',
            ],
            [
                'name' => 'Law',
                'status' => 'active',
                'cta' => 'Explore',
                'url' => 'https://law.zengfy.top',
                'meta' => 'Cases and schedule',
            ],
            [
                'name' => 'Hotel',
                'status' => 'active',
                'cta' => 'Explore',
                'url' => 'https://hotel.zengfy.top',
                'meta' => 'Rooms and bookings',
            ],
            [
                'name' => 'Skill',
                'status' => 'active',
                'cta' => 'Explore',
                'url' => 'https://skill.zengfy.top',
                'meta' => 'Courses and learning',
            ],
            [
                'name' => 'Journal',
                'status' => 'active',
                'cta' => 'Explore',
                'url' => 'https://journal.zengfy.top',
                'meta' => 'Diary and notes',
            ],
            [
                'name' => 'AI Assistant',
                'status' => 'trial',
                'cta' => 'Enable',
                'url' => 'https://smartai.zengfy.top',
                'meta' => 'Workflows, AI automation',
            ],
        ];

        return view('services', compact('services'));
    }

    public function workplacePolicy()
    {
        $header = [
            'tag' => 'Company Policy',
            'title_prefix' => 'Our ',
            'title_highlight' => 'Workplace Policy',
            'title_suffix' => ' & Team Culture',
            'subtitle' => 'Building the world\'s first unified social business ecosystem starts with a culture of transparency, innovation, and digital sovereignty.'
        ];

        $cards = [
            [
                'icon' => '🏢',
                'bg_color' => 'bg-blue-600',
                'shadow_color' => 'shadow-blue-600/30',
                'title' => 'Workplace Model: Hybrid',
                'description' => 'We blend deep on-site collaboration with the freedom and flexibility of remote work. Our model is built on "Productivity over Presence".'
            ],
            [
                'icon' => '🚀',
                'bg_color' => 'bg-indigo-600',
                'shadow_color' => 'shadow-indigo-600/30',
                'title' => 'Core Values',
                'description' => 'Digital Sovereignty, Transparency, Safety First, and Continuous Innovation guide every decision we make.'
            ]
        ];

        $sections = [
            [
                'title' => 'Our Commitment to Flexibility',
                'description' => 'At Zengfy, we trust our team to manage their time and environment. Whether you are working from our creative hub or your own home, the focus remains on building high-impact solutions for our unified ecosystem.'
            ],
            [
                'title' => 'Digital Sovereignty & Security',
                'description' => 'Our internal operations reflect our product vision. We use verified identities and secure communication channels to ensure that our team operates in a safe and productive digital home.'
            ],
            [
                'title' => 'Mental Health & Well-being',
                'description' => 'A healthy team builds healthy products. We encourage unplugging after work hours and provide resources for mental and physical well-being, ensuring our team is always at their best.'
            ],
            [
                'title' => 'Continuous Learning & Growth',
                'description' => 'We believe in investing in our people. From access to premium learning platforms to attending global tech conferences, we make sure our team is constantly evolving and staying ahead of the curve.'
            ]
        ];

        $cta = [
            'title' => 'Want to join the ecosystem?',
            'description' => 'We are always looking for passionate innovators to help us redefine the future of social business.',
            'button_text' => 'View Openings',
            'button_link' => '#'
        ];

        return view('policy.workplace', compact('header', 'cards', 'sections', 'cta'));
    }

    // public function triggerSOS(Request $request)
    // {
    //     $user = auth()->user();
    //     $lat = $request->input('lat');
    //     $lng = $request->input('lng');

    //     // Logic to notify emergency contacts and authorities
    //     // For now, we log it and simulate a successful response
    //     \Illuminate\Support\Facades\Log::emergency("SOS Triggered by User: {$user->name} (ID: {$user->id}) at Lat: {$lat}, Lng: {$lng}");

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Emergency services have been notified.'
    //     ]);
    // }
}
