<?php

namespace Modules\School\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Organization\Models\Organization;
use Modules\School\Models\AcademicYear;
use Modules\School\Models\SchoolClass;
use Modules\School\Models\Section;
use Modules\School\Models\Subject;
use Modules\School\Services\AcademicStructureService;
use Symfony\Component\HttpFoundation\Response;

class AcademicStructureController extends Controller
{
    public function __construct(
        protected AcademicStructureService $service
    ) {}

    /**
     * List all academic years for the tenant.
     */
    public function indexAcademicYears(Request $request, Organization $organization): JsonResponse
    {
        $years = AcademicYear::where('organization_id', $organization->id)
            ->withCount('classes')
            ->orderByDesc('start_date')
            ->get();

        return ApiResponse::success($years, 'Academic years retrieved successfully');
    }

    /**
     * Create a new academic year.
     */
    public function storeAcademicYear(Request $request, Organization $organization): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['nullable', 'string', 'max:50'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_current' => ['nullable', 'boolean'],
            'status' => ['nullable', 'string', 'in:draft,active,archived'],
        ]);

        $year = $this->service->createAcademicYear($organization, $validated);

        return ApiResponse::success($year, 'Academic year created successfully', Response::HTTP_CREATED);
    }

    /**
     * Atomically set the designated academic year as current.
     */
    public function setCurrentAcademicYear(Request $request, Organization $organization, string $academicYearId): JsonResponse
    {
        $academicYear = AcademicYear::where('organization_id', $organization->id)
            ->where('id', $academicYearId)
            ->first();

        if (!$academicYear) {
            return ApiResponse::error('Academic year not found in this organization', Response::HTTP_NOT_FOUND, null, 'ACADEMIC_YEAR_NOT_FOUND');
        }

        $year = $this->service->setCurrentAcademicYear($organization, $academicYear);

        return ApiResponse::success($year, 'Current academic year updated successfully');
    }

    /**
     * Perform academic rollover: archive old year and clone structure to new term.
     */
    public function rolloverAcademicYear(Request $request, Organization $organization, string $academicYearId): JsonResponse
    {
        $sourceYear = AcademicYear::where('organization_id', $organization->id)
            ->where('id', $academicYearId)
            ->first();

        if (!$sourceYear) {
            return ApiResponse::error('Source academic year not found in this organization', Response::HTTP_NOT_FOUND, null, 'ACADEMIC_YEAR_NOT_FOUND');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['nullable', 'string', 'max:50'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'clone_structure' => ['nullable', 'boolean'],
        ]);

        $cloneStructure = $request->boolean('clone_structure', true);

        $newYear = $this->service->rolloverAcademicYear($organization, $sourceYear, $validated, $cloneStructure);

        return ApiResponse::success($newYear, 'Academic year rollover completed successfully', Response::HTTP_CREATED);
    }

    /**
     * List classes, optionally filtered by academic year.
     */
    public function indexClasses(Request $request, Organization $organization): JsonResponse
    {
        $query = SchoolClass::where('organization_id', $organization->id)
            ->with(['sections', 'subjects']);

        if ($request->has('academic_year_id')) {
            $query->where('academic_year_id', $request->query('academic_year_id'));
        } else {
            $currentYear = AcademicYear::where('organization_id', $organization->id)
                ->where('is_current', true)
                ->first();

            if ($currentYear) {
                $query->where('academic_year_id', $currentYear->id);
            }
        }

        $classes = $query->orderBy('numeric_grade')->orderBy('name')->get();

        return ApiResponse::success($classes, 'Classes retrieved successfully');
    }

    /**
     * Create a class in an academic year.
     */
    public function storeClass(Request $request, Organization $organization): JsonResponse
    {
        $validated = $request->validate([
            'academic_year_id' => ['required', 'uuid'],
            'name' => ['required', 'string', 'max:100'],
            'numeric_grade' => ['nullable', 'integer', 'min:0', 'max:20'],
            'code' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        $academicYear = AcademicYear::where('organization_id', $organization->id)
            ->where('id', $validated['academic_year_id'])
            ->first();

        if (!$academicYear) {
            return ApiResponse::error('Designated academic year not found in this organization', Response::HTTP_NOT_FOUND, null, 'ACADEMIC_YEAR_NOT_FOUND');
        }

        // Validate unique class name in this year
        $exists = SchoolClass::where('organization_id', $organization->id)
            ->where('academic_year_id', $academicYear->id)
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return ApiResponse::error('A class with this name already exists in this academic year', Response::HTTP_UNPROCESSABLE_ENTITY, null, 'CLASS_NAME_EXISTS');
        }

        $class = $this->service->createClass($organization, $academicYear, $validated);

        return ApiResponse::success($class, 'Class created successfully', Response::HTTP_CREATED);
    }

    /**
     * Show class details with sections and subjects.
     */
    public function showClass(Request $request, Organization $organization, string $classId): JsonResponse
    {
        $class = SchoolClass::where('organization_id', $organization->id)
            ->where('id', $classId)
            ->with(['academicYear', 'sections', 'subjects'])
            ->first();

        if (!$class) {
            return ApiResponse::error('Class not found in this organization', Response::HTTP_NOT_FOUND, null, 'CLASS_NOT_FOUND');
        }

        return ApiResponse::success($class, 'Class details retrieved successfully');
    }

    /**
     * Add a section to a class.
     */
    public function storeSection(Request $request, Organization $organization, string $classId): JsonResponse
    {
        $class = SchoolClass::where('organization_id', $organization->id)
            ->where('id', $classId)
            ->first();

        if (!$class) {
            return ApiResponse::error('Class not found in this organization', Response::HTTP_NOT_FOUND, null, 'CLASS_NOT_FOUND');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'capacity' => ['nullable', 'integer', 'min:1', 'max:500'],
            'room_number' => ['nullable', 'string', 'max:50'],
        ]);

        $exists = Section::where('organization_id', $organization->id)
            ->where('class_id', $class->id)
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return ApiResponse::error('Section with this name already exists in this class', Response::HTTP_UNPROCESSABLE_ENTITY, null, 'SECTION_NAME_EXISTS');
        }

        $section = $this->service->createSection($organization, $class, $validated);

        return ApiResponse::success($section, 'Section created successfully', Response::HTTP_CREATED);
    }

    /**
     * Add a subject to a class.
     */
    public function storeSubject(Request $request, Organization $organization, string $classId): JsonResponse
    {
        $class = SchoolClass::where('organization_id', $organization->id)
            ->where('id', $classId)
            ->first();

        if (!$class) {
            return ApiResponse::error('Class not found in this organization', Response::HTTP_NOT_FOUND, null, 'CLASS_NOT_FOUND');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => ['nullable', 'string', 'max:50'],
            'type' => ['nullable', 'string', 'in:core,elective,optional'],
            'credits' => ['nullable', 'numeric', 'min:0.5', 'max:10'],
            'pass_marks' => ['nullable', 'integer', 'min:0', 'max:100'],
            'total_marks' => ['nullable', 'integer', 'min:1', 'max:500'],
        ]);

        $subject = $this->service->createSubject($organization, $class, $validated);

        return ApiResponse::success($subject, 'Subject created successfully', Response::HTTP_CREATED);
    }

    /**
     * Get complete academic hierarchy tree.
     */
    public function structure(Request $request, Organization $organization): JsonResponse
    {
        $structure = $this->service->getStructure($organization, $request->query('academic_year_id'));

        if (!$structure) {
            return ApiResponse::success(null, 'No academic structure found for this organization');
        }

        return ApiResponse::success($structure, 'Academic structure retrieved successfully');
    }
}
