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
        TimelineItem::create($this->validated($request));

        return redirect()->route('admin.timeline.index')->with('success', 'Poin sejarah ditambahkan.');
    }

    public function edit(TimelineItem $timeline)
    {
        return view('admin.timeline.form', ['item' => $timeline]);
    }

    public function update(Request $request, TimelineItem $timeline)
    {
        $timeline->update($this->validated($request));

        return redirect()->route('admin.timeline.index')->with('success', 'Poin sejarah diperbarui.');
    }

    public function destroy(TimelineItem $timeline)
    {
        $timeline->delete();

        return redirect()->route('admin.timeline.index')->with('success', 'Poin sejarah dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'year'        => 'required|string|max:20',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order'  => 'required|integer',
        ]);
    }
}