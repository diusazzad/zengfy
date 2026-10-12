import React, { useState } from 'react';
import { Users, HeartHandshake, Sparkles, Building2, GraduationCap, CheckCircle2, ArrowRight, ShieldCheck, Download, CreditCard, Award, FileSpreadsheet } from 'lucide-react';

export default function RoleJourneyTabs({ journeys = [] }) {
    const [activeRole, setActiveRole] = useState('parents');

    const roleDetails = {
        parents: {
            title: 'অভিভাবক (Parents)',
            badge: 'মানসিক প্রশান্তি',
            icon: HeartHandshake,
            color: 'emerald',
            headline: 'সন্তানের ক্লাসে প্রবেশের মুহূর্তেই নিশ্চিন্ত এসএমএস',
            description: 'সকালে স্কুলে পৌঁছানো থেকে শুরু করে বিকেলে বাড়ি ফেরা পর্যন্ত সন্তানের প্রতি মুহূর্তের নিরাপত্তা এবং ব্যাংকের দীর্ঘ লাইনে না দাঁড়িয়ে ১-ট্যাপে স্বচ্ছ ফি পেমেন্ট।',
            points: [
                'সন্তান স্কুলে প্রবেশ বা প্রস্থান করলে সাথে সাথে ফোনে গ্রিন এসএমএস নোটিফিকেশন',
                'ব্যাংকের দীর্ঘ লাইনে না দাঁড়িয়ে ১-ট্যাপে বিকাশ বা নগদ দিয়ে টিউশন ফি প্রদান',
                'টাকা জমার সাথে সাথে স্বয়ংক্রিয় ডিজিটাল সিলযুক্ত মানি রসিদ ডাউনলোড',
                'পরীক্ষার রেজাল্ট ঘোষণার সেকেন্ডেই বিষয়ভিত্তিক ডিজিটাল প্রগ্রেস কার্ড হাতে পাওয়া',
            ],
            visualType: 'parent_fee',
        },
        teachers: {
            title: 'শিক্ষক (Teachers)',
            badge: 'হাতে লেখার ভারমুক্তি',
            icon: Sparkles,
            color: 'teal',
            headline: 'পরীক্ষার খাতা মূল্যায়ন শেষে ১-ক্লিকে স্বয়ংক্রিয় রেজাল্ট শিট',
            description: 'হাতে মার্কশিট তৈরি, ক্যালকুলেটর টেপা বা ম্যানুয়াল এন্ট্রি দেওয়ার ক্লান্তিকর দিন শেষ। জেনফাই স্মার্ট অটো-গ্রেডিং ইঞ্জিন শিক্ষককে শিক্ষাদানে মনোযোগী করে।',
            points: [
                'ক্যালকুলেটর টেপার দিন শেষ—এনসিটিবি ও মাদরাসা গ্রেডিং স্কেলে স্বয়ংক্রিয় জিপিএ তৈরি',
                'মাত্র ৩০ সেকেন্ডে পুরো সেকশনের ডিজিটাল হাজিরা গ্রহণ ও অ্যাবসেন্ট মার্কিং',
                'ক্লাসওয়ার্ক, হোমওয়ার্ক ও জরুরি পরীক্ষার নোটিশ সরাসরি অভিভাবকদের ইনবক্সে প্রেরণ',
                'দুর্বল শিক্ষার্থীদের বিষয়ভিত্তিক এনালাইটিক্স দেখে বিশেষ কেয়ার নেওয়ার সুযোগ',
            ],
            visualType: 'teacher_grade',
        },
        principals: {
            title: 'অধ্যক্ষ ও গভর্নিং বডি (Principals)',
            badge: 'স্বচ্ছ অ্যাকাউন্টিং',
            icon: Building2,
            color: 'indigo',
            headline: 'প্রতিষ্ঠান পরিচালনার প্রতিটি পাই-পয়সার রিয়েল-টাইম ড্যাশবোর্ড',
            description: 'প্রতিষ্ঠানের আয়-ব্যয়, বকেয়া টিউশন ফি, শিক্ষক-কর্মচারী উপস্থিতি ও সার্বিক শৃঙ্খলা এক নজরে পর্যবেক্ষণ করুন আপনার মোবাইল বা ল্যাপটপ থেকে।',
            points: [
                'দৈনিক মোট ফি কালেকশন ও বকেয়া ফি রিয়েল-টাইম মনিটরিং ও হিসাব সংরক্ষণ',
                'শিক্ষক ও কর্মকর্তা-কর্মচারীদের বায়োমেট্রিক হাজিরা ও অটো স্যালারি পে-রোল শীট',
                'এক ক্লিকে সকল অভিভাবকের কাছে জরুরি সরকারি নোটিশ বা আবহাওয়া ছুটি বার্তা ব্রডকাস্ট',
                'বার্ষিক অডিট ও গভর্নিং বডি মিটিংয়ের জন্য নির্ভুল একাউন্টিং লেজার এক্সপোর্ট',
            ],
            visualType: 'principal_dashboard',
        },
        students: {
            title: 'শিক্ষার্থী (Students)',
            badge: 'ডিজিটাল প্রেরণা',
            icon: GraduationCap,
            color: 'purple',
            headline: '১টি স্মার্ট ডিজিটাল আইডি ও আধুনিক শিক্ষাঙ্গনের আনন্দ',
            description: 'স্মার্ট আইডি কার্ডের মাধ্যমে গেট এন্ট্রি, লাইব্রেরি বই ইস্যু, ডিজিটাল রুটিন ও পরীক্ষার সিট প্ল্যান জেনে নিজের একাডেমিক পথচলা করুন সহজ ও সাবলীল।',
            points: [
                'স্মার্ট আরএফআইডি আইডি কার্ড দিয়ে গেট এন্ট্রি, লাইব্রেরি ও বিজ্ঞানাগার অ্যাক্সেস',
                'ডিজিটাল ক্লাস রুটিন, পরীক্ষার সময়সূচি ও সিট প্ল্যান তাৎক্ষণিক দেখা',
                'শতভাগ উপস্থিতি ও পাঠ্যক্রমে ভালো ফলাফলের জন্য ডিজিটাল স্টার ব্যাজ অর্জন',
                'আজীবন সংরক্ষিত নিরাপদ ও সার্বভৌম একাডেমিক সার্টিফিকেট ভল্ট',
            ],
            visualType: 'student_card',
        },
    };

    const currentRole = roleDetails[activeRole] || roleDetails.parents;

    return (
        <section id="role-journeys-section" aria-labelledby="roles-heading" className="py-12 sm:py-16">
            
            {/* Section Header */}
            <div className="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
                <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-800 text-xs font-bold uppercase tracking-wider mb-3">
                    <Users className="w-3.5 h-3.5 text-indigo-600" />
                    <span>৪টি স্বতন্ত্র দৃষ্টিকোণ</span>
                </div>
                <h2 id="roles-heading" className="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                    প্রতিটি পক্ষের জন্য তৈরি{' '}
                    <span className="bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 bg-clip-text text-transparent">
                        বিশেষায়িত স্বস্তি ও সুবিধা
                    </span>
                </h2>
                <p className="mt-4 text-slate-600 text-sm sm:text-base">
                    অভিভাবকের নিশ্চিন্ত শান্তি থেকে অধ্যক্ষের স্বচ্ছ আর্থিক হিসাব—জেনফাই স্কুল সবাইকে এক প্ল্যাটফর্মে সংযুক্ত করে।
                </p>

                {/* 4-Tab Switcher */}
                <div className="mt-8 flex flex-wrap items-center justify-center gap-2 p-1.5 rounded-2xl bg-white border border-slate-200/80 shadow-xs max-w-2xl mx-auto">
                    {Object.entries(roleDetails).map(([key, item]) => {
                        const Icon = item.icon;
                        const isSelected = activeRole === key;
                        return (
                            <button
                                key={key}
                                type="button"
                                onClick={() => setActiveRole(key)}
                                className={`flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer ${
                                    isSelected
                                        ? 'bg-slate-900 text-white shadow-md'
                                        : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100'
                                }`}
                            >
                                <Icon className={`w-4 h-4 ${isSelected ? 'text-emerald-400' : 'text-slate-500'}`} />
                                <span>{item.title}</span>
                            </button>
                        );
                    })}
                </div>
            </div>

            {/* Active Role Content Card */}
            <div className="max-w-5xl mx-auto p-6 sm:p-10 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-xl transition-all">
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    {/* Left: Headline & Bullets (7 cols) */}
                    <div className="lg:col-span-7">
                        <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200 mb-3">
                            <ShieldCheck className="w-3.5 h-3.5 text-emerald-600" />
                            <span>{currentRole.badge}</span>
                        </div>
                        <h3 className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-snug">
                            {currentRole.headline}
                        </h3>
                        <p className="mt-3 text-slate-600 text-sm sm:text-base leading-relaxed">
                            {currentRole.description}
                        </p>

                        <div className="mt-6 space-y-3">
                            {currentRole.points.map((pt, i) => (
                                <div key={i} className="flex items-start gap-3">
                                    <CheckCircle2 className="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" />
                                    <span className="text-sm font-semibold text-slate-800 leading-snug">
                                        {pt}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Right: Visual Proof Mockup (5 cols) */}
                    <div className="lg:col-span-5">
                        
                        {activeRole === 'parents' && (
                            <div className="p-5 rounded-2xl bg-gradient-to-br from-emerald-50 via-white to-teal-50 border border-emerald-200 shadow-md">
                                <div className="flex items-center justify-between pb-3 border-b border-emerald-100">
                                    <div className="flex items-center gap-2">
                                        <div className="w-8 h-8 rounded-lg bg-pink-600 text-white flex items-center justify-center font-bold text-xs">
                                            bKash
                                        </div>
                                        <div>
                                            <div className="text-xs font-bold text-slate-900">ডিজিটাল টিউশন ফি রসিদ</div>
                                            <div className="text-[10px] text-slate-500">অনলাইন পেমেন্ট ভেরিফাইড</div>
                                        </div>
                                    </div>
                                    <span className="text-xs font-black text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full">
                                        পরিশোধিত
                                    </span>
                                </div>

                                <div className="mt-4 space-y-2 text-xs">
                                    <div className="flex justify-between text-slate-600">
                                        <span>মাসিক বেতন (অক্টোবর ২০২৬):</span>
                                        <span className="font-bold text-slate-900">৳১,৫০০</span>
                                    </div>
                                    <div className="flex justify-between text-slate-600">
                                        <span>আইসিটি ও ল্যাব ফি:</span>
                                        <span className="font-bold text-slate-900">৳২০০</span>
                                    </div>
                                    <div className="flex justify-between text-slate-600">
                                        <span>গেট এসএমএস গেটওয়ে ফি:</span>
                                        <span className="font-bold text-slate-900">৳৫০</span>
                                    </div>
                                    <div className="pt-2 border-t border-emerald-100 flex justify-between font-black text-sm text-slate-900">
                                        <span>সর্বমোট পরিশোধ:</span>
                                        <span className="text-emerald-700">৳১,৭৫০</span>
                                    </div>
                                </div>

                                <div className="mt-4 pt-3 border-t border-emerald-100 flex items-center justify-between text-[11px]">
                                    <span className="font-mono text-slate-400">TrxID: BK78A90X21</span>
                                    <span className="text-emerald-700 font-bold flex items-center gap-1 cursor-pointer hover:underline">
                                        <Download className="w-3.5 h-3.5" /> রসিদ ডাউনলোড
                                    </span>
                                </div>
                            </div>
                        )}

                        {activeRole === 'teachers' && (
                            <div className="p-5 rounded-2xl bg-gradient-to-br from-teal-50 via-white to-blue-50 border border-teal-200 shadow-md">
                                <div className="flex items-center justify-between pb-3 border-b border-teal-100">
                                    <div className="flex items-center gap-2">
                                        <FileSpreadsheet className="w-6 h-6 text-teal-600" />
                                        <div>
                                            <div className="text-xs font-bold text-slate-900">স্বয়ংক্রিয় রেজাল্ট শীট জেনারেটর</div>
                                            <div className="text-[10px] text-slate-500">৮ম শ্রেণী - গণিত (বার্ষিক পরীক্ষা)</div>
                                        </div>
                                    </div>
                                    <span className="text-xs font-black text-teal-800 bg-teal-100 px-2 py-0.5 rounded-full">
                                        ১-ক্লিক রেজাল্ট
                                    </span>
                                </div>

                                <div className="mt-4 space-y-2 text-xs">
                                    <div className="flex items-center justify-between p-2 rounded-lg bg-white border border-slate-100">
                                        <span className="font-bold text-slate-800">রোল ০১ - সাকিব আল হাসান</span>
                                        <span className="font-bold text-emerald-600">৯৬ (A+ / 5.00)</span>
                                    </div>
                                    <div className="flex items-center justify-between p-2 rounded-lg bg-white border border-slate-100">
                                        <span className="font-bold text-slate-800">রোল ১২ - সৌম্য আহমেদ</span>
                                        <span className="font-bold text-emerald-600">৯২ (A+ / 5.00)</span>
                                    </div>
                                    <div className="flex items-center justify-between p-2 rounded-lg bg-white border border-slate-100">
                                        <span className="font-bold text-slate-800">রোল ১৭ - মেহজাবিন জাহান</span>
                                        <span className="font-bold text-teal-600">৮৪ (A+ / 5.00)</span>
                                    </div>
                                </div>

                                <div className="mt-4 pt-3 border-t border-teal-100 text-center">
                                    <span className="text-xs font-bold text-teal-700">
                                        ✨ শতভাগ নির্ভুল এনসিটিবি গ্রেডিং ক্যালকুলেশন
                                    </span>
                                </div>
                            </div>
                        )}

                        {activeRole === 'principals' && (
                            <div className="p-5 rounded-2xl bg-gradient-to-br from-indigo-50 via-white to-purple-50 border border-indigo-200 shadow-md">
                                <div className="flex items-center justify-between pb-3 border-b border-indigo-100">
                                    <div className="flex items-center gap-2">
                                        <Building2 className="w-6 h-6 text-indigo-600" />
                                        <div>
                                            <div className="text-xs font-bold text-slate-900">লাইভ ফাইন্যান্সিয়াল ড্যাশবোর্ড</div>
                                            <div className="text-[10px] text-slate-500">অক্টোবর ১২, ২০২৬ (আজকের হিসাব)</div>
                                        </div>
                                    </div>
                                    <span className="text-xs font-black text-indigo-800 bg-indigo-100 px-2 py-0.5 rounded-full">
                                        রিয়েল-টাইম
                                    </span>
                                </div>

                                <div className="mt-4 grid grid-cols-2 gap-3 text-center">
                                    <div className="p-3 rounded-xl bg-white border border-slate-100 shadow-xs">
                                        <div className="text-[10px] font-bold text-slate-500">আজকের ফি কালেকশন</div>
                                        <div className="text-lg font-black text-emerald-700 mt-1">৳১,৮৪,৫০০</div>
                                    </div>
                                    <div className="p-3 rounded-xl bg-white border border-slate-100 shadow-xs">
                                        <div className="text-[10px] font-bold text-slate-500">আজকের মোট উপস্থিতি</div>
                                        <div className="text-lg font-black text-indigo-700 mt-1">৯৮.৬%</div>
                                    </div>
                                </div>

                                <div className="mt-4 pt-3 border-t border-indigo-100 text-center">
                                    <span className="text-xs font-bold text-indigo-800">
                                        📊 অডিট কমপ্লায়েন্স ও বাৎসরিক বাজেট স্বয়ংক্রিয় প্রস্তুত
                                    </span>
                                </div>
                            </div>
                        )}

                        {activeRole === 'students' && (
                            <div className="p-5 rounded-2xl bg-gradient-to-br from-purple-50 via-white to-pink-50 border border-purple-200 shadow-md">
                                <div className="flex items-center justify-between pb-3 border-b border-purple-100">
                                    <div className="flex items-center gap-2">
                                        <Award className="w-6 h-6 text-purple-600" />
                                        <div>
                                            <div className="text-xs font-bold text-slate-900">স্মার্ট স্টুডেন্ট পোর্টাল</div>
                                            <div className="text-[10px] text-slate-500">একাডেমিক প্রোফাইল ও এচিভমেন্ট</div>
                                        </div>
                                    </div>
                                    <span className="text-xs font-black text-purple-800 bg-purple-100 px-2 py-0.5 rounded-full">
                                        স্টার স্টুডেন্ট
                                    </span>
                                </div>

                                <div className="mt-4 space-y-2 text-xs">
                                    <div className="flex items-center justify-between p-2 rounded-lg bg-white border border-slate-100">
                                        <span className="font-semibold text-slate-700">বার্ষিক উপস্থিতি রেকর্ড:</span>
                                        <span className="font-bold text-emerald-700">১০০% উপস্থিত (স্টার ব্যাজ 🌟)</span>
                                    </div>
                                    <div className="flex items-center justify-between p-2 rounded-lg bg-white border border-slate-100">
                                        <span className="font-semibold text-slate-700">ডিজিটাল সার্টিফিকেট ভল্ট:</span>
                                        <span className="font-bold text-indigo-700">এনক্রিপ্টেড ও সুরক্ষিত 🔒</span>
                                    </div>
                                </div>

                                <div className="mt-4 pt-3 border-t border-purple-100 text-center">
                                    <span className="text-xs font-bold text-purple-700">
                                        🎓 স্মার্ট ভবিষ্যৎ গড়ার আধুনিক প্রযুক্তি
                                    </span>
                                </div>
                            </div>
                        )}

                    </div>

                </div>
            </div>

        </section>
    );
}
