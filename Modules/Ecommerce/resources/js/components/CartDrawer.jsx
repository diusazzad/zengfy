import React, { useState } from 'react';
import { X, Trash2, Plus, Minus, ShoppingBag, ShieldCheck, CheckCircle2, ArrowRight } from 'lucide-react';

export default function CartDrawer({ 
    isOpen, 
    onClose, 
    cartItems = [], 
    onUpdateQuantity, 
    onRemoveItem, 
    onClearCart 
}) {
    const [checkoutStep, setCheckoutStep] = useState('cart'); // 'cart' | 'checkout' | 'success'
    const [paymentMethod, setPaymentMethod] = useState('bkash');
    const [buyerName, setBuyerName] = useState('');
    const [buyerPhone, setBuyerPhone] = useState('');
    const [buyerAddress, setBuyerAddress] = useState('');

    if (!isOpen) return null;

    const subtotal = cartItems.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    const freeDeliveryThreshold = 2500;
    const isFreeDelivery = subtotal >= freeDeliveryThreshold;
    const deliveryFee = isFreeDelivery || subtotal === 0 ? 0 : 60;
    const grandTotal = subtotal + deliveryFee;

    const handleConfirmOrder = (e) => {
        e.preventDefault();
        setCheckoutStep('success');
    };

    const handleReset = () => {
        setCheckoutStep('cart');
        onClearCart();
        onClose();
    };

    return (
        <div className="fixed inset-0 z-50 overflow-hidden">
            {/* Backdrop */}
            <div 
                onClick={onClose}
                className="absolute inset-0 bg-slate-900/60 backdrop-blur-xs transition-opacity"
            />

            <div className="fixed inset-y-0 right-0 max-w-full flex pl-10">
                <div className="w-screen max-w-md bg-white shadow-2xl flex flex-col">
                    {/* Drawer Header */}
                    <div className="p-4 sm:p-5 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                        <div className="flex items-center gap-2">
                            <div className="w-8 h-8 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center font-bold">
                                <ShoppingBag className="w-4 h-4" />
                            </div>
                            <div>
                                <h3 className="text-sm font-black text-slate-900">
                                    {checkoutStep === 'cart' ? 'আপনার শপিং ব্যাগ' : checkoutStep === 'checkout' ? 'অর্ডার কনফার্মেশন' : 'অর্ডার সফল!'}
                                </h3>
                                <p className="text-[11px] text-slate-500 font-semibold">
                                    {cartItems.length} টি আইটেম ব্যাগে রয়েছে
                                </p>
                            </div>
                        </div>
                        <button 
                            onClick={onClose}
                            className="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200/60 transition-colors"
                        >
                            <X className="w-5 h-5" />
                        </button>
                    </div>

                    {/* Content Section based on step */}
                    {checkoutStep === 'cart' && (
                        <>
                            {/* Free Delivery Meter */}
                            <div className="p-4 bg-purple-50/70 border-b border-purple-100">
                                <div className="flex items-center justify-between text-xs font-bold text-slate-800 mb-1.5">
                                    <span>
                                        {isFreeDelivery ? '🎉 আপনি ফ্রি ডেলিভারি পাচ্ছেন!' : `আর ৳${(freeDeliveryThreshold - subtotal).toLocaleString()} টাকার পণ্য নিলেই ফ্রি ডেলিভারি!`}
                                    </span>
                                    <span className="text-purple-700 font-black">
                                        {Math.min(100, Math.round((subtotal / freeDeliveryThreshold) * 100))}%
                                    </span>
                                </div>
                                <div className="w-full h-1.5 bg-purple-200/60 rounded-full overflow-hidden">
                                    <div 
                                        className="h-full bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full transition-all duration-300"
                                        style={{ width: `${Math.min(100, Math.round((subtotal / freeDeliveryThreshold) * 100))}%` }}
                                    />
                                </div>
                            </div>

                            {/* Item List */}
                            <div className="flex-1 overflow-y-auto p-4 divide-y divide-slate-100">
                                {cartItems.length === 0 ? (
                                    <div className="text-center py-16">
                                        <div className="text-4xl mb-3">🛍️</div>
                                        <div className="text-sm font-bold text-slate-800 mb-1">ব্যাগটি সম্পূর্ণ খালি</div>
                                        <p className="text-xs text-slate-400 max-w-xs mx-auto">
                                            মার্কেটপ্লেসের সেরা ডিলগুলো থেকে পছন্দের পণ্য কার্টে যুক্ত করুন।
                                        </p>
                                    </div>
                                ) : (
                                    cartItems.map((item) => (
                                        <div key={item.id} className="py-3.5 flex items-center gap-3">
                                            <img 
                                                src={item.image} 
                                                alt={item.title} 
                                                className="w-16 h-16 rounded-xl object-cover bg-slate-100 shrink-0 border border-slate-200"
                                            />
                                            <div className="flex-1 min-w-0">
                                                <h4 className="text-xs font-bold text-slate-900 truncate">
                                                    {item.title}
                                                </h4>
                                                <div className="text-[11px] text-slate-400 font-medium">
                                                    {item.seller?.name || "Verified Merchant"}
                                                </div>
                                                <div className="text-xs font-black text-purple-700 mt-1">
                                                    ৳{item.price.toLocaleString()}
                                                </div>
                                            </div>

                                            {/* Quantity modifier */}
                                            <div className="flex items-center gap-1.5 bg-slate-100 rounded-lg p-1 border border-slate-200">
                                                <button
                                                    onClick={() => onUpdateQuantity(item.id, Math.max(1, item.quantity - 1))}
                                                    className="w-6 h-6 flex items-center justify-center text-slate-600 hover:bg-white rounded transition-colors"
                                                >
                                                    <Minus className="w-3 h-3" />
                                                </button>
                                                <span className="text-xs font-black px-1.5 text-slate-800">{item.quantity}</span>
                                                <button
                                                    onClick={() => onUpdateQuantity(item.id, item.quantity + 1)}
                                                    className="w-6 h-6 flex items-center justify-center text-slate-600 hover:bg-white rounded transition-colors"
                                                >
                                                    <Plus className="w-3 h-3" />
                                                </button>
                                            </div>

                                            {/* Remove Button */}
                                            <button
                                                onClick={() => onRemoveItem(item.id)}
                                                className="p-1.5 text-slate-400 hover:text-red-600 transition-colors"
                                            >
                                                <Trash2 className="w-4 h-4" />
                                            </button>
                                        </div>
                                    ))
                                )}
                            </div>

                            {/* Summary & Checkout Button */}
                            {cartItems.length > 0 && (
                                <div className="p-4 bg-slate-50 border-t border-slate-200">
                                    <div className="space-y-1.5 text-xs font-medium text-slate-600 mb-3">
                                        <div className="flex justify-between">
                                            <span>সাবটোটাল</span>
                                            <span className="font-bold text-slate-900">৳{subtotal.toLocaleString()}</span>
                                        </div>
                                        <div className="flex justify-between">
                                            <span>ডেলিভারি চার্জ</span>
                                            <span className={isFreeDelivery ? 'font-bold text-emerald-600' : 'font-bold text-slate-900'}>
                                                {isFreeDelivery ? 'ফ্রি (৳০)' : `৳${deliveryFee}`}
                                            </span>
                                        </div>
                                        <div className="flex justify-between text-sm font-black text-slate-900 pt-2 border-t border-slate-200">
                                            <span>সর্বমোট বিল</span>
                                            <span className="text-purple-700">৳{grandTotal.toLocaleString()}</span>
                                        </div>
                                    </div>

                                    <button
                                        onClick={() => setCheckoutStep('checkout')}
                                        className="w-full py-3 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-extrabold text-xs shadow-lg shadow-purple-600/25 flex items-center justify-center gap-2 transition-all"
                                    >
                                        <span>চেকআউট করুন (Proceed)</span>
                                        <ArrowRight className="w-4 h-4" />
                                    </button>
                                </div>
                            )}
                        </>
                    )}

                    {checkoutStep === 'checkout' && (
                        <form onSubmit={handleConfirmOrder} className="flex-1 overflow-y-auto p-5 flex flex-col justify-between">
                            <div className="space-y-4">
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">আপনার পূর্ণ নাম</label>
                                    <input 
                                        type="text" 
                                        required
                                        value={buyerName}
                                        onChange={(e) => setBuyerName(e.target.value)}
                                        placeholder="উদাঃ সাদিয়া আক্তার"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-semibold focus:outline-none focus:border-purple-600"
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">মোবাইল নম্বর (bKash/OTP)</label>
                                    <input 
                                        type="tel" 
                                        required
                                        value={buyerPhone}
                                        onChange={(e) => setBuyerPhone(e.target.value)}
                                        placeholder="০১৭xxxxxxxx"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-semibold focus:outline-none focus:border-purple-600"
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-1">ডেলিভারি ঠিকানা</label>
                                    <textarea 
                                        rows="2"
                                        required
                                        value={buyerAddress}
                                        onChange={(e) => setBuyerAddress(e.target.value)}
                                        placeholder="বাসা নং, রোড নং, এলাকা, জেলা"
                                        className="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs font-semibold focus:outline-none focus:border-purple-600"
                                    />
                                </div>

                                {/* Payment Method Picker */}
                                <div>
                                    <label className="block text-xs font-bold text-slate-700 mb-2">পেমেন্ট মেথড নির্বাচন করুন</label>
                                    <div className="grid grid-cols-2 gap-2">
                                        <button
                                            type="button"
                                            onClick={() => setPaymentMethod('bkash')}
                                            className={`p-3 rounded-xl border text-xs font-bold flex flex-col items-center gap-1 transition-all ${paymentMethod === 'bkash' ? 'border-pink-500 bg-pink-50 text-pink-700' : 'border-slate-200 bg-white text-slate-600'}`}
                                        >
                                            <span className="text-base">📱</span>
                                            <span>bKash / Nagad</span>
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => setPaymentMethod('cod')}
                                            className={`p-3 rounded-xl border text-xs font-bold flex flex-col items-center gap-1 transition-all ${paymentMethod === 'cod' ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-slate-200 bg-white text-slate-600'}`}
                                        >
                                            <span className="text-base">💵</span>
                                            <span>ক্যাশ অন ডেলিভারি</span>
                                        </button>
                                    </div>
                                </div>

                                <div className="p-3 bg-purple-50 rounded-xl border border-purple-200 text-xs flex items-start gap-2">
                                    <ShieldCheck className="w-4 h-4 text-purple-600 shrink-0 mt-0.5" />
                                    <p className="text-slate-600 leading-snug">
                                        <strong>স্মার্ট এসক্রো প্রটেকশন:</strong> পার্সেল ডেলিভারি না হওয়া পর্যন্ত আপনার পেমেন্ট ১০০% সুরক্ষিত থাকবে।
                                    </p>
                                </div>
                            </div>

                            <div className="pt-4 border-t border-slate-200">
                                <button
                                    type="submit"
                                    className="w-full py-3.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-extrabold text-xs shadow-lg shadow-purple-600/25 flex items-center justify-center gap-2"
                                >
                                    <span>অর্ডার নিশ্চিত করুন (৳{grandTotal.toLocaleString()})</span>
                                </button>
                                <button
                                    type="button"
                                    onClick={() => setCheckoutStep('cart')}
                                    className="w-full mt-2 text-xs font-bold text-slate-500 hover:text-slate-700 py-1"
                                >
                                    ← ব্যাগে ফিরে যান
                                </button>
                            </div>
                        </form>
                    )}

                    {checkoutStep === 'success' && (
                        <div className="flex-1 p-8 flex flex-col items-center justify-center text-center">
                            <div className="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4">
                                <CheckCircle2 className="w-10 h-10" />
                            </div>
                            <h3 className="text-lg font-black text-slate-900 mb-1">
                                অর্ডার সফলভাবে গৃহীত হয়েছে!
                            </h3>
                            <p className="text-xs text-slate-600 max-w-xs mb-4">
                                আপনার অর্ডার নম্বর <strong className="text-purple-700">#ZENG-{Math.floor(100000 + Math.random() * 900000)}</strong>। 
                                মার্চেন্টকে নোটিফিকেশন পাঠানো হয়েছে। কুরিয়ার ট্র্যাকিং এসএমএস আপনার ফোনে চলে যাবে।
                            </p>
                            <button
                                onClick={handleReset}
                                className="px-6 py-2.5 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition-colors"
                            >
                                কেনাকাটা চালিয়ে যান
                            </button>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}
