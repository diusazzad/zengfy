<!-- resources/views/policy/workplace.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workplace Policy & Team Culture | Zengfy Inc.</title>
    <meta name="description" content="Our hybrid workplace model, culture of transparency, innovation, and digital sovereignty at Zengfy.">
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

    <!-- Main Container -->
    <main class="pt-28 pb-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-12 w-full flex-grow">
        
        <!-- Hero Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full inline-flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-ping"></span>
                {{ $header['tag'] }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black mt-4 text-white tracking-tight leading-tight">
                {{ $header['title_prefix'] }}<span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">{{ $header['title_highlight'] }}</span>{{ $header['title_suffix'] }}
            </h1>
            <p class="mt-4 text-gray-300 text-base sm:text-lg leading-relaxed">
                {{ $header['subtitle'] }}
            </p>
        </div>

        <!-- Workplace Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            @foreach($cards as $card)
                <div class="p-8 bg-[#121A29]/80 rounded-3xl border border-white/10 backdrop-blur-xl hover:border-blue-500/30 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-600/20 border border-blue-500/30 rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        {{ $card['icon'] }}
                    </div>
                    <h3 class="text-xl sm:text-2xl font-black text-white mb-3">{{ $card['title'] }}</h3>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        {{ $card['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Policy Content Sections -->
        <div class="space-y-8 mb-16">
            @foreach($sections as $section)
                <div class="p-8 rounded-3xl bg-[#121A29]/50 border border-white/5 backdrop-blur-sm">
                    <h2 class="text-xl sm:text-2xl font-black text-white mb-3 flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-gradient-to-b from-blue-500 to-indigo-600 rounded-full"></span>
                        {{ $section['title'] }}
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        {{ $section['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Hybrid Work & Careers CTA Card -->
        <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-r from-blue-600/20 via-indigo-600/20 to-purple-600/20 border border-blue-500/30 backdrop-blur-xl text-center relative overflow-hidden">
            <h2 class="text-2xl sm:text-3xl font-black text-white mb-3">{{ $cta['title'] }}</h2>
            <p class="text-xs sm:text-sm text-gray-300 max-w-xl mx-auto mb-6">
                {{ $cta['description'] }}
            </p>
            <a href="{{ route('company') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-sm shadow-xl shadow-blue-600/30 transition-all hover:scale-105 active:scale-95">
                {{ $cta['button_text'] }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </main>

    <!-- Footer -->
    <x-landing.footer />

</body>
</html>