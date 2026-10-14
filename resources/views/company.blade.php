<!-- resources/views/company.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Company, Vision & Leadership Team | Zengfy Inc.</title>
    <meta name="description" content="Meet the visionary team behind Zengfy Inc. — building Bangladesh's first sovereign digital operating ecosystem.">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- Header Navigation -->
    <x-landing.navbar />

    <!-- Main Body Container -->
    <main class="pt-28 pb-24 w-full flex-grow">
        
        <!-- Company Hero Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 text-center mb-20 relative">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[140px] pointer-events-none"></div>

            <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full relative z-10">
                About Zengfy Inc.
            </span>

            <h1 class="text-3xl sm:text-6xl font-black mt-6 text-white tracking-tight leading-tight max-w-4xl mx-auto relative z-10">
                Engineered for <br class="hidden sm:block"/>
                <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                    Digital Sovereignty in Bangladesh.
                </span>
            </h1>

            <p class="mt-6 text-gray-300 text-base sm:text-xl max-w-3xl mx-auto leading-relaxed font-normal relative z-10">
                Zengfy Inc. is a next-generation technology company building Bangladesh’s unified digital infrastructure — seamlessly connecting schools, retail businesses, legal firms, and social communities under one secure NID-verified identity.
            </p>
        </section>

        <!-- Company Mission & Core Values Grid -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 mb-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center mb-16">
                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/70 border border-white/10 backdrop-blur-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-400">Our Mission</span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white mt-2 tracking-tight">Empowering 170M+ Lives with One Sovereign Identity</h2>
                    <p class="text-gray-300 text-sm sm:text-base mt-4 leading-relaxed">
                        We believe individuals and institutions deserve software that works together effortlessly. By integrating National ID verification with Single Sign-On (SSO), Zengfy eliminates digital fraud, password fatigue, and disconnected software silos.
                    </p>
                </div>

                <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/70 border border-white/10 backdrop-blur-xl">
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-400">Our Vision</span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white mt-2 tracking-tight">The Operating System of Modern Bangladesh</h2>
                    <p class="text-gray-300 text-sm sm:text-base mt-4 leading-relaxed">
                        From a classroom in Chittagong to a legal firm in Dhaka or a retail shop in Sylhet, Zengfy provides enterprise-grade cloud tools that level the playing field for every citizen and business owner.
                    </p>
                </div>
            </div>

            <!-- 4 Pillars of Company Values -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-blue-500/30 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 text-2xl mb-4">
                        🛡️
                    </div>
                    <h3 class="text-lg font-bold text-white">NID Accountability</h3>
                    <p class="text-xs text-gray-300 mt-2 leading-relaxed">Zero fake profiles or spam. Real verified identities build authentic trust across our ecosystem.</p>
                </div>

                <div class="p-6 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-indigo-500/30 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 text-2xl mb-4">
                        🔒
                    </div>
                    <h3 class="text-lg font-bold text-white">256-Bit Cloud Vault</h3>
                    <p class="text-xs text-gray-300 mt-2 leading-relaxed">End-to-end encrypted databases safeguarding institutional financial records and legal files.</p>
                </div>

                <div class="p-6 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-cyan-500/30 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 text-2xl mb-4">
                        ⚡
                    </div>
                    <h3 class="text-lg font-bold text-white">99.9% Uptime SLA</h3>
                    <p class="text-xs text-gray-300 mt-2 leading-relaxed">High-availability modular cloud infrastructure engineered for lightning-fast response times.</p>
                </div>

                <div class="p-6 rounded-2xl bg-white/[0.02] border border-white/10 hover:border-green-500/30 transition-all">
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center text-green-400 text-2xl mb-4">
                        🤝
                    </div>
                    <h3 class="text-lg font-bold text-white">Open & Transparent</h3>
                    <p class="text-xs text-gray-300 mt-2 leading-relaxed">Simple pricing with no hidden costs, clear privacy policies, and dedicated local customer care.</p>
                </div>
            </div>
        </section>

        <!-- DEDICATED TEAM SECTION (Our Leadership & Engineers) -->
        <section id="team" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 mb-24 border-t border-white/10 pt-20">
            <div class="text-center mb-16">
                <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                    The Minds Behind Zengfy
                </span>
                <h2 class="text-3xl sm:text-5xl font-black mt-4 text-white tracking-tight">
                    Meet Our Leadership & Engineering Team
                </h2>
                <p class="text-gray-300 text-base sm:text-lg max-w-2xl mx-auto mt-3">
                    A passionate group of software architects, product designers, and security engineers dedicated to transforming digital infrastructure.
                </p>
            </div>

            <!-- Team Members Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($teamMembers as $member)
                    <div class="group p-6 rounded-3xl bg-[#121A29]/70 border {{ str_contains($member['name'], 'Sazzad') ? 'border-blue-500/40 bg-gradient-to-b from-[#162238] to-[#121A29] shadow-xl shadow-blue-600/10' : 'border-white/10 hover:border-blue-500/50' }} hover:bg-[#121A29] backdrop-blur-xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                        
                        @if(str_contains($member['name'], 'Sazzad'))
                            <div class="absolute -top-3 -right-3 px-3.5 py-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-[9px] font-black uppercase tracking-wider rounded-bl-xl shadow-md">
                                Founder & CEO
                            </div>
                        @endif

                        <div>
                            <!-- Avatar / Initials Badge -->
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-400 flex items-center justify-center text-white font-black text-2xl mb-6 shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform">
                                {{ $member['initials'] }}
                            </div>

                            <!-- Role Badge -->
                            <span class="text-[10px] font-extrabold uppercase px-3 py-1 bg-blue-500/10 text-blue-300 rounded-full border border-blue-500/20">
                                {{ $member['badge'] }}
                            </span>

                            <!-- Member Name & Role -->
                            <h3 class="text-xl font-black text-white mt-3 tracking-tight group-hover:text-blue-400 transition-colors">
                                {{ $member['name'] }}
                            </h3>
                            <p class="text-xs font-semibold text-blue-300 mt-1">
                                {{ $member['role'] }}
                            </p>

                            <!-- Bio -->
                            <p class="text-xs text-gray-300 mt-4 leading-relaxed font-normal">
                                {{ $member['bio'] }}
                            </p>
                        </div>

                        <!-- Social Link & Founder Portfolio CTA -->
                        <div class="mt-6 pt-4 border-t border-white/10 flex flex-wrap items-center justify-between gap-2">
                            <div class="flex items-center gap-3">
                                @if(isset($member['social']['linkedin']))
                                    <a href="{{ $member['social']['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-400 text-xs font-semibold flex items-center gap-1 transition-colors">
                                        <span>LinkedIn</span> →
                                    </a>
                                @endif
                                @if(isset($member['social']['github']))
                                    <a href="{{ $member['social']['github'] }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-400 text-xs font-semibold flex items-center gap-1 transition-colors">
                                        <span>GitHub</span> →
                                    </a>
                                @endif
                            </div>

                            @if(str_contains($member['name'], 'Sazzad'))
                                <a href="{{ env('APP_ENV') === 'local' ? 'http://founder.zengfy.top:7000' : 'https://founder.zengfy.top' }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="text-[11px] font-extrabold text-white bg-blue-600 hover:bg-blue-500 border border-blue-400/40 px-3.5 py-1.5 rounded-full transition-all hover:scale-105 shadow-md shadow-blue-600/30 flex items-center gap-1">
                                    <span>Founder Portfolio</span> 🚀
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Workplace Culture & Careers CTA Banner -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-blue-950/80 via-indigo-950/60 to-purple-950/80 border border-blue-500/30 text-center relative overflow-hidden">
                <div class="max-w-3xl mx-auto relative z-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-400">Join Our Mission</span>
                    <h2 class="text-2xl sm:text-4xl font-black text-white mt-3 tracking-tight">Want to Build the Future of Software with Us?</h2>
                    <p class="text-gray-300 text-sm sm:text-base mt-3 leading-relaxed">
                        We are constantly looking for talented engineers, designers, and problem solvers to join our hybrid team. Check out our workplace culture and open roles.
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('policy.workplace') }}" 
                           class="w-full sm:w-auto px-8 py-3.5 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm shadow-xl shadow-blue-600/30 transition-all">
                            View Workplace Policy & Openings
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <x-landing.footer />

</body>
</html>
