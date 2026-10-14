import React, { useState } from 'react';
import { Send, Sparkles, MessageCircle, Heart, Flame, Radio, Plus, Check, MapPin } from 'lucide-react';

export default function InteractiveFeedSimulator({ initialStreams = {}, links = {} }) {
    const [activeTab, setActiveTab] = useState('world');
    const [streams, setStreams] = useState(initialStreams);
    const [composerText, setComposerText] = useState('');
    const [selectedWard, setSelectedWard] = useState('Ward 19, Gulshan-2');

    const tabs = [
        { id: 'world', label: "World Stream", icon: '🌍', bn: 'সর্বজনীন টাইমলাইন' },
        { id: 'nearby', label: "Nearby Ward", icon: '📍', bn: 'ওয়ার্ড ও পাড়ার খবর' },
        { id: 'friends', label: "Friends & Circles", icon: '👥', bn: 'বন্ধুমহল' },
        { id: 'emergency_sos', label: "Emergency SOS", icon: '🚨', bn: 'নাগরিক সুরক্ষা' },
    ];

    const wardsList = [
        'Ward 19, Gulshan-2',
        'Ward 15, Dhanmondi',
        'Ward 04, Chittagong',
        'Ward 08, Sylhet Sadar',
        'Ward 02, Uttara',
    ];

    // Handle interactive reaction clicks
    const handleReaction = (postId, emoji) => {
        setStreams((prev) => {
            const currentStream = prev[activeTab] || [];
            const updated = currentStream.map((item) => {
                if (item.id === postId) {
                    const currentReactions = { ...item.reactions };
                    currentReactions[emoji] = (currentReactions[emoji] || 0) + 1;
                    return { ...item, reactions: currentReactions };
                }
                return item;
            });
            return { ...prev, [activeTab]: updated };
        });
    };

    // Handle interactive post creation
    const handleCreatePost = (e) => {
        e.preventDefault();
        if (!composerText.trim()) return;

        const newPost = {
            id: 'post_' + Date.now(),
            author: 'You (Sovereign Citizen)',
            handle: 'you.zengfy',
            initials: 'YOU',
            avatar_bg: 'bg-blue-600 text-white',
            ward: selectedWard,
            badge: 'Live Interactive',
            verified: true,
            time: 'Just now',
            text: composerText.trim(),
            reactions: { '❤️': 1, '🔥': 1 },
            comments_count: 0,
            is_new: true,
        };

        setStreams((prev) => ({
            ...prev,
            [activeTab]: [newPost, ...(prev[activeTab] || [])],
        }));

        setComposerText('');
    };

    const currentPosts = streams[activeTab] || [];

    return (
        <section id="interactive-streams-section" aria-label="Interactive Social Stream Simulator" className="pt-10 pb-20">
            <div className="max-w-4xl mx-auto px-4 sm:px-6">
                
                {/* Section Header */}
                <div className="text-center mb-8 sm:mb-10">
                    <span className="text-xs uppercase font-extrabold tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-200/70">
                        Interactive Social Stream Simulator
                    </span>
                    <h2 className="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight mt-3">
                        Experience Clean Public Discourse.
                    </h2>
                    <p className="text-sm sm:text-base text-slate-600 mt-2">
                        Switch between streams, test reactions in real-time, or share a simulated post to see how sovereign feeds work.
                    </p>
                </div>

                {/* 4-Stream Tab Switcher Pills */}
                <div role="tablist" aria-label="Social Feed Channels" className="flex items-center justify-start sm:justify-center gap-1.5 p-1.5 bg-slate-200/70 border border-slate-300/80 rounded-2xl mb-6 overflow-x-auto no-scrollbar shadow-xs">
                    {tabs.map((tab) => (
                        <button
                            key={tab.id}
                            type="button"
                            role="tab"
                            aria-selected={activeTab === tab.id}
                            onClick={() => setActiveTab(tab.id)}
                            className={`px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer whitespace-nowrap flex items-center gap-2 ${
                                activeTab === tab.id
                                    ? 'bg-white text-slate-900 shadow-sm border border-slate-200/90'
                                    : 'text-slate-600 hover:text-slate-900 hover:bg-white/50'
                            }`}
                        >
                            <span>{tab.icon}</span>
                            <span>{tab.label}</span>
                            {activeTab === tab.id && (
                                <span className="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse" />
                            )}
                        </button>
                    ))}
                </div>

                {/* Interactive Post Composer Simulator Card */}
                <div className="mb-6 glass-card rounded-3xl p-5 sm:p-6 border border-white/90 shadow-md">
                    <form onSubmit={handleCreatePost}>
                        <div className="flex items-start gap-3">
                            <div aria-hidden="true" className="w-10 h-10 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-xs text-white shadow-xs shrink-0 mt-0.5">
                                YOU
                            </div>
                            <div className="flex-1">
                                <label htmlFor="social-composer-input" className="sr-only">
                                    Compose a simulated social message
                                </label>
                                <textarea
                                    id="social-composer-input"
                                    rows="2"
                                    value={composerText}
                                    onChange={(e) => setComposerText(e.target.value)}
                                    placeholder={`Share an update to ${tabs.find(t => t.id === activeTab)?.label}...`}
                                    className="w-full bg-slate-50/80 hover:bg-white focus:bg-white rounded-2xl p-3.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 border border-slate-200 focus:border-blue-500 focus:outline-none transition resize-none shadow-2xs"
                                />

                                {/* Composer Bottom Controls */}
                                <div className="mt-3 flex flex-wrap items-center justify-between gap-2.5">
                                    <div className="flex items-center gap-2">
                                        <label htmlFor="ward-select" className="text-xs font-semibold text-slate-500 flex items-center gap-1">
                                            <MapPin className="w-3.5 h-3.5 text-blue-600" />
                                            <span>Ward:</span>
                                        </label>
                                        <select
                                            id="ward-select"
                                            value={selectedWard}
                                            onChange={(e) => setSelectedWard(e.target.value)}
                                            className="text-xs font-bold text-slate-700 bg-white border border-slate-200/90 rounded-xl px-2.5 py-1.5 focus:outline-none focus:border-blue-500 shadow-2xs cursor-pointer"
                                        >
                                            {wardsList.map((w) => (
                                                <option key={w} value={w}>{w}</option>
                                            ))}
                                        </select>
                                    </div>

                                    <button
                                        type="submit"
                                        disabled={!composerText.trim()}
                                        className={`px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 shadow-xs ${
                                            composerText.trim()
                                                ? 'bg-blue-600 hover:bg-blue-700 text-white cursor-pointer active:scale-95'
                                                : 'bg-slate-200 text-slate-400 cursor-not-allowed'
                                        }`}
                                    >
                                        <span>Share to Stream</span>
                                        <Send className="w-3 h-3" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {/* Posts Stream List */}
                <div className="space-y-4">
                    {currentPosts.map((post) => (
                        <article
                            key={post.id}
                            className={`glass-card rounded-3xl p-5 sm:p-6 transition-all border ${
                                post.is_new
                                    ? 'border-blue-400/80 bg-blue-50/20 shadow-md animate-in fade-in slide-in-from-top-4 duration-300'
                                    : 'border-white/80'
                            }`}
                        >
                            {/* Author Row */}
                            <div className="flex items-start justify-between gap-3 mb-3">
                                <div className="flex items-center gap-3">
                                    <div aria-hidden="true" className={`w-10 h-10 rounded-2xl ${post.avatar_bg} font-bold flex items-center justify-center text-xs shadow-2xs`}>
                                        {post.initials}
                                    </div>
                                    <div>
                                        <div className="flex items-center gap-1.5">
                                            <span className="text-sm font-bold text-slate-900">{post.author}</span>
                                            {post.verified && (
                                                <span aria-label="Verified Sovereign Citizen" className="w-4 h-4 rounded-full bg-blue-600 flex items-center justify-center text-[10px] text-white font-bold" title="Verified Citizen">
                                                    ✓
                                                </span>
                                            )}
                                        </div>
                                        <div className="text-xs text-slate-400 flex items-center gap-1.5">
                                            <span>@{post.handle}</span>
                                            <span>•</span>
                                            <span>{post.time}</span>
                                        </div>
                                    </div>
                                </div>

                                <div className="flex items-center gap-1.5">
                                    {post.badge && (
                                        <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200/60">
                                            {post.badge}
                                        </span>
                                    )}
                                    <span className="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 border border-slate-200/80">
                                        {post.ward}
                                    </span>
                                </div>
                            </div>

                            {/* Post Text */}
                            <p className="text-xs sm:text-sm text-slate-700 leading-relaxed font-normal mt-2">
                                {post.text}
                            </p>

                            {/* Reactions & Interaction Action Bar */}
                            <div className="mt-4 pt-3.5 border-t border-slate-200/60 flex flex-wrap items-center justify-between gap-3 text-xs">
                                
                                {/* Clickable Reaction Pills */}
                                <div className="flex flex-wrap items-center gap-1.5">
                                    {Object.entries(post.reactions || {}).map(([emoji, count]) => (
                                        <button
                                            key={emoji}
                                            type="button"
                                            onClick={() => handleReaction(post.id, emoji)}
                                            aria-label={`React with ${emoji}, currently ${count}`}
                                            className="bg-white/90 hover:bg-blue-50 border border-slate-200/80 rounded-full px-2.5 py-1 text-xs font-bold text-slate-700 flex items-center gap-1 shadow-2xs cursor-pointer transition-transform active:scale-115"
                                        >
                                            <span aria-hidden="true">{emoji}</span>
                                            <span>{count}</span>
                                        </button>
                                    ))}

                                    {/* Quick Emoji Picker Triggers */}
                                    {['❤️', '🔥', '👏', '💡'].filter(e => !(post.reactions && post.reactions[e])).map(emoji => (
                                        <button
                                            key={emoji}
                                            type="button"
                                            onClick={() => handleReaction(post.id, emoji)}
                                            aria-label={`Add ${emoji} reaction`}
                                            className="text-slate-400 hover:text-slate-700 text-xs px-1.5 py-1 rounded-full hover:bg-slate-100 transition-colors cursor-pointer"
                                        >
                                            {emoji}
                                        </button>
                                    ))}
                                </div>

                                {/* Comments & Join Thread Link */}
                                <div className="flex items-center gap-4 text-slate-500">
                                    <span className="flex items-center gap-1">
                                        <MessageCircle className="w-3.5 h-3.5 text-slate-400" />
                                        <span>{post.comments_count || 0}</span>
                                    </span>

                                    <a
                                        href={links.login || "http://zengfy.top:8000/login"}
                                        className="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors inline-flex items-center gap-1"
                                    >
                                        <span>Join Conversation</span>
                                        <span>→</span>
                                    </a>
                                </div>

                            </div>
                        </article>
                    ))}
                </div>

            </div>
        </section>
    );
}
