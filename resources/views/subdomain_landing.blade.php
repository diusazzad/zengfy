<!-- resources/views/subdomain_landing.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', session('locale', 'bn')) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $module['name'] }} | Zengfy Ecosystem</title>

    <!-- Google Fonts: Plus Jakarta Sans & Hind Siliguri for Bengali -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- SEO Multi-Lingual & Regional hreflang Tags -->
    <link rel="alternate" hreflang="bn" href="{{ url()->current() }}?lang=bn" />
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en" />
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}" />

    <!-- JSON-LD FAQPage Schema for Google Search Rich Snippets -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "SoftwareApplication",
          "@id": "{{ url()->current() }}/#software",
          "name": "{{ $module['name'] }}",
          "operatingSystem": "Web",
          "applicationCategory": "BusinessApplication",
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "ratingCount": "96",
            "bestRating": "5",
            "worstRating": "1"
          },
          "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "BDT"
          },
          "description": "{{ $module['desc_bn'] ?? $module['desc'] }}"
        }
      ]
    }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Hind Siliguri', 'Plus Jakarta Sans', sans-serif; }
        .scroll-reveal {
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
    </style>
</head>
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden min-h-screen flex flex-col justify-between"
      x-data="{
          instituteType: 'school',
          sandboxAction: null,
          sandboxMessage: '',
          studentCount: 500
      }">

    <!-- Shared Header Navigation -->
    <x-landing.navbar />

    <!-- Main Body -->
    <main class="pt-24 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 w-full flex-grow">

        @if($module['id'] === 'founder')
            <!-- World-Class Founder & Systems Architect Dedicated Portfolio Layout -->
            <div class="max-w-5xl mx-auto mb-20 relative scroll-reveal opacity-0 translate-y-10">
                <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-blue-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Profile Card Header -->
                <div class="flex flex-col md:flex-row items-center gap-8 mb-12 p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 backdrop-blur-2xl shadow-2xl relative z-10">
                    <!-- Photo Container -->
                    <div class="relative shrink-0 group">
                        <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-3xl overflow-hidden border-2 border-blue-500/40 shadow-2xl shadow-blue-500/20 group-hover:border-blue-400 transition-all duration-300">
                            <img src="/core-landing-company/founder.webp"
                                 alt="Sazzad Hossain - Founder & Chief Systems Architect"
                                 width="160"
                                 height="160"
                                 loading="eager"
                                 fetchpriority="high"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.onerror=null; this.src='/core-landing-company/founder.jpg';">
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 rounded-full bg-emerald-500 border-4 border-[#0B0F17] flex items-center justify-center text-xs text-white font-bold" title="Systems Active & Ready">
                            ✓
                        </div>
                    </div>

                    <!-- Intro Info -->
                    <div class="text-center md:text-left flex-grow">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-wider mb-3">
                            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                            Founder & Chief Systems Architect
                        </div>
                        <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight">
                            Sazzad Hossain
                        </h1>
                        <p class="text-base sm:text-lg text-blue-300 font-semibold mt-1">
                            Building Bangladesh's First NID-Verified Sovereign Digital Ecosystem
                        </p>
                        <p class="text-xs sm:text-sm text-gray-300 mt-4 leading-relaxed font-normal max-w-2xl">
                            Full-Stack Systems Engineer specializing in high-performance Laravel architectures, distributed Single Sign-On (SSO) engines, multi-tenant SaaS infrastructure, and 256-bit cloud cryptographic security.
                        </p>

                        <!-- Social Buttons -->
                        <div class="mt-6 flex flex-wrap items-center justify-center md:justify-start gap-3">
                            <a href="https://github.com/diusazzad" target="_blank" aria-label="Visit Sazzad Hossain GitHub Profile" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs border border-white/10 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus-visible:ring-offset-[#0B0F17]">
                                <span>GitHub (@diusazzad)</span> →
                            </a>
                            <a href="https://linkedin.com/company/zengfy" target="_blank" aria-label="Connect with Sazzad Hossain on LinkedIn" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600/20 hover:bg-blue-600/30 text-blue-300 font-bold text-xs border border-blue-500/30 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus-visible:ring-offset-[#0B0F17]">
                                <span>LinkedIn Connection</span> →
                            </a>
                            <a href="mailto:sazzadhossain.mahim@gmail.com" aria-label="Send Email to Sazzad Hossain" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-300 font-bold text-xs border border-cyan-500/30 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus-visible:ring-offset-[#0B0F17]">
                                <span>sazzadhossain.mahim@gmail.com</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Interactive Terminal Code Component -->
                <div class="rounded-3xl bg-[#090D14] border border-white/10 overflow-hidden shadow-2xl mb-16 relative z-10 text-left font-mono text-xs">
                    <div class="px-4 py-3 bg-[#111723] border-b border-white/10 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            <span class="ml-2 text-gray-400 font-sans text-xs">sazzad@zengfy-core:~ (bash)</span>
                        </div>
                        <span class="text-blue-400 font-sans font-bold text-[11px]">Zengfy SSO Engine v1.0</span>
                    </div>
                    <div class="p-6 text-gray-300 space-y-2 overflow-x-auto leading-relaxed">
                        <p class="text-emerald-400">$ zengfy-cli architecture --inspect --target=all-15-subdomains</p>
                        <p class="text-gray-400">[INFO] Initializing Zengfy Unified Ecosystem Subdomain Engine...</p>
                        <p class="text-gray-200"><span class="text-blue-400">✓ NID Identity Layer:</span> ACTIVE (Verification SLA: < 0.1s)</p>
                        <p class="text-gray-200"><span class="text-indigo-400">✓ Central SSO Token Gateway:</span> ONLINE (Cross-Domain Session Cookie Active)</p>
                        <p class="text-gray-200"><span class="text-cyan-400">✓ Core Web Vitals Performance:</span> 100/100 Lighthouse Grade (CLS: 0.003, TBT: 0ms)</p>
                        <p class="text-amber-400">$ zengfy-cli deploy --environment=production --domain=zengfy.top</p>
                        <p class="text-emerald-400">[SUCCESS] 15 Subdomains Live: school, pos, law, social, rent, hotel, ngo, civil, skill, journal, ecommerce, habit, schedule, housing, laranexus.</p>
                    </div>
                </div>

                <!-- Skill Radar Pills -->
                <div class="text-center mb-16">
                    <h2 class="text-xl sm:text-3xl font-black text-white tracking-tight mb-4">Core Systems & Tech Stack</h2>
                    <div class="flex flex-wrap items-center justify-center gap-2.5 max-w-3xl mx-auto">
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600/10 border border-blue-500/30 text-blue-300">Laravel 11 Enterprise</span>
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-indigo-600/10 border border-indigo-500/30 text-indigo-300">PHP 8.3 & Artisan</span>
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-cyan-600/10 border border-cyan-500/30 text-cyan-300">Vue.js & React</span>
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-purple-600/10 border border-purple-500/30 text-purple-300">Vite 6 & Tailwind CSS</span>
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-emerald-600/10 border border-emerald-500/30 text-emerald-300">REST API & GraphQL</span>
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-amber-600/10 border border-amber-500/30 text-amber-300">MySQL & Redis Caching</span>
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600/10 border border-rose-500/30 text-rose-300">256-Bit AES Encryption</span>
                        <span class="px-4 py-2 rounded-xl text-xs font-bold bg-slate-600/10 border border-slate-500/30 text-slate-300">Docker & Linux Admin</span>
                    </div>
                </div>

                <!-- Featured Projects Showcase Section -->
                <div class="mb-20">
                    <div class="text-center mb-12">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-blue-400 bg-blue-500/10 border border-blue-500/20 px-3.5 py-1 rounded-full">
                            Portfolio Highlights
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">Featured Core Projects</h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2 max-w-xl mx-auto">Production SaaS systems, API gateways, and enterprise data analytics platforms built from scratch.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Project 1: ZenGfy -->
                        <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-blue-500/50 backdrop-blur-xl transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="w-12 h-12 rounded-2xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-2xl mb-6 text-blue-400">
                                    🌐
                                </div>
                                <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 bg-blue-500/10 text-blue-300 rounded-full border border-blue-500/20">
                                    Sovereign Ecosystem
                                </span>
                                <h3 class="text-xl font-black text-white mt-3 group-hover:text-blue-400 transition-colors">ZenGfy Ecosystem</h3>
                                <p class="text-xs text-gray-300 mt-3 leading-relaxed">
                                    Multi-tenant SaaS ecosystem featuring School ERP, POS Retail, Legal Vault, and NID-verified identity layer across 15+ subdomains.
                                </p>
                            </div>
                            <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000' : 'https://zengfy.top' }}" target="_blank" class="mt-6 text-xs font-bold text-blue-400 hover:text-blue-300 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                <span>Explore ZenGfy</span> →
                            </a>
                        </div>

                        <!-- Project 2: LaraNexus -->
                        <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-orange-500/50 backdrop-blur-xl transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="w-12 h-12 rounded-2xl bg-orange-600/20 border border-orange-500/30 flex items-center justify-center text-2xl mb-6 text-orange-400">
                                    ⚡
                                </div>
                                <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 bg-orange-500/10 text-orange-300 rounded-full border border-orange-500/20">
                                    API Gateway & Open Source
                                </span>
                                <h3 class="text-xl font-black text-white mt-3 group-hover:text-orange-400 transition-colors">LaraNexus Gateway</h3>
                                <p class="text-xs text-gray-300 mt-3 leading-relaxed">
                                    Unified API gateway, real-time webhook dispatcher, and OAuth developer authentication framework for high-throughput Laravel apps.
                                </p>
                            </div>
                            <a href="https://github.com/diusazzad/LaraNexus" target="_blank" class="mt-6 text-xs font-bold text-orange-400 hover:text-orange-300 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                <span>GitHub (@LaraNexus)</span> →
                            </a>
                        </div>

                        <!-- Project 3: Confidens Analytics -->
                        <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-indigo-500/50 backdrop-blur-xl transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="w-12 h-12 rounded-2xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-2xl mb-6 text-indigo-400">
                                    📊
                                </div>
                                <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 bg-indigo-500/10 text-indigo-300 rounded-full border border-indigo-500/20">
                                    Enterprise Analytics
                                </span>
                                <h3 class="text-xl font-black text-white mt-3 group-hover:text-indigo-400 transition-colors">Confidens Analytics</h3>
                                <p class="text-xs text-gray-300 mt-3 leading-relaxed">
                                    High-performance metrics, data pipeline visualizations, and real-time business analytics platform for modern web teams.
                                </p>
                            </div>
                            <a href="https://confidensanalytics.com/" target="_blank" class="mt-6 text-xs font-bold text-indigo-400 hover:text-indigo-300 flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                <span>Visit Confidens Analytics</span> →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Career Work Experience Timeline -->
                <div class="mb-20 max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                            Career Journey
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">Professional Experience</h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">Proven track record of architecting scalable systems and leading technical teams.</p>
                    </div>

                    <div class="space-y-6">
                        <!-- Exp 1: Raw Axiom -->
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/30 backdrop-blur-xl transition-all">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                <div>
                                    <h3 class="text-lg font-black text-white">Full-Stack Developer (Remote)</h3>
                                    <p class="text-xs text-emerald-400 font-bold">Raw Axiom</p>
                                </div>
                                <span class="text-[11px] font-semibold text-gray-400 bg-white/5 border border-white/10 px-3 py-1 rounded-full shrink-0 w-fit">
                                    Nov 2025 – Present
                                </span>
                            </div>
                            <ul class="text-xs text-gray-300 space-y-1.5 leading-relaxed font-normal list-disc list-inside">
                                <li>Engineered robust, data-driven backends using Laravel and scalable RESTful APIs.</li>
                                <li>Integrated AI-assisted features and optimized API performance for international clients.</li>
                                <li>Developed highly interactive and responsive UIs with modern frameworks.</li>
                            </ul>
                        </div>

                        <!-- Exp 2: ZenGfy -->
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/30 backdrop-blur-xl transition-all">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                <div>
                                    <h3 class="text-lg font-black text-white">Founder & Full-Stack Developer</h3>
                                    <p class="text-xs text-blue-400 font-bold">ZenGfy Ecosystem</p>
                                </div>
                                <span class="text-[11px] font-semibold text-gray-400 bg-white/5 border border-white/10 px-3 py-1 rounded-full shrink-0 w-fit">
                                    2023 – Present
                                </span>
                            </div>
                            <ul class="text-xs text-gray-300 space-y-1.5 leading-relaxed font-normal list-disc list-inside">
                                <li>Architected and launched an ambitious multi-tenant SaaS ecosystem including E-commerce, School ERP, POS, and AI tools.</li>
                                <li>Utilized specialized AI logic alongside Laravel backend services and NID identity verification layer.</li>
                            </ul>
                        </div>

                        <!-- Exp 3: APPHS -->
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-indigo-500/30 backdrop-blur-xl transition-all">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                <div>
                                    <h3 class="text-lg font-black text-white">IT Support Engineer</h3>
                                    <p class="text-xs text-indigo-400 font-bold">APPHS | Gazipur, Bangladesh</p>
                                </div>
                                <span class="text-[11px] font-semibold text-gray-400 bg-white/5 border border-white/10 px-3 py-1 rounded-full shrink-0 w-fit">
                                    Jan 2022 – Oct 2025
                                </span>
                            </div>
                            <ul class="text-xs text-gray-300 space-y-1.5 leading-relaxed font-normal list-disc list-inside">
                                <li>Resolved technical issues and maintained software infrastructure for 400+ students.</li>
                                <li>Instructed students on ICT concepts, system security, and programming fundamentals.</li>
                            </ul>
                        </div>

                        <!-- Exp 4: SSL Wireless -->
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/30 backdrop-blur-xl transition-all">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3">
                                <div>
                                    <h3 class="text-lg font-black text-white">Web Intern</h3>
                                    <p class="text-xs text-cyan-400 font-bold">SSL Wireless | Dhaka, Bangladesh</p>
                                </div>
                                <span class="text-[11px] font-semibold text-gray-400 bg-white/5 border border-white/10 px-3 py-1 rounded-full shrink-0 w-fit">
                                    Jun 2021 – Sep 2021
                                </span>
                            </div>
                            <ul class="text-xs text-gray-300 space-y-1.5 leading-relaxed font-normal list-disc list-inside">
                                <li>Built a Learning Management System (LMS) with Laravel/MySQL, improving query performance by 20%.</li>
                                <li>Collaborated in an agile team to develop and test core registration features.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($module['id'] === 'school')
            <!-- Dynamic Institution Switcher Filter (Top Bar Sub-Nav) -->
            <div class="mb-10 flex flex-wrap items-center justify-center gap-2 sm:gap-3 p-2 rounded-2xl bg-[#121A29]/90 border border-white/10 max-w-2xl mx-auto backdrop-blur-xl shadow-xl scroll-reveal opacity-0 translate-y-10">
                <span class="text-xs font-bold text-gray-400 px-3 hidden sm:inline">প্রতিষ্ঠানের ধরন:</span>

                <button @click="instituteType = 'school'"
                        :class="instituteType === 'school' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all flex items-center gap-1.5 cursor-pointer">
                    <span>🏫</span> <span>হাই স্কুল</span>
                </button>

                <button @click="instituteType = 'college'"
                        :class="instituteType === 'college' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all flex items-center gap-1.5 cursor-pointer">
                    <span>🏛️</span> <span>কলেজ</span>
                </button>

                <button @click="instituteType = 'madrasah'"
                        :class="instituteType === 'madrasah' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all flex items-center gap-1.5 cursor-pointer">
                    <span>🕌</span> <span>মাদ্রাসা</span>
                </button>

                <button @click="instituteType = 'coaching'"
                        :class="instituteType === 'coaching' ? 'bg-blue-600 text-white font-bold shadow-lg shadow-blue-600/30' : 'bg-white/5 text-gray-300 hover:bg-white/10'"
                        class="px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all flex items-center gap-1.5 cursor-pointer">
                    <span>🎓</span> <span>কোচিং সেন্টার</span>
                </button>
            </div>

            <!-- 10x School / College Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-blue-400 bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                        🇧🇩 স্মার্ট প্রাতিষ্ঠানিক ডিজিটাল ইআরপি
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        <template x-if="instituteType === 'school'">
                            <span>আপনার স্কুলের প্রশাসনিক জটিলতা শূন্যে আনুন 🏫</span>
                        </template>
                        <template x-if="instituteType === 'college'">
                            <span>আপনার কলেজের একাদশ-দ্বাদশ শ্রেণি ও সেমিস্টার ফি ডিজিটাইজড 🏛️</span>
                        </template>
                        <template x-if="instituteType === 'madrasah'">
                            <span>মাদ্রাসার রেজাল্ট, লিল্লাহ বোর্ডিং ও অনলাইন ফি সমাধান 🕌</span>
                        </template>
                        <template x-if="instituteType === 'coaching'">
                            <span>কোচিং সেন্টারের ব্যাচ শিডিউল ও অনলাইন ফি ম্যানেজমেন্ট 🎓</span>
                        </template>
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        বিকাশ/নগদে অটো-ফি কালেকশন, জিপিএ ৫.০০ রেজাল্ট শিট জেনারেটর এবং অভিভাবক নোটিফিকেশন—সবকিছু এখন একটিমাত্র পোর্টাল থেকে।
                    </p>

                    <!-- Hero Action Buttons (Sandbox First - No Free Trial Signup Abuse) -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#sandbox"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-base shadow-xl shadow-blue-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>🎮 ১-ক্লিকে স্যান্ডবক্স ডেমো টেস্ট করুন</span>
                            <span>→</span>
                        </a>

                        <a href="#pricing"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            প্রাইসিং দেখুন (৳২,৫০০/মাস)
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">

                        <!-- Top School Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-xl text-blue-400">
                                    🏫
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white" x-text="instituteType === 'college' ? 'ঢাকা মডেল কলেজ (EIIN: 10842)' : 'ঢাকা মডেল একাডেমি (EIIN: 10842)'">ঢাকা মডেল একাডেমি</h3>
                                    <p class="text-[11px] text-emerald-400 font-semibold">● লাইভ অনলাইন সিস্টেম সক্রিয়</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                জিপিএ ৫.০০
                            </span>
                        </div>

                        <!-- Live GPA 5.00 Report Card Card -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">শিক্ষার্থী: <strong class="text-white">তাহমিদ হাসান (রোল #১)</strong></span>
                                <span class="text-blue-400 font-bold">শ্রেণি ১০ম (বিজ্ঞান)</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2 text-center pt-2">
                                <div class="p-2 rounded-xl bg-white/5 border border-white/5">
                                    <p class="text-[10px] text-gray-400">পদার্থবিজ্ঞান</p>
                                    <p class="text-xs font-bold text-emerald-400">A+ (৯৫)</p>
                                </div>
                                <div class="p-2 rounded-xl bg-white/5 border border-white/5">
                                    <p class="text-[10px] text-gray-400">উচ্চতর গণিত</p>
                                    <p class="text-xs font-bold text-emerald-400">A+ (৯৮)</p>
                                </div>
                                <div class="p-2 rounded-xl bg-white/5 border border-white/5">
                                    <p class="text-[10px] text-gray-400">ইংরেজি</p>
                                    <p class="text-xs font-bold text-emerald-400">A+ (৯১)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Live bKash Payment Status Badge -->
                        <div class="p-4 rounded-2xl bg-pink-950/30 border border-pink-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-pink-600/20 border border-pink-500/40 flex items-center justify-center font-black text-pink-400 text-lg">
                                    bKash
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ ৳৩,৫০৮ টিউশন ফি পরিশোধিত</p>
                                    <p class="text-[10px] text-pink-300">TrxID: BK98X2L8901 (অটো লেজার বুকিং)</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- YouTube Marketing Video Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-blue-400 bg-blue-500/10 border border-blue-500/20 px-3.5 py-1 rounded-full">
                        ভিডিও টিউটোরিয়াল
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটে দেখুন কীভাবে Zengfy আপনার প্রতিষ্ঠানের সময় ও খরচ বাঁচায়
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-[#121A29] border border-white/10 overflow-hidden shadow-2xl p-2 sm:p-4">
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-black flex items-center justify-center">
                        <iframe class="w-full h-full"
                                src="https://www.youtube-nocookie.com/embed/{{ $module['youtube_id'] ?? 'dQw4w9WgXcQ' }}?rel=0"
                                title="Zengfy School ERP Marketing Video"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Interactive Owner Sandbox Simulator (Hero/Video-এর ঠিক নিচে) -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-blue-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 কেনার আগেই ওনার প্যানেলের ক্ষমতা স্যান্ডবক্সে টেস্ট করুন (সাইনআপ ছাড়া)
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে ওনার প্যানেলের রিয়েল-টাইম ক্লিকেবল ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'admin'; sandboxMessage = '✓ সহকারী প্রধান শিক্ষক (মো: রফিকুল ইসলাম)-কে পেমেন্ট ও রিপোর্ট কার্ড জেনারেটর পারমিশন প্রদান করা হয়েছে।'"
                                :class="sandboxAction === 'admin' ? 'bg-blue-600 border-blue-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🔑</span>
                            <h3 class="text-sm font-bold">১. শিক্ষককে অ্যাডমিন রোল দিন</h3>
                            <p class="text-xs text-gray-400 mt-1">কার হাতে কতটুকু ক্ষমতা থাকবে ১-ক্লিকে ঠিক করুন।</p>
                        </button>

                        <button @click="sandboxAction = 'mark'; sandboxMessage = '✓ বিজ্ঞান বিভাগ ক্লাস ১০-এর জিপিএ ৫.০০ অটো রেজাল্ট শিট জেনারেট সম্পন্ন (রোল #১, #২, #৩)।'"
                                :class="sandboxAction === 'mark' ? 'bg-blue-600 border-blue-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📜</span>
                            <h3 class="text-sm font-bold">২. জিপিএ ৫.০০ অটো মার্কশিট বানান</h3>
                            <p class="text-xs text-gray-400 mt-1">৩ সপ্তাহের ম্যানুয়াল কাজ ১০ সেকেন্ডে জেনারেট করুন।</p>
                        </button>

                        <button @click="sandboxAction = 'bkash'; sandboxMessage = '✓ শিক্ষার্থী রোল #১০-এর ৳৩,৫০৮ বিকাশ ফি কালেকশন ভেরিফাইড এবং স্বয়ংক্রিয় ডিজিটাল SMS রসিদ প্রেরিত।'"
                                :class="sandboxAction === 'bkash' ? 'bg-blue-600 border-blue-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">💳</span>
                            <h3 class="text-sm font-bold">৩. বিকাশ ফি কালেকশন মিলান</h3>
                            <p class="text-xs text-gray-400 mt-1">ব্যাংকের লাইন ছাড়া অটোমেটিক লেজার বুকিং দেখুন।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-blue-950/40 border border-blue-500/40 text-blue-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Owner & Principal Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3.5 py-1 rounded-full">
                        ওনার কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        👑 প্রতিষ্ঠানের মালিক ও প্রিন্সিপাল হিসেবে আপনার হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Power 1 -->
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-2xl mb-4 text-blue-400">
                            👑
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">১-ক্লিক রোল পারমিশন কন্ট্রোল</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            কে কোন ডেটা দেখতে পারবে তার সম্পূর্ণ নিয়ন্ত্রণ আপনার হাতে। একাউন্টেন্ট বা টিচারকে পছন্দ অনুযায়ী পারমিশন দিন।
                        </p>
                    </div>

                    <!-- Power 2 -->
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-2xl mb-4 text-emerald-400">
                            💰
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">লাইভ ডিজিটাল সিন্দুক (Vault)</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            বিকাশ, নগদ ও ক্যাশ কাউন্টারে আজ কত টাকা আদায় হলো—১ সেকেন্ডে মালিকের মোবাইলে লাইভ হিসাব।
                        </p>
                    </div>

                    <!-- Power 3 -->
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-rose-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-rose-600/20 border border-rose-500/30 flex items-center justify-center text-2xl mb-4 text-rose-400">
                            🔒
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">জরুরি এক্সেস লক (Kill-Switch)</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            কোনো কর্মী বা শিক্ষক চাকরি ছাড়লে বা অনিয়ম করলে ১-ক্লিকে তার পুরো সিস্টেম এক্সেস বন্ধ করুন।
                        </p>
                    </div>

                    <!-- Power 4 -->
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-cyan-600/20 border border-cyan-500/30 flex items-center justify-center text-2xl mb-4 text-cyan-400">
                            📊
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">টিচার পারফরম্যান্স ট্র্যাকার</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            কোন শিক্ষক কটি ক্লাস নিয়েছেন এবং নির্ধারিত সময়ে মার্কশিট জমা দিয়েছেন কি না তার গ্রাফ দেখুন।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Savings & ROI Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        খরচ বাঁচানোর লাইভ হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন Zengfy ব্যবহার করলে আপনার বছরে কত টাকা ও সময় সাশ্রয় হবে
                    </h2>

                    <!-- Student Count Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার প্রতিষ্ঠানে শিক্ষার্থী কতজন? <strong class="text-blue-400 text-lg" x-text="studentCount"></strong> জন
                        </label>
                        <input type="range" min="100" max="5000" step="50" x-model="studentCount"
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-blue-500">
                    </div>

                    <!-- Calculated Savings Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">💵 কাগজ ও মেমো খরচ সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1" x-text="'৳' + (studentCount * 90).toLocaleString() + '/বছর'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">⏱️ ম্যানুয়াল কাজের সময় সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-blue-400 mt-1" x-text="(studentCount / 12.5).toFixed(0) + ' ঘণ্টা/মাস'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ Zengfy সাশ্রয়ী খরচ</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">৳২,৫০০/মাস</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-blue-400 bg-blue-500/10 border border-blue-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Legal Vault & Cases</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">NID Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Tenant System</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://ecommerce.zengfy.test:7000' : 'https://ecommerce.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛍️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Shop</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Online Store Engine</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://journal.zengfy.test:7000' : 'https://journal.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-slate-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">📰</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Journal</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Publishing Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://skill.zengfy.test:7000' : 'https://skill.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-violet-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎓</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Skill</h3>
                        <p class="text-[10px] text-gray-400 mt-1">LMS Platform</p>
                    </a>
                </div>
            </div>

            <!-- Transparent & Flexible Pricing Tiers -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-blue-400 bg-blue-500/10 border border-blue-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ কোনো গোপন দাম নেই — স্পষ্ট ও সাশ্রয়ী সাবস্ক্রিপশন প্যাকেজ
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- Starter Plan (৳2,500/mo) -->
                    <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-blue-500/50 backdrop-blur-xl transition-all flex flex-col justify-between">
                        <div>
                            <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-bold border border-blue-500/20">
                                {{ $module['pricing_tiers']['starter']['badge'] ?? 'ছোট-মাঝারি প্রতিষ্ঠানের জন্য' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['starter']['name'] ?? 'স্টার্টার প্যাক (Starter Plan)' }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['starter']['amount'] ?? '৳২,৫০০' }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['starter']['period'] ?? '/ মাস' }}</span>
                            </div>

                            <p class="text-xs text-blue-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['starter']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['starter']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                           class="mt-8 w-full py-3.5 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs text-center border border-white/10 transition-all">
                            স্টার্টার প্যাক শুরু করুন →
                        </a>
                    </div>

                    <!-- Smart Institutional Plan (৳3,500/mo) -->
                    <div class="p-8 rounded-3xl bg-gradient-to-b from-[#162033] to-[#121A29] border border-blue-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-blue-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            জনপ্রিয় প্রাতিষ্ঠানিক প্যাক
                        </div>

                        <div>
                            <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                {{ $module['pricing_tiers']['institutional']['badge'] ?? 'জনপ্রিয় প্রাতিষ্ঠানিক চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['institutional']['name'] ?? 'স্মার্ট প্রাতিষ্ঠানিক প্যাক (Smart Institutional)' }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['institutional']['amount'] ?? '৳৩,৫০০' }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['institutional']['period'] ?? '/ মাস' }}</span>
                            </div>

                            <p class="text-xs text-emerald-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['institutional']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['institutional']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                           class="mt-8 w-full py-3.5 px-6 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs text-center shadow-lg shadow-blue-600/30 transition-all">
                            স্মার্ট প্যাক নির্বাচন করুন →
                        </a>
                    </div>
                </div>

                <p class="text-center text-xs text-gray-400 mt-6">
                    💡 <strong>স্বচ্ছ নোট:</strong> SMS পাঠানো সম্পূর্ণ আপনার ঐচ্ছিক। আপনি চাইলে ১০০% ফ্রিতে অ্যাপ ও ইমেইল নোটিফিকেশন ব্যবহার করতে পারেন।
                </p>
            </div>

            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. SMS কেনা কি বাধ্যতামূলক?</h3>
                        <p class="text-gray-300 leading-relaxed">না, আপনি চাইলে কোনো অতিরিক্ত খরচ ছাড়াই ১০০% ফ্রিতে ইমেইল ও অভিভাবক অ্যাপ নোটিফিকেশন ব্যবহার করতে পারেন।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. আমাদের প্রতিষ্ঠানের তথ্যের নিরাপত্তা কতটা সুরক্ষিত?</h3>
                        <p class="text-gray-300 leading-relaxed">Enterprise-grade 256-bit AES এনক্রিপশন এবং BDIX হাই-স্পিড সার্ভারে প্রতিদিনের অটোমেটিক ব্যাকআপের মাধ্যমে সম্পূর্ণ তথ্য সুরক্ষিত থাকে।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. কলেজ বা মাদ্রাসার জন্য কি এটি ব্যবহার করা যাবে?</h3>
                        <p class="text-gray-300 leading-relaxed">হ্যাঁ, পেজের ওপরের সুইচ থেকে এক ক্লিকেই কলেজ, মাদ্রাসা বা কোচিং সেন্টারের নির্দিষ্ট মোড সিলেক্ট করা যায়।</p>
                    </div>
                </div>
            </div>
        @elseif($module['id'] === 'law')
            <!-- 10x Legal Vault & VakilChamber Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-amber-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        ⚖️ {{ $module['badge'] }}
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        আইনজীবী চেম্বার ডিজিটাইজ করুন, সোশ্যাল গ্রাহক কানেক্ট পান ⚖️
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        সোশ্যাল ইকোসিস্টেমের কোটি কোটি বিচারপ্রার্থী গ্রাহকের কাছে পৌঁছান। হাইকোর্ট ও জেলা জজ কোর্টের অটো কজ লিস্ট রিমাইন্ডার, ২৫৬-বিট ক্লায়েন্ট ফাইল ভল্ট এবং বিকাশ ফি কালেকশন—সবকিছু এখন একটি পোর্টালে।
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#pricing"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-700 hover:from-amber-400 hover:to-amber-600 text-white font-bold text-base shadow-xl shadow-amber-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>🔍  যাচাইকৃত উকিল খুঁজুন (৳২০০)</span>
                            <span>→</span>
                        </a>

                        <a href="#sandbox"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            🎮 ১-ক্লিকে স্যান্ডবক্স ডেমো
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">
                        
                        <!-- Top Court Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-600/20 border border-amber-500/30 flex items-center justify-center text-xl text-amber-400">
                                    ⚖️
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">অ্যাডভোকেট সালাহউদ্দিন & অ্যাসোসিয়েটস</h3>
                                    <p class="text-[11px] text-emerald-400 font-semibold">● সুপ্রিম কোর্ট ও জেলা জজ কোর্ট</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                ভেরিফাইড
                            </span>
                        </div>

                        <!-- Live Case Entry Card Mockup -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">মামলা নং: <strong class="text-white">সিভিল রিভিশন-৪৮২/২০২৬</strong></span>
                                <span class="text-amber-400 font-bold">হাইকোর্ট বিভাগ</span>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                                <p class="text-[11px] text-gray-300">বাদী: <strong class="text-white">মো: সিরাজুল ইসলাম</strong> | বিবাদী: <strong class="text-white">সোনালী ব্যাংক লি:</strong></p>
                                <p class="text-[11px] text-emerald-400 font-semibold">পরবর্তী শুনানির তারিখ: আগামীকাল সকাল ১০:৩০</p>
                            </div>
                        </div>

                        <!-- Live Consultation Fee Badge -->
                        <div class="p-4 rounded-2xl bg-amber-950/40 border border-amber-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-600/20 border border-amber-500/40 flex items-center justify-center font-black text-amber-400 text-lg">
                                    bKash
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ ৳২০০ আইনি পরামর্শ ও মামলা ট্র্যাকিং পরিশোধিত</p>
                                    <p class="text-[10px] text-amber-300">TrxID: LAW99X3L120 (অটো ডিজিটাল রসিদ)</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- YouTube Marketing Video Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        ভিডিও টিউটোরিয়াল
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটে দেখুন কীভাবে Zengfy Law আপনার চেম্বার ও ক্লায়েন্ট ম্যানেজ করে
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-[#121A29] border border-white/10 overflow-hidden shadow-2xl p-2 sm:p-4">
                    <div class="relative aspect-video rounded-2xl overflow-hidden bg-black flex items-center justify-center">
                        <iframe class="w-full h-full" 
                                src="https://www.youtube-nocookie.com/embed/{{ $module['youtube_id'] ?? 'dQw4w9WgXcQ' }}?rel=0" 
                                title="Zengfy Law Suite Video Showcase" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Interactive Sandbox Simulator -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-amber-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 সাইনআপ ছাড়া এখনই ল চেম্বার প্যানেল স্যান্ডবক্সে টেস্ট করুন
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে ল প্যানেলের রিয়েল-টাইম ক্লিকেবল ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'cause'; sandboxMessage = '✓ সিভিল রিভিশন-৪৮২/২০২৬ মামলার আগামী শুনানির তারিখ ১৫ আগস্ট ২০২৬ কজ লিস্ট ক্যালেন্ডারে এন্ট্রি সম্পন্ন এবং ক্লায়েন্টকে অটো SMS প্রেরিত।'" 
                                :class="sandboxAction === 'cause' ? 'bg-amber-600 border-amber-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📅</span>
                            <h3 class="text-sm font-bold">১. কজ লিস্ট শুনানির তারিখ সেট করুন</h3>
                            <p class="text-xs text-gray-400 mt-1">১-ক্লিকে কজ লিস্ট ক্যালেন্ডারে কেস যোগ ও অটো SMS নোটিফিকেশন।</p>
                        </button>

                        <button @click="sandboxAction = 'vault'; sandboxMessage = '✓ এফিডেভিট ও পাওয়ার অব অ্যাটর্নি ফাইল (২৫৬-বিট এনক্রিপ্টেড) ক্লাউড ভল্টে নিরাপদে সংরক্ষিত হয়েছে।'" 
                                :class="sandboxAction === 'vault' ? 'bg-amber-600 border-amber-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🔐</span>
                            <h3 class="text-sm font-bold">২. ২৫৬-বিট ফাইল ভল্ট আপলোড</h3>
                            <p class="text-xs text-gray-400 mt-1">নথিপত্র চুরির ভয় ছাড়া এনক্রিপ্টেড ডিজিটাল সিকিউরিটি মকআপ।</p>
                        </button>

                        <button @click="sandboxAction = 'receipt'; sandboxMessage = '✓ ক্লায়েন্ট মো: সিরাজুল ইসলাম-এর ৳২০০ আইনি পরামর্শ ফি বিকাশ কালেকশন ভেরিফাইড ও ডিজিটাল রসিদ ইস্যু সম্পন্ন।'" 
                                :class="sandboxAction === 'receipt' ? 'bg-amber-600 border-amber-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📜</span>
                            <h3 class="text-sm font-bold">৩. ক্লায়েন্ট ফি বিকাশ রসিদ মেলান</h3>
                            <p class="text-xs text-gray-400 mt-1">রিয়েল-টাইম অ্যাডভোকেট ফি কালেকশন ও ডিজিটাল রসিদ।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-amber-950/40 border border-amber-500/40 text-amber-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Transparent Pricing Tier Section -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ বিচারপ্রার্থী ও অ্যাডভোকেট চেম্বার উভয়ের জন্য সাশ্রয়ী প্ল্যান
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- Client Connect Pack (৳200/connect) -->
                    <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-amber-500/50 backdrop-blur-xl transition-all flex flex-col justify-between">
                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-amber-500/10 text-amber-400 text-xs font-bold border border-amber-500/20">
                                {{ $module['pricing_tiers']['client']['badge'] ?? 'বিচারপ্রার্থী / ক্লায়েন্ট চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['client']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['client']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['client']['period'] }}</span>
                            </div>

                            <p class="text-xs text-amber-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['client']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['client']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-3.5 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs text-center border border-white/10 transition-all">
                            যাচাইকৃত উকিল খুঁজুন →
                        </a>
                    </div>

                    <!-- Advocate Chamber Pack (৳500/mo) -->
                    <div class="p-8 rounded-3xl bg-gradient-to-b from-[#241a10] to-[#121A29] border border-amber-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-amber-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            জনপ্রিয় চেম্বার প্যাক
                        </div>

                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                {{ $module['pricing_tiers']['chamber']['badge'] ?? 'জনপ্রিয় চেম্বার চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['chamber']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['chamber']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['chamber']['period'] }}</span>
                            </div>

                            <p class="text-xs text-amber-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['chamber']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['chamber']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-4 px-6 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-bold text-sm text-center shadow-lg shadow-amber-600/30 transition-all">
                            চেম্বার প্যাক চালু করুন →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Advocate Chamber Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        চেম্বারের কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        ⚖️ অ্যাডভোকেট ও আইনজীবীদের হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-amber-600/20 border border-amber-500/30 flex items-center justify-center text-2xl mb-4 text-amber-400">
                            📅
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">অটো কজ লিস্ট & তারিখ রিমাইন্ডার</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            হাইকোর্ট ও জজ কোর্টের মামলার তারিখ মেলাতে আর কাগজ খুঁজতে হবে না। শুনানির আগে অটো SMS নোটিফিকেশন।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-2xl mb-4 text-emerald-400">
                            🔐
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">২৫৬-বিট এনক্রিপ্টেড ফাইল ভল্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            গোপনীয় নথিপত্র, চুক্তিপত্র ও এফিডেভিট চুরির ভয় ছাড়া ক্লাউড ভল্টে নিরাপদে সংরক্ষিত থাকবে।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-indigo-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-2xl mb-4 text-indigo-400">
                            📱
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">স্মার্ট ভেরিফাইড ক্লায়েন্ট পোর্টাল</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            ক্লায়েন্ট ফোন না দিয়ে মামলায় নিজের বাদী/বিবাদী তথ্য, শুনানি তারিখ ও ডিজিটাল ফি রসিদ নিজেই দেখতে পাবে।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-pink-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-pink-600/20 border border-pink-500/30 flex items-center justify-center text-2xl mb-4 text-pink-400">
                            💳
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">বিকাশ/নগদ অটো-ফি কালেকশন</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            অনলাইনে ক্লায়েন্ট ফি জমা দিলে রিয়েল-টাইম সিন্দুক ব্যালেন্স আপডেট এবং স্বয়ংক্রিয় ডিজিটাল রসিদ জেনারেট।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Savings & ROI Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        সময় ও কল সাশ্রয়ের হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন Zengfy Law ব্যবহার করলে আপনার মাসে কত সময় ও কল সাশ্রয় হবে
                    </h2>

                    <!-- Case Count Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার চেম্বারে চলমান মামলা কতটি? <strong class="text-amber-400 text-lg" x-text="studentCount"></strong> টি
                        </label>
                        <input type="range" min="10" max="1000" step="10" x-model="studentCount" 
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-amber-500">
                    </div>

                    <!-- Calculated Savings Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">⏱️ কজ লিস্ট মেলাতে সময় সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1" x-text="(studentCount * 0.15).toFixed(0) + ' ঘণ্টা/মাস'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">📞 ক্লায়েন্টের অতিরিক্ত ফোন কল হ্রাস</p>
                            <p class="text-xl sm:text-2xl font-black text-amber-400 mt-1">৮০% কল কমবে</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ Zengfy চেম্বার খরচ</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">৳৫০০/মাস</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস প্রফেশনাল অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-amber-500/40 flex flex-col items-center text-center transition-all group shadow-lg shadow-amber-500/10">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-amber-400 mt-1">VakilChamber & Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Tenant System</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://ecommerce.zengfy.test:7000' : 'https://ecommerce.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛍️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Shop</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Online Store Engine</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://journal.zengfy.test:7000' : 'https://journal.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-slate-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">📰</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Journal</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Publishing Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://skill.zengfy.test:7000' : 'https://skill.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-violet-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎓</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Skill</h3>
                        <p class="text-[10px] text-gray-400 mt-1">LMS Platform</p>
                    </a>
                </div>
            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. বিচারপ্রার্থীরা কীভাবে আইনজীবী খুঁজে পাবেন?</h3>
                        <p class="text-gray-300 leading-relaxed">Zengfy Social ও Law ডিরেক্টরি থেকে বিচারপ্রার্থীরা সরাসরি যাচাইকৃত প্রফেশনাল আইনজীবী নির্বাচন করে ৳২০০ পেমেন্ট করে আইনি পরামর্শ ও মামলা ডায়রি লিংক দেখতে পারেন।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. চেম্বারের গোপন নথিপত্র কতটা সুরক্ষিত?</h3>
                        <p class="text-gray-300 leading-relaxed">Enterprise-grade 256-bit AES এনক্রিপশনে আপনার ফাইলের সমস্ত সিকিউরিটি সংরক্ষিত থাকে যা তৃতীয় কারও দেখার সুযোগ নেই।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. জুনিয়র ও সহকারীদের আলাদা রোল দেওয়া যাবে?</h3>
                        <p class="text-gray-300 leading-relaxed">হ্যাঁ, অ্যাডভোকেট চেম্বার প্রধান ইচ্ছেমত জুনিয়র আইনজীবীদের কজ লিস্ট এন্ট্রি ও নির্দিষ্ট কেস ফাইলের এক্সেস রোল পারমিশন দিতে পারেন।</p>
                    </div>
                </div>
            </div>
        @elseif($module['id'] === 'pos')
            <!-- 10x Retail POS & ShopWindow Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-cyan-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                        🛒 {{ $module['badge'] }}
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        আপনার দোকানের কেনাবেচা ডিজিটাইজ করুন, সোশ্যাল ইকোসিস্টেমে বিক্রি বাড়ান 🛒
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        ২ সেকেন্ডে বারকোড বিলিং, অটোমেটিক কাস্টমার বাকি খাতা (ডিজিটাল ডিউ লেজার), দৈনিক লাভ-ক্ষতির হিসাব এবং সোশ্যাল ইকোসিস্টেমের কোটি কোটি ক্রেতার কাছে আপনার দোকানের পণ্য সরাসরি পৌঁছানোর অল-ইন-ওয়ান মেমো সমাধান।
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#pricing"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-base shadow-xl shadow-cyan-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>🏬 মার্চেন্ট ডেমো চালু করুন (৳৮,০০০/বছর)</span>
                            <span>→</span>
                        </a>

                        <a href="#sandbox"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            🎮 ১-ক্লিকে স্যান্ডবক্স পজ
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">
                        
                        <!-- Top Store Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-cyan-600/20 border border-cyan-500/30 flex items-center justify-center text-xl text-cyan-400">
                                    🛒
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">বিসমিল্লাহ জেনারেল স্টোর & সুপারশপ</h3>
                                    <p class="text-[11px] text-emerald-400 font-semibold">● ক্যাশ কাউন্টার পজ ও সোশ্যাল শপ লাইভ</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-400 text-xs font-bold border border-cyan-500/20">
                                পজ টার্মিনাল #১
                            </span>
                        </div>

                        <!-- Live Counter Checkout Memo Mockup -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">মেমো নং: <strong class="text-white">#১০৯২</strong></span>
                                <span class="text-cyan-400 font-bold">৩টি আইটেম (মেমো স্ক্যানড)</span>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                                <div class="flex justify-between text-[11px] text-gray-300">
                                    <span>১x সয়াবিন তেল ৫ লিটার</span>
                                    <span class="font-bold text-white">৳৮৫০</span>
                                </div>
                                <div class="flex justify-between text-[11px] text-gray-300">
                                    <span>২x মিনিকেট চাল ৫০ কেজি</span>
                                    <span class="font-bold text-white">৳৬০০</span>
                                </div>
                                <div class="border-t border-white/10 pt-1 flex justify-between text-xs font-bold text-emerald-400">
                                    <span>সর্বমোট পরিশোধিত (ক্যাশ/বিকাশ):</span>
                                    <span>৳১,৪৫০</span>
                                </div>
                            </div>
                        </div>

                        <!-- Live Due Alert Badge -->
                        <div class="p-4 rounded-2xl bg-cyan-950/40 border border-cyan-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-cyan-600/20 border border-cyan-500/40 flex items-center justify-center font-black text-cyan-400 text-lg">
                                    📖
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ মো: রহিম (বাকি: ৳৭৫০)</p>
                                    <p class="text-[10px] text-cyan-300">১-ক্লিকে বিকাশ/নগদ বাকি তাগাদা SMS প্রেরিত</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Video Showcase Section (Upcoming Banner) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-3.5 py-1 rounded-full">
                        ⏳ অফিশিয়াল ভিডিও টিউটোরিয়াল (Upcoming)
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটের অফিশিয়াল ভিডিও টিউটোরিয়াল খুব শীঘ্রই আসছে
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-cyan-500/30 overflow-hidden shadow-2xl p-8 sm:p-14 text-center relative group">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-cyan-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <div class="w-20 h-20 mx-auto rounded-full bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-4xl shadow-xl shadow-cyan-500/10 animate-pulse">
                            🎬
                        </div>

                        <span class="inline-block px-4 py-1.5 rounded-full bg-cyan-500/20 text-cyan-300 font-extrabold text-xs tracking-wider border border-cyan-400/30 uppercase">
                            Video Tutorial Upcoming
                        </span>

                        <h3 class="text-xl sm:text-2xl font-black text-white">
                            Zengfy POS-এর রিয়েল-টাইম টিউটোরিয়াল তৈরি হচ্ছে!
                        </h3>

                        <p class="text-xs sm:text-sm text-gray-300 max-w-lg mx-auto leading-relaxed">
                            আমাদের প্রোডাক্ট ও মিডিয়া টিম রিয়েল-টাইম বারকোড বিলিং, কাস্টমার বাকি খাতা ও সোশ্যাল শপ উইন্ডোর হাই-কোয়ালিটি টিউটোরিয়াল ভিডিও শুট করছে।
                        </p>

                        <div class="pt-2">
                            <a href="#sandbox" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-cyan-600/30 hover:bg-cyan-600/50 border border-cyan-500/40 text-xs font-bold text-cyan-200 transition-all">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>স্যান্ডবক্সে পজ ড্রাই-রান টেস্ট করতে নিচে ক্লিক করুন →</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Sandbox Simulator -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-cyan-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 সাইনআপ ছাড়া এখনই দোকানের পজ প্যানেল স্যান্ডবক্সে টেস্ট করুন
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে পজ প্যানেলের রিয়েল-টাইম ক্লিকেবল ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'memo'; sandboxMessage = '✓ বিল #১০৯২ তৈরি সম্পন্ন: ৩টি পণ্য (সয়াবিন তেল & চাল), মোট ৳১,৪৫০ নগদ জমা এবং ৫৮ মিমি থার্মাল রসিদ মেমো স্ক্যানড।'" 
                                :class="sandboxAction === 'memo' ? 'bg-cyan-600 border-cyan-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🛒</span>
                            <h3 class="text-sm font-bold">১. ২ সেকেন্ডে বারকোড মেমো কাটুন</h3>
                            <p class="text-xs text-gray-400 mt-1">১-ক্লিকে কাস্টমার বিলিং, অটো ডিসকাউন্ট ও মেমো প্রিন্ট।</p>
                        </button>

                        <button @click="sandboxAction = 'due'; sandboxMessage = '✓ কাস্টমার মো: রহিম (ডিজিটাল বাকি লেজার: ৳৭৫০) এর মোবাইলে বিকাশ/নগদ অটো তাগাদা SMS সফলভাবে প্রেরিত।'" 
                                :class="sandboxAction === 'due' ? 'bg-cyan-600 border-cyan-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📖</span>
                            <h3 class="text-sm font-bold">২. কাস্টমার বাকি খাতায় এন্ট্রি দিন</h3>
                            <p class="text-xs text-gray-400 mt-1">খাতা হারানোর ভয় ছাড়া বাকির টাকা আদায়ের অটো SMS।</p>
                        </button>

                        <button @click="sandboxAction = 'profit'; sandboxMessage = '✓ আজকের ক্যাশ কালেকশন: ৳৪২,৫০০, মোট বিক্রি: ৪৭টি আইটেম এবং আজকের নিট লাভ: ৳৬,৩৫০ হিসাব জেনারেটেড।'" 
                                :class="sandboxAction === 'profit' ? 'bg-cyan-600 border-cyan-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📊</span>
                            <h3 class="text-sm font-bold">৩. দৈনিক প্রফিট & লস রিপোর্ট দেখুন</h3>
                            <p class="text-xs text-gray-400 mt-1">রিয়েল-টাইম নিট লাভ, বিক্রির সংখ্যা ও ক্যাশ ব্যালেন্স।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-cyan-950/40 border border-cyan-500/40 text-cyan-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Transparent Pricing Tier Section -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ কোনো গোপন ফি নেই — সব দোকানিদের জন্য স্পষ্ট সাশ্রয়ী সাবস্ক্রিপশন
                    </h2>
                </div>

                <div class="max-w-xl mx-auto">
                    <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-b from-[#102433] to-[#121A29] border border-cyan-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden text-center">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-cyan-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            জনপ্রিয় মার্চেন্ট প্যাক
                        </div>

                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-cyan-500/10 text-cyan-400 text-xs font-bold border border-cyan-500/20">
                                {{ $module['pricing_tiers']['retail']['badge'] ?? 'জনপ্রিয় মার্চেন্ট চয়েস' }}
                            </span>
                            <h3 class="text-2xl font-black text-white mt-3">{{ $module['pricing_tiers']['retail']['name'] }}</h3>
                            
                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['retail']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['retail']['period'] }}</span>
                            </div>

                            <p class="text-xs text-cyan-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['retail']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300 text-left max-w-md mx-auto">
                                @foreach($module['pricing_tiers']['retail']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-4 px-6 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white font-bold text-sm text-center shadow-lg shadow-cyan-600/30 transition-all">
                            মার্চেন্ট পজ চালু করুন →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Merchant Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-3.5 py-1 rounded-full">
                        দোকানের কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        👑 রিটেইল মার্চেন্ট ও দোকানদারের হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-cyan-600/20 border border-cyan-500/30 flex items-center justify-center text-2xl mb-4 text-cyan-400">
                            🛒
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">সুপারফাস্ট বারকোড ক্যাশ কাউন্টার</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            ২ সেকেন্ডে মেমো ও ভুলমুক্ত বিলিং। ফোন বা বারকোড স্ক্যানার দিয়ে ড্রয়ার নিয়ন্ত্রণ।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-2xl mb-4 text-emerald-400">
                            📖
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">ডিজিটাল কাস্টমার বাকি খাতা</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            খাতা হারানোর ভয় ছাড়া কাস্টমারের ডিজিটাল ডিউ লেজার এবং ১-ক্লিকে বিকাশ তাগাদা SMS।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-indigo-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-2xl mb-4 text-indigo-400">
                            📦
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">অটো স্টক লো-অ্যালার্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            পণ্য ফুরিয়ে গিয়ে খদ্দের ফেরত যাওয়ার আগেই সিস্টেমের স্বয়ংক্রিয় স্টক নোটিফিকেশন।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-pink-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-pink-600/20 border border-pink-500/30 flex items-center justify-center text-2xl mb-4 text-pink-400">
                            🌐
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">সোশ্যাল শপ উইন্ডো কানেক্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            দোকানে POS চালুর সাথে সাথে সোশ্যাল কোটি ক্রেতার নিকটস্থ ক্যাটালগে পণ্য ভিজিবল।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Savings & ROI Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        সময় ও টাকা বাঁচানোর লাইভ হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন Zengfy POS ব্যবহার করলে আপনার দোকানে মাসে কত সময় ও টাকা বাঁচবে
                    </h2>

                    <!-- Daily Sales Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার দোকানে দৈনিক বিক্রি কত টাকা? <strong class="text-cyan-400 text-lg" x-text="'৳' + (studentCount * 50).toLocaleString()"></strong>
                        </label>
                        <input type="range" min="100" max="2000" step="50" x-model="studentCount" 
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-cyan-500">
                    </div>

                    <!-- Calculated Savings Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">⏱️ মেমো কাটতে সময় সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1" x-text="(studentCount * 0.05).toFixed(0) + ' ঘণ্টা/মাস'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">💵 বাকির টাকা দ্রুত আদায় বৃদ্ধি</p>
                            <p class="text-xl sm:text-2xl font-black text-cyan-400 mt-1">৯০% দ্রুত আদায়</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ Zengfy POS খরচ</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">মাত্র ৳২২/দিন</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-cyan-400 bg-cyan-500/10 border border-cyan-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস প্রফেশনাল অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-cyan-500/40 flex flex-col items-center text-center transition-all group shadow-lg shadow-cyan-500/10">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-cyan-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-gray-400 mt-1">VakilChamber & Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Tenant System</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://ecommerce.zengfy.test:7000' : 'https://ecommerce.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛍️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Shop</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Online Store Engine</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://journal.zengfy.test:7000' : 'https://journal.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-slate-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">📰</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Journal</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Publishing Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://skill.zengfy.test:7000' : 'https://skill.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-violet-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎓</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Skill</h3>
                        <p class="text-[10px] text-gray-400 mt-1">LMS Platform</p>
                    </a>
                </div>
            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. দামি বারকোড মেসিন বা কম্পিউটার কেনা কি বাধ্যতামূলক?</h3>
                        <p class="text-gray-300 leading-relaxed">না, আপনি চাইলে যেকোনো অ্যান্ড্রয়েড স্মার্টফোন বা ট্যাবলেটের ক্যামেরা দিয়ে মেমো স্ক্যান করতে পারেন এবং থার্মাল মেমো প্রিন্ট করতে পারেন।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. সোশ্যাল ক্রেতারা কীভাবে আমার দোকানের মালামাল দেখবে?</h3>
                        <p class="text-gray-300 leading-relaxed">Zengfy POS-এ পণ্য এন্ট্রি করলেই ১-ক্লিকে দোকানটি Zengfy Social-এর কোটি কোটি ক্রেতার এলাকার ক্যাটেগরিতে লাইভ হয়ে যাবে।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. কাস্টমার বাকি খাতা কতটা সুরক্ষিত?</h3>
                        <p class="text-gray-300 leading-relaxed">কাগজের খাতা হারিয়ে যাওয়ার ভয় নেই, ক্লাউডে এনক্রিপ্টেড ব্যাকআপ থাকবে এবং ১-ক্লিকে বিকাশ/নগদে বাকি তাগাদা SMS পাঠানো যাবে।</p>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        @elseif($module['id'] === 'journal')
            <!-- 10x Independent Journalism & Columnist Publishing Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-indigo-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                        📰 {{ $module['badge'] }}
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        স্বাধীন সাংবাদিকতা ও ভেরিফাইড কলাম পড়ুন, প্রিয় লেখককে সাপোর্ট করুন 📰
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        পাঠকদের জন্য মাত্র ৳৫০ টাকায় প্রিমিয়াম কলাম ও রিডার পাস এবং সাংবাদিক ও লেখকদের জন্য ৳২০০ টাকায় অল-ইন-ওয়ান পাবলিশিং ইআরপি প্ল্যাটফর্ম।
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#pricing"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-400 hover:to-blue-500 text-white font-bold text-base shadow-xl shadow-indigo-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>📰 প্রিমিয়াম কলাম পড়ুন (৳৫০/মাস)</span>
                            <span>→</span>
                        </a>

                        <a href="#sandbox"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            🎮 ১-ক্লিকে স্যান্ডবক্স ডেমো
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">
                        
                        <!-- Top Journalist Profile Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-xl text-indigo-400">
                                    ✍️
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white flex items-center gap-1">
                                        <span>আরিফুল ইসলাম</span>
                                        <span class="text-xs text-blue-400">✓ NID ভেরিফাইড সাংবাদিক</span>
                                    </h3>
                                    <p class="text-[11px] text-gray-400 font-semibold">কলামিস্ট & ইনভেস্টিগেটিভ রিপোর্টার</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold border border-indigo-500/20">
                                প্রিমিয়াম নিবন্ধ
                            </span>
                        </div>

                        <!-- Live Published Column Snippet Mockup -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">শিরোনাম: <strong class="text-white">"বাংলাদেশের ইকোসিস্টেম বিপ্লব"</strong></span>
                                <span class="text-indigo-400 font-bold">১০ মিনিট রিড</span>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                                <p class="text-[11px] text-gray-300">"একটি ভেরিফাইড ডিজিটাল আইডি যেভাবে দেশের কোটি মানুষের কাজ সহজ করছে..."</p>
                            </div>
                        </div>

                        <!-- Live Reader Tip Jar & Subscription Payout Badge -->
                        <div class="p-4 rounded-2xl bg-indigo-950/40 border border-indigo-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-600/20 border border-indigo-500/40 flex items-center justify-center font-black text-indigo-400 text-lg">
                                    💸
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ মাসিক রিডার পেআউট লেজার</p>
                                    <p class="text-[10px] text-indigo-300">১৫০ জন সাবস্ক্রাইবার (৳৭,৫০০ জমা)</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Video Showcase Section (Upcoming Banner) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3.5 py-1 rounded-full">
                        ⏳ অফিশিয়াল ভিডিও টিউটোরিয়াল (Upcoming)
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটের অফিশিয়াল ভিডিও টিউটোরিয়াল খুব শীঘ্রই আসছে
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-indigo-500/30 overflow-hidden shadow-2xl p-8 sm:p-14 text-center relative group">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-indigo-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <div class="w-20 h-20 mx-auto rounded-full bg-indigo-500/10 border border-indigo-500/30 flex items-center justify-center text-4xl shadow-xl shadow-indigo-500/10 animate-pulse">
                            🎬
                        </div>

                        <span class="inline-block px-4 py-1.5 rounded-full bg-indigo-500/20 text-indigo-300 font-extrabold text-xs tracking-wider border border-indigo-400/30 uppercase">
                            Video Tutorial Upcoming
                        </span>

                        <h3 class="text-xl sm:text-2xl font-black text-white">
                            Zengfy Journal-এর প্রিমিয়াম কলাম ও সাংবাদিক ইআরপি টিউটোরিয়াল তৈরি হচ্ছে!
                        </h3>

                        <p class="text-xs sm:text-sm text-gray-300 max-w-lg mx-auto leading-relaxed">
                            আমাদের প্রোডাক্ট টিম ভেরিফাইড সাংবাদিক প্রোফাইল, প্রিমিয়াম কলাম পাবলিশিং এবং রিডার সাবক্রিপশন পেআউটের হাই-কোয়ালিটি টিউটোরিয়াল ভিডিও শুট করছে।
                        </p>

                        <div class="pt-2">
                            <a href="#sandbox" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600/30 hover:bg-indigo-600/50 border border-indigo-500/40 text-xs font-bold text-indigo-200 transition-all">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>স্যান্ডবক্সে জার্নাল প্যানেল ড্রাই-রান টেস্ট করতে নিচে ক্লিক করুন →</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Sandbox Simulator -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-indigo-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 সাইনআপ ছাড়া এখনই জার্নাল & রিডার প্যানেল স্যান্ডবক্সে টেস্ট করুন
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে জার্নাল প্যানেলের রিয়েল-টাইম ক্লিclickable ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'reader'; sandboxMessage = '✓ ৳৫০ রিডার সাবস্ক্রিপশন পাস অ্যাক্টিভেটেড: প্রিমিয়াম ইনভেস্টিগেটিভ কলাম ও নিবন্ধ আনলকড।'" 
                                :class="sandboxAction === 'reader' ? 'bg-indigo-600 border-indigo-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📰</span>
                            <h3 class="text-sm font-bold">১. ৳৫০ রিডার সাবস্ক্রিপশন পাস</h3>
                            <p class="text-xs text-gray-400 mt-1">বিজ্ঞাপনমুক্ত প্রিমিয়াম কলাম ও ব্লগ এক্সেস।</p>
                        </button>

                        <button @click="sandboxAction = 'verify'; sandboxMessage = '✓ NID সাংবাদিক ভেরিফিকেশন ড্রাই-রান সম্পন্ন: নীল ভেরিফাইড জুরনালিস্ট ব্যাজ প্রকাশিত।'" 
                                :class="sandboxAction === 'verify' ? 'bg-indigo-600 border-indigo-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🛡️</span>
                            <h3 class="text-sm font-bold">২. NID ভেরিফাইড সাংবাদিক প্রোফাইল</h3>
                            <p class="text-xs text-gray-400 mt-1">ভুয়া সংবাদ মুক্ত প্রফেশনাল ট্রাস্ট ব্যাজ।</p>
                        </button>

                        <button @click="sandboxAction = 'writer_erp'; sandboxMessage = '✓ ৳২০০ সাংবাদিক পাবলিশিং ইআরপি অ্যাক্টিভ: ১৫০ জন রিডার সাবস্ক্রিপশন থেকে ৳৭,৫০০ পেআউট ওয়ালেটে জমা।'" 
                                :class="sandboxAction === 'writer_erp' ? 'bg-indigo-600 border-indigo-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">✍️</span>
                            <h3 class="text-sm font-bold">৩. ৳২০০ সাংবাদিক পাবলিশিং ইআরপি</h3>
                            <p class="text-xs text-gray-400 mt-1">কলাম ড্রাফট, নিউজলেটার ও রিডার পেআউট।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-indigo-950/40 border border-indigo-500/40 text-indigo-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Transparent Pricing Tier Section -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ পাঠকদের জন্য ৳৫০/মাস — সাংবাদিকদের জন্য ৳২০০/মাস অল-ইন-ওয়ান ইআরপি
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- Reader Subscription Pass (৳50/mo) -->
                    <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-indigo-500/50 backdrop-blur-xl transition-all flex flex-col justify-between">
                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold border border-indigo-500/20">
                                {{ $module['pricing_tiers']['reader']['badge'] ?? 'পাঠক চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['reader']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['reader']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['reader']['period'] }}</span>
                            </div>

                            <p class="text-xs text-indigo-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['reader']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['reader']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-3.5 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs text-center border border-white/10 transition-all">
                            রিডার পাস নিন →
                        </a>
                    </div>

                    <!-- Journalist ERP Pack (৳200/mo) -->
                    <div class="p-8 rounded-3xl bg-gradient-to-b from-[#101433] to-[#121A29] border border-indigo-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            সাংবাদিক প্যাক
                        </div>

                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                {{ $module['pricing_tiers']['writer']['badge'] ?? 'সাংবাদিক চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['writer']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['writer']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['writer']['period'] }}</span>
                            </div>

                            <p class="text-xs text-indigo-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['writer']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['writer']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-4 px-6 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm text-center shadow-lg shadow-indigo-600/30 transition-all">
                            সাংবাদিক ইআরপি চালু করুন →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Journal & Media Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3.5 py-1 rounded-full">
                        জার্নাল ও মিডিয়া কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        📰 পাঠক ও সাংবাদিকদের হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-indigo-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-2xl mb-4 text-indigo-400">
                            🛡️
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">ভেরিফাইড সাংবাদিক আইডি</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            ভুয়া সংবাদ প্রতিরোধে NID এনক্রিপ্টেড সত্যতা ব্যাজ ও প্রফেশনাল বায়ো।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-2xl mb-4 text-blue-400">
                            💸
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">পাঠক সাবস্ক্রিপশন & টিপস</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            পাঠকদের থেকে সরাসরি মাসিক সাবস্ক্রিপশন ফি ও টিপস সংগ্রহের ব্যবস্থা।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-purple-600/20 border border-purple-500/30 flex items-center justify-center text-2xl mb-4 text-purple-400">
                            ✍️
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">কলাম পাবলিশিং ইআরপি</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            সমৃদ্ধ আর্টিকেল ড্রাফট এডিটর, কপিরাইট নিরাপত্তা ও পাঠক এনালিটিক্স।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-pink-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-pink-600/20 border border-pink-500/30 flex items-center justify-center text-2xl mb-4 text-pink-400">
                            📰
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">বিজ্ঞাপন মুক্ত রিডার মোড</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            পাঠকদের জন্য কোনো বিরক্তিকর বিজ্ঞাপন ছাড়াই পরিচ্ছন্ন পড়ার অভিজ্ঞতা।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Writer Revenue & Audience Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3.5 py-1 rounded-full">
                        লেখক আয় & পাঠক সংখ্যা হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন স্বাধীন সাংবাদিকদের কলাম থেকে আনুমানিক মাসিক আয়
                    </h2>

                    <!-- Reader Count Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার পেয়িং পাঠক সংখ্যা: <strong class="text-indigo-400 text-lg" x-text="studentCount * 10 + ' জন সাবস্ক্রাইবার'"></strong>
                        </label>
                        <input type="range" min="10" max="100" step="5" x-model="studentCount" 
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-indigo-500">
                    </div>

                    <!-- Calculated Writer Revenue Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">📈 আনুমানিক মাসিক আয় (৮৫% পেআউট)</p>
                            <p class="text-xl sm:text-2xl font-black text-indigo-400 mt-1" x-text="'৳' + (studentCount * 10 * 50 * 0.85).toLocaleString() + '/মাস'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🛡️ কপিরাইট নিরাপত্তা</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1">১০০% ভেরিফাইড</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ সাংবাদিক ইআরপি ফি</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">মাত্র ৳২০০ / মাস</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস প্রফেশনাল অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://journal.zengfy.test:7000' : 'https://journal.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-indigo-500/40 flex flex-col items-center text-center transition-all group shadow-lg shadow-indigo-500/10">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">📰</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Journal</h3>
                        <p class="text-[10px] text-indigo-400 mt-1">Journalism & Reader ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-gray-400 mt-1">VakilChamber & Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Tenant System</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://hotel.zengfy.test:7000' : 'https://hotel.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏨</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Hotel</h3>
                        <p class="text-[10px] text-gray-400 mt-1">ERP & ZengPay</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://skill.zengfy.test:7000' : 'https://skill.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-violet-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎓</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Skill</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Bootcamps & LMS</p>
                    </a>
                </div>
            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. সাধারণ পাঠকরা কত টাকায় প্রিমিয়াম কলাম পড়তে পারবে?</h3>
                        <p class="text-gray-300 leading-relaxed">পাঠকরা মাত্র ৳৫০/মাস সাবস্ক্রিপশন ফিতে সব ভেরিফাইড কলামিস্টদের এক্সক্লুসিভ নিবন্ধ ও ইনভেস্টিগেটিভ রিপোর্ট পড়তে পারবে।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. সাংবাদিক ও কলামিস্টরা কীভাবে আয়ের অংশ পাবেন?</h3>
                        <p class="text-gray-300 leading-relaxed">সাংবাদিকদের কলাম যতজন সাবস্ক্রাইবার পড়বে এবং যা টিপস দেবে, তার সিংহভাগ সরাসরি তাদের ওয়ালেটে পেআউট করা হবে।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. ভুয়া কলাম বা ভুয়া আইডি কিভাবে রোখা হয়?</h3>
                        <p class="text-gray-300 leading-relaxed">প্রতিটি সাংবাদিক ও কলামিস্টের NID ও সত্যতা ভেরিফিকেশনের পর নীল ভেরিফাইড জুরনালিস্ট ব্যাজ দেওয়া হয়।</p>
                    </div>
                </div>
            </div>
        @elseif($module['id'] === 'skill')
            <!-- 10x Real-World Skill Bootcamps & Instructor LMS ERP Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-violet-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-violet-400 bg-violet-500/10 border border-violet-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-violet-400 animate-pulse"></span>
                        🎓 {{ $module['badge'] }}
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        ভুয়া কোর্স নয়, স্বল্প খরচে বাস্তবমুখী প্রজেক্ট শিখুন, ক্যারিয়ার গড়ুন 🎓
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        এসএসসি/এইচএসসি পরবর্তী শিক্ষার্থীদের জন্য Spoken English, Practical Computer & IT এবং Real-World Web Projects শিক্ষা মাত্র ৳১২০০ থেকে শুরু। সাথে মেন্টর ও একাডেমির জন্য অল-ইন-ওয়ান LMS ERP পোর্টাল।
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#pricing"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-violet-500 to-purple-600 hover:from-violet-400 hover:to-purple-500 text-white font-bold text-base shadow-xl shadow-violet-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>🎓 বাস্তবমুখী স্কিল কোর্স দেখুন (৳১২০০ থেকে শুরু)</span>
                            <span>→</span>
                        </a>

                        <a href="#sandbox"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            🎮 ১-ক্লিকে স্যান্ডবক্স ডেমো
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">
                        
                        <!-- Top Bootcamp Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-violet-600/20 border border-violet-500/30 flex items-center justify-center text-xl text-violet-400">
                                    🎓
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">এসএসসি স্পেশাল স্পোকেন & আইটি বুটক্যাম্প</h3>
                                    <p class="text-[11px] text-emerald-400 font-semibold">● বাস্তবমুখী প্রজেক্ট & মেন্টরশিপ</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-violet-500/10 text-violet-400 text-xs font-bold border border-violet-500/20">
                                লাইভ ব্যাচ
                            </span>
                        </div>

                        <!-- Live Project Assignment Mockup -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">প্রজেক্ট প্রোগ্রেস: <strong class="text-white">৮৫% প্র্যাকটিক্যাল সম্পন্ন</strong></span>
                                <span class="text-violet-400 font-bold">ফিডব্যাক: গ্রেড A+</span>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                                <p class="text-[11px] text-gray-300">💬 মেন্টর কমেন্ট: <strong class="text-violet-300">"আপনার স্পোকেন অডিও প্রেজেন্টেশন ও ইমেইল রাইটিং প্রজেক্ট চমৎকার হয়েছে!"</strong></p>
                            </div>
                        </div>

                        <!-- Live Skill Certificate Badge -->
                        <div class="p-4 rounded-2xl bg-violet-950/40 border border-violet-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-violet-600/20 border border-violet-500/40 flex items-center justify-center font-black text-violet-400 text-lg">
                                    📜
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ ভেরিফাইড প্রফেশনাল সার্টিফিকেট</p>
                                    <p class="text-[10px] text-violet-300">QR TrxID: SK88901X (NID এনক্রিপ্টেড রসিদ)</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Video Showcase Section (Upcoming Banner) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-violet-400 bg-violet-500/10 border border-violet-500/20 px-3.5 py-1 rounded-full">
                        ⏳ অফিশিয়াল ভিডিও টিউটোরিয়াল (Upcoming)
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটের অফিশিয়াল ভিডিও টিউটোরিয়াল খুব শীঘ্রই আসছে
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-violet-500/30 overflow-hidden shadow-2xl p-8 sm:p-14 text-center relative group">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-violet-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <div class="w-20 h-20 mx-auto rounded-full bg-violet-500/10 border border-violet-500/30 flex items-center justify-center text-4xl shadow-xl shadow-violet-500/10 animate-pulse">
                            🎬
                        </div>

                        <span class="inline-block px-4 py-1.5 rounded-full bg-violet-500/20 text-violet-300 font-extrabold text-xs tracking-wider border border-violet-400/30 uppercase">
                            Video Tutorial Upcoming
                        </span>

                        <h3 class="text-xl sm:text-2xl font-black text-white">
                            Zengfy Skill-এর বাস্তবমুখী প্রজেক্ট ও ইনস্ট্রাক্টর LMS ERP টিউটোরিয়াল তৈরি হচ্ছে!
                        </h3>

                        <p class="text-xs sm:text-sm text-gray-300 max-w-lg mx-auto leading-relaxed">
                            আমাদের প্রোডাক্ট টিম বাস্তবমুখী স্কিল প্রজেক্ট, লাইভ অ্যাসাইনমেন্ট সাবমিশন, মেন্টরশিপ সাপোর্ট এবং ইনস্ট্রাক্টর LMS ERP সেলস পেআউটের হাই-কোয়ালিটি টিউটোরিয়াল ভিডিও শুট করছে।
                        </p>

                        <div class="pt-2">
                            <a href="#sandbox" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-violet-600/30 hover:bg-violet-600/50 border border-violet-500/40 text-xs font-bold text-violet-200 transition-all">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>স্যান্ডবক্সে স্কিল প্যানেল ড্রাই-রান টেস্ট করতে নিচে ক্লিক করুন →</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Sandbox Simulator -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-violet-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-violet-400 bg-violet-500/10 border border-violet-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 সাইনআপ ছাড়া এখনই স্কিল & LMS প্যানেল স্যান্ডবক্সে টেস্ট করুন
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে লার্নিং প্যানেলের রিয়েল-টাইম ক্লিকেবল ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'bootcamp'; sandboxMessage = '✓ ৳১২০০ স্পোকেন ইংলিশ & কম্পিউটার আইটি বুটক্যাম্প কারিকুলাম সফলভাবে আনলকড: লাইভ ব্যাচ সিডিউল ও রিয়েল প্রজেক্ট ভল্ট এক্সেস সম্পন্ন।'" 
                                :class="sandboxAction === 'bootcamp' ? 'bg-violet-600 border-violet-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🎓</span>
                            <h3 class="text-sm font-bold">১. ৳১২০০ বুটক্যাম্প কারিকুলাম</h3>
                            <p class="text-xs text-gray-400 mt-1">Spoken English & IT বাস্তবমুখী প্রজেক্ট কোর্স আনলক।</p>
                        </button>

                        <button @click="sandboxAction = 'assignment'; sandboxMessage = '✓ স্টুডেন্ট প্র্যাকটিক্যাল অ্যাসাইনমেন্ট ফাইল সাবমিট করা হয়েছে: মেন্টর রিভিউ সম্পন্ন এবং ডিজিটাল ভেরিফাইড স্কিল সার্টিফিকেট জেনারেটেড।'" 
                                :class="sandboxAction === 'assignment' ? 'bg-violet-600 border-violet-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📝</span>
                            <h3 class="text-sm font-bold">২. প্র্যাকটিক্যাল অ্যাসাইনমেন্ট & মেন্টর ফিডব্যাক</h3>
                            <p class="text-xs text-gray-400 mt-1">সরাসরি মেন্টরদের কাছ থেকে কোশ্চেন-আনসার ও প্রজেক্ট রিভিউ।</p>
                        </button>

                        <button @click="sandboxAction = 'lms'; sandboxMessage = '✓ ইনস্ট্রাক্টর LMS ERP প্যানেল অ্যাক্টিভ: ২৫ জন স্টুডেন্ট এনরোলমেন্ট সেলস থেকে ৮৫% রেভিনিউ শেয়ার ওয়ালেটে পেআউট সম্পন্ন।'" 
                                :class="sandboxAction === 'lms' ? 'bg-violet-600 border-violet-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">👨‍🏫</span>
                            <h3 class="text-sm font-bold">৩. ইনস্ট্রাক্টর LMS ERP & সেলস পেআউট</h3>
                            <p class="text-xs text-gray-400 mt-1">লাইভ ব্যাচ ম্যানেজমেন্ট ও কোর্স শেয়ার উইথড্রয়াল।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-violet-950/40 border border-violet-500/40 text-violet-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Transparent Pricing Tier Section -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-violet-400 bg-violet-500/10 border border-violet-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ শিক্ষার্থীদের জন্য ৳১২০০ থেকে শুরু — ইনস্ট্রাক্টরদের জন্য সাশ্রয়ী LMS ERP
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- Student Real-World Bootcamp Pack (৳1200+) -->
                    <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-violet-500/50 backdrop-blur-xl transition-all flex flex-col justify-between">
                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-violet-500/10 text-violet-400 text-xs font-bold border border-violet-500/20">
                                {{ $module['pricing_tiers']['learner']['badge'] ?? 'শিক্ষার্থী চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['learner']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['learner']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['learner']['period'] }}</span>
                            </div>

                            <p class="text-xs text-violet-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['learner']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['learner']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-3.5 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs text-center border border-white/10 transition-all">
                            কোর্স বুক করুন →
                        </a>
                    </div>

                    <!-- Instructor LMS ERP Pack (৳500/mo + rev share) -->
                    <div class="p-8 rounded-3xl bg-gradient-to-b from-[#241033] to-[#121A29] border border-violet-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-violet-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            জনপ্রিয় মেন্টর প্যাক
                        </div>

                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                {{ $module['pricing_tiers']['instructor']['badge'] ?? 'জনপ্রিয় মেন্টর চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['instructor']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['instructor']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['instructor']['period'] }}</span>
                            </div>

                            <p class="text-xs text-violet-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['instructor']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['instructor']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-4 px-6 rounded-xl bg-violet-600 hover:bg-violet-500 text-white font-bold text-sm text-center shadow-lg shadow-violet-600/30 transition-all">
                            ইন্সট্রাক্টর ইআরপি চালু করুন →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Skill & Learning Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-violet-400 bg-violet-500/10 border border-violet-500/20 px-3.5 py-1 rounded-full">
                        স্কিল লার্নিং কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎓 শিক্ষার্থী ও মেন্টরদের হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-violet-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-violet-600/20 border border-violet-500/30 flex items-center justify-center text-2xl mb-4 text-violet-400">
                            🎓
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">বাস্তবমুখী প্রজেক্ট কারিকুলাম</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            থিওরি নির্ভরতা মুক্ত সরাসরি বাস্তব কাজের প্রয়োগ যেমন Spoken English ও Web Projects।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-purple-600/20 border border-purple-500/30 flex items-center justify-center text-2xl mb-4 text-purple-400">
                            👨‍🏫
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">ইনস্ট্রাক্টর LMS ERP</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            লাইভ ব্যাচ সিডিউলিং, স্টুডেন্ট অ্যাসাইনমেন্ট এবং অটোমেটেড পেআউট লেজার।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-indigo-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-2xl mb-4 text-indigo-400">
                            💬
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">লাইভ মেন্টরশিপ সাপোর্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            সরাসরি অভিজ্ঞ মেন্টরদের কাছ থেকে নিয়মিত ডাউট ক্লিয়ারিং ও প্রজেক্ট রিভিউ।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-pink-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-pink-600/20 border border-pink-500/30 flex items-center justify-center text-2xl mb-4 text-pink-400">
                            📜
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">ভেরিফাইড স্কিল সার্টিফিকেট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            এনআইডি এনক্রিপ্টেড কিউআর ভেরিফাইড প্রফেশনাল ডিজিটাল স্কিল সার্টিফিকেট।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Career & Salary Boost Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-violet-400 bg-violet-500/10 border border-violet-500/20 px-3.5 py-1 rounded-full">
                        স্কিল & কেরিয়ার বৃদ্ধির হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন বাস্তবমুখী স্কিল প্রজেক্ট শিখলে আপনার আনুমানিক বেতন বৃদ্ধি
                    </h2>

                    <!-- Skill Level Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার বর্তমান স্কিল প্রজেক্ট সংখ্যা: <strong class="text-violet-400 text-lg" x-text="(studentCount / 10).toFixed(0) + ' টি বাস্তব প্রজেক্ট'"></strong>
                        </label>
                        <input type="range" min="10" max="100" step="10" x-model="studentCount" 
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-violet-500">
                    </div>

                    <!-- Calculated Career Growth Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">📈 আনুমানিক শুরুর বেতন</p>
                            <p class="text-xl sm:text-2xl font-black text-violet-400 mt-1" x-text="'৳' + (studentCount * 400).toLocaleString() + '/মাস'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">⏱️ জব পাওয়ার সময় সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1">৭৫% দ্রুত চাকরি</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ কোর্স ফি</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">মাত্র ৳১২০০ থেকে শুরু</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-violet-400 bg-violet-500/10 border border-violet-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস প্রফেশনাল অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://skill.zengfy.test:7000' : 'https://skill.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-violet-500/40 flex flex-col items-center text-center transition-all group shadow-lg shadow-violet-500/10">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎓</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Skill</h3>
                        <p class="text-[10px] text-violet-400 mt-1">Bootcamps & LMS ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-gray-400 mt-1">VakilChamber & Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Tenant System</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://hotel.zengfy.test:7000' : 'https://hotel.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏨</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Hotel</h3>
                        <p class="text-[10px] text-gray-400 mt-1">ERP & ZengPay</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://ecommerce.zengfy.test:7000' : 'https://ecommerce.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛍️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Shop</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Online Store Engine</p>
                    </a>
                </div>
            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. এসএসসি বা এইচএসসির পর কোন্ কোর্সগুলো দিয়ে শুরু করা উচিত?</h3>
                        <p class="text-gray-300 leading-relaxed">বাস্তবমুখী কেরিয়ারের জন্য Spoken English, Practical Computer & IT এবং Real-World Web Coding প্রজেক্ট কোর্সগুলোর দিয়ে শুরু করা উচিত।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. মেন্টরদের কাছ থেকে কীভাবে লাইভ হেল্প পাওয়া যাবে?</h3>
                        <p class="text-gray-300 leading-relaxed">প্রতিটি ব্যাচে সাপ্তাহিক লাইভ Q&A সেশন এবং অ্যাসাইনমেন্ট রিভিউতে মেন্টররা সরাসরি প্রজেক্টের ভুলভ্রান্তি শুধরে দেন।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. ইনস্ট্রাক্টর LMS ERP কীভাবে কাজ করে?</h3>
                        <p class="text-gray-300 leading-relaxed">ইন্সট্রাক্টররা মাত্র ৳৫০০/মাস ও স্বল্প পার্সেন্টেজ শেয়ারে নিজের লার্নিং পোর্টাল চালু করতে পারেন, যেখানে লাইভ ব্যাচ ও অটোমেটেড পেআউট লেজার সংযুক্ত থাকে।</p>
                    </div>
                </div>
            </div>
        @elseif($module['id'] === 'civil')
            <!-- 10x Civil Engineering, Site ERP & AI Structural Analysis Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-amber-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-amber-400 bg-amber-500/10 border border-amber-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        🏗️ {{ $module['badge'] }}
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        সিভিল সাইট ম্যানেজমেন্ট ডিজিটাইজ করুন, AI দিয়ে ম্যাপ ও খরচ এনালাইসিস করুন 🏗️
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        রড, সিমেন্ট ও বালি কাঁচামাল লেজার, সাইট কন্ট্রাক্টর বেতন ইআরপি, AI ম্যাপ এনালাইসিস এবং ভেরিফাইড সিভিল ইঞ্জিনিয়ার ও কন্ট্রাক্টর পেইড সার্চ ডিরেক্টরি।
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#pricing"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-500 to-yellow-600 hover:from-amber-400 hover:to-yellow-500 text-white font-bold text-base shadow-xl shadow-amber-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>🔍 ভেরিফাইড ইঞ্জিনিয়ার ও ম্যাপ খুঁজুন (৳১০০)</span>
                            <span>→</span>
                        </a>

                        <a href="#sandbox"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            🎮 ১-ক্লিকে স্যান্ডবক্স ডেমো
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">
                        
                        <!-- Top Site Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-600/20 border border-amber-500/30 flex items-center justify-center text-xl text-amber-400">
                                    🏗️
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">উত্তরা ১০-তলা আবাসিক ভবন সাইট</h3>
                                    <p class="text-[11px] text-amber-400 font-semibold">● সাইট ইআরপি & সয়েল টেস্ট এনালাইসিস</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-amber-500/10 text-amber-400 text-xs font-bold border border-amber-500/20">
                                লাইভ সাইট
                            </span>
                        </div>

                        <!-- Live Material Ledger Mockup -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">রড-সিমেন্ট সাইট স্টক: <strong class="text-white">১২.৫ টন রড / ৩৫০ ব্যাগ সিমেন্ট</strong></span>
                                <span class="text-amber-400 font-bold">লেবার বেতন: ৳১৮,৫০০</span>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                                <p class="text-[11px] text-gray-300">🤖 AI ম্যাপ এনালাইসিস: <strong class="text-amber-300">"৫ম তলার ঢালাইয়ের জন্য ৬০-গ্রেড রড ব্যবহার করলে ১২% মেটেরিয়াল খরচ সাশ্রয় হবে।"</strong></p>
                            </div>
                        </div>

                        <!-- Live Engineer Verification Search Badge -->
                        <div class="p-4 rounded-2xl bg-amber-950/40 border border-amber-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-600/20 border border-amber-500/40 flex items-center justify-center font-black text-amber-400 text-lg">
                                    🔍
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ ইঞ্জিনিয়ার আব্দুর রহমান (BUET Civil)</p>
                                    <p class="text-[10px] text-amber-300">কাস্টমার ফাইল এক্সেস (৳১০০ সার্চ পেমেন্ট ভেরিফাইড)</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-amber-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Video Showcase Section (Upcoming Banner) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        ⏳ অফিশিয়াল ভিডিও টিউটোরিয়াল (Upcoming)
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটের অফিশিয়াল ভিডিও টিউটোরিয়াল খুব শীঘ্রই আসছে
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-amber-500/30 overflow-hidden shadow-2xl p-8 sm:p-14 text-center relative group">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-amber-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <div class="w-20 h-20 mx-auto rounded-full bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-4xl shadow-xl shadow-amber-500/10 animate-pulse">
                            🎬
                        </div>

                        <span class="inline-block px-4 py-1.5 rounded-full bg-amber-500/20 text-amber-300 font-extrabold text-xs tracking-wider border border-amber-400/30 uppercase">
                            Video Tutorial Upcoming
                        </span>

                        <h3 class="text-xl sm:text-2xl font-black text-white">
                            Zengfy Civil-এর সাইট ইআরপি ও AI ম্যাপ এনালাইসিস টিউটোরিয়াল তৈরি হচ্ছে!
                        </h3>

                        <p class="text-xs sm:text-sm text-gray-300 max-w-lg mx-auto leading-relaxed">
                            আমাদের প্রোডাক্ট টিম সিভিল সাইট রড-সিমেন্ট হিসাব, রাজমিস্ত্রি মজুরি লেজার, AI সয়েল ম্যাপ এনালাইসিস এবং ভেরিফাইড ইঞ্জিনিয়ার সার্চের হাই-কোয়ালিটি টিউটোরিয়াল ভিডিও শুট করছে।
                        </p>

                        <div class="pt-2">
                            <a href="#sandbox" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-600/30 hover:bg-amber-600/50 border border-amber-500/40 text-xs font-bold text-amber-200 transition-all">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                                <span>স্যান্ডবক্সে সিভিল প্যানেল ড্রাই-রান টেস্ট করতে নিচে ক্লিক করুন →</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Sandbox Simulator -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-amber-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 সাইনআপ ছাড়া এখনই সিভিল ইআরপি প্যানেল স্যান্ডবক্সে টেস্ট করুন
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে সিভিল প্যানেলের রিয়েল-টাইম ক্লিকেবল ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'material'; sandboxMessage = '✓ সাইট মেটেরিয়াল এন্ট্রি (৫ টন রড + ২০০ ব্যাগ সিমেন্ট) ও লেবার মজুরি (৳১২,৫০০) ইআরপি লেজারে সফলভাবে এন্টি এবং প্রজেক্ট ফাইল আপডেট।'" 
                                :class="sandboxAction === 'material' ? 'bg-amber-600 border-amber-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🏗️</span>
                            <h3 class="text-sm font-bold">১. রড, সিমেন্ট ও লেবার মজুরি এন্ট্রি</h3>
                            <p class="text-xs text-gray-400 mt-1">১-ক্লিকে সাইট মেটেরিয়াল কেনাকাটা ও রাজমিস্ত্রি বেতন হিসাব।</p>
                        </button>

                        <button @click="sandboxAction = 'ai'; sandboxMessage = '🤖 AI ম্যাপ এনালাইসিস রিপোর্ট: সাইট সয়েল টেস্ট অনুযায়ী পাইলিং গভীরতা ৩৫ ফিট এবং কলাম সাইজ ১৮x২৪ ইঞ্চি রাখার সুপারিশ।'" 
                                :class="sandboxAction === 'ai' ? 'bg-amber-600 border-amber-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🤖</span>
                            <h3 class="text-sm font-bold">২. AI সয়েল টেস্ট & ম্যাপ এনালাইসিস</h3>
                            <p class="text-xs text-gray-400 mt-1">বিল্ডিং ফ্লোর প্ল্যান ও লোড ক্যালকুলেশনে AI দিকনির্দেশনা।</p>
                        </button>

                        <button @click="sandboxAction = 'search'; sandboxMessage = '✓ ৳১০০ পেমেন্টে বুয়েট গ্র্যাজুয়েট সিভিল ইঞ্জিনিয়ার এবং অভিজ্ঞ কন্ট্রাক্টরের স্বচক্ষ ভেরিফাইড কন্টাক্ট ফাইল অনলক সম্পন্ন।'" 
                                :class="sandboxAction === 'search' ? 'bg-amber-600 border-amber-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🔍</span>
                            <h3 class="text-sm font-bold">৩. ৳১০০ পেইড ইঞ্জিনিয়ার সার্চ অনলক</h3>
                            <p class="text-xs text-gray-400 mt-1">বাড়ি বানাতে অভিজ্ঞ সিভিল ইঞ্জিনিয়ার ও ম্যাপ ফাইল সার্চ।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-amber-950/40 border border-amber-500/40 text-amber-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-amber-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Transparent Pricing Tier Section -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ কাস্টমারদের জন্য ৳১০০ — ইঞ্জিনিয়ারিং ফার্মের জন্য সাশ্রয়ী ইআরপি প্যাক
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- Client Verified Search Connect (৳100/search) -->
                    <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-amber-500/50 backdrop-blur-xl transition-all flex flex-col justify-between">
                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-amber-500/10 text-amber-400 text-xs font-bold border border-amber-500/20">
                                {{ $module['pricing_tiers']['client']['badge'] ?? 'বাড়ি নির্মাণকারী চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['client']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['client']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['client']['period'] }}</span>
                            </div>

                            <p class="text-xs text-amber-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['client']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['client']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-amber-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-3.5 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs text-center border border-white/10 transition-all">
                            ইঞ্জিনিয়ার সার্চ করুন →
                        </a>
                    </div>

                    <!-- Engineering Firm ERP (৳800/month) -->
                    <div class="p-8 rounded-3xl bg-gradient-to-b from-[#332610] to-[#121A29] border border-amber-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-amber-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            জনপ্রিয় ফার্ম প্যাক
                        </div>

                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-amber-500/10 text-amber-400 text-xs font-bold border border-amber-500/20">
                                {{ $module['pricing_tiers']['firm']['badge'] ?? 'জনপ্রিয় ফার্ম চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['firm']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['firm']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['firm']['period'] }}</span>
                            </div>

                            <p class="text-xs text-amber-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['firm']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['firm']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-amber-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-4 px-6 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-bold text-sm text-center shadow-lg shadow-amber-600/30 transition-all">
                            সাইট ইআরপি চালু করুন →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Civil & Construction Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        সিভিল সাইট কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏗️ ইঞ্জিনিয়ার, কন্ট্রাক্টর ও বাড়ি নির্মাণকারীদের হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-amber-600/20 border border-amber-500/30 flex items-center justify-center text-2xl mb-4 text-amber-400">
                            🏗️
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">সাইট ইআরপি & কাঁচামাল লেজার</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            রড, সিমেন্ট, বালি বাজার খরচ ও শ্রমিকদের দৈনন্দিন মজুরি হিসাব অটো লেজার।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-yellow-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-yellow-600/20 border border-yellow-500/30 flex items-center justify-center text-2xl mb-4 text-yellow-400">
                            🤖
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">AI সাইট & ম্যাপ এনালাইসিস</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            মেটেরিয়াল এস্টিমেশন, সয়েল টেস্ট রিপোর্ট ও ম্যাপ এনালাইসিসে AI এর স্মার্ট গাইড।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-orange-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-orange-600/20 border border-orange-500/30 flex items-center justify-center text-2xl mb-4 text-orange-400">
                            🔍
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">পেইড ইঞ্জিনিয়ার & কন্ট্রাক্টর সার্চ</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            সাধারণ বাড়ি বানাতে ইচ্ছুক কাস্টমারদের জন্য ভেরিফাইড ইঞ্জিনিয়ার ও ম্যাপ ফাইল সার্চ।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-pink-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-pink-600/20 border border-pink-500/30 flex items-center justify-center text-2xl mb-4 text-pink-400">
                            📐
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">বিল্ডিং ম্যাপ & প্রজেক্ট ভল্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            আর্কিটেকচারাল ব্লুপ্রিন্ট, ক্যাড ফাইল ও প্রজেক্ট মাইলস্টোন ক্লাউড সিকিউরিটি।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Construction Cost & Material Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        নির্মাণ খরচ & AI সাশ্রয়ের হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন আপনার প্রস্তাবিত ভবনের স্কয়ার ফিট অনুযায়ী নির্মাণ খরচ ও AI সাশ্রয়
                    </h2>

                    <!-- Sqft Building Size Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার ভবনের মোট আয়তন (স্কয়ার ফিট): <strong class="text-amber-400 text-lg" x-text="(studentCount * 10).toLocaleString() + ' sqft'"></strong>
                        </label>
                        <input type="range" min="100" max="1000" step="25" x-model="studentCount" 
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-amber-500">
                    </div>

                    <!-- Calculated Material Costs Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🧱 আনুমানিক রড-সিমেন্ট খরচ</p>
                            <p class="text-xl sm:text-2xl font-black text-amber-400 mt-1" x-text="'৳' + (studentCount * 18000).toLocaleString()"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">💡 AI ম্যাপ এনালাইসিসে সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1" x-text="'৳' + (studentCount * 2200).toLocaleString()"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ সিভিল ইআরপি খরচ</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">মাত্র ৳২৬/দিন</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস প্রফেশনাল অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://civil.zengfy.test:7000' : 'https://civil.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-amber-500/40 flex flex-col items-center text-center transition-all group shadow-lg shadow-amber-500/10">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏗️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Civil</h3>
                        <p class="text-[10px] text-amber-400 mt-1">Engineering ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-gray-400 mt-1">VakilChamber & Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Tenant System</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://hotel.zengfy.test:7000' : 'https://hotel.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏨</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Hotel</h3>
                        <p class="text-[10px] text-gray-400 mt-1">ERP & ZengPay</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://ecommerce.zengfy.test:7000' : 'https://ecommerce.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛍️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Shop</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Online Store Engine</p>
                    </a>
                </div>
            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. সিভিল সাইটের রড, সিমেন্ট ও মজুরি হিসাব কীভাবে রাখা যায়?</h3>
                        <p class="text-gray-300 leading-relaxed">মোবাইল বা পিসি প্যানেল থেকে ১-ক্লিকে প্রতিটি চালানের রড, সিমেন্ট, বালির পরিমাণ এবং সাইট শ্রমিকদের দৈনিক হাজিরা ও মজুরি লেজারে সেভ করা যায়।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. AI দিয়ে সাইট ও ম্যাপ এনালাইসিস কীভাবে কাজ করে?</h3>
                        <p class="text-gray-300 leading-relaxed">AI সয়েল টেস্ট রিপোর্ট, স্ট্রাকচারাল ম্যাপ ও লোড ক্যালকুলেশন বিশ্লেষণ করে মেটেরিয়াল ওয়েস্টেজ কমানো এবং টেকসই ভবনের জন্য অটোমেটিক পরামর্শ প্রদান করে।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. কাস্টমারদের জন্য ৳১০০ পেইড ইঞ্জিনিয়ার সার্চ কীভাবে কাজ করে?</h3>
                        <p class="text-gray-300 leading-relaxed">বাড়ি নির্মাণকারী ব্যক্তিরা ৳১০০ পেমেন্ট করে অভিজ্ঞ সিভিল ইঞ্জিনিয়ার, কন্ট্রাক্টরদের লাইভ ফাইল এক্সেস এবং আর্কিটেকচারাল ম্যাপ নকশা ডাউনলোড করতে পারবেন।</p>
                    </div>
                </div>
            </div>
        @elseif($module['id'] === 'hotel')
            <!-- 10x Hotel, Restaurant ERP & AI Growth Supervision Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        🏨 {{ $module['badge'] }}
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        হোটেল, রেস্টুরেন্ট ও কমিউনিটি সেন্টার ডিজিটাইজ করুন, AI দিয়ে ব্যবসা বাড়ান 🏨
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        দৈনিক কাঁচামাল বাজার খরচ, কর্মচারীদের বেতনের খাতা, AI বিজনেস তদারকি এবং রেস্টুরেন্টে ডাইনিং কাস্টমারদের সরাসরি ZengPay Coin দিয়ে ক্যাশলেস বিল পেমেন্ট নেওয়ার অল-ইন-ওয়ান অপারেটিং সিস্টেম।
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#pricing"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white font-bold text-base shadow-xl shadow-emerald-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>🏨 হোটেল ও রেস্টুরেন্ট প্যানেল চালু করুন (৳৭০০/মাস)</span>
                            <span>→</span>
                        </a>

                        <a href="#sandbox"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            🎮 ১-ক্লিকে স্যান্ডবক্স ডেমো
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">
                        
                        <!-- Top Merchant Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-xl text-emerald-400">
                                    🏨
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">গ্র্যান্ড ইন হোটেল & রেস্টুরেন্ট</h3>
                                    <p class="text-[11px] text-emerald-400 font-semibold">● রুম রিজার্ভেশন & ক্যাফে ডাইনিং ইআরপি</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                AI লাইভ তদারকি
                            </span>
                        </div>

                        <!-- Live Order & Expense Ledger Mockup -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">দৈনিক খরচ ও বেতন: <strong class="text-white">৳১২,৪৫০</strong></span>
                                <span class="text-emerald-400 font-bold">আজকের প্রফিট মার্জিন: +২৮%</span>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                                <p class="text-[11px] text-gray-300">🤖 AI পরামর্শ: <strong class="text-emerald-300">"সন্ধ্যা ৭-৯ টায় ক্যাফে চিকেন বিরিয়ানি সেটে ২০% ডিসকাউন্ট দিলে বিক্রি ৪০% বাড়বে।"</strong></p>
                            </div>
                        </div>

                        <!-- Live ZengPay Coin Payment Badge -->
                        <div class="p-4 rounded-2xl bg-emerald-950/40 border border-emerald-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-600/20 border border-emerald-500/40 flex items-center justify-center font-black text-emerald-400 text-lg">
                                    🪙
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ ৳৮৫০ রেস্টুরেন্ট বিল (ZengPay Coin)</p>
                                    <p class="text-[10px] text-emerald-300">Coin TrxID: ZP99824X (ক্যাশলেস অটো লেজার)</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Video Showcase Section (Upcoming Banner) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        ⏳ অফিশিয়াল ভিডিও টিউটোরিয়াল (Upcoming)
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটের অফিশিয়াল ভিডিও টিউটোরিয়াল খুব শীঘ্রই আসছে
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-emerald-500/30 overflow-hidden shadow-2xl p-8 sm:p-14 text-center relative group">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <div class="w-20 h-20 mx-auto rounded-full bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-4xl shadow-xl shadow-emerald-500/10 animate-pulse">
                            🎬
                        </div>

                        <span class="inline-block px-4 py-1.5 rounded-full bg-emerald-500/20 text-emerald-300 font-extrabold text-xs tracking-wider border border-emerald-400/30 uppercase">
                            Video Tutorial Upcoming
                        </span>

                        <h3 class="text-xl sm:text-2xl font-black text-white">
                            Zengfy Hotel-এর AI তদারকি ও ZengPay কুইন টিউটোরিয়াল তৈরি হচ্ছে!
                        </h3>

                        <p class="text-xs sm:text-sm text-gray-300 max-w-lg mx-auto leading-relaxed">
                            আমাদের প্রোডাক্ট টিম হোটেল ইআরপি, দৈনিক বাজার খরচ লেজার, AI গ্রোথ এডভাইজর এবং ZengPay Coin কুইন পেমেন্ট এক্সেপ্ট্যান্সের হাই-কোয়ালিটি টিউটোরিয়াল ভিডিও শুট করছে।
                        </p>

                        <div class="pt-2">
                            <a href="#sandbox" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600/30 hover:bg-emerald-600/50 border border-emerald-500/40 text-xs font-bold text-emerald-200 transition-all">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>স্যান্ডবক্সে হোটেল প্যানেল ড্রাই-রান টেস্ট করতে নিচে ক্লিক করুন →</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Sandbox Simulator -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-emerald-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 সাইনআপ ছাড়া এখনই হোটেল ও রেস্টুরেন্ট প্যানেল স্যান্ডবক্সে টেস্ট করুন
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে ইআরপি প্যানেলের রিয়েল-টাইম ক্লিকেবল ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'expense'; sandboxMessage = '✓ দৈনিক বাজার খরচ (৳৪,৫০০) এবং কর্মচারীদের বেতন লেজারে সফলভাবে এন্টি সম্পন্ন এবং ক্যাশ ব্যালেন্স আপডেট।'" 
                                :class="sandboxAction === 'expense' ? 'bg-emerald-600 border-emerald-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📊</span>
                            <h3 class="text-sm font-bold">১. দৈনিক বাজার খরচ ও বেতন হিসাব</h3>
                            <p class="text-xs text-gray-400 mt-1">১-ক্লিকে কিসেন বাজার, স্টাফ বেতন ও অন্যান্য ওভারহেড এন্ট্রি।</p>
                        </button>

                        <button @click="sandboxAction = 'ai'; sandboxMessage = '🤖 AI তদারকি রিপোর্ট: আগামী সপ্তাহে রেস্টুরেন্টে পিক কাস্টমার ভিড় সামলাতে চিকেন প্রিপারেশন ২৫% বৃদ্ধির ও অটো ডিসকাউন্ট সেট করার পরামর্শ।'" 
                                :class="sandboxAction === 'ai' ? 'bg-emerald-600 border-emerald-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🤖</span>
                            <h3 class="text-sm font-bold">২. AI বিজনেস গ্রোথ পরামর্শ নিন</h3>
                            <p class="text-xs text-gray-400 mt-1">বিক্রি ও মুনাফা বাড়াতে AI স্বয়ংক্রিয় এনালাইসিস রিপোর্ট।</p>
                        </button>

                        <button @click="sandboxAction = 'coin'; sandboxMessage = '✓ কাস্টমার মো: রফিকুল ইসলাম-এর ৳৮৫০ রেস্টুরেন্ট বিল ZengPay Coin QR পেমেন্টে গৃহীত ও ডিজিটাল রসিদ ইস্যু সম্পন্ন।'" 
                                :class="sandboxAction === 'coin' ? 'bg-emerald-600 border-emerald-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🪙</span>
                            <h3 class="text-sm font-bold">৩. ZengPay Coin কুইন পেমেন্ট কালেকশন</h3>
                            <p class="text-xs text-gray-400 mt-1">কাস্টমারদের কাছে সরাসরি ZengPay কুইনে রেস্টুরেন্ট বিল জমা।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-emerald-950/40 border border-emerald-500/40 text-emerald-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Transparent Pricing Tier Section -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ কোনো গোপন ফি নেই — সব হোটেল ও রেস্টুরেন্টের জন্য সাশ্রয়ী অল-ইন-ওয়ান প্যাক
                    </h2>
                </div>

                <div class="max-w-xl mx-auto">
                    <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-b from-[#102923] to-[#121A29] border border-emerald-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden text-center">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-emerald-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            জনপ্রিয় মার্চেন্ট প্যাক
                        </div>

                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                {{ $module['pricing_tiers']['erp']['badge'] ?? 'জনপ্রিয় মার্চেন্ট চয়েস' }}
                            </span>
                            <h3 class="text-2xl font-black text-white mt-3">{{ $module['pricing_tiers']['erp']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['erp']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['erp']['period'] }}</span>
                            </div>

                            <p class="text-xs text-emerald-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['erp']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300 text-left max-w-md mx-auto">
                                @foreach($module['pricing_tiers']['erp']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-4 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm text-center shadow-lg shadow-emerald-600/30 transition-all">
                            হোটেল & রেস্টুরেন্ট প্যাক চালু করুন →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Hotel & Merchant Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        মার্চেন্ট কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏨 হোটেল, রেস্টুরেন্ট ও কমিউনিটি সেন্টারের হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-2xl mb-4 text-emerald-400">
                            📊
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">দৈনিক খরচ & বেতন হিসাব</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            প্রতিদিনের বাজার কাঁচামাল কেনাকাটা, ইউটিলিটি বিল ও কর্মচারীদের বেতন হিসাব লেজার।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-teal-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-teal-600/20 border border-teal-500/30 flex items-center justify-center text-2xl mb-4 text-teal-400">
                            🤖
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">AI দিয়ে ব্যবসা তদারকি</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            কাস্টমার পিক ট্রাফিক, খাবার অপচয় ও বিক্রির ওপর ভিত্তি করে AI এর লাইভ গ্রোথ গাইডেন্স।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-indigo-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-2xl mb-4 text-indigo-400">
                            🪙
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">ZengPay কুইন পেমেন্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            কাস্টমারদের রেস্টুরেন্ট বিল সরাসরি ZengPay Coin দিয়ে ক্যাশলেস কিউআরে গ্রহণ।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-pink-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-pink-600/20 border border-pink-500/30 flex items-center justify-center text-2xl mb-4 text-pink-400">
                            🏨
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">গেস্ট বুকিং & হল সূচি</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            হোটেল রুম রিজার্ভেশন, গেস্ট সিকিউরিটি স্ক্যান ও কমিউনিটি সেন্টার হল বুকিং ক্যালেন্ডার।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic AI ROI & Revenue Growth Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        AI তদারকি ও লাভ বৃদ্ধির হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন Zengfy Hotel ইআরপি ব্যবহার করলে আপনার মাসে কত টাকা লাভ বৃদ্ধি পাবে
                    </h2>

                    <!-- Monthly Revenue Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার হোটেল/রেস্টুরেন্টের মাসিক বিক্রি কত? <strong class="text-emerald-400 text-lg" x-text="'৳' + (studentCount * 500).toLocaleString()"></strong>
                        </label>
                        <input type="range" min="100" max="2000" step="50" x-model="studentCount" 
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-emerald-500">
                    </div>

                    <!-- Calculated Savings Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">📈 AI তদারকিতে লাভ বৃদ্ধি</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1" x-text="'৳' + (studentCount * 75).toLocaleString() + '/মাস'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">⏱️ হিসাব সংক্রান্ত সময় সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-teal-400 mt-1">৮৫% সময় বাঁচবে</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ Zengfy Hotel খরচ</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">মাত্র ৳২৩/দিন</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস প্রফেশনাল অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://hotel.zengfy.test:7000' : 'https://hotel.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-emerald-500/40 flex flex-col items-center text-center transition-all group shadow-lg shadow-emerald-500/10">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏨</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Hotel</h3>
                        <p class="text-[10px] text-emerald-400 mt-1">ERP & ZengPay Coin</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-gray-400 mt-1">VakilChamber & Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Tenant System</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://ecommerce.zengfy.test:7000' : 'https://ecommerce.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛍️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Shop</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Online Store Engine</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://skill.zengfy.test:7000' : 'https://skill.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-violet-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎓</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Skill</h3>
                        <p class="text-[10px] text-gray-400 mt-1">LMS Platform</p>
                    </a>
                </div>
            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. দৈনিক খরচ ও স্টাফ বেতন কীভাবে ট্র্যাকিং করা যাবে?</h3>
                        <p class="text-gray-300 leading-relaxed">মোবাইল বা পিসি থেকে ১-ক্লিকে প্রতিদিনের বাজার কাঁচামাল কেনাকাটা, বিদ্যুৎ বিল ও স্টাফ বেতন এন্ট্রি দিলে স্বয়ংক্রিয়ভাবে ক্যাশ ব্যালেন্স ও লেজার জেনারেট হয়।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. AI দিয়ে ব্যবসা তদারকি কীভাবে সাহায্য করে?</h3>
                        <p class="text-gray-300 leading-relaxed">AI সিস্টেম আপনার প্রতিদিনের বিক্রি, পিক কাস্টমার ট্রাফিক ও খাবার অপচয় বিশ্লেষণ করে বিক্রি ও মুনাফা বাড়ানোর নির্দিষ্ট পরামর্শ প্রদান করে।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. ZengPay Coin কীভাবে কাস্টমারদের থেকে গ্রহণ করব?</h3>
                        <p class="text-gray-300 leading-relaxed">কাস্টমাররা রেস্টুরেন্টে খেয়ে কাউন্টারের ZengPay QR স্ক্যান করে সরাসরি ZengPay Coin টোকেনে বিল পরিশোধ করতে পারবে, যা সাথে সাথে আপনার প্যানেলে ক্যাশলেস হিসেবে জমা হবে।</p>
                    </div>
                </div>
            </div>
        @elseif($module['id'] === 'rent')
            <!-- 10x Radius Rental Property & Verified Tenant Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20 relative">
                <div class="absolute top-1/2 left-1/4 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-purple-600/15 rounded-full blur-[140px] pointer-events-none"></div>

                <!-- Hero Left Copy -->
                <div class="lg:col-span-7 text-center lg:text-left scroll-reveal opacity-0 translate-y-10">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold tracking-wider uppercase text-purple-400 bg-purple-500/10 border border-purple-500/20 px-4 py-1.5 rounded-full mb-6">
                        <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
                        🔑 {{ $module['badge'] }}
                    </span>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                        আপনার এলাকার ৫-১০ কিমি রেডিয়াসে সরাসরি বাড়িওয়ালার ফাঁকা বাসা খুঁজুন 🔑
                    </h1>

                    <p class="mt-6 text-gray-300 text-base sm:text-lg leading-relaxed font-normal">
                        সোশ্যাল ইকোসিস্টেমের কোটি কোটি ব্যবহারকারীর জন্য দালাল বা ব্রোকার ফি ছাড়া ৫-১০ কিমি ম্যাপ রেডিয়াসে ফাঁকা বাসা খোঁজা ও সরাসরি বাড়িওয়ালার সাথে যোগাযোগের অল-ইন-ওয়ান স্মার্ট সমাধান।
                    </p>

                    <!-- Dual Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#pricing"
                           class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-400 hover:to-indigo-500 text-white font-bold text-base shadow-xl shadow-purple-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                            <span>🔍 ৫-১০ কিমি রেডিয়াসে বাসা খুঁজুন (৳৫০)</span>
                            <span>→</span>
                        </a>

                        <a href="#sandbox"
                           class="w-full sm:w-auto px-6 py-4 rounded-2xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-base backdrop-blur-md transition-all text-center">
                            🎮 ১-ক্লিকে স্যান্ডবক্স রেডিয়াস
                        </a>
                    </div>
                </div>

                <!-- Hero Right Live Visual Showcase Mockup -->
                <div class="lg:col-span-5 relative scroll-reveal opacity-0 translate-y-10">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/90 border border-white/10 shadow-2xl backdrop-blur-2xl relative z-10 space-y-6">
                        
                        <!-- Top Location Badge -->
                        <div class="flex items-center justify-between border-b border-white/10 pb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-600/20 border border-purple-500/30 flex items-center justify-center text-xl text-purple-400">
                                    📍
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-white">মিরপুর ১০ (৫ কিমি ম্যাপ রেডিয়াস)</h3>
                                    <p class="text-[11px] text-emerald-400 font-semibold">● ৪টি ভেরিফাইড ফ্ল্যাট ফাঁকা লাইভ</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-purple-500/10 text-purple-400 text-xs font-bold border border-purple-500/20">
                                ব্রোকারমুক্ত
                            </span>
                        </div>

                        <!-- Live Flat Vacancy Card Mockup -->
                        <div class="p-4 rounded-2xl bg-[#090D14] border border-white/10 space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-400">প্রপার্টি আইডি: <strong class="text-white">#RENT-8842</strong></span>
                                <span class="text-purple-400 font-bold">৩ বিএইচকে (১৫০০ বর্গফুট)</span>
                            </div>
                            <div class="p-3 rounded-xl bg-white/5 border border-white/5 space-y-1">
                                <p class="text-[11px] text-gray-300">ঠিকানা: <strong class="text-white">রোড-৪, ব্লক-বি, মিরপুর ১০</strong> | ভাড়া: <strong class="text-white">৳২৪,০০০/মাস</strong></p>
                                <p class="text-[11px] text-emerald-400 font-semibold">বাড়ির মালিক: ভেরিফাইড মো: রফিকুল ইসলাম (সরাসরি নম্বর উন্মুক্ত)</p>
                            </div>
                        </div>

                        <!-- Live Fee Badge -->
                        <div class="p-4 rounded-2xl bg-purple-950/40 border border-purple-500/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-600/20 border border-purple-500/40 flex items-center justify-center font-black text-purple-400 text-lg">
                                    bKash
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white">✓ ৳৫০ সার্চ কানেক্ট ফি পরিশোধিত</p>
                                    <p class="text-[10px] text-purple-300">TrxID: RENT77X992 (বাড়ির মালিকের সরাসরি নম্বর রিলিজড)</p>
                                </div>
                            </div>
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Video Showcase Section (Upcoming Banner) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-purple-400 bg-purple-500/10 border border-purple-500/20 px-3.5 py-1 rounded-full">
                        ⏳ অফিশিয়াল ভিডিও টিউটোরিয়াল (Upcoming)
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🎬 ২ মিনিটের অফিশিয়াল ভিডিও টিউটোরিয়াল খুব শীঘ্রই আসছে
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-purple-500/30 overflow-hidden shadow-2xl p-8 sm:p-14 text-center relative group">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-purple-500/10 rounded-full blur-[100px] pointer-events-none"></div>

                    <div class="relative z-10 space-y-4">
                        <div class="w-20 h-20 mx-auto rounded-full bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-4xl shadow-xl shadow-purple-500/10 animate-pulse">
                            🎬
                        </div>

                        <span class="inline-block px-4 py-1.5 rounded-full bg-purple-500/20 text-purple-300 font-extrabold text-xs tracking-wider border border-purple-400/30 uppercase">
                            Video Tutorial Upcoming
                        </span>

                        <h3 class="text-xl sm:text-2xl font-black text-white">
                            Zengfy Rent-এর ৫-১০ কিমি ম্যাপ ও লিস্টিং টিউটোরিয়াল তৈরি হচ্ছে!
                        </h3>

                        <p class="text-xs sm:text-sm text-gray-300 max-w-lg mx-auto leading-relaxed">
                            আমাদের প্রোডাক্ট টিম ৫-১০ কিমি লাইভ রেডিয়াস ম্যাপ সার্চ, বাড়িওয়ালার ভেরিফাইড প্রপার্টি আইডি ও কন্টাক্ট টোকেন রিলিজের হাই-কোয়ালিটি টিউটোরিয়াল ভিডিও শুট করছে।
                        </p>

                        <div class="pt-2">
                            <a href="#sandbox" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-purple-600/30 hover:bg-purple-600/50 border border-purple-500/40 text-xs font-bold text-purple-200 transition-all">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                                <span>স্যান্ডবক্সে রেডিয়াস ম্যাপ ড্রাই-রান টেস্ট করতে নিচে ক্লিক করুন →</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Sandbox Simulator -->
            <div id="sandbox" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-b from-[#121A29] to-[#0A0E17] border border-purple-500/30 shadow-2xl backdrop-blur-2xl">
                    <div class="text-center max-w-2xl mx-auto mb-8">
                        <span class="text-xs font-extrabold uppercase tracking-widest text-purple-400 bg-purple-500/10 border border-purple-500/20 px-3.5 py-1 rounded-full">
                            স্যান্ডবক্স ড্রাই-রান
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                            🎮 সাইনআপ ছাড়া এখনই বাসা ভাড়া প্যানেল স্যান্ডবক্সে টেস্ট করুন
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-300 mt-2">নিচের বাটনগুলোতে ক্লিক করে রেন্ট প্যানেলের রিয়েল-টাইম ক্লিclickable ক্ষমতা পরীক্ষা করুন:</p>
                    </div>

                    <!-- 3 Clickable Dry-Run Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <button @click="sandboxAction = 'radius'; sandboxMessage = '✓ ৫ কিমি রেডিয়াস সিলেক্টেড: মিরপুর ১০ জোনে ৩টি ভেরিফাইড ফ্ল্যাট ফাঁকা পাওয়া গেছে এবং সরাসরি ম্যাপে পিন দৃশ্যমান।'" 
                                :class="sandboxAction === 'radius' ? 'bg-purple-600 border-purple-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📍</span>
                            <h3 class="text-sm font-bold">১. ৫-১০ কিমি রেডিয়াসে ফাঁকা বাসা ফিল্টার</h3>
                            <p class="text-xs text-gray-400 mt-1">১-ক্লিকে নিজের এলাকার ৫ বা ১০ কিমি ব্যাসার্ধের বাসা সার্চ।</p>
                        </button>

                        <button @click="sandboxAction = 'owner'; sandboxMessage = '✓ ৳৫০ ফি পরিশোধের মাধ্যমে বাড়িওয়ালা মো: রফিকুল ইসলাম-এর সাথে সরাসরি কল ও চ্যাট অপশন উন্মুক্ত হয়েছে।'" 
                                :class="sandboxAction === 'owner' ? 'bg-purple-600 border-purple-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">📞</span>
                            <h3 class="text-sm font-bold">২. সরাসরি বাড়িওয়ালা নম্বর আনলক</h3>
                            <p class="text-xs text-gray-400 mt-1">কোনো ব্রোকার ছাড়াই সরাসরি বাড়িওয়ালার কন্টাক্ট টোকেন রিলিজ।</p>
                        </button>

                        <button @click="sandboxAction = 'ad'; sandboxMessage = '✓ বাড়িওয়ালা হিসেবে ৳১৫০ ফি পেমেন্টে মিরপুর ১০-এর ৩-বিএইচকে ফ্ল্যাটের বাসা ফাঁকা লাইভ বিজ্ঞাপন সোশ্যাল ফিডে পোস্ট সম্পন্ন।'" 
                                :class="sandboxAction === 'ad' ? 'bg-purple-600 border-purple-400 text-white' : 'bg-white/5 hover:bg-white/10 border-white/10 text-gray-300'"
                                class="p-5 rounded-2xl border text-left transition-all cursor-pointer">
                            <span class="text-2xl mb-2 block">🏠</span>
                            <h3 class="text-sm font-bold">৩. বাড়িওয়ালার বাসা ফাঁকা বিজ্ঞাপন এন্ট্রি</h3>
                            <p class="text-xs text-gray-400 mt-1">স্মার্ট প্রপার্টি আইডি সত্যায়ন সহ সোশ্যাল ফিডে লাইভ বিজ্ঞাপন।</p>
                        </button>
                    </div>

                    <!-- Sandbox Output Notification Window -->
                    <div x-show="sandboxMessage" x-cloak x-transition
                         class="p-4 rounded-2xl bg-purple-950/40 border border-purple-500/40 text-purple-200 text-xs sm:text-sm font-semibold flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse shrink-0"></span>
                        <span x-text="sandboxMessage"></span>
                    </div>
                </div>
            </div>

            <!-- Transparent Pricing Tier Section -->
            <div id="pricing" class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-purple-400 bg-purple-500/10 border border-purple-500/20 px-3.5 py-1 rounded-full">
                        স্বচ্ছ ও সাশ্রয়ী প্রাইসিং
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🏷️ বাসা সন্ধানকারী ও বাড়িওয়ালা উভয়ের জন্য সাশ্রয়ী প্ল্যান
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- Tenant Search Connect Pack (৳50/search) -->
                    <div class="p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 hover:border-purple-500/50 backdrop-blur-xl transition-all flex flex-col justify-between">
                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-purple-500/10 text-purple-400 text-xs font-bold border border-purple-500/20">
                                {{ $module['pricing_tiers']['tenant']['badge'] ?? 'বাসা সন্ধানকারী চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['tenant']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['tenant']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['tenant']['period'] }}</span>
                            </div>

                            <p class="text-xs text-purple-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['tenant']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['tenant']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-3.5 px-6 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs text-center border border-white/10 transition-all">
                            বাসা সার্চ চালু করুন →
                        </a>
                    </div>

                    <!-- Landlord Listing Pack (৳150/listing) -->
                    <div class="p-8 rounded-3xl bg-gradient-to-b from-[#251033] to-[#121A29] border border-purple-500/40 shadow-2xl backdrop-blur-xl transition-all flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-3 -right-3 px-4 py-1.5 bg-purple-600 text-white text-[10px] font-black uppercase tracking-wider rounded-bl-xl shadow-lg">
                            জনপ্রিয় বাড়িওয়ালা প্যাক
                        </div>

                        <div>
                            <span class="px-3.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                {{ $module['pricing_tiers']['landlord']['badge'] ?? 'জনপ্রিয় বাড়িওয়ালা চয়েস' }}
                            </span>
                            <h3 class="text-xl font-bold text-white mt-3">{{ $module['pricing_tiers']['landlord']['name'] }}</h3>

                            <div class="my-6">
                                <span class="text-4xl font-black text-white">{{ $module['pricing_tiers']['landlord']['amount'] }}</span>
                                <span class="text-xs text-gray-400">{{ $module['pricing_tiers']['landlord']['period'] }}</span>
                            </div>

                            <p class="text-xs text-purple-300 font-semibold mb-6">✓ {{ $module['pricing_tiers']['landlord']['highlight'] }}</p>

                            <ul class="space-y-3 text-xs text-gray-300">
                                @foreach($module['pricing_tiers']['landlord']['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}" 
                           class="mt-8 w-full py-4 px-6 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-bold text-sm text-center shadow-lg shadow-purple-600/30 transition-all">
                            বাসা ফাঁকা বিজ্ঞাপন দিন →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Landlord Power Matrix (4 Control Levers) -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-purple-400 bg-purple-500/10 border border-purple-500/20 px-3.5 py-1 rounded-full">
                        স্মার্ট রেন্টাল কন্ট্রোল সেন্টার
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🔑 বাসা সন্ধানকারী ও বাড়িওয়ালাদের হাতে যে ৪টি ক্ষমতা থাকবে
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-purple-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-purple-600/20 border border-purple-500/30 flex items-center justify-center text-2xl mb-4 text-purple-400">
                            📍
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">৫-১০ কিমি সুনির্দিষ্ট রেডিয়াস ম্যাপ</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            নিজের লাইভ কাস্টম লোকেশন ধরে ৫ বা ১০ কিমি ব্যাসার্ধের সব ফাঁকা বাসা ১-ক্লিকে ফিল্টার।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-emerald-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-2xl mb-4 text-emerald-400">
                            🚫
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">দালালমুক্ত সরাসরি বাড়িওয়ালা কানেক্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            কোনো তৃতীয় ব্যক্তির অতিরিক্ত কমিশন ছাড়া সরাসরি ভেরিফাইড বাড়ির মালিকের সাথে কথা।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-indigo-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600/20 border border-indigo-500/30 flex items-center justify-center text-2xl mb-4 text-indigo-400">
                            🔐
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">স্মার্ট ভেরিফাইড প্রপার্টি ভল্ট</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            ভূয়া পোস্ট রোধ করতে ভেরিফাইড এনআইডি প্রপার্টি আইডি ও সিকিউরিটি চেকিং।
                        </p>
                    </div>

                    <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 hover:border-pink-500/40 backdrop-blur-xl transition-all">
                        <div class="w-12 h-12 rounded-2xl bg-pink-600/20 border border-pink-500/30 flex items-center justify-center text-2xl mb-4 text-pink-400">
                            📜
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">বিকাশ অটো-ভাড়া কালেকশন & রসিদ</h3>
                        <p class="text-xs text-gray-300 leading-relaxed">
                            বিকাশ/নগদে মাসিক ভাড়া কালেকশন ও স্বয়ংক্রিয় প্রপার্টি ডিজিটাল ভাড়া রসিদ প্রদান।
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dynamic Broker Savings & ROI Calculator -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 shadow-2xl backdrop-blur-xl text-center max-w-4xl mx-auto">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-1 rounded-full">
                        দালাল ফি ও সময় বাঁচানোর লাইভ হিসেব
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        💡 দেখুন Zengfy Rent ব্যবহার করলে বাসা বদলানোর সময়ে আপনার কত টাকা ব্রোকার ফি সাশ্রয় হবে
                    </h2>

                    <!-- Rent Amount Slider -->
                    <div class="my-8 max-w-xl mx-auto">
                        <label class="text-sm font-semibold text-gray-300 block mb-2">
                            আপনার কাঙ্ক্ষিত বাসাবাড়ির মাসিক ভাড়া কত? <strong class="text-purple-400 text-lg" x-text="'৳' + (studentCount * 100).toLocaleString()"></strong>
                        </label>
                        <input type="range" min="50" max="1000" step="50" x-model="studentCount" 
                               class="w-full h-3 bg-white/10 rounded-lg appearance-none cursor-pointer accent-purple-500">
                    </div>

                    <!-- Calculated Savings Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left">
                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">💰 ব্রোকার/দালাল ফি সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-emerald-400 mt-1" x-text="'৳' + (studentCount * 50).toLocaleString() + ' বেঁচে যাবে'"></p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">⏱️ বাসা খোঁজার সময় সাশ্রয়</p>
                            <p class="text-xl sm:text-2xl font-black text-purple-400 mt-1">৮০% সময় বাঁচবে</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/5">
                            <p class="text-xs text-gray-400 font-medium">🏷️ Zengfy Rent ফি</p>
                            <p class="text-xl sm:text-2xl font-black text-white mt-1">মাত্র ৳৫০/সার্চ</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dedicated Zengfy Ecosystem Apps Showcase Section -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-purple-400 bg-purple-500/10 border border-purple-500/20 px-3.5 py-1 rounded-full">
                        Zengfy Ecosystem
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight mt-3">
                        🌐 Zengfy একাউন্ট দিয়ে এক জায়গায় পান ১৫টি নিস প্রফেশনাল অ্যাপ
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">একটিমাত্র একাউন্ট দিয়ে আপনার জীবন ও ব্যবসার সমস্ত অপারেটিং সিস্টেম নিয়ন্ত্রণ করুন।</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://rent.zengfy.test:7000' : 'https://rent.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-purple-500/40 flex flex-col items-center text-center transition-all group shadow-lg shadow-purple-500/10">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🔑</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Rent</h3>
                        <p class="text-[10px] text-purple-400 mt-1">Tenant & Radius Map</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://school.zengfy.test:7000' : 'https://school.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🏫</span>
                        <h3 class="text-xs font-bold text-white">Zengfy School</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Academic ERP</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://law.zengfy.test:7000' : 'https://law.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">⚖️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Law</h3>
                        <p class="text-[10px] text-gray-400 mt-1">VakilChamber & Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://pos.zengfy.test:7000' : 'https://pos.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-cyan-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛒</span>
                        <h3 class="text-xs font-bold text-white">Zengfy POS</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Retail & Inventory</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://social.zengfy.test:7000' : 'https://social.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🌐</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Social</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Verified Feed</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://ecommerce.zengfy.test:7000' : 'https://ecommerce.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🛍️</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Shop</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Online Store Engine</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://journal.zengfy.test:7000' : 'https://journal.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-slate-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">📰</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Journal</h3>
                        <p class="text-[10px] text-gray-400 mt-1">Publishing Vault</p>
                    </a>

                    <a href="{{ env('APP_ENV') === 'local' ? 'http://skill.zengfy.test:7000' : 'https://skill.zengfy.top' }}" class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-violet-500/50 flex flex-col items-center text-center transition-all group">
                        <span class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎓</span>
                        <h3 class="text-xs font-bold text-white">Zengfy Skill</h3>
                        <p class="text-[10px] text-gray-400 mt-1">LMS Platform</p>
                    </a>
                </div>
            </div>

            <!-- FAQs Section -->
            <div id="faq" class="mb-20 max-w-3xl mx-auto scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">❓ সচরাচর জিজ্ঞাসিত প্রশ্নাবলী</h2>
                </div>

                <div class="space-y-4 text-xs sm:text-sm">
                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">১. ৫-১০ কিমি রেডিয়াস ফিল্টার কীভাবে কাজ করে?</h3>
                        <p class="text-gray-300 leading-relaxed">আপনার বর্তমান জিও-লোকেশন অথবা সিলেক্ট করা ম্যানুয়াল লোকেশন ধরে ৫ বা ১০ কিমি বৃত্তাকার ব্যাসার্ধের ভেতরের সব ভেরিফাইড খালি বাসার তথ্য রিয়েল-টাইম ম্যাপে দেখায়।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">২. বাসা ভাড়ায় ভূয়া পোস্ট রোধে কী সিকিউরিটি আছে?</h3>
                        <p class="text-gray-300 leading-relaxed">বাড়িওয়ালা হিসেবে বিজ্ঞাপন পোস্ট দিতে হলে স্মার্ট ভেরিফাইড প্রপার্টি আইডি ও ডিজিটাল এনআইডি ভেরিফিকেশন সম্পন্ন করা বাধ্যতামূলক, ফলে কোনো ভূয়া দালাল চক্রান্ত তৈরি হতে পারবে না।</p>
                    </div>

                    <div class="p-5 rounded-2xl bg-[#121A29]/80 border border-white/10">
                        <h3 class="font-bold text-white mb-1">৩. কন্টাক্ট নম্বর পেতে কত টাকা লাগে?</h3>
                        <p class="text-gray-300 leading-relaxed">বাসা সন্ধানকারী হিসেবে মাত্র ৳৫০ ফি দিয়ে সরাসরি বাড়িতে যেয়ে বাসা পছন্দ করার জন্য ভেরিফাইড বাড়ির মালিকের সঙ্গে কল ও সরাসরি কন্টাক্ট টোকেন রিলিজ করা যায়।</p>
                    </div>
                </div>
            </div>
        @else
            <!-- Default Module View for other subdomains (pos, law, rent, hotel, ngo, civil, etc.) -->
            <div class="text-center max-w-4xl mx-auto mb-16 relative scroll-reveal opacity-0 translate-y-10">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] {{ $module['theme']['bg_glow'] }} rounded-full blur-[140px] pointer-events-none"></div>

                <span class="text-xs font-extrabold tracking-widest uppercase {{ $module['theme']['accent_text'] }} bg-white/5 border border-white/10 px-4 py-1.5 rounded-full relative z-10">
                    {{ $module['badge'] }}
                </span>

                <h1 class="text-3xl sm:text-6xl font-black mt-6 text-white tracking-tight leading-tight relative z-10">
                    {{ $module['name'] }} <br class="hidden sm:block"/>
                    <span class="bg-gradient-to-r {{ $module['theme']['primary'] }} bg-clip-text text-transparent">
                        {{ $module['tagline_bn'] ?? $module['tagline'] }}
                    </span>
                </h1>

                <p class="mt-6 text-gray-300 text-base sm:text-xl max-w-2xl mx-auto leading-relaxed font-normal relative z-10">
                    {{ $module['desc_bn'] ?? $module['desc'] }}
                </p>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                       class="w-full sm:w-auto px-8 py-4 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm sm:text-base shadow-xl shadow-blue-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <span>Launch {{ $module['name'] }} Portal</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

            <!-- Dynamic Features Grid for General Subdomains -->
            <div class="mb-20 scroll-reveal opacity-0 translate-y-10">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight">Core Module Features</h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">Everything you need to automate your operations seamlessly.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($module['features'] as $feature)
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 {{ $module['theme']['border_glow'] }} backdrop-blur-xl transition-all duration-300">
                            <div class="text-3xl mb-4">{{ $feature['icon'] }}</div>
                            <h3 class="text-lg font-bold text-white mb-2">{{ $feature['title_bn'] ?? $feature['title'] }}</h3>
                            <p class="text-xs text-gray-300 leading-relaxed">{{ $feature['desc_bn'] ?? $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dynamic Pricing Card Section for General Subdomains -->
            <div id="pricing" class="max-w-xl mx-auto mb-20 p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 backdrop-blur-xl text-center scroll-reveal opacity-0 translate-y-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-400">Transparent Pricing</span>
                <h2 class="text-3xl font-black text-white mt-2">{{ $module['name'] }} Rate</h2>

                <div class="my-6 p-6 rounded-2xl bg-white/5 border border-white/5">
                    <div class="flex items-baseline justify-center gap-1">
                        <span class="text-4xl font-black text-white">{{ $module['pricing']['amount'] }}</span>
                        <span class="text-xs text-gray-400">{{ $module['pricing']['period'] }}</span>
                    </div>
                    <p class="text-xs text-blue-300 mt-3 font-medium">✓ {{ $module['pricing']['highlight'] }}</p>
                </div>

                <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                   class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm shadow-lg shadow-blue-600/20 transition-all">
                    <span>Subscribe to {{ $module['name'] }}</span>
                    <span>→</span>
                </a>
            </div>
        @endif

    </main>

    <!-- Floating Direct WhatsApp Customer Support Widget -->
    @if(in_array($module['id'], ['school', 'law', 'pos', 'journal']))
        <a href="https://wa.me/8801700000000?text=Assalamu%20Alaikum,%20Zengfy%20Information"
           target="_blank"
           rel="noopener"
           aria-label="Direct WhatsApp Customer Support"
           class="fixed bottom-6 right-6 z-50 p-3.5 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white shadow-2xl shadow-emerald-600/50 border border-emerald-400/40 transition-all hover:scale-110 flex items-center gap-2 group">
            <span class="text-xl">💬</span>
            <span class="hidden group-hover:inline text-xs font-bold pr-1">হোয়াটসঅ্যাপ সাহায্য</span>
        </a>
    @endif

    <!-- Shared Footer -->
    <x-landing.footer />

    <!-- Lightweight Interactive Scroll Animation JS (IntersectionObserver) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.scroll-reveal').forEach(function (el) {
                observer.observe(el);
            });
        });
    </script>

</body>
</html>