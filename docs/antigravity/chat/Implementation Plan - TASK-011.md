# Implementation Plan - TASK-011: Multi-Tenant Scoping & Organization Model

**Phase:** `PHASE 3: Multi-Tenant Organization & Granular RBAC`  
**Task ID:** `TASK-011`  
**Governing Standard:** `CONST-001 (Principle 5: Security & Authorization by Design)`

---

## Executive Summary & Architectural Overview

In a mega-ecosystem like Zengfy—spanning schools, law firms, healthcare clinics, and retail POS—guaranteeing **100% strict data isolation between tenants** is an existential security requirement. A teacher at *Viqarunnisa Noon School* must never accidentally or maliciously view records from *Dhaka Residential Model College*, even if a developer forgets to add `where('organization_id', ...)` in an Eloquent query.

In **TASK-011**, we implement the **Shared-Database Soft-Partitioning Pattern with Global Tenant Scoping** (used by Slack, Shopify, and Stripe). We build a dedicated domain module `Modules/Organization` featuring:
1. **Organization & OrganizationMembership Core Entities:** Universal UUID models capturing organization profiles and many-to-many user-organization relationships with roles (`owner`, `admin`, `member`) and statuses (`active`, `pending_invitation`).
2. **TenantContext Service:** A request-scoped container holding the actively resolved tenant.
3. **BelongsToTenant Trait & TenantScope:** An automatic Eloquent global scope appending `WHERE organization_id = :current_tenant_id` to all queries, coupled with model creation event listeners that auto-stamp `organization_id`.
4. **ResolveTenantContext Middleware:** Zero-trust HTTP middleware that resolves tenant from `X-Organization-Id` header or route parameters, verifies active membership for the authenticated user, and halts unauthorized access with HTTP 403 Forbidden.
5. **Concrete Tenant-Owned Entity (`OrganizationDepartment`):** Demonstrating and proving that child resources are automatically isolated, preventing BOLA/IDOR vulnerabilities.
6. **Automated Feature Test Suite (`TenantScopingTest`):** 100% test coverage verifying cross-tenant barriers, auto-stamping, membership authorization, and zero data leakage.

---

## User Review Required

> [!IMPORTANT]
> **Tenant Scoping Architecture Decision:**  
> We choose **Shared Database + Shared Schema with Global Eloquent Scopes & Composite Indexing** rather than Database-per-tenant.  
> **Why?** Database-per-tenant at 10,000+ organizations causes MySQL connection pool exhaustion and migration latency. Shared schema with strict global ORM scoping provides $O(1)$ fast lookups, unified migrations, and zero-trust data protection when combined with our `BelongsToTenant` trait.

> [!NOTE]
> All primary keys strictly utilize UUIDv4/v7 via `HasUuids` as mandated by `CONST-001`. All API responses adhere to the `ApiResponse` standard envelope.

---

## Proposed Changes

### 1. Domain Registration & Module Configuration

#### [MODIFY] [`modules_statuses.json`](file:///p:/Zengfy-Ecosystem/core/modules_statuses.json)
- Register `"Organization": true`.

---

### 2. Database Migrations (`Modules/Organization/database/migrations`)

#### [NEW] `2026_09_23_000010_create_organizations_table.php`
- `id`: UUID Primary Key
- `name`: string (e.g., "Dhaka Residential Model College")
- `slug`: string unique (e.g., "drmc-dhaka")
- `domain_type`: string (`school`, `law_firm`, `retail_pos`, `clinic`, `enterprise`)
- `is_active`: boolean (default `true`)
- `settings`: json nullable (branding, metadata)
- `created_by_user_id`: foreign UUID -> `users(id)`
- timestamps

#### [NEW] `2026_09_23_000011_create_organization_memberships_table.php`
- `id`: UUID Primary Key
- `organization_id`: foreign UUID -> `organizations(id)` on delete cascade
- `user_id`: foreign UUID -> `users(id)` on delete cascade
- `role`: string (`owner`, `admin`, `member`, `guest`)
- `status`: string (`active`, `pending_invitation`, `suspended`)
- `joined_at`: timestamp nullable
- timestamps
- Unique compound index on `['organization_id', 'user_id']`
- Composite index on `['user_id', 'status']`

#### [NEW] `2026_09_23_000012_create_organization_departments_table.php`
- `id`: UUID Primary Key
- `organization_id`: foreign UUID -> `organizations(id)` on delete cascade (indexed)
- `name`: string (e.g., "Science Faculty", "Accounts & Finance")
- `code`: string (e.g., "SCI-01")
- timestamps

---

### 3. Core Models & Multi-Tenant Engine (`Modules/Organization/app`)

#### [NEW] `Modules/Organization/app/Services/TenantContext.php`
- Request-scoped singleton holding active tenant:
  - `setTenant(?Organization $tenant): void`
  - `getTenant(): ?Organization`
  - `getTenantId(): ?string`
  - `hasTenant(): bool`
  - `clear(): void`
  - `runWithoutTenantScope(callable $callback): mixed` (safely executes administrative logic without tenant global scope).

#### [NEW] `Modules/Organization/app/Scopes/TenantScope.php`
- Implements `Illuminate\Database\Eloquent\Scope`:
  - In `apply(Builder $builder, Model $model)`:
    - If `TenantContext::hasTenant()`, appends `$builder->where($model->qualifyColumn('organization_id'), TenantContext::getTenantId())`.

#### [NEW] `Modules/Organization/app/Traits/BelongsToTenant.php`
- Eloquent Trait:
  - Registers `bootBelongsToTenant()`: attaches `TenantScope`.
  - Attaches `creating` listener: automatically populates `organization_id` with `TenantContext::getTenantId()` if not explicitly specified.
  - Defines `organization()` relationship: `belongsTo(Organization::class, 'organization_id')`.

#### [NEW] `Modules/Organization/app/Models/Organization.php`
- Uses `HasUuids`.
- Relationships:
  - `memberships()`: `hasMany(OrganizationMembership::class)`
  - `users()`: `belongsToMany(User::class, 'organization_memberships')->withPivot(['role', 'status'])`
  - `departments()`: `hasMany(OrganizationDepartment::class)`
- Helper methods: `hasMember(User $user)`, `isOwnedBy(User $user)`.

#### [NEW] `Modules/Organization/app/Models/OrganizationMembership.php`
- Uses `HasUuids`.
- Relationships:
  - `organization()`: `belongsTo(Organization::class)`
  - `user()`: `belongsTo(User::class)`

#### [NEW] `Modules/Organization/app/Models/OrganizationDepartment.php`
- Uses `HasUuids`, `BelongsToTenant`.
- Direct demonstration of tenant-scoped entity.

#### [MODIFY] [`app/Models/User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php)
- Add relationships:
  - `organizationMemberships()`: `hasMany(OrganizationMembership::class)`
  - `organizations()`: `belongsToMany(Organization::class, 'organization_memberships')`

---

### 4. Middleware & HTTP Layer

#### [NEW] `Modules/Organization/app/Http/Middleware/ResolveTenantContext.php`
- Pipeline logic:
  1. Inspects request for tenant identity via `X-Organization-Id` header OR route param `{organization}`.
  2. If present:
     - Locates Organization by UUID or slug. Returns HTTP 404 if not found.
     - Checks if authenticated user is an active member (`status = 'active'`).
     - If not member -> Returns HTTP 403 Forbidden with `ApiResponse::error('Forbidden: You are not an active member of this organization', 403)`.
     - Injects into `TenantContext::setTenant($org)`.
  3. Executes downstream request.
  4. In `terminate()`: cleans up `TenantContext::clear()`.

#### [NEW] `Modules/Organization/app/Http/Controllers/OrganizationController.php`
- `index()`: Returns all organizations the authenticated user belongs to.
- `store(CreateOrganizationRequest $request)`: Creates organization, sets current user as `owner` in `organization_memberships`.
- `show(string $id)`: Returns organization details (authorized only for active members).
- `inviteMember(InviteMemberRequest $request, string $id)`: Adds/invites user to organization (authorized only for `owner` or `admin`).
- `listMembers(string $id)`: Lists all members with their roles and statuses.

#### [NEW] `Modules/Organization/app/Http/Controllers/OrganizationDepartmentController.php`
- `index()`: List departments. (Thanks to `BelongsToTenant`, query is automatically scoped to active tenant).
- `store(Request $request)`: Create department. (Auto-stamped with active `organization_id`).

#### [MODIFY] [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
- Mount `/api/v1/organizations` routes with Sanctum auth and `resolve.tenant` middleware where appropriate.

---

## Verification Plan

### Automated Feature Tests
We will build a comprehensive test class:
[`Modules/Organization/tests/Feature/TenantScopingTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/tests/Feature/TenantScopingTest.php)

Assertions to verify:
1. `test_user_can_create_organization_and_becomes_owner()`
2. `test_user_cannot_access_organization_they_do_not_belong_to_returns_403()`
3. `test_global_tenant_scope_prevents_cross_tenant_data_leakage()`: School A querying departments returns ONLY School A's departments, never School B's, even when using `Department::all()`.
4. `test_tenant_resource_auto_stamping()`: Department created inside School A's context automatically has `organization_id = School A UUID`.
5. `test_direct_idor_access_to_another_tenants_resource_returns_404()`: Trying to access School B's department ID from School A returns 404 Not Found due to global scope.
6. `test_user_can_switch_between_multiple_tenants_via_header()`
7. `test_owner_can_invite_new_member_with_role()`

### Execution Command
```bash
php artisan test Modules/Organization/tests/Feature
php artisan test Modules/Auth/tests/Feature
```
Target: 100% Passing with zero regressions.
