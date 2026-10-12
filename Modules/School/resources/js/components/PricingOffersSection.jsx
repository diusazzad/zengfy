import React, { useState } from 'react';
import { Check, Sparkles, Building, Globe, Shield, PhoneCall, ArrowRight, MessageSquare, Zap } from 'lucide-react';

export default function PricingOffersSection({ packages = [], links = {} }) {
    const [selectedPlan, setSelectedPlan] = useState('cloud_saas');
    const [contactModalOpen, setContactModalOpen] = useState(false);
    const [contactPlanName, setContactPlanName] = useState('');

    const defaultPackages = [
        {
            id: 'cloud_saas',
            name: 'রেডি ক্লাউড সাবস্ক্রিপশন (Cloud SaaS)',
            price: '৳২,০০০',
            period: '/মাস',
            tag: 'ছোট ও মাঝারি শিক্ষা প্রতিষ্ঠান',
            is_popular: true,
            features: [
                'অল-ইন-ওয়ান রেডি ক্লাউড হোস্টিং ও অটো ক্লাউড ব্যাকআপ',
                '১,০০০ শিক্ষার্থী পর্যন্ত আনলিমিটেড ব্যবহার',
                'অভিভাবক ও শিক্ষক স্মার্ট মোবাইল অ্যাপ অ্যাক্সেস',
                'স্বয়ংক্রিয় এসএমএস গেটওয়ে ইন্টিগ্রেশন',
                'NCTB ও মাদরাসা রেজাল্ট অটোমেশন ইঞ্জিন',
                'নিয়মিত সিকিউরিটি আপডেট ও টেকনিক্যাল সাপোর্ট',
            ],
            cta: 'শুরু করুন (Start Cloud)',
        },
        {
            id: 'one_time',
            name: 'ওয়ান-টাইম ওনারশিপ (Self-Hosted on Own Domain)',
            price: 'এককালীন লাইসেন্স',
            period: 'আজীবন ব্যবহার',
            tag: 'প্রতিষ্ঠানের নিজস্ব ডোমেইনে',
            is_popular: false,
            features: [
                'প্রতিষ্ঠানের নিজস্ব ডোমেইন ও হোস্টিংয়ে পূর্ণ সেটআপ',
                'ডাটাবেজের ১০০% নিজস্ব সার্বভৌম নিয়ন্ত্রণ ও গোপনীয়তা',
                'কোনো মাসিক বিলিং বা মেইনটেন্যান্স ফি নেই (জিরো ফি)',
                'আনলিমিটেড শিক্ষার্থী ও শিক্ষক অ্যাকাউন্ট',
                'অফলাইন RFID গেট লোকাল সার্ভার ডাটা সিঙ্ক',
                'ফুল ডাটাবেজ ব্যাকআপ ও এক্সপোর্ট কন্ট্রোল',
            ],
            cta: 'লাইসেন্স নিন (Buy License)',
        },
        {
            id: 'custom_enterprise',
            name: 'কাস্টম এন্টারপ্রাইজ ইআরপি (Custom Enterprise)',
            price: 'কাস্টম কোটেশন',
            period: 'Contact Sales',
            tag: 'বড় ক্যাডেট কলেজ ও চেইন',
            is_popular: false,
            features: [
                'মাল্টি-ক্যাম্পাস ও একাধিক ব্রাঞ্চ একীভূত সেন্ট্রাল ড্যাশবোর্ড',
                'কাস্টম মডিউল ডেভেলপমেন্ট ও স্পেশাল কারিকুলাম সাপোর্ট',
                'প্রতিষ্ঠানে এসে অন-সাইট স্টাফ ট্রেনিং ও ডেডিকেটেড ইঞ্জিনিয়ার',
                'কাস্টম ব্যাংকিং API ও টেলকো বাল্ক এসএমএস সংযোগ',
                'ডেডিকেটেড প্রাইভেট ক্লাউড বা অন-প্রিমিসেস সার্ভার সেটআপ',
                'এসএলএ সহ ২৪/৭ প্রায়োরিটি ১ জরুরি হেল্পডেস্ক',
            ],
            cta: 'সেলস টিমের সাথে কথা বলুন',
        },
    ];

    const displayPackages = packages.length > 0 ? packages : defaultPackages;

    const handleAction = (pkg) => {
        setContactPlanName(pkg.name);
        setContactModalOpen(true);
    };

    return (
        <section id="pricing-offers-section" aria-labelledby="pricing-heading" className="py-12 sm:py-20">
            
            {/* Header */}
            <div className="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-3">
                    <Sparkles className="w-3.5 h-3.5 text-emerald-600" />
                    <span>স্বচ্ছ ও সাশ্রয়ী বাণিজ্যিক অফার</span>
                </div>
                <h2 id="pricing-heading" className="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                    আপনার প্রতিষ্ঠানের সুবিধার জন্য{' '}
                    <span className="bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 bg-clip-text text-transparent">
                        ৩টি উপযোগী প্যাকেজ
                    </span>
                </h2>
                <p className="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    মাসিক সাশ্রয়ী ক্লাউড সার্ভিস হোক কিংবা নিজের ডোমেইনে আজীবন ওয়ান-টাইম ওনারশিপ—আপনার বাজেট ও প্রয়োজনের সাথে মানানসই সেরা প্ল্যান বেছে নিন।
                </p>
            </div>

            {/* 3 Pricing Cards Grid */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto items-stretch">
                {displayPackages.map((pkg) => {
                    const isPopular = pkg.is_popular;
                    return (
                        <div
                            key={pkg.id}
                            className={`flex flex-col justify-between p-6 sm:p-8 rounded-3xl transition-all duration-300 relative ${
                                isPopular
                                    ? 'bg-gradient-to-b from-white via-emerald-50/20 to-white border-2 border-emerald-500 shadow-2xl scale-[1.02] ring-4 ring-emerald-500/10'
                                    : 'bg-white/90 backdrop-blur-xl border border-slate-200/80 shadow-md hover:shadow-xl hover:border-slate-300'
                            }`}
                        >
                            {/* Popular Ribbon */}
                            {isPopular && (
                                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-extrabold text-xs uppercase tracking-wider shadow-md">
                                    ⭐ সর্বাধিক জনপ্রিয় অফার
                                </div>
                            )}

                            <div>
                                <span className="text-[11px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">
                                    {pkg.tag}
                                </span>

                                <h3 className="mt-4 text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                    {pkg.name}
                                </h3>

                                <div className="mt-4 pb-4 border-b border-slate-100 flex items-baseline gap-1.5">
                                    <span className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight font-mono">
                                        {pkg.price}
                                    </span>
                                    <span className="text-sm font-bold text-slate-500">
                                        {pkg.period}
                                    </span>
                                </div>

                                {/* Features List */}
                                <ul className="mt-6 space-y-3">
                                    {pkg.features.map((feat, idx) => (
                                        <li key={idx} className="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 font-medium">
                                            <div className="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                                <Check className="w-2.5 h-2.5" />
                                            </div>
                                            <span className="leading-snug">{feat}</span>
                                        </li>
                                    ))}
                                </ul>
                            </div>

                            {/* Card Bottom CTA */}
                            <div className="mt-8 pt-6 border-t border-slate-100">
                                <button
                                    type="button"
                                    onClick={() => handleAction(pkg)}
                                    className={`w-full py-3.5 px-5 rounded-2xl font-bold text-sm transition-all shadow-xs cursor-pointer flex items-center justify-center gap-2 ${
                                        isPopular
                                            ? 'bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white shadow-emerald-500/25 hover:shadow-lg'
                                            : 'bg-slate-900 hover:bg-slate-800 text-white'
                                    }`}
                                >
                                    <span>{pkg.cta}</span>
                                    <ArrowRight className="w-4 h-4" />
                                </button>
                                <div className="text-center mt-2.5">
                                    <span className="text-[11px] text-slate-400">
                                        {pkg.id === 'one_time' ? 'কোনো গোপন চার্জ নেই' : 'ফ্রি ডেমো এবং সাপোর্ট'}
                                    </span>
                                </div>
                            </div>
                        </div>
                    );
                })}
            </div>

            {/* Quick Consultation Ribbon */}
            <div className="mt-12 max-w-4xl mx-auto p-6 rounded-3xl bg-emerald-50/80 border border-emerald-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
                <div className="flex items-center gap-3">
                    <div className="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0 font-bold">
                        <PhoneCall className="w-5 h-5" />
                    </div>
                    <div>
                        <div className="text-sm font-bold text-slate-900">
                            সিদ্ধান্ত নিতে পারছেন না? আমাদের শিক্ষাবিদ টিমের সাথে কথা বলুন
                        </div>
                        <div className="text-xs text-slate-600">
                            আমরা আপনার ক্যাম্পাসে এসে সরাসরি ফ্রি আরএফআইডি ও সফটওয়্যার ডেমো প্রদর্শন করব।
                        </div>
                    </div>
                </div>

                <a
                    href="https://wa.me/8801700000000?text=Zengfy%20School%20ERP%20Demo%20Request"
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-xs hover:shadow-md transition-all shrink-0"
                >
                    <MessageSquare className="w-4 h-4" />
                    <span>WhatsApp-এ সরাসরি কথা বলুন</span>
                </a>
            </div>

            {/* Simple Contact / Proposal Modal */}
            {contactModalOpen && (
                <div className="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm flex items-center justify-center p-4">
                    <div className="w-full max-w-md bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-200">
                        <div className="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h4 className="text-base font-black text-slate-900">
                                অফার আগ্রহ: {contactPlanName}
                            </h4>
                            <button
                                type="button"
                                onClick={() => setContactModalOpen(false)}
                                className="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold flex items-center justify-center cursor-pointer"
                            >
                                ✕
                            </button>
                        </div>

                        <div className="py-4 space-y-3">
                            <p className="text-xs text-slate-600 leading-relaxed">
                                ধন্যবাদ! আপনার শিক্ষা প্রতিষ্ঠানের জন্য <strong>{contactPlanName}</strong> লাইসেন্স সেটআপ করতে নিচের ফর্মটি দিন বা সরাসরি আমাদের হটলাইনে যোগাযোগ করুন:
                            </p>
                            
                            <div>
                                <label className="text-xs font-bold text-slate-700 block mb-1">প্রতিষ্ঠানের নাম</label>
                                <input
                                    type="text"
                                    placeholder="উদাঃ মতিঝিল আইডিয়াল স্কুল"
                                    className="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-emerald-600"
                                />
                            </div>

                            <div>
                                <label className="text-xs font-bold text-slate-700 block mb-1">যোগাযোগকারীর মোবাইল নম্বর</label>
                                <input
                                    type="text"
                                    placeholder="০১৭xxxxxxxx"
                                    className="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-emerald-600"
                                />
                            </div>

                            <div>
                                <label className="text-xs font-bold text-slate-700 block mb-1">শিক্ষার্থী সংখ্যা (আনুমানিক)</label>
                                <input
                                    type="number"
                                    placeholder="৫০০"
                                    className="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-emerald-600"
                                />
                            </div>
                        </div>

                        <div className="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                            <button
                                type="button"
                                onClick={() => setContactModalOpen(false)}
                                className="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 cursor-pointer"
                            >
                                বন্ধ করুন
                            </button>
                            <button
                                type="button"
                                onClick={() => {
                                    alert('আপনার অনুরোধ সফলভাবে গ্রহণ করা হয়েছে। আমাদের স্কুল প্রতিনিধি ২৪ ঘণ্টার মধ্যে যোগাযোগ করবেন।');
                                    setContactModalOpen(false);
                                }}
                                className="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold cursor-pointer shadow-xs"
                            >
                                অনুরোধ পাঠান
                            </button>
                        </div>
                    </div>
                </div>
            )}

        </section>
    );
}
