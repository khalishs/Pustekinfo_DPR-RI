<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['title', 'title_en', 'description', 'description_en', 'image', 'category_id', 'size', 'is_featured', 'show_on_home', 'sort_order'];

    protected $casts = ['is_featured' => 'boolean', 'show_on_home' => 'boolean'];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }
}