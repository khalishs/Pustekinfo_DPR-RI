<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        return view('admin.hero-slides.index', [
            'slides' => HeroSlide::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.hero-slides.form', [
            'slide' => new HeroSlide(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $request->file('image')->store('hero', 'public');
        $data['is_active'] = $request->boolean('is_active');

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide ditambahkan.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.form', ['slide' => $heroSlide]);
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $data = $this->validated($request, false);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($heroSlide->image);
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide diperbarui.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        Storage::disk('public')->delete($heroSlide->image);
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Slide dihapus.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'title'      => 'nullable|string|max:255',
            'subtitle'   => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
            'image'      => ($imageRequired ? 'required' : 'nullable') . '|image|max:4096',
        ]);
    }
}
