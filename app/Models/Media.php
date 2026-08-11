<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Media extends Model
{
    protected $fillable = ['original_name', 'mime_type', 'size', 'data'];

    public static function storeUpload(UploadedFile $file): string
    {
        $media = self::create([
            'original_name' => $file->getClientOriginalName(),
            'mime_type'     => $file->getMimeType(),
            'size'          => $file->getSize(),
            'data'          => file_get_contents($file->getRealPath()),
        ]);

        return 'media/'.$media->id;
    }

    public static function deleteRef(?string $ref): void
    {
        if (! $ref || ! str_starts_with($ref, 'media/')) {
            return;
        }

        self::whereKey(substr($ref, 6))->delete();
    }
}
