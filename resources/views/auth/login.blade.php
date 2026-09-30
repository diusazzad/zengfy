@extends('layouts.auth')

@section('title', 'Sign In | Zengfy Unified Sovereign Account')
@section('meta_description', 'Sign in to access all Zengfy ecosystem products: Social, School, Law, POS, and more.')

@section('content')
<div x-data="loginForm()" class="relative">

    <!-- Subtle Glow Behind Card -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-blue-600/30 to-indigo-600/30 rounded-3xl blur-xl opacity-50 group-hover:opacity-100 transition duration-1000 -z-10"></div>

    <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl shadow-2xl backdrop-blur-2xl p-6 sm:p-8 relative overflow-hidden">
        
        <!-- Top Gradient Accent Line -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-400"></div>

        <!-- Header -->
        <div class="text-center mb-7">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                <span>Zengfy Central Identity & SSO</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Welcome Back</h1>
            <p class="text-sm text-gray-400 mt-1.5">Sign in to access your unified digital ecosystem</p>
        </div>

        <!-- Error Notification Banner -->
        <div x-show="errorMessage" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs sm:text-sm flex items-start gap-2.5">
            <svg class="w-5 h-5 text-rose-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="errorMessage" class="leading-relaxed"></span>
        </div>

        <!-- Success Notification Banner -->
        <div x-show="successMessage" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm flex items-center gap-2.5">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="successMessage" class="leading-relaxed"></span>
        </div>

        <!-- Login Form -->
        <form @submit.prevent="submitLogin" class="space-y-4">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="login-email" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
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
                        class="w-full pl-11 pr-4 py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="login-password" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider">
                        Password
                    </label>
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-blue-400 hover:text-blue-300 transition-colors">
                        Forgot Password?
                    </a>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
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
                        class="w-full pl-11 pr-11 py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    />
                    <!-- Toggle Password Visibility Icon -->
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword" 
                        aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-white transition-colors cursor-pointer">
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
                <label class="flex items-center gap-2 cursor-pointer">
                    <input 
                        type="checkbox" 
                        x-model="remember"
                        class="w-4 h-4 rounded bg-[#0B0F17] border-white/20 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 focus:ring-offset-transparent cursor-pointer"
                    />
                    <span class="text-xs text-gray-300">Remember this device</span>
                </label>
            </div>

            <!-- Submit Button with Loading State -->
            <button 
                type="submit" 
                :disabled="loading" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:via-indigo-500 hover:to-cyan-400 text-white font-bold py-3.5 px-4 text-sm shadow-xl shadow-blue-600/30 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 mt-2">
                
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>Sign In to Zengfy</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>

                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Authenticating Sovereign ID...</span>
                </span>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/10"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-[#121A29] px-3 text-gray-400 font-semibold tracking-wider">New to Zengfy?</span>
            </div>
        </div>

        <!-- Registration Link -->
        <a href="{{ route('register') }}" 
           class="w-full block text-center py-3 px-4 rounded-xl border border-white/15 bg-white/[0.03] hover:bg-white/[0.08] hover:border-white/30 text-white font-semibold text-sm transition-all duration-200">
            Create Sovereign Account
        </a>

        <!-- Ecosystem Trust Highlights -->
        <div class="mt-6 pt-5 border-t border-white/[0.06] grid grid-cols-3 gap-2 text-center text-[10px] text-gray-400">
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-blue-400 font-bold">⚡ SSO</span>
                <span>All 15 Modules</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-emerald-400 font-bold">🇧🇩 NID</span>
                <span>Anti-Bot Shield</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-cyan-400 font-bold">🔒 AES-256</span>
                <span>Encrypted Vault</span>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function loginForm() {
        return {
            email: '',
            password: '',
            remember: true,
            showPassword: false,
            loading: false,
            errorMessage: '',
            successMessage: '',

            async submitLogin() {
                this.errorMessage = '';
                this.successMessage = '';
                this.loading = true;

                try {
                    const response = await fetch('/api/v1/auth/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            email: this.email,
                            password: this.password,
                            device_name: navigator.userAgent.substring(0, 100),
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (response.status === 429) {
                            this.errorMessage = data.message || 'Too many attempts. You have been temporarily rate-limited for security.';
                        } else if (response.status === 423) {
                            this.errorMessage = data.message || 'Your account is temporarily locked due to repeated failed attempts.';
                        } else {
                            this.errorMessage = data.message || 'Invalid credentials. Please verify your email and password.';
                        }
                        this.loading = false;
                        return;
                    }

                    // Save token for API calls across browser sessions
                    if (data.token) {
                        localStorage.setItem('zengfy_token', data.token);
                    }

                    this.successMessage = 'Access granted! Loading your sovereign dashboard...';
                    
                    setTimeout(() => {
                        const urlParams = new URLSearchParams(window.location.search);
                        const redirectUrl = urlParams.get('redirect_uri') || '{{ route("account") }}';
                        window.location.href = redirectUrl;
                    }, 800);

                } catch (err) {
                    this.errorMessage = 'Network connection failure. Please check your connectivity and try again.';
                    this.loading = false;
                }
            },

            init() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('registered') === '1') {
                    this.successMessage = 'Account created successfully! Please sign in to verify your identity.';
                } else if (urlParams.get('reset') === '1') {
                    this.successMessage = 'Password updated securely! Sign in with your new password.';
                } else if (urlParams.get('logout') === '1') {
                    this.successMessage = 'You have safely signed out of your sovereign session.';
                }
                @if(session('success'))
                    this.successMessage = "{{ session('success') }}";
                @endif
                @if(session('error'))
                    this.errorMessage = "{{ session('error') }}";
                @endif
            }
        }
    }
</script>
@endpush
