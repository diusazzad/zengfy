import React, { useState } from 'react';

export default function RadiusRentalMeshSimulator({ simulator = {} }) {
  const locations = simulator.locations || [];
  const radiusOptions = simulator.radius_options || [
    { id: '1km', radius_km: 1, label: '১ কিমি রেডিয়াস', price: 50, price_text: '৳৫০', desc: 'হাঁটা দূরত্বে অফিস বা ক্যাম্পাসের কাছাকাছি', badge: 'জনপ্রিয়' },
    { id: '3km', radius_km: 3, label: '৩ কিমি রেডিয়াস', price: 250, price_text: '৳২৫০', desc: 'পুরো এলাকার মেগা কভারেজ', badge: 'মেগা' },
  ];
  const sampleFlats = simulator.sample_flats || [];

  const [selectedLocationId, setSelectedLocationId] = useState(locations[0]?.id || 'mirpur10');
  const [selectedRadiusId, setSelectedRadiusId] = useState('1km');
  const [selectedFlatId, setSelectedFlatId] = useState(sampleFlats[0]?.id || 'flat_1');
  
  // Unlocked status per flat or whole area
  const [unlockedFlats, setUnlockedFlats] = useState({});
  const [showPaymentModal, setShowPaymentModal] = useState(false);
  const [paymentProcessing, setPaymentProcessing] = useState(false);
  const [selectedGateway, setSelectedGateway] = useState('bkash');

  const currentLocation = locations.find((l) => l.id === selectedLocationId) || locations[0] || {};
  const currentRadius = radiusOptions.find((r) => r.id === selectedRadiusId) || radiusOptions[0] || {};
  const currentFlat = sampleFlats.find((f) => f.id === selectedFlatId) || sampleFlats[0] || {};
  const isCurrentUnlocked = !!unlockedFlats[currentFlat.id];

  const formatBDT = (num) => {
    return new Intl.NumberFormat('en-IN', { maximumFractionDigits: 0 }).format(num);
  };

  const handleStartUnlock = () => {
    setShowPaymentModal(true);
  };

  const handleConfirmMicroPayment = () => {
    setPaymentProcessing(true);
    setTimeout(() => {
      setUnlockedFlats((prev) => ({
        ...prev,
        [currentFlat.id]: true,
        // unlock all flats in current radius as per concept
        flat_1: true,
        flat_2: true,
        flat_3: true,
      }));
      setPaymentProcessing(false);
      setShowPaymentModal(false);
    }, 1200);
  };

  return (
    <section id="simulator" className="py-20 relative bg-white/60 border-y border-slate-200/80 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-800 border border-indigo-200/60 mb-3">
            <span>📍 লাইভ হাইপারলোকাল জিপিএস মেশ</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            রেডিয়াস-বেসড টু-লেট ফাইন্ডার ও পে-পার-কিমি আনলকার
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            এরিয়া ও রেডিয়াস সিলেক্ট করে দেখুন কীভাবে মাত্র ৳৫০ মাইক্রো-পেমেন্টে বাড়িওয়ালার গোপন নম্বর ও সম্পূর্ণ ঠিকানা আনলক হয়।
          </p>
        </div>

        {/* 1. Location & Radius Controls Bar */}
        <div className="bg-white/90 backdrop-blur-xl rounded-3xl p-6 border border-slate-200/80 shadow-md max-w-5xl mx-auto mb-10">
          <div className="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            {/* Location Selector (7 cols) */}
            <div className="md:col-span-7">
              <label className="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                ১. কাঙ্ক্ষিত এরিয়া নির্বাচন করুন (Location):
              </label>
              <div className="relative">
                <select
                  value={selectedLocationId}
                  onChange={(e) => setSelectedLocationId(e.target.value)}
                  className="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-sm font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer appearance-none"
                >
                  {locations.map((loc) => (
                    <option key={loc.id} value={loc.id}>
                      📍 {loc.name}
                    </option>
                  ))}
                </select>
                <div className="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 font-bold">
                  ▼
                </div>
              </div>
            </div>

            {/* Radius Switcher (5 cols) */}
            <div className="md:col-span-5">
              <label className="block text-xs font-black uppercase tracking-wider text-slate-500 mb-2">
                ২. জিপিএস মেশ রেডিয়াস:
              </label>
              <div className="grid grid-cols-2 gap-2">
                {radiusOptions.map((rad) => (
                  <button
                    key={rad.id}
                    type="button"
                    onClick={() => setSelectedRadiusId(rad.id)}
                    className={`p-2.5 rounded-2xl text-center border transition-all flex flex-col items-center justify-center ${
                      selectedRadiusId === rad.id
                        ? 'bg-indigo-700 text-white border-indigo-700 shadow-md shadow-indigo-700/20 font-bold'
                        : 'bg-slate-50 text-slate-700 hover:bg-slate-100 border-slate-200'
                    }`}
                  >
                    <span className="text-xs font-bold">{rad.label}</span>
                    <span className={`text-[10px] mt-0.5 font-mono ${selectedRadiusId === rad.id ? 'text-emerald-300' : 'text-emerald-600 font-bold'}`}>
                      আনলক: {rad.price_text}
                    </span>
                  </button>
                ))}
              </div>
            </div>
          </div>
        </div>

        {/* 2. Main Simulation Grid: GPS Mesh Map (Left) + Flat Details & Unmasker (Right) */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start max-w-6xl mx-auto">
          {/* LEFT: Simulated GPS Geofence Map Viewport (7 cols) */}
          <div className="lg:col-span-7 space-y-4">
            <div className="bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 rounded-3xl p-6 border border-slate-800 shadow-2xl text-white relative overflow-hidden min-h-[460px] flex flex-col justify-between">
              {/* Radar Geofence Mesh Animation Effect */}
              <div 
                aria-hidden="true" 
                className="absolute inset-0 opacity-20 bg-[radial-gradient(#4338ca_1px,transparent_1px)] [background-size:16px_16px]"
              />

              {/* Geofence Circles */}
              <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                <div className={`rounded-full border border-indigo-500/30 flex items-center justify-center animate-pulse transition-all ${
                  selectedRadiusId === '1km' ? 'w-64 h-64' : 'w-96 h-96'
                }`}>
                  <div className="w-32 h-32 rounded-full border border-emerald-500/40 flex items-center justify-center">
                    <div className="w-16 h-16 rounded-full bg-indigo-600/20 flex items-center justify-center">
                      <span className="w-4 h-4 rounded-full bg-emerald-400 animate-ping"></span>
                    </div>
                  </div>
                </div>
              </div>

              {/* Viewport Top Bar */}
              <div className="relative z-10 flex flex-wrap items-center justify-between gap-2 pb-3 border-b border-slate-800">
                <div className="flex items-center gap-2">
                  <span className="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                  <span className="text-xs font-bold text-emerald-300">
                    GPS Geofence: {currentLocation.center}
                  </span>
                </div>
                <div className="text-[11px] font-mono text-slate-400 bg-slate-800/80 px-2.5 py-0.5 rounded-full border border-slate-700">
                  রেডিয়াস: {currentRadius.radius_km} কিমি ({selectedRadiusId === '1km' ? currentLocation.listings_1km : currentLocation.listings_3km} টি টু-লেট শনাক্ত)
                </div>
              </div>

              {/* Map Floating Flat Markers (Interactive Pins) */}
              <div className="relative z-10 py-12 space-y-4">
                <div className="text-center text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">
                  ম্যাপ পিনে ক্লিক করে ফ্ল্যাট নির্বাচন করুন:
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                  {sampleFlats.map((flat) => {
                    const isSelected = selectedFlatId === flat.id;
                    const isUnlocked = !!unlockedFlats[flat.id];

                    return (
                      <button
                        key={flat.id}
                        type="button"
                        onClick={() => setSelectedFlatId(flat.id)}
                        className={`p-3.5 rounded-2xl text-left border transition-all relative ${
                          isSelected
                            ? 'bg-indigo-950/90 border-indigo-400 shadow-lg shadow-indigo-600/25 scale-105'
                            : 'bg-slate-900/80 border-slate-800 hover:border-slate-700'
                        }`}
                      >
                        <div className="flex items-center justify-between mb-1.5">
                          <span className="text-lg">{flat.photo}</span>
                          <span className={`text-[10px] font-bold px-2 py-0.5 rounded-full ${
                            isUnlocked ? 'bg-emerald-950 text-emerald-300 border border-emerald-700' : 'bg-slate-800 text-slate-400'
                          }`}>
                            {isUnlocked ? '🔓 আনলকড' : '🔒 লকড'}
                          </span>
                        </div>
                        <div className="text-xs font-bold text-white line-clamp-1">
                          {flat.title.split('(')[0].trim()}
                        </div>
                        <div className="text-sm font-black text-emerald-400 mt-1">
                          ৳{formatBDT(flat.rent)} <span className="text-[10px] font-normal text-slate-400">/ মাস</span>
                        </div>
                        <div className="text-[10px] text-slate-400 mt-0.5">
                          {flat.distance}
                        </div>
                      </button>
                    );
                  })}
                </div>
              </div>

              {/* Viewport Bottom Status */}
              <div className="relative z-10 pt-3 border-t border-slate-800 flex items-center justify-between text-xs text-slate-400">
                <span>📍 জিপিএস মেশ: ০% ব্রোকার ফি</span>
                <span className="text-indigo-300 font-bold">
                  {isCurrentUnlocked ? '✓ মালিকের নম্বর সক্রিয়' : '🔒 আনলক করতে ৳৫০ প্রয়োজন'}
                </span>
              </div>
            </div>
          </div>

          {/* RIGHT: Flat Detail Card & Owner Unmasker (5 cols) */}
          <div className="lg:col-span-5 space-y-4">
            <div className="bg-white/95 backdrop-blur-xl rounded-3xl p-6 sm:p-7 border border-slate-200/90 shadow-xl space-y-5">
              {/* Flat Header */}
              <div className="pb-4 border-b border-slate-100">
                <div className="flex items-center justify-between gap-2 mb-1.5">
                  <span className="text-xs font-bold text-indigo-700 bg-indigo-50 px-2.5 py-0.5 rounded-md">
                    {currentFlat.type}
                  </span>
                  <span className="text-xs font-bold text-slate-500">
                    {currentFlat.floor}
                  </span>
                </div>
                <h3 className="text-lg font-black text-slate-900 leading-snug">
                  {currentFlat.title}
                </h3>
                <div className="text-2xl font-black text-indigo-700 mt-2">
                  ৳{formatBDT(currentFlat.rent)} <span className="text-xs font-semibold text-slate-500">/ মাস ({currentFlat.advance})</span>
                </div>
              </div>

              {/* Flat Specs Pills */}
              <div className="grid grid-cols-3 gap-2 text-center text-xs font-bold text-slate-700">
                <div className="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                  <span className="block text-slate-400 text-[10px] font-semibold">আয়তন</span>
                  {currentFlat.sqft} sqft
                </div>
                <div className="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                  <span className="block text-slate-400 text-[10px] font-semibold">রুম / বাথ</span>
                  {currentFlat.beds} বেড / {currentFlat.baths} বাথ
                </div>
                <div className="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                  <span className="block text-slate-400 text-[10px] font-semibold">গ্যাস লাইন</span>
                  {currentFlat.gas}
                </div>
              </div>

              {/* Masked vs Unmasked Landlord & Address Box */}
              <div className={`p-4 rounded-2xl border transition-all ${
                isCurrentUnlocked
                  ? 'bg-emerald-50/70 border-emerald-200 text-emerald-950'
                  : 'bg-slate-50 border-slate-200 text-slate-700'
              }`}>
                <div className="flex items-center justify-between text-xs font-bold mb-2">
                  <span>বাড়ির মালিক ও যোগাযোগের নম্বর</span>
                  <span className={`text-[10px] px-2 py-0.5 rounded-md ${
                    isCurrentUnlocked ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600'
                  }`}>
                    {isCurrentUnlocked ? '✓ আনলকড' : '🔒 লকড'}
                  </span>
                </div>

                <div className="space-y-1.5 text-xs">
                  <div className="flex justify-between">
                    <span className="text-slate-500">মালিকের নাম:</span>
                    <span className="font-bold">{currentFlat.landlord_name}</span>
                  </div>

                  <div className="flex justify-between items-center py-1">
                    <span className="text-slate-500">ফোন নম্বর:</span>
                    <span className={`font-mono text-sm font-black ${
                      isCurrentUnlocked ? 'text-emerald-700' : 'text-slate-400 tracking-wider'
                    }`}>
                      {isCurrentUnlocked ? currentFlat.phone_unmasked : currentFlat.phone_masked}
                    </span>
                  </div>

                  <div className="pt-1.5 border-t border-slate-200/60">
                    <span className="text-slate-500 block mb-0.5">বাসার ঠিকানা:</span>
                    <span className={`font-semibold ${isCurrentUnlocked ? 'text-slate-900' : 'text-slate-400 italic'}`}>
                      {isCurrentUnlocked ? currentFlat.address_unmasked : currentFlat.address_masked}
                    </span>
                  </div>
                </div>
              </div>

              {/* Action Trigger Buttons */}
              <div>
                {!isCurrentUnlocked ? (
                  <button
                    type="button"
                    onClick={handleStartUnlock}
                    className="w-full py-3.5 rounded-2xl bg-indigo-700 hover:bg-indigo-800 text-white font-black text-sm shadow-xl shadow-indigo-700/25 transition-all flex items-center justify-center gap-2 group"
                  >
                    <span>{currentRadius.price_text} আনলক ডেমো টেস্ট করুন</span>
                    <span className="group-hover:translate-x-1 transition-transform">🔓</span>
                  </button>
                ) : (
                  <div className="space-y-2">
                    <a
                      href={`tel:${currentFlat.phone_unmasked}`}
                      className="w-full py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-sm shadow-lg shadow-emerald-600/25 transition-all flex items-center justify-center gap-2"
                    >
                      <span>📞 সরাসরি বাড়িওয়ালাকে কল দিন ({currentFlat.phone_unmasked})</span>
                    </a>
                    <button
                      type="button"
                      onClick={() => alert(`গুগল ম্যাপে নেভিগেশন সক্রিয় করা হয়েছে: ${currentFlat.address_unmasked}`)}
                      className="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs transition-all flex items-center justify-center gap-1.5"
                    >
                      <span>🗺️ গুগল ম্যাপসে হাঁটা দূরত্বের পথ দেখুন</span>
                    </button>
                  </div>
                )}
                <div className="mt-2 text-center text-[11px] text-slate-400">
                  {isCurrentUnlocked ? '✓ সকল নম্বর আনলক হয়েছে।' : '১-ট্যাপ বিকাশ/নগদ পেমেন্টে তৎক্ষণাৎ আনলক'}
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* 3. Micro-Payment 1-Tap Modal Simulator */}
        {showPaymentModal && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in duration-150">
            <div className="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-200 space-y-4">
              <div className="flex items-center justify-between pb-3 border-b border-slate-100">
                <div className="flex items-center gap-2">
                  <div className="w-8 h-8 rounded-xl bg-indigo-100 text-indigo-800 flex items-center justify-center font-bold">
                    💳
                  </div>
                  <div>
                    <h3 className="font-bold text-slate-900 text-sm">
                      পে-পার-কিমি মাইক্রো-পেমেন্ট
                    </h3>
                    <span className="text-[10px] text-slate-500">
                      {currentRadius.label} ({currentRadius.price_text})
                    </span>
                  </div>
                </div>
                <button
                  type="button"
                  onClick={() => setShowPaymentModal(false)}
                  className="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:text-slate-900 flex items-center justify-center"
                >
                  ✕
                </button>
              </div>

              <div className="p-4 rounded-2xl bg-indigo-50/60 border border-indigo-100 space-y-2 text-xs text-indigo-950">
                <div className="flex justify-between">
                  <span>নির্বাচিত এলাকা:</span>
                  <span className="font-bold">{currentLocation.name.split('—')[1] || currentLocation.name}</span>
                </div>
                <div className="flex justify-between">
                  <span>আনলক রেডিয়াস:</span>
                  <span className="font-bold">{currentRadius.radius_km} কিলোমিটার</span>
                </div>
                <div className="flex justify-between">
                  <span>মোট বাসার নম্বর আনলক:</span>
                  <span className="font-bold text-emerald-700">{selectedRadiusId === '1km' ? currentLocation.listings_1km : currentLocation.listings_3km} টি ফ্ল্যাট</span>
                </div>
                <div className="flex justify-between border-t border-indigo-200/60 pt-1.5 text-sm font-black">
                  <span>পেমেন্ট পরিমাণ:</span>
                  <span className="text-indigo-800">{currentRadius.price_text}</span>
                </div>
              </div>

              {/* Gateway Selection */}
              <div className="space-y-1.5">
                <label className="block text-xs font-bold text-slate-700">
                  পেমেন্ট গেটওয়ে:
                </label>
                <div className="grid grid-cols-2 gap-2">
                  <button
                    type="button"
                    onClick={() => setSelectedGateway('bkash')}
                    className={`p-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 ${
                      selectedGateway === 'bkash' ? 'border-pink-500 bg-pink-50 text-pink-700' : 'border-slate-200 text-slate-700'
                    }`}
                  >
                    <span>⚡ বিকাশ (bKash)</span>
                  </button>
                  <button
                    type="button"
                    onClick={() => setSelectedGateway('nagad')}
                    className={`p-3 rounded-xl border text-xs font-bold flex items-center justify-center gap-2 ${
                      selectedGateway === 'nagad' ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-slate-200 text-slate-700'
                    }`}
                  >
                    <span>📱 নগদ (Nagad)</span>
                  </button>
                </div>
              </div>

              <div className="pt-2">
                <button
                  type="button"
                  disabled={paymentProcessing}
                  onClick={handleConfirmMicroPayment}
                  className="w-full py-3.5 rounded-xl bg-indigo-700 hover:bg-indigo-800 text-white font-bold text-xs shadow-md transition-all flex items-center justify-center gap-2"
                >
                  {paymentProcessing ? (
                    <span>ভেরিফাই হচ্ছে...</span>
                  ) : (
                    <span>{currentRadius.price_text} প্রদান সম্পন্ন করুন</span>
                  )}
                </button>
              </div>
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
