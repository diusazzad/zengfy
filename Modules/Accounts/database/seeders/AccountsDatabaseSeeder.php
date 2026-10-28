<?php

namespace Modules\Accounts\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Modules\Accounts\Models\AccountSetting;
use Modules\Accounts\Models\AccountSecurityLog;

class AccountsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds for the Accounts module.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            AccountSetting::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'theme' => 'light',
                    'locale' => 'bn',
                    'two_factor_enabled' => false,
                    'two_factor_method' => 'authenticator',
                    'login_alerts' => true,
                    'recovery_email' => null,
                    'recovery_phone' => $user->phone ?? null,
                    'extra_attributes' => [
                        'allow_ecosystem_sync' => true,
                        'profile_completion_prompt_dismissed' => false,
                        'security_score' => $user->email_verified_at ? 75 : 50,
                    ],
                ]
            );

            // Seed initial account setup log if none exists
            $existingLog = AccountSecurityLog::where('user_id', $user->id)->first();
            if (!$existingLog) {
                AccountSecurityLog::create([
                    'user_id' => $user->id,
                    'event_type' => 'account_created',
                    'ip_address' => $user->registration_ip ?? '127.0.0.1',
                    'device_name' => 'Web Browser',
                    'location' => 'Dhaka, Bangladesh',
                    'status' => 'success',
                    'details' => [
                        'action' => 'Universal Sovereign ID generated',
                        'verified' => !empty($user->email_verified_at),
                    ],
                    'created_at' => $user->created_at ?? now(),
                ]);
            }
        }
    }
}
