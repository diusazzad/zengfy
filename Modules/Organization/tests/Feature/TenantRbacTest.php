<?php

namespace Modules\Organization\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Modules\Organization\Database\Seeders\OrganizationRbacSeeder;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationMembership;
use Modules\Organization\Models\Permission;
use Modules\Organization\Models\Role;
use Modules\Organization\Services\RbacEngine;
use Modules\Organization\Services\TenantContext;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TenantRbacTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        RbacEngine::clearRuntimeCache();
        $this->seed(OrganizationRbacSeeder::class);
    }

    protected function tearDown(): void
    {
        TenantContext::clear();
        RbacEngine::clearRuntimeCache();
        parent::tearDown();
    }

    #[Test]
    public function system_seed_roles_and_permissions_are_bootstrapped()
    {
        $this->assertDatabaseHas('permissions', ['slug' => 'departments.manage']);
        $this->assertDatabaseHas('permissions', ['slug' => 'attendance.mark']);
        $this->assertDatabaseHas('permissions', ['slug' => 'finance.view_ledger']);

        $adminRole = Role::whereNull('organization_id')->where('slug', 'admin')->first();
        $this->assertNotNull($adminRole);
        $this->assertTrue($adminRole->hasPermissionTo('departments.manage'));
    }

    #[Test]
    public function organization_owner_has_wildcard_permission_access()
    {
        $owner = User::create(['name' => 'School Owner', 'email' => 'owner@school.com', 'password' => Hash::make('pass')]);
        $school = Organization::create(['name' => 'Pioneer High School', 'slug' => 'pioneer-high', 'created_by_user_id' => $owner->id]);
        OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $owner->id, 'role' => 'owner', 'status' => 'active']);

        TenantContext::setTenant($school);

        // Owner automatically passes any permission check via wildcard ('*')
        $this->assertTrue($owner->hasTenantPermission('departments.manage', $school));
        $this->assertTrue($owner->hasTenantPermission('finance.view_ledger', $school));
        $this->assertTrue($owner->hasTenantPermission('unregistered.arbitrary.permission', $school));
    }

    #[Test]
    public function member_without_required_permission_is_blocked_with_403()
    {
        $owner = User::create(['name' => 'Owner', 'email' => 'owner@school.com', 'password' => Hash::make('pass')]);
        $teacher = User::create(['name' => 'Teacher Hasan', 'email' => 'hasan@school.com', 'password' => Hash::make('pass')]);

        $school = Organization::create(['name' => 'Sylhet Cadet College', 'slug' => 'scc-sylhet', 'created_by_user_id' => $owner->id]);
        OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $owner->id, 'role' => 'owner', 'status' => 'active']);
        OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $teacher->id, 'role' => 'member', 'status' => 'active']);

        // Teacher only has basic member role without 'departments.manage'
        Sanctum::actingAs($teacher);

        $response = $this->postJson("/api/v1/organizations/{$school->id}/departments", [
            'name' => 'Unauthorized Department',
            'code' => 'UNAUTH-01',
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'INSUFFICIENT_PERMISSIONS',
                ],
            ]);
    }

    #[Test]
    public function member_with_granted_role_can_perform_authorized_action()
    {
        $owner = User::create(['name' => 'Owner', 'email' => 'owner@school.com', 'password' => Hash::make('pass')]);
        $vicePrincipal = User::create(['name' => 'Vice Principal', 'email' => 'vp@school.com', 'password' => Hash::make('pass')]);

        $school = Organization::create(['name' => 'Rajshahi Collegiate School', 'slug' => 'rcs-rajshahi', 'created_by_user_id' => $owner->id]);
        OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $owner->id, 'role' => 'owner', 'status' => 'active']);
        $vpMembership = OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $vicePrincipal->id, 'role' => 'member', 'status' => 'active']);

        // Create custom tenant role with 'departments.manage'
        $role = Role::create([
            'organization_id' => $school->id,
            'name' => 'Vice Principal Role',
            'slug' => 'vice-principal',
        ]);
        $role->givePermissionTo('departments.manage');

        // Assign role to Vice Principal
        $vpMembership->roles()->attach($role->id);

        Sanctum::actingAs($vicePrincipal);

        $response = $this->postJson("/api/v1/organizations/{$school->id}/departments", [
            'name' => 'Department of Higher Mathematics',
            'code' => 'MATH-01',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'Department of Higher Mathematics',
                    'code' => 'MATH-01',
                    'organization_id' => $school->id,
                ],
            ]);
    }

    #[Test]
    public function tenant_owner_can_create_custom_role_with_specific_permissions()
    {
        $owner = User::create(['name' => 'Founder', 'email' => 'founder@corp.com', 'password' => Hash::make('pass')]);
        $org = Organization::create(['name' => 'Zengfy Tech Lab', 'slug' => 'zengfy-lab', 'created_by_user_id' => $owner->id]);
        OrganizationMembership::create(['organization_id' => $org->id, 'user_id' => $owner->id, 'role' => 'owner', 'status' => 'active']);

        Sanctum::actingAs($owner);

        $payload = [
            'name' => 'Lead Auditor',
            'slug' => 'lead-auditor',
            'description' => 'Conducts financial and departmental audits',
            'permissions' => ['audit_logs.view', 'finance.view_ledger'],
        ];

        $response = $this->postJson("/api/v1/organizations/{$org->id}/roles", $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'Lead Auditor',
                    'slug' => 'lead-auditor',
                    'organization_id' => $org->id,
                ],
            ]);

        $this->assertDatabaseHas('roles', [
            'organization_id' => $org->id,
            'slug' => 'lead-auditor',
        ]);
    }

    #[Test]
    public function role_assignment_immediately_grants_permissions()
    {
        $owner = User::create(['name' => 'Owner', 'email' => 'owner@firm.com', 'password' => Hash::make('pass')]);
        $associate = User::create(['name' => 'Junior Associate', 'email' => 'associate@firm.com', 'password' => Hash::make('pass')]);

        $firm = Organization::create(['name' => 'Apex Law Chambers', 'slug' => 'apex-law', 'created_by_user_id' => $owner->id]);
        OrganizationMembership::create(['organization_id' => $firm->id, 'user_id' => $owner->id, 'role' => 'owner', 'status' => 'active']);
        $assocMembership = OrganizationMembership::create(['organization_id' => $firm->id, 'user_id' => $associate->id, 'role' => 'member', 'status' => 'active']);

        $role = Role::create([
            'organization_id' => $firm->id,
            'name' => 'Managing Associate',
            'slug' => 'managing-assoc',
        ]);
        $role->givePermissionTo('departments.manage');

        // Initially associate has no permission
        $this->assertFalse($associate->hasTenantPermission('departments.manage', $firm));

        // Assign role via API
        Sanctum::actingAs($owner);
        $response = $this->postJson("/api/v1/organizations/{$firm->id}/members/{$assocMembership->id}/roles", [
            'role_id' => $role->id,
        ]);

        $response->assertStatus(200);

        // Associate now has permission immediately
        $this->assertTrue($associate->hasTenantPermission('departments.manage', $firm));
    }

    #[Test]
    public function cross_tenant_role_isolation_guaranteed()
    {
        $user = User::create(['name' => 'Multi Role User', 'email' => 'user@portal.com', 'password' => Hash::make('pass')]);

        $schoolA = Organization::create(['name' => 'School A', 'slug' => 'school-a']);
        $membershipA = OrganizationMembership::create(['organization_id' => $schoolA->id, 'user_id' => $user->id, 'role' => 'member', 'status' => 'active']);

        $schoolB = Organization::create(['name' => 'School B', 'slug' => 'school-b']);
        OrganizationMembership::create(['organization_id' => $schoolB->id, 'user_id' => $user->id, 'role' => 'member', 'status' => 'active']);

        // In School A: user is given 'departments.manage'
        $roleA = Role::create(['organization_id' => $schoolA->id, 'name' => 'Admin Role A', 'slug' => 'admin-a']);
        $roleA->givePermissionTo('departments.manage');
        $membershipA->roles()->attach($roleA->id);

        // Assert user has permission in School A
        $this->assertTrue($user->hasTenantPermission('departments.manage', $schoolA));

        // Assert user does NOT have permission in School B!
        $this->assertFalse($user->hasTenantPermission('departments.manage', $schoolB));
    }

    #[Test]
    public function revoking_role_invalidates_cache_and_blocks_subsequent_requests()
    {
        $owner = User::create(['name' => 'Admin User', 'email' => 'admin@school.com', 'password' => Hash::make('pass')]);
        $teacher = User::create(['name' => 'Teacher', 'email' => 'teacher@school.com', 'password' => Hash::make('pass')]);

        $school = Organization::create(['name' => 'Chittagong Grammar School', 'slug' => 'cgs-ctg', 'created_by_user_id' => $owner->id]);
        OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $owner->id, 'role' => 'owner', 'status' => 'active']);
        $teacherMembership = OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $teacher->id, 'role' => 'member', 'status' => 'active']);

        $role = Role::create(['organization_id' => $school->id, 'name' => 'Coordinator', 'slug' => 'coordinator']);
        $role->givePermissionTo('departments.manage');
        $teacherMembership->roles()->attach($role->id);

        // Permission is present and gets cached
        $this->assertTrue($teacher->hasTenantPermission('departments.manage', $school));

        // Revoke role via API
        Sanctum::actingAs($owner);
        $response = $this->deleteJson("/api/v1/organizations/{$school->id}/members/{$teacherMembership->id}/roles/{$role->id}");
        $response->assertStatus(200);

        // Immediate cache invalidation: teacher has lost permission
        $this->assertFalse($teacher->hasTenantPermission('departments.manage', $school));

        // Teacher attempting department creation is now blocked with 403
        auth()->forgetGuards();
        Sanctum::actingAs($teacher);
        $blocked = $this->postJson("/api/v1/organizations/{$school->id}/departments", [
            'name' => 'Robotics Lab',
            'code' => 'ROBO',
        ]);
        $blocked->assertStatus(403);
    }

    #[Test]
    public function public_permissions_endpoint_returns_grouped_permissions()
    {
        $user = User::create(['name' => 'Any User', 'email' => 'user@test.com', 'password' => Hash::make('pass')]);
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/v1/permissions');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $data = $response->json('data');
        $this->assertArrayHasKey('core', $data);
        $this->assertArrayHasKey('school', $data);
    }
}
