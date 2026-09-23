# Implementation Plan - TASK-010: National ID (NID) Verification & AES-256 PII Encryption

## Goal Description
Implement an enterprise-grade National ID (NID) Verification and Personally Identifiable Information (PII) Encryption Engine. The engine secures sensitive citizen identity data using AES-256-CBC encryption at rest, employs a cryptographic blind index (HMAC-SHA256) for O(1) duplicate fraud prevention, simulates a realistic Government Election Commission NID sandbox gateway, and issues verified blue badges (`verified_badge = true`).

---

## User Review Required
> [!IMPORTANT]
> **Cryptographic Blind Index Pattern**:
> When `nid_number` is encrypted with AES-256-CBC, it cannot be queried with a traditional SQL `UNIQUE` index because every encryption operation generates a unique random IV (Initialization Vector).
> To prevent duplicate NID registrations across multiple accounts without decrypting millions of database rows, we store a deterministic `nid_hash` (`hash_hmac('sha256', $nidNumber, config('app.key'))`) with a unique database index.
> 
> **PII Encryption at Rest**:
> `nid_number` and `date_of_birth` are cast with Laravel's `'encrypted'` attribute, guaranteeing they are stored as ciphertext in MySQL/SQLite and automatically decrypted in Eloquent models.

---

## Proposed Changes

### Database & Migrations (`Modules/Auth/database/migrations`)

#### [NEW] [`2026_09_23_000002_add_nid_fields_and_encryption_to_users_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/database/migrations/2026_09_23_000002_add_nid_fields_and_encryption_to_users_table.php)
- Adds columns to `users`:
  - `text('nid_number')->nullable()` (Encrypted ciphertext)
  - `string('nid_hash', 64)->nullable()->unique()` (Blind index for duplicate detection)
  - `date('date_of_birth')->nullable()` (or encrypted)
  - `timestamp('nid_verified_at')->nullable()`
  - `boolean('verified_badge')->default(false)`

### User Model (`app/Models/User.php`)

#### [MODIFY] [`User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php)
- Add `nid_number`, `nid_hash`, `date_of_birth`, `nid_verified_at`, `verified_badge` to `$fillable`.
- Add `'nid_number' => 'encrypted'` to `$casts`.
- Add helper method `maskedNid(): ?string` (e.g. `******7890`).

### Domain Events (`Modules/Auth/app/Events`)

#### [NEW] [`NidVerified.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Events/NidVerified.php)
- Domain event dispatched when a citizen's National ID is successfully verified. Contains `$user`, `$maskedNid`, and `$verifiedAt`.

### Government NID Gateway & Sandbox (`Modules/Auth/app/Contracts` & `Services`)

#### [NEW] [`NidVerificationGatewayInterface.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Contracts/NidVerificationGatewayInterface.php)
- Interface with method:
  `verify(string $nidNumber, string $dob): array`

#### [NEW] [`MockElectionCommissionNidGateway.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Services/MockElectionCommissionNidGateway.php)
- Implements `NidVerificationGatewayInterface`.
- Validates 10-digit (Smart NID) or 17-digit format.
- Simulates sandbox responses:
  - NIDs starting with `999...`: returns `['success' => false, 'message' => 'NID record not found in Election Commission database']`.
  - NIDs starting with `888...`: throws/returns gateway timeout (503).
  - Valid NIDs: returns `['success' => true, 'citizen_name' => '...', 'gender' => '...', 'status' => 'ACTIVE']`.

### Controller & Routes (`Modules/Auth/app/Http/Controllers`)

#### [NEW] [`NidVerificationController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/app/Http/Controllers/NidVerificationController.php)
- `verify(Request $request)`:
  - Validates `nid_number` (10 or 17 digits) and `date_of_birth` (`Y-m-d`).
  - Checks if user is already verified (`nid_verified == true`).
  - Computes `nid_hash` and checks if NID is already claimed by another user (`409 Conflict`).
  - Calls `NidVerificationGatewayInterface`.
  - Saves encrypted data, sets `nid_verified = true`, `verified_badge = true`, `nid_verified_at = now()`.
  - Dispatches `NidVerified` event.
  - Returns `ApiResponse::success` with verification metadata and masked NID.
- `status(Request $request)`:
  - Returns current user's verification status, badge status, and masked NID.

#### [MODIFY] [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
- Add `/api/v1/auth/nid/verify` and `/api/v1/auth/nid/status` under `auth:sanctum`.

#### [MODIFY] [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- Document `/api/v1/auth/nid/verify` and `/api/v1/auth/nid/status`.

### Automated Feature Tests (`Modules/Auth/tests/Feature`)

#### [NEW] [`NidVerificationTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Auth/tests/Feature/NidVerificationTest.php)
- Test 1: Authenticated citizen can verify valid 10-digit Smart NID and receive blue badge (`200 OK`).
- Test 2: NID number is encrypted at rest in the database (raw DB query shows ciphertext, not plain text).
- Test 3: Duplicate NID registration by another user is blocked via blind index (`409 Conflict`).
- Test 4: Invalid NID format or missing DOB fails validation (`422 Unprocessable Content`).
- Test 5: Sandbox gateway rejects non-existent NID starting with `999` (`422 Unprocessable Content`).
- Test 6: Citizen already verified cannot verify again (`400 Bad Request`).
- Test 7: Citizen can fetch current NID status and see masked NID (`200 OK`).
- Test 8: Successful verification dispatches `NidVerified` domain event.

---

## Verification Plan

### Automated Tests
Run the entire test suite:
```bash
php artisan test Modules/Auth/tests/Feature/NidVerificationTest.php
php artisan test Modules/Auth/tests/Feature
```
All tests must pass 100% green.

### Master Checklist & Docs Update
- Update `docs/task/master_engineering_task_checklist.md` marking TASK-010 complete.
- Update `docs/antigravity/chat/` with implementation plan, walkthrough, and chat log copies.
