<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaEvent extends Model
{
    protected $fillable = ['title', 'title_en', 'description', 'description_en', 'event_date', 'event_time', 'location', 'color', 'is_active'];

    protected $casts = ['event_date' => 'date', 'is_active' => 'boolean'];
}