<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('media_url')) {
    /**
     * Resolve a public URL for an uploaded media file. Reads from whichever
     * disk MEDIA_DISK points to — the local "public" disk by default, or an
     * S3-compatible disk once one is configured — so switching storage
     * backends doesn't require touching every view that displays an image.
     */
    function media_url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return Storage::disk(config('filesystems.media_disk'))->url($path);
    }
}
