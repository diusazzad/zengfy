import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchLawData } from './services/lawApi';
import LawNavbar from './components/LawNavbar';
import LawHeroSection from './components/LawHeroSection';
import InteractiveCauseListSimulator from './components/InteractiveCauseListSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import LawPillarsSection from './components/LawPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import LawFooter from './components/LawFooter';

export default function LawLandingApp() {
  const { data: lawData, isLoading, isError } = useQuery({
    queryKey: ['law-landing-data'],
    queryFn: fetchLawData,
    staleTime: 1000 * 60 * 15, // 15 mins cache
  });

  const brand = lawData?.brand || {};
  const stats = lawData?.stats || {};
  const simulator = lawData?.simulator || {};
  const journeys = lawData?.stakeholder_journeys || [];
  const pillars = lawData?.architecture_pillars || [];
  const pricing = lawData?.commercial_offers || [];
  const ecosystem = lawData?.ecosystem_directory || [];

  return (
    <div className="min-h-screen bg-[#FAFAF9] text-slate-900 font-sans selection:bg-rose-900 selection:text-white relative overflow-hidden">
      {/* Background Ambient Glow Orbs (Royal Heritage Burgundy #881337 & Antique Court Gold #D97706) */}
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[550px] bg-gradient-to-tr from-rose-900/15 via-amber-600/10 to-transparent rounded-full blur-3xl opacity-75"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[900px] -right-40 w-[600px] h-[600px] bg-gradient-to-br from-amber-500/10 via-rose-950/10 to-transparent rounded-full blur-3xl opacity-60"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[2100px] -left-40 w-[650px] h-[650px] bg-gradient-to-tr from-rose-900/10 via-amber-700/10 to-transparent rounded-full blur-3xl opacity-50"
      />

      {/* Skip to Main Content Link for WCAG Accessibility */}
      <a 
        href="#main-content" 
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-rose-950 focus:text-white focus:rounded-lg focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-amber-400"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to main content)
      </a>

      {/* Top Navbar */}
      <LawNavbar brand={brand} ecosystem={ecosystem} />

      {/* Main Content Area */}
      <main id="main-content" role="main" tabIndex="-1" className="relative outline-none">
        {/* Hero Section */}
        <LawHeroSection brand={brand} stats={stats} />

        {/* Live Interactive Cause List & Drafting Simulator */}
        <InteractiveCauseListSimulator simulator={simulator} />

        {/* 4 Stakeholder Journeys (Senior, Junior, Muhuri, Client) */}
        <RoleJourneyTabs journeys={journeys} />

        {/* 4 Legal Architecture Pillars */}
        <LawPillarsSection pillars={pillars} />

        {/* 3-Tier Commercial Packages (Chamber Cloud, Self-Hosted, Corporate) */}
        <PricingOffersSection offers={pricing} />
      </main>

      {/* Comprehensive WCAG Footer */}
      <LawFooter brand={brand} ecosystem={ecosystem} />
    </div>
  );
}
