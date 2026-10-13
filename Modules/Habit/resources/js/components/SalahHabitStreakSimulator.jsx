import React, { useState } from 'react';

export default function SalahHabitStreakSimulator({ simulatorData }) {
  const data = simulatorData || {};

  const defaultPrayers = [
    { id: 'fajr', name: 'ফজর', name_en: 'Fajr', time: '৪:৪৫ AM', completed: true, hadith_hint: 'ফজরের সালাত আদায়কারী আল্লাহর নিরাপত্তায় থাকে।' },
    { id: 'dhuhr', name: 'যোহর', name_en: 'Dhuhr', time: '১:১৫ PM', completed: true, hadith_hint: 'যোহরের ওয়াক্তে রহমতের দরজা উন্মুক্ত হয়।' },
    { id: 'asr', name: 'আসর', name_en: 'Asr', time: '৪:৩০ PM', completed: true, hadith_hint: 'মধ্যবর্তী সালাতের প্রতি যত্নশীল হও।' },
    { id: 'maghrib', name: 'মাগরিব', name_en: 'Maghrib', time: '৫:৫৫ PM', completed: false, hadith_hint: 'সূর্যাস্তের পর বিলম্ব না করে সালাত আদায় করো।' },
    { id: 'isha', name: 'ইশা', name_en: 'Isha', time: '৭:১৫ PM', completed: false, hadith_hint: 'ইশা ও ফজর জামাতে আদায়কারী যেন সারা রাত সালাত পড়ল।' },
  ];

  const defaultHabits = [
    { id: 'quran', name: 'কুরআন তেলাওয়াত (১০ মিনিট)', target: '১০ মিনিট', completed: true, icon: '📖' },
    { id: 'water', name: 'পর্যাপ্ত পানি পান (২ লিটার)', target: '২ লিটার', completed: false, icon: '💧' },
  ];

  const defaultCelebrations = [
    { verse: 'সালাত মুমিনের মিরাজ — বুখারী', reference: 'সহীহ বুখারী' },
    { verse: 'নিশ্চয় সালাত অশ্লীল ও মন্দ কাজ থেকে বিরত রাখে', reference: 'সূরা আল-আনকাবুত: ৪৫' },
    { verse: 'আল্লাহর নিকট সর্বাধিক প্রিয় আমল হলো সময়মত সালাত আদায় করা', reference: 'সহীহ বুখারী ও মুসলিম' },
    { verse: 'যে ব্যক্তি ফজরের সালাত আদায় করল, সে আল্লাহর জিম্মাদারীতে রইল', reference: 'সহীহ মুসলিম' },
  ];

  const defaultLeaderboard = [
    { name: 'তানভীর আহমেদ (আপনি)', role: 'সদস্য', streak: 24, score: '১০০%', badge: '🔥 টপ স্ট্রিক' },
    { name: 'আব্দুল্লাহ আল নোমান', role: 'ভাই / স্টাডি সার্কেল', streak: 22, score: '৯৬%', badge: '⭐ নিয়মিত' },
    { name: 'আফরিন সুলতানা', role: 'বোন / ফ্যামিলি', streak: 19, score: '৯১%', badge: '🌿 একনিষ্ঠ' },
    { name: 'সাকিব হাসান', role: 'বন্ধু', streak: 15, score: '৮৫%', badge: '🌱 উন্নতিশীল' },
  ];

  const [prayers, setPrayers] = useState(data.prayers || defaultPrayers);
  const [microHabits, setMicroHabits] = useState(data.micro_habits || defaultHabits);
  const [activeTab, setActiveTab] = useState('tracker'); // 'tracker' or 'leaderboard'
  const [showHadithCard, setShowHadithCard] = useState(false);
  const [selectedHadithIndex, setSelectedHadithIndex] = useState(0);

  const hadithList = data.celebration_hadiths || defaultCelebrations;
  const leaderboard = data.circle_leaderboard || defaultLeaderboard;

  // Calculate streak: base 24 + 1 if all prayers completed
  const completedPrayersCount = prayers.filter((p) => p.completed).length;
  const completedHabitsCount = microHabits.filter((h) => h.completed).length;
  const allPrayersDone = completedPrayersCount === prayers.length;
  const currentStreak = (data.initial_streak || 24) + (allPrayersDone ? 1 : 0);

  const togglePrayer = (id) => {
    setPrayers((prev) => {
      const updated = prev.map((p) => (p.id === id ? { ...p, completed: !p.completed } : p));
      const newlyAllDone = updated.every((p) => p.completed);
      if (newlyAllDone) {
        setSelectedHadithIndex(Math.floor(Math.random() * hadithList.length));
        setShowHadithCard(true);
      }
      return updated;
    });
  };

  const toggleHabit = (id) => {
    setMicroHabits((prev) =>
      prev.map((h) => (h.id === id ? { ...h, completed: !h.completed } : h))
    );
  };

  const handleMarkAllPrayers = () => {
    setPrayers((prev) => prev.map((p) => ({ ...p, completed: true })));
    setMicroHabits((prev) => prev.map((h) => ({ ...h, completed: true })));
    setSelectedHadithIndex(0);
    setShowHadithCard(true);
  };

  const handleResetPrayers = () => {
    setPrayers(defaultPrayers);
    setMicroHabits(defaultHabits);
    setShowHadithCard(false);
  };

  return (
    <section id="simulator" className="py-20 bg-slate-900 text-slate-100 relative overflow-hidden">
      {/* Decorative Glow Orbs */}
      <div className="absolute top-10 left-10 w-96 h-96 bg-emerald-900/20 rounded-full blur-3xl pointer-events-none" />
      <div className="absolute bottom-10 right-10 w-96 h-96 bg-amber-900/20 rounded-full blur-3xl pointer-events-none" />

      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-12">
          <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold mb-4 tracking-wider">
            <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse" />
            লাইভ সালাত ও আমল স্যান্ডবক্স
          </div>
          <h2 className="text-2xl sm:text-4xl font-extrabold tracking-tight text-white mb-4">
            {data.headline || 'দৈনিক সালাত ও মাইক্রো-হ্যাবিট স্ট্রিক স্যান্ডবক্স'}
          </h2>
          <p className="text-slate-300 text-base sm:text-lg">
            {data.subheadline || 'আজকের সালাত ও আমলগুলো চেক করুন এবং লাইভ স্ট্রিক বৃদ্ধি উপভোগ করুন। শতভাগ নো-অ্যাড ও নো-ডাটা-মাইনিং।'}
          </p>
        </div>

        {/* Dashboard Box */}
        <div className="bg-slate-950 border border-slate-800 rounded-3xl shadow-2xl overflow-hidden">
          {/* Top Control Bar with Streak Counter & View Switcher */}
          <div className="bg-slate-900/90 border-b border-slate-800 px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            {/* Live Streak Counter */}
            <div className="flex items-center gap-3">
              <div className="flex items-center gap-2 px-4 py-2 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-300">
                <span className="text-2xl animate-bounce">🔥</span>
                <div>
                  <div className="text-xs uppercase tracking-wider font-semibold text-amber-400">
                    দৈনিক স্ট্রিক
                  </div>
                  <div className="text-lg font-black text-amber-200">
                    {currentStreak} Days Streak
                  </div>
                </div>
              </div>

              <div className="hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-500/10 text-emerald-300 text-xs font-semibold border border-emerald-500/20">
                <span>✓ সালাত: {completedPrayersCount}/৫</span>
                <span>• আমল: {completedHabitsCount}/২</span>
              </div>
            </div>

            {/* View Switcher Tabs */}
            <div className="flex items-center gap-2">
              <button
                type="button"
                onClick={() => setActiveTab('tracker')}
                className={`px-3.5 py-2 rounded-xl text-xs font-bold transition-all ${
                  activeTab === 'tracker'
                    ? 'bg-emerald-600 text-white shadow-md shadow-emerald-900/30'
                    : 'bg-slate-800 text-slate-300 hover:text-white'
                }`}
              >
                🕌 সালাত ও আমল চেকলিস্ট
              </button>

              <button
                type="button"
                onClick={() => setActiveTab('leaderboard')}
                className={`px-3.5 py-2 rounded-xl text-xs font-bold transition-all ${
                  activeTab === 'leaderboard'
                    ? 'bg-amber-600 text-white shadow-md shadow-amber-900/30'
                    : 'bg-slate-800 text-slate-300 hover:text-white'
                }`}
              >
                ⭕ ফ্যামিলি ও সার্কেল রিং
              </button>
            </div>
          </div>

          {/* Tab 1: Prayer & Micro-Habit Checklist */}
          {activeTab === 'tracker' && (
            <div className="p-6 sm:p-10">
              <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                {/* 5 Daily Prayers Column */}
                <div className="lg:col-span-7 space-y-4">
                  <div className="flex items-center justify-between pb-2 border-b border-slate-800">
                    <h3 className="text-base font-bold text-white flex items-center gap-2">
                      <span>🕌</span> আজকের ৫ ওয়াক্ত সালাত
                    </h3>
                    <div className="flex items-center gap-2">
                      <button
                        type="button"
                        onClick={handleMarkAllPrayers}
                        className="text-xs text-emerald-400 hover:text-emerald-300 underline transition-colors"
                      >
                        সব সম্পন্ন করুন (ডেমো)
                      </button>
                      <span className="text-slate-600">•</span>
                      <button
                        type="button"
                        onClick={handleResetPrayers}
                        className="text-xs text-slate-400 hover:text-rose-400 underline transition-colors"
                      >
                        রিসেট
                      </button>
                    </div>
                  </div>

                  <div className="space-y-3">
                    {prayers.map((prayer) => (
                      <div
                        key={prayer.id}
                        onClick={() => togglePrayer(prayer.id)}
                        className={`p-4 rounded-2xl border transition-all cursor-pointer flex items-center justify-between ${
                          prayer.completed
                            ? 'bg-emerald-950/40 border-emerald-600/50 text-white'
                            : 'bg-slate-900/60 border-slate-800 text-slate-300 hover:border-slate-700'
                        }`}
                      >
                        <div className="flex items-center gap-3.5">
                          <input
                            type="checkbox"
                            checked={prayer.completed}
                            onChange={() => {}} // handled by parent div onClick
                            className="w-5 h-5 rounded-md accent-emerald-500 cursor-pointer"
                          />
                          <div>
                            <div className="flex items-center gap-2">
                              <span className="text-base font-extrabold text-white">
                                {prayer.name}
                              </span>
                              <span className="text-xs text-slate-400 font-mono">
                                ({prayer.name_en})
                              </span>
                              {prayer.completed && (
                                <span className="text-[10px] bg-emerald-500/20 text-emerald-300 font-bold px-2 py-0.5 rounded-full border border-emerald-500/30">
                                  আদায়কৃত ✓
                                </span>
                              )}
                            </div>
                            <div className="text-xs text-slate-400 mt-0.5">
                              {prayer.hadith_hint}
                            </div>
                          </div>
                        </div>

                        <div className="text-xs font-mono font-bold text-emerald-400 bg-emerald-950/60 px-2.5 py-1 rounded-xl border border-emerald-800/40">
                          {prayer.time}
                        </div>
                      </div>
                    ))}
                  </div>

                  {/* Micro Habits List */}
                  <div className="pt-4">
                    <h4 className="text-sm font-bold text-slate-300 mb-3 flex items-center gap-2">
                      <span>✨</span> দৈনিক আত্মশুদ্ধি ও স্বাস্থ্য মাইক্রো-আমল
                    </h4>
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                      {microHabits.map((habit) => (
                        <div
                          key={habit.id}
                          onClick={() => toggleHabit(habit.id)}
                          className={`p-3.5 rounded-2xl border transition-all cursor-pointer flex items-center justify-between ${
                            habit.completed
                              ? 'bg-amber-950/40 border-amber-600/50 text-white'
                              : 'bg-slate-900/60 border-slate-800 text-slate-300 hover:border-slate-700'
                          }`}
                        >
                          <div className="flex items-center gap-2.5">
                            <input
                              type="checkbox"
                              checked={habit.completed}
                              onChange={() => {}}
                              className="w-4 h-4 rounded accent-amber-500 cursor-pointer"
                            />
                            <span className="text-base">{habit.icon}</span>
                            <span className="text-xs font-bold text-slate-200">
                              {habit.name}
                            </span>
                          </div>
                          {habit.completed && (
                            <span className="text-[10px] text-amber-300 font-bold">✓</span>
                          )}
                        </div>
                      ))}
                    </div>
                  </div>
                </div>

                {/* Right Column: Hadith Card & Streak Motivation */}
                <div className="lg:col-span-5 space-y-6">
                  {/* Streak Progress Summary */}
                  <div className="bg-gradient-to-br from-slate-900 via-slate-900 to-emerald-950/60 border border-slate-800 rounded-2xl p-6">
                    <div className="flex items-center justify-between mb-4">
                      <span className="text-xs font-bold uppercase tracking-wider text-emerald-400">
                        আজকের আমল প্রগ্রেস
                      </span>
                      <span className="text-xs font-mono text-slate-400">
                        {Math.round(((completedPrayersCount + completedHabitsCount) / 7) * 100)}% সম্পন্ন
                      </span>
                    </div>

                    <div className="w-full bg-slate-800 h-2.5 rounded-full overflow-hidden mb-4">
                      <div
                        className="bg-gradient-to-r from-emerald-500 to-amber-500 h-full transition-all duration-500 rounded-full"
                        style={{
                          width: `${((completedPrayersCount + completedHabitsCount) / 7) * 100}%`,
                        }}
                      />
                    </div>

                    <div className="text-xs text-slate-300 leading-relaxed">
                      {allPrayersDone
                        ? 'মাশাআল্লাহ! আজকের ৫ ওয়াক্ত সালাত সম্পূর্ণ সম্পন্ন হয়েছে। আপনার ধারাবাহিকতা বজায় রাখুন।'
                        : `বাকি রয়েছে ${prayers.length - completedPrayersCount} ওয়াক্ত সালাত। জামাতে সালাত আদায়ে যত্নশীল হোন।`}
                    </div>
                  </div>

                  {/* Animated Hadith Celebration Card */}
                  <div className="bg-slate-900/90 border border-emerald-500/30 rounded-2xl p-6 relative overflow-hidden shadow-lg">
                    <div className="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl pointer-events-none" />
                    
                    <div className="flex items-center justify-between mb-3">
                      <span className="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-300 bg-emerald-500/10 px-2.5 py-1 rounded-full border border-emerald-500/20">
                        <span>📖</span> সালাতের ফজিলত ও হাদিস
                      </span>
                      <button
                        type="button"
                        onClick={() =>
                          setSelectedHadithIndex((prev) => (prev + 1) % hadithList.length)
                        }
                        className="text-xs text-slate-400 hover:text-emerald-400 transition-colors"
                      >
                        পরবর্তী হাদিস →
                      </button>
                    </div>

                    <p className="text-base sm:text-lg font-serif italic text-white leading-relaxed mb-3">
                      “{hadithList[selectedHadithIndex]?.verse}”
                    </p>

                    <div className="text-xs text-emerald-400 font-semibold text-right">
                      — {hadithList[selectedHadithIndex]?.reference}
                    </div>
                  </div>

                  {/* Offline & Privacy Assurance */}
                  <div className="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-xs text-slate-400 flex items-center gap-3">
                    <span className="text-xl">🛡️</span>
                    <div>
                      <strong className="text-slate-200">১০০% নো-অ্যাড ও নো-ট্র্যাকিং: </strong>
                      আপনার সালাতের কোনো তথ্য ক্লাউডে বিক্রি বা ট্র্যাকিং করা হয় না। সম্পূর্ণ লোকাল স্টোরেজ।
                    </div>
                  </div>
                </div>
              </div>
            </div>
          )}

          {/* Tab 2: Family & Study Circle Leaderboard */}
          {activeTab === 'leaderboard' && (
            <div className="p-6 sm:p-10 space-y-6">
              <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
                <div>
                  <h3 className="text-lg font-bold text-white flex items-center gap-2">
                    <span>⭕</span> ফ্যামিলি ও স্টাডি সার্কেল অ্যাকাউন্টেবিলিটি রিং
                  </h3>
                  <p className="text-xs text-slate-400 mt-1">
                    পরিবারের সদস্য ও দ্বীনি ভাইদের সাথে পারস্পরিক আমল প্রতিযোগিতা ও উৎসাহ
                  </p>
                </div>

                <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-xs font-bold">
                  <span>৪ জন সক্রিয় সদস্য</span>
                </div>
              </div>

              {/* Leaderboard Table / Cards */}
              <div className="space-y-3">
                {leaderboard.map((member, idx) => (
                  <div
                    key={idx}
                    className={`p-4 rounded-2xl border transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-3 ${
                      member.name.includes('(আপনি)')
                        ? 'bg-emerald-950/40 border-emerald-500/50 ring-1 ring-emerald-500/30'
                        : 'bg-slate-900/60 border-slate-800'
                    }`}
                  >
                    <div className="flex items-center gap-3">
                      <div className="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center font-bold text-xs text-slate-300">
                        #{idx + 1}
                      </div>
                      <div>
                        <div className="text-sm font-bold text-white flex items-center gap-2">
                          {member.name}
                          <span className="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-300 border border-amber-500/20">
                            {member.badge}
                          </span>
                        </div>
                        <div className="text-xs text-slate-400">{member.role}</div>
                      </div>
                    </div>

                    <div className="flex items-center gap-6">
                      <div className="text-right">
                        <div className="text-xs text-slate-400">সালাত ধারাবাহিকতা</div>
                        <div className="text-sm font-bold text-emerald-400">{member.score}</div>
                      </div>

                      <div className="flex items-center gap-1.5 bg-amber-500/10 px-3 py-1.5 rounded-xl border border-amber-500/20 text-amber-300 font-bold text-xs sm:text-sm">
                        <span>🔥</span>
                        <span>{member.streak} দিন</span>
                      </div>
                    </div>
                  </div>
                ))}
              </div>

              {/* Family Ring Invite Banner */}
              <div className="bg-gradient-to-r from-emerald-950/60 to-slate-900 border border-emerald-800/40 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                  <h4 className="text-sm font-bold text-white mb-1">
                    আপনার পরিবারের নিজস্ব সার্কেল শুরু করুন
                  </h4>
                  <p className="text-xs text-slate-300">
                    সন্তান ও ভাইবোনদের সাথে ৫ জনের প্রাইভেট রিং তৈরি করুন মাত্র ৳৫০০ আজীবন লাইসেন্সে।
                  </p>
                </div>
                <a
                  href="#pricing"
                  className="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-all shadow-md shadow-emerald-900/30 flex-shrink-0"
                >
                  ফ্যামিলি লাইসেন্স দেখুন →
                </a>
              </div>
            </div>
          )}
        </div>
      </div>
    </section>
  );
}
