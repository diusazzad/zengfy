import React, { useState } from 'react';

export default function UncensoredOpEdPaywallSimulator({ simulatorData }) {
  const data = simulatorData || {};
  const presets = data.presets || [];

  const [selectedPresetId, setSelectedPresetId] = useState(presets[0]?.id || 'col_budget');
  const [unlockedState, setUnlockedState] = useState({
    col_budget: false,
    col_judiciary: false,
    col_banking: false
  });
  const [showBcashModal, setShowBcashModal] = useState(false);
  const [selectedPlan, setSelectedPlan] = useState('monthly');
  const [pinInput, setPinInput] = useState('');
  const [bkashPhone, setBkashPhone] = useState('01711-234567');
  const [isProcessing, setIsProcessing] = useState(false);
  const [readerQuestion, setReaderQuestion] = useState('');
  const [tipBoxMessage, setTipBoxMessage] = useState('');
  const [tipSuccess, setTipSuccess] = useState(false);
  const [questionSuccess, setQuestionSuccess] = useState(false);

  const currentPreset = presets.find((p) => p.id === selectedPresetId) || presets[0] || {
    id: 'col_budget',
    title: 'জাতীয় মেগা বাজেট ২০২৬ ও অর্থনৈতিক স্বচ্ছতার অডিট — একটি অনুসন্ধানী প্রতিবেদন',
    author: 'শওকত মাহমুদ',
    author_role: 'সিনিয়র অনুসন্ধানী বিশ্লেষক',
    author_avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80',
    reading_time: '৮ মিনিট পাঠ',
    date: '১২ অক্টোবর, ২০২৬',
    category: 'অনুসন্ধানী অডিট',
    paragraphs: [
      'বাংলাদেশের জাতীয় বাজেট ২০২৬-২৭ অর্থবছরে উন্নয়ন প্রকল্পের বরাদ্দ ও ব্যয়ের হিসাব পুঙ্খানুপুঙ্খ বিশ্লেষণে বেশ কিছু মৌলিক অসঙ্গতি ধরা পড়ে। রাজস্ব আদায়ের প্রক্ষেপণ যখন প্রতি অর্থবছরই অবাস্তবভাবে স্ফীত করা হয়, তখন উন্নয়ন বাজেটের বিশাল ঘাটতি মেটাতে অভ্যন্তরীণ ও বৈদেশিক ঋণের ওপর অতিরিক্ত নির্ভরশীলতা অনিবার্য হয়ে দাঁড়ায়।',
      'আমাদের অডিট অনুসন্ধানে দেখা গেছে, বিগত তিন অর্থবছরে অনুমোদিত শীর্ষ ২০টি মেগা প্রকল্পের অন্তত ১২টির ব্যয় প্রাথমিক ডিপিপি (DPP) অনুমানের চেয়ে গড়ে ১২০% বৃদ্ধি করা হয়েছে। অথচ প্রকল্প বাস্তবায়ন কমিটির অগ্রগতি প্রতিবেদনে মাঠপর্যায়ের বাস্তব অগ্রগতি কাগজ-কলমে দেখানো অগ্রগতির চেয়ে যোজন যোজন পিছিয়ে।',
      'স্বাধীন অর্থনীতিবিদ ও আন্তর্জাতিক অডিট বিশেষজ্ঞদের নিরপেক্ষ মূল্যায়ন অনুযায়ী, করদাতাদের হাজার কোটি টাকার এই অর্থ অপচয় রোধ করতে হলে মন্ত্রণালয় পর্যায়ের ব্যয় বরাদ্দের প্রতিটি ধাপ সম্পূর্ণ ডিজিটাল ও জনসাধারণের জন্য উন্মুক্ত থাকা বাধ্যতামূলক।'
    ],
    paywall_blur_intro: 'বাকি অনুসন্ধানী ডাটা ও এক্সক্লুসিভ ডকুমেন্টস পড়তে কলামিস্টের স্বাধীন সাংবাদিকতায় যুক্ত হন — মাসিক ৳১০০ বা বার্ষিক ৳১,০০০',
    locked_content: {
      paragraphs: [
        'প্রাপ্ত অডিট নথিপত্রে পরিষ্কার প্রতীয়মান হয় যে, বিদেশি পরামর্শক খাতের সিংহভাগ অর্থ এমন সব বিদেশী সংস্থাকে দেওয়া হয়েছে যাদের স্থানীয় অংশীদাররা সংশ্লিষ্ট মন্ত্রণালয়ের সাবেক নীতিনির্ধারকদের পরিবারবর্গের সাথে যৌথ ব্যবসায় যুক্ত। ফলে প্রকল্পের সময়সীমা বারবার বাড়িয়ে বাজেট ফুলিয়ে-ফাঁপিয়ে নেওয়া হয়েছে।',
        'নিম্নলিখিত অডিট সারণিতে ২০২৬ সালের সংশোধিত ব্যয় ও মূল ব্যয়ের তুলনামূলক অমিল তুলে ধরা হলো, যা কোনো মূলধারার করপোরেট গণমাধ্যমে বিজ্ঞাপনদাতার বাপের হস্তক্ষেপে প্রকাশ করা সম্ভব হয়নি।'
      ],
      audit_table: {
        title: 'মেগা বাজেট প্রকল্প ব্যয় ও বৈদেশিক অডিট অমিল তুলনামূলক সারণি (২০২৬)',
        headers: ['প্রকল্পের নাম', 'মূল ডিপিপি বরাদ্দ (কোটি ৳)', 'সংশোধিত দাবি (কোটি ৳)', 'স্বাধীন অডিটে অমিল (কোটি ৳)'],
        rows: [
          ['ঢাকা হাই-স্পিড ইকোনমিক করিডোর', '১২,৪৫০', '২৮,৯০০', '+১৬,৪৫০'],
          ['দক্ষিণ বঙ্গোপসাগর গভীর টার্মিনাল', '১৮,০০০', '৩৫,২০০', '+১৭,২০০'],
          ['জাতীয় হাইপারলুপ ডাটা গ্রিড', '৬,২০০', '১৩,৮০০', '+৭,৬০০']
        ]
      },
      attached_proofs: [
        'পরিকল্পনা কমিশন অডিট রিপোর্ট ২০২৬ (পৃষ্ঠা ৪২-৬৮)',
        'স্বাধীন কনসালট্যান্টদের অপ্রকাশিত মূল্যায়ন নথি',
        'বাংলাদেশ ব্যাংক বৈদেশিক মুদ্রার স্পেশাল লেজার নোট'
      ]
    }
  };

  const isUnlocked = !!unlockedState[selectedPresetId];

  const handleOpenPayment = (plan) => {
    setSelectedPlan(plan);
    setPinInput('');
    setShowBcashModal(true);
  };

  const handleConfirmPayment = (e) => {
    e.preventDefault();
    if (pinInput.length < 4) return;
    setIsProcessing(true);
    setTimeout(() => {
      setIsProcessing(false);
      setUnlockedState((prev) => ({
        ...prev,
        [selectedPresetId]: true
      }));
      setShowBcashModal(false);
    }, 1000);
  };

  const handleResetLock = () => {
    setUnlockedState((prev) => ({
      ...prev,
      [selectedPresetId]: false
    }));
    setTipSuccess(false);
    setQuestionSuccess(false);
  };

  const handleTipSubmit = (e) => {
    e.preventDefault();
    if (!tipBoxMessage.trim()) return;
    setTipSuccess(true);
    setTipBoxMessage('');
    setTimeout(() => setTipSuccess(false), 5000);
  };

  const handleQuestionSubmit = (e) => {
    e.preventDefault();
    if (!readerQuestion.trim()) return;
    setQuestionSuccess(true);
    setReaderQuestion('');
    setTimeout(() => setQuestionSuccess(false), 5000);
  };

  return (
    <section id="simulator" className="relative py-20 bg-slate-900 text-slate-100 overflow-hidden">
      {/* Background Decorative Grid */}
      <div className="absolute inset-0 bg-[linear-gradient(to_right,#1e293b15_1px,transparent_1px),linear-gradient(to_bottom,#1e293b15_1px,transparent_1px)] bg-[size:4rem_4rem] pointer-events-none" />
      
      {/* Ambient Glows */}
      <div className="absolute top-1/4 left-10 w-96 h-96 bg-rose-900/20 rounded-full blur-3xl pointer-events-none" />
      <div className="absolute bottom-10 right-10 w-96 h-96 bg-slate-800/40 rounded-full blur-3xl pointer-events-none" />

      <div className="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-semibold mb-4 tracking-wider">
            <span className="w-2 h-2 rounded-full bg-rose-500 animate-pulse" />
            লাইভ সিমুলেটর ও পে-ওয়াল অভিজ্ঞতা
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            {data.headline || 'আনসেন্সরড পলিটিক্যাল অপ-এড কলাম ও পেইড পে-ওয়াল প্রিভিউ'}
          </h2>
          <p className="text-slate-300 text-base sm:text-lg leading-relaxed">
            {data.subheadline || 'নিচে ৩টি প্রকৃত অনুসন্ধানী কলামের ডেমো পড়ে দেখুন। ১ম ৩টি প্যারাগ্রাফ ফ্রি, বিকাশ ১-ট্যাপ আনলকে সম্পূর্ণ সত্য উন্মোচন করুন।'}
          </p>
        </div>

        {/* Preset Selector Tabs */}
        <div className="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-8">
          {presets.map((preset) => {
            const active = preset.id === selectedPresetId;
            const unlocked = unlockedState[preset.id];
            return (
              <button
                key={preset.id}
                type="button"
                onClick={() => setSelectedPresetId(preset.id)}
                className={`flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 border ${
                  active
                    ? 'bg-rose-700 text-white border-rose-600 shadow-lg shadow-rose-900/30'
                    : 'bg-slate-800/80 text-slate-300 border-slate-700/80 hover:bg-slate-800 hover:text-white'
                }`}
              >
                <span>{preset.category}</span>
                <span className="text-xs opacity-75 font-normal">({preset.author})</span>
                {unlocked && (
                  <span className="inline-flex items-center text-[10px] bg-emerald-500/20 text-emerald-300 px-1.5 py-0.5 rounded border border-emerald-500/30 font-bold">
                    ✓ আনলকড
                  </span>
                )}
              </button>
            );
          })}
        </div>

        {/* Newspaper Reader Container */}
        <div className="bg-slate-950 border border-slate-800 rounded-3xl shadow-2xl overflow-hidden transition-all duration-300">
          {/* Newspaper Masthead Bar */}
          <div className="bg-slate-900/90 border-b border-slate-800 px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div className="flex items-center gap-3">
              <span className="text-xs font-bold tracking-widest uppercase px-2.5 py-1 rounded bg-rose-950/80 text-rose-300 border border-rose-800/50">
                {currentPreset.category}
              </span>
              <span className="text-xs text-slate-400">• {currentPreset.date}</span>
              <span className="text-xs text-slate-400">• {currentPreset.reading_time}</span>
            </div>

            <div className="flex items-center gap-2">
              {isUnlocked ? (
                <button
                  type="button"
                  onClick={handleResetLock}
                  className="text-xs text-slate-400 hover:text-rose-400 underline underline-offset-4 transition-colors"
                >
                  পুনরায় পে-ওয়াল লক করুন (ডেমো)
                </button>
              ) : (
                <span className="inline-flex items-center gap-1.5 text-xs text-amber-400 font-medium bg-amber-500/10 px-2.5 py-1 rounded-full border border-amber-500/20">
                  <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                  পে-ওয়াল অ্যাক্টিভ
                </span>
              )}
            </div>
          </div>

          {/* Reader Body */}
          <div className="p-6 sm:p-10 lg:p-12 font-serif">
            {/* Op-Ed Headline */}
            <h1 className="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-100 leading-snug tracking-tight mb-6">
              {currentPreset.title}
            </h1>

            {/* Author Profile Byline */}
            <div className="flex items-center gap-4 py-4 mb-8 border-y border-slate-800/80 not-italic font-sans">
              <img
                src={currentPreset.author_avatar}
                alt={currentPreset.author}
                className="w-12 h-12 rounded-full object-cover ring-2 ring-rose-500/40"
              />
              <div>
                <div className="text-base font-bold text-white flex items-center gap-2">
                  {currentPreset.author}
                  <span className="text-rose-400 text-xs font-normal px-2 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20">
                    ভেরিফাইড কলামিস্ট
                  </span>
                </div>
                <div className="text-xs text-slate-400">{currentPreset.author_role}</div>
              </div>
            </div>

            {/* Summary / Sub-lead */}
            {currentPreset.summary && (
              <div className="bg-slate-900/60 border-l-4 border-rose-600 p-4 rounded-r-xl mb-8 not-italic font-sans text-slate-300 text-sm sm:text-base">
                <strong className="text-rose-400">মূল সারসংক্ষেপ: </strong>
                {currentPreset.summary}
              </div>
            )}

            {/* Free Paragraphs (1, 2, 3) */}
            <div className="space-y-6 text-slate-200 text-base sm:text-lg leading-relaxed">
              {currentPreset.paragraphs.map((p, idx) => (
                <p key={idx} className="first-letter:text-3xl first-letter:font-bold first-letter:text-rose-400 first-letter:mr-1">
                  {p}
                </p>
              ))}
            </div>

            {/* Paywalled / Unlocked Section */}
            {!isUnlocked ? (
              <div className="relative mt-8 pt-4">
                {/* Simulated Blurred Paragraph Background */}
                <div className="relative overflow-hidden rounded-2xl select-none filter blur-sm opacity-40 text-slate-400 space-y-4">
                  <p>
                    আমাদের অডিট অনুসন্ধানে প্রাপ্ত গোপন নথিপত্রে আরও পরিষ্কার প্রতীয়মান হয় যে কীভাবে নির্দিষ্ট কয়েকটি প্রভাবশালীর সিন্ডিকেটের কাছে বিশেষ বাণিজ্যিক সুবিধা অর্পণ করা হয়েছিল। মন্ত্রণালয়ের গোপনীয় অভ্যন্তরীণ নথিপত্র এবং স্বাধীন হিসাব নিরীক্ষকদের রিপোর্ট অনুসারে...
                  </p>
                  <p>
                    নিম্নলিখিত বিশদ অডিট ও আন্তর্জাতিক ব্যাংক সমূহের সুইফট ট্রেইল থেকে প্রাপ্ত তথ্যসমূহ বিশ্লেষণ করলে স্পষ্ট বোঝা যায় যে কীভাবে অর্থ পাচার ও রাজস্ব ফাঁকির আন্তর্জাতিক নেটওয়ার্ক পরিচালিত হয়েছে...
                  </p>
                </div>

                {/* Frosted Glass Paywall Card Overlay */}
                <div className="absolute inset-0 flex items-center justify-center p-4">
                  <div className="w-full max-w-xl bg-slate-900/95 backdrop-blur-xl border border-rose-600/30 rounded-2xl p-6 sm:p-8 text-center shadow-2xl font-sans">
                    <div className="w-12 h-12 mx-auto mb-3 rounded-full bg-rose-600/20 border border-rose-500/40 flex items-center justify-center text-rose-400">
                      <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                      </svg>
                    </div>

                    <h3 className="text-lg sm:text-xl font-bold text-white mb-2">
                      স্বাধীন সাংবাদিকতাকে সমর্থন করুন
                    </h3>
                    <p className="text-slate-300 text-sm mb-6 leading-relaxed">
                      {currentPreset.paywall_blur_intro}
                    </p>

                    {/* Subscription Buttons */}
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                      <button
                        type="button"
                        onClick={() => handleOpenPayment('monthly')}
                        className="group flex flex-col items-center justify-center p-3.5 rounded-xl bg-rose-700 hover:bg-rose-600 text-white font-medium transition-all duration-200 shadow-md shadow-rose-900/40 border border-rose-500"
                      >
                        <span className="text-xs text-rose-200">মাসিক সাবস্ক্রিপশন</span>
                        <span className="text-base font-bold">৳১০০ / মাস</span>
                        <span className="text-[11px] text-rose-200 mt-1 flex items-center gap-1">
                          <span className="w-1.5 h-1.5 rounded-full bg-white animate-ping" />
                          বিকাশ ১-ট্যাপ আনলক
                        </span>
                      </button>

                      <button
                        type="button"
                        onClick={() => handleOpenPayment('yearly')}
                        className="group flex flex-col items-center justify-center p-3.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-medium transition-all duration-200 border border-slate-700"
                      >
                        <span className="text-xs text-slate-400">বার্ষিক সাবস্ক্রিপশন</span>
                        <span className="text-base font-bold text-amber-300">৳১,০০০ / বছর</span>
                        <span className="text-[11px] text-slate-400 mt-1">২ মাস ফ্রি (সেভিং)</span>
                      </button>
                    </div>

                    <div className="flex items-center justify-center gap-4 text-xs text-slate-400">
                      <span className="flex items-center gap-1">
                        <svg className="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                          <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                        </svg>
                        ১০০% কলামিস্টের আয়
                      </span>
                      <span className="flex items-center gap-1">
                        <svg className="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                          <path fillRule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clipRule="evenodd" />
                        </svg>
                        জিরো সেন্সরশিপ
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            ) : (
              /* UNLOCKED CONTENT SECTION */
              <div className="mt-8 space-y-8 animate-fadeIn">
                <div className="bg-emerald-950/40 border border-emerald-600/40 rounded-xl p-4 flex items-center justify-between not-italic font-sans">
                  <div className="flex items-center gap-3 text-emerald-300 text-sm font-semibold">
                    <span className="w-3 h-3 rounded-full bg-emerald-400" />
                    সম্পূর্ণ অনুসন্ধানী রিপোর্ট ও নথিপত্র সফলভাবে আনলক করা হয়েছে!
                  </div>
                  <span className="text-xs text-emerald-400/80 font-mono">ভেরিফাইড পে-ওয়াল অ্যাক্সেস</span>
                </div>

                {/* Locked Paragraphs */}
                <div className="space-y-6 text-slate-200 text-base sm:text-lg leading-relaxed">
                  {Array.isArray(currentPreset.locked_content?.paragraphs) ? (
                    currentPreset.locked_content.paragraphs.map((p, idx) => (
                      <p key={idx}>{p}</p>
                    ))
                  ) : (
                    <p>{currentPreset.locked_content?.paragraphs}</p>
                  )}
                </div>

                {/* Audit Comparison Table */}
                {currentPreset.locked_content?.audit_table && (
                  <div className="not-italic font-sans my-8 bg-slate-900 border border-slate-800 rounded-2xl p-6 overflow-hidden">
                    <h4 className="text-base font-bold text-white mb-4 flex items-center gap-2">
                      <span className="w-2 h-2 rounded-full bg-rose-500" />
                      {currentPreset.locked_content.audit_table.title}
                    </h4>
                    <div className="overflow-x-auto">
                      <table className="w-full text-left text-sm text-slate-300 border-collapse">
                        <thead>
                          <tr className="border-b border-slate-800 text-xs text-slate-400 font-semibold uppercase tracking-wider">
                            {currentPreset.locked_content.audit_table.headers.map((h, idx) => (
                              <th key={idx} className="py-3 px-4">{h}</th>
                            ))}
                          </tr>
                        </thead>
                        <tbody className="divide-y divide-slate-800/60 font-mono text-xs sm:text-sm">
                          {currentPreset.locked_content.audit_table.rows.map((row, rIdx) => (
                            <tr key={rIdx} className="hover:bg-slate-800/40 transition-colors">
                              {row.map((cell, cIdx) => (
                                <td key={cIdx} className={`py-3 px-4 ${cIdx === row.length - 1 ? 'text-rose-400 font-bold' : ''}`}>
                                  {cell}
                                </td>
                              ))}
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  </div>
                )}

                {/* Attached Proofs List */}
                {currentPreset.locked_content?.attached_proofs && (
                  <div className="not-italic font-sans bg-slate-900/70 border border-slate-800 rounded-2xl p-6">
                    <h4 className="text-sm font-bold text-white mb-3 uppercase tracking-wider flex items-center gap-2">
                      <svg className="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                      </svg>
                      সংযুক্ত অনুসন্ধানী প্রুফ ডকুমেন্টস:
                    </h4>
                    <ul className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                      {currentPreset.locked_content.attached_proofs.map((proof, idx) => (
                        <li key={idx} className="flex items-center gap-2.5 p-3 rounded-xl bg-slate-800/80 border border-slate-700/60 text-xs text-slate-300">
                          <span className="p-1.5 rounded-lg bg-rose-500/10 text-rose-400">PDF</span>
                          <span className="truncate font-sans">{proof}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                )}

                {/* Interactive Reader Features (Reader Q&A & Whistleblower Tip Box) */}
                <div className="not-italic font-sans pt-6 border-t border-slate-800 grid grid-cols-1 md:grid-cols-2 gap-6">
                  {/* Ask Columnist Direct Question */}
                  <div className="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                    <h4 className="text-sm font-bold text-white mb-1 flex items-center gap-2">
                      <span>💬</span> কলামিস্টকে সরাসরি প্রশ্ন করুন
                    </h4>
                    <p className="text-xs text-slate-400 mb-4">
                      পেইড সাবস্ক্রাইবার হিসেবে আপনার প্রশ্নের জবাব কলামিস্টের পরবর্তী অপ-এডে দেওয়া হবে।
                    </p>
                    {questionSuccess ? (
                      <div className="p-3 bg-emerald-950/60 border border-emerald-600/40 rounded-xl text-emerald-300 text-xs">
                        ✓ আপনার প্রশ্নটি কলামিস্টের ব্যক্তিগত ড্যাশবোর্ডে পাঠানো হয়েছে!
                      </div>
                    ) : (
                      <form onSubmit={handleQuestionSubmit} className="space-y-3">
                        <textarea
                          rows={2}
                          value={readerQuestion}
                          onChange={(e) => setReaderQuestion(e.target.value)}
                          placeholder="এই অনুসন্ধান সম্পর্কে আপনার প্রশ্ন বা মন্তব্য লিখুন..."
                          className="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-rose-500"
                        />
                        <button
                          type="submit"
                          className="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-xl text-xs font-semibold border border-slate-700 transition-colors"
                        >
                          প্রশ্ন পাঠান
                        </button>
                      </form>
                    )}
                  </div>

                  {/* Whistleblower Anonymous Tip-box */}
                  <div className="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                    <h4 className="text-sm font-bold text-white mb-1 flex items-center gap-2">
                      <span>🔐</span> এনক্রিপ্টেড হুইসেলব্লোয়ার টিপ-বক্স
                    </h4>
                    <p className="text-xs text-slate-400 mb-4">
                      ক্লায়েন্ট-সাইড ২৫৬-বিট এনক্রিপশন। আপনার আইপি বা পরিচয় কোথাও সংরক্ষিত হবে না।
                    </p>
                    {tipSuccess ? (
                      <div className="p-3 bg-emerald-950/60 border border-emerald-600/40 rounded-xl text-emerald-300 text-xs">
                        ✓ আপনার গোপন তথ্য সম্পূর্ণ এনক্রিপ্ট হয়ে কলামিস্টের ভল্টে পৌঁছেছে।
                      </div>
                    ) : (
                      <form onSubmit={handleTipSubmit} className="space-y-3">
                        <textarea
                          rows={2}
                          value={tipBoxMessage}
                          onChange={(e) => setTipBoxMessage(e.target.value)}
                          placeholder="গোপন তথ্য, নথিপত্রের লিংক বা কোনো সূত্র প্রদান করুন..."
                          className="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-rose-500"
                        />
                        <button
                          type="submit"
                          className="px-4 py-2 bg-rose-700 hover:bg-rose-600 text-white rounded-xl text-xs font-semibold transition-colors shadow-sm shadow-rose-900/40"
                        >
                          এনক্রিপ্ট করে পাঠান
                        </button>
                      </form>
                    )}
                  </div>
                </div>
              </div>
            )}
          </div>
        </div>
      </div>

      {/* bKash Payment Simulation Modal */}
      {showBcashModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-md">
          <div className="w-full max-w-md bg-white text-slate-900 rounded-3xl shadow-2xl overflow-hidden animate-scaleUp">
            {/* bKash Header */}
            <div className="bg-[#DF146E] p-6 text-white text-center relative">
              <button
                type="button"
                onClick={() => setShowBcashModal(false)}
                className="absolute top-4 right-4 text-white/80 hover:text-white text-lg font-bold p-1"
              >
                ✕
              </button>
              <div className="text-xs font-semibold tracking-wider uppercase mb-1 opacity-90">bKash 1-Tap Unlock Demo</div>
              <h3 className="text-xl font-black">বিকাশ পেমেন্ট গেটওয়ে</h3>
              <p className="text-xs text-white/90 mt-1">
                মার্চেন্ট: Zengfy Journal • {currentPreset.author}
              </p>
            </div>

            {/* Modal Body */}
            <form onSubmit={handleConfirmPayment} className="p-6 space-y-4">
              <div className="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-center">
                <div className="text-xs text-slate-500">পরিশোধের পরিমাণ</div>
                <div className="text-2xl font-black text-[#DF146E]">
                  {selectedPlan === 'monthly' ? '৳১০০.০০' : '৳১,০০০.০০'}
                </div>
                <div className="text-[11px] text-slate-500 mt-1">
                  {selectedPlan === 'monthly' ? 'মাসিক রিডার সাবস্ক্রিপশন ফি' : 'বার্ষিক রিডার সাবস্ক্রিপশন ফি (২ মাস ফ্রি)'}
                </div>
              </div>

              <div>
                <label className="block text-xs font-semibold text-slate-700 mb-1">
                  বিকাশ অ্যাকাউন্ট নম্বর
                </label>
                <input
                  type="text"
                  value={bkashPhone}
                  onChange={(e) => setBkashPhone(e.target.value)}
                  className="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-mono text-sm focus:outline-none focus:border-[#DF146E]"
                  required
                />
              </div>

              <div>
                <label className="block text-xs font-semibold text-slate-700 mb-1">
                  বিকাশ পিন (ডেমো জন্য যে কোনো ৪-৫ ডিজিট দিন)
                </label>
                <input
                  type="password"
                  maxLength={5}
                  value={pinInput}
                  onChange={(e) => setPinInput(e.target.value)}
                  placeholder="• • • • •"
                  className="w-full px-4 py-2.5 rounded-xl border border-slate-300 font-mono text-center tracking-widest text-lg focus:outline-none focus:border-[#DF146E]"
                  required
                />
              </div>

              <div className="pt-2 flex gap-3">
                <button
                  type="button"
                  onClick={() => setShowBcashModal(false)}
                  className="w-1/2 py-3 rounded-xl border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-100 transition-colors"
                >
                  বাতিল
                </button>
                <button
                  type="submit"
                  disabled={isProcessing || pinInput.length < 4}
                  className="w-1/2 py-3 rounded-xl bg-[#DF146E] hover:bg-[#c20f5e] text-white text-sm font-bold shadow-md shadow-pink-500/30 transition-colors disabled:opacity-50"
                >
                  {isProcessing ? 'যাচাই হচ্ছে...' : 'নিশ্চিত করুন'}
                </button>
              </div>

              <p className="text-[11px] text-center text-slate-400 mt-2">
                এটি একটি নিরাপদ সিমুলেশন। কোনো আসল টাকা কর্তন করা হবে না।
              </p>
            </form>
          </div>
        </div>
      )}
    </section>
  );
}
