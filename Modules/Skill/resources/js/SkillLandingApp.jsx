import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { fetchSkillData } from './services/skillApi';
import SkillNavbar from './components/SkillNavbar';
import SkillHeroSection from './components/SkillHeroSection';
import PostSscSkillCareerSimulator from './components/PostSscSkillCareerSimulator';
import RoleJourneyTabs from './components/RoleJourneyTabs';
import SkillPillarsSection from './components/SkillPillarsSection';
import PricingOffersSection from './components/PricingOffersSection';
import SkillFooter from './components/SkillFooter';

export default function SkillLandingApp() {
  const { data: skillData, isLoading, isError } = useQuery({
    queryKey: ['skill-landing-data'],
    queryFn: fetchSkillData,
    staleTime: 1000 * 60 * 15, // 15 mins cache
  });

  const brand = skillData?.brand || {};
  const stats = skillData?.stats || {};
  const simulator = skillData?.simulator || {};
  const journeys = skillData?.journeys || [];
  const pillars = skillData?.pillars || [];
  const pricing = skillData?.pricing || [];
  const faqs = skillData?.faqs || [];

  return (
    <div className="min-h-screen bg-[#FAFAFA] text-slate-900 font-sans selection:bg-blue-600 selection:text-white relative overflow-hidden">
      {/* Background Ambient Glow Orbs (Electric Cobalt Blue #2563EB & Neon Cyan #06B6D4) */}
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[850px] h-[550px] bg-gradient-to-tr from-blue-600/15 via-cyan-500/10 to-transparent rounded-full blur-3xl opacity-75"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[950px] -right-40 w-[600px] h-[600px] bg-gradient-to-br from-cyan-500/10 via-blue-700/10 to-transparent rounded-full blur-3xl opacity-60"
      />
      <div 
        aria-hidden="true" 
        className="pointer-events-none absolute top-[2100px] -left-40 w-[650px] h-[650px] bg-gradient-to-tr from-blue-600/10 via-indigo-500/10 to-transparent rounded-full blur-3xl opacity-50"
      />

      {/* Skip to Main Content Link for WCAG Accessibility */}
      <a 
        href="#main-content" 
        className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-blue-600 focus:text-white focus:rounded-lg focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-cyan-300 font-bold"
      >
        সরাসরি মূল তথ্যে যান (Skip to main content)
      </a>

      {/* Top Navbar */}
      <SkillNavbar brand={brand} />

      {/* Main Content Area */}
      <main id="main-content" role="main" tabIndex="-1" className="relative outline-none">
        {/* Hero Section */}
        <SkillHeroSection stats={stats} />

        {/* Live Interactive Post-SSC Career Guidance Simulator */}
        <PostSscSkillCareerSimulator simulatorData={simulator} />

        {/* 4 Stakeholder Journeys (Student, Parent, Trainer, Employer) */}
        <RoleJourneyTabs journeys={journeys} />

        {/* 4 Sovereign Learning Pillars */}
        <SkillPillarsSection pillars={pillars} />

        {/* 3-Tier Commercial Offers + FAQ Accordion */}
        <PricingOffersSection pricing={pricing} faqs={faqs} />
      </main>

      {/* Comprehensive WCAG Footer */}
      <SkillFooter />
    </div>
  );
}
