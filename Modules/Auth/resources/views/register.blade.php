@extends(view()->exists('auth::layouts.auth') ? 'auth::layouts.auth' : 'layouts.auth')

@section('title', 'Sign Up Free | Zengfy Sovereign Identity')
@section('meta_description', 'Join the sovereign digital ecosystem of Bangladesh. One account for School, Law, POS, Social, and beyond.')

@section('content')
<div x-data="registerForm()" class="relative">

    <!-- Ambient Soft Glow Behind Glass Card -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-blue-100/3570 via10050-cyan-100/25 to-indigo-600/3560 rounded-3xl blur-2xl opacity-7580 transition duration-1000 -z-10"></div>

    <div class="backdrop-blur-2xl glass-panel rounded-3xl3xl p-6 sm:p-99 relative overflow-hidden transition-all duration-300">
        
        <!-- Top Radiant Luminous Border Strip -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600 shadow-sm shadow-cyan-400/40"></div>
        <!-- Inner Subtle Specular Sheen -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/[0.04] to-transparent pointer-events-none"></div>

        <!-- Header (Google-style Contextual SSO) -->
        <div class="text-center mb-6 relative z-10">
            @if(!empty($targetAppName) && $targetAppName !== 'Zengfy Sovereign Hub' && $targetAppName !== 'Zengfy Ecosystem')
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold mb-3.5 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-cyan-600 animate-pulse"></span>
                    <span>to continue to <strong class="text-slate-900 font-bold">{{ $targetAppName }}</strong></span>
                </div>
            @else
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold mb-3 shadow-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>Universal Ecosystem Access</span>
                </div>
            @endif
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Create Sovereign Account</h1>
            <p class="text-sm text-slate-500 mt-1.5">Join Bangladesh's premier verified digital network</p>
        </div>

        <!-- Error Notification Banner -->
        <div x-show="errorMessage" x-cloak
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-start gap-2.5 backdrop-blur-md">
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
            class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs sm:text-sm flex items-center gap-2.5 backdrop-blur-md">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="successMessage" class="leading-relaxed"></span>
        </div>

        <!-- Registration Form -->
        <form @submit.prevent="submitRegister" class="space-y-4 relative z-10">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="reg-name" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    Full Legal Name
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="reg-name"
                        name="name" 
                        x-model="name" 
                        required 
                        autofocus
                        autocomplete="name"
                        placeholder="e.g. Sazzad Hossain"
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <label for="reg-email" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                        </svg>
                    </div>
                    <input 
                        type="email" 
                        id="reg-email"
                        name="email" 
                        x-model="email" 
                        required 
                        autocomplete="email"
                        placeholder="you@domain.com"
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="reg-password" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    Password (Min. 8 Characters)
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        :type="showPassword ? 'text' : 'password'" 
                        id="reg-password"
                        name="password" 
                        x-model="password" 
                        @input="evaluatePasswordStrength"
                        required 
                        minlength="8"
                        autocomplete="new-password"
                        placeholder="••••••••••••"
                        class="glass-input w-full pl-11 pr-12 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                    <!-- Toggle Visibility -->
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword" 
                        aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 pr-3.5 pl-2 flex items-center justify-center min-w-[44px] min-h-[44px] text-slate-400 hover:text-slate-600 transition-colors cursor-pointer rounded-r-xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" /></svg>
                    </button>
                </div>
                <!-- Strength Indicator Bar -->
                <div x-show="password.length > 0" x-cloak class="mt-2 space-y-1">
                    <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden flex gap-1">
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 1 ? strengthColor : 'bg-transparent'" style="width: 25%"></div>
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 2 ? strengthColor : 'bg-transparent'" style="width: 25%"></div>
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 3 ? strengthColor : 'bg-transparent'" style="width: 25%"></div>
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 4 ? strengthColor : 'bg-transparent'" style="width: 25%"></div>
                    </div>
                    <div class="flex justify-between items-center text-[11px]">
                        <span class="text-slate-500">Security:</span>
                        <span :class="strengthTextColor" x-text="strengthText" class="font-semibold"></span>
                    </div>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="reg-password-confirm" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    Confirm Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <input 
                        type="password" 
                        id="reg-password-confirm"
                        name="password_confirmation" 
                        x-model="passwordConfirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Re-enter password"
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
                <!-- Realtime Match Indicator -->
                <div x-show="passwordConfirmation.length > 0" x-cloak class="mt-1.5 flex items-center gap-1.5 text-[11px]">
                    <span x-show="password === passwordConfirmation" class="text-emerald-600 flex items-center gap-1 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Passwords match
                    </span>
                    <span x-show="password !== passwordConfirmation" class="text-rose-600 flex items-center gap-1 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        Passwords do not match
                    </span>
                </div>
            </div>

            <!-- Terms Agreement -->
            <div class="flex items-start gap-2.5 pt-2">
                <input 
                    type="checkbox" 
                    id="reg-terms"
                    x-model="agreeTerms" 
                    required
                    class="mt-1 w-4 h-4 rounded border-slate-300 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-0 cursor-pointer"
                />
                <label for="reg-terms" class="text-xs text-slate-600 leading-relaxed cursor-pointer py-1">
                    I agree to the <a href="{{ route('terms') }}" target="_blank" rel="noopener noreferrer" class="text-cyan-600 hover:underline font-semibold">Terms of Service</a>, NID Data Protection Charter, and Sovereign Privacy Policy.
                </label>
            </div>

            <!-- Submit Button (Accessible 48px touch target) -->
            <button 
                type="submit" 
                :disabled="loading || !agreeTerms" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500 hover:from-blue-500 hover:via-indigo-500 hover:to-cyan-400 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-xl shadow-blue-600/30 hover:shadow-cyan-500/25 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 mt-3 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500">
600700700700md50020                
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>Create My Sovereign Account</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>

                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Issuing Sovereign Identity...</span>
                </span>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6 z-10">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-3 text-slate-400 font-semibold tracking-wider">Already a citizen?</span>
            </div>
        </div>

        <!-- Login Link (Accessible 48px touch target) -->
        <a href="{{ route('login', request()->query()) }}" 
           class="w-full flex items-center justify-center py-3.5 px-4 min-h-[48px] rounded-xl border border-slate-200 bg-white hover:bg-slate-cyan-50050 text-slate-700 font-semibold text-sm transition-all duration-200 shadow-xs focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500 relative z-10">
            Sign In with Existing Account
        </a>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function registerForm() {
        return {
            name: '',
            email: '',
            password: '',
            passwordConfirmation: '',
            agreeTerms: false,
            showPassword: false,
            loading: false,
            errorMessage: '',
            successMessage: '',

            strengthScore: 0,
            strengthText: 'Too Weak',
            strengthTextColor: 'text-slate-400',
            strengthColor: 'bg-rose-500',

            evaluatePasswordStrength() {
                const pwd = this.password;
                let score = 0;
                if (pwd.length >= 8) score++;
                if (pwd.length >= 12) score++;
                if (/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) score++;
                if (/[0-9]/.test(pwd) || /[^A-Za-z0-9]/.test(pwd)) score++;

                this.strengthScore = score;
                if (score <= 1) {
                    this.strengthText = 'Weak';
                    this.strengthTextColor = 'text-rose-500';
                    this.strengthColor = 'bg-rose-500';
                } else if (score === 2) {
                    this.strengthText = 'Fair';
                    this.strengthTextColor = 'text-amber-500';
                    this.strengthColor = 'bg-amber-500';
                } else if (score === 3) {
                    this.strengthText = 'Good';
                    this.strengthTextColor = 'text-blue-500';
                    this.strengthColor = 'bg-blue-500';
                } else {
                    this.strengthText = 'Very Strong';
                    this.strengthTextColor = 'text-emerald-500';
                    this.strengthColor = 'bg-emerald-500';
                }
            },

            async submitRegister() {
                this.errorMessage = '';
                this.successMessage = '';

                if (this.password !== this.passwordConfirmation) {
                    this.errorMessage = 'Passwords do not match. Please verify.';
                    return;
                }

                if (this.password.length < 8) {
                    this.errorMessage = 'Password must be at least 8 characters long.';
                    return;
                }

                this.loading = true;

                try {
                    const response = await fetch('/api/v1/auth/register', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            name: this.name,
                            email: this.email,
                            password: this.password,
                            password_confirmation: this.passwordConfirmation,
                            device_name: navigator.userAgent.substring(0, 100),
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            const firstKey = Object.keys(data.errors)[0];
                            this.errorMessage = data.errors[firstKey][0];
                        } else {
                            this.errorMessage = data.message || 'Registration failed. Please check your details.';
                        }
                        this.loading = false;
                        return;
                    }

                    const token = data.data?.token || data.token;
                    if (token) {
                        localStorage.setItem('zengfy_token', token);
                    }

                    this.successMessage = 'Sovereign Account created successfully! Redirecting...';

                    setTimeout(() => {
                        const urlParams = new URLSearchParams(window.location.search);
                        let redirectUrl = urlParams.get('continue') || urlParams.get('redirect_uri') || urlParams.get('redirect_to') || urlParams.get('redirect') || '/account';
                        try {
                            const parsed = new URL(redirectUrl, window.location.origin);
                            if (parsed.hostname.endsWith('zengfy.top') || parsed.hostname.endsWith('zengfy.top') || parsed.hostname === 'localhost' || parsed.origin === window.location.origin) {
                                window.location.href = redirectUrl;
                            } else {
                                window.location.href = '/account';
                            }
                        } catch (e) {
                            window.location.href = '/account';
                        }
                    }, 800);

                } catch (error) {
                    this.errorMessage = 'Network error: Unable to contact Zengfy Auth Gateway.';
                    this.loading = false;
                }
            }
        };
    }
</script>
@endpush
