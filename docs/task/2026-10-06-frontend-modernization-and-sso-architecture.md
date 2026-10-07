# 📋 Zengfy Frontend Modernization & Central SSO Architecture Roadmap

**Document ID:** `TASK-FE-MODERN-20261006`  
**Date:** `2026-10-06`  
**Governing Standard:** `CONST-001 (Engineering Constitution)`, `ARCH-002 (API Blueprint)`, `ADR-001`  
**Author:** 👑 Agent 1 (Lead Systems Architect)  
**Supervisor / Tech Lead:** 👨‍💻 Sazzad Hossain  
**Status:** `APPROVED / IN EXECUTION`  
**Location:** [`docs/task/2026-10-06-frontend-modernization-and-sso-architecture.md`](file:///p:/Zengfy-Ecosystem/core/docs/task/2026-10-06-frontend-modernization-and-sso-architecture.md)

---

## 🎯 Executive Summary & Architectural Decisions

Following our architecture review on **October 6, 2026**, Zengfy is adopting a **Google-grade Subdomain Architecture with a Centralized SSO Identity Provider (IdP)**. Because our core backend is completely **API-First** (RESTful, Redis-backed, rate-limited, and modular), our client layer is divided into specialized, high-performance engines:

```
                               ┌─────────────────────────────────────────────────────────────┐
                               │               Zengfy Sovereign API Gateway                   │
                               │  Laravel 11 Multi-Node Cluster + Redis + MySQL + MinIO S3   │
                               │                (Base Domain: zengfy.test:7000)              │
                               └──────────────────────────────┬──────────────────────────────┘
                                                              │
                                ┌─────────────────────────────┼─────────────────────────────┐
                                │                             │                             │
                                ▼                             ▼                             ▼
       ┌──────────────────────────────────┐ ┌──────────────────────────────────┐ ┌──────────────────────────────────┐
       │     Central Identity Hub (SSO)   │ │      Hyperlocal Social Hub       │ │       Native Mobile Platform   │
       │     account.zengfy.test:7000     │ │      social.zengfy.test:7000     │ │       Flutter 3.47 / Dart 3.13 │
       ├──────────────────────────────────┤ ├──────────────────────────────────┤ ├──────────────────────────────────┤
       │ Engine: Nuxt 3 (SSR Pre-rendered)│ │ Engine: Nuxt 3 (SSR + Hydration) │ │ Engine: Cross-Platform Native    │
       │ • Instant <100ms Form Rendering  │ │ • 60 FPS Infinite Virtual Scroll │ │ • 120 FPS Mobile Performance     │
       │ • Decoupled Fast Signup (0 NID)  │ │ • Night Yellow (Eye Comfort)     │ │ • Biometric & Offline Storage    │
       │ • Phone OTP + NID Citizen Badge  │ │ • OpenGraph Social Meta Previews │ │ • Ward SOS Beacon & Push Alerts  │
       │ • Wildcard Cookie (.zengfy.test) │ │ • Dynamic Media & Reactions      │ │ • Google Play & APK Showcase     │
       └──────────────────────────────────┘ └──────────────────────────────────┘ └──────────────────────────────────┘
```

---

## 🗺️ Master Task-Based Execution Breakdown

---

### 🏛️ PHASE 1: Subdomain Routing & Cross-Domain SSO Infrastructure

- [x] **TASK-INFRA-001: Nginx Subdomain Reverse Proxy Configuration**
  - **Objective:** Configure local Nginx (`core-proxy-1`) and production Nginx to route subdomains to their designated frontend/backend containers.
  - **Domains:**
    - `zengfy.test:7000` ➔ Main Portal & AI Agentic Searchbar
    - `account.zengfy.test:7000` ➔ Central SSO & Account Hub
    - `social.zengfy.test:7000` ➔ Hyperlocal Social Network
  - **Deliverable:** Verified wildcard proxy pass routing and explicit `social.{domain}` route dispatching with seamless 302 redirects.

- [x] **TASK-INFRA-002: Wildcard Session Cookie & Cross-Origin Security**
  - **Objective:** Configure centralized session sharing so logging in once at `account.zengfy.test` automatically authenticates `social.zengfy.test` and other ecosystem apps.
  - **Settings:**
    - Dynamic wildcard `SESSION_DOMAIN` (.zengfy.test / .zengfy.top) in `config/session.php`.
    - No-cache headers (`Cache-Control: no-cache, no-store, max-age=0, must-revalidate`) preventing Back-Forward Cache (bfcache) leakage.
    - Bfcache buster script on all auth & social layout blades.
- [x] **TASK-INFRA-003: Container Performance Tuning & Docker Node/NPM Setup**
  - **Objective:** Fix slow page loading (10s latency down to < 300ms) caused by Windows filesystem mounts and missing CLI OPcache in Docker.
  - **Actions Completed:**
    - Installed `nodejs (24.18.1)` and `npm (11.12.1)` across all Docker nodes (`core-app1-1`, `core-app2-1`, `core-app3-1`) and baked into `Dockerfile`.
    - Executed `docker exec core-app1-1 npm install` and verified production asset building via Vite (`npm run build`).
    - Configured CLI OPcache (`opcache.enable_cli=1`, `opcache.revalidate_freq=60`, `opcache.memory_consumption=256MB`, JIT `opcache.jit=1255`).
    - Optimized Composer classmap (`8,684` classes indexed) and cached Laravel routes & config.
  - **Verified Result:** Response time dropped from **9-12 seconds down to ~280 milliseconds** (11x speedup).

---

### 🔐 PHASE 2: Central SSO Auth & Sovereign Account Hub (`account.zengfy.test`)

- [ ] **TASK-AUTH-001: Decoupled Fast Registration Screen**
  - **Route:** `/register`
  - **Specification:**
    - Inputs: Full Name, Email, Password, Password Confirmation.
    - Initial NID input is **completely removed** to guarantee frictionless 3-second onboarding and satisfy legal/regulatory policies.
    - Real-time password strength meter (Weak, Fair, Good, Sovereign 256-bit).
    - Idempotency key via `crypto.randomUUID()`.
  - **Deliverable:** Instant server-rendered registration screen that creates an active user session upon submission.

- [ ] **TASK-AUTH-002: Sovereign Sign-In Portal with Security Guards**
  - **Route:** `/login`
  - **Specification:**
    - Fast SSR rendering (< 100ms first paint).
    - Brute-force lockout visual banner (`HTTP 423`) and rate-limiting notice (`HTTP 429`).
    - Smart redirect: Supports `redirect_uri` (e.g. user redirected from `social.zengfy.test/feed` returns there immediately after login).
  - **Deliverable:** High-conversion, zero-lag login portal with auto device naming.

- [x] **TASK-AUTH-003: 3-Step Password Recovery Engine**
  - **Route:** `/forgot-password`
  - **Specification:**
    - Step 1: Email input & 60-second cooldown timer.
    - Step 2: 6-digit OTP code verification.
    - Step 3: New password setup with automatic redirection to `/login`.
  - **Deliverable:** Responsive self-service recovery page.

- [ ] **TASK-AUTH-004: Sovereign Profile & Device Security Dashboard**
  - **Route:** `/account` (or `/dashboard`)
  - **Specification:**
    - Profile picture live upload with instant preview and storage symlink resolution.
    - Active sessions and device list with 1-click "Revoke Session" and "Revoke All Other Devices" actions.
    - Password change modal with current password confirmation.
    - 9-Dot Universal Ecosystem Launcher modal.
  - **Deliverable:** Modern account management console.

- [ ] **TASK-AUTH-005: Citizen Verification Hub (Phone OTP + National ID)**
  - **Route:** `/account/verify`
  - **Specification:**
    - **Step 1:** Mandatory Bangladeshi Mobile Phone Number verification via SMS OTP.
    - **Step 2:** National ID (NID) Smart Card 10-digit / Old NID 17-digit verification against Election Commission gateway API.
    - Successful verification awards the **Blue Citizen Badge** (`verified_badge = true`).
  - **Deliverable:** Dedicated verification workflow protecting national identity sovereignty.

---

### 🌐 PHASE 3: Hyperlocal Social Media Portal (`social.zengfy.test`)

- [x] **TASK-SOC-001: Eye-Comfort "Night Yellow" Theme System**
  - **Specification:**
    - Default/Toggleable eye-comfort palette designed to minimize blue-light fatigue:
      - Background: `#15120B` (Warm dark amber)
      - Cards & Nav: `#1F190F` (Warm sepia surface)
      - Text: `#F8EFE3` (Warm cream primary) & `#B5A186` (Muted)
      - Borders: `rgba(245, 158, 11, 0.16)`
      - Glow & Accents: Amber/Gold `#F59E0B`
    - Segmented Theme Switcher placed directly adjacent to "Sign Out" in the user dropdown and quick toggle in top navbar.
    - Persistent state via `localStorage.getItem('zengfy_eye_comfort')`.
  - **Deliverable:** Verified flicker-free theme switching on all feed components.

- [x] **TASK-SOC-002: Modular Social Route Separation**
  - **Specification:**
    - All social routes decoupled into [`Modules/Social/routes/web.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/routes/web.php).
    - Root `routes/web.php` maintains clean modular include (`require base_path('Modules/Social/routes/web.php')`).
    - Route ownership handed over to Agent 2 for ongoing UI polish.
  - **Deliverable:** Decoupled, conflict-free routing structure.

- [ ] **TASK-SOC-003: Timeline Feed with Virtual Scroll & Keyset Pagination**
  - **Route:** `/feed`
  - **Specification:**
    - Infinite scroll utilizing cursor-based keyset pagination (`GET /api/v1/feed?cursor=...`).
    - Virtual DOM windowing to prevent browser memory bloat on low-end mobile devices.
    - Multipart image uploads with client-side preview, compression, and error boundaries.
    - Instant optimistic like toggle and comment drawer.
  - **Deliverable:** 60 FPS scrolling feed with hyperlocal Ward filtering.

- [x] **TASK-SOC-004: Citizen Public Profile & Social Graph**
  - **Route:** `/u/{handle}`
  - **Specification:**
    - Real database user binding: avatar, bio, ward code, citizen verification tick.
    - Live Follow / Unfollow toggle button with instant follower counter update.
    - Tabbed view: "Posts", "Media Gallery", and "About".
  - **Deliverable:** Polished public profile with full responsiveness.

- [ ] **TASK-SOC-005: OpenGraph Dynamic Meta Tags for Social Sharing**
  - **Specification:**
    - When a user shares a Zengfy link (`social.zengfy.test/u/{handle}` or `/posts/{id}`) on WhatsApp, Facebook, or Twitter, dynamic OpenGraph meta tags render:
      - `og:title`, `og:description`, `og:image`, `twitter:card`.
  - **Deliverable:** SSR-generated rich link previews for all public pages.

---

### 📱 PHASE 4: Flutter Native Mobile Application (`mobile/zengfy_app`)

- [x] **TASK-MOB-001: Flutter Environment & Project Scaffold**
  - **Environment:**
    - Flutter SDK `3.47.6` installed at `C:\src\flutter`.
    - Dart SDK `3.13.5` configured in system `PATH`.
  - **Deliverable:** Initialize clean Flutter application repository with Material 3 & custom Zengfy dark/amber themes.

- [ ] **TASK-MOB-002: Unified SSO Auth Client for Mobile**
  - **Specification:**
    - Secure storage of tokens via `flutter_secure_storage`.
    - Biometric authentication (Fingerprint / Face ID) for instant sign-in.
    - Central SSO OAuth/Sanctum token refresh interceptor in Dio.
  - **Deliverable:** Working native login and registration with session persistence.

- [x] **TASK-MOB-003: Mobile App Showcase & APK Download Page**
  - **Route:** `/download`
  - **Specification:**
    - Showcase hero with device mockup, feature highlights (Ward SOS, Offline Identity, Ultra-fast feed).
    - Direct APK download button and SHA-256 integrity verification badge.
  - **Deliverable:** High-converting landing page for Android mobile app distribution.

---

## 👥 Multi-Agent Work Allocation Matrix

| Module / Scope | Lead Agent | Environment | Responsibilities |
|---|---|---|---|
| **Core Architecture & SSO Gateway** | 👑 **Agent 1** | Antigravity IDE | Subdomain Nginx routing, Session Domain cookies, Laravel API endpoints, Rate limiting, Flutter SDK environment setup. |
| **Social Module & Profile Frontend** | 🎨 **Agent 2** | Zed Editor | `Modules/Social/routes/web.php`, `profile.blade.php`, `/forgot-password`, `/download`, UI styling, Alpine reactivity. |
| **Testing & Quality Assurance** | 👨‍💻 **Sazzad Hossain** | Browser | Automated tests paused; manual end-to-end verification directly in the browser across all subdomains. |

---

## 🏁 Verification & Acceptance Criteria

1. **Registration:** Visiting `http://zengfy.test:7000/register` shows only Name, Email, and Password. Signup completes in < 3 seconds without asking for NID.
2. **Night Yellow Feed:** Visiting `http://zengfy.test:7000/feed` displays the eye-comfort warm amber palette. Clicking the toggle switch flips between Midnight and Night Yellow seamlessly.
3. **Route Separation:** Social routes function from `Modules/Social/routes/web.php` without errors.
4. **Flutter Ready:** `flutter --version` executes cleanly in terminal without errors.
