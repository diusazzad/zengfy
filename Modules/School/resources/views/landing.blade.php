<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy School | Smart Campus. Peaceful Parents. Zero Paper.</title>
    <meta name="description" content="Bangladesh's sovereign school, college and madrasah management platform. Smart RFID attendance, 1-click automated NCTB report cards, and transparent tuition fee collection.">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite Assets (React 19 Fast Refresh + Tailwind CSS) -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'Modules/School/resources/js/main.jsx'])
</head>
<body class="bg-[#F8FAFC] text-slate-900 antialiased selection:bg-emerald-600 selection:text-white min-h-screen">
    <!-- Accessible Skip to Main Content Link (WCAG 2.1 AA) -->
    <a href="#main-content" 
       class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-emerald-600 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white font-bold text-sm">
        Skip to main content / মূল তথ্যে যান
    </a>

    <!-- React 19 School Landing Application Mount Point -->
    <div id="react-school-landing-root" 
         data-initial-data="{{ json_encode($initialData ?? null, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
        <!-- Pre-hydration Semantic Main Landmark -->
        <main id="main-content" role="main" class="min-h-screen flex items-center justify-center bg-[#F8FAFC]">
            <div class="flex flex-col items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-600 via-teal-600 to-indigo-600 flex items-center justify-center font-black text-xl text-white shadow-xl shadow-emerald-500/25 animate-pulse">
                    🏫
                </div>
                <div class="text-sm font-bold text-slate-500">Loading Zengfy Sovereign School ERP...</div>
            </div>
        </main>
    </div>
</body>
</html>
