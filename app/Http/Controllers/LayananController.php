<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\PageBanner;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get()->map(fn (Service $service) => [
            'id'          => Str::slug($service->title),
            'title'       => $service->title,
            'title_en'    => $service->title_en,
            'desc'        => $service->description,
            'desc_en'     => $service->description_en,
            'features'    => $service->features,
            'features_en' => $service->features_en,
            'cta'         => $service->cta_text,
            'cta_en'      => $service->cta_text_en,
            'icon'        => $service->icon_svg,
        ])->all();

        return view('layanan', [
            'services'   => $services,
            'setting'    => SiteSetting::first(),
            'pageBanner' => PageBanner::where('page', 'layanan')->first(),
        ]);
    }
}
