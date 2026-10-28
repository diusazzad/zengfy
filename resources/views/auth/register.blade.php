@extends(view()->exists('auth::layouts.auth') ? 'auth::layouts.auth' : 'layouts.auth')

@section('title', 'Sign Up Free | Zengfy Sovereign Identity')
@section('meta_description', 'Join the sovereign digital ecosystem of Bangladesh. One account for School, Law, POS, Social, and beyond.')

@push('head')
<script>
    function registerForm() {
        return {
            step: 'identity', // 'identity' (Step 1) | 'credentials' (Step 2) | 'verification' (Step 3)
            name: '',
            dateOfBirth: '',
            gender: 'male',
            email: '',
            password: '',
            passwordConfirmation: '',
            website: '', // Honeypot
            agreeTerms: false,
            showPassword: false,
            loading: false,
            errorMessage: '',
            successMessage: '',

            // 6-Digit Email OTP Verification State
            registeredUserId: '',
            registeredEmail: '',
            devCode: '',
            otpDigits: ['', '', '', '', '', ''],
            verifying: false,
            resending: false,
            timerSeconds: 600,
            timerInterval: null,
            resendCooldown: 60,
            resendInterval: null,
            canResend: false,

            strengthScore: 0,
            strengthText: 'দুর্বল (Weak)',
            strengthTextColor: 'text-slate-400',
            strengthColor: 'bg-rose-500',

            nextStep: function() {
                this.errorMessage = '';
                var trimmedName = (this.name || '').trim();
                if (!trimmedName || trimmedName.length < 2) {
                    this.errorMessage = 'অনুগ্রহ করে আপনার পুরো নাম প্রদান করুন (কমপক্ষে ২ অক্ষর)।';
                    return;
                }
                if (!this.dateOfBirth) {
                    this.errorMessage = 'অনুগ্রহ করে আপনার জন্মতারিখ নির্বাচন করুন।';
                    return;
                }
                if (!this.gender) {
                    this.errorMessage = 'অনুগ্রহ করে আপনার লিঙ্গ (Gender) নির্বাচন করুন।';
                    return;
                }

                this.step = 'credentials';
                if (this.$nextTick) {
                    this.$nextTick(function() {
                        var emailInput = document.getElementById('reg-email');
                        if (emailInput) emailInput.focus();
                    });
                }
            },

            prevStep: function() {
                this.errorMessage = '';
                this.step = 'identity';
                if (this.$nextTick) {
                    this.$nextTick(function() {
                        var nameInput = document.getElementById('reg-name');
                        if (nameInput) nameInput.focus();
                    });
                }
            },

            backToEditEmail: function() {
                this.errorMessage = '';
                this.successMessage = '';
                this.step = 'credentials';
                if (this.$nextTick) {
                    this.$nextTick(function() {
                        var emailInput = document.getElementById('reg-email');
                        if (emailInput) emailInput.focus();
                    });
                }
            },

            startCountdown: function(duration) {
                if (this.timerInterval) clearInterval(this.timerInterval);
                this.timerSeconds = duration || 600;
                var self = this;
                this.timerInterval = setInterval(function() {
                    if (self.timerSeconds > 0) {
                        self.timerSeconds--;
                    } else {
                        clearInterval(self.timerInterval);
                    }
                }, 1000);
            },

            get formattedTimer() {
                var mins = Math.floor(this.timerSeconds / 60);
                var secs = this.timerSeconds % 60;
                return (mins < 10 ? '0' : '') + mins + ':' + (secs < 10 ? '0' : '') + secs;
            },

            startResendCooldown: function(cooldown) {
                if (this.resendInterval) clearInterval(this.resendInterval);
                this.resendCooldown = cooldown || 60;
                this.canResend = false;
                var self = this;
                this.resendInterval = setInterval(function() {
                    if (self.resendCooldown > 0) {
                        self.resendCooldown--;
                    } else {
                        self.canResend = true;
                        clearInterval(self.resendInterval);
                    }
                }, 1000);
            },

            handleOtpInput: function(index, e) {
                var val = e.target.value.replace(/[^0-9]/g, '');
                if (val.length > 1) {
                    var chars = val.split('');
                    for (var i = 0; i < 6; i++) {
                        if (chars[i]) this.otpDigits[i] = chars[i];
                    }
                    var nextIndex = Math.min(chars.length, 5);
                    var nextEl = document.getElementById('otp-box-' + nextIndex);
                    if (nextEl) nextEl.focus();
                    if (this.otpDigits.join('').length === 6) {
                        this.submitVerifyOtp();
                    }
                    return;
                }

                this.otpDigits[index] = val;
                if (val && index < 5) {
                    var nextEl = document.getElementById('otp-box-' + (index + 1));
                    if (nextEl) nextEl.focus();
                }

                if (this.otpDigits.join('').length === 6) {
                    this.submitVerifyOtp();
                }
            },

            handleOtpKeydown: function(index, e) {
                if (e.key === 'Backspace' && !this.otpDigits[index] && index > 0) {
                    var prevEl = document.getElementById('otp-box-' + (index - 1));
                    if (prevEl) {
                        prevEl.focus();
                        this.otpDigits[index - 1] = '';
                    }
                } else if (e.key === 'ArrowLeft' && index > 0) {
                    var prevEl = document.getElementById('otp-box-' + (index - 1));
                    if (prevEl) prevEl.focus();
                } else if (e.key === 'ArrowRight' && index < 5) {
                    var nextEl = document.getElementById('otp-box-' + (index + 1));
                    if (nextEl) nextEl.focus();
                }
            },

            handleOtpPaste: function(e) {
                e.preventDefault();
                var clipboardData = e.clipboardData || window.clipboardData;
                var pastedData = clipboardData.getData('Text').replace(/[^0-9]/g, '');
                if (pastedData.length >= 6) {
                    var digits = pastedData.slice(0, 6).split('');
                    this.otpDigits = digits;
                    var lastEl = document.getElementById('otp-box-5');
                    if (lastEl) lastEl.focus();
                    this.submitVerifyOtp();
                }
            },

            fillDevCode: function() {
                if (this.devCode && this.devCode.length === 6) {
                    this.otpDigits = this.devCode.split('');
                    this.submitVerifyOtp();
                }
            },

            evaluatePasswordStrength: function() {
                var pwd = this.password || '';
                var score = 0;
                if (pwd.length >= 8) score++;
                if (pwd.length >= 12) score++;
                if (/[A-Z]/.test(pwd) && /[a-z]/.test(pwd)) score++;
                if (/[0-9]/.test(pwd) || /[^A-Za-z0-9]/.test(pwd)) score++;

                this.strengthScore = score;
                if (score <= 1) {
                    this.strengthText = 'দুর্বল (Weak)';
                    this.strengthTextColor = 'text-rose-500';
                    this.strengthColor = 'bg-rose-500';
                } else if (score === 2) {
                    this.strengthText = 'মাঝারি (Fair)';
                    this.strengthTextColor = 'text-amber-500';
                    this.strengthColor = 'bg-amber-500';
                } else if (score === 3) {
                    this.strengthText = 'শক্তিশালী (Good)';
                    this.strengthTextColor = 'text-blue-500';
                    this.strengthColor = 'bg-blue-500';
                } else {
                    this.strengthText = 'খুবই শক্তিশালী (Very Strong)';
                    this.strengthTextColor = 'text-emerald-500';
                    this.strengthColor = 'bg-emerald-500';
                }
            },

            submitRegister: async function() {
                this.errorMessage = '';
                this.successMessage = '';

                var trimmedEmail = (this.email || '').trim();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(trimmedEmail)) {
                    this.errorMessage = 'একটি সঠিক ও কার্যকর ইমেইল ঠিকানা প্রদান করুন।';
                    return;
                }

                if (!this.password || this.password.length < 8) {
                    this.errorMessage = 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।';
                    return;
                }

                if (this.password !== this.passwordConfirmation) {
                    this.errorMessage = 'উভয় পাসওয়ার্ড হুবহু একই হতে হবে। অনুগ্রহ করে নিশ্চিত করুন।';
                    return;
                }

                this.loading = true;

                try {
                    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    var csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

                    var response = await fetch('/api/v1/auth/register', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            name: (this.name || '').trim(),
                            date_of_birth: this.dateOfBirth,
                            gender: this.gender,
                            email: trimmedEmail,
                            password: this.password,
                            password_confirmation: this.passwordConfirmation,
                            website: this.website,
                            device_name: typeof navigator !== 'undefined' ? navigator.userAgent.substring(0, 100) : 'Web Client',
                        })
                    });

                    var data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            var firstKey = Object.keys(data.errors)[0];
                            this.errorMessage = data.errors[firstKey][0];
                        } else {
                            this.errorMessage = data.message || 'রেজিস্ট্রেশন ব্যর্থ হয়েছে। অনুগ্রহ করে তথ্য যাচাই করুন।';
                        }
                        this.loading = false;
                        return;
                    }

                    // Transition to Step 3: Email OTP Verification
                    this.registeredUserId = (data.data && data.data.user_id) ? data.data.user_id : '';
                    this.registeredEmail = (data.data && data.data.email) ? data.data.email : trimmedEmail;
                    this.devCode = (data.data && data.data.dev_code) ? data.data.dev_code : '';
                    this.otpDigits = ['', '', '', '', '', ''];
                    this.step = 'verification';
                    this.loading = false;
                    this.successMessage = data.message || 'আপনার ইমেইলে ৬-ডিজিটের ভেরিফিকেশন কোড পাঠানো হয়েছে। কোডটি নিচে দিন।';
                    this.startCountdown(data.data ? data.data.expires_in_seconds : 600);
                    this.startResendCooldown(60);

                    if (this.$nextTick) {
                        this.$nextTick(function() {
                            var firstEl = document.getElementById('otp-box-0');
                            if (firstEl) firstEl.focus();
                        });
                    }

                } catch (error) {
                    this.errorMessage = 'সার্ভারের সাথে সংযোগ স্থাপন সম্ভব হয়নি। ইন্টারনেট সংযোগ পরীক্ষা করুন।';
                    this.loading = false;
                }
            },

            submitVerifyOtp: async function() {
                var fullOtp = this.otpDigits.join('');
                if (fullOtp.length !== 6) {
                    this.errorMessage = 'অনুগ্রহ করে সম্পূর্ণ ৬-ডিজিটের ওটিপি কোডটি লিখুন।';
                    return;
                }

                this.errorMessage = '';
                this.successMessage = '';
                this.verifying = true;

                try {
                    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    var csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

                    var response = await fetch('/api/v1/auth/email/verify-otp', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            user_id: this.registeredUserId,
                            email: this.registeredEmail,
                            otp: fullOtp,
                            device_name: typeof navigator !== 'undefined' ? navigator.userAgent.substring(0, 100) : 'Web Client',
                        })
                    });

                    var data = await response.json();

                    if (!response.ok) {
                        if (data.errors && data.errors.otp) {
                            this.errorMessage = data.errors.otp[0];
                        } else {
                            this.errorMessage = data.message || 'ভুল ওটিপি কোড। অনুগ্রহ করে সঠিক কোড দিন।';
                        }
                        this.verifying = false;
                        return;
                    }

                    var token = (data.data && data.data.token) ? data.data.token : data.token;
                    if (token) {
                        localStorage.setItem('zengfy_token', token);
                    }

                    this.successMessage = 'ইমেইল সফলভাবে যাচাই হয়েছে! ড্যাশবোর্ডে প্রবেশ করা হচ্ছে...';

                    setTimeout(function() {
                        var urlParams = new URLSearchParams(window.location.search);
                        var port = window.location.port ? (':' + window.location.port) : '';
                        var defaultDashboard = 'http://accounts.zengfy.top' + port + '/';
                        var redirectUrl = defaultDashboard;

                        var continueParam = urlParams.get('continue') || urlParams.get('redirect_uri') || urlParams.get('redirect_to') || urlParams.get('redirect');
                        if (continueParam) {
                            try {
                                var parsed = new URL(continueParam, window.location.origin);
                                var host = parsed.hostname.toLowerCase();
                                var isLanding = host === 'zengfy.top' && (parsed.pathname === '/' || parsed.pathname === '');
                                var isAuth = parsed.pathname.indexOf('/login') !== -1 || parsed.pathname.indexOf('/register') !== -1;
                                if (!isLanding && !isAuth && (host.indexOf('zengfy.top') !== -1 || host === 'localhost' || host === '127.0.0.1')) {
                                    redirectUrl = continueParam;
                                }
                            } catch (e) {
                                redirectUrl = defaultDashboard;
                            }
                        }

                        window.location.href = redirectUrl;
                    }, 600);

                } catch (error) {
                    this.errorMessage = 'সার্ভারের সাথে সংযোগ স্থাপন সম্ভব হয়নি। ইন্টারনেট সংযোগ পরীক্ষা করুন।';
                    this.verifying = false;
                }
            },

            submitResendOtp: async function() {
                if (!this.canResend || this.resending) return;

                this.errorMessage = '';
                this.successMessage = '';
                this.resending = true;

                try {
                    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                    var csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

                    var response = await fetch('/api/v1/auth/email/resend-otp', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            user_id: this.registeredUserId,
                            email: this.registeredEmail,
                        })
                    });

                    var data = await response.json();
                    this.resending = false;

                    if (!response.ok) {
                        this.errorMessage = data.message || 'কোড পুনরায় পাঠানো সম্ভব হয়নি। কিছুক্ষণ পর চেষ্টা করুন।';
                        return;
                    }

                    if (data.data && data.data.dev_code) {
                        this.devCode = data.data.dev_code;
                    }

                    this.otpDigits = ['', '', '', '', '', ''];
                    this.successMessage = 'আপনার ইমেইলে নতুন ভেরিফিকেশন কোড পাঠানো হয়েছে!';
                    this.startCountdown(data.data ? data.data.expires_in_seconds : 600);
                    this.startResendCooldown(60);

                    if (this.$nextTick) {
                        this.$nextTick(function() {
                            var firstEl = document.getElementById('otp-box-0');
                            if (firstEl) firstEl.focus();
                        });
                    }

                } catch (error) {
                    this.errorMessage = 'সার্ভারে সংযোগ ব্যর্থ হয়েছে।';
                    this.resending = false;
                }
            }
        };
    }
window.registerForm = registerForm;
    document.addEventListener('alpine:init', function() {
        if (window.Alpine && typeof window.registerForm === 'function') {
            window.Alpine.data('registerForm', window.registerForm);
        }
    });
</script>
@endpush

@section('content')
<div id="react-auth-root" data-initial-mode="register"></div>
<div id="blade-auth-fallback">
<div x-data="registerForm()" class="relative">

    <!-- Ambient Soft Glow Behind Glass Card -->
    <div class="absolute -inset-1.5 bg-gradient-to-r from-blue-100/70 via-cyan-100/50 to-indigo-100/60 rounded-3xl blur-xl opacity-80 transition duration-1000 -z-10"></div>

    <div class="glass-panel rounded-3xl p-6 sm:p-9 relative overflow-hidden transition-all duration-300">
        
        <!-- Top Radiant Luminous Border Strip -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600"></div>

        <!-- Header (Contextual Universal SSO) -->
        <div class="text-center mb-6 relative z-10">
            @if(!empty($targetAppName) && $targetAppName !== 'Zengfy Sovereign Hub' && $targetAppName !== 'Zengfy Ecosystem')
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold mb-3.5 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>to continue to <strong class="text-slate-900 font-bold">{{ $targetAppName }}</strong></span>
                </div>
            @else
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold mb-3 shadow-xs">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>Universal Sovereign Identity</span>
                </div>
            @endif
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">নতুন অ্যাকাউন্ট তৈরি করুন</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1.5">একটি সার্বজনীন পরিচয় দিয়ে Zengfy ইকোসিস্টেমের সকল সেবায় প্রবেশ করুন</p>
        </div>

        <!-- Multi-Step Progress Indicator -->
        <div class="mb-6 relative z-10">
            <div class="grid grid-cols-3 gap-1.5 text-[11px] font-semibold">
                <!-- Step 1 -->
                <div class="flex items-center gap-1.5 p-2 rounded-xl transition-all"
                     :class="step === 'identity' ? 'bg-blue-50/80 text-blue-700 border border-blue-200/60' : (step === 'credentials' || step === 'verification' ? 'bg-emerald-50/60 text-emerald-700 border border-emerald-200/60' : 'bg-slate-50 text-slate-400 border border-slate-100')">
                    <div class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0"
                         :class="step === 'identity' ? 'bg-blue-600 text-white' : (step === 'credentials' || step === 'verification' ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500')">
                        <span x-show="step === 'identity'">১</span>
                        <svg x-show="step !== 'identity'" x-cloak class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="truncate">ব্যক্তিগত</span>
                </div>

                <!-- Step 2 -->
                <div class="flex items-center gap-1.5 p-2 rounded-xl transition-all"
                     :class="step === 'credentials' ? 'bg-blue-50/80 text-blue-700 border border-blue-200/60' : (step === 'verification' ? 'bg-emerald-50/60 text-emerald-700 border border-emerald-200/60' : 'bg-slate-50 text-slate-400 border border-slate-100')">
                    <div class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0"
                         :class="step === 'credentials' ? 'bg-blue-600 text-white' : (step === 'verification' ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500')">
                        <span x-show="step !== 'verification'">২</span>
                        <svg x-show="step === 'verification'" x-cloak class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="truncate">পাসওয়ার্ড</span>
                </div>

                <!-- Step 3 -->
                <div class="flex items-center gap-1.5 p-2 rounded-xl transition-all"
                     :class="step === 'verification' ? 'bg-blue-50/80 text-blue-700 border border-blue-200/60' : 'bg-slate-50 text-slate-400 border border-slate-100'">
                    <div class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0"
                         :class="step === 'verification' ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-500'">
                        <span>৩</span>
                    </div>
                    <span class="truncate">যাচাইকরণ</span>
                </div>
            </div>
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
        <!-- STEP 1: PERSONAL IDENTITY (Name, Date of Birth, Gender)                   -->
        <!-- ========================================================================= -->
        <form x-show="step === 'identity'" @submit.prevent="nextStep" class="space-y-4 relative z-10" x-transition:enter="transition ease-out duration-200">
            <!-- Full Name -->
            <div>
                <label for="reg-name" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    পুরো নাম (Full Legal Name) <span class="text-rose-500">*</span>
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
                        placeholder="যেমন: মোঃ সাজ্জাদ হোসেন"
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="reg-dob" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    জন্মতারিখ (Date of Birth) <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input 
                        type="date" 
                        id="reg-dob"
                        name="date_of_birth" 
                        x-model="dateOfBirth" 
                        max="{{ date('Y-m-d') }}"
                        required 
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
            </div>

            <!-- Gender Selection -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    লিঙ্গ (Gender) <span class="text-rose-500">*</span>
                </label>
                <div class="grid grid-cols-3 gap-2">
                    <label class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl border cursor-pointer text-xs font-semibold transition-all"
                           :class="gender === 'male' ? 'bg-blue-50 border-blue-600 text-blue-700 shadow-xs' : 'border-slate-200 bg-white/70 text-slate-600 hover:bg-slate-50'">
                        <input type="radio" name="gender" value="male" x-model="gender" class="sr-only">
                        <span>👨 পুরুষ</span>
                    </label>

                    <label class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl border cursor-pointer text-xs font-semibold transition-all"
                           :class="gender === 'female' ? 'bg-blue-50 border-blue-600 text-blue-700 shadow-xs' : 'border-slate-200 bg-white/70 text-slate-600 hover:bg-slate-50'">
                        <input type="radio" name="gender" value="female" x-model="gender" class="sr-only">
                        <span>👩 নারী</span>
                    </label>

                    <label class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl border cursor-pointer text-xs font-semibold transition-all"
                           :class="gender === 'other' ? 'bg-blue-50 border-blue-600 text-blue-700 shadow-xs' : 'border-slate-200 bg-white/70 text-slate-600 hover:bg-slate-50'">
                        <input type="radio" name="gender" value="other" x-model="gender" class="sr-only">
                        <span>🧑 অন্যান্য</span>
                    </label>
                </div>
            </div>

            <!-- Next Step Button -->
            <button 
                type="submit" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-xl shadow-blue-500/25 transition-all duration-300 transform active:scale-[0.98] cursor-pointer flex items-center justify-center gap-2 mt-4 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                <span>পরবর্তী ধাপ (Next)</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <!-- ========================================================================= -->
        <!-- STEP 2: ACCOUNT CREDENTIALS (Email & Password)                            -->
        <!-- ========================================================================= -->
        <form x-show="step === 'credentials'" x-cloak @submit.prevent="submitRegister" class="space-y-4 relative z-10" x-transition:enter="transition ease-out duration-200">
            @csrf

            <!-- Anti-Bot Honeypot Field -->
            <div style="position: absolute; left: -9999px; top: -9999px; opacity: 0; pointer-events: none;" aria-hidden="true">
                <input type="text" name="website" x-model="website" tabindex="-1" autocomplete="off" />
            </div>

            <!-- Identity Summary Pill with Change Button -->
            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-200/80 mb-3">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shrink-0">
                        <span x-text="(name || 'U').charAt(0).toUpperCase()">U</span>
                    </div>
                    <div class="min-w-0">
                        <p x-text="name" class="text-xs font-bold text-slate-900 truncate"></p>
                        <p class="text-[10px] text-slate-500">
                            জন্ম: <span x-text="dateOfBirth"></span> &bull; 
                            <span x-text="gender === 'male' ? 'পুরুষ' : (gender === 'female' ? 'নারী' : 'অন্যান্য')"></span>
                        </p>
                    </div>
                </div>
                <button 
                    type="button" 
                    @click="prevStep" 
                    class="text-xs font-bold text-blue-600 hover:text-blue-700 px-2 py-1 rounded-md hover:bg-blue-50 transition-colors shrink-0">
                    পরিবর্তন
                </button>
            </div>

            <!-- Email Address -->
            <div>
                <label for="reg-email" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    ইমেইল ঠিকানা (Email Address) <span class="text-rose-500">*</span>
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
                    পাসওয়ার্ড (Password - কমপক্ষে ৮ অক্ষর) <span class="text-rose-500">*</span>
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
                        class="absolute inset-y-0 right-0 pr-3.5 pl-2 flex items-center justify-center min-w-[44px] min-h-[44px] text-slate-400 hover:text-slate-600 transition-colors cursor-pointer rounded-r-xl focus-visible:outline-none">
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
                        <span class="text-slate-500">নিরাপত্তা স্তর:</span>
                        <span :class="strengthTextColor" x-text="strengthText" class="font-semibold"></span>
                    </div>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="reg-password-confirm" class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wider">
                    পাসওয়ার্ড নিশ্চিত করুন (Confirm Password) <span class="text-rose-500">*</span>
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
                        placeholder="পাসওয়ার্ড পুনরায় লিখুন"
                        class="glass-input w-full pl-11 pr-4 py-3 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none transition-all duration-200"
                    />
                </div>
                <!-- Realtime Match Indicator -->
                <div x-show="passwordConfirmation.length > 0" x-cloak class="mt-1.5 flex items-center gap-1.5 text-[11px]">
                    <span x-show="password === passwordConfirmation" class="text-emerald-600 flex items-center gap-1 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        পাসওয়ার্ড মিলেছে (Passwords match)
                    </span>
                    <span x-show="password !== passwordConfirmation" class="text-rose-600 flex items-center gap-1 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        পাসওয়ার্ড মিলছে না (Passwords do not match)
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
                    class="mt-1 w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 cursor-pointer"
                />
                <label for="reg-terms" class="text-xs text-slate-600 leading-relaxed cursor-pointer py-0.5">
                    আমি Zengfy-এর <a href="{{ Route::has('terms') ? route('terms') : '/terms' }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-semibold">শর্তাবলী</a> ও <a href="{{ Route::has('faq') ? route('faq') : '/faq' }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-semibold">গোপনীয়তা নীতি</a> মেনে নিচ্ছি।
                </label>
            </div>

            <!-- Action Buttons: Back & Create Account -->
            <div class="flex items-center gap-3 pt-2">
                <button 
                    type="button" 
                    @click="prevStep"
                    class="py-3.5 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-all duration-200 cursor-pointer">
                    পূর্ববর্তী
                </button>
                <button 
                    type="submit" 
                    :disabled="loading || !agreeTerms" 
                    class="flex-1 relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-xl shadow-blue-500/25 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    
                    <span x-show="!loading" class="flex items-center gap-2">
                        <span>কোড পাঠান ও এগিয়ে যান</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>

                    <span x-show="loading" x-cloak class="flex items-center gap-2">
                        <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>সার্বভৌম পরিচয় তৈরি হচ্ছে...</span>
                    </span>
                </button>
            </div>
        </form>

        <!-- ========================================================================= -->
        <!-- STEP 3: EMAIL OTP VERIFICATION                                            -->
        <!-- ========================================================================= -->
        <div x-show="step === 'verification'" x-cloak class="space-y-5 relative z-10" x-transition:enter="transition ease-out duration-200">
            <!-- Email Verification Info Card -->
            <div class="p-4 rounded-2xl bg-blue-50/70 border border-blue-200/80 text-center">
                <div class="w-12 h-12 mx-auto rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30 mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900">৬-ডিজিটের কোড লিখুন</h3>
                <p class="text-xs text-slate-600 mt-1">
                    আমরা <strong class="text-blue-700 font-semibold" x-text="registeredEmail"></strong> ঠিকানায় একটি যাচাইকরণ কোড পাঠিয়েছি।
                </p>
                <button 
                    type="button" 
                    @click="backToEditEmail" 
                    class="mt-2 text-xs font-semibold text-blue-600 hover:text-blue-800 underline inline-flex items-center gap-1 cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    <span>ইমেইল ভুল হয়েছে? পরিবর্তন করুন</span>
                </button>
            </div>

            <!-- Dev Code Auto-Fill Pill (For Testing) -->
            <div x-show="devCode" x-cloak class="p-3 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 rounded bg-amber-200/80 text-amber-900 font-mono text-xs font-bold">DEV TEST</span>
                    <span class="text-xs text-amber-800">টেস্ট কোড: <strong class="font-mono font-bold tracking-widest" x-text="devCode"></strong></span>
                </div>
                <button 
                    type="button" 
                    @click="fillDevCode" 
                    class="text-xs bg-amber-600 hover:bg-amber-700 text-white font-bold px-3 py-1 rounded-lg transition-colors shadow-xs cursor-pointer">
                    অটো ফিল করুন
                </button>
            </div>

            <!-- 6-Digit OTP Input Boxes -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wider text-center">
                    ভেরিফিকেশন ওটিপি (OTP Code)
                </label>
                <div class="flex items-center justify-center gap-2 sm:gap-2.5" @paste="handleOtpPaste($event)">
                    <template x-for="(digit, idx) in otpDigits" :key="idx">
                        <input 
                            type="text" 
                            :id="'otp-box-' + idx"
                            inputmode="numeric" 
                            pattern="[0-9]*"
                            maxlength="1" 
                            :value="digit"
                            @input="handleOtpInput(idx, $event)"
                            @keydown="handleOtpKeydown(idx, $event)"
                            class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl sm:text-2xl font-bold font-mono rounded-xl border border-slate-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 bg-white text-slate-900 shadow-xs transition-all focus:outline-none"
                            :class="digit ? 'border-blue-600 bg-blue-50/30' : ''"
                            autocomplete="off"
                        />
                    </template>
                </div>
            </div>

            <!-- Expiry Countdown & Resend Option -->
            <div class="flex items-center justify-between text-xs pt-1 px-1">
                <div class="flex items-center gap-1.5 text-slate-500">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>মেয়াদ: <strong class="font-mono text-slate-700 font-semibold" x-text="formattedTimer"></strong></span>
                </div>

                <div>
                    <button 
                        type="button" 
                        @click="submitResendOtp" 
                        :disabled="!canResend || resending"
                        class="font-semibold text-blue-600 hover:text-blue-800 disabled:text-slate-400 disabled:cursor-not-allowed transition-colors cursor-pointer inline-flex items-center gap-1">
                        <span x-show="!resending && canResend">পুনরায় কোড পাঠান</span>
                        <span x-show="!resending && !canResend" x-text="'পুনরায় কোড (' + resendCooldown + 's)'"></span>
                        <span x-show="resending" x-cloak>পাঠানো হচ্ছে...</span>
                    </button>
                </div>
            </div>

            <!-- Submit Verification Button -->
            <button 
                type="button" 
                @click="submitVerifyOtp" 
                :disabled="verifying || otpDigits.join('').length !== 6" 
                class="w-full relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 text-white font-bold py-3.5 px-4 min-h-[48px] text-sm shadow-xl shadow-blue-500/25 transition-all duration-300 transform active:scale-[0.98] disabled:opacity-60 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center gap-2 mt-3 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                
                <span x-show="!verifying" class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>যাচাই সম্পন্ন করে ড্যাশবোর্ডে প্রবেশ করুন</span>
                </span>

                <span x-show="verifying" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>যাচাই করা হচ্ছে...</span>
                </span>
            </button>
        </div>

        <!-- Divider -->
        <div class="relative my-6 z-10">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center text-xs uppercase">
                <span class="bg-white px-3 text-slate-400 font-semibold tracking-wider">ইতিমধ্যে অ্যাকাউন্ট আছে?</span>
            </div>
        </div>

        <!-- Login Link -->
        <a href="{{ route('login', request()->query()) }}" 
           class="w-full flex items-center justify-center py-3.5 px-4 min-h-[48px] rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-all duration-200 shadow-xs focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 relative z-10">
            বিদ্যমান অ্যাকাউন্ট দিয়ে লগইন করুন
        </a>

        <!-- Ecosystem Trust Highlights -->
        <div class="mt-6 pt-5 border-t border-slate-200/80 grid grid-cols-3 gap-2 text-center text-[10px] text-slate-500">
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-blue-600 font-bold">⚡ Instant SSO</span>
                <span>All 15 Modules</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-emerald-600 font-bold">🇧🇩 NID Vault</span>
                <span>Anti-Bot Shield</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-xs mb-0.5 text-cyan-600 font-bold">🔒 AES-256</span>
                <span>Encrypted Storage</span>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@push('scripts')
@vite(['resources/js/react/main.jsx'])
@endpush
