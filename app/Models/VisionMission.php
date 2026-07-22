<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    protected $fillable = ['vision_text', 'mission_items'];

    public function missionList(): array
    {
        return array_filter(array_map('trim', explode("\n", $this->mission_items ?? '')));
    }
}