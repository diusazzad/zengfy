# 4. UI/UX Design Brief & Design System
## Zengfy Sovereign Ecosystem Master Landing

---

### 1. Design Vision: Premium White Glassmorphism
The design departs completely from dark obsidian themes, embracing an airy, state-of-the-art **White Glassmorphism** system:
- **Light Ambient Canvas:** `#F8FAFC` base background layered with soft pastel ambient glowing blurs (Sky Blue, Indigo, Cyan) and a subtle geometric dot grid.
- **Frosted Glass Panels:** High-definition frosted glass (`bg-white/75 backdrop-blur-2xl border border-white/80 shadow-md`) creating depth and sophistication.
- **Crisp High-Contrast Typography:** Headings in deep slate (`#0F172A`), body text in readable slate (`#475569`), with vibrant brand accents (`#2563EB`).
- **Tactile & Interactive:** Dynamic hover lifts, real-time emoji reaction counters, and an interactive live chat simulator.
- **Zero Pricing Clutter:** The interface focuses strictly on utility, civic security, and product features without disruptive sales pitches.

---

### 2. Design Tokens & Color Palette

#### Canvas & Glass Surfaces
| Token Name | Value | Purpose |
|---|---|---|
| `canvas-bg` | `#F8FAFC` | Main page canvas background |
| `glass-panel` | `rgba(255, 255, 255, 0.72)` + `backdrop-blur(24px)` | Main sections & stats ribbon |
| `glass-card` | `rgba(255, 255, 255, 0.68)` + `backdrop-blur(20px)` | 13 Micro-SaaS feature cards |
| `glass-card-hover` | `rgba(255, 255, 255, 0.92)` + `border-blue-400/40` | Hover state for interactive cards |
| `glass-nav` | `rgba(255, 255, 255, 0.80)` + `backdrop-blur(24px)` | Sticky header navigation |

#### Typography & Brand Accents
| Role | Color | Hex Code | Usage |
|---|---|---|---|
| **Primary Text** | Slate 900 | `#0F172A` | Hero title, section headings, card titles |
| **Secondary Text** | Slate 600 | `#475569` | Descriptions, subtitles, feature copy |
| **Muted Text** | Slate 400 | `#94A3B8` | Timestamps, metadata, subdomain badges |
| **Brand Primary** | Blue 600 | `#2563EB` | Primary CTA buttons, logo dots, links |
| **Brand Hover** | Blue 700 | `#1D4ED8` | Active button press & hover states |
| **Sovereign Success** | Emerald 600 | `#059669` | Encrypted badges, 99.98% uptime indicator |
| **Interactive Glow** | Indigo 600 | `#4F46E5` | Gradient buttons and ambient orb glows |

---

### 3. Typography Hierarchy
Primary Font Family: `Plus Jakarta Sans`, sans-serif.

| Level | Size | Weight | Line Height | Usage |
|---|---|---|---|---|
| **Hero Headline** | 4.5rem (72px) | 900 (Black) | 1.05 | "Speak Freely." |
| **Section Title** | 3.5rem (56px) | 900 (Black) | 1.10 | "One Unified Account. Infinite Digital Ecosystem." |
| **Card Heading** | 1.25rem (20px)| 900 (Black) | 1.25 | Module Title (e.g. "Zengfy School") |
| **Body Subtitle** | 1.25rem (20px)| 400 (Regular)| 1.60 | Hero subtitle in English |
| **Bengali Value** | 0.95rem (15px)| 500 (Medium) | 1.60 | Subtitle in Bengali |
| **Body Standard** | 0.875rem (14px)| 400 (Regular)| 1.50 | Card descriptions & feature details |
| **Pill / Tag** | 0.6875rem (11px)| 800 (Extra Bold)| 1.20 | Category badges & status tags |

---

### 4. Key Component Specifications

#### A. Header & 9-Dot (Waffle) Apps Launcher
- Sticky frosted glass bar (`h-20`, `glass-nav`).
- Waffle menu button: 44x44px touch target with clean 3x3 circle matrix.
- Popover panel: pure white frosted glass dialog (`rounded-3xl p-5 shadow-2xl`) displaying 9 top micro-SaaS modules in a 3x3 grid with high-touch cards.
- "Sign In" CTA: Pill button with subtle blue shadow (`shadow-blue-500/20`).

#### B. Hero Section with Live Chat Simulator
- Left Column: Bold "Speak Freely." statement, Bengali subtitle, Get Started CTA, and Android APK download button.
- Right Column: Smartphone/browser glass preview box (`bg-white/75 backdrop-blur-2xl rounded-3xl p-6 border-white/90 shadow-2xl`):
  - Simulated chat conversation between verified citizens.
  - Interactive reaction pills (❤️, 🔥): clicking increments counter in real-time.
  - Interactive message input bar allowing visitors to type and append test messages.

#### C. 13 Micro-SaaS Bento Grid
- Live stats ribbon: 4 high-impact counters (Verified Citizens, Total Wards, Active Institutions, System Uptime).
- Instant search bar with magnifying glass icon and category filter pills (`All`, `Civic & Mesh`, `Business & POS`, `Education & Legal`, `Productivity & Vault`).
- 13 Frosted White Glass Cards:
  - Custom icon in rounded white container.
  - Category badge, title, tagline, description, and direct subdomain launcher (`Launch →`).
  - **Zero pricing tags**.

---

### 5. Accessibility (WCAG 2.1 AA) Compliance
1. **Semantic Landmarks:** `<main id="main-content" role="main">`, `<header role="banner">`, `<nav role="navigation">`, `<footer role="contentinfo">`.
2. **Keyboard Bypass:** High-contrast "Skip to main content / মূল তথ্যে যান" link visible upon keyboard `Tab`.
3. **Screen Reader Labels:** All form inputs (chat tester, search box) possess accessible `<label class="sr-only">`.
4. **Touch Targets:** All interactive buttons and tabs meet the minimum 44x44px touch target requirement.

---

### 6. Zengfy Social Landing UI/UX & Component Suite (`social.zengfy.test:8000`)

#### 6.1 Visual Aesthetics & Glassmorphism
- **Base Canvas:** `#F8FAFC` slate canvas with multi-layered ambient blur orbs:
  - Top-Left: Sky Blue (`from-blue-200/50 via-sky-100/40 to-transparent blur-3xl`).
  - Top-Right: Indigo/Violet (`from-indigo-200/45 via-purple-100/30 to-transparent blur-3xl`).
  - Mid-Body: Emerald/Cyan (`from-emerald-100/30 via-cyan-100/30 to-transparent blur-3xl`).
  - Background Texture: Radial dot matrix (`bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:28px_28px] opacity-35`).
- **Surface Elevation:** Frosted white glass cards (`bg-white/80 backdrop-blur-2xl border border-white/90 shadow-xl shadow-slate-200/50`).

#### 6.2 Key Components
1. **`SocialNavbar.jsx`:**
   - Sticky frosted glass bar (`h-20 bg-white/70 backdrop-blur-2xl border-b border-white/80`).
   - Waffle (9-Dot) launcher popover with 3x3 ecosystem app grid.
   - Direct SSO links (`/login` and `/register`).
2. **`SocialHeroSection.jsx`:**
   - Headline: "Real People. Real Communities. Zero Noise." (4.25rem, Black 900).
   - Subtitle: Bengali civic value proposition emphasizing 100% NID-verified identity and zero algorithmic manipulation.
   - Dynamic Telemetry Ribbon: 1,480+ Citizens, 4,554 Wards, 99.4% Safety Index, 3.2s SOS Response.
3. **`InteractiveFeedSimulator.jsx`:**
   - 4-Channel Switcher Tabs: 🌍 World Stream, 📍 Nearby Ward, 👥 Friends & Circles, 🚨 Emergency SOS.
   - Interactive Composer: Visitor can type a post, choose category/ward, and publish live to the preview list.
   - Clickable Emoji Reaction Pills: ❤️, 🔥, 👏, 💡, 🚨 with micro particle burst animations.
4. **`EmergencySosRadarSection.jsx`:**
   - Sonar Radar Visualizer: 3 concentric pulsating rings with rotating sweep radar and central beacon dot.
   - 3 Telemetry Cards: 3.2s Average Response, 750m Mesh Radius, 34 Active Sentinels.
   - Interactive "Trigger Simulated SOS Beacon" button with live sentinel alert simulation.
5. **`SocialPillarsSection.jsx`:**
   - 4 Frosted Bento Cards: Zero Algorithmic Rage-Bait, Sovereign Verified Identity, Hyperlocal Ward Geolocation, and End-to-End Encrypted Circles.

---

### 7. Zengfy School Design System & Component Library (`school.zengfy.test:8000`)

#### 7.1 Palette & Aesthetic
- **Canvas:** `#F8FAFC` Slate canvas with subtle radial dot matrix.
- **Ambient Glow Orbs:**
  - Top-Left: Soft Emerald (`from-emerald-200/50 via-teal-100/40 to-transparent blur-3xl`).
  - Top-Right: Soft Indigo/Violet (`from-indigo-200/45 via-teal-100/30 to-transparent blur-3xl`).
  - Mid-Body: Soft Mint/Cyan (`from-teal-100/35 via-emerald-100/35 to-transparent blur-3xl`).
- **Primary Accents:** Emerald (`#059669`), Teal (`#0D9488`), Royal Indigo (`#4F46E5`), and High-Contrast Slate (`#0F172A`).

#### 7.2 Component Breakdown
1. **`SchoolNavbar.jsx`:**
   - Sticky white frosted glass navbar (`bg-white/80 backdrop-blur-2xl border-b border-slate-200/80`).
   - Brand logo with emerald badge and 9-dot Waffle apps launcher modal popover.
2. **`SchoolHeroSection.jsx`:**
   - Emotive Bengali headline: *"কাগজের ঝামেলাহীন আধুনিক ক্যাম্পাস। অভিভাবকের নিশ্চিন্ত ভরসা।"*
   - Telemetry Ribbon: 540+ Institutions, 180,000+ Students, 99.9% Attendance Accuracy, 4,554 Wards.
3. **`InteractiveRfidSimulator.jsx`:**
   - Left: Physical student ID card for Soumya Ahmed with contactless RFID chip and scanner tap trigger.
   - Micro-interaction: Web Audio pleasant chime + green ripple waves.
   - Right: Realistic smartphone mockup displaying government-masked instant SMS arrival in 0.8 seconds.
   - Shift switcher: Morning arrival (`08:02 AM`) vs afternoon departure (`02:15 PM`).
4. **`RoleJourneyTabs.jsx`:**
   - 4 Perspective tabs: 👨‍👩‍👧 Parents, 👨‍🏫 Teachers, 🏛️ Principals, 🎓 Students.
   - Proof widgets: bKash tuition receipt mockup, 1-click result sheet generator, live finance ticker, and student stars.
5. **`DigitalReportCardSimulator.jsx`:**
   - Interactive subject sliders with real-time recalculation of NCTB letter grades, grade points, total score, and overall GPA 5.00 (Golden A+).
   - Curriculum toggle: NCTB General School vs Madrasah Education Board.
   - PDF transcript print preview trigger.
6. **`PricingOffersSection.jsx`:**
   - 3 Commercial models: Cloud SaaS (৳২,০০০/month), One-Time Self-Hosted License (own domain, zero monthly fees), and Custom Enterprise ERP.
   - Consultation inquiry modal and direct WhatsApp hotline button.
7. **`SchoolPillarsSection.jsx`:**
   - 4 Architectural pillars: Offline-Ready RFID Mesh, Dual Curriculum Compatibility, Transparent Mobile Payments, and Sovereign Academic Vault.
8. **`SchoolFooter.jsx`:**
   - Semantic WCAG footer with ecosystem navigation, developer API docs, and copyright notice.

---

### 8. Zengfy POS Design System (`pos.zengfy.test:8000`)
- **Palette:** Amber Gold (`#F59E0B`), Deep Slate Navy (`#0F172A`), Crisp White (`#FFFFFF`).
- **Components:** `POSNavbar`, `POSHeroSection`, `BoutiquePosSimulator` (Matrix barcode scan, live thermal print slip, bKash Baki Khata collection SMS), `RoleJourneyTabs`, `POSPillarsSection`, `PricingOffersSection`, `POSFooter`.

---

### 9. Zengfy Law Design System (`law.zengfy.test:8000`)
- **Palette:** Royal Heritage Burgundy (`#881337`), Antique Gold (`#D97706`), Parchment Ivory (`#FAFAF9`).
- **Components:** `LawNavbar`, `LawHeroSection`, `CauseListSimulator` (Case cause list search, bench tracking, Vakalatnama preview, client SMS dispatch), `RoleJourneyTabs`, `LawPillarsSection`, `PricingOffersSection`, `LawFooter`.

---

### 10. Zengfy Civil Design System (`civil.zengfy.test:8000`)
- **Palette:** Blueprint Cyan (`#0891B2`), Steel Slate (`#1E293B`), Crisp Graph White (`#FAFAFA`).
- **Components:**
  1. `CivilNavbar.jsx`: Blueprint Cyan badge and ecosystem Waffle launcher modal.
  2. `CivilHeroSection.jsx`: Emotive engineering headline, trust ribbon (620+ firms, 18,500+ plots, ৳450 Cr+ materials).
  3. `InteractivePlotCostSimulator.jsx`: Plot selector (3, 5, 10 katha), preset selector (Duplex Villa vs 7-Storey Complex), multi-angle 3D isometric building block rendering (Isometric, Elevation, Floorplan), dynamic steel/cement/brick price sliders, automated BOQ calculations, and downloadable formal estimate quote modal.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Architect, Site Engineer, Firm Owner, Landowner Client).
  5. `CivilPillarsSection.jsx`: 4 Structural pillars (3D Land GIS Engine, Dynamic Material Costing Algorithm, RAJUK & Municipality Compliance Drafter, Sovereign Project Vault).
  6. `PricingOffersSection.jsx`: Strictly 3 Cloud SaaS subscription tiers (৳3,000/mo Studio Cloud, ৳6,000/mo Firm Pro, Mega Developer Enterprise) + FAQ accordion.
  7. `CivilFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign platform directory.

---

### 11. Zengfy NGO Design System (`ngo.zengfy.test:8000`)
- **Palette:** Humanitarian Teal (`#0D9488`), Hope Coral Rose (`#F43F5E`), Clean Slate (`#FAFAFA`).
- **Components:**
  1. `NGONavbar.jsx`: Humanitarian Teal badge, 13-app 9-dot Waffle launcher popover, and SSO authentication triggers.
  2. `NGOHeroSection.jsx`: Emotive charity headline, telemetry ribbon (৳৩২ কোটি+ সংগৃহীত অনুদান, ৯৮০+ ক্যাম্পেইন, ১,৮০,০০০+ পরিবার, ১০০% অডিট স্বচ্ছতা).
  3. `LiveDonationZakatSimulator.jsx`: 3 Campaign switchers (Flood relief, Winter clothes, Orphanage education), preset donation amounts, payment channel switcher (bKash, Nagad, Bank, Expat Card), Zakat toggle, live animated progress bar, official Tax Exemption Money Receipt modal with QR code, and allocated relief goods card with GPS tracking code.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Expatriate Donor, Charity Director, Field Volunteer, Relief Beneficiary).
  5. `NGOPillarsSection.jsx`: 4 Sovereign pillars (Tamper-Proof Ledger, Strict Shariah Zakat Rulebook, GPS-Tagged Field Verification, Sovereign Donor Privacy Vault).
  6. `PricingOffersSection.jsx`: 3 Commercial tiers (৳1,500/mo Charity Cloud, Lifetime Trust License, International NGO Suite) + FAQ accordion.
  7. `NGOFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign directory.

---

### 12. Zengfy Rent Design System (`rent.zengfy.test:8000`)
- **Palette:** Hyperlocal Indigo (`#4338CA`), GPS Emerald (`#10B981`), Clean Frost Slate (`#FAFAFA`).
- **Components:**
  1. `RentNavbar.jsx`: Hyperlocal Indigo badge, 13-app 9-dot Waffle launcher popover, and SSO authentication triggers.
  2. `RentHeroSection.jsx`: Emotive headline, telemetry ribbon (২৪,৫০০+ ভেরিফায়েড বাসা, ১ কিমি নির্ভুল রেডিয়াস, ৳০ দালাল কমিশন, ৯৯.২% হ্যাপি টেন্যান্ট).
  3. `RadiusRentalMeshSimulator.jsx`: Location dropdown (Mirpur, Dhanmondi, Shantinagar, Uttara, GEC, Zindabazar), 1 km vs 3 km radius selector, interactive GPS pin map view, ৳50 micro-payment modal, and unmasked owner phone number with direct call/navigation actions.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Corporate Tenant, Bachelor Student, Flat Owner, Building Caretaker).
  5. `RentPillarsSection.jsx`: 4 Sovereign pillars (Zero Broker Network, Precision GPS Geofencing, Micro-Payment Unlock, Legally-Vetted Rental Agreement Vault).
  6. `PricingOffersSection.jsx`: 3 Commercial tiers (Tenant Micro-Unlock ৳50/৳250, Landlord Flat Listing ৳250, Landlord ERP Cloud ৳500/mo) + FAQ accordion.
  7. `RentFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign directory.

---

### 13. Zengfy Hotel Design System (`hotel.zengfy.test:8000`)
- **Palette:** Luxury Champagne Gold (`#B45309` / `#D97706`), Midnight Navy (`#0A192F` / `#0F172A`), Crisp Pearl White (`#FAFAFA`).
- **Components:**
  1. `HotelNavbar.jsx`: Champagne Gold badge, 13-app 9-dot Waffle launcher popover, and SSO authentication triggers.
  2. `HotelHeroSection.jsx`: Emotive resort headline, telemetry ribbon (৪২০+ রিসোর্ট ও হোটেল, ৳০ ওটিএ কমিশন, ১৮,০০০+ সরাসরি গেস্ট বুকিং, ৯৯.৪% পজিটিভ রিভিউ).
  3. `KitchenBazarBookingSimulator.jsx`: Dual-tab interface:
     - Tab 1: Daily kitchen raw bazar itemized ledger, chef cash memo validator, and 18-member staff duty roster & daily wage calculator.
     - Tab 2: Zero-commission direct guest booking engine with room tier selector, dynamic OTA 15% commission savings tracker, and instant booking voucher modal with QR room pass.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Resort Owner, Front Desk Receptionist, Head Chef, Vacationing Guest).
  5. `HotelPillarsSection.jsx`: 4 Sovereign pillars (Kitchen Bazar & Wastage Ledger, Zero OTA Commission Direct Engine, Staff Roster & Daily Wage Payroll, Sovereign Guest Privacy Vault).
  6. `PricingOffersSection.jsx`: 3 Commercial tiers (Mid-Tier Hotel Cloud ৳2,500/mo, Lifetime Resort Ownership, Luxury Hotel & Chain Enterprise) + FAQ accordion.
  7. `HotelFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign directory.

---

### 14. Zengfy Shop Design System (`shop.zengfy.test:8000`)
- **Palette:** Sunset Orange (`#EA580C` / `#F97316`), Cyber Violet (`#7C3AED` / `#8B5CF6`), Crisp Canvas (`#FAFAFA`).
- **Components:** `ShopNavbar`, `ShopHeroSection`, `AntiFraudCodReturnSimulator` (Customer risk presets, courier score analysis, green pass vs red COD advance alert, live shipping label generator), `RoleJourneyTabs`, `ShopPillarsSection`, `PricingOffersSection`, `ShopFooter`.

---

### 15. Zengfy Skill Design System (`skill.zengfy.test:8000`)
- **Palette:** Electric Cobalt Blue (`#2563EB` / `#1D4ED8`), Neon Cyan (`#06B6D4` / `#0891B2`), Deep Obsidian Slate (`#0F172A`).
- **Components:**
  1. `SkillNavbar.jsx`: Electric Cobalt badge, 13-app 9-dot Waffle launcher popover, and SSO authentication triggers.
  2. `SkillHeroSection.jsx`: Emotive headline, telemetry ribbon (১,৮৫০+ ভেরিফাইড ট্রেইনার, ৪২,০০০+ সফল শিক্ষার্থী, ৯৮.৬% কোর্স কমপ্লিশন, ১০০% এনআইডি ভেরিফাইড সার্টিফিকেট).
  3. `PostSscSkillCareerSimulator.jsx`: 3-question guidance quiz, AI recommended career track, verified mentor profile, 1-minute demo video player, and tamper-proof NID digital certificate modal.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Fresh Graduate Student, Conscious Parents, Verified Skill Trainer, Tech Employers).
  5. `SkillPillarsSection.jsx`: 4 Sovereign pillars (Zengfy Verified Mentor Network, Structured 90-Day Curriculum, Verifiable Digital Credentials, Student Project Showcase Vault).
  6. `PricingOffersSection.jsx`: 3 Commercial tiers (Verified Trainer Cloud ৳1,500/mo, Academy Lifetime Ownership, Enterprise Educator Suite) + FAQ accordion.
  7. `SkillFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign directory.

---

### 16. Zengfy Journal Design System (`journal.zengfy.test:8000`)
- **Palette:** Editorial Obsidian (`#0F172A`), Deep Crimson Accent (`#BE123C` / `#E11D48`), Warm Newsprint Paper (`#F8FAFC` / `#FAFAFA`).
- **Components:**
  1. `JournalNavbar.jsx`: Editorial Obsidian & Crimson badge, 13-app 9-dot Waffle launcher popover, and SSO authentication triggers.
  2. `JournalHeroSection.jsx`: Emotive headline, telemetry ribbon (৮৫০+ স্বাধীন কলামিস্ট, ৳১.৮ কোটি+ রিডার পে-ওয়াল আয়, ৩,৪০,০০০+ সচেতন পাঠক, ১০০% সেন্সরশিপ-মুক্ত).
  3. `UncensoredOpEdPaywallSimulator.jsx`: Op-ed article reader, frosted glass paywall blur, bKash 1-tap unlock demo modal, encrypted whistleblower tip-box modal.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Independent Columnist, Discerning Reader, Protected Whistleblower, Independent Media Syndicate).
  5. `JournalPillarsSection.jsx`: 4 Sovereign pillars (100% Censorship-Resistant Publishing, Direct Reader Micro-Subscriptions, Zero-Knowledge Source Protection, Custom Domain Substack Engine).
  6. `PricingOffersSection.jsx`: 3 Commercial tiers (৳৮০০/মাস Journalist Pro SaaS, ৳৫,০০০ Lifetime Journal License, Media Syndicate Suite Contact Sales) + FAQ accordion.
  7. `JournalFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign directory.

---

### 17. Zengfy Habit Design System (`habit.zengfy.test:8000`)
- **Palette:** Vitality Emerald (`#10B981` / `#059669`), Sunrise Amber (`#F59E0B` / `#D97706`), Deep Charcoal Slate (`#0F172A`).
- **Components:**
  1. `HabitNavbar.jsx`: Vitality Emerald badge, 13-app 9-dot Waffle launcher popover, and SSO authentication triggers.
  2. `HabitHeroSection.jsx`: Emotive headline on spiritual & personal discipline, telemetry ribbon (৫,২০০+ নিয়মিত মুসল্লি ও ইউজার, ৯৪% সালাত কনসিস্টেন্সি, ৪,৫০,০০০+ কমপ্লিটেড স্ট্রিক, ১০০% নো-অ্যাড নো-ট্র্যাকিং).
  3. `SalahHabitStreakSimulator.jsx`: Interactive daily tracker:
     - 5 Daily Prayers (ফজর, যোহর, আসর, মাগরিব, ইশা) + Quran & Water tracker checkboxes.
     - Dynamic flame streak counter (🔥) with animated progress ring.
     - Bengali Hadith / motivational popup card upon completing prayers.
     - Family / Circle streak leaderboard preview.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Practicing Muslim & Student, Busy Professional, Parents Guiding Children, Circle / Halaqah Leader).
  5. `HabitPillarsSection.jsx`: 4 Sovereign pillars (Strict Privacy Zero-Ad Architecture, 5 Daily Prayers Waqt Precision, Family & Circle Accountability Rings, Offline-First Local Data Storage).
  6. `PricingOffersSection.jsx`: 3 Commercial tiers (Individual Free Forever ৳0, Family & Circle Cloud ৳500 Lifetime, Institutional Halaqah Suite ৳1,200/yr) + FAQ accordion.
  7. `HabitFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign directory.

---

### 18. Zengfy Schedule Design System (`schedule.zengfy.test:8000`)
- **Palette:** Royal Indigo (`#4F46E5` / `#6366F1`), Electric Cyan (`#06B6D4` / `#0EA5E9`), Midnight Slate (`#0F172A`), Crisp Pearl Canvas (`#FAFAFA`).
- **Components:**
  1. `ScheduleNavbar.jsx`: Royal Indigo badge, 14-app 9-dot Waffle launcher popover, and SSO authentication triggers.
  2. `ScheduleHeroSection.jsx`: Emotive booking headline, telemetry ribbon (৩,৮০০+ পেশাজীবী ও চেম্বার, ৯২% নো-শো রিডাকশন, ১,২০,০০০+ সাকসেসফুল অ্যাপয়েন্টমেন্ট, ১০০% বিকাশ নো-ফি ইন্টিগ্রেশন).
  3. `ConsultationBookingCalendarSimulator.jsx`: Interactive Appointment Booking & bKash Deposit Sandbox:
     - 3 Professional Services (Medical Chamber Doctor, High Court Lawyer, Tech & Business Mentor).
     - Live interactive calendar dates (Today, Tomorrow, Day After) and time slots (Morning, Afternoon, Evening) with available vs booked indicators.
     - Advance booking deposit toggle (100% full fee or ৳200 token fee).
     - Simulated booking confirmation modal with instant Google Meet link, .ics calendar download, and SMS reminder draft voucher.
  4. `RoleJourneyTabs.jsx`: 4 Stakeholder perspectives (Doctors & Chamber Specialists, Lawyers & Legal Advisors, Freelance Mentors & Coaches, Clients & Patients).
  5. `SchedulePillarsSection.jsx`: 4 Sovereign pillars (Native bKash/Nagad Consultation Fees, Automated SMS & WhatsApp No-Show Prevention, Two-Way Google Calendar Sync, Zero Per-Booking Platform Commission).
  6. `PricingOffersSection.jsx`: 3 Commercial tiers (Solo Pro SaaS ৳৬০০/মাস, Chamber Lifetime License ৳৪,৫০০ এককালীন, Enterprise Clinic & Firm Suite Contact Sales) + FAQ accordion.
  7. `ScheduleFooter.jsx`: WCAG 2.1 AA compliant footer with language switcher `[ 🇧🇩 বাংলা | 🇬🇧 English ]` and sovereign directory.


