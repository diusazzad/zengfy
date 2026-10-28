import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchHotelData } from './services/hotelApi';
import HotelNavbar from './components/HotelNavbar';
import HotelHeroSection from './components/HotelHeroSection';
import KitchenBazarBookingSimulator from './components/KitchenBazarBookingSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import HotelPillarsSection from './components/HotelPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import HotelFooter from './components/HotelFooter';

export default function HotelLandingApp() {
  const { data: hotelData, isLoading, isError } = useQuery({
    queryKey: ['hotel-landing-data'],
    queryFn: fetchHotelData,
    staleTime: 1000 * 60 * 15, // 15 mins cache
  });

  const brand = hotelData?.brand || {};
  const stats = hotelData?.stats || {};
  const simulator = hotelData?.simulator || {};
  const journeys = hotelData?.stakeholder_journeys || [];
  const pillars = hotelData?.architecture_pillars || [];
  const pricing = hotelData?.commercial_offers || [];

  return (
    <div className="min-h-screen bg-[#FAFAFA] text-slate-900 font-sans selection:bg-amber-600 selection:text-white relative overflow-hidden">
      {/* Background Ambient Glow Orbs (Hyperlocal Indigo #4338CA & GPS Emerald #10B981) */}
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[550px] bg-gradient-to-tr from-amber-600/15 via-slate-900/10 to-transparent rounded-full blur-3xl opacity-75"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[950px] -right-40 w-[600px] h-[600px] bg-gradient-to-br from-slate-900/10 via-amber-900/10 to-transparent rounded-full blur-3xl opacity-60"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[2100px] -left-40 w-[650px] h-[650px] bg-gradient-to-tr from-amber-600/10 via-amber-700/10 to-transparent rounded-full blur-3xl opacity-50"
      />

      {/* Skip to Main Content Link for WCAG Accessibility */}
      <a 
        href="#main-content" 
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-amber-800 focus:text-white focus:rounded-lg focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-emerald-400 font-bold"
      >
        সরাসরি মূল কন্টেন্টে যান (Skip to main content)
      </a>

      {/* Top Navbar */}
      <HotelNavbar brand={brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" tabIndex="-1" className="relative outline-none">
        {/* Hero Section */}
        <HotelHeroSection brand={brand} stats={stats} />

        {/* Live Interactive Radius Rental Mesh Simulator */}
        <KitchenBazarBookingSimulator simulator={simulator} />

        {/* 4 Stakeholder Journeys (Corporate Families, Students/Bachelors, Landlords, Caretakers) */}
        <RoleJourneyTabs journeys={journeys} />

        {/* 4 Sovereign Real Estate Pillars */}
        <HotelPillarsSection pillars={pillars} />

        {/* 3-Tier Commercial Offers (Tenant Micro-Unlock, Landlord Listing, Landlord Cloud ERP) */}
        <PricingOffersSection offers={pricing} faq={hotelData?.faq || []} />
      </main>

      {/* Comprehensive WCAG Footer */}
      <HotelFooter brand={brand} />
    </div>
  );
}
