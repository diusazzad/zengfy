import React from 'react';

export default function SkillHeroSection({ stats = {} }) {
  const brandStats = [
    {
      label: 'ভেরিফাইড মেন্টর ও ট্রেইনার',
      value: stats.active_trainers || '১,৮৫০+',
      desc: 'এনআইডি ও স্কিল ভেরিফায়েড',
      icon: '🏅',
      color: 'from-blue-500 to-indigo-500',
    },
    {
      label: 'সফল পোস্ট-এসএসসি শিক্ষার্থী',
      value: stats.successful_students || '৪২,০০০+',
      desc: 'সারা দেশে গ্র্যাজুয়েট',
      icon: '🎓',
      color: 'from-cyan-500 to-teal-500',
    },
    {
      label: 'কোর্স কমপ্লিশন একুরেসি',
      value: stats.completion_rate || '৯৮.৬%',
      desc: 'বাস্তব প্রজেক্ট সাবমিশন',
      icon: '📈',
      color: 'from-emerald-500 to-green-600',
    },
    {
      label: 'ট্যাম্পার-প্রুফ কিউআর সনদ',
      value: stats.verified_certificates || '১০০%',
      desc: 'লিঙ্কডইন ভেরিফায়েবল',
      icon: '📜',
      color: 'from-violet-500 to-purple-600',
    },
  ];

  return (
    <section className="relative pt-12 pb-16 overflow-hidden">
      {/* Background Decorative Gradient Light */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-gradient-to-tr from-blue-400/15 via-cyan-400/10 to-indigo-300/15 rounded-full blur-3xl pointer-events-none -z-10" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto">
          {/* Sovereign Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/90 border border-blue-200/80 shadow-xs mb-6 backdrop-blur-md">
            <span className="text-sm">🇧🇩</span>
            <span className="text-xs font-bold text-blue-700 uppercase tracking-wide">
              Bangladesh Verified Skill Hub & Post-SSC Career Launchpad
            </span>
            <span className="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping" />
          </div>

          {/* Emotive Headline */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.18] sm:leading-[1.15] mb-6">
            এসএসসি ও এইচএসসি পরবর্তী ৩ মাসে{' '}
            <span className="bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 bg-clip-text text-transparent underline decoration-cyan-300/40 decoration-wavy">
              সঠিক স্কিল
            </span>
            । ভেরিফাইড ট্রেইনারদের নিশ্চিত গাইডলাইন।
          </h1>

          {/* Value Subtitle */}
          <p className="text-base sm:text-lg lg:text-xl text-slate-600 font-medium max-w-3xl mx-auto mb-8 leading-relaxed">
            প্রতারক কোচিং নয়, জেনফাই-ভেরিফাইড টপ মেন্টরদের তত্ত্বাবধানে প্র্যাক্টিক্যাল কোডিং, গ্রাফিক্স, স্পোকেন ইংলিশ ও ফ্রিল্যান্সিং ক্যারিয়ার। অবসর সময়ের সেরা সদ্ব্যবহার।
          </p>

          {/* Action CTAs */}
          <div className="flex flex-wrap items-center justify-center gap-3 sm:gap-4 mb-14">
            <a
              href="#simulator"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-white bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-xl shadow-blue-600/30 hover:shadow-2xl hover:shadow-blue-600/40 transform hover:-translate-y-0.5 transition-all cursor-pointer"
            >
              <span>🎯 ক্যারিয়ার কুইজ দিন (Find My Track)</span>
              <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M19 9l-7 7-7-7" />
              </svg>
            </a>

            <a
              href="http://zengfy.test:8000/register?continue=http%3A%2F%2Fskill.zengfy.test%3A8000%2F"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-slate-700 hover:text-blue-700 bg-white/90 hover:bg-blue-50/60 border border-slate-200/90 hover:border-blue-200 shadow-sm transition-all"
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
                className="p-4 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/70 shadow-xs hover:shadow-md hover:border-blue-200/80 transition-all group"
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
