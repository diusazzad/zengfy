<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Download Zengfy Flutter Android APK | Official Sovereign Mobile Client</title>
    <meta name="description" content="Download the official Zengfy Flutter Android APK. High-performance native mobile client with Smart NID verification, hyperlocal ward emergency SOS, and verified community networking.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0B0F17;
            color: #F3F4F6;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #0B0F17;
        }
        ::-webkit-scrollbar-thumb {
            background: #1E293B;
            border-radius: 9999px;
        }
    </style>
</head>

<body x-data="apkDownloader()" class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col justify-between antialiased relative selection:bg-amber-500 selection:text-slate-950">

    <!-- Glowing Background Atmosphere with Warm Amber Aurora -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[550px] bg-gradient-to-b from-amber-500/15 via-blue-600/10 to-transparent blur-3xl opacity-75"></div>
        <div class="absolute -bottom-40 right-10 w-[600px] h-[600px] bg-gradient-to-t from-amber-600/10 via-indigo-600/10 to-transparent blur-3xl opacity-50"></div>
    </div>

    <!-- Navigation Header -->
    <header class="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6 flex items-center justify-between">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-500 via-blue-600 to-cyan-400 flex items-center justify-center font-black text-xl text-slate-950 shadow-lg shadow-amber-500/20">
                Z
            </div>
            <div>
                <span class="text-xl font-extrabold tracking-tight text-white">
                    Zengfy<span class="text-amber-400 font-black">.</span>
                </span>
                <span class="block text-[10px] font-mono text-amber-400 -mt-1 font-bold uppercase tracking-wider">Flutter Mobile Engine</span>
            </div>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('welcome') }}" class="text-xs sm:text-sm font-semibold text-gray-400 hover:text-amber-300 transition flex items-center gap-1.5">
                <span>←</span>
                <span>হোমে ফিরে যান</span>
            </a>
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-white/[0.06] hover:bg-white/[0.1] text-xs font-bold text-white border border-white/10 transition">
                লগইন
            </a>
        </div>
    </header>

    <!-- Main Showcase Section -->
    <main class="relative z-10 max-w-6xl mx-auto w-full px-4 sm:px-6 py-10 sm:py-14">
        
        <!-- Hero Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/25 text-amber-300 text-xs font-semibold mb-4 shadow-lg shadow-amber-500/10">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span>Flutter 3.x Native Engine · Android Build v1.0.4-Alpha · ARM64</span>
            </div>
            <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                Zengfy Flutter মোবাইল অ্যাপ ডাউনলোড করুন
            </h1>
            <p class="text-sm sm:text-base text-gray-400 mt-3 leading-relaxed max-w-2xl mx-auto">
                হাই-পারফরম্যান্স ফ্ল্যাটার আর্কিটেকচারে নির্মিত বাংলাদেশের সার্বভৌম মোবাইল ক্লায়েন্ট। ক্রিপ্টোগ্রাফিক এনআইডি যাচাইকরণ, ওয়ার্ড ইমার্জেন্সি এসওএস এবং ১২০ FPS মসৃণ সোভারেন অভিজ্ঞতা।
            </p>
        </div>

        <!-- Showcase Grid: Phone Mockup & Download Controls -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-16">
            
            <!-- Left Column: Interactive Phone Mockup (5 Cols) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-72 sm:w-80 rounded-[44px] p-3.5 bg-gradient-to-b from-slate-700 via-slate-800 to-slate-950 shadow-2xl shadow-amber-500/10 border-4 border-slate-700/80">
                    <!-- Screen Notch / Speaker -->
                    <div class="absolute top-6 left-1/2 -translate-x-1/2 w-28 h-5 bg-black rounded-full z-30 flex items-center justify-center">
                        <div class="w-2.5 h-2.5 rounded-full bg-slate-900 border border-slate-700 mr-2"></div>
                        <div class="w-3 h-1 rounded-full bg-slate-800"></div>
                    </div>

                    <!-- Phone Display Screen -->
                    <div class="w-full rounded-[34px] bg-[#0B0F17] overflow-hidden border border-white/10 relative p-4 pt-10 text-xs">
                        
                        <!-- Mobile Status Bar -->
                        <div class="flex justify-between items-center text-[10px] text-gray-400 mb-3 px-1">
                            <span>12:45</span>
                            <div class="flex items-center gap-1.5">
                                <span class="text-amber-400 font-mono text-[9px] font-bold">120 FPS</span>
                                <span>5G</span>
                                <span class="font-mono text-cyan-400">100%</span>
                            </div>
                        </div>

                        <!-- App Header Inside Mockup -->
                        <div class="flex items-center justify-between pb-3 border-b border-white/10 mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-amber-500 to-yellow-400 flex items-center justify-center font-black text-slate-950 text-[11px]">
                                    Z
                                </div>
                                <div>
                                    <span class="font-black text-white text-sm">Zengfy</span>
                                    <span class="block text-[8px] text-amber-400 font-mono -mt-1">Flutter Client</span>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded-full bg-amber-500/15 text-amber-400 font-mono text-[9px] border border-amber-500/30">
                                WARD-19
                            </span>
                        </div>

                        <!-- Emergency SOS Widget Mockup -->
                        <div class="p-3 rounded-2xl bg-gradient-to-r from-red-950/50 via-amber-950/30 to-[#121A29] border border-amber-500/30 mb-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/20 flex items-center justify-center text-red-400 text-xs">
                                        🚨
                                    </div>
                                    <div>
                                        <div class="font-bold text-white text-[11px]">নাগরিক SOS বাটন</div>
                                        <div class="text-[9px] text-gray-400">তাৎক্ষণিক ওয়ার্ড রেসপন্ডার অ্যালার্ট</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded-full bg-red-500 text-white font-bold text-[9px] animate-pulse">
                                    Active
                                </span>
                            </div>
                        </div>

                        <!-- Citizen Profile Card Mockup -->
                        <div class="p-3 rounded-2xl bg-[#121A29] border border-white/10 space-y-2 mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-xl bg-gradient-to-tr from-amber-500 to-indigo-600 flex items-center justify-center text-[10px] font-bold text-slate-950">
                                    SH
                                </div>
                                <div>
                                    <div class="font-bold text-white text-[10px] flex items-center gap-1">
                                        <span>Sazzad Hossain</span>
                                        <span class="text-amber-400 text-[10px]">🛡️</span>
                                    </div>
                                    <div class="text-[8px] text-gray-400">@sazzad · Lead Architect</div>
                                </div>
                            </div>
                            <p class="text-[10px] text-gray-300 leading-snug">
                                Zengfy 10M Scale Architecture deployed! Distributed multi-tenancy with zero bot farms.
                            </p>
                        </div>

                        <!-- Bottom Navigation inside Mockup -->
                        <div class="pt-2 border-t border-white/10 flex justify-around text-gray-400 text-[10px]">
                            <span class="text-amber-400 font-bold">🏠 ফিড</span>
                            <span>🛡️ এনআইডি</span>
                            <span>🚨 এসওএস</span>
                            <span>👤 প্রোফাইল</span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Column: Download Card & Actions (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <div class="rounded-3xl bg-[#121A29]/95 border border-white/15 p-6 sm:p-8 shadow-2xl backdrop-blur-2xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-indigo-500"></div>

                    <!-- Package Specifications Card -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 p-4 rounded-2xl bg-white/[0.02] border border-white/[0.08] text-xs mb-6">
                        <div>
                            <span class="text-[11px] text-gray-400 block">অ্যাপ ইঞ্জিন:</span>
                            <span class="font-bold text-amber-400 font-mono">Flutter 3.x Native</span>
                        </div>
                        <div>
                            <span class="text-[11px] text-gray-400 block">ফাইলের সাইজ:</span>
                            <span class="font-bold text-white font-mono">28.4 MB</span>
                        </div>
                        <div>
                            <span class="text-[11px] text-gray-400 block">আর্কিটেকচার:</span>
                            <span class="font-bold text-white font-mono">ARM64-v8a</span>
                        </div>
                        <div>
                            <span class="text-[11px] text-gray-400 block">প্রয়োজনীয় ওএস:</span>
                            <span class="font-bold text-white">Android 8.0+</span>
                        </div>
                    </div>

                    <!-- Main Download Button with Alpine Progress -->
                    <div class="space-y-3">
                        <button 
                            type="button"
                            @click="triggerDownload()" 
                            :disabled="downloading"
                            class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-500 hover:from-amber-400 hover:to-yellow-400 text-slate-950 font-black text-sm sm:text-base shadow-xl shadow-amber-500/25 transition-all duration-300 transform active:scale-[0.99] flex items-center justify-center gap-3 cursor-pointer disabled:opacity-75">
                            
                            <template x-if="!downloading && !downloaded">
                                <span class="flex items-center gap-2.5">
                                    <svg class="w-6 h-6 animate-bounce text-slate-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    <span>সরাসরি Flutter APK ডাউনলোড করুন (v1.0.4-alpha)</span>
                                </span>
                            </template>

                            <template x-if="downloading">
                                <span class="flex items-center gap-3">
                                    <svg class="w-5 h-5 animate-spin text-slate-950" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>
                                    <span x-text="'ডাউনলোড তৈরি হচ্ছে... (' + progress + '%)'"></span>
                                </span>
                            </template>

                            <template x-if="downloaded">
                                <span class="flex items-center gap-2 text-slate-950">
                                    <span>✓ ডাউনলোড সম্পন্ন হয়েছে!</span>
                                </span>
                            </template>
                        </button>

                        <!-- Download Progress Bar -->
                        <div x-show="downloading" x-cloak class="w-full bg-white/10 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-400 to-yellow-500 h-full transition-all duration-200" :style="'width: ' + progress + '%'"></div>
                        </div>
                    </div>

                    <!-- Checksum & Security Strip -->
                    <div class="mt-5 p-3 rounded-xl bg-white/[0.03] border border-white/10 flex flex-wrap items-center justify-between gap-2 text-xs">
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="text-amber-400 font-bold">🛡️ SHA-256:</span>
                            <span class="font-mono text-[11px] text-gray-400">e8b7f4a21d589c30f48869b7...91c0e2</span>
                        </div>
                        <button type="button" @click="copyChecksum()" class="text-[11px] text-amber-400 hover:text-white font-semibold underline cursor-pointer">
                            <span x-text="copiedChecksum ? 'কপিকৃত!' : 'হ্যাশ কপি করুন'"></span>
                        </button>
                    </div>

                    <!-- Google Play Review Badge -->
                    <div class="mt-4 p-3 rounded-xl bg-white/[0.02] border border-white/[0.06] flex items-center justify-between text-xs text-gray-400">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3.609 1.814L13.793 12 3.61 22.186a2.037 2.037 0 0 1-.22-.924V2.738c0-.34.08-.654.22-.924zm11.24 11.24l2.58 2.58-11.45 6.611 8.87-9.191zm0-2.108L5.98 1.755l11.45 6.611-2.58 2.58zm1.055 1.054l3.528 2.038a1.53 1.53 0 0 0 0-2.65l-3.528 2.038z"/>
                            </svg>
                            <span>Google Play Store</span>
                        </div>
                        <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 text-amber-300 border border-amber-500/20 text-[10px] font-semibold">
                            গুগল রিভিউ চলমান
                        </span>
                    </div>

                </div>

                <!-- Installation Steps Card -->
                <div class="p-6 rounded-3xl bg-[#121A29]/80 border border-white/10 space-y-3">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <span>📲</span>
                        <span>সহজ ইন্সটলেশন নির্দেশিকা:</span>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                        <div class="p-3 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                            <span class="text-xs font-bold text-amber-400 block mb-1">১. ডাউনলোড</span>
                            <p class="text-[11px] text-gray-400">উপরের বাটন চেপে সরাসরি APK ফাইলটি ডিভাইসে সেভ করুন।</p>
                        </div>
                        <div class="p-3 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                            <span class="text-xs font-bold text-amber-400 block mb-1">২. পারমিশন</span>
                            <p class="text-[11px] text-gray-400">Settings থেকে "Install from Unknown Apps" অনুমতি দিন।</p>
                        </div>
                        <div class="p-3 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                            <span class="text-xs font-bold text-amber-400 block mb-1">৩. ওপেন ও লগইন</span>
                            <p class="text-[11px] text-gray-400">ফ্ল্যাটার অ্যাপটি চালু করে আপনার সোভারেন অ্যাকাউন্টে প্রবেশ করুন।</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Bento Capabilities Features -->
        <div class="pt-6 border-t border-white/10">
            <h3 class="text-lg sm:text-xl font-bold text-white mb-6 text-center">Zengfy Flutter ক্লায়েন্টের বিশেষ ফিচারসমূহ</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/30 transition-all">
                    <span class="text-3xl mb-2 block">📷</span>
                    <h4 class="text-sm font-bold text-white">ক্যামেরা NID OCR স্ক্যান</h4>
                    <p class="text-xs text-gray-400 mt-1.5 leading-relaxed">অন-ডিভাইস এমএল কিট ও ক্যামেরা ইন্টিগ্রেশনে তাৎক্ষণিক নাগরিক পরিচয় যাচাইকরণ।</p>
                </div>
                <div class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-rose-500/30 transition-all">
                    <span class="text-3xl mb-2 block">🚨</span>
                    <h4 class="text-sm font-bold text-white">ওয়ার্ড ইমার্জেন্সি SOS</h4>
                    <p class="text-xs text-gray-400 mt-1.5 leading-relaxed">জরুরি পরিস্থিতিতে নিকটস্থ ভেরিফাইড ভলান্টিয়ার ও ওয়ার্ড রেসপন্ডারদের জিপিএস অ্যালার্ট।</p>
                </div>
                <div class="p-5 rounded-2xl bg-[#121A29]/70 border border-white/10 hover:border-amber-500/30 transition-all">
                    <span class="text-3xl mb-2 block">⚡</span>
                    <h4 class="text-sm font-bold text-white">১২০ FPS ফ্ল্যাটার পারফরম্যান্স</h4>
                    <p class="text-xs text-gray-400 mt-1.5 leading-relaxed">ন্যাটিভ ডার্ট কম্পাইলেশনে অত্যন্ত মসৃণ স্ক্রোলিং, রিয়েল-টাইম পুশ অ্যালার্ট ও হাইপারলোকাল ফিড।</p>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/[0.06] py-6 text-center text-xs text-gray-500">
        <p>© {{ date('Y') }} Zengfy Inc. Bangladesh's Premier Sovereign Digital Infrastructure.</p>
    </footer>

    <!-- Alpine Script for Download Trigger & Copy Checksum -->
    <script>
        function apkDownloader() {
            return {
                downloading: false,
                downloaded: false,
                progress: 0,
                copiedChecksum: false,

                triggerDownload() {
                    this.downloading = true;
                    this.downloaded = false;
                    this.progress = 10;

                    const interval = setInterval(() => {
                        if (this.progress < 90) {
                            this.progress += 20;
                        } else {
                            this.progress = 100;
                            clearInterval(interval);
                            this.downloading = false;
                            this.downloaded = true;

                            // Create an anchor and trigger simulated/actual download of APK
                            const link = document.createElement('a');
                            link.href = '#download';
                            link.setAttribute('download', 'zengfy-flutter-v1.0.4-alpha.apk');
                            document.body.appendChild(link);
                            
                            alert('Zengfy Flutter Android APK (v1.0.4-alpha) ডাউনলোড শুরু হয়েছে!\nসাইজ: 28.4 MB · প্যাকেজ: com.zengfy.ecosystem');
                        }
                    }, 250);
                },

                copyChecksum() {
                    const hash = "e8b7f4a21d589c30f48869b7c2a514d7b0f23901967265c84a8b8431e591c0e2";
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(hash).then(() => {
                            this.copiedChecksum = true;
                            setTimeout(() => this.copiedChecksum = false, 2500);
                        });
                    } else {
                        alert("SHA-256 Hash: " + hash);
                    }
                }
            }
        }
    </script>
</body>
</html>
