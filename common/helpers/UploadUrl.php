<?php

namespace common\helpers;

/**
 * Builds public URLs for files physically stored under backend/web/uploads.
 */
final class UploadUrl
{
    public static function backendWeb(string $path): string
    {
        $path = ltrim($path, '/');
        $mediaBaseUrl = rtrim((string) getenv('MEDIA_BASE_URL'), '/');

        if ($mediaBaseUrl !== '') {
            return $mediaBaseUrl . '/backend/web/' . $path;
        }

        if (isset($_SERVER['HTTP_HOST'])
            && (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false
                || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false)) {
            return '/Sinpaptep/backend/web/' . $path;
        }

        return '/backend/web/' . $path;
    }
}
