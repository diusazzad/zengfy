<?php

namespace App\Services\FounderZengfyTop;

use App\Contracts\FounderZengfyTop\MusicStreamInterface;
use Override;

class SpotifyService implements MusicStreamInterface
{
    #[Override]
    public function getCurrentPlaying(): array
    {
        return [
            'is_playing' => true,
            'title' => 'Starboy',
            'artist' => 'The Weeknd, Daft Punk',
            'album_art' => 'https://i.scdn.co/image/ab67616d0000b2734718e2b124f79258be7bc452',
            'spotify_url' => 'https://open.spotify.com/track/7MXVkk9YMqq6vq0c0yq9O8',

            // specific song
            'track_id' => '1eCrtZ9IuaeBMjTdPU453W',
        ];
    }
}
