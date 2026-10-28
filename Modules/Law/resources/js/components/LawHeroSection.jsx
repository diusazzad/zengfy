import React from 'react';
import { ArrowRight, CheckCircle2, Scale, Calendar, ShieldCheck, Sparkles, BookOpen } from 'lucide-react';

export default function LawHeroSection({ brand = {}, stats = {}, links = {}, onTrySimulator }) {
    return (
        <section className="relative pt-12 pb-16 md:pt-20 md:pb-24 overflow-hidden">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                
                {/* Top Sovereign Badge */}
                <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-50/90 border border-rose-200/80 shadow-xs mb-6 sm:mb-8 animate-in fade-in slide-in-from-top-4 duration-500">
                    <span className="w-2 h-2 rounded-full bg-[#881337] animate-ping" />
                    <span className="text-xs sm:text-sm font-bold text-[#881337] flex items-center gap-1.5">
                        <span>⚖️</span>
                        <span>সুপ্রিম কোর্ট ও ৬৪ জেলার জজ আদালতের ডিজিটাল চেম্বার নেটওয়ার্ক</span>
                    </span>
                </div>

                {/* Main H1 Headline */}
                <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 max-w-5xl mx-auto leading-[1.15] sm:leading-[1.12]">
                    মামলার তারিখ আর কখনো মিস হবে না—{' '}
                    <span className="bg-gradient-to-r from-[#881337] via-rose-800 to-amber-700 bg-clip-text text-transparent">
                        কজলিস্ট অটো-স্ক্র্যাপার ও কেস ভল্ট
                    </span>{' '}
                    ⚖️
                </h1>

                {/* Sub-headline */}
                <p className="mt-6 text-base sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed font-normal">
                    হাইকোর্ট ও জেলা আদালতের দৈনিক কজলিস্ট স্বয়ংক্রিয় ট্র্যাকিং, ১-ক্লিকে ওকালতনামা ও বেইল পিটিশন ড্রাফটিং, 
                    মুহুরি পেশকার লেজার এবং মক্কেলকে হেয়ারিং SMS নোটিশ—<span className="font-semibold text-slate-800">আইনজীবীদের চেম্বার পরিচালনার ১০০% সার্বভৌম ও নির্ভরযোগ্য প্ল্যাটফর্ম।</span>
                </p>

                {/* Hero CTAs */}
                <div className="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 max-w-md mx-auto">
                    <a
                        href={links.register || "/register"}
                        className="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-2xl bg-gradient-to-r from-[#881337] via-rose-800 to-amber-700 hover:from-rose-900 hover:to-amber-800 text-white font-extrabold text-base shadow-xl shadow-rose-950/25 hover:shadow-2xl hover:shadow-rose-950/35 active:scale-95 transition-all"
                    >
                        <span>চেম্বার ডেমো চালু করুন</span>
                        <ArrowRight className="w-5 h-5" />
                    </a>

                    <button
                        type="button"
                        onClick={onTrySimulator}
                        className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-white/90 hover:bg-slate-50 border border-slate-200/90 text-slate-800 font-bold text-base shadow-xs hover:shadow-md transition-all cursor-pointer"
                    >
                        <Scale className="w-5 h-5 text-[#881337]" />
                        <span>লাইভ কজলিস্ট সিমুলেটর</span>
                    </button>
                </div>

                {/* Feature Pills */}
                <div className="mt-8 flex flex-wrap items-center justify-center gap-3 text-xs sm:text-sm font-semibold text-slate-600">
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>ডেইলি কজলিস্ট স্ক্র্যাপার</span>
                    </div>
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>১-ক্লিক ওকালতনামা ড্রাফটার</span>
                    </div>
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>মুহুরি ও পেশকার লেজার</span>
                    </div>
                    <div className="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60">
                        <CheckCircle2 className="w-4 h-4 text-emerald-600" />
                        <span>২৫৬-বিট দলিল ও খতিয়ান ভল্ট</span>
                    </div>
                </div>

                {/* Trust Statistics Ribbon */}
                <div className="mt-14 max-w-5xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            {stats.active_advocates || '840+'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            সক্রিয় আইনজীবী ও চেম্বার
                        </div>
                    </div>

                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-[#881337] tracking-tight">
                            {stats.tracked_cases || '42,000+'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            লাইভ কজলিস্ট ট্র্যাকড মামলা
                        </div>
                    </div>

                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-amber-700 tracking-tight">
                            ৬৪ জেলা
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            জজ আদালত + সুপ্রিম কোর্ট
                        </div>
                    </div>

                    <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/80 shadow-xs text-left">
                        <div className="text-2xl sm:text-3xl font-black text-emerald-600 tracking-tight">
                            {stats.missed_cause_list_dates || '0.00%'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">
                            মিসড কজলিস্ট ডেট গ্যারান্টি
                        </div>
                    </div>
                </div>

            </div>
        </section>
    );
}