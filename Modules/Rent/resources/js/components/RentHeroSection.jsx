import React from 'react';

export default function RentHeroSection({ brand = {}, stats = {} }) {
  return (
    <section className="relative pt-12 pb-20 sm:pt-16 sm:pb-24 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto space-y-6">
          {/* Top Pill / Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-900 border border-indigo-200/80 shadow-xs">
            <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>{brand.badge || '🇧🇩 Bangladesh Hyperlocal Pay-Per-Km House & Mess Rental Mesh'}</span>
          </div>

          {/* Emotive Main Headline */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15]">
            দালালমুক্ত বাড়ি ভাড়া। <span className="text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 via-indigo-800 to-emerald-600">১ ক্লিকে ১ কিলোমিটারের সকল টু-লেট আনলক।</span>
          </h1>

          {/* Bengali Subtitle */}
          <p className="text-base sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
            {brand.tagline_bn || 'দালালমুক্ত বাড়ি ভাড়া। ১ ক্লিকে ১ কিলোমিটারের সকল টু-লেট আনলক।'} 
            <span className="block mt-1 font-medium text-slate-500">
              কোনো ব্রোকার বা দালাল চক্র নেই! জিপিএস ম্যাপে আপনার কাঙ্ক্ষিত এলাকার ১ কিমি বা ৩ কিমি রেডিয়াসের সকল বাসার নম্বর ও ফ্ল্যাট বিবরণ মাত্র ৳৫০ বা ৳২৫০ মাইক্রো-পেমেন্টে সরাসরি আনলক করুন।
            </span>
          </p>

          {/* CTA Buttons */}
          <div className="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
              href="#simulator"
              className="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-indigo-700 hover:bg-indigo-800 text-white font-bold text-sm shadow-xl shadow-indigo-700/25 hover:shadow-indigo-700/35 transition-all flex items-center justify-center gap-2 group"
            >
              <span>১ কিমি টু-লেট আনলকার ডেমো দেখুন (৳৫০)</span>
              <svg className="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </a>

            <a
              href="#pricing"
              className="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-white/90 hover:bg-white text-slate-800 font-bold text-sm border border-slate-200/90 shadow-sm hover:border-slate-300 transition-all flex items-center justify-center gap-2"
            >
              <span>বাড়িওয়ালার ফ্ল্যাট লিস্টিং (৳২৫০)</span>
              <svg className="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>

          {/* Core Values Strip */}
          <div className="pt-2 text-xs font-semibold text-slate-500 flex flex-wrap items-center justify-center gap-4">
            <span className="flex items-center gap-1.5 text-emerald-800 bg-emerald-50/80 px-3 py-1 rounded-lg border border-emerald-100">
              ✓ ১ মাসের ভাড়ার কোনো দালালি নেই (৳০ ব্রোকারেজ)
            </span>
            <span className="flex items-center gap-1.5 text-indigo-800 bg-indigo-50/80 px-3 py-1 rounded-lg border border-indigo-100">
              ✓ সরাসরি বাড়িওয়ালার আসল ফোন নম্বর ও ফটো
            </span>
            <span className="flex items-center gap-1.5 text-slate-800 bg-slate-100 px-3 py-1 rounded-lg border border-slate-200">
              ✓ আইনি বাড়িভাড়া চুক্তিপত্র ভল্ট
            </span>
          </div>
        </div>

        {/* Real Estate Trust Ribbon */}
        <div className="mt-14 max-w-5xl mx-auto">
          <div className="rounded-3xl bg-white/80 backdrop-blur-xl border border-indigo-100/80 shadow-lg shadow-indigo-950/5 p-6 sm:p-8">
            <div className="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 text-center divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
              <div className="pt-4 lg:pt-0">
                <div className="text-2xl sm:text-3xl font-black text-indigo-700 tracking-tight">
                  {stats.verified_listings || '২৪,৫০০+'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">ভেরিফায়েড টু-লেট বাসা</div>
                <div className="text-[11px] text-slate-400 mt-0.5">ঢাকা, চট্টগ্রাম ও বিভাগীয় শহর</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                  {stats.precision_radius || '১ কিমি / ৩ কিমি'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">হাইপারলোকাল জিপিএস মেশ</div>
                <div className="text-[11px] text-slate-400 mt-0.5">হাঁটা দূরত্বের নিখুঁত রেডিয়াস</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-emerald-600 tracking-tight">
                  {stats.broker_commission || '৳০ দালাল কমিশন'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">জিরো ব্রোকার নেটওয়ার্ক</div>
                <div className="text-[11px] text-slate-400 mt-0.5">সরাসরি বাড়িওয়ালার সাথে চুক্তি</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-indigo-700 tracking-tight">
                  {stats.happy_tenants_score || '৯৯.২%'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">সন্তুষ্ট ভাড়াটিয়া ও পরিবার</div>
                <div className="text-[11px] text-slate-400 mt-0.5">১ দিনে বাসা খোঁজার রেকর্ড</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
