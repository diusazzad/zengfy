import React, { useState } from 'react';

export default function ConsultationBookingCalendarSimulator({ simulatorData }) {
  const data = simulatorData || {};
  const services = data.services || [
    {
      id: 'doctor',
      name: 'ডা. মাহফুজুর রহমান',
      title: 'মেডিকেল কনসালট্যান্ট ও মেডিসিন বিশেষজ্ঞ',
      avatar: 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=150&auto=format&fit=crop&q=80',
      duration: '৩০ মিনিট',
      fee: '৳১,০০০',
      fee_amount: 1000,
      token_amount: 200,
      location: 'ধানমন্ডি চেম্বার ও গুগল মিট (টেলিমেডিসিন)',
      badge: 'মেডিকেল চেম্বার'
    },
    {
      id: 'lawyer',
      name: 'এডভোকেট শামসুল হুদা',
      title: 'সুপ্রিম কোর্ট ও হাইকোর্ট লিগ্যাল অ্যাডভাইজার',
      avatar: 'https://images.unsplash.com/photo-1556157382-97eda2d62296?w=150&auto=format&fit=crop&q=80',
      duration: '৪৫ মিনিট',
      fee: '৳১,৫০০',
      fee_amount: 1500,
      token_amount: 200,
      location: 'পল্টন চেম্বার ও ভার্চুয়াল কনসালটেশন',
      badge: 'লিগ্যাল কনসালট্যান্ট'
    },
    {
      id: 'mentor',
      name: 'তানভীরুল ইসলাম',
      title: 'টেক ও বিজনেস স্ট্র্যাটেজি মেন্টর',
      avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
      duration: '৬০ মিনিট',
      fee: '৳২,০০০',
      fee_amount: 2000,
      token_amount: 200,
      location: '১:১ লাইভ গুগল মিট ভিডিও সেশন',
      badge: 'বিজনেস কোচ'
    }
  ];

  const dates = data.dates || [
    { id: 'today', label: 'আজ (Today)', date_str: '১৩ অক্টোবর, ২০২৬' },
    { id: 'tomorrow', label: 'আগামীকাল (Tomorrow)', date_str: '১৪ অক্টোবর, ২০২৬' },
    { id: 'day_after', label: 'পরশু (Day After)', date_str: '১৫ অক্টোবর, ২০২৬' }
  ];

  const timeSlotsByDate = data.time_slots || {
    today: [
      { time: '১০:০০ AM', period: 'সকাল', available: false },
      { time: '১১:০০ AM', period: 'সকাল', available: true },
      { time: '০৩:০০ PM', period: 'বিকাল', available: true },
      { time: '০৪:৩০ PM', period: 'বিকাল', available: false },
      { time: '০৭:০০ PM', period: 'সন্ধ্যা', available: true },
      { time: '০৮:০০ PM', period: 'সন্ধ্যা', available: true }
    ],
    tomorrow: [
      { time: '১০:৩০ AM', period: 'সকাল', available: true },
      { time: '১১:৩০ AM', period: 'সকাল', available: false },
      { time: '০২:৩০ PM', period: 'বিকাল', available: true },
      { time: '০৩:৩০ PM', period: 'বিকাল', available: true },
      { time: '০৬:৩০ PM', period: 'সন্ধ্যা', available: true },
      { time: '০৭:৩০ PM', period: 'সন্ধ্যা', available: false }
    ],
    day_after: [
      { time: '০৯:৩০ AM', period: 'সকাল', available: true },
      { time: '১১:০০ AM', period: 'সকাল', available: true },
      { time: '০৩:০০ PM', period: 'বিকাল', available: true },
      { time: '০৪:০০ PM', period: 'বিকাল', available: true },
      { time: '০৭:০০ PM', period: 'সন্ধ্যা', available: true },
      { time: '০৮:৩০ PM', period: 'সন্ধ্যা', available: true }
    ]
  };

  const [selectedServiceId, setSelectedServiceId] = useState('doctor');
  const [selectedDateId, setSelectedDateId] = useState('today');
  const [selectedSlotTime, setSelectedSlotTime] = useState('১১:০০ AM');
  const [depositMode, setDepositMode] = useState('token'); // 'token' or 'full'
  const [clientName, setClientName] = useState('রাকিবুল হাসান');
  const [clientPhone, setClientPhone] = useState('01711-889900');
  const [showModal, setShowModal] = useState(false);
  const [isProcessing, setIsProcessing] = useState(false);

  const currentService = services.find((s) => s.id === selectedServiceId) || services[0];
  const currentDateObj = dates.find((d) => d.id === selectedDateId) || dates[0];
  const availableSlots = timeSlotsByDate[selectedDateId] || timeSlotsByDate['today'];

  const payableAmount = depositMode === 'token' ? currentService.token_amount : currentService.fee_amount;

  const handleBookNow = (e) => {
    e.preventDefault();
    if (!selectedSlotTime) return;
    setIsProcessing(true);
    setTimeout(() => {
      setIsProcessing(false);
      setShowModal(true);
    }, 700);
  };

  const handleDownloadIcs = () => {
    const icsData = `BEGIN:VCALENDAR\nVERSION:2.0\nPRODID:-//Zengfy Schedule//BN\nBEGIN:VEVENT\nSUMMARY:কনসালটেশন সেশন - ${currentService.name}\nDESCRIPTION:${currentService.title}\nSTATUS:CONFIRMED\nEND:VEVENT\nEND:VCALENDAR`;
    const blob = new Blob([icsData], { type: 'text/calendar;charset=utf-8' });
    const link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.setAttribute('download', 'appointment-zengfy.ics');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  };

  return (
    <section id="simulator" className="py-20 bg-slate-900 text-slate-100 relative overflow-hidden">
      <div className="absolute top-10 left-10 w-96 h-96 bg-indigo-900/20 rounded-full blur-3xl pointer-events-none" />
      <div className="absolute bottom-10 right-10 w-96 h-96 bg-cyan-900/20 rounded-full blur-3xl pointer-events-none" />

      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="text-center max-w-3xl mx-auto mb-12">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold mb-4 tracking-wider">
            <span className="w-2 h-2 rounded-full bg-cyan-400 animate-pulse" />
            লাইভ অ্যাপয়েন্টমেন্ট স্যান্ডবক্স
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            {data.headline || 'পেশাজীবী কনসালটেশন বুকিং ও বিকাশ ডিপোজিট স্যান্ডবক্স'}
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            {data.subheadline || 'পেশাজীবী নির্বাচন করুন, পছন্দের স্লট বাছুন এবং বিকাশ ডিপোজিটের মাধ্যমে লাইভ গুগল মিট কনফার্মেশন উপভোগ করুন।'}
          </p>
        </div>

        {/* 1. Professional Switcher Tabs */}
        <div className="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-8">
          {services.map((serv) => {
            const active = serv.id === selectedServiceId;
            return (
              <button
                key={serv.id}
                type="button"
                onClick={() => {
                  setSelectedServiceId(serv.id);
                  setSelectedSlotTime('১১:০০ AM');
                }}
                className={`flex items-center gap-3 px-4 py-3 rounded-2xl border transition-all text-left cursor-pointer ${
                  active
                    ? 'bg-indigo-600 text-white border-indigo-400 shadow-lg shadow-indigo-950/50 ring-2 ring-indigo-400/40'
                    : 'bg-slate-800/80 text-slate-300 border-slate-700 hover:bg-slate-800 hover:text-white'
                }`}
              >
                <img
                  src={serv.avatar}
                  alt={serv.name}
                  className="w-10 h-10 rounded-full object-cover border border-white/20"
                />
                <div>
                  <div className="text-xs font-bold">{serv.name}</div>
                  <div className={`text-[11px] truncate max-w-[150px] ${active ? 'text-indigo-200' : 'text-slate-400'}`}>
                    {serv.badge} • {serv.fee}
                  </div>
                </div>
              </button>
            );
          })}
        </div>

        {/* 2. Interactive Booking Board */}
        <div className="bg-slate-950 border border-slate-800 rounded-3xl shadow-2xl overflow-hidden p-6 sm:p-10">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {/* Left: Professional Details & Slot Picker */}
            <div className="lg:col-span-7 space-y-6">
              <div className="flex items-start gap-4 p-5 rounded-2xl bg-slate-900/80 border border-slate-800">
                <img
                  src={currentService.avatar}
                  alt={currentService.name}
                  className="w-14 h-14 rounded-2xl object-cover ring-2 ring-indigo-500/40"
                />
                <div>
                  <div className="flex items-center gap-2">
                    <span className="text-lg font-bold text-white">{currentService.name}</span>
                    <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                      {currentService.badge}
                    </span>
                  </div>
                  <div className="text-xs text-slate-400 mt-0.5">{currentService.title}</div>
                  <div className="flex items-center gap-4 text-xs text-slate-300 mt-2">
                    <span>⏱️ সময়: <strong className="text-white">{currentService.duration}</strong></span>
                    <span>📍 স্থান: <strong className="text-white">{currentService.location}</strong></span>
                  </div>
                </div>
              </div>

              {/* Step 1: Select Date */}
              <div>
                <label className="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-3">
                  ১. তারিখ নির্বাচন করুন (Date)
                </label>
                <div className="grid grid-cols-3 gap-2 sm:gap-3">
                  {dates.map((d) => {
                    const active = d.id === selectedDateId;
                    return (
                      <button
                        key={d.id}
                        type="button"
                        onClick={() => setSelectedDateId(d.id)}
                        className={`p-3 rounded-xl border text-center transition-all cursor-pointer ${
                          active
                            ? 'bg-indigo-600/30 border-indigo-500 text-white font-bold ring-1 ring-indigo-400'
                            : 'bg-slate-900 border-slate-800 text-slate-300 hover:border-slate-700'
                        }`}
                      >
                        <div className="text-xs">{d.label}</div>
                        <div className="text-[10px] text-slate-400 mt-0.5">{d.date_str}</div>
                      </button>
                    );
                  })}
                </div>
              </div>

              {/* Step 2: Select Slot */}
              <div>
                <div className="flex items-center justify-between mb-3">
                  <label className="text-xs font-bold text-slate-300 uppercase tracking-wider">
                    ২. ফাঁকা স্লট নির্বাচন করুন (Time Slot)
                  </label>
                  <span className="text-[11px] text-slate-400">
                    তারিখ: {currentDateObj.date_str}
                  </span>
                </div>

                <div className="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                  {availableSlots.map((slot, idx) => {
                    const isSelected = selectedSlotTime === slot.time && slot.available;
                    return (
                      <button
                        key={idx}
                        type="button"
                        disabled={!slot.available}
                        onClick={() => setSelectedSlotTime(slot.time)}
                        className={`p-3 rounded-xl border text-xs font-bold transition-all flex items-center justify-between ${
                          !slot.available
                            ? 'bg-slate-900/30 border-slate-800 text-slate-600 cursor-not-allowed line-through'
                            : isSelected
                            ? 'bg-cyan-500 text-slate-950 border-cyan-400 font-extrabold shadow-lg shadow-cyan-500/20 ring-2 ring-cyan-300'
                            : 'bg-slate-900 border-slate-800 text-slate-200 hover:border-indigo-500 cursor-pointer'
                        }`}
                      >
                        <span>{slot.time}</span>
                        {!slot.available ? (
                          <span className="text-[9px] uppercase px-1 py-0.5 rounded bg-slate-800 text-slate-500 font-normal">
                            বুকড
                          </span>
                        ) : isSelected ? (
                          <span className="text-[10px]">✓</span>
                        ) : (
                          <span className="text-[10px] text-emerald-400 font-normal">ফাঁকা</span>
                        )}
                      </button>
                    );
                  })}
                </div>
              </div>
            </div>

            {/* Right: Checkout & Deposit Toggle */}
            <div className="lg:col-span-5 space-y-6">
              <div className="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <h3 className="text-sm font-bold text-white mb-4 uppercase tracking-wider flex items-center gap-2">
                  <span>💳</span> বুকিং সামারি ও অগ্রিম ডিপোজিট
                </h3>

                <div className="bg-slate-950 p-4 rounded-xl border border-slate-800 space-y-2 mb-4 text-xs">
                  <div className="flex justify-between text-slate-400">
                    <span>পেশাজীবী:</span>
                    <strong className="text-white">{currentService.name}</strong>
                  </div>
                  <div className="flex justify-between text-slate-400">
                    <span>নির্বাচিত স্লট:</span>
                    <strong className="text-cyan-400">{currentDateObj.label} @ {selectedSlotTime}</strong>
                  </div>
                  <div className="flex justify-between text-slate-400">
                    <span>কনসালটেশন ফি:</span>
                    <strong className="text-white">{currentService.fee}</strong>
                  </div>
                </div>

                {/* Deposit Option Toggle */}
                <div className="mb-4">
                  <label className="block text-xs font-semibold text-slate-300 mb-2">
                    পেমেন্ট অপশন নির্বাচন করুন:
                  </label>
                  <div className="grid grid-cols-2 gap-2">
                    <button
                      type="button"
                      onClick={() => setDepositMode('token')}
                      className={`p-3 rounded-xl border text-xs text-left cursor-pointer transition-all ${
                        depositMode === 'token'
                          ? 'bg-indigo-600/30 border-indigo-400 text-white font-bold ring-1 ring-indigo-400'
                          : 'bg-slate-950 border-slate-800 text-slate-400 hover:text-white'
                      }`}
                    >
                      <div className="font-bold text-indigo-300">টোকেন ডিপোজিট</div>
                      <div className="text-[11px] font-black text-white mt-1">৳২০০.০০</div>
                      <div className="text-[9px] text-slate-400">বাকি টাকা চেম্বারে</div>
                    </button>

                    <button
                      type="button"
                      onClick={() => setDepositMode('full')}
                      className={`p-3 rounded-xl border text-xs text-left cursor-pointer transition-all ${
                        depositMode === 'full'
                          ? 'bg-indigo-600/30 border-indigo-400 text-white font-bold ring-1 ring-indigo-400'
                          : 'bg-slate-950 border-slate-800 text-slate-400 hover:text-white'
                      }`}
                    >
                      <div className="font-bold text-cyan-300">সম্পূর্ণ ফি পরিশোধ</div>
                      <div className="text-[11px] font-black text-white mt-1">{currentService.fee}</div>
                      <div className="text-[9px] text-slate-400">অনলাইনে ফুল পে</div>
                    </button>
                  </div>
                </div>

                {/* Client Name & Phone */}
                <form onSubmit={handleBookNow} className="space-y-3">
                  <div>
                    <label className="block text-xs text-slate-400 mb-1">আপনার নাম</label>
                    <input
                      type="text"
                      value={clientName}
                      onChange={(e) => setClientName(e.target.value)}
                      className="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-indigo-500"
                      required
                    />
                  </div>
                  <div>
                    <label className="block text-xs text-slate-400 mb-1">মোবাইল নম্বর (এসএমএস রিমাইন্ডারের জন্য)</label>
                    <input
                      type="text"
                      value={clientPhone}
                      onChange={(e) => setClientPhone(e.target.value)}
                      className="w-full bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white font-mono focus:outline-none focus:border-indigo-500"
                      required
                    />
                  </div>

                  <button
                    type="submit"
                    disabled={isProcessing}
                    className="w-full mt-4 py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#DF146E] via-pink-600 to-indigo-600 hover:from-pink-600 hover:to-indigo-500 text-white font-bold text-xs sm:text-sm shadow-lg shadow-pink-900/30 transition-all flex items-center justify-center gap-2 cursor-pointer"
                  >
                    <span>{isProcessing ? 'যাচাই হচ্ছে...' : `বিকাশে ৳${payableAmount} পরিশোধ করে বুক করুন`}</span>
                    <span>→</span>
                  </button>
                </form>

                <div className="flex items-center justify-center gap-3 text-[11px] text-slate-400 mt-4">
                  <span>✓ ইনস্ট্যান্ট গুগল মিট লিঙ্ক</span>
                  <span>•</span>
                  <span>✓ স্বয়ংক্রিয় এসএমএস অ্যালার্ট</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Confirmation Modal */}
      {showModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md">
          <div className="w-full max-w-lg bg-slate-900 border border-indigo-500/40 rounded-3xl p-6 sm:p-8 text-slate-100 shadow-2xl relative animate-in fade-in zoom-in-95 duration-150">
            <button
              type="button"
              onClick={() => setShowModal(false)}
              className="absolute top-5 right-5 text-slate-400 hover:text-white text-lg font-bold p-1 cursor-pointer"
            >
              ✕
            </button>

            <div className="text-center mb-6">
              <div className="w-12 h-12 mx-auto mb-3 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl">
                ✓
              </div>
              <h3 className="text-xl font-black text-white">অ্যাপয়েন্টমেন্ট সফলভাবে নিশ্চিত হয়েছে!</h3>
              <p className="text-xs text-slate-400 mt-1">
                বিকাশ ট্রানজ্যাকশন আইডি: <span className="font-mono text-cyan-400">TRX-ZG-2026-9481</span>
              </p>
            </div>

            <div className="bg-slate-950 border border-slate-800 rounded-2xl p-4 text-xs space-y-2.5 mb-5">
              <div className="flex justify-between">
                <span className="text-slate-400">পেশাজীবী:</span>
                <span className="font-bold text-white">{currentService.name}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-slate-400">তারিখ ও সময়:</span>
                <span className="font-bold text-cyan-300">{currentDateObj.date_str} @ {selectedSlotTime}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-slate-400">ক্লায়েন্ট:</span>
                <span className="text-white">{clientName} ({clientPhone})</span>
              </div>
              <div className="flex justify-between border-t border-slate-800 pt-2">
                <span className="text-slate-400">গুগল মিট লিঙ্ক:</span>
                <a
                  href="https://meet.google.com/zgf-sched-demo"
                  target="_blank"
                  rel="noreferrer"
                  className="text-indigo-400 hover:underline font-mono"
                >
                  meet.google.com/zgf-sched-demo ↗
                </a>
              </div>
            </div>

            <div className="bg-indigo-950/40 border border-indigo-800/40 rounded-xl p-3 text-[11px] text-indigo-300 mb-6">
              <strong>📱 ফোনে পাঠানো এসএমএস: </strong>
              "{clientName}, আপনার অ্যাপয়েন্টমেন্ট {currentService.name}-এর সাথে {currentDateObj.date_str} {selectedSlotTime}-এ কনফার্ম হয়েছে। মিট লিঙ্ক এসএমএসে পাঠানো হয়েছে।"
            </div>

            <div className="grid grid-cols-2 gap-3">
              <button
                type="button"
                onClick={handleDownloadIcs}
                className="py-3 px-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold border border-slate-700 flex items-center justify-center gap-1.5 cursor-pointer"
              >
                <span>📅 ক্যালেন্ডার ইভেন্ট (.ics)</span>
              </button>

              <button
                type="button"
                onClick={() => setShowModal(false)}
                className="py-3 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold shadow-md shadow-indigo-900/30 cursor-pointer"
              >
                <span>সম্পন্ন করুন</span>
              </button>
            </div>
          </div>
        </div>
      )}
    </section>
  );
}
