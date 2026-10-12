import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchSchoolLandingData, FALLBACK_SCHOOL_DATA } from './services/schoolApi';
import SchoolNavbar from './components/SchoolNavbar';
import SchoolHeroSection from './components/SchoolHeroSection';
import InteractiveRfidSimulator from './components/InteractiveRfidSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import DigitalReportCardSimulator from './components/DigitalReportCardSimulator';
import PricingOffersSection from './components/PricingOffersSection';
import SchoolPillarsSection from './components/SchoolPillarsSection';
import SchoolFooter from './components/SchoolFooter';

export default function SchoolLandingApp() {
    const { data = FALLBACK_SCHOOL_DATA } = useQuery({
        queryKey: ['school-landing-data'],
        queryFn: fetchSchoolLandingData,
        staleTime: 1000 * 60 * 5, // 5 mins
    });

    const brand = data.brand || {};
    const stats = data.stats || {};
    const rfidDemo = data.rfid_demo || {};
    const roleJourneys = data.role_journeys || [];
    const gradingDemo = data.grading_demo || {};
    const packages = data.packages || [];
    const features = data.features || [];
    const links = data.links || {};

    const handleNavigateSection = (sectionId) => {
        if (sectionId === 'hero') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else if (sectionId === 'rfid') {
            const el = document.getElementById('rfid-simulator-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        } else if (sectionId === 'roles') {
            const el = document.getElementById('role-journeys-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        } else if (sectionId === 'grading') {
            const el = document.getElementById('grading-calculator-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        } else if (sectionId === 'pricing') {
            const el = document.getElementById('pricing-offers-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        } else if (sectionId === 'pillars') {
            const el = document.getElementById('school-pillars-section');
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }
    };

    return (
        <div className="min-h-screen bg-[#F8FAFC] text-slate-900 selection:bg-emerald-600 selection:text-white flex flex-col relative overflow-x-hidden font-sans">
            
            {/* Accessible Skip Link (WCAG 2.1 AA) */}
            <a
                href="#main-content"
                className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-emerald-600 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white font-bold text-sm"
            >
                Skip to main content / মূল তথ্যে যান
            </a>

            {/* Ambient Multi-Layer Glow Orbs (Soft Emerald & Indigo Behind Frosted Glass) */}
            <div className="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
                {/* Soft Emerald Glow Top Left */}
                <div className="absolute -top-32 -left-32 w-[650px] h-[650px] rounded-full bg-gradient-to-br from-emerald-200/50 via-teal-100/40 to-transparent blur-3xl opacity-80" />
                {/* Soft Indigo / Violet Glow Top Right */}
                <div className="absolute top-10 -right-32 w-[700px] h-[700px] rounded-full bg-gradient-to-bl from-indigo-200/45 via-teal-100/30 to-transparent blur-3xl opacity-80" />
                {/* Soft Mint Glow Mid-Body */}
                <div className="absolute top-[45%] left-1/2 -translate-x-1/2 w-[850px] h-[550px] rounded-full bg-gradient-to-tr from-teal-100/35 via-emerald-100/35 to-transparent blur-3xl opacity-70" />
                {/* Subtle Dot Matrix Background */}
                <div className="absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:28px_28px] opacity-35" />
            </div>

            {/* Navbar Header */}
            <SchoolNavbar
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
                <SchoolHeroSection
                    brand={brand}
                    stats={stats}
                    links={links}
                    onExploreRfid={() => handleNavigateSection('rfid')}
                    onExplorePricing={() => handleNavigateSection('pricing')}
                />

                {/* 2. Interactive RFID Attendance Kiosk + Simulated Guardian SMS */}
                <InteractiveRfidSimulator
                    demoData={rfidDemo}
                />

                {/* 3. Role Journeys: Parents, Teachers, Principals, Students */}
                <RoleJourneyTabs
                    journeys={roleJourneys}
                />

                {/* 4. Digital Report Card Simulator (NCTB / Madrasah GPA 5.00 Calculator) */}
                <DigitalReportCardSimulator
                    gradingData={gradingDemo}
                />

                {/* 5. 3-Tier Bangladesh Commercial Offers (৳2,000/mo SaaS, One-Time Self-Hosted, Custom Enterprise) */}
                <PricingOffersSection
                    packages={packages}
                    links={links}
                />

                {/* 6. Sovereign Academic Architecture Pillars */}
                <SchoolPillarsSection
                    features={features}
                />
            </main>

            {/* Footer Landmark */}
            <SchoolFooter links={links} />

        </div>
    );
}
