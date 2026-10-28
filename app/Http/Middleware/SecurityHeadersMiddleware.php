<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request and apply intelligent caching & security headers.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Don't add headers to binary file responses to avoid errors
        if (method_exists($response, 'header')) {
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('X-XSS-Protection', '1; mode=block');
            $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
            $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');
            $response->header('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

            $path = $request->path();

            // 1. Immutable Long-term browser cache (1 Year) for versioned build assets & static downloads
            if (str_starts_with($path, 'build/') || str_starts_with($path, 'downloads/')) {
                $response->header('Cache-Control', 'public, max-age=31536000, immutable');
            }
            // 2. Medium cache (30 Days) for images, icons & logos with stale-while-revalidate
            elseif (str_starts_with($path, 'images/') || $path === 'favicon.ico' || str_ends_with($path, '.png') || str_ends_with($path, '.webp')) {
                $response->header('Cache-Control', 'public, max-age=2592000, stale-while-revalidate=86400');
            }
            // 3. Service Worker must NEVER be cached by browser HTTP cache
            elseif ($path === 'sw.js') {
                $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
                $response->header('Pragma', 'no-cache');
            }
            // 4. Authenticated, user-specific or sensitive stateful paths -> strict no-store (bfcache safe)
            elseif ($request->user() || str_starts_with($path, 'account') || str_starts_with($path, 'dashboard') || str_starts_with($path, 'api/v1/auth')) {
                $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
                $response->header('Pragma', 'no-cache');
                $response->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
            }
            // 5. Public web landing and informational pages -> short cache with stale-while-revalidate
            else {
                $response->header('Cache-Control', 'public, max-age=300, stale-while-revalidate=86400');
            }
        }

        return $response;
    }
}
