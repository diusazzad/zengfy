import React, { useState } from 'react';

export default function PricingOffersSection({ pricingData, faqsData }) {
  const pricing = Array.isArray(pricingData) && pricingData.length > 0 ? pricingData : [];
  const faqs = Array.isArray(faqsData) && faqsData.length > 0 ? faqsData : [];

  const [openFaqIndex, setOpenFaqIndex] = useState(0);

  const toggleFaq = (index) => {
    setOpenFaqIndex(openFaqIndex === index ? -1 : index);
  };

  return (
    <section id="pricing" className="py-20 bg-slate-950 text-slate-100 relative overflow-hidden">
      {/* Background Decor */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[40rem] h-[40rem] bg-indigo-950/20 rounded-full blur-3xl pointer-events-none" />

      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold mb-4 tracking-wider">
            সাশ্রয়ী ও সার্বভৌম বাণিজ্যিক মডেল
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            ডলারে অপচয় নয়, দেশীয় টাকায় পেশাদার ক্যালেন্ডার সমাধান
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            ক্যালেন্ডলির পেছনে প্রতি মাসে ১৬ ডলার অপচয় বন্ধ করুন। বিকাশ ডিপোজিটযুক্ত সার্বভৌম শিডিউলিং।
          </p>
        </div>

        {/* Pricing Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20 items-stretch">
          {pricing.map((tier) => (
            <div
              key={tier.id}
              className={`rounded-3xl p-8 flex flex-col justify-between transition-all duration-300 relative ${
                tier.highlighted
                  ? 'bg-slate-900 border-2 border-indigo-500 shadow-2xl shadow-indigo-950/40 scale-105 z-10'
                  : 'bg-slate-900/60 border border-slate-800 hover:border-slate-700'
              }`}
            >
              {tier.badge && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2">
                  <span
                    className={`px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase shadow-md ${
                      tier.highlighted
                        ? 'bg-indigo-600 text-white shadow-indigo-900/50'
                        : 'bg-slate-800 text-slate-300 border border-slate-700'
                    }`}
                  >
                    {tier.badge}
                  </span>
                </div>
              )}

              <div>
                <h3 className="text-xl font-bold text-white mb-2">{tier.name}</h3>
                <p className="text-xs text-slate-400 mb-6 leading-relaxed">{tier.description}</p>

                <div className="mb-6 pb-6 border-b border-slate-800">
                  <div className="flex items-baseline gap-1">
                    <span className="text-3xl sm:text-4xl font-black text-white">{tier.price}</span>
                    <span className="text-xs text-slate-400 font-medium">{tier.cycle}</span>
                  </div>
                </div>

                <ul className="space-y-3 mb-8">
                  {tier.features.map((feat, idx) => (
                    <li key={idx} className="flex items-start gap-2.5 text-xs text-slate-300">
                      <svg
                        className="w-4 h-4 text-indigo-400 flex-shrink-0 mt-0.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                      </svg>
                      <span>{feat}</span>
                    </li>
                  ))}
                </ul>
              </div>

              <div>
                <a
                  href={tier.cta_link || 'http://zengfy.top:8000/register'}
                  className={`w-full py-3.5 px-4 rounded-xl text-center text-xs sm:text-sm font-bold transition-all duration-200 block shadow-md cursor-pointer ${
                    tier.highlighted
                      ? 'bg-indigo-600 hover:bg-indigo-500 text-white shadow-indigo-900/30'
                      : 'bg-slate-800 hover:bg-slate-700 text-white border border-slate-700'
                  }`}
                >
                  {tier.cta}
                </a>
              </div>
            </div>
          ))}
        </div>

        {/* FAQ Section */}
        <div className="max-w-3xl mx-auto">
          <div className="text-center mb-10">
            <h3 className="text-xl sm:text-2xl font-bold text-white mb-2">
              সাধারণ জিজ্ঞাসা (FAQ)
            </h3>
            <p className="text-xs sm:text-sm text-slate-400">
              অ্যাপয়েন্টমেন্ট বুকিং ও জেনফাই শিডিউল প্ল্যাটফর্ম সম্পর্কে সচরাচর জিজ্ঞাসিত প্রশ্ন
            </p>
          </div>

          <div className="space-y-3">
            {faqs.map((faq, idx) => {
              const isOpen = openFaqIndex === idx;
              return (
                <div
                  key={idx}
                  className="bg-slate-900/70 border border-slate-800 rounded-2xl overflow-hidden transition-colors"
                >
                  <button
                    type="button"
                    onClick={() => toggleFaq(idx)}
                    className="w-full p-5 text-left flex items-center justify-between gap-4 font-semibold text-sm sm:text-base text-white hover:text-indigo-400 transition-colors cursor-pointer"
                  >
                    <span>{faq.q}</span>
                    <span className="text-indigo-400 text-lg flex-shrink-0 font-mono">
                      {isOpen ? '−' : '+'}
                    </span>
                  </button>

                  {isOpen && (
                    <div className="px-5 pb-5 text-xs sm:text-sm text-slate-300 leading-relaxed border-t border-slate-800/60 pt-3">
                      {faq.a}
                    </div>
                  )}
                </div>
              );
            })}
          </div>
        </div>
      </div>
    </section>
  );
}
