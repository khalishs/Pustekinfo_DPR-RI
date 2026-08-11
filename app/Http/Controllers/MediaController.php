<?php

namespace App\Http\Controllers;

use App\Models\Media;

class MediaController extends Controller
{
    public function show(Media $media)
    {
        return response($media->data, 200)
            ->header('Content-Type', $media->mime_type)
            ->header('Content-Length', (string) $media->size)
            ->header('Cache-Control', 'public, max-age=31536000, immutable');
    }
}
