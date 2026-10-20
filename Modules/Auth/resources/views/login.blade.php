@extends(view()->exists('auth::layouts.auth') ? 'auth::layouts.auth' : 'layouts.auth')

@section('title', 'Sign In | Zengfy Unified Sovereign Account')
@section('meta_description', 'Sign in to access all Zengfy ecosystem products: Social, School, Law, POS, and more.')

@section('content')
<div id="react-auth-root" data-initial-mode="login"></div>
<div id="blade-auth-fallback">
<div x-data="loginForm()" class="relative">

    <!-- Ambient Soft Glow Behind Glass Card -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-blue-100/70 via-indigo-100/50 to-cyan-100/60 rounded-3xl blur-xl opacity-80 transition duration-1000 -z-10"></div>

    <div class="glass-panel rounded-3xl p-6 sm:p-9 relative overflow-hidden transition-all duration-300">
        
        <!-- Top Gradient Accent Strip -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500"></div>

        <!-- Header (Google-style Contextual SSO) -->
        <div class="text-center mb-6 relative z-10">
            @if(!empty($targetAppName) && $targetAppName !== 'Zengfy Sovereign Hub' && $targetAppName !== 'Zengfy Ecosystem')
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold mb-3.5 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>to continue to <strong class="text-slate-900 font-bold">{{ $targetAppName }}</strong></span>
                </div>
            @else
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold mb-3 shadow-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>Zengfy Central Identity & SSO</span>
                </div>
            @endif
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">লগইন করুন</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1.5">আপনার সেন্ট্রাল সার্বভৌম অ্যাকাউন্ট দিয়ে প্রবেশ করুন</p>
        </div>

        <!-- Error Notification Banner -->
        <div x-show="errorMessage" x-cloak
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-start gap-2.5">
            <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="errorMessage" class="leading-relaxed"></span>
        </div>

        <!-- Success Notification Banner -->
        <div x-show="successMessage" x-cloak
            role="status"
            aria-live="polite"
            aria-atomic="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs sm:text-sm flex items-center gap-2.5">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="successMessage" class="leading-relaxed"></span>
        </div>

        <!-- ========================================================================= -->
        <!-- STEP 1: ONLY EMAIL FIELD (Google-style Identifier-First)                  -->
        <!-- ========================================================================= -->
        <form x-show="step === 'email'" @submit.prevent="nextStep" class="space-y-4 relative z-10" x-transition:enter="transition ease-out duration-200">
            <div>
                <label for="login-email" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    ইমেইল ঠিকানা (Email Address)
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                        </svg>
                    </div>
                    <input 
                        type="email" 
                        id="login-email"
                        name="email" 
                        x-model="email" 
                        required 
                        autofocus
                        autocomplete="email"
                        placeholder="you@domain.com"
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
                <p class="text-[11px] text-slate-400 mt-1.5">প্রথমে আপনার ইমেইল প্রদান করুন, এরপর পাসওয়ার্ডের ধাপ আসবে</p>
            </div>

            <!-- Next Step Button -->
            <button 
                type="submit" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-lg shadow-blue-500/25 transition-all duration-300 transform active:scale-[0.98] cursor-pointer flex items-center justify-center gap-2 mt-4 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <span>পরবর্তী (Next)</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <!-- ========================================================================= -->
        <!-- STEP 2: ONLY PASSWORD FIELD (After email is validated)                    -->
        <!-- ========================================================================= -->
        <form x-show="step === 'password'" x-cloak @submit.prevent="submitLogin" class="space-y-4 relative z-10" x-transition:enter="transition ease-out duration-200">
            @csrf

            <!-- User Identifier Badge / Change Email Pill -->
            <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-200/80 mb-3">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shrink-0">
                        <span x-text="email.charAt(0).toUpperCase()">U</span>
                    </div>
                    <span x-text="email" class="text-xs font-semibold text-slate-800 truncate"></span>
                </div>
                <button 
                    type="button" 
                    @click="prevStep" 
                    class="text-xs font-bold text-blue-600 hover:text-blue-700 px-2 py-1 rounded-md hover:bg-blue-50 transition-colors shrink-0">
                    পরিবর্তন
                </button>
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="login-password" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                        পাসওয়ার্ড (Password)
                    </label>
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors py-1 px-1 rounded-md">
                        পাসওয়ার্ড ভুলে গেছেন?
                    </a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        :type="showPassword ? 'text' : 'password'" 
                        id="login-password"
                        name="password" 
                        x-model="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="••••••••••••"
                        class="glass-input w-full pl-11 pr-12 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                    <!-- Toggle Password Visibility Icon -->
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword" 
                        aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 pr-3.5 pl-2 flex items-center justify-center min-w-[44px] min-h-[44px] text-slate-400 hover:text-slate-600 transition-colors cursor-pointer rounded-r-xl focus-visible:outline-none">
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2.5 cursor-pointer py-1 min-h-[32px]">
                    <input 
                        type="checkbox" 
                        x-model="remember"
                        class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 cursor-pointer"
                    />
                    <span class="text-xs text-slate-600 font-medium">এই ডিভাইসে মনে রাখুন</span>
                </label>
            </div>

            <!-- Action Buttons: Back & Sign In -->
            <div class="flex items-center gap-3 pt-2">
                <button 
                    type="button" 
                    @click="prevStep"
                    class="py-3.5 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-all duration-200 cursor-pointer">
                    পূর্ববর্তী
                </button>
                <button 
                    type="submit" 
                    :disabled="loading" 
                    class="flex-1 relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-lg shadow-blue-500/25 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    
                    <span x-show="!loading" class="flex items-center gap-2">
                        <span>লগইন করুন</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>

                    <span x-show="loading" x-cloak class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>যাচাই করা হচ্ছে...</span>
                    </span>
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-3 text-slate-400 font-semibold tracking-wider">নতুন অ্যাকাউন্ট প্রয়োজন?</span>
            </div>
        </div>

        <!-- Registration Link -->
        <a href="{{ route('register', request()->query()) }}" 
           class="w-full flex items-center justify-center py-3.5 px-4 min-h-[48px] rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-all duration-200 shadow-xs focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
            নতুন সার্বভৌম অ্যাকাউন্ট তৈরি করুন
        </a>

        <!-- Ecosystem Trust Highlights -->
        <div class="mt-6 pt-5 border-t border-slate-200/80 grid grid-cols-3 gap-2 text-center text-[10px] text-slate-500">
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-blue-600 font-bold">⚡ SSO</span>
                <span>All 15 Modules</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-emerald-600 font-bold">🇧🇩 NID</span>
                <span>Anti-Bot Shield</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-cyan-600 font-bold">🔒 AES-256</span>
                <span>Encrypted Vault</span>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@push('scripts')
@vite(['resources/js/react/main.jsx'])
<script>
    function loginForm() {
        return {
            step: 'email',
            email: '',
            password: '',
            remember: true,
            showPassword: false,
            loading: false,
            errorMessage: '',
            successMessage: '',

            nextStep() {
                this.errorMessage = '';
                const trimmed = this.email.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!trimmed || !emailRegex.test(trimmed)) {
                    this.errorMessage = 'অনুগ্রহ করে একটি সঠিক ইমেইল ঠিকানা দিন (যেমন: user@example.com)';
                    return;
                }
                this.email = trimmed;
                this.step = 'password';
                this.$nextTick(() => {
                    const passInput = document.getElementById('login-password');
                    if (passInput) passInput.focus();
                });
            },

            prevStep() {
                this.errorMessage = '';
                this.step = 'email';
                this.$nextTick(() => {
                    const emailInput = document.getElementById('login-email');
                    if (emailInput) emailInput.focus();
                });
            },

            async submitLogin() {
                this.errorMessage = '';
                this.successMessage = '';

                if (!this.password) {
                    this.errorMessage = 'অনুগ্রহ করে আপনার পাসওয়ার্ড প্রদান করুন';
                    return;
                }

                this.loading = true;

                try {
                    const response = await fetch('/api/v1/auth/login', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            email: this.email,
                            password: this.password,
                            remember: this.remember,
                            device_name: navigator.userAgent.substring(0, 100),
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (response.status === 429) {
                            this.errorMessage = data.message || 'অতিরিক্ত প্রচেষ্টার কারণে সাময়িকভাবে ব্লক করা হয়েছে। কিছুক্ষণ পর চেষ্টা করুন।';
                        } else if (response.status === 423) {
                            this.errorMessage = data.message || 'বারবার ভুল চেষ্টার কারণে আপনার অ্যাকাউন্ট সাময়িক লক করা হয়েছে।';
                        } else {
                            this.errorMessage = data.message || 'ভুল ইমেইল বা পাসওয়ার্ড। অনুগ্রহ করে আবার পরীক্ষা করুন।';
                        }
                        this.loading = false;
                        return;
                    }

                    // Save token for API calls across browser sessions
                    const token = data.data?.token || data.token;
                    if (token) {
                        localStorage.setItem('zengfy_token', token);
                    }

                    this.successMessage = 'অনুমোদন সফল! ড্যাশবোর্ডে নিয়ে যাওয়া হচ্ছে...';
                    
                    setTimeout(() => {
                        const urlParams = new URLSearchParams(window.location.search);
                        let redirectUrl = urlParams.get('continue') || urlParams.get('redirect_uri') || urlParams.get('redirect_to') || urlParams.get('redirect') || '/';
                        try {
                            const parsed = new URL(redirectUrl, window.location.origin);
                            if (parsed.hostname.endsWith('zengfy.top') || parsed.hostname === 'localhost' || parsed.origin === window.location.origin) {
                                window.location.href = redirectUrl;
                            } else {
                                window.location.href = '/';
                            }
                        } catch (e) {
                            window.location.href = '/';
                        }
                    }, 500);

                } catch (error) {
                    this.errorMessage = 'সার্ভারের সাথে সংযোগ স্থাপন করা সম্ভব হয়নি। ইন্টারনেট সংযোগ পরীক্ষা করুন।';
                    this.loading = false;
                }
            }
        };
    }
</script>
@endpush
