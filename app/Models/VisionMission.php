<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    protected $fillable = ['vision_text', 'vision_text_en', 'mission_items', 'mission_items_en'];

    public function missionList(): array
    {
        return array_filter(array_map('trim', explode("\n", $this->mission_items ?? '')));
    }

    public function missionListEn(): array
    {
        return array_filter(array_map('trim', explode("\n", $this->mission_items_en ?? '')));
    }
}