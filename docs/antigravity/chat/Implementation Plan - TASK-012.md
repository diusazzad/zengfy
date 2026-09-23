# Implementation Plan - TASK-012: Granular Role-Based Access Control (RBAC Engine)

**Phase:** `PHASE 3: Multi-Tenant Organization & Granular RBAC`  
**Task ID:** `TASK-012`  
**Governing Standards:** `CONST-001 (Principle 4: Dependency Direction, Principle 5: Security & Authorization by Design)`

---

## Executive Summary & Architectural Overview

In **TASK-011**, we established tenant isolation so that School A can never read School B's data. However, **isolation is only half of enterprise security**. Inside School A, you cannot allow a Teacher to view the school's financial bank accounts, nor can you allow a Student to modify exam marks or attendance.

In **TASK-012**, we build an enterprise-grade, high-performance **Tenant-Scoped RBAC Engine** inspired by **Google Cloud IAM and AWS IAM Policy Bindings**:
1. **Roles vs. Permissions Separation:** 
   - Permissions are atomic capability flags (`departments.manage`, `attendance.mark`, `finance.view_ledger`, `exam.publish`).
   - Roles are bundles of permissions (`Principal`, `Teacher`, `Accountant`).
2. **Tenant-Scoped Roles & System Templates:**
   - System template roles (`admin`, `member`, `guest`) with default permission sets.
   - Custom tenant roles (organizations can create custom roles with tailored permission sets).
3. **Multi-Role Assignment (`organization_membership_roles`):**
   - A member can hold multiple roles simultaneously within an organization (e.g., "Senior Teacher" + "Sports Coordinator").
4. **Zero-Latency In-Memory & Redis Permission Caching (`RbacEngine`):**
   - Fast $O(1)$ bitmap/set lookup without running complex SQL joins on every HTTP request.
   - Automated cache invalidation when roles or assignments are updated.
5. **Owner Superadmin Bypass:**
   - Organization `owner` holds wildcard access (`*`), eliminating permission deadlock.
6. **Zero-Trust Permission Middleware (`RequireTenantPermission`):**
   - Enforces `middleware('tenant.permission:departments.manage')` halting unauthorized requests with HTTP 403 `INSUFFICIENT_PERMISSIONS`.
7. **Cross-Tenant Role Isolation:**
   - A user who is `Principal` in School A has ZERO administrative privileges in School B.

---

## User Review Required

> [!IMPORTANT]
> **Tenant-Scoped RBAC vs Global Roles:**  
> Roles are **NEVER** stored directly on the `users` table as a static column (e.g., `users.role = 'teacher'`). In Zengfy, user roles are strictly scoped to an `OrganizationMembership`. This allows a citizen to be a Teacher in School A and a Parent in School B without privilege pollution.

> [!NOTE]
> All tables strictly utilize Universal UUID primary keys via `HasUuids` as mandated by `CONST-001`.

---

## Proposed Changes

### 1. Database Migrations (`Modules/Organization/database/migrations`)

#### [NEW] `2026_09_23_000020_create_roles_and_permissions_tables.php`
- `permissions` table:
  - `id`: UUID Primary Key
  - `name`: string
  - `slug`: string (unique)
  - `module`: string (default 'core')
  - timestamps
- `roles` table:
  - `id`: UUID Primary Key
  - `organization_id`: nullable foreign UUID -> `organizations(id)` (NULL = system template; UUID = custom tenant role)
  - `name`: string
  - `slug`: string
  - `description`: string nullable
  - timestamps
  - index on `['organization_id', 'slug']`
- `role_permissions` pivot table:
  - `role_id`: foreign UUID -> `roles(id)` on delete cascade
  - `permission_id`: foreign UUID -> `permissions(id)` on delete cascade
  - primary key: `['role_id', 'permission_id']`
- `organization_membership_roles` pivot table:
  - `membership_id`: foreign UUID -> `organization_memberships(id)` on delete cascade
  - `role_id`: foreign UUID -> `roles(id)` on delete cascade
  - primary key: `['membership_id', 'role_id']`

---

### 2. Core Domain Models & Services (`Modules/Organization/app`)

#### [NEW] `Modules/Organization/app/Models/Permission.php`
- Uses `HasUuids`.
- Relationships: `roles()`: belongsToMany `Role`.

#### [NEW] `Modules/Organization/app/Models/Role.php`
- Uses `HasUuids`.
- Relationships:
  - `organization()`: belongsTo `Organization`
  - `permissions()`: belongsToMany `Permission`
  - `memberships()`: belongsToMany `OrganizationMembership`
- Helper methods: `givePermissionTo()`, `revokePermissionTo()`, `hasPermissionTo()`.

#### [NEW] `Modules/Organization/app/Services/RbacEngine.php`
- High-performance permission evaluation and caching:
  - `getUserPermissions(User $user, Organization $organization): array`
  - `hasPermission(User $user, Organization $organization, string $permissionSlug): bool`
  - `invalidateUserPermissions(User $user, Organization $organization): void`

#### [NEW] `Modules/Organization/app/Traits/HasTenantPermissions.php`
- Trait for `User` model:
  - `hasTenantPermission(string $permissionSlug, ?Organization $organization = null): bool`
  - `assignTenantRole(Role|string $role, Organization $organization): void`
  - `removeTenantRole(Role|string $role, Organization $organization): void`
  - `getTenantRoles(Organization $organization): Collection`

#### [MODIFY] [`app/Models/User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php)
- Include `HasTenantPermissions` trait.

#### [MODIFY] [`Modules/Organization/app/Models/OrganizationMembership.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/OrganizationMembership.php)
- Add `roles()` relationship (`belongsToMany(Role::class, 'organization_membership_roles', 'membership_id', 'role_id')`).

---

### 3. Middleware & HTTP Layer

#### [NEW] `Modules/Organization/app/Http/Middleware/RequireTenantPermission.php`
- Inspects active `TenantContext`.
- Checks `$request->user()->hasTenantPermission($permission, $tenant)`.
- If unauthorized, returns HTTP 403 Forbidden with `INSUFFICIENT_PERMISSIONS` code.

#### [MODIFY] [`bootstrap/app.php`](file:///p:/Zengfy-Ecosystem/core/bootstrap/app.php)
- Register `'tenant.permission' => \Modules\Organization\Http\Middleware\RequireTenantPermission::class`.

#### [NEW] `Modules/Organization/app/Http/Controllers/RoleController.php`
- `listPermissions()`: List all available system permissions grouped by module.
- `index()`: List all roles available to the tenant (system + custom).
- `store()`: Create a custom tenant role with permissions (requires `roles.manage`).
- `assignRoleToMember()`: Assign a role to an organization member.
- `removeRoleFromMember()`: Remove a role from an organization member.

#### [MODIFY] [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
- Register role management routes under `/api/v1/organizations/{organization}/roles`.
- Apply `tenant.permission:departments.manage` to department creation to prove RBAC protection in tests.

#### [MODIFY] [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- Document role management endpoints and permission requirements.

---

## Verification Plan

### Automated Feature Tests
We will build a comprehensive test class:
[`Modules/Organization/tests/Feature/TenantRbacTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/tests/Feature/TenantRbacTest.php)

Assertions to verify:
1. `test_system_seed_roles_and_permissions_are_created_successfully()`
2. `test_organization_owner_has_wildcard_permission_access()`
3. `test_member_without_required_permission_is_blocked_with_403()` (e.g. Teacher cannot create departments).
4. `test_member_with_granted_role_can_perform_authorized_action()` (e.g. Principal with `departments.manage` creates department).
5. `test_tenant_owner_can_create_custom_role_with_specific_permissions()`
6. `test_role_assignment_immediately_grants_permissions()`
7. `test_cross_tenant_role_isolation()` (Role granted in School A does NOT grant privileges in School B).
8. `test_revoking_role_invalidates_cache_and_blocks_subsequent_requests()`

### Execution Command
```bash
php artisan test Modules/Organization/tests/Feature
php artisan test Modules/Auth/tests/Feature
```
Target: 100% Passing with zero regressions (50+ tests total).
