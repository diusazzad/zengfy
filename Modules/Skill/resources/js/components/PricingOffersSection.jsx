import React, { useState } from 'react';

export default function PricingOffersSection({ pricing = [], faqs = [] }) {
  const [openFaq, setOpenFaq] = useState(null);

  const toggleFaq = (idx) => {
    setOpenFaq(openFaq === idx ? null : idx);
  };

  const defaultPricing = [
    {
      name: 'ভেরিফাইড ট্রেইনার ক্লাউড (Trainer Cloud SaaS)',
      tagline: 'ব্যক্তিগত আইটি ট্রেইনার ও মেন্টরদের নিজস্ব ব্যাচ পরিচালনার জন্য সেরা',
      price: '৳১,৫০০',
      period: 'মাস',
      popular: true,
      features: [
        'আনলিমিটেড স্টুডেন্ট ও ভিডিও হোস্টিং',
        'লাইভ গুগল মিট ও জুম সিঙ্ক',
        'অটো এনআইডি সার্টিফিকেট জেনারেটর',
        'বিকাশ ও নগদ পেমেন্ট গেটওয়ে',
        'Zengfy Verified Badge 🏅 মেন্টর প্রোফাইল',
        'স্টুডেন্ট প্রজেক্ট সাবমিশন ও গ্রেডিং সিস্টেম',
        '২৪/৭ ডেডিকেটেড প্রায়োরিটি সাপোর্ট',
      ],
      cta: '১৪ দিনের ফ্রি ট্রায়াল শুরু করুন',
      tier: 'saas',
    },
    {
      name: 'আইটি একাডেমি ওনারশিপ (Academy Lifetime Ownership)',
      tagline: 'আইটি ট্রেনিং ইনস্টিটিউটের নিজস্ব ডোমেইনে আজীবন আনলিমিটেড ব্যবহার, জিরো মাসিক চার্জ, সম্পূর্ণ ডাটা স্বাধীনতা',
      price: 'এককালীন ওনারশিপ লাইসেন্স',
      period: 'আজীবন লাইসেন্স',
      popular: false,
      features: [
        'নিজস্ব ডোমেইনে আজীবন আনলিমিটেড ব্যবহার',
        'জিরো মাসিক চার্জ — সম্পূর্ণ ডাটা স্বাধীনতা',
        'আনলিমিটেড ট্রেইনার একাউন্ট ও মাল্টিপল কোর্স',
        'কাস্টম একাডেমি ব্র্যান্ডিং ও এনআইডি সার্টিফিকেট',
        'সম্পূর্ণ স্টুডেন্ট ডাটাবেস আপনার ব্যক্তিগত সার্ভারে',
        '১ বছর প্রিমিয়াম অন-কল টেকনিক্যাল সাপোর্ট',
      ],
      cta: 'আজীবন একাডেমি ওনারশিপ নিন',
      tier: 'lifetime',
    },
    {
      name: 'এন্টারপ্রাইজ এডুকেটর স্যুট (Polytechnic & Govt IT Suite)',
      tagline: 'সরকারি পলিটেকনিক, বিশ্ববিদ্যালয় ও বড় কর্পোরেট ট্রেনিং সেন্টারের জন্য মাল্টি-ব্রাঞ্চ লার্নিং ম্যানেজমেন্ট ইআরপি',
      price: 'Contact Sales',
      period: 'কাস্টম কোটেশন',
      popular: false,
      features: [
        'সরকারি পলিটেকনিক ও মাল্টি-ব্রাঞ্চ লার্নিং ম্যানেজমেন্ট ইআরপি',
        'কাস্টম মোবাইল অ্যাপস (Android & iOS Flutter)',
        'সরকারি স্কিল স্ট্যান্ডার্ড ও কারিকুলাম ম্যাপিং',
        'ডেডিকেটেড ক্লাউড ক্লাস্টার ও ৯৯.৯৯% আপটাইম এসএলএ',
        'অন-সাইট ট্রেইনার ট্রেইনিং ও এক্সিকিউটিভ কনসালটেন্সি',
      ],
      cta: 'এন্টারপ্রাইজ অ্যাডভাইজরের সাথে কথা বলুন',
      tier: 'enterprise',
    },
  ];

  const items = pricing.length > 0 ? pricing : defaultPricing;

  return (
    <section id="pricing" className="py-20 scroll-mt-20 bg-slate-50/70 border-t border-slate-200/60">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-100 text-blue-800 text-xs font-bold mb-3 border border-blue-200">
            <span>💎 কমার্শিয়াল সাবস্ক্রিপশন ও একাডেমি অফার</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
            ট্রেইনার ও আইটি একাডেমির জন্য সম্পূর্ণ স্বাধীন সমাধান
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            ব্যক্তিগত মেন্টরশিপ শুরু করতে ক্লাউড সাবস্ক্রিপশন অথবা প্রতিষ্ঠানের জন্য আজীবন ওনারশিপ লাইসেন্স বেছে নিন।
          </p>
        </div>

        {/* Pricing Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch mb-20 max-w-6xl mx-auto">
          {items.map((tier, idx) => (
            <div
              key={idx}
              className={`rounded-3xl p-8 flex flex-col justify-between transition-all relative ${
                tier.popular
                  ? 'bg-white border-2 border-blue-600 shadow-2xl shadow-blue-500/15 ring-4 ring-blue-500/10 md:-translate-y-2'
                  : 'bg-white/80 backdrop-blur-xl border border-slate-200 shadow-lg hover:shadow-xl'
              }`}
            >
              {tier.popular && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                  MOST POPULAR • সেরা পছন্দ
                </div>
              )}

              <div>
                <h3 className="text-xl font-black text-slate-900 mb-1">{tier.name}</h3>
                <p className="text-xs text-slate-500 mb-6 min-h-[32px]">{tier.tagline}</p>

                <div className="flex items-baseline gap-1.5 pb-6 mb-6 border-b border-slate-100">
                  <span className="text-2xl sm:text-3xl font-black text-slate-900 font-mono tracking-tight">
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
                  href={`http://zengfy.test:8000/register?continue=http%3A%2F%2Fskill.zengfy.test%3A8000%2F&tier=${tier.tier}`}
                  className={`w-full py-3.5 px-4 rounded-2xl text-xs font-bold text-center transition-all block ${
                    tier.popular
                      ? 'bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white shadow-lg shadow-blue-600/30'
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
                পোস্ট-এসএসসি কোর্স, এনআইডি ভেরিফিকেশন ও একাডেমি লাইসেন্সিং সম্পর্কিত যাবতীয় তথ্যের উত্তর
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
