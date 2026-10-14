import React, { useState } from 'react';

export default function PricingOffersSection({ pricingData, faqsData }) {
  const defaultPricing = [
    {
      id: 'tier_pro',
      name: 'জার্নালিস্ট প্রো কলাম',
      badge: 'সবচেয়ে জনপ্রিয়',
      price: '৳৮০০',
      cycle: '/ মাস',
      description: 'স্বাধীন লেখক ও কলামিস্টদের জন্য নিজস্ব সাবস্ক্রিপশনভিত্তিক জার্নালিজম হাব।',
      features: [
        'নিজস্ব কাস্টম ডোমেইন কানেকশন ও অটো SSL',
        'আনলিমিটেড কলাম, অপ-এড ও নিউজলেটার প্রকাশ',
        '১-ট্যাপ বিকাশ, নগদ ও রকেট সরাসরি পে-ওয়াল গেটওয়ে',
        'এনক্রিপ্টেড হুইসেলব্লোয়ার সিক্রেট ড্রপবক্স ভল্ট',
        'সর্বোচ্চ ৫,০০০ সক্রিয় নিউজলেটার সাবস্ক্রাইবার',
        'রিয়েল-টাইম রিডার অ্যানালিটিক্স ও অডিয়েন্স গ্রোথ টুলস'
      ],
      highlighted: true,
      cta: 'প্রো কলামিস্ট হিসেবে শুরু করুন',
      cta_link: 'http://zengfy.top:8000/register?tier=journal_pro'
    },
    {
      id: 'tier_lifetime',
      name: 'আজীবন জার্নালিস্ট লাইসেন্স',
      badge: 'সার্বভৌম ওনারশিপ',
      price: '৳৫,০০০',
      cycle: 'এককালীন ওনারশিপ',
      description: 'জিরো মাসিক চার্জ। লেখকের নিজস্ব সার্ভার ও ডোমেইনে সম্পূর্ণ সার্বভৌম স্বাধীনতা।',
      features: [
        'আজীবন নো-সাবস্ক্রিপশন ফুল প্ল্যাটফর্ম ওনারশিপ লাইসেন্স',
        'সম্পূর্ণ আনলিমিটেড পাঠক ও আজীবন নিউজলেটার ব্রডকাস্ট',
        'নিজস্ব সার্ভারে সেলফ-হোস্টিং ও ফুল সোর্স কোড অ্যাক্সেস',
        '১০০% আয় লেখকের সরাসরি ব্যাংকে (জিরো প্ল্যাটফর্ম ফি)',
        'প্রাইভেট হুইসেলব্লোয়ার ডেডিকেটেড ক্লায়েন্ট ভল্ট',
        'লাইফটাইম মেজর সফটওয়্যার আপডেট ও প্যাচ সাপোর্ট'
      ],
      highlighted: false,
      cta: 'আজীবন ওনারশিপ লাইসেন্স নিন',
      cta_link: 'http://zengfy.top:8000/register?tier=journal_lifetime'
    },
    {
      id: 'tier_syndicate',
      name: 'মিডিয়া হাউস ও সিন্ডিকেট স্যুট',
      badge: 'টিম ও কালেক্টিভ',
      price: 'Contact Sales',
      cycle: '(কাস্টম চুক্তি)',
      description: 'স্বাধীন সংবাদ সংস্থা ও অনুসন্ধানী কালেক্টিভ টিমের জন্য মাল্টি-লেখক এডিটোরিয়াল পোর্টাল।',
      features: [
        'মাল্টিপল লেখক ও এডিটর টিম ম্যানেজমেন্ট কনসোল',
        'যৌথ সাবস্ক্রিপশন ও অটোমেটেড রয়্যালটি স্প্লিট ইঞ্জিন',
        'উন্নত এনক্রিপ্টেড ডিজিটাল হুইসেলব্লোয়ার নিউজরুম ভল্ট',
        'ডেডিকেটেড ক্লাউড হোস্ট ও প্রায়োরিটি অন-ডিমান্ড সাপোর্ট',
        'আইনি পরামর্শ ও ডিজিটাল সিকিউরিটি সুরক্ষা অডিট'
      ],
      highlighted: false,
      cta: 'সিন্ডিকেট টিমের সাথে যোগাযোগ করুন',
      cta_link: 'http://zengfy.top:8000/register?tier=journal_enterprise'
    }
  ];

  const defaultFaqs = [
    {
      q: 'জেনফাই জার্নালে কি আসলেই কোনো সেন্সরশিপ নেই?',
      a: 'হ্যাঁ, জেনফাই জার্নাল সার্বভৌম নো-সেন্সরশিপ আর্কিটেকচারে তৈরি। এখানে কোনো সেন্ট্রাল কমিটি বা করপোরেট মিডিয়া মনিটরিং বোর্ড নেই যারা সরকারের নির্দেশে কোনো কলাম মুছে দেবে বা লাইন বদলে দেবে। লেখকের প্রকাশনা অধিকার সম্পূর্ণ সুরক্ষিত।'
    },
    {
      q: 'পাঠকরা কীভাবে সাবস্ক্রিপশন ফি পরিশোধ করবে?',
      a: 'বাংলাদেশি পাঠকদের জন্য সহজতম উপায়ে বিকাশ, নগদ ও রকেট গেটওয়ে যুক্ত রয়েছে। ১-ট্যাপে মাসিক বা বার্ষিক সাবস্ক্রিপশন ফি দিয়ে তৎক্ষণাৎ কলাম ও এক্সক্লুসিভ ডকুমেন্টস আনলক করা যায়। টাকা সরাসরি লেখকের ব্যক্তিগত অ্যাকাউন্টে জমা হয়।'
    },
    {
      q: 'হুইসেলব্লোয়ারদের পরিচয় ফাঁস হওয়ার কোনো ঝুঁকি আছে কি?',
      a: 'না। জেনফাই জার্নালের হুইসেলব্লোয়ার সিক্রেট ড্রপবক্স ক্লায়েন্ট-সাইড ২৫৬-বিট জিরো-নলেজ এনক্রিপশন ব্যবহার করে। তথ্য পাঠানোর সময় সার্ভারে কোনো আইপি অ্যাড্রেস বা ডিভাইসের ডিজিটাল ফিঙ্গারপ্রিন্ট সংরক্ষণ করা হয় না। ফলে সোর্স সম্পূর্ণ নিরাপদ থাকে।'
    },
    {
      q: 'আমি কি আমার নিজস্ব ডোমেইনে (যেমন myjournal.com) এটি চালাতে পারব?',
      a: 'অবশ্যই! আমাদের প্রো ও লাইফটাইম লাইসেন্সে নিজস্ব কাস্টম ডোমেইন ম্যাপিং ও ফ্রি এসএসএল (SSL) সার্টিফিকেশন সুবিধা রয়েছে। আপনি আপনার নিজস্ব ব্র্যান্ডেই পাঠকদের কাছে পরিচিত হবেন।'
    }
  ];

  const pricing = Array.isArray(pricingData) && pricingData.length > 0 ? pricingData : defaultPricing;
  const faqs = Array.isArray(faqsData) && faqsData.length > 0 ? faqsData : defaultFaqs;

  const [openFaqIndex, setOpenFaqIndex] = useState(0);

  const toggleFaq = (index) => {
    setOpenFaqIndex(openFaqIndex === index ? -1 : index);
  };

  return (
    <section id="pricing" className="py-20 bg-slate-950 text-slate-100 relative overflow-hidden">
      {/* Background Decor */}
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[40rem] h-[40rem] bg-rose-950/20 rounded-full blur-3xl pointer-events-none" />

      <div className="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-semibold mb-4 tracking-wider">
            স্বচ্ছ ও সার্বভৌম বাণিজ্যিক মডেল
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            আপনার সাংবাদিকতা, আপনার স্বাধীন উপার্জনের অধিকার
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            মাসিক ফি বা এককালীন ওনারশিপ — যে কোনো বিকল্প বেছে নিন এবং মধ্যস্বত্বভোগী ছাড়াই আপনার কলাম পরিচালনা করুন।
          </p>
        </div>

        {/* Pricing Cards Grid */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20 items-stretch">
          {pricing.map((tier) => (
            <div
              key={tier.id}
              className={`rounded-3xl p-8 flex flex-col justify-between transition-all duration-300 relative ${
                tier.highlighted
                  ? 'bg-slate-900 border-2 border-rose-500 shadow-2xl shadow-rose-950/40 scale-105 z-10'
                  : 'bg-slate-900/60 border border-slate-800 hover:border-slate-700'
              }`}
            >
              {tier.badge && (
                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2">
                  <span className={`px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase shadow-md ${
                    tier.highlighted
                      ? 'bg-rose-600 text-white shadow-rose-900/50'
                      : 'bg-slate-800 text-slate-300 border border-slate-700'
                  }`}>
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
                      <svg className="w-4 h-4 text-rose-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                  className={`w-full py-3.5 px-4 rounded-xl text-center text-xs sm:text-sm font-bold transition-all duration-200 block shadow-md ${
                    tier.highlighted
                      ? 'bg-rose-600 hover:bg-rose-500 text-white shadow-rose-900/30'
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
              স্বাধীন সাংবাদিকতা ও জেনফাই জার্নাল প্ল্যাটফর্ম সম্পর্কে আপনার প্রশ্নগুলোর উত্তর
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
                    className="w-full p-5 text-left flex items-center justify-between gap-4 font-semibold text-sm sm:text-base text-white hover:text-rose-400 transition-colors"
                  >
                    <span>{faq.q}</span>
                    <span className="text-rose-400 text-lg flex-shrink-0">
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
