<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StelaVideo;
use Illuminate\Http\Request;

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

        StelaVideo::create($this->validated($request));

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
        $stelaVideo->update($this->validated($request));

        return redirect()->route('admin.stela-videos.index')->with('success', 'Video Sekilas STELA diperbarui.');
    }

    public function destroy(StelaVideo $stelaVideo)
    {
        $stelaVideo->delete();

        return redirect()->route('admin.stela-videos.index')->with('success', 'Video Sekilas STELA dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'video_url' => 'nullable|url',
            'link_url'  => 'nullable|url',
        ]);
    }
}
