@extends(view()->exists('auth::layouts.auth') ? 'auth::layouts.auth' : 'layouts.auth')

@section('title', 'Recover Sovereign Account | Zengfy')
@section('meta_description', 'Recover your Zengfy sovereign citizen account in 3 secure steps using cryptographic 6-digit OTP.')

@section('content')
<div x-data="forgotPasswordFlow()" class="relative">

    <!-- Ambient Soft Glow Behind Card -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-amber-100/70 via-blue-100/50 to-indigo-100/60 rounded-3xl blur-xl opacity-80 transition duration-1000 -z-10"></div>

    <div class="glass-panel rounded-3xl p-6 sm:p-8 relative overflow-hidden transition-all duration-300">
        
        <!-- Top Gradient Accent Strip with Night Amber Tone -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-indigo-600"></div>

        <!-- 3-Step Visual Progress Stepper -->
        <div class="mb-7">
            <div class="flex items-center justify-between max-w-xs mx-auto mb-2">
                <!-- Step 1 Dot -->
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black transition-all duration-300"
                         :class="step >= 1 ? (step === 1 ? 'bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-950 shadow-md shadow-amber-500/20 ring-2 ring-amber-400/50' : 'bg-amber-100 text-amber-700 border border-amber-300') : 'bg-slate-100 text-slate-400'">
                        <span x-show="step > 1">✓</span>
                        <span x-show="step <= 1">১</span>
                    </div>
                    <span class="text-[10px] font-semibold mt-1" :class="step === 1 ? 'text-amber-700' : (step > 1 ? 'text-amber-600' : 'text-slate-400')">ইমেইল</span>
                </div>

                <!-- Line 1-2 -->
                <div class="flex-1 h-0.5 mx-2 -mt-4 transition-all duration-500"
                     :class="step >= 2 ? 'bg-gradient-to-r from-amber-400 to-amber-500' : 'bg-slate-200'"></div>

                <!-- Step 2 Dot -->
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black transition-all duration-300"
                         :class="step >= 2 ? (step === 2 ? 'bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-950 shadow-md shadow-amber-500/20 ring-2 ring-amber-400/50' : 'bg-amber-100 text-amber-700 border border-amber-300') : 'bg-slate-100 text-slate-400'">
                        <span x-show="step > 2">✓</span>
                        <span x-show="step <= 2">২</span>
                    </div>
                    <span class="text-[10px] font-semibold mt-1" :class="step === 2 ? 'text-amber-700' : (step > 2 ? 'text-amber-600' : 'text-slate-400')">ওটিপি কোড</span>
                </div>

                <!-- Line 2-3 -->
                <div class="flex-1 h-0.5 mx-2 -mt-4 transition-all duration-500"
                     :class="step >= 3 ? 'bg-gradient-to-r from-amber-400 to-emerald-500' : 'bg-slate-200'"></div>

                <!-- Step 3 Dot -->
                <div class="flex flex-col items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black transition-all duration-300"
                         :class="step >= 3 ? 'bg-gradient-to-r from-emerald-500 to-teal-400 text-white shadow-md shadow-emerald-500/20 ring-2 ring-emerald-400/50' : 'bg-slate-100 text-slate-400'">
                        <span>৩</span>
                    </div>
                    <span class="text-[10px] font-semibold mt-1" :class="step === 3 ? 'text-emerald-700' : 'text-slate-400'">নতুন পাসওয়ার্ড</span>
                </div>
            </div>
        </div>

        <!-- Step Titles & Descriptions -->
        <div class="text-center mb-6">
            <template x-if="step === 1">
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">অ্যাকাউন্ট পুনরুদ্ধার</h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-sm mx-auto">
                        আপনার নিবন্ধিত ইমেইল ঠিকানা দিন। আমরা তাৎক্ষণিক একটি ৬-ডিজিটের সিকিউর ভেরিফিকেশন কোড পাঠাব।
                    </p>
                </div>
            </template>
            <template x-if="step === 2">
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">ওটিপি কোড যাচাই</h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-sm mx-auto">
                        <span class="text-amber-700 font-mono font-bold" x-text="email"></span> ঠিকানায় পাঠানো ৬-সংখ্যার কোডটি প্রবেশ করান।
                    </p>
                </div>
            </template>
            <template x-if="step === 3">
                <div>
                    <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">নতুন পাসওয়ার্ড নির্ধারণ</h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-sm mx-auto">
                        আপনার অ্যাকাউন্টের জন্য একটি শক্তিশালী এবং নিরাপদ নতুন পাসওয়ার্ড সেট করুন।
                    </p>
                </div>
            </template>
        </div>

        <!-- Error Alert Banner -->
        <div x-show="errorMessage" x-cloak
            role="alert"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs sm:text-sm flex items-start gap-2.5">
            <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="errorMessage" class="leading-relaxed"></span>
        </div>

        <!-- Success Alert Banner -->
        <div x-show="successMessage" x-cloak
            role="status"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs sm:text-sm flex items-center gap-2.5">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span x-text="successMessage" class="leading-relaxed"></span>
        </div>

        <!-- Local Development OTP Hint Badge -->
        <div x-show="devCode && step === 2" x-cloak class="mb-5 p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-xs flex items-center justify-between">
            <span>টেস্টিং ওটিপি কোড: <strong class="font-mono text-amber-900 text-sm ml-1" x-text="devCode"></strong></span>
            <button type="button" @click="autoFillDevCode()" class="text-[11px] font-bold text-slate-900 bg-amber-200 hover:bg-amber-300 py-1 px-2.5 rounded-lg border border-amber-300 transition cursor-pointer shadow-xs">
                স্বয়ংক্রিয় পূরণ
            </button>
        </div>

        <!-- ========================================== -->
        <!-- ধাপ ১ (STEP 1): Enter Email                -->
        <!-- ========================================== -->
        <form x-show="step === 1" @submit.prevent="requestOtp" class="space-y-4">
            <div>
                <label for="recovery-email" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    আপনার নিবন্ধিত ইমেইল
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
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
                        placeholder="citizen@zengfy.com"
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                :disabled="loading" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-amber-500 via-amber-600 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-slate-950 font-black py-3.5 px-4 min-h-[48px] text-sm shadow-md shadow-amber-500/20 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2">
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>ভেরিফিকেশন কোড পাঠান</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-slate-950" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>ওটিপি কোড জেনারেট হচ্ছে...</span>
                </span>
            </button>
        </form>

        <!-- ========================================== -->
        <!-- ধাপ ২ (STEP 2): 6-Digit OTP Verification   -->
        <!-- ========================================== -->
        <form x-show="step === 2" x-cloak @submit.prevent="verifyOtpCode" class="space-y-5">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                        ৬-সংখ্যার কোড প্রবেশ করান
                    </label>
                    <button type="button" @click="step = 1" class="text-[11px] text-blue-600 hover:underline font-medium">
                        ইমেইল পরিবর্তন
                    </button>
                </div>

                <!-- 6 Digit Boxes Grid -->
                <div class="grid grid-cols-6 gap-2 sm:gap-3 max-w-sm mx-auto">
                    <template x-for="(d, idx) in 6" :key="idx">
                        <input 
                            type="text" 
                            maxlength="1"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            :id="'otp-box-' + idx"
                            x-model="otpDigits[idx]"
                            @input="handleOtpInput($event, idx)"
                            @keydown="handleOtpKeydown($event, idx)"
                            @paste="handleOtpPaste($event)"
                            class="glass-input w-full aspect-square text-center font-mono font-black text-xl sm:text-2xl rounded-xl text-slate-900 focus:outline-none transition-all duration-200"
                            :class="otpDigits[idx] ? 'border-amber-500 shadow-xs ring-2 ring-amber-400/30 bg-amber-50/50' : 'border-slate-200 focus:border-amber-500'"
                        />
                    </template>
                </div>
            </div>

            <!-- Resend Countdown & Action -->
            <div class="flex items-center justify-between text-xs text-slate-500 pt-1">
                <span x-show="countdown > 0">
                    পুনরায় কোড পাঠানোর অপেক্ষা: <strong class="text-amber-700 font-mono" x-text="countdown + ' সেকেন্ড'"></strong>
                </span>
                <button 
                    x-show="countdown === 0" 
                    type="button" 
                    @click="requestOtp" 
                    class="text-xs text-blue-600 hover:text-blue-700 font-semibold underline cursor-pointer">
                    পুনরায় কোড পাঠান
                </button>
            </div>

            <!-- Verify Code Button -->
            <button 
                type="submit" 
                :disabled="loading || fullOtpCode.length !== 6" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-amber-500 via-amber-600 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-slate-950 font-black py-3.5 px-4 min-h-[48px] text-sm shadow-md shadow-amber-500/20 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2">
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>কোড যাচাই ও পরবর্তী ধাপ</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-slate-950" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>কোড যাচাই করা হচ্ছে...</span>
                </span>
            </button>
        </form>

        <!-- ========================================== -->
        <!-- ধাপ ৩ (STEP 3): Set New Secure Password    -->
        <!-- ========================================== -->
        <form x-show="step === 3" x-cloak @submit.prevent="submitReset" class="space-y-4">
            <!-- New Password Field -->
            <div>
                <label for="recovery-password" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    নতুন পাসওয়ার্ড
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
                        class="glass-input w-full pl-4 pr-12 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword" 
                        aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 pr-3.5 pl-2 flex items-center justify-center min-w-[44px] min-h-[44px] text-slate-400 hover:text-slate-600 transition-colors cursor-pointer rounded-r-xl">
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
                    <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden flex">
                        <div class="h-full transition-all duration-300 rounded-full"
                             :class="{
                                'w-1/4 bg-rose-500': strengthLevel === 1,
                                'w-2/4 bg-amber-500': strengthLevel === 2,
                                'w-3/4 bg-blue-500': strengthLevel === 3,
                                'w-full bg-emerald-500': strengthLevel === 4,
                                'w-0': strengthLevel === 0
                             }"></div>
                    </div>
                    <div class="flex justify-between items-center text-[10px] text-slate-500">
                        <span>পাসওয়ার্ড শক্তি: <strong :class="strengthTextColor" x-text="strengthLabel"></strong></span>
                        <span>কমপক্ষে ৮ অক্ষর আবশ্যক</span>
                    </div>
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label for="recovery-confirm" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    পাসওয়ার্ড নিশ্চিত করুন
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="recovery-confirm"
                        x-model="passwordConfirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="••••••••••••"
                        class="glass-input w-full pl-4 pr-10 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                        :class="passwordConfirmation && password === passwordConfirmation ? 'border-emerald-500 ring-2 ring-emerald-500/20' : ''"
                    />
                    <div x-show="passwordConfirmation" class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                        <span x-show="password === passwordConfirmation" class="text-emerald-600 text-sm font-bold">✓</span>
                        <span x-show="password !== passwordConfirmation" class="text-rose-600 text-sm font-bold">✕</span>
                    </div>
                </div>
            </div>

            <!-- Save & Submit Button -->
            <button 
                type="submit" 
                :disabled="loading || password.length < 8 || password !== passwordConfirmation" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-600 via-teal-600 to-blue-600 hover:from-emerald-700 hover:to-blue-700 text-white font-black py-3.5 px-4 min-h-[48px] text-sm shadow-md shadow-emerald-500/20 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2">
                <span x-show="!loading" class="flex items-center gap-2">
                    <span>পাসওয়ার্ড পরিবর্তন ও ড্যাশবোর্ডে প্রবেশ</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
                <span x-show="loading" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>নতুন ক্রেডেনশিয়াল আপডেট হচ্ছে...</span>
                </span>
            </button>
        </form>

        <!-- Back to Sign In Link -->
        <div class="mt-6 pt-5 border-t border-slate-200/80 text-center">
            <a href="{{ route('login') }}" class="text-xs text-slate-500 hover:text-blue-600 font-medium transition-colors inline-flex items-center gap-1.5 py-2 px-3 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>সাইন-ইন পেজে ফিরে যান</span>
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
        otpDigits: ['', '', '', '', '', ''],
        password: '',
        passwordConfirmation: '',
        showPassword: false,
        loading: false,
        errorMessage: '',
        successMessage: '',
        devCode: null,
        countdown: 0,
        countdownTimer: null,
        strengthLevel: 0,
        strengthLabel: 'খুব ছোট',
        strengthTextColor: 'text-slate-400',

        get fullOtpCode() {
            return this.otpDigits.join('');
        },

        autoFillDevCode() {
            if (!this.devCode || this.devCode.length !== 6) return;
            for (let i = 0; i < 6; i++) {
                this.otpDigits[i] = this.devCode[i];
            }
            const lastBox = document.getElementById('otp-box-5');
            if (lastBox) lastBox.focus();
        },

        handleOtpInput(e, idx) {
            const val = e.target.value.replace(/[^0-9]/g, '');
            this.otpDigits[idx] = val.slice(-1);
            if (val && idx < 5) {
                const nextBox = document.getElementById('otp-box-' + (idx + 1));
                if (nextBox) nextBox.focus();
            }
        },

        handleOtpKeydown(e, idx) {
            if (e.key === 'Backspace' && !this.otpDigits[idx] && idx > 0) {
                const prevBox = document.getElementById('otp-box-' + (idx - 1));
                if (prevBox) {
                    prevBox.focus();
                    this.otpDigits[idx - 1] = '';
                }
            }
        },

        handleOtpPaste(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
            if (!text) return;
            for (let i = 0; i < 6; i++) {
                this.otpDigits[i] = text[i] || '';
            }
            const targetIdx = Math.min(text.length, 5);
            const box = document.getElementById('otp-box-' + targetIdx);
            if (box) box.focus();
        },

        evaluatePasswordStrength() {
            const p = this.password;
            let score = 0;
            if (p.length >= 8) score++;
            if (/[A-Z]/.test(p) && /[a-z]/.test(p)) score++;
            if (/[0-9]/.test(p)) score++;
            if (/[^A-Za-z0-9]/.test(p)) score++;

            this.strengthLevel = score;
            const labels = ['খুব ছোট', 'দুর্বল', 'মোটামুটি', 'শক্তিশালী', 'অত্যন্ত শক্তিশালী'];
            const colors = ['text-slate-400', 'text-rose-500', 'text-amber-500', 'text-blue-600', 'text-emerald-600'];
            this.strengthLabel = labels[score] || 'দুর্বল';
            this.strengthTextColor = colors[score] || 'text-rose-500';
        },

        startCountdown(seconds = 60) {
            this.countdown = seconds;
            if (this.countdownTimer) clearInterval(this.countdownTimer);
            this.countdownTimer = setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) {
                    clearInterval(this.countdownTimer);
                }
            }, 1000);
        },

        async requestOtp() {
            this.errorMessage = '';
            this.successMessage = '';
            this.loading = true;

            try {
                const response = await fetch('/api/v1/auth/forgot-password/request-otp', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ email: this.email })
                });

                const data = await response.json();

                if (!response.ok) {
                    this.errorMessage = data.message || 'ওটিপি পাঠাতে সমস্যা হয়েছে। পুনরায় চেষ্টা করুন।';
                    this.loading = false;
                    return;
                }

                this.devCode = data.data?.dev_otp || null;
                this.successMessage = data.message || '৬-ডিজিটের ভেরিফিকেশন কোড পাঠানো হয়েছে।';
                this.step = 2;
                this.startCountdown(60);

                setTimeout(() => {
                    const box0 = document.getElementById('otp-box-0');
                    if (box0) box0.focus();
                }, 200);

            } catch (err) {
                this.errorMessage = 'নেটওয়ার্ক সংযোগ ত্রুটি। অনুগ্রহ করে ইন্টারনেটের গতি পরীক্ষা করুন।';
            } finally {
                this.loading = false;
            }
        },

        async verifyOtpCode() {
            if (this.fullOtpCode.length !== 6) {
                this.errorMessage = 'অনুগ্রহ করে সম্পূর্ণ ৬-সংখ্যার কোড প্রবেশ করান।';
                return;
            }

            this.errorMessage = '';
            this.successMessage = '';
            this.loading = true;

            try {
                const response = await fetch('/api/v1/auth/forgot-password/verify-otp', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        email: this.email,
                        otp: this.fullOtpCode
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    this.errorMessage = data.message || 'ভুল বা মেয়াদোত্তীর্ণ ওটিপি কোড।';
                    this.loading = false;
                    return;
                }

                this.successMessage = 'ওটিপি কোড সফলভাবে যাচাই হয়েছে। নতুন পাসওয়ার্ড দিন।';
                this.step = 3;

                setTimeout(() => {
                    const passInput = document.getElementById('recovery-password');
                    if (passInput) passInput.focus();
                }, 200);

            } catch (err) {
                this.errorMessage = 'নেটওয়ার্ক সংযোগ ত্রুটি।';
            } finally {
                this.loading = false;
            }
        },

        async submitReset() {
            if (this.password !== this.passwordConfirmation) {
                this.errorMessage = 'উভয় পাসওয়ার্ড হুবহু মিলছে না।';
                return;
            }

            if (this.password.length < 8) {
                this.errorMessage = 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।';
                return;
            }

            this.errorMessage = '';
            this.successMessage = '';
            this.loading = true;

            try {
                const response = await fetch('/api/v1/auth/forgot-password/reset', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        email: this.email,
                        otp: this.fullOtpCode,
                        password: this.password,
                        password_confirmation: this.passwordConfirmation
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    this.errorMessage = data.message || 'পাসওয়ার্ড রিসেট করা সম্ভব হয়নি।';
                    this.loading = false;
                    return;
                }

                this.successMessage = 'পাসওয়ার্ড সফলভাবে পরিবর্তিত হয়েছে! ড্যাশবোর্ডে প্রবেশ করা হচ্ছে...';

                setTimeout(() => {
                    window.location.href = '/account';
                }, 800);

            } catch (err) {
                this.errorMessage = 'নেটওয়ার্ক সংযোগ ত্রুটি।';
            } finally {
                this.loading = false;
            }
        }
    };
}
</script>
@endpush
