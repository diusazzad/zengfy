# Walkthrough - TASK-012: Granular Role-Based Access Control (RBAC Engine)

**Phase:** `PHASE 3: Multi-Tenant Organization & Granular RBAC`  
**Milestone:** `TASK-012: Granular Role-Based Access Control (RBAC Engine)`  
**Status:** 🟢 **COMPLETED & 100% PASSING (9/9 Tests)**  
**Overall Test Baseline:** `50/50 Feature Tests Passing (245 Assertions)`

---

## 🏛️ High-Level Architectural Summary

In **TASK-012**, we implemented an enterprise-grade, high-performance **Tenant-Scoped RBAC Engine** inspired by **Google Cloud IAM and AWS IAM Policy Bindings**.

```
[User Request with Sanctum Token]
               │
               ▼
[ResolveTenantContext Middleware]
  - Binds active Organization to TenantContext
               │
               ▼
[RequireTenantPermission Middleware (`tenant.permission:departments.manage`)]
               │
               ▼
      [RbacEngine::hasPermission]
               │
               ├─► Is Organization Owner? ──► TRUE (Wildcard '*' Superadmin Bypass)
               │
               └─► Evaluates Cached Permissions (In-Memory / Redis)
                   - Checks user's active membership roles in this specific organization
                   - Returns TRUE if permission exists, else throws 403 INSUFFICIENT_PERMISSIONS
```

---

## 🛠️ Changes Implemented

### 1. Database Migrations (`Modules/Organization/database/migrations`)
- `2026_09_23_000020_create_roles_and_permissions_tables.php`:
  - `permissions`: UUID, `name`, `slug` (unique), `module`.
  - `roles`: UUID, `organization_id` (nullable: null = system template; UUID = custom tenant role), `name`, `slug`, `description`.
  - `role_permissions`: pivot linking `roles` and `permissions`.
  - `organization_membership_roles`: pivot linking `organization_memberships` and `roles` allowing members to hold multiple roles simultaneously.

### 2. Models & Traits
- [`Permission.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/Permission.php): Model with `roles()` relationship.
- [`Role.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/Role.php): Model with `permissions()`, `memberships()`, `givePermissionTo()`, `revokePermissionTo()`, `hasPermissionTo()`.
- [`HasTenantPermissions.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Traits/HasTenantPermissions.php): Trait included in [`User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php) exposing `$user->hasTenantPermission()`, `$user->assignTenantRole()`, `$user->removeTenantRole()`.
- [`OrganizationMembership.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Models/OrganizationMembership.php): Added `roles()` relationship.

### 3. Core Engine & Middleware
- [`RbacEngine.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Services/RbacEngine.php): Fast permission aggregation, owner wildcard bypass, in-memory & Redis caching, and cache invalidation.
- [`RequireTenantPermission.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Http/Middleware/RequireTenantPermission.php): Middleware enforcing zero-trust permission checks. Registered as `'tenant.permission'` in [`bootstrap/app.php`](file:///p:/Zengfy-Ecosystem/core/bootstrap/app.php).

### 4. Controllers & Routes
- [`RoleController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/app/Http/Controllers/RoleController.php): `listPermissions`, `index`, `store`, `assignRoleToMember`, `removeRoleFromMember`.
- [`OrganizationRbacSeeder.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Organization/database/seeders/OrganizationRbacSeeder.php): Seeds baseline permissions and template roles (`admin`, `member`).
- [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php): Mounted RBAC endpoints and applied `tenant.permission:departments.manage` to department creation.
- [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml): Documented all RBAC endpoints in OpenAPI 3.1.

---

## 🧪 Verification & Automated Test Evidence

Command executed:
```bash
php artisan test Modules/Organization/tests/Feature/TenantRbacTest.php
```

Output:
```text
   PASS  Modules\Organization\Tests\Feature\TenantRbacTest
  ✓ system seed roles and permissions are bootstrapped                           1.38s  
  ✓ organization owner has wildcard permission access                            0.08s  
  ✓ member without required permission is blocked with 403                       0.14s  
  ✓ member with granted role can perform authorized action                       0.09s  
  ✓ tenant owner can create custom role with specific permissions                0.08s  
  ✓ role assignment immediately grants permissions                               0.08s  
  ✓ cross tenant role isolation guaranteed                                       0.07s  
  ✓ revoking role invalidates cache and blocks subsequent requests               0.08s  
  ✓ public permissions endpoint returns grouped permissions                      0.07s  

  Tests:    9 passed (28 assertions)
  Duration: 2.70s
```

Full Feature Suite Verification across Central Identity, Multi-Tenancy & RBAC:
```bash
php artisan test Modules/Auth/tests/Feature Modules/Organization/tests/Feature
```

```text
  Tests:    50 passed (245 assertions)
  Duration: 4.55s
```
