<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    protected $fillable = ['name', 'show_name', 'position', 'position_en', 'photo', 'show_photo', 'unit_description', 'unit_description_en', 'level', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean', 'show_name' => 'boolean', 'show_photo' => 'boolean'];
}