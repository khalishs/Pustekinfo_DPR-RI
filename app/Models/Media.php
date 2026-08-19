<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['original_name', 'mime_type', 'size', 'path', 'data'];

    public static function storeUpload(UploadedFile $file): string
    {
        $path = $file->store('media', 'public');

        $media = self::create([
            'original_name' => $file->getClientOriginalName(),
            'mime_type'     => $file->getMimeType(),
            'size'          => $file->getSize(),
            'path'          => $path,
        ]);

        return 'media/'.$media->id;
    }

    public static function deleteRef(?string $ref): void
    {
        if (! $ref) {
            return;
        }

        if (! str_starts_with($ref, 'media/')) {
            // Path lama dari sebelum tabel Media dibuat (mis. "hero/xxx.jpg") — hapus langsung dari disk.
            Storage::disk('public')->delete($ref);

            return;
        }

        $media = self::find(substr($ref, 6));
        if (! $media) {
            return;
        }

        if ($media->path) {
            Storage::disk('public')->delete($media->path);
        }

        $media->delete();
    }
}
