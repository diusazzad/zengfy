<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Download Zengfy Android APK | Sovereign Mobile Network</title>
    <meta name="description" content="Download the official Zengfy Android APK. Secure NID verification, ward emergency SOS, and verified community networking.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

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

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0B0F17;
            color: #F3F4F6;
        }
    </style>
</head>

<body class="bg-[#0B0F17] text-gray-100 min-h-screen flex flex-col justify-between antialiased relative selection:bg-blue-600 selection:text-white">

    <!-- Glowing Background Atmosphere -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-gradient-to-b from-cyan-500/20 via-blue-600/10 to-transparent blur-3xl opacity-70"></div>
        <div class="absolute -bottom-40 right-10 w-[500px] h-[500px] bg-gradient-to-t from-blue-700/15 via-indigo-600/10 to-transparent blur-3xl opacity-50"></div>
    </div>

    <!-- Navigation Header -->
    <header class="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6 flex items-center justify-between">
        <a href="{{ route('welcome') }}" class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-400 flex items-center justify-center font-black text-lg text-white shadow-lg shadow-blue-500/25">
                Z
            </div>
            <span class="text-xl font-extrabold tracking-tight text-white">
                Zengfy<span class="text-cyan-400 font-black">.</span>
            </span>
        </a>

        <div class="flex items-center gap-3">
            <a href="{{ route('welcome') }}" class="text-xs sm:text-sm font-semibold text-gray-400 hover:text-white transition">
                ← Back to Home
            </a>
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl bg-white/[0.06] hover:bg-white/[0.1] text-xs font-semibold text-white border border-white/10 transition">
                Sign In
            </a>
        </div>
    </header>

    <!-- Main Download Card -->
    <main class="relative z-10 max-w-4xl mx-auto w-full px-4 sm:px-6 py-12">
        
        <div class="rounded-3xl bg-[#121A29]/95 border border-white/15 p-6 sm:p-10 shadow-2xl backdrop-blur-2xl relative overflow-hidden">
            <!-- Top Gradient Accent -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 via-blue-600 to-indigo-500"></div>

            <div class="text-center max-w-2xl mx-auto mb-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/25 text-cyan-300 text-xs font-semibold mb-4">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    <span>Official Android Alpha Build v1.0.4</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Download Zengfy for Android
                </h1>
                <p class="text-sm text-gray-400 mt-2">
                    Direct APK download with full sovereign identity features, emergency ward SOS, and offline-first community networking.
                </p>
            </div>

            <!-- APK Specs & Direct Download Box -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center pb-8 border-b border-white/10">
                
                <!-- Left: Download Actions -->
                <div class="space-y-4">
                    <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/[0.08] space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Package Name:</span>
                            <span class="font-mono text-cyan-400">com.zengfy.ecosystem</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Build Version:</span>
                            <span class="font-semibold text-white">v1.0.4-alpha</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">File Size:</span>
                            <span class="font-semibold text-white">28.4 MB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Required OS:</span>
                            <span class="font-semibold text-white">Android 8.0+ (Oreo or later)</span>
                        </div>
                    </div>

                    <a href="#download-apk" 
                       onclick="alert('Alpha Build v1.0.4 package ready. In development environment, the APK package is compiled via Capacitor / Android Studio.');"
                       class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600 hover:from-cyan-400 hover:to-indigo-500 text-white font-bold text-sm shadow-xl shadow-cyan-500/25 transition flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        <span>Download APK Package (Direct)</span>
                    </a>

                    <div class="p-3 rounded-xl bg-white/[0.03] border border-white/10 flex items-center justify-between text-xs text-gray-400">
                        <span class="flex items-center gap-2">
                            <span>Google Play Store</span>
                        </span>
                        <span class="px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-300 border border-amber-500/20 text-[10px] font-semibold">
                            Google Review In-Progress
                        </span>
                    </div>
                </div>

                <!-- Right: Installation Guide -->
                <div class="p-5 rounded-2xl bg-[#0B0F17]/80 border border-white/10 space-y-3">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <span>📲</span>
                        <span>Easy Installation Steps</span>
                    </h3>
                    <ol class="list-decimal pl-5 space-y-2 text-xs text-gray-300">
                        <li>Tap <strong class="text-white">Download APK Package</strong> above to save the file.</li>
                        <li>If prompted, permit <strong class="text-cyan-400">"Install unknown apps"</strong> in your Android Settings.</li>
                        <li>Open the downloaded <code class="font-mono text-[11px] text-cyan-300">zengfy-v1.0.4.apk</code> and tap Install.</li>
                        <li>Launch Zengfy Mobile and sign in with your sovereign credentials!</li>
                    </ol>
                    <p class="text-[11px] text-gray-500 pt-2 border-t border-white/[0.05]">
                        🔒 Cryptographically signed by Zengfy Digital Security Authority.
                    </p>
                </div>

            </div>

            <!-- Mobile Capabilities Bento -->
            <div class="pt-8">
                <h3 class="text-base font-bold text-white mb-4 text-center">Engineered for Sovereign Citizens</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center">
                    <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/[0.06]">
                        <span class="text-2xl mb-1 block">📸</span>
                        <h4 class="text-xs font-bold text-white">Camera NID OCR</h4>
                        <p class="text-[11px] text-gray-400 mt-1">Automatic optical recognition for instant citizen verification.</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/[0.06]">
                        <span class="text-2xl mb-1 block">🚨</span>
                        <h4 class="text-xs font-bold text-white">Ward Emergency SOS</h4>
                        <p class="text-[11px] text-gray-400 mt-1">Immediate GPS beacon to local responders in critical situations.</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/[0.06]">
                        <span class="text-2xl mb-1 block">⚡</span>
                        <h4 class="text-xs font-bold text-white">FCM Push Alerts</h4>
                        <p class="text-[11px] text-gray-400 mt-1">Real-time alerts for neighborhood notices, chats, and news.</p>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/[0.06] py-6 text-center text-xs text-gray-500">
        <p>© {{ date('Y') }} Zengfy Inc. Bangladesh's Premier Sovereign Identity Network.</p>
    </footer>

</body>
</html>