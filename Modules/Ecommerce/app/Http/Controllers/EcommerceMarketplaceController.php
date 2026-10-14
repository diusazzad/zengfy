<?php

namespace Modules\Ecommerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class EcommerceMarketplaceController extends Controller
{
    /**
     * Display the Zengfy Multi-Vendor Marketplace Home Feed.
     */
    public function index(): View
    {
        $initialData = $this->loadMarketplaceData();
        return view('ecommerce::marketplace', compact('initialData'));
    }

    /**
     * API endpoint returning the dynamic marketplace landing data.
     */
    public function getLandingData(): JsonResponse
    {
        $data = $this->loadMarketplaceData();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Helper to load and dynamically replace domain tokens in marketplace data.
     */
    protected function loadMarketplaceData(): array
    {
        $jsonPath = module_path('Ecommerce', 'resources/data/marketplace_data.json');
        
        if (!File::exists($jsonPath)) {
            return [];
        }

        $rawJson = File::get($jsonPath);
        $baseDomain = config('app.base_domain', env('APP_BASE_DOMAIN', 'zengfy.top'));
        $hydratedJson = str_replace('{{BASE_DOMAIN}}', $baseDomain, $rawJson);

        return json_decode($hydratedJson, true) ?: [];
    }
}
