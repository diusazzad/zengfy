import React from 'react';

export default function SchedulePillarsSection({ pillarsData }) {
  const pillars = Array.isArray(pillarsData) && pillarsData.length > 0 ? pillarsData : [];

  return (
    <section id="pillars" className="py-20 bg-slate-900 text-slate-100 relative">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold mb-4 tracking-wider">
            সার্বভৌম ৪ মূলভিত্তি
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            যে ৪টি স্তম্ভে দাঁড়িয়ে জেনফাই শিডিউল
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            বিদেশি ডলার নির্ভরতা ও সিরিয়াল বিশৃঙ্খলা দূর করে দেশীয় পেশাজীবীদের জন্য সার্বভৌম ক্যালেন্ডার প্রযুক্তি।
          </p>
        </div>

        {/* 4 Pillars Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {pillars.map((pillar) => (
            <div
              key={pillar.id}
              className="bg-slate-950/70 border border-slate-800 rounded-3xl p-8 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-950/20 group flex flex-col justify-between"
            >
              <div>
                <div className="flex items-center justify-between mb-6">
                  <div className="w-14 h-14 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                    {pillar.icon}
                  </div>
                  <span className="text-[11px] font-mono tracking-wider text-indigo-400 bg-indigo-500/10 px-3 py-1 rounded-full border border-indigo-500/20">
                    {pillar.badge}
                  </span>
                </div>

                <h3 className="text-xl font-bold text-white mb-3 group-hover:text-indigo-300 transition-colors">
                  {pillar.title}
                </h3>

                <p className="text-slate-300 text-sm leading-relaxed mb-6">
                  {pillar.description}
                </p>

                {Array.isArray(pillar.key_features) && (
                  <ul className="space-y-2.5 pt-4 border-t border-slate-800/80">
                    {pillar.key_features.map((feat, idx) => (
                      <li key={idx} className="flex items-center gap-2.5 text-xs text-slate-300">
                        <span className="w-1.5 h-1.5 rounded-full bg-indigo-400" />
                        <span>{feat}</span>
                      </li>
                    ))}
                  </ul>
                )}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
