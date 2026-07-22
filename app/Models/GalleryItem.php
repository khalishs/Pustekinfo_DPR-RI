<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['title', 'description', 'image', 'category_id', 'size', 'is_featured', 'sort_order'];

    protected $casts = ['is_featured' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }
}