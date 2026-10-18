<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy Marketplace | দারাজের বিকল্প প্রতারণাহীন কেনাকাটা ও জিরো রিটার্ন লস</title>
    <meta name="description" content="বাংলাদেশের প্রথম NID-ভেরিফাইড অ্যান্টি-ফ্রড মাল্টি-ভেন্ডর মার্কেটপ্লেস। দারাজের চেয়ে ৫০% কম কমিশন, জিরো রিটার্ন লস এবং ২৪ ঘণ্টার মধ্যে এক্সপ্রেস ডেলিভারি।">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite Assets (React 19 Fast Refresh + Tailwind CSS) -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'Modules/Ecommerce/resources/js/main.jsx'])
</head>
<body class="bg-[#F8FAFC] text-slate-900 antialiased selection:bg-[#7C3AED] selection:text-white min-h-screen">
    <!-- Accessible Skip to Main Content Link (WCAG 2.1 AA) -->
    <a href="#main-content" 
       class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-[#7C3AED] focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-purple-300 font-bold text-sm">
        Skip to main content / মূল তথ্যে যান
    </a>

    <!-- React 19 Ecommerce Marketplace Mount Point -->
    <div id="react-ecommerce-marketplace-root" 
         data-initial-data="{{ json_encode($initialData ?? null, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
        <!-- Pre-hydration Semantic Main Landmark (Simple & Clean) -->`n        <main id="main-content" role="main" class="min-h-screen">`n        </main>
    </div>
</body>
</html>
