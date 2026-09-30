<?php

namespace Modules\Social\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use InvalidArgumentException;

class MediaStorageService
{
    /**
     * Allowed MIME types and their extensions.
     */
    protected const ALLOWED_MIME_TYPES = [
        'image/jpeg' => ['type' => 'image', 'ext' => 'jpg', 'max_size' => 15728640],     // 15MB
        'image/png' => ['type' => 'image', 'ext' => 'png', 'max_size' => 15728640],       // 15MB
        'image/webp' => ['type' => 'image', 'ext' => 'webp', 'max_size' => 15728640],     // 15MB
        'image/gif' => ['type' => 'image', 'ext' => 'gif', 'max_size' => 10485760],       // 10MB
        'video/mp4' => ['type' => 'video', 'ext' => 'mp4', 'max_size' => 104857600],      // 100MB
        'video/quicktime' => ['type' => 'video', 'ext' => 'mov', 'max_size' => 104857600],// 100MB
        'application/pdf' => ['type' => 'document', 'ext' => 'pdf', 'max_size' => 20971520], // 20MB
    ];

    /**
     * Generate presigned direct upload URL.
     * Clients upload large binary objects directly to S3/MinIO or signed local endpoint,
     * avoiding web worker saturation and preserving application bandwidth.
     */
    public function generatePresignedUpload(
        User $user,
        string $filename,
        string $mimeType,
        int $fileSizeBytes
    ): array {
        if (!isset(self::ALLOWED_MIME_TYPES[$mimeType])) {
            throw new InvalidArgumentException("Unsupported media MIME type: [{$mimeType}]. Supported types: JPEG, PNG, WebP, GIF, MP4, QuickTime, PDF.");
        }

        $meta = self::ALLOWED_MIME_TYPES[$mimeType];

        if ($fileSizeBytes > $meta['max_size']) {
            $maxMb = round($meta['max_size'] / (1024 * 1024));
            throw new InvalidArgumentException("File size exceeds maximum allowed limit of {$maxMb}MB for this media format.");
        }

        $extension = $meta['ext'];
        $uniqueId = (string) Str::uuid();
        $year = date('Y');
        $month = date('m');
        $storagePath = "media/posts/{$user->id}/{$year}/{$month}/{$uniqueId}.{$extension}";

        $expiresAt = now()->addMinutes(20);
        $diskName = config('filesystems.default', 'public');

        if ($diskName === 's3' && config('filesystems.disks.s3.bucket')) {
            $uploadUrl = $this->generateS3PresignedUrl($storagePath, $mimeType, $expiresAt);
            $publicUrl = Storage::disk('s3')->url($storagePath);
        } else {
            // Local / development signed upload endpoint
            $uploadUrl = URL::temporarySignedRoute(
                'api.v1.media.direct-upload',
                $expiresAt,
                ['path' => base64_encode($storagePath)]
            );
            $publicUrl = asset('storage/' . $storagePath);
        }

        return [
            'upload_url' => $uploadUrl,
            'storage_path' => $storagePath,
            'public_url' => $publicUrl,
            'media_type' => $meta['type'],
            'mime_type' => $mimeType,
            'file_size_bytes' => $fileSizeBytes,
            'expires_at' => $expiresAt->toIso8601String(),
            'required_headers' => [
                'Content-Type' => $mimeType,
            ],
        ];
    }

    /**
     * Store directly uploaded file into configured disk.
     */
    public function storeDirectFile(UploadedFile $file, string $storagePath): string
    {
        $diskName = config('filesystems.default', 'public');
        $disk = Storage::disk($diskName === 's3' ? 's3' : 'public');

        $disk->put($storagePath, file_get_contents($file->getRealPath()));

        return $diskName === 's3'
            ? Storage::disk('s3')->url($storagePath)
            : asset('storage/' . $storagePath);
    }

    /**
     * Generate S3 / MinIO presigned PUT url.
     */
    protected function generateS3PresignedUrl(string $path, string $mimeType, \DateTimeInterface $expiresAt): string
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('s3');

        if (method_exists($disk, 'temporaryUploadUrl')) {
            return $disk->temporaryUploadUrl($path, $expiresAt, [
                'ContentType' => $mimeType,
            ]);
        }

        // Fallback for AWS S3 Client
        $client = $disk->getClient();
        $command = $client->getCommand('PutObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $path,
            'ContentType' => $mimeType,
        ]);

        $request = $client->createPresignedRequest($command, $expiresAt);
        return (string) $request->getUri();
    }
}
