<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    public function edit()
    {
        $item = VisionMission::first() ?? new VisionMission();

        return view('admin.vision-mission.edit', ['item' => $item]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'vision_text'   => 'required|string',
            'mission_items' => 'required|string',
        ]);

        $item = VisionMission::first() ?? new VisionMission();
        $item->fill($data)->save();

        return redirect()->route('admin.vision-mission.edit')->with('success', 'Visi & Misi diperbarui.');
    }
}