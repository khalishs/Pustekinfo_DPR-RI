<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leadership extends Model
{
    protected $fillable = [
    'name', 'position', 'photo', 'welcome_title', 'welcome_title_en', 'description', 'description_en',
    'signature_role', 'signature_role_en', 'education', 'education_en', 'term', 'term_en',
    'expertise', 'expertise_en', 'email',
];
}