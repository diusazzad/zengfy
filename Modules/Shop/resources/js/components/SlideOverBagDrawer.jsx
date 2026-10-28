import React, { useState } from 'react';
import { X, Trash2, Plus, Minus, ShoppingBag, ShieldCheck, CheckCircle2, ArrowRight } from 'lucide-react';

export default function SlideOverBagDrawer({ 
    isOpen, 
    onClose, 
    bagItems = [], 
    onUpdateQuantity, 
    onRemoveItem, 
    onClearBag 
}) {
    const [step, setStep] = useState('bag'); // 'bag' | 'checkout' | 'success'
    const [name, setName] = useState('');
    const [phone, setPhone] = useState('');
    const [address, setAddress] = useState('');
    const [paymentMethod, setPaymentMethod] = useState('bkash');

    if (!isOpen) return null;

    const subtotal = bagItems.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    const deliveryFee = 0; // Free delivery for Zengfy Atelier
    const grandTotal = subtotal + deliveryFee;

    const handleConfirmOrder = (e) => {
        e.preventDefault();
        setStep('success');
    };

    const handleReset = () => {
        setStep('bag');
        onClearBag();
        onClose();
    };

    return (
        <div className="fixed inset-0 z-50 overflow-hidden">
            {/* Backdrop */}
            <div 
                onClick={onClose}
                className="absolute inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"
            />

            <div className="fixed inset-y-0 right-0 max-w-full flex pl-10">
                <div className="w-screen max-w-md bg-white shadow-2xl flex flex-col font-sans">
                    {/* Header */}
                    <div className="p-5 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                        <div className="flex items-center gap-2.5">
                            <div className="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center">
                                <ShoppingBag className="w-4 h-4" />
                            </div>
                            <div>
                                <h3 className="text-sm font-black uppercase tracking-wider text-slate-950 font-mono">
                                    {step === 'bag' ? 'ZENGFY ATELIER BAG' : step === 'checkout' ? 'অর্ডার কনফার্মেশন' : 'অর্ডার গৃহীত!'}
                                </h3>
                                <p className="text-[11px] text-slate-400 font-semibold">
                                    {bagItems.length} টি পোশাক ব্যাগে রয়েছে
                                </p>
                            </div>
                        </div>
                        <button 
                            onClick={onClose}
                            className="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200 transition-colors"
                        >
                            <X className="w-5 h-5" />
                        </button>
                    </div>

                    {step === 'bag' && (
                        <>
                            {/* Free Shipping Strip */}
                            <div className="p-3.5 bg-slate-950 text-white text-xs font-bold flex items-center justify-between">
                                <span className="flex items-center gap-1.5">
                                    <span className="w-2 h-2 rounded-full bg-emerald-400" />
                                    সারা বাংলাদেশে ফ্রি এক্সপ্রেস ডেলিভারি
                                </span>
                                <span className="text-[10px] uppercase tracking-widest text-slate-400 font-mono">
                                    100% COMPLIMENTARY
                                </span>
                            </div>

                            {/* Item List */}
                            <div className="flex-1 overflow-y-auto p-5 divide-y divide-slate-100">
                                {bagItems.length === 0 ? (
                                    <div className="text-center py-20">
                                        <div className="text-4xl mb-3">🏷️</div>
                                        <div className="text-sm font-bold text-slate-900 mb-1">আপনার ব্যাগটি সম্পূর্ণ খালি</div>
                                        <p className="text-xs text-slate-400 max-w-xs mx-auto">
                                            আমাদের অটাম/উইন্টার ড্রপ ০১ থেকে পছন্দের হুডি বা টি-শার্ট নির্বাচন করুন।
                                        </p>
                                    </div>
                                ) : (
                                    bagItems.map((item, idx) => (
                                        <div key={`${item.id}-${item.selectedSize}-${idx}`} className="py-4 flex items-center gap-3.5">
                                            <img 
                                                src={item.image_front} 
                                                alt={item.title}
                                                className="w-16 h-20 rounded-xl object-cover bg-slate-100 shrink-0 border border-slate-200"
                                            />
                                            <div className="flex-1 min-w-0">
                                                <h4 className="text-xs font-bold text-slate-900 truncate">
                                                    {item.title}
                                                </h4>
                                                <div className="text-[11px] text-slate-500 font-mono mt-0.5">
                                                    সাইজ: <strong className="text-slate-900 font-bold">{item.selectedSize}</strong> • {item.gsm}
                                                </div>
                                                <div className="text-xs font-black text-slate-950 font-mono mt-1">
                                                    ৳{item.price.toLocaleString()}
                                                </div>
                                            </div>

                                            {/* Quantity */}
                                            <div className="flex items-center gap-1 bg-slate-100 rounded-lg p-1 border border-slate-200">
                                                <button
                                                    onClick={() => onUpdateQuantity(item.id, item.selectedSize, Math.max(1, item.quantity - 1))}
                                                    className="w-5 h-5 flex items-center justify-center text-slate-600 hover:bg-white rounded transition-colors"
                                                >
                                                    <Minus className="w-3 h-3" />
                                                </button>
                                                <span className="text-xs font-black px-1.5 text-slate-800 font-mono">{item.quantity}</span>
                                                <button
                                                    onClick={() => onUpdateQuantity(item.id, item.selectedSize, item.quantity + 1)}
                                                    className="w-5 h-5 flex items-center justify-center text-slate-600 hover:bg-white rounded transition-colors"
                                                >
                                                    <Plus className="w-3 h-3" />
                                                </button>
                                            </div>

                                            {/* Remove */}
                                            <button
                                                onClick={() => onRemoveItem(item.id, item.selectedSize)}
                                                className="p-1 text-slate-400 hover:text-red-600 transition-colors"
                                            >
                                                <Trash2 className="w-4 h-4" />
                                            </button>
                                        </div>
                                    ))
                                )}
                            </div>

                            {/* Bag Summary */}
                            {bagItems.length > 0 && (
                                <div className="p-5 bg-slate-50 border-t border-slate-200">
                                    <div className="space-y-1.5 text-xs text-slate-600 mb-4">
                                        <div className="flex justify-between">
                                            <span>পোশাকের মূল্য</span>
                                            <span className="font-bold text-slate-900 font-mono">৳{subtotal.toLocaleString()}</span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span>এক্সপ্রেস শিপিং</span>
                                            <span className="font-bold text-emerald-600 uppercase font-mono">ফ্রি (৳০)</span>
                                        </div>
                                        <div className="flex justify-between text-sm font-black text-slate-950 pt-2 border-t border-slate-200 font-mono">
                                            <span>সর্বমোট প্রদেয়</span>
                                            <span>৳{grandTotal.toLocaleString()}</span>
                                        </div>
                                    </div>

                                    <button
                                        onClick={() => setStep('checkout')}
                                        className="w-full py-3.5 rounded-xl bg-slate-950 hover:bg-slate-800 text-white font-black text-xs uppercase tracking-widest shadow-xl shadow-slate-950/20 flex items-center justify-center gap-2 transition-all"
                                    >
                                        <span>চেকআউট ও ডেলিভারি (Proceed)</span>
                                        <ArrowRight className="w-4 h-4" />
                                    </button>
                                </div>
                            )}
                        </>
                    )}

                    {step === 'checkout' && (
                        <form onSubmit={handleConfirmOrder} className="flex-1 overflow-y-auto p-6 flex flex-col justify-between">
                            <div className="space-y-4">
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">আপনার পূর্ণ নাম</label>
                                    <input 
                                        type="text" 
                                        required
                                        value={name}
                                        onChange={(e) => setName(e.target.value)}
                                        placeholder="উদাঃ ফাহিম আহমেদ"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-semibold focus:outline-none focus:border-slate-950"
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">মোবাইল নম্বর (bKash/OTP)</label>
                                    <input 
                                        type="tel" 
                                        required
                                        value={phone}
                                        onChange={(e) => setPhone(e.target.value)}
                                        placeholder="০১৭xxxxxxxx"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-semibold focus:outline-none focus:border-slate-950"
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">ডেলিভারি ঠিকানা</label>
                                    <textarea 
                                        rows="2"
                                        required
                                        value={address}
                                        onChange={(e) => setAddress(e.target.value)}
                                        placeholder="বাসা নং, রোড নং, এলাকা, জেলা"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-semibold focus:outline-none focus:border-slate-950"
                                    />
                                </div>

                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-2">পেমেন্ট মেথড</label>
                                    <div className="grid grid-cols-2 gap-2">
                                        <button
                                            type="button"
                                            onClick={() => setPaymentMethod('bkash')}
                                            className={`p-3 rounded-xl border text-xs font-bold flex flex-col items-center gap-1 transition-all ${paymentMethod === 'bkash' ? 'border-slate-950 bg-slate-950 text-white' : 'border-slate-200 bg-white text-slate-600'}`}
                                        >
                                            <span className="text-base">📱</span>
                                            <span>bKash 1-Click Pay</span>
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => setPaymentMethod('cod')}
                                            className={`p-3 rounded-xl border text-xs font-bold flex flex-col items-center gap-1 transition-all ${paymentMethod === 'cod' ? 'border-slate-950 bg-slate-950 text-white' : 'border-slate-200 bg-white text-slate-600'}`}
                                        >
                                            <span className="text-base">💵</span>
                                            <span>ক্যাশ অন ডেলিভারি</span>
                                        </button>
                                    </div>
                                </div>

                                <div className="p-3 bg-slate-100 rounded-xl border border-slate-200 text-xs flex items-start gap-2">
                                    <ShieldCheck className="w-4 h-4 text-slate-700 shrink-0 mt-0.5" />
                                    <p className="text-slate-600 leading-snug">
                                        <strong>৭ দিনের ফ্রি সাইজ সোয়াপ:</strong> সাইজ নিয়ে সামান্যতম অমিল হলেও আপনি ফ্রি এক্সচেঞ্জ সুবিধা পাবেন।
                                    </p>
                                </div>
                            </div>

                            <div className="pt-4 border-t border-slate-200">
                                <button
                                    type="submit"
                                    className="w-full py-3.5 rounded-xl bg-slate-950 hover:bg-slate-800 text-white font-black text-xs uppercase tracking-widest shadow-xl"
                                >
                                    <span>অর্ডার নিশ্চিত করুন (৳{grandTotal.toLocaleString()})</span>
                                </button>
                                <button
                                    type="button"
                                    onClick={() => setStep('bag')}
                                    className="w-full mt-2 text-xs font-bold text-slate-500 hover:text-slate-700 py-1"
                                >
                                    ← ব্যাগে ফিরে যান
                                </button>
                            </div>
                        </form>
                    )}

                    {step === 'success' && (
                        <div className="flex-1 p-8 flex flex-col items-center justify-center text-center">
                            <div className="w-16 h-16 rounded-full bg-slate-950 text-white flex items-center justify-center mb-4 shadow-xl">
                                <CheckCircle2 className="w-10 h-10" />
                            </div>
                            <h3 className="text-lg font-black text-slate-950 font-mono mb-1">
                                ORDER CONFIRMED!
                            </h3>
                            <p className="text-xs text-slate-600 max-w-xs mb-4">
                                অর্ডার নম্বর: <strong className="text-slate-950 font-mono">#ATELIER-{Math.floor(100000 + Math.random() * 900000)}</strong>। 
                                আপনার পার্সেলটি ঢাকা স্টুডিও থেকে স্পেশাল ব্ল্যাক বক্সে প্যাকিং শুরু হয়েছে।
                            </p>
                            <button
                                onClick={handleReset}
                                className="px-6 py-2.5 rounded-xl bg-slate-950 text-white text-xs font-bold hover:bg-slate-800 transition-colors"
                            >
                                কালেকশন ব্রাউজ চালিয়ে যান
                            </button>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
