import React from 'react';

export default function ShopHeroSection({ stats = {} }) {
  const brandStats = [
    {
      label: 'অনলাইন ব্র্যান্ড ও মার্চেন্ট',
      value: stats.active_brands || '১,২০০+',
      desc: 'সারা দেশে সক্রিয় শপ',
      icon: '🛍️',
      color: 'from-orange-500 to-amber-500',
    },
    {
      label: 'আরটিও রিটার্ন ক্ষতি সেভ',
      value: stats.rto_losses_saved || '৳৪ কোটি+',
      desc: 'কুরিয়ার লস প্রতিরোধ',
      icon: '🛡️',
      color: 'from-emerald-500 to-teal-500',
    },
    {
      label: 'সফল ডেলিভারি একুরেসি',
      value: stats.delivery_success_rate || '৯৯.১%',
      desc: 'নিরাপদ কাস্টমার ট্রাস্ট',
      icon: '📦',
      color: 'from-violet-500 to-purple-600',
    },
    {
      label: 'ফেক অর্ডার ও প্রতারণা ব্লকড',
      value: stats.fake_orders_blocked || '৪৫,০০০+',
      desc: 'স্বয়ংক্রিয় এআই শিল্ড',
      icon: '⚡',
      color: 'from-rose-500 to-red-600',
    },
  ];

  return (
    <section className="relative pt-12 pb-16 overflow-hidden">
      {/* Background Decorative Gradient Light */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-gradient-to-tr from-orange-400/15 via-violet-400/10 to-amber-300/15 rounded-full blur-3xl pointer-events-none -z-10" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto">
          {/* Sovereign Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/90 border border-orange-200/80 shadow-xs mb-6 backdrop-blur-md">
            <span className="text-sm">🇧🇩</span>
            <span className="text-xs font-bold text-orange-700 uppercase tracking-wide">
              Zengfy Commerce | Anti-Fraud D2C & Social Commerce Platform
            </span>
            <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping" />
          </div>

          {/* Emotive Headline */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.18] sm:leading-[1.15] mb-6">
            ফেসবুক ও ডিটুসি ব্যবসার{' '}
            <span className="bg-gradient-to-r from-orange-600 via-orange-500 to-violet-600 bg-clip-text text-transparent underline decoration-orange-300/40 decoration-wavy">
              আরটিও রিটার্ন ক্ষতি
            </span>{' '}
            শূন্যে নামিয়ে আনুন।
          </h1>

          {/* Value Subtitle */}
          <p className="text-base sm:text-lg lg:text-xl text-slate-600 font-medium max-w-3xl mx-auto mb-8 leading-relaxed">
            কাস্টমারের পূর্বের ডেলিভারি ট্র্যাক রেকর্ড এআই দিয়ে নিমেষেই যাচাই করুন। ঝুঁকিপূর্ণ অর্ডারে স্বয়ংক্রিয়ভাবে ২০০ টাকা অগ্রিম ডেলিভারি ফি নিন এবং স্টিডফাস্ট, পাঠাও ও রেডএক্স কুরিয়ারের সাথে ১-ক্লিকে শিপমেন্ট সম্পন্ন করুন।
          </p>

          {/* Action CTAs */}
          <div className="flex flex-wrap items-center justify-center gap-3 sm:gap-4 mb-14">
            <a
              href="#simulator"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-white bg-gradient-to-r from-orange-600 via-orange-500 to-violet-600 hover:from-orange-700 hover:to-violet-700 shadow-xl shadow-orange-600/30 hover:shadow-2xl hover:shadow-orange-600/40 transform hover:-translate-y-0.5 transition-all cursor-pointer"
            >
              <span>🛡️ অ্যান্টি-ফ্রড স্কোর যাচাই করুন</span>
              <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M19 9l-7 7-7-7" />
              </svg>
            </a>

            <a
              href="http://accounts.zengfy.top:8000/register?continue=http%3A%2F%2Fshop.zengfy.top%3A8000%2F"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-slate-700 hover:text-orange-700 bg-white/90 hover:bg-orange-50/60 border border-slate-200/90 hover:border-orange-200 shadow-sm transition-all"
            >
              <span>🚀 ১৪ দিনের ফ্রি ট্রায়াল</span>
            </a>

            <a
              href="https://github.com/diusazzad/zengfy/releases"
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center gap-1.5 px-4 py-3.5 rounded-2xl text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors"
            >
              <span>📱 মোবাইল APK</span>
              <svg className="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
              </svg>
            </a>
          </div>

          {/* Telemetry Trust Strip */}
          <div className="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 text-left">
            {brandStats.map((card, idx) => (
              <div
                key={idx}
                className="p-4 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/70 shadow-xs hover:shadow-md hover:border-orange-200/80 transition-all group"
              >
                <div className="flex items-center justify-between mb-2">
                  <span className="text-xl group-hover:scale-110 transition-transform">{card.icon}</span>
                  <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-mono">
                    VERIFIED
                  </span>
                </div>
                <div className="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mb-0.5">
                  {card.value}
                </div>
                <div className="text-xs font-bold text-slate-700">{card.label}</div>
                <div className="text-[11px] text-slate-400 mt-0.5">{card.desc}</div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
