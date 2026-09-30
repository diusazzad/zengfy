<?php

namespace Modules\Organization\Http\Middleware;

use App\Http\Responses\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationMembership;
use Modules\Organization\Services\TenantContext;
use Symfony\Component\HttpFoundation\Response;

class ResolveTenantContext
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, bool $required = true): Response
    {
        $tenantIdentifier = $request->route('organization') 
            ?? $request->route('organization_id') 
            ?? $request->header('X-Organization-Id');

        if (!$tenantIdentifier) {
            if ($required) {
                return ApiResponse::error(
                    'Tenant context required: missing X-Organization-Id header or organization route parameter',
                    Response::HTTP_BAD_REQUEST,
                    null,
                    'MISSING_TENANT_CONTEXT'
                );
            }

            return $next($request);
        }

        // Resolve organization by UUID, slug, or bound instance
        if ($tenantIdentifier instanceof Organization) {
            $organization = $tenantIdentifier;
        } else {
            $organization = Organization::where('id', $tenantIdentifier)
                ->orWhere('slug', $tenantIdentifier)
                ->first();
        }

        if (!$organization) {
            return ApiResponse::error(
                'Organization not found',
                Response::HTTP_NOT_FOUND,
                null,
                'ORGANIZATION_NOT_FOUND'
            );
        }

        if (!$organization->is_active) {
            return ApiResponse::error(
                'Organization is inactive or suspended',
                Response::HTTP_FORBIDDEN,
                null,
                'ORGANIZATION_INACTIVE'
            );
        }

        // Zero-Trust Tenant Authorization: Ensure authenticated user is an active member
        $user = $request->user();
        if ($user) {
            $isMember = OrganizationMembership::where('organization_id', $organization->id)
                ->where('user_id', $user->id)
                ->where('status', 'active')
                ->exists();

            if (!$isMember) {
                return ApiResponse::error(
                    'Forbidden: You are not an active member of this organization',
                    Response::HTTP_FORBIDDEN,
                    null,
                    'TENANT_ACCESS_DENIED'
                );
            }
        }

        TenantContext::setTenant($organization);
        $request->attributes->set('tenant', $organization);

        return $next($request);
    }

    /**
     * Clean up the tenant context after the response is prepared.
     */
    public function terminate(Request $request, Response $response): void
    {
        TenantContext::clear();
    }
}
