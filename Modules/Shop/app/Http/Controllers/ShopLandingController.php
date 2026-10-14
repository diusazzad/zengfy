<?php

namespace Modules\Shop\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopLandingController extends Controller
{
    /**
     * Provide comprehensive clothing catalog and atelier brand data payload for Zengfy Atelier.
     */
    protected function getShopData(): array
    {
        $baseDomain = config('app.base_domain', 'zengfy.top');
        $port = config('app.port', 8000);
        $protocol = request()->secure() ? 'https://' : 'http://';
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : '';

        $jsonPath = base_path('Modules/Shop/resources/data/clothing_data.json');
        if (file_exists($jsonPath)) {
            $raw = file_get_contents($jsonPath);
            $raw = str_replace(
                ['{{BASE_DOMAIN}}', '{{PORT_SUFFIX}}', '{{PROTOCOL}}'],
                [$baseDomain, $portSuffix, $protocol],
                $raw
            );
            $data = json_decode($raw, true);
            if (is_array($data)) {
                $data['auth']['is_authenticated'] = auth()->check();
                $data['auth']['user'] = auth()->user() ? [
                    'id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ] : null;

                return $data;
            }
        }

        return [];
    }

    /**
     * Display the dedicated React 19 Zengfy Atelier Clothing Brand Storefront.
     */
    public function index(Request $request): View|JsonResponse
    {
        $initialData = $this->getShopData();

        if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
            return response()->json([
                'status' => 'success',
                'timestamp' => now()->toIso8601String(),
                'data' => $initialData,
            ], 200, [
                'Cache-Control' => 'public, max-age=300, stale-while-revalidate=86400',
            ]);
        }

        return view('shop::landing', compact('initialData'));
    }

    /**
     * Provide public REST API endpoint for Atelier Clothing catalog data.
     */
    public function data(Request $request): JsonResponse
    {
        $data = $this->getShopData();

        return response()->json([
            'status' => 'success',
            'timestamp' => now()->toIso8601String(),
            'data' => $data,
        ], 200, [
            'Cache-Control' => 'public, max-age=300, stale-while-revalidate=86400',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With',
        ]);
    }
}
