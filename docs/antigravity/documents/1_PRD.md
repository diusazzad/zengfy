# 1. Product Requirements Document (PRD)
## Zengfy Sovereign Ecosystem Master Landing

---

### 1. Executive Summary & Vision
**Zengfy Ecosystem** is Bangladesh's next-generation sovereign digital infrastructure designed to unify public civic communication, institutional school ERPs, retail POS billing, and legal case vaults under a **single verified sovereign citizen identity**.

The Master Landing page (`http://zengfy.test:8000/`) serves as the central command portal and entry point to the 13 sovereign micro-SaaS platforms. Designed with a **White Glassmorphic aesthetic** (`#F8FAFC` canvas, frosted glass panels, ambient glow orbs) and built directly with **React 19, Tailwind CSS v4, and Vite inside Laravel 11**, it delivers a world-class, ultra-fast, and accessible gateway.

---

### 2. Strategic Execution Strategy: Single-Module Clean Slate
To ensure rock-solid stability, zero routing conflicts, and clean progress:
1. **Isolated Landing Focus:** All other module routes (`Social`, `School`, `Auth`, etc.) are cleanly detached from the root registries (`routes/web.php` and `routes/api.php`) while we focus 100% on perfecting the Master Landing module.
2. **Sequential Iteration:** Master Landing is completed first, followed next by the dedicated Social Landing, other micro-SaaS landings, and the companion Flutter mobile app.
3. **Decoupled Pricing:** All pricing tiers and commercial checkout clutter have been removed from the master landing page. Pricing will live on its own dedicated domain (`billing.zengfy.test`) in a future phase.

---

### 3. Solution Overview & Key Components
- **Header & Google-Style 9-Dot Apps Launcher:** Instant-access 3x3 modal popover displaying the sovereign app grid alongside direct Sign In / Register SSO links.
- **Signal-Style Hero ("Speak Freely."):**
  - High-impact headline and Bengali value proposition emphasizing zero ad-tracking and sovereign encryption.
  - Interactive live social chat mockup: visitors can interactively click reaction emojis (❤️, 🔥) and test typing messages.
  - Direct CTAs: "Get Started" and "Download Android APK".
- **Ecosystem Showcase ("One Unified Account. Infinite Digital Ecosystem."):**
  - Live platform telemetry strip: Verified Citizens (`1,480+`), Wards (`4,554`), Institutions (`540+`), Uptime (`99.98%`).
  - Search filter input and category tabs (`All`, `Civic & Mesh`, `Business & POS`, `Education & Legal`, `Productivity & Vault`).
  - 13 Frosted White Glass Cards for all micro-SaaS platforms (Social, School, POS, Law, Civil, NGO, Rent, Hotel, Commerce, Skill, Journal, Habit, Schedule) with direct subdomain launch URLs.
- **Sovereign Infrastructure Pillars:** 4 architectural guarantees (Citizen SSO, Hyperlocal Ward Mesh, 256-Bit Zero-Knowledge Vault, Autonomous Micro-SaaS Engine).
- **Public REST API:** `GET /api/v1/ecosystem/landing` provides dynamic platform metadata consumed identically by the React 19 web app and the Flutter mobile app.

---

### 4. Functional Requirements
- **FR-1 (Clean Root Mount):** Directly accessible at `http://zengfy.test:8000/` without separate ports or decoupled servers.
- **FR-2 (Dynamic API Consumption):** React 19 frontend hydrates seamlessly from SSR data injection (`data-initial-data`) and re-queries `/api/v1/ecosystem/landing` via TanStack Query.
- **FR-3 (Interactive Hero Simulator):** Real-time interactive social chat preview allowing user reaction clicks and message submissions.
- **FR-4 (WCAG 2.1 AA Accessibility):** Screen-reader compliant with semantic `<main id="main-content" role="main">`, `<header role="banner">`, `<footer role="contentinfo">`, "Skip to main content" link, and descriptive ARIA labels on all interactive controls.
- **FR-5 (Flutter API Parity):** REST endpoint structured in pure JSON to allow direct consumption by the Flutter/Android mobile app.

---

### 5. Non-Functional Requirements
- **Performance:** First Contentful Paint (FCP) < 0.6s, Time to Interactive (TTI) < 1.0s, Zero CLS.
- **Aesthetic:** White Glassmorphic design (`#F8FAFC` base, `backdrop-blur-2xl`, translucent white panels, high-contrast `#0F172A` text).
- **Reliability:** Built with offline fallback mock data ensuring zero crashes even if backend database connections are interrupted.

---

### 6. Social Module Dedicated Landing (`social.zengfy.test:8000/`)

#### 6.1 Vision & Benchmarks
The Social Landing is the dedicated public front door for Bangladesh's sovereign social network, benchmarking the best of:
- **Threads & Bluesky:** Clean timeline aesthetic, open protocols, zero algorithmic rage-bait, pure chronological order.
- **Signal:** 256-bit client-side encryption, zero commercial ad profiling, zero data harvesting.
- **Nextdoor:** Hyperlocal ward integration across Bangladesh's 4,554 administrative wards.

#### 6.2 Key Features
1. **Interactive Multi-Channel Feed Simulator:**
   - 4 switcher channels: 🌍 **World Stream**, 📍 **Nearby Ward** (e.g. Ward 19, Gulshan-2), 👥 **Friends & Circles**, 🚨 **Emergency SOS**.
   - Live composer simulation allowing visitors to test-compose and append posts with instant feedback.
   - Clickable emoji reactions (❤️, 🔥, 👏, 💡, 🚨) with particle bursts and dynamic counter increments.
2. **Emergency SOS Radar Visualizer:**
   - Interactive radar beacon demonstrating hyperlocal ward safety mesh.
   - Shows real-time simulated telemetry: 3.2s average response time, 750m broadcast radius, 34 online verified ward sentinels.
3. **4 Civic Architecture Pillars:**
   - Zero Algorithmic Rage-Bait, Sovereign Verified Identity (NID backed), Hyperlocal Ward Geolocation, and End-to-End Encrypted Circles.
4. **Single-Module Route Clean Slate:**
   - Stripped away legacy half-baked internal routes in `Modules/Social/routes/web.php` and `api.php`.
   - Dedicated clean endpoints: `GET /` on `social.zengfy.test:8000`, redirect from `zengfy.test:8000/social`, and public REST endpoint `GET /api/v1/social/landing`.

---

### 7. School Module Dedicated Landing (`school.zengfy.test:8000/`)

#### 7.1 Vision & Benchmarks
The School Landing is the dedicated public gateway for Bangladesh's sovereign educational management ecosystem, benchmarking global leaders (Toddle, ClassDojo, Brightwheel, PowerSchool) and custom-engineered for local institutions:
- **Bengali Cultural Resonance:** "কাগজের ঝামেলাহীন আধুনিক ক্যাম্পাস। অভিভাবকের নিশ্চিন্ত ভরসা।"
- **Dual Curriculum Engine:** Complete compatibility with General Schools (NCTB), Cadet Academies, and Madrasahs (Qawmi & Alia).
- **Paperless Institutional Governance:** Automated RFID gate attendance, 1-click grade sheet calculation, and 1-tap mobile tuition fees.

#### 7.2 Interactive Core Simulators
1. **Interactive RFID Gate Attendance Kiosk:**
   - Interactive student ID card for "সৌম্য আহমেদ" (Roll: 12, Class: 8th) with audio-visual tap feedback.
   - Synchronous animated smartphone mockup of the guardian showing instant SMS arrival ("সৌম্য সকাল ৮:০২ মিনিটে নিরাপদে ক্লাসে প্রবেশ করেছে").
   - Toggle between Morning Arrival (`08:02 AM`) and Afternoon Departure (`02:15 PM`).
2. **Digital Report Card Simulator (GPA 5.00 Calculator):**
   - Interactive marks sliders across Bangla, English, Mathematics, and Science/Arabic.
   - Instant NCTB letter grade, grade points, total score, and overall GPA computation with Golden A+ validation.
   - Toggle between NCTB General School curriculum and Madrasah Board curriculum.

#### 7.3 Four Stakeholder Journeys
- 👨‍👩‍👧 **অভিভাবক (Parents):** Instant gate SMS, 1-tap bKash/Nagad fee payment, zero bank queues, instant digital stamped receipts.
- 👨‍🏫 **শিক্ষক (Teachers):** Elimination of manual calculators, automated NCTB marksheet generation, 30-second digital section roll call.
- 🏛️ **অধ্যক্ষ ও গভর্নিং বডি (Principals):** Real-time fee collection dashboard, staff biometric payroll, 1-click broadcast notices.
- 🎓 **শিক্ষার্থী (Students):** 1-Card campus access, digital timetable, attendance star badges, encrypted academic vault.

#### 7.4 Three Bangladesh Institutional Commercial Offers
1. **রেডি ক্লাউড সাবস্ক্রিপশন (Cloud SaaS):** ৳২,০০০ / মাস — All-in-one cloud hosting, automated backups, 1,000 students, mobile apps, SMS gateway.
2. **ওয়ান-টাইম ওনারশিপ লাইসেন্স (Self-Hosted on Own Domain):** এককালীন ওনারশিপ — Setup on institution's own domain, 100% sovereign data control, zero monthly billing, offline RFID sync.
3. **কাস্টম এন্টারপ্রাইজ ইআরপি (Custom Enterprise):** Contact Sales — Multi-campus dashboards, custom modules, on-site staff training, dedicated engineer, custom banking APIs.

---

### 8. POS Module Dedicated Landing (`pos.zengfy.test:8000/`)

#### 8.1 Vision & Target Retailers
Dedicated retail management ERP for Bangladesh's boutique fashion showrooms, shopping mall retailers (e.g. Jamuna Future Park, Bashundhara City), and apparel brands:
- **Pain Points Solved:** Color & size matrix stock management, barcode scanner checkout under 1.8 seconds, eliminating cashier theft, and automated bKash SMS recovery for customer credit (Baki Khata).
- **Core Simulators:** Interactive Boutique POS Sandbox with variant matrix (S, M, L, XL, XXL) selection, barcode gun scan simulation, live 3-inch ESC/POS thermal receipt generation, and SMS collection alert.
- **3 Commercial Tiers:** Smart Boutique Pack (৳8,000/yr), Fashion Flagship Pro (৳14,500/yr), Multi-Branch Mall Enterprise (৳28,000/yr).

---

### 9. Law Module Dedicated Landing (`law.zengfy.test:8000/`)

#### 9.1 Vision & Legal Practice
Dedicated digital chamber and court practice platform for Bangladesh Supreme Court and 64 District Court Advocates, clerks, and law firms:
- **Pain Points Solved:** Eliminating missed hearing dates via automated daily court Cause List scraping, 1-click Vakalatnama & Bail petition drafting, court clerk/muhuri ledger accounting, and encrypted client case vault.
- **Core Simulator:** Interactive Cause List Sandbox with case search (`১২৮/২০২৬`), bench tracking, Vakalatnama modal preview, and client hearing reminder SMS trigger.
- **3 Commercial Tiers:** Smart Chamber Cloud (৳2,000/mo), Lifetime Chamber License (One-time, own PC/domain), Corporate Law Firm Suite (Contact Sales).
### 10. Civil Module Dedicated Landing (`civil.zengfy.test:8000/`)

#### 10.1 Vision & Architectural Engineering
Dedicated 3D land plot architecture, structural CAD vault, and dynamic construction costing ERP for Bangladesh civil engineering firms, architects, and developers:
- **Pain Points Solved:** Landowner communication barrier solved with instant 3D isometric visualization, BNBC & RAJUK/CDA setback/FAR compliance, live rod-cement wholesale/retail price tracking, and Bar Bending Schedule (BBS) automation.
- **Strict Commercial Rule:** Strictly Cloud SaaS (Software as a Service) subscription model — NO one-time license.
- **Core Simulator:** Interactive 3D Plot & Costing Sandbox featuring sample plots (3, 5, 10 Katha), architectural presets (Modern Duplex Villa vs 7-Storey Residential Complex), multi-angle rendering (Isometric, Front Elevation, Floorplan), real-time steel/cement/brick price sliders, dynamic BOQ calculation, and downloadable formal estimate quote.
- **3 Commercial Tiers:** Architect Studio Cloud (৳3,000/mo), Construction Firm Pro (৳6,000/mo), Mega Developer Enterprise (Contact Sales).

### 11. NGO Module Dedicated Landing (`ngo.zengfy.test:8000/`)

#### 11.1 Vision & Sovereign Crowdfunding
Dedicated transparent crowdfunding, live donation campaigns, and Shariah-compliant Zakat distribution platform for Bangladesh charity trusts, foundations, orphanages, and disaster relief programs:
- **Pain Points Solved:** Donor & expatriate trust crisis solved with live progress bars, automated tax-exemption money receipts, and 100% transparent GPS-tagged photo audit trails for relief distribution.
- **Core Simulator:** Interactive Live Donation & Zakat Allocation Sandbox featuring campaign switcher (Sylhet/Feni flood relief, Kurigram winter blanket drive, Orphanage educational zakat fund), dynamic preset donation buttons (৳১,০০০, ৳২,৫০০, ৳৫,০০০, ৳১০,০০০), bKash/Nagad/Expatriate USD gateways, instant progress bar animation, downloadable official tax money receipt, and allocated relief goods card with GPS tracking tag.
- **3 Commercial Tiers:** Charity Cloud (৳1,500/mo), Lifetime Trust License (One-time, own domain), International NGO Custom Software (Contact Sales).

---
