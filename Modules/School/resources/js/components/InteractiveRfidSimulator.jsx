import React, { useState } from 'react';
import { Radio, Smartphone, CheckCircle, Wifi, ShieldAlert, Clock, ArrowRight, Zap, RefreshCw, Send, Bell } from 'lucide-react';

export default function InteractiveRfidSimulator({ demoData = {} }) {
    const [mode, setMode] = useState('in'); // 'in' (Entry) or 'out' (Exit)
    const [isPunched, setIsPunched] = useState(false);
    const [isScanning, setIsScanning] = useState(false);
    const [punchCount, setPunchCount] = useState(1);
    const [lastTime, setLastTime] = useState('08:02 AM');

    const handleTapCard = () => {
        setIsScanning(true);
        setIsPunched(false);

        // Optional subtle Web Audio pleasant beep
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(880, ctx.currentTime); // A5 note
            gain.gain.setValueAtTime(0.15, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.18);
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start();
            osc.stop(ctx.currentTime + 0.2);
        } catch {
            // Audio policy fallback
        }

        setTimeout(() => {
            setIsScanning(false);
            setIsPunched(true);
            setPunchCount(prev => prev + 1);
            if (mode === 'in') {
                setLastTime('08:02 AM');
            } else {
                setLastTime('02:15 PM');
            }
        }, 600);
    };

    const smsMessage = mode === 'in'
        ? 'সৌম্য সকাল ৮:০২ মিনিটে নিরাপদে মতিঝিল মডেল স্কুল ক্যাম্পাসে প্রবেশ করেছে। (শ্রেণী: ৮ম, রোল: ১২)'
        : 'সৌম্য দুপুর ২:১৫ মিনিটে স্কুল ক্যাম্পাস থেকে প্রস্থান করেছে। শুভ প্রত্যাবর্তন! (শ্রেণী: ৮ম, রোল: ১২)';

    return (
        <section id="rfid-simulator-section" aria-labelledby="rfid-demo-heading" className="py-12 sm:py-16">
            
            {/* Header with Emotive Pitch */}
            <div className="text-center max-w-3xl mx-auto mb-10 sm:mb-14">
                <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-3">
                    <Radio className="w-3.5 h-3.5 text-emerald-600 animate-pulse" />
                    <span>ইন্টারেক্টিভ আরএফআইডি সিমুলেটর</span>
                </div>
                <h2 id="rfid-demo-heading" className="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                    সন্তান স্কুলে পৌঁছামাত্রই{' '}
                    <span className="bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                        মা-বাবার ফোনে স্বস্তির মেসেজ
                    </span>
                </h2>
                <p className="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    নিচের স্মার্ট কার্ডে ক্লিক করে লাইভ দেখুন—শিক্ষার্থী গেটের স্ক্যানারে কার্ড ছোঁয়ামাত্র কীভাবে ১ সেকেন্ডে অভিভাবকের মোবাইলে স্বয়ংক্রিয় এসএমএস পৌঁছায়।
                </p>

                {/* Mode Selector Toggle */}
                <div className="mt-6 inline-flex p-1.5 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
                    <button
                        type="button"
                        onClick={() => { setMode('in'); setIsPunched(false); }}
                        className={`px-5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer ${
                            mode === 'in'
                                ? 'bg-emerald-600 text-white shadow-xs'
                                : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'
                        }`}
                    >
                        ☀️ সকালের প্রবেশ হাজিরা (08:02 AM)
                    </button>
                    <button
                        type="button"
                        onClick={() => { setMode('out'); setIsPunched(false); }}
                        className={`px-5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer ${
                            mode === 'out'
                                ? 'bg-indigo-600 text-white shadow-xs'
                                : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'
                        }`}
                    >
                        🏫 ছুটির প্রস্থান হাজিরা (02:15 PM)
                    </button>
                </div>
            </div>

            {/* Interactive Stage (Card Reader vs Parent's Phone) */}
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center max-w-6xl mx-auto">
                
                {/* Left Column: Smart RFID Student Card & Gate Reader Mockup (7 cols) */}
                <div className="lg:col-span-7 flex flex-col items-center">
                    
                    {/* The Physical Gate Reader Stand */}
                    <div className="w-full max-w-md p-6 sm:p-8 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/90 shadow-xl relative overflow-hidden">
                        
                        {/* Top Hardware Status Bar */}
                        <div className="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                            <div className="flex items-center gap-2">
                                <span className={`w-3 h-3 rounded-full ${isScanning ? 'bg-amber-500 animate-ping' : isPunched ? 'bg-emerald-500' : 'bg-slate-400'}`} />
                                <span className="text-xs font-bold text-slate-700">গেট টার্মিনাল #০১ (Main Entrance)</span>
                            </div>
                            <div className="flex items-center gap-2 text-[11px] font-mono text-slate-500">
                                <Wifi className="w-3.5 h-3.5 text-emerald-600" />
                                <span>অফলাইন মেশ সিঙ্ক</span>
                            </div>
                        </div>

                        {/* Visual Smart RFID Student Card */}
                        <div
                            onClick={handleTapCard}
                            role="button"
                            tabIndex="0"
                            onKeyDown={(e) => { if (e.key === 'Enter' || e.key === ' ') handleTapCard(); }}
                            title="কার্ড পাঞ্চ করতে ক্লিক করুন"
                            className={`w-full p-5 sm:p-6 rounded-2xl bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white border transition-all duration-300 cursor-pointer select-none relative overflow-hidden group shadow-lg ${
                                isScanning
                                    ? 'ring-4 ring-emerald-400 scale-[0.98]'
                                    : 'hover:scale-[1.02] hover:shadow-2xl hover:border-emerald-400/80 border-slate-700'
                            }`}
                        >
                            {/* Card Watermark */}
                            <div className="absolute right-[-20px] bottom-[-20px] text-8xl font-black text-white/5 pointer-events-none">
                                ZG
                            </div>

                            <div className="flex items-start justify-between">
                                <div>
                                    <span className="text-[10px] font-black tracking-widest text-emerald-400 uppercase">
                                        স্মার্ট স্টুডেন্ট আইডি কার্ড
                                    </span>
                                    <div className="text-xs text-slate-300 font-semibold mt-0.5">
                                        মতিঝিল মডেল স্কুল অ্যান্ড কলেজ
                                    </div>
                                </div>
                                <div className="w-9 h-7 rounded-md bg-amber-400/90 border border-amber-300 flex items-center justify-center shadow-xs">
                                    <div className="w-6 h-4 border border-amber-800/40 rounded-xs grid grid-cols-2 gap-0.5" />
                                </div>
                            </div>

                            <div className="mt-5 flex items-center gap-4">
                                <div className="w-14 h-14 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 flex items-center justify-center text-2xl font-bold border-2 border-emerald-400 shadow-sm shrink-0">
                                    👨‍🎓
                                </div>
                                <div className="min-w-0">
                                    <div className="text-base sm:text-lg font-black tracking-tight text-white truncate">
                                        সৌম্য আহমেদ
                                    </div>
                                    <div className="text-xs text-emerald-300 font-medium">
                                        শ্রেণী: ৮ম | শাখা: ক | রোল: ১২
                                    </div>
                                    <div className="text-[11px] font-mono text-slate-400 mt-0.5">
                                        ID: ZG-SCH-2026-0812
                                    </div>
                                </div>
                            </div>

                            <div className="mt-4 pt-3 border-t border-slate-700/80 flex items-center justify-between text-xs">
                                <div className="flex items-center gap-1.5 text-slate-300">
                                    <Radio className="w-3.5 h-3.5 text-emerald-400 animate-pulse" />
                                    <span>RFID Contactless</span>
                                </div>
                                <span className="text-emerald-400 font-bold group-hover:translate-x-1 transition-transform flex items-center gap-1">
                                    কার্ড পাঞ্চ করুন <ArrowRight className="w-3 h-3" />
                                </span>
                            </div>

                            {/* Ripple Effect Ring when tapped */}
                            {isScanning && (
                                <div className="absolute inset-0 bg-emerald-500/20 backdrop-blur-xs flex items-center justify-center animate-pulse">
                                    <span className="text-sm font-bold text-white bg-emerald-600 px-3 py-1 rounded-full shadow-md">
                                        স্ক্যান হচ্ছে...
                                    </span>
                                </div>
                            )}
                        </div>

                        {/* Gate Scanner Feedback */}
                        <div className="mt-5 text-center">
                            <button
                                type="button"
                                onClick={handleTapCard}
                                disabled={isScanning}
                                className="w-full py-3.5 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-300 text-white font-black text-sm tracking-wide shadow-md shadow-emerald-500/20 hover:shadow-lg transition-all flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <Zap className="w-4 h-4" />
                                <span>{isScanning ? 'স্ক্যান সম্পন্ন হচ্ছে...' : '👉 এখানে ক্লিক করে কার্ড পাঞ্চ করুন'}</span>
                            </button>
                            <p className="mt-2 text-[11px] text-slate-500">
                                টিপস: কার্ডের উপর ক্লিক করলেও লাইভ পাঞ্চ অ্যাকশন ট্রিগার হবে
                            </p>
                        </div>

                    </div>

                </div>

                {/* Right Column: Parent's Smartphone Mockup with Real-time SMS (5 cols) */}
                <div className="lg:col-span-5 flex flex-col items-center">
                    
                    <div className="w-full max-w-[340px] rounded-[42px] p-3.5 bg-slate-900 shadow-2xl border-4 border-slate-800 relative">
                        
                        {/* Phone Top Speaker & Camera Notch */}
                        <div className="w-28 h-4 bg-slate-900 rounded-full mx-auto mb-2 flex items-center justify-center">
                            <div className="w-2.5 h-2.5 rounded-full bg-slate-800" />
                        </div>

                        {/* Phone Screen Canvas */}
                        <div className="w-full min-h-[460px] rounded-[32px] bg-gradient-to-b from-slate-100 to-slate-200 p-4 flex flex-col justify-between overflow-hidden relative">
                            
                            {/* Screen Status Bar */}
                            <div className="flex items-center justify-between text-[11px] font-semibold text-slate-700 px-2 pt-1">
                                <span>{lastTime}</span>
                                <div className="flex items-center gap-1.5">
                                    <Wifi className="w-3 h-3 text-slate-700" />
                                    <span>5G</span>
                                    <span>100%</span>
                                </div>
                            </div>

                            {/* Middle Notification Area */}
                            <div className="my-auto space-y-3 py-6">
                                
                                {/* Lockscreen Clock */}
                                <div className="text-center">
                                    <div className="text-4xl font-extrabold text-slate-800 font-mono tracking-tight">
                                        {lastTime}
                                    </div>
                                    <div className="text-xs text-slate-500 font-medium">
                                        বুধবার, ১২ অক্টোবর ২০২৬
                                    </div>
                                </div>

                                {/* Instant Parent SMS Notification Box */}
                                <div
                                    className={`p-3.5 rounded-2xl bg-white/95 backdrop-blur-xl border shadow-lg transition-all duration-500 ${
                                        isPunched
                                            ? 'border-emerald-300 ring-2 ring-emerald-500/30 scale-100 opacity-100'
                                            : 'border-slate-200 scale-95 opacity-80'
                                    }`}
                                >
                                    <div className="flex items-center justify-between pb-1.5 border-b border-slate-100">
                                        <div className="flex items-center gap-1.5">
                                            <div className="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px] font-bold">
                                                Z
                                            </div>
                                            <span className="text-xs font-black text-slate-800">
                                                ZENGFY-SMS
                                            </span>
                                            <span className="text-[9px] bg-slate-100 text-slate-600 px-1.5 py-0.2 rounded font-semibold">
                                                Masked
                                            </span>
                                        </div>
                                        <span className="text-[10px] text-emerald-600 font-bold flex items-center gap-1">
                                            <Clock className="w-2.5 h-2.5" />
                                            {isPunched ? 'এইমাত্র' : '08:02 AM'}
                                        </span>
                                    </div>

                                    {/* SMS Text Body */}
                                    <p className="mt-2 text-xs text-slate-800 leading-relaxed font-medium">
                                        {smsMessage}
                                    </p>

                                    <div className="mt-2 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-500">
                                        <span className="flex items-center gap-1 text-emerald-700 font-semibold">
                                            <CheckCircle className="w-3 h-3 text-emerald-600" />
                                            ডেলিভারি সম্পন্ন (০.৮ সেকেন্ড)
                                        </span>
                                        <span className="font-mono text-slate-400">Govt Reg: #1982</span>
                                    </div>
                                </div>

                                {isPunched && (
                                    <div className="p-2.5 rounded-xl bg-emerald-50/90 border border-emerald-200 text-center animate-in fade-in duration-300">
                                        <span className="text-[11px] font-bold text-emerald-800 flex items-center justify-center gap-1.5">
                                            <Bell className="w-3 h-3 text-emerald-600" />
                                            অভিভাবকের উদ্বেগ দূর! মা-বাবা নিশ্চিন্ত।
                                        </span>
                                    </div>
                                )}

                            </div>

                            {/* Bottom Swipe Indicator */}
                            <div className="text-center pb-2">
                                <div className="w-28 h-1 bg-slate-400/80 rounded-full mx-auto" />
                                <span className="text-[10px] text-slate-500 font-medium mt-1 block">
                                    অভিভাবকের অ্যান্ড্রয়েড / আইফোন স্ক্রিন
                                </span>
                            </div>

                        </div>

                    </div>

                    <div className="mt-4 text-center">
                        <span className="text-xs font-bold text-slate-600 inline-flex items-center gap-1.5">
                            <ShieldAlert className="w-3.5 h-3.5 text-emerald-600" />
                            <span>ইন্টারনেট না থাকলেও অফলাইন বাফারিং ব্যাকআপ সচল থাকে</span>
                        </span>
                    </div>

                </div>

            </div>

        </section>
    );
}
