<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreValue extends Model
{
    protected $fillable = ['title', 'title_en', 'description', 'description_en', 'icon', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}