<?php

namespace App\Services;

class ModuleDataService
{
    /**
     * Master Data Dictionary for all 14 Zengfy Ecosystem Modules
     */
    public static function getModulesData(): array
    {
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $scheme = env('APP_URL_SCHEME', 'https');
        $port = env('APP_ENV') === 'local' ? ':7000' : '';

        return [
            'school' => [
                'id' => 'school',
                'name' => 'Zengfy School ERP',
                'name_bn' => 'Zengfy স্কুল ইআরপি',
                'category' => 'Education & Academic ERP',
                'category_bn' => 'স্মার্ট প্রাতিষ্ঠানিক ডিজিটাল ইআরপি 🇧🇩',
                'badge' => 'Institutional ERP Platform',
                'tagline' => 'Automate Academic Operations & Tuition Fee Collection',
                'tagline_bn' => 'আপনার স্কুলের প্রশাসনিক জটিলতা শূন্যে আনুন, অনলাইন ফি ও অটো মার্কশিট চালু করুন 🏫',
                'desc' => 'Automate student attendance, exam report cards, tuition fee collection with bKash, and real-time parent SMS alerts.',
                'desc_bn' => 'বিকাশ/নগদে অটো-ফি কালেকশন, জিপিএ ৫.০০ রেজাল্ট শিট জেনারেটর এবং অভিভাবক নোটিফিকেশন—সবকিছু এখন একটিমাত্র পোর্টাল থেকে।',
                'youtube_id' => 'dQw4w9WgXcQ',
                'theme' => [
                    'primary' => 'from-blue-600 to-indigo-600',
                    'accent_text' => 'text-blue-400',
                    'bg_glow' => 'bg-blue-600/10',
                    'border_glow' => 'hover:border-blue-500/50',
                ],
                'pricing_tiers' => [
                    'starter' => [
                        'name' => 'স্টার্টার প্যাক (Starter Plan)',
                        'amount' => '৳২,৫০০',
                        'period' => '/ মাস',
                        'badge' => 'ছোট-মাঝারি প্রতিষ্ঠানের জন্য',
                        'highlight' => '১০০% ফ্রি অ্যাপ ও ইমেইল নোটিফিকেশন (কোনো বাধ্যবাধকতা নেই SMS কেনার)।',
                        'features' => [
                            'আনলিমিটেড শিক্ষার্থী ও শিক্ষক একাউন্ট',
                            'জিপিএ ৫.০০ অটো মার্কশিট ও রেজাল্ট পোর্টাল',
                            'বিকাশ ও নগদ ডিজিটাল ফি কালেকশন',
                            '১০০% ফ্রি অ্যাপ ও ইমেইল নোটিফিকেশন',
                            'বিডিআইএক্স ৯৯.৯% আপটাইম ক্লাউড সিকিউরিটি',
                        ],
                    ],
                    'institutional' => [
                        'name' => 'স্মার্ট প্রাতিষ্ঠানিক প্যাক (Smart Institutional)',
                        'amount' => '৳৩,৫০০',
                        'period' => '/ মাস',
                        'badge' => 'জনপ্রিয় প্রাতিষ্ঠানিক চয়েস',
                        'highlight' => 'ফ্রি অ্যাপ নোটিফিকেশন + সাথে সাশ্রয়ী ফ্লেক্সিবল SMS ক্রেডিট যোগ করার সুবিধা।',
                        'features' => [
                            'স্টার্টার প্যাকের সমস্ত সুবিধা',
                            'ফ্রি অ্যাপ নোটিফিকেশন + ফ্লেক্সিবল SMS বান্ডেল',
                            'বায়োমেট্রিক ও কিউআর কোড হাজিরা সিস্টেম',
                            'অভিভাবক অ্যান্ড্রয়েড অ্যাপ ও রিয়েল-টাইম ট্র্যাকিং',
                            'ডেডিকেটেড হোয়াটসঅ্যাপ কাস্টমার সাপোর্ট',
                        ],
                    ],
                ],
                'pricing' => [
                    'amount' => '৳২,৫০০',
                    'period' => '/ মাস থেকে শুরু',
                    'badge' => 'ফ্লেক্সিবল প্ল্যান',
                    'highlight' => '১০০% ফ্রি অ্যাপ নোটিফিকেশন সহ সাশ্রয়ী ফ্লেক্সিবল প্রাইসিং।',
                ],
                'features' => [
                    ['icon' => '📚', 'title' => 'Student & Exam Portal', 'title_bn' => 'স্টুডেন্ট ও এক্সাম পোর্টাল', 'desc' => 'Automated report card generation and GPA calculator.', 'desc_bn' => '১-ক্লিকে জিপিএ ৫.০০ অটো মার্কশিট ও গ্রেড ক্যালকুলেশন।'],
                    ['icon' => '💳', 'title' => 'bKash Fee Collection', 'title_bn' => 'বিকাশ ও নগদ অনলাইন ফি কালেকশন', 'desc' => 'Instant online tuition fee collection and SMS receipts.', 'desc_bn' => 'অনলাইন টিউশন ফি জমা এবং রিয়েল-টাইম অটোমেটিক ডিজিটাল রসিদ।'],
                    ['icon' => '🕒', 'title' => 'Biometric Attendance', 'title_bn' => 'বায়োমেট্রিক হাজিরা ও নোটিফিকেশন', 'desc' => 'Real-time student & staff attendance tracking.', 'desc_bn' => 'শিক্ষার্থী ও শিক্ষকদের দৈনিক উপস্থিতির তাৎক্ষণিক তথ্য।'],
                    ['icon' => '📱', 'title' => 'Parent Android App', 'title_bn' => 'অভিভাবক অ্যাপ ও কানেক্টিভিটি', 'desc' => 'Live updates on homework, results, and fees for parents.', 'desc_bn' => 'সন্তানের উপস্থিতি, পরীক্ষার নম্বর ও ফি জমা ঘরে বসেই অভিভাবকের হাতে।'],
                ],
                'url' => "{$scheme}://school.{$baseDomain}{$port}",
            ],

            'pos' => [
                'id' => 'pos',
                'name' => 'Zengfy POS & Retail',
                'name_bn' => 'Zengfy POS — রিটেইল ইআরপি, বাকি খাতা ও সোশ্যাল শপ উইন্ডো',
                'category' => 'Commerce & Multi-Store',
                'badge' => 'স্মার্ট রিটেইল পজ, বাকি খাতা ও সোশ্যাল শপ উইন্ডো 🇧🇩',
                'tagline' => 'Smart Retail Billing & Stock Inventory',
                'tagline_bn' => 'আপনার দোকানের কেনাবেচা ডিজিটাইজ করুন, সোশ্যাল ইকোসিস্টেমে বিক্রি বাড়ান',
                'desc' => 'Manage multi-store inventory, barcode scanning, bKash/Nagad billing, and daily profit/loss reports.',
                'desc_bn' => '২ সেকেন্ডে বারকোড বিলিং, অটোমেটিক কাস্টমার বাকি খাতা (ডিজিটাল ডিউ লেজার), দৈনিক লাভ-ক্ষতির হিসাব এবং সোশ্যাল ইকোসিস্টেমের কোটি কোটি ক্রেতার কাছে আপনার দোকানের পণ্য সরাসরি পৌঁছানোর অল-ইন-ওয়ান মেমো সমাধান।',
                'youtube_id' => 'dQw4w9WgXcQ',
                'theme' => [
                    'primary' => 'from-cyan-500 via-blue-500 to-indigo-600',
                    'accent_text' => 'text-cyan-400',
                    'bg_glow' => 'bg-cyan-600/10',
                    'border_glow' => 'hover:border-cyan-500/50',
                ],
                'pricing_tiers' => [
                    'retail' => [
                        'name' => 'স্মার্ট রিটেইল প্যাক (Smart Retail POS)',
                        'badge' => 'জনপ্রিয় মার্চেন্ট চয়েস',
                        'amount' => '৳৮,০০০',
                        'period' => '/ বছর (৳৬৬৬/মাস তুল্য)',
                        'highlight' => 'অনলিমিটেড বারকোড কাস্টমার মেমো, ডিজিটাল বাকি খাতা ও সোশ্যাল শপ উইন্ডো।',
                        'features' => [
                            '২ সেকেন্ডে বারকোড স্ক্যানিং মেমো ও থার্মাল রসিদ প্রিন্ট',
                            'স্মার্টফোনকে ওয়ারলেস বারকোড স্ক্যানার বানানোর ফ্রি মোড',
                            'ডিজিটাল কাস্টমার বাকি খাতা & ১-ক্লিকে বিকাশ/নগদ তাগাদা SMS',
                            'Zengfy Social ইকোসিস্টেমে ১-ক্লিকে অনলাইন শপ উইন্ডো চালু',
                            'অটো স্টক লো-অ্যালার্ট ও দৈনিক নীট লাভ-ক্ষতি রিপোর্ট',
                            'লোকাল ২৪/৭ কাস্টমার সাপোর্ট ও ফ্রি মার্চেন্ট ট্রেনিং',
                        ],
                    ],
                ],
                'pricing' => [
                    'amount' => '৳৮,০০০',
                    'period' => '/ বছর (মাসিক ৳৬৬৬ তুল্য)',
                    'badge' => 'সাশ্রয়ী বাৎসরিক প্ল্যান',
                    'highlight' => 'কোনো মাসিক বা গোপন ফি ছাড়া ফুল মার্চেন্ট পজ ও ডিজিটাল শপ উইন্ডো।',
                ],
                'features' => [
                    ['icon' => '🛒', 'title' => 'Barcode POS Terminal', 'title_bn' => '২ সেকেন্ডের বারকোড কাউন্টার মেমো', 'desc' => 'Ultra-fast item checkout under 2 seconds.', 'desc_bn' => 'পিক আওয়ারে ভিড় ছাড়া ২ সেকেন্ডে দ্রুত ও নির্ভুল কাস্টমার বিলিং।'],
                    ['icon' => '📖', 'title' => 'Digital Due Ledger', 'title_bn' => 'ডিজিটাল কাস্টমার বাকি খাতা', 'desc' => 'Customer due book with automatic SMS reminders.', 'desc_bn' => 'খাতা হারানোর ভয় ছাড়া বাকির টাকা আদায়ের অটো বিকাশ তাগাদা SMS।'],
                    ['icon' => '📦', 'title' => 'Stock & Low Alert', 'title_bn' => 'অটো স্টক লো-অ্যালার্ট', 'desc' => 'Automated low stock alerts and supplier purchase orders.', 'desc_bn' => 'পণ্য ফুরিয়ে খদ্দের ফেরত যাওয়ার আগেই অটোমেটিক স্টক অ্যালার্ট।'],
                    ['icon' => '🌐', 'title' => 'Social Shop Window', 'title_bn' => 'সোশ্যাল শপ উইন্ডো কানেক্ট', 'desc' => 'Connect store to Zengfy Social buyers.', 'desc_bn' => 'সোশ্যাল কোটি ক্রেতার নিকটস্থ ডিরেক্টরিতে দোকানের পণ্য প্রদর্শনী।'],
                ],
                'url' => "{$scheme}://pos.{$baseDomain}{$port}",
            ],

            'law' => [
                'id' => 'law',
                'name' => 'Zengfy Law Suite',
                'name_bn' => 'Zengfy Law Suite — ভকিল চেম্বার ও লিগ্যাল মার্কেটপ্লেস',
                'category' => 'Legal Practice & Vault',
                'badge' => 'যাচাইকৃত লিগ্যাল মার্কেটপ্লেস ও ডিজিটাল চেম্বার ইআরপি 🇧🇩',
                'tagline' => 'Court Schedules, Client Records & Encrypted Vault',
                'tagline_bn' => 'যাচাইকৃত অভিজ্ঞ আইনজীবীর সাথে কথা বলুন, অথবা আইনি চেম্বার ডিজিটাইজ করুন',
                'desc' => 'Organize court hearing dates, client case files, and legal billing in a 256-bit encrypted cloud vault.',
                'desc_bn' => 'সোশ্যাল ইকোসিস্টেমের কোটি কোটি বিচারপ্রার্থী গ্রাহকের কাছে পৌঁছান। হাইকোর্ট ও জেলা জজ কোর্টের অটো কজ লিস্ট রিমাইন্ডার, ২৫৬-বিট ক্লায়েন্ট ফাইল ভল্ট এবং বিকাশ ফি কালেকশন—সবকিছু এখন একটি স্মার্ট পোর্টালে।',
                'youtube_id' => 'dQw4w9WgXcQ',
                'theme' => [
                    'primary' => 'from-amber-500 via-orange-500 to-amber-600',
                    'accent_text' => 'text-amber-400',
                    'bg_glow' => 'bg-amber-600/10',
                    'border_glow' => 'hover:border-amber-500/50',
                ],
                'pricing_tiers' => [
                    'client' => [
                        'name' => 'বিচারপ্রার্থী / ক্লায়েন্ট প্যাক (Client Connect)',
                        'badge' => 'স্মার্ট বিচারপ্রার্থী চয়েস',
                        'amount' => '৳২০০',
                        'period' => '/ কানেক্ট বা পরামর্শ',
                        'highlight' => 'যাচাইকৃত অভিজ্ঞ আইনজীবীর সাথে সরাসরি কন্সালটেশন ও মামলার লাইভ তথ্য।',
                        'features' => [
                            'যাচাইকৃত অভিজ্ঞ প্রফেশনাল আইনজীবী সার্চ',
                            'নিজের মামলার বর্তমান অবস্থা, বাদী/বিবাদী তথ্য ও তারিখ দেখা',
                            '১-ক্লিকে বিকাশ/নগদে অনলাইন ফি পরিশোধ ও ডিজিটাল রসিদ',
                            'আইনি কন্সালটেশন ও ফাইল শেয়ারিং',
                        ],
                    ],
                    'chamber' => [
                        'name' => 'অ্যাডভোকেট চেম্বার প্যাক (Zengfy VakilChamber)',
                        'badge' => 'জনপ্রিয় চেম্বার চয়েস',
                        'amount' => '৳৫০০',
                        'period' => '/ মাস (ফ্ল্যাট রেট)',
                        'highlight' => 'আনলিমিটেড কেস ফাইল ডায়রি, অটো কজ লিস্ট ও জুনিয়র পারমিশন কন্ট্রোল।',
                        'features' => [
                            'আনলিমিটেড কেস ফাইল ডায়রি ও শুনানি ট্র্যাকিং',
                            'অটো কজ লিস্ট SMS & ইমেইল নোটিফিকেশন',
                            '২৫৬-বিট এনক্রিপ্টেড ফাইল ভল্ট স্টোরেজ',
                            'জুনিয়র আইনজীবী ও সহকারী রোল পারমিশন কন্ট্রোল',
                            'সোশ্যাল গ্রাহকদের ডিরেক্টরি থেকে নতুন ক্লায়েন্ট পাওয়ার সুযোগ',
                        ],
                    ],
                ],
                'pricing' => [
                    'amount' => '৳৫০০',
                    'period' => '/ মাস (ফ্ল্যাট চেম্বার প্যাক)',
                    'badge' => 'স্বচ্ছ প্রাইসিং',
                    'highlight' => 'বিচারপ্রার্থীদের জন্য ৳২০০/পরামর্শ ও আইনজীবীদের জন্য ৳৫০০/মাস ফ্ল্যাট চেম্বার রেট।',
                ],
                'features' => [
                    ['icon' => '⚖️', 'title' => 'Court Hearing Schedule', 'title_bn' => 'অটো কজ লিস্ট & তারিখ রিমাইন্ডার', 'desc' => 'Auto-sync cause lists and hearing dates.', 'desc_bn' => 'হাইকোর্ট ও জজ কোর্টের তারিখ মিস হওয়া শূন্যে নামান।'],
                    ['icon' => '🔐', 'title' => 'Encrypted Document Vault', 'title_bn' => '২৫৬-বিট ক্লায়েন্ট ফাইল ভল্ট', 'desc' => '256-bit AES encryption for confidential legal papers.', 'desc_bn' => 'গোপনীয় আইনি নথি, চুক্তিপত্র ও এফিডেভিটের নিরাপদ স্টোরেজ।'],
                    ['icon' => '📱', 'title' => 'Client Case Portal', 'title_bn' => 'স্মার্ট ভেরিফাইড ক্লায়েন্ট কেস পোর্টাল', 'desc' => 'Track full legal history and payment invoices.', 'desc_bn' => 'ক্লায়েন্ট ফোন না দিয়ে মামলায় নিজের বাদী/বিবাদী আপডেট ও তারিখ দেখতে পাবে।'],
                    ['icon' => '💳', 'title' => 'bKash Legal Billing', 'title_bn' => 'বিকাশ অটো-ফি কালেকশন ও রসিদ', 'desc' => 'Instant bKash payment receipts and ledgers.', 'desc_bn' => 'অ্যাডভোকেট ফি ও ক্লায়েন্ট বিলিং হিসাবের অটোমেটিক ডিজিটাল রসিদ।'],
                ],
                'url' => "{$scheme}://law.{$baseDomain}{$port}",
            ],

            'social' => [
                'id' => 'social',
                'name' => 'Zengfy Social',
                'category' => 'Community & Identity',
                'badge' => 'NID Verified Network',
                'tagline' => 'NID-Verified Social Network for Real Connections',
                'desc' => 'Connect, share, and build real community trust with zero fake profiles or spam bots.',
                'theme' => [
                    'primary' => 'from-blue-600 to-cyan-600',
                    'accent_text' => 'text-blue-400',
                    'bg_glow' => 'bg-blue-600/10',
                    'border_glow' => 'hover:border-blue-500/50',
                ],
                'pricing' => [
                    'amount' => 'Full Free',
                    'period' => 'per account',
                    'badge' => '100% Free',
                    'highlight' => 'Free Forever for all verified Bangladeshi citizens.',
                ],
                'features' => [
                    ['icon' => '🌐', 'title' => 'Real NID Badges', 'desc' => 'Guaranteed authentic human profiles.'],
                    ['icon' => '💬', 'title' => 'Community Discussions', 'desc' => 'Engage in localized topic feeds and groups.'],
                ],
                'url' => "{$scheme}://social.{$baseDomain}{$port}",
            ],

            'rent' => [
                'id' => 'rent',
                'name' => 'Zengfy Rent',
                'category' => 'Property & Rental',
                'badge' => 'Zengfy Rent — স্মার্ট রেডিয়াস বাসা ও টেন্যান্ট পোর্টাল',
                'tagline' => 'Automated Radius Rental Property & Verified Tenant Portal',
                'tagline_bn' => 'আপনার এলাকার ৫-১০ কিমি রেডিয়াসে সরাসরি বাড়িওয়ালার ফাঁকা বাসা খুঁজুন 🔑',
                'desc' => 'Find verified rental housing within 5km/10km radius with zero broker commission. Landlords can list vacant flats securely.',
                'desc_bn' => 'সোশ্যাল ইকোসিস্টেমের কোটি কোটি ব্যবহারকারীর জন্য দালাল ফি ছাড়া ৫-১০ কিমি ম্যাপ রেডিয়াসে ফাঁকা বাসা খোজার ও সরাসরি বাড়িওয়ালার সাথে যোগাযোগের স্মার্ট সমাধান।',
                'theme' => [
                    'primary' => 'from-purple-600 to-indigo-600',
                    'accent_text' => 'text-purple-400',
                    'bg_glow' => 'bg-purple-600/10',
                    'border_glow' => 'hover:border-purple-500/50',
                ],
                'youtube_id' => 'dQw4w9WgXcQ',
                'pricing_tiers' => [
                    'tenant' => [
                        'name' => 'বাসা অনুসন্ধানকারী কানেক্ট (Tenant Search)',
                        'badge' => 'বাসা সন্ধানকারী চয়েস',
                        'amount' => '৳৫০',
                        'period' => '/ সার্চ কোয়েরি & কন্টাক্ট রিলিজ',
                        'highlight' => '৫-১০ কিমি ম্যাপ রেডিয়াসে ফাঁকা বাসা ফিল্টার ও ১-ক্লিকে সরাসরি বাড়িওয়ালার নম্বর রিলিজ।',
                        'features' => [
                            '৫ কিমি ও ১০ কিমি রেডিয়াস সার্কেল ম্যাপ সার্চ',
                            'দালাল বা মধ্যস্বত্বভোগী ছাড়া সরাসরি বাড়িওয়ালার নম্বর পাওয়া',
                            'প্রপার্টির ছবি, ফ্ল্যাটের সাইজ (২/৩ বিএইচকে) ও প্রকৃত ভাড়া দেখা',
                            'ডিজিটাল কন্টাক্ট টোকেন ও বুকিং রসিদ',
                        ],
                    ],
                    'landlord' => [
                        'name' => 'বাড়িওয়ালা লিস্টিং প্যাক (Landlord Listing)',
                        'badge' => 'বাড়িওয়ালা চয়েস',
                        'amount' => '৳১৫০',
                        'period' => '/ অ্যাক্টিভ বাসা ফাঁকা বিজ্ঞাপন',
                        'highlight' => 'Zengfy Social-এর কোটি কোটি ইউজারের কাছে সরাসরি বাসা ফাঁকার বিজ্ঞাপন পৌঁছানো।',
                        'features' => [
                            '১-ক্লিকে সোশ্যাল ফিডে বাসা ফাঁকা লাইভ বিজ্ঞাপন',
                            'স্মার্ট ভেরিফাইড প্রপার্টি আইডি ও ওনার সিকিউরিটি ভের্রিফাইড',
                            'ভাড়াটিয়া ব্যাকগ্রাউন্ড চেক ও স্মার্ট কন্টাক্ট নোটিফিকেশন',
                            'বিকাশ/নগদ ভাড়া কালেকশন ও ডিজিটাল ভাড়া রসিদ',
                        ],
                    ],
                ],
                'pricing' => [
                    'amount' => '৳৫০',
                    'period' => '/ সার্চ কানেক্ট (বাড়িওয়ালার জন্য ৳১৫০/বিজ্ঞাপন)',
                    'badge' => 'স্বচ্ছ প্রাইসিং',
                    'highlight' => 'বাসা সন্ধানকারীদের জন্য ৳৫০/সার্চ ও বাড়িওয়ালাদের জন্য ৳১৫০/বিজ্ঞাপন।',
                ],
                'features' => [
                    ['icon' => '📍', 'title' => '5-10 KM Radius Map Search', 'title_bn' => '৫-১০ কিমি রেডিয়াস ম্যাপ সার্চ', 'desc' => 'Interactive radius circle search around your live location.', 'desc_bn' => 'লাইভ লোকেশনের ৫-১০ কিমির ভেতর খালি বাসা ফিল্টার।'],
                    ['icon' => '🚫', 'title' => 'Broker Free Direct Connect', 'title_bn' => 'দালালমুক্ত সরাসরি বাড়িওয়ালা কন্টাক্ট', 'desc' => 'Direct owner contact release with zero middleman fee.', 'desc_bn' => 'কোনো অতিরিক্ত কমিশন ছাড়াই সরাসরি বাড়িওয়ালার সাথে কথা।'],
                    ['icon' => '🔐', 'title' => 'Verified Property ID', 'title_bn' => 'স্মার্ট ভেরিফাইড প্রপার্টি ভল্ট', 'desc' => 'NID-authenticated property ownership verification.', 'desc_bn' => 'ডিজিটাল এনআইডি ও ভেরিফাইড বাড়িওয়ালা প্রোফাইল সিকিউরিটি।'],
                    ['icon' => '📜', 'title' => 'Digital Rent Receipts', 'title_bn' => 'বিকাশ অটো-ভাড়া কালেকশন & রসিদ', 'desc' => 'Instant bKash rent collection and automated digital receipts.', 'desc_bn' => '১-ক্লিকে মাসিক বাসা ভাড়া কালেকশন ও অটো ডিজিটাল রসিদ।'],
                ],
                'url' => "{$scheme}://rent.{$baseDomain}{$port}",
            ],

            'hotel' => [
                'id' => 'hotel',
                'name' => 'Zengfy Hotel',
                'category' => 'Hospitality & Booking',
                'badge' => 'Zengfy Hotel & Restaurant ERP — AI তদারকি ও ZengPay কুইন পেমেন্ট',
                'tagline' => 'Automated Hotel, Restaurant ERP & AI Business Growth Supervision',
                'tagline_bn' => 'হোটেল, রেস্টুরেন্ট ও কমিউনিটি সেন্টার ডিজিটাইজ করুন, AI দিয়ে ব্যবসা বাড়ান 🏨',
                'desc' => 'Daily expenses audit, employee payroll, AI business monitoring, and customer restaurant payments via ZengPay Coin tokens.',
                'desc_bn' => 'দৈনিক খরচ ও কর্মচারীদের বেতনের খাতা, AI বিজনেস তদারকি এবং রেস্টুরেন্টে গ্রাহকদের ZengPay কুইন পেমেন্ট নেওয়ার অল-ইন-ওয়ান অপারেটিং সিস্টেম।',
                'theme' => [
                    'primary' => 'from-emerald-600 to-teal-600',
                    'accent_text' => 'text-emerald-400',
                    'bg_glow' => 'bg-emerald-600/10',
                    'border_glow' => 'hover:border-emerald-500/50',
                ],
                'youtube_id' => 'dQw4w9WgXcQ',
                'pricing_tiers' => [
                    'erp' => [
                        'name' => 'হোটেল & রেস্টুরেন্ট অল-ইন-ওয়ান ইআরপি (Hotel & Restaurant Suite)',
                        'badge' => 'জনপ্রিয় মার্চেন্ট চয়েস',
                        'amount' => '৳৭০০',
                        'period' => '/ মাস (ফ্ল্যাট সাবস্ক্রিপশন)',
                        'highlight' => 'দৈনিক খরচ ও বেতন ইআরপি, AI বিজনেস গাইড এবং কাস্টমারদের ZengPay কুইন পেমেন্ট কালেকশন।',
                        'features' => [
                            'দৈনিক কাঁচামাল কেনাকাটা, বাজার খরচ ও স্টাফ বেতন লেজার',
                            'AI দিয়ে ব্যবসা তদারকি (বিক্রি বাড়াতে অটো সাজেশন)',
                            'রেস্টুরেন্ট বিল কাস্টমারদের ZengPay Coin দিয়ে পরিশোধের সুবিধা',
                            'গেস্ট রুম সিকিউরিটি ভেরিফিকেশন ও কমিউনিটি কনভেনশন হল বুকিং',
                        ],
                    ],
                ],
                'pricing' => [
                    'amount' => '৳৭০০',
                    'period' => '/ মাস (ফ্ল্যাট সাবস্ক্রিপশন)',
                    'badge' => 'স্বচ্ছ প্রাইসিং',
                    'highlight' => 'সব হোটেল, রেস্টুরেন্ট ও কমিউনিটি সেন্টারের জন্য ৳৭০০/মাস ফ্ল্যাট রেট।',
                ],
                'features' => [
                    ['icon' => '📊', 'title' => 'Daily Expense & Payroll', 'title_bn' => 'দৈনিক খরচ ও বেতন হিসাব ইআরপি', 'desc' => 'Track daily market costs and employee salary disbursements.', 'desc_bn' => 'প্রতিদিনের কাঁচামাল বাজার খরচ, বিদ্যুৎ বিল ও স্টাফ বেতন।'],
                    ['icon' => '🤖', 'title' => 'AI Business Growth Advisor', 'title_bn' => 'AI দিয়ে ব্যবসা তদারকি & গাইড', 'desc' => 'Smart AI supervision analyzing sales and profit margins.', 'desc_bn' => 'কাস্টমার ট্রাফিক ও লাভ বাড়াতে AI স্বয়ংক্রিয় সাজেশন।'],
                    ['icon' => '🪙', 'title' => 'ZengPay Coin QR Payments', 'title_bn' => 'ZengPay কুইন ক্যাশলেস পেমেন্ট', 'desc' => 'Accept instant restaurant bill payments via ZengPay Coin tokens.', 'desc_bn' => 'কাস্টমারদের রেস্টুরেন্ট বিল সরাসরি ZengPay কুইনে নেওয়ার সুযোগ।'],
                    ['icon' => '🏨', 'title' => 'Room & Banquet Hall Booking', 'title_bn' => 'গেস্ট রুম & কমিউনিটি সেন্টার সূচি', 'desc' => 'Room reservations, guest security check, and event hall calendar.', 'desc_bn' => 'গেস্ট এনআইডি ভেরিফিকেশন ও কনভেনশন হল বুকিং ক্যালেন্ডার।'],
                ],
                'url' => "{$scheme}://hotel.{$baseDomain}{$port}",
            ],

            'ngo' => [
                'id' => 'ngo',
                'name' => 'Zengfy NGO',
                'category' => 'Charity & Non-Profit',
                'badge' => 'Zengfy NGO — ১00% স্বচ্ছ ডোনেশন ও ভেরিফাইড ত্রাণ পোর্টাল',
                'tagline' => 'Transparent Donation, Verified Proof & Emergency Relief System',
                'tagline_bn' => '১00% স্বচ্ছ ডোনেশন পোর্টাল, সরাসরি সোশ্যাল কাস্টমারদের সহায়তায় দাঁড়ান ❤️',
                'desc' => '100% verified authentic charity campaigns, real-time live donation progress tickers, document proof verification, and social live stream fundraising.',
                'desc_bn' => 'ভূয়া ফান্ডরাইজিং মুক্ত ভেরিফাইড প্রুফ ভেরিফিকেশন, রিয়েল-টাইম লাইভ ডোনেশন টিকার এবং সোশ্যাল ইকোসিস্টেমে লাইভ সেশন ব্রডকাস্ট।',
                'theme' => [
                    'primary' => 'from-rose-600 to-pink-600',
                    'accent_text' => 'text-rose-400',
                    'bg_glow' => 'bg-rose-600/10',
                    'border_glow' => 'hover:border-rose-500/50',
                ],
                'youtube_id' => 'dQw4w9WgXcQ',
                'pricing_tiers' => [
                    'donor' => [
                        'name' => 'স্বচ্ছ ডোনার এক্সেস (Social Donor Access)',
                        'badge' => 'ডোনার চয়েস',
                        'amount' => '১০০% ফ্রি',
                        'period' => '(০% প্ল্যাটফর্ম ফি)',
                        'highlight' => 'কোনো অতিরিক্ত সার্ভিস চার্জ ছাড়াই সরাসরি ভেরিফাইড ত্রাণ তহবিলে ১-ক্লিকে ডোনেশন।',
                        'features' => [
                            '১০০% ভেরিফাইড এনজিও ও সরাসরি সামাজিক ডোনেশন',
                            'রিয়েল-টাইম ডোনেশন কাউন্টার ও লাইভ আপডেট দেখা',
                            '১-ক্লিকে বিকাশ/নগদে ১০০% ফ্রিতে সহায়তা পাঠানো',
                            'ডিজিটাল ডোনার রসিদ ও ত্রাণ বিতরণ স্ট্যাটাস',
                        ],
                    ],
                    'organizer' => [
                        'name' => 'ভেরিফাইড ক্যাম্পেইন প্যাক (Verified Campaign Promotion)',
                        'badge' => 'আয়োজক চয়েস',
                        'amount' => '৳৩০০',
                        'period' => '/ অ্যাক্টিভ ক্যাম্পেইন প্রচার',
                        'highlight' => 'এনআইডি ও মেডিকেল প্রুফ ভেরিফিকেশন সহ সোশ্যাল ফিডে লাইভ সেশন ফান্ডরাইজিং।',
                        'features' => [
                            'এনআইডি, হাসপাতাল ও ত্রাণ নথিপত্র সত্যায়ন চেক',
                            'Zengfy Social-এ লাইভ সেশন ও ব্রডকাস্ট অপশন আনলক',
                            'সোশ্যাল ইকোসিস্টেমের কোটি কোটি ইউজারের কাছে ফিচার্ড পিন',
                            'স্বচ্ছ ডোনেশন লেজার ও ফটো/ভাউচার আপডেট পোর্টাল',
                        ],
                    ],
                ],
                'pricing' => [
                    'amount' => '১০০% ফ্রি',
                    'period' => '(আয়োজক ভেরিফাইড প্রচারের জন্য ৳৩০০/ক্যাম্পেইন)',
                    'badge' => 'স্বচ্ছ প্রাইসিং',
                    'highlight' => 'ডোনারদের জন্য ১০০% ফ্রি ও আয়োজকদের সত্যায়িত প্রচারের জন্য ৳৩০০/ক্যাম্পেইন।',
                ],
                'features' => [
                    ['icon' => '❤️', 'title' => 'Real-Time Fund Counter', 'title_bn' => 'রিয়েল-টাইম লাইভ ডোনেশন হিসাব', 'desc' => 'Live funding progress bar and transparent ledgers.', 'desc_bn' => '১-ক্লিকে সংগৃহীত ফান্ড ও লাইভ ট্র্যাকিং।'],
                    ['icon' => '🔐', 'title' => '100% Verified Proof Check', 'title_bn' => '১০০% সত্যায়িত প্রুফ ভেরিফিকেশন', 'desc' => 'NID and document authentication to eliminate fake fundraisers.', 'desc_bn' => 'এনআইডি ও মেডিকেল নথিপত্র সত্যায়ন চেক।'],
                    ['icon' => '🎥', 'title' => 'Social Live Broadcast', 'title_bn' => 'সোশ্যাল লাইভ সেশন ব্রডকাস্ট', 'desc' => 'Host live fundraising sessions directly on Zengfy Social.', 'desc_bn' => 'সোশ্যাল ফিডে লাইভ সেশন চালিয়ে সরাসরি ডোনেশন আহ্বান।'],
                    ['icon' => '📜', 'title' => 'Transparent Audit Ledger', 'title_bn' => 'স্বচ্ছ ত্রাণ বিতরণ লেজার', 'desc' => 'Public audit ledgers and automated digital donor receipts.', 'desc_bn' => 'ছবি, ভাউচার ও রসিদ সহ স্বচ্ছ ত্রাণ লেজার।'],
                ],
                'url' => "{$scheme}://ngo.{$baseDomain}{$port}",
            ],

            'civil' => [
                'id' => 'civil',
                'name' => 'Zengfy Civil',
                'category' => 'Engineering & Construction',
                'badge' => 'Zengfy Civil — সিভিল সাইট ইআরপি, AI ম্যাপ এনালাইসিস ও কনসালট্যান্ট পোর্টাল',
                'tagline' => 'Civil Site Management ERP, AI Structural Analysis & Contractor Network',
                'tagline_bn' => 'সিভিল সাইট ম্যানেজমেন্ট ডিজিটাইজ করুন, AI দিয়ে ম্যাপ ও খরচ এনালাইসিস করুন 🏗️',
                'desc' => 'Complete site raw material expenses ledger, labor daily wages, AI structural map analysis, and verified engineer search directory.',
                'desc_bn' => 'রড, সিমেন্ট ও বালি কাঁচামাল লেজার, সাইট কন্ট্রাক্টর বেতন ইআরপি, AI ম্যাপ এনালাইসিস এবং ভেরিফাইড ইঞ্জিনিয়ার ও কন্ট্রাক্টর পেইড সার্চ পোর্টাল।',
                'theme' => [
                    'primary' => 'from-amber-600 to-yellow-600',
                    'accent_text' => 'text-amber-400',
                    'bg_glow' => 'bg-amber-600/10',
                    'border_glow' => 'hover:border-amber-500/50',
                ],
                'youtube_id' => 'dQw4w9WgXcQ',
                'pricing_tiers' => [
                    'client' => [
                        'name' => 'হোম-ওনার সার্চ কানেক্ট (Verified Consultant Search)',
                        'badge' => 'বাড়ি নির্মাণকারী চয়েস',
                        'amount' => '৳১০০',
                        'period' => '/ ভেরিফাইড ইঞ্জিনিয়ার সার্চ',
                        'highlight' => 'ভেরিফাইড সিভিল ইঞ্জিনিয়ার, কন্ট্রাক্টর প্রোফাইল ও বিল্ডিং প্ল্যান এক্সেস।',
                        'features' => [
                            'ভেরিফাইড সিভিল ইঞ্জিনিয়ার ও স্থপতি ফাইল এক্সেস',
                            'অভিজ্ঞ কন্ট্রাক্টরদের পূর্বের প্রজেক্ট ট্র্যাক রেকর্ড',
                            'বিল্ডিং ফ্লোর প্ল্যান ও ব্লুপ্রিন্ট গ্যালারি সার্চ',
                            '১-ক্লিকে কনসালট্যান্ট সরাসরি কন্টাক্ট ইনফো',
                        ],
                    ],
                    'firm' => [
                        'name' => 'ইঞ্জিনিয়ারিং ফার্ম & কন্ট্রাক্টর ইআরপি (Construction ERP)',
                        'badge' => 'ফার্ম & কন্ট্রাক্টর চয়েস',
                        'amount' => '৳৮০০',
                        'period' => '/ মাস (ফ্ল্যাট সাবস্ক্রিপশন)',
                        'highlight' => 'সাইট কাঁচামাল খরচ লেজার, লেবার মজুরি ইআরপি ও AI ম্যাপ এনালাইসিস।',
                        'features' => [
                            'রড, সিমেন্ট, বালি বাজার খরচ ও ডেলিভারি ট্র্যাকিং',
                            'রাজমিস্ত্রি ও সাইট লেবারদের দৈনিক হাজিরা ও মজুরি লেজার',
                            'AI দিয়ে সাইট সয়েল টেস্ট ও ম্যাপ ফাইল এনালাইসিস',
                            'ক্লাউড আর্কিটেকচারাল ব্লুপ্রিন্ট ভল্ট ও ক্লায়েন্ট বিলিং',
                        ],
                    ],
                ],
                'pricing' => [
                    'amount' => '৳১০০',
                    'period' => '(ইঞ্জিনিয়ারিং ফার্ম ইআরপির জন্য ৳৮০০/মাস)',
                    'badge' => 'স্বচ্ছ প্রাইসিং',
                    'highlight' => 'কাস্টমার সার্চের জন্য ৳১০০ ও ফার্ম সাইট ইআরপির জন্য ৳৮০০/মাস।',
                ],
                'features' => [
                    ['icon' => '🏗️', 'title' => 'Civil Site Expense ERP', 'title_bn' => 'সাইট কাঁচামাল & লেবার হিসাব', 'desc' => 'Track rod, cement, sand purchases and worker wages.', 'desc_bn' => 'রড, সিমেন্ট, বালি কাঁচামাল খরচ ও রাজমিস্ত্রি মজুরি।'],
                    ['icon' => '🤖', 'title' => 'AI Structural & Soil Advisor', 'title_bn' => 'AI সাইট & ম্যাপ এনালাইসিস', 'desc' => 'Smart AI evaluating floor plans and soil test reports.', 'desc_bn' => 'বিল্ডিং ফ্লোর প্ল্যান ও সয়েল টেস্টে AI দিকনির্দেশনা।'],
                    ['icon' => '📐', 'title' => 'Blueprint Cloud Vault', 'title_bn' => 'বিল্ডিং ম্যাপ & প্রজেক্ট ভল্ট', 'desc' => 'Cloud storage for CAD drawings and structural blueprints.', 'desc_bn' => 'আর্কিটেকচারাল ব্লুপ্রিন্ট ও ক্লায়েন্ট ডকুমেন্ট ভল্ট।'],
                    ['icon' => '🔍', 'title' => 'Verified Engineer Search', 'title_bn' => 'পেইড ইঞ্জিনিয়ার & কন্ট্রাক্টর সার্চ', 'desc' => 'Search verified civil engineers and contractor credentials.', 'desc_bn' => 'ভেরিফাইড সিভিল ইঞ্জিনিয়ার ও কন্ট্রাক্টর প্রোফাইল।'],
                ],
                'url' => "{$scheme}://civil.{$baseDomain}{$port}",
            ],

            'skill' => [
                'id' => 'skill',
                'name' => 'Zengfy Skill',
                'category' => 'LMS & Training',
                'badge' => 'LMS Platform',
                'tagline' => 'Online Courses, Instructors & Skill Certifications',
                'desc' => 'Host live classes, video courses, student assignments, and verified certificates.',
                'theme' => [
                    'primary' => 'from-violet-600 to-purple-600',
                    'accent_text' => 'text-violet-400',
                    'bg_glow' => 'bg-violet-600/10',
                    'border_glow' => 'hover:border-violet-500/50',
                ],
                'pricing' => [
                    'amount' => 'Flexible Rate',
                    'period' => 'based on teacher/course',
                    'badge' => 'Instructor Hub',
                    'highlight' => 'Custom commission and subscription rates set by instructors.',
                ],
                'features' => [
                    ['icon' => '🎓', 'title' => 'Live Classes & Courses', 'desc' => 'Stream HD video lessons and assignments.'],
                    ['icon' => '📜', 'title' => 'Digital Certificates', 'desc' => 'Issue tamper-proof verified course certificates.'],
                ],
                'url' => "{$scheme}://skill.{$baseDomain}{$port}",
            ],

            'journal' => [
                'id' => 'journal',
                'name' => 'Zengfy Journal',
                'category' => 'Personal & Productivity',
                'badge' => 'Personal Vault',
                'tagline' => 'Encrypted Personal Diary, Notes & Thought Log',
                'desc' => 'Keep your daily thoughts, private notes, and personal goals protected with biometric encryption.',
                'theme' => [
                    'primary' => 'from-slate-600 to-zinc-600',
                    'accent_text' => 'text-slate-400',
                    'bg_glow' => 'bg-slate-600/10',
                    'border_glow' => 'hover:border-slate-500/50',
                ],
                'pricing' => [
                    'amount' => '৳300',
                    'period' => '/ month',
                    'badge' => 'Private Vault',
                    'highlight' => '256-bit encrypted personal diary & unlimited cloud sync.',
                ],
                'features' => [
                    ['icon' => '📓', 'title' => 'Biometric Encrypted Log', 'desc' => 'PIN and fingerprint protected diary entries.'],
                    ['icon' => '☁️', 'title' => 'Cloud Sync', 'desc' => 'Access your notes across all your devices securely.'],
                ],
                'url' => "{$scheme}://journal.{$baseDomain}{$port}",
            ],

            'ecommerce' => [
                'id' => 'ecommerce',
                'name' => 'Zengfy Commerce',
                'category' => 'Online Store & Orders',
                'badge' => 'E-Commerce Platform',
                'tagline' => 'Online Storefront, Order Tracking & Gateway Integration',
                'desc' => 'Launch your branded online store with automated inventory, order dispatching, and bKash checkout.',
                'theme' => [
                    'primary' => 'from-blue-600 to-indigo-600',
                    'accent_text' => 'text-blue-400',
                    'bg_glow' => 'bg-blue-600/10',
                    'border_glow' => 'hover:border-blue-500/50',
                ],
                'pricing' => [
                    'amount' => '৳2,000',
                    'period' => '/ month',
                    'badge' => 'Store Owner',
                    'highlight' => 'Includes custom domain setup and bKash/Steadfast courier integration.',
                ],
                'features' => [
                    ['icon' => '🛍️', 'title' => 'Custom Online Shop', 'desc' => 'Mobile-optimized product catalog and cart.'],
                    ['icon' => '🚚', 'title' => 'Courier Integration', 'desc' => 'One-click Steadfast & Pathao courier booking.'],
                ],
                'url' => "{$scheme}://ecommerce.{$baseDomain}{$port}",
            ],

            'habit' => [
                'id' => 'habit',
                'name' => 'Zengfy Habit',
                'category' => 'Personal Growth & Habits',
                'badge' => 'Habit Tracker',
                'tagline' => 'Daily Habit Tracking & Accountability System',
                'desc' => 'Build daily streaks, track habits, and achieve personal milestones with gamified analytics.',
                'theme' => [
                    'primary' => 'from-emerald-600 to-green-600',
                    'accent_text' => 'text-emerald-400',
                    'bg_glow' => 'bg-emerald-600/10',
                    'border_glow' => 'hover:border-emerald-500/50',
                ],
                'pricing' => [
                    'amount' => 'Full Free',
                    'period' => 'per account',
                    'badge' => '100% Free',
                    'highlight' => 'Free habit streak tracking for all ecosystem users.',
                ],
                'features' => [
                    ['icon' => '🔥', 'title' => 'Streak Counter', 'desc' => 'Maintain daily discipline streaks and reminders.'],
                    ['icon' => '📈', 'title' => 'Analytics Graph', 'desc' => 'Visualize monthly habit completion charts.'],
                ],
                'url' => "{$scheme}://habit.{$baseDomain}{$port}",
            ],

            'schedule' => [
                'id' => 'schedule',
                'name' => 'Zengfy Schedule',
                'category' => 'Task & Calendar Automation',
                'badge' => 'Calendar System',
                'tagline' => 'Unified Calendar, Meetings & Task Scheduling',
                'desc' => 'Schedule meetings, set automated SMS reminders, and manage daily task queues across teams.',
                'theme' => [
                    'primary' => 'from-indigo-600 to-blue-600',
                    'accent_text' => 'text-indigo-400',
                    'bg_glow' => 'bg-indigo-600/10',
                    'border_glow' => 'hover:border-indigo-500/50',
                ],
                'pricing' => [
                    'amount' => '৳400',
                    'period' => '/ month',
                    'badge' => 'Pro Calendar',
                    'highlight' => 'Includes Google Calendar sync and SMS appointment alerts.',
                ],
                'features' => [
                    ['icon' => '📅', 'title' => 'Smart Calendar', 'desc' => 'Cross-device team meeting and task scheduling.'],
                    ['icon' => '⏰', 'title' => 'SMS Reminders', 'desc' => 'Automated client appointment SMS notifications.'],
                ],
                'url' => "{$scheme}://schedule.{$baseDomain}{$port}",
            ],

            'housing' => [
                'id' => 'housing',
                'name' => 'Zengfy Housing',
                'category' => 'Real Estate & Properties',
                'badge' => 'Real Estate Suite',
                'tagline' => 'Commercial Property Sales, Rent & Land Directory',
                'desc' => 'List and manage commercial real estate, residential plots, building projects, and buyer leads.',
                'theme' => [
                    'primary' => 'from-teal-600 to-cyan-600',
                    'accent_text' => 'text-teal-400',
                    'bg_glow' => 'bg-teal-600/10',
                    'border_glow' => 'hover:border-teal-500/50',
                ],
                'pricing' => [
                    'amount' => '৳1,500',
                    'period' => '/ month',
                    'badge' => 'Real Estate Agency',
                    'highlight' => 'List unlimited properties and verified buyer leads.',
                ],
                'features' => [
                    ['icon' => '🏡', 'title' => 'Property Listing', 'desc' => 'HD photo galleries and map location pins.'],
                    ['icon' => '📋', 'title' => 'Lead Management', 'desc' => 'Track buyer inquiries and virtual tour requests.'],
                ],
                'url' => "{$scheme}://housing.{$baseDomain}{$port}",
            ],

            'laranexus' => [
                'id' => 'laranexus',
                'name' => 'Zengfy LaraNexus',
                'category' => 'Developer & API Gateway',
                'badge' => 'Developer Platform',
                'tagline' => 'Unified API Gateway, Webhooks & Developer Hub',
                'desc' => 'Connect custom third-party applications to Zengfy Unified SSO and access high-speed APIs.',
                'theme' => [
                    'primary' => 'from-orange-600 to-amber-600',
                    'accent_text' => 'text-orange-400',
                    'bg_glow' => 'bg-orange-600/10',
                    'border_glow' => 'hover:border-orange-500/50',
                ],
                'pricing' => [
                    'amount' => 'Developer Tier',
                    'period' => 'pay per API request',
                    'badge' => 'API Access',
                    'highlight' => '1,000 free API calls per month with instant webhooks.',
                ],
                'features' => [
                    ['icon' => '⚡', 'title' => 'REST API & Webhooks', 'desc' => 'Ultra-fast event webhooks and OAuth authentication.'],
                    ['icon' => '🛠️', 'title' => 'Developer Dashboard', 'desc' => 'Manage API tokens, rate limits, and audit logs.'],
                ],
                'url' => "{$scheme}://laranexus.{$baseDomain}{$port}",
            ],

            'founder' => [
                'id' => 'founder',
                'name' => 'Sazzad Hossain | Founder & Systems Architect',
                'category' => 'Founder & Systems Engineering',
                'badge' => 'Founder & Chief Architect',
                'tagline' => 'Full-Stack Engineer & Visionary Behind Zengfy Sovereign Ecosystem',
                'desc' => 'Explore the architectural vision, open-source projects, and systems engineering journey of Sazzad Hossain.',
                'theme' => [
                    'primary' => 'from-blue-600 via-indigo-600 to-cyan-400',
                    'accent_text' => 'text-blue-400',
                    'bg_glow' => 'bg-blue-600/10',
                    'border_glow' => 'hover:border-blue-500/50',
                ],
                'pricing' => [
                    'amount' => 'Open Vision',
                    'period' => 'Public Portfolio',
                    'badge' => 'Systems Architect',
                    'highlight' => 'Building Bangladesh\'s first NID-verified digital ecosystem.',
                ],
                'features' => [
                    ['icon' => '🏛️', 'title' => 'Unified SSO Architecture', 'desc' => 'Multi-tenant authentication across 15+ subdomains.'],
                    ['icon' => '⚡', 'title' => 'High Performance Systems', 'desc' => 'Core Web Vitals 100/100 Lighthouse performance.'],
                    ['icon' => '🔐', 'title' => 'Sovereign NID Security', 'desc' => 'National ID verified identity and data encryption.'],
                    ['icon' => '💻', 'title' => 'Open Source & Mentorship', 'desc' => 'Empowering developers with clean code & architecture.'],
                ],
                'url' => "{$scheme}://founder.{$baseDomain}{$port}",
            ],
        ];
    }

    public static function getModuleBySlug(string $slug): ?array
    {
        $modules = self::getModulesData();
        return $modules[strtolower($slug)] ?? null;
    }
}
