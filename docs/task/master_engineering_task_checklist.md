# 📋 Zengfy 10M Engineering: Master Mission & Task Tracker
**Document ID:** `TASK-MASTER-001`  
**Governing Standard:** `CONST-001 (Engineering Constitution)` & `ARCH-002 (API Architecture Blueprint)`  
**Status:** `ACTIVE / LIVING ROADMAP`  
**Location:** `docs/task/master_engineering_task_checklist.md`

---

## 🎯 How to Use This Master Checklist

This tracker is designed as an **interactive masterclass roadmap** for the founder and AI autonomous agents. 

Every task is an **Engineering Mission** that details:
1. **Status:** `[x]` for Verified Production-Ready, `[ ]` for Upcoming.
2. **Core Concepts:** The computer science and systems architecture theory behind it.
3. **Why It Matters:** The real-world business and scaling problem it solves.
4. **Artifacts & Proof:** Verified terminal evidence, code files, and test results.

---

## 🗺️ High-Level Mission Roadmap

```
Phase 0: Engineering Foundation & Constitution ─────────────► [DONE: 100%]
Phase 1: Local Production-Grade Infrastructure ──────────────► [DONE: 100%]
Phase 2: Central Identity & Unified Single Sign-On (SSO) ────► [DONE: 100%]
Phase 3: Multi-Tenant Organization & Granular RBAC ──────────► [DONE: 100%]
Phase 4: Consumer Social Media & Hyperlocal Feeds ───────────► [IN PROGRESS - TASK-013 DONE]
Phase 5: Real-Time Messaging & Emergency SOS Danger Alert ───► [PLANNED]
Phase 6: Enterprise SaaS Workspaces (School ERP) ────────────► [PLANNED]
Phase 7: B2B Subscription Billing & Local Payment Gateways ──► [PLANNED]
Phase 8: Production Observability, CI/CD & Chaos Testing ────► [PLANNED]
```

> [!NOTE]
> **Multi-Agent Dual-Engine Collaboration Active:**  
> Development is now distributed between **Agent 1 (Antigravity IDE Lead - Core Architecture & Backend)** and **Agent 2 (Zed Editor Extension - Frontend & UI Engineering)**.  
> Live Coordination Board: [`docs/antigravity/multi-agent/INDEX.md`](file:///p:/Zengfy-Ecosystem/core/docs/antigravity/multi-agent/INDEX.md)  
> Active Chat Thread: [`docs/antigravity/multi-agent/chat/THREAD-001-AUTH-AND-SOCIAL-UI.md`](file:///p:/Zengfy-Ecosystem/core/docs/antigravity/multi-agent/chat/THREAD-001-AUTH-AND-SOCIAL-UI.md)  
> Latest Frontend & SSO Modernization Roadmap: [`docs/task/2026-10-06-frontend-modernization-and-sso-architecture.md`](file:///p:/Zengfy-Ecosystem/core/docs/task/2026-10-06-frontend-modernization-and-sso-architecture.md)

---

# 🏛️ PHASE 0: Engineering Foundation & Constitution

### [x] TASK-001: Supreme Engineering Constitution & ADR-001
- **Status:** 🟢 **COMPLETED & ACCEPTED**
- **Artifacts:** 
  - [`docs/architecture/00_architecture_principles.md`](file:///p:/Zengfy-Ecosystem/core/docs/architecture/00_architecture_principles.md)
  - [`docs/architecture/adr/ADR-001-modular-monolith-first.md`](file:///p:/Zengfy-Ecosystem/core/docs/architecture/adr/ADR-001-modular-monolith-first.md)
- **Core Concepts Learned:**
  - *Modular Monolith First:* Avoiding the distributed monolith anti-pattern and premature microservices complexity.
  - *Hard Invariant (Data Ownership):* A domain must NEVER directly query or write another domain's database tables. Cross-module communication happens exclusively via In-Process Service Contracts or Domain Events.
  - *AI Agent Governance:* Strict rules forbidding AI agents from inventing ad-hoc APIs or bypassing security policies.
- **Why It Matters:** Without a constitution, a team of developers and AI agents will inevitably turn the codebase into unmaintainable "spaghetti code" within 6 months.

---

### [x] TASK-002: Canonical Resource Model & 36-Section API Architecture Blueprint
- **Status:** 🟢 **COMPLETED & ACCEPTED**
- **Artifacts:**
  - [`docs/architecture/01_api_architecture_blueprint.md`](file:///p:/Zengfy-Ecosystem/core/docs/architecture/01_api_architecture_blueprint.md)
- **Core Concepts Learned:**
  - *Canonical Resource Modeling:* Mapping all 26 core entities (`Identity`, `Profile`, `Organization`, `Membership`, `Post`, `EmergencyEvent`, `SchoolStudent`, etc.) with strict ownership boundaries.
  - *Universal Multi-Tenancy:* `Identity -> Organization -> Membership -> Role -> SaaS Modules`.
  - *Cursor-Based Pagination:* Why `offset` pagination fails at 10M rows and how cursor tokens ensure sub-50ms feed latency.
- **Why It Matters:** Gives every future AI agent an exact, human- and machine-readable specification so no API contracts are ever guessed or broken.

---

### [x] TASK-003: OpenAPI 3.1 Contract Specification & Standardized Response DTOs
- **Status:** 🟢 **COMPLETED & ACCEPTED**
- **Artifacts:**
  - [`app/Http/Responses/ApiResponse.php`](file:///p:/Zengfy-Ecosystem/core/app/Http/Responses/ApiResponse.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Contract-First Development:* Defining the API schema before writing the controller logic.
  - *Typed Response Envelopes:* Standardizing `{ success, message, data, meta: { request_id, timestamp } }` and deterministic error codes (`VALIDATION_ERROR`, `UNAUTHORIZED`, `RATE_LIMITED`).
  - *Metadata Traceability:* Generating unique microsecond-precision `req_...` UUIDs for end-to-end distributed tracing across microservices and mobile clients.
- **Why It Matters:** Allows frontend mobile (Flutter) and web (Next.js) developers to build UI with mock data in parallel without waiting for backend implementation.

---

# 🐳 PHASE 1: Local Production-Grade Infrastructure

### [x] TASK-004: Multi-Container Docker Cluster Setup
- **Status:** 🟢 **COMPLETED & VERIFIED IN DOCKER**
- **Artifacts:**
  - [`docker-compose.yml`](file:///p:/Zengfy-Ecosystem/core/docker-compose.yml)
  - [`Dockerfile`](file:///p:/Zengfy-Ecosystem/core/Dockerfile) (PHP 8.4 Alpine)
  - [`nginx/nginx.conf`](file:///p:/Zengfy-Ecosystem/core/nginx/nginx.conf)
- **Core Concepts Learned:**
  - *Reverse Proxy & Round-Robin Load Balancing:* Nginx listening on port 7000, forwarding traffic evenly across 3 Laravel containers (`app1:8001`, `app2:8002`, `app3:8003`).
  - *Container Networking & Port Mapping:* MySQL on internal 3306 (mapped to host 3307 to prevent Windows collisions), Redis on 6379.
  - *Stateless Workers:* All containers execute identically with central Redis holding shared cache and sessions.
- **Why It Matters:** Eliminates the "Works on my machine" problem and gives us a $10,000 cloud infrastructure cluster running for free on your laptop.

---

### [x] TASK-005: Automated Feature Test Suite & Database Isolation
- **Status:** 🟢 **COMPLETED & 100% PASSING**
- **Artifacts:**
  - [`Modules/Auth/tests/Feature/RegistrationTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/tests/Feature/RegistrationTest.php)
  - [`phpunit.xml`](file:///p:/Zengfy-Ecosystem/core/phpunit.xml)
- **Core Concepts Learned:**
  - *In-Memory SQLite Testing:* Fast test execution without polluting the MySQL database.
  - *Idempotency Replay Verification:* Proving that sending the same `X-Idempotency-Key` returns the cached 200 OK without inserting a duplicate user.
  - *Rate Limiting Assertion:* Automated assertion verifying that the 6th request is blocked with HTTP 429 Too Many Requests.
- **Why It Matters:** Guarantees that future refactoring by AI agents will never accidentally break core registration or security features.

---

### [x] TASK-006: Locust Concurrency Load Testing & Bot Army Simulation
- **Status:** 🟢 **COMPLETED & VERIFIED ON PORT 7000**
- **Artifacts:**
  - [`tests/load_testing/locustfile.py`](file:///p:/Zengfy-Ecosystem/core/tests/load_testing/locustfile.py)
  - Screenshots: Locust Dashboard on `http://localhost:8089/`
- **Core Concepts Learned:**
  - *High-Concurrency Simulation:* Swarming the Docker cluster with 250+ simultaneous virtual users.
  - *DDoS Attack Simulation:* Simulating bots making rapid-fire registration requests and verifying that Nginx and Laravel throttle them automatically.
- **Why It Matters:** Benchmarking before deployment proves that the system will not crash when real users rush into the platform on launch day.

---

# 🔑 PHASE 2: Central Identity & Unified Single Sign-On (SSO)

### [x] TASK-007: Enterprise Login & Multi-Device Session Engine
- **Status:** 🟢 **COMPLETED & 100% PASSING (6/6 Tests)**
- **Artifacts:**
  - [`Modules/Auth/app/Http/Controllers/AuthController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Http/Controllers/AuthController.php)
  - [`Modules/Auth/app/Models/AuthDevice.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Models/AuthDevice.php)
  - [`Modules/Auth/database/migrations/2026_09_23_000001_create_auth_devices_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/database/migrations/2026_09_23_000001_create_auth_devices_table.php)
  - [`Modules/Auth/tests/Feature/LoginTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/tests/Feature/LoginTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
- **Core Concepts Learned:**
  - *Universal UUID Primary Keys:* Enforcing strict UUIDv4/v7 across `users`, `auth_devices`, and Sanctum polymorphic relations.
  - *Multi-Device Session Tracking:* Automatic capture of IP address, User-Agent device classification, and activity timestamps in `auth_devices`.
  - *Single & Global Session Revocation:* Revoking current access token on single logout (`/api/v1/auth/logout`) and purging all active tokens and device entries on global logout (`/api/v1/auth/logout-all`).
  - *Active Session Inspection:* Exposing authenticated profile and active session device history on `/api/v1/auth/me`.
  - *Rate Limiting / Brute-Force Shield:* Enforcing 5 login requests per minute throttle on `/api/v1/auth/login`.
- **Why It Matters:** Prevents account takeover, tracks active devices, and provides enterprise-grade security.

---

### [x] TASK-008: Cross-Subdomain SSO Ticket Exchange Gateway
- **Status:** 🟢 **COMPLETED & 100% PASSING (7/7 Tests)**
- **Artifacts:**
  - [`Modules/Auth/app/Http/Controllers/SsoController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Http/Controllers/SsoController.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
  - [`Modules/Auth/tests/Feature/SsoTicketExchangeTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/tests/Feature/SsoTicketExchangeTest.php)
- **Core Concepts Learned:**
  - *Third-Party Cookie Blocking Defense:* Overcoming Safari/Chrome ITP restrictions where cookies on `zengfy.top` cannot be shared across separated client origins (`school.zengfy.top`).
  - *Short-Lived Single-Use Cryptographic Ticket Exchange:* Central Auth generates high-entropy `sso_tkt_...` tokens with a strict 60-second TTL.
  - *Atomic Single-Use Replay Defense:* Utilizing atomic `Cache::pull` during ticket exchange so every ticket is permanently dead upon first redemption, eliminating replay attacks.
  - *Subdomain Spoofing Prevention:* Enforcing ecosystem domain whitelisting and verifying that the ticket's registered `target_subdomain` matches the calling client application.
  - *Subdomain-Scoped Session Tokens:* Issuing scoped Sanctum tokens (`school:*`, `pos:*`) and tracking distinct active device sessions per portal.
- **Why It Matters:** Users log in ONCE on `zengfy.top` and seamlessly move between Social, School, Law, and POS without ever re-entering their password or exposing credentials.

---

### [x] TASK-009: Brute-Force Defense & Redis Lockout Engine
- **Status:** 🟢 **COMPLETED & 100% PASSING (7/7 Tests)**
- **Artifacts:**
  - [`Modules/Auth/app/Services/BruteForceProtectionService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Services/BruteForceProtectionService.php)
  - [`Modules/Auth/app/Events/AccountLockoutTriggered.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Events/AccountLockoutTriggered.php)
  - [`app/Http/Responses/ApiResponse.php`](file:///p:/Zengfy-Ecosystem/core/app/Http/Responses/ApiResponse.php)
  - [`Modules/Auth/app/Http/Controllers/AuthController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Http/Controllers/AuthController.php)
  - [`Modules/Auth/tests/Feature/BruteForceLockoutTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/tests/Feature/BruteForceLockoutTest.php)
- **Core Concepts Learned:**
  - *Dual-Key Rate Limiting:* Separating Client IP tracking (`auth:attempts:ip:{ip}`) from Target Account tracking (`auth:attempts:email:{sha256}`) to neutralize distributed botnets and rotating proxy assaults.
  - *Multi-Tier Exponential Backoff:* Tier 1 (5 attempts) triggers 60s cooldown; Tier 2 (10 attempts) triggers 15-minute (900s) extended security lockout.
  - *Assault Escalation without Bcrypt Exhaustion:* Continued hammering during cooldown escalates to Tier 2 without computing expensive `Hash::check()` hashes, protecting server CPU from bcrypt DoS exhaustion.
  - *Atomic Cache Eviction on Success:* Valid credentials immediately clear failed attempt counters so legitimate citizens are never penalized.
  - *RFC 6585 Compliance:* Returning HTTP `Retry-After: {seconds}` header and typed metadata for frontend countdown timers.
  - *Security Alerting:* Dispatching `AccountLockoutTriggered` domain event on Tier 2 lockouts.
- **Why It Matters:** Protects millions of citizen accounts from automated password guessing attacks and credential stuffing botnets.

---

### [x] TASK-010: National ID (NID) Verification & AES-256 PII Encryption
- **Status:** 🟢 **COMPLETED & 100% PASSING (8/8 Tests)**
- **Artifacts:**
  - [`Modules/Auth/database/migrations/2026_09_23_000002_add_nid_fields_and_encryption_to_users_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/database/migrations/2026_09_23_000002_add_nid_fields_and_encryption_to_users_table.php)
  - [`app/Models/User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php)
  - [`Modules/Auth/app/Contracts/NidVerificationGatewayInterface.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Contracts/NidVerificationGatewayInterface.php)
  - [`Modules/Auth/app/Services/MockElectionCommissionNidGateway.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Services/MockElectionCommissionNidGateway.php)
  - [`Modules/Auth/app/Events/NidVerified.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Events/NidVerified.php)
  - [`Modules/Auth/app/Http/Controllers/NidVerificationController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Http/Controllers/NidVerificationController.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
  - [`Modules/Auth/tests/Feature/NidVerificationTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/tests/Feature/NidVerificationTest.php)
- **Core Concepts Learned:**
  - *PII Encryption at Rest (AES-256-CBC):* Using Laravel's `'encrypted'` Eloquent casting so NID numbers are never stored in plaintext in MySQL/SQLite, shielding citizens even in the event of a database leak.
  - *The Cryptographic Blind Index Pattern:* Overcoming the AES initialization vector (IV) uniqueness limitation by creating a deterministic HMAC-SHA256 blind index (`nid_hash`) with a database unique constraint to prevent duplicate NID fraud across multiple accounts in $O(1)$ time.
  - *Government NID Gateway Sandbox:* Clean interface abstraction (`NidVerificationGatewayInterface`) and realistic mock simulating the Bangladesh Election Commission registry with format validation and test case triggers (`999...` for not found, `888...` for downtime).
  - *Verified Blue Badge & Masked Identifiers:* Automated verification updates `verified_badge = true` and exposes masked strings (`******7890`) for secure UI display.
  - *Audit Domain Events:* Dispatched `NidVerified` event upon citizen verification for downstream loyalty badges, notification triggers, and trust scoring.
- **Why It Matters:** Eliminates fake profiles, online scams, and establishes Zengfy as Bangladesh’s most trusted, accountable digital platform.

---

# 🏢 PHASE 3: Multi-Tenant Organization & Granular RBAC [DONE: 100%]

### [x] TASK-011: Multi-Tenant Scoping & Organization Model
- **Status:** 🟢 **COMPLETED & 100% PASSING (9/9 Tests)**
- **Artifacts:**
  - [`Modules/Organization/app/Models/Organization.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/Organization.php)
  - [`Modules/Organization/app/Models/OrganizationMembership.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/OrganizationMembership.php)
  - [`Modules/Organization/app/Models/OrganizationDepartment.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/OrganizationDepartment.php)
  - [`Modules/Organization/app/Services/TenantContext.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Services/TenantContext.php)
  - [`Modules/Organization/app/Scopes/TenantScope.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Scopes/TenantScope.php)
  - [`Modules/Organization/app/Traits/BelongsToTenant.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Traits/BelongsToTenant.php)
  - [`Modules/Organization/app/Http/Middleware/ResolveTenantContext.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Http/Middleware/ResolveTenantContext.php)
  - [`Modules/Organization/app/Http/Controllers/OrganizationController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Http/Controllers/OrganizationController.php)
  - [`Modules/Organization/app/Http/Controllers/OrganizationDepartmentController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Http/Controllers/OrganizationDepartmentController.php)
  - [`Modules/Organization/database/migrations/2026_09_23_000010_create_organizations_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/database/migrations/2026_09_23_000010_create_organizations_table.php)
  - [`Modules/Organization/database/migrations/2026_09_23_000011_create_organization_memberships_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/database/migrations/2026_09_23_000011_create_organization_memberships_table.php)
  - [`Modules/Organization/database/migrations/2026_09_23_000012_create_organization_departments_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/database/migrations/2026_09_23_000012_create_organization_departments_table.php)
  - [`Modules/Organization/tests/Feature/TenantScopingTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/tests/Feature/TenantScopingTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Shared-Database Soft-Partitioning with Global Scoping:* Eliminating cross-tenant data leakage by enforcing `TenantScope` at the Eloquent ORM level—even if developers forget `where('organization_id')`, queries are automatically isolated.
  - *Tenant Resource Auto-Stamping:* Using the `BelongsToTenant` trait's `creating` lifecycle hook to automatically bind new records to the active tenant's UUID without manual parameter passing.
  - *Zero-Trust Tenant Resolution:* Enforcing `ResolveTenantContext` middleware that verifies user membership on every request, blocking non-members with HTTP 403 Forbidden.
  - *BOLA / IDOR Immunity:* Attempting to access another organization's resource directly returns HTTP 404 Not Found because the global tenant scope transparently filters it out of the query space.
  - *Administrative Escape Hatch:* Safe execution of cross-tenant aggregate analytics or system migrations via `TenantContext::runWithoutTenantScope()`.
- **Why It Matters:** Guarantees absolute data privacy and security across all B2B verticals (Schools, Law, Hospitals, Retail) on Zengfy.

---

### [x] TASK-012: Granular Role-Based Access Control (RBAC Engine)
- **Status:** 🟢 **COMPLETED & 100% PASSING (9/9 Tests)**
- **Artifacts:**
  - [`Modules/Organization/app/Models/Permission.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/Permission.php)
  - [`Modules/Organization/app/Models/Role.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/Role.php)
  - [`Modules/Organization/app/Models/OrganizationMembership.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/OrganizationMembership.php)
  - [`Modules/Organization/app/Services/RbacEngine.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Services/RbacEngine.php)
  - [`Modules/Organization/app/Traits/HasTenantPermissions.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Traits/HasTenantPermissions.php)
  - [`Modules/Organization/app/Http/Middleware/RequireTenantPermission.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Http/Middleware/RequireTenantPermission.php)
  - [`Modules/Organization/app/Http/Controllers/RoleController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Http/Controllers/RoleController.php)
  - [`Modules/Organization/database/migrations/2026_09_23_000020_create_roles_and_permissions_tables.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/database/migrations/2026_09_23_000020_create_roles_and_permissions_tables.php)
  - [`Modules/Organization/database/seeders/OrganizationRbacSeeder.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/database/seeders/OrganizationRbacSeeder.php)
  - [`Modules/Organization/tests/Feature/TenantRbacTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/tests/Feature/TenantRbacTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Decoupling Roles from Permissions:* Permissions are atomic capability strings (`departments.manage`, `attendance.mark`, `finance.view_ledger`), while roles are dynamic permission bundles. Code checks permissions, never hardcoded role strings.
  - *Multi-Tenant IAM Scoping:* Roles are scoped per organization; a user who is Principal in School A has zero elevated privileges in School B.
  - *Zero-Latency Permission Caching (`RbacEngine`):* $O(1)$ fast permission evaluation via in-memory and Redis cache without multi-table SQL JOIN bottlenecks on every HTTP request.
  - *Superadmin Wildcard Bypass:* The organization `owner` holds `*` wildcard access, eliminating administrative lockout while non-owners are strictly checked against assigned roles.
  - *Zero-Trust Permission Middleware:* Intercepting requests and halting unauthorized actions with HTTP 403 Forbidden.
- **Why It Matters:** Guarantees that teachers cannot view school financial ledgers and students cannot alter their own exam grades.

---

# 📱 PHASE 4: Consumer Social Media & Hyperlocal Feeds [DONE: 100%]

### [x] TASK-013: User Profiles & Follow/Friendship Graph
- **Status:** 🟢 **COMPLETED & 100% PASSING (11/11 Tests)**
- **Artifacts:**
  - [`Modules/Social/database/migrations/2026_09_23_000030_add_social_profile_fields_to_users_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000030_add_social_profile_fields_to_users_table.php)
  - [`Modules/Social/database/migrations/2026_09_23_000031_create_follows_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000031_create_follows_table.php)
  - [`Modules/Social/database/migrations/2026_09_23_000032_create_friendships_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000032_create_friendships_table.php)
  - [`Modules/Social/app/Models/Follow.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/Follow.php)
  - [`Modules/Social/app/Models/Friendship.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/Friendship.php)
  - [`Modules/Social/app/Services/SocialGraphService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/SocialGraphService.php)
  - [`Modules/Social/app/Traits/HasSocialGraph.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Traits/HasSocialGraph.php)
  - [`app/Models/User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php)
  - [`Modules/Social/app/Http/Controllers/ProfileController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/ProfileController.php)
  - [`Modules/Social/app/Http/Controllers/FollowController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/FollowController.php)
  - [`Modules/Social/app/Http/Controllers/FriendshipController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/FriendshipController.php)
  - [`Modules/Social/tests/Feature/SocialGraphTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/SocialGraphTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Bidirectional vs Unidirectional Graphs:* Supporting one-way creator/celebrity follow graphs alongside mutual friend networks with a formal state machine (`pending` -> `accepted`, `declined`, `blocked`).
  - *Cache Layering with Redis Atomic Counters ($O(1)$):* Completely bypassing slow `COUNT(*)` SQL table scans by maintaining atomic Redis counters (`user:{id}:followers_count`) synchronized with persistent database counter columns.
  - *Universal UUID Graph Invariants:* Using strict UUID primary keys and foreign keys with cascading integrity across all graph edge tables.
  - *Hyperlocal Spatial Profile Hierarchy:* Capturing `ward_code`, `thana_code`, and `district_code` to power neighborhood feeds and community geo-fencing.
  - *Sanitized Handles & Privacy Controls:* Dynamic handle cleansing (`@` prefix trimming), unique handle reservation, and public/private profile state tracking.
- **Why It Matters:** Forms the foundational social fabric connecting 10,000,000+ citizens across Bangladesh.

---

### [x] TASK-014: Post Creation, Media Attachments & Cursor Pagination
- **Status:** 🟢 **COMPLETED & 100% PASSING (10/10 Tests)**
- **Artifacts:**
  - [`Modules/Social/database/migrations/2026_09_23_000033_create_posts_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000033_create_posts_table.php)
  - [`Modules/Social/database/migrations/2026_09_23_000034_create_post_media_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000034_create_post_media_table.php)
  - [`Modules/Social/app/Models/Post.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/Post.php)
  - [`Modules/Social/app/Models/PostMedia.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/PostMedia.php)
  - [`Modules/Social/app/Services/MediaStorageService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/MediaStorageService.php)
  - [`Modules/Social/app/Services/PostService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/PostService.php)
  - [`Modules/Social/app/Http/Controllers/MediaController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/MediaController.php)
  - [`Modules/Social/app/Http/Controllers/PostController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/PostController.php)
  - [`Modules/Social/tests/Feature/PostCreationAndPaginationTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/PostCreationAndPaginationTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Keyset / Cursor-Based Infinite Scrolling ($O(1)$ Scale):* Eliminating high-offset performance degradation and pagination drift via composite indexes `['created_at', 'id']` and Laravel cursor pagination (`CursorPaginator`).
  - *Direct-to-Storage Presigned Uploads:* Offloading heavy image/video binary streams directly to S3/MinIO via presigned URLs and temporary signed fallback routes, preventing web worker exhaustion.
  - *Granular Feed Visibility Scoping:* Strict multi-layer visibility engine enforcing `public`, `friends_only` (bidirectional friendship verification), and `private` author-only isolation.
  - *Hyperlocal Boundary Tagging:* Auto-inheriting geographic ward/thana metadata onto posts for instant neighborhood community feed aggregation.
- **Why It Matters:** Gives Zengfy the architectural foundation to serve high-concurrency infinite feeds to millions of simultaneous Bangladeshi users without database bottlenecks.

---

### [x] TASK-015: Hyperlocal Ward-Level News Feed & Geo-Fencing
- **Status:** 🟢 **COMPLETED & 100% PASSING (5/5 Tests)**
- **Artifacts:**
  - [`Modules/Social/app/Services/HyperlocalFeedService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/HyperlocalFeedService.php)
  - [`Modules/Social/app/Http/Controllers/HyperlocalController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/HyperlocalController.php)
  - [`Modules/Social/tests/Feature/HyperlocalFeedTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/HyperlocalFeedTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Spatial Hierarchy & Progressive Expansion:* Prioritizing precise neighborhood ward feeds (`ward_code`), with seamless automatic fallback to the broader thana (`thana_code`) when a ward feed has sparse activity.
  - *Emergency & Civic Notice Geo-Fencing:* Dedicated notice extraction endpoints isolating critical announcements (`announcement`, `hyperlocal_notice`) such as city corporation alerts, water outages, and Dengue prevention drives.
  - *Cached Neighborhood Pulse Metrics:* Sub-millisecond aggregation of community activity (total posts, civic notice alerts, active neighbors count) backed by in-memory caching.
- **Why It Matters:** Bridges digital social interaction directly to grassroots civic governance and physical neighborhood communities across 4,500+ union parishads and city corporation wards in Bangladesh.

---

# 🆘 PHASE 5: Real-Time Messaging & Emergency SOS Danger Alert

### [x] TASK-016: Real-Time WebSocket Gateway (Laravel Reverb)
- **Status:** 🟢 **COMPLETED & 100% PASSING (9/9 Tests)**
- **Artifacts:**
  - [`config/broadcasting.php`](file:///p:/Zengfy-Ecosystem/core/config/broadcasting.php)
  - [`config/reverb.php`](file:///p:/Zengfy-Ecosystem/core/config/reverb.php)
  - [`routes/channels.php`](file:///p:/Zengfy-Ecosystem/core/routes/channels.php)
  - [`bootstrap/app.php`](file:///p:/Zengfy-Ecosystem/core/bootstrap/app.php)
  - [`Modules/Social/database/migrations/2026_09_23_000035_create_conversations_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000035_create_conversations_table.php)
  - [`Modules/Social/app/Models/Conversation.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/Conversation.php)
  - [`Modules/Social/app/Models/ConversationParticipant.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/ConversationParticipant.php)
  - [`Modules/Social/app/Models/Message.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/Message.php)
  - [`Modules/Social/app/Events/MessageSent.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Events/MessageSent.php)
  - [`Modules/Social/app/Events/UserTyping.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Events/UserTyping.php)
  - [`Modules/Social/app/Services/MessagingService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/MessagingService.php)
  - [`Modules/Social/app/Http/Controllers/ConversationController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/ConversationController.php)
  - [`Modules/Social/tests/Feature/RealTimeMessagingTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/RealTimeMessagingTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *High-Performance WebSocket Infrastructure (Laravel Reverb):* Leveraging persistent asynchronous event loops (ReactPHP under the hood) capable of maintaining 100,000+ concurrent open TCP socket connections with sub-10ms broadcast latency.
  - *Strict Channel Authorization & Multi-Tenant Security:* Universal UUID authentication on `/broadcasting/auth` protecting private conversations (`chat.{id}`), personal alert streams (`users.{id}`), and hyperlocal neighborhood presence (`presence.ward.{wardCode}`).
  - *Keyset Cursor Pagination for Instant Chat History:* Keyset indexes `['conversation_id', 'created_at', 'id']` allowing smooth, infinite reverse scrolling without database query exhaustion.
  - *Live Interactive Ephemeral Events:* Real-time typing indicators (`user.typing`) and instant read receipts broadcasted without persistent database table bloat.
- **Why It Matters:** Powers the instantaneous chat and real-time citizen collaboration layer across Zengfy, laying the critical WebSocket transport needed for Emergency SOS distress signals.

---

### [x] TASK-017: Emergency SOS Distress Signal & Geo-Radius Broadcast
- **Status:** 🟢 **COMPLETED & 100% PASSING (7/7 Tests)**
- **Artifacts:**
  - [Modules/Social/database/migrations/2026_09_23_000036_create_emergency_events_table.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/database/migrations/2026_09_23_000036_create_emergency_events_table.php)
  - [Modules/Social/app/Models/EmergencyEvent.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/EmergencyEvent.php)
  - [Modules/Social/app/Models/EmergencyContact.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/EmergencyContact.php)
  - [Modules/Social/app/Events/EmergencyAlertTriggered.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Events/EmergencyAlertTriggered.php)
  - [Modules/Social/app/Events/EmergencyAlertResolved.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Events/EmergencyAlertResolved.php)
  - [Modules/Social/app/Services/EmergencySosService.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/EmergencySosService.php)
  - [Modules/Social/app/Http/Controllers/EmergencySosController.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/EmergencySosController.php)
  - [Modules/Social/tests/Feature/EmergencySosTest.php](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/EmergencySosTest.php)
  - [
outes/api.php](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [
outes/channels.php](file:///p:/Zengfy-Ecosystem/core/routes/channels.php)
  - [docs/api/openapi.yaml](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Sub-Second Distress Broadcast (< 500ms SLA):* Using ShouldBroadcastNow on EmergencyAlertTriggered to bypass queue delays, pushing instant GPS coordinates and distress details across presence.ward.{wardCode} and emergency.radius.
  - *Panic Multi-Tap Deduplication Guard:* Preventing redundant alarms when a citizen taps in panic via a 60-second active window idempotency filter.
  - *Redis Geo-Radius Location Indexing:* Using GEOADD and ZREM on active emergencies for sub-millisecond proximity queries.
  - *Distress Lifecycle & Authorization:* Strict ownership enforcement on distress resolution preventing non-originators from closing active citizen emergencies.
  - *Trusted Emergency Contacts CRUD:* Managing personal emergency contact lists for automated dispatch.
- **Why It Matters:** Provides a nationwide life-saving emergency distress infrastructure for women, students, and citizens in Bangladesh.

---

# 🏫 PHASE 6: Enterprise SaaS Workspaces (School ERP)

### [x] TASK-018: Academic Architecture: Classes, Sections & Subjects
- **Status:** 🟢 **COMPLETED & 100% PASSING (9/9 Tests)**
- **Artifacts:**
  - [`Modules/School/database/migrations/2026_09_23_000040_create_academic_years_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000040_create_academic_years_table.php)
  - [`Modules/School/database/migrations/2026_09_23_000041_create_school_classes_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000041_create_school_classes_table.php)
  - [`Modules/School/database/migrations/2026_09_23_000042_create_sections_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000042_create_sections_table.php)
  - [`Modules/School/database/migrations/2026_09_23_000043_create_subjects_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000043_create_subjects_table.php)
  - [`Modules/School/app/Models/AcademicYear.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/AcademicYear.php)
  - [`Modules/School/app/Models/SchoolClass.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/SchoolClass.php)
  - [`Modules/School/app/Models/Section.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/Section.php)
  - [`Modules/School/app/Models/Subject.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/Subject.php)
  - [`Modules/School/app/Services/AcademicStructureService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Services/AcademicStructureService.php)
  - [`Modules/School/app/Http/Controllers/AcademicStructureController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Http/Controllers/AcademicStructureController.php)
  - [`Modules/School/tests/Feature/AcademicStructureTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/tests/Feature/AcademicStructureTest.php)
  - [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
  - [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- **Core Concepts Learned:**
  - *Academic Year Modeling & Atomic Current Switching:* Enforcing strict multi-tenant academic lifecycle (`draft`, `active`, `archived`) where switching active academic year atomically demotes previous terms.
  - *Deep Academic Structure Rollover:* Atomic database transaction archiving previous years while cloning complete class, section, and subject hierarchies into the new academic session.
  - *Universal Tenant Scoping (`BelongsToTenant`):* Strict multi-tenant isolation ensuring school records, classes, and sections cannot leak across organizations, preventing IDOR vulnerabilities.
  - *Zero-Trust RBAC Governance:* Protecting modification endpoints with `'tenant.permission:academic.manage'` while providing organization owners seamless wildcard access.
- **Why It Matters:** Provides the foundational multi-tenant academic skeleton powering hundreds of primary, secondary, and higher secondary schools across Bangladesh on the Zengfy School SaaS suite.

---

### [ ] TASK-019: Student Information System & Batch Attendance
- **Status:** ⚪ **PLANNED**
- **Core Concepts to Learn:**
  - *Batch Upsert Concurrency:* Saving attendance for 50 students in a single atomic SQL transaction (`INSERT ... ON DUPLICATE KEY UPDATE`).
  - *Automated SMS Alerts to Guardians:* Asynchronous queue job dispatching SMS when a student is marked absent.

---

### [ ] TASK-020: Gradebook, Examinations & Report Card Publishing
- **Status:** ⚪ **PLANNED**
- **Core Concepts to Learn:**
  - *Calculated Fields & Caching:* Calculating GPA, letter grades, and merit positions; caching report card views as static immutable snapshots.

---

# 💳 PHASE 7: B2B Subscription Billing & Local Payment Gateways

### [ ] TASK-021: B2B SaaS Subscription Engine (Monthly / Annual)
- **Status:** ⚪ **PLANNED**
- **Core Concepts to Learn:**
  - *Subscription Lifecycle:* Trials, Grace Periods, Active, Past-Due, and Suspended states.
  - *Automated Invoicing:* Monthly recurring cron jobs generating invoices 7 days before subscription renewal.

---

### [ ] TASK-022: Local Payment Integration (bKash, Nagad) & Webhook Idempotency
- **Status:** ⚪ **PLANNED**
- **Core Concepts to Learn:**
  - *Payment Webhook Verification:* Validating cryptographic HMAC signatures sent by bKash/Nagad.
  - *Webhook Idempotency:* Storing webhook transaction IDs in Redis to prevent processing duplicate payment notifications.

---

# 📊 PHASE 8: Production Observability, CI/CD & Chaos Testing

### [ ] TASK-023: OpenTelemetry Distributed Tracing & Prometheus Metrics
- **Status:** ⚪ **PLANNED**
- **Core Concepts to Learn:**
  - *Trace Propagation:* Passing `X-Request-ID` from Nginx -> App -> Redis -> MySQL.
  - *APM Dashboards:* Real-time visualization of p95/p99 latency, slow SQL queries, and error spikes in Grafana.

---

### [ ] TASK-024: Automated CI/CD Pipeline & Zero-Downtime Rolling Deploys
- **Status:** ⚪ **PLANNED**
- **Core Concepts to Learn:**
  - *GitHub Actions Pipeline:* Automated static analysis (PHPStan), boundary validation, and unit tests running on every commit.
  - *Zero-Downtime Deployments:* Updating application containers sequentially behind Nginx without dropping a single user connection.

---

### [ ] TASK-025: Production Chaos Testing & Service Extraction Evaluation
- **Status:** ⚪ **PLANNED**
- **Core Concepts to Learn:**
  - *Chaos Engineering:* Intentionally stopping `app1` or `redis` during peak Locust traffic to prove automatic failover.
  - *Service Extraction:* Evaluating if Reverb or Social needs extraction into a dedicated Go/Rust service based on measured bottlenecks.

---

## 🏁 Definition of Mastery

By completing all missions in this tracker:
1. You will have built a **real-world, multi-tenant digital ecosystem** serving 10M scale.
2. You will be able to justify every single line of code and architectural decision during technical interviews at top-tier global companies.
3. Your codebase will be protected by constitutional laws that prevent AI agents from ever corrupting or compromising your architecture.
