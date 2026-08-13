<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function show(Media $media)
    {
        $data = $media->path
            ? Storage::disk('public')->get($media->path)
            : $media->data;

        return response($data, 200)
            ->header('Content-Type', $media->mime_type)
            ->header('Content-Length', (string) $media->size)
            ->header('Cache-Control', 'public, max-age=31536000, immutable');
    }
}
