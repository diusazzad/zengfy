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
                'category' => 'Commerce & Multi-Store',
                'badge' => 'Retail Billing Solution',
                'tagline' => 'Smart Retail Billing & Stock Inventory',
                'desc' => 'Manage multi-store inventory, barcode scanning, bKash/Nagad billing, and daily profit/loss reports.',
                'theme' => [
                    'primary' => 'from-cyan-600 to-blue-600',
                    'accent_text' => 'text-cyan-400',
                    'bg_glow' => 'bg-cyan-600/10',
                    'border_glow' => 'hover:border-cyan-500/50',
                ],
                'pricing' => [
                    'amount' => '৳40,000',
                    'period' => 'One-time (৳8,000/yr maint.)',
                    'badge' => 'Lifetime License',
                    'highlight' => 'Full ownership with free thermal printer & barcode integration.',
                ],
                'features' => [
                    ['icon' => '🛒', 'title' => 'Barcode POS Terminal', 'desc' => 'Ultra-fast item checkout under 2 seconds.'],
                    ['icon' => '📦', 'title' => 'Stock & Low Alert', 'desc' => 'Automated low stock alerts and supplier purchase orders.'],
                    ['icon' => '📊', 'title' => 'Daily Profit & Loss', 'desc' => 'Real-time financial analytics dashboard.'],
                    ['icon' => '📲', 'title' => 'Mobile POS Scanner', 'desc' => 'Turn any smartphone into a wireless barcode scanner.'],
                ],
                'url' => "{$scheme}://pos.{$baseDomain}{$port}",
            ],

            'law' => [
                'id' => 'law',
                'name' => 'Zengfy Law Suite',
                'category' => 'Legal Practice & Vault',
                'badge' => 'Legal Practice System',
                'tagline' => 'Court Schedules, Client Records & Encrypted Vault',
                'desc' => 'Organize court hearing dates, client case files, and legal billing in a 256-bit encrypted cloud vault.',
                'theme' => [
                    'primary' => 'from-amber-600 to-orange-600',
                    'accent_text' => 'text-amber-400',
                    'bg_glow' => 'bg-amber-600/10',
                    'border_glow' => 'hover:border-amber-500/50',
                ],
                'pricing' => [
                    'amount' => '৳500',
                    'period' => '/ month',
                    'badge' => 'Chamber License',
                    'highlight' => 'Includes automated SMS hearing reminders for advocate chambers.',
                ],
                'features' => [
                    ['icon' => '⚖️', 'title' => 'Court Hearing Schedule', 'desc' => 'Auto-sync cause lists and hearing dates.'],
                    ['icon' => '🔐', 'title' => 'Encrypted Document Vault', 'desc' => '256-bit AES encryption for confidential legal papers.'],
                    ['icon' => '📜', 'title' => 'Client Case History', 'desc' => 'Track full legal history and payment invoices.'],
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
                'badge' => 'Tenant Verification System',
                'tagline' => 'Automated Rental Property & Tenant Verification',
                'desc' => 'Manage apartments, commercial spaces, tenant agreements, and background search reports instantly.',
                'theme' => [
                    'primary' => 'from-purple-600 to-indigo-600',
                    'accent_text' => 'text-purple-400',
                    'bg_glow' => 'bg-purple-600/10',
                    'border_glow' => 'hover:border-purple-500/50',
                ],
                'pricing' => [
                    'amount' => '৳30',
                    'period' => 'per search detail',
                    'badge' => 'Pay As You Go',
                    'highlight' => 'Instant NID tenant background & property search reports.',
                ],
                'features' => [
                    ['icon' => '🔑', 'title' => 'Tenant Verification', 'desc' => 'NID-verified tenant history and Police Form auto-fill.'],
                    ['icon' => '🏢', 'title' => 'Flat & Rent Tracking', 'desc' => 'Track rent due dates, utility bills, and SMS reminders.'],
                ],
                'url' => "{$scheme}://rent.{$baseDomain}{$port}",
            ],

            'hotel' => [
                'id' => 'hotel',
                'name' => 'Zengfy Hotel',
                'category' => 'Hospitality & Booking',
                'badge' => 'Hotel PMS System',
                'tagline' => 'Room Booking, Guest Check-in & Housekeeping',
                'desc' => 'Streamline room reservations, guest ID verification, invoice printing, and staff shift schedules.',
                'theme' => [
                    'primary' => 'from-emerald-600 to-teal-600',
                    'accent_text' => 'text-emerald-400',
                    'bg_glow' => 'bg-emerald-600/10',
                    'border_glow' => 'hover:border-emerald-500/50',
                ],
                'pricing' => [
                    'amount' => '৳1,200',
                    'period' => '/ month',
                    'badge' => 'Hospitality Suite',
                    'highlight' => 'Unlimited room management, guest check-ins, and POS integration.',
                ],
                'features' => [
                    ['icon' => '🏨', 'title' => 'Live Room Status', 'desc' => 'Real-time room availability, cleaning, and booking status.'],
                    ['icon' => '🧾', 'title' => 'Guest Check-in & Invoice', 'desc' => 'Instant guest ID scanning and thermal receipt printing.'],
                ],
                'url' => "{$scheme}://hotel.{$baseDomain}{$port}",
            ],

            'ngo' => [
                'id' => 'ngo',
                'name' => 'Zengfy NGO',
                'category' => 'Charity & Non-Profit',
                'badge' => 'Non-Profit Support',
                'tagline' => 'Transparent Donation & Relief Distribution System',
                'desc' => 'Track charity funds, relief distribution to the poor, and verified volunteer team campaigns.',
                'theme' => [
                    'primary' => 'from-rose-600 to-pink-600',
                    'accent_text' => 'text-rose-400',
                    'bg_glow' => 'bg-rose-600/10',
                    'border_glow' => 'hover:border-rose-500/50',
                ],
                'pricing' => [
                    'amount' => 'Free / Donation',
                    'period' => 'for poor & welfare',
                    'badge' => 'Welfare Plan',
                    'highlight' => '100% free software for verified non-profit organizations.',
                ],
                'features' => [
                    ['icon' => '❤️', 'title' => 'Relief Distribution', 'desc' => 'NID-based transparent relief disbursement.'],
                    ['icon' => '📊', 'title' => 'Donor Audit Ledger', 'desc' => 'Real-time public financial audit and donor receipts.'],
                ],
                'url' => "{$scheme}://ngo.{$baseDomain}{$port}",
            ],

            'civil' => [
                'id' => 'civil',
                'name' => 'Zengfy Civil',
                'category' => 'Engineering & Construction',
                'badge' => 'Construction Suite',
                'tagline' => 'Site Engineering, Material Expenses & Blueprint Vault',
                'desc' => 'Track construction project budgets, site contractor payments, and structural blueprints.',
                'theme' => [
                    'primary' => 'from-amber-600 to-yellow-600',
                    'accent_text' => 'text-amber-400',
                    'bg_glow' => 'bg-amber-600/10',
                    'border_glow' => 'hover:border-amber-500/50',
                ],
                'pricing' => [
                    'amount' => '৳700',
                    'period' => '/ month',
                    'badge' => 'Site Engineering',
                    'highlight' => 'Project tracking, site expense logs, and blueprint storage.',
                ],
                'features' => [
                    ['icon' => '🏗️', 'title' => 'Material Expense Log', 'desc' => 'Track cement, rod, and worker wage ledgers.'],
                    ['icon' => '📐', 'title' => 'Blueprint Vault', 'desc' => 'Secure CAD & architectural drawing cloud storage.'],
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
