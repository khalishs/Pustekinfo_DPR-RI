<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    protected $fillable = [
        'title', 'title_en', 'category', 'category_en', 'excerpt', 'excerpt_en',
        'content', 'content_en', 'image',
        'author', 'reading_minutes', 'is_featured', 'published_at',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
    ];
}