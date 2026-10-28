import React, { useState } from 'react';
import { User, Mail, Lock, Eye, EyeOff, Loader2, ArrowRight, ArrowLeft, AlertCircle, Sparkles, CheckCircle2, Calendar, Check, Edit2, ShieldCheck } from 'lucide-react';
import { useMockAuthStore } from './mockAuthStore';
import PasswordStrengthMeter from './PasswordStrengthMeter';

export default function RegisterCard({ onSwitchToLogin }) {
  const { register: storeRegister, lastError, clearError } = useMockAuthStore();

  // Wizard Step: 1 = Personal Details (Name, DOB, Gender), 2 = Credentials (Email, Password)
  const [step, setStep] = useState(1);

  // Step 1: Personal Details
  const [fullName, setFullName] = useState('');
  const [dateOfBirth, setDateOfBirth] = useState('');
  const [gender, setGender] = useState('male'); // 'male' | 'female' | 'other'

  // Step 2: Account Credentials
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [passwordConfirmation, setPasswordConfirmation] = useState('');
  const [agreeTerms, setAgreeTerms] = useState(true);
  const [showPassword, setShowPassword] = useState(false);
  const [website, setWebsite] = useState(''); // Anti-bot honeypot

  // State Management
  const [loading, setLoading] = useState(false);
  const [validationError, setValidationError] = useState('');
  const [successMessage, setSuccessMessage] = useState('');

  // Read continue parameter
  const urlParams = new URLSearchParams(typeof window !== 'undefined' ? window.location.search : '');
  const continueUrl = urlParams.get('continue') || urlParams.get('redirect_uri') || urlParams.get('redirect_to') || urlParams.get('redirect') || '';

  const getTargetAppName = () => {
    if (!continueUrl) return 'Zengfy Sovereign Dashboard';
    try {
      const parsed = new URL(continueUrl, window.location.origin);
      const host = parsed.hostname.toLowerCase();
      if (host.startsWith('social.')) return 'Zengfy Social Feed';
      if (host.startsWith('school.')) return 'Zengfy Smart School';
      if (host.startsWith('pos.')) return 'Zengfy Retail POS';
      if (host.startsWith('law.')) return 'Zengfy Judicial Law';
      if (host.startsWith('civil.')) return 'Zengfy Civil Engine';
      if (host.startsWith('ngo.')) return 'Zengfy NGO';
      if (host.startsWith('rent.')) return 'Zengfy Rental System';
      if (host.startsWith('hotel.')) return 'Zengfy Hospitality Hub';
      if (host.startsWith('shop.')) return 'Zengfy Marketplace';
      if (host.startsWith('ecommerce.')) return 'Zengfy Commerce';
      if (host.startsWith('skill.')) return 'Zengfy Skill Academy';
      if (host.startsWith('journal.')) return 'Zengfy Journal';
      if (host.startsWith('habit.')) return 'Zengfy Habit';
      if (host.startsWith('schedule.')) return 'Zengfy Schedule';
      return 'Zengfy Sovereign Hub';
    } catch (e) {
      return 'Zengfy Sovereign Hub';
    }
  };

  const targetAppName = getTargetAppName();

  // Validate Step 1 and proceed to Step 2
  const handleProceedToStep2 = (e) => {
    if (e) e.preventDefault();
    clearError();
    setValidationError('');

    const trimmedName = fullName.trim();
    if (!trimmedName || trimmedName.length < 2) {
      setValidationError('অনুগ্রহ করে আপনার পুরো নাম প্রদান করুন (কমপক্ষে ২ অক্ষর)।');
      return;
    }

    if (!dateOfBirth) {
      setValidationError('অনুগ্রহ করে আপনার জন্মতারিখ নির্বাচন করুন।');
      return;
    }

    // Verify DOB is not in the future
    const dobDate = new Date(dateOfBirth);
    const today = new Date();
    if (dobDate > today) {
      setValidationError('জন্মতারিখ আজকের দিনের পরের হতে পারে না।');
      return;
    }

    if (!gender) {
      setValidationError('অনুগ্রহ করে আপনার লিঙ্গ (Gender) নির্বাচন করুন।');
      return;
    }

    setStep(2);
  };

  // Submit Final Registration (Step 2)
  const handleSubmit = async (e) => {
    e.preventDefault();
    clearError();
    setValidationError('');
    setSuccessMessage('');

    // Re-verify Step 1 data integrity
    const trimmedName = fullName.trim();
    if (!trimmedName || trimmedName.length < 2) {
      setStep(1);
      setValidationError('অনুগ্রহ করে আপনার পুরো নাম প্রদান করুন।');
      return;
    }
    if (!dateOfBirth) {
      setStep(1);
      setValidationError('অনুগ্রহ করে আপনার জন্মতারিখ দিন।');
      return;
    }

    // Validate Email
    const trimmedEmail = email.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(trimmedEmail)) {
      setValidationError('একটি সঠিক ও কার্যকর ইমেইল ঠিকানা প্রদান করুন।');
      return;
    }

    // Disposable Domain Check
    const domain = trimmedEmail.split('@')[1]?.toLowerCase();
    const badDomains = [
      '10minutemail.com', 'tempmail.com', 'mailinator.com', 
      'yopmail.com', 'guerrillamail.com', 'sharklasers.com', 
      'dispostable.com', 'trashmail.com'
    ];
    if (badDomains.includes(domain)) {
      setValidationError('অস্থায়ী বা ডিসপোজাবল ইমেইল দিয়ে অ্যাকাউন্ট তৈরি করা যাবে না। স্থায়ী ইমেইল দিন।');
      return;
    }

    // Validate Password
    if (!password || password.length < 8) {
      setValidationError('পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।');
      return;
    }

    if (password !== passwordConfirmation) {
      setValidationError('উভয় পাসওয়ার্ড হুবহু একই হতে হবে। অনুগ্রহ করে নিশ্চিত করুন।');
      return;
    }

    if (!agreeTerms) {
      setValidationError('রেজিস্ট্রেশন সম্পন্ন করতে ব্যবহারের শর্তাবলী ও গোপনীয়তা নীতি মেনে নিতে হবে।');
      return;
    }

    setLoading(true);

    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
      
      const res = await fetch('/api/v1/auth/register', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          name: trimmedName,
          date_of_birth: dateOfBirth,
          gender: gender,
          email: trimmedEmail,
          password: password,
          password_confirmation: passwordConfirmation,
          website: website, // Anti-bot honeypot
          device_name: typeof navigator !== 'undefined' ? navigator.userAgent.substring(0, 100) : 'Web Client',
        }),
      });

      const data = await res.json();

      if (!res.ok) {
        if (data.errors) {
          const firstKey = Object.keys(data.errors)[0];
          setValidationError(data.errors[firstKey][0]);
        } else {
          setValidationError(data.message || 'রেজিস্ট্রেশন ব্যর্থ হয়েছে। তথ্য যাচাই করুন।');
        }
        setLoading(false);
        return;
      }

      const token = data.data?.token || data.token;
      if (token) {
        localStorage.setItem('zengfy_token', token);
      }

      // Sync mock store state if applicable
      try {
        await storeRegister({ 
          fullName: trimmedName, 
          dateOfBirth, 
          gender, 
          email: trimmedEmail, 
          password 
        });
      } catch (err) {
        // non-blocking
      }

      setSuccessMessage('সার্বভৌম অ্যাকাউন্ট সফলভাবে তৈরি হয়েছে! ড্যাশবোর্ডে নিয়ে যাওয়া হচ্ছে...');

      setTimeout(() => {
        const port = window.location.port ? `:${window.location.port}` : '';
        const defaultDashboard = `http://accounts.zengfy.top${port}/`;
        let redirectUrl = defaultDashboard;

        const continueParam = continueUrl || (new URLSearchParams(window.location.search)).get('continue');
        if (continueParam) {
          try {
            const parsed = new URL(continueParam, window.location.origin);
            const host = parsed.hostname.toLowerCase();
            // Do NOT redirect to root landing page (zengfy.top) or auth pages
            const isLanding = host === 'zengfy.top' && (parsed.pathname === '/' || parsed.pathname === '');
            const isAuth = parsed.pathname.includes('/login') || parsed.pathname.includes('/register');
            if (!isLanding && !isAuth && (host.endsWith('zengfy.top') || host === 'localhost' || host === '127.0.0.1')) {
              redirectUrl = continueParam;
            }
          } catch (e) {
            redirectUrl = defaultDashboard;
          }
        }

        window.location.href = redirectUrl;
      }, 700);

    } catch (err) {
      setValidationError('সার্ভারের সাথে সংযোগ স্থাপন করা সম্ভব হয়নি। ইন্টারনেট সংযোগ পরীক্ষা করুন।');
      setLoading(false);
    }
  };

  const handleGoogleMock = () => {
    setFullName('সাজ্জাদ হোসেন (Google)');
    setDateOfBirth('1998-05-15');
    setGender('male');
    setEmail('sazzad.google@gmail.com');
    setPassword('GoogleSecurePass2026!');
    setPasswordConfirmation('GoogleSecurePass2026!');
    setStep(2);
  };

  const maxDobDate = new Date().toISOString().split('T')[0];

  const getGenderLabel = (g) => {
    if (g === 'male') return 'পুরুষ';
    if (g === 'female') return 'নারী';
    return 'অন্যান্য';
  };

  return (
    <div className="w-full max-w-md mx-auto bg-white/95 rounded-3xl border border-slate-200/90 shadow-2xl shadow-blue-500/10 p-6 sm:p-8 backdrop-blur-2xl relative overflow-hidden transition-all duration-300">
      
      {/* Top Radiant Luminous Border Strip */}
      <div className="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-cyan-500 via-blue-600 to-indigo-600"></div>

      {/* Brand Header */}
      <div className="text-center mb-5 relative z-10">
        <div className="w-12 h-12 bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-md shadow-blue-500/25 text-white font-black text-2xl tracking-tighter">
          Z
        </div>
        
        {continueUrl && targetAppName !== 'Zengfy Sovereign Dashboard' && targetAppName !== 'Zengfy Sovereign Hub' ? (
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold mb-2 shadow-2xs">
            <span className="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            <span>to continue to <strong>{targetAppName}</strong></span>
          </div>
        ) : (
          <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold mb-2 shadow-2xs">
            <ShieldCheck className="w-3.5 h-3.5 text-blue-600" />
            <span>Universal Sovereign Identity</span>
          </div>
        )}

        <h2 className="text-2xl font-extrabold text-slate-900 tracking-tight">নতুন অ্যাকাউন্ট তৈরি করুন</h2>
        <p className="text-xs text-slate-500 mt-1 font-medium">
          {step === 1 ? 'ধাপ ১: আপনার ব্যক্তিগত পরিচয় তথ্য প্রদান করুন' : 'ধাপ ২: স্থায়ী ইমেইল ও শক্তিশালী পাসওয়ার্ড সেট করুন'}
        </p>
      </div>

      {/* Progressive Step Stepper & Progress Bar */}
      <div className="mb-6 relative z-10">
        {/* Progress Fill Line */}
        <div className="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden mb-2.5">
          <div 
            className="h-full bg-gradient-to-r from-blue-600 to-indigo-600 transition-all duration-500 ease-out rounded-full"
            style={{ width: step === 1 ? '50%' : '100%' }}
          />
        </div>

        {/* Step Badges */}
        <div className="grid grid-cols-2 gap-2">
          <button 
            type="button"
            onClick={() => { if (step === 2) setStep(1); }}
            className={`flex items-center gap-2 p-2 rounded-xl text-left transition-all ${step === 2 ? 'cursor-pointer hover:bg-slate-100' : ''} ${
              step === 1 ? 'bg-blue-50/90 text-blue-700 border border-blue-200/80 shadow-2xs' : 'bg-slate-50 text-slate-600 border border-slate-100'
            }`}
          >
            <div className={`w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold ${
              step === 1 ? 'bg-blue-600 text-white' : 'bg-emerald-500 text-white'
            }`}>
              {step === 1 ? '১' : <Check className="w-3 h-3 stroke-[3]" />}
            </div>
            <div className="min-w-0">
              <span className="block text-xs font-bold leading-none">ব্যক্তিগত তথ্য</span>
              <span className="text-[10px] text-slate-400">নাম, জন্ম ও লিঙ্গ</span>
            </div>
          </button>

          <div className={`flex items-center gap-2 p-2 rounded-xl transition-all ${
            step === 2 ? 'bg-blue-50/90 text-blue-700 border border-blue-200/80 shadow-2xs' : 'bg-slate-50 text-slate-400 border border-slate-100'
          }`}>
            <div className={`w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold ${
              step === 2 ? 'bg-blue-600 text-white' : 'bg-slate-200 text-slate-500'
            }`}>
              ২
            </div>
            <div className="min-w-0">
              <span className="block text-xs font-bold leading-none">নিরাপত্তা ও ইমেইল</span>
              <span className="text-[10px] text-slate-400">অ্যাকাউন্ট ক্রেডেনশিয়াল</span>
            </div>
          </div>
        </div>
      </div>

      {/* Global Error Banner */}
      {(lastError || validationError) && (
        <div className="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs flex items-start gap-2.5 animate-in fade-in duration-200">
          <AlertCircle className="w-4 h-4 shrink-0 mt-0.5 text-rose-600" />
          <span className="leading-relaxed font-medium">{lastError || validationError}</span>
        </div>
      )}

      {/* Success Notification Banner */}
      {successMessage && (
        <div className="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs flex items-center gap-2.5 animate-in fade-in duration-200">
          <CheckCircle2 className="w-4 h-4 shrink-0 text-emerald-600" />
          <span className="leading-relaxed font-medium">{successMessage}</span>
        </div>
      )}

      {/* ========================================================================= */}
      {/* STEP 1: PERSONAL IDENTITY (Name, Date of Birth, Gender)                   */}
      {/* ========================================================================= */}
      {step === 1 && (
        <form onSubmit={handleProceedToStep2} className="space-y-4 animate-in fade-in duration-200">
          
          {/* Field 1: Full Name */}
          <div>
            <label htmlFor="reg-fullName" className="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
              পুরো নাম (Full Legal Name) <span className="text-rose-500">*</span>
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <User className="w-4 h-4" />
              </div>
              <input
                id="reg-fullName"
                type="text"
                value={fullName}
                onChange={(e) => {
                  setFullName(e.target.value);
                  if (validationError) setValidationError('');
                }}
                required
                autoFocus
                autoComplete="name"
                placeholder="যেমন: মোঃ সাজ্জাদ হোসেন"
                className="w-full pl-10 pr-3.5 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
              />
            </div>
            <p className="text-[10px] text-slate-400 mt-1">জাতীয় পরিচয়পত্র বা অফিশিয়াল নথির সাথে মিলিয়ে নাম প্রদান করুন</p>
          </div>

          {/* Field 2: Date of Birth */}
          <div>
            <label htmlFor="reg-dob" className="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
              জন্মতারিখ (Date of Birth) <span className="text-rose-500">*</span>
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <Calendar className="w-4 h-4" />
              </div>
              <input
                id="reg-dob"
                type="date"
                value={dateOfBirth}
                max={maxDobDate}
                onChange={(e) => {
                  setDateOfBirth(e.target.value);
                  if (validationError) setValidationError('');
                }}
                required
                className="w-full pl-10 pr-3.5 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
              />
            </div>
            <p className="text-[10px] text-slate-400 mt-1">নিরাপত্তা ও বয়স যাচাইকরণের উদ্দেশ্যে ব্যবহৃত হবে</p>
          </div>

          {/* Field 3: Gender Selection */}
          <div>
            <label className="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
              লিঙ্গ (Gender) <span className="text-rose-500">*</span>
            </label>
            <div className="grid grid-cols-3 gap-2">
              <button
                type="button"
                onClick={() => setGender('male')}
                className={`py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-1.5 transition-all cursor-pointer ${
                  gender === 'male'
                    ? 'bg-blue-50 border-blue-600 text-blue-700 shadow-2xs ring-1 ring-blue-600/30'
                    : 'border-slate-200 bg-white/80 text-slate-600 hover:bg-slate-50 hover:border-slate-300'
                }`}
              >
                <span>👨 পুরুষ</span>
              </button>

              <button
                type="button"
                onClick={() => setGender('female')}
                className={`py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-1.5 transition-all cursor-pointer ${
                  gender === 'female'
                    ? 'bg-blue-50 border-blue-600 text-blue-700 shadow-2xs ring-1 ring-blue-600/30'
                    : 'border-slate-200 bg-white/80 text-slate-600 hover:bg-slate-50 hover:border-slate-300'
                }`}
              >
                <span>👩 নারী</span>
              </button>

              <button
                type="button"
                onClick={() => setGender('other')}
                className={`py-2.5 px-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-1.5 transition-all cursor-pointer ${
                  gender === 'other'
                    ? 'bg-blue-50 border-blue-600 text-blue-700 shadow-2xs ring-1 ring-blue-600/30'
                    : 'border-slate-200 bg-white/80 text-slate-600 hover:bg-slate-50 hover:border-slate-300'
                }`}
              >
                <span>🧑 অন্যান্য</span>
              </button>
            </div>
          </div>

          {/* Google 1-Tap Demo Button */}
          <button
            type="button"
            onClick={handleGoogleMock}
            className="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border border-slate-200 hover:bg-slate-50 active:scale-[0.99] text-slate-600 text-xs font-semibold transition-all shadow-2xs mt-1 cursor-pointer"
          >
            <svg className="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Google দিয়ে স্বয়ংক্রিয় তথ্য পূরণ (Demo Fill)</span>
          </button>

          {/* Next Button */}
          <button
            type="submit"
            className="w-full py-3.5 px-4 min-h-[48px] bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-500/25 active:scale-[0.98] transition-all flex items-center justify-center gap-2 cursor-pointer mt-4"
          >
            <span>পরবর্তী ধাপ (Next)</span>
            <ArrowRight className="w-4 h-4" />
          </button>
        </form>
      )}

      {/* ========================================================================= */}
      {/* STEP 2: CREDENTIALS & SECURITY (Email, Password, Confirm)                 */}
      {/* ========================================================================= */}
      {step === 2 && (
        <form onSubmit={handleSubmit} className="space-y-4 animate-in fade-in duration-200">
          
          {/* Anti-bot Honeypot input */}
          <div style={{ position: 'absolute', left: '-9999px', top: '-9999px', opacity: 0, pointerEvents: 'none' }} aria-hidden="true">
            <input
              type="text"
              name="website"
              value={website}
              onChange={(e) => setWebsite(e.target.value)}
              tabIndex={-1}
              autoComplete="off"
            />
          </div>

          {/* Identity Summary Card with Edit Button */}
          <div className="flex items-center justify-between p-3.5 rounded-2xl bg-blue-50/60 border border-blue-200/80 shadow-2xs">
            <div className="flex items-center gap-3 min-w-0">
              <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center text-xs font-black shadow-xs shrink-0">
                {fullName ? fullName.charAt(0).toUpperCase() : 'U'}
              </div>
              <div className="min-w-0 text-left">
                <p className="text-xs font-extrabold text-slate-900 truncate">{fullName}</p>
                <p className="text-[11px] text-slate-500 flex items-center gap-1.5 mt-0.5">
                  <span>জন্ম: {dateOfBirth}</span>
                  <span>&bull;</span>
                  <span className="font-semibold text-blue-700">{getGenderLabel(gender)}</span>
                </p>
              </div>
            </div>
            <button
              type="button"
              onClick={() => {
                clearError();
                setValidationError('');
                setStep(1);
              }}
              className="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-700 px-2.5 py-1.5 rounded-lg hover:bg-blue-100/60 transition-colors shrink-0 cursor-pointer"
            >
              <Edit2 className="w-3 h-3" />
              <span>পরিবর্তন</span>
            </button>
          </div>

          {/* Email Address */}
          <div>
            <label htmlFor="reg-email" className="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
              ইমেইল ঠিকানা (Email Address) <span className="text-rose-500">*</span>
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <Mail className="w-4 h-4" />
              </div>
              <input
                id="reg-email"
                type="email"
                value={email}
                onChange={(e) => {
                  setEmail(e.target.value);
                  if (validationError) setValidationError('');
                }}
                required
                autoFocus
                autoComplete="email"
                placeholder="name@example.com"
                className="w-full pl-10 pr-3.5 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
              />
            </div>
          </div>

          {/* Password */}
          <div>
            <label htmlFor="reg-password" className="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
              পাসওয়ার্ড (Password - কমপক্ষে ৮ অক্ষর) <span className="text-rose-500">*</span>
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <Lock className="w-4 h-4" />
              </div>
              <input
                id="reg-password"
                type={showPassword ? 'text' : 'password'}
                value={password}
                onChange={(e) => {
                  setPassword(e.target.value);
                  if (validationError) setValidationError('');
                }}
                required
                autoComplete="new-password"
                placeholder="••••••••••••"
                className="w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
              />
              <button
                type="button"
                onClick={() => setShowPassword(!showPassword)}
                className="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer"
                title={showPassword ? 'পাসওয়ার্ড লুকান' : 'পাসওয়ার্ড দেখুন'}
              >
                {showPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
              </button>
            </div>

            {/* Live Entropy Password Strength Meter */}
            <PasswordStrengthMeter password={password} />
          </div>

          {/* Confirm Password */}
          <div>
            <label htmlFor="reg-password-confirm" className="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
              পাসওয়ার্ড নিশ্চিত করুন (Confirm Password) <span className="text-rose-500">*</span>
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <Lock className="w-4 h-4" />
              </div>
              <input
                id="reg-password-confirm"
                type={showPassword ? 'text' : 'password'}
                value={passwordConfirmation}
                onChange={(e) => {
                  setPasswordConfirmation(e.target.value);
                  if (validationError) setValidationError('');
                }}
                required
                autoComplete="new-password"
                placeholder="পাসওয়ার্ড পুনরায় লিখুন"
                className="w-full pl-10 pr-3.5 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
              />
            </div>
            {/* Realtime Match Indicator */}
            {passwordConfirmation.length > 0 && (
              <div className="mt-1.5 flex items-center gap-1.5 text-[11px]">
                {password === passwordConfirmation ? (
                  <span className="text-emerald-600 flex items-center gap-1 font-semibold">
                    <CheckCircle2 className="w-3.5 h-3.5" />
                    পাসওয়ার্ড মিলেছে (Passwords match)
                  </span>
                ) : (
                  <span className="text-rose-600 flex items-center gap-1 font-semibold">
                    <AlertCircle className="w-3.5 h-3.5" />
                    পাসওয়ার্ড মিলছে না (Passwords do not match)
                  </span>
                )}
              </div>
            )}
          </div>

          {/* Terms Agreement Checkbox */}
          <div className="flex items-start gap-2.5 pt-1">
            <input
              type="checkbox"
              id="reg-terms-react"
              checked={agreeTerms}
              onChange={(e) => setAgreeTerms(e.target.checked)}
              className="mt-0.5 w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer"
            />
            <label htmlFor="reg-terms-react" className="text-xs text-slate-600 leading-relaxed cursor-pointer">
              আমি Zengfy-এর{' '}
              <a href="/terms" target="_blank" rel="noreferrer" className="text-blue-600 hover:underline font-bold">
                ব্যবহারের শর্তাবলী
              </a>{' '}
              ও{' '}
              <a href="/policy" target="_blank" rel="noreferrer" className="text-blue-600 hover:underline font-bold">
                গোপনীয়তা নীতি
              </a>{' '}
              মেনে নিচ্ছি।
            </label>
          </div>

          {/* Back & Submit Buttons */}
          <div className="flex items-center gap-2.5 pt-2">
            <button
              type="button"
              onClick={() => {
                clearError();
                setValidationError('');
                setStep(1);
              }}
              className="py-3.5 px-4 min-h-[48px] rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer"
            >
              <ArrowLeft className="w-4 h-4" />
              <span>পূর্ববর্তী</span>
            </button>

            <button
              type="submit"
              disabled={loading || !agreeTerms}
              className="flex-1 py-3.5 px-4 min-h-[48px] bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 active:scale-[0.98] text-white text-xs font-bold rounded-xl shadow-lg shadow-blue-600/25 transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-60"
            >
              {loading ? (
                <>
                  <Loader2 className="w-4 h-4 animate-spin" />
                  <span>সার্বভৌম অ্যাকাউন্ট তৈরি হচ্ছে...</span>
                </>
              ) : (
                <>
                  <span>অ্যাকাউন্ট তৈরি করুন</span>
                  <ArrowRight className="w-4 h-4" />
                </>
              )}
            </button>
          </div>
        </form>
      )}

      {/* Switch to Login Link */}
      <div className="mt-6 pt-5 border-t border-slate-100 text-center">
        <p className="text-xs text-slate-500 font-medium">
          ইতিমধ্যে আপনার অ্যাকাউন্ট রয়েছে?{' '}
          <button
            type="button"
            onClick={onSwitchToLogin}
            className="text-blue-600 hover:text-blue-700 font-bold hover:underline cursor-pointer"
          >
            সরাসরি লগইন করুন
          </button>
        </p>
      </div>

      {/* Ecosystem Trust Highlights */}
      <div className="mt-5 pt-4 border-t border-slate-100 grid grid-cols-3 gap-2 text-center text-[10px] text-slate-400 font-medium">
        <div className="flex flex-col items-center">
          <span className="text-xs text-blue-600 font-bold mb-0.5">⚡ Instant SSO</span>
          <span>All 15 Modules</span>
        </div>
        <div className="flex flex-col items-center">
          <span className="text-xs text-emerald-600 font-bold mb-0.5">🇧🇩 NID Vault</span>
          <span>Anti-Bot Shield</span>
        </div>
        <div className="flex flex-col items-center">
          <span className="text-xs text-cyan-600 font-bold mb-0.5">🔒 AES-256</span>
          <span>Encrypted Storage</span>
        </div>
      </div>

    </div>
  );
}
