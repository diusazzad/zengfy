import React, { useState, useMemo } from 'react';
import { ExternalLink, Search, CheckCircle2, ArrowUpRight, Sparkles } from 'lucide-react';

export default function ProductsSection({ modules = [], stats = {} }) {
    const [selectedCategory, setSelectedCategory] = useState('all');
    const [searchQuery, setSearchQuery] = useState('');

    const categories = [
        { id: 'all', label: 'All Platforms' },
        { id: 'civic', label: 'Civic & Mesh' },
        { id: 'business', label: 'Business & POS' },
        { id: 'institutional', label: 'Education & Legal' },
        { id: 'personal', label: 'Productivity & Vault' },
    ];

    const filteredModules = useMemo(() => {
        return modules.filter((mod) => {
            const matchesSearch =
                mod.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                mod.desc.toLowerCase().includes(searchQuery.toLowerCase()) ||
                mod.category.toLowerCase().includes(searchQuery.toLowerCase());

            if (!matchesSearch) return false;

            if (selectedCategory === 'all') return true;
            if (selectedCategory === 'civic') return ['social', 'ngo', 'civil'].includes(mod.id);
            if (selectedCategory === 'business') return ['pos', 'ecommerce', 'shop', 'rent', 'hotel'].includes(mod.id);
            if (selectedCategory === 'institutional') return ['school', 'law'].includes(mod.id);
            if (selectedCategory === 'personal') return ['journal', 'habit', 'schedule', 'skill'].includes(mod.id);

            return true;
        });
    }, [modules, searchQuery, selectedCategory]);

    return (
        <section id="modules-section" aria-label="14 Micro-SaaS Operating Platforms" className="pt-16 sm:pt-24 pb-20 sm:pb-28 border-t border-slate-200/70">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                {/* Section Header */}
                <div className="text-center max-w-4xl mx-auto mb-12 sm:mb-16">
                    <div className="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-panel-subtle text-slate-700 text-xs sm:text-sm font-semibold mb-4 shadow-xs">
                        <span aria-hidden="true" className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" />
                        <span>Single Sign-On • 14 Connected Operating Platforms</span>
                    </div>

                    <h2 className="text-4xl sm:text-5xl md:text-6xl font-black tracking-tight text-slate-900 leading-[1.1]">
                        One Unified Account. <br className="hidden sm:inline" />
                        <span className="bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-600 bg-clip-text text-transparent">
                            Infinite Digital Ecosystem.
                        </span>
                    </h2>

                    <p className="mt-4 sm:mt-5 text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto">
                        Connect your school ERP, retail point of sale, legal case files, and team operations under one seamless sovereign identity.
                    </p>
                    <p className="mt-2 text-sm sm:text-base font-semibold text-blue-700">
                        একটি একাউন্টেই স্কুল ম্যানেজমেন্ট, রিটেইল পিওএস, আইনি কেস ভল্ট এবং সকল প্রয়োজনীয় ডিজিটাল সমাধান।
                    </p>
                </div>

                {/* Live Platform Stats Strip */}
                <div className="mb-12 glass-panel rounded-3xl p-6 sm:p-8 grid grid-cols-2 lg:grid-cols-4 gap-6 text-center border border-white/80 shadow-md">
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
                        <div className="text-3xl sm:text-4xl font-black text-indigo-600 tracking-tight">
                            {stats.active_institutions || '540'}+
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">Active Institutions</div>
                    </div>
                    <div>
                        <div className="text-3xl sm:text-4xl font-black text-emerald-600 tracking-tight">
                            {stats.system_uptime || '99.98%'}
                        </div>
                        <div className="text-xs sm:text-sm font-bold text-slate-500 mt-1">Ecosystem Uptime</div>
                    </div>
                </div>

                {/* Category Filter Pills & Search */}
                <div className="flex flex-col md:flex-row items-center justify-between gap-4 mb-10">
                    {/* Filter Pills */}
                    <div role="tablist" aria-label="Platform Categories" className="flex flex-wrap items-center gap-2 p-1.5 rounded-2xl glass-panel-subtle">
                        {categories.map((cat) => (
                            <button
                                key={cat.id}
                                type="button"
                                role="tab"
                                aria-selected={selectedCategory === cat.id}
                                onClick={() => setSelectedCategory(cat.id)}
                                className={`px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer ${
                                    selectedCategory === cat.id
                                        ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20'
                                        : 'text-slate-600 hover:text-slate-900 hover:bg-white/80'
                                }`}
                            >
                                {cat.label}
                            </button>
                        ))}
                    </div>

                    {/* App Search Bar */}
                    <div className="relative w-full md:w-72">
                        <label htmlFor="modules-search-input" className="sr-only">
                            Search platforms by name or category
                        </label>
                        <Search aria-hidden="true" className="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" />
                        <input
                            id="modules-search-input"
                            type="text"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            placeholder="Search platforms by name..."
                            className="w-full bg-white/90 rounded-2xl pl-10 pr-4 py-2.5 text-xs sm:text-sm text-slate-800 placeholder-slate-400 border border-slate-200 focus:border-blue-500 focus:outline-none transition shadow-2xs"
                        />
                    </div>
                </div>

                {/* 13 Platforms Bento Grid (Frosted White Glass Cards) */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {filteredModules.map((item) => (
                        <div
                            key={item.id}
                            className="glass-card rounded-3xl p-6 sm:p-7 flex flex-col justify-between group hover:border-blue-300"
                        >
                            <div>
                                {/* Top Badge & Icon */}
                                <div className="flex items-center justify-between mb-5">
                                    <div aria-hidden="true" className="w-12 h-12 rounded-2xl bg-white border border-slate-200/90 shadow-2xs flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                                        {item.icon}
                                    </div>
                                    <span className="text-[11px] font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200/60">
                                        {item.badge}
                                    </span>
                                </div>

                                <span className="text-[11px] font-extrabold uppercase tracking-wider text-blue-600">
                                    {item.category}
                                </span>

                                <h3 className="text-xl font-black text-slate-900 mt-1 group-hover:text-blue-600 transition-colors">
                                    {item.name}
                                </h3>

                                <p className="text-xs font-semibold text-slate-500 mt-1">
                                    {item.tagline}
                                </p>

                                <p className="text-xs text-slate-600 mt-3 leading-relaxed">
                                    {item.desc}
                                </p>
                            </div>

                            {/* Card Footer: Subdomain URL & Launch Button */}
                            <div className="pt-5 mt-6 border-t border-slate-200/60 flex items-center justify-between">
                                <span className="text-[11px] font-mono text-slate-400 truncate max-w-[150px]">
                                    {item.id}.zengfy.top
                                </span>

                                <a
                                    href={item.url}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label={`Launch ${item.name}`}
                                    className="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white hover:bg-blue-50 text-blue-600 font-bold text-xs border border-blue-200 shadow-2xs hover:shadow-xs active:scale-95 transition-all"
                                >
                                    <span>Launch</span>
                                    <ArrowUpRight aria-hidden="true" className="w-3.5 h-3.5" />
                                </a>
                            </div>
                        </div>
                    ))}
                </div>

                {filteredModules.length === 0 && (
                    <div className="text-center py-16 text-slate-500">
                        <p className="text-sm font-semibold">No platforms found matching &ldquo;{searchQuery}&rdquo;</p>
                        <button
                            type="button"
                            onClick={() => {
                                setSearchQuery('');
                                setSelectedCategory('all');
                            }}
                            className="mt-3 text-xs font-bold text-blue-600 underline cursor-pointer"
                        >
                            Reset filters
                        </button>
                    </div>
                )}

            </div>
        </section>
    );
}
