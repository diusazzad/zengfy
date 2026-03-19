<?php

namespace Modules\Team\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeamAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@zengfy.top'],
            [
                'name' => 'Team Admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        // $this->call([]);
    }
}
