import React from 'react';

export default function ShopPillarsSection({ pillars = [] }) {
  const pillarIcons = {
    shield: '🛡️',
    truck: '🚚',
    chart: '📊',
    store: '🏷️',
  };

  const defaultPillars = [
    {
      title: 'এআই অ্যান্টি-ফ্রড রিটার্ন প্রিভেনশন',
      subtitle: 'AI Anti-Fraud RTO Shield',
      description: 'বাংলাদেশের লাখ লাখ ডেলিভারি ডাটার ক্রস-রেফারেন্সিংয়ের মাধ্যমে ফেক ও অবিবেচক ক্রেতা চিহ্নিত করে। ডেলিভারিম্যান যাওয়ার আগেই আরটিও রিটার্ন ক্ষতি শতভাগ প্রতিরোধ করে।',
      icon: 'shield',
      badge: 'Smart Fraud Engine',
    },
    {
      title: 'মাল্টি-কুরিয়ার অটোমেটেড এপিআই',
      subtitle: 'Steadfast, Pathao & RedX 1-Click Sync',
      description: 'পৃথক কুরিয়ার পোর্টালে লগইন করার ঝামেলা চিরতরে বন্ধ। স্টিডফাস্ট, পাঠাও ও রেডএক্স কুরিয়ারে এক ক্লিকে পার্সেল বুকিং, ট্র্যাকিং কোড জেনারেশন ও শিপিং স্টিকার প্রিন্ট।',
      icon: 'truck',
      badge: 'Unified Courier Mesh',
    },
    {
      title: 'রিয়েল-টাইম সিওডি পেমেন্ট রিকনসিলিয়েশন',
      subtitle: 'COD Cash Reconciliation Ledger',
      description: 'কুরিয়ার কোন পার্সেলের কত ক্যাশ টাকা আটকে রেখেছে, কত টাকা কেটে নিয়েছে এবং কখন ব্যাংকে ট্রান্সফার করেছে—সবকিছুর স্বয়ংক্রিয় দৈনিক অডিট ও স্বচ্ছ লেজার।',
      icon: 'chart',
      badge: 'Audit & Cash Ledger',
    },
    {
      title: 'সার্বভৌম ইনভেন্টরি ও ব্র্যান্ডেড স্টোরফ্রন্ট',
      subtitle: 'Sovereign Storefront Vault',
      description: 'উদ্যোক্তার নিজস্ব ডোমেইনে ফেসবুক পেইজের চেয়ে ১০ গুণ দ্রুতগতির লাইটনিং-ফাস্ট ই-কমার্স শপ। সম্পূর্ণ গ্রাহক ডেটা ও ইনভেন্টরির শতভাগ সার্বভৌম মালিকানা।',
      icon: 'store',
      badge: '100% Brand Sovereignty',
    },
  ];

  const items = pillars.length > 0 ? pillars : defaultPillars;

  return (
    <section id="pillars" className="py-20 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-violet-100 text-violet-800 text-xs font-bold mb-3 border border-violet-200">
            <span>🏛️ সার্বভৌম আর্কিটেকচার স্তম্ভ</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
            কেন সাধারণ ই-কমার্স নয়, কেন জেনফায় শপ?
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            শুধু প্রোডাক্ট সাজিয়ে রাখার সাইট নয়, এটি ডিটুসি ব্র্যান্ডের মুনাফা রক্ষা এবং রিটার্ন ক্ষতি নির্মূলের সম্পূর্ণ স্বয়ংক্রিয় সিস্টেম।
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
          {items.map((pillar, idx) => (
            <div
              key={idx}
              className="p-8 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-orange-300 transition-all group"
            >
              <div className="flex items-center justify-between mb-5">
                <div className="w-14 h-14 rounded-2xl bg-gradient-to-tr from-orange-100 to-violet-100 text-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-xs">
                  {pillarIcons[pillar.icon] || '🛡️'}
                </div>
                <span className="text-[10px] font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 font-mono border border-slate-200">
                  {pillar.badge}
                </span>
              </div>

              <h3 className="text-xl font-black text-slate-900 tracking-tight mb-1">
                {pillar.title}
              </h3>
              <div className="text-xs font-bold text-orange-600 mb-3 font-mono">
                {pillar.subtitle}
              </div>
              <p className="text-sm text-slate-600 leading-relaxed">
                {pillar.description}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
