import React, { useState } from 'react';

export default function RoleJourneyTabs({ journeysData }) {
  const journeys = Array.isArray(journeysData) && journeysData.length > 0 ? journeysData : [];
  const [activeTabId, setActiveTabId] = useState(journeys[0]?.id || 'doctor');
  const current = journeys.find((j) => j.id === activeTabId) || journeys[0];

  if (!current) return null;

  return (
    <section id="journeys" className="py-20 bg-slate-950 text-slate-100 relative overflow-hidden">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold mb-4 tracking-wider">
            পেশাজীবী ভূমিকা ও স্টেকহোল্ডার জার্নি
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            কার জন্য কীভাবে সময় ও আয়ের বিপ্লব ঘটায় জেনফাই শিডিউল?
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            ডাক্তারের চেম্বার থেকে শুরু করে সুপ্রিম কোর্টের আইনজীবী ও গ্লোবাল ফ্রিল্যান্সার — সবার জন্য নিবেদিত সমাধান।
          </p>
        </div>

        {/* 4 Role Selector Tabs */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-3 mb-10">
          {journeys.map((item) => {
            const active = item.id === activeTabId;
            return (
              <button
                key={item.id}
                type="button"
                onClick={() => setActiveTabId(item.id)}
                className={`p-4 rounded-2xl text-left transition-all duration-200 border flex flex-col justify-between cursor-pointer ${
                  active
                    ? 'bg-slate-900 border-indigo-500 shadow-lg shadow-indigo-950/50 ring-1 ring-indigo-500/50'
                    : 'bg-slate-900/40 border-slate-800 hover:bg-slate-900/80 hover:border-slate-700'
                }`}
              >
                <div className="text-2xl mb-2">{item.icon}</div>
                <div>
                  <div className={`text-xs uppercase tracking-wider font-semibold mb-1 ${active ? 'text-indigo-400' : 'text-slate-400'}`}>
                    {item.badge}
                  </div>
                  <div className={`text-sm font-bold line-clamp-1 ${active ? 'text-white' : 'text-slate-300'}`}>
                    {item.role}
                  </div>
                </div>
              </button>
            );
          })}
        </div>

        {/* Active Journey Detail Card */}
        <div className="bg-slate-900/80 border border-slate-800 rounded-3xl p-6 sm:p-10 lg:p-12 backdrop-blur-xl shadow-2xl transition-all duration-300">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {/* Left: Headline, Description & Features */}
            <div className="lg:col-span-7 space-y-6">
              <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold">
                <span>{current.icon}</span>
                <span>{current.badge}</span>
              </div>

              <h3 className="text-xl sm:text-2xl lg:text-3xl font-extrabold text-white leading-snug">
                {current.headline}
              </h3>

              <p className="text-slate-300 text-base leading-relaxed">
                {current.description}
              </p>

              {/* Bullet Points */}
              {Array.isArray(current.points) && (
                <div className="pt-2">
                  <h4 className="text-xs uppercase tracking-wider text-slate-400 font-bold mb-3">
                    মূল ক্ষমতায়ন ও সুবিধাসমূহ:
                  </h4>
                  <ul className="space-y-3">
                    {current.points.map((pt, idx) => (
                      <li key={idx} className="flex items-start gap-3 text-sm text-slate-200">
                        <span className="flex-shrink-0 w-5 h-5 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xs font-bold mt-0.5">
                          ✓
                        </span>
                        <span>{pt}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              )}
            </div>

            {/* Right: Quote Card & CTA */}
            <div className="lg:col-span-5 space-y-6">
              {current.quote && (
                <div className="bg-slate-950/80 border border-slate-800/80 rounded-2xl p-6 relative">
                  <div className="text-indigo-500 text-3xl font-serif leading-none mb-2">“</div>
                  <p className="text-slate-300 text-sm sm:text-base italic leading-relaxed mb-4">
                    {current.quote.replace(/[“”]/g, '')}
                  </p>
                  <div className="text-xs text-indigo-400 font-semibold uppercase tracking-wider">
                    — {current.role} বাস্তব অভিজ্ঞতা
                  </div>
                </div>
              )}

              <div className="bg-gradient-to-br from-indigo-950/40 to-slate-900 border border-indigo-800/30 rounded-2xl p-6">
                <div className="text-sm font-bold text-white mb-2">
                  সিরিয়াল মিস ও সময়ের অপচয় বন্ধ করুন
                </div>
                <p className="text-xs text-slate-300 mb-4 leading-relaxed">
                  বিকাশ ডিপোজিট ও স্বয়ংক্রিয় গুগল ক্যালেন্ডার সিঙ্কে নিজের পেশাদার ব্র্যান্ডিং শুরু করুন।
                </p>
                <a
                  href="#simulator"
                  className="inline-flex items-center justify-center w-full py-3 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs sm:text-sm font-bold transition-all shadow-md shadow-indigo-900/30 cursor-pointer"
                >
                  বুকিং ডেমো দেখুন →
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
