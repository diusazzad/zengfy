<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //     public function __construct()
// {
//     $this->middleware('auth');
// }

    public function welcome()
    {
        return view('welcome');
    }

    public function team()
    {
        return view('team');
    }


    public function downloadApp()
    {
        return view('download');
    }
    public function signup()
    {
        // Use the new signup view in the Auth module
        return view('auth::signup');
    }

    public function login()
    {
        // Use the login view in the Auth module
        return view('auth::login');
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

}
