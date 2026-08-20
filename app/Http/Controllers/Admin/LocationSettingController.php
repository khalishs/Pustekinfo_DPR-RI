<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class LocationSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();

        return view('admin.settings.location', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'maps_embed_url' => 'nullable|url',
        ]);

        $data['show_location'] = $request->boolean('show_location');

        $setting = SiteSetting::first() ?? new SiteSetting();
        $setting->fill($data)->save();

        return redirect()->route('admin.location-settings.edit')->with('success', 'Pengaturan lokasi diperbarui.');
    }
}
