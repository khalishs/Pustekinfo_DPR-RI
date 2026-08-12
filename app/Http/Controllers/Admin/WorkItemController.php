<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkItem;
use App\Support\WorkItemIcons;
use Illuminate\Http\Request;

class WorkItemController extends Controller
{
    const MAX_ITEMS = 20;

    public function index()
    {
        return view('admin.work-items.index', [
            'items' => WorkItem::orderBy('row_position')->orderBy('sort_order')->get(),
            'maxItems' => self::MAX_ITEMS,
        ]);
    }

    public function create()
    {
        if (WorkItem::count() >= self::MAX_ITEMS) {
            return redirect()->route('admin.work-items.index')
                ->with('error', 'Maksimal ' . self::MAX_ITEMS . ' card yang bisa ditampilkan di section "Apa yang Kami Kerjakan". Hapus salah satu card lama terlebih dahulu.');
        }

        return view('admin.work-items.form', [
            'item' => new WorkItem(),
            'icons' => WorkItemIcons::all(),
        ]);
    }

    public function store(Request $request)
    {
        if (WorkItem::count() >= self::MAX_ITEMS) {
            return redirect()->route('admin.work-items.index')
                ->with('error', 'Maksimal ' . self::MAX_ITEMS . ' card yang bisa ditampilkan di section "Apa yang Kami Kerjakan". Hapus salah satu card lama terlebih dahulu.');
        }

        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        WorkItem::create($data);

        return redirect()->route('admin.work-items.index')->with('success', 'Card ditambahkan.');
    }

    public function edit(WorkItem $workItem)
    {
        return view('admin.work-items.form', [
            'item' => $workItem,
            'icons' => WorkItemIcons::all(),
        ]);
    }

    public function update(Request $request, WorkItem $workItem)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $workItem->update($data);

        return redirect()->route('admin.work-items.index')->with('success', 'Card diperbarui.');
    }

    public function destroy(WorkItem $workItem)
    {
        $workItem->delete();

        return redirect()->route('admin.work-items.index')->with('success', 'Card dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'          => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description'    => 'required|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
            'icon_key'       => 'required|in:' . implode(',', WorkItemIcons::keys()),
            'row_position'   => 'required|integer|in:1,2',
            'sort_order'     => 'required|integer',
        ]);
    }
}
