<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\Leadership;
use App\Models\NewsItem;
use App\Models\AgendaEvent;
use App\Models\GalleryItem;
use App\Models\SiteSetting;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        $today = Carbon::today();
        $monthStart = $today->copy()->startOfMonth();
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
                'day'   => $cursor->day,
                'muted' => ! $cursor->isSameMonth($monthStart),
                'today' => $cursor->isToday(),
                'events'=> $eventsInRange->get($dateStr, collect()),
            ];
            $cursor->addDay();
        }

        return view('home', [
            'stats'         => Statistic::orderBy('sort_order')->get(),
            'leadership'    => Leadership::first(),
            'featuredNews'  => NewsItem::where('is_featured', true)->latest('published_at')->first(),
            'latestNews'    => NewsItem::where('is_featured', false)->latest('published_at')->take(4)->get(),
            'todayEvents'   => AgendaEvent::whereDate('event_date', $today)->get(),
            'galleries'     => GalleryItem::orderBy('sort_order')->get(),
            'setting'       => SiteSetting::first(),
            'calendarDays'  => $calendarDays,
            'monthLabel'    => $bulanIndo[$monthStart->month - 1] . ' ' . $monthStart->year,
        ]);
    }
}