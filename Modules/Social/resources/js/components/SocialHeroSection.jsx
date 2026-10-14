import React from 'react';
import { ShieldCheck, Smartphone, ArrowRight, Sparkles, Radio, Users, CheckCircle2 } from 'lucide-react';

export default function SocialHeroSection({ brand = {}, stats = {}, links = {}, onExploreStreams }) {
    return (
        <section id="social-hero-section" aria-label="Social Hero Overview" className="relative pt-8 sm:pt-16 pb-16 sm:pb-22 text-center max-w-5xl mx-auto">
            
            {/* Live Sentinel Status Pill */}
            <div className="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-panel-subtle text-slate-700 text-xs sm:text-sm font-semibold mb-6 shadow-xs">
                <span aria-hidden="true" className="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse" />
                <span className="text-blue-700 font-bold">Verified Citizen Network</span>
                <span aria-hidden="true" className="text-slate-300">•</span>
                <span>Zero Bots</span>
                <span aria-hidden="true" className="text-slate-300">•</span>
                <span>Hyperlocal Ward Mesh</span>
            </div>

            {/* Bold Headline */}
            <h1 className="text-4xl sm:text-6xl md:text-7xl font-black tracking-tight text-slate-900 leading-[1.08] max-w-4xl mx-auto">
                Real People. <br />
                <span className="bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 bg-clip-text text-transparent">
                    Real Communities.
                </span> <br />
                Zero Noise<span className="text-blue-600">.</span>
            </h1>

            {/* Subheadlines in English & Bengali */}
            <p className="mt-5 text-base sm:text-xl text-slate-600 font-normal leading-relaxed max-w-2xl mx-auto">
                The next-generation sovereign social network for Bangladesh. Experience authentic neighborhood discussions, civic emergency SOS beacons, and close friends timeline under one unified sovereign account.
            </p>

            <p className="mt-3 text-sm sm:text-base text-blue-700 font-semibold leading-relaxed max-w-xl mx-auto">
                কোনো অ্যালগরিদমিক অপপ্রচার বা ট্র্যাকিং নেই — সত্যিকারে যাচাইকৃত বাংলাদেশি নাগরিকদের সম্পূর্ণ নিরাপদ, নিরপেক্ষ ও স্বাধীন সামাজিক নেটওয়ার্ক।
            </p>

            {/* Action CTAs */}
            <div className="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3.5 sm:gap-4 max-w-md mx-auto">
                <a
                    href={links.login || "http://zengfy.top:8000/login"}
                    className="w-full sm:w-auto px-8 py-4 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-sm sm:text-base shadow-xl shadow-blue-500/25 hover:shadow-2xl hover:shadow-blue-500/35 active:scale-95 transition-all inline-flex items-center justify-center gap-2.5 min-h-[52px]"
                >
                    <span>Join Citizen Network</span>
                    <ArrowRight aria-hidden="true" className="w-5 h-5 text-blue-200" />
                </a>

                <a
                    href={links.download || "http://zengfy.top:8000/download"}
                    className="w-full sm:w-auto px-7 py-4 rounded-full glass-panel hover:bg-white text-slate-800 font-bold text-sm sm:text-base border border-white/80 transition-all inline-flex items-center justify-center gap-2.5 min-h-[52px]"
                >
                    <Smartphone aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                    <span>Download Android APK</span>
                </a>
            </div>

            {/* Trust Badges */}
            <div className="pt-8 flex flex-wrap items-center justify-center gap-5 sm:gap-8 text-xs sm:text-sm text-slate-500 font-semibold">
                <div className="flex items-center gap-2">
                    <ShieldCheck aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                    <span>Zero Bot Farms Guarantee</span>
                </div>
                <div className="flex items-center gap-2">
                    <CheckCircle2 aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                    <span>100% Chronological Feeds</span>
                </div>
                <div className="flex items-center gap-2">
                    <Sparkles aria-hidden="true" className="w-4 h-4 text-emerald-600" />
                    <span>End-to-End Encrypted Circles</span>
                </div>
            </div>

            {/* Dynamic Telemetry Stats Ribbon */}
            <div className="mt-12 glass-panel rounded-3xl p-6 sm:p-8 grid grid-cols-2 lg:grid-cols-4 gap-6 text-center border border-white/80 shadow-md">
                <div>
                    <div className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        {stats.verified_citizens ? stats.verified_citizens.toLocaleString() : '1,480'}+
                    </div>
                    <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">Verified Citizens</div>
                </div>
                <div>
                    <div className="text-3xl sm:text-4xl font-black text-blue-600 tracking-tight">
                        {stats.total_wards ? stats.total_wards.toLocaleString() : '4,554'}
                    </div>
                    <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">Civic Wards Mapped</div>
                </div>
                <div>
                    <div className="text-3xl sm:text-4xl font-black text-emerald-600 tracking-tight">
                        {stats.safety_index || '99.4%'}
                    </div>
                    <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">Community Safety Index</div>
                </div>
                <div>
                    <div className="text-3xl sm:text-4xl font-black text-indigo-600 tracking-tight">
                        {stats.active_circles ? stats.active_circles.toLocaleString() : '1,280'}+
                    </div>
                    <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">Active Sovereign Circles</div>
                </div>
            </div>

        </section>
    );
}
