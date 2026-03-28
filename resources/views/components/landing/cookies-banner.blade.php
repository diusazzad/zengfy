<!-- p:\Zengfy-Ecosystem\core\resources\views\components\landing\cookies-banner.blade.php -->
<div id="cookie-banner" 
     class="fixed z-[100] transition-all duration-700 transform translate-y-full opacity-0 pointer-events-none
            inset-x-4 bottom-4 md:inset-x-auto md:right-6 md:bottom-6 md:max-w-sm w-full md:w-auto">
    <div class="bg-white/80 backdrop-blur-2xl border border-white/20 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] p-6 md:p-8 relative overflow-hidden group">
        <!-- Decorative Gradient -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-colors duration-700"></div>
        
        <div class="relative flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-blue-50/50 rounded-2xl flex items-center justify-center text-2xl shadow-inner">
                    🍪
                </div>
                <div>
                    <h4 class="font-black text-gray-900 tracking-tight">Cookies Policy</h4>
                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Privacy First</p>
                </div>
            </div>
            
            <p class="text-xs sm:text-sm text-gray-600 font-medium leading-relaxed">
                আমরা আপনার অভিজ্ঞতা উন্নত করতে কুকি ব্যবহার করি। সাইটটি ব্যবহার চালিয়ে যাওয়ার মাধ্যমে আপনি আমাদের <a href="#" class="text-blue-600 hover:underline">কুকি পলিসি</a> মেনে নিচ্ছেন।
            </p>

            <div class="flex items-center gap-3 pt-2">
                <button onclick="acceptCookies()" 
                        class="flex-1 md:flex-none bg-gray-900 text-white px-8 py-3.5 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg hover:shadow-blue-500/25 active:scale-95">
                    Accept All
                </button>
                <button onclick="hideBanner()" 
                        class="px-6 py-3.5 text-gray-400 hover:text-gray-900 text-xs font-black uppercase tracking-widest transition-colors">
                    Later
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const COOKIE_NAME = 'zengfy_cookie_consent';
    const EXPIRY_DAYS = 30;

    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/;SameSite=Lax";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i=0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function showBanner() {
        const banner = document.getElementById('cookie-banner');
        banner.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');
        banner.classList.add('translate-y-0', 'opacity-100');
    }

    function hideBanner() {
        const banner = document.getElementById('cookie-banner');
        banner.classList.add('translate-y-full', 'opacity-0');
        setTimeout(() => {
            banner.classList.add('pointer-events-none');
        }, 700);
    }

    function acceptCookies() {
        setCookie(COOKIE_NAME, 'accepted', EXPIRY_DAYS);
        hideBanner();
        // Trigger diagnostic event if needed
        console.log('🍪 Settings saved for ' + EXPIRY_DAYS + ' days');
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (!getCookie(COOKIE_NAME)) {
            setTimeout(showBanner, 2000); // 2 second delay for better UX
        }
    });
</script>