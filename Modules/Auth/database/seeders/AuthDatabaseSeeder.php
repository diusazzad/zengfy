<?php

namespace Modules\Auth\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\AuthDevice;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds for Central Identity & Authentication.
     */
    public function run(): void
    {
        // 1. Super Admin / Founder Sovereign Account (handles user@test.com or admin@zengfy.test)
        $admin = User::where('email', 'user@test.com')
            ->orWhere('email', 'admin@zengfy.test')
            ->orWhere('handle', 'sazzad')
            ->first();

        if ($admin) {
            $admin->update([
                'name' => 'Sazzad Hossain',
                'handle' => 'sazzad',
                'email' => 'admin@zengfy.test',
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'phone' => '+8801700000001',
                'avatar' => 'https://ui-avatars.com/api/?name=Sazzad+Hossain&background=2563eb&color=fff',
                'bio' => 'Founder & Lead Architect of the Zengfy Sovereign Ecosystem.',
                'ward_code' => '1001',
                'thana_code' => 'DHK-01',
                'district_code' => 'DHK',
                'nid_verified' => true,
                'verified_badge' => true,
                'nid_verified_at' => now(),
            ]);
        } else {
            $admin = User::create([
                'name' => 'Sazzad Hossain',
                'handle' => 'sazzad',
                'email' => 'admin@zengfy.test',
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'phone' => '+8801700000001',
                'avatar' => 'https://ui-avatars.com/api/?name=Sazzad+Hossain&background=2563eb&color=fff',
                'bio' => 'Founder & Lead Architect of the Zengfy Sovereign Ecosystem.',
                'ward_code' => '1001',
                'thana_code' => 'DHK-01',
                'district_code' => 'DHK',
                'nid_verified' => true,
                'verified_badge' => true,
                'nid_verified_at' => now(),
            ]);
        }

        // Attach desktop device session
        AuthDevice::updateOrCreate(
            [
                'user_id' => $admin->id,
                'device_name' => 'Chrome on Windows 11 Desktop',
            ],
            [
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                'last_active_at' => now(),
            ]
        );

        // Pre-generate API Token for developer testing
        if ($admin->tokens()->where('name', 'admin-desktop-token')->doesntExist()) {
            $admin->createToken('admin-desktop-token');
        }

        // 2. Verified Citizen Account (Ayesha Rahman)
        $citizen = User::where('email', 'ayesha@zengfy.test')
            ->orWhere('handle', 'ayesha')
            ->first();

        if ($citizen) {
            $citizen->update([
                'name' => 'Ayesha Rahman',
                'handle' => 'ayesha',
                'email' => 'ayesha@zengfy.test',
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'user_type' => 'citizen',
                'phone' => '+8801700000002',
                'avatar' => 'https://ui-avatars.com/api/?name=Ayesha+Rahman&background=06b6d4&color=fff',
                'bio' => 'Verified citizen actively contributing to community security and education.',
                'ward_code' => '1002',
                'thana_code' => 'DHK-02',
                'district_code' => 'DHK',
                'nid_verified' => true,
                'verified_badge' => true,
                'nid_verified_at' => now(),
            ]);
        } else {
            $citizen = User::create([
                'name' => 'Ayesha Rahman',
                'handle' => 'ayesha',
                'email' => 'ayesha@zengfy.test',
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'user_type' => 'citizen',
                'phone' => '+8801700000002',
                'avatar' => 'https://ui-avatars.com/api/?name=Ayesha+Rahman&background=06b6d4&color=fff',
                'bio' => 'Verified citizen actively contributing to community security and education.',
                'ward_code' => '1002',
                'thana_code' => 'DHK-02',
                'district_code' => 'DHK',
                'nid_verified' => true,
                'verified_badge' => true,
                'nid_verified_at' => now(),
            ]);
        }

        AuthDevice::updateOrCreate(
            [
                'user_id' => $citizen->id,
                'device_name' => 'Mobile Android App',
            ],
            [
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Linux; Android 14; Pixel 8) AppleWebKit/537.36 Mobile Safari/537.36',
                'last_active_at' => now(),
            ]
        );

        if ($citizen->tokens()->where('name', 'citizen-mobile-token')->doesntExist()) {
            $citizen->createToken('citizen-mobile-token');
        }

        // 3. School / Institutional Admin Account
        $schoolAdmin = User::where('email', 'school@zengfy.test')
            ->orWhere('handle', 'zengfyschool')
            ->first();

        if ($schoolAdmin) {
            $schoolAdmin->update([
                'name' => 'Zengfy Academy Admin',
                'handle' => 'zengfyschool',
                'email' => 'school@zengfy.test',
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'user_type' => 'school_admin',
                'phone' => '+8801700000003',
                'avatar' => 'https://ui-avatars.com/api/?name=Zengfy+Academy&background=4f46e5&color=fff',
                'bio' => 'Administrator for Zengfy Academic & Student ERP Portal.',
                'ward_code' => '1001',
                'thana_code' => 'DHK-01',
                'district_code' => 'DHK',
                'nid_verified' => true,
                'verified_badge' => true,
                'school_id_verified' => true,
                'nid_verified_at' => now(),
            ]);
        } else {
            $schoolAdmin = User::create([
                'name' => 'Zengfy Academy Admin',
                'handle' => 'zengfyschool',
                'email' => 'school@zengfy.test',
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'user_type' => 'school_admin',
                'phone' => '+8801700000003',
                'avatar' => 'https://ui-avatars.com/api/?name=Zengfy+Academy&background=4f46e5&color=fff',
                'bio' => 'Administrator for Zengfy Academic & Student ERP Portal.',
                'ward_code' => '1001',
                'thana_code' => 'DHK-01',
                'district_code' => 'DHK',
                'nid_verified' => true,
                'verified_badge' => true,
                'school_id_verified' => true,
                'nid_verified_at' => now(),
            ]);
        }

        AuthDevice::updateOrCreate(
            [
                'user_id' => $schoolAdmin->id,
                'device_name' => 'Safari on macOS Laptop',
            ],
            [
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Safari/605.1.15',
                'last_active_at' => now(),
            ]
        );

        // 4. Also keep user@test.com working for convenience if distinct
        User::firstOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'Test User',
                'handle' => 'test_user',
                'password' => Hash::make('Password@123'),
                'email_verified_at' => now(),
                'user_type' => 'citizen',
            ]
        );
    }
}
