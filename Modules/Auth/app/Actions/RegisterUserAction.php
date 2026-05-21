<?php

namespace Modules\Auth\Actions;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;

class RegisterUserAction
{
    /**
     * Execute the registration logic.
     *
     * @param array $data Validated user data
     * @return array
     */
    public function execute(array $data)
    {
        // 1. Capture User's IP Address
        $ip = request()->ip();

        // Use a test IP if working on localhost
        if ($ip == '127.0.0.1' || $ip == '::1') {
            $ip = '103.155.220.1'; // An example IP (Bangladesh) for testing GeoIP locally
        }

        $locationData = null;

        // 2. Fetch Geolocation from IP
        if ($ip) {
            $locationData = Location::get($ip);
        }

        // 3. Create User with Tracking Info
        $user = User::create([
            'uuid' => (string) Str::uuid(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            // Intelligence Data
            'registration_ip' => $ip,
            'country_code' => $locationData ? $locationData->countryCode : null,
            'city' => $locationData ? $locationData->cityName : null,
        ]);

        return [
            'user' => $user,
        ];
    }
}
