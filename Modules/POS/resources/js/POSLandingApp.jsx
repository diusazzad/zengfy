import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchPOSData, FALLBACK_POS_DATA } from './services/posApi';
import POSNavbar from './components/POSNavbar';
import POSHeroSection from './components/POSHeroSection';
import InteractiveBarcodeSimulator from './components/InteractiveBarcodeSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import POSPillarsSection from './components/POSPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import POSFooter from './components/POSFooter';

export default function POSLandingApp() {
    const { data = FALLBACK_POS_DATA } = useQuery({
        queryKey: ['pos-landing-data'],
        queryFn: fetchPOSData,
        staleTime: 1000 * 60 * 5, // 5 mins
    });

    const brand = data.brand || {};
    const stats = data.stats || {};
    const simulator = data.simulator || {};
    const stakeholders = data.stakeholders || [];
    const pillars = data.pillars || [];
    const pricing = data.pricing || [];
    const faq = data.faq || [];
    const links = data.links || {};

    const handleScrollToSimulator = () => {
        const el = document.getElementById('simulator-section');
        if (el) el.scrollIntoView({ behavior: 'smooth' });
    };

    return (
        <div className="min-h-screen bg-[#F8FAFC] text-slate-900 selection:bg-amber-600 selection:text-white flex flex-col relative overflow-x-hidden font-sans">
            
            {/* Accessible Skip Link for Keyboard / Screen Reader Navigation */}
            <a
                href="#main-content"
                className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-amber-600 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white font-bold text-sm"
            >
                Skip to main content / মূল তথ্যে যান
            </a>

            {/* Ambient Multi-Layer Glow Orbs (Soft Amber, Orange & Rose) */}
            <div className="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
                <div className="absolute -top-32 -left-32 w-[650px] h-[650px] rounded-full bg-gradient-to-br from-amber-200/40 via-orange-100/30 to-transparent blur-3xl opacity-80" />
                <div className="absolute top-10 -right-32 w-[700px] h-[700px] rounded-full bg-gradient-to-bl from-rose-200/40 via-orange-100/20 to-transparent blur-3xl opacity-80" />
                <div className="absolute top-[45%] left-1/2 -translate-x-1/2 w-[850px] h-[550px] rounded-full bg-gradient-to-tr from-amber-100/30 via-orange-100/30 to-transparent blur-3xl opacity-70" />
                <div className="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:28px_28px] opacity-35" />
            </div>

            {/* Header */}
            <POSNavbar links={links} />

            {/* Semantic Main Landmark */}
            <main id="main-content" role="main" className="flex-1 relative z-10">
                <POSHeroSection
                    brand={brand}
                    stats={stats}
                    links={links}
                    onTrySimulator={handleScrollToSimulator}
                />

                <InteractiveBarcodeSimulator
                    simulatorData={simulator}
                />

                <RoleJourneyTabs
                    stakeholders={stakeholders}
                />

                <POSPillarsSection
                    pillars={pillars}
                />

                <PricingOffersSection
                    pricing={pricing}
                    faq={faq}
                    links={links}
                />
            </main>

            {/* Footer */}
            <POSFooter links={links} />

        </div>
    );
}