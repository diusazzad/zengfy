import React, { useMemo } from 'react';
import { ShieldCheck, ShieldAlert, Shield } from 'lucide-react';

export default function PasswordStrengthMeter({ password = '' }) {
  const analysis = useMemo(() => {
    if (!password) {
      return { score: 0, label: 'পাসওয়ার্ড দিন', color: 'bg-slate-200', textClass: 'text-slate-400' };
    }

    let score = 0;
    const lower = password.toLowerCase();

    // Check common weak passwords
    const commonPatterns = ['password', '123456', 'qwerty', 'admin', 'zengfy', 'bangladesh'];
    if (commonPatterns.some((p) => lower.includes(p))) {
      return { score: 1, label: 'অতি পরিচিত বা দুর্বল পাসওয়ার্ড', color: 'bg-rose-500', textClass: 'text-rose-600' };
    }

    if (password.length >= 8) score += 1;
    if (password.length >= 12) score += 1;
    if (/[A-Z]/.test(password)) score += 1;
    if (/[0-9]/.test(password)) score += 1;
    if (/[^A-Za-z0-9]/.test(password)) score += 1;

    if (score <= 1) {
      return { score: 1, label: 'দুর্বল (কমপক্ষে ৮ অক্ষর ও মিশ্রণ দিন)', color: 'bg-rose-500', textClass: 'text-rose-600' };
    }
    if (score === 2) {
      return { score: 2, label: 'মাঝারি (বড় হাতের অক্ষর ও সংখ্যা দিন)', color: 'bg-amber-500', textClass: 'text-amber-600' };
    }
    if (score === 3 || score === 4) {
      return { score: 3, label: 'ভালো ও নিরাপদ পাসওয়ার্ড', color: 'bg-blue-500', textClass: 'text-blue-600' };
    }
    return { score: 4, label: 'অত্যন্ত শক্তিশালী ও দুর্ভেদ্য!', color: 'bg-emerald-500', textClass: 'text-emerald-600' };
  }, [password]);

  if (!password) return null;

  return (
    <div className="mt-2 space-y-1.5 transition-all duration-300">
      <div className="flex items-center justify-between text-[11px] font-semibold">
        <span className="text-slate-500 flex items-center gap-1">
          {analysis.score >= 3 ? (
            <ShieldCheck className="w-3.5 h-3.5 text-emerald-600" />
          ) : (
            <ShieldAlert className="w-3.5 h-3.5 text-amber-500" />
          )}
          পাসওয়ার্ড নিরাপত্তা স্তর:
        </span>
        <span className={`font-bold ${analysis.textClass}`}>{analysis.label}</span>
      </div>

      {/* 4-Segment Progress Bar */}
      <div className="grid grid-cols-4 gap-1.5 h-1.5 w-full">
        <div className={`h-full rounded-full transition-all duration-300 ${analysis.score >= 1 ? analysis.color : 'bg-slate-200'}`} />
        <div className={`h-full rounded-full transition-all duration-300 ${analysis.score >= 2 ? analysis.color : 'bg-slate-200'}`} />
        <div className={`h-full rounded-full transition-all duration-300 ${analysis.score >= 3 ? analysis.color : 'bg-slate-200'}`} />
        <div className={`h-full rounded-full transition-all duration-300 ${analysis.score >= 4 ? analysis.color : 'bg-slate-200'}`} />
      </div>
    </div>
  );
}
