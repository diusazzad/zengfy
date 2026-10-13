import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchJournalLandingData } from './services/journalApi';
import JournalNavbar from './components/JournalNavbar';
import JournalHeroSection from './components/JournalHeroSection';
import UncensoredOpEdPaywallSimulator from './components/UncensoredOpEdPaywallSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import JournalPillarsSection from './components/JournalPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import JournalFooter from './components/JournalFooter';

export default function JournalLandingApp() {
  const { data: apiResponse, isLoading, isError } = useQuery({
    queryKey: ['journalLandingData'],
    queryFn: fetchJournalLandingData,
    staleTime: 1000 * 60 * 10,
    retry: 1
  });

  const landingData = apiResponse?.data || window.__INITIAL_JOURNAL_DATA__ || {};

  return (
    <div className="min-h-screen bg-slate-950 text-slate-100 flex flex-col font-sans selection:bg-rose-600 selection:text-white relative antialiased">
      {/* Skip to Main Content Link for WCAG 2.1 AA Accessibility */}
      <a
        href="#main-content"
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-rose-700 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white text-xs font-bold"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to Main Content)
      </a>

      {/* Ambient Glow Orbs */}
      <div className="fixed top-0 left-1/4 -translate-x-1/2 w-[35rem] h-[35rem] bg-rose-900/15 rounded-full blur-[120px] pointer-events-none -z-10" />
      <div className="fixed top-1/3 right-10 w-[30rem] h-[30rem] bg-slate-800/20 rounded-full blur-[140px] pointer-events-none -z-10" />
      <div className="fixed bottom-10 left-1/3 w-[40rem] h-[40rem] bg-rose-950/10 rounded-full blur-[150px] pointer-events-none -z-10" />

      {/* Navigation Bar */}
      <JournalNavbar brandData={landingData.brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" className="flex-1">
        {/* Hero Section */}
        <JournalHeroSection
          brandData={landingData.brand}
          statsData={landingData.stats}
        />

        {/* Uncensored Op-Ed Paywall Simulator */}
        <UncensoredOpEdPaywallSimulator
          simulatorData={landingData.simulator}
        />

        {/* Stakeholder Journey Tabs */}
        <RoleJourneyTabs
          journeysData={landingData.journeys}
        />

        {/* 4 Sovereign Journalistic Pillars */}
        <JournalPillarsSection
          pillarsData={landingData.pillars}
        />

        {/* 3-Tier Commercial Pricing & FAQs */}
        <PricingOffersSection
          pricingData={landingData.pricing}
          faqsData={landingData.faqs}
        />
      </main>

      {/* Footer */}
      <JournalFooter brandData={landingData.brand} />
    </div>
  );
}
