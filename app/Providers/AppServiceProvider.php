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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::addNamespace('main', base_path('Modules/Main/resources/views'));
    }
}
