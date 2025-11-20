# Zengfy Strategic Workflows

As CEO-level thinking, we treat Zengfy as a fully orchestrated experience. This document captures the major workflows customers and internal teams follow.

## 1. Guest Journey (Landing → Signup)

1. **Landing Page** (`zengfy.top`)
   - Visitor lands; the mega menu highlights services, the hero explains the hybrid SaaS nature, and the sticky header exposes five CTAs (Home, Team, Play, Contact, Signup).
   - “Play” button runs short curated music to differentiate the brand.
   - Navigation offers subdomain teasers (Ecommerce, Watch Store, School, AI calendar).
2. **Explore Subdomain Demos**
   - Each service has a static demo page (e.g., `ecommerce.zengfy.top/demo`) showcasing UI: fixed nav with Home, Messages, Play button, Orders, Account.
   - CTA on demo: “Sign up to unlock this service.”
3. **Signup Flow**
   - Guest registers via landing page; system creates a central `account`.
   - The SSO token then redirects to `ecommerce.zengfy.top` (primary service) showing a free dashboard with limited features.
   - Email verification unlocks the Ecommerce dashboard while showing locked tiles for other services.
4. **Post-Login UX**
   - Always redirect logged-in users to their ecommerce dashboard.
   - Use a global shared header (mega menu) linking to all services; purchase buttons open modals explaining paid tiers.
   - “Logout” returns to marketing landing page.

## 2. Subscription & Access Workflow

1. **Entitlement Management**
   - Users pick service(s) via `accounts.zengfy` (billing portal) or from CTAs within any subdomain.
   - Payment gateway handles Bkash/Nagad; upon success `subscriptions` table records service access.
   - `entitlements` JSON streamlines feature flags per service.
2. **Service Activation**
   - When `subscription.status = active`, the service module listens for event and enables dashboards, API routes, and nav links.
   - For premium watch store, the user receives curated invitations (preorder) via `notifications`.
3. **Cross-Service Switching**
   - Once purchased, header `mega menu` uses the SSO token to transition seamlessly.
   - Sessions obey `allowed_services` claim to show/hide menu items.

## 3. Service Operations (e.g., School ERP)

1. **Profile Setup**
   - School owner provisions roles (owner, accountant, IT, teacher, student, parent) in the admin dashboard.
   - Each role receives a personalized dashboard with modules (attendance, results, finance).
2. **Daily Activities**
   - Teachers publish notes/test templates; parents access via their login.
   - Accountants track admissions, fees, expenses; platform emits alerts for dues.
3. **AI Assistance**
   - Habit tracking and AI calendar use scheduled cron jobs to analyze data, predict sales, and prepare SMS/email reminders.
   - AI email/SMS assistant listens to inbox to auto create calendar events and reminders.

## 4. Product-House Operations

1. **Content & Play Button**
   - Marketing team updates copies/images for each service; the Play button uses curated tracks.
   - QA ensures cross-platform nav is fixed for home, messages, play, orders, account.
2. **Product Launch Sequence**
   - Team sync (CEO + product) defines service-level requirements and updates docs/architecture.
   - DevOps ensures each subdomain deployment uses identical stack (PHP 8+, Laravel, Tailwind) with incremental DB migrations.

## 5. Internal Execution Checklist

| Area | Outcome |
|------|---------|
| Documentation | All architecture, database, and workflow docs live in `docs/`. |
| Monitoring | Use uptime & Imunify360 metrics for security/SLA (99.9%). |
| Customer Support | Tickets escalate via `support@zengfy.top`; maintain knowledge base per service. |
| Growth | Track conversions from landing → signup → premium via analytics dashboards. |

These workflows align with large SaaS firms: clear marketing funnel, unified account plane, modular service releases, and recorded operating procedures.
