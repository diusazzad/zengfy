<?php

namespace Modules\School\Services;

use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Modules\Organization\Models\Organization;
use Modules\School\Models\AcademicYear;
use Modules\School\Models\SchoolClass;
use Modules\School\Models\Section;
use Modules\School\Models\Subject;

class AcademicStructureService
{
    /**
     * Create a new academic year for an organization.
     */
    public function createAcademicYear(Organization $tenant, array $data): AcademicYear
    {
        return DB::transaction(function () use ($tenant, $data) {
            $isCurrent = (bool) ($data['is_current'] ?? false);

            if ($isCurrent) {
                AcademicYear::where('organization_id', $tenant->id)
                    ->update(['is_current' => false]);
            }

            return AcademicYear::create([
                'organization_id' => $tenant->id,
                'name' => $data['name'],
                'code' => $data['code'] ?? null,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'is_current' => $isCurrent,
                'status' => $data['status'] ?? 'active',
            ]);
        });
    }

    /**
     * Atomically set an academic year as the current active year for a tenant.
     */
    public function setCurrentAcademicYear(Organization $tenant, AcademicYear $academicYear): AcademicYear
    {
        if ($academicYear->organization_id !== $tenant->id) {
            throw new InvalidArgumentException('Academic year does not belong to this organization.');
        }

        return DB::transaction(function () use ($tenant, $academicYear) {
            AcademicYear::where('organization_id', $tenant->id)
                ->where('id', '!=', $academicYear->id)
                ->update(['is_current' => false]);

            $academicYear->update([
                'is_current' => true,
                'status' => 'active',
            ]);

            return $academicYear->fresh();
        });
    }

    /**
     * Perform an academic year rollover: archive the old term, establish the new term,
     * and clone all classes, sections, and subjects into the new term.
     */
    public function rolloverAcademicYear(
        Organization $tenant,
        AcademicYear $sourceYear,
        array $newYearData,
        bool $cloneStructure = true
    ): AcademicYear {
        if ($sourceYear->organization_id !== $tenant->id) {
            throw new InvalidArgumentException('Source academic year does not belong to this organization.');
        }

        return DB::transaction(function () use ($tenant, $sourceYear, $newYearData, $cloneStructure) {
            // 1. Archive previous source year and unset current status
            $sourceYear->update([
                'is_current' => false,
                'status' => 'archived',
            ]);

            // 2. Unset any other current years in tenant
            AcademicYear::where('organization_id', $tenant->id)
                ->update(['is_current' => false]);

            // 3. Create target academic year
            $targetYear = AcademicYear::create([
                'organization_id' => $tenant->id,
                'name' => $newYearData['name'],
                'code' => $newYearData['code'] ?? null,
                'start_date' => $newYearData['start_date'],
                'end_date' => $newYearData['end_date'],
                'is_current' => true,
                'status' => 'active',
            ]);

            // 4. Clone structure if requested
            if ($cloneStructure) {
                $classes = $sourceYear->classes()->with(['sections', 'subjects'])->get();

                foreach ($classes as $oldClass) {
                    $newClass = SchoolClass::create([
                        'organization_id' => $tenant->id,
                        'academic_year_id' => $targetYear->id,
                        'name' => $oldClass->name,
                        'numeric_grade' => $oldClass->numeric_grade,
                        'code' => $oldClass->code,
                        'description' => $oldClass->description,
                    ]);

                    // Clone sections
                    foreach ($oldClass->sections as $oldSection) {
                        Section::create([
                            'organization_id' => $tenant->id,
                            'class_id' => $newClass->id,
                            'name' => $oldSection->name,
                            'capacity' => $oldSection->capacity,
                            'room_number' => $oldSection->room_number,
                        ]);
                    }

                    // Clone subjects
                    foreach ($oldClass->subjects as $oldSubject) {
                        Subject::create([
                            'organization_id' => $tenant->id,
                            'class_id' => $newClass->id,
                            'name' => $oldSubject->name,
                            'code' => $oldSubject->code,
                            'type' => $oldSubject->type,
                            'credits' => $oldSubject->credits,
                            'pass_marks' => $oldSubject->pass_marks,
                            'total_marks' => $oldSubject->total_marks,
                        ]);
                    }
                }
            }

            return $targetYear->load(['classes.sections', 'classes.subjects']);
        });
    }

    /**
     * Create a school class in an academic year.
     */
    public function createClass(Organization $tenant, AcademicYear $academicYear, array $data): SchoolClass
    {
        if ($academicYear->organization_id !== $tenant->id) {
            throw new InvalidArgumentException('Academic year does not belong to this organization.');
        }

        return SchoolClass::create([
            'organization_id' => $tenant->id,
            'academic_year_id' => $academicYear->id,
            'name' => $data['name'],
            'numeric_grade' => $data['numeric_grade'] ?? null,
            'code' => $data['code'] ?? null,
            'description' => $data['description'] ?? null,
        ]);
    }

    /**
     * Create a section under a class.
     */
    public function createSection(Organization $tenant, SchoolClass $class, array $data): Section
    {
        if ($class->organization_id !== $tenant->id) {
            throw new InvalidArgumentException('Class does not belong to this organization.');
        }

        return Section::create([
            'organization_id' => $tenant->id,
            'class_id' => $class->id,
            'name' => $data['name'],
            'capacity' => $data['capacity'] ?? 40,
            'room_number' => $data['room_number'] ?? null,
        ]);
    }

    /**
     * Create a subject under a class.
     */
    public function createSubject(Organization $tenant, SchoolClass $class, array $data): Subject
    {
        if ($class->organization_id !== $tenant->id) {
            throw new InvalidArgumentException('Class does not belong to this organization.');
        }

        return Subject::create([
            'organization_id' => $tenant->id,
            'class_id' => $class->id,
            'name' => $data['name'],
            'code' => $data['code'] ?? null,
            'type' => $data['type'] ?? 'core',
            'credits' => $data['credits'] ?? 3.00,
            'pass_marks' => $data['pass_marks'] ?? 33,
            'total_marks' => $data['total_marks'] ?? 100,
        ]);
    }

    /**
     * Fetch complete academic structure for active or specified academic year.
     */
    public function getStructure(Organization $tenant, ?string $academicYearId = null): ?AcademicYear
    {
        $query = AcademicYear::where('organization_id', $tenant->id)
            ->with(['classes.sections', 'classes.subjects']);

        if ($academicYearId) {
            return $query->where('id', $academicYearId)->first();
        }

        $current = (clone $query)->where('is_current', true)->first();

        return $current ?? $query->where('status', 'active')->latest()->first();
    }
}
