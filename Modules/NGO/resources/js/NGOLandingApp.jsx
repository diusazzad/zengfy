import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchNGOData } from './services/ngoApi';
import NGONavbar from './components/NGONavbar';
import NGOHeroSection from './components/NGOHeroSection';
import LiveDonationZakatSimulator from './components/LiveDonationZakatSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import NGOPillarsSection from './components/NGOPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import NGOFooter from './components/NGOFooter';

export default function NGOLandingApp() {
  const { data: ngoData, isLoading, isError } = useQuery({
    queryKey: ['ngo-landing-data'],
    queryFn: fetchNGOData,
    staleTime: 1000 * 60 * 15, // 15 mins cache
  });

  const brand = ngoData?.brand || {};
  const stats = ngoData?.stats || {};
  const simulator = ngoData?.simulator || {};
  const journeys = ngoData?.stakeholder_journeys || [];
  const pillars = ngoData?.architecture_pillars || [];
  const pricing = ngoData?.commercial_offers || [];

  return (
    <div className="min-h-screen bg-[#FAFAFA] text-slate-900 font-sans selection:bg-teal-600 selection:text-white relative overflow-hidden">
      {/* Background Ambient Glow Orbs (Humanitarian Teal #0D9488 & Hope Coral Rose #F43F5E) */}
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[550px] bg-gradient-to-tr from-teal-600/15 via-rose-500/10 to-transparent rounded-full blur-3xl opacity-75"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[950px] -right-40 w-[600px] h-[600px] bg-gradient-to-br from-rose-500/10 via-teal-800/10 to-transparent rounded-full blur-3xl opacity-60"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[2100px] -left-40 w-[650px] h-[650px] bg-gradient-to-tr from-teal-600/10 via-rose-500/10 to-transparent rounded-full blur-3xl opacity-50"
      />

      {/* Skip to Main Content Link for WCAG Accessibility */}
      <a 
        href="#main-content" 
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-teal-700 focus:text-white focus:rounded-lg focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-rose-400 font-bold"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to main content)
      </a>

      {/* Top Navbar */}
      <NGONavbar brand={brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" tabIndex="-1" className="relative outline-none">
        {/* Hero Section */}
        <NGOHeroSection brand={brand} stats={stats} />

        {/* Live Interactive Crowdfunding & Zakat Simulator */}
        <LiveDonationZakatSimulator simulator={simulator} />

        {/* 4 Stakeholder Journeys (Donor, Trustee, Volunteer, Beneficiary) */}
        <RoleJourneyTabs journeys={journeys} />

        {/* 4 Sovereign Humanitarian Pillars */}
        <NGOPillarsSection pillars={pillars} />

        {/* 3-Tier Commercial Offers (Cloud SaaS, Lifetime Trust, International NGO) */}
        <PricingOffersSection offers={pricing} />
      </main>

      {/* Comprehensive WCAG Footer */}
      <NGOFooter brand={brand} />
    </div>
  );
}
