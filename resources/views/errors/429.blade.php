<!-- resources/views/errors/429.blade.php -->
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>High Traffic Protection | Zengfy Ecosystem</title>

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
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col items-center justify-between p-4 sm:p-8">

    <!-- Top Brand Header -->
    <header class="w-full max-w-7xl mx-auto flex items-center justify-between py-4">
        <a href="/" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-black text-lg text-white shadow-lg shadow-blue-500/20">
                Z
            </div>
            <span class="text-xl font-extrabold text-white tracking-tight">
                zengfy<span class="text-blue-500 font-black">.</span>
            </span>
        </a>

        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-semibold">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
            <span>Traffic Safeguard Active</span>
        </div>
    </header>

    <!-- Center Waiting Room Content Box -->
    <main class="w-full max-w-2xl mx-auto text-center my-auto py-12" x-data="trafficWaitingRoom()">
        <div class="p-8 sm:p-12 rounded-3xl bg-[#121A29]/80 border border-white/10 backdrop-blur-2xl shadow-2xl relative overflow-hidden">
            
            <!-- Glowing Background Accent -->
            <div class="absolute -top-24 -left-24 w-48 h-48 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Icon -->
            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-3xl text-amber-400 shadow-xl shadow-amber-500/10">
                ⏳
            </div>

            <!-- Title -->
            <h1 class="text-2xl sm:text-4xl font-black text-white tracking-tight leading-tight mb-3">
                High Traffic Volume Detected
            </h1>
            <p class="text-xs sm:text-sm text-gray-300 max-w-lg mx-auto leading-relaxed mb-8">
                Our server protection engine is managing a sudden burst of requests to ensure zero data loss. Please hold on for a moment.
            </p>

            <!-- Interactive Progress Bar Container -->
            <div class="mb-8 bg-white/5 border border-white/10 rounded-2xl p-5 text-left">
                <div class="flex items-center justify-between text-xs mb-2">
                    <span class="font-bold text-gray-300">Auto-Reconnecting Queue...</span>
                    <span class="font-extrabold text-blue-400" x-text="timeLeft + 's remaining'">10s remaining</span>
                </div>

                <!-- Outer Track -->
                <div class="w-full h-3 rounded-full bg-white/10 overflow-hidden relative">
                    <!-- Inner Progress Bar -->
                    <div class="h-full bg-gradient-to-r from-blue-500 via-indigo-500 to-cyan-400 rounded-full transition-all duration-1000 ease-linear"
                         :style="'width: ' + progress + '%'"></div>
                </div>

                <p class="text-[11px] text-gray-400 mt-2.5 text-center">
                    The page will automatically retry connecting when the progress completes.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <button @click="retryNow()" 
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-blue-600/30 transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 flex items-center justify-center gap-2">
                    <span>Retry Connection Now 🔄</span>
                </button>
                <a href="/" 
                   class="w-full sm:w-auto px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-gray-200 border border-white/10 font-semibold text-xs sm:text-sm transition-all text-center">
                    Back to Ecosystem Home
                </a>
            </div>

        </div>
    </main>

    <!-- Bottom Footer Note -->
    <footer class="w-full max-w-7xl mx-auto text-center py-4 text-xs text-gray-500">
        © {{ date('Y') }} Zengfy Inc. Intelligent Traffic Rate-Limiting Protection.
    </footer>

    <!-- Alpine.js Countdown & Auto-Reload Script -->
    <script>
        function trafficWaitingRoom() {
            return {
                timeLeft: 10,
                progress: 0,
                interval: null,
                init() {
                    this.interval = setInterval(() => {
                        if (this.timeLeft > 0) {
                            this.timeLeft--;
                            this.progress = ((10 - this.timeLeft) / 10) * 100;
                        } else {
                            clearInterval(this.interval);
                            window.location.reload();
                        }
                    }, 1000);
                },
                retryNow() {
                    clearInterval(this.interval);
                    window.location.reload();
                }
            }
        }
    </script>
</body>
</html>
