<x-layouts.landing>
    <x-slot name="title">Meet the Team | Zengfy</x-slot>

    <!-- Team Hero Section -->
    <section class="pt-32 pb-20 bg-gradient-to-b from-gray-50 to-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 sm:px-10 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100/50 rounded-full text-blue-700 font-bold text-xs mb-8 uppercase tracking-widest animate-fade-in">
                🚀 The Visionaries
            </div>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-gray-900 leading-tight mb-8 font-sans">
                Meet the minds behind <span class="text-blue-600">Zengfy</span>
            </h1>
            <p class="text-xl text-gray-600 font-medium leading-relaxed max-w-2xl mx-auto">
                We are a team of dreamers, builders, and innovators dedicated to redefining how the world does business
                and connects socially.
            </p>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-8 sm:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 max-w-5xl mx-auto">
                @foreach($team as $member)
                    <div class="group relative animate-fade-in-up" style="animation-delay: {{ $loop->index * 150 }}ms">
                        <!-- Card Background Glow -->
                        <div
                            class="absolute -inset-1 bg-gradient-to-r {{ $member['gradient'] }} rounded-[3rem] blur opacity-10 group-hover:opacity-30 transition duration-1000 group-hover:duration-200">
                        </div>

                        <div
                            class="relative bg-white p-8 sm:p-12 rounded-[3rem] border border-gray-100 shadow-xl shadow-blue-900/5 flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-2">
                            <!-- Profile Image Container -->
                            <div class="relative mb-8">
                                <div
                                    class="w-40 h-40 rounded-[2.5rem] bg-gradient-to-br {{ $member['gradient'] }} p-1 overflow-hidden shadow-2xl shadow-blue-900/20 transform group-hover:rotate-3 transition-transform duration-500">
                                    <div
                                        class="w-full h-full bg-white rounded-[2.3rem] flex items-center justify-center text-5xl bg-opacity-90 backdrop-blur-xl overflow-hidden">
                                        @if(isset($member['image']) && $member['image'])
                                            <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            👤
                                        @endif
                                    </div>
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-12 h-12 bg-white rounded-2xl shadow-lg border border-gray-50 flex items-center justify-center text-xl animate-bounce">
                                    ✨
                                </div>
                            </div>

                            <h3 class="text-3xl font-black text-gray-900 mb-2">{{ $member['name'] }}</h3>
                            <div
                                class="text-blue-600 font-black tracking-widest uppercase text-xs mb-6 px-4 py-1.5 bg-blue-50 rounded-full">
                                {{ $member['role'] }}
                            </div>
                            <p class="text-gray-500 font-medium leading-relaxed mb-8">
                                {{ $member['bio'] }}
                            </p>

                            <!-- Social Links -->
                            <div class="flex items-center gap-4">
                                <a href="{{ $member['linkedin'] }}" target="_blank"
                                    class="w-12 h-12 bg-gray-50 hover:bg-blue-600 hover:text-white rounded-2xl flex items-center justify-center text-gray-400 transition-all shadow-sm border border-gray-100">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                    </svg>
                                </a>
                                <a href="{{ $member['twitter'] }}"
                                    class="w-12 h-12 bg-gray-50 hover:bg-black hover:text-white rounded-2xl flex items-center justify-center text-gray-400 transition-all shadow-sm border border-gray-100">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Join the Team CTA -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-8 sm:px-10">
            <div
                class="bg-blue-600 rounded-[3rem] p-10 sm:p-20 text-center text-white relative overflow-hidden shadow-2xl shadow-blue-600/30">
                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-black mb-6">Want to make history with us?</h2>
                    <p class="text-blue-100 text-lg sm:text-xl font-medium mb-12 max-w-2xl mx-auto">
                        We are looking for exceptional talent to join our mission of building the world's first unified
                        social business ecosystem.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="mailto:careers@zengfy.top"
                            class="px-10 py-5 bg-white text-blue-600 rounded-2xl font-black text-lg hover:bg-blue-50 transition-all transform hover:scale-105 active:scale-95 shadow-xl">
                            Join the Team
                        </a>
                        <a href="#"
                            class="px-10 py-5 bg-blue-700 text-white rounded-2xl font-black text-lg hover:bg-blue-800 transition-all">
                            View Openings
                        </a>
                    </div>
                </div>
                <!-- Abstract 3D Shapes -->
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-64 h-64 bg-blue-400/20 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl">
                </div>
            </div>
        </div>
    </section>
</x-layouts.landing>