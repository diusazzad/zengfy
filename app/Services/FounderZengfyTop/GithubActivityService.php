<?php

namespace App\Services\FounderZengfyTop;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GithubActivityService
{

    public function getLatestActivity(string $username): array
    {
        return Cache::remember("github_activity_{$username}", 900, function () use ($username) {

            $response = Http::withoutVerifying()->withHeaders([
                'User-Agent' => 'Zengfy-Ecosystem'
            ])->get("https://api.github.com/users/{$username}/events/public");
            if ($response->successful()) {
                $events = $response->json();
                $commitsToday = 0;
                $latestProject = 'No recent activity';
                $status = 'Taking a break ☕';
                foreach ($events as $event) {
                    if ($event['type'] === 'PushEvent') {
                        $commitsToday += count($event['payload']['commits'] ?? []);
                        if ($latestProject === 'No recent activity') {
                            $latestProject = str_replace($username . '/', '', $event['repo']['name']);
                            $status = 'Active & Coding right now 🔥';
                        }
                    }
                }
                return [
                    'username' => $username,
                    'commits_today' => $commitsToday,
                    'latest_project' => $latestProject,
                    'status' => $status
                ];
            }
            // Fallback if API fails
            return [
                'username' => $username,
                'commits_today' => 0,
                'latest_project' => 'Unable to fetch',
                'status' => 'Offline'
            ];
        });
    }


}
