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
        \Modules\Team\Models\TeamUser::updateOrCreate(
            ['email' => 'admin@zengfy.top'],
            [
                'name' => 'Team Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            ]
        );
    }
}
