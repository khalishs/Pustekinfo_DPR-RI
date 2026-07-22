<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class LayananController extends Controller
{
    public function index()
    {
        return view('layanan', [
            'setting' => SiteSetting::first(),
        ]);
    }
}
