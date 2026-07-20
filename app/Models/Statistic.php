<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['key', 'label', 'value', 'suffix', 'decimals', 'sort_order'];
}