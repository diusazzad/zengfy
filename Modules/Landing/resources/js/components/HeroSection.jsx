import React, { useState } from 'react';
import { ShieldCheck, Lock, Sparkles, Send, ArrowRight, Heart, Flame, Smartphone, Check } from 'lucide-react';

export default function HeroSection({ ecosystem = {}, links = {}, onExploreApps }) {
    const [messages, setMessages] = useState([
        {
            id: 1,
            author: 'Rahim Chowdhury',
            handle: 'rahim_c',
            initials: 'RC',
            avatarBg: 'bg-blue-100 text-blue-700',
            time: '10:14 AM',
            text: 'Hey! Have you tried the new sovereign ecosystem on Zengfy?',
            isOutgoing: false,
            reactions: { '❤️': 14, '🔥': 6 },
        },
        {
            id: 2,
            author: 'Sovereign Citizen',
            handle: 'me',
            initials: 'SC',
            avatarBg: 'bg-emerald-100 text-emerald-700',
            time: '10:15 AM',
            text: 'Yes! One unified login unlocks everything — encrypted messaging, school ERP, and retail POS. Zero commercial ad tracking!',
            isOutgoing: true,
            reactions: { '❤️': 28, '🔥': 12 },
        },
        {
            id: 3,
            author: 'Farhana Islam',
            handle: 'farhana_edu',
            initials: 'FI',
            avatarBg: 'bg-indigo-100 text-indigo-700',
            time: '10:16 AM',
            text: 'Our school migrated to Zengfy School ERP. RFID attendance & report cards work like magic! 🏫✨',
            isOutgoing: false,
            reactions: { '❤️': 19 },
        },
    ]);

    const [inputVal, setInputVal] = useState('');

    const handleSendMessage = (e) => {
        e.preventDefault();
        if (!inputVal.trim()) return;

        const newMsg = {
            id: Date.now(),
            author: 'You',
            handle: 'you',
            initials: 'YO',
            avatarBg: 'bg-blue-600 text-white',
            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
            text: inputVal.trim(),
            isOutgoing: true,
            reactions: { '❤️': 1 },
        };

        setMessages((prev) => [...prev, newMsg]);
        setInputVal('');
    };

    const handleAddReaction = (msgId, emoji) => {
        setMessages((prev) =>
            prev.map((msg) => {
                if (msg.id === msgId) {
                    const currentCount = msg.reactions[emoji] || 0;
                    return {
                        ...msg,
                        reactions: {
                            ...msg.reactions,
                            [emoji]: currentCount + 1,
                        },
                    };
                }
                return msg;
            })
        );
    };

    return (
        <section id="hero-section" aria-label="Hero Overview" className="relative pt-6 sm:pt-14 pb-16 sm:pb-24">
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                {/* Left Column: Bold Headline & CTAs */}
                <div className="lg:col-span-7 text-left space-y-6 sm:space-y-7">
                    
                    {/* Privacy Badge */}
                    <div className="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-panel-subtle text-slate-700 text-xs sm:text-sm font-semibold shadow-xs">
                        <span aria-hidden="true" className="w-2.5 h-2.5 rounded-full bg-blue-600 animate-pulse" />
                        <span className="text-blue-700 font-bold">Privacy First</span>
                        <span aria-hidden="true" className="text-slate-300">•</span>
                        <span>Sovereign Citizen Infrastructure</span>
                    </div>

                    {/* Bold Headline */}
                    <h1 className="text-5xl sm:text-6xl md:text-7xl font-black tracking-tight text-slate-900 leading-[1.05]">
                        Speak Freely<span className="text-blue-600">.</span>
                    </h1>

                    {/* Subheadlines */}
                    <p className="text-xl sm:text-2xl text-slate-600 font-normal leading-relaxed max-w-2xl">
                        Say &ldquo;hello&rdquo; to a different messaging experience. An unexpected focus on privacy, combined with all of the modular features you expect.
                    </p>

                    <p className="text-sm sm:text-base text-slate-500 font-medium leading-relaxed max-w-xl">
                        কোনো বাণিজ্যিক নজরদারি বা ট্র্যাকিং নেই — সার্বভৌম নাগরিক পরিচয়ে সম্পূর্ণ নিরাপদ, দ্রুত ও স্বাধীন সোশ্যাল নেটওয়ার্ক এবং ১৪টি ক্লাউড সেবা।
                    </p>

                    {/* Action CTAs */}
                    <div className="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 sm:gap-4 max-w-lg">
                        <a
                            href={links.social || "http://social.zengfy.test:8000"}
                            className="px-8 py-4 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-base sm:text-lg shadow-xl shadow-blue-500/25 hover:shadow-2xl hover:shadow-blue-500/35 active:scale-95 transition-all inline-flex items-center justify-center gap-2.5 min-h-[54px]"
                        >
                            <span>Get Started</span>
                            <ArrowRight aria-hidden="true" className="w-5 h-5 text-blue-200" />
                        </a>

                        <a
                            href={links.download || "/download"}
                            className="px-6 py-4 rounded-full glass-panel hover:bg-white text-slate-800 font-bold text-sm sm:text-base border border-white/80 transition-all inline-flex items-center justify-center gap-2.5 min-h-[54px]"
                        >
                            <Smartphone aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                            <span>Download Android APK</span>
                        </a>
                    </div>

                    {/* Trust Pillars */}
                    <div className="pt-4 flex flex-wrap items-center gap-5 sm:gap-7 text-xs sm:text-sm text-slate-500 font-semibold">
                        <div className="flex items-center gap-2">
                            <ShieldCheck aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                            <span>End-to-End Encrypted</span>
                        </div>
                        <div className="flex items-center gap-2">
                            <Lock aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                            <span>No Ads or Trackers</span>
                        </div>
                        <div className="flex items-center gap-2">
                            <Sparkles aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                            <span>100% Free Forever</span>
                        </div>
                    </div>

                </div>

                {/* Right Column: Signal-Style White Glassmorphic Live Chat Preview */}
                <div className="lg:col-span-5 relative" aria-label="Interactive Social Chat Preview">
                    
                    {/* Ambient Glow Behind Mockup Frame */}
                    <div aria-hidden="true" className="absolute -inset-4 bg-gradient-to-tr from-blue-300/30 via-indigo-200/25 to-cyan-200/30 rounded-3xl blur-2xl opacity-80" />

                    {/* Floating Pill Top Right */}
                    <div className="absolute -top-3.5 -right-2 sm:-right-4 z-20 glass-panel px-3.5 py-1.5 rounded-full border border-white/90 shadow-md text-xs font-bold text-slate-800 flex items-center gap-2">
                        <span aria-hidden="true" className="w-2 h-2 rounded-full bg-emerald-500 animate-ping" />
                        <span>🔒 256-Bit Encrypted</span>
                    </div>

                    {/* Floating Pill Bottom Left */}
                    <div className="absolute -bottom-3.5 -left-2 sm:-left-4 z-20 glass-panel px-3.5 py-1.5 rounded-full border border-white/90 shadow-md text-xs font-bold text-slate-800 flex items-center gap-2">
                        <span aria-hidden="true" className="text-blue-600 font-bold">⚡</span>
                        <span>Zero Data Harvesting</span>
                    </div>

                    {/* Glass Device Preview Box */}
                    <div className="bg-white/75 backdrop-blur-2xl rounded-3xl p-5 sm:p-6 border border-white/90 shadow-2xl ring-1 ring-slate-900/5 relative z-10 overflow-hidden">
                        
                        {/* Chat Header */}
                        <div className="flex items-center justify-between pb-4 border-b border-slate-200/70 mb-5">
                            <div className="flex items-center gap-3">
                                <div className="relative">
                                    <div aria-hidden="true" className="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-xs">
                                        Z
                                    </div>
                                    <span aria-hidden="true" className="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-emerald-500 border-2 border-white" />
                                </div>
                                <div>
                                    <div className="flex items-center gap-1.5">
                                        <h2 className="text-sm font-bold text-slate-900">Zengfy Social Circle</h2>
                                        <span aria-label="Verified Citizen" className="text-blue-600 text-xs font-bold" title="Verified Sovereign Citizen">✓</span>
                                    </div>
                                    <p className="text-[11px] text-emerald-600 font-medium flex items-center gap-1">
                                        <span aria-hidden="true">•</span>
                                        <span>Private End-to-End Feed</span>
                                    </p>
                                </div>
                            </div>
                            <span className="text-[10px] font-mono font-semibold px-2 py-0.5 rounded-md bg-slate-100 text-slate-500">
                                Live Interactive
                            </span>
                        </div>

                        {/* Interactive Message Stream */}
                        <div className="space-y-4 max-h-[300px] overflow-y-auto pr-1">
                            {messages.map((msg) => (
                                <div
                                    key={msg.id}
                                    className={`flex ${msg.isOutgoing ? 'flex-col items-end' : 'items-start gap-2.5'}`}
                                >
                                    {!msg.isOutgoing && (
                                        <div aria-hidden="true" className={`w-7 h-7 rounded-full ${msg.avatarBg} font-bold flex items-center justify-center text-[10px] shrink-0 mt-0.5`}>
                                            {msg.initials}
                                        </div>
                                    )}

                                    <div
                                        className={`rounded-2xl px-4 py-2.5 max-w-[85%] text-xs sm:text-sm ${
                                            msg.isOutgoing
                                                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-tr-sm shadow-md'
                                                : 'bg-white/90 text-slate-800 rounded-tl-sm border border-white/80 shadow-xs'
                                        }`}
                                    >
                                        {!msg.isOutgoing && (
                                            <span className="text-[10px] font-bold text-slate-500 block mb-0.5">
                                                {msg.author}
                                            </span>
                                        )}
                                        <p className="leading-relaxed">{msg.text}</p>
                                        <div
                                            className={`text-[9px] mt-1 text-right flex items-center justify-end gap-1 ${
                                                msg.isOutgoing ? 'text-blue-200' : 'text-slate-400'
                                            }`}
                                        >
                                            <span>{msg.time}</span>
                                            {msg.isOutgoing && <span aria-label="Delivered and read">• ✓✓</span>}
                                        </div>
                                    </div>

                                    {/* Clickable Reactions Pill */}
                                    <div className={`flex items-center gap-1.5 mt-1 ${msg.isOutgoing ? 'mr-2' : 'ml-9'}`}>
                                        {Object.entries(msg.reactions).map(([emoji, count]) => (
                                            <button
                                                key={emoji}
                                                type="button"
                                                onClick={() => handleAddReaction(msg.id, emoji)}
                                                aria-label={`React with ${emoji}, currently ${count} reactions`}
                                                className="bg-white/90 hover:bg-blue-50 rounded-full px-2 py-0.5 text-[11px] shadow-2xs border border-slate-200/70 flex items-center gap-1 cursor-pointer transition-transform active:scale-110"
                                            >
                                                <span aria-hidden="true">{emoji}</span>
                                                <span className="text-[10px] font-bold text-slate-700">{count}</span>
                                            </button>
                                        ))}
                                        <button
                                            type="button"
                                            onClick={() => handleAddReaction(msg.id, '❤️')}
                                            aria-label="Add heart reaction"
                                            className="text-[10px] text-slate-400 hover:text-red-500 px-1 py-0.5 transition-colors cursor-pointer"
                                            title="Add Reaction"
                                        >
                                            +
                                        </button>
                                    </div>
                                </div>
                            ))}
                        </div>

                        {/* Interactive Message Input Box */}
                        <form onSubmit={handleSendMessage} className="mt-5 pt-3 border-t border-slate-200/70 flex items-center gap-2">
                            <label htmlFor="chat-mock-input" className="sr-only">
                                Type a message to test interactive chat
                            </label>
                            <input
                                id="chat-mock-input"
                                type="text"
                                value={inputVal}
                                onChange={(e) => setInputVal(e.target.value)}
                                placeholder="Type a message to test..."
                                className="flex-1 bg-white/90 hover:bg-white rounded-full px-4 py-2 text-xs text-slate-800 placeholder-slate-400 border border-slate-200/80 focus:border-blue-500 focus:outline-none transition shadow-2xs"
                            />
                            <button
                                type="submit"
                                aria-label="Send message in live preview"
                                className="w-8 h-8 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center shrink-0 shadow-xs transition active:scale-95 cursor-pointer"
                            >
                                <Send aria-hidden="true" className="w-3.5 h-3.5" />
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </section>
    );
}
