import React from 'react';
import { ArrowRight, ShieldCheck, CheckCircle2, Sparkles, Building2, Users, Radio, Award } from 'lucide-react';

export default function SchoolHeroSection({
    brand = {},
    stats = {},
    links = {},
    onExploreRfid,
    onExplorePricing
}) {
    return (
        <section aria-labelledby="school-hero-heading" className="pt-10 sm:pt-16 pb-12 sm:pb-20 text-center relative">
            
            {/* Top Pill / Badge */}
            <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/90 border border-emerald-200/80 shadow-xs mb-6 sm:mb-8 hover:border-emerald-300 transition-colors">
                <span className="flex h-2.5 w-2.5 relative">
                    <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span className="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span className="text-xs font-bold text-slate-800 tracking-wide">
                    জাতীয় শিক্ষাক্রম (NCTB) ও মাদরাসা শিক্ষা বোর্ড কম্প্যাটিবল
                </span>
                <span className="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-emerald-100/80 text-emerald-800">
                    Sovereign ERP
                </span>
            </div>

            {/* Emotive Bengali Main Headline */}
            <h1
                id="school-hero-heading"
                className="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black tracking-tight text-slate-900 leading-[1.12] sm:leading-[1.15] max-w-5xl mx-auto"
            >
                কাগজের ঝামেলাহীন আধুনিক ক্যাম্পাস।{' '}
                <span className="block mt-2 sm:mt-3 bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 bg-clip-text text-transparent">
                    অভিভাবকের নিশ্চিন্ত ভরসা।
                </span>
            </h1>

            {/* Subtitle */}
            <p className="mt-6 sm:mt-8 text-base sm:text-lg md:text-xl text-slate-600 font-medium max-w-3xl mx-auto leading-relaxed">
                স্মার্ট আরএফআইডি গেট হাজিরায় সেকেন্ডে অভিভাবকের ফোনে এসএমএস, ১-ক্লিকে স্বয়ংক্রিয় প্রগ্রেস রিপোর্ট কার্ড এবং ব্যাংকের লাইনে না দাঁড়িয়ে ১-ট্যাপে স্বচ্ছ বিকাশ/নগদ ডিজিটাল ফি কালেকশন।
            </p>

            {/* Action Buttons */}
            <div className="mt-8 sm:mt-10 flex flex-wrap items-center justify-center gap-4">
                <button
                    type="button"
                    onClick={onExploreRfid}
                    className="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 hover:from-emerald-700 hover:to-indigo-700 text-white font-bold text-sm sm:text-base shadow-lg shadow-emerald-500/25 hover:shadow-xl hover:shadow-emerald-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer"
                >
                    <span>আরএফআইডি ডেমো পাঞ্চ করুন</span>
                    <Radio className="w-4 h-4 animate-pulse" />
                </button>

                <button
                    type="button"
                    onClick={onExplorePricing}
                    className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-white hover:bg-slate-50 border border-slate-200 text-slate-800 hover:text-emerald-700 font-bold text-sm sm:text-base shadow-xs hover:border-emerald-200 hover:shadow-md transition-all cursor-pointer"
                >
                    <span>প্যাকেজ ও অফার দেখুন (৳২,০০০/মাস)</span>
                    <ArrowRight className="w-4 h-4" />
                </button>

                <a
                    href={links.register || "http://accounts.zengfy.top:8000/register"}
                    className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-emerald-50 hover:bg-emerald-100/80 border border-emerald-200/80 text-emerald-800 font-bold text-sm sm:text-base transition-all"
                >
                    <span>ফ্রি ট্রায়াল শুরু করুন</span>
                </a>
            </div>

            {/* Live Institutional Telemetry Ribbon */}
            <div className="mt-14 sm:mt-20 max-w-5xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 text-left">
                
                {/* 1. Institutions */}
                <div className="p-4 sm:p-5 rounded-3xl bg-white/80 backdrop-blur-xl border border-slate-200/70 shadow-xs hover:shadow-md hover:border-emerald-200 transition-all">
                    <div className="flex items-center justify-between mb-2">
                        <div className="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-200/60 flex items-center justify-center text-emerald-600 font-bold">
                            <Building2 className="w-5 h-5" />
                        </div>
                        <span className="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                            স্কুল ও কলেজ
                        </span>
                    </div>
                    <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {stats.institutions_count ? `${stats.institutions_count}+` : '৫৪০+'}
                    </div>
                    <p className="text-xs text-slate-500 font-medium mt-1">সক্রিয় শিক্ষা প্রতিষ্ঠান ও একাডেমি</p>
                </div>

                {/* 2. Students */}
                <div className="p-4 sm:p-5 rounded-3xl bg-white/80 backdrop-blur-xl border border-slate-200/70 shadow-xs hover:shadow-md hover:border-teal-200 transition-all">
                    <div className="flex items-center justify-between mb-2">
                        <div className="w-9 h-9 rounded-xl bg-teal-50 border border-teal-200/60 flex items-center justify-center text-teal-600 font-bold">
                            <Users className="w-5 h-5" />
                        </div>
                        <span className="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-teal-100 text-teal-800">
                            সক্রিয় শিক্ষার্থী
                        </span>
                    </div>
                    <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {stats.students_count ? `${stats.students_count.toLocaleString()}+` : '১,৮০,০০০+'}
                    </div>
                    <p className="text-xs text-slate-500 font-medium mt-1">স্মার্ট ডিজিটাল আইডি ব্যবহারকারী</p>
                </div>

                {/* 3. Attendance Accuracy */}
                <div className="p-4 sm:p-5 rounded-3xl bg-white/80 backdrop-blur-xl border border-slate-200/70 shadow-xs hover:shadow-md hover:border-indigo-200 transition-all">
                    <div className="flex items-center justify-between mb-2">
                        <div className="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-200/60 flex items-center justify-center text-indigo-600 font-bold">
                            <ShieldCheck className="w-5 h-5" />
                        </div>
                        <span className="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-800">
                            নির্ভুলতা
                        </span>
                    </div>
                    <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {stats.attendance_accuracy || '৯৯.৯%'}
                    </div>
                    <p className="text-xs text-slate-500 font-medium mt-1">স্বয়ংক্রিয় আরএফআইডি ও এসএমএস</p>
                </div>

                {/* 4. Nationwide Coverage */}
                <div className="p-4 sm:p-5 rounded-3xl bg-white/80 backdrop-blur-xl border border-slate-200/70 shadow-xs hover:shadow-md hover:border-cyan-200 transition-all">
                    <div className="flex items-center justify-between mb-2">
                        <div className="w-9 h-9 rounded-xl bg-cyan-50 border border-cyan-200/60 flex items-center justify-center text-cyan-600 font-bold">
                            <Award className="w-5 h-5" />
                        </div>
                        <span className="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-cyan-100 text-cyan-800">
                            সারাদেশে
                        </span>
                    </div>
                    <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                        {stats.wards_covered ? `${stats.wards_covered.toLocaleString()}` : '৪,৫৫৪'}
                    </div>
                    <p className="text-xs text-slate-500 font-medium mt-1">সকল ইউনিয়ন ও ওয়ার্ডে নেটওয়ার্ক</p>
                </div>

            </div>

        </section>
    );
}
