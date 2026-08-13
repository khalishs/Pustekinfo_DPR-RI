<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineItem extends Model
{
    protected $fillable = ['year', 'title', 'title_en', 'description', 'description_en', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}