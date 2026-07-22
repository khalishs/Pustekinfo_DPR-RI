<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leadership extends Model
{
    protected $fillable = [
    'name', 'position', 'photo', 'welcome_title', 'description', 'signature_role',
    'education', 'term', 'expertise', 'email',
];
}