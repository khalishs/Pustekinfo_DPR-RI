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
        $data['is_active'] = $request->boolean('is_active');
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
        $data['is_active'] = $request->boolean('is_active');
        $galleryCategory->update($data);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Kategori diperbarui.');
    }

    public function toggleActive(GalleryCategory $galleryCategory)
    {
        $newState = ! $galleryCategory->is_active;
        $galleryCategory->update(['is_active' => $newState]);

        return redirect()->route('admin.gallery-categories.index')->with(
            'success',
            $newState ? 'Kategori diaktifkan kembali dan akan tampil ke pengguna.' : 'Kategori dinonaktifkan dan tidak akan tampil ke pengguna.'
        );
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
            'name_en'    => 'nullable|string|max:100',
            'sort_order' => 'required|integer',
            'is_active'  => 'sometimes|boolean',
        ]);
    }
}