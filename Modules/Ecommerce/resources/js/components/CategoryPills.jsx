import React from 'react';
import { 
    Smartphone, Shirt, ShoppingBag, Home, 
    Apple, Sparkles, Smile, BookOpen, Layers
} from 'lucide-react';

export default function CategoryPills({ 
    categories = [], 
    selectedCategory, 
    onSelectCategory 
}) {
    const getCategoryIcon = (iconName) => {
        switch (iconName) {
            case 'Smartphone': return <Smartphone className="w-4 h-4" />;
            case 'Shirt': return <Shirt className="w-4 h-4" />;
            case 'ShoppingBag': return <ShoppingBag className="w-4 h-4" />;
            case 'Home': return <Home className="w-4 h-4" />;
            case 'Apple': return <Apple className="w-4 h-4" />;
            case 'Sparkles': return <Sparkles className="w-4 h-4" />;
            case 'Smile': return <Smile className="w-4 h-4" />;
            case 'BookOpen': return <BookOpen className="w-4 h-4" />;
            default: return <Layers className="w-4 h-4" />;
        }
    };

    return (
        <section className="max-w-7xl mx-auto px-4 sm:px-6 py-4">
            <div className="flex items-center justify-between mb-3">
                <h2 className="text-base font-black text-slate-900 flex items-center gap-2">
                    <span className="w-2.5 h-2.5 rounded-full bg-purple-600" />
                    টপ ক্যাটাগরি ব্রাউজ করুন
                </h2>
                {selectedCategory !== 'all' && (
                    <button
                        onClick={() => onSelectCategory('all')}
                        className="text-xs font-bold text-purple-600 hover:text-purple-800"
                    >
                        সব দেখুন (Reset)
                    </button>
                )}
            </div>

            <div className="flex items-center gap-2.5 overflow-x-auto pb-2 scrollbar-none">
                {/* 'All' category pill */}
                <button
                    onClick={() => onSelectCategory('all')}
                    className={`flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-bold shrink-0 transition-all border ${
                        selectedCategory === 'all'
                            ? 'bg-purple-600 text-white border-purple-600 shadow-md shadow-purple-600/20'
                            : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'
                    }`}
                >
                    <Layers className="w-4 h-4" />
                    <span>সব পণ্য</span>
                </button>

                {categories.map((cat) => {
                    const isSelected = selectedCategory === cat.name;
                    return (
                        <button
                            key={cat.id}
                            onClick={() => onSelectCategory(cat.name)}
                            className={`flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-bold shrink-0 transition-all border ${
                                isSelected
                                    ? 'bg-purple-600 text-white border-purple-600 shadow-md shadow-purple-600/20'
                                    : 'bg-white text-slate-750 border-slate-200 hover:bg-slate-50'
                            }`}
                        >
                            <span className={isSelected ? 'text-white' : 'text-purple-600'}>
                                {getCategoryIcon(cat.icon)}
                            </span>
                            <span>{cat.name}</span>
                            <span className={`text-[10px] px-1.5 py-0.2 rounded-full font-semibold ${
                                isSelected ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-400'
                            }`}>
                                {cat.count.split('+')[0]}+
                            </span>
                        </button>
                    );
                })}
            </div>
        </section>
    );
}
