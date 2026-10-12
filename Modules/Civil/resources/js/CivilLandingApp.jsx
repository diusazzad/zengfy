import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchCivilData } from './services/civilApi';
import CivilNavbar from './components/CivilNavbar';
import CivilHeroSection from './components/CivilHeroSection';
import InteractivePlotCostSimulator from './components/InteractivePlotCostSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import CivilPillarsSection from './components/CivilPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import CivilFooter from './components/CivilFooter';

export default function CivilLandingApp() {
  const { data: civilData, isLoading, isError } = useQuery({
    queryKey: ['civil-landing-data'],
    queryFn: fetchCivilData,
    staleTime: 1000 * 60 * 15, // 15 mins cache
  });

  const brand = civilData?.brand || {};
  const stats = civilData?.stats || {};
  const simulator = civilData?.simulator || {};
  const journeys = civilData?.stakeholder_journeys || [];
  const pillars = civilData?.architecture_pillars || [];
  const pricing = civilData?.commercial_offers || [];

  return (
    <div className="min-h-screen bg-[#FAFAFA] text-slate-900 font-sans selection:bg-cyan-600 selection:text-white relative overflow-hidden">
      {/* Background Ambient Glow Orbs (Blueprint Cyan #0891B2 & Steel Slate #1E293B) */}
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[550px] bg-gradient-to-tr from-cyan-600/15 via-slate-800/10 to-transparent rounded-full blur-3xl opacity-75"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[950px] -right-40 w-[600px] h-[600px] bg-gradient-to-br from-cyan-500/10 via-slate-900/10 to-transparent rounded-full blur-3xl opacity-60"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[2100px] -left-40 w-[650px] h-[650px] bg-gradient-to-tr from-cyan-600/10 via-slate-800/10 to-transparent rounded-full blur-3xl opacity-50"
      />

      {/* Skip to Main Content Link for WCAG Accessibility */}
      <a 
        href="#main-content" 
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-cyan-700 focus:text-white focus:rounded-lg focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-cyan-400"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to main content)
      </a>

      {/* Top Navbar */}
      <CivilNavbar brand={brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" tabIndex="-1" className="relative outline-none">
        {/* Hero Section */}
        <CivilHeroSection brand={brand} stats={stats} />

        {/* Live Interactive 3D Plot & Costing Simulator */}
        <InteractivePlotCostSimulator simulator={simulator} />

        {/* 4 Stakeholder Journeys (Architect, Site Engineer, Firm Owner, Landowner) */}
        <RoleJourneyTabs journeys={journeys} />

        {/* 4 Structural Architecture Pillars */}
        <CivilPillarsSection pillars={pillars} />

        {/* 3-Tier SaaS Commercial Packages (Strictly Cloud Subscription) */}
        <PricingOffersSection offers={pricing} />
      </main>

      {/* Comprehensive WCAG Footer */}
      <CivilFooter brand={brand} />
    </div>
  );
}
