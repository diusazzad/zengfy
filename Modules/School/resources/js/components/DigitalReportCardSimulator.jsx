import React, { useState } from 'react';
import { Calculator, Award, CheckCircle2, RefreshCw, Printer, Sparkles, BookOpen, FileCheck } from 'lucide-react';

function getGradeInfo(marks) {
    const m = Number(marks) || 0;
    if (m >= 80) return { grade: 'A+', point: 5.0, color: 'text-emerald-700 bg-emerald-50 border-emerald-200' };
    if (m >= 70) return { grade: 'A', point: 4.0, color: 'text-teal-700 bg-teal-50 border-teal-200' };
    if (m >= 60) return { grade: 'A-', point: 3.5, color: 'text-blue-700 bg-blue-50 border-blue-200' };
    if (m >= 50) return { grade: 'B', point: 3.0, color: 'text-amber-700 bg-amber-50 border-amber-200' };
    if (m >= 40) return { grade: 'C', point: 2.0, color: 'text-orange-700 bg-orange-50 border-orange-200' };
    if (m >= 33) return { grade: 'D', point: 1.0, color: 'text-yellow-700 bg-yellow-50 border-yellow-200' };
    return { grade: 'F', point: 0.0, color: 'text-rose-700 bg-rose-50 border-rose-200' };
}

export default function DigitalReportCardSimulator({ gradingData = {} }) {
    const [curriculum, setCurriculum] = useState('nctb'); // 'nctb' or 'madrasah'
    const [marks, setMarks] = useState({
        bangla: 84,
        english: 78,
        math: 92,
        science: 88,
    });

    const handleMarkChange = (subject, val) => {
        const num = Math.max(0, Math.min(100, Number(val) || 0));
        setMarks(prev => ({ ...prev, [subject]: num }));
    };

    const subjectsList = curriculum === 'nctb'
        ? [
            { id: 'bangla', name: 'বাংলা (Bangla)' },
            { id: 'english', name: 'ইংরেজি (English)' },
            { id: 'math', name: 'গণিত (Mathematics)' },
            { id: 'science', name: 'বিজ্ঞান (Science)' },
        ]
        : [
            { id: 'bangla', name: 'বাংলা ও সাহিত্য' },
            { id: 'english', name: 'ইংরেজি (English)' },
            { id: 'math', name: 'গণিত (Mathematics)' },
            { id: 'science', name: 'আরবি ও কুরআন মাজীদ' },
        ];

    // Compute grades
    const grades = subjectsList.map(s => {
        const m = marks[s.id] ?? 80;
        const info = getGradeInfo(m);
        return { ...s, marks: m, ...info };
    });

    const hasFailed = grades.some(g => g.point === 0);
    const totalPoints = grades.reduce((acc, curr) => acc + curr.point, 0);
    const avgPoint = hasFailed ? 0.0 : (totalPoints / grades.length);
    const totalMarks = grades.reduce((acc, curr) => acc + curr.marks, 0);

    let overallGrade = 'F';
    let gpaBadgeText = 'অনুত্তীর্ণ (Fail)';
    if (!hasFailed) {
        if (avgPoint >= 5.0) {
            overallGrade = 'A+';
            gpaBadgeText = 'গোল্ডেন জিপিএ ৫.০০ (Golden A+)';
        } else if (avgPoint >= 4.0) {
            overallGrade = 'A';
            gpaBadgeText = 'জিপিএ ' + avgPoint.toFixed(2) + ' (Excellent)';
        } else if (avgPoint >= 3.5) {
            overallGrade = 'A-';
            gpaBadgeText = 'জিপিএ ' + avgPoint.toFixed(2) + ' (Very Good)';
        } else if (avgPoint >= 3.0) {
            overallGrade = 'B';
            gpaBadgeText = 'জিপিএ ' + avgPoint.toFixed(2) + ' (Good)';
        } else {
            overallGrade = 'C';
            gpaBadgeText = 'জিপিএ ' + avgPoint.toFixed(2) + ' (Passed)';
        }
    }

    const resetMarks = () => {
        setMarks({ bangla: 84, english: 78, math: 92, science: 88 });
    };

    return (
        <section id="grading-calculator-section" aria-labelledby="grading-heading" className="py-12 sm:py-16">
            
            {/* Header */}
            <div className="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
                <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-800 text-xs font-bold uppercase tracking-wider mb-3">
                    <Calculator className="w-3.5 h-3.5 text-indigo-600" />
                    <span>এনসিটিবি ও মাদরাসা গ্রেডিং সিমুলেটর</span>
                </div>
                <h2 id="grading-heading" className="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                    নম্বর বসান, সেকেন্ডে তৈরি হবে{' '}
                    <span className="bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-600 bg-clip-text text-transparent">
                        বোর্ড গ্রেডিং রিপোর্ট কার্ড
                    </span>
                </h2>
                <p className="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    নিচের স্লাইডারগুলো ডানে-বামে টেনে নম্বর পরিবর্তন করুন। দেখুন কীভাবে জেনফাই ইঞ্জিন তাৎক্ষণিকভাবে লেটার গ্রেড, গ্রেড পয়েন্ট ও গড় জিপিএ হিসাব করে প্রিন্ট-রেডি কার্ড তৈরি করে।
                </p>

                {/* Curriculum Toggle */}
                <div className="mt-6 inline-flex p-1.5 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
                    <button
                        type="button"
                        onClick={() => setCurriculum('nctb')}
                        className={`px-5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer ${
                            curriculum === 'nctb'
                                ? 'bg-indigo-600 text-white shadow-xs'
                                : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'
                        }`}
                    >
                        📚 সাধারণ স্কুল ও ক্যাডেট কারিকুলাম (NCTB)
                    </button>
                    <button
                        type="button"
                        onClick={() => setCurriculum('madrasah')}
                        className={`px-5 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all cursor-pointer ${
                            curriculum === 'madrasah'
                                ? 'bg-emerald-600 text-white shadow-xs'
                                : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50'
                        }`}
                    >
                        🕌 মাদরাসা শিক্ষা বোর্ড কারিকুলাম
                    </button>
                </div>
            </div>

            {/* Interactive Grid: Sliders on Left, Digital Marksheet on Right */}
            <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start max-w-6xl mx-auto">
                
                {/* Left: Subject Marks Sliders (6 cols) */}
                <div className="lg:col-span-6 p-6 sm:p-8 rounded-3xl bg-white/90 backdrop-blur-2xl border border-slate-200/90 shadow-xl">
                    <div className="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                        <div className="flex items-center gap-2">
                            <Sparkles className="w-4 h-4 text-indigo-600" />
                            <span className="text-sm font-bold text-slate-800">নম্বর স্লাইডার কন্ট্রোল</span>
                        </div>
                        <button
                            type="button"
                            onClick={resetMarks}
                            className="text-xs text-slate-500 hover:text-indigo-600 font-semibold flex items-center gap-1 cursor-pointer transition-colors"
                        >
                            <RefreshCw className="w-3 h-3" />
                            <span>রিসেট</span>
                        </button>
                    </div>

                    <div className="space-y-5">
                        {subjectsList.map(s => {
                            const val = marks[s.id] ?? 80;
                            const info = getGradeInfo(val);
                            return (
                                <div key={s.id} className="p-3.5 rounded-2xl bg-slate-50/70 border border-slate-200/60">
                                    <div className="flex items-center justify-between mb-2">
                                        <label htmlFor={`slider-${s.id}`} className="text-xs font-bold text-slate-800">
                                            {s.name}
                                        </label>
                                        <div className="flex items-center gap-2">
                                            <span className={`px-2 py-0.5 rounded-md text-[11px] font-black border ${info.color}`}>
                                                {info.grade} ({info.point.toFixed(1)})
                                            </span>
                                            <span className="font-mono text-xs font-black text-slate-900 w-8 text-right">
                                                {val}
                                            </span>
                                        </div>
                                    </div>
                                    <input
                                        id={`slider-${s.id}`}
                                        type="range"
                                        min="0"
                                        max="100"
                                        value={val}
                                        onChange={(e) => handleMarkChange(s.id, e.target.value)}
                                        className="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                                    />
                                    <div className="flex justify-between text-[10px] text-slate-400 font-mono mt-1">
                                        <span>০</span>
                                        <span>৩৩ (পাস)</span>
                                        <span>৮০ (A+)</span>
                                        <span>১০০</span>
                                    </div>
                                </div>
                            );
                        })}
                    </div>

                    <div className="mt-5 p-3 rounded-xl bg-indigo-50/70 border border-indigo-200/60 text-center">
                        <span className="text-xs font-bold text-indigo-900">
                            💡 ১০০% স্বয়ংক্রিয়: পরীক্ষার খাতা এন্ট্রি করলেই রেজাল্ট শিট প্রস্তুত হয়ে যায়!
                        </span>
                    </div>
                </div>

                {/* Right: Real-time Digital Marksheet & Certificate Preview (6 cols) */}
                <div className="lg:col-span-6 p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-2xl relative overflow-hidden">
                    
                    {/* Official Marksheet Header */}
                    <div className="text-center pb-4 border-b-2 border-slate-900">
                        <div className="inline-block px-2.5 py-0.5 rounded-full bg-slate-100 text-[10px] font-mono uppercase tracking-widest text-slate-600 mb-1">
                            Official Academic Progress Report
                        </div>
                        <h4 className="text-base sm:text-lg font-black text-slate-900 tracking-tight">
                            মতিঝিল মডেল স্কুল অ্যান্ড কলেজ
                        </h4>
                        <div className="text-xs text-slate-500 font-medium">
                            বার্ষিক মূল্যায়ন পরীক্ষা ২০২৬ | শ্রেণী: ৮ম | শাখা: ক
                        </div>
                    </div>

                    {/* Student Mini Meta */}
                    <div className="my-3 py-2 px-3 rounded-xl bg-slate-50 border border-slate-200/60 flex items-center justify-between text-xs">
                        <div>
                            <span className="text-slate-500">শিক্ষার্থী: </span>
                            <span className="font-bold text-slate-800">সৌম্য আহমেদ</span>
                        </div>
                        <div>
                            <span className="text-slate-500">রোল: </span>
                            <span className="font-bold text-slate-800">১২</span>
                        </div>
                        <div>
                            <span className="text-slate-500">আইডি: </span>
                            <span className="font-mono font-bold text-slate-800">ZG-0812</span>
                        </div>
                    </div>

                    {/* Table of Marks */}
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr className="border-b border-slate-200 text-slate-500 font-bold">
                                    <th className="py-2">বিষয়</th>
                                    <th className="py-2 text-center">প্রাপ্ত নম্বর</th>
                                    <th className="py-2 text-center">লেটার গ্রেড</th>
                                    <th className="py-2 text-right">গ্রেড পয়েন্ট</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-slate-100">
                                {grades.map(g => (
                                    <tr key={g.id} className="hover:bg-slate-50/50">
                                        <td className="py-2 font-semibold text-slate-800">{g.name}</td>
                                        <td className="py-2 text-center font-mono font-bold text-slate-900">{g.marks}</td>
                                        <td className="py-2 text-center">
                                            <span className={`px-2 py-0.5 rounded-md text-[10px] font-black border ${g.color}`}>
                                                {g.grade}
                                            </span>
                                        </td>
                                        <td className="py-2 text-right font-mono font-bold text-slate-800">{g.point.toFixed(2)}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {/* Summary Bar */}
                    <div className="mt-4 pt-4 border-t-2 border-slate-900 flex items-center justify-between">
                        <div>
                            <div className="text-xs text-slate-500 font-semibold">সর্বমোট নম্বর</div>
                            <div className="text-xl font-black text-slate-900 font-mono">
                                {totalMarks} / ৪০০
                            </div>
                        </div>

                        {/* Overall GPA Badge */}
                        <div className="text-right">
                            <div className="text-xs text-slate-500 font-semibold">ফাইনাল ফলাফল</div>
                            <div className={`text-xl sm:text-2xl font-black font-mono ${hasFailed ? 'text-rose-600' : 'text-emerald-700'}`}>
                                GPA {avgPoint.toFixed(2)}
                            </div>
                        </div>
                    </div>

                    {/* Status Pill */}
                    <div className={`mt-4 p-3 rounded-xl text-center text-xs font-black border ${
                        hasFailed
                            ? 'bg-rose-50 text-rose-800 border-rose-200'
                            : 'bg-emerald-50 text-emerald-800 border-emerald-200'
                    }`}>
                        <span>{gpaBadgeText}</span>
                    </div>

                    {/* Print PDF Button */}
                    <div className="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span className="text-[11px] text-slate-400 font-mono">
                            Digital Seal Verified: #ZG-VER-2026
                        </span>
                        <button
                            type="button"
                            onClick={() => window.print()}
                            className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-all cursor-pointer"
                        >
                            <Printer className="w-3.5 h-3.5" />
                            <span>পিডিএফ প্রিন্ট প্রিভিউ</span>
                        </button>
                    </div>

                </div>

            </div>

        </section>
    );
}
