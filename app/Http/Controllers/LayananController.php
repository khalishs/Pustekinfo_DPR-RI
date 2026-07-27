<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get()->map(fn (Service $service) => [
            'id'       => Str::slug($service->title),
            'title'    => $service->title,
            'desc'     => $service->description,
            'features' => $service->features,
            'cta'      => $service->cta_text,
            'icon'     => $service->icon_svg,
        ])->all();

        return view('layanan', [
            'services' => $services,
            'setting'  => SiteSetting::first(),
        ]);
    }
}
