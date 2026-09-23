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
        \Illuminate\Support\Facades\View::addNamespace('main', base_path('Modules/Main/resources/views'));

        // Automatically discover and load migrations from all domain Modules
        $modulesPath = base_path('Modules');
        if (is_dir($modulesPath)) {
            foreach (glob($modulesPath . '/*/database/migrations') as $migrationDir) {
                $this->loadMigrationsFrom($migrationDir);
            }
        }
    }
}
