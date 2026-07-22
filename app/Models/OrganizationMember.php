<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    protected $fillable = ['name', 'position', 'photo', 'unit_description', 'level', 'sort_order'];
}