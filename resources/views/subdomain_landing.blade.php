<!-- resources/views/subdomain_landing.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $module['name'] }} | Zengfy Ecosystem</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
          "description": "{{ $module['desc'] }}"
        },
        {
          "@type": "FAQPage",
          "@id": "{{ url()->current() }}/#faqpage",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is the pricing for {{ $module['name'] }}?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{ $module['name'] }} is {{ $module['pricing']['amount'] }} {{ $module['pricing']['period'] }}. {{ $module['pricing']['highlight'] }}"
              }
            },
            {
              "@type": "Question",
              "name": "How do I launch {{ $module['name'] }}?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Simply sign in with your NID-verified Zengfy Unified SSO account to access {{ $module['name'] }} instantly."
              }
            }
          ]
        }
      ]
    }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- Shared Header Navigation -->
    <x-landing.navbar />

    <!-- Main Body -->
    <main class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 w-full flex-grow">

        <!-- Dynamic Hero Section -->
        @if($module['id'] === 'founder')
            <!-- World-Class Founder & Systems Architect Dedicated Portfolio Layout -->
            <div class="max-w-5xl mx-auto mb-20 relative">
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

            </div>
        @else
            <!-- Standard Module Hero Section -->
            <div class="text-center max-w-4xl mx-auto mb-16 relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] {{ $module['theme']['bg_glow'] }} rounded-full blur-[140px] pointer-events-none"></div>

                <span class="text-xs font-extrabold tracking-widest uppercase {{ $module['theme']['accent_text'] }} bg-white/5 border border-white/10 px-4 py-1.5 rounded-full relative z-10">
                    {{ $module['badge'] }}
                </span>

                <h1 class="text-3xl sm:text-6xl font-black mt-6 text-white tracking-tight leading-tight relative z-10">
                    {{ $module['name'] }} <br class="hidden sm:block"/>
                    <span class="bg-gradient-to-r {{ $module['theme']['primary'] }} bg-clip-text text-transparent">
                        {{ $module['tagline'] }}
                    </span>
                </h1>

                <p class="mt-6 text-gray-300 text-base sm:text-xl max-w-2xl mx-auto leading-relaxed font-normal relative z-10">
                    {{ $module['desc'] }}
                </p>

                <!-- Action CTAs -->
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
                    <a href="{{ env('APP_ENV') === 'local' ? 'http://zengfy.test:7000/login' : 'https://zengfy.top/login' }}"
                       class="w-full sm:w-auto px-8 py-4 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm sm:text-base shadow-xl shadow-blue-600/30 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                        <span>Launch {{ $module['name'] }} Portal</span>
                        <span>→</span>
                    </a>
                    <a href="#pricing"
                       class="w-full sm:w-auto px-8 py-4 rounded-full bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-sm sm:text-base backdrop-blur-md transition-all">
                        View Pricing ({{ $module['pricing']['amount'] }})
                    </a>
                </div>
            </div>
        @endif

        @if($module['id'] === 'founder')
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
        @else
            <!-- Dynamic Features Grid -->
            <div class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-2xl sm:text-4xl font-black text-white tracking-tight">Core Module Features</h2>
                    <p class="text-xs sm:text-sm text-gray-400 mt-2">Everything you need to automate your operations seamlessly.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($module['features'] as $feature)
                        <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 {{ $module['theme']['border_glow'] }} backdrop-blur-xl transition-all duration-300">
                            <div class="text-3xl mb-4">{{ $feature['icon'] }}</div>
                            <h3 class="text-lg font-bold text-white mb-2">{{ $feature['title'] }}</h3>
                            <p class="text-xs text-gray-300 leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Dynamic Pricing Card Section -->
            <div id="pricing" class="max-w-xl mx-auto mb-20 p-8 rounded-3xl bg-[#121A29]/80 border border-white/10 backdrop-blur-xl text-center">
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

    <!-- Shared Footer -->
    <x-landing.footer />

</body>
</html>
