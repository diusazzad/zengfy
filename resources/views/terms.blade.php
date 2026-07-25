<!-- resources/views/terms.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms & Conditions & Enterprise Compliance | Zengfy Inc.</title>
    <meta name="description" content="Platform Terms of Service, Enterprise Identity Verification Rules, Data Privacy, and User Agreements for Zengfy Ecosystem.">
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
    <main class="pt-28 pb-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-12 w-full flex-grow">
        
        <!-- Hero Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                Legal & Governance
            </span>
            <h1 class="text-3xl sm:text-5xl font-black mt-4 text-white tracking-tight leading-tight">
                Terms of Service & <br class="hidden sm:block"/>
                <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                    Enterprise Compliance.
                </span>
            </h1>
            <p class="mt-4 text-gray-300 text-base sm:text-lg leading-relaxed">
                Please read these terms carefully before accessing or activating any sub-application suite in the Zengfy Unified Ecosystem.
            </p>
        </div>

        <!-- Policy Sections Cards -->
        <div class="space-y-6 mb-16">
            @foreach($termsSections as $section)
                <div class="p-6 sm:p-8 rounded-3xl bg-[#121A29]/70 border border-white/10 backdrop-blur-xl hover:border-blue-500/30 transition-all">
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight mb-3">
                        {{ $section['title'] }}
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-300 leading-relaxed font-normal">
                        {{ $section['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Privacy & Contact Note -->
        <div class="p-8 rounded-3xl bg-blue-600/10 border border-blue-500/20 text-center">
            <h3 class="text-lg font-bold text-white mb-2">Have Legal or Compliance Questions?</h3>
            <p class="text-xs sm:text-sm text-gray-300 max-w-xl mx-auto mb-4">
                Our legal and cyber-compliance team is dedicated to safeguarding Bangladeshi citizens and institutional privacy.
            </p>
            <a href="mailto:legal@zengfy.top" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs shadow-lg transition-all">
                Contact Legal Department (legal@zengfy.top)
            </a>
        </div>

    </main>

    <!-- Footer -->
    <x-landing.footer />

</body>
</html>
