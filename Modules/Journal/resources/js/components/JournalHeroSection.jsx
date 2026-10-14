import React from 'react';

export default function JournalHeroSection({ stats = {} }) {
  const brandStats = [
    {
      label: 'স্বাধীন কলামিস্ট ও অনুসন্ধানী লেখক',
      value: stats.active_columnists || '৮৫০+',
      desc: 'ভেরিফাইড জার্নালিস্ট',
      icon: '✍️',
      color: 'from-slate-900 to-rose-700',
    },
    {
      label: 'রিডার পে-ওয়াল ও সাবস্ক্রিপশন আয়',
      value: stats.paywall_revenue || '৳১.৮ কোটি+',
      desc: 'বিকাশ ও নগদ পে-আউট',
      icon: '💳',
      color: 'from-rose-600 to-pink-600',
    },
    {
      label: 'সচেতন ও সক্রিয় পাঠক নেটওয়ার্ক',
      value: stats.discerning_readers || '৩,৪০,০০০+',
      desc: 'স্বাধীন পাঠক কমিউনিটি',
      icon: '📖',
      color: 'from-amber-600 to-rose-600',
    },
    {
      label: 'সেন্সরশিপ-রেজিস্ট্যান্ট পাবলিশিং',
      value: stats.censorship_resistant || '১০০%',
      desc: 'জিরো-নলেজ সোর্স এনক্রিপশন',
      icon: '🛡️',
      color: 'from-slate-800 to-slate-950',
    },
  ];

  return (
    <section className="relative pt-12 pb-16 overflow-hidden">
      {/* Background Decorative Gradient Light */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-gradient-to-tr from-rose-700/15 via-rose-500/10 to-slate-900/15 rounded-full blur-3xl pointer-events-none -z-10" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto">
          {/* Sovereign Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/90 border border-rose-200/80 shadow-xs mb-6 backdrop-blur-md">
            <span className="text-sm">🇧🇩</span>
            <span className="text-xs font-bold text-rose-800 uppercase tracking-wide">
              Bangladesh Independent Journalism & Sovereign Op-Ed Platform
            </span>
            <span className="w-1.5 h-1.5 rounded-full bg-rose-600 animate-ping" />
          </div>

          {/* Emotive Headline */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.18] sm:leading-[1.15] mb-6 font-serif">
            সেন্সরশিপমুক্ত স্বাধীন মতপ্রকাশ।{' '}
            <span className="bg-gradient-to-r from-rose-700 via-rose-600 to-slate-900 bg-clip-text text-transparent underline decoration-rose-300/40 decoration-wavy">
              সত্য সাংবাদিকতার
            </span>{' '}
            সার্বভৌম কণ্ঠস্বর।
          </h1>

          {/* Value Subtitle */}
          <p className="text-base sm:text-lg lg:text-xl text-slate-600 font-medium max-w-3xl mx-auto mb-8 leading-relaxed">
            করপোরেট মিডিয়া বা রাজনৈতিক রক্তচক্ষুর ভয় ছাড়া নিজের স্বাধীন নিউজলেটার, অপ-এড ও পে-ওয়াল থেকে সরাসরি পাঠকদের সাবস্ক্রিপশনে আয় করুন। অনুসন্ধানী নথিপত্র প্রকাশ ও জিরো-নলেজ হুইসেলব্লোয়ার নিরাপত্তা।
          </p>

          {/* Action CTAs */}
          <div className="flex flex-wrap items-center justify-center gap-3 sm:gap-4 mb-14">
            <a
              href="#simulator"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-white bg-gradient-to-r from-slate-900 via-rose-700 to-rose-600 hover:from-slate-800 hover:to-rose-700 shadow-xl shadow-rose-900/30 hover:shadow-2xl hover:shadow-rose-900/40 transform hover:-translate-y-0.5 transition-all cursor-pointer"
            >
              <span>🔥 আনসেন্সরড অপ-এড পড়ুন (Explore Columns)</span>
              <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2.5" d="M19 9l-7 7-7-7" />
              </svg>
            </a>

            <a
              href="http://zengfy.top:8000/register?tier=journal_pro&continue=http%3A%2F%2Fjournal.zengfy.top%3A8000%2F"
              className="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-slate-700 hover:text-rose-700 bg-white/90 hover:bg-rose-50/60 border border-slate-200/90 hover:border-rose-200 shadow-sm transition-all"
            >
              <span>✍️ স্বাধীন কলামিস্ট রেজিস্ট্রেশন</span>
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
                className="p-4 rounded-2xl bg-white/80 backdrop-blur-xl border border-slate-200/70 shadow-xs hover:shadow-md hover:border-rose-200/80 transition-all group"
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
