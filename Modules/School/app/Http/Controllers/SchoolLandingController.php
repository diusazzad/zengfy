<?php

namespace Modules\School\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolLandingController extends Controller
{
    /**
     * Web Entrypoint for Zengfy School Product Landing (http://school.zengfy.top:8000/).
     * Returns the reactive White Glassmorphic React 19 app shell with initialData for SSR,
     * or returns the pure JSON payload for API requests.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return $this->data($request);
        }

        $payload = $this->data($request)->getData(true);

        return view('school::landing', [
            'initialData' => $payload['data'] ?? [],
        ]);
    }

    /**
     * Dedicated REST API for Zengfy School Product Landing.
     * Serves institutional telemetry, RFID demo profile, grading simulation,
     * 3-tier Bangladesh commercial offers, and ecosystem SSO links.
     * Consumed by both the React 19 web landing and the Flutter Android mobile app.
     */
    public function data(Request $request): JsonResponse
    {
        $baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));
        $scheme = $request->getScheme();
        $port = $request->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        return response()->json([
            'status' => 'success',
            'message' => 'Zengfy School Sovereign Educational Network Landing API payload',
            'data' => [
                'brand' => [
                    'name' => 'Zengfy School',
                    'brand' => 'Zengfy.School',
                    'tagline' => 'Smart Campus. Peaceful Parents. Zero Paper.',
                    'tagline_bn' => 'কাগজের ঝামেলাহীন আধুনিক ক্যাম্পাস। অভিভাবকের নিশ্চিন্ত ভরসা।',
                    'description' => "Bangladesh's next-generation sovereign school, college & madrasah management platform. Instant RFID attendance notifications, 1-click NCTB automated report cards, and transparent digital fee collection with zero paper bureaucracy.",
                    'version' => '1.0.0',
                    'base_domain' => $baseDomain,
                ],
                'stats' => [
                    'institutions_count' => 540,
                    'students_count' => 180000,
                    'attendance_accuracy' => '99.9%',
                    'wards_covered' => 4554,
                ],
                'rfid_demo' => [
                    'student_name' => 'Soumya Ahmed (সৌম্য আহমেদ)',
                    'student_id' => 'ZG-SCH-2026-0812',
                    'class' => 'Class 8, Section A (Roll: 12)',
                    'institution' => 'Motijheel Model School & College',
                    'entry_time' => '08:02 AM',
                    'guardian_phone' => '+880 1711-***892',
                    'gate_id' => 'Main Gate RFID Scanner #01',
                    'sms_text' => 'সৌম্য সকাল ৮:০২ মিনিটে নিরাপদে মতিঝিল মডেল স্কুল ক্যাম্পাসে প্রবেশ করেছে। (শ্রেণী: ৮ম, রোল: ১২)',
                ],
                'role_journeys' => [
                    [
                        'role' => 'parents',
                        'title' => 'অভিভাবক (Parents)',
                        'badge' => 'মানসিক প্রশান্তি',
                        'icon' => 'heart-handshake',
                        'headline' => 'সন্তানের ক্লাসে প্রবেশের মুহূর্তে নিশ্চিন্ত নোটিফিকেশন',
                        'points' => [
                            'সন্তান স্কুলে ঢুকলে ও বের হলে সাথে সাথে ফোনে গ্রিন SMS নোটিফিকেশন',
                            'ব্যাংকের লাইনে না দাঁড়িয়ে ১-ট্যাপে বিকাশ/নগদে টিউশন ফি পরিশোধ',
                            'তাৎক্ষণিক ডিজিটাল স্ট্যাম্পড মানি রসিদ ডাউনলোড',
                            'পরীক্ষার রেজাল্ট পাবলিশ হওয়ার সেকেন্ডেই ডিজিটাল প্রগ্রেস কার্ড অ্যাক্সেস',
                        ],
                    ],
                    [
                        'role' => 'teachers',
                        'title' => 'শিক্ষক (Teachers)',
                        'badge' => 'হাতে লেখার ভারমুক্তি',
                        'icon' => 'sparkles',
                        'headline' => 'পরীক্ষার খাতা দেখা শেষ, রেজাল্ট শিট হবে ১-ক্লিকে',
                        'points' => [
                            'হাতে মার্কশিট লেখা বা ক্যালকুলেটর টেপার দিন শেষ—অটো গ্রেডিং ইঞ্জিন',
                            'NCTB এবং মাদ্রাসা শিক্ষা বোর্ড কারিকুলাম অনুযায়ী অটো GPA ৫.০০ তৈরি',
                            'ক্লাসের ছাত্রছাত্রীদের দৈনিক হোমওয়ার্ক ও নোটিশ অভিভাবকদের ইনবক্সে প্রেরণ',
                            'মাত্র ৩০ সেকেন্ডে পুরো ক্লাসের ডিজিটাল উপস্থিতি সম্পন্ন',
                        ],
                    ],
                    [
                        'role' => 'principals',
                        'title' => 'অধ্যক্ষ ও প্রশাসন (Principals)',
                        'badge' => 'স্বচ্ছ অ্যাকাউন্টিং',
                        'icon' => 'building-2',
                        'headline' => 'প্রতিষ্ঠান পরিচালনার প্রতিটি পাই-পয়সার রিয়েল-টাইম ড্যাশবোর্ড',
                        'points' => [
                            'প্রতিদিনের টিউশন ফি কালেকশন ও বকেয়া ফি রিয়েল-টাইম মনিটরিং',
                            'শিক্ষক ও কর্মকর্তা-কর্মচারীদের ডিজিটাল বায়োমেট্রিক ও স্যালারি পে-রোল',
                            'এক ক্লিকে সকল শিক্ষার্থী বা নির্দিষ্ট শ্রেণীর অভিভাবকদের জরুরি SMS ব্রডকাস্ট',
                            'বোর্ড অডিট ও বাৎসরিক অর্থ কমিটির জন্য নির্ভুল ব্যালেন্স শিট এক্সপোর্ট',
                        ],
                    ],
                    [
                        'role' => 'students',
                        'title' => 'শিক্ষার্থী (Students)',
                        'badge' => 'ডিজিটাল প্রেরণা',
                        'icon' => 'graduation-cap',
                        'headline' => 'স্মার্ট ডিজিটাল আইডি ও আধুনিক শিক্ষা জীবনের আনন্দ',
                        'points' => [
                            '১টি স্মার্ট আরএফআইডি কার্ডে গেট এন্ট্রি, লাইব্রেরি ও ক্যান্টিন এক্সেস',
                            'ডিজিটাল ক্লাস রুটিন ও পরীক্ষার সিট প্ল্যান সহজে দেখা',
                            'বার্ষিক সহশিক্ষা ও অ্যাটেনডেন্স স্টার ব্যাজ অর্জন',
                            'আজীবন সংরক্ষিত নিরাপদ ডিজিটাল একাডেমিক সার্টিফিকেট ভল্ট',
                        ],
                    ],
                ],
                'grading_demo' => [
                    'scale' => '5.00 GPA',
                    'subjects' => [
                        ['id' => 'bangla', 'name' => 'বাংলা (Bangla)', 'marks' => 84, 'max' => 100],
                        ['id' => 'english', 'name' => 'ইংরেজি (English)', 'marks' => 78, 'max' => 100],
                        ['id' => 'math', 'name' => 'গণিত (Mathematics)', 'marks' => 92, 'max' => 100],
                        ['id' => 'science', 'name' => 'বিজ্ঞান (Science)', 'marks' => 88, 'max' => 100],
                    ],
                ],
                'packages' => [
                    [
                        'id' => 'cloud_saas',
                        'name' => 'রেডি ক্লাউড সাবস্ক্রিপশন (Cloud SaaS)',
                        'price' => '৳২,০০০',
                        'period' => '/মাস',
                        'tag' => 'ছোট ও মাঝারি প্রতিষ্ঠান',
                        'is_popular' => true,
                        'features' => [
                            'অল-ইন-ওয়ান রেডি ক্লাউড হোস্টিং ও অটো ব্যাকআপ',
                            '১,০০০ শিক্ষার্থী পর্যন্ত আনলিমিটেড ব্যবহার',
                            'অভিভাবক ও শিক্ষক মোবাইল অ্যাপ অ্যাক্সেস',
                            'স্বয়ংক্রিয় SMS গেটওয়ে কানেকশন',
                            'NCTB ও মাদ্রাসা রেজাল্ট অটোমেশন ইঞ্জিন',
                            'নিয়মিত সিকিউরিটি ও ফিচার আপডেট',
                        ],
                        'cta' => 'শুরু করুন (Start Cloud)',
                    ],
                    [
                        'id' => 'one_time',
                        'name' => 'ওয়ান-টাইম ওনারশিপ (Self-Hosted on Own Domain)',
                        'price' => 'এককালীন ওনারশিপ',
                        'period' => 'আজীবন ব্যবহারের লাইসেন্স',
                        'tag' => 'প্রতিষ্ঠানের নিজস্ব ডোমেইনে',
                        'is_popular' => false,
                        'features' => [
                            'প্রতিষ্ঠানের নিজস্ব ডোমেইন ও হোস্টিংয়ে সেটআপ',
                            'ডাটাবেজের ১০০% নিজস্ব সার্বভৌম নিয়ন্ত্রণ',
                            'জিরো মাসিক বিলিং বা মেইনটেন্যান্স ফি',
                            'আনলিমিটেড শিক্ষার্থী ও শিক্ষক অ্যাকাউন্ট',
                            'অফলাইন RFID গেট লোকাল সার্ভার সিঙ্ক',
                            'ফুল ডাটা এক্সপোর্ট ও ব্যাকআপ কন্ট্রোল',
                        ],
                        'cta' => 'লাইসেন্স কিনুন (Buy License)',
                    ],
                    [
                        'id' => 'custom_enterprise',
                        'name' => 'কাস্টম এন্টারপ্রাইজ ইআরপি (Custom Enterprise)',
                        'price' => 'Contact Sales',
                        'period' => 'কাস্টম কোটেশন',
                        'tag' => 'বড় ক্যাডেট কলেজ ও চেইন',
                        'is_popular' => false,
                        'features' => [
                            'মাল্টি-ক্যাম্পাস ও একাধিক ব্রাঞ্চ একীভূত ড্যাশবোর্ড',
                            'কাস্টম মডিউল ডেভেলপমেন্ট ও স্পেশাল কারিকুলাম',
                            'অন-সাইট স্টাফ ট্রেনিং ও ডেডিকেটেড ইঞ্জিনিয়ার',
                            'কাস্টম ব্যাংকিং API ও টেলকো বাল্ক গেটওয়ে',
                            'ডেডিকেটেড প্রাইভেট ক্লাউড বা অন-প্রিমিসেস সার্ভার',
                            'এসএলএ সহ প্রায়োরিটি ১ জরুরি সাপোর্ট',
                        ],
                        'cta' => 'সেলস টিমের সাথে কথা বলুন (Contact Sales)',
                    ],
                ],
                'features' => [
                    [
                        'key' => 'rfid_mesh',
                        'title' => 'স্মার্ট আরএফআইডি গেট হাজিরা',
                        'tag' => 'অফলাইন ব্যাকআপ',
                        'description' => 'বিদ্যুৎ বা ইন্টারনেট চলে গেলেও অফলাইন লোকাল মেমোরিতে হাজিরা রেকর্ড থাকে এবং লাইন ফিরে আসার সাথে সাথে ব্যাকলগ সিঙ্ক হয়ে অভিভাবকদের নোটিফিকেশন পাঠায়।',
                        'icon' => 'wifi-off',
                    ],
                    [
                        'key' => 'dual_curriculum',
                        'title' => 'NCTB ও মাদরাসা ডুয়াল কারিকুলাম',
                        'tag' => 'সকল বোর্ডের জন্য',
                        'description' => 'সাধারণ প্রাথমিক ও উচ্চ বিদ্যালয়, ক্যাডেট একাডেমি এবং কওমি ও আলিয়া মাদ্রাসার স্বতন্ত্র মূল্যায়ন পদ্ধতি একই প্ল্যাটফর্মে ১০০% কাস্টমাইজযোগ্য।',
                        'icon' => 'book-open',
                    ],
                    [
                        'key' => 'mobile_payments',
                        'title' => '১-ট্যাপে স্বচ্ছ বিকাশ/নগদ ফি প্রদান',
                        'tag' => 'ব্যাংক লাইনের অবসান',
                        'description' => 'অভিভাবক ঘরে বসেই টিউশন ফি, পরীক্ষার ফি ও বাস ফি পরিশোধ করেন। একাউন্ট্যান্টের কাছে সাথে সাথে রিয়েল-টাইম লেজার ট্রানজেকশন অটো পোস্টিং হয়ে যায়।',
                        'icon' => 'credit-card',
                    ],
                    [
                        'key' => 'encrypted_vault',
                        'title' => 'সার্বভৌম সার্টিফিকেট ও রেজাল্ট ভল্ট',
                        'tag' => 'NID লিঙ্কড',
                        'description' => 'শিক্ষার্থীর প্রশংসাপত্র, মার্কশিট ও একাডেমিক আর্কাইভ ২৫৬-বিট ক্লায়েন্ট এনক্রিপশনে আজীবন সুরক্ষিত থাকে, যা কোনো কর্পোরেট ব্রোকার ডাটা মাইনিং করতে পারে না।',
                        'icon' => 'shield-check',
                    ],
                ],
                'auth' => [
                    'is_authenticated' => Auth::check(),
                    'user' => Auth::user(),
                ],
                'links' => [
                    'home' => "{$scheme}://{$baseDomain}{$portSuffix}/",
                    'school' => "{$scheme}://school.{$baseDomain}{$portSuffix}/",
                    'portal' => "{$scheme}://school.{$baseDomain}{$portSuffix}/",
                    'login' => "{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode("{$scheme}://school.{$baseDomain}{$portSuffix}/"),
                    'register' => "{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode("{$scheme}://school.{$baseDomain}{$portSuffix}/"),
                    'account' => "{$scheme}://{$baseDomain}{$portSuffix}/account",
                    'download' => "{$scheme}://{$baseDomain}{$portSuffix}/download",
                    'demo' => "{$scheme}://school.{$baseDomain}{$portSuffix}/#demo-section",
                    'api_docs' => "{$scheme}://{$baseDomain}{$portSuffix}/api/v1/school/landing",
                ],
            ],
        ]);
    }
}
