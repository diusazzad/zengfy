<?php

namespace Modules\Organization\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationDepartment;
use Modules\Organization\Models\OrganizationMembership;
use Modules\Organization\Services\TenantContext;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TenantScopingTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        TenantContext::clear();
        parent::tearDown();
    }

    #[Test]
    public function user_can_create_organization_and_automatically_becomes_active_owner()
    {
        $user = User::create([
            'name' => 'Dr. Kamal Hossain',
            'email' => 'kamal@drmc.edu.bd',
            'password' => Hash::make('Secret123!'),
        ]);

        Sanctum::actingAs($user);

        $payload = [
            'name' => 'Dhaka Residential Model College',
            'slug' => 'drmc-dhaka',
            'domain_type' => 'school',
            'settings' => [
                'theme' => 'navy-gold',
                'eiin' => '107977',
            ],
        ];

        $response = $this->postJson('/api/v1/organizations', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'Dhaka Residential Model College',
                    'slug' => 'drmc-dhaka',
                    'domain_type' => 'school',
                ],
            ]);

        $orgId = $response->json('data.id');
        $this->assertNotEmpty($orgId);

        // Verify organization membership is established as active owner
        $this->assertDatabaseHas('organization_memberships', [
            'organization_id' => $orgId,
            'user_id' => $user->id,
            'role' => 'owner',
            'status' => 'active',
        ]);
    }

    #[Test]
    public function authenticated_user_can_list_only_organizations_they_belong_to()
    {
        $userA = User::create(['name' => 'User A', 'email' => 'a@test.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'User B', 'email' => 'b@test.com', 'password' => Hash::make('pass')]);

        $org1 = Organization::create(['name' => 'Org One', 'slug' => 'org-one', 'created_by_user_id' => $userA->id]);
        OrganizationMembership::create(['organization_id' => $org1->id, 'user_id' => $userA->id, 'role' => 'owner', 'status' => 'active']);

        $org2 = Organization::create(['name' => 'Org Two', 'slug' => 'org-two', 'created_by_user_id' => $userA->id]);
        OrganizationMembership::create(['organization_id' => $org2->id, 'user_id' => $userA->id, 'role' => 'member', 'status' => 'active']);

        $org3 = Organization::create(['name' => 'Org Three (Foreign)', 'slug' => 'org-three', 'created_by_user_id' => $userB->id]);
        OrganizationMembership::create(['organization_id' => $org3->id, 'user_id' => $userB->id, 'role' => 'owner', 'status' => 'active']);

        Sanctum::actingAs($userA);

        $response = $this->getJson('/api/v1/organizations');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $data = $response->json('data');
        $this->assertCount(2, $data);
        $slugs = array_column($data, 'slug');
        $this->assertContains('org-one', $slugs);
        $this->assertContains('org-two', $slugs);
        $this->assertNotContains('org-three', $slugs);
    }

    #[Test]
    public function user_cannot_access_organization_they_do_not_belong_to_returns_403()
    {
        $userA = User::create(['name' => 'User A', 'email' => 'a@test.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'User B', 'email' => 'b@test.com', 'password' => Hash::make('pass')]);

        $orgA = Organization::create(['name' => 'Org A', 'slug' => 'org-a', 'created_by_user_id' => $userA->id]);
        OrganizationMembership::create(['organization_id' => $orgA->id, 'user_id' => $userA->id, 'role' => 'owner', 'status' => 'active']);

        // User B tries to access Org A details
        Sanctum::actingAs($userB);

        $response = $this->getJson("/api/v1/organizations/{$orgA->id}");

        $response->assertStatus(403)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'TENANT_ACCESS_DENIED',
                ],
            ]);
    }

    #[Test]
    public function global_tenant_scope_strictly_prevents_cross_tenant_data_leakage()
    {
        $userA = User::create(['name' => 'Principal A', 'email' => 'principal.a@school.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'Principal B', 'email' => 'principal.b@school.com', 'password' => Hash::make('pass')]);

        $schoolA = Organization::create(['name' => 'School A', 'slug' => 'school-a', 'created_by_user_id' => $userA->id]);
        OrganizationMembership::create(['organization_id' => $schoolA->id, 'user_id' => $userA->id, 'role' => 'owner', 'status' => 'active']);

        $schoolB = Organization::create(['name' => 'School B', 'slug' => 'school-b', 'created_by_user_id' => $userB->id]);
        OrganizationMembership::create(['organization_id' => $schoolB->id, 'user_id' => $userB->id, 'role' => 'owner', 'status' => 'active']);

        // Provision departments directly for each school
        TenantContext::setTenant($schoolA);
        $deptA1 = OrganizationDepartment::create(['name' => 'School A - Physics', 'code' => 'PHY-A']);
        $deptA2 = OrganizationDepartment::create(['name' => 'School A - Chemistry', 'code' => 'CHE-A']);
        TenantContext::clear();

        TenantContext::setTenant($schoolB);
        $deptB1 = OrganizationDepartment::create(['name' => 'School B - Arts', 'code' => 'ART-B']);
        TenantContext::clear();

        // 1. HTTP API Level Test: Principal A fetches departments under School A route
        Sanctum::actingAs($userA);
        $response = $this->getJson("/api/v1/organizations/{$schoolA->id}/departments");

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertCount(2, $data);
        $names = array_column($data, 'name');
        $this->assertContains('School A - Physics', $names);
        $this->assertContains('School A - Chemistry', $names);
        $this->assertNotContains('School B - Arts', $names);

        // 2. ORM Level Test: Even with OrganizationDepartment::all(), tenant scope limits results
        TenantContext::setTenant($schoolA);
        $ormDepartments = OrganizationDepartment::all();
        $this->assertCount(2, $ormDepartments);
        $this->assertFalse($ormDepartments->contains('id', $deptB1->id));
        TenantContext::clear();
    }

    #[Test]
    public function tenant_child_resource_auto_stamping_via_belongs_to_tenant_trait()
    {
        $user = User::create(['name' => 'Headmaster', 'email' => 'head@school.com', 'password' => Hash::make('pass')]);
        $school = Organization::create(['name' => 'Apex Academy', 'slug' => 'apex-academy', 'created_by_user_id' => $user->id]);
        OrganizationMembership::create(['organization_id' => $school->id, 'user_id' => $user->id, 'role' => 'owner', 'status' => 'active']);

        Sanctum::actingAs($user);

        // Create department through API without explicitly supplying organization_id
        $response = $this->postJson("/api/v1/organizations/{$school->id}/departments", [
            'name' => 'Information Technology & Robotics',
            'code' => 'IT-ROBO',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'Information Technology & Robotics',
                    'code' => 'IT-ROBO',
                    'organization_id' => $school->id,
                ],
            ]);

        $this->assertDatabaseHas('organization_departments', [
            'organization_id' => $school->id,
            'name' => 'Information Technology & Robotics',
            'code' => 'IT-ROBO',
        ]);
    }

    #[Test]
    public function direct_idor_access_to_another_tenants_resource_returns_404()
    {
        $userA = User::create(['name' => 'User A', 'email' => 'a@org.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'User B', 'email' => 'b@org.com', 'password' => Hash::make('pass')]);

        $orgA = Organization::create(['name' => 'Org A', 'slug' => 'org-a', 'created_by_user_id' => $userA->id]);
        OrganizationMembership::create(['organization_id' => $orgA->id, 'user_id' => $userA->id, 'role' => 'owner', 'status' => 'active']);

        $orgB = Organization::create(['name' => 'Org B', 'slug' => 'org-b', 'created_by_user_id' => $userB->id]);
        OrganizationMembership::create(['organization_id' => $orgB->id, 'user_id' => $userB->id, 'role' => 'owner', 'status' => 'active']);

        TenantContext::setTenant($orgB);
        $secretDepartmentB = OrganizationDepartment::create(['name' => 'Confidential Financial Audits', 'code' => 'AUD-B']);
        TenantContext::clear();

        // User A attempts IDOR by requesting Org B's department ID within Org A's URL
        Sanctum::actingAs($userA);

        $response = $this->getJson("/api/v1/organizations/{$orgA->id}/departments/{$secretDepartmentB->id}");

        // Due to global tenant scope filtering by organization_id = orgA->id, find($id) returns null -> 404 Not Found!
        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'DEPARTMENT_NOT_FOUND',
                ],
            ]);
    }

    #[Test]
    public function user_belonging_to_multiple_tenants_can_cleanly_switch_context()
    {
        $multiOrgUser = User::create(['name' => 'Consultant Rahman', 'email' => 'rahman@consultant.com', 'password' => Hash::make('pass')]);

        $client1 = Organization::create(['name' => 'Law Firm One', 'slug' => 'law-one']);
        OrganizationMembership::create(['organization_id' => $client1->id, 'user_id' => $multiOrgUser->id, 'role' => 'admin', 'status' => 'active']);

        $client2 = Organization::create(['name' => 'Law Firm Two', 'slug' => 'law-two']);
        OrganizationMembership::create(['organization_id' => $client2->id, 'user_id' => $multiOrgUser->id, 'role' => 'member', 'status' => 'active']);

        TenantContext::setTenant($client1);
        OrganizationDepartment::create(['name' => 'Litigation Practice', 'code' => 'LIT-1']);
        TenantContext::clear();

        TenantContext::setTenant($client2);
        OrganizationDepartment::create(['name' => 'Corporate Mergers', 'code' => 'CORP-2']);
        TenantContext::clear();

        Sanctum::actingAs($multiOrgUser);

        // Fetch Client 1 data
        $response1 = $this->getJson("/api/v1/organizations/{$client1->id}/departments");
        $response1->assertStatus(200);
        $this->assertCount(1, $response1->json('data'));
        $this->assertEquals('Litigation Practice', $response1->json('data.0.name'));

        // Fetch Client 2 data
        $response2 = $this->getJson("/api/v1/organizations/{$client2->id}/departments");
        $response2->assertStatus(200);
        $this->assertCount(1, $response2->json('data'));
        $this->assertEquals('Corporate Mergers', $response2->json('data.0.name'));
    }

    #[Test]
    public function owner_can_invite_member_and_regular_member_cannot_invite()
    {
        $owner = User::create(['name' => 'Owner', 'email' => 'owner@firm.com', 'password' => Hash::make('pass')]);
        $member = User::create(['name' => 'Staff Member', 'email' => 'staff@firm.com', 'password' => Hash::make('pass')]);
        $newCandidate = User::create(['name' => 'New Candidate', 'email' => 'candidate@firm.com', 'password' => Hash::make('pass')]);

        $org = Organization::create(['name' => 'Summit Corp', 'slug' => 'summit-corp', 'created_by_user_id' => $owner->id]);
        OrganizationMembership::create(['organization_id' => $org->id, 'user_id' => $owner->id, 'role' => 'owner', 'status' => 'active']);
        OrganizationMembership::create(['organization_id' => $org->id, 'user_id' => $member->id, 'role' => 'member', 'status' => 'active']);

        // 1. Regular member tries to invite candidate -> 403 Forbidden
        Sanctum::actingAs($member);
        $forbiddenResponse = $this->postJson("/api/v1/organizations/{$org->id}/members", [
            'user_id' => $newCandidate->id,
            'role' => 'member',
        ]);

        $forbiddenResponse->assertStatus(403)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'INSUFFICIENT_PERMISSIONS',
                ],
            ]);

        // 2. Owner invites candidate -> 201 Created
        auth()->forgetGuards();
        Sanctum::actingAs($owner);
        $successResponse = $this->postJson("/api/v1/organizations/{$org->id}/members", [
            'user_id' => $newCandidate->id,
            'role' => 'admin',
        ]);

        $successResponse->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'user_id' => $newCandidate->id,
                    'role' => 'admin',
                    'status' => 'active',
                ],
            ]);

        $this->assertDatabaseHas('organization_memberships', [
            'organization_id' => $org->id,
            'user_id' => $newCandidate->id,
            'role' => 'admin',
            'status' => 'active',
        ]);
    }

    #[Test]
    public function administrative_escape_hatch_runs_without_tenant_scope()
    {
        $org1 = Organization::create(['name' => 'Org 1', 'slug' => 'org-1']);
        $org2 = Organization::create(['name' => 'Org 2', 'slug' => 'org-2']);

        TenantContext::setTenant($org1);
        OrganizationDepartment::create(['name' => 'Dept 1']);
        TenantContext::clear();

        TenantContext::setTenant($org2);
        OrganizationDepartment::create(['name' => 'Dept 2']);
        TenantContext::clear();

        // While bound to Org 1, normal query returns 1 record
        TenantContext::setTenant($org1);
        $this->assertCount(1, OrganizationDepartment::all());

        // Using administrative escape hatch, system background worker queries across all tenants
        $allDepartments = TenantContext::runWithoutTenantScope(function () {
            return OrganizationDepartment::all();
        });

        $this->assertCount(2, $allDepartments);
        TenantContext::clear();
    }
}
