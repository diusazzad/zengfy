<!-- resources/views/pricing.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transparent Ecosystem Pricing | Zengfy</title>
    <meta name="description" content="Simple, transparent pricing for Zengfy School, POS, Law, Rent, Hotel, and Civil suites in Bangladesh.">
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
    <main class="pt-28 pb-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 w-full flex-grow">
        
        <!-- Hero Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-blue-400 font-extrabold tracking-widest uppercase text-xs bg-blue-500/10 border border-blue-500/20 px-4 py-1.5 rounded-full">
                Transparent Local Pricing
            </span>
            <h1 class="text-3xl sm:text-5xl font-black mt-4 text-white tracking-tight leading-tight">
                Simple, Honest Rates. <br class="hidden sm:block"/>
                <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400 bg-clip-text text-transparent">
                    No Hidden Fees.
                </span>
            </h1>
            <p class="mt-4 text-gray-300 text-base sm:text-lg leading-relaxed">
                Pay per active module with native support for bKash, Nagad, Rocket, and local debit/credit cards.
            </p>
        </div>

        <!-- Ecosystem Pricing Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($products as $product)
                <div class="group relative rounded-3xl p-6 sm:p-8 bg-[#121A29]/70 border border-white/10 hover:border-blue-500/50 hover:bg-[#121A29] backdrop-blur-xl transition-all duration-300 flex flex-col justify-between">
                    
                    <div>
                        <!-- Badge & Icon -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-blue-600 transition-all duration-300">
                                {{ $product['icon'] }}
                            </div>
                            <span class="text-xs font-bold px-3 py-1 bg-blue-500/10 text-blue-300 rounded-full border border-blue-500/20">
                                {{ $product['pricing']['badge'] }}
                            </span>
                        </div>

                        <!-- Product Name -->
                        <h2 class="text-2xl font-black text-white tracking-tight group-hover:text-blue-400 transition-colors">
                            {{ $product['name'] }}
                        </h2>
                        <p class="text-xs font-semibold text-gray-300 mt-1 uppercase tracking-wider">
                            {{ $product['category'] }}
                        </p>

                        <!-- Price Tag -->
                        <div class="mt-6 p-4 rounded-2xl bg-white/5 border border-white/5">
                            <div class="flex items-baseline gap-1">
                                <span class="text-3xl font-black text-white tracking-tight">
                                    {{ $product['pricing']['amount'] }}
                                </span>
                                <span class="text-xs text-gray-400 font-medium">
                                    {{ $product['pricing']['period'] }}
                                </span>
                            </div>
                            <p class="text-xs text-blue-300 mt-2 font-medium">
                                ✓ {{ $product['pricing']['highlight'] }}
                            </p>
                        </div>

                        <!-- Features Summary -->
                        <p class="text-xs sm:text-sm text-gray-300 mt-4 leading-relaxed font-normal">
                            {{ $product['desc'] }}
                        </p>
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-8 pt-5 border-t border-white/10">
                        <a href="{{ $product['url'] }}" target="_blank" 
                           class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm shadow-lg shadow-blue-600/20 transition-all active:scale-95">
                            <span>Get Started with {{ $product['name'] }}</span>
                            <span>→</span>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Local Payment Gateways Strip -->
        <div class="mt-16 p-8 rounded-3xl bg-[#121A29]/40 border border-white/10 text-center">
            <h3 class="text-sm uppercase font-extrabold tracking-widest text-blue-400 mb-4">Supported Payment Methods</h3>
            <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-sm font-bold text-gray-300">
                <span class="px-4 py-2 bg-white/5 rounded-xl border border-white/10 text-pink-400">bKash</span>
                <span class="px-4 py-2 bg-white/5 rounded-xl border border-white/10 text-orange-400">Nagad</span>
                <span class="px-4 py-2 bg-white/5 rounded-xl border border-white/10 text-purple-400">Rocket</span>
                <span class="px-4 py-2 bg-white/5 rounded-xl border border-white/10 text-blue-400">Visa / Mastercard</span>
                <span class="px-4 py-2 bg-white/5 rounded-xl border border-white/10 text-green-400">Local Bank Transfer</span>
            </div>
        </div>

    </main>

    <!-- Pre-Footer CTA -->
    <x-landing.cta />

    <!-- Footer -->
    <x-landing.footer />

</body>
</html>
