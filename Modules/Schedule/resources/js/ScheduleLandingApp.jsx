import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchScheduleData } from './services/scheduleApi';
import ScheduleNavbar from './components/ScheduleNavbar';
import ScheduleHeroSection from './components/ScheduleHeroSection';
import ConsultationBookingCalendarSimulator from './components/ConsultationBookingCalendarSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import SchedulePillarsSection from './components/SchedulePillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import ScheduleFooter from './components/ScheduleFooter';

export default function ScheduleLandingApp() {
  const { data: apiResponse, isLoading, isError } = useQuery({
    queryKey: ['scheduleLandingData'],
    queryFn: fetchScheduleData,
    staleTime: 1000 * 60 * 10,
    retry: 1,
  });

  const landingData = apiResponse?.data || apiResponse || window.__INITIAL_SCHEDULE_DATA__ || {};

  return (
    <div className="min-h-screen bg-[#FAFAFA] text-slate-900 flex flex-col font-sans selection:bg-indigo-600 selection:text-white relative antialiased">
      {/* Skip to Main Content Link for WCAG 2.1 AA Accessibility */}
      <a
        href="#main-content"
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-indigo-700 focus:text-white focus:rounded-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-white text-xs font-bold"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to Main Content)
      </a>

      {/* Ambient Glow Orbs */}
      <div className="fixed top-0 left-1/4 -translate-x-1/2 w-[35rem] h-[35rem] bg-indigo-300/15 rounded-full blur-[120px] pointer-events-none -z-10" />
      <div className="fixed top-1/3 right-10 w-[30rem] h-[30rem] bg-cyan-200/15 rounded-full blur-[140px] pointer-events-none -z-10" />
      <div className="fixed bottom-10 left-1/3 w-[40rem] h-[40rem] bg-indigo-400/10 rounded-full blur-[150px] pointer-events-none -z-10" />

      {/* Navigation Bar */}
      <ScheduleNavbar brand={landingData.brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" className="flex-1">
        {/* Hero Section */}
        <ScheduleHeroSection
          brandData={landingData.brand}
          statsData={landingData.stats}
        />

        {/* Live Consultation Booking Calendar Sandbox */}
        <ConsultationBookingCalendarSimulator
          simulatorData={landingData.simulator}
        />

        {/* Stakeholder Perspectives */}
        <RoleJourneyTabs
          journeysData={landingData.journeys}
        />

        {/* 4 Sovereign Pillars */}
        <SchedulePillarsSection
          pillarsData={landingData.pillars}
        />

        {/* 3-Tier Commercial Pricing & FAQs */}
        <PricingOffersSection
          pricingData={landingData.pricing}
          faqsData={landingData.faqs}
        />
      </main>

      {/* Footer */}
      <ScheduleFooter brandData={landingData.brand} />
    </div>
  );
}
