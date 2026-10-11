<?php

use App\Http\Controllers\Api\V1\ModuleApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ModuleApiController::class)->prefix('v1')->group(function () {
    Route::get('/modules', 'index')->middleware(['throttle:60,1'])->name('api.v1.modules.index');
    Route::get('/modules/{subdomain}', 'show')->middleware(['throttle:60,1'])->name('api.v1.modules.show');
});

// Central Identity & Authentication Routes (v1)
require base_path('Modules/Auth/routes/api.php');

// Multi-Tenant Organization & Granular Scoping Routes (v1)
Route::prefix('v1/organizations')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'index'])
        ->name('api.v1.organizations.index');

    Route::post('/', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'store'])
        ->name('api.v1.organizations.store');

    Route::get('/{organization}', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'show'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.show');

    Route::post('/{organization}/members', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'inviteMember'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.members.invite');

    Route::get('/{organization}/members', [\Modules\Organization\Http\Controllers\OrganizationController::class, 'listMembers'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.members.index');

    // Tenant-Scoped Resources (demonstrating BelongsToTenant & Global TenantScope)
    Route::get('/{organization}/departments', [\Modules\Organization\Http\Controllers\OrganizationDepartmentController::class, 'index'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.departments.index');

    Route::post('/{organization}/departments', [\Modules\Organization\Http\Controllers\OrganizationDepartmentController::class, 'store'])
        ->middleware(['tenant.resolve', 'tenant.permission:departments.manage'])
        ->name('api.v1.organizations.departments.store');

    Route::get('/{organization}/departments/{department}', [\Modules\Organization\Http\Controllers\OrganizationDepartmentController::class, 'show'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.departments.show');

    // Granular RBAC Role Management
    Route::get('/{organization}/roles', [\Modules\Organization\Http\Controllers\RoleController::class, 'index'])
        ->middleware(['tenant.resolve'])
        ->name('api.v1.organizations.roles.index');

    Route::post('/{organization}/roles', [\Modules\Organization\Http\Controllers\RoleController::class, 'store'])
        ->middleware(['tenant.resolve', 'tenant.permission:roles.manage'])
        ->name('api.v1.organizations.roles.store');

    Route::post('/{organization}/members/{membership}/roles', [\Modules\Organization\Http\Controllers\RoleController::class, 'assignRoleToMember'])
        ->middleware(['tenant.resolve', 'tenant.permission:roles.manage'])
        ->name('api.v1.organizations.members.roles.assign');

    Route::delete('/{organization}/members/{membership}/roles/{role}', [\Modules\Organization\Http\Controllers\RoleController::class, 'removeRoleFromMember'])
        ->middleware(['tenant.resolve', 'tenant.permission:roles.manage'])
        ->name('api.v1.organizations.members.roles.remove');

    // School Academic Architecture (TASK-018)
    Route::prefix('{organization}/school')->middleware(['tenant.resolve'])->group(function () {
        Route::get('/academic-years', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'indexAcademicYears'])
            ->name('api.v1.organizations.school.academic-years.index');

        Route::post('/academic-years', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeAcademicYear'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.academic-years.store');

        Route::post('/academic-years/{academicYear}/set-current', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'setCurrentAcademicYear'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.academic-years.set-current');

        Route::post('/academic-years/{academicYear}/rollover', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'rolloverAcademicYear'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.academic-years.rollover');

        Route::get('/classes', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'indexClasses'])
            ->name('api.v1.organizations.school.classes.index');

        Route::post('/classes', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeClass'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.classes.store');

        Route::get('/classes/{class}', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'showClass'])
            ->name('api.v1.organizations.school.classes.show');

        Route::post('/classes/{class}/sections', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeSection'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.classes.sections.store');

        Route::post('/classes/{class}/subjects', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'storeSubject'])
            ->middleware(['tenant.permission:academic.manage'])
            ->name('api.v1.organizations.school.classes.subjects.store');

        Route::get('/structure', [\Modules\School\Http\Controllers\AcademicStructureController::class, 'structure'])
            ->name('api.v1.organizations.school.structure');
    });
});

Route::get('v1/permissions', [\Modules\Organization\Http\Controllers\RoleController::class, 'listPermissions'])
    ->middleware(['auth:sanctum'])
    ->name('api.v1.permissions.index');

// Social Module API Routes (v1)
require base_path('Modules/Social/routes/api.php');
