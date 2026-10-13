import React, { useState } from 'react';

export default function PostSscSkillCareerSimulator({ simulatorData = {} }) {
  const quizQuestions = simulatorData.quiz_questions || [
    {
      id: 'q_level',
      title: 'প্রশ্ন ১ (শিক্ষাগত পর্যায়):',
      options: [
        { id: 'ssc', label: 'এসএসসি ২০২৬ উত্তীর্ণ', desc: 'পরীক্ষার পরবর্তী ৩-৪ মাসের অবসর সময়ের সদ্ব্যবহার' },
        { id: 'hsc', label: 'এইচএসসি ২০২৬ উত্তীর্ণ', desc: 'বিশ্ববিদ্যালয় ভর্তির আগের অবসর সময়ের সদ্ব্যবহার' },
        { id: 'diploma_uni', label: 'ডিপ্লোমা/বিশ্ববিদ্যালয় শিক্ষার্থী', desc: 'পড়াশোনার পাশাপাশি প্র্যাক্টিক্যাল স্কিল অর্জন' },
      ],
    },
    {
      id: 'q_interest',
      title: 'প্রশ্ন ২ (আগ্রহের ক্ষেত্র):',
      options: [
        { id: 'coding', label: 'কোডিং ও সফটওয়্যার', track_id: 'web_dev' },
        { id: 'design', label: 'ইউআই/ইউএক্স ও ক্রিয়েটিভ ডিজাইন', track_id: 'ui_ux' },
        { id: 'english', label: 'স্পোকেন ইংলিশ ও প্রফেশনাল কমিউনিকেশন', track_id: 'spoken_english' },
        { id: 'marketing', label: 'ডিজিটাল ফ্রিল্যান্সিং', track_id: 'digital_freelancing' },
      ],
    },
    {
      id: 'q_time',
      title: 'প্রশ্ন ৩ (দৈনিক সময়):',
      options: [
        { id: 'time_1_2', label: '১-২ ঘণ্টা', intensity: 'Moderate' },
        { id: 'time_3_4', label: '৩-৪ ঘণ্টা (প্রস্তাবিত)', intensity: 'Recommended' },
        { id: 'time_full', label: 'ফুল-টাইম বুটক্যাম্প (৫+ ঘণ্টা)', intensity: 'Intensive' },
      ],
    },
  ];

  const tracks = simulatorData.tracks || {
    web_dev: {
      id: 'web_dev',
      title: 'প্র্যাক্টিক্যাল ফুল-স্ট্যাক ওয়েব ও ফ্রিল্যান্সিং ক্যারিয়ার',
      match_score: 98,
      duration: '৯০ দিন (৩ মাস)',
      badge: 'সেরা স্কিল ট্র্যাক 🌟',
      description: 'শূন্য থেকে প্রোগ্রামিং লজিক, রিয়্যাক্ট, গিটহাব এবং সরাসরি ক্লায়েন্ট প্রজেক্ট সম্পন্ন করে নিজেকে কর্মক্ষম গড়ে তোলার পূর্ণাঙ্গ রোডম্যাপ।',
      roadmap: {
        'মাস ১': 'ফাউন্ডেশন ও লজিক',
        'মাস ২': 'রিয়্যাক্ট ও গিটহাব',
        'মাস ৩': 'ক্লায়েন্ট প্রজেক্ট ও সিভি',
      },
    },
    ui_ux: {
      id: 'ui_ux',
      title: 'ইউআই/ইউএক্স ও ক্রিয়েটিভ ডিজাইন',
      match_score: 96,
      duration: '৯০ দিন (৩ মাস)',
      badge: 'সেরা স্কিল ট্র্যাক ✨',
      description: 'ডিজাইন থিওরি, কালার সাইকোলজি, ফিগমা মাস্টারক্লাস এবং লাইভ মোবাইল ও ওয়েব ইন্টারফেস তৈরির মাধ্যমে টপ ডিজাইনার হওয়ার গাইডলাইন।',
      roadmap: {
        'মাস ১': 'ফাউন্ডেশন ও ফিগমা টুলস',
        'মাস ২': 'মোবাইল অ্যাপ ওয়্যারফ্রেম ও প্রোটোটাইপিং',
        'মাস ৩': 'ক্লায়েন্ট পোর্টফোলিও ও সিভি',
      },
    },
    spoken_english: {
      id: 'spoken_english',
      title: 'স্পোকেন ইংলিশ ও প্রফেশনাল কমিউনিকেশন',
      match_score: 95,
      duration: '৬০ দিন (২ মাস)',
      badge: 'সেরা স্কিল ট্র্যাক 🌐',
      description: 'ইংরেজি ভীতি দূর করে আন্তর্জাতিক বায়ারদের সাথে সাবলীলভাবে ভিডিও ইন্টারভিউ দেওয়া এবং মেসেজে কাজ নেওয়ার স্পেশালাইজড স্পোকেন ট্র্যাক।',
      roadmap: {
        'মাস ১': 'ফাউন্ডেশন ও ফ্লুয়েন্ট স্পিকিং',
        'মাস ২': 'বায়ার মিটিং ও ভিডিও ইন্টারভিউ',
        'মাস ৩': 'প্রফেশনাল কোল্ড ইমেল ও সিভি',
      },
    },
    digital_freelancing: {
      id: 'digital_freelancing',
      title: 'ডিজিটাল ফ্রিল্যান্সিং',
      match_score: 94,
      duration: '৯০ দিন (৩ মাস)',
      badge: 'সেরা স্কিল ট্র্যাক 🚀',
      description: 'মেটা ও গুগল অ্যাডস, এসইও, সেলস ফানেল এবং এফ-কমার্স ব্যবসার গ্রোথ স্ট্র্যাটেজি শিখে নিশ্চিত ডিজিটাল ফ্রিল্যান্সিং স্কিল।',
      roadmap: {
        'মাস ১': 'ফাউন্ডেশন ও কন্টেন্ট স্ট্র্যাটেজি',
        'মাস ২': 'মেটা অ্যাডস ও এসইও অপ্টিমাইজেশন',
        'মাস ৩': 'ক্লায়েন্ট প্রজেক্ট ও ফ্রিল্যান্সিং প্রোফাইল',
      },
    },
  };

  const mentor = simulatorData.mentor || {
    name: 'তানভীরুল ইসলাম',
    designation: 'সিনিয়র সফটওয়্যার ইঞ্জিনিয়ার',
    verified_badge: 'Zengfy Verified Badge 🏅',
    rating: '৪.৯/৫ রেটিং',
    students_count: '১,৪৫০+ সফল শিক্ষার্থী',
    nid_verified: true,
    location: 'ঢাকা, বাংলাদেশ',
  };

  const sampleCertificate = simulatorData.sample_certificate || {
    student_name: 'সাকিব আল হাসান',
    course_title: 'Full-Stack Web & Freelancing Career (Post-SSC 2026)',
    credential_id: 'ZG-SKL-2026-89421',
    nid_hash: 'NID-V-***9812',
    issue_date: '১৩ অক্টোবর, ২০২৬',
  };

  // State
  const [selectedLevel, setSelectedLevel] = useState('ssc');
  const [selectedInterest, setSelectedInterest] = useState('coding');
  const [selectedTime, setSelectedTime] = useState('time_3_4');
  const [isSubmittingQuiz, setIsSubmittingQuiz] = useState(false);
  const [quizSubmitted, setQuizSubmitted] = useState(true);
  const [isPlayingVideo, setIsPlayingVideo] = useState(false);
  const [showCertificateModal, setShowCertificateModal] = useState(false);

  // Active track
  const activeTrackKey = selectedInterest === 'coding'
    ? 'web_dev'
    : selectedInterest === 'design'
    ? 'ui_ux'
    : selectedInterest === 'english'
    ? 'spoken_english'
    : 'digital_freelancing';

  const currentTrack = tracks[activeTrackKey] || tracks.web_dev;

  const handleSubmitQuiz = () => {
    setIsSubmittingQuiz(true);
    setQuizSubmitted(false);
    setTimeout(() => {
      setIsSubmittingQuiz(false);
      setQuizSubmitted(true);
    }, 400);
  };

  return (
    <section id="simulator" className="py-16 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12">
          <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-100 text-blue-800 text-xs font-bold mb-3 border border-blue-200">
            <span>🎯 পোস্ট-এসএসসি ক্যারিয়ার গাইডেন্স কুইজ ও ভেরিফাইড কোর্স ট্রায়াল প্লেয়ার</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
            পোস্ট-এসএসসি ক্যারিয়ার গাইডেন্স কুইজ
          </h2>
          <p className="text-sm sm:text-base text-slate-600">
            নিচের ৩টি প্রশ্নের উত্তর দিয়ে কুইজ সাবমিট করুন। জেনফাই এআই স্বয়ংক্রিয়ভাবে আপনার জন্য সেরা স্কিল ট্র্যাক, ৩ মাসের রোডম্যাপ এবং ভেরিফাইড মেন্টর ডেমো লেকচার উপস্থাপন করবে।
          </p>
        </div>

        {/* Simulator Grid */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          {/* Left Column: 3 Interactive Quiz Questions (5 Cols) */}
          <div className="lg:col-span-5 space-y-6">
            {/* Question 1: Educational Level */}
            <div className="p-6 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md">
              <div className="flex items-center justify-between mb-3">
                <span className="text-xs font-bold uppercase tracking-wider text-slate-500">
                  প্রশ্ন ১ (শিক্ষাগত পর্যায়)
                </span>
                <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 font-mono">
                  STEP 1 / 3
                </span>
              </div>
              <div className="space-y-2">
                {quizQuestions[0]?.options.map((opt) => {
                  const isSelected = opt.id === selectedLevel;
                  return (
                    <button
                      key={opt.id}
                      type="button"
                      onClick={() => setSelectedLevel(opt.id)}
                      className={`w-full text-left p-3.5 rounded-2xl border transition-all cursor-pointer ${
                        isSelected
                          ? 'border-blue-600 bg-blue-50/70 shadow-sm ring-2 ring-blue-500/20'
                          : 'border-slate-200/80 hover:border-slate-300 hover:bg-slate-50/60'
                      }`}
                    >
                      <div className="text-xs font-bold text-slate-900">{opt.label}</div>
                      <div className="text-[11px] text-slate-500 mt-0.5">{opt.desc}</div>
                    </button>
                  );
                })}
              </div>
            </div>

            {/* Question 2: Interest Field */}
            <div className="p-6 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md">
              <div className="flex items-center justify-between mb-3">
                <span className="text-xs font-bold uppercase tracking-wider text-slate-500">
                  প্রশ্ন ২ (আগ্রহের ক্ষেত্র)
                </span>
                <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-cyan-50 text-cyan-700 font-mono">
                  STEP 2 / 3
                </span>
              </div>
              <div className="space-y-2">
                {quizQuestions[1]?.options.map((opt) => {
                  const isSelected = opt.id === selectedInterest;
                  return (
                    <button
                      key={opt.id}
                      type="button"
                      onClick={() => {
                        setSelectedInterest(opt.id);
                        setIsPlayingVideo(false);
                      }}
                      className={`w-full text-left p-3 rounded-2xl border transition-all cursor-pointer flex items-center justify-between ${
                        isSelected
                          ? 'border-cyan-600 bg-cyan-50/60 shadow-sm ring-2 ring-cyan-500/20'
                          : 'border-slate-200/80 hover:border-slate-300 hover:bg-slate-50/60'
                      }`}
                    >
                      <div className="text-xs font-bold text-slate-900">{opt.label}</div>
                      <span className="text-xs font-bold text-cyan-700">{isSelected ? '✓' : '→'}</span>
                    </button>
                  );
                })}
              </div>
            </div>

            {/* Question 3: Daily Time Commitment */}
            <div className="p-6 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/80 shadow-md">
              <div className="flex items-center justify-between mb-3">
                <span className="text-xs font-bold uppercase tracking-wider text-slate-500">
                  প্রশ্ন ৩ (দৈনিক সময়)
                </span>
                <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-mono">
                  STEP 3 / 3
                </span>
              </div>
              <div className="grid grid-cols-3 gap-2 mb-4">
                {quizQuestions[2]?.options.map((opt) => {
                  const isSelected = opt.id === selectedTime;
                  return (
                    <button
                      key={opt.id}
                      type="button"
                      onClick={() => setSelectedTime(opt.id)}
                      className={`p-2.5 rounded-2xl border text-center transition-all cursor-pointer ${
                        isSelected
                          ? 'border-blue-600 bg-blue-600 text-white font-bold shadow-md shadow-blue-600/30'
                          : 'border-slate-200/80 bg-white hover:bg-slate-50 text-slate-700'
                      }`}
                    >
                      <div className="text-xs font-extrabold truncate">{opt.label}</div>
                      <div className={`text-[10px] mt-0.5 ${isSelected ? 'text-blue-100' : 'text-slate-400'}`}>
                        {opt.intensity}
                      </div>
                    </button>
                  );
                })}
              </div>

              {/* Submit Quiz Action Button */}
              <button
                type="button"
                onClick={handleSubmitQuiz}
                disabled={isSubmittingQuiz}
                className="w-full py-3.5 px-4 rounded-2xl font-bold text-xs text-white bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-lg shadow-blue-600/30 transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-98"
              >
                {isSubmittingQuiz ? (
                  <>
                    <svg className="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                      <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                      <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                    </svg>
                    <span>এআই রিকমেন্ডেশন তৈরি হচ্ছে...</span>
                  </>
                ) : (
                  <>
                    <span>⚡ কুইজ সাবমিট করুন ও সেরা স্কিল ট্র্যাক দেখুন</span>
                  </>
                )}
              </button>
            </div>
          </div>

          {/* Right Column: AI Recommendation, 3-Month Roadmap, Trainer & Video (7 Cols) */}
          <div className="lg:col-span-7 space-y-6">
            {/* AI Recommendation Result Card */}
            <div className="p-6 sm:p-8 rounded-3xl bg-white/95 backdrop-blur-2xl border border-slate-200/90 shadow-xl relative overflow-hidden">
              {/* Decorative Glow */}
              <div className="absolute -right-16 -top-16 w-48 h-48 rounded-full blur-3xl bg-blue-500/15 pointer-events-none" />

              {/* Recommendation Header */}
              <div className="pb-5 border-b border-slate-100">
                <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-800 text-xs font-bold mb-3">
                  <span>🏆 এআই রিকমেন্ডেশন ফলাফল</span>
                </div>

                <div className="flex items-start justify-between gap-4">
                  <div>
                    <h3 className="text-base sm:text-xl font-bold text-slate-800">
                      আপনার জন্য সেরা স্কিল ট্র্যাক:{' '}
                      <span className="font-extrabold text-blue-700 underline decoration-cyan-400">
                        {currentTrack.title}
                      </span>
                    </h3>
                    <p className="text-xs text-slate-500 mt-1 leading-relaxed">
                      {currentTrack.description}
                    </p>
                  </div>

                  <div className="text-right shrink-0">
                    <div className="text-3xl sm:text-4xl font-black text-blue-600 tracking-tight font-mono">
                      {currentTrack.match_score}%
                    </div>
                    <div className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                      ম্যাচ স্কোর
                    </div>
                  </div>
                </div>
              </div>

              {/* 3-Month Step-by-Step Roadmap */}
              <div className="my-6">
                <span className="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-3">
                  ৩ মাসের ধাপে ধাপে রোডম্যাপ প্রদর্শন:
                </span>
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-3">
                  {Object.entries(currentTrack.roadmap).map(([month, details], idx) => (
                    <div key={idx} className="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/70 text-left">
                      <div className="inline-block px-2 py-0.5 rounded-lg bg-blue-600 text-white text-[10px] font-bold mb-1.5 font-mono">
                        {month}
                      </div>
                      <div className="text-xs font-bold text-slate-800">
                        {details}
                      </div>
                    </div>
                  ))}
                </div>
              </div>

              {/* Verified Trainer Card & 1-Minute Demo Video Player */}
              <div className="p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-blue-50/80 to-cyan-50/80 border border-blue-200/70 space-y-4">
                {/* Trainer Info */}
                <div className="flex items-center justify-between flex-wrap gap-2 pb-3 border-b border-blue-200/60">
                  <div className="flex items-center gap-3">
                    <div className="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-cyan-500 text-white flex items-center justify-center font-black text-xl shadow-sm">
                      👨‍🏫
                    </div>
                    <div>
                      <div className="flex items-center gap-2">
                        <span className="text-sm font-black text-slate-900">{mentor.name}</span>
                        <span className="text-[11px] font-bold px-2 py-0.5 rounded-md bg-amber-100 text-amber-800 border border-amber-300">
                          {mentor.verified_badge}
                        </span>
                      </div>
                      <div className="text-xs text-slate-600 mt-0.5 font-semibold">
                        {mentor.designation} • {mentor.location}
                      </div>
                    </div>
                  </div>

                  <div className="text-right">
                    <div className="text-xs font-black text-slate-900">{mentor.rating}</div>
                    <div className="text-[11px] text-slate-600 font-semibold">{mentor.students_count}</div>
                  </div>
                </div>

                {/* 1-Minute Demo Video Player Mockup */}
                <div className="rounded-2xl bg-slate-900 text-white p-4 overflow-hidden border border-slate-800 shadow-inner">
                  <div className="flex items-center justify-between pb-3 border-b border-slate-800 text-xs">
                    <div className="flex items-center gap-2">
                      <span className="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse" />
                      <span className="font-mono text-slate-300">১ মিনিটের ডেমো ভিডিও লেকচার প্লেয়ার</span>
                    </div>
                    <span className="text-[10px] px-2 py-0.5 rounded bg-slate-800 text-cyan-400 font-mono">
                      LIVE CLASSROOM DEMO
                    </span>
                  </div>

                  <div className="py-5 text-center">
                    {isPlayingVideo ? (
                      <div className="space-y-3">
                        <div className="text-sm font-bold text-cyan-400 flex items-center justify-center gap-2">
                          <span className="w-2 h-2 rounded-full bg-cyan-400 animate-ping" />
                          <span>লাইভ প্রিমিয়াম ক্লাসরুম লেকচার প্লে হচ্ছে... (0:42 / 1:00)</span>
                        </div>
                        <div className="w-full h-2 rounded-full bg-slate-800 overflow-hidden max-w-sm mx-auto">
                          <div className="h-full bg-gradient-to-r from-blue-500 to-cyan-400 w-3/4 rounded-full transition-all duration-1000" />
                        </div>
                        <p className="text-xs text-slate-300 italic">
                          "এসএসসি বা এইচএসসি পরীক্ষার পর প্রতিদিন ৩ ঘণ্টা প্র্যাকটিস করলে কিভাবে ৯০ দিনে ফার্স্ট ফ্রিল্যান্সিং অর্ডার পাওয়া যায়..."
                        </p>
                        <button
                          type="button"
                          onClick={() => setIsPlayingVideo(false)}
                          className="px-3 py-1 rounded-lg bg-slate-800 text-slate-300 text-xs hover:bg-slate-700 cursor-pointer"
                        >
                          পজ করুন ⏸
                        </button>
                      </div>
                    ) : (
                      <div className="space-y-2">
                        <button
                          type="button"
                          onClick={() => setIsPlayingVideo(true)}
                          className="w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-500 text-white flex items-center justify-center text-xl mx-auto shadow-lg shadow-blue-600/40 cursor-pointer hover:scale-105 transition-all"
                        >
                          ▶
                        </button>
                        <div className="text-xs font-bold text-slate-200">
                          ১ মিনিটের ডেমো ভিডিও লেকচার শুনুন (Play Lecture)
                        </div>
                        <div className="text-[11px] text-slate-400">
                          ক্লিক করলেই লাইভ প্রিমিয়াম ক্লাসরুম লেকচার প্লে হয়
                        </div>
                      </div>
                    )}
                  </div>
                </div>

                {/* Bottom Actions: NID Certificate & Start Free Trial */}
                <div className="flex flex-wrap items-center justify-between gap-3 pt-2">
                  <button
                    type="button"
                    onClick={() => setShowCertificateModal(true)}
                    className="px-4 py-2.5 rounded-xl text-xs font-bold text-blue-700 bg-white hover:bg-blue-50 border border-blue-200 transition-all flex items-center gap-1.5 cursor-pointer shadow-xs"
                  >
                    <span>📜 এনআইডি-ভেরিফাইড ট্যাম্পার-প্রুফ সার্টিফিকেট প্রিভিউ</span>
                  </button>

                  <a
                    href="http://zengfy.test:8000/register?continue=http%3A%2F%2Fskill.zengfy.test%3A8000%2F"
                    className="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 shadow-md shadow-blue-600/25 transition-all flex items-center gap-1.5 cursor-pointer"
                  >
                    <span>ফ্রি ট্রায়াল শুরু করুন / ভর্তি কনফার্ম করুন</span>
                    <span>→</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* MODAL: NID-Verified Tamper-Proof Certificate */}
      {showCertificateModal && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4 animate-in fade-in">
          <div className="w-full max-w-lg bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-200 text-left relative">
            <button
              type="button"
              onClick={() => setShowCertificateModal(false)}
              className="absolute top-4 right-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-sm cursor-pointer"
            >
              ✕
            </button>

            {/* Certificate Header */}
            <div className="text-center pb-4 border-b border-slate-200">
              <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-800 text-xs font-bold mb-2">
                <span>🇧🇩 বাংলাদেশ সার্বভৌম স্কিল ক্রেডেনশিয়াল</span>
              </div>
              <h4 className="text-xl font-black text-slate-900">
                VERIFIED DIGITAL CERTIFICATE
              </h4>
              <p className="text-xs text-slate-500 font-mono">
                CREDENTIAL ID: {sampleCertificate.credential_id}
              </p>
            </div>

            {/* Certificate Body */}
            <div className="my-5 p-5 rounded-2xl bg-gradient-to-br from-slate-50 via-white to-blue-50/50 border-2 border-dashed border-blue-200 text-center space-y-3">
              <span className="text-xs text-slate-400 uppercase tracking-widest block font-serif">
                This is proudly presented to
              </span>
              <h3 className="text-2xl font-black text-slate-900 tracking-tight font-serif">
                {sampleCertificate.student_name}
              </h3>
              <p className="text-xs text-slate-600 max-w-sm mx-auto leading-relaxed">
                for successfully graduating the 90-day intensive curriculum:
              </p>
              <div className="text-sm font-extrabold text-blue-700 px-3 py-1.5 bg-blue-50/80 rounded-xl inline-block border border-blue-200">
                {sampleCertificate.course_title}
              </div>

              {/* Security & Verification Details */}
              <div className="pt-3 border-t border-slate-200 grid grid-cols-2 gap-2 text-left text-[11px] font-mono text-slate-600">
                <div>
                  <span className="text-slate-400 block">NID Verification:</span>
                  <strong className="text-emerald-700">✓ {sampleCertificate.nid_hash}</strong>
                </div>
                <div>
                  <span className="text-slate-400 block">Date of Issue:</span>
                  <strong>{sampleCertificate.issue_date}</strong>
                </div>
              </div>

              {/* QR Code Simulation */}
              <div className="pt-2 flex items-center justify-center gap-3">
                <div className="w-16 h-16 bg-white border border-slate-300 rounded-xl p-1 flex items-center justify-center font-mono text-[9px] text-slate-400 text-center leading-tight">
                  [QR CODE]<br />LINKEDIN VERIFIED
                </div>
                <div className="text-left text-xs">
                  <div className="font-bold text-slate-800">LinkedIn Verifiable</div>
                  <div className="text-[11px] text-slate-500">কিউআর কোড স্ক্যান করে লিঙ্কডইন ও সিভিতে শতভাগ ভেরিফাই করা যায়।</div>
                </div>
              </div>
            </div>

            {/* Modal Buttons */}
            <div className="flex gap-2">
              <button
                type="button"
                onClick={() => {
                  alert('[Credential Verification] কিউআর লিঙ্কডইন অথেনটিকেশন সফলভাবে ভ্যালিডেট হয়েছে!');
                  setShowCertificateModal(false);
                }}
                className="flex-1 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md transition-all cursor-pointer"
              >
                🔗 লিঙ্কডইনে সার্টিফিকেট শেয়ার করুন
              </button>
              <button
                type="button"
                onClick={() => setShowCertificateModal(false)}
                className="px-4 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition-all cursor-pointer"
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
