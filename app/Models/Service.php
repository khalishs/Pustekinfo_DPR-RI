<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'title_en', 'description', 'description_en', 'features', 'features_en', 'icon_svg', 'cta_text', 'cta_text_en', 'sort_order'];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
    ];
}
