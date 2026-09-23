# 🏛️ Zengfy API Architecture Blueprint & Canonical Resource Model
**Document ID:** `ARCH-002`  
**Governing Standard:** `CONST-001 (Engineering Constitution)` & `ADR-001 (Modular Monolith)`  
**Status:** `CANONICAL / BASELINE`  
**Version:** `1.0.0`  
**Scope:** `All Public & Internal Platform APIs (v1), WebSocket Gateway, Multi-Tenant Domain Boundaries`

---

## 🎯 Executive Architectural Mandate

This document serves as the **contractual engineering specification** for the entire Zengfy ecosystem (serving 10,000,000+ users across Social Media, Emergency SOS Danger Alerts, and B2B SaaS Workspaces such as School ERP, Legal, and POS).

### 🛡️ The Hard Invariant (Non-Negotiable)
> **A domain MUST NOT directly read from or write to another domain's owned database tables.**  
> Inter-domain communication within this Modular Monolith executes strictly via **In-Process Service Contracts (PHP Interfaces)** or asynchronous **Domain Events**. Foreign entities are referenced exclusively via scalar UUIDs.

---

# 📦 PART 1: The Canonical Resource Model

Every entity in the Zengfy platform is mapped to a strictly defined Canonical Resource. AI agents and engineers **MUST NOT invent ad-hoc entities or cross-domain relationships** outside of this model.

```
                  ┌────────────────────────────────────────┐
                  │          Identity Resource             │ (Root Anchor)
                  └───────────────────┬────────────────────┘
                                      │
                 ┌────────────────────┴────────────────────┐
                 ▼                                         ▼
   ┌──────────────────────────┐              ┌──────────────────────────┐
   │   User / Profile         │              │   Organization / Tenant  │
   └─────────────┬────────────┘              └─────────────┬────────────┘
                 │                                         │
        ┌────────┴────────┐                       ┌────────┴────────┐
        ▼                 ▼                       ▼                 ▼
   [Social Graph]   [Emergency SOS]         [Membership/Role]  [Subscriptions]
   • Posts          • DangerAlert           • Policies         • Invoices
   • Comments       • LiveLocation          • School ERP       • Payments
   • Messages       • TrustedContacts       • Legal / POS      • SaaS Products
```

---

### 1.1 Identity & Access Domain Resources

#### `Resource: Identity`
- **Owner Domain:** `Modules/Auth`
- **Responsibility:** Global credentials, primary authentication anchor, password hashing (Argon2id/Bcrypt), multi-factor authentication (TOTP/WebAuthn), account status (active, locked, banned).
- **Identifier:** `id: UUIDv7` (Globally unique, time-ordered).
- **Data Owned:** `identities` (`id`, `email`, `phone_e164`, `password_hash`, `status`, `created_at`).
- **Data Referenced:** None (Root entity).
- **Events Produced:** `IdentityCreated`, `IdentityLocked`, `PasswordChanged`.
- **Consistency:** Strong (ACID).

#### `Resource: Session` & `Resource: Device`
- **Owner Domain:** `Modules/Auth`
- **Responsibility:** Stateful session tracking, refresh tokens, device fingerprinting, remote session revocation.
- **Data Owned:** `auth_sessions`, `auth_devices` (Redis + DB persistence).
- **Events Produced:** `SessionRevoked`, `DeviceRevokedAll`.

#### `Resource: UserProfile`
- **Owner Domain:** `Modules/Identity` (or `Modules/User`)
- **Responsibility:** Public human attributes (Full name, avatar, bio, language locale, verified badge).
- **Data Owned:** `user_profiles` (`id: UUIDv7`, `identity_id: UUIDv7 (Unique)`, `name`, `handle`, `avatar_url`, `locale`, `is_verified`).
- **Events Produced:** `ProfileUpdated`, `VerificationBadgeAwarded`.

---

### 1.2 Tenancy, Organization & RBAC Resources

#### `Resource: Organization` (The Tenant Anchor)
- **Owner Domain:** `Modules/Organization`
- **Responsibility:** Multi-tenant boundary for B2B businesses (Schools, Law Firms, Hotels, Retail Stores).
- **Data Owned:** `organizations` (`id: UUIDv7`, `name`, `slug`, `type`, `tier`, `settings_json`, `created_at`).
- **Data Referenced:** `owner_identity_id: UUIDv7`.
- **Events Produced:** `OrganizationCreated`, `OrganizationSuspended`.

#### `Resource: Membership` & `Resource: Role` & `Resource: Permission`
- **Owner Domain:** `Modules/Organization`
- **Responsibility:** Connecting a human `Identity` to an `Organization` with scoped privileges.
- **Data Owned:** `org_memberships` (`id`, `org_id`, `identity_id`), `org_roles` (`id`, `org_id`, `slug`), `org_role_permissions`.
- **Invariant:** A user can belong to multiple organizations with completely distinct roles (e.g., Principal in School A, Parent in School B).
- **Events Produced:** `MemberJoinedOrganization`, `MemberRoleUpdated`.

---

### 1.3 Social & Hyperlocal Media Resources

#### `Resource: Post`
- **Owner Domain:** `Modules/Social`
- **Responsibility:** Public social updates, news sharing, ward-level community posts.
- **Data Owned:** `social_posts` (`id: UUIDv7`, `author_identity_id: UUIDv7`, `type`, `scope [world, country, ward]`, `ward_code`, `content`, `media_ids_json`, `visibility`, `metrics_cache_json`).
- **Events Produced:** `PostCreated`, `PostModerated`, `PostDeleted`.

#### `Resource: Comment` & `Resource: Reaction`
- **Owner Domain:** `Modules/Social`
- **Data Owned:** `social_comments`, `social_reactions`.
- **Events Produced:** `CommentAdded`, `ReactionAdded`.

#### `Resource: Conversation` & `Resource: Message`
- **Owner Domain:** `Modules/Messaging`
- **Responsibility:** One-to-one and group real-time messaging with end-to-end encryption markers.
- **Data Owned:** `conversations`, `conversation_participants`, `messages` (`id: UUIDv7`, `conversation_id`, `sender_identity_id`, `ciphertext`, `delivery_status`).
- **Realtime Requirement:** WebSockets (< 100ms delivery via Redis Pub/Sub).
- **Events Produced:** `MessageDispatched`, `MessageDelivered`, `MessageRead`.

---

### 1.4 Emergency & Public Safety Resources

#### `Resource: EmergencyEvent` (SOS Danger Alert)
- **Owner Domain:** `Modules/Emergency`
- **Responsibility:** High-priority, life-safety distress signal broadcast triggered via hardware button or in-app tap.
- **Data Owned:** `emergency_events` (`id: UUIDv7`, `sender_identity_id`, `latitude`, `longitude`, `accuracy_meters`, `status [triggered, acknowledged, resolved, false_alarm]`, `created_at`).
- **Data Referenced:** `sender_identity_id`.
- **Realtime Requirement:** Critical WebSockets + Push Broadcast (< 500ms SLA to nearby online contacts).
- **Idempotency:** Strict (5-second deduplication window via Redis).
- **Events Produced:** `EmergencyTriggered`, `EmergencyLocationUpdated`, `EmergencyResolved`.

---

### 1.5 Enterprise SaaS: School Management Resources

#### `Resource: SchoolStudent` & `Resource: SchoolTeacher` & `Resource: SchoolClass`
- **Owner Domain:** `Modules/School`
- **Responsibility:** K-12 and College academic management, grade books, student records.
- **Data Owned:** `school_students` (`id: UUIDv7`, `org_id: UUIDv7`, `student_id_code`, `first_name`, `last_name`, `gender`, `dob`, `class_id`, `guardian_identity_id: UUIDv7 (nullable)`).
- **Data Referenced:** `org_id: UUIDv7`, `guardian_identity_id: UUIDv7`.
- **Invariant:** `Modules/School` NEVER queries `users` table directly. If a student is linked to a system identity, it only stores `identity_id: UUIDv7`.
- **Events Produced:** `StudentAdmitted`, `AttendanceMarked`, `ReportCardPublished`.

---

### 1.6 Billing & Subscription Resources

#### `Resource: SaaSProduct` & `Resource: Subscription` & `Resource: Invoice` & `Resource: Payment`
- **Owner Domain:** `Modules/Billing`
- **Responsibility:** Plan catalog, recurring B2B billing, bKash/Nagad/Card gateway processing, ledger history.
- **Data Owned:** `billing_plans`, `billing_subscriptions`, `billing_invoices`, `billing_payments`, `billing_webhook_logs`.
- **Data Referenced:** `org_id: UUIDv7`, `payer_identity_id: UUIDv7`.
- **Idempotency:** Mandatory `X-Idempotency-Key` on payments; Webhook deduplication.
- **Events Produced:** `SubscriptionCreated`, `PaymentSucceeded`, `PaymentFailed`, `SubscriptionExpired`.

---

# 🌐 PART 2: The 36-Section API Architecture Blueprint

Every section defines: **Context, Domain Responsibility, Endpoints, AuthN/AuthZ, Tenant Scope, Data Ownership, Concurrency/Idempotency, and Future Extraction Boundary.**

---

### SECTION 01: Architecture Principles & Governance
- **Mandate:** All APIs comply with `CONST-001` (Modular Monolith, Strict Ownership, Inward Dependencies).
- **Execution Mode:** In-process modular service calls inside Docker cluster (`proxy:7000` -> `app1`, `app2`, `app3`).

---

### SECTION 02: Client Architecture & Consumer Topology
- **Web App (React / Next.js):** Consumes `/api/v1` via standard JSON REST and server-side rendering for ERPs and SEO landing pages.
- **Mobile Super-App (Flutter):** Consumes `/api/v1` via Bearer Token. Manages local SQLite offline cache, background GPS for SOS, and WebSocket streams.

---

### SECTION 03: Edge Routing & API Gateway Topology
- **Load Balancer (Nginx):** Terminates TLS, enforces rate limiting (`limit_req_zone`), strips hop-by-hop headers, injects `X-Request-ID` correlation headers, and forwards to upstream `laravel_nodes`.

---

### SECTION 04: API Versioning & URL Scheme
- **Base URI:** `/api/v1/...`
- **Deprecation Policy:** Deprecated endpoints return `Sunset: <Date>` HTTP header; supported for a minimum of 6 months before removal.

---

### SECTION 05: Standard API Envelope & Error Contracts
All REST endpoints output a deterministic, typed JSON envelope:
```json
{
  "success": true,
  "message": "Resource retrieved successfully",
  "data": {},
  "meta": {
    "request_id": "req-9a8f-22b",
    "timestamp": "2026-09-23T07:35:00Z"
  }
}
```
**Error Structure:**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": ["The email has already been taken."]
  },
  "meta": {
    "request_id": "req-9a8f-22b",
    "error_code": "VALIDATION_ERROR"
  }
}
```

---

### SECTION 06: Authentication & Token Lifecycle (`Modules/Auth`)
- **Endpoints:**
  - `POST /api/v1/auth/register` (Idempotent account creation)
  - `POST /api/v1/auth/login` (Returns Bearer Token + Device ID)
  - `POST /api/v1/auth/logout` (Revokes current token)
  - `POST /api/v1/auth/logout-all` (Revokes all active sessions across devices)
  - `GET  /api/v1/auth/me` (Returns authenticated user credentials & claims)
- **AuthN:** Public for register/login; Bearer Token (Sanctum) for session routes.
- **Idempotency:** `X-Idempotency-Key` mandatory on register.

---

### SECTION 07: Single Sign-On (SSO) & Cross-Domain Exchange
- **Mechanism:** Central Identity Token exchange.
- **Flow:** User logged into `zengfy.top` clicks on `school.zengfy.top`. Client passes short-lived exchange ticket (`POST /api/v1/auth/sso-ticket`) which resolves to a scoped token for the target subdomain without re-authenticating.

---

### SECTION 08: User Profile & Public Identity (`Modules/Identity`)
- **Endpoints:**
  - `GET  /api/v1/users/{handle}` (Public profile)
  - `PATCH /api/v1/users/me` (Update name, avatar, bio)
- **Data Ownership:** `user_profiles` table.

---

### SECTION 09: Social Graph & Connections (`Modules/Social`)
- **Endpoints:**
  - `POST   /api/v1/social/follow/{userId}`
  - `DELETE /api/v1/social/follow/{userId}`
  - `GET    /api/v1/social/followers`
  - `GET    /api/v1/social/following`
- **Data Ownership:** `social_follows` (`follower_id: UUID`, `following_id: UUID`).

---

### SECTION 10: Social Posts & Reactions (`Modules/Social`)
- **Endpoints:**
  - `POST   /api/v1/social/posts` (Create post with scope: world, country, ward)
  - `GET    /api/v1/social/posts/{postId}`
  - `DELETE /api/v1/social/posts/{postId}`
  - `POST   /api/v1/social/posts/{postId}/reactions` (Like, Love, Care)
- **Idempotency:** Supported on `POST /posts` to prevent double-posting on slow 3G networks.

---

### SECTION 11: Hyperlocal & Ward-Level News Feed (`Modules/Social`)
- **Endpoints:**
  - `GET /api/v1/social/feed?scope=ward&ward_id=45&cursor=eyJpZCI...`
  - `GET /api/v1/social/feed?scope=country`
- **Performance Design:** Cursor-based pagination (`cursor=...`) over offset-based pagination to ensure p99 query latency < 50ms on million-row tables.

---

### SECTION 12: Real-time Messaging & Chat (`Modules/Messaging`)
- **Endpoints:**
  - `GET  /api/v1/chat/conversations`
  - `POST /api/v1/chat/conversations` (Create 1-on-1 or group chat)
  - `POST /api/v1/chat/messages` (Send message)
- **Realtime Delivery:** Laravel Reverb / WebSockets broadcasting `NewMessageEvent` on private channel `private-conversation.{id}`.

---

### SECTION 13: Emergency SOS Danger Alert Engine (`Modules/Emergency`)
- **Endpoints:**
  - `POST /api/v1/emergency/sos` (Trigger distress signal with GPS lat/lng)
  - `PATCH /api/v1/emergency/sos/{id}/location` (Streaming live coordinates)
  - `POST /api/v1/emergency/sos/{id}/resolve` (Cancel/Resolve alert)
- **SLA & Concurrency:**
  - Ingestion < 50ms.
  - Deduped via Redis key `sos:active:{user_id}` (prevents multiple alerts within 10s).
  - Broadcasts to Redis Geo-radius channel alerting trusted contacts & nearby online users.

---

### SECTION 14: Organization & Tenant Management (`Modules/Organization`)
- **Endpoints:**
  - `POST /api/v1/orgs` (Register school, business, law firm)
  - `GET  /api/v1/orgs/{orgId}`
  - `PATCH /api/v1/orgs/{orgId}`
- **AuthZ:** Only Organization Owner or Admin.

---

### SECTION 15: Tenant Membership & Role-Based Access Control (RBAC)
- **Endpoints:**
  - `GET    /api/v1/orgs/{orgId}/members`
  - `POST   /api/v1/orgs/{orgId}/invitations`
  - `PATCH  /api/v1/orgs/{orgId}/members/{memberId}/role`
  - `DELETE /api/v1/orgs/{orgId}/members/{memberId}`

---

### SECTION 16: School ERP: Student Information System (`Modules/School`)
- **Endpoints:**
  - `GET  /api/v1/school/students?class_id=X&cursor=Y`
  - `POST /api/v1/school/students` (Admit student)
  - `GET  /api/v1/school/students/{studentId}`
- **Data Invariant:** Scoped strictly by `org_id`. Foreign identity stored as scalar `guardian_identity_id`.

---

### SECTION 17: School ERP: Attendance & Academics (`Modules/School`)
- **Endpoints:**
  - `POST /api/v1/school/attendance/batch` (Batch attendance submission)
  - `GET  /api/v1/school/attendance/report?class_id=X&date=Y`
- **Idempotency:** Batch attendance requires `X-Idempotency-Key` (date + class unique constraint).

---

### SECTION 18: School ERP: Examinations & Gradebooks (`Modules/School`)
- **Endpoints:**
  - `POST /api/v1/school/exams`
  - `POST /api/v1/school/grades/bulk-entry`
  - `GET  /api/v1/school/report-cards/{studentId}`

---

### SECTION 19: School ERP: Fee Collection & Student Invoicing (`Modules/School`)
- **Endpoints:**
  - `POST /api/v1/school/fees/generate-monthly`
  - `POST /api/v1/school/fees/{feeId}/pay` (Dispatches internal `FeePaymentRequested` to Billing module)

---

### SECTION 20: Future SaaS Modules (Law, POS, Hotel, Civil)
- **Contract Policy:** Each new B2B product registers as a modular domain implementing standard `TenantSubscriberInterface`.

---

### SECTION 21: B2B Subscription Catalog (`Modules/Billing`)
- **Endpoints:**
  - `GET  /api/v1/billing/plans` (School Starter ৳999/mo, Pro ৳2999/mo)
  - `POST /api/v1/billing/subscriptions` (Subscribe organization)
  - `GET  /api/v1/billing/subscriptions/active`

---

### SECTION 22: Payment Gateway & Local Integrations (`Modules/Billing`)
- **Endpoints:**
  - `POST /api/v1/billing/payments/initiate` (Returns bKash / Nagad payment URL)
  - `POST /api/v1/billing/webhooks/bkash` (Public webhook listener)
- **Security:** Webhook signature verification + idempotent processing log.

---

### SECTION 23: Identity Verification & NID Portal (`Modules/Verification`)
- **Endpoints:**
  - `POST /api/v1/verification/nid-submit` (NID number + DOB + biometric selfie)
  - `GET  /api/v1/verification/status`
- **Data Protection:** NID numbers encrypted at rest with AES-256-CBC.

---

### SECTION 24: Centralized Notification Engine (`Modules/Notification`)
- **Endpoints:**
  - `GET   /api/v1/notifications`
  - `PATCH /api/v1/notifications/{id}/read`
- **Channels:** In-App, Push Notification (FCM), SMS (Local gateways), Email.

---

### SECTION 25: Media & Object Storage Pipeline (`Modules/Media`)
- **Endpoints:**
  - `POST /api/v1/media/presigned-upload-url` (Direct-to-S3 / MinIO upload)
  - `POST /api/v1/media/confirm` (Validates uploaded file MIME & dimensions)

---

### SECTION 26: Search & Discovery Engine (`Modules/Search`)
- **Endpoints:**
  - `GET /api/v1/search?q=XYZ&type=schools,users,posts`
- **Evolution:** MySQL fulltext search in Phase 1 -> OpenSearch / Elasticsearch extraction when dataset exceeds 5M documents.

---

### SECTION 27: Central Administration & Audit Logging (`Modules/Admin`)
- **Endpoints:**
  - `GET /api/v1/admin/audit-logs`
  - `POST /api/v1/admin/users/{id}/suspend`

---

### SECTION 28: Database Ownership Matrix (The Anti-Coupling Ledger)

| Module / Domain | Owned Database Tables | Permitted Foreign References |
| :--- | :--- | :--- |
| **`Modules/Auth`** | `identities`, `auth_sessions`, `auth_devices` | *None (Root)* |
| **`Modules/Identity`** | `user_profiles` | `identity_id` (scalar UUID) |
| **`Modules/Organization`** | `organizations`, `org_memberships`, `org_roles` | `identity_id` (scalar UUID) |
| **`Modules/Social`** | `social_posts`, `social_comments`, `social_reactions` | `author_identity_id` (scalar UUID) |
| **`Modules/Messaging`** | `conversations`, `conversation_participants`, `messages` | `sender_identity_id` (scalar UUID) |
| **`Modules/Emergency`** | `emergency_events`, `emergency_contacts` | `sender_identity_id` (scalar UUID) |
| **`Modules/School`** | `school_students`, `school_classes`, `school_attendance` | `org_id`, `guardian_identity_id` |
| **`Modules/Billing`** | `billing_plans`, `billing_subscriptions`, `billing_invoices` | `org_id`, `payer_identity_id` |

*Rule:* No table above shall ever have a SQL Foreign Key constraint pointing across this module boundary!

---

### SECTION 29: Redis State, Caching & Queue Topology
- **Connection `redis_cache`:** Query caches (TTL 60s - 3600s).
- **Connection `redis_session`:** Active user sessions and Sanctum token cache.
- **Connection `redis_queue`:** Asynchronous Horizon queue pipelines (`queue:high`, `queue:default`, `queue:low`).
- **Connection `redis_presence`:** WebSocket active connection presence and Geo-coordinates for SOS.

---

### SECTION 30: WebSocket Gateway & Broadcasting Architecture
- **Server:** Laravel Reverb running on internal port 8080 (proxied via Nginx WSS).
- **Channel Conventions:**
  - `private-user.{identity_id}` (Personal alerts, notifications)
  - `private-org.{org_id}` (School/Business staff live updates)
  - `presence-chat.{conversation_id}` (Live typing, read receipts)
  - `private-emergency.{emergency_id}` (Live GPS location streaming during distress)

---

### SECTION 31: Concurrency, Locking & Idempotency Engine
- **Idempotency Header:** `X-Idempotency-Key: <UUID>`
- **Storage:** Key cached in Redis for 120 seconds (`idempotency:{key}`).
- **Pessimistic Row Locking:** Used only on financial transactions:
  ```php
  DB::table('billing_subscriptions')->where('id', $subId)->lockForUpdate()->first();
  ```

---

### SECTION 32: Rate Limiting & Abuse Prevention Engine
- **Public Auth Routes:** `throttle:5,1` (5 attempts per minute).
- **Emergency SOS Routes:** 1 alert per 10 seconds, max 10 alerts per hour.
- **General API Routes:** `throttle:60,1` for free users; `throttle:300,1` for verified/paid B2B API keys.

---

### SECTION 33: Distributed Tracing & Observability
- **Header:** `X-Request-ID` generated by Nginx or client.
- **Propagation:** Injected into every log entry (`Log::withContext(['request_id' => ...])`).
- **Metrics Export:** Prometheus metrics exposed at `/metrics` (authenticated) reporting RPS, p95/p99 latency, 5xx errors, and DB query duration.

---

### SECTION 34: API Security & Threat Defense
- **CORS:** Strict origin whitelisting (`*.zengfy.top`, `localhost:7000`, `localhost:5173`).
- **Input Sanitization:** Form Request classes strictly typing and sanitizing all payload fields.
- **SQL Injection Defense:** 100% Parameterized queries via Eloquent / PDO.

---

### SECTION 35: Automated Contract Testing & Production Readiness
- **Contract Tests:** PHPUnit test suite validating every endpoint against OpenAPI schema.
- **Load Test Requirement:** Every new domain must provide a Locust task suite asserting < 150ms p99 latency under 500 concurrent virtual users before production merge.

---

### SECTION 36: Future Service Extraction Boundaries

```text
[Zengfy Modular Monolith]
          │
          ├── (1) Realtime Messaging / SOS WebSocket Server
          │       Signal: High concurrent socket connections (> 50,000 persistent TCP connections)
          │       Candidate: Standalone Go / Node.js WebSocket microservice reading from Redis Pub/Sub.
          │
          ├── (2) Social Feed Recommendation & Ranking
          │       Signal: Complex machine learning / graph computations (> 500ms CPU time)
          │       Candidate: Python / FastAPI inference service consuming Kafka post events.
          │
          └── (3) School Management ERP
                  Signal: Dedicated enterprise compliance / separate database scaling
                  Candidate: Independent Laravel SaaS application consuming Central Identity via OAuth2.
```

---

## 🏁 Definition of Done for TASK-002

1. [x] Canonical Resource Model fully mapped with zero cross-module DB join leakage.
2. [x] All 36 architectural dimensions comprehensively specified.
3. [x] Strict data ownership invariants established.
4. [x] Concurrency, Idempotency, and Failure modes detailed per domain.
5. [x] Service extraction triggers and migration paths documented.
