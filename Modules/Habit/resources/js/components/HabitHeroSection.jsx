import React from 'react';

export default function HabitHeroSection({ brandData, statsData }) {
  const brand = brandData || {};
  const stats = statsData || {};

  return (
    <section className="relative pt-12 pb-20 sm:pt-16 sm:pb-28 overflow-hidden bg-gradient-to-b from-emerald-50/40 via-stone-50/60 to-white">
      {/* Background Subtle Gradient Blobs */}
      <div className="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[45rem] h-[25rem] bg-emerald-200/25 rounded-full blur-3xl pointer-events-none -z-10" />
      <div className="absolute top-1/3 right-10 w-[20rem] h-[20rem] bg-amber-200/25 rounded-full blur-3xl pointer-events-none -z-10" />

      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {/* National Badge */}
        <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-100/80 border border-emerald-200/80 text-emerald-900 text-xs sm:text-sm font-semibold mb-6 shadow-xs">
          <span>🇧🇩</span>
          <span>{brand.badge || '5 Daily Prayers & Daily Micro-Habit Consistency Platform'}</span>
        </div>

        {/* Emotive Headline */}
        <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6 max-w-4xl mx-auto">
          {brand.tagline_bn || '৫ ওয়াক্ত সালাত ও আত্মশুদ্ধির ধারাবাহিকতা। ১০০% বিজ্ঞাপনহীন, নিরাপদ ও ব্যক্তিগত স্ট্রিক প্ল্যাটফর্ম।'}
        </h1>

        {/* Sub-headline */}
        <p className="text-base sm:text-lg lg:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed mb-8">
          {brand.subheadline || 'কোনো অ্যালগরিদম বা স্পনসরড বিজ্ঞাপনের বিভ্রান্তি ছাড়া সালাতের নিয়মিত পাবন্দি, কুরআন তেলাওয়াত ও পরিবারের হালাকা অ্যাকাউন্টেবিলিটি রিং।'}
        </p>

        {/* Action Buttons */}
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
          <a
            href="#simulator"
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-bold text-sm sm:text-base shadow-lg shadow-emerald-900/25 hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 cursor-pointer"
          >
            <span>🔥 আজকের সালাত স্ট্রিক দেখুন</span>
            <span>→</span>
          </a>

          <a
            href="http://accounts.zengfy.top:8000/register?continue=http%3A%2F%2Fhabit.zengfy.top%3A8000%2F"
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-sm sm:text-base border border-slate-200 shadow-xs hover:border-slate-300 transition-all cursor-pointer"
          >
            <span>⭕ পরিবার ও হালাকা রিং খুলুন</span>
          </a>
        </div>

        {/* Telemetry Ribbon: 4 Key Metrics */}
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto">
          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-emerald-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-emerald-700">
              {stats.active_worshippers || '৫,২০০+'}
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              নিয়মিত মুসল্লি ও ইউজার
            </span>
          </div>

          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-emerald-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-emerald-600">
              {stats.consistency_rate || '৯৪%'}
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              সালাত কনসিস্টেন্সি রেট
            </span>
          </div>

          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-amber-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-amber-600 flex items-center gap-1">
              <span>🔥</span>
              <span>{stats.completed_streaks || '৪,৫০,০০০+'}</span>
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              কমপ্লিটেড স্ট্রিক দিন
            </span>
          </div>

          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-emerald-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-emerald-800">
              {stats.ad_free_privacy || '১০০%'}
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              নো-অ্যাড নো-ট্র্যাকিং
            </span>
          </div>
        </div>
      </div>
    </section>
  );
}
