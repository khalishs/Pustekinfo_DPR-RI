<?php

namespace App\Http\Controllers;

use App\Models\AgendaEvent;
use App\Models\NewsItem;
use App\Models\SiteSetting;
use Carbon\Carbon;

class InformasiController extends Controller
{
    public function index()
    {
        $bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        $bulanParam = request('bulan');
        $monthStart = (is_string($bulanParam) && preg_match('/^\d{4}-\d{2}$/', $bulanParam))
            ? Carbon::createFromFormat('Y-m', $bulanParam)->startOfMonth()
            : Carbon::today()->startOfMonth();

        $gridStart = $monthStart->copy()->startOfWeek(Carbon::MONDAY);
        $gridEnd = $monthStart->copy()->endOfMonth()->endOfWeek(Carbon::MONDAY);

        $eventsInRange = AgendaEvent::whereBetween('event_date', [$gridStart->format('Y-m-d'), $gridEnd->format('Y-m-d')])
            ->get()
            ->groupBy(fn ($e) => $e->event_date->format('Y-m-d'));

        $calendarDays = [];
        $cursor = $gridStart->copy();
        while ($cursor->lte($gridEnd)) {
            $dateStr = $cursor->format('Y-m-d');
            $calendarDays[] = [
                'day'    => $cursor->day,
                'muted'  => ! $cursor->isSameMonth($monthStart),
                'today'  => $cursor->isToday(),
                'events' => $eventsInRange->get($dateStr, collect()),
            ];
            $cursor->addDay();
        }

        $kategori = request('kategori');

        $news = NewsItem::when($kategori, fn ($q) => $q->where('category', $kategori))
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('informasi', [
            'news'          => $news,
            'kategoriList'  => NewsItem::select('category')->distinct()->pluck('category'),
            'kategoriAktif' => $kategori,
            'todayEvents'   => AgendaEvent::whereDate('event_date', Carbon::today())->get(),
            'calendarDays'  => $calendarDays,
            'monthLabel'    => $bulanIndo[$monthStart->month - 1].' '.$monthStart->year,
            'prevMonth'     => $monthStart->copy()->subMonth()->format('Y-m'),
            'nextMonth'     => $monthStart->copy()->addMonth()->format('Y-m'),
            'setting'       => SiteSetting::first(),
        ]);
    }

    public function show(NewsItem $news)
    {
        return view('berita-detail', [
            'news'    => $news,
            'setting' => SiteSetting::first(),
        ]);
    }
}
