import React, { useState } from 'react';
import { Barcode, ShoppingCart, Printer, Trash2, Plus, Minus, CheckCircle, Smartphone, Send, Sparkles } from 'lucide-react';

export default function InteractiveBarcodeSimulator({ simulatorData = {} }) {
    const inventory = simulatorData.inventory || [];
    const storeName = simulatorData.store_name || "Royal Heritage Boutique & Fashion";
    const storeAddress = simulatorData.store_address || "Shop #402, Level 4, Jamuna Future Park, Dhaka";
    const cashierName = simulatorData.cashier || "Tanvir Hasan";
    const sampleDue = simulatorData.sample_due_entry || {};

    const [selectedProduct, setSelectedProduct] = useState(inventory[0] || null);
    const [selectedVariantIndex, setSelectedVariantIndex] = useState(0);

    const [cart, setCart] = useState([
        {
            id: 'cart-1',
            name: 'Premium Panjabi (Linen Cotton)',
            sku: 'PAN-2026-LNN',
            barcode: '894120260101',
            size: '40',
            color: 'Navy Blue',
            price: 2450,
            quantity: 1,
        },
        {
            id: 'cart-2',
            name: 'Slim-Fit Stretch Denim Jeans',
            sku: 'DNM-SLM-09',
            barcode: '894120260312',
            size: '32',
            color: 'Indigo Blue',
            price: 1950,
            quantity: 1,
        },
    ]);

    const [barcodeInput, setBarcodeInput] = useState('');
    const [scanNotification, setScanNotification] = useState('');
    const [paymentMethod, setPaymentMethod] = useState('cash');
    const [isPrinted, setIsPrinted] = useState(false);
    const [smsSent, setSmsSent] = useState(false);

    const subtotal = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);
    const vat = Math.round(subtotal * 0.05);
    const discount = subtotal > 3000 ? 200 : 0;
    const total = subtotal + vat - discount;

    const handleAddToCart = (prod, variantIdx) => {
        if (!prod || !prod.variants) return;
        const variant = prod.variants[variantIdx];
        if (!variant) return;

        const cartItemId = `${prod.id}-${variant.size}-${variant.color}`;
        const existing = cart.find(item => item.id === cartItemId);

        if (existing) {
            setCart(cart.map(item => item.id === cartItemId ? { ...item, quantity: item.quantity + 1 } : item));
        } else {
            setCart([
                ...cart,
                {
                    id: cartItemId,
                    name: prod.name,
                    sku: prod.sku,
                    barcode: prod.barcode,
                    size: variant.size,
                    color: variant.color,
                    price: prod.price,
                    quantity: 1,
                }
            ]);
        }

        setScanNotification(`✓ "${prod.name} (${variant.color} - ${variant.size})" বিল কাউন্টারে যোগ হয়েছে!`);
        setTimeout(() => setScanNotification(''), 3000);
        setIsPrinted(false);
    };

    const handleBarcodeScan = (e) => {
        e.preventDefault();
        if (!barcodeInput.trim()) return;

        const matched = inventory.find(item => item.barcode === barcodeInput.trim() || item.sku.toLowerCase() === barcodeInput.trim().toLowerCase());
        if (matched) {
            handleAddToCart(matched, 0);
            setBarcodeInput('');
        } else {
            setScanNotification('⚠️ বারকোড পাওয়া যায়নি! ডেমো বারকোডে ক্লিক করুন।');
            setTimeout(() => setScanNotification(''), 3000);
        }
    };

    const updateQuantity = (id, delta) => {
        setCart(cart.map(item => {
            if (item.id === id) {
                const newQty = item.quantity + delta;
                return newQty > 0 ? { ...item, quantity: newQty } : null;
            }
            return item;
        }).filter(Boolean));
        setIsPrinted(false);
    };

    const removeItem = (id) => {
        setCart(cart.filter(item => item.id !== id));
        setIsPrinted(false);
    };
    const handlePrintBill = () => {
        setIsPrinted(true);
    };

    const handleSendDueSms = () => {
        setSmsSent(true);
        setTimeout(() => setSmsSent(false), 5000);
    };

    return (
        <section id="simulator-section" className="py-16 md:py-24 relative overflow-hidden bg-slate-100/60 border-y border-slate-200/80">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div className="text-center max-w-3xl mx-auto mb-12">
                    <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100/80 border border-amber-200 text-amber-900 text-xs font-bold uppercase tracking-wider mb-3">
                        <Barcode className="w-4 h-4 text-amber-700" />
                        <span>Interactive Boutique POS Sandbox</span>
                    </div>
                    <h2 className="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                        লাইভ ফ্যাশন বারকোড স্ক্যানার ও থার্মাল বিল সিমুলেটর 🏷️
                    </h2>
                    <p className="mt-3 text-slate-600 text-base">
                        পোশাকের সাইজ ও কালার ভ্যারিয়্যান্ট নির্বাচন করুন, বারকোড স্ক্যান করুন এবং ডানপাশে লাইভ ৩-ইঞ্চি থার্মাল মেমো তৈরি প্রত্যক্ষ করুন।
                    </p>
                </div>

                {scanNotification && (
                    <div className="max-w-xl mx-auto mb-6 p-3 rounded-2xl bg-amber-50 border border-amber-300 text-amber-900 font-bold text-center text-xs sm:text-sm animate-in fade-in zoom-in-95 duration-200 flex items-center justify-center gap-2 shadow-sm">
                        <Sparkles className="w-4 h-4 text-amber-600" />
                        <span>{scanNotification}</span>
                    </div>
                )}

                <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <div className="lg:col-span-7 space-y-6">
                        
                        <div className="p-5 rounded-3xl bg-white border border-slate-200/90 shadow-sm">
                            <form onSubmit={handleBarcodeScan} className="flex gap-2">
                                <div className="relative flex-1">
                                    <Barcode className="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" />
                                    <input
                                        type="text"
                                        value={barcodeInput}
                                        onChange={(e) => setBarcodeInput(e.target.value)}
                                        placeholder="বারকোড গান স্ক্যান করুন (যেমন: 894120260101)..."
                                        className="w-full pl-11 pr-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-amber-500 focus:outline-none text-xs sm:text-sm font-mono text-slate-900 transition"
                                    />
                                </div>
                                <button
                                    type="submit"
                                    className="px-5 py-3 rounded-2xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-amber-500/20 active:scale-95 transition cursor-pointer shrink-0"
                                >
                                    স্ক্যান
                                </button>
                            </form>
                            <div className="mt-2.5 flex items-center gap-2 text-[11px] text-slate-500">
                                <span>কুইক স্ক্যান টেস্ট:</span>
                                <button
                                    type="button"
                                    onClick={() => inventory[0] && handleAddToCart(inventory[0], 1)}
                                    className="px-2 py-0.5 rounded-md bg-slate-100 hover:bg-amber-100 text-slate-700 hover:text-amber-800 font-mono transition cursor-pointer"
                                >
                                    894120260101 (পাঞ্জাবি)
                                </button>
                                <button
                                    type="button"
                                    onClick={() => inventory[2] && handleAddToCart(inventory[2], 0)}
                                    className="px-2 py-0.5 rounded-md bg-slate-100 hover:bg-amber-100 text-slate-700 hover:text-amber-800 font-mono transition cursor-pointer"
                                >
                                    894120260312 (জিন্স)
                                </button>
                            </div>
                        </div>

                        <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            {inventory.map((prod) => {
                                const isSelected = selectedProduct?.id === prod.id;
                                return (
                                    <div
                                        key={prod.id}
                                        onClick={() => {
                                            setSelectedProduct(prod);
                                            setSelectedVariantIndex(0);
                                        }}
                                        className={`p-4 rounded-3xl border transition-all cursor-pointer text-left ${
                                            isSelected
                                                ? 'bg-amber-50/90 border-amber-400 shadow-md ring-2 ring-amber-500/20'
                                                : 'bg-white hover:bg-slate-50/80 border-slate-200/90 shadow-xs'
                                        }`}
                                    >
                                        <div className="flex items-start justify-between gap-2">
                                            <span className="text-xs font-bold px-2 py-0.5 rounded-md bg-slate-100 text-slate-700">
                                                {prod.category}
                                            </span>
                                            <span className="text-[11px] font-extrabold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">
                                                {prod.tag}
                                            </span>
                                        </div>

                                        <h3 className="mt-2 text-sm sm:text-base font-extrabold text-slate-900 leading-snug">
                                            {prod.name}
                                        </h3>
                                        <p className="text-xs text-slate-500 font-medium">
                                            {prod.name_bn}
                                        </p>

                                        <div className="mt-3 flex items-baseline justify-between">
                                            <span className="text-lg font-black text-amber-700">
                                                ৳{prod.price.toLocaleString()}
                                            </span>
                                            <span className="text-[11px] font-mono text-slate-400">
                                                SKU: {prod.sku}
                                            </span>
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                        {selectedProduct && (
                            <div className="p-5 sm:p-6 rounded-3xl bg-white border border-slate-200/90 shadow-sm text-left">
                                <div className="flex items-center justify-between pb-3 border-b border-slate-100">
                                    <div>
                                        <h4 className="text-sm sm:text-base font-black text-slate-900">
                                            {selectedProduct.name} — ভ্যারিয়্যান্ট ম্যাট্রিক্স
                                        </h4>
                                        <p className="text-xs text-slate-500">
                                            নির্দিষ্ট সাইজ ও কালার বেছে নিয়ে কাউন্টারে বিল করুন
                                        </p>
                                    </div>
                                    <div className="text-right">
                                        <span className="text-base font-black text-amber-700">
                                            ৳{selectedProduct.price.toLocaleString()}
                                        </span>
                                    </div>
                                </div>

                                <div className="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                    {selectedProduct.variants && selectedProduct.variants.map((variant, idx) => {
                                        const isVarSelected = selectedVariantIndex === idx;
                                        return (
                                            <button
                                                key={`${variant.size}-${variant.color}`}
                                                type="button"
                                                onClick={() => setSelectedVariantIndex(idx)}
                                                className={`p-3 rounded-2xl border text-left transition cursor-pointer ${
                                                    isVarSelected
                                                        ? 'bg-amber-600 text-white border-amber-600 shadow-md shadow-amber-600/25'
                                                        : 'bg-slate-50 hover:bg-slate-100 border-slate-200 text-slate-800'
                                                }`}
                                            >
                                                <div className="text-xs font-black">
                                                    সাইজ: {variant.size}
                                                </div>
                                                <div className={`text-[11px] truncate mt-0.5 ${isVarSelected ? 'text-amber-100' : 'text-slate-500'}`}>
                                                    রং: {variant.color}
                                                </div>
                                                <div className={`text-[10px] font-bold mt-1.5 ${isVarSelected ? 'text-white' : 'text-emerald-600'}`}>
                                                    স্টক: {variant.stock} পিস
                                                </div>
                                            </button>
                                        );
                                    })}
                                </div>

                                <div className="mt-5 flex items-center justify-between gap-4 pt-4 border-t border-slate-100">
                                    <div className="text-xs text-slate-500 flex items-center gap-1.5 font-mono">
                                        <Barcode className="w-4 h-4 text-slate-400" />
                                        <span>বারকোড: {selectedProduct.barcode}</span>
                                    </div>
                                    <button
                                        type="button"
                                        onClick={() => handleAddToCart(selectedProduct, selectedVariantIndex)}
                                        className="px-6 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-amber-500/20 active:scale-95 transition cursor-pointer flex items-center gap-2"
                                    >
                                        <ShoppingCart className="w-4 h-4" />
                                        <span>কাউন্টারে যোগ করুন</span>
                                    </button>
                                </div>
                            </div>
                        )}

                        <div className="p-5 rounded-3xl bg-amber-50/60 border border-amber-200/80 shadow-xs text-left">
                            <div className="flex items-center justify-between">
                                <div className="flex items-center gap-2">
                                    <Smartphone className="w-5 h-5 text-amber-700" />
                                    <h4 className="text-sm font-bold text-amber-950">
                                        ডিজিটাল বাকি খাতা ও বিকাশ SMS তাগাদা ফিচার
                                    </h4>
                                </div>
                                <span className="text-[11px] font-extrabold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                    অটো রিকভারি
                                </span>
                            </div>

                            <div className="mt-3 p-3.5 rounded-2xl bg-white border border-amber-200/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                <div>
                                    <div className="font-bold text-slate-900">
                                        {sampleDue.customer_name} ({sampleDue.phone})
                                    </div>
                                    <div className="text-slate-500 mt-0.5">
                                        বকেয়া: <span className="font-extrabold text-rose-600">৳{sampleDue.due_amount}</span> • {sampleDue.ward}
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    onClick={handleSendDueSms}
                                    className={`px-4 py-2 rounded-xl font-bold transition flex items-center justify-center gap-1.5 cursor-pointer shrink-0 ${
                                        smsSent
                                            ? 'bg-emerald-600 text-white'
                                            : 'bg-amber-600 hover:bg-amber-700 text-white shadow-xs'
                                    }`}
                                >
                                    <Send className="w-3.5 h-3.5" />
                                    <span>{smsSent ? 'SMS প্রেরিত হয়েছে!' : 'বিকাশ SMS তাগাদা পাঠান'}</span>
                                </button>
                            </div>
                        </div>

                    </div>
                    <div className="lg:col-span-5">
                        <div className="sticky top-24">
                            <div className="bg-white rounded-3xl shadow-xl border border-slate-300 overflow-hidden relative">
                                
                                <div className="bg-slate-900 text-white px-5 py-3 flex items-center justify-between text-xs">
                                    <div className="flex items-center gap-2">
                                        <Printer className="w-4 h-4 text-emerald-400" />
                                        <span className="font-bold">৩-ইঞ্চি থার্মাল পিওএস প্রিন্টার</span>
                                    </div>
                                    <span className="font-mono text-emerald-400 text-[11px]">80mm Paper • ESC/POS</span>
                                </div>

                                <div className="p-6 font-mono text-xs text-slate-800 bg-[#FCFDFD] space-y-4">
                                    
                                    <div className="text-center space-y-1 pb-3 border-b border-dashed border-slate-300">
                                        <h3 className="font-black text-sm tracking-tight text-slate-900 uppercase">
                                            {storeName}
                                        </h3>
                                        <p className="text-[11px] text-slate-500">
                                            {storeAddress}
                                        </p>
                                        <p className="text-[10px] text-slate-500">
                                            ভ্যাট রেজিস্ট্রেশন: 001928374-0101
                                        </p>
                                    </div>

                                    <div className="flex justify-between text-[11px] text-slate-500 pb-2 border-b border-dashed border-slate-200">
                                        <div>
                                            <div>বিল #: INV-2026-89421</div>
                                            <div>ক্যাশিয়ার: {cashierName}</div>
                                        </div>
                                        <div className="text-right">
                                            <div>{new Date().toLocaleDateString('en-GB')}</div>
                                            <div>10:45 AM</div>
                                        </div>
                                    </div>

                                    <div className="space-y-2.5 pb-3 border-b border-dashed border-slate-300">
                                        <div className="flex justify-between font-bold text-[11px] text-slate-900">
                                            <span>আইটেম বিবরণ</span>
                                            <span>মূল্য</span>
                                        </div>

                                        {cart.length === 0 ? (
                                            <div className="text-center py-6 text-slate-400 font-sans text-xs">
                                                কাউন্টার খালি। বামপাশ থেকে পণ্য স্ক্যান করুন।
                                            </div>
                                        ) : (
                                            cart.map((item) => (
                                                <div key={item.id} className="space-y-1">
                                                    <div className="flex justify-between items-start text-xs font-bold text-slate-900">
                                                        <span className="leading-tight">{item.name}</span>
                                                        <span>৳{(item.price * item.quantity).toLocaleString()}</span>
                                                    </div>
                                                    <div className="flex justify-between items-center text-[10px] text-slate-500 font-sans">
                                                        <span>[{item.color} | সাইজ: {item.size}] @ ৳{item.price}</span>
                                                        
                                                        <div className="flex items-center gap-1.5 font-sans">
                                                            <button
                                                                type="button"
                                                                onClick={() => updateQuantity(item.id, -1)}
                                                                className="w-4 h-4 rounded bg-slate-200 flex items-center justify-center hover:bg-slate-300 transition"
                                                            >
                                                                <Minus className="w-2.5 h-2.5" />
                                                            </button>
                                                            <span className="font-bold text-slate-900">{item.quantity}</span>
                                                            <button
                                                                type="button"
                                                                onClick={() => updateQuantity(item.id, 1)}
                                                                className="w-4 h-4 rounded bg-slate-200 flex items-center justify-center hover:bg-slate-300 transition"
                                                            >
                                                                <Plus className="w-2.5 h-2.5" />
                                                            </button>
                                                            <button
                                                                type="button"
                                                                onClick={() => removeItem(item.id)}
                                                                className="text-rose-500 hover:text-rose-700 ml-1 transition"
                                                            >
                                                                <Trash2 className="w-3 h-3" />
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            ))
                                        )}
                                    </div>

                                    <div className="space-y-1.5 text-xs">
                                        <div className="flex justify-between text-slate-600">
                                            <span>সাবটোটাল:</span>
                                            <span>৳{subtotal.toLocaleString()}</span>
                                        </div>
                                        <div className="flex justify-between text-slate-600">
                                            <span>ভ্যাট (৫%):</span>
                                            <span>৳{vat.toLocaleString()}</span>
                                        </div>
                                        {discount > 0 && (
                                            <div className="flex justify-between text-emerald-600 font-bold">
                                                <span>স্পেশাল অফার ডিসকাউন্ট:</span>
                                                <span>-৳{discount}</span>
                                            </div>
                                        )}
                                        <div className="flex justify-between font-black text-sm text-slate-900 pt-2 border-t border-slate-300">
                                            <span>সর্বমোট প্রদেয়:</span>
                                            <span className="text-amber-700">৳{total.toLocaleString()}</span>
                                        </div>
                                    </div>

                                    <div className="pt-3 border-t border-dashed border-slate-300 font-sans">
                                        <span className="text-[11px] font-bold text-slate-600 block mb-2">
                                            পেমেন্ট মেথড নির্বাচন:
                                        </span>
                                        <div className="grid grid-cols-4 gap-1 text-[11px] font-bold">
                                            <button
                                                type="button"
                                                onClick={() => setPaymentMethod('cash')}
                                                className={`py-1.5 rounded-lg border text-center transition cursor-pointer ${
                                                    paymentMethod === 'cash' ? 'bg-amber-600 text-white border-amber-600' : 'bg-slate-50 text-slate-700'
                                                }`}
                                            >
                                                ক্যাশ
                                            </button>
                                            <button
                                                type="button"
                                                onClick={() => setPaymentMethod('bkash')}
                                                className={`py-1.5 rounded-lg border text-center transition cursor-pointer ${
                                                    paymentMethod === 'bkash' ? 'bg-pink-600 text-white border-pink-600' : 'bg-slate-50 text-slate-700'
                                                }`}
                                            >
                                                বিকাশ
                                            </button>
                                            <button
                                                type="button"
                                                onClick={() => setPaymentMethod('split')}
                                                className={`py-1.5 rounded-lg border text-center transition cursor-pointer ${
                                                    paymentMethod === 'split' ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-slate-50 text-slate-700'
                                                }`}
                                            >
                                                স্প্লিট
                                            </button>
                                            <button
                                                type="button"
                                                onClick={() => setPaymentMethod('due')}
                                                className={`py-1.5 rounded-lg border text-center transition cursor-pointer ${
                                                    paymentMethod === 'due' ? 'bg-rose-600 text-white border-rose-600' : 'bg-slate-50 text-slate-700'
                                                }`}
                                            >
                                                বাকি
                                            </button>
                                        </div>
                                    </div>

                                    <div className="text-center pt-3 border-t border-dashed border-slate-300 space-y-2">
                                        <div className="font-mono text-center tracking-widest text-lg font-black text-slate-900">
                                            |||| | |||||| || ||||| |||
                                        </div>
                                        <p className="text-[10px] text-slate-500">
                                            Zengfy POS • ৭ দিনের মধ্যে পণ্য এক্সচেঞ্জ সুবিধা
                                        </p>
                                    </div>

                                </div>

                                <div className="p-4 bg-slate-50 border-t border-slate-200 font-sans">
                                    <button
                                        type="button"
                                        onClick={handlePrintBill}
                                        disabled={cart.length === 0}
                                        className="w-full py-3.5 rounded-2xl bg-gradient-to-r from-amber-600 via-orange-600 to-rose-600 hover:from-amber-700 hover:to-rose-700 text-white font-extrabold text-sm shadow-lg shadow-orange-500/25 active:scale-98 transition flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
                                    >
                                        <Printer className="w-4 h-4" />
                                        <span>থার্মাল মেমো প্রিন্ট করুন (১.৮ সেকেন্ড)</span>
                                    </button>

                                    {isPrinted && (
                                        <div className="mt-2.5 p-2 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold text-center flex items-center justify-center gap-1.5 animate-in fade-in duration-200">
                                            <CheckCircle className="w-4 h-4 text-emerald-600" />
                                            <span>মেমো প্রিন্ট সফল! স্টক স্বয়ংক্রিয়ভাবে আপডেট হয়েছে।</span>
                                        </div>
                                    )}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    );
}