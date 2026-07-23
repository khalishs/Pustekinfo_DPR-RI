<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'features', 'icon_svg', 'cta_text', 'sort_order'];

    protected $casts = [
        'features' => 'array',
    ];
}
