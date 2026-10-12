import React, { useState } from 'react';

export default function RoleJourneyTabs({ journeys = [] }) {
  const [activeTab, setActiveTab] = useState(journeys[0]?.id || 'corporate');
  const currentJourney = journeys.find((j) => j.id === activeTab) || journeys[0] || {};

  return (
    <section id="journeys" className="py-20 relative bg-white/70 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-800 border border-indigo-200/60 mb-3">
            <span>👥 স্টেকহোল্ডার দৃষ্টিভঙ্গি</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            ৪টি স্বতন্ত্র ভূমিকায় দালালমুক্ত স্বস্তি
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            পরিবার, ব্যাচেলর শিক্ষার্থী, ফ্ল্যাট মালিক এবং বিল্ডিং কেয়ারটেকারদের জন্য সমন্বিত সমাধান।
          </p>
        </div>

        {/* 4 Tabs Selector */}
        <div className="flex flex-wrap justify-center gap-2 sm:gap-3 mb-10">
          {journeys.map((journey) => (
            <button
              key={journey.id}
              type="button"
              onClick={() => setActiveTab(journey.id)}
              className={`px-4 sm:px-6 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all flex items-center gap-2.5 border ${
                activeTab === journey.id
                  ? 'bg-indigo-700 text-white border-indigo-700 shadow-lg shadow-indigo-700/25 scale-[1.02]'
                  : 'bg-white/80 hover:bg-white text-slate-700 border-slate-200 hover:border-slate-300'
              }`}
            >
              <span className="text-base sm:text-lg">{journey.icon}</span>
              <span>{journey.role.split('(')[0].trim()}</span>
            </button>
          ))}
        </div>

        {/* Journey Card Display */}
        <div className="max-w-4xl mx-auto">
          <div className="bg-white/90 backdrop-blur-2xl rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-xl relative overflow-hidden">
            {/* Top Info */}
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
              <div className="flex items-center gap-4">
                <div className="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-3xl shadow-inner">
                  {currentJourney.icon}
                </div>
                <div>
                  <h3 className="text-xl sm:text-2xl font-black text-slate-900">
                    {currentJourney.role}
                  </h3>
                  <p className="text-xs sm:text-sm font-semibold text-indigo-700 mt-0.5">
                    {currentJourney.tagline}
                  </p>
                </div>
              </div>

              <div className="hidden sm:inline-flex px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                ভূমিকা ভেরিফায়েড
              </div>
            </div>

            {/* Testimonial Quote */}
            <blockquote className="my-6 p-4 rounded-2xl bg-slate-50 border-l-4 border-indigo-700 text-sm sm:text-base italic text-slate-700 leading-relaxed">
              "{currentJourney.quote}"
            </blockquote>

            {/* Features Checklist Grid */}
            <div className="mt-6">
              <h4 className="text-xs font-black uppercase tracking-wider text-slate-400 mb-4">
                প্রধান সুবিধা ও বিশেষ সমাধান
              </h4>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                {(currentJourney.features || []).map((feature, idx) => (
                  <div
                    key={idx}
                    className="flex items-start gap-2.5 p-3 rounded-xl bg-slate-50/70 border border-slate-100 text-xs sm:text-sm text-slate-800"
                  >
                    <span className="w-5 h-5 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-[10px] font-bold shrink-0 mt-0.5">
                      ✓
                    </span>
                    <span className="leading-snug">{feature}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* Bottom Action */}
            <div className="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
              <span className="text-xs text-slate-500">
                দালাল চক্রের অবসান ঘটিয়ে সরাসরি বাড়িওয়ালা বা ভাড়াটিয়ার সাথে যুক্ত হোন।
              </span>
              <a
                href="#simulator"
                className="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all flex items-center gap-1.5"
              >
                <span>এই মোডে টু-লেট খুঁজুন</span>
                <svg className="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
