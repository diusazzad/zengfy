# 📚 Zengfy Engineering & Laravel Topic Progress Tracker

This document tracks all official Laravel documentation concepts, system design architectures, and security practices implemented in the Zengfy Unified Ecosystem.

---

## 🚀 Phase 1: Core Landing & Dynamic Subdomain Engine

### 1. Routing & Architecture
- [x] **Sub-Domain Routing (`Route::domain`)**: Dynamic `{subdomain}.zengfy.top` wildcard resolution.
- [x] **API Route Versioning (`Route::prefix('v1')`)**: RESTful API route groups in `routes/api.php`.
- [x] **Controller Grouping (`Route::controller`)**: Grouping resource actions under controllers.
- [x] **Route Naming (`->name()`)**: Named route generation for URL helpers.

### 2. Security & SEO Optimization
- [x] **Rate Limiting & Throttling (`throttle:60,1`)**: Protecting API endpoints from DDoS and scraping.
- [x] **Environment Configuration (`env()` & `config()`)**: Isolating domain schemes for local (`:7000`) & production (`https`).
- [x] **WCAG 2.1 Accessibility & Focus Rings**: Touch targets (44px+) and focus rings (`focus-visible:ring-2`).
- [x] **Robots.txt & Sitemap Integration**: Dynamic XML Sitemap Engine (`SitemapController`) indexing main pages & all 15 subdomains.
- [x] **Font Display Swap (`&display=swap`)**: Zero Flash of Invisible Text (FOIT) font performance optimization.
- [x] **FAQPage JSON-LD Schema**: Schema.org FAQPage rich search snippet markup.
- [x] **Dynamic `hreflang` Regional Tags**: Multi-lingual & regional SEO targeting (`bn`, `en`, `x-default`).

### 3. Architecture & Service Layer
- [x] **Service Pattern (`ModuleDataService`)**: Single Responsibility Principle (SRP) isolating business data logic from controllers.
- [x] **JSON HTTP Responses (`response()->json()`)**: Standardized 200 OK & 404 Not Found JSON API responses.
- [x] **Dynamic Subdomain Hydration (`subdomain_landing.blade.php`)**: Master dynamic view template rendering adaptive module themes.

---

## 🔒 Phase 2: Central Auth, SSO & NID Verification Roadmap

- [ ] **Database Migrations & Foreign Keys**: `users`, `nid_verifications`, and `user_app_access` schema.
- [ ] **Laravel Sanctum / JWT Tokens**: Unified Single Sign-On (SSO) token issuance for subdomains.
- [ ] **NID Verification Engine**: National ID identity verification gateway & mock sandbox.
- [ ] **Subdomain Session Sharing**: Cross-subdomain cookie authentication across `*.zengfy.top`.
- [ ] **Multi-Tenant Authorization & Policies**: Restricting app features per user subscription role.

---

*Last Updated: July 2026*
