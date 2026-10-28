import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchSocialLandingData, FALLBACK_SOCIAL_DATA } from './services/socialApi';
import SocialNavbar from './components/SocialNavbar';
import SocialHeroSection from './components/SocialHeroSection';
import InteractiveFeedSimulator from './components/InteractiveFeedSimulator';
import EmergencySosRadarSection from './components/EmergencySosRadarSection';
import SocialPillarsSection from './components/SocialPillarsSection';
import SocialFooter from './components/SocialFooter';

export default function SocialLandingApp() {
    const { data = FALLBACK_SOCIAL_DATA } = useQuery({
        queryKey: ['social-landing-data'],
        queryFn: fetchSocialLandingData,
        staleTime: 1000 * 60 * 5, // 5 mins
    });

    const brand = data.brand || {};
    const stats = data.stats || {};
    const sosTelemetry = data.sos_telemetry || {};
    const streams = data.streams || {};
    const features = data.features || [];
    const links = data.links || {};

    const handleNavigateSection = (sectionId) => {
        if (sectionId === 'hero') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else if (sectionId === 'streams') {
            const el = document.getElementById('interactive-streams-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        } else if (sectionId === 'sos') {
            const el = document.getElementById('sos-radar-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        } else if (sectionId === 'pillars') {
            const el = document.getElementById('social-pillars-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }
    };

    return (
        <div className="min-h-screen bg-[#F8FAFC] text-slate-900 selection:bg-blue-600 selection:text-white flex flex-col relative overflow-x-hidden font-sans">
            
            {/* Accessible Skip Link (WCAG 2.1 AA) */}
            <a
                href="#main-content"
                className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-blue-600 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white font-bold text-sm"
            >
                Skip to main content / মূল তথ্যে যান
            </a>

            {/* Ambient Multi-Layer Glow Orbs (Soft Pastels Behind Frosted Glass) */}
            <div className="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
                {/* Soft Sky Blue Orb Top Left */}
                <div className="absolute -top-32 -left-32 w-[650px] h-[650px] rounded-full bg-gradient-to-br from-blue-200/50 via-sky-100/40 to-transparent blur-3xl opacity-80" />
                {/* Soft Indigo / Violet Orb Top Right */}
                <div className="absolute top-10 -right-32 w-[700px] h-[700px] rounded-full bg-gradient-to-bl from-indigo-200/45 via-purple-100/30 to-transparent blur-3xl opacity-80" />
                {/* Soft Emerald Glow Mid-Body */}
                <div className="absolute top-[45%] left-1/2 -translate-x-1/2 w-[850px] h-[550px] rounded-full bg-gradient-to-tr from-emerald-100/30 via-cyan-100/30 to-transparent blur-3xl opacity-70" />
                {/* Subtle Dot Matrix Background */}
                <div className="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:28px_28px] opacity-35" />
            </div>

            {/* Navbar Header */}
            <SocialNavbar
                links={links}
                onNavigateSection={handleNavigateSection}
            />

            {/* Semantic Main Landmark */}
            <main
                id="main-content"
                role="main"
                tabIndex="-1"
                aria-label="Main content"
                className="relative z-10 flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 focus:outline-none"
            >
                {/* 1. Hero Section with Live Telemetry Ribbon */}
                <SocialHeroSection
                    brand={brand}
                    stats={stats}
                    links={links}
                    onExploreStreams={() => handleNavigateSection('streams')}
                />

                {/* 2. Interactive Feed Simulator (4-Channel Switcher + Post Composer + Particles) */}
                <InteractiveFeedSimulator
                    initialStreams={streams}
                    links={links}
                />

                {/* 3. Ward Emergency SOS Radar Section */}
                <EmergencySosRadarSection
                    telemetry={sosTelemetry}
                />

                {/* 4. Sovereign Social Architecture Pillars */}
                <SocialPillarsSection
                    features={features}
                />
            </main>

            {/* Footer Landmark */}
            <SocialFooter links={links} />

        </div>
    );
}
