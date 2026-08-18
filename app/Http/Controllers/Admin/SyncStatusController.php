<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgendaEvent;
use App\Models\ContactMessage;
use App\Models\CoreValue;
use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use App\Models\HeroSlide;
use App\Models\NewsItem;
use App\Models\OrganizationMember;
use App\Models\ProfilPhoto;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\StelaVideo;
use App\Models\Statistic;
use App\Models\TimelineItem;
use App\Models\WorkItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SyncStatusController extends Controller
{
    /**
     * Maps each admin list route's resource segment (admin.{resource}.index)
     * to the Eloquent model backing it, so the frontend can poll for changes
     * made from another device/tab without a websocket server.
     */
    public const RESOURCES = [
        'statistics' => Statistic::class,
        'news' => NewsItem::class,
        'agenda' => AgendaEvent::class,
        'gallery' => GalleryItem::class,
        'gallery-categories' => GalleryCategory::class,
        'timeline' => TimelineItem::class,
        'organization-members' => OrganizationMember::class,
        'core-values' => CoreValue::class,
        'hero-slides' => HeroSlide::class,
        'profil-photos' => ProfilPhoto::class,
        'work-items' => WorkItem::class,
        'services' => Service::class,
        'stela-videos' => StelaVideo::class,
        'messages' => ContactMessage::class,
        'layanan-pengajuan' => ServiceRequest::class,
    ];

    public function check(Request $request): JsonResponse
    {
        $model = self::RESOURCES[$request->query('resource')] ?? null;

        if (! $model) {
            return response()->json(['version' => null], 404);
        }

        $latest = $model::max('updated_at');

        return response()->json([
            'version' => ($latest ? strtotime($latest) : 0) . ':' . $model::count(),
        ]);
    }
}
