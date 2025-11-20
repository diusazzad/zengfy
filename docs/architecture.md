# Zengfy Architecture Overview

## Vision
Zengfy is a hybrid SaaS ecosystem: a centralized landing experience (`zengfy`) that routes authenticated users into specialized subdomains such as `ecommerce.zengfy`, `school.zengfy`, and so on. Each subdomain behaves like a mini-product with its own UI, data models, and workflows while sharing a single account, identity provider, and billing plane.

## Core Layers

1. **Entry Layer (Landing + Marketing)**
   - `zengfy.top` (or configurable domain) shows the hero, mega-menu, product teasers, and the four-call-to-action header (Home, Team, Play, Contact, Signup).
   - Static content is served via CDN, pre-rendered marketing pages, and hero video, while capturing email/interests for follow-up.

2. **Identity & SSO**
   - Central auth service (Laravel Sanctum/Passport) issues tokens scoped to `zengfy` domain.
   - Clients sign up/login once; the subdomains trust the central identity via shared cookies (`.zengfy`) and JWTs.
   - Access control is enforced by `org_role` claims used across subdomains (e.g., school admin, ecommerce seller, habit user).

3. **Subdomain Micro-products**
   - Each subdomain (e.g., `ecommerce`, `school`, `pos`, `hotel`, `watch`, `journal`, `civil`, `law`, `habits`, `smartai`, `accounts`) is a Laravel module deployed on the same infrastructure with route prefixes or separate API gateways.
   - Shared services: Payments (Bkash/Nagad), Notifications (Email/SMS), AI job queue (via Supervisor/Redis), Logging/Monitoring.
   - Each product ships with a dashboard, marketplace/storefront, and dedicated data tables that map back to the `account_id`.

4. **Billing & Subscription Plane**
   - The `accounts.zengfy` subdomain functions as the SaaS control center: plans, invoices, roles, and service-level entitlements.
   - Offers Tiers:
     - Free tier: access to ecommerce demo dashboard + marketing content.
     - Paid tier: unlocks specific subdomain modules, custom dashboards, premium support, and watch store whitelist access.

5. **Infrastructure & Operations**
   - Deploy on owned BD datacenter with Litespeed, CloudLinux, NVMe, Imunify360, DDoS protection, daily backups, and multi-zone BDIX peering as described in the server spec.
   - CDN/edge caching for marketing assets; dynamic APIs served via PHP-FPM, queue workers process AI/mail/SMS jobs.
   - Monitoring: use uptime + logging to reason about SLA and 99.9% uptime guarantee.

## Architectural Patterns

- **Modular Monolith (Hybrid Microservices)**: Laravel modules per service share code yet retain service-specific controllers/views.
- **Domain-Driven Design**: Each service bounded context (Ecommerce, School, POS, Habit) maintains its own aggregate roots (Product, Student, Inventory, HabitSession).
- **Event-Driven Workflows**: User actions (order placed, student registered) emit events consumed by AI jobs, notification services, and analytics dashboards.
- **Security-by-Design**: Encrypted data-at-rest, TLS1.3, centralized IAM for role assertions, WAF rules in front of each domain.

## Routing Snapshot

| Subdomain | Purpose | Sample Path |
|-----------|---------|-------------|
| `zengfy.top` | Marketing + signup/login | `/`, `/team`, `/services`, `/signup` |
| `accounts.zengfy.top` | SaaS account, billing, entitlements | `/billing`, `/subscriptions`, `/roles` |
| `ecommerce.zengfy.top` | Ecommerce SaaS shop front and management | `/store`, `/products`, `/order` |
| `school.zengfy.top` | School ERP workflow | `/dashboard`, `/students`, `/teachers` |
| `watch.zengfy.top` | Curated watch boutique | `/showroom`, `/preorder`, `/vip` |
| `pos.zengfy.top` | Retail POS POS | `/terminal`, `/inventory` |
| `hotel.zengfy.top` | Hotel management | `/reservations`, `/staff` |
| `civil.zengfy.top` | Civil construction ERP | `/projects`, `/materials` |
| `law.zengfy.top` | Legal workflow | `/cases`, `/schedules` |
| `journal.zengfy.top` | Publish CMS | `/articles`, `/pricing` |
| `habits.zengfy.top` | Habit tracking | `/sessions`, `/insights` |
| `smartai.zengfy.top` | AI calendar | `/sync`, `/reminders` |

## Delivery Considerations

- **API Gateway** routes traffic to the proper module/subdomain and injects headers for `account_id`.
- **Shared Component Library**: Tailwind/Tailwind UI-based component set reused across marketing, SaaS dashboards, and sub-domain navbars.
- **Mega Menu & Sticky Header**: Present on each product page with 5 actions including play button (audio snippet), home, team, contact, signup.
