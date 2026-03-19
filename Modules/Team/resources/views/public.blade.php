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
    <section class="py-24 bg-white dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-8 sm:px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10">
                @forelse($team as $member)
                    <div class="group relative flex flex-col bg-white dark:bg-gray-900 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-xl shadow-gray-200/40 dark:shadow-none overflow-hidden hover:-translate-y-2 transition-all duration-500">
                        <!-- Top Banner / Background -->
                        <div class="h-32 bg-gradient-to-br from-primary-500 to-primary-700 opacity-10 group-hover:opacity-20 transition-opacity"></div>
                        
                        <div class="px-8 pb-10 flex flex-col items-center -mt-16 text-center flex-grow">
                            <!-- Image -->
                            <div class="relative mb-6">
                                <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-white dark:border-gray-900 shadow-2xl transition-transform duration-500 group-hover:scale-105">
                                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center text-white shadow-lg border-2 border-white dark:border-gray-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-1 tracking-tight">{{ $member->name }}</h3>
                            <div class="text-primary-600 dark:text-primary-400 font-bold text-xs uppercase tracking-widest mb-4">
                                {{ $member->designation }}
                            </div>
                            
                            @if($member->bio)
                                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-8 line-clamp-3 group-hover:line-clamp-none transition-all duration-300">
                                    {{ $member->bio }}
                                </p>
                            @endif

                            <!-- Social Links -->
                            <div class="mt-auto flex items-center justify-center gap-3">
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-800 hover:bg-primary-600 dark:hover:bg-primary-600 text-gray-400 hover:text-white flex items-center justify-center transition-all border border-gray-100 dark:border-gray-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    </a>
                                @endif
                                
                                @if($member->twitter_url)
                                    <a href="{{ $member->twitter_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-800 hover:bg-sky-500 text-gray-400 hover:text-white flex items-center justify-center transition-all border border-gray-100 dark:border-gray-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                    </a>
                                @endif

                                @if($member->github_url)
                                    <a href="{{ $member->github_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-800 hover:bg-gray-900 dark:hover:bg-white dark:hover:text-black text-gray-400 hover:text-white flex items-center justify-center transition-all border border-gray-100 dark:border-gray-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                                    </a>
                                @endif

                                @if($member->facebook_url)
                                    <a href="{{ $member->facebook_url }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-gray-800 hover:bg-blue-600 text-gray-400 hover:text-white flex items-center justify-center transition-all border border-gray-100 dark:border-gray-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-gray-50 dark:bg-gray-900 rounded-[3rem] border border-dashed border-gray-200 dark:border-gray-800">
                        <div class="text-6xl mb-4">👥</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">বর্তমানে কোনো মেম্বার পাওয়া যায়নি।</h3>
                        <p class="text-gray-500">আমরা শীঘ্রই আমাদের টিমের নতুন মেম্বারদের তথ্য যোগ করবো।</p>
                    </div>
                @endforelse
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