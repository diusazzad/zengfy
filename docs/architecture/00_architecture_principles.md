# 📜 Zengfy Engineering Constitution & Architecture Principles
**Document ID:** `CONST-001`  
**Status:** `ACTIVE / CANONICAL`  
**Version:** `1.0.0`  
**Last Updated:** `September 2026`  
**Governing Authority:** `Zengfy Engineering Team & AI Autonomous Agents`

---

## 🏛️ Preamble & Purpose

Zengfy is designed to be Bangladesh’s first unified digital ecosystem, operating at the scale of **10,000,000+ users** across consumer social, life-saving emergency systems, and mission-critical enterprise SaaS applications (School ERP, Legal, POS, etc.).

This document serves as the **Supreme Engineering Constitution** of the Zengfy codebase. Every human engineer and AI agent operating on this repository is strictly bound by these principles. No code shall be merged, refactored, or deployed that violates these hard architectural invariants.

---

## 🤖 AI Agent Governance & Operational Directives

To prevent architectural drift, code hallucination, and boundary erosion caused by autonomous AI agents, all AI agents executing tasks on Zengfy **MUST** strictly obey the following rules:

1. **Inspect Before Modifying:** An agent must inspect existing architecture, boundaries, and domain rules before modifying or writing code.
2. **Strict Domain Respect:** An agent shall never violate domain boundaries or query another domain’s database tables directly.
3. **Never Invent API Contracts:** All public APIs must adhere to approved OpenAPI specifications and versioning schemes (`/api/v1/...`). Agents must not invent ad-hoc endpoints.
4. **Zero Authorization Bypass:** An agent must never bypass authentication, middleware, or multi-tenant policies for convenience or testing shortcuts.
5. **Architectural Justification:** Every architectural change must be justified with an Architecture Decision Record (ADR).
6. **Mandatory Evidence & Verification:** An agent cannot declare a task complete without running tests and providing verified terminal/log evidence fulfilling the **Definition of Done (DoD)**.
7. **Role Definition:** The agent acts not merely as a "code generator," but as an **Architecture-Constrained Senior Systems Engineer**.

---

## 💎 The 7 Core Architectural Principles

```
[Principle 1: Modular Monolith First]
         │
[Principle 2: Strict Domain & Data Ownership]
         │
[Principle 3: API-First & Versioned Contracts]
         │
[Principle 4: Dependency Direction & In-Process Boundaries]
         │
[Principle 5: Security & Authorization by Design]
         │
[Principle 6: Concurrency, Idempotency & Failure by Design]
         │
[Principle 7: Technology Selection = Capability → Evidence → Technology]
```

---

### Principle 1: Modular Monolith First (Evolutionary Architecture)

* **Rule:** All domains must initially reside within a single, highly structured Modular Monolith. Microservices are forbidden until explicitly justified by empirical production telemetry.
* **Why:** Monoliths provide instant transactional consistency, zero-latency in-memory communication, simplified deployments, and single-source observability. Premature microservices create distributed latency, network failures, data inconsistency, and massive operational overhead.
* **Problem Prevented:** Distributed monolith anti-pattern, network serialization overhead, cross-service debugging nightmares, and premature DevOps complexity.
* **Allowed:**
  - Isolating features into self-contained modules (`Modules/Auth`, `Modules/School`, `Modules/Social`).
  - Running independent workers/queues within the same codebase.
* **Forbidden:**
  - Splitting domains into separate git repositories or standalone microservices before reaching verified throughput bottlenecks.
* **Example:**
  ```text
  ✅ Allowed: Modules/Auth and Modules/School living in the same Laravel codebase.
  ❌ Forbidden: Deploying a standalone Node.js microservice for School ERP without load test proof.
  ```
* **Exception:** Dedicated third-party or infrastructure daemons (e.g., Redis, MySQL, Nginx, or an isolated WebSocket broker if proven necessary).
* **Enforcement Mechanism:** Repository structure audits and CI dependency check rules.
* **Verification:** CI test suite checks that all modules pass within the unified pipeline.

---

### Principle 2: Strict Domain & Data Ownership (Hard Invariant)

* **Rule:** **A domain completely owns its database tables. No domain may directly read or write tables owned by another domain.**
* **Why:** If Domain A directly joins Domain B's tables in SQL, their data schemas become tightly coupled. Extracting Domain B into a dedicated service later becomes impossible without breaking Domain A.
* **Problem Prevented:** Schema coupling, untraceable cascade updates, phantom reads, and architectural lock-in.
* **Allowed:**
  - Storing a foreign domain's entity ID strictly as a scalar UUID reference (e.g., `user_id CHAR(36)` in `school_students`).
  - Reading foreign domain data exclusively through **In-Process Service Contracts** or **Domain Events**.
* **Forbidden:**
  - SQL `JOIN` queries across module table boundaries.
  - Foreign key database constraints referencing tables in another domain.
  - Direct Eloquent relations traversing module boundaries (e.g., `School::with('user.posts')`).
* **Example:**
  ```php
  // ❌ FORBIDDEN: School querying Identity database directly
  $user = DB::table('users')->where('id', $student->user_id)->first();
  
  // ✅ ALLOWED: School consuming Identity via In-Process Contract
  $userDTO = $this->identityContract->getUserBasicInfo($student->user_id);
  ```
* **Exception:** None. This is a non-negotiable architectural invariant.
* **Enforcement Mechanism:** Static analysis / PHPStan custom rules forbidding cross-module model imports.
* **Verification:** Automated schema linter verifying foreign key constraints only point to intra-module tables.

---

### Principle 3: API-First & Versioned Contracts

* **Rule:** All external interactions (Web, Mobile, Third-party) must consume explicitly versioned, schema-defined REST or WebSocket APIs (`/api/v1/...`). Controllers must never expose raw database schemas or internal models.
* **Why:** Web and mobile clients evolve at different speeds. Versioned contracts guarantee backward compatibility and allow client updates without backend breaking changes.
* **Problem Prevented:** Breaking mobile app crashes upon backend deployment; undocumented API drift; tight coupling between UI and SQL schema.
* **Allowed:**
  - Versioned API prefixes (`/api/v1/auth/register`, `/api/v2/feed`).
  - Explicit Resource Transformers / API Resources (`JsonResource`) returning standardized JSON envelopes:
    ```json
    {
      "success": true,
      "message": "Operation successful",
      "data": {},
      "errors": null
    }
    ```
* **Forbidden:**
  - Returning raw Eloquent models directly from controllers.
  - Modifying existing published API fields without deprecation cycles and major version bumping.
* **Example:**
  ```php
  // ❌ FORBIDDEN: Returning raw Model
  return User::all();
  
  // ✅ ALLOWED: Standardized API Resource Envelope
  return (new UserResource($user))->additional(['success' => true]);
  ```
* **Exception:** Internal web server Blade landing pages (which consume internal view models).
* **Enforcement Mechanism:** Contract testing via OpenAPI validation.
* **Verification:** Automated tests validating API response against OpenAPI schemas.

---

### Principle 4: Dependency Direction & In-Process Boundaries

* **Rule:** Dependencies must strictly flow inward toward the Domain Core. Business logic must live inside Domain Services and Actions, never inside HTTP Controllers or Queue Jobs.
* **Why:** Controllers and Console commands are merely delivery mechanisms (input adapters). Keeping business logic isolated ensures that the same logic can be invoked via HTTP, CLI, WebSockets, or tests without code duplication.
* **Problem Prevented:** Bloated controllers (Fat Controllers), duplicate validation logic, untestable business processes.
* **Allowed:**
  - Controllers only validating input, delegating to a Domain Action/Service, and returning an API Resource.
  - In-process communication across modules via PHP Interfaces and Data Transfer Objects (DTOs).
* **Forbidden:**
  - Database transactions, business validations, or entity mutations written directly inside Controllers or Middleware.
* **Example:**
  ```text
  [HTTP Request] ──► [AuthController] ──► [RegisterUserAction] ──► [Domain Model]
                                                   │
                                          Dispatches [UserRegistered Event]
  ```
* **Enforcement Mechanism:** Code reviews and architecture linters checking controller method line counts (max 25 lines per method).
* **Verification:** Unit tests asserting that Domain Actions can execute successfully without mocking HTTP requests.

---

### Principle 5: Security & Authorization by Design (Zero-Trust)

* **Rule:** Every request must be authenticated, authorized, and validated at the boundary. Multi-tenancy isolation must be cryptographically or structurally guaranteed.
* **Why:** In a multi-tenant platform serving schools, law firms, and social users, data leakage between tenants is fatal to business trust and legal compliance.
* **Problem Prevented:** Broken Object-Level Authorization (BOLA / IDOR), cross-tenant data contamination, privilege escalation, credential stuffing.
* **Allowed:**
  - Scoped API tokens (Sanctum Token Abilities / OAuth2 Scopes).
  - Explicit Policy checks (`$this->authorize('view', $tenantResource)`).
  - Global query tenant scopes ensuring queries automatically filter by `tenant_id` / `organization_id`.
* **Forbidden:**
  - Unscoped database queries that fetch records by ID without validating tenant ownership.
  - Hardcoded API credentials or plaintext sensitive data (PII/NID must be encrypted with AES-256).
* **Example:**
  ```php
  // ❌ FORBIDDEN: IDOR Vulnerability
  $invoice = Invoice::find($id);
  
  // ✅ ALLOWED: Tenant-scoped and authorized query
  $invoice = Invoice::where('organization_id', $currentTenant->id)->findOrFail($id);
  $this->authorize('view', $invoice);
  ```
* **Enforcement Mechanism:** Automated security tests asserting 403 Forbidden when Tenant A requests Tenant B's UUID.
* **Verification:** CI security scans (SAST) and automated BOLA regression tests.

---

### Principle 6: Concurrency, Idempotency & Failure by Design

* **Rule:** All write operations that create or alter state must be idempotent. The system must expect network partitions, dropped packets, and server crashes, and recover gracefully.
* **Why:** In high-concurrency environments (e.g., 5,000 requests/sec, mobile networks with spotty 3G/4G, rapid double-clicks on "Pay" or "Alert"), requests will be duplicated or timed out.
* **Problem Prevented:** Duplicate billing charges, double user registrations, corrupted inventories, and cascading service outages.
* **Allowed:**
  - Requiring `X-Idempotency-Key` headers on state-mutating POST/PATCH requests.
  - Wrapping multi-table operations in atomic database transactions (`DB::transaction`).
  - Handling slow, secondary side effects (notifications, analytics, emails) via asynchronous queue workers with exponential backoff and Dead Letter Queues (DLQ).
* **Forbidden:**
  - Performing synchronous external HTTP API calls (e.g., SMS gateways, bKash) inside user HTTP request cycles.
* **Example:**
  ```text
  Client Click 1 ──► [Nginx] ──► [Worker 1] ──► Creates User & Caches Key (201 Created)
  Client Click 2 ──► [Nginx] ──► [Worker 2] ──► Cache Hit on Idempotency Key ──► Returns Cached 200 OK
  ```
* **Enforcement Mechanism:** Automated Locust load tests injecting duplicate idempotency keys and asserting exactly 1 database insert.
* **Verification:** Unit and feature tests verifying transaction rollback upon deliberate mid-operation exceptions.

---

### Principle 7: Technology Selection = Capability → Evidence → Technology

* **Rule:** Technology adoption must follow the strict sequence: **Identify Needed Capability → Define Success Metric → Evaluate Alternatives → Benchmark Evidence → Select Technology**.
* **Why:** Adopting tools based on industry hype creates unmaintainable stacks that bankrupt engineering teams. Every tool must earn its place through measurable performance gains.
* **Problem Prevented:** Resume-Driven Development (RDD), unnecessary infrastructure bills, complex multi-runtime debugging.
* **Allowed:**
  - Using Docker, Nginx, PHP 8.4, Redis, and MySQL because they provide proven multi-container load balancing, sub-millisecond cache latency, and relational ACID guarantees.
  - Recording every tech choice in a formal Architecture Decision Record (ADR).
* **Forbidden:**
  - Adding a new runtime (Node, Go, Python, Rust) or database (MongoDB, Cassandra) without documented proof that the existing stack cannot satisfy latency or throughput requirements under benchmark.
* **Example Inventory Rule:**
  ```text
  Capability Needed: In-memory session & rate limiting (< 2ms response).
  Options: Memcached, Redis.
  Evidence: Redis provides data structures (Hashes, Sets for Geo-radius SOS alerts) + Pub/Sub.
  Decision: Redis Alpine adopted and documented in ADR.
  ```
* **Enforcement Mechanism:** Mandatory ADR review before adding any new container, daemon, or third-party service.
* **Verification:** Performance benchmarks recorded in `docs/benchmarks/`.

---

## 🎯 Definition of Done (DoD) for Any Engineering Task

No task shall be considered complete by an engineer or AI agent unless it satisfies:

1. [ ] **Architectural Compliance:** Adheres to all 7 principles of CONST-001.
2. [ ] **Zero Cross-Domain DB Leakage:** Uses defined contracts or domain events for cross-module needs.
3. [ ] **Automated Tests Passing:** Unit and Feature tests pass with 100% green status.
4. [ ] **Idempotency & Concurrency Verified:** State mutations tested against duplicate requests.
5. [ ] **Security Scoped:** Authorization policies and input validations active.
6. [ ] **Observability Active:** Structured logging and metrics added.
7. [ ] **Documentation & ADR Updated:** Relevant architecture docs updated to reflect changes.
