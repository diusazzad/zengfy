import React, { useState } from 'react';

export default function PricingOffersSection({ offers = [], faq = [] }) {
  const [openFaq, setOpenFaq] = useState(null);

  const defaultFaqs = [
    {
      q: 'পে-পার-কিমি (Pay-Per-Km) কীভাবে কাজ করে?',
      a: 'খুবই সহজ! আপনি আমাদের ম্যাপে আপনার কাঙ্ক্ষিত এলাকা (যেমন মিরপুর ১০ বা ধানমন্ডি ২৭) নির্বাচন করবেন। এরপর ১ কিলোমিটার রেডিয়াসে যত বাসা খালি আছে, তার সবগুলো বাড়িওয়ালার আসল ফোন নম্বর ও সঠিক ঠিকানা মাত্র ৫০ টাকায় ১ ক্লিকে বিকাশ বা নগদের মাধ্যমে আনলক হয়ে যাবে।',
    },
    {
      q: 'আমি কি কোনো ব্রোকার বা দালালের সাথে কথা বলব?',
      a: 'একদমই না! Zengfy Rent প্ল্যাটফর্মে কোনো ব্রোকার বা দালাল অনুমোদিত নয়। আনলক করার পর আপনি সরাসরি ফ্ল্যাট মালিক বা বাড়িওয়ালার নিজস্ব নম্বরে কথা বলবেন। ফলে ১ মাসের ভাড়ার অতিরিক্ত দালালি কমিশন সম্পূর্ণ বাঁচবে।',
    },
    {
      q: 'বাড়িওয়ালাদের লিস্টিং ফি কি প্রতি মাসে দিতে হবে?',
      a: 'না! বাড়িওয়ালাদের জন্য ফ্ল্যাট লিস্টিং ফি মাত্র ২৫০ টাকা, এবং এটি এককালীন। অর্থাৎ আপনার ফ্ল্যাটটি ভাড়া না হওয়া পর্যন্ত বিজ্ঞাপনটি লাইভ থাকবে, কোনো মাসিক রিনিউয়াল ফি নেই।',
    },
    {
      q: 'ব্যাচেলর ও শিক্ষার্থীদের জন্য কি আলাদা ফিল্টার আছে?',
      a: 'হ্যাঁ, আমাদের প্ল্যাটফর্মে ফ্যামিলি ফ্ল্যাট, ব্যাচেলর সাবলেট ও মেস সিটের জন্য সুনির্দিষ্ট ফিল্টার রয়েছে। যেসকল বাড়িওয়ালা ব্যাচেলরদের সানন্দে ফ্ল্যাট দেন, সেগুলো ম্যাপে স্পষ্টভাবে চিহ্নিত থাকে।',
    },
  ];

  return (
    <section id="pricing" className="py-20 relative bg-white/70 border-t border-slate-200/80 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200/60 mb-3">
            <span>💳 ৩টি স্বচ্ছ বাণিজ্যিক ও ওনারশিপ মডেল</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            রিসোর্ট ও হোটেলের জন্য ৩-টিয়ার কমার্শিয়াল মডেল
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            ওটিএ-র ১৫-২০% কমিশনের দিন শেষ। ক্লাউড সাবস্ক্রিপশন অথবা আজীবন নিজস্ব লাইসেন্স মালিকানা।র দিন শেষ। মাত্র ৫০ টাকায় ১ কিমির সকল টু-লেট আনলক, অথবা ২৫০ টাকায় ফ্ল্যাট ভাড়া না হওয়া পর্যন্ত লাইভ বিজ্ঞাপন।
          </p>
        </div>

        {/* 3 Tiers Pricing Cards */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
          {offers.map((tier) => (
            <div
              key={tier.id}
              className={`rounded-3xl p-8 flex flex-col justify-between transition-all relative ${
                tier.popular
                  ? 'bg-slate-900 text-white shadow-2xl shadow-amber-950/20 border-2 border-amber-500 scale-[1.03] z-10'
                  : 'bg-white/90 backdrop-blur-xl text-slate-900 border border-slate-200 shadow-md hover:shadow-xl'
              }`}
            >
              {/* Popular Badge */}
              {tier.popular && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-amber-600 to-emerald-500 text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                  সবচেয়ে জনপ্রিয় চয়েস
                </div>
              )}

              <div>
                {/* Header */}
                <div className="mb-6">
                  <span className={`text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md ${
                    tier.popular ? 'bg-amber-950 text-amber-300 border border-amber-800' : 'bg-amber-50 text-amber-800 border border-amber-100'
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
                        tier.popular ? 'bg-emerald-400 text-slate-950' : 'bg-emerald-100 text-emerald-800'
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
                  href="#kitchen-simulator"
                  className={`w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm text-center block transition-all shadow-md ${
                    tier.popular
                      ? 'bg-amber-600 hover:bg-amber-500 text-white shadow-amber-600/25'
                      : 'bg-slate-900 hover:bg-slate-800 text-white shadow-slate-900/10'
                  }`}
                >
                  {tier.cta}
                </a>
              </div>
            </div>
          ))}
        </div>

        {/* Landlord Help & Consultation Strip */}
        <div className="mt-14 max-w-4xl mx-auto p-6 rounded-3xl bg-amber-50/80 border border-amber-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
          <div className="space-y-1">
            <h4 className="text-sm font-bold text-slate-900">
              আপনি কি মাঝারি রিসোর্ট, বুটিক হোটেল বা ইকো-কটেজের স্বত্বাধিকারী?
            </h4>
            <p className="text-xs text-slate-600">
              জেনফাই হোটেল ক্লাউডে যুক্ত হয়ে জিরো-কমিশন ডিরেক্ট বুকিং ও কিচেন বাজার অটোমেশন সুবিধা গ্রহণ করুন।
            </p>
          </div>
          <div className="flex items-center gap-3">
            <a
              href="tel:+8801711000000"
              className="px-5 py-2.5 rounded-xl bg-amber-700 hover:bg-amber-800 text-white text-xs font-bold transition-all shadow-sm"
            >
              📞 রিসোর্ট সাপোর্ট হেল্পলাইন
            </a>
            <a
              href="mailto:hotel@zengfy.com"
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
              পে-পার-কিমি টু-লেট আনলকার ও লিস্টিং সম্পর্কিত তথ্য
            </p>
          </div>

          <div className="space-y-3">
            {(faq && faq.length > 0 ? faq : defaultFaqs).map((faqItem, idx) => (
              <div
                key={idx}
                className="bg-white/90 backdrop-blur-xl rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs transition-all"
              >
                <button
                  type="button"
                  onClick={() => setOpenFaq(openFaq === idx ? null : idx)}
                  className="w-full p-4 sm:p-5 text-left flex items-center justify-between gap-4 font-bold text-sm text-slate-800 hover:text-amber-700"
                >
                  <span>{faqItem.q}</span>
                  <span className="text-amber-700 text-lg">
                    {openFaq === idx ? '−' : '+'}
                  </span>
                </button>

                {openFaq === idx && (
                  <div className="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    {faqItem.a}
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
