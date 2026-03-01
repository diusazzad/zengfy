<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\cookies-banner.blade.php -->
<div id="cookie-banner"
    class="fixed bottom-6 right-6 max-w-sm w-[calc(100%-3rem)] bg-white/95 backdrop-blur-xl border border-gray-100 rounded-2xl shadow-2xl p-6 z-50 transform translate-y-32 opacity-0 transition-all duration-1000">
    <div id="cookie-main-content">
        <div class="flex items-start gap-4">
            <div class="text-3xl">🍪</div>
            <div class="flex-1">
                <h4 class="font-black text-gray-900">Cookies Policy</h4>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 mb-5 font-medium leading-relaxed">
                    We use cookies to improve your experience on our platform. By browsing, you agree to our policies.
                </p>
                <div class="flex items-center gap-3">
                    <button onclick="acceptCookies()"
                        class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-black hover:bg-blue-700 transition shadow-lg shadow-blue-600/20">
                        Accept All
                    </button>
                    <a href="#"
                        class="text-gray-400 hover:text-gray-600 text-xs font-bold uppercase tracking-wider">Learn
                        More</a>
                </div>
            </div>
            <button onclick="closeCookies()" class="text-gray-300 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Data Info Section (Hidden by default) -->
    <div id="cookie-data-info" class="hidden animate-in fade-in slide-in-from-bottom-2 duration-700">
        <div class="flex items-center gap-2 mb-4 text-green-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-black text-sm uppercase tracking-tighter">Preference Saved!</span>
        </div>
        <h5 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Diagnostic Data</h5>
        <div class="bg-gray-50 rounded-xl p-4 space-y-3 border border-gray-100">
            <div class="flex justify-between text-xs font-bold">
                <span class="text-gray-400 uppercase tracking-tighter">Storage Items:</span>
                <span id="local-storage-count" class="font-mono text-blue-600">0</span>
            </div>
            <div class="flex justify-between text-xs font-bold">
                <span class="text-gray-400 uppercase tracking-tighter">Active Cookies:</span>
                <span id="cookie-count" class="font-mono text-blue-600">0</span>
            </div>
            <div class="flex justify-between text-xs font-black pt-3 border-t border-gray-100">
                <span class="text-gray-900 uppercase tracking-tighter">Optimized:</span>
                <span id="memory-saved" class="font-mono text-green-600">0.00 KB</span>
            </div>
        </div>
        <button onclick="closeCookies()"
            class="w-full mt-6 py-3 bg-gray-900 text-white rounded-xl text-sm font-black hover:bg-black transition shadow-xl">
            Got it
        </button>
    </div>
</div>