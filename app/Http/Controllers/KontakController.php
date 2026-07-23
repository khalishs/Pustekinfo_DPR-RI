<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak', [
            'setting' => SiteSetting::first(),
        ]);
    }

    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'instansi' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'pesan'  => 'required|string',
        ]);

        ContactMessage::create($data);

        return back()->with('status', 'Pesan Anda berhasil dikirim. Tim kami akan segera merespons.');
    }
}