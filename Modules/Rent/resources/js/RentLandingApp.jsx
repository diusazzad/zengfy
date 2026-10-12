import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchRentData } from './services/rentApi';
import RentNavbar from './components/RentNavbar';
import RentHeroSection from './components/RentHeroSection';
import RadiusRentalMeshSimulator from './components/RadiusRentalMeshSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import RentPillarsSection from './components/RentPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import RentFooter from './components/RentFooter';

export default function RentLandingApp() {
  const { data: rentData, isLoading, isError } = useQuery({
    queryKey: ['rent-landing-data'],
    queryFn: fetchRentData,
    staleTime: 1000 * 60 * 15, // 15 mins cache
  });

  const brand = rentData?.brand || {};
  const stats = rentData?.stats || {};
  const simulator = rentData?.simulator || {};
  const journeys = rentData?.stakeholder_journeys || [];
  const pillars = rentData?.architecture_pillars || [];
  const pricing = rentData?.commercial_offers || [];

  return (
    <div className="min-h-screen bg-[#FAFAFA] text-slate-900 font-sans selection:bg-indigo-700 selection:text-white relative overflow-hidden">
      {/* Background Ambient Glow Orbs (Hyperlocal Indigo #4338CA & GPS Emerald #10B981) */}
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[550px] bg-gradient-to-tr from-indigo-700/15 via-emerald-500/10 to-transparent rounded-full blur-3xl opacity-75"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[950px] -right-40 w-[600px] h-[600px] bg-gradient-to-br from-emerald-500/10 via-indigo-900/10 to-transparent rounded-full blur-3xl opacity-60"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[2100px] -left-40 w-[650px] h-[650px] bg-gradient-to-tr from-indigo-700/10 via-emerald-600/10 to-transparent rounded-full blur-3xl opacity-50"
      />

      {/* Skip to Main Content Link for WCAG Accessibility */}
      <a 
        href="#main-content" 
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-indigo-800 focus:text-white focus:rounded-lg focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-emerald-400 font-bold"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to main content)
      </a>

      {/* Top Navbar */}
      <RentNavbar brand={brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" tabIndex="-1" className="relative outline-none">
        {/* Hero Section */}
        <RentHeroSection brand={brand} stats={stats} />

        {/* Live Interactive Radius Rental Mesh Simulator */}
        <RadiusRentalMeshSimulator simulator={simulator} />

        {/* 4 Stakeholder Journeys (Corporate Families, Students/Bachelors, Landlords, Caretakers) */}
        <RoleJourneyTabs journeys={journeys} />

        {/* 4 Sovereign Real Estate Pillars */}
        <RentPillarsSection pillars={pillars} />

        {/* 3-Tier Commercial Offers (Tenant Micro-Unlock, Landlord Listing, Landlord Cloud ERP) */}
        <PricingOffersSection offers={pricing} />
      </main>

      {/* Comprehensive WCAG Footer */}
      <RentFooter brand={brand} />
    </div>
  );
}
