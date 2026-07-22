<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index', [
            'items' => GalleryItem::with('category')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.gallery.form', [
            'item' => new GalleryItem(),
            'categories' => GalleryCategory::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $request->file('image')->store('galeri', 'public');
        $data['is_featured'] = $request->boolean('is_featured');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri ditambahkan.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.gallery.form', [
            'item' => $gallery,
            'categories' => GalleryCategory::orderBy('sort_order')->get(),
        ]);
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $data = $this->validated($request, false);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('galeri', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri diperbarui.');
    }

    public function destroy(GalleryItem $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri dihapus.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:gallery_categories,id',
            'size'        => 'required|in:big,med,wide,small',
            'sort_order'  => 'required|integer',
            'image'       => ($imageRequired ? 'required' : 'nullable') . '|image|max:2048',
        ]);
    }
}