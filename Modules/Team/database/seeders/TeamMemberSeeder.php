<?php

namespace Modules\Team\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Team\Models\Team;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::updateOrCreate(
            ['name' => 'Sazzad Hossain'],
            [
                'designation' => 'Founder & CTO',
                'bio' => 'Visionary architect behind the Zengfy ecosystem. Passionate about digital sovereignty and building secure, unified business solutions for a better tomorrow.',
                'image_path' => 'team/sazzad.png',
                'linkedin_url' => 'https://linkedin.com/in/sazzadhossainmahim',
                'status' => 'active',
                'order' => 1
            ]
        );

        Team::updateOrCreate(
            ['name' => 'Mahabub Hossain'],
            [
                'designation' => 'Co-Founder',
                'bio' => 'Technical strategist driving the innovation of our unified social business platforms. Focused on high-performance architecture and seamless user experiences.',
                'image_path' => 'team/mahabub.png',
                'linkedin_url' => 'https://linkedin.com/in/mhmahbub',
                'status' => 'active',
                'order' => 2
            ]
        );
    }
}
