<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Models\PageBanner;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak', [
            'setting'    => SiteSetting::first() ?? new SiteSetting(),
            'pageBanner' => PageBanner::where('page', 'kontak')->first(),
        ]);
    }

    public function kirim(Request $request)
    {
        $data = $request->validate([
            'nama'   => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s]+$/'],
            'email'  => 'required|email|max:255',
            'instansi' => 'nullable|string|max:255',
            'kategori' => 'required|string|in:umum,teknis,kerjasama,pengaduan',
            'pesan'  => 'required|string|min:10',
        ], [
            'nama.regex' => 'Nama hanya boleh berisi huruf.',
            'pesan.min'  => 'Mohon tulis pesan Anda lebih rinci (minimal 10 karakter).',
        ]);

        ContactMessage::create($data);

        return back()->with('status', 'Pesan Anda berhasil dikirim. Tim kami akan segera merespons.');
    }
}