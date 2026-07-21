<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    public function index()
    {
        return view('admin.gallery.index', [
            'items' => GalleryItem::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.gallery.form', ['item' => new GalleryItem()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);

        $data['image'] = $request->file('image')->store('galeri', 'public');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri ditambahkan.');
    }

    public function edit(GalleryItem $galleryItem)
    {
        return view('admin.gallery.form', ['item' => $galleryItem]);
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image')) {
            if ($galleryItem->image) {
                Storage::disk('public')->delete($galleryItem->image);
            }
            $data['image'] = $request->file('image')->store('galeri', 'public');
        }

        $galleryItem->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri diperbarui.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        if ($galleryItem->image) {
            Storage::disk('public')->delete($galleryItem->image);
        }
        $galleryItem->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri dihapus.');
    }
}