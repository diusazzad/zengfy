import React from 'react';

export default function HotelPillarsSection({ pillars = [] }) {
  return (
    <section id="pillars" className="py-20 relative bg-white/50 border-t border-slate-200/80 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200/60 mb-3">
            <span>🏛️ প্রযুক্তিগত ভিত্তি</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            ৪টি সার্বভৌম রিয়েল এস্টেট স্তম্ভ
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            বাংলাদেশে প্রথমবারের মতো ব্রোকার-মুক্ত হাইপারলোকাল জিপিএস মেশ এবং পে-পার-কিমি মাইক্রো-পেমেন্ট আর্কিটেকচার।
          </p>
        </div>

        {/* 4 Pillars Bento Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
          {pillars.map((pillar, idx) => (
            <div
              key={pillar.id || idx}
              className="bg-white/90 backdrop-blur-xl rounded-3xl p-8 border border-slate-200/80 shadow-md hover:shadow-xl hover:border-amber-300 transition-all flex flex-col justify-between group"
            >
              <div>
                <div className="flex items-center justify-between mb-4">
                  <span className="text-3xl p-3 rounded-2xl bg-amber-50 text-amber-700 border border-amber-100 group-hover:scale-110 transition-transform">
                    {idx === 0 && '🗺️'}
                    {idx === 1 && '📍'}
                    {idx === 2 && '💳'}
                    {idx === 3 && '📜'}
                  </span>
                  <span className="text-xs font-mono font-bold text-amber-800 bg-amber-50 px-3 py-1 rounded-full border border-amber-200/60">
                    {pillar.metric}
                  </span>
                </div>

                <h3 className="text-xl font-bold text-slate-900 tracking-tight mb-1">
                  {pillar.title}
                </h3>
                <div className="text-xs font-semibold text-amber-600 mb-3">
                  {pillar.subtitle}
                </div>
                <p className="text-sm text-slate-600 leading-relaxed">
                  {pillar.desc}
                </p>
              </div>

              <div className="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span className="flex items-center gap-1.5 font-medium">
                  <span className="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                  উৎপাদন লাইভ ও ভেরিফায়েড
                </span>
                <span className="text-amber-700 font-bold group-hover:translate-x-1 transition-transform flex items-center gap-1">
                  <span>বিস্তারিত</span>
                  <span>→</span>
                </span>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
