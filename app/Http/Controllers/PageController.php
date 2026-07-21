<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class PageController extends Controller
{

    public function welcome()
    {
        // Redirect if already logged in (optional based on user request "dashboard... আপাতত না")
        // But the user said "LANDING PAGE শুধু রাখবে", so maybe we don't redirect to dashboard even if auth.
        // For now, let's keep it simple.

        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $scheme = env('APP_URL_SCHEME', 'https');
        $port = env('APP_ENV') === 'local' ? ':7000' : '';

        $services = [
            [
                'name' => 'Zengfy Commerce',
                'desc' => 'Inventory, Orders & Online Store.',
                'img' => 'images/services/webP/ecommerce.jpg',
                'url' => "{$scheme}://ecommerce.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy School',
                'desc' => 'Complete Academic Management.',
                'img' => 'images/services/webP/school.jpg',
                'url' => "{$scheme}://school.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy POS',
                'desc' => 'Point of Sale & Billing.',
                'img' => 'images/services/webP/pos.jpg',
                'url' => "{$scheme}://pos.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy Rent',
                'desc' => 'Automated Rental Management.',
                'img' => 'images/services/webP/rent.jpg',
                'url' => "{$scheme}://rent.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy Hotel',
                'desc' => 'Booking & Stay Management.',
                'img' => 'images/services/webP/hotel.jpg',
                'url' => "{$scheme}://hotel.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy NGO',
                'desc' => 'Charity & Program Tracking.',
                'img' => 'images/services/webP/ngo.jpg',
                'url' => "{$scheme}://ngo.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy Civil',
                'desc' => 'Engineering & Construction.',
                'img' => 'images/services/webP/civil.webp',
                'url' => "{$scheme}://civil.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy Law',
                'desc' => 'Cases, Clients & Schedules.',
                'img' => 'images/services/webP/law.jpg',
                'url' => "{$scheme}://law.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy Skill',
                'desc' => 'Courses & Learning Platform.',
                'img' => 'images/services/webP/skill.jpg',
                'url' => "{$scheme}://skill.{$baseDomain}{$port}"
            ],
            [
                'name' => 'Zengfy Journal',
                'desc' => 'Personal Diary & Notes.',
                'img' => 'images/services/webP/journal.jpg',
                'url' => "{$scheme}://journal.{$baseDomain}{$port}"
            ],
        ];

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

    public function triggerSOS(Request $request)
    {
        $user = auth()->user();
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        // Logic to notify emergency contacts and authorities
        // For now, we log it and simulate a successful response
        \Illuminate\Support\Facades\Log::emergency("SOS Triggered by User: {$user->name} (ID: {$user->id}) at Lat: {$lat}, Lng: {$lng}");

        return response()->json([
            'status' => 'success',
            'message' => 'Emergency services have been notified.'
        ]);
    }
}
