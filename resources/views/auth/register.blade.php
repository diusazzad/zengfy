@extends('layouts.auth')

@section('title', 'Sign Up Free | Zengfy Sovereign Identity')
@section('meta_description', 'Join the sovereign digital ecosystem of Bangladesh. One account for School, Law, POS, Social, and beyond.')

@section('content')
<div x-data="registerForm()" class="relative">

    <!-- Subtle Ambient Glow -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-blue-600/30 via-indigo-600/30 to-cyan-500/30 rounded-3xl blur-xl opacity-50 group-hover:opacity-100 transition duration-1000 -z-10"></div>

    <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl shadow-2xl backdrop-blur-2xl p-6 sm:p-8 relative overflow-hidden">
        
        <!-- Top Gradient Accent Line -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-400 via-blue-600 to-indigo-600"></div>

        <!-- Header -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs font-semibold mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                <span>Universal Ecosystem Access</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Create Sovereign Account</h1>
            <p class="text-sm text-gray-400 mt-1.5">Join Bangladesh's premier verified digital network</p>
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

        <!-- Registration Form -->
        <form @submit.prevent="submitRegister" class="space-y-4">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="reg-name" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
                    Full Legal Name
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
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
                        class="w-full pl-11 pr-4 py-2.5 sm:py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <label for="reg-email" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
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
                        id="reg-email"
                        name="email" 
                        x-model="email" 
                        required 
                        autocomplete="email"
                        placeholder="sazzad@example.com"
                        class="w-full pl-11 pr-4 py-2.5 sm:py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Password Field with Strength Meter -->
            <div>
                <label for="reg-password" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
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
                        autocomplete="new-password"
                        placeholder="At least 8 characters"
                        class="w-full pl-11 pr-11 py-2.5 sm:py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    />
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

                <!-- Dynamic Password Strength Bar -->
                <div x-show="password.length > 0" x-cloak class="mt-2 space-y-1">
                    <div class="grid grid-cols-4 gap-1.5 h-1.5 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 1 ? strengthColor : 'bg-transparent'"></div>
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 2 ? strengthColor : 'bg-transparent'"></div>
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 3 ? strengthColor : 'bg-transparent'"></div>
                        <div class="h-full rounded-full transition-all duration-300" :class="strengthScore >= 4 ? strengthColor : 'bg-transparent'"></div>
                    </div>
                    <div class="flex justify-between items-center text-[10px]">
                        <span class="text-gray-400">Security Strength:</span>
                        <span :class="strengthTextColor" class="font-semibold" x-text="strengthText"></span>
                    </div>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="reg-password-confirm" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
                    Confirm Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
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
                        class="w-full pl-11 pr-4 py-2.5 sm:py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    />
                </div>
                <!-- Realtime Match Indicator -->
                <div x-show="passwordConfirmation.length > 0" x-cloak class="mt-1.5 flex items-center gap-1.5 text-[11px]">
                    <span x-show="password === passwordConfirmation" class="text-emerald-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Passwords match
                    </span>
                    <span x-show="password !== passwordConfirmation" class="text-rose-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        Passwords do not match
                    </span>
                </div>
            </div>

            <!-- Optional Smart NID Input Box -->
            <div class="pt-1">
                <div class="flex items-center justify-between mb-1.5">
                    <label for="reg-nid" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider flex items-center gap-1.5">
                        <span>National ID (NID)</span>
                        <span class="text-[10px] lowercase text-cyan-400 font-normal px-2 py-0.5 rounded-full bg-cyan-500/10 border border-cyan-500/20">Optional</span>
                    </label>
                    <span x-show="nid.length > 0" x-cloak class="text-[10px] text-gray-400" x-text="nid.length + ' digits'"></span>
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="reg-nid"
                        name="nid" 
                        x-model="nid" 
                        maxlength="17"
                        placeholder="10-digit Smart Card or 17-digit NID"
                        class="w-full pl-11 pr-4 py-2.5 sm:py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all duration-200"
                    />
                </div>
                <p class="text-[11px] text-gray-400 mt-1.5 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Verify your NID now or later to unlock the <strong class="text-cyan-300">Blue Citizen Badge</strong>.</span>
                </p>
            </div>

            <!-- Terms Agreement -->
            <div class="flex items-start gap-2.5 pt-2">
                <input 
                    type="checkbox" 
                    id="reg-terms"
                    x-model="agreeTerms" 
                    required
                    class="mt-1 w-4 h-4 rounded bg-[#0B0F17] border-white/20 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 focus:ring-offset-transparent cursor-pointer"
                />
                <label for="reg-terms" class="text-xs text-gray-400 leading-relaxed cursor-pointer">
                    I agree to the <a href="{{ route('terms') }}" target="_blank" class="text-blue-400 hover:underline">Terms of Service</a>, NID Data Protection Charter, and Sovereign Privacy Policy.
                </label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                :disabled="loading || !agreeTerms" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600 hover:from-cyan-400 hover:via-blue-500 hover:to-indigo-500 text-white font-bold py-3.5 px-4 text-sm shadow-xl shadow-blue-600/30 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 mt-3">
                
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>Create My Sovereign Account</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>

                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Issuing Sovereign Identity...</span>
                </span>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/10"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-[#121A29] px-3 text-gray-400 font-semibold tracking-wider">Already a citizen?</span>
            </div>
        </div>

        <!-- Login Link -->
        <a href="{{ route('login') }}" 
           class="w-full block text-center py-3 px-4 rounded-xl border border-white/15 bg-white/[0.03] hover:bg-white/[0.08] hover:border-white/30 text-white font-semibold text-sm transition-all duration-200">
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
            nid: '',
            agreeTerms: false,
            showPassword: false,
            loading: false,
            errorMessage: '',
            successMessage: '',

            // Strength Meter Properties
            strengthScore: 0,
            strengthText: 'Too Weak',
            strengthColor: 'bg-rose-500',
            strengthTextColor: 'text-rose-400',

            evaluatePasswordStrength() {
                const pwd = this.password;
                let score = 0;
                if (pwd.length >= 8) score++;
                if (/[A-Z]/.test(pwd)) score++;
                if (/[0-9]/.test(pwd)) score++;
                if (/[^A-Za-z0-9]/.test(pwd)) score++;

                this.strengthScore = score;
                if (score === 0 || pwd.length < 6) {
                    this.strengthText = 'Very Weak';
                    this.strengthColor = 'bg-rose-600';
                    this.strengthTextColor = 'text-rose-400';
                } else if (score === 1) {
                    this.strengthText = 'Weak';
                    this.strengthColor = 'bg-amber-500';
                    this.strengthTextColor = 'text-amber-400';
                } else if (score === 2 || score === 3) {
                    this.strengthText = 'Good';
                    this.strengthColor = 'bg-blue-500';
                    this.strengthTextColor = 'text-blue-400';
                } else if (score >= 4) {
                    this.strengthText = 'Sovereign 256-Bit';
                    this.strengthColor = 'bg-emerald-400';
                    this.strengthTextColor = 'text-emerald-400';
                }
            },

            async submitRegister() {
                this.errorMessage = '';
                this.successMessage = '';

                if (this.password !== this.passwordConfirmation) {
                    this.errorMessage = 'Passwords do not match. Please verify both fields.';
                    return;
                }

                if (!this.agreeTerms) {
                    this.errorMessage = 'You must accept the Terms of Service to create an account.';
                    return;
                }

                this.loading = true;

                try {
                    // Generate idempotency key for network resilience
                    const idempotencyKey = (crypto && crypto.randomUUID) ? crypto.randomUUID() : 'idemp_' + Date.now();

                    const response = await fetch('/api/v1/auth/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Idempotency-Key': idempotencyKey,
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),
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
                        if (response.status === 422 && data.errors) {
                            const firstErrorKey = Object.keys(data.errors)[0];
                            this.errorMessage = data.errors[firstErrorKey][0];
                        } else if (response.status === 429) {
                            this.errorMessage = data.message || 'Rate limit exceeded. Please wait a few moments before trying again.';
                        } else {
                            this.errorMessage = data.message || 'Registration could not be completed. Please try again.';
                        }
                        this.loading = false;
                        return;
                    }

                    // Save token if provided
                    if (data.token) {
                        localStorage.setItem('zengfy_token', data.token);
                    }

                    this.successMessage = 'Sovereign Account created successfully! Preparing your sovereign dashboard...';

                    setTimeout(() => {
                        window.location.href = '{{ route("account") }}?welcome=1';
                    }, 1000);

                } catch (err) {
                    this.errorMessage = 'Network connection failed. Please check your connectivity and try again.';
                    this.loading = false;
                }
            }
        }
    }
</script>
@endpush
