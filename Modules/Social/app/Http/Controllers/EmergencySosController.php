<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Social\Services\EmergencySosService;

class EmergencySosController extends Controller
{
    public function __construct(
        protected EmergencySosService $sosService
    ) {}

    /**
     * Trigger Emergency SOS distress signal.
     */
    public function trigger(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'accuracy' => ['nullable', 'numeric', 'min:0'],
            'ward_code' => ['nullable', 'string', 'max:50'],
            'thana_code' => ['nullable', 'string', 'max:50'],
            'district_code' => ['nullable', 'string', 'max:50'],
            'distress_type' => ['nullable', 'string', 'in:general,medical,harassment,accident,fire'],
            'battery_level' => ['nullable', 'integer', 'between:0,100'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $event = $this->sosService->triggerSos($request->user(), $validated);

        return ApiResponse::success(
            $event,
            'Emergency SOS distress signal triggered and broadcasted successfully.',
            201
        );
    }

    /**
     * Resolve or cancel an active SOS distress signal.
     */
    public function resolve(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['nullable', 'string', 'in:resolved,cancelled,false_alarm'],
            'resolution_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $event = $this->sosService->resolveSos($request->user(), $id, $validated);

        return ApiResponse::success(
            $event,
            'Emergency SOS distress signal marked as ' . ($validated['status'] ?? 'resolved') . '.'
        );
    }

    /**
     * Get active emergency alerts filtered by optional ward code.
     */
    public function active(Request $request): JsonResponse
    {
        $events = $this->sosService->getActiveEvents(
            $request->query('ward_code'),
            (int) $request->query('per_page', 15)
        );

        return ApiResponse::success(
            $events,
            'Active emergency alerts retrieved successfully.'
        );
    }

    /**
     * Get citizen's emergency history.
     */
    public function history(Request $request): JsonResponse
    {
        $events = $this->sosService->getUserHistory(
            $request->user(),
            (int) $request->query('per_page', 15)
        );

        return ApiResponse::success(
            $events,
            'Emergency alert history retrieved successfully.'
        );
    }

    /**
     * Get citizen's trusted emergency contacts.
     */
    public function getContacts(Request $request): JsonResponse
    {
        $contacts = $this->sosService->getContacts($request->user());

        return ApiResponse::success(
            $contacts,
            'Emergency contacts retrieved successfully.'
        );
    }

    /**
     * Add a trusted emergency contact.
     */
    public function addContact(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'contact_name' => ['required', 'string', 'max:100'],
            'contact_phone' => ['required', 'string', 'max:20'],
            'relationship' => ['nullable', 'string', 'max:50'],
            'is_trusted' => ['nullable', 'boolean'],
        ]);

        $contact = $this->sosService->addContact($request->user(), $validated);

        return ApiResponse::success(
            $contact,
            'Emergency contact added successfully.',
            201
        );
    }

    /**
     * Delete an emergency contact.
     */
    public function deleteContact(Request $request, string $id): JsonResponse
    {
        $this->sosService->deleteContact($request->user(), $id);

        return ApiResponse::success(
            null,
            'Emergency contact removed successfully.'
        );
    }
}
