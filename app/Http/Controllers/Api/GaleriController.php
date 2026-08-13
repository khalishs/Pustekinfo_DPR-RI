<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categorySlug = $request->query('kategori');

        $items = GalleryItem::with('category')
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($q2) => $q2->where('slug', $categorySlug)))
            ->orderBy('sort_order')
            ->paginate(12);

        return response()->json($items);
    }

    public function categories(): JsonResponse
    {
        return response()->json([
            'data' => GalleryCategory::where('is_active', true)->withCount('items')->orderBy('sort_order')->get(),
        ]);
    }
}
