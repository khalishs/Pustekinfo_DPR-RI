<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    const MAX_HOME_ITEMS = 8;

    const SIZE_LIMITS = ['big' => 1, 'med' => 2, 'wide' => 1, 'small' => 4];

    const SIZE_LABELS = ['big' => 'Besar (2x2)', 'med' => 'Sedang', 'wide' => 'Lebar', 'small' => 'Kecil'];

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
            'homeCount' => GalleryItem::where('show_on_home', true)->count(),
            'maxHomeItems' => self::MAX_HOME_ITEMS,
            'sizeCounts' => $this->sizeCounts(null),
            'sizeLimits' => self::SIZE_LIMITS,
            'sizeLabels' => self::SIZE_LABELS,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true, null);
        $data['image'] = $request->file('image')->store('galeri', 'public');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['show_on_home'] = $request->boolean('show_on_home');

        GalleryItem::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto galeri ditambahkan.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.gallery.form', [
            'item' => $gallery,
            'categories' => GalleryCategory::orderBy('sort_order')->get(),
            'homeCount' => GalleryItem::where('show_on_home', true)->whereKeyNot($gallery->id)->count(),
            'maxHomeItems' => self::MAX_HOME_ITEMS,
            'sizeCounts' => $this->sizeCounts($gallery),
            'sizeLimits' => self::SIZE_LIMITS,
            'sizeLabels' => self::SIZE_LABELS,
        ]);
    }

    private function sizeCounts(?GalleryItem $gallery): array
    {
        return GalleryItem::where('show_on_home', true)
            ->when($gallery, fn ($q) => $q->whereKeyNot($gallery->id))
            ->selectRaw('size, count(*) as c')
            ->groupBy('size')
            ->pluck('c', 'size')
            ->toArray();
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $data = $this->validated($request, false, $gallery);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['show_on_home'] = $request->boolean('show_on_home');

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

    private function validated(Request $request, bool $imageRequired, ?GalleryItem $gallery): array
    {
        return $request->validate([
            'title'          => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'description_en' => 'nullable|string',
            'category_id'    => 'required|exists:gallery_categories,id',
            'size'           => ['required', 'in:big,med,wide,small', function ($attribute, $value, $fail) use ($request, $gallery) {
                if (! $request->boolean('show_on_home')) {
                    return;
                }

                $max = self::SIZE_LIMITS[$value] ?? null;
                if ($max === null) {
                    return;
                }

                $count = GalleryItem::where('show_on_home', true)
                    ->where('size', $value)
                    ->when($gallery, fn ($q) => $q->whereKeyNot($gallery->id))
                    ->count();

                if ($count >= $max) {
                    $label = self::SIZE_LABELS[$value] ?? $value;
                    $message = "Slot ukuran \"{$label}\" di halaman utama sudah penuh (maksimal {$max}). Pilih ukuran lain atau kosongkan salah satu foto \"{$label}\" dari Home terlebih dahulu.";
                    session()->flash('error', $message);
                    $fail($message);
                }
            }],
            'sort_order'     => 'required|integer',
            'image'          => ($imageRequired ? 'required' : 'nullable') . '|image|min:2048|max:10240',
            'is_featured'    => ['sometimes', function ($attribute, $value, $fail) use ($request, $gallery) {
                if (! $request->boolean('is_featured')) {
                    return;
                }

                $alreadyFeatured = GalleryItem::where('is_featured', true)
                    ->when($gallery, fn ($q) => $q->whereKeyNot($gallery->id))
                    ->exists();

                if ($alreadyFeatured) {
                    $fail('Sudah ada foto lain yang dijadikan sorotan. Batalkan sorotan foto tersebut terlebih dahulu sebelum memilih foto ini.');
                }
            }],
            'show_on_home'   => ['sometimes', function ($attribute, $value, $fail) use ($request, $gallery) {
                if (! $request->boolean('show_on_home')) {
                    return;
                }

                $countOnHome = GalleryItem::where('show_on_home', true)
                    ->when($gallery, fn ($q) => $q->whereKeyNot($gallery->id))
                    ->count();

                if ($countOnHome >= self::MAX_HOME_ITEMS) {
                    $message = 'Maksimal ' . self::MAX_HOME_ITEMS . ' foto yang bisa ditampilkan di halaman utama (Home). Batalkan salah satu foto lain dari Home terlebih dahulu.';
                    session()->flash('error', $message);
                    $fail($message);
                }
            }],
        ]);
    }
}