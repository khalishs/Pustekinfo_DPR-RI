<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Models\PageBanner;
use App\Models\ProfilPhoto;
use App\Models\Statistic;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function heroSlides(): JsonResponse
    {
        return response()->json([
            'data' => HeroSlide::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function profilPhotos(): JsonResponse
    {
        return response()->json([
            'data' => ProfilPhoto::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function statistics(): JsonResponse
    {
        return response()->json([
            'data' => Statistic::orderBy('sort_order')->get(),
        ]);
    }

    public function pageBanner(string $page): JsonResponse
    {
        if (! array_key_exists($page, PageBanner::PAGES)) {
            return response()->json(['message' => 'Halaman tidak dikenal.'], 404);
        }

        return response()->json([
            'data' => PageBanner::where('page', $page)->first(),
        ]);
    }
}
