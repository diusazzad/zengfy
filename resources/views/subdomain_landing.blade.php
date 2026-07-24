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
      "@type": "FAQPage",
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

    </main>

    <!-- Shared Footer -->
    <x-landing.footer />

</body>
</html>
