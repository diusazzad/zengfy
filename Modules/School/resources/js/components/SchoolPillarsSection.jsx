import React from 'react';
import { WifiOff, BookOpen, CreditCard, ShieldCheck, Cpu, Database, Lock, CheckCircle2 } from 'lucide-react';

export default function SchoolPillarsSection({ features = [] }) {
    const defaultFeatures = [
        {
            key: 'rfid_mesh',
            title: 'অফলাইন-রেডি আরএফআইডি মেশ',
            tag: 'বিদ্যুৎ ও নেট বিভ্রাটেও সচল',
            description: 'লোডশেডিং বা ওয়াইফাই বিচ্ছিন্ন হলেও গেটের লোকাল হার্ডওয়্যার মেমোরিতে শিক্ষার্থীদের কার্ড পাঞ্চ ডাটা জমা থাকে। বিদ্যুৎ আসামাত্র স্বয়ংক্রিয়ভাবে ক্লাউডে সিঙ্ক হয়ে অভিভাবকদের এসএমএস চলে যায়।',
            icon: WifiOff,
            badgeColor: 'text-amber-800 bg-amber-50 border-amber-200',
        },
        {
            key: 'dual_curriculum',
            title: 'NCTB ও মাদরাসা ডুয়াল কারিকুলাম',
            tag: 'সকল শিক্ষা বোর্ডের জন্য',
            description: 'সাধারণ প্রাথমিক ও উচ্চ বিদ্যালয়, ইংলিশ মিডিয়াম ক্যাডেট একাডেমি এবং কওমি ও আলিয়া মাদ্রাসার স্বতন্ত্র বিষয়বিন্যাস ও গ্রেডিং পদ্ধতি একই সিস্টেমে ১০০% কাস্টমাইজযোগ্য।',
            icon: BookOpen,
            badgeColor: 'text-indigo-800 bg-indigo-50 border-indigo-200',
        },
        {
            key: 'mobile_payments',
            title: '১-ট্যাপে স্বচ্ছ বিকাশ/নগদ ফি আদায়',
            tag: 'ব্যাংক লাইনের অবসান',
            description: 'অভিভাবক ঘরে বসেই টিউশন ফি, বার্ষিক সেশন ফি ও ল্যাব ফি পরিশোধ করেন। একাউন্ট্যান্টের কাছে সাথে সাথে রিয়েল-টাইম লেজার পোস্টিং হয় এবং অভিভাবক পান ডিজিটাল সিলযুক্ত রসিদ।',
            icon: CreditCard,
            badgeColor: 'text-pink-800 bg-pink-50 border-pink-200',
        },
        {
            key: 'encrypted_vault',
            title: 'সার্বভৌম সার্টিফিকেট ও রেজাল্ট ভল্ট',
            tag: 'NID লিঙ্কড ডিজিটাল ভল্ট',
            description: 'শিক্ষার্থীর প্রশংসাপত্র, মার্কশিট ও একাডেমিক আর্কাইভ ২৫৬-বিট ক্লায়েন্ট এনক্রিপশনে আজীবন সুরক্ষিত থাকে, যা কোনো কর্পোরেট ব্রোকার ডাটা মাইনিং করতে পারে না।',
            icon: ShieldCheck,
            badgeColor: 'text-emerald-800 bg-emerald-50 border-emerald-200',
        },
    ];

    const displayFeatures = features.length > 0
        ? features.map(f => {
            let IconComponent = ShieldCheck;
            if (f.key === 'rfid_mesh') IconComponent = WifiOff;
            else if (f.key === 'dual_curriculum') IconComponent = BookOpen;
            else if (f.key === 'mobile_payments') IconComponent = CreditCard;
            else if (f.key === 'encrypted_vault') IconComponent = ShieldCheck;
            return {
                ...f,
                icon: IconComponent,
                badgeColor: 'text-emerald-800 bg-emerald-50 border-emerald-200',
            };
        })
        : defaultFeatures;

    return (
        <section id="school-pillars-section" aria-labelledby="pillars-heading" className="py-12 sm:py-20">
            
            {/* Header */}
            <div className="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-3">
                    <Database className="w-3.5 h-3.5 text-emerald-600" />
                    <span>সার্বভৌম প্রযুক্তি ভিত্তি</span>
                </div>
                <h2 id="pillars-heading" className="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                    নিরাপদ ও টেকসই{' '}
                    <span className="bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 bg-clip-text text-transparent">
                        ক্যাম্পাস আর্কিটেকচার
                    </span>
                </h2>
                <p className="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    বাংলাদেশের বাস্তব অবকাঠামো মাথায় রেখে তৈরি—লোডশেডিং প্রতিরোধী অফলাইন ক্যাশিং থেকে শুরু করে জাতীয় পরিচয়পত্র লিঙ্কড সার্বভৌম শিক্ষার্থী রেকর্ড।
                </p>
            </div>

            {/* 4 Pillars Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-6xl mx-auto">
                {displayFeatures.map((item, index) => {
                    const Icon = item.icon;
                    return (
                        <div
                            key={item.key || index}
                            className="p-6 sm:p-8 rounded-3xl bg-white/90 backdrop-blur-xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-emerald-300 transition-all group"
                        >
                            <div className="flex items-center justify-between mb-4">
                                <div className="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center justify-center text-slate-800 group-hover:scale-110 group-hover:bg-emerald-50 group-hover:text-emerald-700 transition-all shadow-xs">
                                    <Icon className="w-6 h-6" />
                                </div>
                                <span className={`text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full border ${item.badgeColor || 'text-slate-600 bg-slate-100 border-slate-200'}`}>
                                    {item.tag}
                                </span>
                            </div>

                            <h3 className="text-xl font-black text-slate-900 tracking-tight group-hover:text-emerald-700 transition-colors">
                                {item.title}
                            </h3>

                            <p className="mt-3 text-sm text-slate-600 leading-relaxed font-medium">
                                {item.description}
                            </p>
                        </div>
                    );
                })}
            </div>

        </section>
    );
}
