<?php

namespace Modules\Organization\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Organization\Models\Permission;
use Modules\Organization\Models\Role;

class OrganizationRbacSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Core organization permissions
            ['name' => 'Manage Organization Settings', 'slug' => 'organization.settings.manage', 'module' => 'core'],
            ['name' => 'Manage Members', 'slug' => 'members.manage', 'module' => 'core'],
            ['name' => 'Manage Roles and Permissions', 'slug' => 'roles.manage', 'module' => 'core'],
            ['name' => 'Manage Departments', 'slug' => 'departments.manage', 'module' => 'core'],
            ['name' => 'View Audit Logs', 'slug' => 'audit_logs.view', 'module' => 'core'],

            // School domain permissions
            ['name' => 'Mark Student Attendance', 'slug' => 'attendance.mark', 'module' => 'school'],
            ['name' => 'Publish Examination', 'slug' => 'exam.publish', 'module' => 'school'],
            ['name' => 'Grade Examination', 'slug' => 'exam.grade', 'module' => 'school'],
            ['name' => 'View Financial Ledger', 'slug' => 'finance.view_ledger', 'module' => 'school'],
            ['name' => 'Collect Tuition Fees', 'slug' => 'finance.collect_fee', 'module' => 'school'],
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['slug' => $p['slug']], $p);
        }

        // System template roles (organization_id is null)
        $adminRole = Role::firstOrCreate(
            ['slug' => 'admin', 'organization_id' => null],
            ['name' => 'Administrator', 'description' => 'Full administrative access excluding ownership transfer']
        );
        $adminPermissions = Permission::whereIn('slug', [
            'organization.settings.manage',
            'members.manage',
            'roles.manage',
            'departments.manage',
            'audit_logs.view',
        ])->pluck('id');
        $adminRole->permissions()->sync($adminPermissions);

        Role::firstOrCreate(
            ['slug' => 'member', 'organization_id' => null],
            ['name' => 'Standard Member', 'description' => 'Standard member with baseline read access']
        );
    }
}
