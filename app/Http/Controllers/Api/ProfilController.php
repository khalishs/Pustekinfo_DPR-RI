<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use App\Models\Leadership;
use App\Models\OrganizationMember;
use App\Models\TimelineItem;
use App\Models\VisionMission;
use Illuminate\Http\JsonResponse;

class ProfilController extends Controller
{
    public function leadership(): JsonResponse
    {
        return response()->json([
            'data' => Leadership::first(),
        ]);
    }

    public function organizationMembers(): JsonResponse
    {
        return response()->json([
            'data' => OrganizationMember::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function visionMission(): JsonResponse
    {
        $visionMission = VisionMission::first();

        return response()->json([
            'data' => $visionMission ? [
                'vision_text'     => $visionMission->vision_text,
                'vision_text_en'  => $visionMission->vision_text_en,
                'mission_items'   => $visionMission->missionList(),
                'mission_items_en' => $visionMission->missionListEn(),
            ] : null,
        ]);
    }

    public function coreValues(): JsonResponse
    {
        return response()->json([
            'data' => CoreValue::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function timeline(): JsonResponse
    {
        return response()->json([
            'data' => TimelineItem::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }
}
