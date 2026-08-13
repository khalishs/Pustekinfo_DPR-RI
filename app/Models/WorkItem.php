<?php

namespace App\Models;

use App\Support\WorkItemIcons;
use Illuminate\Database\Eloquent\Model;

class WorkItem extends Model
{
    protected $fillable = [
        'title', 'title_en', 'description', 'description_en',
        'icon_key', 'row_position', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'row_position' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function iconSvg(): string
    {
        return WorkItemIcons::svg($this->icon_key);
    }
}
