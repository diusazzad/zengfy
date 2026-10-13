import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchHabitData } from './services/habitApi';
import HabitNavbar from './components/HabitNavbar';
import HabitHeroSection from './components/HabitHeroSection';
import SalahHabitStreakSimulator from './components/SalahHabitStreakSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import HabitPillarsSection from './components/HabitPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import HabitFooter from './components/HabitFooter';

export default function HabitLandingApp() {
  const { data: apiResponse, isLoading, isError } = useQuery({
    queryKey: ['habitLandingData'],
    queryFn: fetchHabitData,
    staleTime: 1000 * 60 * 10,
    retry: 1,
  });

  const landingData = apiResponse?.data || apiResponse || window.__INITIAL_HABIT_DATA__ || {};

  return (
    <div className="min-h-screen bg-[#FAFAF9] text-slate-900 flex flex-col font-sans selection:bg-emerald-600 selection:text-white relative antialiased">
      {/* Skip to Main Content Link for WCAG 2.1 AA Accessibility */}
      <a
        href="#main-content"
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-emerald-700 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white text-xs font-bold"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to Main Content)
      </a>

      {/* Ambient Glow Orbs */}
      <div className="fixed top-0 left-1/4 -translate-x-1/2 w-[35rem] h-[35rem] bg-emerald-300/15 rounded-full blur-[120px] pointer-events-none -z-10" />
      <div className="fixed top-1/3 right-10 w-[30rem] h-[30rem] bg-amber-200/15 rounded-full blur-[140px] pointer-events-none -z-10" />
      <div className="fixed bottom-10 left-1/3 w-[40rem] h-[40rem] bg-emerald-400/10 rounded-full blur-[150px] pointer-events-none -z-10" />

      {/* Navigation Bar */}
      <HabitNavbar brand={landingData.brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" className="flex-1">
        {/* Hero Section */}
        <HabitHeroSection
          brandData={landingData.brand}
          statsData={landingData.stats}
        />

        {/* 5 Daily Prayers & Habit Streak Simulator */}
        <SalahHabitStreakSimulator
          simulatorData={landingData.simulator}
        />

        {/* Stakeholder Perspective Tabs */}
        <RoleJourneyTabs
          journeysData={landingData.journeys}
        />

        {/* 4 Sovereign Pillars */}
        <HabitPillarsSection
          pillarsData={landingData.pillars}
        />

        {/* 3-Tier Commercial Pricing & FAQs */}
        <PricingOffersSection
          pricingData={landingData.pricing}
          faqsData={landingData.faqs}
        />
      </main>

      {/* Footer */}
      <HabitFooter brandData={landingData.brand} />
    </div>
  );
}
