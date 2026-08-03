<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'address'       => 'required|string',
            'address_en'    => 'nullable|string',
            'phone'         => 'required|string|max:50',
            'email'         => 'required|email|max:255',
            'instagram_url' => 'nullable|url',
            'youtube_url'   => 'nullable|url',
            'x_url'         => 'nullable|url',
            'maps_embed_url' => 'nullable|url',
        ]);

        $data['show_location'] = $request->boolean('show_location');

        $setting = SiteSetting::first() ?? new SiteSetting();
        $setting->fill($data)->save();

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan footer diperbarui.');
    }
}