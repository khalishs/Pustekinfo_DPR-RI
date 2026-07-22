<?php

namespace App\Http\Controllers;

use App\Models\TimelineItem;
use App\Models\Leadership;
use App\Models\OrganizationMember;
use App\Models\VisionMission;
use App\Models\CoreValue;
use App\Models\SiteSetting;

class ProfilController extends Controller
{
    public function index()
    {
        $members = OrganizationMember::orderBy('sort_order')->get();

        return view('profil', [
            'timeline'      => TimelineItem::orderBy('sort_order')->get(),
            'leadership'    => Leadership::first(),
            'members'       => $members,
            'kepala'        => $members->firstWhere('level', 'kepala'),
            'sekretariat'   => $members->firstWhere('level', 'sekretariat'),
            'bidangList'    => $members->where('level', 'bidang')->values(),
            'visionMission' => VisionMission::first(),
            'coreValues'    => CoreValue::orderBy('sort_order')->get(),
            'setting'       => SiteSetting::first(),
        ]);
    }
}