import React, { useState } from 'react';
import { Mail, Lock, Eye, EyeOff, Loader2, ArrowRight, ArrowLeft, AlertCircle, KeyRound, ShieldCheck, CheckCircle2 } from 'lucide-react';
import { useMockAuthStore } from './mockAuthStore';

export default function LoginCard({ onSwitchToRegister }) {
  const { login: mockLogin, isLoading: isMockLoading, lastError: mockLastError, clearError: clearMockError } = useMockAuthStore();

  // Step 1: Identifier (Email), Step 2: Password
  const [step, setStep] = useState(1);
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [rememberMe, setRememberMe] = useState(true);
  const [loading, setLoading] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');
  const [successMessage, setSuccessMessage] = useState('');

  // Read continue parameter
  const urlParams = new URLSearchParams(typeof window !== 'undefined' ? window.location.search : '');
  const continueUrl = urlParams.get('continue') || urlParams.get('redirect_uri') || urlParams.get('redirect_to') || urlParams.get('redirect') || '';

  // Determine target application name from continue URL
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

  // Step 1: Validate email before moving to password
  const handleNextStep = (e) => {
    e.preventDefault();
    setErrorMessage('');
    clearMockError();

    const trimmed = email.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!trimmed || !emailRegex.test(trimmed)) {
      setErrorMessage('অনুগ্রহ করে একটি সঠিক ইমেইল ঠিকানা প্রদান করুন (যেমন: user@example.com)');
      return;
    }

    setStep(2);
  };

  // Step 2: Submit credentials to central backend
  const handleFinalSubmit = async (e) => {
    e.preventDefault();
    setErrorMessage('');
    setSuccessMessage('');
    clearMockError();

    if (!password) {
      setErrorMessage('আপনার অ্যাকাউন্টের পাসওয়ার্ড প্রদান করুন');
      return;
    }

    setLoading(true);

    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

      const res = await fetch('/api/v1/auth/login', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
          email: email.trim(),
          password: password,
          remember: rememberMe,
          device_name: navigator.userAgent.substring(0, 100),
        }),
      });

      const data = await res.json();

      if (res.ok) {
        const token = data.data?.token || data.token;
        if (token) {
          localStorage.setItem('zengfy_token', token);
        }

        setSuccessMessage(`প্রমাণীকরণ সফল! ${targetAppName}-এ রিডাইরেক্ট করা হচ্ছে...`);

        setTimeout(() => {
          let destination = continueUrl;
          if (!destination || destination === '/' || destination.endsWith('/login') || destination.endsWith('zengfy.top:8000/')) {
            destination = 'http://accounts.zengfy.top:8000/';
          }

          try {
            const parsed = new URL(destination, window.location.origin);
            if (
              parsed.hostname.endsWith('zengfy.top') ||
              parsed.hostname === 'localhost' ||
              parsed.hostname === '127.0.0.1' ||
              parsed.origin === window.location.origin
            ) {
              window.location.href = destination;
            } else {
              window.location.href = 'http://accounts.zengfy.top:8000/';
            }
          } catch (err) {
            window.location.href = 'http://accounts.zengfy.top:8000/';
          }
        }, 600);
        return;
      }

      if (res.status === 401 || res.status === 422) {
        const mockRes = await mockLogin({ email: email.trim(), password });
        if (mockRes.success) {
          setSuccessMessage('মক অ্যাকাউন্টে লগইন সফল! ড্যাশবোর্ডে যাচ্ছেন...');
          setTimeout(() => {
            window.location.href = continueUrl || 'http://accounts.zengfy.top:8000/';
          }, 600);
          return;
        }

        setErrorMessage(data.message || 'ভুল ইমেইল বা পাসওয়ার্ড। অনুগ্রহ করে পুনরায় চেষ্টা করুন।');
        setLoading(false);
        return;
      }

      if (res.status === 429 || res.status === 423) {
        setErrorMessage(data.message || 'অতিরিক্ত বার ভুল চেষ্টার কারণে অ্যাকাউন্ট সাময়িক লক করা হয়েছে।');
        setLoading(false);
        return;
      }

      setErrorMessage(data.message || 'লগইন ব্যর্থ হয়েছে।');
      setLoading(false);

    } catch (err) {
      const mockRes = await mockLogin({ email: email.trim(), password });
      if (mockRes.success) {
        setSuccessMessage('মক অথেনটিকেশন সফল! ড্যাশবোর্ডে যাচ্ছেন...');
        setTimeout(() => {
          window.location.href = continueUrl || 'http://accounts.zengfy.top:8000/';
        }, 600);
        return;
      }
      setErrorMessage('নেটওয়ার্ক সংযোগ বিচ্ছিন্ন অথবা সার্ভার সমস্যা।');
      setLoading(false);
    }
  };

  const handleFillDemo = () => {
    setEmail('demo@zengfy.com');
    setPassword('Password123');
    setErrorMessage('');
    setStep(2);
  };

  return (
    <div className="w-full max-w-md mx-auto bg-white/95 rounded-3xl border border-slate-200/90 shadow-2xl shadow-blue-500/10 p-6 sm:p-8 backdrop-blur-2xl relative overflow-hidden transition-all duration-300">
      
      {/* Top Gradient Accent Strip */}
      <div className="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500"></div>

      {/* Contextual Target App Badge */}
      <div className="text-center mb-6 relative z-10">
        <div className="w-12 h-12 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-md shadow-blue-500/25 text-white font-black text-2xl tracking-tighter">
          Z
        </div>

        {continueUrl ? (
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold mb-2 shadow-2xs">
            <span className="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            <span>{targetAppName}-এ যাওয়ার জন্য লগইন করুন</span>
          </div>
        ) : (
          <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold mb-2 shadow-2xs">
            <ShieldCheck className="w-3.5 h-3.5 text-blue-600" />
            <span>Zengfy সেন্ট্রাল আইডেন্টিটি ও SSO</span>
          </div>
        )}

        <h2 className="text-2xl font-extrabold text-slate-900 tracking-tight">
          {step === 1 ? 'অ্যাকাউন্টে সাইন-ইন' : 'পাসওয়ার্ড নিশ্চিত করুন'}
        </h2>
        <p className="text-xs text-slate-500 mt-1 font-medium">
          {step === 1 
            ? 'সেন্ট্রাল আইডেন্টিটি দিয়ে আপনার সমস্ত সেবায় প্রবেশ করুন' 
            : 'আপনার সুরক্ষিত মাস্টার পাসওয়ার্ড দিয়ে প্রমাণীকরণ করুন'}
        </p>
      </div>

      {/* Error Banner */}
      {(errorMessage || mockLastError) && (
        <div className="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs flex items-start gap-2.5 animate-in fade-in duration-200">
          <AlertCircle className="w-4 h-4 shrink-0 mt-0.5 text-rose-600" />
          <span className="leading-relaxed font-medium">{errorMessage || mockLastError}</span>
        </div>
      )}

      {/* Success Banner */}
      {successMessage && (
        <div className="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs flex items-center gap-2.5 animate-in fade-in duration-200">
          <CheckCircle2 className="w-4 h-4 shrink-0 text-emerald-600" />
          <span className="leading-relaxed font-medium">{successMessage}</span>
        </div>
      )}

      {/* STEP 1: IDENTIFIER (EMAIL) */}
      {step === 1 && (
        <form onSubmit={handleNextStep} className="space-y-4">
          <div>
            <label htmlFor="login-email" className="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">
              ইমেইল ঠিকানা (Email Address)
            </label>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <Mail className="w-4 h-4" />
              </div>
              <input
                id="login-email"
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
                autoFocus
                autoComplete="username email"
                placeholder="name@domain.com"
                className="w-full pl-10 pr-3.5 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
              />
            </div>
          </div>

          <button
            type="submit"
            className="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-500/25 hover:shadow-xl transition-all flex items-center justify-center gap-2 cursor-pointer"
          >
            <span>পরবর্তী ধাপ (Next)</span>
            <ArrowRight className="w-4 h-4" />
          </button>

          {/* 1-Click Demo Fill */}
          <button
            type="button"
            onClick={handleFillDemo}
            className="w-full py-2.5 px-3 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-600 text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors cursor-pointer mt-2"
          >
            <KeyRound className="w-3.5 h-3.5 text-blue-600" />
            <span>১-ক্লিকে ডেমো টেস্ট (demo@zengfy.com)</span>
          </button>
        </form>
      )}

      {/* STEP 2: PASSWORD VERIFICATION */}
      {step === 2 && (
        <form onSubmit={handleFinalSubmit} className="space-y-4">
          {/* Selected Email Pill with Change Option */}
          <div className="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-200/90 text-xs mb-3">
            <div className="flex items-center gap-2 min-w-0">
              <div className="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs shrink-0">
                {email.charAt(0).toUpperCase()}
              </div>
              <span className="truncate font-semibold text-slate-800">{email}</span>
            </div>
            <button
              type="button"
              onClick={() => {
                setStep(1);
                setErrorMessage('');
              }}
              className="text-blue-600 hover:text-blue-700 font-bold text-xs shrink-0 flex items-center gap-1 cursor-pointer hover:underline ml-2"
            >
              <ArrowLeft className="w-3 h-3" />
              <span>পরিবর্তন</span>
            </button>
          </div>

          <div>
            <div className="flex items-center justify-between mb-1.5">
              <label htmlFor="login-password" className="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                পাসওয়ার্ড (Password)
              </label>
              <a href="/forgot-password" className="text-xs font-semibold text-blue-600 hover:underline">
                পাসওয়ার্ড ভুলে গেছেন?
              </a>
            </div>
            <div className="relative">
              <div className="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <Lock className="w-4 h-4" />
              </div>
              <input
                id="login-password"
                type={showPassword ? 'text' : 'password'}
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
                autoFocus
                autoComplete="current-password"
                placeholder="••••••••••••"
                className="w-full pl-10 pr-11 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
              />
              <button
                type="button"
                onClick={() => setShowPassword(!showPassword)}
                className="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer"
              >
                {showPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
              </button>
            </div>
          </div>

          {/* Remember Me */}
          <div className="flex items-center gap-2">
            <input
              id="rememberMe"
              type="checkbox"
              checked={rememberMe}
              onChange={(e) => setRememberMe(e.target.checked)}
              className="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300 cursor-pointer"
            />
            <label htmlFor="rememberMe" className="text-xs text-slate-600 font-medium cursor-pointer">
              আমাকে এই ডিভাইসে মনে রাখুন (Remember this device)
            </label>
          </div>

          {/* Submit Button */}
          <button
            type="submit"
            disabled={loading || isMockLoading}
            className="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 hover:from-blue-700 hover:via-indigo-700 hover:to-cyan-700 active:scale-[0.98] text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-500/25 hover:shadow-xl transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-60"
          >
            {loading || isMockLoading ? (
              <>
                <Loader2 className="w-4 h-4 animate-spin" />
                <span>প্রমাণীকরণ হচ্ছে...</span>
              </>
            ) : (
              <>
                <span>সাইন ইন সম্পন্ন করুন</span>
                <ArrowRight className="w-4 h-4" />
              </>
            )}
          </button>
        </form>
      )}

      {/* Divider */}
      <div className="relative my-6">
        <div className="absolute inset-0 flex items-center">
          <div className="w-full border-t border-slate-200"></div>
        </div>
        <div className="relative flex justify-center text-xs uppercase">
          <span className="bg-white px-3 text-slate-400 font-semibold tracking-wider">Zengfy প্ল্যাটফর্মে নতুন?</span>
        </div>
      </div>

      {/* Switch to Register Link */}
      <div className="text-center">
        <button
          type="button"
          onClick={onSwitchToRegister}
          className="w-full flex items-center justify-center py-3 px-4 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs transition-all shadow-2xs cursor-pointer"
        >
          এখানে ৩টি ফিল্ডে নতুন অ্যাকাউন্ট তৈরি করুন
        </button>
      </div>

    </div>
  );
}
