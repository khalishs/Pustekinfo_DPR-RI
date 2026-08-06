<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['icon_svg', 'label', 'label_en', 'value', 'suffix', 'decimals', 'sort_order'];
}