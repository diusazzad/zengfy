import React from 'react';

export default function CivilHeroSection({ brand = {}, stats = {} }) {
  return (
    <section className="relative pt-12 pb-20 sm:pt-16 sm:pb-24 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-4xl mx-auto space-y-6">
          {/* Top Pill / Badge */}
          <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold bg-cyan-50 text-cyan-900 border border-cyan-200/80 shadow-xs">
            <span className="w-2 h-2 rounded-full bg-cyan-600 animate-pulse"></span>
            <span>{brand.badge || '🇧🇩 Bangladesh Sovereign 3D Architecture & Costing ERP'}</span>
          </div>

          {/* Emotive Main Headline */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-[1.15]">
            যেকোনো জমির <span className="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-slate-800">৩ডি প্লট ও এলিভেশন</span>, সাথে লাইভ বাজারদরে নির্ভুল কস্টিং।
          </h1>

          {/* Bengali Subtitle */}
          <p className="text-base sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
            {brand.tagline_bn || 'সিভিল আর্কিটেক্ট ও কন্সট্রাকশন ফার্মের জন্য ৩ডি প্লট ভিজ্যুয়ালাইজার ও ম্যাটেরিয়াল কস্টিং ইআরপি।'} 
            <span className="block mt-1 font-medium text-slate-500">
              ক্লায়েন্টকে সাধারণ ২ডি ব্লুপ্রিন্ট নয়—ব্রাউজারেই দেখান প্রাণবন্ত ৩ডি ফ্লোরপ্ল্যান এবং দিন রড, সিমেন্ট, ইট ও বালুর শতভাগ নিখুঁত খরচ শিট।
            </span>
          </p>

          {/* CTA Buttons */}
          <div className="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
              href="#simulator"
              className="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-sm shadow-xl shadow-cyan-600/25 hover:shadow-cyan-600/35 transition-all flex items-center justify-center gap-2 group"
            >
              <span>৩ডি প্লট ও কস্টিং সিমুলেটর দেখুন</span>
              <svg className="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </a>

            <a
              href="#pricing"
              className="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-white/90 hover:bg-white text-slate-800 font-bold text-sm border border-slate-200/90 shadow-sm hover:border-slate-300 transition-all flex items-center justify-center gap-2"
            >
              <span>ফার্ম ক্লাউড সাবস্ক্রিপশন (SaaS)</span>
              <svg className="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </div>

          {/* Strict SaaS Cloud Stamp */}
          <div className="pt-2 text-xs font-semibold text-slate-500 flex items-center justify-center gap-4">
            <span className="flex items-center gap-1.5 text-cyan-800 bg-cyan-50/80 px-3 py-1 rounded-lg border border-cyan-100">
              <svg className="w-4 h-4 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
              </svg>
              ১০০% ক্লাউড সার্ভিস (কোনো ভারী হার্ডওয়্যার বা সার্ভার ক্রয়ের ঝামেলা নেই)
            </span>
          </div>
        </div>

        {/* Engineering Trust Ribbon */}
        <div className="mt-14 max-w-5xl mx-auto">
          <div className="rounded-3xl bg-white/80 backdrop-blur-xl border border-cyan-100/80 shadow-lg shadow-cyan-950/5 p-6 sm:p-8">
            <div className="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 text-center divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
              <div className="pt-4 lg:pt-0">
                <div className="text-2xl sm:text-3xl font-black text-cyan-700 tracking-tight">
                  {stats.active_engineering_firms || '620+'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">সক্রিয় সিভিল ও আর্কিটেক্ট ফার্ম</div>
                <div className="text-[11px] text-slate-400 mt-0.5">ঢাকা, চট্টগ্রাম ও বিভাগীয় শহর</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                  {stats.rendered_3d_plots || '18,500+'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">রেন্ডারকৃত ৩ডি প্লট ও ড্রয়িং</div>
                <div className="text-[11px] text-slate-400 mt-0.5">৬০ FPS মসৃণ ওয়েবজিএল ইঞ্জিন</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-cyan-700 tracking-tight">
                  {stats.materials_estimated_bdt || '৳450 Cr+'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">ম্যাটেরিয়াল প্রাক্কলিত বাজেট</div>
                <div className="text-[11px] text-slate-400 mt-0.5">রড, সিমেন্ট, ইট ও বালুর হিসাব</div>
              </div>

              <div className="pt-4 lg:pt-0 lg:pl-6">
                <div className="text-2xl sm:text-3xl font-black text-emerald-600 tracking-tight">
                  {stats.costing_accuracy || '99.8%'}
                </div>
                <div className="text-xs font-bold text-slate-700 mt-1">কস্টিং ও রাজউক নির্ভুলতা</div>
                <div className="text-[11px] text-slate-400 mt-0.5">BNBC বিল্ডিং কোড কমপ্লায়েন্ট</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
