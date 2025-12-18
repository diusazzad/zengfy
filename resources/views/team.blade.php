<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy | টীম</title>
    <meta name="description"
        content="Zengfy-এর টীমে যারা SaaS, ব্যবসা ও প্রযুক্তি নিয়ে কাজ করে। স্থানীয় টীমের সাথে পরিচিত হোন।">
    <meta name="robots" content="index, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { bn: ['"Noto Sans Bengali"', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            background: #f8fafc;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(24px);
            animation: fadeUp 0.6s ease forwards;
        }

        .fade-up:nth-child(1) {
            animation-delay: 0.1s;
        }

        .fade-up:nth-child(2) {
            animation-delay: 0.2s;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="text-gray-800 bg-slate-50 pb-16 md:pb-0" x-data="{ scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)">
    @php
        $team = [
            [
                'name' => 'Mahbub Hossain',
                'role_bn' => 'প্রতিষ্ঠাতা ও ব্যবসায়িক অপারেশনের প্রধান',
                'role_en' => 'Founder & Head of Business Operations',
                'location' => 'ঢাকা, বাংলাদেশ',
                'image' => asset('welcome/team/masum.png'),
                'linkedin' => 'https://www.linkedin.com/in/mhmahbub/',
                'twitter' => 'https://twitter.com/mhmahbub',
                'email' => 'mahbub@zengfy.top',
                'bio_bn' => 'Mahbub Zengfy-এর ব্যবসায়িক কৌশল, অংশীদারিত্ব ও কাস্টমার সাকসেস পরিচালনা করেন। স্থানীয় সম্পর্ক ও data-driven সিদ্ধান্ত প্ল্যাটফর্মকে নির্ভরযোগ্য রাখে।',
                'bio_en' => 'Mahbub steers Zengfy\'s business strategy, partnerships, and customer success. His focus on local relationships and data-driven decision making keeps the SaaS experience reliable and grounded in Bangladesh.',
            ],
            [
                'name' => 'Sazzad Hossain Mahim',
                'role_bn' => 'প্রধান প্রকৌশলী ও প্ল্যাটফর্ম আর্কিটেক্ট',
                'role_en' => 'Principal Engineer & Platform Architect',
                'location' => 'ঢাকা, বাংলাদেশ',
                'image' => asset('welcome/team/mahim.png'),
                'linkedin' => 'https://www.linkedin.com/in/sazzadmahim',
                'twitter' => 'https://twitter.com/sazzadmahim',
                'email' => 'mahim@zengfy.top',
                'bio_bn' => 'Sazzad Zengfy-এর SaaS আর্কিটেকচার ডিজাইন করেন। Laravel, Vue.js ও MySQL-এ অভিজ্ঞ তিনি ক্লাউড সিকিউরিটি ও স্কেলযোগ্য ডিজাইন বাস্তবায়ন করেন।',
                'bio_en' => 'Sazzad designs Zengfy\'s SaaS architecture. With deep experience in Laravel, Vue.js, and MySQL, he applies cloud security and scalable design practices that customers rely on every day.',
            ],
        ];
    @endphp

    <!-- Sticky Header using Alpine for state -->
    <header :class="{ 'bg-white/90 shadow-md backdrop-blur-md': scrolled, 'bg-white/50 backdrop-blur-sm': !scrolled }"
        class="fixed top-0 w-full z-50 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('welcome') }}"
                class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent transform hover:scale-105 transition duration-300">Zengfy</a>
            <nav class="flex flex-wrap items-center gap-6 text-sm font-medium">
                <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-blue-600 transition">হোম</a>
                <a href="{{ route('team') }}"
                    class="text-blue-600 relative after:content-[''] after:absolute after:bottom-[-4px] after:left-0 after:w-full after:h-0.5 after:bg-blue-600">টীম</a>
                <a href="{{ route('download.app') }}" class="text-gray-600 hover:text-blue-600 transition">অ্যাপ</a>
                <a href="{{ route('faq') }}" class="text-gray-600 hover:text-blue-600 transition">FAQ</a>
                <a href="{{ route('signup') }}"
                    class="bg-gray-900 text-white px-5 py-2 rounded-full shadow-lg hover:bg-gray-800 hover:shadow-xl transition transform hover:-translate-y-0.5">সাইন
                    আপ</a>
            </nav>
        </div>
    </header>

    <main class="pt-20">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-white">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-green-50 opacity-50"></div>
            <!-- Animated Background Blobs -->
            <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-blue-300/20 rounded-full blur-3xl animate-pulse">
            </div>
            <div class="absolute bottom-[-10%] left-[-5%] w-96 h-96 bg-green-300/20 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>

            <div class="relative max-w-6xl mx-auto px-4 py-20 lg:py-28 flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 space-y-8 animate-fade-in-up">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100/50 border border-blue-200 text-blue-700 text-sm font-medium">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                        Meet the Creators
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight text-gray-900">
                        SaaS for <br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-500">Bangladesh</span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-lg leading-relaxed">
                        আমরা ব্যবসার উপর ভিত্তি করে সিদ্ধান্ত নেই, লোকাল দলের সাহায্যে উন্নয়ন ও সাপোর্ট চালাই। আমরা গড়ছি
                        আগামীর ডিজিটাল বাংলাদেশ।
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('signup') }}"
                            class="bg-blue-600 text-white px-8 py-4 rounded-full font-bold shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:bg-blue-700 transition transform hover:-translate-y-1">যোগাযোগ
                            করুন</a>
                        <a href="#team-section"
                            class="group flex items-center gap-2 px-8 py-4 rounded-full border border-gray-300 text-gray-700 font-semibold hover:border-gray-400 hover:bg-gray-50 transition">
                            টীম দেখুন
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 transform group-hover:translate-y-1 transition" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="flex-1 w-full max-w-md" x-data="{ shown: false }" x-intersect="shown = true">
                    <div
                        class="bg-white/80 backdrop-blur-xl border border-white/50 p-8 rounded-[2rem] shadow-2xl relative overflow-hidden group hover:scale-[1.02] transition duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-green-500/5 transition opacity-0 group-hover:opacity-100">
                        </div>
                        <h3 class="text-gray-500 font-medium uppercase tracking-widest text-xs mb-6">IMPACT AT A GLANCE
                        </h3>

                        <div class="grid grid-cols-1 gap-8">
                            <div class="border-l-4 border-blue-500 pl-4">
                                <div class="text-5xl font-black text-gray-900 mb-1 flex items-baseline">
                                    <span x-data="{ count: 0 }"
                                        x-effect="if(shown) { let i = 0; const timer = setInterval(() => { count += 10; if(count >= 500) { count = 500; clearInterval(timer); } }, 20); }">
                                        <span x-text="count"></span>
                                    </span>+
                                </div>
                                <p class="text-gray-600 text-sm font-medium">Verified Businesses</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-4">
                                <div class="text-5xl font-black text-gray-900 mb-1 flex items-baseline">
                                    <span x-data="{ count: 0 }"
                                        x-effect="if(shown) { let i = 0; const timer = setInterval(() => { count += 1; if(count >= 24) { count = 24; clearInterval(timer); } }, 50); }">
                                        <span x-text="count"></span>
                                    </span>/7
                                </div>
                                <p class="text-gray-600 text-sm font-medium">Local Support</p>
                            </div>
                            <div class="border-l-4 border-purple-500 pl-4">
                                <div class="text-5xl font-black text-gray-900 mb-1 flex items-baseline">
                                    <span x-data="{ count: 0 }"
                                        x-effect="if(shown) { let i = 0; const timer = setInterval(() => { count += 2; if(count >= 99) { count = 99; clearInterval(timer); } }, 30); }">
                                        <span x-text="count"></span>
                                    </span>%
                                </div>
                                <p class="text-gray-600 text-sm font-medium">SLA Uptime</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tech Stack Marquee -->
        <div class="bg-gray-900 py-10 overflow-hidden relative">
            <div class="absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-gray-900 to-transparent z-10"></div>
            <div class="absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-gray-900 to-transparent z-10"></div>
            <div
                class="flex items-center gap-12 animate-marquee whitespace-nowrap opacity-50 text-white font-mono text-xl">
                <span>LARAVEL</span> <span>•</span> <span>VUE.JS</span> <span>•</span> <span>TAILWIND CSS</span>
                <span>•</span> <span>AWS</span> <span>•</span> <span>MYSQL</span> <span>•</span> <span>ALPINE.JS</span>
                <span>•</span> <span>REDIS</span> <span>•</span> <span>DOCKER</span> <span>•</span>
                <span>LARAVEL</span> <span>•</span> <span>VUE.JS</span> <span>•</span> <span>TAILWIND CSS</span>
                <span>•</span> <span>AWS</span> <span>•</span> <span>MYSQL</span> <span>•</span> <span>ALPINE.JS</span>
                <span>•</span> <span>REDIS</span> <span>•</span> <span>DOCKER</span>
            </div>
        </div>

        <!-- Values Section -->
        <section class="py-20 bg-slate-50">
            <div class="max-w-6xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900">আমাদের মূল্যবোধ</h2>
                    <p class="text-gray-600 mt-4 max-w-xl mx-auto">আমরা শুধুমাত্র সফটওয়্যার বানাই না, আমরা বিশ্বাস ও
                        ভরসা তৈরি করি।</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 group">
                        <div
                            class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition duration-300">
                            🛡️</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Trust First</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">আপনার ডাটার নিরাপত্তা আমাদের সর্বোচ্চ
                            অগ্রাধিকার। আমরা আন্তর্জাতিক মানের এনক্রিপশন ব্যবহার করি।</p>
                    </div>
                    <!-- Value 2 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 group">
                        <div
                            class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition duration-300">
                            🚀</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">আমরা প্রতিনিয়ত শিখি এবং নতুন প্রযুক্তি ব্যবহার
                            করি যাতে আপনার ব্যবসা থাকে সবার চেয়ে এগিয়ে।</p>
                    </div>
                    <!-- Value 3 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition duration-300 border border-gray-100 group">
                        <div
                            class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition duration-300">
                            🇧🇩</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Local at Heart</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">গ্লোবাল মানের প্রযুক্তি, কিন্তু লোকাল মার্কেটের
                            প্রয়োজন অনুযায়ী কাস্টমাইজড। আমরা দেশী ব্যবসার ধরণ বুঝি।</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section id="team-section" class="py-20 px-4 bg-white relative">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <p class="text-blue-600 font-semibold tracking-widest text-sm uppercase mb-3">Leadership</p>
                    <h2 class="text-4xl font-bold text-gray-900">Visionaries</h2>
                </div>

                <div class="grid gap-10 md:grid-cols-2 lg:gap-16">
                    @foreach ($team as $member)
                        <div class="group perspective">
                            <article
                                class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-500 transform hover:rotate-x-2 hover:shadow-2xl hover:-translate-y-2">
                                <div
                                    class="bg-gradient-to-br from-indigo-600 to-blue-500 p-8 text-white relative overflow-hidden">
                                    <div
                                        class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 w-24 h-24 bg-black/10 rounded-full -ml-10 -mb-10 blur-xl">
                                    </div>

                                    <div class="relative z-10 flex flex-col sm:flex-row items-center gap-6">
                                        <div class="w-24 h-24 rounded-full p-1 bg-white/20 backdrop-blur-sm">
                                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}"
                                                class="w-full h-full rounded-full object-cover border-2 border-white/50">
                                        </div>
                                        <div class="text-center sm:text-left">
                                            <h3 class="text-2xl font-bold">{{ $member['name'] }}</h3>
                                            <p class="text-blue-100 font-medium mt-1">{{ $member['role_en'] }}</p>
                                            <p class="text-xs text-blue-200 mt-1 uppercase tracking-wider">
                                                {{ $member['location'] }}</p>
                                        </div>
                                    </div>

                                    <!-- Social Links Reveal on Hover -->
                                    <div
                                        class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 translate-x-4 group-hover:translate-x-0">
                                        <a href="{{ $member['linkedin'] }}" target="_blank"
                                            class="bg-white/20 p-2 rounded-full hover:bg-white/40 transition backdrop-blur-md text-white">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                            </svg>
                                        </a>
                                        <a href="mailto:{{ $member['email'] }}"
                                            class="bg-white/20 p-2 rounded-full hover:bg-white/40 transition backdrop-blur-md text-white">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-8 space-y-6">
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Bangla
                                            Bio</h4>
                                        <p class="text-gray-700 leading-relaxed">{{ $member['bio_bn'] }}</p>
                                    </div>
                                    <div class="pt-6 border-t border-gray-100">
                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">English
                                            Bio</h4>
                                        <p class="text-gray-500 text-sm leading-relaxed italic">"{{ $member['bio_en'] }}"
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div
                    class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-12 shadow-2xl relative overflow-hidden text-white">
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10 space-y-6">
                        <h2 class="text-3xl md:text-4xl font-bold">Ready to modernize your business?</h2>
                        <p class="text-blue-100 text-lg max-w-2xl mx-auto">Join hundreds of Bangladeshi businesses using
                            Zengfy to scale efficiently.</p>
                        <div class="flex flex-wrap justify-center gap-4 pt-4">
                            <a href="{{ route('signup') }}"
                                class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition shadow-lg">Get
                                Started Free</a>
                            <a href="mailto:team@zengfy.top"
                                class="border border-white/30 text-white px-8 py-3 rounded-full font-semibold hover:bg-white/10 transition">Contact
                                Sales</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 border-t border-gray-800 text-gray-400 py-12">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <h4 class="text-white text-xl font-bold mb-2">Zengfy</h4>
                <p class="text-sm">Unified SaaS Platform for Bangladesh.</p>
            </div>
            <div class="flex gap-6 text-sm font-medium">
                <a href="{{ route('welcome') }}" class="hover:text-white transition">Home</a>
                <a href="{{ route('team') }}" class="hover:text-white transition">Team</a>
                <a href="{{ route('download.app') }}" class="hover:text-white transition">Mobile App</a>
                <a href="{{ route('faq') }}" class="hover:text-white transition">Help Center</a>
            </div>
            <div class="text-xs text-gray-600">
                &copy; {{ date('Y') }} All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Alpine.js Intersect Plugin (Simulated for this snippet if not loaded, usually needed for scroll spy) -->
    <!-- Ideally, users should have Alpine loaded with Intersect plugin in their layout or here -->
    <x-mobile-nav />
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        .animate-marquee {
            animation: marquee 25s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .perspective {
            perspective: 1000px;
        }

        .rotate-x-2 {
            transform: rotateX(2deg);
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>

</html>