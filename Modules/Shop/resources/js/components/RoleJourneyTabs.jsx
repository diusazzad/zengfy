import React, { useState } from 'react';

export default function RoleJourneyTabs({ journeys = [] }) {
  const [activeTab, setActiveTab] = useState(0);

  if (!journeys || journeys.length === 0) {
    return null;
  }

  const roleIcons = ['🛍️', '📦', '💳', '📱'];
  const current = journeys[activeTab] || journeys[0];

  return (
    <section id="journeys" className="py-16 scroll-mt-20 bg-slate-50/60 border-y border-slate-200/60">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-3xl mx-auto mb-10">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-100 text-orange-800 text-xs font-bold mb-3 border border-orange-200">
            <span>👥 স্টেকহোল্ডার পার্সপেক্টিভ জার্নি</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
            প্রতিটি টিমের জন্য নিখুঁত ডিটুসি কমার্স এক্সপেরিয়েন্স
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            মার্চেন্ট ফাউন্ডার থেকে শুরু করে কাস্টমার—প্রত্যেকের জন্য ডিজাইন করা বিশেষায়িত ইন্টারফেস ও ফিচারসেট।
          </p>
        </div>

        {/* Tab Buttons */}
        <div className="flex flex-wrap items-center justify-center gap-2 mb-8">
          {journeys.map((item, idx) => (
            <button
              key={idx}
              type="button"
              onClick={() => setActiveTab(idx)}
              className={`px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-bold transition-all flex items-center gap-2 cursor-pointer ${
                activeTab === idx
                  ? 'bg-gradient-to-r from-orange-600 to-violet-600 text-white shadow-lg shadow-orange-600/25 scale-102'
                  : 'bg-white/80 hover:bg-white text-slate-700 border border-slate-200/80 shadow-xs'
              }`}
            >
              <span>{roleIcons[idx] || '👤'}</span>
              <span>{item.role}</span>
            </button>
          ))}
        </div>

        {/* Tab Content Panel */}
        <div className="p-6 sm:p-10 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-xl max-w-4xl mx-auto">
          <div className="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
              <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 border border-orange-200 text-orange-800 text-xs font-bold mb-2">
                <span>{roleIcons[activeTab]}</span>
                <span>{current.title}</span>
              </div>
              <h3 className="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                {current.tagline}
              </h3>
            </div>
            <span className="text-3xl shrink-0 p-3 rounded-2xl bg-orange-50 border border-orange-100 hidden md:block">
              {roleIcons[activeTab]}
            </span>
          </div>

          {/* Testimonial Quote */}
          <blockquote className="my-6 p-4 sm:p-5 rounded-2xl bg-slate-50 border-l-4 border-orange-500 text-slate-700 text-sm sm:text-base italic leading-relaxed">
            "{current.quote}"
          </blockquote>

          {/* Metrics Ribbon */}
          {current.metrics && (
            <div className="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
              {Object.entries(current.metrics).map(([metricLabel, metricVal], mIdx) => (
                <div key={mIdx} className="p-3.5 rounded-2xl bg-white border border-slate-200/80 shadow-xs text-center">
                  <div className="text-lg sm:text-xl font-black text-orange-600 font-mono">
                    {metricVal}
                  </div>
                  <div className="text-[11px] font-bold text-slate-600 mt-0.5">{metricLabel}</div>
                </div>
              ))}
            </div>
          )}

          {/* Key Capabilities */}
          <div>
            <h4 className="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
              কোর সুবিধা ও অটোমেশন:
            </h4>
            <div className="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
              {(current.features || []).map((feat, fIdx) => (
                <div key={fIdx} className="flex items-start gap-2 p-2.5 rounded-xl bg-slate-50/70 border border-slate-100 text-xs font-semibold text-slate-700">
                  <span className="text-emerald-500 font-bold shrink-0">✓</span>
                  <span>{feat}</span>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
