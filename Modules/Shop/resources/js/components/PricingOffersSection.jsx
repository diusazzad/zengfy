import React, { useState } from 'react';

export default function PricingOffersSection({ pricing = [], faqs = [] }) {
  const [openFaq, setOpenFaq] = useState(null);

  const toggleFaq = (idx) => {
    setOpenFaq(openFaq === idx ? null : idx);
  };

  return (
    <section id="pricing" className="py-20 scroll-mt-20 bg-slate-50/70 border-t border-slate-200/60">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-100 text-orange-800 text-xs font-bold mb-3 border border-orange-200">
            <span>💎 বাণিজ্যিক সাবস্ক্রিপশন ও ওনারশিপ অফার</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
            কোনো অর্ডার কমিশন নেই, সম্পূর্ণ স্বাধীন ব্যবসায়িক মডেল
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            আপনার অনলাইন বিজনেসের প্রয়োজন অনুযায়ী ক্লাউড সার্ভিস অথবা আজীবন ওনারশিপ লাইসেন্স নির্বাচন করুন।
          </p>
        </div>

        {/* Pricing Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch mb-20 max-w-6xl mx-auto">
          {pricing.map((tier, idx) => (
            <div
              key={idx}
              className={`rounded-3xl p-8 flex flex-col justify-between transition-all relative ${
                tier.popular
                  ? 'bg-white border-2 border-orange-500 shadow-2xl shadow-orange-500/15 ring-4 ring-orange-500/10 md:-translate-y-2'
                  : 'bg-white/80 backdrop-blur-xl border border-slate-200 shadow-lg hover:shadow-xl'
              }`}
            >
              {tier.popular && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-orange-600 to-violet-600 text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                  MOST POPULAR • সেরা পছন্দ
                </div>
              )}

              <div>
                <h3 className="text-xl font-black text-slate-900 mb-1">{tier.name}</h3>
                <p className="text-xs text-slate-500 mb-6 min-h-[32px]">{tier.tagline}</p>

                <div className="flex items-baseline gap-1.5 pb-6 mb-6 border-b border-slate-100">
                  <span className="text-3xl sm:text-4xl font-black text-slate-900 font-mono tracking-tight">
                    {tier.price}
                  </span>
                  <span className="text-xs font-bold text-slate-400">/{tier.period}</span>
                </div>

                <div className="space-y-3 mb-8">
                  <span className="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-2">
                    প্যাকেজের অন্তর্ভুক্ত সুবিধা:
                  </span>
                  {tier.features.map((feature, fIdx) => (
                    <div key={fIdx} className="flex items-start gap-2.5 text-xs text-slate-700">
                      <span className="text-emerald-500 font-bold shrink-0 mt-0.5">✓</span>
                      <span className="leading-relaxed">{feature}</span>
                    </div>
                  ))}
                </div>
              </div>

              <div>
                <a
                  href={`http://accounts.zengfy.top:8000/register?continue=http%3A%2F%2Fshop.zengfy.top%3A8000%2F&tier=${tier.tier}`}
                  className={`w-full py-3.5 px-4 rounded-2xl text-xs font-bold text-center transition-all block ${
                    tier.popular
                      ? 'bg-gradient-to-r from-orange-600 to-violet-600 hover:from-orange-700 hover:to-violet-700 text-white shadow-lg shadow-orange-600/30'
                      : 'bg-slate-900 hover:bg-slate-800 text-white'
                  }`}
                >
                  {tier.cta}
                </a>
              </div>
            </div>
          ))}
        </div>

        {/* FAQ Accordion Section */}
        {faqs && faqs.length > 0 && (
          <div className="max-w-3xl mx-auto pt-8">
            <div className="text-center mb-8">
              <h3 className="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                সাধারণ জিজ্ঞাসা (Frequently Asked Questions)
              </h3>
              <p className="text-xs sm:text-sm text-slate-500 mt-1">
                ডিটুসি কমার্স, কুরিয়ার এপিআই এবং অ্যান্টি-ফ্রড সিস্টেম সম্পর্কিত যাবতীয় প্রশ্নের উত্তর
              </p>
            </div>

            <div className="space-y-3">
              {faqs.map((faq, idx) => {
                const isOpen = openFaq === idx;
                return (
                  <div
                    key={idx}
                    className="rounded-2xl bg-white border border-slate-200/90 shadow-xs overflow-hidden transition-all"
                  >
                    <button
                      type="button"
                      onClick={() => toggleFaq(idx)}
                      className="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 cursor-pointer hover:bg-slate-50/70 transition-colors"
                    >
                      <span className="text-xs sm:text-sm font-bold text-slate-900">
                        {faq.q}
                      </span>
                      <span className={`text-slate-400 text-lg transition-transform ${isOpen ? 'rotate-180' : ''}`}>
                        ▼
                      </span>
                    </button>

                    {isOpen && (
                      <div className="px-4 pb-5 sm:px-5 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        {faq.a}
                      </div>
                    )}
                  </div>
                );
              })}
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
