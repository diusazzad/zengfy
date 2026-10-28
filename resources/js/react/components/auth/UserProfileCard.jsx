import React from 'react';
import { UserCheck, ShieldCheck, ShieldAlert, LogOut, CheckCircle, MailCheck, Sparkles, RefreshCw } from 'lucide-react';
import { useMockAuthStore } from './mockAuthStore';

export default function UserProfileCard() {
  const { currentUser, logout, verifyEmail, isLoading } = useMockAuthStore();

  if (!currentUser) return null;

  const isVerified = currentUser.status === 'ACTIVE';

  return (
    <div className="w-full max-w-md mx-auto bg-white rounded-3xl border border-slate-200/90 shadow-xl shadow-slate-200/50 p-6 sm:p-8 backdrop-blur-xl animate-in zoom-in-95 duration-200">
      
      {/* Header */}
      <div className="flex items-center justify-between pb-5 border-b border-slate-100">
        <div className="flex items-center gap-3">
          <div className="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-xl flex items-center justify-center shadow-md shadow-blue-500/20">
            {currentUser.fullName ? currentUser.fullName.charAt(0) : 'U'}
          </div>
          <div>
            <h3 className="text-base font-extrabold text-slate-900 leading-tight">
              {currentUser.fullName}
            </h3>
            <p className="text-xs text-slate-500 font-mono mt-0.5">{currentUser.email}</p>
          </div>
        </div>

        <button
          onClick={logout}
          className="p-2 text-slate-400 hover:text-rose-600 rounded-xl hover:bg-rose-50 transition-colors cursor-pointer"
          title="লগআউট"
        >
          <LogOut className="w-4 h-4" />
        </button>
      </div>

      {/* Trust Tier Badge */}
      <div className="my-5 p-4 rounded-2xl bg-slate-50 border border-slate-200/70">
        <div className="flex items-center justify-between mb-2">
          <span className="text-[11px] font-bold text-slate-500 uppercase tracking-wider">
            সার্বভৌম নাগরিক ট্রাস্ট স্তর
          </span>
          <span className={`inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-extrabold ${
            isVerified 
              ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' 
              : 'bg-amber-100 text-amber-800 border border-amber-300'
          }`}>
            {isVerified ? <ShieldCheck className="w-3.5 h-3.5 text-emerald-600" /> : <ShieldAlert className="w-3.5 h-3.5 text-amber-600" />}
            <span>{currentUser.trustTier || (isVerified ? 'Tier 1: Verified' : 'Tier 0: Guest')}</span>
          </span>
        </div>

        <div className="space-y-1.5 text-xs text-slate-600">
          <div className="flex justify-between">
            <span className="text-slate-400 font-medium">অ্যাকাউন্ট স্ট্যাটাস:</span>
            <span className="font-bold text-slate-800">{currentUser.status}</span>
          </div>
          <div className="flex justify-between">
            <span className="text-slate-400 font-medium">তৈরির সময়:</span>
            <span className="font-mono text-[11px] text-slate-700">
              {new Date(currentUser.createdAt).toLocaleString('bn-BD')}
            </span>
          </div>
        </div>
      </div>

      {/* Action If Not Verified */}
      {!isVerified && (
        <div className="mb-5 p-3.5 rounded-2xl bg-amber-50/80 border border-amber-200 text-amber-900 text-xs">
          <div className="flex items-start gap-2.5">
            <ShieldAlert className="w-4 h-4 text-amber-600 shrink-0 mt-0.5" />
            <div>
              <p className="font-bold text-amber-950">ইমেইল ভেরিফিকেশন বাকি রয়েছে</p>
              <p className="text-[11px] text-amber-800/90 mt-0.5 leading-relaxed">
                সোশ্যাল পোস্ট ও সিভিক গ্রুপে অংশ নিতে আপনার ইমেইল যাচাই করা প্রয়োজন।
              </p>
              <button
                onClick={() => verifyEmail(currentUser.id)}
                disabled={isLoading}
                className="mt-2.5 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-[11px] shadow-xs active:scale-95 transition-all cursor-pointer disabled:opacity-50"
              >
                <CheckCircle className="w-3.5 h-3.5" />
                <span>সরাসরি ইমেইল ভেরিফাই করুন (Demo)</span>
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Verified Banner */}
      {isVerified && (
        <div className="mb-5 p-3.5 rounded-2xl bg-emerald-50/80 border border-emerald-200 text-emerald-900 text-xs">
          <div className="flex items-center gap-2.5">
            <MailCheck className="w-4 h-4 text-emerald-600 shrink-0" />
            <span className="font-semibold text-emerald-950">
              আপনার ইমেইল সফলভাবে ভেরিফাইড! আপনি এখন সোশ্যাল ফিডে পোস্ট করতে পারবেন।
            </span>
          </div>
        </div>
      )}

      {/* Logout / Switch Button */}
      <button
        onClick={logout}
        className="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 active:scale-98 text-slate-700 text-xs font-bold rounded-xl transition-colors flex items-center justify-center gap-2 cursor-pointer"
      >
        <LogOut className="w-3.5 h-3.5" />
        <span>লগআউট করে নতুন ইউজার টেস্ট করুন</span>
      </button>

    </div>
  );
}
