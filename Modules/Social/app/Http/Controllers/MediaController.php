<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Modules\Social\Services\MediaStorageService;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
    public function __construct(
        protected MediaStorageService $mediaService
    ) {}

    /**
     * Generate presigned URL for direct client-to-storage upload.
     */
    public function presign(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'file_name' => ['required', 'string', 'max:255'],
            'mime_type' => ['required', 'string', 'max:100'],
            'file_size_bytes' => ['required', 'integer', 'min:1'],
        ]);

        try {
            $result = $this->mediaService->generatePresignedUpload(
                user: $request->user(),
                filename: $validated['file_name'],
                mimeType: $validated['mime_type'],
                fileSizeBytes: $validated['file_size_bytes']
            );

            return ApiResponse::success($result, 'Presigned upload URL generated successfully');
        } catch (InvalidArgumentException $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                statusCode: Response::HTTP_UNPROCESSABLE_ENTITY,
                errorCode: 'INVALID_MEDIA_SPEC'
            );
        }
    }

    /**
     * Local development endpoint for direct file uploads via temporary signed route.
     */
    public function directUpload(Request $request): JsonResponse
    {
        if (!$request->hasValidSignature()) {
            return ApiResponse::error('Invalid or expired upload signature.', Response::HTTP_FORBIDDEN, null, 'INVALID_SIGNATURE');
        }

        $request->validate([
            'file' => ['required', 'file', 'max:51200'], // max 50MB
        ]);

        $rawPath = base64_decode($request->query('path', ''));
        if (empty($rawPath)) {
            return ApiResponse::error('Missing storage path.', Response::HTTP_BAD_REQUEST, null, 'INVALID_PATH');
        }

        $url = $this->mediaService->storeDirectFile($request->file('file'), $rawPath);

        return ApiResponse::success([
            'url' => $url,
            'storage_path' => $rawPath,
        ], 'File uploaded successfully');
    }
}
