import React, { useState } from 'react';
import { Check, ArrowRight, HelpCircle, ChevronDown, ChevronUp, Calculator, Sparkles } from 'lucide-react';

export default function PricingOffersSection({ pricing = [], faq = [], links = {} }) {
    const [openFaq, setOpenFaq] = useState(null);
    const [dailySales, setDailySales] = useState(25000);

    const timeSavedHrs = (dailySales / 12000).toFixed(1);
    const dueRecoveryTk = Math.round(dailySales * 0.15);

    return (
        <section id="pricing-section" className="py-16 md:py-24 relative overflow-hidden bg-white">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                {/* 1. Header */}
                <div className="text-center max-w-3xl mx-auto mb-14">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-50 border border-amber-200/80 text-amber-800 text-xs font-bold uppercase tracking-wider mb-3">
                        <Sparkles className="w-4 h-4 text-amber-600" />
                        <span>Transparent Retail Pricing</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        কোনো গোপন ফি নেই • বার্ষিক স্বচ্ছ প্যাকেজ 💳
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        লাখ টাকার জটিল সফ্টওয়্যার নয়—মাত্র ৳৮,০০০/বছরে (৳৬৬৬/মাস) সম্পূর্ণ ফ্যাশন পিওএস ও ইনভেন্টরি।
                    </p>
                </div>

                {/* 2. Interactive ROI Calculator */}
                <div className="max-w-3xl mx-auto mb-16 p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-transparent border border-amber-200/80 shadow-sm text-left">
                    <div className="flex items-center gap-2.5 mb-4">
                        <div className="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center shadow-xs">
                            <Calculator className="w-5 h-5" />
                        </div>
                        <div>
                            <h3 className="text-base sm:text-lg font-black text-slate-900">
                                সময় ও বকেয়া টাকা বাঁচানোর লাইভ ক্যালকুলেটর
                            </h3>
                            <p className="text-xs text-slate-500">
                                আপনার শোরুমের দৈনিক সেলস দিয়ে হিসেব দেখুন
                            </p>
                        </div>
                    </div>

                    <div className="space-y-3">
                        <div className="flex justify-between items-center text-sm font-bold text-slate-800">
                            <span>দোকানে দৈনিক গড় বিক্রি:</span>
                            <span className="text-base font-black text-amber-700 font-mono">
                                ৳{dailySales.toLocaleString()}
                            </span>
                        </div>
                        <input
                            type="range"
                            min="5000"
                            max="100000"
                            step="5000"
                            value={dailySales}
                            onChange={(e) => setDailySales(Number(e.target.value))}
                            className="w-full accent-amber-600 cursor-pointer"
                        />
                        <div className="flex justify-between text-[11px] text-slate-400 font-mono">
                            <span>৳৫,০০০</span>
                            <span>৳৫০,০০০</span>
                            <span>৳১,০০,০০০</span>
                        </div>
                    </div>

                    <div className="mt-6 pt-5 border-t border-amber-200/60 grid grid-cols-1 sm:grid-cols-3 gap-3 text-center">
                        <div className="p-3 rounded-2xl bg-white border border-amber-100 shadow-2xs">
                            <div className="text-xs text-slate-500 font-medium">ক্যাশ কাউন্টারে সময় বাঁচবে</div>
                            <div className="text-lg font-black text-slate-900 mt-1">~{timeSavedHrs} ঘণ্টা / দিন</div>
                        </div>
                        <div className="p-3 rounded-2xl bg-white border border-amber-100 shadow-2xs">
                            <div className="text-xs text-slate-500 font-medium">বিকাশ SMS বকেয়া আদায়</div>
                            <div className="text-lg font-black text-emerald-600 mt-1">~৳{dueRecoveryTk.toLocaleString()} / মাস</div>
                        </div>
                        <div className="p-3 rounded-2xl bg-white border border-amber-100 shadow-2xs">
                            <div className="text-xs text-slate-500 font-medium">Zengfy POS খরচ মাত্র</div>
                            <div className="text-lg font-black text-amber-700 mt-1">৳২২ / দিন</div>
                        </div>
                    </div>
                </div>

                {/* 3. 3-Tier Commercial Pricing Cards */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 items-stretch mb-20">
                    {pricing.map((tier) => (
                        <div
                            key={tier.id}
                            className={`p-6 sm:p-8 rounded-3xl border flex flex-col justify-between transition-all duration-300 relative text-left ${
                                tier.is_popular
                                    ? 'bg-gradient-to-b from-amber-500/10 via-white to-amber-500/5 border-amber-400 shadow-xl ring-2 ring-amber-500/20 md:-translate-y-2'
                                    : 'bg-white border-slate-200/90 shadow-sm hover:shadow-md'
                            }`}
                        >
                            {tier.is_popular && (
                                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-amber-600 to-rose-600 text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                                    {tier.badge}
                                </div>
                            )}

                            <div>
                                <div className="flex items-center justify-between">
                                    <h3 className="text-xl font-black text-slate-900">
                                        {tier.name_bn || tier.name}
                                    </h3>
                                    {!tier.is_popular && tier.badge && (
                                        <span className="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600">
                                            {tier.badge}
                                        </span>
                                    )}
                                </div>

                                <p className="text-xs text-slate-500 mt-2 min-h-[36px]">
                                    {tier.desc}
                                </p>

                                <div className="mt-5 pb-5 border-b border-slate-100">
                                    <div className="flex items-baseline gap-1">
                                        <span className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                                            {tier.price}
                                        </span>
                                        <span className="text-xs font-semibold text-slate-500">
                                            {tier.billing}
                                        </span>
                                    </div>
                                </div>

                                {/* Features List */}
                                <ul className="mt-6 space-y-3">
                                    {tier.features.map((feat, fIdx) => (
                                        <li key={fIdx} className="flex items-start gap-2.5 text-xs sm:text-sm text-slate-700 font-medium">
                                            <div className="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                                <Check className="w-2.5 h-2.5" />
                                            </div>
                                            <span>{feat}</span>
                                        </li>
                                    ))}
                                </ul>
                            </div>

                            <div className="mt-8 pt-4">
                                <a
                                    href={links.register || "/register"}
                                    className={`w-full py-3.5 rounded-2xl font-extrabold text-xs sm:text-sm transition flex items-center justify-center gap-2 cursor-pointer shadow-md ${
                                        tier.is_popular
                                            ? 'bg-gradient-to-r from-amber-600 via-orange-600 to-rose-600 hover:from-amber-700 hover:to-rose-700 text-white shadow-orange-500/25 active:scale-95'
                                            : 'bg-slate-900 hover:bg-slate-800 text-white active:scale-95'
                                    }`}
                                >
                                    <span>{tier.cta}</span>
                                    <ArrowRight className="w-4 h-4" />
                                </a>
                            </div>
                        </div>
                    ))}
                </div>

                {/* 4. FAQ Accordion */}
                <div className="max-w-3xl mx-auto text-left">
                    <div className="text-center mb-8">
                        <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold mb-2">
                            <HelpCircle className="w-3.5 h-3.5" />
                            <span>Frequently Asked Questions</span>
                        </div>
                        <h3 className="text-2xl font-black text-slate-900">
                            সচরাচর জিজ্ঞাসিত প্রশ্নাবলী (FAQ) ❓
                        </h3>
                    </div>

                    <div className="space-y-3">
                        {faq.map((item, idx) => {
                            const isOpen = openFaq === idx;
                            return (
                                <div
                                    key={idx}
                                    className="rounded-2xl border border-slate-200/90 bg-white shadow-2xs overflow-hidden transition"
                                >
                                    <button
                                        type="button"
                                        onClick={() => setOpenFaq(isOpen ? null : idx)}
                                        className="w-full p-4 sm:p-5 flex items-center justify-between gap-4 text-left font-bold text-sm sm:text-base text-slate-900 hover:text-amber-700 cursor-pointer"
                                    >
                                        <span>{item.q}</span>
                                        {isOpen ? (
                                            <ChevronUp className="w-4 h-4 text-amber-600 shrink-0" />
                                        ) : (
                                            <ChevronDown className="w-4 h-4 text-slate-400 shrink-0" />
                                        )}
                                    </button>

                                    {isOpen && (
                                        <div className="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3 animate-in fade-in duration-200">
                                            {item.a}
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