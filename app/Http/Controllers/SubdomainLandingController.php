<?php

namespace App\Http\Controllers;

use App\Services\ModuleDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubdomainLandingController extends Controller
{
    public function show(Request $request, string $subdomain = null)
    {
        if (!$subdomain) {
            $host = $request->getHost();
            $parts = explode('.', $host);
            $subdomain = $parts[0] ?? 'school';
        }
        $module = ModuleDataService::getModuleBySlug($subdomain);
        if (!$module) {
            // Fallback to School or Main Welcome
            return redirect()->route('welcome');
        }
        return view('subdomain_landing', compact('module'));
    }
}
