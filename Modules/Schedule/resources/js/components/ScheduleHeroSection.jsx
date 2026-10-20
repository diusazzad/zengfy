import React from 'react';

export default function ScheduleHeroSection({ brandData, statsData }) {
  const brand = brandData || {};
  const stats = statsData || {};

  return (
    <section className="relative pt-12 pb-20 sm:pt-16 sm:pb-28 overflow-hidden bg-gradient-to-b from-indigo-50/50 via-slate-50/60 to-white">
      {/* Background Subtle Gradient Glow Orbs */}
      <div className="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[45rem] h-[25rem] bg-indigo-200/25 rounded-full blur-3xl pointer-events-none -z-10" />
      <div className="absolute top-1/3 right-10 w-[20rem] h-[20rem] bg-cyan-200/25 rounded-full blur-3xl pointer-events-none -z-10" />

      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {/* National Badge */}
        <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-100/80 border border-indigo-200/80 text-indigo-900 text-xs sm:text-sm font-semibold mb-6 shadow-xs">
          <span>🇧🇩</span>
          <span>{brand.badge || 'Professional Appointment & Consultation Scheduling Calendar ERP'}</span>
        </div>

        {/* Emotive Headline */}
        <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6 max-w-4xl mx-auto">
          {brand.tagline_bn || 'পেশাজীবীদের সময়ের পূর্ণ মর্যাদা। "কখন ফ্রি আছেন?" মেসেজিং বন্ধ করে লাইভ স্লট বুকিং ও নিশ্চিত ফি আদায়।'}
        </h1>

        {/* Sub-headline */}
        <p className="text-base sm:text-lg lg:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed mb-8">
          {brand.subheadline || 'ডাক্তার, আইনজীবী, ফ্রিল্যান্সার ও কনসালট্যান্টদের জন্য নো-শো জিরো করার স্বয়ংক্রিয় এসএমএস/হোয়াটসঅ্যাপ রিমাইন্ডার ও অগ্রিম বিকাশ ডিপোজিট কালেকশন।'}
        </p>

        {/* Action Buttons */}
        <div className="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
          <a
            href="#simulator"
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-700 hover:to-cyan-700 text-white font-bold text-sm sm:text-base shadow-lg shadow-indigo-900/25 hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 cursor-pointer"
          >
            <span>📅 বুকিং ক্যালেন্ডার স্যান্ডবক্স দেখুন</span>
            <span>→</span>
          </a>

          <a
            href="http://accounts.zengfy.top:8000/register?continue=http%3A%2F%2Fschedule.zengfy.top%3A8000%2F"
            className="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white hover:bg-slate-50 text-slate-800 font-bold text-sm sm:text-base border border-slate-200 shadow-xs hover:border-slate-300 transition-all cursor-pointer"
          >
            <span>⚡ নিজস্ব বুকিং পেজ খুলুন</span>
          </a>
        </div>

        {/* Telemetry Ribbon: 4 Key Metrics */}
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto">
          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-indigo-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-indigo-700">
              {stats.active_professionals || '৩,৮০০+'}
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              পেশাজীবী ও চেম্বার
            </span>
          </div>

          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-cyan-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-cyan-700">
              {stats.noshow_reduction || '৯২%'}
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              নো-শো রিডাকশন রেট
            </span>
          </div>

          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-indigo-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-indigo-600">
              {stats.successful_appointments || '১,২০,০০০+'}
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              সাকসেসফুল অ্যাপয়েন্টমেন্ট
            </span>
          </div>

          <div className="p-5 rounded-2xl bg-white/90 backdrop-blur-md border border-cyan-100 shadow-sm flex flex-col items-center">
            <span className="text-xl sm:text-2xl font-black text-cyan-600">
              {stats.bkash_integration || '১০০%'}
            </span>
            <span className="text-xs text-slate-500 font-medium mt-1">
              বিকাশ নো-ফি ইন্টিগ্রেশন
            </span>
          </div>
        </div>
      </div>
    </section>
  );
}
