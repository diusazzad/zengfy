<?php

namespace Modules\Law\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LawLandingController extends Controller
{
    /**
     * Web Entrypoint for Zengfy Law Product Landing (http://law.zengfy.test:8000/).
     * Returns the reactive White Glassmorphic React 19 app shell with initialData for SSR,
     * or returns the pure JSON payload for API requests.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            return $this->data($request);
        }

        $payload = $this->data($request)->getData(true);

        return view('law::landing', [
            'initialData' => $payload['data'] ?? [],
        ]);
    }

    /**
     * Dedicated REST API for Zengfy Law Product Landing.
     * Serves legal chamber telemetry, cause list sample case, 4 stakeholder journeys,
     * 4 legal pillars, 3-tier commercial packages, and SSO links.
     * Consumed by both the React 19 web landing and the Flutter Android mobile app.
     */
    public function data(Request $request): JsonResponse
    {
        $baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.test'));
        $scheme = $request->getScheme();
        $port = $request->getPort();
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

        return response()->json([
            'status' => 'success',
            'message' => 'Zengfy Law Sovereign Legal Chamber & Case Vault Landing API payload',
            'data' => [
                'brand' => [
                    'name' => 'Zengfy Law',
                    'brand' => 'Zengfy.Law',
                    'tagline' => 'Supreme & District Court Case Vault. Zero Missing Dates.',
                    'tagline_bn' => 'আইনজীবী ও ডিজিটাল চেম্বারের জন্য কজলিস্ট ট্র্যাকার, ওকালতনামা ও কেস ভল্ট।',
                    'description' => "Bangladesh's premier sovereign legal tech platform for advocates and law chambers. Automated Supreme Court & 64 District Courts cause list tracking, 1-click Vakalatnama & bail petition drafting, court clerk fee ledgers, and 256-bit client case vaults.",
                    'version' => '1.0.0',
                    'base_domain' => $baseDomain,
                ],
                'stats' => [
                    'active_advocates' => '840+',
                    'tracked_cases' => '42,000+',
                    'court_jurisdictions' => '64 Districts + Supreme Court',
                    'missed_cause_list_dates' => '0.00%',
                ],
                'simulator' => [
                    'sample_case' => [
                        'case_no' => 'সিভিল রিভিশন নং ১২৮/২০২৬',
                        'case_type' => 'দেওয়ানি রিভিশন মামলা',
                        'court' => 'জেলা ও দায়রা জজ আদালত, চট্টগ্রাম (কোর্ট নং ৩)',
                        'advocate' => 'অ্যাডভোকেট নাজমুল হুদা',
                        'advocate_bar' => 'সুপ্রিম কোর্ট ও জেলা আইনজীবী সমিতি',
                        'next_hearing' => 'আগামীকাল, সকাল ১০:৩০ মিনিট',
                        'hearing_stage' => 'শুনানি ও তর্ক (Final Hearing)',
                        'client_name' => 'হাজী আব্দুল কাদের',
                        'client_phone' => '01711-498452',
                        'opposite_party' => 'বনাম মোসাঃ রহিমা খাতুন ও অন্যান্য',
                        'serial_no' => '১৪ নং কজলিস্ট তালিকাভুক্ত',
                        'status' => 'শুনানির জন্য প্রস্তুত',
                    ],
                    'sms_draft' => 'সম্মানিত মক্কেল, আপনার সিভিল রিভিশন নং ১২৮/২০২৬ মামলাটি আগামীকাল জেলা জজ আদালত নং ৩-এ শুনানির জন্য ধার্য আছে। সকাল ১০টার মধ্যে চেম্বারে উপস্থিত থাকার অনুরোধ রইল। - চেম্বার অব অ্যাডভোকেট নাজমুল হুদা',
                    'cause_list_feed' => [
                        [
                            'serial' => '০৫',
                            'case_no' => 'রিট পিটিশন নং ৪১৫০/২০২৫',
                            'bench' => 'হাইকোর্ট ডিভিশন (বেঞ্চ নং ১৪ - মাননীয় বিচারপতি ...)',
                            'stage' => 'রুল শুনানি ও অন্তর্বর্তীকালীন আদেশ',
                            'time' => 'সকাল ১০:৪৫ মিনিট',
                            'status' => 'Passed Over',
                        ],
                        [
                            'serial' => '১৪',
                            'case_no' => 'সিভিল রিভিশন নং ১২৮/২০২৬',
                            'bench' => 'জেলা ও দায়রা জজ আদালত, চট্টগ্রাম (কোর্ট নং ৩)',
                            'stage' => 'তর্ক ও চূড়ান্ত শুনানি (Hearing)',
                            'time' => 'সকাল ১১:১৫ মিনিট',
                            'status' => 'Ready for Hearing',
                        ],
                        [
                            'serial' => '২২',
                            'case_no' => 'ফৌজদারি মিস কেস নং ৩৪০/২০২৬',
                            'bench' => 'মহানগর দায়রা জজ আদালত, ঢাকা (কোর্ট নং ১)',
                            'stage' => 'জামিন শুনানি (Bail Hearing)',
                            'time' => 'দুপুর ১২:০০ মিনিট',
                            'status' => 'Bail Petition Filed',
                        ],
                    ],
                ],
                'stakeholders' => [
                    [
                        'id' => 'senior',
                        'title' => 'Senior Advocate & Chamber Head',
                        'title_bn' => 'সিনিয়র আইনজীবী ও চেম্বার প্রধান',
                        'role_desc' => 'কজলিস্ট মিসিং জিরো—প্রতিটি বেঞ্চের লাইভ আপডেট ও চেম্বারের অটুট সুনাম',
                        'avatar' => '👨‍⚖️',
                        'benefits' => [
                            'হাইকোর্ট ও জেলা আদালতের দৈনিক কজলিস্ট থেকে রাত ১২টায় চেম্বারের সব মামলার তারিখ স্বয়ংক্রিয় সিঙ্ক',
                            'জুনিয়রদের ড্রাফটিং কোয়ালিটি ও কেস স্ট্যাটাস যেকোনো সময় ল্যাপটপ বা মোবাইলে তদারকি',
                            'মক্কেলের বকেয়া ফিস ও মুহুরিদের পেশকার খরচের ডিজিটাল ব্যালেন্স শিট',
                            'সুপ্রিম কোর্ট ও জেলা বারের শীর্ষ চেম্বার পরিচালনায় শতভাগ পেশাদারি গতি',
                        ],
                    ],
                    [
                        'id' => 'junior',
                        'title' => 'Junior & Associate Lawyer',
                        'title_bn' => 'জুনিয়র ও অ্যাসোসিয়েট আইনজীবী',
                        'role_desc' => '১-ক্লিকে রেডিমেড ফরম্যাটে নির্ভুল ওকালতনামা, জামিন ও আরজি প্রস্তুত',
                        'avatar' => '🧑‍💼',
                        'benefits' => [
                            'আইনি ফরম্যাট লাইব্রেরি থেকে সেকেন্ডে ওকালতনামা ও বেইল পিটিশন অটো-ফিল',
                            'আদালতের নথিপত্র ও আইনি নজির (High Court Precedents) সাথে সাথে সার্চ সুবিধা',
                            'মামলার শুনানির পূর্বপ্রস্তুতি নোটস সরাসরি ক্লাউড কেস ফাইলে সেভ রাখা',
                            'ম্যানুয়াল ডায়রি লেখার ঝামেলা শেষ—ক্যালেন্ডারে কোর্ট অনুযায়ী ডেট অর্গানাইজড',
                        ],
                    ],
                    [
                        'id' => 'clerk',
                        'title' => 'Court Muhuri & Chamber Clerk',
                        'title_bn' => 'আদালতের মুহুরি ও ক্লার্ক',
                        'role_desc' => 'পেশকার হিসাব, কোর্ট ফি, প্রসেস ফি ও তলবানা লেজার নির্ভুলভাবে সংরক্ষণ',
                        'avatar' => '📜',
                        'benefits' => [
                            'প্রতিটি মামলার কোর্ট ফি, নকল ফি ও পেশকার খরচের নিখুঁত ডিজিটাল ভাউচার',
                            'সার্টিফাইড কপি ও তলবানা জারির সময়সীমার স্বয়ংক্রিয় নোটিফিকেশন',
                            'মক্কেলদের সাক্ষাতের শিডিউল ও চেম্বারের দৈনিক খরচাদির হিসাব',
                            'আইনজীবীর নির্দেশনায় তাৎক্ষণিক নথিপত্র ও এফিডেভিট প্রিন্ট রেডি',
                        ],
                    ],
                    [
                        'id' => 'litigant',
                        'title' => 'Client & Litigant',
                        'title_bn' => 'বিচারপ্রার্থী মক্কেল',
                        'role_desc' => 'মামলার পরবর্তী তারিখ ও কোর্ট আদেশের সরাসরি এসএমএস আপডেট',
                        'avatar' => '👥',
                        'benefits' => [
                            'শুনানির আগের দিন মোবাইলে স্বয়ংক্রিয় রিমাইন্ডার এসএমএস প্রাপ্তি',
                            'আদালতের আদেশ বা স্থগিতাদেশের স্পষ্ট কপি আইনজীবীর ডিজিটাল নোটসহ দেখা',
                            'ফি ও পেশকার খরচের স্বচ্ছ ডিজিটাল মানি রিসিট প্রাপ্তি',
                            'Zengfy এনআইডি ভেরিফাইড নাগরিক অ্যাকাউন্টে গোপনীয় দলিল সুরক্ষিত রাখা',
                        ],
                    ],
                ],
                'pillars' => [
                    [
                        'id' => 'causelist_scraper',
                        'icon' => 'calendar',
                        'title' => 'Automated Cause List Sync & Scraper',
                        'title_bn' => 'স্মার্ট কজলিস্ট অটো-স্ক্র্যাপার ও ডেট অ্যালার্ট',
                        'desc' => 'সুপ্রিম কোর্ট (আপিল ও হাইকোর্ট বিভাগ) এবং ৬৪ জেলার আদালতের দৈনিক কজলিস্ট স্বয়ংক্রিয়ভাবে স্ক্যান করে চেম্বারের কেস নম্বর শনাক্ত করে। কোনো তারিখ আর মিস হবে না।',
                        'badge' => 'Zero Missing Dates',
                    ],
                    [
                        'id' => 'vakalatnama_drafter',
                        'icon' => 'file-text',
                        'title' => '1-Click Vakalatnama & Legal Drafter',
                        'title_bn' => '১-ক্লিক ওকালতনামা ও পিটিশন ড্রাফটার',
                        'desc' => 'মক্কেলের নাম ও মামলার তথ্য দিলেই স্বয়ংক্রিয়ভাবে স্ট্যান্ডার্ড কোর্ট ফরম্যাটে ওকালতনামা, জামিননামা, আরজি ও রিট পিটিশন ড্রাফট তৈরি হয়ে প্রিন্ট হয়ে যায়।',
                        'badge' => 'Instant Drafting',
                    ],
                    [
                        'id' => 'court_ledger',
                        'icon' => 'scale',
                        'title' => 'Court Fee, Process & Peshkar Ledger',
                        'title_bn' => 'মুহুরি ও পেশকার ট্রানজেকশন লেজার',
                        'desc' => 'কোর্ট ফি, তলবানা, প্রসেস ফি ও পেশকার খরচের স্বচ্ছ ট্র্যাকিং। মক্কেলকে ১-ক্লিকে মোট কোর্ট খরচের আইটেমাইজড স্লিপ পাঠানো সম্ভব।',
                        'badge' => 'Chamber Accounting',
                    ],
                    [
                        'id' => 'khatian_vault',
                        'icon' => 'shield-check',
                        'title' => 'Sovereign 256-Bit Land & Case Vault',
                        'title_bn' => 'সার্বভৌম দলিল ও খতিয়ান ভল্ট (CS, SA, RS, BS)',
                        'desc' => 'দেওয়ানি মামলার অত্যন্ত গুরুত্বপূর্ণ দলিল, বায়া দলিল ও খতিয়ান ২৫৬-বিট এনক্রিপশনে সুরক্ষিত। কর্পোরেট নজরদারিমুক্ত সম্পূর্ণ সার্বভৌম গোপনীয়তা।',
                        'badge' => '256-Bit Encrypted',
                    ],
                ],
                'pricing' => [
                    [
                        'id' => 'tier_cloud',
                        'name' => 'Smart Chamber Cloud',
                        'name_bn' => 'স্মার্ট চেম্বার ক্লাউড',
                        'price' => '৳২,০০০',
                        'billing' => '/ মাস (বার্ষিক বিলে ছাড়)',
                        'badge' => 'জনপ্রিয় ক্লাউড সল্যুশন',
                        'is_popular' => true,
                        'desc' => 'স্বতন্ত্র আইনজীবী ও ২-৩ জন জুনিয়র পরিচালিত ডিজিটাল চেম্বারের জন্য ক্লাউড স্যুট।',
                        'features' => [
                            '৫০০টি মামলার লাইভ কজলিস্ট ট্র্যাকিং ও ডেট অ্যালার্ট',
                            'আনলিমিটেড ১-ক্লিক ওকালতনামা ও ড্রাফটিং টেমপ্লেট',
                            'মক্কেলদের স্বয়ংক্রিয় হেয়ারিং SMS রিমাইন্ডার',
                            'মুহুরি ও কোর্ট ফি ডিজিটাল ট্রানজেকশন খাতা',
                            'মোবাইল ও ল্যাপটপে নিরবচ্ছিন্ন সিঙ্ক ও ২৪/৭ ব্যাকআপ',
                            'সুপ্রিম কোর্ট ও জেলা আদালতের ডেডিকেটেড সাপোর্ট',
                        ],
                        'cta' => 'চেম্বার ক্লাউড চালু করুন',
                    ],
                    [
                        'id' => 'tier_lifetime',
                        'name' => 'Lifetime Self-Hosted Chamber',
                        'name_bn' => 'আজীবন চেম্বার লাইসেন্স (Own PC / Server)',
                        'price' => 'এককালীন লাইসেন্স',
                        'billing' => 'আজীবন ব্যবহার (জিরো মাসিক বিল)',
                        'badge' => '১০০% গোপনীয় ডেটাবেজ',
                        'is_popular' => false,
                        'desc' => 'যেসব সিনিয়র আইনজীবী ক্লাউডের বাইরে নিজস্ব ল্যাপটপ বা চেম্বার পিসিতে গোপনীয় ডাটাবেজ রাখতে চান।',
                        'features' => [
                            'আইনজীবীর নিজস্ব ডোমেইন বা লোকাল পিসিতে ওয়ান-ক্লিক ইনস্টল',
                            'কোনো মাসিক বা বার্ষিক রিনিউয়াল ফি নেই',
                            'আনলিমিটেড মামলা, ওকালতনামা ও মক্কেল ডাটাবেজ',
                            'ফুল অফলাইন সমর্থন—ইন্টারনেট ছাড়াও চেম্বার পরিচালিত হবে',
                            'সম্পূর্ণ সোর্স কোড ও ডাটাবেজ ব্যাকআপ নিজের নিয়ন্ত্রণে',
                            'এককালীন অন-সাইট চেম্বার সেটআপ ও স্টাফ ট্রেনিং',
                        ],
                        'cta' => 'লাইসেন্স বিস্তারিত জানুন',
                    ],
                    [
                        'id' => 'tier_enterprise',
                        'name' => 'Corporate Law Firm Suite',
                        'name_bn' => 'কর্পোরেট ল ফার্ম স্যুট',
                        'price' => 'কাস্টম সল্যুশন',
                        'billing' => 'ফার্ম সাইজ অনুযায়ী',
                        'badge' => 'টপ-টিয়ার ল ফার্ম',
                        'is_popular' => false,
                        'desc' => '১০+ পার্টনার ও অ্যাসোসিয়েট পরিচালিত শীর্ষস্থানীয় কর্পোরেট ও লিটিগেশন ল ফার্মের জন্য।',
                        'features' => [
                            'লাইফটাইম প্যাকের সকল সুবিধা অন্তর্ভুক্ত',
                            'মাল্টি-ব্রাঞ্চ ল ফার্ম ও রোল-বেসড সিকিউরিটি পারমিশন',
                            'কর্পোরেট রিটেইনার ক্লক ট্র্যাকার ও বিলিং ইনভয়েস',
                            'হাইকোর্ট বেঞ্চ অ্যাসাইনমেন্ট ও আপিল বিভাগের জন্য কাস্টম কনফিগ',
                            'ডেডিকেটেড ভার্চুয়াল প্রাইভেট সার্ভার (VPS) ও 99.99% SLA',
                            'ভিআইপি অ্যাকাউন্ট ম্যানেজার ও অন-কল সাপোর্ট',
                        ],
                        'cta' => 'এন্টারপ্রাইজ কনসালটেশন নিন',
                    ],
                ],
                'faq' => [
                    [
                        'q' => 'হাইকোর্ট ও জেলা আদালতের কজলিস্ট কীভাবে স্বয়ংক্রিয়ভাবে আপডেট হয়?',
                        'a' => 'Zengfy Law-এর ইন্টেলিজেন্ট ইঞ্জিন প্রতি রাতে বাংলাদেশ সুপ্রিম কোর্ট এবং ৬৪ জেলার আদালতের অনলাইন কজলিস্ট স্বয়ংক্রিয়ভাবে স্ক্র্যাপ করে। আপনার চেম্বারের রেজিস্টার্ড কেস নম্বরগুলোর সাথে মিলে গেলে তা আপনার ড্যাশবোর্ডে ও মোবাইলে নোটিফাই করে।',
                    ],
                    [
                        'q' => 'মামলার নথিপত্র কি ক্লাউডে নিরাপদ থাকবে?',
                        'a' => 'সম্পূর্ণ নিরাপদ! আমাদের প্ল্যাটফর্মে ২৫৬-বিট মিলিটারি গ্রেড ক্লায়েন্ট এনক্রিপশন ব্যবহার করা হয়। আপনি চাইলে কোনো ক্লাউড ব্যবহার না করে আমাদের "Lifetime Self-Hosted" লাইসেন্স নিয়ে সম্পূর্ণ ডেটা আপনার নিজস্ব চেম্বারের কম্পিউটারে অফলাইনেও রাখতে পারেন।',
                    ],
                    [
                        'q' => 'মক্কেলকে কি স্বয়ংক্রিয়ভাবে এসএমএস পাঠানো যায়?',
                        'a' => 'হ্যাঁ! শুনানির আগের দিন সন্ধ্যাবেলা মক্কেলের মোবাইলে চেম্বারের নাম ও মামলা নম্বরসহ মার্জিত এসএমএস রিমাইন্ডার পৌঁছে যায়, যাতে তিনি সময়মতো আদালতে বা চেম্বারে উপস্থিত থাকতে পারেন।',
                    ],
                    [
                        'q' => 'মুহুরি ও পেশকার খরচের হিসাব কীভাবে রাখা যায়?',
                        'a' => 'সিস্টেমে ডেডিকেটেড মুহুরি ট্রানজেকশন লেজার রয়েছে। কোর্ট ফি, তলবানা, সার্টিফাইড কপি ও পেশকার খরচের রসিদ এন্ট্রি করলে মামলার ফাইলের সাথে তা স্বয়ংক্রিয়ভাবে যুক্ত হয়ে যায় এবং মক্কেলকে খরচের ভাউচার দেওয়া যায়।',
                    ],
                ],
                'auth' => [
                    'is_authenticated' => Auth::check(),
                    'user' => Auth::user() ? [
                        'id' => Auth::id(),
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ] : null,
                ],
                'links' => [
                    'home' => "{$scheme}://law.{$baseDomain}{$portSuffix}/",
                    'login' => "{$scheme}://{$baseDomain}{$portSuffix}/login?continue=" . urlencode("{$scheme}://law.{$baseDomain}{$portSuffix}/"),
                    'register' => "{$scheme}://{$baseDomain}{$portSuffix}/register?continue=" . urlencode("{$scheme}://law.{$baseDomain}{$portSuffix}/"),
                    'download' => "https://github.com/diusazzad/zengfy/releases",
                    'master_landing' => "{$scheme}://{$baseDomain}{$portSuffix}/",
                    'social' => "{$scheme}://social.{$baseDomain}{$portSuffix}/",
                    'school' => "{$scheme}://school.{$baseDomain}{$portSuffix}/",
                    'pos' => "{$scheme}://pos.{$baseDomain}{$portSuffix}/",
                    'api_docs' => "{$scheme}://law.{$baseDomain}{$portSuffix}/api/v1/law/landing",
                ],
            ],
        ]);
    }
}