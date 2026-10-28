<?php

namespace Modules\Organization\Http\Middleware;

use App\Http\Responses\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Modules\Organization\Services\TenantContext;
use Symfony\Component\HttpFoundation\Response;

class RequireTenantPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();

        if (!$user) {
            return ApiResponse::error(
                'Unauthenticated',
                Response::HTTP_UNAUTHORIZED,
                null,
                'UNAUTHENTICATED'
            );
        }

        $tenant = TenantContext::getTenant();

        if (!$tenant) {
            return ApiResponse::error(
                'Tenant context required for permission check',
                Response::HTTP_BAD_REQUEST,
                null,
                'MISSING_TENANT_CONTEXT'
            );
        }

        if (!$user->hasTenantPermission($permission, $tenant)) {
            return ApiResponse::error(
                "Forbidden: You lack the required permission [{$permission}] in this organization",
                Response::HTTP_FORBIDDEN,
                null,
                'INSUFFICIENT_PERMISSIONS'
            );
        }

        return $next($request);
    }
}
