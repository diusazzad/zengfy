@extends('layouts.auth')

@section('title', 'Recover Account | Zengfy Unified Sovereign Account')
@section('meta_description', 'Reset your Zengfy sovereign password using instant 6-digit verification code.')

@section('content')
<div x-data="forgotPasswordFlow()" class="relative">

    <!-- Subtle Glow Behind Card -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-blue-600/30 via-cyan-500/20 to-indigo-600/30 rounded-3xl blur-xl opacity-50 group-hover:opacity-100 transition duration-1000 -z-10"></div>

    <div class="bg-[#121A29]/90 border border-white/10 rounded-2xl shadow-2xl backdrop-blur-2xl p-6 sm:p-8 relative overflow-hidden">
        
        <!-- Top Gradient Accent Line -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-cyan-400 to-indigo-500"></div>

        <!-- Header -->
        <div class="text-center mb-6">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs font-semibold mb-3">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span>Sovereign Security Recovery</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight" x-text="step === 1 ? 'Password Recovery' : 'Set New Password'"></h1>
            <p class="text-sm text-gray-400 mt-1.5" x-text="step === 1 ? 'Enter your account email to receive a 6-digit verification code.' : 'Enter your 6-digit code and choose a new secure password.'"></p>
        </div>

        <!-- Error Banner (with aria-live for immediate screen reader announcement) -->
        <div x-show="errorMessage" x-cloak
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs sm:text-sm flex items-start gap-2.5">
            <svg class="w-5 h-5 text-rose-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="errorMessage" class="leading-relaxed"></span>
        </div>

        <!-- Success Banner -->
        <div x-show="successMessage" x-cloak
            role="status"
            aria-live="polite"
            aria-atomic="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm flex items-center gap-2.5">
            <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="successMessage" class="leading-relaxed"></span>
        </div>

        <!-- Local Development Hint -->
        <div x-show="devCode" x-cloak class="mb-5 p-3 rounded-xl bg-blue-500/10 border border-blue-500/30 text-blue-300 text-xs flex items-center justify-between">
            <span>Development OTP Code: <strong class="font-mono text-white text-sm" x-text="devCode"></strong></span>
            <button type="button" @click="code = devCode" class="text-[11px] underline text-cyan-300 hover:text-white py-1 px-2 min-h-[36px] flex items-center">Auto-fill</button>
        </div>

        <!-- STEP 1: Enter Email -->
        <form x-show="step === 1" @submit.prevent="requestOtp" class="space-y-4">
            <div>
                <label for="recovery-email" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
                    Your Registered Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                        </svg>
                    </div>
                    <input 
                        type="email" 
                        id="recovery-email"
                        x-model="email" 
                        required 
                        autofocus
                        autocomplete="email"
                        placeholder="you@domain.com"
                        class="w-full pl-11 pr-4 py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Submit Button (Accessible 48px touch target) -->
            <button 
                type="submit" 
                :disabled="loading" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-cyan-500 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-xl shadow-cyan-500/20 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-cyan-500">
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>Send Verification Code</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Generating Secure OTP...</span>
                </span>
            </button>
        </form>

        <!-- STEP 2: Enter Code & New Password -->
        <form x-show="step === 2" x-cloak @submit.prevent="submitReset" class="space-y-4">
            <!-- 6-digit Code -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="recovery-code" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider">
                        6-Digit Verification Code
                    </label>
                    <button type="button" @click="requestOtp" class="text-xs text-cyan-400 hover:text-cyan-300 py-1.5 px-2 min-h-[36px] inline-flex items-center">Resend Code</button>
                </div>
                <input 
                    type="text" 
                    id="recovery-code"
                    x-model="code" 
                    maxlength="6"
                    required 
                    autocomplete="one-time-code"
                    placeholder="123456"
                    class="w-full tracking-[0.5em] text-center font-mono font-bold text-lg py-2.5 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-600 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all duration-200"
                />
            </div>

            <!-- New Password -->
            <div>
                <label for="recovery-password" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
                    New Password
                </label>
                <div class="relative">
                    <input 
                        :type="showPassword ? 'text' : 'password'" 
                        id="recovery-password"
                        x-model="password" 
                        @input="evaluatePasswordStrength"
                        required 
                        autocomplete="new-password"
                        placeholder="••••••••••••"
                        class="w-full pl-4 pr-12 py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                    />
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword" 
                        aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 pr-3.5 pl-2 flex items-center justify-center min-w-[44px] min-h-[44px] text-gray-400 hover:text-white transition-colors cursor-pointer rounded-r-xl focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <!-- Password Strength Meter -->
                <div class="mt-2 space-y-1">
                    <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden flex">
                        <div class="h-full transition-all duration-300 rounded-full"
                             :class="{
                                'w-1/4 bg-rose-500': strengthLevel === 1,
                                'w-2/4 bg-amber-500': strengthLevel === 2,
                                'w-3/4 bg-blue-500': strengthLevel === 3,
                                'w-full bg-emerald-500': strengthLevel === 4,
                                'w-0': strengthLevel === 0
                             }"></div>
                    </div>
                    <div class="flex justify-between items-center text-[10px] text-gray-400">
                        <span>Strength: <strong :class="strengthTextColor" x-text="strengthLabel"></strong></span>
                        <span>Min. 8 characters</span>
                    </div>
                </div>
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="recovery-confirm" class="block text-xs font-semibold text-gray-300 mb-1.5 uppercase tracking-wider">
                    Confirm New Password
                </label>
                <input 
                    type="password" 
                    id="recovery-confirm"
                    x-model="passwordConfirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="••••••••••••"
                    class="w-full pl-4 pr-4 py-3 bg-[#0B0F17]/70 border border-white/10 rounded-xl text-white placeholder-gray-500 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                />
            </div>

            <!-- Submit Button (Accessible 48px touch target) -->
            <button 
                type="submit" 
                :disabled="loading" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-500 via-blue-600 to-cyan-500 hover:from-emerald-400 hover:to-cyan-400 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-xl shadow-blue-600/30 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>Save Password & Launch Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Updating Password Credentials...</span>
                </span>
            </button>
        </form>

        <!-- Back to Sign In Link (Accessible touch target min-h-[44px]) -->
        <div class="mt-6 pt-5 border-t border-white/[0.06] text-center">
            <a href="{{ route('login') }}" class="text-xs text-gray-400 hover:text-white transition-colors inline-flex items-center gap-1.5 py-2 px-3 min-h-[44px] rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Back to Sign In</span>
            </a>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function forgotPasswordFlow() {
        return {
            step: 1,
            email: '',
            code: '',
            password: '',
            passwordConfirmation: '',
            showPassword: false,
            loading: false,
            errorMessage: '',
            successMessage: '',
            devCode: null,
            strengthLevel: 0,
            strengthLabel: 'Too Short',
            strengthTextColor: 'text-gray-500',

            evaluatePasswordStrength() {
                const p = this.password;
                let score = 0;
                if (p.length >= 8) score++;
                if (p.length >= 12) score++;
                if (/[A-Z]/.test(p) && /[0-9]/.test(p)) score++;
                if (/[^A-Za-z0-9]/.test(p)) score++;

                this.strengthLevel = score;
                const labels = ['Too Short', 'Weak', 'Fair', 'Good', 'Strong'];
                const colors = ['text-gray-500', 'text-rose-400', 'text-amber-400', 'text-blue-400', 'text-emerald-400'];
                this.strengthLabel = labels[score];
                this.strengthTextColor = colors[score];
            },

            async requestOtp() {
                this.errorMessage = '';
                this.successMessage = '';
                this.loading = true;

                try {
                    const response = await fetch('/api/v1/auth/forgot-password', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ email: this.email })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        this.errorMessage = data.message || 'Failed to send recovery code. Ensure email is registered.';
                        this.loading = false;
                        return;
                    }

                    this.successMessage = 'A 6-digit code has been dispatched to your email address.';
                    if (data.dev_code) {
                        this.devCode = data.dev_code;
                    }
                    this.step = 2;
                    this.loading = false;

                } catch (error) {
                    this.errorMessage = 'Network error: Unable to contact Zengfy Auth Gateway.';
                    this.loading = false;
                }
            },

            async submitReset() {
                this.errorMessage = '';
                this.successMessage = '';

                if (this.password !== this.passwordConfirmation) {
                    this.errorMessage = 'Passwords do not match. Please re-enter.';
                    return;
                }

                if (this.password.length < 8) {
                    this.errorMessage = 'Password must be at least 8 characters long.';
                    return;
                }

                this.loading = true;

                try {
                    const response = await fetch('/api/v1/auth/reset-password', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            email: this.email,
                            code: this.code,
                            password: this.password,
                            password_confirmation: this.passwordConfirmation,
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        this.errorMessage = data.message || 'Invalid or expired verification code. Try again.';
                        this.loading = false;
                        return;
                    }

                    if (data.token) {
                        localStorage.setItem('zengfy_token', data.token);
                    }

                    this.successMessage = 'Password updated successfully! Launching your Sovereign Hub...';

                    setTimeout(() => {
                        window.location.href = '/account';
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
