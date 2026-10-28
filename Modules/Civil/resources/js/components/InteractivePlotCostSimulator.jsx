import React, { useState, useId } from 'react';

export default function InteractivePlotCostSimulator({ simulator = {} }) {
  const plots = simulator.sample_plots || [];
  const presets = simulator.design_presets || [];
  const rates = simulator.material_rates || {
    steel_per_ton: 95000,
    cement_per_bag: 540,
    brick_per_piece: 14,
    sand_per_cft: 48,
    labor_rate_sqft: 320,
    currency: 'BDT',
  };

  const [selectedPlotId, setSelectedPlotId] = useState(plots[0]?.id || 'plot_3katha');
  const [selectedPresetId, setSelectedPresetId] = useState(presets[0]?.id || 'duplex_villa');
  const [viewAngle, setViewAngle] = useState('isometric'); // 'isometric' | 'elevation' | 'floorplan'
  const [activeFloorLayer, setActiveFloorLayer] = useState('all');
  const [rateAdjust, setRateAdjust] = useState({
    steel: rates.steel_per_ton,
    cement: rates.cement_per_bag,
    brick: rates.brick_per_piece,
    sand: rates.sand_per_cft,
  });
  const [copiedLink, setCopiedLink] = useState(false);
  const [showQuotationModal, setShowQuotationModal] = useState(false);

  // Accessible unique IDs for form controls
  const steelRateId = useId();
  const cementRateId = useId();

  const currentPlot = plots.find((p) => p.id === selectedPlotId) || plots[0] || {};
  const currentPreset = presets.find((p) => p.id === selectedPresetId) || presets[0] || {};

  // Scaling factor based on plot size
  const plotMultiplier = (currentPlot.katha || 3) / 3;

  // Material quantities calculated dynamically
  const steelTon = Number((currentPreset.steel_ton * (selectedPlotId === 'plot_10katha' ? 1.4 : plotMultiplier)).toFixed(1));
  const cementBags = Math.round(currentPreset.cement_bags * (selectedPlotId === 'plot_10katha' ? 1.35 : plotMultiplier));
  const bricksCount = Math.round(currentPreset.bricks_count * (selectedPlotId === 'plot_10katha' ? 1.3 : plotMultiplier));
  const sandCft = Math.round(currentPreset.sand_cft * (selectedPlotId === 'plot_10katha' ? 1.35 : plotMultiplier));
  const effectiveSqft = Math.round(currentPreset.total_sqft * (selectedPlotId === 'plot_10katha' ? 1.35 : (plotMultiplier > 1 ? 1.2 : 1)));

  // Costs
  const steelCost = steelTon * rateAdjust.steel;
  const cementCost = cementBags * rateAdjust.cement;
  const brickCost = bricksCount * rateAdjust.brick;
  const sandCost = sandCft * rateAdjust.sand;
  const rawMaterialTotal = steelCost + cementCost + brickCost + sandCost;
  const laborCost = effectiveSqft * rates.labor_rate_sqft;
  const finishingCost = (rawMaterialTotal + laborCost) * (currentPreset.finish_cost_ratio || 0.45);
  const totalProjectCost = Math.round(rawMaterialTotal + laborCost + finishingCost);

  const formatBDT = (num) => {
    return new Intl.NumberFormat('en-IN', { maximumFractionDigits: 0 }).format(num);
  };

  const formatCroreLakh = (num) => {
    if (num >= 10000000) {
      return (num / 10000000).toFixed(2) + ' কোটি টাকা';
    }
    return (num / 100000).toFixed(2) + ' লাখ টাকা';
  };

  const handleCopyPresentation = () => {
    setCopiedLink(true);
    setTimeout(() => setCopiedLink(false), 2500);
  };

  return (
    <section id="simulator" className="py-20 relative bg-white/60 border-y border-slate-200/80 scroll-mt-20">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {/* Section Header */}
        <div className="text-center max-w-3xl mx-auto mb-14">
          <div className="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-cyan-50 text-cyan-800 border border-cyan-200/60 mb-3">
            <span>📐 লাইভ ইন্টারেক্টিভ সিমুলেটর</span>
          </div>
          <h2 className="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
            ৩ডি প্লট ভিজ্যুয়ালাইজার ও ম্যাটেরিয়াল কস্টিং ক্যালকুলেটর
          </h2>
          <p className="text-sm sm:text-base text-slate-600 mt-2">
            জমির মাপ ও ডিজাইন প্রিসেট পরিবর্তন করে তাৎক্ষণিক ৩ডি আর্কিটেকচারাল এলিভেশন এবং বর্তমান বাজারদর অনুযায়ী রড, সিমেন্ট ও ইট কস্টিং হিসাব দেখুন।
          </p>
        </div>

        {/* Main Grid: Control Panel (Left) + 3D Viewport (Right) */}
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
          {/* LEFT COLUMN: Plot & Preset Controls (5 cols) */}
          <div className="lg:col-span-5 space-y-6">
            {/* 1. Plot Selection */}
            <div className="bg-white/90 backdrop-blur-xl rounded-3xl p-6 border border-slate-200/80 shadow-sm">
              <div className="flex items-center justify-between mb-4">
                <span className="text-xs font-black uppercase tracking-wider text-slate-500">
                  ১. জমির পরিমাপ নির্বাচন করুন (Plot Size)
                </span>
                <span className="text-[11px] font-bold text-cyan-600 bg-cyan-50 px-2 py-0.5 rounded-md">
                  {currentPlot.katha} কাঠা
                </span>
              </div>

              <div className="grid grid-cols-3 gap-2.5">
                {plots.map((plot) => (
                  <button
                    key={plot.id}
                    type="button"
                    onClick={() => setSelectedPlotId(plot.id)}
                    className={`p-3 rounded-2xl text-left border transition-all ${
                      selectedPlotId === plot.id
                        ? 'bg-cyan-600 text-white border-cyan-600 shadow-md shadow-cyan-600/20 font-bold'
                        : 'bg-slate-50/80 text-slate-700 hover:bg-slate-100 border-slate-200/80'
                    }`}
                  >
                    <div className="text-sm font-bold">{plot.katha} কাঠা</div>
                    <div className={`text-[10px] mt-0.5 ${selectedPlotId === plot.id ? 'text-cyan-100' : 'text-slate-500'}`}>
                      {plot.sqft} বর্গফুট
                    </div>
                  </button>
                ))}
              </div>

              {/* Plot Compliance Specs */}
              <div className="mt-4 p-3.5 rounded-2xl bg-slate-50 border border-slate-100 text-xs space-y-1.5">
                <div className="flex justify-between">
                  <span className="text-slate-500">লোকেশন:</span>
                  <span className="font-bold text-slate-800">{currentPlot.location}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-slate-500">রাজউক ফার (FAR) লিমিট:</span>
                  <span className="font-bold text-cyan-700">{currentPlot.far_limit}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-slate-500">অনুমোদনযোগ্য সর্বোচ্চ এরিয়া:</span>
                  <span className="font-bold text-slate-800">{formatBDT(currentPlot.max_built_area)} বর্গফুট</span>
                </div>
                <div className="flex justify-between pt-1 border-t border-slate-200/60">
                  <span className="text-slate-500">সেটব্যাক রুলস:</span>
                  <span className="font-semibold text-slate-700">{currentPlot.setback}</span>
                </div>
              </div>
            </div>

            {/* 2. Building Design Preset Selection */}
            <div className="bg-white/90 backdrop-blur-xl rounded-3xl p-6 border border-slate-200/80 shadow-sm">
              <div className="flex items-center justify-between mb-4">
                <span className="text-xs font-black uppercase tracking-wider text-slate-500">
                  ২. বিল্ডিং টাইপ ও ডিজাইন প্রিসেট
                </span>
                <span className="text-[11px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded-md">
                  {currentPreset.floors} তলা
                </span>
              </div>

              <div className="space-y-3">
                {presets.map((preset) => (
                  <button
                    key={preset.id}
                    type="button"
                    onClick={() => setSelectedPresetId(preset.id)}
                    className={`w-full p-4 rounded-2xl text-left border transition-all flex items-center justify-between ${
                      selectedPresetId === preset.id
                        ? 'bg-slate-900 text-white border-slate-900 shadow-md shadow-slate-900/15'
                        : 'bg-slate-50/80 text-slate-700 hover:bg-slate-100 border-slate-200/80'
                    }`}
                  >
                    <div>
                      <div className="text-sm font-bold">{preset.name}</div>
                      <div className={`text-xs mt-1 flex items-center gap-3 ${selectedPresetId === preset.id ? 'text-slate-300' : 'text-slate-500'}`}>
                        <span>📏 {formatBDT(preset.total_sqft)} বর্গফুট</span>
                        <span>🛏️ {preset.bedrooms} বেড</span>
                        <span>🚗 {preset.parking} পার্কিং</span>
                      </div>
                    </div>
                    <div className={`w-6 h-6 rounded-full flex items-center justify-center border text-xs ${
                      selectedPresetId === preset.id
                        ? 'border-cyan-400 bg-cyan-500 text-white font-bold'
                        : 'border-slate-300 text-transparent'
                    }`}>
                      ✓
                    </div>
                  </button>
                ))}
              </div>
            </div>

            {/* 3. Live Steel & Cement Market Rate Slider Bar */}
            <div className="bg-white/90 backdrop-blur-xl rounded-3xl p-6 border border-slate-200/80 shadow-sm">
              <div className="flex items-center justify-between mb-3">
                <span className="text-xs font-black uppercase tracking-wider text-slate-500">
                  ৩. বর্তমান ঢাকা বাজারদর অ্যাডজাস্টার
                </span>
                <span className="text-[10px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
                  লাইভ মার্কেট রেট
                </span>
              </div>

              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label htmlFor={steelRateId} className="text-[11px] font-semibold text-slate-500 block mb-1">
                    রড (টাকা/টন): ৳{formatBDT(rateAdjust.steel)}
                  </label>
                  <input
                    id={steelRateId}
                    type="range"
                    min="85000"
                    max="115000"
                    step="1000"
                    value={rateAdjust.steel}
                    onChange={(e) => setRateAdjust({ ...rateAdjust, steel: Number(e.target.value) })}
                    className="w-full accent-cyan-600 cursor-pointer"
                  />
                </div>

                <div>
                  <label htmlFor={cementRateId} className="text-[11px] font-semibold text-slate-500 block mb-1">
                    সিমেন্ট (টাকা/ব্যাগ): ৳{rateAdjust.cement}
                  </label>
                  <input
                    id={cementRateId}
                    type="range"
                    min="480"
                    max="650"
                    step="10"
                    value={rateAdjust.cement}
                    onChange={(e) => setRateAdjust({ ...rateAdjust, cement: Number(e.target.value) })}
                    className="w-full accent-cyan-600 cursor-pointer"
                  />
                </div>
              </div>
            </div>
          </div>

          {/* RIGHT COLUMN: 3D Isometric Viewport & Elevation Card (7 cols) */}
          <div className="lg:col-span-7 space-y-6">
            {/* 3D Canvas Mockup Card */}
            <div className="bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 rounded-3xl p-6 border border-slate-800 shadow-2xl text-white relative overflow-hidden">
              {/* Grid Background Effect */}
              <div 
                aria-hidden="true" 
                className="absolute inset-0 opacity-15 bg-[linear-gradient(to_right,#0891b2_1px,transparent_1px),linear-gradient(to_bottom,#0891b2_1px,transparent_1px)] bg-[size:24px_24px]"
              />

              {/* Viewport Header Controls */}
              <div className="relative z-10 flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-slate-800 mb-6">
                <div className="flex items-center gap-2">
                  <span className="w-3 h-3 rounded-full bg-cyan-400 animate-pulse"></span>
                  <span className="text-xs font-bold text-cyan-300">
                    WebGL 3D Isometric Viewport
                  </span>
                  <span className="text-[10px] bg-slate-800 text-slate-400 px-2 py-0.5 rounded-full font-mono">
                    60 FPS
                  </span>
                </div>

                {/* View Angle Switcher */}
                <div className="flex items-center gap-1 bg-slate-800/80 p-1 rounded-xl text-xs font-semibold">
                  <button
                    type="button"
                    onClick={() => setViewAngle('isometric')}
                    className={`px-3 py-1 rounded-lg transition-all ${
                      viewAngle === 'isometric'
                        ? 'bg-cyan-600 text-white shadow-sm'
                        : 'text-slate-400 hover:text-white'
                    }`}
                  >
                    আইসোমেট্রিক ৩ডি
                  </button>
                  <button
                    type="button"
                    onClick={() => setViewAngle('elevation')}
                    className={`px-3 py-1 rounded-lg transition-all ${
                      viewAngle === 'elevation'
                        ? 'bg-cyan-600 text-white shadow-sm'
                        : 'text-slate-400 hover:text-white'
                    }`}
                  >
                    ফ্রন্ট এলিভেশন
                  </button>
                  <button
                    type="button"
                    onClick={() => setViewAngle('floorplan')}
                    className={`px-3 py-1 rounded-lg transition-all ${
                      viewAngle === 'floorplan'
                        ? 'bg-cyan-600 text-white shadow-sm'
                        : 'text-slate-400 hover:text-white'
                    }`}
                  >
                    ফ্লোরপ্ল্যান
                  </button>
                </div>
              </div>

              {/* Interactive Visual Graphic Area */}
              <div className="relative z-10 py-8 min-h-[340px] flex flex-col items-center justify-center">
                {viewAngle === 'isometric' && (
                  <div className="w-full max-w-md space-y-4 text-center">
                    {/* Simulated 3D Isometric Building Block Diagram */}
                    <div className="relative mx-auto w-64 h-56 flex items-center justify-center">
                      {/* Base Plot Slab */}
                      <div className="absolute bottom-2 w-60 h-28 rounded-2xl bg-cyan-900/30 border-2 border-cyan-500/40 transform -rotate-12 skew-x-12 shadow-2xl flex items-center justify-center">
                        <span className="text-[10px] font-mono text-cyan-300">
                          {currentPlot.katha} কাঠা বাউন্ডারি প্লট ({currentPlot.sqft} sqft)
                        </span>
                      </div>

                      {/* Floor Blocks Stacked */}
                      {currentPreset.id === 'duplex_villa' ? (
                        <div className="relative z-10 space-y-1 transform -rotate-6">
                          {/* Rooftop */}
                          <div className="w-40 h-10 rounded-t-xl bg-gradient-to-r from-cyan-600 to-cyan-500 border border-cyan-300/40 shadow-lg flex items-center justify-center text-xs font-bold text-white">
                            রুফটপ টেরাস ও সোলার
                          </div>
                          {/* Level 2 */}
                          <div className="w-44 h-16 rounded-lg bg-slate-800/90 border border-cyan-400/50 shadow-md p-2 flex flex-col justify-center">
                            <span className="text-[11px] font-bold text-cyan-300">২য় তলা: ৩টি মাস্টার বেডরুম + ব্যালকনি</span>
                            <span className="text-[9px] text-slate-400">এটাস্ট বাথ, ড্রেসিং ও ফ্যামিলি লাউঞ্জ</span>
                          </div>
                          {/* Ground Floor */}
                          <div className="w-48 h-20 rounded-b-xl bg-slate-800/95 border border-cyan-400/60 shadow-xl p-2 flex flex-col justify-center">
                            <span className="text-[11px] font-bold text-cyan-300">গ্রাউন্ড ফ্লোর: ড্রয়িং, ডাইনিং ও ২ কার পার্কিং</span>
                            <span className="text-[9px] text-slate-400">মেইন এন্ট্রি পোর্চ ও সার্ভেন্ট কোয়ার্টার</span>
                          </div>
                        </div>
                      ) : (
                        <div className="relative z-10 space-y-1 transform -rotate-6">
                          {/* 7 Storey Stacked Representation */}
                          <div className="w-36 h-6 rounded-t-lg bg-cyan-600 text-[10px] font-bold flex items-center justify-center text-white">
                            ৭ম তলা (পেন্টহাউস)
                          </div>
                          <div className="w-40 h-8 bg-slate-800 border-x border-cyan-500/40 text-[10px] flex items-center justify-center text-slate-300">
                            ৪র্থ - ৬ষ্ঠ তলা (টিপিক্যাল ইউনিট এ ও বি)
                          </div>
                          <div className="w-40 h-8 bg-slate-800 border-x border-cyan-500/40 text-[10px] flex items-center justify-center text-slate-300">
                            ২য় - ৩য় তলা (রেসিডেন্সিয়াল ইউনিট)
                          </div>
                          <div className="w-44 h-12 rounded-b-lg bg-slate-800/95 border border-cyan-500/60 p-1 text-[10px] flex flex-col justify-center items-center text-cyan-300">
                            <span>গ্রাউন্ড ফ্লোর: ৬টি কার পার্কিং + গার্ড রুম</span>
                            <span className="text-[8px] text-slate-400">সাবস্টেশন ও জেনারেটর স্পেস</span>
                          </div>
                        </div>
                      )}
                    </div>

                    <div className="pt-2 text-xs text-slate-400 flex items-center justify-center gap-4">
                      <span>📐 বিল্ট-আপ: <strong className="text-white">{formatBDT(effectiveSqft)} sqft</strong></span>
                      <span>•</span>
                      <span>🏛️ তলা: <strong className="text-cyan-400">{currentPreset.floors} তলা</strong></span>
                      <span>•</span>
                      <span>🚗 পার্কিং: <strong className="text-white">{currentPreset.parking} টি</strong></span>
                    </div>
                  </div>
                )}

                {viewAngle === 'elevation' && (
                  <div className="w-full max-w-sm bg-slate-950/80 rounded-2xl p-5 border border-slate-800 text-left space-y-3 font-mono text-xs">
                    <div className="text-cyan-400 font-bold border-b border-slate-800 pb-2 flex justify-between">
                      <span>FRONT ELEVATION SPEC (2D CAD)</span>
                      <span>SCALE 1:100</span>
                    </div>
                    <div className="space-y-1.5 text-slate-300 text-[11px]">
                      <div className="flex justify-between">
                        <span>মোট বিল্ডিং উচ্চতা:</span>
                        <span className="text-white font-bold">{currentPreset.floors * 10} ফুট (প্যারাপেট সহ)</span>
                      </div>
                      <div className="flex justify-between">
                        <span>রাস্তার প্রস্থ (Road Width):</span>
                        <span className="text-white font-bold">২৫ ফুট আরবান এভিনিউ</span>
                      </div>
                      <div className="flex justify-between">
                        <span>সামনের সেটব্যাক (Front Setback):</span>
                        <span className="text-emerald-400 font-bold">রাজউক অনুমোদিত {currentPlot.setback.split(',')[0]}</span>
                      </div>
                      <div className="flex justify-between">
                        <span>এক্সটেরিয়র ফিনিশিং:</span>
                        <span className="text-white">ওয়েদারকোট + গ্রাফিটো + টেম্পারড গ্লাস</span>
                      </div>
                    </div>
                  </div>
                )}

                {viewAngle === 'floorplan' && (
                  <div className="w-full max-w-md bg-slate-950/80 rounded-2xl p-5 border border-slate-800 text-left space-y-3 font-mono text-xs">
                    <div className="text-cyan-400 font-bold border-b border-slate-800 pb-2 flex justify-between">
                      <span>MASTER ARCHITECTURAL FLOORPLAN</span>
                      <span>RAJUK DWG SYNC</span>
                    </div>
                    <div className="grid grid-cols-2 gap-3 text-[11px] text-slate-300">
                      <div className="p-2.5 rounded-lg bg-slate-900 border border-slate-800">
                        <div className="text-cyan-400 font-bold">মাস্টার বেডরুম ১</div>
                        <div>১৪′ × ১৬′ (ব্যালকনি ও বাথ)</div>
                      </div>
                      <div className="p-2.5 rounded-lg bg-slate-900 border border-slate-800">
                        <div className="text-cyan-400 font-bold">লিভিং ও ড্রয়িং</div>
                        <div>১৮′ × ২২′ (ডাবল হাইট)</div>
                      </div>
                      <div className="p-2.5 rounded-lg bg-slate-900 border border-slate-800">
                        <div className="text-cyan-400 font-bold">ডাইনিং স্পেস</div>
                        <div>১২′ × ১৫′ (ওপেন কিচেন সংলগ্ন)</div>
                      </div>
                      <div className="p-2.5 rounded-lg bg-slate-900 border border-slate-800">
                        <div className="text-cyan-400 font-bold">কিচেন ও প্যান্ট্রি</div>
                        <div>১০′ × ১২′ (সার্ভিস ব্যালকনি)</div>
                      </div>
                    </div>
                  </div>
                )}
              </div>

              {/* Viewport Footer Actions */}
              <div className="relative z-10 pt-4 border-t border-slate-800 flex flex-wrap items-center justify-between gap-3 text-xs">
                <button
                  type="button"
                  onClick={handleCopyPresentation}
                  className="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-cyan-300 font-bold border border-slate-700 transition-all flex items-center gap-1.5"
                >
                  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                  </svg>
                  <span>{copiedLink ? '✓ লিঙ্ক কপি হয়েছে!' : 'ক্লায়েন্ট ৩ডি প্রেজেন্টেশন লিংক'}</span>
                </button>

                <button
                  type="button"
                  onClick={() => setShowQuotationModal(true)}
                  className="px-4 py-2 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white font-bold transition-all flex items-center gap-1.5 shadow-md shadow-cyan-600/30"
                >
                  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  <span>অফিসিয়াল কোটেশন শিট (PDF)</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        {/* BOTTOM SECTION: Real-time Material Costing Breakdown */}
        <div className="mt-12 bg-white/90 backdrop-blur-xl rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md">
          <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
              <h3 className="text-lg sm:text-xl font-black text-slate-900">
                নির্মাণ সামগ্রীর লাইভ বাজারদর ও খরচের বিবরণী (Material BOQ Sheet)
              </h3>
              <p className="text-xs sm:text-sm text-slate-500 mt-1">
                {currentPlot.name} • {currentPreset.name} ({formatBDT(effectiveSqft)} বর্গফুট মোট আয়তন)
              </p>
            </div>

            <div className="sm:text-right">
              <div className="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                সর্বমোট প্রাক্কলিত নির্মাণ বাজেট
              </div>
              <div className="text-2xl sm:text-3xl font-black text-cyan-700 tracking-tight">
                ৳{formatBDT(totalProjectCost)}
              </div>
              <div className="text-xs font-bold text-emerald-600 mt-0.5">
                ≈ {formatCroreLakh(totalProjectCost)}
              </div>
            </div>
          </div>

          {/* 4 Materials Metric Cards */}
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
            {/* 1. Steel */}
            <div className="p-4 rounded-2xl bg-cyan-50/60 border border-cyan-100">
              <div className="flex items-center justify-between text-xs text-slate-600 font-semibold mb-2">
                <span>রড (Steel 60/72 Grade)</span>
                <span className="text-cyan-800 font-bold">{steelTon} টন</span>
              </div>
              <div className="text-lg font-black text-slate-900">
                ৳{formatBDT(steelCost)}
              </div>
              <div className="text-[11px] text-slate-500 mt-1">
                দর: ৳{formatBDT(rateAdjust.steel)} / টন
              </div>
            </div>

            {/* 2. Cement */}
            <div className="p-4 rounded-2xl bg-blue-50/60 border border-blue-100">
              <div className="flex items-center justify-between text-xs text-slate-600 font-semibold mb-2">
                <span>সিমেন্ট (Portland Composite)</span>
                <span className="text-blue-800 font-bold">{formatBDT(cementBags)} ব্যাগ</span>
              </div>
              <div className="text-lg font-black text-slate-900">
                ৳{formatBDT(cementCost)}
              </div>
              <div className="text-[11px] text-slate-500 mt-1">
                দর: ৳{rateAdjust.cement} / ব্যাগ
              </div>
            </div>

            {/* 3. Bricks */}
            <div className="p-4 rounded-2xl bg-amber-50/60 border border-amber-100">
              <div className="flex items-center justify-between text-xs text-slate-600 font-semibold mb-2">
                <span>ইট (Auto Brick / 1st Class)</span>
                <span className="text-amber-800 font-bold">{formatBDT(bricksCount)} পিস</span>
              </div>
              <div className="text-lg font-black text-slate-900">
                ৳{formatBDT(brickCost)}
              </div>
              <div className="text-[11px] text-slate-500 mt-1">
                দর: ৳{rateAdjust.brick} / পিস
              </div>
            </div>

            {/* 4. Sand */}
            <div className="p-4 rounded-2xl bg-slate-100/70 border border-slate-200">
              <div className="flex items-center justify-between text-xs text-slate-600 font-semibold mb-2">
                <span>বালু (Sylhet Sand FM 2.5)</span>
                <span className="text-slate-800 font-bold">{formatBDT(sandCft)} ঘনফুট</span>
              </div>
              <div className="text-lg font-black text-slate-900">
                ৳{formatBDT(sandCost)}
              </div>
              <div className="text-[11px] text-slate-500 mt-1">
                দর: ৳{rateAdjust.sand} / ঘনফুট
              </div>
            </div>
          </div>

          {/* Secondary breakdown: Labor & Finishing */}
          <div className="mt-4 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4 text-xs text-slate-500">
            <div className="flex items-center gap-6">
              <span>
                • লেবার ও ঢালাই ব্যয়: <strong className="text-slate-800">৳{formatBDT(laborCost)}</strong> (৳{rates.labor_rate_sqft}/sqft)
              </span>
              <span>
                • ফিনিশিং ও স্যানিটারি প্রভিশন: <strong className="text-slate-800">৳{formatBDT(finishingCost)}</strong>
              </span>
            </div>

            <div className="text-cyan-800 font-semibold">
              ✓ বাজারদর ও কোয়ান্টিটি সরাসরি এক্সেল/পিডিএফ ফরম্যাটে এক্সপোর্টেবল
            </div>
          </div>
        </div>

        {/* Modal: Simulated Quotation Preview */}
        {showQuotationModal && (
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in duration-150">
            <div className="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 space-y-4">
              <div className="flex items-center justify-between pb-3 border-b border-slate-100">
                <div className="flex items-center gap-2">
                  <span className="text-xl">📄</span>
                  <span className="font-bold text-slate-900">
                    অফিসিয়াল আর্কিটেকচারাল কোটেশন শিট
                  </span>
                </div>
                <button
                  type="button"
                  onClick={() => setShowQuotationModal(false)}
                  className="w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:text-slate-900 flex items-center justify-center"
                >
                  ✕
                </button>
              </div>

              <div className="text-xs text-slate-600 space-y-2 font-mono bg-slate-50 p-4 rounded-2xl border border-slate-200">
                <div className="text-center font-bold text-slate-800 text-sm mb-2">
                  ZENGFY CIVIL ARCHITECTURE HUB
                </div>
                <div className="flex justify-between">
                  <span>প্রজেক্ট নাম:</span>
                  <span className="font-bold">{currentPreset.name}</span>
                </div>
                <div className="flex justify-between">
                  <span>জমির পরিমাপ:</span>
                  <span>{currentPlot.katha} কাঠা ({currentPlot.location})</span>
                </div>
                <div className="flex justify-between">
                  <span>মোট বিল্ট-আপ এরিয়া:</span>
                  <span>{formatBDT(effectiveSqft)} sqft</span>
                </div>
                <div className="flex justify-between border-t border-slate-200 pt-1">
                  <span>রড (Steel):</span>
                  <span>{steelTon} টন (৳{formatBDT(steelCost)})</span>
                </div>
                <div className="flex justify-between">
                  <span>সিমেন্ট (Cement):</span>
                  <span>{cementBags} ব্যাগ (৳{formatBDT(cementCost)})</span>
                </div>
                <div className="flex justify-between">
                  <span>ইট (Bricks):</span>
                  <span>{bricksCount} পিস (৳{formatBDT(brickCost)})</span>
                </div>
                <div className="flex justify-between">
                  <span>বালু (Sand):</span>
                  <span>{sandCft} CFT (৳{formatBDT(sandCost)})</span>
                </div>
                <div className="flex justify-between border-t border-slate-300 pt-1 font-bold text-slate-900">
                  <span>সর্বমোট প্রাক্কলিত বাজেট:</span>
                  <span className="text-cyan-700">৳{formatBDT(totalProjectCost)} ({formatCroreLakh(totalProjectCost)})</span>
                </div>
              </div>

              <div className="flex gap-3 pt-2">
                <button
                  type="button"
                  onClick={() => {
                    alert('কোটেশন শিট সফলভাবে প্রস্তুত হয়েছে। আপনার ডাউনলোড শুরু হচ্ছে...');
                    setShowQuotationModal(false);
                  }}
                  className="flex-1 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-bold text-xs shadow-md transition-all"
                >
                  পিডিএফ ডাউনলোড করুন
                </button>
                <button
                  type="button"
                  onClick={() => setShowQuotationModal(false)}
                  className="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs"
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
