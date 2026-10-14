import React from 'react';

export default function NGOFooter({ brand = {} }) {
  return (
    <footer className="relative border-t border-slate-200/80 bg-white/70 backdrop-blur-xl mt-24 text-slate-700">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">
          {/* Brand Info */}
          <div className="lg:col-span-2 space-y-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-600 via-teal-700 to-rose-600 flex items-center justify-center text-white shadow-md">
                <span className="text-xl">🤝</span>
              </div>
              <div>
                <span className="text-xl font-black tracking-tight text-slate-900">
                  Zengfy <span className="text-teal-600">NGO</span>
                </span>
                <span className="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-teal-50 text-teal-800 border border-teal-200/60">
                  Zakat & Trust
                </span>
              </div>
            </div>

            <p className="text-sm text-slate-600 leading-relaxed max-w-sm">
              বাংলাদেশের চ্যারিটি ট্রাস্ট, এতিমখানা ও মানবিক সংস্থার জন্য সার্বভৌম ক্রাউডফান্ডিং ও শরীয়াহ যাকাত ইঞ্জিন।
            </p>

            {/* Compliance Badge */}
            <div className="pt-2 flex items-center gap-2.5 text-xs text-slate-500">
              <span className="inline-flex items-center justify-center w-5 h-5 rounded-full bg-teal-100 text-teal-800 font-bold">
                ✓
              </span>
              <span>শরীয়াহ যাকাত বোর্ড ও এনবিআর আয়কর আইন ২০২৩ কমপ্লায়েন্ট</span>
            </div>

            {/* Language Switcher */}
            <div className="pt-2 flex items-center gap-2 text-xs">
              <span className="text-slate-400">ভাষা / Language:</span>
              <span className="px-2.5 py-1 rounded-md bg-teal-50 text-teal-900 font-bold border border-teal-200 cursor-default">
                🇧🇩 বাংলা
              </span>
              <button
                type="button"
                onClick={() => alert('English interface version is active in settings.')}
                className="px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 hover:text-slate-900 hover:bg-slate-200 border border-slate-200 transition-colors"
              >
                🇬🇧 English
              </button>
            </div>
          </div>

          {/* Quick Humanitarian Links */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              মানবিক মডিউল
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-teal-600 transition-colors">
                  লাইভ ক্রাউডফান্ডিং ক্যাম্পেইন
                </a>
              </li>
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-teal-600 transition-colors">
                  শরীয়াহ যাকাত ভল্ট ও ক্যালকুলেটর
                </a>
              </li>
              <li>
                <a href="#simulator" className="text-slate-600 hover:text-teal-600 transition-colors">
                  ডিজিটাল ট্যাক্স মানি রিসিট (QR)
                </a>
              </li>
              <li>
                <a href="#pillars" className="text-slate-600 hover:text-teal-600 transition-colors">
                  ট্যাম্পার-প্রুফ পাবলিক লেজার
                </a>
              </li>
              <li>
                <a href="#pillars" className="text-slate-600 hover:text-teal-600 transition-colors">
                  জিপিএস জিও-ট্যাগড রিলিফ ট্র্যাকার
                </a>
              </li>
            </ul>
          </div>

          {/* Trust Standards */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              স্বচ্ছতা ও শরীয়াহ মান
            </h4>
            <ul className="space-y-2.5 text-sm text-slate-600">
              <li>কুরআনিক ৮টি যাকাত খাত নিয়মাবলী</li>
              <li>এনবিআর আয়কর রেয়াত ধারা ৭৬</li>
              <li>জিরো থার্ড-পার্টি কমিশন নীতি</li>
              <li>সরাসরি ট্রাস্ট ব্যাংক একাউন্ট ডিপোজিট</li>
              <li>অফলাইন ভলান্টিয়ার কিউআর ভেরিফিকেশন</li>
              <li>২৫৬-বিট ডোনার প্রাইভেসি ভল্ট</li>
            </ul>
          </div>

          {/* Sovereign Ecosystem Directory */}
          <div>
            <h4 className="text-xs font-bold text-slate-900 uppercase tracking-wider mb-4">
              Zengfy ইকোসিস্টেম
            </h4>
            <ul className="space-y-2.5 text-sm">
              <li>
                <a href="http://zengfy.top:8000" className="text-slate-600 hover:text-teal-600 transition-colors flex items-center justify-between">
                  <span>মাস্টার ইকোসিস্টেম</span>
                  <span className="text-[10px] bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded font-mono">Hub</span>
                </a>
              </li>
              <li>
                <a href="http://social.zengfy.top:8000" className="text-slate-600 hover:text-teal-600 transition-colors flex items-center justify-between">
                  <span>Zengfy Social</span>
                  <span className="text-[10px] bg-sky-100 text-sky-700 px-1.5 py-0.5 rounded font-mono">NID</span>
                </a>
              </li>
              <li>
                <a href="http://school.zengfy.top:8000" className="text-slate-600 hover:text-teal-600 transition-colors flex items-center justify-between">
                  <span>Zengfy School</span>
                  <span className="text-[10px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded font-mono">Edu</span>
                </a>
              </li>
              <li>
                <a href="http://pos.zengfy.top:8000" className="text-slate-600 hover:text-teal-600 transition-colors flex items-center justify-between">
                  <span>Zengfy POS</span>
                  <span className="text-[10px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-mono">Retail</span>
                </a>
              </li>
              <li>
                <a href="http://law.zengfy.top:8000" className="text-slate-600 hover:text-teal-600 transition-colors flex items-center justify-between">
                  <span>Zengfy Law</span>
                  <span className="text-[10px] bg-rose-100 text-rose-800 px-1.5 py-0.5 rounded font-mono">Legal</span>
                </a>
              </li>
              <li>
                <a href="http://civil.zengfy.top:8000" className="text-slate-600 hover:text-teal-600 transition-colors flex items-center justify-between">
                  <span>Zengfy Civil</span>
                  <span className="text-[10px] bg-cyan-100 text-cyan-800 px-1.5 py-0.5 rounded font-mono">3D</span>
                </a>
              </li>
              <li>
                <a href="http://ngo.zengfy.top:8000" className="text-teal-900 font-bold flex items-center justify-between">
                  <span>Zengfy NGO</span>
                  <span className="text-[10px] bg-teal-100 text-teal-800 px-1.5 py-0.5 rounded font-bold font-mono">Live</span>
                </a>
              </li>
            </ul>
          </div>
        </div>

        {/* Bottom Copyright */}
        <div className="pt-8 border-t border-slate-200/60 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
          <p>
            © {new Date().getFullYear()} Zengfy NGO — Sovereign Crowdfunding & Zakat Trust Platform. All rights reserved.
          </p>
          <div className="flex items-center gap-6">
            <span className="flex items-center gap-1.5">
              <span className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
              অডিট ও গেটওয়ে সার্ভার সিঙ্ক: সক্রিয়
            </span>
            <a href="http://ngo.zengfy.top:8000/login" className="hover:text-teal-600 font-semibold">
              ট্রাস্টি লগইন (SSO)
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
