# 🏛️ Architecture Decision Record (ADR-001)
**Title:** Modular Monolith Architecture Before Microservices  
**Status:** `ACCEPTED`  
**Date:** `2026-09-23`  
**Author:** `Zengfy Engineering Team & Lead AI Architect`  
**Deciders:** `Founder, Lead Architect, Core Platform Team`  
**Supersedes:** `N/A`  
**Superseded By:** `N/A`

---

## 1. Context & Business Drivers

Zengfy is building a high-scale digital ecosystem for Bangladesh, serving both consumer applications (Social Media, Hyperlocal Ward Feeds, Emergency SOS Danger Alerts) and business B2B SaaS applications (School ERP, Legal Case Management, Hotel Management, POS, Billing).

The long-term vision projects **10,000,000+ registered users**, with peak loads exceeding **5,000 to 10,000 Requests Per Second (RPS)**.

In building an ecosystem of this breadth, early-stage engineering teams face a critical architectural fork:
1. **Option A (Distributed Microservices):** Build independent repositories and services for each domain (e.g., Auth service, Social service, School service, Billing service) communicating over HTTP/gRPC.
2. **Option B (Modular Monolith):** Build a unified codebase structured with strict internal domain boundaries (`Modules/Auth`, `Modules/School`, etc.) sharing an infrastructure platform (Nginx, Redis, MySQL) deployed as containerized workers.

---

## 2. Problem Statement

Starting directly with microservices introduces catastrophic early-stage failure modes:
- **Premature Network Boundaries:** Splitting code across network boundaries before domain boundaries stabilize leads to the dreaded **"Distributed Monolith"** anti-pattern (microservices that must be deployed together and crash together).
- **Dual-Write & Distributed Transaction Failures:** Operations that span domains (e.g., User registers -> subscribes to School -> creates initial payment) require Two-Phase Commits (2PC) or complex Saga orchestrators, leading to data inconsistencies.
- **Extreme Operational Overhead:** Managing 5+ CI/CD pipelines, Dockerfiles, service discovery mechanisms, and tracing systems consumes 80% of engineering bandwidth, leaving zero time for actual product delivery.
- **Latency Tax:** Every inter-service network call over HTTP/gRPC adds 5–25ms of latency, destroying the p99 latency SLA (< 150ms).

---

## 3. Decision

We formally decide to build the Zengfy platform as a **Modular Monolith First**, powered by Laravel 11/12/13, PHP 8.4, Redis, and MySQL 8.0 running inside multi-container Docker environments behind an Nginx Load Balancer.

### Core Architectural Invariants:
1. **Codebase Monolith, Domain Separation:** All domains live in the single repository under `Modules/{Domain}`.
2. **Strict Persistence Ownership:** No module may directly query or alter another module's database tables. Cross-domain interactions are handled exclusively via **In-Process Service Contracts** (PHP Interfaces) or **Domain Events** (Event Bus).
3. **Stateless Scale-Out:** The monolith application containers (`app1`, `app2`, `app3`) remain strictly stateless, sharing state only via centralized Redis and MySQL clusters.
4. **Measurement-Driven Extraction:** We will **NOT** extract any microservice until telemetry proves a specific, non-negotiable bottleneck.

---

## 4. Why Modular Monolith?

1. **Zero-Latency In-Process Communication (0ms):** When `Modules/School` requests basic user data from `Modules/Auth`, the call executes in-memory as a native PHP function call (sub-microsecond execution) without HTTP serialization or network overhead.
2. **Local ACID Transaction Safety:** Critical multi-step domain operations execute within a single atomic database transaction (`DB::transaction`), eliminating phantom records and financial balance mismatches.
3. **Refactoring Fluidity:** Early in a startup's lifecycle, domain boundaries shift rapidly. In a Modular Monolith, moving a concept between domains is a simple code refactor, rather than an agonizing cross-repository API migration.
4. **Developer Velocity:** A single `docker compose up -d` spins up the entire production-grade environment on any laptop in seconds.

---

## 5. Why Not Microservices Initially?

| Architectural Dimension | Microservices at Day 1 | Zengfy Modular Monolith |
| :--- | :--- | :--- |
| **Data Consistency** | Eventual consistency; Sagas needed | Immediate ACID consistency where needed |
| **Inter-Service Latency** | 5ms - 50ms per network hop | < 0.01ms (In-Memory PHP function call) |
| **Deployment Complexity** | Multi-repo, service meshes (Istio), K8s | Single repository, Docker Compose / Rolling deploy |
| **Observability Overhead** | Distributed tracing mandatory Day 1 | Centralized structured logs & APM |
| **Startup Cost & Team Size** | Requires 5+ DevOps/Infra engineers | Can be operated by a single high-velocity engineer |

---

## 6. Benefits & Capabilities Enabled

- **High-Throughput Local Testing:** As proven by our Locust tests, our 3-node containerized monolith effortlessly handles concurrent bot traffic with automated load balancing.
- **Clean In-Process API Contracts:** Clean interfaces allow any domain to be treated as a black box.
- **Effortless Future Extraction:** Because `Modules/School` does NOT join `users` or `social_posts` tables, extracting `Modules/School` into a standalone service later requires **zero database schema redesign**.

---

## 7. Trade-offs & Limitations

- **Shared Compute Resources:** A CPU-heavy bug in Social Feed ranking could temporarily consume worker threads needed by School ERP.
  - *Mitigation:* Isolate asynchronous queue workers by queue names (`queue:school`, `queue:social`, `queue:emergency`).
- **Shared Relational Database:** High write volume on Social could impact read latency for SaaS.
  - *Mitigation:* Read-replica splitting (1 Master for writes, Read Replicas for queries) and aggressive Redis caching.
- **Discipline Required:** A Modular Monolith requires strict code review enforcement to ensure engineers/agents do not bypass module boundaries.

---

## 8. Failure Modes & Mitigations

1. **Failure Mode 1: Boundary Erosion (Spaghetti Monolith)**
   - *Scenario:* A developer writes `use Modules\Social\Entities\Post;` inside a School controller.
   - *Mitigation:* Static analysis / architecture linter forbidding direct imports of foreign internal entities.
2. **Failure Mode 2: Monolith Thread Exhaustion**
   - *Scenario:* Slow external API calls (e.g. bKash payment gateway or SMS provider) lock PHP-FPM workers.
   - *Mitigation:* Principle 6 strictly requires all slow or external I/O to run in asynchronous Redis queues.

---

## 9. Extraction Signals (When will we extract a Microservice?)

We will only extract a domain into an independent microservice when at least one of the following **Empirical Measurement Signals** is triggered:

```text
[Modular Monolith Running]
           │
           ▼
[Measure with Locust & OpenTelemetry APM]
           │
           ▼
[Bottleneck Signal Triggered?]
    ├── 1. Disproportionate Scaling: Realtime WebSockets requires 100x more memory than CRUD?
    ├── 2. Independent Deployment Velocity: A team of 10 engineers commits 50 times/day to Social?
    └── 3. Compute-Intensive Workload: Feed ranking / ML requires GPU / Python runtime?
           │
           ▼ (YES)
[Extract Candidate Domain into Dedicated Service]
           │
           ▼
[Re-Benchmark & Measure Latency Delta]
```

---

## 10. Future Migration & Extraction Path

If `Modules/Social` or `Modules/Messaging` triggers an extraction signal:
1. The internal PHP interface (e.g., `SocialContractInterface`) is swapped with an HTTP/gRPC Adapter implementing the identical interface.
2. The domain's database tables are migrated to a dedicated database instance.
3. The rest of the monolith continues executing without a single line of business logic changing.

---

## 11. Consequences & Approval

- **Approved:** This ADR serves as the foundational architectural baseline for all subsequent tasks starting from **TASK-001**.
- **Review Cadence:** Re-evaluated after achieving **100,000 Monthly Active Users** or during quarterly performance engineering reviews.
