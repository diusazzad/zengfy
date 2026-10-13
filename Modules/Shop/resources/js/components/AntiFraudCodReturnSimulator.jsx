import React, { useState } from 'react';

export default function AntiFraudCodReturnSimulator({ simulatorData = {} }) {
  const customers = simulatorData.customers || [
    {
      id: 'cust_safe',
      name: 'তানজিলা হক (বিশ্বস্ত ক্রেতা)',
      phone: '০১৭**-****৮২',
      full_phone: '০১৭২৮-৯৪৫১৮২',
      delivery_rate: 98,
      total_orders: 24,
      successful_orders: 23,
      rto_count: 0,
      risk_level: 'safe',
      risk_label: 'নিরাপদ বিশ্বস্ত ক্রেতা',
      location: 'ধানমন্ডি, ঢাকা',
      trust_badge: 'Verified VIP Buyer',
      notes: 'গত ২ বছরে ২৩টি সফল ডেলিভারি। কোনো কুরিয়ার রিজেকশন নেই।',
    },
    {
      id: 'cust_risky',
      name: 'মোঃ রাশেদ হাসান (উচ্চ ঝুঁকি)',
      phone: '০১৮**-****১৯',
      full_phone: '০১৮১৯-৭৬৩৪১৯',
      delivery_rate: 34,
      total_orders: 6,
      successful_orders: 2,
      rto_count: 4,
      risk_level: 'high_risk',
      risk_label: 'উচ্চ ঝুঁকিপূর্ণ ফেক ক্রেতা',
      location: 'আগ্রাবাদ, চট্টগ্রাম',
      trust_badge: 'High RTO Flagged',
      notes: 'পূর্বে ৪টি পার্সেল রিজেক্ট করেছে। ডেলিভারিম্যান পৌঁছালে ফোন বন্ধ রাখার ইতিহাস রয়েছে।',
    },
    {
      id: 'cust_new',
      name: 'ফারজানা ইয়াসমিন (নতুন ক্রেতা)',
      phone: '০১৯**-****৫০',
      full_phone: '০১৯১১-২২৩৩৫০',
      delivery_rate: 65,
      total_orders: 1,
      successful_orders: 0,
      rto_count: 0,
      risk_level: 'new_buyer',
      risk_label: 'নতুন ক্রেতা (যাচাইযোগ্য)',
      location: 'উপশহর, রাজশাহী',
      trust_badge: 'First Order Pending',
      notes: 'নেটওয়ার্কে নতুন নম্বর। ওটিপি বা ফোন কল কনফার্মেশন রিকমেন্ডেড।',
    },
  ];

  const products = simulatorData.products || [
    {
      id: 'prod_saree',
      name: 'ঢাকা জামদানি সিল্ক শাড়ি (হাতে বোনা)',
      price: 4500,
      price_text: '৳৪,৫০০',
      category: 'Traditional Fashion',
      delivery_charge: 130,
    },
    {
      id: 'prod_bag',
      name: 'প্রিমিয়াম জেনুইন লেদার স্লিং ব্যাগ',
      price: 1850,
      price_text: '৳১,৮৫০',
      category: 'Lifestyle & Bags',
      delivery_charge: 80,
    },
    {
      id: 'prod_watch',
      name: 'আল্ট্রা স্মার্টওয়াচ সিরিজ ৮ (অ্যামোলেড)',
      price: 2900,
      price_text: '৳২,৯০০',
      category: 'Smart Gadgets',
      delivery_charge: 100,
    },
  ];

  const couriers = simulatorData.couriers || [
    { id: 'steadfast', name: 'Steadfast Courier', logo_name: 'Steadfast', speed: '২৪-৪৮ ঘণ্টা', base_fee: '৳৮০' },
    { id: 'pathao', name: 'Pathao Courier', logo_name: 'Pathao', speed: '২৪ ঘণ্টা এক্সপ্রেস', base_fee: '৳৮৫' },
    { id: 'redx', name: 'RedX Logistics', logo_name: 'RedX', speed: '৪৮ ঘণ্টা ওয়াইড নেটওয়ার্ক', base_fee: '৳৭৫' },
  ];

  const [selectedCustomerId, setSelectedCustomerId] = useState(customers[0]?.id || 'cust_safe');
  const [selectedProductId, setSelectedProductId] = useState(products[0]?.id || 'prod_saree');
  const [selectedCourierId, setSelectedCourierId] = useState(couriers[0]?.id || 'steadfast');
  const [isAnalyzing, setIsAnalyzing] = useState(false);
  const [showLabelModal, setShowLabelModal] = useState(false);
  const [showAdvanceFeeModal, setShowAdvanceFeeModal] = useState(false);

  const currentCustomer = customers.find((c) => c.id === selectedCustomerId) || customers[0];
  const currentProduct = products.find((p) => p.id === selectedProductId) || products[0];
  const currentCourier = couriers.find((c) => c.id === selectedCourierId) || couriers[0];

  const handleAnalyze = () => {
    setIsAnalyzing(true);
    setTimeout(() => {
      setIsAnalyzing(false);
    }, 450);
  };

  const getScoreColor = (rate) => {
    if (rate >= 80) return 'text-emerald-600';
    if (rate >= 50) return 'text-amber-600';
    return 'text-rose-600';
  };

  const getScoreBg = (rate) => {
    if (rate >= 80) return 'bg-emerald-500';
    if (rate >= 50) return 'bg-amber-500';
    return 'bg-rose-500';
  };

  return (
    <section id="simulator" className="py-16 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-orange-100 text-orange-800 text-xs font-bold mb-3 border border-orange-200">
            <span>🛡️ লাইভ অ্যান্টি-ফ্রড ডেমো সিমুলেটর</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
            কুরিয়ার রিটার্ন ক্ষতি প্রতিরোধ ও এআই অর্ডার ভেরিফায়ার
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            নিচের ক্রেতা প্রোফাইল ও প্রোডাক্ট সিলেক্ট করে পরীক্ষা করুন কিভাবে জেনফায় এআই সেকেন্ডের মধ্যে ফেক অর্ডার ডিটেক্ট করে এবং ক্ষতি শূন্যে নামিয়ে আনে।
          </p>
        </div>

        {/* Simulator Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          {/* Left Column: Controls & Selectors (5 Cols) */}
          <div className="lg:col-span-5 space-y-6">
            {/* Step 1: Customer Profile Presets */}
            <div className="p-6 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md">
              <div className="flex items-center justify-between mb-4">
                <span className="text-xs font-bold uppercase tracking-wider text-slate-400">
                  ধাপ ১: কাস্টমার ট্রাস্ট প্রোফাইল
                </span>
                <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-mono">
                  LIVE DATABASE
                </span>
              </div>

              <div className="space-y-2.5">
                {customers.map((cust) => {
                  const isSelected = cust.id === selectedCustomerId;
                  return (
                    <button
                      key={cust.id}
                      type="button"
                      onClick={() => {
                        setSelectedCustomerId(cust.id);
                        handleAnalyze();
                      }}
                      className={`w-full text-left p-3.5 rounded-2xl border transition-all cursor-pointer ${
                        isSelected
                          ? 'border-orange-500 bg-orange-50/60 shadow-sm ring-2 ring-orange-500/20'
                          : 'border-slate-200/80 hover:border-slate-300 hover:bg-slate-50/60'
                      }`}
                    >
                      <div className="flex items-center justify-between">
                        <div className="flex items-center gap-2.5">
                          <span className="text-lg">
                            {cust.risk_level === 'safe' ? '🟢' : cust.risk_level === 'high_risk' ? '🔴' : '🟡'}
                          </span>
                          <div>
                            <div className="text-xs font-bold text-slate-900">{cust.name}</div>
                            <div className="text-[11px] font-mono text-slate-500">{cust.phone} • {cust.location}</div>
                          </div>
                        </div>
                        <div className="text-right">
                          <span
                            className={`text-xs font-black ${
                              cust.risk_level === 'safe'
                                ? 'text-emerald-700'
                                : cust.risk_level === 'high_risk'
                                ? 'text-rose-700'
                                : 'text-amber-700'
                            }`}
                          >
                            {cust.delivery_rate}%
                          </span>
                          <div className="text-[9.5px] text-slate-400 font-semibold">সাকসেস রেট</div>
                        </div>
                      </div>
                    </button>
                  );
                })}
              </div>
            </div>

            {/* Step 2: Order Item Selection */}
            <div className="p-6 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md">
              <div className="flex items-center justify-between mb-4">
                <span className="text-xs font-bold uppercase tracking-wider text-slate-400">
                  ধাপ ২: অর্ডারকৃত প্রোডাক্ট নির্বাচন
                </span>
                <span className="text-xs font-semibold text-slate-500 font-mono">
                  COD AMOUNT
                </span>
              </div>

              <div className="grid grid-cols-1 gap-2.5">
                {products.map((prod) => {
                  const isSelected = prod.id === selectedProductId;
                  return (
                    <button
                      key={prod.id}
                      type="button"
                      onClick={() => {
                        setSelectedProductId(prod.id);
                        handleAnalyze();
                      }}
                      className={`text-left p-3 rounded-2xl border transition-all cursor-pointer flex items-center justify-between ${
                        isSelected
                          ? 'border-violet-500 bg-violet-50/50 shadow-sm ring-2 ring-violet-500/20'
                          : 'border-slate-200/80 hover:border-slate-300 hover:bg-slate-50/60'
                      }`}
                    >
                      <div>
                        <div className="text-xs font-bold text-slate-900">{prod.name}</div>
                        <div className="text-[10.5px] text-slate-400">{prod.category} • ডেলিভারি ফি ৳{prod.delivery_charge}</div>
                      </div>
                      <div className="text-sm font-extrabold text-violet-700 font-mono">
                        {prod.price_text}
                      </div>
                    </button>
                  );
                })}
              </div>
            </div>

            {/* Step 3: Courier Selection */}
            <div className="p-6 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md">
              <span className="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-3">
                ধাপ ৩: পার্টনার কুরিয়ার এপিআই
              </span>
              <div className="grid grid-cols-3 gap-2">
                {couriers.map((courier) => {
                  const isSelected = courier.id === selectedCourierId;
                  return (
                    <button
                      key={courier.id}
                      type="button"
                      onClick={() => setSelectedCourierId(courier.id)}
                      className={`p-2.5 rounded-2xl border text-center transition-all cursor-pointer ${
                        isSelected
                          ? 'border-orange-500 bg-orange-500 text-white font-bold shadow-md shadow-orange-500/30'
                          : 'border-slate-200/80 bg-white hover:bg-slate-50 text-slate-700'
                      }`}
                    >
                      <div className="text-xs font-extrabold tracking-tight truncate">{courier.logo_name}</div>
                      <div className={`text-[10px] mt-0.5 ${isSelected ? 'text-orange-100' : 'text-slate-400'}`}>
                        {courier.speed}
                      </div>
                    </button>
                  );
                })}
              </div>

              {/* Check Score Action Button */}
              <button
                type="button"
                onClick={handleAnalyze}
                disabled={isAnalyzing}
                className="w-full mt-5 py-3.5 px-4 rounded-2xl font-bold text-sm text-white bg-gradient-to-r from-orange-600 via-orange-500 to-violet-600 hover:from-orange-700 hover:to-violet-700 shadow-lg shadow-orange-600/30 transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-98"
              >
                {isAnalyzing ? (
                  <>
                    <svg className="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                      <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                      <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                    </svg>
                    <span>এআই ডাটাবেসে হিস্ট্রি যাচাই হচ্ছে...</span>
                  </>
                ) : (
                  <>
                    <span>⚡ স্কোর ও ঝুঁকি বিশ্লেষণ করুন (Check Fraud Score)</span>
                  </>
                )}
              </button>
            </div>
          </div>

          {/* Right Column: AI Analysis Result & Action Cards (7 Cols) */}
          <div className="lg:col-span-7">
            <div className="p-6 sm:p-8 rounded-3xl bg-white/95 backdrop-blur-2xl border border-slate-200/90 shadow-xl relative overflow-hidden">
              {/* Decorative Glow */}
              <div
                className={`absolute -right-16 -top-16 w-48 h-48 rounded-full blur-3xl opacity-20 pointer-events-none ${
                  currentCustomer.risk_level === 'safe'
                    ? 'bg-emerald-500'
                    : currentCustomer.risk_level === 'high_risk'
                    ? 'bg-rose-500'
                    : 'bg-amber-500'
                }`}
              />

              {/* Analysis Header */}
              <div className="flex items-start justify-between pb-6 border-b border-slate-100 gap-4">
                <div>
                  <div className="flex items-center gap-2 mb-1">
                    <span className="text-xl">
                      {currentCustomer.risk_level === 'safe' ? '🛡️' : currentCustomer.risk_level === 'high_risk' ? '🚨' : '⚠️'}
                    </span>
                    <h3 className="text-lg sm:text-xl font-black text-slate-900 tracking-tight">
                      এআই রিয়েল-টাইম কুরিয়ার ফ্রড অডিট
                    </h3>
                  </div>
                  <p className="text-xs text-slate-500 font-mono">
                    TARGET: {currentCustomer.phone} | NETWORK RECORD: {currentCustomer.total_orders} ORDERS
                  </p>
                </div>

                <div className="text-right">
                  <div className={`text-2xl sm:text-3xl font-black tracking-tight ${getScoreColor(currentCustomer.delivery_rate)}`}>
                    {currentCustomer.delivery_rate}%
                  </div>
                  <div className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                    Trust Rating
                  </div>
                </div>
              </div>

              {/* Progress Bar Visualizer */}
              <div className="my-6">
                <div className="flex justify-between text-xs font-bold text-slate-700 mb-2">
                  <span>ডেলিভারি সফলতার নির্ভরযোগ্যতা স্কোর</span>
                  <span className={getScoreColor(currentCustomer.delivery_rate)}>
                    {currentCustomer.risk_label}
                  </span>
                </div>
                <div className="w-full h-3 rounded-full bg-slate-100 overflow-hidden p-0.5 border border-slate-200/80">
                  <div
                    className={`h-full rounded-full transition-all duration-700 ${getScoreBg(currentCustomer.delivery_rate)}`}
                    style={{ width: `${currentCustomer.delivery_rate}%` }}
                  />
                </div>
              </div>

              {/* Historical Telemetry Badges */}
              <div className="grid grid-cols-3 gap-2.5 sm:gap-3 p-3.5 rounded-2xl bg-slate-50 border border-slate-200/70 mb-6">
                <div className="text-center p-2 rounded-xl bg-white border border-slate-100">
                  <div className="text-xs text-slate-400 font-semibold">মোট অর্ডার</div>
                  <div className="text-base font-extrabold text-slate-900 mt-0.5">{currentCustomer.total_orders}টি</div>
                </div>
                <div className="text-center p-2 rounded-xl bg-white border border-slate-100">
                  <div className="text-xs text-slate-400 font-semibold">সফল রিসিভ</div>
                  <div className="text-base font-extrabold text-emerald-600 mt-0.5">{currentCustomer.successful_orders}টি</div>
                </div>
                <div className="text-center p-2 rounded-xl bg-white border border-slate-100">
                  <div className="text-xs text-slate-400 font-semibold">রিটার্ন (RTO)</div>
                  <div className={`text-base font-extrabold mt-0.5 ${currentCustomer.rto_count > 0 ? 'text-rose-600' : 'text-slate-700'}`}>
                    {currentCustomer.rto_count}টি
                  </div>
                </div>
              </div>

              {/* CASE 1: SAFE CUSTOMER (Green Shield) */}
              {currentCustomer.risk_level === 'safe' && (
                <div className="p-5 rounded-2xl bg-emerald-50/80 border border-emerald-200/80 space-y-4">
                  <div className="flex items-start gap-3">
                    <div className="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-md shadow-emerald-600/20">
                      ✓
                    </div>
                    <div>
                      <div className="text-sm font-black text-emerald-900">
                        COD নিরাপদ — স্বয়ংক্রিয়ভাবে অর্ডার কনফার্মড!
                      </div>
                      <p className="text-xs text-emerald-800 mt-0.5 leading-relaxed">
                        এই ক্রেতার অতীতে ২৩টি সফল ডেলিভারি রেকর্ড রয়েছে। কোনো আরটিও কুরিয়ার রিটার্ন ক্ষতি নেই। ক্যাশ অন ডেলিভারিতে পার্সেল পাঠানোর জন্য শতভাগ সুরক্ষিত।
                      </p>
                    </div>
                  </div>

                  <div className="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-emerald-200/60">
                    <div className="flex items-center gap-2">
                      <span className="text-xs font-bold text-slate-700 font-mono">
                        {currentCourier.logo_name} Tracking ID:
                      </span>
                      <span className="px-2.5 py-1 rounded-md bg-white border border-emerald-300 font-mono text-xs font-black text-emerald-800">
                        SF-DH-892147
                      </span>
                    </div>

                    <button
                      type="button"
                      onClick={() => setShowLabelModal(true)}
                      className="px-4 py-2 rounded-xl text-xs font-bold text-white bg-emerald-700 hover:bg-emerald-800 shadow-md shadow-emerald-700/25 transition-all flex items-center gap-1.5 cursor-pointer"
                    >
                      <span>🖨️ শিপমেন্ট লেবেল ও বারকোড দেখুন</span>
                    </button>
                  </div>
                </div>
              )}

              {/* CASE 2: HIGH RISK FAKE CUSTOMER (Red Shield) */}
              {currentCustomer.risk_level === 'high_risk' && (
                <div className="p-5 rounded-2xl bg-rose-50/90 border border-rose-200/90 space-y-4">
                  <div className="flex items-start gap-3">
                    <div className="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-md shadow-rose-600/20">
                      ✕
                    </div>
                    <div>
                      <div className="text-sm font-black text-rose-950 flex items-center gap-2">
                        <span>উচ্চ ঝুঁকি! ক্যাশ অন ডেলিভারি (COD) স্বয়ংক্রিয়ভাবে ব্লকড</span>
                        <span className="text-[10px] px-1.5 py-0.5 rounded bg-rose-200 text-rose-900 font-mono">BLOCKED</span>
                      </div>
                      <p className="text-xs text-rose-900 mt-0.5 leading-relaxed">
                        সতর্কতা: এই নম্বরে অতীতে ৪টি পার্সেল রিজেক্ট হয়েছে। পার্সেল পাঠালে কুরিয়ার চার্জ বাবদ <span className="font-bold underline">৳{currentProduct.delivery_charge} ক্ষতি</span> হওয়ার প্রবল সম্ভাবনা রয়েছে!
                      </p>
                    </div>
                  </div>

                  {/* Solution Draft Box */}
                  <div className="p-3.5 rounded-xl bg-white border border-rose-200/80">
                    <div className="flex items-center justify-between mb-2">
                      <span className="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                        <span>💬 স্বয়ংক্রিয় সমাধান: ২০০ টাকা অগ্রিম ডেলিভারি ফি চার্জ</span>
                      </span>
                      <span className="text-[10px] font-bold text-rose-600 font-mono">
                        Auto-Drafted
                      </span>
                    </div>
                    <p className="text-[11.5px] text-slate-600 font-mono bg-slate-50 p-2.5 rounded-lg border border-slate-200/60 leading-relaxed">
                      "প্রিয় {currentCustomer.name.split(' ')[0]}, আপনার {currentProduct.name} অর্ডারটি নিশ্চিত করতে কুরিয়ার সার্ভিস চার্জ বাবদ ৳২০০ এই বিকাশ লিংকে পরিশোধ করুন: pay.zengfy.com/d/{currentProduct.id}"
                    </p>
                    <div className="mt-3 flex justify-end">
                      <button
                        type="button"
                        onClick={() => setShowAdvanceFeeModal(true)}
                        className="px-4 py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 shadow-md shadow-rose-600/25 transition-all flex items-center gap-1.5 cursor-pointer"
                      >
                        <span>📲 হোয়াটসঅ্যাপে বিকাশ লিংক পাঠান</span>
                      </button>
                    </div>
                  </div>
                </div>
              )}

              {/* CASE 3: NEW BUYER (Yellow Warning Shield) */}
              {currentCustomer.risk_level === 'new_buyer' && (
                <div className="p-5 rounded-2xl bg-amber-50/90 border border-amber-200/90 space-y-4">
                  <div className="flex items-start gap-3">
                    <div className="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center font-bold text-lg shrink-0 shadow-md shadow-amber-500/20">
                      ?
                    </div>
                    <div>
                      <div className="text-sm font-black text-amber-950">
                        নতুন ক্রেতা — ফোন কল বা ওটিপি ভেরিফিকেশন প্রযোজ্য
                      </div>
                      <p className="text-xs text-amber-900 mt-0.5 leading-relaxed">
                        এই ক্রেতা পূর্বে নেটওয়ার্কে কোনো অর্ডার করেননি। ডেলিভারি নিশ্চিত করতে ১ ক্লিকে রোবোকল (IVR) বা ওটিপি এসএমএস কনফার্মেশন পাঠানো শ্রেয়।
                      </p>
                    </div>
                  </div>

                  <div className="flex flex-wrap items-center justify-between gap-2 pt-3 border-t border-amber-200/60">
                    <span className="text-xs font-semibold text-amber-900">
                      রিকমেন্ডেড অ্যাকশন:
                    </span>
                    <button
                      type="button"
                      onClick={() => alert(`[Zengfy IVR Dialing] ${currentCustomer.full_phone} নম্বরে স্বয়ংক্রিয় রোবোকল রিং হচ্ছে... ক্রেতা '১' চেপে অর্ডার নিশ্চিত করবেন।`)}
                      className="px-4 py-2 rounded-xl text-xs font-bold text-slate-900 bg-amber-400 hover:bg-amber-300 shadow-sm transition-all flex items-center gap-1.5 cursor-pointer"
                    >
                      <span>📞 ১-ক্লিকে রোবোকল ভেরিফিকেশন পাঠান</span>
                    </button>
                  </div>
                </div>
              )}

              {/* Order Breakdown Snapshot */}
              <div className="mt-6 pt-5 border-t border-slate-100 flex flex-wrap items-center justify-between text-xs text-slate-500 gap-2">
                <div>
                  <span className="font-bold text-slate-800">অর্ডার সারসংক্ষেপ:</span> {currentProduct.name} ({currentProduct.price_text})
                </div>
                <div>
                  <span className="font-bold text-slate-800">নির্বাচিত কুরিয়ার:</span> {currentCourier.name} ({currentCourier.base_fee})
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* MODAL 1: 4x6 Printable Shipping Label & Barcode */}
      {showLabelModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4">
          <div className="w-full max-w-md bg-white rounded-3xl p-6 shadow-2xl border border-slate-200 text-left relative">
            <button
              type="button"
              onClick={() => setShowLabelModal(false)}
              className="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-sm cursor-pointer"
            >
              ✕
            </button>

            <div className="text-center pb-4 border-b border-slate-200">
              <span className="text-xs font-bold text-orange-600 uppercase tracking-widest block">
                STEADFAST COURIER EXPRESS DISPATCH
              </span>
              <h4 className="text-lg font-black text-slate-900 mt-1">
                অফিসিয়াল শিপমেন্ট প্যাকিং লেবেল
              </h4>
            </div>

            {/* Label Body (ESC/POS 4x6 Simulation) */}
            <div className="my-4 p-4 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-300 space-y-3 font-mono text-xs">
              <div className="flex justify-between items-center pb-2 border-b border-slate-200">
                <span className="font-bold text-slate-700">TRACKING: SF-DH-892147</span>
                <span className="font-extrabold text-emerald-700 px-2 py-0.5 rounded bg-emerald-100">COD VERIFIED</span>
              </div>

              {/* Barcode Mockup */}
              <div className="py-2 text-center bg-white rounded-lg border border-slate-200">
                <div className="text-2xl tracking-[0.25em] font-black text-slate-900">
                  ||| | ||||| || |||| ||| ||
                </div>
                <div className="text-[10px] text-slate-400 mt-0.5">SF-892147-BD-2026</div>
              </div>

              <div className="grid grid-cols-2 gap-2 pt-1 text-[11px]">
                <div>
                  <span className="text-slate-400 block">প্রাপক (Customer):</span>
                  <strong className="text-slate-900">{currentCustomer.name}</strong>
                  <div className="text-slate-600">{currentCustomer.full_phone}</div>
                  <div className="text-slate-500">{currentCustomer.location}</div>
                </div>
                <div>
                  <span className="text-slate-400 block">প্রেরক (Merchant):</span>
                  <strong className="text-slate-900">Zengfy Fashion D2C</strong>
                  <div className="text-slate-600">০১৭০০-০০০০০০</div>
                  <div className="text-slate-500">বনানী, ঢাকা</div>
                </div>
              </div>

              <div className="pt-2 border-t border-slate-200 flex justify-between items-center text-xs">
                <span>আইটেম: {currentProduct.name}</span>
                <span className="font-bold text-slate-900">{currentProduct.price_text}</span>
              </div>
              <div className="flex justify-between items-center text-sm font-black text-slate-900 pt-1">
                <span>সিওডি আদায় (Collect COD):</span>
                <span className="text-orange-600">৳{currentProduct.price + currentProduct.delivery_charge}</span>
              </div>
            </div>

            <div className="flex gap-2">
              <button
                type="button"
                onClick={() => {
                  alert('[Printer Connection] থার্মাল লেবেল প্রিন্টারে কমান্ড পাঠানো হয়েছে।');
                  setShowLabelModal(false);
                }}
                className="flex-1 py-3 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all cursor-pointer"
              >
                🖨️ থার্মাল লেবেল প্রিন্ট করুন
              </button>
              <button
                type="button"
                onClick={() => setShowLabelModal(false)}
                className="px-4 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all cursor-pointer"
              >
                বন্ধ করুন
              </button>
            </div>
          </div>
        </div>
      )}

      {/* MODAL 2: Advance Delivery Fee WhatsApp / bKash Draft */}
      {showAdvanceFeeModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4">
          <div className="w-full max-w-md bg-white rounded-3xl p-6 shadow-2xl border border-slate-200 text-left relative">
            <button
              type="button"
              onClick={() => setShowAdvanceFeeModal(false)}
              className="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-sm cursor-pointer"
            >
              ✕
            </button>

            <div className="text-center pb-4 border-b border-slate-200">
              <div className="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-2xl mx-auto mb-2">
                🛡️
              </div>
              <h4 className="text-lg font-black text-slate-900">
                অগ্রিম ডেলিভারি ফি কালেকশন লিংক
              </h4>
              <p className="text-xs text-slate-500 mt-1">
                অতীতে পার্সেল রিজেকশনের কারণে ক্রেতার কাছ থেকে নিশ্চিত ২০০ টাকা চার্জ
              </p>
            </div>

            <div className="my-5 p-4 rounded-2xl bg-emerald-50/90 border border-emerald-200 space-y-2">
              <div className="flex items-center justify-between text-xs font-bold text-emerald-900">
                <span>WhatsApp Message Draft:</span>
                <span className="text-[10px] bg-white px-2 py-0.5 rounded border border-emerald-300">Ready</span>
              </div>
              <div className="p-3 bg-white rounded-xl text-xs text-slate-700 leading-relaxed font-sans border border-emerald-100">
                "আসসালামু আলাইকুম {currentCustomer.name.split(' ')[0]}! আপনার <strong>{currentProduct.name}</strong> ({currentProduct.price_text}) অর্ডারটির জন্য ধন্যবাদ। কুরিয়ার পলিসি অনুযায়ী ২০০ টাকা অগ্রিম ডেলিভারি চার্জ পরিশোধ সাপেক্ষে পার্সেল ডিসপ্যাচ করা হবে।<br /><br />
                👉 <strong>বিকাশ মার্চেন্ট পেমেন্ট লিংক:</strong><br />
                <span className="text-blue-600 font-mono underline">https://pay.zengfy.com/advance/200?ref=ord_9812</span><br /><br />
                বাকি ৳{currentProduct.price} টাকা পার্সেল হাতে পেয়ে ক্যাশ পরিশোধ করবেন।"
              </div>
            </div>

            <div className="flex gap-2">
              <button
                type="button"
                onClick={() => {
                  alert(`[WhatsApp API] ${currentCustomer.full_phone} নম্বরে ২০০ টাকা অগ্রিম ফি এর মেসেজ ড্রাফট পাঠানো হয়েছে!`);
                  setShowAdvanceFeeModal(false);
                }}
                className="flex-1 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-all flex items-center justify-center gap-1.5 cursor-pointer"
              >
                <span>📲 হোয়াটসঅ্যাপে তাৎক্ষণিক সেন্ড করুন</span>
              </button>
              <button
                type="button"
                onClick={() => setShowAdvanceFeeModal(false)}
                className="px-4 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all cursor-pointer"
              >
                বাতিল
              </button>
            </div>
          </div>
        </div>
      )}
    </section>
  );
}
