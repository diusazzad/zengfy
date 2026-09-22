# 🎓 Zengfy Engineering Masterclass & Case Study Log

এই ডকুমেন্টটি আমাদের প্রজেক্টে প্র্যাকটিক্যালি শেখা প্রতিটি হাই-লেভেল সিস্টেম ডিজাইন, ইনফ্রাস্ট্রাকচার এবং আর্কিটেকচারাল কনসেপ্টের **Master Reference Guide**। এটি আপনার সিভি (CV), পোর্টফোলিও এবং টেকনিক্যাল ইন্টারভিউতে টপ-টায়ার ইঞ্জিনিয়ারদের মতো উত্তর দেওয়ার জন্য সরাসরি প্রস্তুত করা।

---

## 📑 সূচিপত্র (Learning Modules)
1. [Observability Topology Visualizer (লাইভ ট্রাফিক ভিজ্যুয়ালাইজেশন)](#1-observability-topology-visualizer)
2. [Layer-7 Load Balancing & Horizontal Scaling (Nginx)](#2-layer-7-load-balancing--horizontal-scaling)
3. [Idempotency & Database Atomicity (DB Transaction)](#3-idempotency--database-atomicity)
4. [Anti-DDoS & Adaptive Rate Limiting (Throttle)](#4-anti-ddos--adaptive-rate-limiting)
5. [Event-Driven Asynchronous Architecture (Queue & Workers)](#5-event-driven-asynchronous-architecture)
6. [Distributed Stress Testing & Bot Orchestration (Locust)](#6-distributed-stress-testing--bot-orchestration)

---

## 1. Observability Topology Visualizer

### 🧠 Theory & What it is:
Netflix, Uber বা Stripe-এর মতো কোম্পানিগুলো তাদের সিস্টেম মনিটর করার জন্য শুধু সাধারণ গ্রাফ দেখে না। তারা একটি **"Digital Twin"** বা **"Topology Visualizer"** ব্যবহার করে (যেমন Netflix-এর *Vizceral*), যেখানে ডাটা সেন্টারের সার্ভারগুলোর মাঝে লাইভ রিকোয়েস্ট কণাগুলো কীভাবে উড়ে যাচ্ছে তা রিয়েল-টাইমে দৃশ্যমান হয়।

```
[Client / Bot] ──(HTTP)──► [Nginx] ──(Round Robin)──► [App Node 1/2/3] ──(State)──► [Redis/DB]
                                │                              ▲
                                └───► (Live SSE / WebSocket) ──┘
                                             │
                                             ▼
                             [Browser Canvas Particle Engine]
```

### 🔬 Core Architecture Concept:
- **Telemetry Middleware:** প্রতিটি ইনকামিং রিকোয়েস্টের নোড নাম, আইপি, স্ট্যাটাস কোড (`201`, `429`) এবং ল্যাটেন্সি ক্যাপচার করে।
- **Real-Time Pipeline (SSE / Redis PubSub):** মাইক্রো-সেকেন্ডের মধ্যে ইভেন্টগুলো ব্রাউজারে ব্রডকাস্ট করে।
- **Canvas Particle Rendering:** ব্রাউজার ইভেন্ট পাওয়া মাত্রই স্ক্রিনে গ্র্যাভিটি এবং বেজিয়ার কার্ভ দিয়ে কণা উড়িয়ে নির্দিষ্ট নোডে পাঠায়।

### 💼 Practical Scenario & CV Highlight:
> *"Architected and built a real-time reactive Observability Topology Visualizer in Laravel & HTML5 Canvas that renders microsecond-level live distributed traffic, load-balancer routing, and DDoS rate-limiting animations."*

---

## 2. Layer-7 Load Balancing & Horizontal Scaling

### 🧠 Theory & What it is:
১০ মিলিয়ন ইউজারের সিস্টেমে একটি সার্ভারের র‍্যাম/সিপিইউ বাড়ানো (Vertical Scaling) সম্ভব নয়। তাই একাধিক কম ক্ষমতার সার্ভার পাশাপাশি বসিয়ে (Horizontal Scaling) তাদের সামনে একটি **Reverse Proxy (Nginx)** বসানো হয়।

### 🔬 Core Architecture Concept:
- **Round-Robin Algorithm:** Nginx প্রতিটি নতুন রিকোয়েস্ট ক্রমানুসারে `App1 -> App2 -> App3` এ পাঠায়।
- **Stateless Architecture:** কোনো সার্ভার নিজের কাছে ইউজারের সেশন রাখে না; সবাই সেন্ট্রাল **Redis** থেকে সেশন পড়ে। ফলে যে কোনো সার্ভারে রিকোয়েস্ট গেলেও ইউজার লগআউট হয় না।
- **Zero-Downtime Failover:** কোনো নোড ডাউন (Crash) হলে Nginx স্বয়ংক্রিয়ভাবে সেটি ডিটেক্ট করে ট্রাফিক বাকি নোডগুলোতে পাঠায়।

### 💼 Practical Scenario & CV Highlight:
> *"Engineered a multi-node horizontal scaling cluster with Docker and Nginx Layer-7 reverse proxy implementing Round-Robin routing and Redis-backed stateless session management."*

---

## 3. Idempotency & Database Atomicity

### 🧠 Theory & What it is:
মোবাইল অ্যাপে স্লো নেটওয়ার্ক থাকলে ইউজার একাধিকবার "Submit" বাটনে চাপ দিতে পারে। সাধারণ সিস্টেমে এটি ডুপ্লিকেট ইউজার বানিয়ে ফেলে বা এরর দেয়। **Idempotency** নিশ্চিত করে যে একই রিকোয়েস্ট ১০০ বার আসলেও ডাটাবেসে মাত্র একবারই অ্যাকশন হবে এবং প্রতিবার একই টোকেন ফেরত যাবে।

### 🔬 Core Architecture Concept:
- **X-Idempotency-Key Header:** ক্লায়েন্ট একটি ইউনিক UUID পাঠায়।
- **Fast Redis Lookup:** কন্ট্রোলারের শুরুতে ক্যাশ চেক করা হয়; কি (Key) থাকলে ডাটাবেস কুয়েরি বাইপাস করে ক্যাশড রেসপন্স ফিরিয়ে দেয় (`HTTP 200`)।
- **Atomic Transaction (`DB::transaction`):** ইউজার ইনসার্ট এবং টোকেন জেনারেশন একসাথে হয়। মাঝপথে কোনো এরর হলে সম্পূর্ণ ডেটা রোলব্যাক হয়।

### 💼 Practical Scenario & CV Highlight:
> *"Implemented enterprise-grade API Idempotency and atomic database transactions to guarantee zero duplicate entity creation and seamless network retry resilience."*

---

## 4. Anti-DDoS & Adaptive Rate Limiting

### 🧠 Theory & What it is:
হ্যাকাররা বট দিয়ে প্রতি সেকেন্ডে শত শত রিকোয়েস্ট পাঠিয়ে সার্ভার ডাউন করতে চায়। রেট লিমিটিং লেয়ার অতিরিক্ত ট্রাফিকগুলোকে ডাটাবেসে যাওয়ার আগেই আটকে দেয়।

### 🔬 Core Architecture Concept:
- **Leaky / Token Bucket Algorithm:** প্রতিটি আইপি বা ডিভাইসের জন্য একটি কাউন্টার রাখা হয়।
- **HTTP 429 Too Many Requests:** প্রতি মিনিটে ৫টির বেশি রিকোয়েস্ট আসলে সার্ভার ডাটাবেস টাচ না করেই `429` এরর দিয়ে কানেকশন ক্লোজ করে দেয়।

---

## 5. Event-Driven Asynchronous Architecture

### 🧠 Theory & What it is:
রেজিস্ট্রেশনের পর ওয়েলকাম ইমেইল পাঠানো বা টেলিমেট্রি লগ করতে ২-৩ সেকেন্ড সময় লাগে। এটি ইউজারের রিকোয়েস্টে করলে ইউজারের স্ক্রিন ফ্রিজ হয়ে থাকবে।

### 🔬 Core Architecture Concept:
- **Non-blocking Dispatch:** কন্ট্রোলার ইউজার তৈরি করেই সাথে সাথে `UserRegistered` ইভেন্ট ফায়ার করে ইউজারকে রেসপন্স পাঠিয়ে দেয় (মাত্র ২০ মিলিসেকেন্ডে!)।
- **Worker Queue (`ShouldQueue`):** ইভেন্টটি ব্যাকগ্রাউন্ডে **Redis Horizon Queue Worker**-এ চলে যায় এবং ওয়ার্কার সম্পূর্ণ আলাদা প্রসেসে ইমেইল পাঠিয়ে দেয়।

---

## 6. Distributed Stress Testing & Bot Orchestration

### 🧠 Theory & What it is:
কোড প্রোডাকশনে যাওয়ার আগে লোকাল পিসিতে আসল ট্রাফিক স্পাইক সিমুলেট করা।

### 🔬 Core Architecture Concept:
- **Locust (Python):** মাল্টি-থ্রেডেড ভার্চুয়াল ইউজার তৈরি করে সিস্টেমকে স্ট্রেস টেস্ট করা।
- **Key Metrics Tracked:**
  - **RPS (Requests Per Second):** সিস্টেম প্রতি সেকেন্ডে কয়টি রিকোয়েস্ট প্রসেস করতে পারছে।
  - **P95 / P99 Latency:** ৯৫% ইউজারের রেসপন্স টাইম কত দ্রুত হচ্ছে।
  - **Failure Percentage:** রেট লিমিটার দ্বারা ব্লক হওয়া বটের অনুপাত।

---

*Log Updated: August 2026 • Zengfy Core Architecture Team*
