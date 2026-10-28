<?php

namespace Modules\Journal\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JournalLandingController extends Controller
{
    /**
     * Provide comprehensive telemetry, simulator and independent journalism data payload for Zengfy Journal.
     */
    protected function getJournalData(): array
    {
        $baseDomain = config('app.base_domain', 'zengfy.top');
        $port = config('app.port', 8000);
        $protocol = request()->secure() ? 'https://' : 'http://';
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : '';

        $jsonPath = base_path('Modules/Journal/resources/data/journal_data.json');
        if (file_exists($jsonPath)) {
            $raw = file_get_contents($jsonPath);
            $raw = str_replace(
                ['{{BASE_DOMAIN}}', '{{BASE_DOMAIN%}', '{{PORT_SUFFIX}}', '{{PROTOCOL}}'],
                [$baseDomain, $baseDomain, $portSuffix, $protocol],
                $raw
            );
            $data = json_decode($raw, true);
            if (is_array($data)) {
                return $data;
            }
        }

        return [];
    }

    /**
     * Display the Zengfy Journal dedicated landing page.
     */
    public function index(): View
    {
        $data = $this->getJournalData();

        return view('journal::landing', [
            'initialData' => $data,
        ]);
    }

    /**
     * Provide public REST API response for Zengfy Journal landing data.
     */
    public function data(Request $request): JsonResponse
    {
        $data = $this->getJournalData();

        return response()->json([
            'status' => 'success',
            'timestamp' => now()->toISOString(),
            'data' => $data,
        ], 200, [
            'Cache-Control' => 'public, max-age=300, stale-while-revalidate=86400',
        ]);
    }
}
