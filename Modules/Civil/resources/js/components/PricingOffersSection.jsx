import React, { useState } from 'react';

export default function PricingOffersSection({ offers = [] }) {
  const [openFaq, setOpenFaq] = useState(null);

  const faqs = [
    {
      q: 'Zengfy Civil-এ কোনো এককালীন (One-Time) লাইসেন্স ফি আছে কি?',
      a: 'না, Zengfy Civil সম্পূর্ণ SaaS (Software as a Service) ক্লাউড সাবস্ক্রিপশন মডেলে পরিচালিত। ফলে কোনো ভারি সার্ভার ক্রয়, জটিল ইন্সটলেশন বা রক্ষণাবেক্ষণের বাড়তি খরচ নেই। আপনি যেকোনো ডিভাইসের ব্রাউজার থেকে সরাসরি লগইন করে সেবাটি ব্যবহার করতে পারবেন।',
    },
    {
      q: '৩ডি প্লট রেন্ডারিং করতে কি দামি গ্রাফিক্স কার্ড বা উচ্চগতির পিসির প্রয়োজন?',
      a: 'একদমই না! আমাদের ৩ডি রেন্ডারিং ইঞ্জিন ক্লাউড-অপ্টিমাইজড ওয়েবজিএল (WebGL) আর্কিটেকচারে চলে। তাই সাধারণ ল্যাপটপ, ট্যাবলেট বা যেকোনো স্মার্টফোনেই অনায়াসে ৬০ FPS মসৃণ ৩ডি মডেল ও ফ্লোরপ্ল্যান ক্লায়েন্টকে ঘুরিয়ে দেখানো সম্ভব।',
    },
    {
      q: 'লাইভ ম্যাটেরিয়াল রেট কীভাবে আপডেট হয়?',
      a: 'আমাদের সিস্টেমে প্রতিদিনের বাংলাদেশের পাইকারি ও খুচরা বাজারদর (রড, সিমেন্ট, অটো ব্রিক ও সিলেট বালু) নিয়মিত আপডেট থাকে। তাছাড়া ফার্ম চাইলে প্রজেক্টের জন্য তাদের নিজস্ব স্পেশাল রেটও সেভ করে রাখতে পারে।',
    },
    {
      q: 'রাজউক এবং সিটি কর্পোরেশনের বিল্ডিং নিয়মনীতি কি এতে মেনে চলা হয়?',
      a: 'হ্যাঁ, আমাদের অ্যালগরিদম বাংলাদেশ ন্যাশনাল বিল্ডিং কোড (BNBC) এবং রাজউক/সিডিএ/আরডিএ-এর ফার (Floor Area Ratio - FAR) ও সেটব্যাক রুলস অনুযায়ী স্বয়ংক্রিয় হিসাব প্রদান করে।',
    },
  ];

  return (
    <section id="pricing" className="py-20 relative bg-white/70 border-t border-slate-200/80 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-cyan-50 text-cyan-800 border border-cyan-200/60 mb-3">
            <span>💳 স্বচ্ছ ক্লাউড সাবস্ক্রিপশন</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            সিভিল ফার্ম ও স্টুডিওর জন্য ৩টি ক্লাউড প্যাকেজ
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            শতভাগ ক্লাউড সার্ভিস (SaaS)—কোনো জটিল সফটওয়্যার ইন্সটলেশন বা এককালীন লাইসেন্স ফি নেই। সরাসরি ব্রাউজারে ক্লায়েন্টকে ৩ডি শোকেস করুন।
          </p>
        </div>

        {/* 3 SaaS Tiers Pricing Cards */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
          {offers.map((tier) => (
            <div
              key={tier.id}
              className={`rounded-3xl p-8 flex flex-col justify-between transition-all relative ${
                tier.popular
                  ? 'bg-slate-900 text-white shadow-2xl shadow-cyan-950/20 border-2 border-cyan-500 scale-[1.03] z-10'
                  : 'bg-white/90 backdrop-blur-xl text-slate-900 border border-slate-200 shadow-md hover:shadow-xl'
              }`}
            >
              {/* Popular Badge */}
              {tier.popular && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-cyan-500 to-cyan-600 text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                  সবচেয়ে জনপ্রিয় চয়েস
                </div>
              )}

              <div>
                {/* Header */}
                <div className="mb-6">
                  <span className={`text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md ${
                    tier.popular ? 'bg-cyan-950 text-cyan-300 border border-cyan-800' : 'bg-cyan-50 text-cyan-800 border border-cyan-100'
                  }`}>
                    {tier.badge}
                  </span>
                  <h3 className="text-xl sm:text-2xl font-black mt-3">
                    {tier.name}
                  </h3>
                  <p className={`text-xs mt-2 leading-relaxed ${tier.popular ? 'text-slate-300' : 'text-slate-600'}`}>
                    {tier.summary}
                  </p>
                </div>

                {/* Pricing Block */}
                <div className="mb-6 pb-6 border-b border-slate-200/40">
                  <div className="flex items-baseline gap-1.5">
                    <span className="text-3xl sm:text-4xl font-black tracking-tight">
                      {tier.price}
                    </span>
                    <span className={`text-xs font-semibold ${tier.popular ? 'text-slate-300' : 'text-slate-500'}`}>
                      {tier.billing}
                    </span>
                  </div>
                </div>

                {/* Features List */}
                <ul className="space-y-3 mb-8 text-xs sm:text-sm">
                  {(tier.features || []).map((feat, idx) => (
                    <li key={idx} className="flex items-start gap-2.5">
                      <span className={`w-4 h-4 rounded-full flex items-center justify-center text-[10px] font-bold shrink-0 mt-0.5 ${
                        tier.popular ? 'bg-cyan-400 text-slate-950' : 'bg-cyan-100 text-cyan-800'
                      }`}>
                        ✓
                      </span>
                      <span className={tier.popular ? 'text-slate-200' : 'text-slate-700'}>
                        {feat}
                      </span>
                    </li>
                  ))}
                </ul>
              </div>

              {/* Action Button */}
              <div>
                <a
                  href="http://civil.zengfy.test:8000/login"
                  className={`w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm text-center block transition-all shadow-md ${
                    tier.popular
                      ? 'bg-cyan-500 hover:bg-cyan-400 text-slate-950 shadow-cyan-500/25'
                      : 'bg-slate-900 hover:bg-slate-800 text-white shadow-slate-900/10'
                  }`}
                >
                  {tier.cta}
                </a>
              </div>
            </div>
          ))}
        </div>

        {/* Engineering Hotline & Consultation Strip */}
        <div className="mt-14 max-w-4xl mx-auto p-6 rounded-3xl bg-cyan-50/80 border border-cyan-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
          <div className="space-y-1">
            <h4 className="text-sm font-bold text-slate-900">
              ফার্মের নিজস্ব কাস্টমাইজেশন বা মেগা প্রজেক্ট সাপোর্ট প্রয়োজন?
            </h4>
            <p className="text-xs text-slate-600">
              আমাদের স্ট্রাকচারাল ইঞ্জিনিয়ার ও সফটওয়্যার টিম আপনার ফার্মের সাথে মিটিং করতে প্রস্তুত।
            </p>
          </div>
          <div className="flex items-center gap-3">
            <a
              href="tel:+8801711000000"
              className="px-5 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-bold transition-all shadow-sm"
            >
              📞 কনসালটেশন কল
            </a>
            <a
              href="mailto:civil@zengfy.com"
              className="px-4 py-2.5 rounded-xl bg-white hover:bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200 transition-all"
            >
              ইমেইল করুন
            </a>
          </div>
        </div>

        {/* FAQ Accordion */}
        <div id="faq" className="mt-20 max-w-3xl mx-auto scroll-mt-20">
          <div className="text-center mb-8">
            <h3 className="text-xl sm:text-2xl font-black text-slate-900">
              সচরাচর জিজ্ঞাসিত প্রশ্নাবলী (FAQ)
            </h3>
            <p className="text-xs text-slate-500 mt-1">
              ক্লাউড সাবস্ক্রিপশন ও ৩ডি ইঞ্জিন সম্পর্কিত সাধারণ জিজ্ঞাসা
            </p>
          </div>

          <div className="space-y-3">
            {faqs.map((faq, idx) => (
              <div
                key={idx}
                className="bg-white/90 backdrop-blur-xl rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs transition-all"
              >
                <button
                  type="button"
                  onClick={() => setOpenFaq(openFaq === idx ? null : idx)}
                  className="w-full p-4 sm:p-5 text-left flex items-center justify-between gap-4 font-bold text-sm text-slate-800 hover:text-cyan-700"
                >
                  <span>{faq.q}</span>
                  <span className="text-cyan-600 text-lg">
                    {openFaq === idx ? '−' : '+'}
                  </span>
                </button>

                {openFaq === idx && (
                  <div className="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    {faq.a}
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
