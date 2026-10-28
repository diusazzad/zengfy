# 🎓 Engineering Walkthrough: TASK-018 — Academic Architecture: Classes, Sections & Subjects

**System Phase:** `Phase 6: Enterprise SaaS Workspaces (School ERP)`  
**Standard:** `CONST-001 (Sovereign Engineering Constitution)`  
**Module:** `Modules/School`  
**Test Suite Status:** 🟢 `114 Tests Passing (564 Assertions, 0 Failures)`  

---

## 1. Architectural Blueprint

The School ERP Academic Architecture models the foundational multi-tenant hierarchy across thousands of educational institutions on the Zengfy cloud platform:

```
┌────────────────────────────────────────────────────────┐
│               Organization (School Tenant)             │
│        (Strict Isolation via BelongsToTenant)          │
└───────────────────────────┬────────────────────────────┘
                            │ 1 : N
                            ▼
┌────────────────────────────────────────────────────────┐
│                      AcademicYear                      │
│        status: draft / active / archived               │
│        is_current: boolean (atomic uniqueness)         │
└───────────────────────────┬────────────────────────────┘
                            │ 1 : N
                            ▼
┌────────────────────────────────────────────────────────┐
│                      SchoolClass                       │
│        (numeric_grade, code, name, description)        │
└───────────────┬────────────────────────┬───────────────┘
                │ 1 : N                  │ 1 : N
                ▼                        ▼
┌────────────────────────┐      ┌────────────────────────┐
│        Section         │      │        Subject         │
│  capacity, room_number │      │ credits, pass/total    │
└────────────────────────┘      └────────────────────────┘
```

---

## 2. Implemented Components & Code Artifacts

### 2.1 Database Migrations
- [`Modules/School/database/migrations/2026_09_23_000040_create_academic_years_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000040_create_academic_years_table.php)
- [`Modules/School/database/migrations/2026_09_23_000041_create_school_classes_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000041_create_school_classes_table.php)
- [`Modules/School/database/migrations/2026_09_23_000042_create_sections_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000042_create_sections_table.php)
- [`Modules/School/database/migrations/2026_09_23_000043_create_subjects_table.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/database/migrations/2026_09_23_000043_create_subjects_table.php)

### 2.2 Domain Models
- [`Modules/School/app/Models/AcademicYear.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/AcademicYear.php)
- [`Modules/School/app/Models/SchoolClass.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/SchoolClass.php)
- [`Modules/School/app/Models/Section.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/Section.php)
- [`Modules/School/app/Models/Subject.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Models/Subject.php)

### 2.3 Service & Controller Layers
- [`Modules/School/app/Services/AcademicStructureService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Services/AcademicStructureService.php)
- [`Modules/School/app/Http/Controllers/AcademicStructureController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/School/app/Http/Controllers/AcademicStructureController.php)

### 2.4 Routes & OpenAPI
- Mounted under `/api/v1/organizations/{organization}/school/...` in [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
- Detailed endpoint specs added to [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)

---

## 3. Key Architectural Innovations

1. **Automatic Atomic Current Switching:**
   - Setting a new term as active triggers an atomic database update setting all other terms for that specific school tenant to `is_current = false`.
2. **One-Click Academic Rollover:**
   - The rollover service archives the old year and clones the entire class, section, and subject taxonomy into the new academic year within a single atomic `DB::transaction()`.
3. **Cross-Tenant IDOR Proofing:**
   - Attempting to query or modify another school's classes or subjects is intercepted by `tenant.resolve` and `TenantScope`, returning HTTP 403 or HTTP 404.

---

## 4. Test Suite Execution Results

Command:
```bash
php artisan test Modules/School/tests/Feature/AcademicStructureTest.php
```

Output:
```text
   PASS  Modules\School\Tests\Feature\AcademicStructureTest
  ✓ authenticated organization owner can create academic year
  ✓ setting academic year as current atomically unsets other years
  ✓ can create school classes sections and subjects
  ✓ duplicate section name within same class is rejected
  ✓ duplicate class name in same academic year is rejected
  ✓ academic year rollover archives old and clones structure to new year
  ✓ global tenant scope strictly prevents cross tenant access and idor
  ✓ member without academic manage permission is forbidden from modifications
  ✓ structure endpoint returns nested hierarchy tree

  Tests:    9 passed (58 assertions)
  Duration: 2.34s
```

Full System Run:
```text
  Tests:    114 passed (564 assertions)
  Duration: 11.77s
```
