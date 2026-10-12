import React, { useState, useMemo } from 'react';
import { Search, Sparkles, Filter, X } from 'lucide-react';
import ModuleCard from './ModuleCard';

export default function ModuleGrid({ modules = [], searchQuery = '', setSearchQuery }) {
    const [selectedCategory, setSelectedCategory] = useState('All');

    const categories = useMemo(() => {
        const set = new Set();
        modules.forEach((m) => {
            if (m.category) {
                // Group categories into broader buckets for cleaner pills
                if (m.category.includes('Social') || m.category.includes('Civic') || m.category.includes('Charity')) {
                    set.add('Civic & Social');
                } else if (m.category.includes('Commerce') || m.category.includes('Retail') || m.category.includes('Real Estate') || m.category.includes('Hospitality')) {
                    set.add('Commerce & Business');
                } else if (m.category.includes('Education') || m.category.includes('Legal') || m.category.includes('Engineering') || m.category.includes('LMS')) {
                    set.add('Institutional ERP');
                } else {
                    set.add('Personal & Productivity');
                }
            }
        });
        return ['All', 'Civic & Social', 'Commerce & Business', 'Institutional ERP', 'Personal & Productivity'];
    }, [modules]);

    const filteredModules = useMemo(() => {
        return modules.filter((m) => {
            const matchesSearch =
                !searchQuery ||
                m.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                m.tagline.toLowerCase().includes(searchQuery.toLowerCase()) ||
                m.desc.toLowerCase().includes(searchQuery.toLowerCase()) ||
                m.category.toLowerCase().includes(searchQuery.toLowerCase());

            if (!matchesSearch) return false;
            if (selectedCategory === 'All') return true;

            if (selectedCategory === 'Civic & Social') {
                return m.category.includes('Social') || m.category.includes('Civic') || m.category.includes('Charity');
            }
            if (selectedCategory === 'Commerce & Business') {
                return m.category.includes('Commerce') || m.category.includes('Retail') || m.category.includes('Real Estate') || m.category.includes('Hospitality');
            }
            if (selectedCategory === 'Institutional ERP') {
                return m.category.includes('Education') || m.category.includes('Legal') || m.category.includes('Engineering') || m.category.includes('LMS');
            }
            if (selectedCategory === 'Personal & Productivity') {
                return m.category.includes('Productivity') || m.category.includes('Personal') || m.category.includes('Booking') || m.category.includes('Focus');
            }

            return true;
        });
    }, [modules, searchQuery, selectedCategory]);

    return (
        <section id="modules-section" className="py-6 sm:py-10">
            {/* Header with Title and Search Count */}
            <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
                <div>
                    <div className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 text-xs font-bold mb-2">
                        <Sparkles className="w-3.5 h-3.5 text-cyan-400" />
                        <span>Unified Micro-SaaS Mesh</span>
                    </div>
                    <h2 className="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                        Explore All 13 Sovereign Apps
                    </h2>
                    <p className="text-xs sm:text-sm text-gray-400 mt-1">
                        Independent micro-platforms connected to one sovereign ID and NID verification vault.
                    </p>
                </div>

                {/* Counter Pill */}
                <div className="flex items-center gap-2 self-start sm:self-auto">
                    <span className="text-xs text-gray-400">Showing:</span>
                    <span className="px-2.5 py-1 rounded-xl bg-[#121A29] border border-white/10 text-cyan-300 text-xs font-black">
                        {filteredModules.length} of {modules.length} Apps
                    </span>
                </div>
            </div>

            {/* Category Filter Pills (Horizontal Scrollable on Mobile) */}
            <div className="flex items-center gap-2 overflow-x-auto pb-3 mb-6 no-scrollbar">
                {categories.map((cat) => {
                    const isSelected = selectedCategory === cat;
                    return (
                        <button
                            key={cat}
                            type="button"
                            onClick={() => setSelectedCategory(cat)}
                            className={`px-3.5 py-2 rounded-xl text-xs font-bold whitespace-nowrap active:scale-95 transition-all cursor-pointer ${
                                isSelected
                                    ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30 border border-blue-400/40'
                                    : 'bg-[#121A29] hover:bg-[#182236] text-gray-300 hover:text-white border border-white/[0.08]'
                            }`}
                        >
                            {cat}
                        </button>
                    );
                })}
            </div>

            {/* Active Search Filter Banner */}
            {searchQuery && (
                <div className="flex items-center justify-between p-3 rounded-xl bg-blue-500/10 border border-blue-500/20 mb-6 text-xs text-cyan-300">
                    <span>
                        Filtering by: <strong className="text-white font-bold">"{searchQuery}"</strong>
                    </span>
                    <button
                        type="button"
                        onClick={() => setSearchQuery('')}
                        className="flex items-center gap-1 text-gray-400 hover:text-white"
                    >
                        <span>Clear</span>
                        <X className="w-3.5 h-3.5" />
                    </button>
                </div>
            )}

            {/* Responsive Grid: 1 col on mobile, 2 on tablet, 3 on desktop */}
            {filteredModules.length > 0 ? (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                    {filteredModules.map((mod) => (
                        <ModuleCard key={mod.id} module={mod} />
                    ))}
                </div>
            ) : (
                <div className="bg-[#121A29] border border-white/[0.08] rounded-2xl p-10 text-center">
                    <p className="text-sm font-bold text-gray-200 mb-2">No apps match your query.</p>
                    <p className="text-xs text-gray-400 mb-4">Try searching for "POS", "School", "Legal", or clear filters.</p>
                    <button
                        type="button"
                        onClick={() => {
                            setSearchQuery('');
                            setSelectedCategory('All');
                        }}
                        className="px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-bold"
                    >
                        Reset Filters
                    </button>
                </div>
            )}
        </section>
    );
}