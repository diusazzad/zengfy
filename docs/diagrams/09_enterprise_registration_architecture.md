# System Design Masterclass: 10M Scale Enterprise Registration

এই ডকুমেন্টটি আপনার **Enterprise Registration System**-এর ভিজ্যুয়াল ব্লুপ্রিন্ট। এটি রিয়েল-ওয়ার্ল্ড ক্লাউড আর্কিটেকচার (Docker, Load Balancing, Redis, Queue) লোকাল মেশিনে কীভাবে কাজ করবে, তার সিস্টেম ডিজাইন।

---

## 1. The High-Level Architecture (The Big Picture)
কীভাবে হাজার হাজার বোট (Bots) আমাদের সিস্টেমে হিট করবে এবং সিস্টেম তা হ্যান্ডেল করবে:

```mermaid
flowchart TD
    subgraph Load_Testing [Locust Bot Army]
        Bots((5,000 Concurrent <br/> Fake Users))
    end

    subgraph Docker_Network [Local Docker Compose Network]
        Nginx{Nginx <br/> Load Balancer :7000}
        
        subgraph Laravel_Nodes [Horizontal Scaling]
            Node1[Laravel App 1 <br/> Port 8001]
            Node2[Laravel App 2 <br/> Port 8002]
            Node3[Laravel App 3 <br/> Port 8003]
        end
        
        subgraph Data_Layer [State & Persistence]
            Redis[(Redis <br/> Session, Cache, Horizon)]
            MySQL[(MySQL <br/> Master DB)]
        end
        
        subgraph Background_Workers [Async Processing]
            Worker[Horizon Worker]
        end
    end

    Bots -->|POST /api/register| Nginx
    Nginx -->|Round Robin| Node1
    Nginx -->|Round Robin| Node2
    Nginx -->|Round Robin| Node3
    
    Node1 --> Redis
    Node2 --> Redis
    Node3 --> Redis
    
    Node1 --> MySQL
    Node2 --> MySQL
    Node3 --> MySQL
    
    Node1 -.->|Fire Event| Redis
    Redis -.->|Pop Queue| Worker
```

---

## 2. The Registration Logic Flow (Senior Level)
একটি সিঙ্গেল রেজিস্ট্রেশন রিকোয়েস্ট ভেতরে কীভাবে প্রসেস হবে:

```mermaid
sequenceDiagram
    participant User
    participant App as Laravel Node
    participant Redis as Redis (Bloom Filter & Rate Limit)
    participant DB as MySQL (Transaction)
    participant Queue as Horizon Queue

    User->>App: POST /api/register {email, pass, device_id}
    
    %% Rate Limiting Step
    App->>Redis: Check Rate Limit (device_id)
    alt Limit Exceeded
        Redis-->>App: True
        App-->>User: HTTP 429 Too Many Requests
    end
    
    %% Bloom Filter Step
    App->>Redis: Check Bloom Filter (email exists?)
    alt Exists in Bloom Filter
        Redis-->>App: Probably Yes -> Check DB
        App->>DB: SELECT count WHERE email
    else Not in Bloom Filter
        Redis-->>App: Definitely No (Skip DB Check!)
    end
    
    %% Transaction Step
    App->>DB: BEGIN Transaction
    App->>DB: INSERT User (UUID)
    App->>DB: INSERT Personal Access Token
    App->>DB: COMMIT Transaction
    
    %% Async Event Step
    App->>Queue: Dispatch UserRegistered Event
    App-->>User: HTTP 201 Created (Returns Token)
```

---

## 3. Real-Time Monitoring (Laravel Pulse)
হাজার হাজার রিকোয়েস্ট আসার সময় আমরা ড্যাশবোর্ডে কী কী মনিটর করবো:

```mermaid
mindmap
  root((Laravel Pulse))
    Performance
      Slow Endpoints (> 200ms)
      Slow Queries (DB Bottlenecks)
    Usage
      Top 10 IP Addresses (Finding the bots)
      Active Users
    Health
      CPU & Memory Usage
      Redis Queue Pending Jobs
      Exceptions & Deadlocks
```
