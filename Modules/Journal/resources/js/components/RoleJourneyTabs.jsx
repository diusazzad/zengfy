import React, { useState } from 'react';

export default function RoleJourneyTabs({ journeysData }) {
  const defaultJourneys = [
    {
      id: 'columnist',
      role: 'স্বাধীন সাংবাদিক ও কলামিস্ট',
      badge: 'Independent Columnist',
      icon: '✍️',
      headline: 'রাজনৈতিক চাপ ও করপোরেট মালিকদের চোখরাঙানি ছাড়া স্বাধীন এডিটোরিয়াল কণ্ঠস্বর',
      description: 'কোনো মিডিয়া হাউস বা বিজ্ঞাপনদাতার তোষামোদ না করে সম্পূর্ণ স্বাধীন মতপ্রকাশ করুন। নিজের ভেরিফাইড অডিয়েন্স তৈরি করুন এবং সরাসরি পাঠকের বিকাশ/নগদ মাইক্রো-পেমেন্ট থেকে নিয়মিত সম্মানজনক আয় নিশ্চিত করুন।',
      points: [
        '১০০% সেন্সরশিপ-প্রুফ নিজস্ব নিউজলেটার ও অপ-এড পোর্টাল',
        'বিকাশ ও নগদে মাসিক ও বার্ষিক পে-ওয়াল সরাসরি নিজস্ব অ্যাকাউন্টে',
        'নিজস্ব কাস্টম ডোমেইন (যেমন: yourname.journal.com বা yoursite.com)',
        'জিরো-নলেজ এনক্রিপ্টেড হুইসেলব্লোয়ার ইনবক্সে গোপন নথিপত্র সংগ্রহ'
      ],
      quote: '“আগে সম্পাদক মশাইয়ের লাল কালিতে গুরুত্বপূর্ণ লাইন কাটা পড়ত। জেনফাই জার্নালে আমার লেখার প্রতিটি শব্দ অবিকৃত থাকে।”'
    },
    {
      id: 'reader',
      role: 'সচেতন ও বিবেকবান পাঠক',
      badge: 'Discerning Reader',
      icon: '📖',
      headline: 'পেইড প্রোপাগান্ডা ও ক্লীকবেইটের বদলে ফিল্টারহীন গভীর অনুসন্ধানী সত্য বিশ্লেষণ',
      description: 'করপোরেট মিডিয়ার স্পনসরড ও পক্ষপাতদুষ্ট সংবাদের দিন শেষ। সত্য অনুসন্ধানে নির্ভীক সাংবাদিকদের সরাসরি সহায়তা দিয়ে পড়ুন গভীর বিশ্লেষণ, মেগা প্রজেক্টের বাজেট অডিট ও অপ্রকাশিত ফাইল।',
      points: [
        '১ ক্লিকে বিকাশ দিয়ে মাত্র ৳১০০ সাবস্ক্রিপশনে এক্সক্লুসিভ প্রতিবেদন আনলক',
        'কোনো বিরক্তিদায়ক অ্যাড, পপ-আপ বা ট্র্যাকারের নজরদারি নেই',
        'পেইড কলামিস্টদের সাথে সরাসরি ইন্টারেক্টিভ প্রশ্নোত্তর সেশন',
        'পিডিএফ ও অফলাইন রিডিং সাপোর্টসহ আর্কাইভিং সুবিধা'
      ],
      quote: '“আমার দেওয়া সাবস্ক্রিপশনের টাকায় যখন সত্য রিপোর্ট প্রকাশিত হয়, তখন মনে হয় নাগরিক হিসেবে আমিও সত্যের সাথে আছি।”'
    },
    {
      id: 'whistleblower',
      role: 'হুইসেলব্লোয়ার ও গোপন সোর্স',
      badge: 'Protected Whistleblower',
      icon: '🕵️',
      headline: 'এনক্রিপ্টেড ক্লায়েন্ট ভল্টের মাধ্যমে নির্ভয়ে দুর্নীতি ও অনিয়মের নথিপত্র ফাঁস করার নিশ্চয়তা',
      description: 'হুইসেলব্লোয়ারদের সুরক্ষা ছাড়া বস্তুনিষ্ঠ সাংবাদিকতা অসম্ভব। জেনফাই জার্নাল ব্যবহার করে ২৫৬-বিট ক্লায়েন্ট-সাইড জিরো-নলেজ আর্কিটেকচারে সরাসরি সাংবাদিকদের কাছে ডকুমেন্ট পাঠান কোনো পরিচয় বা ডিজিটাল ফুটপ্রিন্ট ছাড়া।',
      points: [
        'জিরো-লগিং আর্কিটেকচার: সার্ভারে কোনো আইপি বা মেটাডাটা সংরক্ষণ হয় না',
        'ফাইল পাঠানোর সাথে সাথেই মেটাডাটা (EXIF/GPS/ডিভাইস আইডি) স্ট্রিপিং',
        'স্বয়ংক্রিয় ধ্বংসযোগ্য ওয়ান-টাইম সিক্রেট শেয়ারিং ড্রপবক্স',
        'সাংবাদিকের সাথে দ্বিমুখী এনক্রিপ্টেড ছদ্মনামী চ্যাট'
      ],
      quote: '“কোনো ডিজিটাল ফুটপ্রিন্ট না রেখেই ব্যাংকের অভ্যন্তরীণ অডিট শিট সাংবাদিকদের হাতে নিরাপদে পৌঁছে দিতে পেরেছি।”'
    },
    {
      id: 'syndicate',
      role: 'স্বাধীন মিডিয়া কালেক্টিভ ও সিন্ডিকেট',
      badge: 'Independent Media Syndicate',
      icon: '📰',
      headline: 'একাধিক নির্ভীক লেখকের যৌথ জার্নাল ও যৌথ সাবস্ক্রিপশন ব্যবস্থাপনা',
      description: 'অনুসন্ধানী সাংবাদিকদের যৌথ দল, থিংকট্যাংক বা স্বাধীন মিডিয়া কালেক্টিভ গড়ে তুলুন। যৌথ পে-ওয়াল, টিম রয়্যালটি স্প্লিট এবং মাল্টি-অথর এডিটোরিয়াল ওয়ার্কফ্লো দিয়ে একটি স্বাধীন সংবাদ সংস্থা পরিচালনা করুন।',
      points: [
        'মাল্টিপল লেখক ও এডিটর টিম ম্যানেজমেন্ট কনসোল',
        'যৌথ সাবস্ক্রিপশন ও অটোমেটেড রয়্যালটি স্প্লিট ইঞ্জিন',
        'উন্নত এনক্রিপ্টেড ডিজিটাল হুইসেলব্লোয়ার নিউজরুম ভল্ট',
        'ডেডিকেটেড ক্লাউড হোস্ট ও প্রায়োরিটি অন-ডিমান্ড সাপোর্ট'
      ],
      quote: '“আমাদের ৫ জন অনুসন্ধানী সাংবাদিকের যৌথ সিন্ডিকেট এখন সম্পূর্ণ সাবস্ক্রিপশন মডেলে স্বাবলম্বী।”'
    }
  ];

  const journeys = Array.isArray(journeysData) && journeysData.length > 0 ? journeysData : defaultJourneys;
  const [activeTabId, setActiveTabId] = useState(journeys[0]?.id || 'columnist');
  const current = journeys.find((j) => j.id === activeTabId) || journeys[0];

  return (
    <section id="journeys" className="py-20 bg-slate-950 text-slate-100 relative overflow-hidden">
      {/* Background Subtle Gradient */}
      <div className="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-950 to-slate-950 pointer-events-none" />

      <div className="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-semibold mb-4 tracking-wider">
            স্টেকহোল্ডার দৃষ্টিভঙ্গি ও জার্নি
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            স্বাধীন সাংবাদিকতার সার্বভৌম বাস্তুতন্ত্রে আপনার ভূমিকা
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            কলামিস্ট থেকে শুরু করে পাঠক এবং গোপন সোর্স — সার্বভৌম মতপ্রকাশের প্রতিটি অংশীদার এখানে সুরক্ষিত ও ক্ষমতায়িত।
          </p>
        </div>

        {/* Tab Buttons */}
        <div className="grid grid-cols-2 md:grid-cols-4 gap-3 mb-10">
          {journeys.map((item) => {
            const active = item.id === activeTabId;
            return (
              <button
                key={item.id}
                type="button"
                onClick={() => setActiveTabId(item.id)}
                className={`p-4 rounded-2xl text-left transition-all duration-200 border flex flex-col justify-between ${
                  active
                    ? 'bg-slate-900 border-rose-600 shadow-lg shadow-rose-950/50 ring-1 ring-rose-500/50'
                    : 'bg-slate-900/40 border-slate-800 hover:bg-slate-900/80 hover:border-slate-700'
                }`}
              >
                <div className="text-2xl mb-2">{item.icon}</div>
                <div>
                  <div className={`text-xs uppercase tracking-wider font-semibold mb-1 ${active ? 'text-rose-400' : 'text-slate-400'}`}>
                    {item.badge}
                  </div>
                  <div className={`text-sm font-bold line-clamp-1 ${active ? 'text-white' : 'text-slate-300'}`}>
                    {item.role}
                  </div>
                </div>
              </button>
            );
          })}
        </div>

        {/* Active Journey Detail Card */}
        {current && (
          <div className="bg-slate-900/80 border border-slate-800 rounded-3xl p-6 sm:p-10 lg:p-12 backdrop-blur-xl shadow-2xl transition-all duration-300">
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
              {/* Left Column: Headline, Description & Features */}
              <div className="lg:col-span-7 space-y-6">
                <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-semibold">
                  <span>{current.icon}</span>
                  <span>{current.badge}</span>
                </div>

                <h3 className="text-xl sm:text-2xl lg:text-3xl font-extrabold text-white leading-snug">
                  {current.headline}
                </h3>

                <p className="text-slate-300 text-base leading-relaxed">
                  {current.description}
                </p>

                {/* Bullet Points */}
                {Array.isArray(current.points) && (
                  <div className="pt-2">
                    <h4 className="text-xs uppercase tracking-wider text-slate-400 font-bold mb-3">
                      মূল ক্ষমতায়ন ও সুবিধাসমূহ:
                    </h4>
                    <ul className="space-y-3">
                      {current.points.map((pt, idx) => (
                        <li key={idx} className="flex items-start gap-3 text-sm text-slate-200">
                          <span className="flex-shrink-0 w-5 h-5 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center text-xs font-bold mt-0.5">
                            ✓
                          </span>
                          <span>{pt}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                )}
              </div>

              {/* Right Column: Quote & Live Micro-Action Card */}
              <div className="lg:col-span-5 space-y-6">
                {current.quote && (
                  <div className="bg-slate-950/80 border border-slate-800/80 rounded-2xl p-6 relative">
                    <div className="text-rose-500 text-3xl font-serif leading-none mb-2">“</div>
                    <p className="text-slate-300 text-sm sm:text-base italic leading-relaxed mb-4">
                      {current.quote.replace(/[“”]/g, '')}
                    </p>
                    <div className="text-xs text-rose-400 font-semibold uppercase tracking-wider">
                      — {current.role} বাস্তব অভিজ্ঞতা
                    </div>
                  </div>
                )}

                <div className="bg-gradient-to-br from-rose-950/40 to-slate-900 border border-rose-800/30 rounded-2xl p-6">
                  <div className="text-sm font-bold text-white mb-2">
                    এখনই স্বাধীন প্ল্যাটফর্মে যুক্ত হোন
                  </div>
                  <p className="text-xs text-slate-300 mb-4 leading-relaxed">
                    কোনো মিডলম্যান বা রাজনৈতিক নজরদারি নেই। আপনার প্রতিটি মতপ্রকাশ এখানে সুরক্ষিত।
                  </p>
                  <a
                    href="#pricing"
                    className="inline-flex items-center justify-center w-full py-3 px-4 rounded-xl bg-rose-700 hover:bg-rose-600 text-white text-xs sm:text-sm font-bold transition-all shadow-md shadow-rose-900/30"
                  >
                    শুরু করুন →
                  </a>
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
