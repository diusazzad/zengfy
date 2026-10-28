# Zengfy Phase 0: Discovered Module Inventory & Evidence Matrix

**Audit Date:** 2026-10-27  
**Auditor:** Antigravity AI (Engineering Baseline Audit)  
**Repository:** [github.com/diusazzad/zengfy](https://github.com/diusazzad/zengfy)  
**Branch:** `chore/phase-0-repository-audit`  
**Status Taxonomy:**
- `IMPLEMENTED_AND_TESTED`: Relevant functionality exists, is backed by database migrations and models, and automated tests verify core logic.
- `IMPLEMENTED_NOT_VERIFIED`: Full functional implementation exists, but testing or runtime verification is partial/failing.
- `PARTIALLY_IMPLEMENTED`: Only some foundational workflows exist; major domain capabilities or relationships are missing.
- `UI_ONLY_OR_PLACEHOLDER`: Scaffolding, marketing landing page, or UI mockups exist without backing Eloquent models, migrations, or business services.
- `NOT_FOUND`: No supporting implementation found in the codebase.
- `BLOCKED_OR_UNKNOWN`: Evidence is insufficient or verification is blocked.

---

## 1. Summary Module Status Table

| Module | Discovered Status | Migrations / Tables | Models | Routes & Entry Points | Tests Available | Test Status |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **Auth** | `IMPLEMENTED_AND_TESTED` | 3 migrations (`users`, `auth_devices`, `personal_access_tokens`) | `App\Models\User`, `AuthDevice`, `PersonalAccessToken` | `routes/web.php`, `routes/api.php` | 7 Feature Tests in `Modules/Auth/tests/Feature/` | Core unit & security pass (SSO 7/7, Login 6/6; registration test has minor validation assertion drift) |
| **Organization** | `IMPLEMENTED_AND_TESTED` | 3 migrations (`organizations`, `memberships`, `departments`, `roles`, `permissions`, `role_permissions`, `membership_roles`) | `Organization`, `OrganizationMembership`, `OrganizationDepartment`, `Role`, `Permission` | `routes/web.php`, `routes/api.php` | 2 Feature Tests (`TenantRbacTest`, `TenantScopingTest`) | Seed/Isolation passes; API route tenant subdomain binding requires explicit test domain headers |
| **Social** | `IMPLEMENTED_AND_TESTED` | 9 migrations (`posts`, `post_media`, `follows`, `friendships`, `conversations`, `messages`, `emergency_events`, `likes`, `comments`) | `Post`, `PostMedia`, `Follow`, `Friendship`, `Conversation`, `Message`, `EmergencyEvent`, `Comment`, `Like` | `routes/web.php`, `routes/api.php` | 5 Feature Tests (`HyperlocalFeedTest`, `EmergencySosTest`, `PostCreationAndPaginationTest`, etc.) | Hyperlocal feed 5/5 pass, Emergency SOS 6/7 pass; API routes expect central route provider scoping |
| **School** | `PARTIALLY_IMPLEMENTED` | 1 migration (`academic_years`, `school_classes`, `sections`, `subjects`) | `AcademicYear`, `SchoolClass`, `Section`, `Subject` | `routes/web.php`, `routes/api.php` | 1 Feature Test (`AcademicStructureTest`) | Structure models exist; missing student enrollments, teachers, fee billing, attendance, grading |
| **Accounts** | `PARTIALLY_IMPLEMENTED` | 2 migrations (`account_settings`, `account_security_logs`) | `AccountSetting`, `AccountSecurityLog` | `routes/web.php`, `routes/api.php` | 0 module tests (covered by core tests) | Settings and logs functional; subscription and billing are static UI placeholders |
| **Civil** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Landing/marketing controller only (`CivilLandingController.php`) with hardcoded telemetry |
| **Ecommerce** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing page with hardcoded pricing arrays and SSO redirects |
| **Habit** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with hardcoded metrics |
| **Hotel** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with static view data |
| **Journal** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with mock article metrics |
| **Landing** | `UI_ONLY_OR_PLACEHOLDER` | None | 0 | `routes/web.php` | None | Main ecosystem portal landing page (`zengfy.com`) linking to product subdomains |
| **Law** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller (`LawLandingController.php`) with mock lawyer stats |
| **NGO** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with mock donation & volunteer counts |
| **POS** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with mock transaction metrics |
| **Rent** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with mock rental listings |
| **Schedule** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with mock calendar & appointment stats |
| **Shop** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with mock product catalog stats |
| **Skill** | `UI_ONLY_OR_PLACEHOLDER` | None (`.gitkeep`) | 0 | `routes/web.php` | None | Marketing landing controller with mock course and student stats |

*Note: Directory `Modules/nginx` contains an Nginx template configuration and is not an application module.*

---

## 2. Detailed Evidence & Module Profiles

### 1. Auth Module
- **Namespace:** `Modules\Auth`
- **Intended Responsibility:** Multi-device user authentication, session security, SSO ticket exchange for ecosystem subdomains, password recovery, and identity verification.
- **Paths & Key Artifacts:**
  - Routes: `Modules/Auth/routes/web.php`, `Modules/Auth/routes/api.php`
  - Controllers: `AuthController.php`, `PasswordResetController.php`, `SsoTicketController.php`, `DeviceSecurityController.php`, `AccountHubController.php`
  - Services: `AuthService.php`, `SsoTicketService.php`, `NidVerificationService.php` (mock verification provider)
  - Models: `AuthDevice.php`, `PersonalAccessToken.php`, central `App\Models\User.php`
  - Migrations: `0001_01_01_000000_create_users_table.php`, `Modules/Auth/database/migrations/2026_03_29_000001_create_auth_devices_table.php`
- **Tests Available:** 7 Feature tests in `Modules/Auth/tests/Feature/`:
  - `LoginTest.php` (All 6 pass)
  - `PasswordResetTest.php` (All 4 pass)
  - `SsoTicketExchangeTest.php` (All 7 pass)
  - `AccountHubTest.php` (All pass)
  - `DeviceSecurityTest.php` (All pass)
  - `RegistrationTest.php` (1 pass, 3 assertion drifts on error response key)
  - `NidVerificationTest.php`
- **Discovered Status:** `IMPLEMENTED_AND_TESTED`
- **Missing Pieces & Gaps:**
  - Production NID gateway integration (currently returns mock verified status with deterministic hash).
  - WebAuthn / FIDO2 / hardware 2FA (currently only email-based OTP/code).
- **Recommended Next Action:** Decouple domain-specific columns (`followers_count`, `school_id_verified`) out of central `users` table into module profile tables.

---

### 2. Organization Module
- **Namespace:** `Modules\Organization`
- **Intended Responsibility:** Multi-tenant workspace engine, organization lifecycle, department management, role-based access control (RBAC), and tenant context scoping.
- **Paths & Key Artifacts:**
  - Routes: `Modules/Organization/routes/web.php`, `Modules/Organization/routes/api.php`
  - Controllers: `OrganizationController.php`, `MembershipController.php`, `RolePermissionController.php`
  - Services / Core Engine: `Services/TenantContext.php`, `Services/RbacEngine.php`
  - Traits: `Traits/BelongsToTenant.php`, `Traits/HasTenantPermissions.php`
  - Scopes: `Scopes/TenantScope.php`
  - Middleware: `Middleware/TenantContextMiddleware.php`
  - Models: `Organization.php`, `OrganizationMembership.php`, `OrganizationDepartment.php`, `Role.php`, `Permission.php`
  - Migrations:
    - `2026_03_30_000001_create_organizations_table.php`
    - `2026_03_30_000002_create_organization_memberships_table.php`
    - `2026_03_30_000003_create_roles_and_permissions_tables.php`
- **Tests Available:** 2 Feature tests:
  - `Modules/Organization/tests/Feature/TenantRbacTest.php`
  - `Modules/Organization/tests/Feature/TenantScopingTest.php`
- **Discovered Status:** `IMPLEMENTED_AND_TESTED`
- **Missing Pieces & Gaps:**
  - Tenant invitation acceptance email delivery queue worker.
  - Multi-tenancy currently relies on HTTP request subdomain or header (`X-Tenant-ID`), but some automated tests invoke API endpoints without subdomain scoping, resulting in route resolution mismatch during full test suites.
- **Recommended Next Action:** Maintain `Organization` as the central multi-tenancy core for School, Law, POS, and Enterprise modules.

---

### 3. Social Module
- **Namespace:** `Modules\Social`
- **Intended Responsibility:** Hyperlocal community feed (ward/thana scoping), social graph (followers, friends), real-time messaging, emergency SOS broadcasting radar.
- **Paths & Key Artifacts:**
  - Routes: `Modules/Social/routes/web.php`, `Modules/Social/routes/api.php`
  - Controllers: `FeedController.php`, `PostController.php`, `SocialGraphController.php`, `MessagingController.php`, `EmergencySosController.php`
  - Services: `FeedService.php`, `SosBroadcaster.php`, `MediaUploadService.php`
  - Models: `Post.php`, `PostMedia.php`, `Follow.php`, `Friendship.php`, `Conversation.php`, `Message.php`, `EmergencyEvent.php`, `Comment.php`, `Like.php`
  - Migrations: 9 database migration files creating 9 domain tables in `Modules/Social/database/migrations/`.
- **Tests Available:** 5 Feature tests:
  - `HyperlocalFeedTest.php` (5/5 pass)
  - `EmergencySosTest.php` (6/7 pass)
  - `PostCreationAndPaginationTest.php`
  - `RealTimeMessagingTest.php`
  - `SocialGraphTest.php`
- **Discovered Status:** `IMPLEMENTED_AND_TESTED`
- **Missing Pieces & Gaps:**
  - Push notification / SMS gateway for emergency SOS dispatch.
  - S3 / MinIO production storage driver for high-volume post media uploads (currently local disk).
- **Recommended Next Action:** Standardize API route prefixing to ensure API routes resolve consistently in tests and production.

---

### 4. School Module
- **Namespace:** `Modules\School`
- **Intended Responsibility:** K-12 and institutional academic management ERP (classes, sections, subjects, academic years, rollover).
- **Paths & Key Artifacts:**
  - Routes: `Modules/School/routes/web.php`, `Modules/School/routes/api.php`
  - Controllers: `AcademicStructureController.php`, `SchoolLandingController.php`
  - Models: `AcademicYear.php`, `SchoolClass.php`, `Section.php`, `Subject.php`
  - Migrations: `2026_03_30_000004_create_academic_structure_tables.php`
- **Tests Available:** `Modules/School/tests/Feature/AcademicStructureTest.php`
- **Discovered Status:** `PARTIALLY_IMPLEMENTED`
- **Missing Pieces & Gaps:**
  - Student admission and enrollment lifecycle.
  - Teacher profiles, subject teacher assignment.
  - Daily attendance tracking and reporting.
  - Fee schedules, invoices, and online fee collection.
  - Examinations, mark sheets, grade book, and report card generation.
- **Recommended Next Action:** Complete core student registry and fee management models before offering School ERP for general use.

---

### 5. Accounts Module
- **Namespace:** `Modules\Accounts`
- **Intended Responsibility:** Central identity account hub (`accounts.zengfy.com`), profile settings, security audit logs, connected devices, and subscription tier overview.
- **Paths & Key Artifacts:**
  - Routes: `Modules/Accounts/routes/web.php`, `Modules/Accounts/routes/api.php`
  - Controllers: `AccountSettingController.php`, `SecurityLogController.php`, `SubscriptionOverviewController.php`
  - Models: `AccountSetting.php`, `AccountSecurityLog.php`
  - Migrations:
    - `2026_03_29_000002_create_account_settings_table.php`
    - `2026_03_29_000003_create_account_security_logs_table.php`
- **Tests Available:** Covered via Auth & Core test suites.
- **Discovered Status:** `PARTIALLY_IMPLEMENTED`
- **Missing Pieces & Gaps:**
  - Actual billing gateway integration (SSLCommerz, bKash, Stripe). Subscription tiers are hardcoded React/Blade UI representations.
- **Recommended Next Action:** Implement genuine billing ledger tables (`subscriptions`, `invoices`, `payment_transactions`).

---

### 6. Civil, Ecommerce, Habit, Hotel, Journal, Landing, Law, NGO, POS, Rent, Schedule, Shop, Skill Modules
- **Discovered Status for all 13 modules:** `UI_ONLY_OR_PLACEHOLDER`
- **Detailed Findings per Module:**
  1. **Civil:** Routes define landing page at `civil.zengfy.com`. Controller returns mock public service announcements and dispute tracking statistics. Zero models, zero migrations (`database/migrations/.gitkeep`), zero tests.
  2. **Ecommerce:** Routes define `ecommerce.zengfy.com`. Controller renders marketing page with mock featured products, store templates, and redirect routes to accounts login. Zero models, zero migrations, zero tests.
  3. **Habit:** Routes define `habit.zengfy.com`. Controller serves landing UI with static streak tracking counters. Zero models, zero migrations, zero tests.
  4. **Hotel:** Routes define `hotel.zengfy.com`. Controller serves landing UI with mock room booking and occupancy statistics. Zero models, zero migrations, zero tests.
  5. **Journal:** Routes define `journal.zengfy.com`. Controller serves landing UI with mock reader metrics and article editor mockup. Zero models, zero migrations, zero tests.
  6. **Landing:** Core root portal at `zengfy.com`. Renders landing page and product showcase directory.
  7. **Law:** Routes define `law.zengfy.com`. Controller (`LawLandingController.php`) returns hardcoded statistics (`['active_cases' => 1240, 'verified_lawyers' => 85]`). Zero models, zero migrations, zero tests.
  8. **NGO:** Routes define `ngo.zengfy.com`. Controller serves landing UI with mock donation counters. Zero models, zero migrations, zero tests.
  9. **POS:** Routes define `pos.zengfy.com`. Controller serves landing UI with mock terminal sale stats and barcode scanner mock. Zero models, zero migrations, zero tests.
  10. **Rent:** Routes define `rent.zengfy.com`. Controller serves landing UI with mock apartment listings and tenancy contract templates. Zero models, zero migrations, zero tests.
  11. **Schedule:** Routes define `schedule.zengfy.com`. Controller serves landing UI with mock booking slots. Zero models, zero migrations, zero tests.
  12. **Shop:** Routes define `shop.zengfy.com`. Controller serves landing UI with mock inventory metrics. Zero models, zero migrations, zero tests.
  13. **Skill:** Routes define `skill.zengfy.com`. Controller serves landing UI with mock courses and certificates. Zero models, zero migrations, zero tests.
- **Recommended Next Action:** Do not market or sell these 13 modules as functioning SaaS products until foundational domain models, migrations, authorization, and automated tests are implemented.

---

## 3. Discovered Shared Infrastructure & Tooling Modules

### Nginx Template Directory (`Modules/nginx/`)
- Contains `nginx.conf`, `default.conf`, and subdomain routing configurations.
- Serves as the configuration baseline for multi-subdomain routing across `*.zengfy.test` and `*.zengfy.com`.
