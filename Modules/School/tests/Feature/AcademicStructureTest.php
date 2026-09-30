<?php

namespace Modules\School\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Modules\Organization\Database\Seeders\OrganizationRbacSeeder;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationMembership;
use Modules\Organization\Models\Role;
use Modules\Organization\Services\RbacEngine;
use Modules\Organization\Services\TenantContext;
use Modules\School\Models\AcademicYear;
use Modules\School\Models\SchoolClass;
use Modules\School\Models\Section;
use Modules\School\Models\Subject;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AcademicStructureTest extends TestCase
{
    use RefreshDatabase;

    protected User $owner;
    protected Organization $school;
    protected OrganizationMembership $membership;

    protected function setUp(): void
    {
        parent::setUp();
        RbacEngine::clearRuntimeCache();
        $this->seed(OrganizationRbacSeeder::class);

        $this->owner = User::create([
            'name' => 'Principal Rahat',
            'email' => 'principal@dhakaschool.edu.bd',
            'password' => Hash::make('SecretPass123!'),
        ]);

        $this->school = Organization::create([
            'name' => 'Dhaka Model Academy',
            'slug' => 'dhaka-model-academy',
            'created_by_user_id' => $this->owner->id,
            'is_active' => true,
        ]);

        $this->membership = OrganizationMembership::create([
            'organization_id' => $this->school->id,
            'user_id' => $this->owner->id,
            'role' => 'owner',
            'status' => 'active',
        ]);
    }

    protected function tearDown(): void
    {
        TenantContext::clear();
        RbacEngine::clearRuntimeCache();
        parent::tearDown();
    }

    #[Test]
    public function authenticated_organization_owner_can_create_academic_year()
    {
        Sanctum::actingAs($this->owner);

        $payload = [
            'name' => 'Academic Year 2026-2027',
            'code' => 'AY-2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => true,
        ];

        $response = $this->postJson("/api/v1/organizations/{$this->school->id}/school/academic-years", $payload);

        $response->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'Academic Year 2026-2027')
            ->assertJsonPath('data.code', 'AY-2026')
            ->assertJsonPath('data.is_current', true)
            ->assertJsonPath('data.organization_id', $this->school->id);

        $this->assertDatabaseHas('academic_years', [
            'organization_id' => $this->school->id,
            'code' => 'AY-2026',
            'is_current' => 1,
        ]);
    }

    #[Test]
    public function setting_academic_year_as_current_atomically_unsets_other_years()
    {
        Sanctum::actingAs($this->owner);

        $year1 = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Term 2025',
            'code' => 'AY-2025',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'is_current' => true,
            'status' => 'active',
        ]);

        $year2 = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Term 2026',
            'code' => 'AY-2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => false,
            'status' => 'active',
        ]);

        $response = $this->postJson("/api/v1/organizations/{$this->school->id}/school/academic-years/{$year2->id}/set-current");

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.id', $year2->id)
            ->assertJsonPath('data.is_current', true);

        $this->assertFalse((bool) $year1->fresh()->is_current);
        $this->assertTrue((bool) $year2->fresh()->is_current);
    }

    #[Test]
    public function can_create_school_classes_sections_and_subjects()
    {
        Sanctum::actingAs($this->owner);

        $year = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Academic Year 2026',
            'code' => 'AY-2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => true,
        ]);

        // 1. Create Class 10
        $classResponse = $this->postJson("/api/v1/organizations/{$this->school->id}/school/classes", [
            'academic_year_id' => $year->id,
            'name' => 'Class 10',
            'numeric_grade' => 10,
            'code' => 'CLS-10',
            'description' => 'Secondary School Certificate Candidate Class',
        ]);

        $classResponse->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'Class 10')
            ->assertJsonPath('data.numeric_grade', 10);

        $classId = $classResponse->json('data.id');

        // 2. Create Section
        $sectionResponse = $this->postJson("/api/v1/organizations/{$this->school->id}/school/classes/{$classId}/sections", [
            'name' => 'Section Padma',
            'capacity' => 45,
            'room_number' => 'Building 2 - Room 304',
        ]);

        $sectionResponse->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'Section Padma')
            ->assertJsonPath('data.capacity', 45);

        // 3. Create Subject
        $subjectResponse = $this->postJson("/api/v1/organizations/{$this->school->id}/school/classes/{$classId}/subjects", [
            'name' => 'Higher Mathematics',
            'code' => 'HMATH-101',
            'type' => 'core',
            'credits' => 3.5,
            'pass_marks' => 33,
            'total_marks' => 100,
        ]);

        $subjectResponse->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'Higher Mathematics')
            ->assertJsonPath('data.code', 'HMATH-101');

        $this->assertDatabaseHas('sections', [
            'organization_id' => $this->school->id,
            'class_id' => $classId,
            'name' => 'Section Padma',
        ]);

        $this->assertDatabaseHas('subjects', [
            'organization_id' => $this->school->id,
            'class_id' => $classId,
            'code' => 'HMATH-101',
        ]);
    }

    #[Test]
    public function duplicate_section_name_within_same_class_is_rejected()
    {
        Sanctum::actingAs($this->owner);

        $year = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Term 2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => true,
        ]);

        $class = SchoolClass::create([
            'organization_id' => $this->school->id,
            'academic_year_id' => $year->id,
            'name' => 'Class 9',
            'numeric_grade' => 9,
        ]);

        Section::create([
            'organization_id' => $this->school->id,
            'class_id' => $class->id,
            'name' => 'Section Rose',
            'capacity' => 40,
        ]);

        $duplicateResponse = $this->postJson("/api/v1/organizations/{$this->school->id}/school/classes/{$class->id}/sections", [
            'name' => 'Section Rose',
            'capacity' => 35,
        ]);

        $duplicateResponse->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonPath('error_code', 'SECTION_NAME_EXISTS');
    }

    #[Test]
    public function duplicate_class_name_in_same_academic_year_is_rejected()
    {
        Sanctum::actingAs($this->owner);

        $year = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Term 2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => true,
        ]);

        SchoolClass::create([
            'organization_id' => $this->school->id,
            'academic_year_id' => $year->id,
            'name' => 'Class 8',
            'numeric_grade' => 8,
        ]);

        $duplicateResponse = $this->postJson("/api/v1/organizations/{$this->school->id}/school/classes", [
            'academic_year_id' => $year->id,
            'name' => 'Class 8',
            'numeric_grade' => 8,
        ]);

        $duplicateResponse->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonPath('error_code', 'CLASS_NAME_EXISTS');
    }

    #[Test]
    public function academic_year_rollover_archives_old_and_clones_structure_to_new_year()
    {
        Sanctum::actingAs($this->owner);

        $year2025 = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Academic Year 2025',
            'code' => 'AY-2025',
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'is_current' => true,
            'status' => 'active',
        ]);

        $class9 = SchoolClass::create([
            'organization_id' => $this->school->id,
            'academic_year_id' => $year2025->id,
            'name' => 'Class 9',
            'numeric_grade' => 9,
            'code' => 'CLS-9',
        ]);

        Section::create([
            'organization_id' => $this->school->id,
            'class_id' => $class9->id,
            'name' => 'Section A',
            'capacity' => 40,
        ]);

        Section::create([
            'organization_id' => $this->school->id,
            'class_id' => $class9->id,
            'name' => 'Section B',
            'capacity' => 40,
        ]);

        Subject::create([
            'organization_id' => $this->school->id,
            'class_id' => $class9->id,
            'name' => 'Physics',
            'code' => 'PHY-9',
            'credits' => 3.0,
        ]);

        // Rollover to 2026
        $rolloverResponse = $this->postJson("/api/v1/organizations/{$this->school->id}/school/academic-years/{$year2025->id}/rollover", [
            'name' => 'Academic Year 2026',
            'code' => 'AY-2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'clone_structure' => true,
        ]);

        $rolloverResponse->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'Academic Year 2026')
            ->assertJsonPath('data.is_current', true)
            ->assertJsonPath('data.status', 'active');

        $newYearId = $rolloverResponse->json('data.id');

        // Check source year archived
        $this->assertEquals('archived', $year2025->fresh()->status);
        $this->assertFalse((bool) $year2025->fresh()->is_current);

        // Check cloned classes in new year
        $newClasses = SchoolClass::where('academic_year_id', $newYearId)->get();
        $this->assertCount(1, $newClasses);
        $newClass = $newClasses->first();
        $this->assertEquals('Class 9', $newClass->name);

        // Check cloned sections in new class
        $newSections = Section::where('class_id', $newClass->id)->get();
        $this->assertCount(2, $newSections);
        $this->assertTrue($newSections->pluck('name')->contains('Section A'));
        $this->assertTrue($newSections->pluck('name')->contains('Section B'));

        // Check cloned subject
        $newSubjects = Subject::where('class_id', $newClass->id)->get();
        $this->assertCount(1, $newSubjects);
        $this->assertEquals('PHY-9', $newSubjects->first()->code);
    }

    #[Test]
    public function global_tenant_scope_strictly_prevents_cross_tenant_access_and_idor()
    {
        $otherUser = User::create([
            'name' => 'Other Principal',
            'email' => 'other@chittagong.edu.bd',
            'password' => Hash::make('pass'),
        ]);

        $otherSchool = Organization::create([
            'name' => 'Chittagong High School',
            'slug' => 'chittagong-high',
            'created_by_user_id' => $otherUser->id,
            'is_active' => true,
        ]);

        OrganizationMembership::create([
            'organization_id' => $otherSchool->id,
            'user_id' => $otherUser->id,
            'role' => 'owner',
            'status' => 'active',
        ]);

        // Secret class in Dhaka Model Academy
        $year = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Dhaka 2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => true,
        ]);

        $dhakaClass = SchoolClass::create([
            'organization_id' => $this->school->id,
            'academic_year_id' => $year->id,
            'name' => 'Exclusive Dhaka Class',
        ]);

        // Chittagong user attempts to query Dhaka School via IDOR
        Sanctum::actingAs($otherUser);

        // Attempt 1: Direct URL IDOR
        $response = $this->getJson("/api/v1/organizations/{$this->school->id}/school/classes/{$dhakaClass->id}");
        // Denied by tenant.resolve because otherUser is not a member of $this->school
        $response->assertStatus(403);

        // Attempt 2: Target own school URL but requesting Dhaka class ID
        $responseCross = $this->getJson("/api/v1/organizations/{$otherSchool->id}/school/classes/{$dhakaClass->id}");
        // Returns 404 because Dhaka class does not exist in Chittagong school's tenant scope
        $responseCross->assertStatus(404);
    }

    #[Test]
    public function member_without_academic_manage_permission_is_forbidden_from_modifications()
    {
        $teacher = User::create([
            'name' => 'Teacher Faruk',
            'email' => 'faruk@dhakaschool.edu.bd',
            'password' => Hash::make('pass'),
        ]);

        // Member without academic.manage
        OrganizationMembership::create([
            'organization_id' => $this->school->id,
            'user_id' => $teacher->id,
            'role' => 'member',
            'status' => 'active',
        ]);

        $year = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Academic Year 2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => true,
        ]);

        Sanctum::actingAs($teacher);

        // Attempt to create a class without academic.manage permission
        $response = $this->postJson("/api/v1/organizations/{$this->school->id}/school/classes", [
            'academic_year_id' => $year->id,
            'name' => 'Hacked Class',
        ]);

        $response->assertStatus(403)
            ->assertJsonPath('success', false)
            ->assertJsonPath('error_code', 'INSUFFICIENT_PERMISSIONS');
    }

    #[Test]
    public function structure_endpoint_returns_nested_hierarchy_tree()
    {
        Sanctum::actingAs($this->owner);

        $year = AcademicYear::create([
            'organization_id' => $this->school->id,
            'name' => 'Term 2026',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
            'is_current' => true,
        ]);

        $class = SchoolClass::create([
            'organization_id' => $this->school->id,
            'academic_year_id' => $year->id,
            'name' => 'Class 7',
            'numeric_grade' => 7,
        ]);

        Section::create([
            'organization_id' => $this->school->id,
            'class_id' => $class->id,
            'name' => 'Section Meghna',
            'capacity' => 50,
        ]);

        Subject::create([
            'organization_id' => $this->school->id,
            'class_id' => $class->id,
            'name' => 'Bangla 1st Paper',
            'code' => 'BAN-101',
        ]);

        $response = $this->getJson("/api/v1/organizations/{$this->school->id}/school/structure");

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'Term 2026')
            ->assertJsonPath('data.classes.0.name', 'Class 7')
            ->assertJsonPath('data.classes.0.sections.0.name', 'Section Meghna')
            ->assertJsonPath('data.classes.0.subjects.0.name', 'Bangla 1st Paper');
    }
}
