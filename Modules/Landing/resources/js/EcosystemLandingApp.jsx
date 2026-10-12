import React, { useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchEcosystemData, FALLBACK_ECOSYSTEM_DATA } from './services/ecosystemApi';
import Navbar from './components/Navbar';
import HeroSection from './components/HeroSection';
import ProductsSection from './components/ProductsSection';
import SecuritySection from './components/SecuritySection';
import Footer from './components/Footer';

export default function EcosystemLandingApp() {
    const { data = FALLBACK_ECOSYSTEM_DATA, isLoading } = useQuery({
        queryKey: ['ecosystem-landing-data'],
        queryFn: fetchEcosystemData,
        staleTime: 1000 * 60 * 5, // 5 mins
    });

    const ecosystem = data.ecosystem || {};
    const stats = data.stats || {};
    const modules = data.modules || [];
    const features = data.features || [];
    const links = data.links || {};

    const handleNavigateSection = (sectionId) => {
        if (sectionId === 'hero') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else if (sectionId === 'modules') {
            const el = document.getElementById('modules-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        } else if (sectionId === 'security') {
            const el = document.getElementById('security-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }
    };

    return (
        <div className="min-h-screen bg-[#F8FAFC] text-slate-900 selection:bg-blue-600 selection:text-white flex flex-col relative overflow-x-hidden font-sans">
            
            {/* Accessible Skip Link for Keyboard / Screen Reader Navigation */}
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
                {/* Soft Cyan Glow Mid-Body */}
                <div className="absolute top-[40%] left-1/2 -translate-x-1/2 w-[850px] h-[550px] rounded-full bg-gradient-to-tr from-amber-100/30 via-cyan-100/30 to-transparent blur-3xl opacity-70" />
                {/* Very Subtle Vector Mesh Grid */}
                <div className="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:28px_28px] opacity-35" />
            </div>

            {/* Header Landmark */}
            <Navbar
                links={links}
                modules={modules}
                onNavigateSection={handleNavigateSection}
            />

            {/* Semantic Main Landmark (Screen Reader & A11y Compliant) */}
            <main
                id="main-content"
                role="main"
                tabIndex="-1"
                aria-label="Main content"
                className="relative z-10 flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 focus:outline-none"
            >
                {/* 1. Hero Section (Signal-Style "Speak Freely" & Interactive Social Chat Preview) */}
                <HeroSection
                    ecosystem={ecosystem}
                    links={links}
                    onExploreApps={() => handleNavigateSection('modules')}
                />

                {/* 2. Products Section (One Unified Account + Stats + 13 Micro-SaaS Cards, Zero Pricing) */}
                <ProductsSection
                    modules={modules}
                    stats={stats}
                />

                {/* 3. Security & Infrastructure Pillars Section */}
                <SecuritySection
                    features={features}
                />
            </main>

            {/* Footer Landmark */}
            <Footer links={links} />

        </div>
    );
}