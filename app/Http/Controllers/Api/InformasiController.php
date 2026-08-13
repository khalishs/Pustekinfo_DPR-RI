<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AgendaEvent;
use App\Models\NewsItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function news(Request $request): JsonResponse
    {
        $kategori = $request->query('kategori');

        $news = NewsItem::where('is_active', true)
            ->when($kategori, fn ($q) => $q->where('category', $kategori))
            ->latest('published_at')
            ->paginate(9);

        return response()->json($news);
    }

    public function newsShow(NewsItem $news): JsonResponse
    {
        abort_unless($news->is_active, 404);

        return response()->json(['data' => $news]);
    }

    public function agenda(Request $request): JsonResponse
    {
        $from = $request->query('dari');
        $to = $request->query('sampai');

        $agenda = AgendaEvent::where('is_active', true)
            ->when($from, fn ($q) => $q->whereDate('event_date', '>=', $from))
            ->when($to, fn ($q) => $q->whereDate('event_date', '<=', $to))
            ->orderBy('event_date')
            ->orderBy('event_time')
            ->paginate(20);

        return response()->json($agenda);
    }

    public function agendaShow(AgendaEvent $agendum): JsonResponse
    {
        abort_unless($agendum->is_active, 404);

        return response()->json(['data' => $agendum]);
    }
}
