import React from 'react';

export default function NGOHeroSection({ brand = {}, stats = {} }) {
  return (
    <section className="relative pt-12 pb-20 sm:pt-16 sm:pb-24 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto space-y-6">
          {/* Top Pill / Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold bg-teal-50 text-teal-900 border border-teal-200/80 shadow-xs">
            <span className="w-2 h-2 rounded-full bg-teal-600 animate-pulse"></span>
            <span>{brand.badge || '🇧🇩 Bangladesh Sovereign Crowdfunding & Zakat Trust Platform'}</span>
          </div>

          {/* Emotive Main Headline */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15]">
            স্বচ্ছ অনুদান, আস্থার সংযোগ। <span className="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-rose-600">প্রবাসী ও দাতাদের শতভাগ নিশ্চিত ভরসা।</span>
          </h1>

          {/* Bengali Subtitle */}
          <p className="text-base sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
            {brand.tagline_bn || 'চ্যারিটি ট্রাস্ট, এতিমখানা ও মানবিক সংস্থার জন্য সার্বভৌম ক্রাউডফান্ডিং ও শরীয়াহ যাকাত ইঞ্জিন।'} 
            <span className="block mt-1 font-medium text-slate-500">
              সাধারণ দান ও যাকাত ফান্ডের সম্পূর্ণ আলাদা লেজার, সরাসরি নিজস্ব ব্যাংক একাউন্টে সেটেলমেন্ট এবং প্রতিটি টাকার জিও-ট্যাগড ডিজিটাল মানি রিসিট।
            </span>
          </p>

          {/* CTA Buttons */}
          <div className="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
              href="#simulator"
              className="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-sm shadow-xl shadow-teal-600/25 hover:shadow-teal-600/35 transition-all flex items-center justify-center gap-2 group"
            >
              <span>লাইভ অনুদান ও যাকাত ডেমো টেস্ট করুন</span>
              <svg className="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </a>

            <a
              href="#pricing"
              className="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-white/90 hover:bg-white text-slate-800 font-bold text-sm border border-slate-200/90 shadow-sm hover:border-slate-300 transition-all flex items-center justify-center gap-2"
            >
              <span>চ্যারিটি ট্রাস্ট প্যাকেজ ও লাইসেন্স</span>
              <svg className="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>

          {/* Trust Guarantees */}
          <div className="pt-2 text-xs font-semibold text-slate-500 flex flex-wrap items-center justify-center gap-4">
            <span className="flex items-center gap-1.5 text-teal-800 bg-teal-50/80 px-3 py-1 rounded-lg border border-teal-100">
              ✓ জিরো থার্ড-পার্টি কমিশন
            </span>
            <span className="flex items-center gap-1.5 text-teal-800 bg-teal-50/80 px-3 py-1 rounded-lg border border-teal-100">
              ✓ শরীয়াহ বোর্ডের যাকাত অডিট গাইডলাইন
            </span>
            <span className="flex items-center gap-1.5 text-rose-800 bg-rose-50/80 px-3 py-1 rounded-lg border border-rose-100">
              ✓ আয়কর রেয়াতযোগ্য ভেরিফায়েড মানি রিসিট
            </span>
          </div>
        </div>

        {/* Humanitarian Trust Ribbon */}
        <div className="mt-14 max-w-5xl mx-auto">
          <div className="rounded-3xl bg-white/80 backdrop-blur-xl border border-teal-100/80 shadow-lg shadow-teal-950/5 p-6 sm:p-8">
            <div className="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 text-center divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
              <div className="pt-4 lg:pt-0">
                <div className="text-2xl sm:text-3xl font-black text-teal-700 tracking-tight">
                  {stats.total_donations_collected || '৳৩২ কোটি+'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">সংগৃহীত অনুদান ও যাকাত</div>
                <div className="text-[11px] text-slate-400 mt-0.5">১০০% ভেরিফায়েড ব্যাংক ট্রান্সফার</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                  {stats.active_campaigns || '৯৮০+'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">সফল চ্যারিটি ক্যাম্পেইন</div>
                <div className="text-[11px] text-slate-400 mt-0.5">বন্যা, শীতবস্ত্র, চিকিৎসা ও এতিমখানা</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-rose-600 tracking-tight">
                  {stats.beneficiary_families || '১,৮০,০০০+'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">সাহায্যপ্রাপ্ত পরিবার</div>
                <div className="text-[11px] text-slate-400 mt-0.5">ডিজিটাল কিউআর কার্ডে ত্রাণ বিতরণ</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-emerald-600 tracking-tight">
                  {stats.audit_transparency_score || '১০০%'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">অডিট স্বচ্ছতা স্কোর</div>
                <div className="text-[11px] text-slate-400 mt-0.5">ট্যাম্পার-প্রুফ পাবলিক লেজার</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
