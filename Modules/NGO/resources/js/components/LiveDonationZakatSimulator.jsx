import React, { useState, useId } from 'react';

export default function LiveDonationZakatSimulator({ simulator = {} }) {
  const campaigns = simulator.campaigns || [];
  const presetAmounts = simulator.preset_amounts || [1000, 2500, 5000, 10000];
  const paymentChannels = simulator.payment_channels || [
    { id: 'bkash', name: 'বিকাশ (bKash)', icon: '⚡', charge: '০% গেটওয়ে ফি' },
    { id: 'nagad', name: 'নগদ (Nagad)', icon: '📱', charge: '০% গেটওয়ে ফি' },
    { id: 'bank', name: 'ব্যাংক ট্রান্সফার', icon: '🏦', charge: 'সরাসরি ট্রাস্ট একাউন্ট' },
    { id: 'expat', name: 'প্রবাসী কার্ড (USD)', icon: '🌍', charge: 'Visa / Mastercard' },
  ];

  const [activeCampaignId, setActiveCampaignId] = useState(campaigns[0]?.id || 'sylhet_flood');
  const [selectedAmount, setSelectedAmount] = useState(presetAmounts[1] || 2500);
  const [customAmount, setCustomAmount] = useState('');
  const [selectedChannel, setSelectedChannel] = useState(paymentChannels[0]?.id || 'bkash');
  const [isZakat, setIsZakat] = useState(false);
  const [donorName, setDonorName] = useState('মুহাম্মাদ আব্দুল্লাহ');

  // Interactive dynamic simulation states
  const [dynamicRaised, setDynamicRaised] = useState({});
  const [dynamicDonors, setDynamicDonors] = useState({});
  const [showReceiptModal, setShowReceiptModal] = useState(false);
  const [lastReceipt, setLastReceipt] = useState(null);

  const customAmountInputId = useId();
  const zakatCheckboxId = useId();
  const donorNameInputId = useId();

  const currentCampaign = campaigns.find((c) => c.id === activeCampaignId) || campaigns[0] || {};

  // Current raised amount with dynamic increments
  const raisedAmount = (currentCampaign.raised || 0) + (dynamicRaised[currentCampaign.id] || 0);
  const donorsCount = (currentCampaign.donors_count || 0) + (dynamicDonors[currentCampaign.id] || 0);
  const targetAmount = currentCampaign.target || 1000000;
  const progressPercent = Math.min(100, Math.round((raisedAmount / targetAmount) * 100));

  const formatBDT = (num) => {
    return new Intl.NumberFormat('en-IN', { maximumFractionDigits: 0 }).format(num);
  };

  const handleAmountSelect = (amount) => {
    setSelectedAmount(amount);
    setCustomAmount('');
  };

  const handleCustomAmountChange = (e) => {
    const val = e.target.value.replace(/\D/g, '');
    setCustomAmount(val);
    if (val) {
      setSelectedAmount(Number(val));
    }
  };

  const handleDonateDemo = () => {
    const donationValue = selectedAmount || 1000;
    
    // Update live counts
    setDynamicRaised((prev) => ({
      ...prev,
      [currentCampaign.id]: (prev[currentCampaign.id] || 0) + donationValue,
    }));
    setDynamicDonors((prev) => ({
      ...prev,
      [currentCampaign.id]: (prev[currentCampaign.id] || 0) + 1,
    }));

    // Generate simulated receipt
    const txHash = 'TXN-' + Math.random().toString(36).substring(2, 9).toUpperCase();
    const trackingId = currentCampaign.gps_prefix || '#ZNG-7842';

    setLastReceipt({
      id: txHash,
      trackingId,
      campaignTitle: currentCampaign.title,
      donorName: donorName || 'সম্মানিত দাতা',
      amount: donationValue,
      channel: paymentChannels.find((p) => p.id === selectedChannel)?.name || 'বিকাশ (bKash)',
      isZakat,
      timestamp: new Date().toLocaleString('bn-BD', { dateStyle: 'medium', timeStyle: 'short' }),
      reliefUnit: currentCampaign.relief_unit || 'ত্রাণ প্যাকেট ও শিশু পুষ্টি সামগ্রী',
    });

    setShowReceiptModal(true);
  };

  return (
    <section id="simulator" className="py-20 relative bg-white/60 border-y border-slate-200/80 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-teal-50 text-teal-800 border border-teal-200/60 mb-3">
            <span>🤝 লাইভ ইন্টারঅ্যাক্টিভ অনুদান ডেমো</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            লাইভ ডোনেশন ক্যাম্পেইন ও যাকাত ডিস্ট্রিবিউশন ভেরিফায়ার
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            যেকোনো ক্যাম্পেইন নির্বাচন করে অনুদান দিয়ে দেখুন কীভাবে তৎক্ষণাৎ অডিট মানি রিসিট প্রস্তুত হয় এবং জিও-ট্যাগড ত্রাণ বরাদ্দ যুক্ত হয়।
          </p>
        </div>

        {/* 1. Campaign Switcher Tabs (3 Campaigns) */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-3 mb-10 max-w-5xl mx-auto">
          {campaigns.map((camp) => (
            <button
              key={camp.id}
              type="button"
              onClick={() => setActiveCampaignId(camp.id)}
              className={`p-4 rounded-2xl text-left border transition-all flex flex-col justify-between ${
                activeCampaignId === camp.id
                  ? 'bg-teal-700 text-white border-teal-700 shadow-lg shadow-teal-700/20 scale-[1.02]'
                  : 'bg-white/80 hover:bg-white text-slate-700 border-slate-200/80 hover:border-teal-200'
              }`}
            >
              <div>
                <div className="flex items-center justify-between gap-2 mb-1.5">
                  <span className={`text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md ${
                    activeCampaignId === camp.id ? 'bg-teal-800 text-teal-200' : 'bg-teal-50 text-teal-800'
                  }`}>
                    {camp.badge}
                  </span>
                  <span className={`text-xs font-bold ${activeCampaignId === camp.id ? 'text-teal-200' : 'text-slate-500'}`}>
                    {camp.category}
                  </span>
                </div>
                <h3 className="text-sm font-bold leading-snug line-clamp-2">
                  {camp.title}
                </h3>
              </div>

              <div className="mt-3 pt-2 border-t border-white/20 text-xs flex justify-between">
                <span>লক্ষ্যমাত্রা: ৳{formatBDT(camp.target)}</span>
                <span className={`font-bold ${activeCampaignId === camp.id ? 'text-teal-200' : 'text-teal-700'}`}>
                  সংগৃহীত: ৳{formatBDT((camp.raised || 0) + (dynamicRaised[camp.id] || 0))}
                </span>
              </div>
            </button>
          ))}
        </div>

        {/* 2. Interactive Split Simulation Canvas */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          {/* LEFT: Live Campaign Tracker & Relief Allocation (6 cols) */}
          <div className="lg:col-span-6 space-y-6">
            <div className="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md">
              {/* Campaign Header */}
              <div className="flex items-center justify-between gap-3 pb-4 border-b border-slate-100">
                <div>
                  <span className="text-xs font-bold text-teal-700 uppercase tracking-wider">
                    {currentCampaign.category}
                  </span>
                  <h3 className="text-lg sm:text-xl font-black text-slate-900 mt-0.5">
                    {currentCampaign.title}
                  </h3>
                </div>
                <div className="shrink-0 text-right">
                  <span className="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                    <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    লাইভ সক্রিয়
                  </span>
                </div>
              </div>

              {/* Progress Bar & Telemetry */}
              <div className="py-6 space-y-3">
                <div className="flex items-baseline justify-between text-xs sm:text-sm">
                  <div>
                    <span className="text-slate-500">সংগৃহীত তহবিল: </span>
                    <strong className="text-2xl font-black text-teal-700">
                      ৳{formatBDT(raisedAmount)}
                    </strong>
                  </div>
                  <div className="text-slate-500">
                    লক্ষ্য: <strong className="text-slate-800 font-bold">৳{formatBDT(targetAmount)}</strong>
                  </div>
                </div>

                {/* Animated Progress Meter */}
                <div className="w-full h-4 rounded-full bg-slate-100 overflow-hidden relative p-0.5 border border-slate-200">
                  <div
                    className="h-full rounded-full bg-gradient-to-r from-teal-500 via-teal-600 to-rose-500 transition-all duration-700 shadow-sm"
                    style={{ width: `${progressPercent}%` }}
                  />
                </div>

                <div className="flex items-center justify-between text-xs text-slate-500 pt-1">
                  <span className="flex items-center gap-1.5 font-semibold text-slate-700">
                    👥 মোট দাতা: <strong className="text-teal-800 font-bold">{formatBDT(donorsCount)} জন</strong>
                  </span>
                  <span className="font-bold text-teal-700">
                    {progressPercent}% ফান্ড সম্পন্ন
                  </span>
                </div>
              </div>

              {/* Location & Relief Details */}
              <div className="p-4 rounded-2xl bg-teal-50/50 border border-teal-100/80 space-y-2 text-xs">
                <div className="flex justify-between">
                  <span className="text-slate-500">কার্যক্রম এলাকা:</span>
                  <span className="font-bold text-slate-800">{currentCampaign.location}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-slate-500">ত্রাণ সামগ্রী কিট:</span>
                  <span className="font-bold text-teal-900">{currentCampaign.relief_unit}</span>
                </div>
                <div className="flex justify-between pt-1 border-t border-teal-200/50">
                  <span className="text-slate-500">ক্যাম্পেইন বিবরণ:</span>
                  <span className="text-slate-700 text-right max-w-xs">{currentCampaign.description}</span>
                </div>
              </div>

              {/* Real-Time Live Relief Allocation Preview */}
              <div className="mt-5 p-4 rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 text-white shadow-xl relative overflow-hidden">
                <div className="flex items-center justify-between pb-2 mb-2 border-b border-slate-800 text-xs">
                  <span className="font-bold text-teal-300 flex items-center gap-1.5">
                    📍 লাইভ ত্রাণ বরাদ্দ কার্ড (GPS Verified)
                  </span>
                  <span className="font-mono text-[10px] text-slate-400">
                    {currentCampaign.gps_prefix}
                  </span>
                </div>
                <p className="text-xs sm:text-sm text-slate-200 leading-relaxed">
                  {currentCampaign.impact_text}
                </p>
                <div className="mt-2.5 pt-2 border-t border-slate-800/80 flex items-center justify-between text-[11px] text-slate-400">
                  <span>ফিল্ড ডেলিভারি অডিট: ভলান্টিয়ার কিউআর দ্বারা সত্যায়িত</span>
                  <span className="text-emerald-400 font-bold">✓ জিপিএস লকড</span>
                </div>
              </div>
            </div>
          </div>

          {/* RIGHT: Donation Controls & Payment Simulator (6 cols) */}
          <div className="lg:col-span-6 space-y-6">
            <div className="bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md">
              <div className="flex items-center justify-between pb-4 mb-5 border-b border-slate-100">
                <span className="text-xs font-black uppercase tracking-wider text-slate-500">
                  অনুদান ও যাকাত ফরম (Donation Desk)
                </span>
                <span className="text-xs font-bold text-rose-600 bg-rose-50 px-2.5 py-0.5 rounded-full">
                  ০% মধ্যস্বত্বভোগী ফি
                </span>
              </div>

              {/* Donor Name Input */}
              <div className="mb-5">
                <label htmlFor={donorNameInputId} className="block text-xs font-bold text-slate-700 mb-1.5">
                  দাতার নাম (ঐচ্ছিক / সাদাকায়ে জারিয়া):
                </label>
                <input
                  id={donorNameInputId}
                  type="text"
                  value={donorName}
                  onChange={(e) => setDonorName(e.target.value)}
                  placeholder="আপনার নাম বা পরিবারের নাম লিখুন"
                  className="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 text-sm font-semibold text-slate-800"
                />
              </div>

              {/* Preset Donation Amounts */}
              <div className="mb-5">
                <label className="block text-xs font-bold text-slate-700 mb-2">
                  অনুদানের পরিমাণ নির্বাচন করুন (BDT):
                </label>
                <div className="grid grid-cols-4 gap-2 mb-3">
                  {presetAmounts.map((amt) => (
                    <button
                      key={amt}
                      type="button"
                      onClick={() => handleAmountSelect(amt)}
                      className={`py-3 rounded-xl text-center text-xs sm:text-sm font-bold border transition-all ${
                        selectedAmount === amt && !customAmount
                          ? 'bg-teal-700 text-white border-teal-700 shadow-md shadow-teal-700/20'
                          : 'bg-slate-50 text-slate-700 hover:bg-slate-100 border-slate-200'
                      }`}
                    >
                      ৳{formatBDT(amt)}
                    </button>
                  ))}
                </div>

                {/* Custom Amount Field */}
                <div>
                  <label htmlFor={customAmountInputId} className="sr-only">
                    কাস্টম পরিমাণ
                  </label>
                  <div className="relative">
                    <span className="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">
                      ৳
                    </span>
                    <input
                      id={customAmountInputId}
                      type="text"
                      value={customAmount}
                      onChange={handleCustomAmountChange}
                      placeholder="অন্য পরিমাণ লিখুন (উদাঃ ১৫,০০০)"
                      className="w-full pl-8 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-500 text-sm font-semibold text-slate-800"
                    />
                  </div>
                </div>
              </div>

              {/* Payment Channel Selector */}
              <div className="mb-5">
                <label className="block text-xs font-bold text-slate-700 mb-2">
                  পেমেন্ট মাধ্যম বেছে নিন:
                </label>
                <div className="grid grid-cols-2 gap-2.5">
                  {paymentChannels.map((channel) => (
                    <button
                      key={channel.id}
                      type="button"
                      onClick={() => setSelectedChannel(channel.id)}
                      className={`p-3 rounded-xl text-left border transition-all flex items-center justify-between ${
                        selectedChannel === channel.id
                          ? 'bg-teal-50 border-teal-600 text-teal-950 font-bold'
                          : 'bg-slate-50 hover:bg-slate-100 border-slate-200 text-slate-700'
                      }`}
                    >
                      <div className="flex items-center gap-2">
                        <span className="text-xl">{channel.icon}</span>
                        <div>
                          <div className="text-xs font-bold leading-tight">{channel.name}</div>
                          <div className="text-[10px] text-slate-400">{channel.charge}</div>
                        </div>
                      </div>
                      <div className={`w-4 h-4 rounded-full border flex items-center justify-center text-[10px] ${
                        selectedChannel === channel.id ? 'border-teal-600 bg-teal-600 text-white' : 'border-slate-300'
                      }`}>
                        ✓
                      </div>
                    </button>
                  ))}
                </div>
              </div>

              {/* Zakat Checkbox */}
              <div className="mb-6 p-3.5 rounded-2xl bg-amber-50/70 border border-amber-200/80 flex items-start gap-3">
                <input
                  id={zakatCheckboxId}
                  type="checkbox"
                  checked={isZakat}
                  onChange={(e) => setIsZakat(e.target.checked)}
                  className="mt-0.5 w-4 h-4 text-teal-600 rounded-md border-amber-300 focus:ring-teal-500 cursor-pointer"
                />
                <label htmlFor={zakatCheckboxId} className="text-xs text-amber-950 leading-relaxed cursor-pointer">
                  <strong className="block font-bold">এটি আমার যাকাত ফান্ড থেকে প্রদত্ত (Shariah Audited)</strong>
                  চিহ্নিত করলে এই অনুদানটি স্বয়ংক্রিয়ভাবে যাকাত ভল্টে সংরক্ষিত হবে এবং কুরআনিক ৮টি খাতের বাইরে এক পয়সাও ব্যয় হবে না।
                </label>
              </div>

              {/* Action Button: Donate Demo */}
              <div>
                <button
                  type="button"
                  onClick={handleDonateDemo}
                  className="w-full py-4 rounded-2xl bg-gradient-to-r from-teal-600 to-rose-600 hover:from-teal-700 hover:to-rose-700 text-white font-black text-sm shadow-xl shadow-teal-700/25 transition-all flex items-center justify-center gap-2 group"
                >
                  <span>অনুদান টেস্ট করুন (৳{formatBDT(selectedAmount || 1000)})</span>
                  <span className="group-hover:translate-x-1 transition-transform">→</span>
                </button>
                <div className="mt-2 text-center text-[11px] text-slate-400">
                  🔒 এটি একটি ইন্টারেক্টিভ সিমুলেটর — কোনো আসল টাকা কাটা হবে না।
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* 3. Official Digital Donation Tax Receipt Modal */}
        {showReceiptModal && lastReceipt && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in duration-150">
            <div className="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-200 space-y-4">
              <div className="flex items-center justify-between pb-3 border-b border-slate-100">
                <div className="flex items-center gap-2.5">
                  <div className="w-8 h-8 rounded-xl bg-teal-100 text-teal-800 flex items-center justify-center font-bold">
                    ✓
                  </div>
                  <div>
                    <h3 className="font-bold text-slate-900 text-sm sm:text-base">
                      ডিজিটাল অনুদান মানি রিসিট (Tax Exemption)
                    </h3>
                    <span className="text-[10px] text-slate-400 font-mono">
                      ট্রানজেকশন আইডি: {lastReceipt.id}
                    </span>
                  </div>
                </div>
                <button
                  type="button"
                  onClick={() => setShowReceiptModal(false)}
                  className="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:text-slate-900 flex items-center justify-center"
                >
                  ✕
                </button>
              </div>

              {/* Receipt Body */}
              <div className="bg-slate-50 rounded-2xl p-5 border border-slate-200/80 font-mono text-xs space-y-2.5 text-slate-700">
                <div className="text-center font-bold text-slate-900 text-sm pb-2 border-b border-slate-200">
                  ZENGFY SOVEREIGN NGO & ZAKAT TRUST
                </div>
                <div className="flex justify-between">
                  <span>ক্যাম্পেইন:</span>
                  <span className="font-bold text-right text-slate-900">{lastReceipt.campaignTitle}</span>
                </div>
                <div className="flex justify-between">
                  <span>দাতার নাম:</span>
                  <span className="font-bold">{lastReceipt.donorName}</span>
                </div>
                <div className="flex justify-between">
                  <span>অনুদানের পরিমাণ:</span>
                  <span className="text-base font-black text-teal-700">৳{formatBDT(lastReceipt.amount)}</span>
                </div>
                <div className="flex justify-between">
                  <span>পেমেন্ট গেটওয়ে:</span>
                  <span>{lastReceipt.channel}</span>
                </div>
                <div className="flex justify-between">
                  <span>ফান্ড ক্যাটাগরি:</span>
                  <span className={lastReceipt.isZakat ? 'text-amber-700 font-bold' : 'text-slate-800'}>
                    {lastReceipt.isZakat ? '🕌 শরীয়াহ যাকাত তহবিল' : 'সাধারণ দান / সাদাকাহ'}
                  </span>
                </div>
                <div className="flex justify-between">
                  <span>তারিখ ও সময়:</span>
                  <span>{lastReceipt.timestamp}</span>
                </div>
                <div className="flex justify-between pt-2 border-t border-slate-200">
                  <span>ত্রাণ ট্র্যাকিং রেফারেন্স:</span>
                  <span className="text-teal-700 font-bold">{lastReceipt.trackingId}</span>
                </div>

                {/* Simulated QR Code */}
                <div className="mt-4 pt-3 border-t border-dashed border-slate-300 flex items-center justify-between">
                  <div className="text-[10px] text-slate-500 space-y-0.5">
                    <div>জাতীয় রাজস্ব বোর্ড (NBR) আয়কর আইন ২০২৩</div>
                    <div>ধারা ৭৬ অনুযায়ী অনুদান সম্পূর্ণ কর রেয়াতযোগ্য।</div>
                  </div>
                  <div className="w-14 h-14 bg-white p-1 rounded-lg border border-slate-300 flex items-center justify-center font-bold text-[9px] text-center text-slate-800 shadow-inner">
                    QR VERIFIED
                  </div>
                </div>
              </div>

              {/* Action Buttons */}
              <div className="flex gap-3 pt-2">
                <button
                  type="button"
                  onClick={() => {
                    alert('মানি রিসিট ডাউনলোড সম্পন্ন হয়েছে (PDF)!');
                    setShowReceiptModal(false);
                  }}
                  className="flex-1 py-3 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow-md transition-all"
                >
                  রিসিট ডাউনলোড (PDF)
                </button>
                <button
                  type="button"
                  onClick={() => setShowReceiptModal(false)}
                  className="px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs"
                >
                  বন্ধ করুন
                </button>
              </div>
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
