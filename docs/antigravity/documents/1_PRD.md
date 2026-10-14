# 1. Product Requirements Document (PRD)
## Zengfy Sovereign Ecosystem Master Landing

---

### 1. Executive Summary & Vision
**Zengfy Ecosystem** is Bangladesh's next-generation sovereign digital infrastructure designed to unify public civic communication, institutional school ERPs, retail POS billing, and legal case vaults under a **single verified sovereign citizen identity**.

The Master Landing page (`http://zengfy.top:8000/`) serves as the central command portal and entry point to the 13 sovereign micro-SaaS platforms. Designed with a **White Glassmorphic aesthetic** (`#F8FAFC` canvas, frosted glass panels, ambient glow orbs) and built directly with **React 19, Tailwind CSS v4, and Vite inside Laravel 11**, it delivers a world-class, ultra-fast, and accessible gateway.

---

### 2. Strategic Execution Strategy: Single-Module Clean Slate
To ensure rock-solid stability, zero routing conflicts, and clean progress:
1. **Isolated Landing Focus:** All other module routes (`Social`, `School`, `Auth`, etc.) are cleanly detached from the root registries (`routes/web.php` and `routes/api.php`) while we focus 100% on perfecting the Master Landing module.
2. **Sequential Iteration:** Master Landing is completed first, followed next by the dedicated Social Landing, other micro-SaaS landings, and the companion Flutter mobile app.
3. **Decoupled Pricing:** All pricing tiers and commercial checkout clutter have been removed from the master landing page. Pricing will live on its own dedicated domain (`billing.zengfy.top`) in a future phase.

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
- **FR-1 (Clean Root Mount):** Directly accessible at `http://zengfy.top:8000/` without separate ports or decoupled servers.
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

### 6. Social Module Dedicated Landing (`social.zengfy.top:8000/`)

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
   - Dedicated clean endpoints: `GET /` on `social.zengfy.top:8000`, redirect from `zengfy.top:8000/social`, and public REST endpoint `GET /api/v1/social/landing`.

---

### 7. School Module Dedicated Landing (`school.zengfy.top:8000/`)

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

### 8. POS Module Dedicated Landing (`pos.zengfy.top:8000/`)

#### 8.1 Vision & Target Retailers
Dedicated retail management ERP for Bangladesh's boutique fashion showrooms, shopping mall retailers (e.g. Jamuna Future Park, Bashundhara City), and apparel brands:
- **Pain Points Solved:** Color & size matrix stock management, barcode scanner checkout under 1.8 seconds, eliminating cashier theft, and automated bKash SMS recovery for customer credit (Baki Khata).
- **Core Simulators:** Interactive Boutique POS Sandbox with variant matrix (S, M, L, XL, XXL) selection, barcode gun scan simulation, live 3-inch ESC/POS thermal receipt generation, and SMS collection alert.
- **3 Commercial Tiers:** Smart Boutique Pack (৳8,000/yr), Fashion Flagship Pro (৳14,500/yr), Multi-Branch Mall Enterprise (৳28,000/yr).

---

### 9. Law Module Dedicated Landing (`law.zengfy.top:8000/`)

#### 9.1 Vision & Legal Practice
Dedicated digital chamber and court practice platform for Bangladesh Supreme Court and 64 District Court Advocates, clerks, and law firms:
- **Pain Points Solved:** Eliminating missed hearing dates via automated daily court Cause List scraping, 1-click Vakalatnama & Bail petition drafting, court clerk/muhuri ledger accounting, and encrypted client case vault.
- **Core Simulator:** Interactive Cause List Sandbox with case search (`১২৮/২০২৬`), bench tracking, Vakalatnama modal preview, and client hearing reminder SMS trigger.
- **3 Commercial Tiers:** Smart Chamber Cloud (৳2,000/mo), Lifetime Chamber License (One-time, own PC/domain), Corporate Law Firm Suite (Contact Sales).
### 10. Civil Module Dedicated Landing (`civil.zengfy.top:8000/`)

#### 10.1 Vision & Architectural Engineering
Dedicated 3D land plot architecture, structural CAD vault, and dynamic construction costing ERP for Bangladesh civil engineering firms, architects, and developers:
- **Pain Points Solved:** Landowner communication barrier solved with instant 3D isometric visualization, BNBC & RAJUK/CDA setback/FAR compliance, live rod-cement wholesale/retail price tracking, and Bar Bending Schedule (BBS) automation.
- **Strict Commercial Rule:** Strictly Cloud SaaS (Software as a Service) subscription model — NO one-time license.
- **Core Simulator:** Interactive 3D Plot & Costing Sandbox featuring sample plots (3, 5, 10 Katha), architectural presets (Modern Duplex Villa vs 7-Storey Residential Complex), multi-angle rendering (Isometric, Front Elevation, Floorplan), real-time steel/cement/brick price sliders, dynamic BOQ calculation, and downloadable formal estimate quote.
- **3 Commercial Tiers:** Architect Studio Cloud (৳3,000/mo), Construction Firm Pro (৳6,000/mo), Mega Developer Enterprise (Contact Sales).

### 11. NGO Module Dedicated Landing (`ngo.zengfy.top:8000/`)

#### 11.1 Vision & Sovereign Crowdfunding
Dedicated transparent crowdfunding, live donation campaigns, and Shariah-compliant Zakat distribution platform for Bangladesh charity trusts, foundations, orphanages, and disaster relief programs:
- **Pain Points Solved:** Donor & expatriate trust crisis solved with live progress bars, automated tax-exemption money receipts, and 100% transparent GPS-tagged photo audit trails for relief distribution.
- **Core Simulator:** Interactive Live Donation & Zakat Allocation Sandbox featuring campaign switcher (Sylhet/Feni flood relief, Kurigram winter blanket drive, Orphanage educational zakat fund), dynamic preset donation buttons (৳১,০০০, ৳২,৫০০, ৳৫,০০০, ৳১০,০০০), bKash/Nagad/Expatriate USD gateways, instant progress bar animation, downloadable official tax money receipt, and allocated relief goods card with GPS tracking tag.
- **3 Commercial Tiers:** Charity Cloud (৳1,500/mo), Lifetime Trust License (One-time, own domain), International NGO Custom Software (Contact Sales).

### 12. Rent Module Dedicated Landing (`rent.zengfy.top:8000/`)

#### 12.1 Vision & Disruptive Rental Mesh
Dedicated broker-free hyperlocal rental mesh and property management ERP for Bangladesh tenants, students, bachelors, flat owners, and building caretakers:
- **Pain Points Solved:** Broker exploitation (1 month rent commission) and exhausting street searches eliminated with Pay-Per-Km micro-payments (৳50 for 1 km / ৳250 for 3 km) to unlock direct verified owner phone numbers and addresses.
- **Core Simulator:** Interactive Radius Rental Mesh Sandbox featuring location selection (Dhaka, Chittagong, Sylhet), 1 km vs 3 km radius toggle, interactive GPS pins (Family Flats, Bachelor Sublets, Deluxe Studios), ৳50 micro-payment unlock simulation, and unmasked owner phone number with direct call/navigation triggers.
- **3 Commercial Tiers:** Tenant Pay-Per-Radius (৳50 1km / ৳250 3km micro-unlock), Landlord Flat Listing (৳250 one-time per flat till rented), Building Owner Landlord Cloud (৳500/mo ERP).

### 13. Hotel Module Dedicated Landing (`hotel.zengfy.top:8000/`)

#### 13.1 Vision & Hospitality ERP
Dedicated resort, boutique hotel, and eco-cottage management ERP for Bangladesh hospitality business owners:
- **Pain Points Solved:** Kitchen raw material theft (bazar churi) eliminated via daily itemized ledger and wastage audit, staff rosters & biometric payroll, and zero-commission direct guest booking engine to escape 15-20% OTA (Booking.com/Agoda) commission cuts.
- **Core Simulator:** Interactive Kitchen Bazar & Zero-Commission Booking Sandbox with dual tabs:
  - Tab 1: Daily kitchen bazar ledger (fish, meat, rice, spices: ৳7,400), chef cash memo validator, and 18-member staff attendance & wage tracker.
  - Tab 2: Zero-commission direct guest booking engine with cottage/suite selector, dynamic OTA fee comparison (-15% loss vs ৳0 Zengfy cut), and 1-tap bKash/Card direct guest booking confirmation voucher with QR room pass.
- **3 Commercial Tiers:** Mid-Tier Hotel Cloud Suite (৳2,500/mo SaaS), Lifetime Resort Ownership License (one-time, own domain), Luxury Hotel & Chain Enterprise (Contact Sales).

### 14. Shop Module Dedicated Landing (`shop.zengfy.top:8000/`)

#### 14.1 Vision & Anti-Fraud D2C Social Commerce
Dedicated anti-fraud e-commerce & courier integration ERP for Bangladesh F-Commerce and D2C brands:
- **Pain Points Solved:** High RTO courier return loss eliminated with automated delivery success rate scoring, Steadfast/Pathao 1-click booking, and advance delivery fee bKash payment link trigger for high-risk customers.
- **Core Simulator:** Interactive Anti-Fraud COD Return Simulator with customer risk presets (Safe regular buyer vs high-risk fake buyer), courier selection, green COD approved vs red alert advance fee notice, and live courier shipping label generation.
- **3 Commercial Tiers:** Ready Cloud Shop (৳1,200/mo SaaS), Lifetime Store Ownership License (one-time, own domain), Enterprise D2C Brand (Contact Sales).

---

### 15. Skill Module Dedicated Landing (`skill.zengfy.top:8000/`)

#### 15.1 Vision & Verified Post-SSC Career Launchpad
Dedicated verified skills platform and 90-day practical roadmap for Bangladesh SSC & HSC graduates and verified IT mentors:
- **Pain Points Solved:** Fraudulent and low-quality coaching centers replaced with 100% Zengfy-verified industry mentors, zero-to-hero 90-day roadmaps, and tamper-proof NID-verified digital credentials.
- **Core Simulator:** Interactive Post-SSC Career Guidance Quiz & Verified Demo Player with 3-question guidance quiz, instant AI recommended track matching (Web Dev, UI/UX, English, Freelancing), 1-minute demo video player, and verifiable digital certificate modal.
- **3 Commercial Tiers:** Verified Trainer Cloud (৳1,500/mo SaaS), Academy Lifetime Ownership License (one-time, own domain), Enterprise Educator Suite (Contact Sales).

---

### 16. Journal Module Dedicated Landing (`journal.zengfy.top:8000/`)

#### 16.1 Vision & Censorship-Resistant Independent Journalism
Dedicated sovereign editorial portal and paywall reader monetization suite for Bangladesh independent journalists, investigative reporters, and op-ed columnists:
- **Pain Points Solved:** Corporate media censorship, algorithmic de-platforming, and financial vulnerability of fearless writers eliminated through direct reader monetization, zero intermediary interference, and zero-knowledge encrypted whistleblower leak vaults.
- **Core Simulator:** Interactive Uncensored Op-Ed & bKash Paywall Simulator featuring:
  - Investigative op-ed reader with blurred/frosted glass paywall gate after the first paragraph.
  - 1-tap bKash/Nagad micro-payment unlock simulation (৳20 per investigative report / ৳150 monthly subscription).
  - Encrypted Whistleblower DropBox modal demo demonstrating 256-bit client-side zero-knowledge source encryption without server-side IP logging.
- **3 Commercial Tiers:** Journalist Pro SaaS (৳800/mo), Lifetime Journal License (৳5,000 one-time, own domain), Media Syndicate Suite (Contact Sales).

---

### 17. Habit Module Dedicated Landing (`habit.zengfy.top:8000/`)

#### 17.1 Vision & 5 Daily Prayers & Habit Streak Platform
Dedicated spiritual and lifestyle discipline tracking platform for Muslims and conscious achievers across Bangladesh:
- **Pain Points Solved:** Broken routines, missed prayers (ওয়াক্ত ছুটে যাওয়া), and intrusive ad-filled habit apps replaced with clean, zero-ad 5 Daily Prayers (৫ ওয়াক্ত সালাত) tracking, custom daily micro-habits, and family/circle accountability rings.
- **Core Simulator:** Interactive Salah & Daily Micro-Habit Streak Sandbox featuring:
  - Fajr, Dhuhr, Asr, Maghrib, Isha interactive checkboxes + daily Quran reading and water intake.
  - Live streak flame counter (🔥) that increments dynamically with animated encouraging Bengali Hadith/motivational insights.
  - Circle accountability view comparing streaks with family or study circle members.
- **3 Commercial Tiers:** Sovereign Individual Free Forever (৳0, 100% privacy, zero ads), Family & Circle Cloud (৳500 one-time lifetime license), Community & Institution Tier (৳1,200/yr).

---

### 18. Schedule Module Dedicated Landing (`schedule.zengfy.top:8000/`)

#### 18.1 Vision & Client Appointment Booking & Consultation Calendar
Dedicated client appointment booking, paid consultation scheduling, and automated SMS reminder calendar for Bangladesh professionals (doctors, lawyers, consultants, tutors, and coaches):
- **Pain Points Solved:** Back-and-forth messaging ("কখন ফ্রি আছেন?") and client no-show loss eliminated through automated time slot booking, advance bKash/Nagad appointment fee collection, and two-way Google Calendar / Google Meet sync without expensive USD Calendly subscriptions.
- **Core Simulator:** Interactive Consultation Booking & bKash Deposit Sandbox featuring:
  - Professional/Service selector (Doctor chamber, Legal advisory, Tech consultation).
  - Real-time date & time slot picker with live availability status.
  - Advance booking deposit toggle (100% full fee or ৳200 serial confirmation token).
  - Instant booking voucher modal with downloadable Google Calendar / .ics invite, Google Meet link, and automated SMS reminder preview.
- **3 Commercial Tiers:** Solo Professional Cloud (৳600/mo SaaS), Chamber Lifetime License (৳4,500 one-time, own domain), Enterprise Clinic & Consultancy Suite (Contact Sales).

---
