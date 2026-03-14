<x-layouts.landing>
    <x-slot name="title">Workplace Policy | Zengfy</x-slot>

    <!-- Policy Header -->
    <section class="pt-32 pb-20 bg-gradient-to-b from-blue-50 to-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 sm:px-10">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100/50 rounded-full text-blue-700 font-bold text-xs mb-8 uppercase tracking-widest animate-fade-in">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                {{ $header['tag'] }}
            </div>
            <h1
                class="text-4xl sm:text-5xl md:text-6xl font-black text-gray-900 leading-tight mb-6 font-sans max-w-3xl">
                {{ $header['title_prefix'] }}<span class="text-blue-600">{{ $header['title_highlight'] }}</span>{{ $header['title_suffix'] }}
            </h1>
            <p class="text-xl text-gray-600 font-medium leading-relaxed max-w-2xl">
                {{ $header['subtitle'] }}
            </p>
        </div>
    </section>

    <!-- Policy Content -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-8 sm:px-10">
            <div class="prose prose-lg prose-blue max-w-none">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
                    @foreach($cards as $card)
                    <div
                        class="p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-500 group">
                        <div
                            class="w-14 h-14 {{ $card['bg_color'] }} rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg {{ $card['shadow_color'] }} group-hover:scale-110 transition-transform">
                            {{ $card['icon'] }}</div>
                        <h3 class="text-2xl font-black text-gray-900 mb-4">{{ $card['title'] }}</h3>
                        <p class="text-gray-600 font-medium leading-relaxed">
                            {{ $card['description'] }}
                        </p>
                    </div>
                    @endforeach
                </div>

                <div class="space-y-12 text-gray-700">
                    @foreach($sections as $section)
                    <div>
                        <h2 class="text-3xl font-black text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-1 h-10 bg-blue-600 rounded-full"></span>
                            {{ $section['title'] }}
                        </h2>
                        <p class="font-medium leading-relaxed">
                            {{ $section['description'] }}
                        </p>
                    </div>
                    @endforeach

                    <div
                        class="bg-blue-900 rounded-[3rem] p-10 sm:p-16 text-white relative overflow-hidden group shadow-2xl shadow-blue-900/40">
                        <div class="relative z-10 text-center">
                            <h2 class="text-3xl sm:text-4xl font-black mb-6">{{ $cta['title'] }}</h2>
                            <p class="text-blue-100 text-lg sm:text-xl font-medium mb-10 max-w-2xl mx-auto">
                                {{ $cta['description'] }}
                            </p>
                            <a href="{{ $cta['button_link'] }}"
                                class="inline-flex items-center gap-3 px-10 py-5 bg-white text-blue-900 rounded-2xl font-black text-lg hover:bg-blue-50 transition-all transform hover:scale-105 active:scale-95 shadow-xl">
                                {{ $cta['button_text'] }}
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-64 h-64 bg-blue-400/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layouts.landing>