import React from 'react';
import { Sparkles, ArrowRight, CheckCircle2, ShieldCheck, Zap, Barcode, PhoneCall } from 'lucide-react';

export default function POSHeroSection({ brand = {}, stats = {}, links = {}, onTrySimulator }) {
    return (
        <section className="relative pt-12 pb-16 md:pt-20 md:pb-24 overflow-hidden">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                
                {/* Top Sovereign Badge */}
                <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-50/90 border border-amber-200/80 shadow-xs mb-6 sm:mb-8 animate-in fade-in slide-in-from-top-4 duration-500">
                    <span className="w-2 h-2 rounded-full bg-amber-500 animate-ping" />
                    <span className="text-xs sm:text-sm font-bold text-amber-900 flex items-center gap-1.5">
                        <span>🇧🇩</span>
                        <span>ফ্যাশন বুটিক ও শপিং মল রিটেইলের জন্য তৈরি • ১.৮ সেকেন্ডে বারকোড মেমো</span>
                    </span>
                </div>

                {/* Main H1 Emotive Headline */}
                <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 max-w-5xl mx-auto leading-[1.15] sm:leading-[1.12]">
                    আপনার শোরুমের কেনাবেচা ডিজিটাইজ করুন,{' '}
                    <span className="bg-gradient-to-r from-amber-600 via-orange-600 to-rose-600 bg-clip-text text-transparent">
                        সুপারফাস্ট বারকোড ক্যাশ কাউন্টারে
                    </span>{' '}
                    লাইনমুক্ত রাখুন 🛒
                </h1>

                {/* Sub-headline */}
                <p className="mt-6 text-base sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-normal">
                    পোশাকের কালার ও সাইজ ম্যাট্রিক্স বারকোড বিলিং, ২ সেকেন্ডে থার্মাল রসিদ প্রিন্ট, 
                    ডিজিটাল বাকি খাতা ও স্বয়ংক্রিয় bKash তাগাদা SMS—<span className="font-semibold text-slate-800">বুটিক ও শপিং মল আউটলেটের ১০০% ঝামেলামুক্ত অল-ইন-ওয়ান রিটেইল ইআরপি।</span>
                </p>

                {/* Hero CTAs */}
                <div className="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 max-w-md mx-auto">
                    <a
                        href={links.register || "/register"}
                        className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-600 via-orange-600 to-rose-600 hover:from-amber-700 hover:to-rose-700 text-white font-extrabold text-base shadow-xl shadow-orange-500/25 hover:shadow-2xl hover:shadow-orange-500/35 active:scale-95 transition-all"
                    >
                        <span>বুটিক ডেমো চালু করুন (৳৮,০০০/বছর)</span>
                        <ArrowRight className="w-5 h-5" />
                    </a>

                    <button
                        type="button"
                        onClick={onTrySimulator}
                        className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-white/90 hover:bg-slate-50 border border-slate-200/90 text-slate-800 font-bold text-base shadow-xs hover:shadow-md transition-all cursor-pointer"
                    >
                        <Barcode className="w-5 h-5 text-amber-600" />
                        <span>লাইভ বারকোড সিমুলেটর</span>
                    </button>
                </div>

                {/* Feature Pills */}
                <div className="mt-8 flex flex-wrap items-center justify-center gap-3 text-xs sm:text-sm font-semibold text-slate-600">
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>সাইজ-কালার ম্যাট্রিক্স</span>
                    </div>
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>থার্মাল বিল ও SMS স্লিপ</span>
                    </div>
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>অটো বাকি খাতা ও বিকাশ রিকভারি</span>
                    </div>
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>সোশ্যাল ১-ক্লিক শপউইন্ডো</span>
                    </div>
                </div>

                {/* Trust Statistics Ribbon */}
                <div className="mt-14 max-w-5xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            {stats.active_showrooms || '1,280+'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            সক্রিয় ফ্যাশন শোরুম ও বুটিক
                        </div>
                    </div>

                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-amber-700 tracking-tight">
                            {stats.avg_checkout_speed || '1.8s'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            গড় বারকোড চেকআউট স্পিড
                        </div>
                    </div>

                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-emerald-600 tracking-tight">
                            {stats.sms_recovery_rate || '91.4%'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            বিকাশ SMS বকেয়া আদায় হার
                        </div>
                    </div>

                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            {stats.daily_bills_processed || '480,000+'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            পিক ডে মেমো প্রসেসড
                        </div>
                    </div>
                </div>

            </div>
        </section>
    );
}