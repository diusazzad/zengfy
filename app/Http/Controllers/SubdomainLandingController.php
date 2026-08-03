<?php

namespace App\Http\Controllers;

use App\Contracts\FounderZengfyTop\MusicStreamInterface;
use App\Services\FounderZengfyTop\GithubActivityService;
use App\Services\ModuleDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubdomainLandingController extends Controller
{
    protected $github;
    protected $music;
    public function __construct(GithubActivityService $github, MusicStreamInterface $musicStreamInterface)
    {
        $this->github = $github;
        $this->music = $musicStreamInterface;
    }
    public function show(Request $request, string $subdomain = null)
    {
        $githubState = null;
        $musicState = null;
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
        $githubState = null;
        if ($subdomain === 'founder') {
            $githubState = $this->github->getLatestActivity('diusazzad');
        }
        if ($subdomain === 'founder') {
            $githubState = $this->github->getLatestActivity('diusazzad');
            $musicState = $this->music->getCurrentPlaying();
        }


        return view('subdomain_landing', compact('module', 'githubState', 'musicState'));
    }
}
