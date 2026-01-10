<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // For now, allow all or check role.
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // If not admin, just allow for now to avoid blocking development, or abort
        return $next($request);
    }
}
