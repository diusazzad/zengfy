<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy.top — বাংলাদেশের ইউনিফাইড SaaS প্ল্যাটফর্ম</title>
    <meta name="description"
        content="এক অ্যাকাউন্টে ই-কমার্স, স্কুল ERP, POS, হোটেল, ঘড়ি, AI, আরও অনেক সার্ভিস। বিকাশ/নগদ, বাংলা UI, দ্রুত অনবোর্ডিং।">
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
            /* Fixed navbar এর জন্য স্থান সংরক্ষণ */
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
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between h-16">
            <a href="https://zengfy.top" class="text-2xl font-extrabold text-blue-600">Zengfy.top</a>
            <nav class="flex space-x-6">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600">হোম</a>
                <a href="{{ route('team') }}" class="hover:text-blue-600">টীম</a>
                <a href="{{ route('download.app') }}" class="hover:text-blue-600">Download App</a>
                <a href="{{ route('signup') }}"
                    class="bg-yellow-400 text-gray-900 px-4 py-2 rounded font-semibold hover:bg-yellow-300">সাইন আপ</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-tr from-blue-600 to-green-500 text-white pt-8 pb-16">
        <div class="max-w-6xl mx-auto px-4 flex flex-col lg:flex-row items-center gap-10">
            <div class="flex-1">
                <h1 class="text-4xl sm:text-5xl font-extrabold mb-4">এক অ্যাকাউন্টে সব ব্যবসার সমাধান</h1>
                <p class="mb-6 text-lg">ই-কমার্স, স্কুল ERP, POS, হোটেল, ঘড়ি, AI, আরও অনেক কিছু — Zengfy.top-এ।</p>
                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('signup') }}"
                        class="px-5 py-3 bg-yellow-400 text-gray-900 rounded font-semibold shadow hover:bg-yellow-300">এখনই
                        সাইন আপ</a>
                </div>
                <ul class="space-y-2 text-white/90">
                    <li>• লোকাল পেমেন্ট (বিকাশ/নগদ)</li>
                    <li>• বাংলা UI ও কাস্টমাইজড ড্যাশবোর্ড</li>
                    <li>• ফ্রি ও পেইড প্ল্যান</li>
                    <li>• দ্রুত অনবোর্ডিং ও সাপোর্ট</li>
                </ul>
            </div>

            <div class="flex-1 flex justify-center">
                <div class="bg-white/20 rounded-xl p-6 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=600&q=80"
                        alt="Zengfy Platform" class="rounded-lg max-w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="max-w-6xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-center mb-8 text-blue-600">আমাদের সার্ভিসসমূহ</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            <a href="https://zengfy.top/services/ecommerce" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🛒</div>
                    <div class="font-semibold">ই-কমার্স SaaS</div>
                    <div class="text-sm text-gray-600 mt-2">অনলাইন পণ্য বিক্রি</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/school" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🎓</div>
                    <div class="font-semibold">স্কুল ERP</div>
                    <div class="text-sm text-gray-600 mt-2">স্কুল পরিচালনা-ব্যবস্থাপনা</div>
                </div>
            </a>
            <a href="https://zengfy.top/services/workshop" class="block service-card max-w-xs mx-auto">
                <div class="bg-white rounded-lg p-3 shadow text-center hover:shadow-lg transition">
                    <div class="text-2xl mb-1">🎥</div>
                    <div class="font-semibold text-base">Video & Editing Workshop</div>
                    <div class="text-xs text-gray-600 mt-1">Creative skills উন্নত করুন, practical hands-on training
                    </div>
                </div>
            </a>



            <a href="https://zengfy.top/services/pos" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">💳</div>
                    <div class="font-semibold">POS</div>
                    <div class="text-sm text-gray-600 mt-2">ইনভেন্টরি, লেনদেন, AI</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/roomrental" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🦐</div>
                    <div class="font-semibold">Rent A House</div>
                    <div class="text-sm text-gray-600 mt-2">বাসা খুঁজা , অবস্থান বুঝে </div>
                </div>
            </a>

            <a href="https://zengfy.top/services/hotel" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🏨</div>
                    <div class="font-semibold">হোটেল</div>
                    <div class="text-sm text-gray-600 mt-2">দৈনিক লেনদেন, রিপোর্ট</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/watch" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">⌚</div>
                    <div class="font-semibold">ওয়াচ স্টোর</div>
                    <div class="text-sm text-gray-600 mt-2">ব্র্যান্ডেড ঘড়ি, প্রিমিয়াম</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/journalism" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">📰</div>
                    <div class="font-semibold">জার্নাল</div>
                    <div class="text-sm text-gray-600 mt-2">কনটেন্ট পাবলিশ</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/wellness" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">📈</div>
                    <div class="font-semibold">হ্যাবিট</div>
                    <div class="text-sm text-gray-600 mt-2">অভ্যাস অ্যানালাইসিস</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/aiflow" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🤖</div>
                    <div class="font-semibold">AI ক্যালেন্ডার</div>
                    <div class="text-sm text-gray-600 mt-2">ইমেইল/SMS - শিডিউল</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/civil" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🏗️</div>
                    <div class="font-semibold">সিভিল</div>
                    <div class="text-sm text-gray-600 mt-2">প্রজেক্ট, ইনভেন্টরি</div>
                </div>
            </a>

            <a href="https://zengfy.top/services/legal" class="block service-card">
                <div class="bg-white rounded-lg p-4 shadow text-center hover:shadow-lg transition">
                    <div class="text-3xl mb-2">⚖️</div>
                    <div class="font-semibold">ল</div>
                    <div class="text-sm text-gray-600 mt-2">কেস, শিডিউলিং</div>
                </div>
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-blue-50 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-blue-600">কেন Zengfy.top বেছে নিবেন?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-4xl text-blue-600 mb-4">💰</div>
                    <h3 class="text-xl font-semibold mb-2">সাশ্রয়ী মূল্য</h3>
                    <p class="text-gray-600">ফ্রি থেকে প্রিমিয়াম প্ল্যান, আপনার ব্যবসার আকার অনুযায়ী সঠিক প্যাকেজ
                        নির্বাচন করুন</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-4xl text-blue-600 mb-4">🚀</div>
                    <h3 class="text-xl font-semibold mb-2">দ্রুত সেটআপ</h3>
                    <p class="text-gray-600">মাত্র কয়েক মিনিটে আপনার ব্যবসা অনলাইনে নিয়ে আসুন, কোন টেকনিক্যাল জ্ঞান
                        প্রয়োজন নেই</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="text-4xl text-blue-600 mb-4">🌐</div>
                    <h3 class="text-xl font-semibold mb-2">বাংলাদেশি সমাধান</h3>
                    <p class="text-gray-600">বাংলাদেশের বাজার ও চাহিদা অনুযায়ী তৈরি, সম্পূর্ণ বাংলা ভাষায় ইন্টারফেস
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-blue-600">গ্রাহকদের মতামত</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold mr-4">
                            রা</div>
                        <div>
                            <h4 class="font-semibold">রহিম আহমেদ</h4>
                            <p class="text-gray-600 text-sm">ই-কমার্স ব্যবসায়ী</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"Zengfy.top ব্যবহার করে আমার অনলাইন ব্যবসার সম্পূর্ণ ব্যবস্থাপনা খুব সহজ
                        হয়ে গেছে। একটি প্ল্যাটফর্মে সবকিছু পেয়ে আমি খুব খুশি।"</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold mr-4">
                            স</div>
                        <div>
                            <h4 class="font-semibold">সুমাইয়া আক্তার</h4>
                            <p class="text-gray-600 text-sm">স্কুল অধ্যক্ষ</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"আমাদের স্কুলের জন্য ERP সলিউশন হিসাবে Zengfy.top অসাধারণ। attendance,
                        results, fees - সবকিছুর জন্য একটি সিস্টেম।"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-blue-600 to-green-500 py-12 text-white">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">আজই শুরু করুন আপনার ব্যবসার ডিজিটাল রূপান্তর</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">একটি মাত্র অ্যাকাউন্টে সব ব্যবসার প্রয়োজনীয় টুলস পেয়ে যান</p>
            <a href="{{ route('signup') }}"
                class="inline-block bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg font-semibold text-lg shadow-lg hover:bg-yellow-300 transition">বিনামূল্যে
                রেজিস্টার করুন</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Zengfy.top</h3>
                    <p class="text-gray-400">বাংলাদেশের প্রথম ইউনিফাইড SaaS প্ল্যাটফর্ম। একটি অ্যাকাউন্টে সব ব্যবসার
                        সমাধান।</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">দ্রুত লিংক</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('welcome') }}" class="text-gray-400 hover:text-white">হোম</a></li>
                        <li><a href="{{ route('team') }}" class="text-gray-400 hover:text-white">টীম</a></li>
                        <li><a href="{{ route('team') }}" class="text-gray-400 hover:text-white">যোগাযোগ</a>
                        </li>
                        <li><a href="{{ route('signup') }}" class="text-gray-400 hover:text-white">সাইন
                                আপ</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">সার্ভিসসমূহ</h3>
                    <ul class="space-y-2">
                        <li><a href="https://zengfy.top/services/ecommerce"
                                class="text-gray-400 hover:text-white">ই-কমার্স</a></li>
                        <li><a href="https://zengfy.top/services/school" class="text-gray-400 hover:text-white">স্কুল
                                ERP</a></li>
                        <li><a href="https://zengfy.top/services/pos" class="text-gray-400 hover:text-white">POS</a>
                        </li>
                        <li><a href="https://zengfy.top/services/hotel" class="text-gray-400 hover:text-white">হোটেল
                                ব্যবস্থাপনা</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">যোগাযোগ</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>ইমেইল: mail@zengfy.top</li>
                        <li>ফোন: +৮৮০ ১953576147</li>
                        <li>ঠিকানা: ঢাকা, বাংলাদেশ</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>© ২০২5 Zengfy.top - সকল অধিকার সংরক্ষিত</p>
            </div>
        </div>
    </footer>

    <!-- Fixed Bottom Navbar (Mobile Only) -->
    <div class="fixed-navbar">
        <a href="{{ route('welcome') }}" class="nav-item active">
            <div class="nav-icon">🏠</div>
            <div class="nav-text">হোম</div>
        </a>
        <a href="{{ route('team') }}" class="nav-item">
            <div class="nav-icon">👥</div>
            <div class="nav-text">টীম</div>
        </a>
        <a href="{{ route('download.app') }}" class="nav-item">
            <div class="nav-icon">📲</div>
            <div class="nav-text">Download App</div>
        </a>
        <a href="{{ route('signup') }}" class="nav-item">
            <div class="nav-icon">📝</div>
            <div class="nav-text">সাইন আপ</div>
        </a>
    </div>

    <script>
        // Mobile navbar item active状态管理
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function () {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Desktop nav active状态
        const currentPage = window.location.href;
        document.querySelectorAll('.desktop-nav a').forEach(link => {
            if (link.href === currentPage) {
                link.classList.add('text-blue-700', 'font-bold');
            }
        });
    </script>
</body>

</html>