<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StelaVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StelaVideoController extends Controller
{
    const MAX_ITEMS = 1;

    public function index()
    {
        return view('admin.stela-videos.index', [
            'items' => StelaVideo::latest()->get(),
            'maxItems' => self::MAX_ITEMS,
        ]);
    }

    public function create()
    {
        if (StelaVideo::count() >= self::MAX_ITEMS) {
            return redirect()->route('admin.stela-videos.index')
                ->with('error', 'Maksimal ' . self::MAX_ITEMS . ' video Sekilas STELA. Hapus video yang ada terlebih dahulu untuk menggantinya.');
        }

        return view('admin.stela-videos.form', [
            'item' => new StelaVideo(),
        ]);
    }

    public function store(Request $request)
    {
        if (StelaVideo::count() >= self::MAX_ITEMS) {
            return redirect()->route('admin.stela-videos.index')
                ->with('error', 'Maksimal ' . self::MAX_ITEMS . ' video Sekilas STELA. Hapus video yang ada terlebih dahulu untuk menggantinya.');
        }

        $data = $this->validated($request);

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('videos', 'assets');
        }

        StelaVideo::create($data);

        return redirect()->route('admin.stela-videos.index')->with('success', 'Video Sekilas STELA ditambahkan.');
    }

    public function edit(StelaVideo $stelaVideo)
    {
        return view('admin.stela-videos.form', [
            'item' => $stelaVideo,
        ]);
    }

    public function update(Request $request, StelaVideo $stelaVideo)
    {
        $data = $this->validated($request);

        if ($request->boolean('hapus_video') && $stelaVideo->video) {
            Storage::disk('assets')->delete($stelaVideo->video);
            $data['video'] = null;
        } elseif ($request->hasFile('video')) {
            if ($stelaVideo->video) {
                Storage::disk('assets')->delete($stelaVideo->video);
            }
            $data['video'] = $request->file('video')->store('videos', 'assets');
        }

        $stelaVideo->update($data);

        return redirect()->route('admin.stela-videos.index')->with('success', 'Video Sekilas STELA diperbarui.');
    }

    public function destroy(StelaVideo $stelaVideo)
    {
        if ($stelaVideo->video) {
            Storage::disk('assets')->delete($stelaVideo->video);
        }

        $stelaVideo->delete();

        return redirect()->route('admin.stela-videos.index')->with('success', 'Video Sekilas STELA dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'video_type'  => 'required|in:upload,youtube',
            'youtube_url' => 'required_if:video_type,youtube|nullable|url',
            'video'       => 'nullable|mimes:mp4,webm,ogg|max:51200',
            'link_url'    => 'nullable|url',
        ]);
    }
}
