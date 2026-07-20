<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('kategori');

        $items = GalleryItem::when($category, fn ($q) => $q->where('category', $category))
            ->orderBy('sort_order')
            ->paginate(12)
            ->withQueryString();

        return view('galeri', [
            'items'          => $items,
            'activeCategory' => $category,
            'setting'        => SiteSetting::first(),
        ]);
    }
}