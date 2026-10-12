import React, { useState } from 'react';
import { Scale, Search, FileText, Send, CheckCircle2, Clock, MapPin, User, AlertCircle, BookOpen, Sparkles, Printer } from 'lucide-react';

export default function InteractiveCauseListSimulator({ simulatorData = {} }) {
    const sampleCase = simulatorData.sample_case || {};
    const feed = simulatorData.cause_list_feed || [];
    const smsDraft = simulatorData.sms_draft || "";

    const [searchQuery, setSearchQuery] = useState('১২৮/২০২৬');
    const [selectedCase, setSelectedCase] = useState(sampleCase);
    const [showVakalatnama, setShowVakalatnama] = useState(false);
    const [smsSent, setSmsSent] = useState(false);
    const [searchStatus, setSearchStatus] = useState('');

    const handleSearch = (e) => {
        e.preventDefault();
        if (!searchQuery.trim()) return;

        if (searchQuery.includes('১২৮') || searchQuery.includes('কাদের') || searchQuery.includes('সিভিল')) {
            setSelectedCase(sampleCase);
            setSearchStatus('✓ মামলা শনাক্ত হয়েছে: জেলা ও দায়রা জজ আদালত, চট্টগ্রাম (কোর্ট নং ৩)');
        } else if (searchQuery.includes('৪১৫০') || searchQuery.includes('রিট')) {
            setSelectedCase({
                case_no: 'রিট পিটিশন নং ৪১৫০/২০২৫',
                case_type: 'সংবিধানিক রিট মোশন',
                court: 'বাংলাদেশ সুপ্রিম কোর্ট, হাইকোর্ট বিভাগ (বেঞ্চ নং ১৪)',
                advocate: 'ব্যারিস্টার নাজমুল হুদা',
                advocate_bar: 'সুপ্রিম কোর্ট বার অ্যাসোসিয়েশন',
                next_hearing: 'আগামীকাল, সকাল ১০:৪৫ মিনিট',
                hearing_stage: 'রুল শুনানি ও অন্তর্বর্তীকালীন আদেশ',
                client_name: 'মেঘনা টেক্সটাইল মিলস লিমিটেড',
                client_phone: '01819-332110',
                opposite_party: 'বনাম বাংলাদেশ সরকার ও অন্যান্য',
                serial_no: '০৫ নং কজলিস্ট তালিকাভুক্ত',
                status: 'Passed Over',
            });
            setSearchStatus('✓ মামলা শনাক্ত হয়েছে: হাইকোর্ট বিভাগ (বেঞ্চ নং ১৪)');
        } else {
            setSelectedCase(sampleCase);
            setSearchStatus('✓ ডেমো মামলা লোড হয়েছে');
        }
        setTimeout(() => setSearchStatus(''), 4000);
    };

    const handleSendSms = () => {
        setSmsSent(true);
        setTimeout(() => setSmsSent(false), 5000);
    };

    return (
        <section id="simulator-section" className="py-16 md:py-24 relative overflow-hidden bg-stone-100/70 border-y border-stone-200">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div className="text-center max-w-3xl mx-auto mb-12">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-rose-100/80 border border-rose-200 text-[#881337] text-xs font-bold uppercase tracking-wider mb-3">
                        <Scale className="w-4 h-4 text-[#881337]" />
                        <span>Interactive Court Cause List Sandbox</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        লাইভ কজলিস্ট সার্চ ও ওকালতনামা সিমুলেটর 📜
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        মামলা নম্বর বা মক্কেলের নাম দিয়ে কজলিস্ট ট্র্যাক করুন, সেকেন্ডে কোর্ট ওকালতনামা প্রস্তুত করুন এবং মক্কেলকে শুনানি এসএমএস পাঠান।
                    </p>
                </div>

                {searchStatus && (
                    <div className="max-w-xl mx-auto mb-6 p-3 rounded-2xl bg-rose-50 border border-rose-200 text-[#881337] font-bold text-center text-xs sm:text-sm animate-in fade-in zoom-in-95 duration-200 flex items-center justify-center gap-2 shadow-xs">
                        <Sparkles className="w-4 h-4 text-amber-600" />
                        <span>{searchStatus}</span>
                    </div>
                )}
                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    {/* LEFT PANEL: Cause List Search & Daily Bench Feed (6 Cols) */}
                    <div className="lg:col-span-6 space-y-6">
                        
                        {/* Search Bar */}
                        <div className="p-5 rounded-3xl bg-white border border-stone-200/90 shadow-sm text-left">
                            <form onSubmit={handleSearch} className="flex gap-2">
                                <div className="relative flex-1">
                                    <Search className="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-stone-400" />
                                    <input
                                        type="text"
                                        value={searchQuery}
                                        onChange={(e) => setSearchQuery(e.target.value)}
                                        placeholder="মামলা নং (যেমন: ১২৮/২০২৬) বা মক্কেলের নাম..."
                                        className="w-full pl-11 pr-4 py-3 rounded-2xl bg-stone-50 border border-stone-200 focus:bg-white focus:border-[#881337] focus:outline-none text-xs sm:text-sm font-semibold text-slate-900 transition"
                                    />
                                </div>
                                <button
                                    type="submit"
                                    className="px-5 py-3 rounded-2xl bg-[#881337] hover:bg-rose-900 text-white font-bold text-xs sm:text-sm shadow-md shadow-rose-950/20 active:scale-95 transition cursor-pointer shrink-0"
                                >
                                    সার্চ করুন
                                </button>
                            </form>

                            <div className="mt-2.5 flex items-center gap-2 text-[11px] text-stone-500">
                                <span>কুইক ডেমো টেস্ট:</span>
                                <button
                                    type="button"
                                    onClick={() => { setSearchQuery('১২৮/২০২৬'); setSelectedCase(sampleCase); }}
                                    className="px-2 py-0.5 rounded-md bg-stone-100 hover:bg-rose-100 text-stone-700 hover:text-[#881337] transition cursor-pointer font-bold"
                                >
                                    ১২৮/২০২৬ (চট্টগ্রাম জজ কোর্ট)
                                </button>
                                <button
                                    type="button"
                                    onClick={() => { setSearchQuery('৪১৫০/২০২৫'); handleSearch({ preventDefault: () => {} }); }}
                                    className="px-2 py-0.5 rounded-md bg-stone-100 hover:bg-rose-100 text-stone-700 hover:text-[#881337] transition cursor-pointer font-bold"
                                >
                                    ৪১৫০/২০২৫ (হাইকোর্ট)
                                </button>
                            </div>
                        </div>

                        {/* Daily Court Cause List Feed */}
                        <div className="p-5 sm:p-6 rounded-3xl bg-white border border-stone-200/90 shadow-sm text-left">
                            <div className="flex items-center justify-between pb-3 border-b border-stone-100">
                                <div>
                                    <h4 className="text-sm sm:text-base font-black text-slate-900 flex items-center gap-2">
                                        <Clock className="w-4 h-4 text-[#881337]" />
                                        <span>দৈনিক কজলিস্ট লাইভ স্ক্র্যাপার ফিড</span>
                                    </h4>
                                    <p className="text-xs text-stone-500">
                                        আজকের তালিকাভুক্ত মামলার বেঞ্চ স্ট্যাটাস
                                    </p>
                                </div>
                                <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                    লাইভ সিঙ্ক
                                </span>
                            </div>

                            <div className="mt-4 space-y-3">
                                {feed.map((item, idx) => (
                                    <div
                                        key={idx}
                                        onClick={() => {
                                            if (item.case_no.includes('১২৮')) setSelectedCase(sampleCase);
                                            else handleSearch({ preventDefault: () => {} });
                                        }}
                                        className="p-3.5 rounded-2xl bg-stone-50 hover:bg-rose-50/50 border border-stone-200 hover:border-rose-200 transition cursor-pointer flex items-start justify-between gap-3"
                                    >
                                        <div className="space-y-1">
                                            <div className="flex items-center gap-2">
                                                <span className="text-xs font-black px-2 py-0.5 rounded bg-stone-200 text-slate-800 font-mono">
                                                    ক্রমিক: {item.serial}
                                                </span>
                                                <span className="text-xs font-black text-slate-900">
                                                    {item.case_no}
                                                </span>
                                            </div>
                                            <div className="text-[11px] text-stone-600 font-medium">
                                                {item.bench}
                                            </div>
                                            <div className="text-[10px] text-stone-500">
                                                পর্যায়: {item.stage} • সময়: {item.time}
                                            </div>
                                        </div>

                                        <span className={`text-[10px] font-extrabold px-2 py-1 rounded-lg shrink-0 ${
                                            item.status.includes('Ready')
                                                ? 'bg-emerald-100 text-emerald-800'
                                                : 'bg-amber-100 text-amber-800'
                                        }`}>
                                            {item.status}
                                        </span>
                                    </div>
                                ))}
                            </div>
                        </div>

                    </div>

                    {/* RIGHT PANEL: Case Detail Card + Vakalatnama & SMS Actions (6 Cols) */}
                    <div className="lg:col-span-6 space-y-6">
                        
                        {/* Court Case File Card */}
                        <div className="p-6 rounded-3xl bg-white border border-stone-200/90 shadow-md text-left space-y-5">
                            
                            {/* Card Top */}
                            <div className="flex items-start justify-between gap-3 pb-4 border-b border-stone-100">
                                <div>
                                    <span className="text-xs font-extrabold px-2.5 py-1 rounded-full bg-rose-50 text-[#881337] border border-rose-200/80">
                                        {selectedCase.case_type || "দেওয়ানি মামলা"}
                                    </span>
                                    <h3 className="mt-2 text-lg sm:text-xl font-black text-slate-900">
                                        {selectedCase.case_no}
                                    </h3>
                                    <p className="text-xs text-stone-500 font-semibold mt-0.5">
                                        {selectedCase.opposite_party}
                                    </p>
                                </div>

                                <div className="text-right">
                                    <span className="text-xs font-extrabold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                                        {selectedCase.status}
                                    </span>
                                    <div className="text-[11px] font-bold text-stone-500 mt-1">
                                        {selectedCase.serial_no}
                                    </div>
                                </div>
                            </div>

                            {/* Details Grid */}
                            <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                <div className="p-3 rounded-2xl bg-stone-50 border border-stone-100 space-y-0.5">
                                    <div className="text-stone-400 font-bold text-[10px]">আদালত ও বেঞ্চ:</div>
                                    <div className="font-extrabold text-slate-800 leading-snug">{selectedCase.court}</div>
                                </div>
                                <div className="p-3 rounded-2xl bg-stone-50 border border-stone-100 space-y-0.5">
                                    <div className="text-stone-400 font-bold text-[10px]">পরবর্তী শুনানির তারিখ:</div>
                                    <div className="font-black text-[#881337]">{selectedCase.next_hearing}</div>
                                </div>
                                <div className="p-3 rounded-2xl bg-stone-50 border border-stone-100 space-y-0.5">
                                    <div className="text-stone-400 font-bold text-[10px]">নিযুক্ত আইনজীবী:</div>
                                    <div className="font-extrabold text-slate-800">{selectedCase.advocate}</div>
                                    <div className="text-[10px] text-stone-500">{selectedCase.advocate_bar}</div>
                                </div>
                                <div className="p-3 rounded-2xl bg-stone-50 border border-stone-100 space-y-0.5">
                                    <div className="text-stone-400 font-bold text-[10px]">মক্কেল ও যোগাযোগ:</div>
                                    <div className="font-extrabold text-slate-800">{selectedCase.client_name}</div>
                                    <div className="text-[10px] text-stone-500">{selectedCase.client_phone}</div>
                                </div>
                            </div>

                            {/* 2 Flagship Interactive Action Buttons */}
                            <div className="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <button
                                    type="button"
                                    onClick={() => setShowVakalatnama(!showVakalatnama)}
                                    className="py-3 px-4 rounded-2xl bg-[#881337] hover:bg-rose-900 text-white font-extrabold text-xs shadow-md shadow-rose-950/20 active:scale-95 transition flex items-center justify-center gap-2 cursor-pointer"
                                >
                                    <FileText className="w-4 h-4 text-amber-300" />
                                    <span>{showVakalatnama ? 'ওকালতনামা ড্রাফট বন্ধ করুন' : '১-ক্লিক ওকালতনামা ড্রাফট'}</span>
                                </button>

                                <button
                                    type="button"
                                    onClick={handleSendSms}
                                    className={`py-3 px-4 rounded-2xl font-extrabold text-xs transition flex items-center justify-center gap-2 cursor-pointer ${
                                        smsSent
                                            ? 'bg-emerald-600 text-white'
                                            : 'bg-stone-900 hover:bg-stone-800 text-white shadow-xs'
                                    }`}
                                >
                                    <Send className="w-4 h-4 text-emerald-400" />
                                    <span>{smsSent ? 'SMS পাঠানো হয়েছে!' : 'মক্কেলকে হেয়ারিং SMS পাঠান'}</span>
                                </button>
                            </div>

                            {/* Vakalatnama Preview Modal Box */}
                            {showVakalatnama && (
                                <div className="mt-4 p-5 rounded-2xl bg-amber-50/70 border border-amber-300 text-stone-800 font-serif text-xs leading-relaxed space-y-3 animate-in fade-in duration-200">
                                    <div className="text-center pb-2 border-b border-amber-200">
                                        <div className="font-black text-sm uppercase text-[#881337]">
                                            বাংলাদেশ সুপ্রিম কোর্ট / জেলা আদালত ওকালতনামা
                                        </div>
                                        <div className="text-[10px] text-stone-500 font-sans">
                                            দ্যা বাংলাদেশ লিগ্যাল প্র্যাকটিশনার্স অ্যান্ড বার কাউন্সিল অর্ডার ১৯৭২
                                        </div>
                                    </div>
                                    <p className="text-[11px]">
                                        মামলা নং: <strong>{selectedCase.case_no}</strong>, আদালত: <strong>{selectedCase.court}</strong>।
                                        আমি/আমরা নিম্নলিখিত মোকদ্দমায় আমার/আমাদের পক্ষে ওকালতি ও সওয়াল-জওয়াব করিবার জন্য <strong>{selectedCase.advocate}</strong>-কে ক্ষমতা অর্পণ করিলাম।
                                    </p>
                                    <div className="flex justify-between items-end pt-3 text-[10px] font-sans">
                                        <div>মক্কেল: <strong>{selectedCase.client_name}</strong></div>
                                        <div className="text-right text-[#881337] font-bold">
                                            ✓ ডিজিটাল এনআইডি ও সিল স্বাক্ষরিত
                                        </div>
                                    </div>
                                </div>
                            )}

                            {/* Hearing SMS Draft Preview */}
                            <div className="mt-4 p-4 rounded-2xl bg-stone-50 border border-stone-200 text-xs text-stone-700 space-y-1.5">
                                <div className="flex items-center justify-between text-[11px] font-bold text-stone-500">
                                    <span>মক্কেলের মোবাইল SMS নোটিশ প্রিভিউ:</span>
                                    <span> প্রাপক: {selectedCase.client_phone}</span>
                                </div>
                                <div className="p-3 rounded-xl bg-white border border-stone-200/80 font-mono text-[11px] leading-relaxed text-slate-900">
                                    "{smsDraft}"
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    );
}