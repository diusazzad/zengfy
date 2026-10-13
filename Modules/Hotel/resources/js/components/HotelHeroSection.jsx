import React from 'react';

export default function HotelHeroSection({ brand = {}, stats = {} }) {
  return (
    <section className="relative pt-12 pb-16 md:pt-20 md:pb-24 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div className="text-center max-w-4xl mx-auto">
          {/* Sovereign Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-50/90 border border-amber-200/80 shadow-xs mb-6 animate-in fade-in slide-in-from-bottom-3 duration-500">
            <span className="text-base">🇧🇩</span>
            <span className="text-xs font-bold text-amber-900 tracking-wide">
              {brand.badge || 'Bangladesh Resort, Boutique Hotel & Eco-Cottage ERP'}
            </span>
          </div>

          {/* Emotive Headline */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15] mb-6">
            রিসোর্ট ও হোটেলের দৈনিক কিচেন বাজার থেকে{' '}
            <span className="bg-gradient-to-r from-amber-600 via-amber-700 to-slate-900 bg-clip-text text-transparent">
              জিরো-কমিশন ডিরেক্ট বুকিং।
            </span>
          </h1>

          {/* Value Proposition Description */}
          <p className="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto mb-8 leading-relaxed font-normal">
            {brand.description ||
              'Booking.com ও Agoda-কে ১৫-২০% কমিশন দেওয়া বন্ধ করুন। রিসোর্টের নিজস্ব ব্র্যান্ডেড ওয়েবসাইটে সরাসরি গেস্ট বুকিং, বাবুর্চির কাঁচাবাজারের স্বচ্ছ লেজার ও ১৮ জন স্টাফের রোস্টার পরিচালনা করুন এক ক্লিকে।'}
          </p>

          {/* Primary Action Buttons */}
          <div className="flex flex-wrap items-center justify-center gap-3.5 mb-14">
            <a
              href="#kitchen-simulator"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-black text-white bg-gradient-to-r from-amber-600 via-amber-700 to-slate-900 hover:opacity-95 shadow-xl shadow-amber-900/25 transition-all hover:scale-105 active:scale-95"
            >
              <span>🍳 কিচেন বাজার ও বুকিং সিমুলেটর টেস্ট</span>
              <span>→</span>
            </a>

            <a
              href="#pricing"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-slate-700 bg-white/90 hover:bg-white border border-slate-200/80 shadow-md hover:shadow-lg transition-all"
            >
              <span>💳 প্যাকেজ ও লাইসেন্স মডেল</span>
            </a>

            <a
              href="https://github.com/diusazzad/zengfy/releases"
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-2 px-4 py-3.5 rounded-2xl text-sm font-bold text-slate-600 hover:text-amber-800 bg-amber-50/70 hover:bg-amber-100/80 border border-amber-200/60 transition-all"
            >
              <span>📱 অ্যান্ড্রয়েড APK</span>
            </a>
          </div>

          {/* Telemetry Ribbon Strip (4 Verified Metric Cards) */}
          <div className="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 max-w-5xl mx-auto">
            <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-amber-100 shadow-sm hover:shadow-md transition-shadow text-left">
              <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                {stats.active_resorts || '৪২০+'}
              </div>
              <div className="text-xs font-bold text-amber-700 mt-1">সক্রিয় রিসোর্ট ও হোটেল</div>
              <div className="text-[11px] text-slate-400 mt-0.5">শ্রীমঙ্গল, সাজেক ও কক্সবাজার</div>
            </div>

            <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-amber-100 shadow-sm hover:shadow-md transition-shadow text-left">
              <div className="text-2xl sm:text-3xl font-black text-amber-700 tracking-tight">
                {stats.ota_commission_saved || '৳০ ওটিএ'}
              </div>
              <div className="text-xs font-bold text-amber-700 mt-1">জিরো কমিশন ডিরেক্ট বুকিং</div>
              <div className="text-[11px] text-slate-400 mt-0.5">১০০% টাকা ওনারের একাউন্টে</div>
            </div>

            <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-amber-100 shadow-sm hover:shadow-md transition-shadow text-left">
              <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                {stats.direct_guest_bookings || '১৮,০০০+'}
              </div>
              <div className="text-xs font-bold text-amber-700 mt-1">সরাসরি গেস্ট বুকিং</div>
              <div className="text-[11px] text-slate-400 mt-0.5">বিকাশ ও কার্ড পেমেন্টে সম্পন্ন</div>
            </div>

            <div className="p-4 sm:p-5 rounded-2xl bg-white/80 backdrop-blur-xl border border-amber-100 shadow-sm hover:shadow-md transition-shadow text-left">
              <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                {stats.positive_reviews_rate || '৯৯.৪%'}
              </div>
              <div className="text-xs font-bold text-amber-700 mt-1">পজিটিভ রিভিউ রেট</div>
              <div className="text-[11px] text-slate-400 mt-0.5">৬৪ জেলায় সন্তুষ্ট হোটেল স্বত্বাধিকারী</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
