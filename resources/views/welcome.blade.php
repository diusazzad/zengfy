<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy — বাংলাদেশের ইউনিফাইড SaaS প্ল্যাটফর্ম</title>
    <meta name="description"
        content="একক প্ল্যাটফর্মে ই-কমার্স, ERP, POS, হোটেল ও AI-চালিত ওয়ার্কফ্লো গড়ে তোলার জন্য Zengfy। বাংলা UI, বিকাশ/নগদ ও ত্বরান্বিত অনবোর্ডিং।">
    <meta name="author" content="Zengfy Team">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0f172a">
    <meta name="format-detection" content="telephone=no">
    <link rel="canonical" href="{{ url('/') }}">
    <meta property="og:title" content="Zengfy — বাংলাদেশের ইউনিফাইড SaaS প্ল্যাটফর্ম">
    <meta property="og:description"
        content="ই-কমার্স, স্কুল ERP, POS, হোটেল পরিচালনা ও AI অটোমেশন — একটি অ্যাকাউন্টে। বাংলা ইন্টারফেস, লোকাল পেমেন্ট ও স্ট্রং সাপোর্ট।">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Zengfy">
    <meta property="og:locale" content="bn_BD">
    <meta property="og:image"
        content="https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=600&amp;q=80">
    <meta property="og:image:alt" content="Zengfy SaaS platform screen">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Zengfy — বাংলার ব্যবসার SaaS সমাধান">
    <meta name="twitter:description"
        content="একটি একক অ্যাকাউন্টে ERP, POS, হোটেল ও AI-চালিত কার্যক্রম। বিকাশ/নগদ, বাংলা UI ও দ্রুত অনবোর্ডিং।">
    <meta name="twitter:image"
        content="https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=600&amp;q=80">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        bn: ['"Noto Sans Bengali"', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            padding-bottom: 70px;
        }

        .fixed-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
            text-decoration: none;
            color: #4B5563;
            transition: all 0.3s ease;
        }

        .nav-item.active {
            color: #2563EB;
        }

        .nav-item:hover {
            color: #2563EB;
        }

        .nav-icon {
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .nav-text {
            font-size: 0.75rem;
        }

        @media (min-width: 769px) {
            .fixed-navbar {
                display: none;
            }

            body {
                padding-bottom: 0;
            }
        }

        .desktop-nav {
            display: none;
        }

        @media (min-width: 769px) {
            .desktop-nav {
                display: flex;
            }
        }

        .service-card {
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    <!-- Desktop Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40 desktop-nav">
        <div class="max-w-6xl mx-auto w-full px-4 py-3 flex flex-wrap items-center justify-between gap-4">
            <a href="/" class="text-2xl font-extrabold text-blue-600">Zengfy</a>
            <nav class="flex flex-wrap items-center gap-3 text-sm sm:text-base" role="navigation" aria-label="Primary navigation">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600" aria-current="page">হোম</a>
                <a href="{{ route('team') }}" class="hover:text-blue-600">টীম</a>
                <a href="{{ route('faq') }}" class="hover:text-blue-600">FAQ</a>
                <a href="{{ route('download.app') }}" class="hover:text-blue-600">Download App</a>
                <a href="{{ route('signup') }}"
                    class="bg-yellow-400 text-gray-900 px-4 py-2 rounded font-semibold hover:bg-yellow-300 transition">সাইন আপ</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
    <section id="hero" aria-labelledby="hero-title" class="bg-gradient-to-tr from-blue-600 to-green-500 text-white pt-8 pb-16">
        <div class="max-w-6xl mx-auto px-4 flex flex-col lg:flex-row items-center gap-12">
            <div class="flex-1">
                <p class="text-sm uppercase tracking-[0.3em] text-white/70 mb-2">Zengfy</p>
                <h1 id="hero-title" class="text-4xl sm:text-5xl font-extrabold mb-4">বাংলাদেশের জন্য নির্মিত ইউনিফাইড SaaS</h1>
                <p class="mb-6 text-lg text-white/90">ই-কমার্স, স্কুল ERP, POS, হোটেল ও AI অটোমেশন একসঙ্গে এনালিটিক্স,
                    লোকাল পেমেন্ট ও বাংলা UI-সহ। দ্রুত অনবোর্ডিং, ২৪/৭ সাপোর্ট ও সর্বোচ্চ সিকিউরিটি ফোকাসের উপর নির্মিত।</p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('signup') }}"
                        class="px-5 py-3 bg-yellow-400 text-gray-900 rounded font-semibold shadow hover:bg-yellow-300 transition"
                        aria-label="Zengfy SaaS সাইন আপ">এখনই সাইন আপ</a>
                    <a href="{{ route('download.app') }}"
                        class="px-5 py-3 border border-white/60 rounded font-semibold hover:border-white hover:text-white transition"
                        aria-label="Zengfy অ্যাপ ডাউনলোড করুন">অ্যাপ ডাউনলোড</a>
                </div>
                <ul class="space-y-2 text-white/90 text-sm">
                    <li>• ই-কমার্স, ERP, POS, হোটেল, রেন্টাল ও AI ওয়ার্কফ্লো এক প্ল্যাটফর্মে</li>
                    <li>• নিরাপদ ডেটা, ব্যাকআপ, এবং বিকাশ/নগদ নিয়ে দ্রুত লেনদেন</li>
                    <li>• স্থানীয় টিম, অনলাইন ট্রেনিং ও Pro-গ্রেড সাপোর্ট</li>
                </ul>
            </div>

            <div class="flex-1 flex justify-center">
                <div
                    class="bg-white/10 backdrop-blur rounded-2xl p-6 shadow-2xl w-full max-w-md border border-white/20">
                    <img loading="lazy" referrerpolicy="no-referrer"
                        src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=600&q=80"
                        alt="Zengfy Platform" class="rounded-xl w-full h-auto border border-white/10 shadow-lg">
                    <div class="mt-4 space-y-1 text-sm text-white/80">
                        <p class="font-semibold text-white">৫০০+ Verified ব্যবসা</p>
                        <p>২৪/৭ লোকাল সাপোর্ট ও রিয়েল-টাইম ড্যাশবোর্ড</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" aria-labelledby="services-title" class="max-w-6xl mx-auto px-4 py-12">
        <p class="text-center text-sm uppercase tracking-[0.4em] text-gray-400 mb-2">service matrix</p>
        <h2 id="services-title" class="text-3xl font-bold text-center mb-4 text-blue-600">আমাদের সার্ভিসসমূহ</h2>
        <p class="text-center text-gray-600 mb-8 max-w-3xl mx-auto">ইন্টারনেট ব্যবসা, স্কুল, হোটেল কিংবা রিটেইল—Zengfy আপনাকে এক প্ল্যাটফর্মে ধারণ করে
            অর্ডার, পেমেন্ট, রিজার্ভেশন, সফটওয়্যার অটোমেশন ও লোকাল সাপোর্টের ব্যালেন্স রেখে দেয়।</p>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <a href="/services/ecommerce" class="block service-card" aria-label="ই-কমার্স SaaS সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🛒</div>
                    <div class="font-semibold">ই-কমার্স SaaS</div>
                    <div class="text-sm text-gray-600 mt-2">অর্ডার, পেমেন্ট, ডেলিভারি অটোমেশন</div>
                </div>
            </a>

            <a href="/services/school" class="block service-card" aria-label="স্কুল ERP সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🎓</div>
                    <div class="font-semibold">স্কুল ERP</div>
                    <div class="text-sm text-gray-600 mt-2">ফি, অ্যাটেনডেন্স, রেজাল্ট, হোস্টেল</div>
                </div>
            </a>

            <a href="/services/workshop" class="block service-card" aria-label="Video ও Editing Workshop">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-2xl mb-1">🎥</div>
                    <div class="font-semibold text-base">Video & Editing Workshop</div>
                    <div class="text-xs text-gray-600 mt-1">Creative skills, practical hands-on training</div>
                </div>
            </a>

            <a href="/services/pos" class="block service-card" aria-label="POS সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">💳</div>
                    <div class="font-semibold">POS</div>
                    <div class="text-sm text-gray-600 mt-2">ইনভেন্টরি, লেনদেন, AI রিপোর্টিং</div>
                </div>
            </a>

            <a href="/services/roomrental" class="block service-card" aria-label="Rent a House সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🏘️</div>
                    <div class="font-semibold">Rent a House</div>
                    <div class="text-sm text-gray-600 mt-2">বাসা খোঁজ, বুকিং ও পেমেন্ট ট্র্যাকিং</div>
                </div>
            </a>

            <a href="/services/hotel" class="block service-card" aria-label="হোটেল ম্যানেজমেন্ট সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🏨</div>
                    <div class="font-semibold">হোটেল</div>
                    <div class="text-sm text-gray-600 mt-2">ডেইলি লেনদেন, রিপোর্ট ও রিজার্ভেশন</div>
                </div>
            </a>

            <a href="/services/watch" class="block service-card" aria-label="ওয়াচ স্টোর সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">⌚</div>
                    <div class="font-semibold">ওয়াচ স্টোর</div>
                    <div class="text-sm text-gray-600 mt-2">ব্র্যান্ড এবং প্রিমিয়াম স্টক ম্যানেজমেন্ট</div>
                </div>
            </a>

            <a href="/services/journalism" class="block service-card" aria-label="জার্নাল সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">📰</div>
                    <div class="font-semibold">জার্নাল</div>
                    <div class="text-sm text-gray-600 mt-2">কনটেন্ট পাবলিশ ও সাবস্ক্রিপশন মডেল</div>
                </div>
            </a>

            <a href="/services/wellness" class="block service-card" aria-label="হ্যাবিট ও ওয়েলনেস সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">📈</div>
                    <div class="font-semibold">হ্যাবিট</div>
                    <div class="text-sm text-gray-600 mt-2">অভ্যাস অ্যানালাইসিস ও পারফরম্যান্স টুলস</div>
                </div>
            </a>

            <a href="/services/aiflow" class="block service-card" aria-label="AI ক্যালেন্ডার সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🤖</div>
                    <div class="font-semibold">AI ক্যালেন্ডার</div>
                    <div class="text-sm text-gray-600 mt-2">ইমেইল ও SMS শিডিউল, স্মার্ট রিমাইন্ডার</div>
                </div>
            </a>

            <a href="/services/civil" class="block service-card" aria-label="সিভিল সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🏗️</div>
                    <div class="font-semibold">সিভিল</div>
                    <div class="text-sm text-gray-600 mt-2">প্রজেক্ট, ইনভেন্টরি ও সাপ্লাই চেইন</div>
                </div>
            </a>

            <a href="/services/legal" class="block service-card" aria-label="লিগ্যাল সার্ভিস">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">⚖️</div>
                    <div class="font-semibold">লিগ্যাল</div>
                    <div class="text-sm text-gray-600 mt-2">কেস ও শিডিউল ম্যানেজমেন্ট</div>
                </div>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" aria-labelledby="features-title" class="bg-blue-50 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 id="features-title" class="text-3xl font-bold text-center mb-4 text-blue-600">কেন Zengfy বেছে নিবেন?</h2>
            <p class="text-center text-gray-600 mb-10 max-w-3xl mx-auto">সব পাওয়ার বাংলা SaaS প্ল্যাটফর্ম। স্বচ্ছ মূল্য,
                দ্রুত সেটআপ এবং স্থানীয় নিরাপত্তা ও কনফিগারেশন—আপনার ব্যবসার জন্য তৈরি।</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-4xl text-blue-600 mb-4">💰</div>
                    <h3 class="text-xl font-semibold mb-2">স্বচ্ছ মূল্য</h3>
                    <p class="text-gray-600">ফ্রি থেকে প্রিমিয়াম প্ল্যান, ব্যবসার আকার অনুযায়ী প্যাকেজ, এবং লুকানো চার্জ নেই</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-4xl text-blue-600 mb-4">🚀</div>
                    <h3 class="text-xl font-semibold mb-2">দ্রুত সেটআপ</h3>
                    <p class="text-gray-600">ফরমালিটি গুলো কমিয়ে দিনে অনলাইনশপ, স্কুল বা হোটেল পরিচালনায় নেওয়া যায়</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-4xl text-blue-600 mb-4">🛡️</div>
                    <h3 class="text-xl font-semibold mb-2">লোকাল সিকিউরিটি</h3>
                    <p class="text-gray-600">AES এনক্রিপশন, ব্যাকআপ, ট্রান্সপোর্ট লেয়ার সিকিউরিটি, সার্ভার মনিটরিং সহ</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" aria-labelledby="testimonials-title" class="py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 id="testimonials-title" class="text-3xl font-bold text-center mb-4 text-blue-600">গ্রাহকদের মতামত</h2>
            <p class="text-center text-gray-600 mb-8">বাংলাদেশের নানা সেক্টর থেকে ব্যবসা ও শিক্ষা প্রতিষ্ঠানগুলো
                কিভাবে Zengfy-কে তাদের দিনের নতুন ড্যাশবোর্ড হিসেবে ব্যবহার করছে।</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <article class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold mr-4">
                            রা</div>
                        <div>
                            <h4 class="font-semibold">রহিম আহমেদ</h4>
                            <p class="text-gray-600 text-sm">ই-কমার্স প্ল্যাটফর্ম</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 leading-relaxed">
                        "Zengfy-এ একটি প্ল্যাটফর্মে অর্ডার, স্টক, ইনভয়েস ও পেমেন্ট দেখা হয়। রিপোর্ট এখন
                        এক ক্লিকে, এবং সাপোর্ট লোকাল টিম থেকে ২৪/৭ পাওয়া যায়।"
                    </blockquote>
                </article>

                <article class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold mr-4">
                            স</div>
                        <div>
                            <h4 class="font-semibold">সুমাইয়া আক্তার</h4>
                            <p class="text-gray-600 text-sm">স্কুল অধ্যক্ষ</p>
                        </div>
                    </div>
                    <blockquote class="text-gray-700 leading-relaxed">
                        "স্কুল ERP-তে present/absent, result, fees সবকিছুর জন্য একটি সিস্টেম। Zengfy-এর analytics এবং
                        ট্র্যাকিং আমাদের অভিভাবকদেরও সন্তুষ্ট করছে।"
                    </blockquote>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" aria-labelledby="cta-title" class="bg-gradient-to-r from-blue-600 to-green-500 py-12 text-white">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 id="cta-title" class="text-3xl font-bold mb-4">আজই শুরু করুন আপনার ব্যবসার ডিজিটাল রূপান্তর</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                প্রোডাকশন-রেডি SaaS, যেটি নিরাপত্তা, অনবোর্ডিং গাইড এবং লোকাল সাপোর্ট দিয়ে আপনার টিমকে শক্তিশালী করে।
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('signup') }}"
                    class="inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-yellow-300 transition"
                    aria-label="Zengfy-এ বিনামূল্যে রেজিস্টার করুন">বিনামূল্যে রেজিস্টার</a>
                <a href="{{ route('team') }}"
                    class="inline-block border border-white/60 px-6 py-3 rounded-lg font-semibold text-lg hover:border-white hover:text-white transition"
                    aria-label="Zengfy টীমের সাথে যোগাযোগ করুন">টীমের সাথে কথা বলুন</a>
            </div>
        </div>
    </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8" role="contentinfo">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
                <div>
                    <h3 class="text-xl font-bold mb-4">Zengfy</h3>
                    <p class="text-gray-400">বাংলাদেশের প্রথম ইউনিফাইড SaaS প্ল্যাটফর্ম। একটি অ্যাকাউন্টে সব ব্যবসার
                        সমাধান, নিরাপদ ডেটা ও লোকাল সাপোর্ট।</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">দ্রুত লিংক</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('welcome') }}" class="text-gray-400 hover:text-white">হোম</a></li>
                        <li><a href="{{ route('team') }}" class="text-gray-400 hover:text-white">টীম</a></li>
                        <li><a href="{{ route('team') }}" class="text-gray-400 hover:text-white">যোগাযোগ</a></li>
                        <li><a href="{{ route('signup') }}" class="text-gray-400 hover:text-white">সাইন আপ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">সার্ভিসসমূহ</h3>
                    <ul class="space-y-2">
                        <li><a href="/services/ecommerce"
                                class="text-gray-400 hover:text-white">ই-কমার্স</a></li>
                        <li><a href="/services/school" class="text-gray-400 hover:text-white">স্কুল
                                ERP</a></li>
                        <li><a href="/services/pos" class="text-gray-400 hover:text-white">POS</a>
                        </li>
                        <li><a href="/services/hotel" class="text-gray-400 hover:text-white">হোটেল
                                ব্যবস্থাপনা</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">যোগাযোগ</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>ইমেইল: <a href="mailto:mail@zengfy.top" class="hover:text-white">mail@zengfy.top</a></li>
                        <li>ফোন: <a href="tel:+8801953576147" class="hover:text-white">+৮৮০ ১৯৫৩ ৫৭৬১৪৭</a></li>
                        <li>ঠিকানা: ঢাকা, বাংলাদেশ</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400 space-y-1">
                <p>© ২০২৫ Zengfy — সকল অধিকার সংরক্ষিত</p>
                <p class="text-xs text-gray-500">TLS 1.3, নিয়মিত সিকিউরিটি অডিট ও ব্যাকআপ সহ</p>
            </div>
        </div>
    </footer>

    <!-- Fixed Bottom Navbar (Mobile Only) -->
    <nav class="fixed-navbar" role="navigation" aria-label="Mobile navigation">
        <a href="{{ route('welcome') }}" class="nav-item active" aria-current="page">
            <div class="nav-icon">🏠</div>
            <div class="nav-text">হোম</div>
        </a>
        <a href="{{ route('team') }}" class="nav-item" aria-label="টীম সম্পর্কিত তথ্য">
            <div class="nav-icon">👥</div>
            <div class="nav-text">টীম</div>
        </a>
        <a href="{{ route('download.app') }}" class="nav-item" aria-label="অ্যাপ ডাউনলোড">
            <div class="nav-icon">📲</div>
            <div class="nav-text">Download App</div>
        </a>
        <a href="{{ route('signup') }}" class="nav-item" aria-label="সাইন আপ করুন">
            <div class="nav-icon">📝</div>
            <div class="nav-text">সাইন আপ</div>
        </a>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navItems = document.querySelectorAll('.nav-item');
            if (navItems.length) {
                navItems.forEach(item => {
                    item.addEventListener('click', () => {
                        navItems.forEach(i => i.classList.remove('active'));
                        item.classList.add('active');
                    });
                });
            }

            const desktopLinks = document.querySelectorAll('.desktop-nav a');
            const normalizePath = value => {
                const trimmed = (value || '').replace(/\/$/, '');
                return trimmed === '' ? '/' : trimmed;
            };
            const currentPath = normalizePath(window.location.pathname);

            desktopLinks.forEach(link => {
                try {
                    const linkUrl = new URL(link.href, window.location.origin);
                    if (normalizePath(linkUrl.pathname) === currentPath) {
                        link.classList.add('text-blue-700', 'font-bold');
                        link.setAttribute('aria-current', 'page');
                    }
                } catch (error) {
                    // ignore invalid hrefs
                }
            });
        });
    </script>
    <script type="application/ld+json">
       
    </script>
</body>

</html>