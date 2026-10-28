<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Auth\Models\AuthDevice;

class SsoController extends Controller
{
    /**
     * Allowed subdomains in the Zengfy Ecosystem.
     */
    public const ALLOWED_SUBDOMAINS = [
        'school',
        'pos',
        'law',
        'social',
        'hotel',
        'rent',
        'civil',
        'ngo',
        'journal',
        'skill',
        'emergency',
    ];

    /**
     * Ticket time-to-live in seconds (strict short-lived single-use window).
     */
    public const TICKET_TTL_SECONDS = 60;

    /**
     * Generate a single-use cryptographic SSO ticket for a target ecosystem subdomain.
     * Requires active Sanctum authentication on Central Identity (zengfy.top).
     */
    public function generateTicket(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'target_subdomain' => 'required|string|in:' . implode(',', self::ALLOWED_SUBDOMAINS),
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $user = $request->user();
        $targetSubdomain = $request->input('target_subdomain');

        // Cryptographically secure random ticket (sso_tkt_ + 48 hex chars)
        $ticket = 'sso_tkt_' . bin2hex(random_bytes(24));

        $ticketPayload = [
            'user_id' => $user->id,
            'target_subdomain' => $targetSubdomain,
            'created_at' => now()->timestamp,
        ];

        // Store ticket in cache with strict 60-second TTL
        Cache::put(
            "sso_ticket:{$ticket}",
            $ticketPayload,
            now()->addSeconds(self::TICKET_TTL_SECONDS)
        );

        $rootDomain = config('app.url_domain', 'zengfy.top');
        $redirectUrl = "https://{$targetSubdomain}.{$rootDomain}/auth/sso/callback?ticket={$ticket}";

        return ApiResponse::success([
            'ticket' => $ticket,
            'target_subdomain' => $targetSubdomain,
            'expires_in' => self::TICKET_TTL_SECONDS,
            'redirect_url' => $redirectUrl,
        ], 'SSO ticket generated successfully');
    }

    /**
     * Atomically exchange an SSO ticket for a scoped session token and device session.
     * Single-use only: the ticket is immediately consumed and invalidated.
     */
    public function exchangeTicket(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ticket' => 'required|string|starts_with:sso_tkt_',
            'subdomain' => 'required|string|in:' . implode(',', self::ALLOWED_SUBDOMAINS),
            'device_name' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $ticket = $request->input('ticket');
        $subdomain = $request->input('subdomain');

        // Atomic retrieval and eviction (Single-Use Replay Defense)
        $cachedTicket = Cache::pull("sso_ticket:{$ticket}");

        if (! $cachedTicket) {
            return ApiResponse::unauthorized('Invalid or expired SSO ticket.');
        }

        // Subdomain Spoofing Prevention: Target subdomain in ticket must match caller's subdomain
        if ($cachedTicket['target_subdomain'] !== $subdomain) {
            return ApiResponse::forbidden('SSO ticket was not issued for this domain.');
        }

        $user = User::find($cachedTicket['user_id']);

        if (! $user) {
            return ApiResponse::unauthorized('User associated with this SSO ticket no longer exists.');
        }

        $deviceName = $request->input('device_name') ?? $this->detectDeviceName($request, $subdomain);

        // Record or update device session in auth_devices
        $device = AuthDevice::updateOrCreate(
            [
                'user_id' => $user->id,
                'user_agent' => $request->userAgent(),
            ],
            [
                'device_name' => $deviceName,
                'ip_address' => $request->ip(),
                'last_active_at' => now(),
            ]
        );

        // Issue scoped Sanctum token for the target subdomain
        $tokenName = "{$subdomain}:sso_session";
        $tokenAbilities = ["{$subdomain}:*"];
        $token = $user->createToken($tokenName, $tokenAbilities)->plainTextToken;

        return ApiResponse::success([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $token,
            'subdomain' => $subdomain,
            'device' => [
                'id' => $device->id,
                'device_name' => $device->device_name,
                'last_active_at' => $device->last_active_at,
            ],
        ], 'SSO session established successfully');
    }

    /**
     * Helper to detect simple device string from user-agent and context.
     */
    protected function detectDeviceName(Request $request, string $subdomain): string
    {
        $userAgent = $request->userAgent() ?? '';
        $subdomainLabel = ucfirst($subdomain);

        if (str_contains($userAgent, 'Windows')) {
            return "Chrome on Windows ({$subdomainLabel})";
        } elseif (str_contains($userAgent, 'Macintosh')) {
            return "Safari on macOS ({$subdomainLabel})";
        } elseif (str_contains($userAgent, 'Android')) {
            return "Android App ({$subdomainLabel})";
        } elseif (str_contains($userAgent, 'iPhone')) {
            return "iOS App ({$subdomainLabel})";
        }

        return "Web Client ({$subdomainLabel})";
    }
}
