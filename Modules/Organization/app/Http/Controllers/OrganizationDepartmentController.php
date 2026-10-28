<?php

namespace Modules\Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Organization\Models\OrganizationDepartment;
use Symfony\Component\HttpFoundation\Response;

class OrganizationDepartmentController extends Controller
{
    /**
     * List departments for the active tenant.
     * Note: TenantScope automatically filters queries by organization_id!
     */
    public function index(Request $request): JsonResponse
    {
        $departments = OrganizationDepartment::all();

        return ApiResponse::success($departments, 'Tenant departments retrieved successfully');
    }

    /**
     * Create a department for the active tenant.
     * Note: BelongsToTenant automatically stamps organization_id!
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50'],
        ]);

        $department = OrganizationDepartment::create($validated);

        return ApiResponse::created($department, 'Department created successfully');
    }

    /**
     * View a specific department.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $department = OrganizationDepartment::find($id);

        if (!$department) {
            return ApiResponse::error('Department not found', Response::HTTP_NOT_FOUND, null, 'DEPARTMENT_NOT_FOUND');
        }

        return ApiResponse::success($department, 'Department retrieved successfully');
    }
}
