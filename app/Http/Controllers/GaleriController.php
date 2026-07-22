<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\GalleryCategory;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->query('kategori');

        $categories = GalleryCategory::withCount('items')->orderBy('sort_order')->get();

        $items = GalleryItem::with('category')
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($q2) => $q2->where('slug', $categorySlug)))
            ->orderBy('sort_order')
            ->paginate(12)
            ->withQueryString();

        $totalFoto = GalleryItem::count();
        $kegiatanTerdokumentasi = GalleryItem::whereNotNull('title')->distinct('title')->count('title');
        $totalKategori = GalleryCategory::count();

        $tahunAwal = GalleryItem::min('created_at');
        $tahunAkhir = GalleryItem::max('created_at');
        $rentangWaktu = '-';
        if ($tahunAwal) {
            $awal = Carbon::parse($tahunAwal)->year;
            $akhir = Carbon::parse($tahunAkhir)->year;
            $rentangWaktu = $awal == $akhir ? (string) $awal : "{$awal}–{$akhir}";
        }

        $featured = GalleryItem::with('category')->where('is_featured', true)->latest()->first();

        return view('galeri', [
            'items'                  => $items,
            'categories'             => $categories,
            'activeCategory'         => $categorySlug,
            'setting'                => SiteSetting::first(),
            'totalFoto'              => $totalFoto,
            'kegiatanTerdokumentasi' => $kegiatanTerdokumentasi,
            'totalKategori'          => $totalKategori,
            'rentangWaktu'           => $rentangWaktu,
            'featured'               => $featured,
        ]);
    }
}