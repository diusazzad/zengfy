import React, { useState } from 'react';
import { 
    CreditCard, Wallet, Receipt, CheckCircle2, Clock, Sparkles, 
    ArrowRight, ShieldCheck, AlertCircle, Loader2, Building2, 
    Scale, GraduationCap, Globe, ShoppingBag, Plus, X, 
    ChevronRight, Download, Check, Shield
} from 'lucide-react';
import { cn } from '../../utils/cn';

export default function BillingManager({ initialBilling = null }) {
    const [billingData, setBillingData] = useState(initialBilling || {
        wallet_balance: 250.00,
        primary_payment_method: {
            type: 'bkash',
            name: 'bKash Wallet',
            account_number: '0171***429',
            is_default: true,
        },
        saved_methods: [
            { id: 'pm_1', type: 'bkash', name: 'bKash Wallet', masked: '0171***429', is_default: true },
            { id: 'pm_2', type: 'nagad', name: 'Nagad Account', masked: '0182***812', is_default: false },
            { id: 'pm_3', type: 'visa', name: 'City Bank Visa Debit', masked: '**** **** **** 4892', is_default: false },
        ],
        subscriptions: [
            {
                id: 'sub_social_badge',
                module: 'social',
                module_name: 'Zengfy Social',
                plan_name: 'ভেরিফাইড সিটিজেন ব্লু ব্যাজ (NID Verified)',
                price: '৳ ৫০',
                interval: 'মাসিক',
                status: 'active',
                status_label: 'সক্রিয় (Active)',
                status_color: 'emerald',
                badge: 'Verified Citizen',
                next_billing: '২০ নভেম্বর, ২০২৬',
                features: [
                    'ব্লু টিক ভেরিফাইড প্রোফাইল ও ট্রাস্ট ব্যাজ',
                    'হাইপারলোকাল ওয়ার্ড পোলে সরাসরি ভোটাধিকার',
                    'সোশ্যাল ফিডে প্রায়োরিটি অ্যালগরিদম প্লেসমেন্ট',
                ],
                auto_renew: true,
            },
            {
                id: 'sub_school_pro',
                module: 'school',
                module_name: 'Zengfy School ERP',
                tenant_name: 'ধানমন্ডি মডেল স্কুল ও কলেজ (Tenant)',
                plan_name: 'School Pro ERP (৫০০+ শিক্ষার্থী)',
                price: '৳ ১,৫০০',
                interval: 'মাসিক',
                status: 'active',
                status_label: 'সক্রিয় (Active)',
                status_color: 'emerald',
                next_billing: '০১ নভেম্বর, ২০২৬',
                features: [
                    'ডিজিটাল স্মার্ট হাজিরা ও স্বয়ংক্রিয় এসএমএস গেটওয়ে',
                    'অনলাইন ফি ও টিউশন কালেকশন রসিদ প্রিন্ট',
                    'টার্ম ফাইনাল গ্রেডিং ও ডিজিটাল মার্কশিট জেনারেটর',
                ],
                auto_renew: true,
            },
            {
                id: 'sub_law_trial',
                module: 'law',
                module_name: 'Zengfy Legal Practice',
                tenant_name: 'হোসাইন & অ্যাসোসিয়েটস ল চেম্বার',
                plan_name: 'Law Vault & Case Diary (১৪ দিনের ফ্রি ট্রায়াল)',
                price: '৳ ১,০০০',
                interval: 'মাসিক',
                status: 'trialing',
                status_label: 'ফ্রি ট্রায়াল (৪ দিন বাকি)',
                status_color: 'amber',
                next_billing: '২৫ অক্টোবর, ২০২৬ (ট্রায়াল সমাপ্ত)',
                features: [
                    'স্মার্ট কেস ডায়রি ও দৈনিক আদালতের কার্যতালিকা (Cause List)',
                    'ক্লায়েন্ট ফি ভল্ট ও আইনি ড্রাফট ডকুমেন্ট',
                    'কনফিডেনশিয়াল এনক্রিপ্টেড কেস আর্কাইভ',
                ],
                auto_renew: false,
            },
        ],
        invoices: [
            {
                id: 'inv_104',
                invoice_no: 'ZENG-INV-2026-104',
                product: 'Zengfy School ERP Pro Plan',
                date: '১০ অক্টোবর, ২০২৬',
                amount: '৳ ১,৫০০.০০',
                method: 'bKash (TrxID: 9X48194)',
                status: 'paid',
                status_label: 'পরিশোধিত (Paid)',
            },
            {
                id: 'inv_089',
                invoice_no: 'ZENG-INV-2026-089',
                product: 'Social Verified Citizen Badge',
                date: '১৫ সেপ্টেম্বর, ২০২৬',
                amount: '৳ ৫০.০০',
                method: 'Nagad (TrxID: NG83018)',
                status: 'paid',
                status_label: 'পরিশোধিত (Paid)',
            },
            {
                id: 'inv_042',
                invoice_no: 'ZENG-INV-2026-042',
                product: 'SMS Gateway Credit Pack (500 SMS)',
                date: '০১ সেপ্টেম্বর, ২০২৬',
                amount: '৳ ১২৫.০০',
                method: 'bKash (TrxID: 8B90184)',
                status: 'paid',
                status_label: 'পরিশোধিত (Paid)',
            },
        ],
    });

    const [paymentModalOpen, setPaymentModalOpen] = useState(false);
    const [selectedSubscription, setSelectedSubscription] = useState(null);
    const [selectedGateway, setSelectedGateway] = useState('bkash');
    const [isProcessingPayment, setIsProcessingPayment] = useState(false);
    const [paymentSuccessToast, setPaymentSuccessToast] = useState(null);

    const handleOpenPayment = (sub) => {
        setSelectedSubscription(sub);
        setPaymentModalOpen(true);
    };

    const handleConfirmPayment = () => {
        setIsProcessingPayment(true);
        setTimeout(() => {
            setIsProcessingPayment(false);
            setPaymentModalOpen(false);
            const trxId = 'TRX-' + Math.random().toString(36).substring(2, 8).toUpperCase() + '-' + selectedGateway.toUpperCase();
            
            if (selectedSubscription) {
                setBillingData(prev => ({
                    ...prev,
                    subscriptions: prev.subscriptions.map(s => 
                        s.id === selectedSubscription.id 
                            ? { ...s, status: 'active', status_label: 'সক্রিয় (Active)', status_color: 'emerald', next_billing: '২০ নভেম্বর, ২০২৭' }
                            : s
                    ),
                    invoices: [
                        {
                            id: 'inv_' + Date.now(),
                            invoice_no: 'ZENG-INV-2026-' + Math.floor(100 + Math.random() * 900),
                            product: selectedSubscription.plan_name,
                            date: 'আজ (মাত্র এইমাত্র)',
                            amount: selectedSubscription.price,
                            method: selectedGateway.toUpperCase() + ' (' + trxId + ')',
                            status: 'paid',
                            status_label: 'পরিশোধিত (Paid)',
                        },
                        ...prev.invoices
                    ]
                }));
            }

            setPaymentSuccessToast('পেমেন্ট সফলভাবে সম্পন্ন হয়েছে! ট্রানজ্যাকশন আইডি: ' + trxId);
            setTimeout(() => setPaymentSuccessToast(null), 6000);
        }, 1200);
    };

    return (
        <div className="space-y-6">
            {/* Success Toast */}
            {paymentSuccessToast && (
                <div className="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-semibold flex items-center justify-between shadow-sm animate-in fade-in slide-in-from-top-2">
                    <div className="flex items-center gap-2.5">
                        <CheckCircle2 className="w-5 h-5 text-emerald-600 shrink-0" />
                        <span>{paymentSuccessToast}</span>
                    </div>
                    <button type="button" onClick={() => setPaymentSuccessToast(null)} className="text-emerald-600 hover:text-emerald-800 cursor-pointer">
                        <X className="w-4 h-4" />
                    </button>
                </div>
            )}

            {/* Header Card (Google Style) */}
            <div className="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6 sm:p-8">
                <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div className="flex items-center gap-2.5 mb-1.5">
                            <div className="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <CreditCard className="w-5 h-5" />
                            </div>
                            <h2 className="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                পেমেন্ট ও সাবস্ক্রিপশন
                            </h2>
                            <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                Central Hub
                            </span>
                        </div>
                        <p className="text-xs sm:text-sm text-slate-500 max-w-2xl">
                            Zengfy ইকোসিস্টেমের সকল মাইক্রো-সাস (Social, School, Law, POS) সাবস্ক্রিপশন, পেমেন্ট মেথড এবং অফিশিয়াল ভ্যাট চালান একক সেন্ট্রাল হাব থেকে পরিচালনা করুন।
                        </p>
                    </div>

                    <div className="shrink-0 flex items-center gap-2">
                        <button
                            type="button"
                            onClick={() => alert('Zengfy অটো-বিলিং সিস্টেম চালু রয়েছে। বিকাশ ও কার্ড থেকে নির্ধারিত তারিখে স্বয়ংক্রিয়ভাবে রিনিউ হবে।')}
                            className="px-4 py-2 rounded-full border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all flex items-center gap-1.5 shadow-2xs cursor-pointer"
                        >
                            <ShieldCheck className="w-4 h-4 text-emerald-600" />
                            <span>অটো-বিলিং প্রোটেকশন</span>
                        </button>
                    </div>
                </div>

                {/* 3 Overview Stat Widgets */}
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6 pt-6 border-t border-slate-100">
                    {/* Widget 1: Primary Payment Method */}
                    <div className="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 flex flex-col justify-between">
                        <div>
                            <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                                ডিফল্ট পেমেন্ট মেথড
                            </span>
                            <div className="flex items-center gap-2.5 mt-1">
                                <div className="w-8 h-8 rounded-xl bg-pink-500 text-white font-black text-xs flex items-center justify-center shrink-0">
                                    বিকাশ
                                </div>
                                <div className="overflow-hidden">
                                    <p className="text-xs font-bold text-slate-900 truncate">bKash Personal</p>
                                    <p className="text-[11px] text-slate-500 font-mono">0171***429</p>
                                </div>
                            </div>
                        </div>
                        <div className="mt-3 pt-2.5 border-t border-slate-200/60 flex items-center justify-between">
                            <span className="text-[10px] text-emerald-600 font-semibold flex items-center gap-1">
                                <span className="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> ভেরিফাইড
                            </span>
                            <button type="button" onClick={() => alert('পেমেন্ট মেথড সেটিংস: বিকাশ, নগদ বা কার্ড পরিবর্তন করতে পারবেন।')} className="text-[11px] font-bold text-blue-600 hover:underline cursor-pointer">
                                পরিবর্তন &rarr;
                            </button>
                        </div>
                    </div>

                    {/* Widget 2: Active Subscriptions */}
                    <div className="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 flex flex-col justify-between">
                        <div>
                            <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                                সক্রিয় সাবস্ক্রিপশন
                            </span>
                            <div className="flex items-baseline gap-2 mt-1">
                                <span className="text-2xl font-black text-slate-900">৩টি</span>
                                <span className="text-xs text-slate-500 font-medium">লাইসেন্স রানিং</span>
                            </div>
                            <p className="text-[11px] text-slate-500 mt-1">Social, School ERP ও Law Vault</p>
                        </div>
                        <div className="mt-3 pt-2.5 border-t border-slate-200/60 flex items-center justify-between">
                            <span className="text-[10px] text-slate-400">পরবর্তী বিলিং: ১ নভেম্বর</span>
                            <span className="text-[10px] bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full">
                                অল গুড
                            </span>
                        </div>
                    </div>

                    {/* Widget 3: Zengfy Wallet */}
                    <div className="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 flex flex-col justify-between">
                        <div>
                            <span className="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                                Zengfy ওয়ালেট ব্যালেন্স
                            </span>
                            <div className="flex items-baseline gap-1 mt-1">
                                <span className="text-2xl font-black text-slate-900">৳ ২৫০.০০</span>
                            </div>
                            <p className="text-[11px] text-slate-500 mt-1">এসএমএস প্যাক বা ইনস্ট্যান্ট কন্টাক্ট রিলিজ</p>
                        </div>
                        <div className="mt-3 pt-2.5 border-t border-slate-200/60 flex items-center justify-between">
                            <span className="text-[10px] text-slate-400">অব্যবহৃত ব্যালেন্স</span>
                            <button type="button" onClick={() => alert('ওয়ালেট রিচার্জ ডেমো: বিকাশ বা নগদ দিয়ে যেকোনো মুহূর্তে রিচার্জ করা যাবে।')} className="text-[11px] font-bold text-blue-600 hover:underline cursor-pointer">
                                + রিচার্জ &rarr;
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {/* Active Subscriptions List */}
            <div className="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6 sm:p-8">
                <div className="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                    <div>
                        <h3 className="text-base font-bold text-slate-900">
                            চলমান সাবস্ক্রিপশন ও লাইসেন্সসমূহ (Active Subscriptions)
                        </h3>
                        <p className="text-xs text-slate-500 mt-0.5">
                            আপনার ব্যক্তিগত অ্যাকাউন্ট এবং প্রতিষ্ঠানের নামে নেওয়া একটিভ প্রোডাক্ট সার্ভিসসমূহ
                        </p>
                    </div>
                    <span className="text-xs font-bold px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                        {billingData.subscriptions.length} টি সার্ভিস
                    </span>
                </div>

                <div className="space-y-4">
                    {billingData.subscriptions.map((sub) => {
                        const isTrial = sub.status === 'trialing';
                        return (
                            <div 
                                key={sub.id} 
                                className={cn(
                                    "p-5 rounded-3xl border transition-all hover:shadow-md",
                                    isTrial ? "border-amber-200/80 bg-amber-50/30" : "border-slate-200/90 bg-white"
                                )}
                            >
                                <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div className="flex items-start gap-4">
                                        <div className={cn(
                                            "w-12 h-12 rounded-2xl flex items-center justify-center text-xl shrink-0 shadow-2xs",
                                            sub.module === 'social' ? 'bg-blue-50 text-blue-600' :
                                            sub.module === 'school' ? 'bg-amber-50 text-amber-600' : 'bg-indigo-50 text-indigo-600'
                                        )}>
                                            {sub.module === 'social' && <Globe className="w-6 h-6" />}
                                            {sub.module === 'school' && <GraduationCap className="w-6 h-6" />}
                                            {sub.module === 'law' && <Scale className="w-6 h-6" />}
                                        </div>

                                        <div>
                                            <div className="flex flex-wrap items-center gap-2">
                                                <h4 className="text-sm font-bold text-slate-900">
                                                    {sub.plan_name}
                                                </h4>
                                                <span className={cn(
                                                    "text-[10px] font-bold px-2 py-0.5 rounded-full border",
                                                    isTrial ? "bg-amber-100 text-amber-800 border-amber-300" : "bg-emerald-50 text-emerald-700 border-emerald-200"
                                                )}>
                                                    {sub.status_label}
                                                </span>
                                                {sub.badge && (
                                                    <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-100 flex items-center gap-1">
                                                        <ShieldCheck className="w-3 h-3" />
                                                        {sub.badge}
                                                    </span>
                                                )}
                                            </div>

                                            {sub.tenant_name && (
                                                <p className="text-xs font-semibold text-slate-600 mt-1 flex items-center gap-1.5">
                                                    <Building2 className="w-3.5 h-3.5 text-slate-400" />
                                                    <span>{sub.tenant_name}</span>
                                                </p>
                                            )}

                                            <div className="flex flex-wrap items-center gap-y-1 gap-x-4 mt-2 text-xs text-slate-500">
                                                <span className="font-bold text-slate-800 text-sm">{sub.price} <span className="text-xs font-normal text-slate-500">/ {sub.interval}</span></span>
                                                <span>•</span>
                                                <span>পরবর্তী বিলিং: <strong className="text-slate-700">{sub.next_billing}</strong></span>
                                                <span>•</span>
                                                <span>অটো-রিনিউ: <strong className={sub.auto_renew ? "text-emerald-600 font-bold" : "text-amber-600"}>{sub.auto_renew ? 'চালু' : 'বন্ধ'}</strong></span>
                                            </div>

                                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-1.5 mt-3 pt-3 border-t border-slate-100">
                                                {sub.features.map((feat, idx) => (
                                                    <div key={idx} className="flex items-center gap-1.5 text-[11px] text-slate-600">
                                                        <Check className="w-3.5 h-3.5 text-emerald-600 shrink-0" />
                                                        <span>{feat}</span>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    </div>

                                    <div className="shrink-0 flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-2 pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                                        <button
                                            type="button"
                                            onClick={() => handleOpenPayment(sub)}
                                            className={cn(
                                                "py-2 px-5 rounded-full text-xs font-bold transition-all shadow-xs cursor-pointer flex items-center gap-1.5",
                                                isTrial 
                                                    ? "bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/20"
                                                    : "bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/20"
                                            )}
                                        >
                                            <span>{isTrial ? 'প্রো প্ল্যানে আপগ্রেড করুন' : 'প্ল্যান রিনিউ / ম্যানেজ'}</span>
                                            <ArrowRight className="w-3.5 h-3.5" />
                                        </button>
                                        <span className="text-[10px] text-slate-400">
                                            {isTrial ? 'ট্রায়াল শেষ হতে ৪ দিন বাকি' : 'বিকাশ অটো-পে সমর্থিত'}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        );
                    })}
                </div>
            </div>

            {/* Catalog: Explore More SaaS Modules */}
            <div className="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6 sm:p-8">
                <div className="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                    <div>
                        <h3 className="text-base font-bold text-slate-900">
                            ইকোসিস্টেমের অন্যান্য প্রোডাক্ট প্ল্যান (Explore More SaaS)
                        </h3>
                        <p className="text-xs text-slate-500 mt-0.5">
                            আপনার প্রয়োজন অনুযায়ী যেসকল প্রোডাক্টে সাবস্ক্রিপশন নিতে পারেন
                        </p>
                    </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {/* Module 1: POS */}
                    <div className="p-5 rounded-2xl border border-slate-200/90 hover:border-blue-200 transition-all flex flex-col justify-between hover:shadow-xs group">
                        <div>
                            <div className="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                                <ShoppingBag className="w-5 h-5" />
                            </div>
                            <h4 className="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                Zengfy Retail POS
                            </h4>
                            <p className="text-xs text-slate-500 mt-1">
                                বারকোড বিলিং, ইনভেন্টরি ট্র্যাকিং, ক্যাশ ড্রয়ার ও ইনস্ট্যান্ট মেমো প্রিন্ট।
                            </p>
                            <div className="mt-3">
                                <span className="text-base font-black text-slate-900">৳ ৫০০</span>
                                <span className="text-xs text-slate-400"> / মাস</span>
                            </div>
                        </div>
                        <button 
                            type="button" 
                            onClick={() => handleOpenPayment({ id: 'pos_starter', plan_name: 'Zengfy Retail POS Starter', price: '৳ ৫০০', interval: 'মাসিক' })}
                            className="mt-4 w-full py-2 px-3 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-700 text-xs font-bold border border-slate-200/80 transition-all cursor-pointer"
                        >
                            সাবস্ক্রিপশন শুরু করুন
                        </button>
                    </div>

                    {/* Module 2: Civil 3D */}
                    <div className="p-5 rounded-2xl border border-slate-200/90 hover:border-blue-200 transition-all flex flex-col justify-between hover:shadow-xs group">
                        <div>
                            <div className="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-3">
                                <Building2 className="w-5 h-5" />
                            </div>
                            <h4 className="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                Civil Engineering 3D
                            </h4>
                            <p className="text-xs text-slate-500 mt-1">
                                আর্কিটেকচারাল ব্লুপ্রিন্ট, ৩D মডেল প্রিভিউয়ার ও সাইট মেটেরিয়াল ক্যালকুলেটর।
                            </p>
                            <div className="mt-3">
                                <span className="text-base font-black text-slate-900">৳ ২,০০০</span>
                                <span className="text-xs text-slate-400"> / মাস</span>
                            </div>
                        </div>
                        <button 
                            type="button" 
                            onClick={() => handleOpenPayment({ id: 'civil_pro', plan_name: 'Civil Engineering 3D Suite', price: '৳ ২,০০০', interval: 'মাসিক' })}
                            className="mt-4 w-full py-2 px-3 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-700 text-xs font-bold border border-slate-200/80 transition-all cursor-pointer"
                        >
                            ১৪ দিনের ট্রায়াল নিন
                        </button>
                    </div>

                    {/* Module 3: Enterprise All-in-One Bundle */}
                    <div className="p-5 rounded-2xl border border-blue-200 bg-gradient-to-br from-blue-50/50 to-indigo-50/40 flex flex-col justify-between hover:shadow-sm">
                        <div>
                            <div className="flex items-center justify-between mb-3">
                                <div className="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-xs">
                                    <Sparkles className="w-5 h-5" />
                                </div>
                                <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-600 text-white">
                                    ৬০% ছাড়
                                </span>
                            </div>
                            <h4 className="text-sm font-bold text-slate-900">
                                All-in-One Sovereign Suite
                            </h4>
                            <p className="text-xs text-slate-600 mt-1">
                                সোশ্যাল, স্কুল, ল, পস সহ সবগুলো ১৪টি প্ল্যাটফর্ম একক সাবস্ক্রিপশনে।
                            </p>
                            <div className="mt-3">
                                <span className="text-base font-black text-blue-700">৳ ২,৯৯৯</span>
                                <span className="text-xs text-slate-500"> / মাস</span>
                            </div>
                        </div>
                        <button 
                            type="button" 
                            onClick={() => handleOpenPayment({ id: 'bundle_all', plan_name: 'Zengfy All-in-One Sovereign Suite', price: '৳ ২,৯৯৯', interval: 'মাসিক' })}
                            className="mt-4 w-full py-2 px-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-xs cursor-pointer"
                        >
                            সম্পূর্ণ বান্ডেল আনলক করুন
                        </button>
                    </div>
                </div>
            </div>

            {/* Invoices & History (Google Style) */}
            <div className="rounded-3xl bg-white border border-slate-200/90 shadow-xs p-6 sm:p-8">
                <div className="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                    <div>
                        <h3 className="text-base font-bold text-slate-900">
                            লেনদেন হিস্ট্রি ও অফিশিয়াল চালান (Invoices & Receipts)
                        </h3>
                        <p className="text-xs text-slate-500 mt-0.5">
                            আপনার অতীতের সকল পেমেন্টের ভ্যাট চালান এবং ডাউনলোডযোগ্য রসিদ
                        </p>
                    </div>
                    <Receipt className="w-5 h-5 text-slate-400" />
                </div>

                <div className="overflow-x-auto">
                    <table className="w-full text-left text-xs">
                        <thead>
                            <tr className="border-b border-slate-100 text-slate-400 uppercase text-[10px] tracking-wider">
                                <th className="pb-3 font-bold">ইনভয়েস নম্বর</th>
                                <th className="pb-3 font-bold">প্রোডাক্ট / সার্ভিস</th>
                                <th className="pb-3 font-bold">তারিখ</th>
                                <th className="pb-3 font-bold">পদ্ধতি</th>
                                <th className="pb-3 font-bold">পরিমাণ</th>
                                <th className="pb-3 font-bold">স্ট্যাটাস</th>
                                <th className="pb-3 font-bold text-right">রসিদ</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-100">
                            {billingData.invoices.map((inv) => (
                                <tr key={inv.id} className="hover:bg-slate-50/60 transition-colors">
                                    <td className="py-3.5 font-mono font-bold text-slate-800">
                                        {inv.invoice_no}
                                    </td>
                                    <td className="py-3.5 font-semibold text-slate-800">
                                        {inv.product}
                                    </td>
                                    <td className="py-3.5 text-slate-500">
                                        {inv.date}
                                    </td>
                                    <td className="py-3.5 text-slate-600">
                                        {inv.method}
                                    </td>
                                    <td className="py-3.5 font-bold text-slate-900">
                                        {inv.amount}
                                    </td>
                                    <td className="py-3.5">
                                        <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            {inv.status_label}
                                        </span>
                                    </td>
                                    <td className="py-3.5 text-right">
                                        <button 
                                            type="button" 
                                            onClick={() => alert(`ইনভয়েস ${inv.invoice_no} ডাউনলোড হচ্ছে... (Demo PDF Receipt)`)}
                                            className="text-xs font-semibold text-blue-600 hover:underline inline-flex items-center gap-1 cursor-pointer"
                                        >
                                            <Download className="w-3.5 h-3.5" />
                                            <span>PDF</span>
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>

            {/* Interactive Payment Gateway Modal */}
            {paymentModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs animate-in fade-in duration-150">
                    <div className="bg-white rounded-3xl border border-slate-200/90 shadow-2xl max-w-md w-full p-6 animate-in zoom-in-95 duration-150">
                        <div className="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                            <div className="flex items-center gap-2">
                                <CreditCard className="w-5 h-5 text-blue-600" />
                                <h3 className="text-base font-bold text-slate-900">
                                    Zengfy সেন্ট্রাল পেমেন্ট গেটওয়ে
                                </h3>
                            </div>
                            <button type="button" onClick={() => setPaymentModalOpen(false)} className="text-slate-400 hover:text-slate-600 cursor-pointer">
                                <X className="w-5 h-5" />
                            </button>
                        </div>

                        {selectedSubscription && (
                            <div className="mb-5 p-4 rounded-2xl bg-blue-50/60 border border-blue-100">
                                <span className="text-[10px] font-bold uppercase text-blue-700 tracking-wider">সিলেক্টেড প্ল্যান</span>
                                <p className="text-sm font-bold text-slate-900 mt-0.5">{selectedSubscription.plan_name}</p>
                                <div className="flex items-baseline justify-between mt-2 pt-2 border-t border-blue-200/60">
                                    <span className="text-xs text-slate-600">পরিশোধযোগ্য মোট ফি:</span>
                                    <span className="text-lg font-black text-blue-700">{selectedSubscription.price}</span>
                                </div>
                            </div>
                        )}

                        <div className="space-y-2 mb-5">
                            <label className="block text-xs font-bold text-slate-700 mb-2">পেমেন্ট মাধ্যম বেছে নিন:</label>
                            
                            {/* bKash */}
                            <label className={cn(
                                "flex items-center justify-between p-3.5 rounded-2xl border cursor-pointer transition-all",
                                selectedGateway === 'bkash' ? "border-pink-500 bg-pink-50/40 ring-2 ring-pink-500/20" : "border-slate-200 hover:bg-slate-50"
                            )}>
                                <div className="flex items-center gap-3">
                                    <input type="radio" name="gateway" checked={selectedGateway === 'bkash'} onChange={() => setSelectedGateway('bkash')} className="text-pink-600" />
                                    <div>
                                        <p className="text-xs font-bold text-slate-900">bKash Personal / Merchant</p>
                                        <p className="text-[10px] text-slate-500">সেভড নম্বর: 0171***429 (১-ক্লিক পেমেন্ট)</p>
                                    </div>
                                </div>
                                <span className="text-xs font-black text-pink-600">বিকাশ</span>
                            </label>

                            {/* Nagad */}
                            <label className={cn(
                                "flex items-center justify-between p-3.5 rounded-2xl border cursor-pointer transition-all",
                                selectedGateway === 'nagad' ? "border-amber-500 bg-amber-50/40 ring-2 ring-amber-500/20" : "border-slate-200 hover:bg-slate-50"
                            )}>
                                <div className="flex items-center gap-3">
                                    <input type="radio" name="gateway" checked={selectedGateway === 'nagad'} onChange={() => setSelectedGateway('nagad')} className="text-amber-600" />
                                    <div>
                                        <p className="text-xs font-bold text-slate-900">Nagad Payment</p>
                                        <p className="text-[10px] text-slate-500">অটো ওটিপি ও পিন ভেরিফিকেশন</p>
                                    </div>
                                </div>
                                <span className="text-xs font-black text-amber-600">নগদ</span>
                            </label>

                            {/* Visa / Master */}
                            <label className={cn(
                                "flex items-center justify-between p-3.5 rounded-2xl border cursor-pointer transition-all",
                                selectedGateway === 'card' ? "border-blue-500 bg-blue-50/40 ring-2 ring-blue-500/20" : "border-slate-200 hover:bg-slate-50"
                            )}>
                                <div className="flex items-center gap-3">
                                    <input type="radio" name="gateway" checked={selectedGateway === 'card'} onChange={() => setSelectedGateway('card')} className="text-blue-600" />
                                    <div>
                                        <p className="text-xs font-bold text-slate-900">Debit / Credit Card</p>
                                        <p className="text-[10px] text-slate-500">ভিসা, মাস্টারকার্ড ও নেক্সাস-পে</p>
                                    </div>
                                </div>
                                <span className="text-xs font-bold text-blue-600">Cards</span>
                            </label>

                            {/* Zengfy Wallet */}
                            <label className={cn(
                                "flex items-center justify-between p-3.5 rounded-2xl border cursor-pointer transition-all",
                                selectedGateway === 'wallet' ? "border-indigo-500 bg-indigo-50/40 ring-2 ring-indigo-500/20" : "border-slate-200 hover:bg-slate-50"
                            )}>
                                <div className="flex items-center gap-3">
                                    <input type="radio" name="gateway" checked={selectedGateway === 'wallet'} onChange={() => setSelectedGateway('wallet')} className="text-indigo-600" />
                                    <div>
                                        <p className="text-xs font-bold text-slate-900">Zengfy ওয়ালেট ব্যালেন্স</p>
                                        <p className="text-[10px] text-slate-500">বর্তমান ব্যালেন্স: ৳ ২৫০.০০</p>
                                    </div>
                                </div>
                                <span className="text-xs font-bold text-indigo-600">Wallet</span>
                            </label>
                        </div>

                        <div className="flex items-center gap-3">
                            <button
                                type="button"
                                onClick={() => setPaymentModalOpen(false)}
                                className="flex-1 py-2.5 px-4 rounded-full border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-all cursor-pointer"
                            >
                                বাতিল
                            </button>
                            <button
                                type="button"
                                onClick={handleConfirmPayment}
                                disabled={isProcessingPayment}
                                className="flex-1 py-2.5 px-4 rounded-full bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-md shadow-blue-500/20 flex items-center justify-center gap-2 cursor-pointer"
                            >
                                {isProcessingPayment ? (
                                    <>
                                        <Loader2 className="w-4 h-4 animate-spin" />
                                        <span>প্রসেসিং হচ্ছে...</span>
                                    </>
                                ) : (
                                    <>
                                        <span>নিশ্চিত ও পেমেন্ট করুন</span>
                                    </>
                                )}
                            </button>
                        </div>
                    </div>
                </div>
            )}

        </div>
    );
}
