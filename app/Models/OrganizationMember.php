<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    protected $fillable = ['name', 'position', 'position_en', 'photo', 'unit_description', 'unit_description_en', 'level', 'sort_order'];
}