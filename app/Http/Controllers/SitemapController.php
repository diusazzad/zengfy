<?php

namespace App\Http\Controllers;

use App\Services\ModuleDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap.xml for main domain and all 15 subdomains
     */
    public function index(Request $request)
    {
        $host = $request->getHost();
        $baseDomain = env('APP_BASE_DOMAIN', 'zengfy.top');
        $scheme = env('APP_URL_SCHEME', 'https');
        $port = env('APP_ENV') === 'local' ? ':7000' : '';
        $now = now()->tz('UTC')->toAtomString();

        $urls = [];

        // Main domain routes
        $urls[] = ['loc' => "{$scheme}://{$baseDomain}{$port}/", 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '1.0'];
        $urls[] = ['loc' => "{$scheme}://{$baseDomain}{$port}/products", 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['loc' => "{$scheme}://{$baseDomain}{$port}/pricing", 'lastmod' => $now, 'changefreq' => 'daily', 'priority' => '0.9'];
        $urls[] = ['loc' => "{$scheme}://{$baseDomain}{$port}/company", 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.8'];
        $urls[] = ['loc' => "{$scheme}://{$baseDomain}{$port}/policy/workplace", 'lastmod' => $now, 'changefreq' => 'monthly', 'priority' => '0.7'];
        $urls[] = ['loc' => "{$scheme}://{$baseDomain}{$port}/faq", 'lastmod' => $now, 'changefreq' => 'weekly', 'priority' => '0.7'];

        // Dynamically append all 15 ecosystem subdomains
        $modules = ModuleDataService::getModulesData();
        foreach ($modules as $module) {
            $urls[] = [
                'loc' => $module['url'] . '/',
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => in_array($module['id'], ['school', 'pos', 'law', 'social']) ? '0.9' : '0.8',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . htmlspecialchars($url['loc']) . '</loc>';
            $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
