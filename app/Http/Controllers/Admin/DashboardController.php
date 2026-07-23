<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgendaEvent;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\NewsItem;
use App\Models\OrganizationMember;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'newsCount' => NewsItem::count(),
            'upcomingAgendaCount' => AgendaEvent::where('event_date', '>=', Carbon::today())->count(),
            'galleryCount' => GalleryItem::count(),
            'organizationMemberCount' => OrganizationMember::count(),
            'unreadMessagesCount' => ContactMessage::where('is_read', false)->count(),
            'latestMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
