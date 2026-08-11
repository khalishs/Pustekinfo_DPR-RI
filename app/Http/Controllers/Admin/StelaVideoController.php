<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StelaVideoController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::first() ?? new SiteSetting();

        return view('admin.layanan.stela-video', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'stela_video_type'  => 'required|in:upload,youtube',
            'stela_youtube_url' => 'required_if:stela_video_type,youtube|nullable|url',
            'stela_video'       => 'nullable|mimes:mp4,webm,ogg|max:51200',
            'stela_url'         => 'nullable|url',
        ]);

        $setting = SiteSetting::first() ?? new SiteSetting();

        if ($request->boolean('hapus_stela_video') && $setting->stela_video) {
            Storage::disk('assets')->delete($setting->stela_video);
            $data['stela_video'] = null;
        } elseif ($request->hasFile('stela_video')) {
            if ($setting->stela_video) {
                Storage::disk('assets')->delete($setting->stela_video);
            }
            $data['stela_video'] = $request->file('stela_video')->store('videos', 'assets');
        }

        $setting->fill($data)->save();

        return redirect()->route('admin.stela-video.edit')->with('success', 'Video Sekilas STELA diperbarui.');
    }
}
