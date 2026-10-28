হ্যাঁ—**এটা এখন পরবর্তী Agent-এর ওপর ছেড়ে দেওয়াই সবচেয়ে যৌক্তিক।**

তবে Agent-কে শুধু “TASK-002 বানাও” বললে হবে না। `TASK-001`-এর Constitution ও ADR-001-কে **source of truth** ধরে পরবর্তী কাজ করতে বলো, এবং বিশেষভাবে যেন API endpoint বানানোর আগে **canonical resources + domain ownership + dependency boundaries** নির্ধারণ করে।

তুমি Agent-কে এই নির্দেশনাটাই দিতে পারো:

TASK-001 সফলভাবে সম্পন্ন হয়েছে এবং নিচের দুটি document এখন Zengfy-এর canonical architectural source of truth:

* `docs/architecture/00_architecture_principles.md`
* `docs/architecture/adr/ADR-001-modular-monolith-first.md`

এখন তুমি **TASK-002: Canonical Resource Model & 36-Section API Architecture Blueprint** শুরু করো।

### গুরুত্বপূর্ণ নির্দেশনা

TASK-001-এর কোনো architectural principle ভাঙবে না। বিশেষ করে:

* Modular Monolith First
* Strict Domain & Data Ownership
* API-First + `/api/v1/...`
* Dependency Direction
* Security & Tenant Scoping
* Concurrency + Idempotency + Failure Design
* Capability → Evidence → Technology

### TASK-002-এর মূল লক্ষ্য

শুধু endpoint-এর একটি তালিকা তৈরি করবে না।

প্রথমে Zengfy-এর **Canonical Resource Model** নির্ধারণ করবে এবং তারপর প্রতিটি resource-এর:

```text
Resource
├── Owner Domain
├── Responsibility
├── Identity
├── Relationships
├── Allowed Operations
├── Authorization Boundary
├── Tenant Scope
├── Data Ownership
├── Referenced Resources
├── Events Produced
├── Events Consumed
├── Realtime Requirements
├── Idempotency Requirements
├── Consistency Requirements
├── Failure Modes
└── Future Service Boundary
```

নির্ধারণ করবে।

### Canonical Resources

কমপক্ষে এগুলো architecture-level resource হিসেবে যাচাই করবে:

Identity
User/Profile
Device
Session
Organization
Membership
Role
Permission
Post
Comment
Reaction
Follow/Friend
Community
Conversation
Message
Feed
EmergencyEvent
Verification
Notification
Media/File
SaaSProduct
Subscription
Invoice
Payment
BusinessProfile
AuditLog

এছাড়াও School ERP এবং ভবিষ্যৎ SaaS-এর প্রয়োজনীয় canonical resources identify করবে।

**নিজে থেকে resource invent করবে না**—প্রতিটি resource-এর business responsibility এবং domain ownership justify করবে।

### 36-Section API Architecture Blueprint

আগের architecture plan-এর 36টি section পুনরায় যাচাই করবে এবং প্রয়োজন হলে reorder/merge/split করবে।

প্রতিটি section-এর জন্য শুধু endpoint নয়:

```text
Business Context
Real-World Scenario
Problem
Concepts to Learn
Domain Responsibility
Resource Model
API Contract
Authentication
Authorization
Tenant Boundary
Data Ownership
Consistency
Concurrency
Idempotency
Events
Realtime
Caching
Rate Limiting
Failure Scenarios
Observability
Testing
Performance Considerations
Technology Selection
Alternatives & Trade-offs
Future Extraction Boundary
AI-Agent Constraints
Definition of Done
Mastery Questions
```

### বিশেষ Architectural Invariant

এই rule-টি blueprint-এর কেন্দ্রীয় invariant হিসেবে রাখবে:

> A domain MUST NOT directly read from or write to another domain's owned tables.

উদাহরণ:

```text
School
  ↓
Identity Contract
  ↓
Identity
```

এবং:

```text
School ❌ → users table
School ✅ → IdentityContract
```

### API Design

API design করার সময় অন্তত এগুলো cover করবে:

* `/api/v1/...`
* Resource-oriented REST
* Commands যেখানে প্রয়োজন
* Pagination
* Filtering
* Sorting
* Validation
* Error contract
* Idempotency
* Authorization
* Rate limiting
* ETags / caching যেখানে justified
* Optimistic concurrency যেখানে প্রয়োজন
* WebSocket boundary
* Domain events
* API backward compatibility
* Deprecation strategy

### Technology Selection

প্রতিটি technology আগে থেকে ধরে নেবে না।

প্রয়োজন অনুযায়ী:

```text
Capability
   ↓
Requirement
   ↓
Options
   ↓
Trade-off
   ↓
Technology
   ↓
Benchmark / Evidence
```

ব্যবহার করবে।

### AI-Agent Safety

পরবর্তী implementation agent যেন ভুল API বা architecture invent করতে না পারে—সেই জন্য blueprint-টিকে **machine-readable এবং human-readable contract** হিসেবে design করবে।

যেখানে সম্ভব canonical resource, operation, authorization এবং ownership explicitly define করবে।

### Deliverables

শেষে অন্তত:

```text
docs/architecture/01_api_architecture_blueprint.md
```

তৈরি করবে।

প্রয়োজনে supporting documents তৈরি করতে পারো, কিন্তু অপ্রয়োজনীয় documentation proliferation করবে না।

### গুরুত্বপূর্ণ

TASK-001-এর সিদ্ধান্তকে blindly expand করবে না।

যদি TASK-002-এর analysis-এর সময় কোনো architectural contradiction, missing boundary, ambiguous resource বা ভুল dependency পাওয়া যায়:

1. প্রথমে সমস্যাটি identify করো
2. কেন সমস্যা explain করো
3. TASK-001-এর কোন principle-এর সাথে conflict হচ্ছে তা দেখাও
4. প্রয়োজন হলে ADR proposal দাও
5. তারপর blueprint finalize করো

অর্থাৎ লক্ষ্য শুধু document লেখা নয়।

**Goal: Zengfy-এর API architecture এমনভাবে define করা যাতে পরবর্তী AI agents implementation করার সময় architecture invent না করে, বরং একটি explicit engineering contract অনুসরণ করে।**

TASK-002 শেষ হলে আমাকে জানাবে:

* কী তৈরি হয়েছে
* কোন architectural decisions নেওয়া হয়েছে
* কোন নতুন সমস্যা/ambiguity পাওয়া গেছে
* কোনো নতুন ADR প্রয়োজন কি না
* TASK-003-এর জন্য কী dependency তৈরি হয়েছে
* এবং Definition of Done-এর evidence

এখন Agent-কে কাজটা করতে দাও। **তুমি এই পর্যায়ে implementation-এ ঝাঁপ দিও না**—আগে canonical architecture contract solid করা বেশি মূল্যবান। TASK-002-এর output এলে সেটি এখানে এনে দিলে আমরা Principal-level architectural review করতে পারব।
