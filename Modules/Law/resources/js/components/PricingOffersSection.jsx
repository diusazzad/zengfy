import React, { useState } from 'react';
import { Check, ArrowRight, HelpCircle, ChevronDown, ChevronUp, Scale, PhoneCall, Sparkles } from 'lucide-react';

export default function PricingOffersSection({ pricing = [], faq = [], links = {} }) {
    const [openFaq, setOpenFaq] = useState(null);

    return (
        <section id="pricing-section" className="py-16 md:py-24 relative overflow-hidden bg-white">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                {/* Header */}
                <div className="text-center max-w-3xl mx-auto mb-14">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-50 border border-rose-200/80 text-[#881337] text-xs font-bold uppercase tracking-wider mb-3">
                        <Scale className="w-4 h-4 text-[#881337]" />
                        <span>Transparent Legal Chamber Pricing</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        চেম্বারের গোপনীয়তা ও স্বাচ্ছন্দ্য অনুযায়ী প্যাকেজ 💳
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        ক্লাউড সাবস্ক্রিপশন অথবা আইনজীবীর নিজস্ব ল্যাপটপে আজীবন গোপনীয় ডাটাবেজ—পছন্দ সম্পূর্ণ আপনার।
                    </p>
                </div>

                {/* 3-Tier Commercial Pricing Cards */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 items-stretch mb-20">
                    {pricing.map((tier) => (
                        <div
                            key={tier.id}
                            className={`p-6 sm:p-8 rounded-3xl border flex flex-col justify-between transition-all duration-300 relative text-left ${
                                tier.is_popular
                                    ? 'bg-gradient-to-b from-rose-900/10 via-white to-rose-900/5 border-[#881337] shadow-xl ring-2 ring-rose-900/20 md:-translate-y-2'
                                    : 'bg-white border-stone-200/90 shadow-sm hover:shadow-md'
                            }`}
                        >
                            {tier.is_popular && (
                                <div className="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-[#881337] via-rose-800 to-amber-700 text-white text-[11px] font-black uppercase tracking-wider shadow-md">
                                    {tier.badge}
                                </div>
                            )}

                            <div>
                                <div className="flex items-center justify-between">
                                    <h3 className="text-xl font-black text-slate-900">
                                        {tier.name_bn || tier.name}
                                    </h3>
                                    {!tier.is_popular && tier.badge && (
                                        <span className="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-stone-100 text-stone-600">
                                            {tier.badge}
                                        </span>
                                    )}
                                </div>

                                <p className="text-xs text-stone-500 mt-2 min-h-[36px]">
                                    {tier.desc}
                                </p>

                                <div className="mt-5 pb-5 border-b border-stone-100">
                                    <div className="flex items-baseline gap-1">
                                        <span className="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                                            {tier.price}
                                        </span>
                                        <span className="text-xs font-semibold text-stone-500">
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
                                            ? 'bg-gradient-to-r from-[#881337] via-rose-800 to-amber-700 hover:from-rose-900 hover:to-amber-800 text-white shadow-rose-950/25 active:scale-95'
                                            : 'bg-stone-900 hover:bg-stone-800 text-white active:scale-95'
                                    }`}
                                >
                                    <span>{tier.cta}</span>
                                    <ArrowRight className="w-4 h-4" />
                                </a>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Consultation Hotline Strip */}
                <div className="max-w-3xl mx-auto mb-16 p-5 sm:p-6 rounded-3xl bg-amber-50/70 border border-amber-200 text-left flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div className="flex items-center gap-3">
                        <div className="w-12 h-12 rounded-2xl bg-amber-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                            <PhoneCall className="w-6 h-6" />
                        </div>
                        <div>
                            <div className="font-black text-sm text-slate-900">
                                চেম্বার অন-সাইট ইনস্টলেশন ও ডেমো সহায়তা
                            </div>
                            <div className="text-xs text-stone-600">
                                সুপ্রিম কোর্ট বার বা জেলা বার ভবনে সরাসরি প্রতিনিধির সহায়তা পেতে যোগাযোগ করুন।
                            </div>
                        </div>
                    </div>
                    <a
                        href="tel:+8801700000000"
                        className="px-5 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shrink-0 shadow-xs transition"
                    >
                        হটলাইনে কল করুন
                    </a>
                </div>

                {/* FAQ Accordion */}
                <div className="max-w-3xl mx-auto text-left">
                    <div className="text-center mb-8">
                        <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-stone-100 text-stone-700 text-xs font-bold mb-2">
                            <HelpCircle className="w-3.5 h-3.5" />
                            <span>Legal Chamber FAQ</span>
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
                                    className="rounded-2xl border border-stone-200/90 bg-white shadow-2xs overflow-hidden transition"
                                >
                                    <button
                                        type="button"
                                        onClick={() => setOpenFaq(isOpen ? null : idx)}
                                        className="w-full p-4 sm:p-5 flex items-center justify-between gap-4 text-left font-bold text-sm sm:text-base text-slate-900 hover:text-[#881337] cursor-pointer"
                                    >
                                        <span>{item.q}</span>
                                        {isOpen ? (
                                            <ChevronUp className="w-4 h-4 text-[#881337] shrink-0" />
                                        ) : (
                                            <ChevronDown className="w-4 h-4 text-stone-400 shrink-0" />
                                        )}
                                    </button>

                                    {isOpen && (
                                        <div className="px-5 pb-5 text-xs sm:text-sm text-stone-600 leading-relaxed border-t border-stone-100 pt-3 animate-in fade-in duration-200">
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