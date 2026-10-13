import React, { useState } from 'react';

export default function KitchenBazarBookingSimulator({ simulator = {} }) {
  const [activeTab, setActiveTab] = useState('kitchen');
  const [kitchenSubTab, setKitchenSubTab] = useState('bazar');
  
  const initialItems = simulator?.kitchen_ledger?.items || [];
  const [bazarItems, setBazarItems] = useState(initialItems);
  const [hasAddedItem, setHasAddedItem] = useState(false);
  const [tipDistributed, setTipDistributed] = useState(false);

  const rooms = simulator?.booking_engine?.rooms || [];
  const [selectedRoomId, setSelectedRoomId] = useState(rooms[0]?.id || 'family_suite');
  const [nights, setNights] = useState(1);
  const [showVoucherModal, setShowVoucherModal] = useState(false);

  const selectedRoom = rooms.find((r) => r.id === selectedRoomId) || rooms[0] || { name: 'রিসোর্ট স্যুট', price: 8500, price_text: '৳৮,৫০০ প্রতি রাত' };
  const totalRoomBill = selectedRoom.price * nights;
  const otaCut = Math.round(totalRoomBill * 0.15);
  const totalBazarCost = bazarItems.reduce((acc, item) => acc + (item.cost || 0), 0) || 7400;

  const handleAddSampleItem = () => {
    if (!hasAddedItem) {
      setBazarItems([
        ...bazarItems,
        {
          id: 'item_5',
          name: 'সকালের তাজা ডিম ও গরুর খাঁটি দুধ',
          qty: '১ কেস এবং ৫ লিটার',
          rate: '৳৭৫০',
          cost: 750,
          vendor: 'ডেইরি ফার্ম মেমো #১০৪',
          status: 'ভেরিফায়েড',
        },
      ]);
      setHasAddedItem(true);
    }
  };

  return (
    <section id="kitchen-simulator" className="py-16 md:py-24 relative z-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center max-w-3xl mx-auto mb-10">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-900 text-xs font-bold mb-3">
            <span>✨</span>
            <span>ফ্ল্যাগশিপ ইন্টারঅ্যাক্টিভ সিমুলেটর</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight mb-3">
            কিচেন বাজার লেজার ও জিরো-কমিশন ডিরেক্ট বুকিং সিমুলেটর
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            রিসোর্টের বাবুর্চির কাঁচাবাজারের স্বচ্ছ ডিজিটাল হিসাব রাখুন এবং ওটিএ প্ল্যাটফর্মের ১৫-২০% কমিশন সম্পূর্ণ সেভ করে সরাসরি বুকিং নিন।
          </p>

          <div className="inline-flex p-1.5 mt-6 rounded-2xl bg-slate-100/90 border border-slate-200/80 shadow-inner">
            <button
              type="button"
              onClick={() => setActiveTab('kitchen')}
              className={`px-5 py-2.5 rounded-xl text-xs sm:text-sm font-black transition-all flex items-center gap-2 ${
                activeTab === 'kitchen'
                  ? 'bg-white text-slate-900 shadow-md border border-slate-200/50'
                  : 'text-slate-600 hover:text-slate-900'
              }`}
            >
              <span>🍳</span>
              <span>ট্যাব ১: কিচেন বাজার ও স্টাফ রোস্টার</span>
            </button>
            <button
              type="button"
              onClick={() => setActiveTab('booking')}
              className={`px-5 py-2.5 rounded-xl text-xs sm:text-sm font-black transition-all flex items-center gap-2 ${
                activeTab === 'booking'
                  ? 'bg-amber-600 text-white shadow-md shadow-amber-900/20'
                  : 'text-slate-600 hover:text-slate-900'
              }`}
            >
              <span>🌐</span>
              <span>ট্যাব ২: জিরো-কমিশন ডিরেক্ট বুকিং ইঞ্জিন</span>
            </button>
          </div>
        </div>

        {activeTab === 'kitchen' && (
          <div className="bg-white/90 backdrop-blur-2xl rounded-3xl border border-amber-100/90 shadow-xl p-5 sm:p-8 animate-in fade-in duration-200">
            <div className="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-slate-100">
              <div className="flex items-center gap-2 bg-slate-100 p-1 rounded-xl">
                <button
                  type="button"
                  onClick={() => setKitchenSubTab('bazar')}
                  className={`px-4 py-1.5 rounded-lg text-xs font-bold transition-all ${
                    kitchenSubTab === 'bazar'
                      ? 'bg-white text-slate-900 shadow-xs'
                      : 'text-slate-600 hover:text-slate-900'
                  }`}
                >
                  🥬 কাঁচাবাজার লেজার ও ভাউচার
                </button>
                <button
                  type="button"
                  onClick={() => setKitchenSubTab('staff')}
                  className={`px-4 py-1.5 rounded-lg text-xs font-bold transition-all ${
                    kitchenSubTab === 'staff'
                      ? 'bg-white text-slate-900 shadow-xs'
                      : 'text-slate-600 hover:text-slate-900'
                  }`}
                >
                  👥 ১৮ জন স্টাফের রোস্টার ও মজুরি
                </button>
              </div>

              <div className="flex items-center gap-3">
                <span className="text-xs font-bold text-slate-500">তারিখ: ১২ অক্টোবর, ২০২৬</span>
                <span className="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                  মোট বাজার: ৳{totalBazarCost.toLocaleString('bn-BD')}
                </span>
              </div>
            </div>

            {kitchenSubTab === 'bazar' && (
              <div className="mt-6">
                <div className="flex flex-wrap items-center justify-between gap-3 mb-4">
                  <h3 className="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span>📋 আজকের কাঁচাবাজার এন্ট্রি লিস্ট</span>
                    <span className="text-xs font-normal text-slate-500">(বাবুর্চির ক্যাশ মেমো অডিট সম্পন্ন)</span>
                  </h3>
                  {!hasAddedItem ? (
                    <button
                      type="button"
                      onClick={handleAddSampleItem}
                      className="px-3.5 py-1.5 rounded-xl text-xs font-bold text-amber-800 bg-amber-50 hover:bg-amber-100 border border-amber-200/80 transition-all flex items-center gap-1.5"
                    >
                      <span>➕ নতুন বাজার এন্ট্রি টেস্ট (দুধ ও ডিম)</span>
                    </button>
                  ) : (
                    <span className="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-200">
                      ✓ ডিম ও দুধ এন্ট্রি যুক্ত হয়েছে
                    </span>
                  )}
                </div>

                <div className="overflow-x-auto rounded-2xl border border-slate-200/70">
                  <table className="w-full text-left text-xs sm:text-sm">
                    <thead className="bg-slate-50/80 text-slate-700 font-bold border-b border-slate-200/70">
                      <tr>
                        <th className="py-3 px-4">আইটেম বিবরণ</th>
                        <th className="py-3 px-4">পরিমাণ</th>
                        <th className="py-3 px-4">দর</th>
                        <th className="py-3 px-4">মোট টাকা</th>
                        <th className="py-3 px-4">মেমো ও ভেন্ডর</th>
                        <th className="py-3 px-4 text-center">স্ট্যাটাস</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-slate-100">
                      {bazarItems.map((item) => (
                        <tr key={item.id} className="hover:bg-amber-50/40 transition-colors">
                          <td className="py-3 px-4 font-bold text-slate-900">{item.name}</td>
                          <td className="py-3 px-4 text-slate-600">{item.qty}</td>
                          <td className="py-3 px-4 text-slate-600 font-mono">{item.rate}</td>
                          <td className="py-3 px-4 font-bold text-amber-800 font-mono">
                            ৳{(item.cost || 0).toLocaleString('bn-BD')}
                          </td>
                          <td className="py-3 px-4 text-slate-500 text-xs">{item.vendor}</td>
                          <td className="py-3 px-4 text-center">
                            <span className="inline-flex px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                              ✓ {item.status}
                            </span>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>

                <div className="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div className="p-4 rounded-2xl bg-amber-50/80 border border-amber-200/60">
                    <div className="text-xs font-bold text-amber-900 mb-1">🔪 দৈনিক অপচয় রিপোর্ট</div>
                    <div className="text-xl font-black text-amber-800">০.৮ কেজি স্ক্র্যাপ</div>
                    <div className="text-[11px] text-amber-700 mt-0.5">মাছ ও মুরগির কাটিং স্ক্র্যাপ রেকর্ডকৃত</div>
                  </div>
                  <div className="p-4 rounded-2xl bg-slate-50 border border-slate-200/60">
                    <div className="text-xs font-bold text-slate-700 mb-1">💰 অপচয়ের আর্থিক ক্ষতি</div>
                    <div className="text-xl font-black text-slate-900">৳১৮০ মাত্র</div>
                    <div className="text-[11px] text-slate-500 mt-0.5">টোটাল বাজেটের মাত্র ২.৪% স্বাভাবিক ক্ষতি</div>
                  </div>
                  <div className="p-4 rounded-2xl bg-emerald-50/80 border border-emerald-200/60">
                    <div className="text-xs font-bold text-emerald-900 mb-1">⭐ কিচেন এফিসিয়েন্সি রেটিং</div>
                    <div className="text-xl font-black text-emerald-800">৯৭.৬% নিখুঁত</div>
                    <div className="text-[11px] text-emerald-700 mt-0.5">বাবুর্চির বাজার চুরিমুক্ত স্বচ্ছ অডিট স্কোর</div>
                  </div>
                </div>
              </div>
            )}

            {kitchenSubTab === 'staff' && (
              <div className="mt-6">
                <div className="flex flex-wrap items-center justify-between gap-3 mb-4">
                  <div>
                    <h3 className="text-base font-bold text-slate-900">রিসোর্টের ১৮ জন স্টাফের আজকের শিফট রোস্টার</h3>
                    <p className="text-xs text-slate-500">উপস্থিতি: ১৮ জনের ১৮ জনই উপস্থিত | দৈনিক মোট মজুরি: ৳১২,৬০০</p>
                  </div>
                  <button
                    type="button"
                    onClick={() => setTipDistributed(!tipDistributed)}
                    className="px-3.5 py-1.5 rounded-xl text-xs font-bold text-amber-900 bg-amber-100/90 hover:bg-amber-200/90 border border-amber-300/80 transition-all"
                  >
                    {tipDistributed ? '✓ টিপস বিতরণ সম্পন্ন (৳৩,২০০)' : '🎁 টিপস ও ওভারটাইম অটো-বিতরণ টেস্ট'}
                  </button>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                  <div className="p-4 rounded-2xl bg-slate-50/90 border border-slate-200/80">
                    <div className="flex items-center justify-between mb-2">
                      <span className="font-bold text-sm text-slate-900">👨‍🍳 হেড শেফ ও সহকারী বাবুর্চি (৩ জন)</span>
                      <span className="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                        সক্রিয়
                      </span>
                    </div>
                    <p className="text-xs text-slate-600 mb-2">শিফট: সকাল ৭:০০ থেকে রাত ১১:০০ (কিচেন ও ডাইনিং প্রিপারেশন)</p>
                    <div className="text-xs font-bold text-slate-500 flex items-center justify-between pt-2 border-t border-slate-200">
                      <span>দৈনিক মজুরি: ৳৩,৫০০</span>
                      {tipDistributed && <span className="text-amber-700 font-bold">+ ৳৮০০ টিপস বোনাস</span>}
                    </div>
                  </div>

                  <div className="p-4 rounded-2xl bg-slate-50/90 border border-slate-200/80">
                    <div className="flex items-center justify-between mb-2">
                      <span className="font-bold text-sm text-slate-900">🛎️ ফ্রন্ট ডেস্ক ও নাইট ম্যানেজার (৩ জন)</span>
                      <span className="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                        ডিউটিতে
                      </span>
                    </div>
                    <p className="text-xs text-slate-600 mb-2">শিফট: ২৪ ঘণ্টা রোস্টার (গেস্ট চেক-ইন ও সিকিউরিটি)</p>
                    <div className="text-xs font-bold text-slate-500 flex items-center justify-between pt-2 border-t border-slate-200">
                      <span>দৈনিক মজুরি: ৳৩,০০০</span>
                      {tipDistributed && <span className="text-amber-700 font-bold">+ ৳৬০০ টিপস বোনাস</span>}
                    </div>
                  </div>

                  <div className="p-4 rounded-2xl bg-slate-50/90 border border-slate-200/80">
                    <div className="flex items-center justify-between mb-2">
                      <span className="font-bold text-sm text-slate-900">🧹 রুম সার্ভিস ও হাউসকিপিং বয় (৮ জন)</span>
                      <span className="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                        উপস্থিত
                      </span>
                    </div>
                    <p className="text-xs text-slate-600 mb-2">শিফট: সকাল ৮:০০ থেকে বিকাল ৫:০০ (কটেজ প্রেপারেশন)</p>
                    <div className="text-xs font-bold text-slate-500 flex items-center justify-between pt-2 border-t border-slate-200">
                      <span>দৈনিক মজুরি: ৳৪,৩০০</span>
                      {tipDistributed && <span className="text-amber-700 font-bold">+ ৳১,৪০০ টিপস বোনাস</span>}
                    </div>
                  </div>

                  <div className="p-4 rounded-2xl bg-slate-50/90 border border-slate-200/80">
                    <div className="flex items-center justify-between mb-2">
                      <span className="font-bold text-sm text-slate-900">🛡️ সিকিউরিটি ও গার্ডেনার (৪ জন)</span>
                      <span className="text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                        পেট্রোল
                      </span>
                    </div>
                    <p className="text-xs text-slate-600 mb-2">শিফট: ১২ ঘণ্টা রোস্টার (গেট ও প্রপার্টি সুরক্ষা)</p>
                    <div className="text-xs font-bold text-slate-500 flex items-center justify-between pt-2 border-t border-slate-200">
                      <span>দৈনিক মজুরি: ৳১,৮০০</span>
                      {tipDistributed && <span className="text-amber-700 font-bold">+ ৳৪০০ টিপস বোনাস</span>}
                    </div>
                  </div>
                </div>
              </div>
            )}
          </div>
        )}

        {activeTab === 'booking' && (
          <div className="bg-white/90 backdrop-blur-2xl rounded-3xl border border-amber-200/90 shadow-2xl p-5 sm:p-8 animate-in fade-in duration-200">
            <div className="max-w-4xl mx-auto">
              <div className="text-center mb-8">
                <span className="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-900 border border-amber-200 mb-2">
                  <span>💡</span>
                  <span>ওটিএ প্ল্যাটফর্মের ১৫-২০% কমিশন বর্জন করুন</span>
                </span>
                <h3 className="text-xl sm:text-2xl font-black text-slate-900">
                  রিসোর্টের নিজস্ব জিরো-কমিশন ডিরেক্ট বুকিং ইঞ্জিন
                </h3>
                <p className="text-xs sm:text-sm text-slate-600 mt-1">
                  একটি রুম নির্বাচন করুন এবং দেখুন ওটিএ কমিশন বাঁচিয়ে কত টাকা সরাসরি আপনার ব্যাংক একাউন্টে জমা হয়।
                </p>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                {rooms.map((room) => {
                  const isSelected = room.id === selectedRoomId;
                  return (
                    <div
                      key={room.id}
                      onClick={() => setSelectedRoomId(room.id)}
                      className={`cursor-pointer p-4 rounded-2xl border transition-all ${
                        isSelected
                          ? 'bg-amber-50/90 border-amber-500 shadow-lg ring-2 ring-amber-500/30'
                          : 'bg-slate-50/70 border-slate-200 hover:bg-white hover:border-slate-300'
                      }`}
                    >
                      <div className="flex items-center justify-between mb-2">
                        <span className="font-black text-sm text-slate-900">{room.name}</span>
                        {isSelected && (
                          <span className="w-2 h-2 rounded-full bg-amber-600 animate-ping"></span>
                        )}
                      </div>
                      <p className="text-xs text-slate-500 mb-3 line-clamp-2">{room.tagline}</p>
                      <div className="text-lg font-black text-amber-800 font-mono mb-3">
                        {room.price_text}
                      </div>
                      <div className="space-y-1">
                        {(room.features || []).slice(0, 3).map((feat, i) => (
                          <div key={i} className="text-[11px] text-slate-600 flex items-center gap-1.5">
                            <span className="text-emerald-600 font-bold">✓</span>
                            <span>{feat}</span>
                          </div>
                        ))}
                      </div>
                    </div>
                  );
                })}
              </div>

              <div className="flex flex-wrap items-center justify-between gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200 mb-8">
                <div>
                  <span className="text-xs font-bold text-slate-700 block">অতিথির স্টে বা রাত সংখ্যা (Nights):</span>
                  <span className="text-xs text-slate-500">আপনার প্রয়োজনমতো রাত নির্বাচন করুন</span>
                </div>
                <div className="flex items-center gap-2">
                  {[1, 2, 3, 5, 7].map((num) => (
                    <button
                      key={num}
                      type="button"
                      onClick={() => setNights(num)}
                      className={`w-9 h-9 rounded-xl text-xs font-black transition-all ${
                        nights === num
                          ? 'bg-amber-600 text-white shadow-md'
                          : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'
                      }`}
                    >
                      {num} রাত
                    </button>
                  ))}
                </div>
              </div>

              <div className="p-6 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-amber-950 text-white shadow-xl mb-8">
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center divide-y sm:divide-y-0 sm:divide-x divide-slate-700/80">
                  <div className="pb-4 sm:pb-0">
                    <span className="text-xs font-semibold text-slate-400 block mb-1">মোট রুম ভাড়া ({nights} রাত)</span>
                    <span className="text-2xl font-black font-mono">৳{totalRoomBill.toLocaleString('bn-BD')}</span>
                    <span className="text-[11px] text-slate-400 block mt-1">{selectedRoom.name}</span>
                  </div>

                  <div className="py-4 sm:py-0">
                    <span className="text-xs font-semibold text-rose-300 block mb-1">ওটিএ প্ল্যাটফর্ম কমিশন (-১৫%)</span>
                    <span className="text-2xl font-black text-rose-400 font-mono">-৳{otaCut.toLocaleString('bn-BD')}</span>
                    <span className="text-[11px] text-rose-300/80 block mt-1">ওটিএ প্ল্যাটফর্মের ক্ষতি!</span>
                  </div>

                  <div className="pt-4 sm:pt-0">
                    <span className="text-xs font-semibold text-emerald-300 block mb-1">জেনফাই ডিরেক্ট বুকিং (০% কমিশন)</span>
                    <span className="text-2xl font-black text-emerald-400 font-mono">৳০ কমিশন</span>
                    <span className="text-[11px] text-emerald-300 font-bold block mt-1">১০০% টাকা আপনার ব্যাংক একাউন্টে</span>
                  </div>
                </div>

                <div className="mt-6 pt-5 border-t border-slate-700/80 flex flex-wrap items-center justify-between gap-3 text-xs">
                  <div className="flex items-center gap-2 text-emerald-300 font-bold">
                    <span>🎉</span>
                    <span>আপনি এই একটি বুকিংয়ে নিট বাঁচাচ্ছেন ৳{otaCut.toLocaleString('bn-BD')} টাকা!</span>
                  </div>
                  <div className="text-slate-400 text-[11px]">
                    স্বয়ংক্রিয় গেস্ট এসএমএস ও কিউআর রুম পাস সহ
                  </div>
                </div>
              </div>

              <div className="text-center">
                <button
                  type="button"
                  onClick={() => setShowVoucherModal(true)}
                  className="inline-flex items-center gap-2.5 px-8 py-4 rounded-2xl text-base font-black text-white bg-gradient-to-r from-amber-600 via-amber-700 to-slate-900 hover:opacity-95 shadow-xl shadow-amber-900/30 transition-all hover:scale-105 active:scale-95 cursor-pointer"
                >
                  <span>💳 বিকাশ ও কার্ড ডিরেক্ট বুকিং টেস্ট</span>
                  <span>(কিউআর পাস পপআপ)</span>
                  <span>→</span>
                </button>
                <div className="text-[11px] text-slate-500 mt-2">
                  ক্লিক করলে সঙ্গে সঙ্গে একটি প্রিমিয়াম ডিজিটাল বুকিং ভাউচার ও স্ক্যানযোগ্য রুম পাস প্রদর্শিত হবে
                </div>
              </div>
            </div>
          </div>
        )}
      </div>

      {showVoucherModal && (
        <div 
          className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md animate-in fade-in duration-200"
          onClick={() => setShowVoucherModal(false)}
        >
          <div 
            className="bg-white rounded-3xl shadow-2xl border border-amber-200 max-w-md w-full overflow-hidden animate-in zoom-in-95 duration-150"
            onClick={(e) => e.stopPropagation()}
          >
            <div className="bg-gradient-to-r from-amber-600 via-amber-700 to-slate-900 text-white p-5 text-center relative">
              <button
                type="button"
                onClick={() => setShowVoucherModal(false)}
                className="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 text-white flex items-center justify-center text-sm font-bold transition-all"
              >
                ✕
              </button>
              <div className="inline-block px-3 py-0.5 rounded-full bg-amber-400/20 text-amber-200 text-[11px] font-bold mb-1 border border-amber-300/30">
                ★ কনফার্মড ডিজিটাল বুকিং ভাউচার
              </div>
              <h4 className="text-lg font-black">Zengfy Sovereign Resort Pass</h4>
              <p className="text-xs text-amber-100/80 mt-0.5">রেফারেন্স কোড: #ZH-2026-8849</p>
            </div>

            <div className="p-6 space-y-4">
              <div className="p-3.5 rounded-2xl bg-amber-50/70 border border-amber-200/60">
                <div className="text-xs text-amber-800 font-bold mb-1">অতিথির নাম ও বিবরণ</div>
                <div className="text-sm font-bold text-slate-900">তানভীর আহমেদ (VIP Guest)</div>
                <div className="text-xs text-slate-600">+৮৮০১৭১২-***৪৫৯ | ঢাকা, বাংলাদেশ</div>
              </div>

              <div className="grid grid-cols-2 gap-3 text-xs">
                <div className="p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                  <span className="text-slate-500 block mb-0.5">রুমের ধরন</span>
                  <span className="font-bold text-slate-900">{selectedRoom.name}</span>
                </div>
                <div className="p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                  <span className="text-slate-500 block mb-0.5">স্টে মেয়াদ</span>
                  <span className="font-bold text-slate-900">{nights} রাত (১২ অক্টোবর)</span>
                </div>
              </div>

              <div className="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/70 flex items-center justify-between">
                <div>
                  <span className="text-xs text-slate-500 block">পরিশোধিত মোট টাকা</span>
                  <span className="text-lg font-black text-amber-800 font-mono">
                    ৳{totalRoomBill.toLocaleString('bn-BD')}
                  </span>
                </div>
                <div className="text-right">
                  <span className="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                    ✓ বিকাশ ইনস্ট্যান্ট পেইড
                  </span>
                  <span className="text-[10px] text-slate-400 block mt-0.5">০% ওটিএ ফি</span>
                </div>
              </div>

              <div className="text-center pt-2 pb-1">
                <div className="inline-block p-3 rounded-2xl bg-white border-2 border-dashed border-amber-300 shadow-sm">
                  <svg className="w-28 h-28 mx-auto" viewBox="0 0 100 100" fill="currentColor">
                    <rect x="10" y="10" width="25" height="25" fill="#0F172A" rx="4" />
                    <rect x="15" y="15" width="15" height="15" fill="#FFFFFF" rx="2" />
                    <rect x="19" y="19" width="7" height="7" fill="#B45309" />

                    <rect x="65" y="10" width="25" height="25" fill="#0F172A" rx="4" />
                    <rect x="70" y="15" width="15" height="15" fill="#FFFFFF" rx="2" />
                    <rect x="74" y="19" width="7" height="7" fill="#B45309" />

                    <rect x="10" y="65" width="25" height="25" fill="#0F172A" rx="4" />
                    <rect x="15" y="70" width="15" height="15" fill="#FFFFFF" rx="2" />
                    <rect x="19" y="74" width="7" height="7" fill="#B45309" />

                    <rect x="42" y="12" width="6" height="6" fill="#0F172A" />
                    <rect x="52" y="22" width="6" height="6" fill="#0F172A" />
                    <rect x="42" y="32" width="6" height="6" fill="#B45309" />
                    <rect x="12" y="45" width="6" height="6" fill="#0F172A" />
                    <rect x="24" y="52" width="6" height="6" fill="#0F172A" />
                    <rect x="45" y="45" width="10" height="10" fill="#B45309" rx="2" />
                    <rect x="65" y="42" width="6" height="6" fill="#0F172A" />
                    <rect x="78" y="52" width="6" height="6" fill="#0F172A" />
                    <rect x="42" y="68" width="6" height="6" fill="#0F172A" />
                    <rect x="52" y="78" width="6" height="6" fill="#0F172A" />
                    <rect x="68" y="72" width="6" height="6" fill="#0F172A" />
                    <rect x="78" y="82" width="6" height="6" fill="#B45309" />
                  </svg>
                  <span className="text-[10px] font-bold text-slate-500 uppercase tracking-wider block mt-1">
                    ফ্রন্ট ডেস্কে ১-সেকেন্ড স্ক্যান পাস
                  </span>
                </div>
              </div>
            </div>

            <div className="p-4 bg-slate-50 border-t border-slate-100 flex items-center gap-2">
              <button
                type="button"
                onClick={() => alert('ভাউচার ডাউনলোড সম্পন্ন!')}
                className="flex-1 py-2.5 rounded-xl text-xs font-bold text-white bg-amber-600 hover:bg-amber-700 transition-colors"
              >
                📥 ভাউচার সেভ করুন
              </button>
              <button
                type="button"
                onClick={() => setShowVoucherModal(false)}
                className="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-200 hover:bg-slate-100 transition-colors"
              >
                বন্ধ করুন
              </button>
            </div>
          </div>
        </div>
      )}
    </section>
  );
}
