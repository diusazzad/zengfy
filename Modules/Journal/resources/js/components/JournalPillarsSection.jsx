import React from 'react';

export default function JournalPillarsSection({ pillarsData }) {
  const defaultPillars = [
    {
      id: 'censorship_resistant',
      icon: '🛡️',
      badge: 'Censorship-Resistant Publishing',
      title: '১০০% সেন্সরশিপ-মুক্ত সার্বভৌম ব্লগিং',
      description: 'কারো হুকুমে লেখা মুছে দেওয়া বা চাপ প্রয়োগে কোনো লাইন পরিবর্তন করার সুযোগ নেই। আপনার লেখা আপনারই নিয়ন্ত্রণে অপরিবর্তনীয় থাকবে।',
      key_features: [
        'অপরিবর্তনীয় ক্রিপ্টোগ্রাফিক টাইমস্ট্যাম্প ও ভার্সনিং',
        'কোনো রাজনৈতিক বা করপোরেট সেন্ট্রাল সেন্সরশিপ বোর্ড নেই',
        'লেখক ছাড়া দ্বিতীয় কোনো ব্যক্তির কনটেন্ট মোছার ক্ষমতা নেই'
      ]
    },
    {
      id: 'reader_paywall',
      icon: '💳',
      badge: 'Direct Reader Micro-Subscription',
      title: 'ডিরেক্ট রিডার বিকাশ/নগদ পে-ওয়াল',
      description: 'বিজ্ঞাপনদাতার রক্তচক্ষু ও স্পনসরদের তোষামোদের দিন শেষ। বিশ্বস্ত পাঠকদের সাবস্ক্রিপশন আয়ে গড়ে তুলুন আপনার স্বাধীন সাংবাদিকতা।',
      key_features: [
        'বিকাশ, নগদ ও রকেটে ১-ট্যাপ তাৎক্ষণিক মাইক্রো-পেমেন্ট',
        'স্বয়ংক্রিয় রিকারিং সাবস্ক্রিপশন ও এককালীন অপ-এড আনলক',
        '১০০% আয় সরাসরি কলামিস্টের অ্যাকাউন্টে, কোনো কাটছাঁট নেই'
      ]
    },
    {
      id: 'whistleblower_vault',
      icon: '🔐',
      badge: 'Zero-Knowledge Source Protection',
      title: 'জিরো-নলেজ হুইসেলব্লোয়ার ভল্ট',
      description: 'ক্লায়েন্ট-সাইড ২৫৬-বিট এনক্রিপশন ও নো-লগ আর্কিটেকচার। অনুসন্ধানী সোর্সের ব্যক্তিগত পরিচয় ও ডিজিটাল ফুটপ্রিন্ট শতভাগ নিরাপদ।',
      key_features: [
        'ক্লায়েন্ট-সাইড AES-256 জিরো-নলেজ এনক্রিপশন',
        'স্বয়ংক্রিয় মেটাডাটা স্ট্রিপিং (ছবি/ফাইলের এক্সিফ ও জিপিএস অপসারণ)',
        'সার্ভারে কোনো আইপি বা ডিজিটাল ফিঙ্গারপ্রিন্ট সংরক্ষণ নেই'
      ]
    },
    {
      id: 'custom_domain',
      icon: '🌐',
      badge: 'Custom Domain Substack Sovereign Engine',
      title: 'নিজস্ব ডোমেইনে সার্বভৌম এডিটোরিয়াল',
      description: 'আপনার নিজস্ব ব্র্যান্ড, নিজস্ব ডোমেইন ও নিজস্ব সাবস্ক্রাইবার তালিকা। কোনো থার্ড পার্টি প্ল্যাটফর্মের ওপর অডিয়েন্স নির্ভরতা নেই।',
      key_features: [
        'নিজস্ব কাস্টম ডোমেইন ম্যাপিং ও অটো-রিনিউ ফ্রি SSL',
        'সাবস্ক্রাইবার ইমেইল লিস্টের শতভাগ মালিকানা ও সম্পূর্ণ ডেটা এক্সপোর্ট',
        'প্রফেশনাল নিউজলেটার ব্রডকাস্টিং ও হাই-ইনবক্স ডেলিভারিবিলিটি'
      ]
    }
  ];

  const pillars = Array.isArray(pillarsData) && pillarsData.length > 0 ? pillarsData : defaultPillars;

  return (
    <section id="pillars" className="py-20 bg-slate-900 text-slate-100 relative">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-16">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-semibold mb-4 tracking-wider">
            সার্বভৌম সাংবাদিকতার ৪ মূলভিত্তি
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            যে ৪টি স্তম্ভে দাঁড়িয়ে সেন্সরশিপমুক্ত সত্য সাংবাদিকতা
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            করপোরেট মিডিয়ার আপসকামিতার বিপরীতে স্বাধীন কলামিস্ট ও অনুসন্ধানী সাংবাদিকদের পূর্ণ সুরক্ষা ও সার্বভৌম অর্থনৈতিক স্বাধীনতা।
          </p>
        </div>

        {/* 4 Pillars Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {pillars.map((pillar) => (
            <div
              key={pillar.id}
              className="bg-slate-950/70 border border-slate-800 rounded-3xl p-8 hover:border-rose-600/50 transition-all duration-300 hover:shadow-2xl hover:shadow-rose-950/20 group flex flex-col justify-between"
            >
              <div>
                <div className="flex items-center justify-between mb-6">
                  <div className="w-14 h-14 rounded-2xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                    {pillar.icon}
                  </div>
                  <span className="text-[11px] font-mono tracking-wider text-rose-400 bg-rose-500/10 px-3 py-1 rounded-full border border-rose-500/20">
                    {pillar.badge}
                  </span>
                </div>

                <h3 className="text-xl font-bold text-white mb-3 group-hover:text-rose-300 transition-colors">
                  {pillar.title}
                </h3>

                <p className="text-slate-300 text-sm leading-relaxed mb-6">
                  {pillar.description}
                </p>

                {Array.isArray(pillar.key_features) && (
                  <ul className="space-y-2.5 pt-4 border-t border-slate-800/80">
                    {pillar.key_features.map((feat, idx) => (
                      <li key={idx} className="flex items-center gap-2.5 text-xs text-slate-300">
                        <span className="w-1.5 h-1.5 rounded-full bg-rose-500" />
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
