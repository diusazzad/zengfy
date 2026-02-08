<?php

namespace Modules\Main\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TrendingService
{
    /**
     * Get trending topics or news.
     * For now, returns a mix of API news and curated local trends.
     */
    public function getTrends()
    {
        return Cache::remember('trending_topics', 3600, function () {
            // In a real scenario, we'd fetch from an API like NewsAPI.org
            // For this demo, we'll provide high-quality curated trends for Bangladesh/Tech
            return [
                [
                    'category' => 'Technology • Trending',
                    'title' => '#ZengfyEcosystem',
                    'posts_count' => '45k Posts',
                ],
                [
                    'category' => 'Business • Bangladesh',
                    'title' => 'Smart Bangladesh 2041',
                    'posts_count' => '120k Posts',
                ],
                [
                    'category' => 'Education • News',
                    'title' => 'Zeng School Launch',
                    'posts_count' => '12k Posts',
                ],
                [
                    'category' => 'Lifestyle • Food',
                    'title' => 'Dhaka Street Food Tour',
                    'posts_count' => '8k Posts',
                ],
                [
                    'category' => 'Startup • Trending',
                    'title' => '#FutureOfSaaS',
                    'posts_count' => '25k Posts',
                ],
            ];
        });
    }
}
