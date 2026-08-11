<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimelineItem;
use Illuminate\Http\Request;

class TimelineItemController extends Controller
{
    public function index()
    {
        return view('admin.timeline.index', [
            'items' => TimelineItem::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.timeline.form', ['item' => new TimelineItem()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        TimelineItem::create($data);

        return redirect()->route('admin.timeline.index')->with('success', 'Poin sejarah ditambahkan.');
    }

    public function edit(TimelineItem $timeline)
    {
        return view('admin.timeline.form', ['item' => $timeline]);
    }

    public function update(Request $request, TimelineItem $timeline)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $timeline->update($data);

        return redirect()->route('admin.timeline.index')->with('success', 'Poin sejarah diperbarui.');
    }

    public function toggleActive(TimelineItem $timeline)
    {
        $newState = ! $timeline->is_active;
        $timeline->update(['is_active' => $newState]);

        return redirect()->route('admin.timeline.index')->with(
            'success',
            $newState ? 'Poin sejarah diaktifkan kembali dan akan tampil ke pengguna.' : 'Poin sejarah dinonaktifkan dan tidak akan tampil ke pengguna.'
        );
    }

    public function destroy(TimelineItem $timeline)
    {
        $timeline->delete();

        return redirect()->route('admin.timeline.index')->with('success', 'Poin sejarah dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'year'           => 'required|string|max:20',
            'title'          => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description'    => 'required|string',
            'description_en' => 'nullable|string',
            'sort_order'     => 'required|integer',
            'is_active'      => 'sometimes|boolean',
        ]);
    }
}