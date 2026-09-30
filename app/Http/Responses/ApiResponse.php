<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    /**
     * Return a standardized success JSON response.
     */
    public static function success(
        mixed $data = null,
        string $message = 'Operation successful',
        int $statusCode = Response::HTTP_OK,
        array $extraMeta = []
    ): JsonResponse {
        $meta = array_merge([
            'request_id' => request()->header('X-Request-ID') ?? request()->header('CF-Ray') ?? (string) \Illuminate\Support\Str::uuid(),
            'timestamp' => now()->toIso8601String(),
        ], $extraMeta);

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'meta' => $meta,
        ], $statusCode);
    }

    /**
     * Return a standardized created (201) JSON response.
     */
    public static function created(
        mixed $data = null,
        string $message = 'Resource created successfully',
        array $extraMeta = []
    ): JsonResponse {
        return self::success($data, $message, Response::HTTP_CREATED, $extraMeta);
    }

    /**
     * Return a standardized error JSON response.
     */
    public static function error(
        string $message = 'An error occurred',
        int $statusCode = Response::HTTP_BAD_REQUEST,
        mixed $errors = null,
        string $errorCode = 'BAD_REQUEST',
        array $extraMeta = []
    ): JsonResponse {
        $meta = array_merge([
            'request_id' => request()->header('X-Request-ID') ?? (string) \Illuminate\Support\Str::uuid(),
            'error_code' => $errorCode,
            'timestamp' => now()->toIso8601String(),
        ], $extraMeta);

        return response()->json([
            'success' => false,
            'message' => $message,
            'error_code' => $errorCode,
            'errors' => $errors,
            'meta' => $meta,
        ], $statusCode);
    }

    /**
     * Return a standardized validation error response (422).
     */
    public static function validationError(
        mixed $errors,
        string $message = 'The given data was invalid.'
    ): JsonResponse {
        return self::error(
            message: $message,
            statusCode: Response::HTTP_UNPROCESSABLE_ENTITY,
            errors: $errors,
            errorCode: 'VALIDATION_ERROR'
        );
    }

    /**
     * Return a standardized unauthenticated response (401).
     */
    public static function unauthorized(string $message = 'Unauthenticated.'): JsonResponse
    {
        return self::error(
            message: $message,
            statusCode: Response::HTTP_UNAUTHORIZED,
            errorCode: 'UNAUTHORIZED'
        );
    }

    /**
     * Return a standardized forbidden response (403).
     */
    public static function forbidden(string $message = 'This action is unauthorized.'): JsonResponse
    {
        return self::error(
            message: $message,
            statusCode: Response::HTTP_FORBIDDEN,
            errorCode: 'FORBIDDEN'
        );
    }

    /**
     * Return a standardized not found response (404).
     */
    public static function notFound(string $message = 'Resource not found.'): JsonResponse
    {
        return self::error(
            message: $message,
            statusCode: Response::HTTP_NOT_FOUND,
            errorCode: 'NOT_FOUND'
        );
    }

    /**
     * Return a standardized rate limited response (429) with RFC 6585 Retry-After header.
     */
    public static function rateLimited(
        string $message = 'Too many requests. Please slow down.',
        int $retryAfterSeconds = 60,
        array $extraMeta = []
    ): JsonResponse {
        $meta = array_merge(['retry_after' => $retryAfterSeconds], $extraMeta);

        return self::error(
            message: $message,
            statusCode: Response::HTTP_TOO_MANY_REQUESTS,
            errors: ['retry_after' => $retryAfterSeconds],
            errorCode: 'RATE_LIMITED',
            extraMeta: $meta
        )->header('Retry-After', (string) $retryAfterSeconds);
    }
}
