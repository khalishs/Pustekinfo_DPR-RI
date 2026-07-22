<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        return view('admin.gallery-categories.index', [
            'categories' => GalleryCategory::withCount('items')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.gallery-categories.form', ['category' => new GalleryCategory()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']);
        GalleryCategory::create($data);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Kategori ditambahkan.');
    }

    public function edit(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery-categories.form', ['category' => $galleryCategory]);
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']);
        $galleryCategory->update($data);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Kategori diperbarui.');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        if ($galleryCategory->items()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih dipakai foto galeri.');
        }

        $galleryCategory->delete();

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Kategori dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'       => 'required|string|max:100',
            'sort_order' => 'required|integer',
        ]);
    }
}