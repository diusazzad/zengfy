import React, { useState } from 'react';

export default function PricingOffersSection({ offers = [] }) {
  const [openFaq, setOpenFaq] = useState(null);

  const faqs = [
    {
      q: 'সংগৃহীত অনুদানের টাকা কি সরাসরি আমাদের ফাউন্ডেশনের ব্যাংক একাউন্টে জমা হবে?',
      a: 'হ্যাঁ, সম্পূর্ণ সরাসরি! বিকাশ, নগদ বা ব্যাংক একাউন্টের মার্চেন্ট ক্রেডেনশিয়াল আপনার ফাউন্ডেশনের নামে থাকবে। কোনো মধ্যস্বত্বভোগী ছাড়া অনুদানের টাকা সরাসরি আপনার ট্রাস্টের ব্যাংক একাউন্টে জমা হবে।',
    },
    {
      q: 'যাকাত ফান্ডের টাকা কি সাধারণ তহবিলের সাথে মিশে যাওয়ার কোনো সম্ভাবনা আছে?',
      a: 'একদমই না। Zengfy NGO-তে সাধারণ অনুদান ও যাকাতের জন্য সম্পূর্ণ আলাদা ডিজিটাল ভল্ট ও লেজার ব্যবহার করা হয়। যাকাত ফান্ড থেকে শুধুমাত্র শরীয়াহ অনুমোদিত ৮টি খাতের সুবিধাভোগীদের সরাসরি সহায়তা দেওয়া হয়।',
    },
    {
      q: 'বিদেশ থেকে প্রবাসী বাংলাদেশিরা কীভাবে অনুদান পাঠাতে পারবেন?',
      a: 'আন্তর্জাতিক ভিসা, মাস্টারকার্ড ও রেমিট্যান্স চ্যানেলের মাধ্যমে বিশ্বের যেকোনো প্রান্ত থেকে ডলার বা স্থানীয় মুদ্রায় সহজেই অনুদান দেওয়া যায়। দাতা তাৎক্ষণিক ডিজিটাল ট্যাক্স রেয়াতযোগ্য মানি রিসিট পেয়ে যান।',
    },
    {
      q: 'বন্যা বা দুর্যোগকবলিত প্রত্যন্ত চরাঞ্চলে ইন্টারনেটের সমস্যা হলে কীভাবে কাজ করবে?',
      a: 'আমাদের ফিল্ড ভলান্টিয়ার মোবাইল অ্যাপটি অফলাইন-ফার্স্ট প্রযুক্তিতে নির্মিত। দুর্গম এলাকায় ইন্টারনেট ছাড়াও কিউআর স্ক্যান করে ত্রাণ বিতরণ রেকর্ড করা যায় এবং নেটওয়ার্ক পাওয়া মাত্রই স্বয়ংক্রিয়ভাবে ক্লাউডে সিঙ্ক হয়ে যায়।',
    },
  ];

  return (
    <section id="pricing" className="py-20 relative bg-white/70 border-t border-slate-200/80 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-teal-50 text-teal-800 border border-teal-200/60 mb-3">
            <span>💳 স্বচ্ছ কমার্শিয়াল ও ওনারশিপ মডেল</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            চ্যারিটি ফাউন্ডেশন ও এনজিওর জন্য ৩টি প্যাকেজ
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            মাসিক ক্লাউড সাবস্ক্রিপশন অথবা ফাউন্ডেশনের নিজস্ব ডোমেইনে আজীবন সার্বভৌমিক ক্রাউডফান্ডিং লাইসেন্স।
          </p>
        </div>

        {/* 3 Tiers Pricing Cards */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
          {offers.map((tier) => (
            <div
              key={tier.id}
              className={`rounded-3xl p-8 flex flex-col justify-between transition-all relative ${
                tier.popular
                  ? 'bg-slate-900 text-white shadow-2xl shadow-teal-950/20 border-2 border-teal-500 scale-[1.03] z-10'
                  : 'bg-white/90 backdrop-blur-xl text-slate-900 border border-slate-200 shadow-md hover:shadow-xl'
              }`}
            >
              {/* Popular Badge */}
              {tier.popular && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                  সবচেয়ে জনপ্রিয় চয়েস
                </div>
              )}

              <div>
                {/* Header */}
                <div className="mb-6">
                  <span className={`text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md ${
                    tier.popular ? 'bg-teal-950 text-teal-300 border border-teal-800' : 'bg-teal-50 text-teal-800 border border-teal-100'
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
                        tier.popular ? 'bg-teal-400 text-slate-950' : 'bg-teal-100 text-teal-800'
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
                  href="http://ngo.zengfy.top:8000/login"
                  className={`w-full py-3.5 rounded-2xl font-bold text-xs sm:text-sm text-center block transition-all shadow-md ${
                    tier.popular
                      ? 'bg-teal-500 hover:bg-teal-400 text-slate-950 shadow-teal-500/25'
                      : 'bg-slate-900 hover:bg-slate-800 text-white shadow-slate-900/10'
                  }`}
                >
                  {tier.cta}
                </a>
              </div>
            </div>
          ))}
        </div>

        {/* Charity Consultation Strip */}
        <div className="mt-14 max-w-4xl mx-auto p-6 rounded-3xl bg-teal-50/80 border border-teal-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
          <div className="space-y-1">
            <h4 className="text-sm font-bold text-slate-900">
              ফাউন্ডেশনের নিজস্ব ডোমেইনে কাস্টম সেটআপ বা অনবোর্ডিং সাপোর্ট প্রয়োজন?
            </h4>
            <p className="text-xs text-slate-600">
              আমাদের টিম সরাসরি আপনার ট্রাস্টি বোর্ডের সাথে মিটিং ও ফ্রি ডেমো সেশনের জন্য প্রস্তুত।
            </p>
          </div>
          <div className="flex items-center gap-3">
            <a
              href="tel:+8801711000000"
              className="px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold transition-all shadow-sm"
            >
              📞 ট্রাস্ট কনসালটেশন কল
            </a>
            <a
              href="mailto:ngo@zengfy.com"
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
              ক্রাউডফান্ডিং, যাকাত ও পেমেন্ট সেটেলমেন্ট সম্পর্কিত তথ্য
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
                  className="w-full p-4 sm:p-5 text-left flex items-center justify-between gap-4 font-bold text-sm text-slate-800 hover:text-teal-700"
                >
                  <span>{faq.q}</span>
                  <span className="text-teal-600 text-lg">
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
