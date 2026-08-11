<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'title_en', 'description', 'description_en', 'features', 'features_en', 'icon_image', 'cta_text', 'cta_text_en', 'sort_order', 'is_active'];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
        'is_active' => 'boolean',
    ];
}
