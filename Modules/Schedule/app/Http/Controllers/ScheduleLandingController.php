<?php

namespace Modules\Schedule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleLandingController extends Controller
{
    /**
     * Provide comprehensive telemetry, simulator and consultation booking data payload for Zengfy Schedule.
     */
    protected function getScheduleData(): array
    {
        $baseDomain = config('app.base_domain', 'zengfy.test');
        $port = config('app.port', 8000);
        $protocol = request()->secure() ? 'https://' : 'http://';
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : '';

        $jsonPath = base_path('Modules/Schedule/resources/data/schedule_data.json');
        if (file_exists($jsonPath)) {
            $raw = file_get_contents($jsonPath);
            $raw = str_replace(
                ['{{BASE_DOMAIN}}', '{{PORT_SUFFIX}}', '{{PROTOCOL}}'],
                [$baseDomain, $portSuffix, $protocol],
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
     * Display the Zengfy Schedule dedicated landing page (or JSON if requested).
     */
    public function index(Request $request): View|JsonResponse
    {
        $data = $this->getScheduleData();

        if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
            return response()->json([
                'status' => 'success',
                'timestamp' => now()->toISOString(),
                'data' => $data,
            ], 200, [
                'Cache-Control' => 'public, max-age=300, stale-while-revalidate=86400',
            ]);
        }

        return view('schedule::landing', [
            'initialData' => $data,
        ]);
    }

    /**
     * Provide public REST API response for Zengfy Schedule landing data.
     */
    public function data(Request $request): JsonResponse
    {
        $data = $this->getScheduleData();

        return response()->json([
            'status' => 'success',
            'timestamp' => now()->toISOString(),
            'data' => $data,
        ], 200, [
            'Cache-Control' => 'public, max-age=300, stale-while-revalidate=86400',
        ]);
    }
}
