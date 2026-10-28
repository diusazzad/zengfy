import React from 'react';

export default function SkillPillarsSection({ pillars = [] }) {
  const pillarIcons = {
    badge: '🏅',
    compass: '🧭',
    certificate: '📜',
    code: '💻',
  };

  const defaultPillars = [
    {
      title: '১০০% ভেরিফাইড ট্রেইনার নেটওয়ার্ক',
      subtitle: 'Zengfy Verified Mentor Network',
      description: 'এনআইডি, একাডেমিক ব্যাকগ্রাউন্ড ও বাস্তব ইন্ডাস্ট্রি প্রজেক্ট অভিজ্ঞতা যাচাই ছাড়া কাউকে জেনফাই প্ল্যাটফর্মে কোর্স হোস্টিংয়ের অনুমতি দেওয়া হয় না। ভুয়া মেন্টর ও চটকদার বিজ্ঞাপন সম্পূর্ণ নিষিদ্ধ।',
      icon: 'badge',
      badge: 'Zero Fake Mentors',
    },
    {
      title: 'এসএসসি/এইচএসসি পোস্ট-এক্সাম রোডম্যাপ',
      subtitle: 'Structured 90-Day Practical Curriculum',
      description: 'পরীক্ষার পরবর্তী ৩-৪ মাসের অবসর সময়ের প্রতিটি দিনের জন্য সুনির্দিষ্ট সিলেবাস। ফান্ডামেন্টাল লজিক থেকে শুরু করে রিয়্যাল-লাইফ মার্কেটপ্লেস প্রজেক্ট হ্যান্ডস-অন তৈরি।',
      icon: 'compass',
      badge: '90-Day Blueprint',
    },
    {
      title: 'এনআইডি-ভেরিফাইড ট্যাম্পার-প্রুফ সার্টিফিকেট',
      subtitle: 'Verifiable Digital QR Credentials',
      description: 'কাগজের জাল সার্টিফিকেটের দিন শেষ। প্রতিটি সনদে রয়েছে ইউনিক কিউআর কোড যা লিঙ্কডইন, বায়ার ও রিক্রুটাররা ১ ক্লিকে জাতীয় পরিচয়পত্র ও প্রজেক্ট হিস্ট্রি সহ যাচাই করতে পারেন।',
      icon: 'certificate',
      badge: 'LinkedIn Compatible',
    },
    {
      title: 'সার্বভৌম প্রজেক্ট ভল্ট ও কোড প্লেগ্রাউন্ড',
      subtitle: 'Student Project Showcase Vault',
      description: 'প্রতিটি শিক্ষার্থীর তৈরি লাইভ ওয়েবসাইট, ডিজাইন ও সফটওয়্যার প্রজেক্ট সার্বভৌম ক্লাউডে হোস্ট থাকে। রেজ্যুমিতে যুক্ত করার মতো নিজস্ব লাইভ পোর্টফোলিও ইউআরএল।',
      icon: 'code',
      badge: 'Live Portfolio Hosting',
    },
  ];

  const items = pillars.length > 0 ? pillars : defaultPillars;

  return (
    <section id="pillars" className="py-20 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-100 text-cyan-800 text-xs font-bold mb-3 border border-cyan-200">
            <span>🏛️ সার্বভৌম শিক্ষা স্তম্ভ</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
            কেন ভুয়া কোচিং নয়, কেন জেনফাই স্কিল?
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            শুধুমাত্র লেকচার শোনানো নয়, শিক্ষার্থীদের ক্যারিয়ার ও বাস্তব কাজের সক্ষমতা নিশ্চিত করার পূর্ণাঙ্গ সার্বভৌম পরিকাঠামো।
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
          {items.map((pillar, idx) => (
            <div
              key={idx}
              className="p-8 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-blue-300 transition-all group"
            >
              <div className="flex items-center justify-between mb-5">
                <div className="w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-100 to-cyan-100 text-2xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-xs">
                  {pillarIcons[pillar.icon] || '🏅'}
                </div>
                <span className="text-[10px] font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 font-mono border border-slate-200">
                  {pillar.badge}
                </span>
              </div>

              <h3 className="text-xl font-black text-slate-900 tracking-tight mb-1">
                {pillar.title}
              </h3>
              <div className="text-xs font-bold text-blue-600 mb-3 font-mono">
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
