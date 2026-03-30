<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    /**
     * Generate sitemap.xml
     */
    public function index()
    {
        $urls = [
            [
                'loc' => url('/'),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0',
            ],
            // Add other main routes here as they are developed
            [
                'loc' => url('/login'),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ],
        ];

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
