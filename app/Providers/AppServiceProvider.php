<?php

namespace App\Providers;

use App\Contracts\FounderZengfyTop\MusicStreamInterface;
use App\Services\FounderZengfyTop\SpotifyService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            MusicStreamInterface::class,
            SpotifyService::class,
        );

        $this->app->bind(
            \Modules\Auth\Contracts\NidVerificationGatewayInterface::class,
            \Modules\Auth\Services\MockElectionCommissionNidGateway::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (is_dir(base_path('Modules/Landing/resources/views'))) {
            \Illuminate\Support\Facades\View::addNamespace('landing', base_path('Modules/Landing/resources/views'));
        }
        if (is_dir(base_path('Modules/Main/resources/views'))) {
            \Illuminate\Support\Facades\View::addNamespace('main', base_path('Modules/Main/resources/views'));
        }
        if (is_dir(base_path('Modules/Auth/resources/views'))) {
            \Illuminate\Support\Facades\View::addNamespace('auth', base_path('Modules/Auth/resources/views'));
        }
        if (is_dir(base_path('Modules/Social/resources/views'))) {
            \Illuminate\Support\Facades\View::addNamespace('social', base_path('Modules/Social/resources/views'));
        }

        // Automatically discover and load migrations from all domain Modules
        $modulesPath = base_path('Modules');
        if (is_dir($modulesPath)) {
            foreach (glob($modulesPath . '/*/database/migrations') as $migrationDir) {
                $this->loadMigrationsFrom($migrationDir);
            }
        }

        // Dedicated IP-based rate limiting for user registrations
        \Illuminate\Support\Facades\RateLimiter::for('registration', function (\Illuminate\Http\Request $request) {
            return \Illuminate\Cache\RateLimiting\Limit::perMinute(5)->by($request->ip());
        });

        // =========================================================================
        // Google-style Central SSO: Universal Guest Redirect to Central Identity Gateway
        // Whenever any unauthenticated user accesses an auth-protected route on any
        // subdomain or module (e.g. social.*, school.*, pos.*, law.*), seamlessly
        // redirect them to the Central Sovereign Login Portal with their destination continue URL.
        // =========================================================================
        \Illuminate\Auth\Middleware\Authenticate::redirectUsing(function (\Illuminate\Http\Request $request) {
            if (! $request->expectsJson()) {
                $scheme = $request->getScheme();
                $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
                $port = $request->getPort();
                $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : "";

                $centralLogin = "{$scheme}://{$baseDomain}{$portSuffix}/login";
                $target = $request->fullUrl();

                return "{$centralLogin}?continue=" . urlencode($target);
            }
        });
    }
}
