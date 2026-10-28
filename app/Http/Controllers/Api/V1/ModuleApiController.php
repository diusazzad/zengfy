<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ModuleDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuleApiController extends Controller
{
    public function index(): JsonResponse
    {
        $modules = ModuleDataService::getModulesData();
        return response()->json([
            'status' => 'success',
            'meta' => [
                'total' => count($modules),
                'version' => 'v1',
            ],
            'data' => array_values($modules),
        ], 200);
    }
    /**
     * Get single module details by subdomain slug
     * GET /api/v1/modules/{subdomain}
     */
    public function show(string $subdomain): JsonResponse
    {
        $module = ModuleDataService::getModuleBySlug($subdomain);
        if (!$module) {
            return response()->json([
                'status' => 'error',
                'message' => "Module subdomain '{$subdomain}' was not found in Zengfy Ecosystem.",
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'meta' => [
                'subdomain' => $subdomain,
                'cached' => true,
            ],
            'data' => $module,
        ], 200);
    }
}
