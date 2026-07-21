<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'instansi' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'pesan'  => 'required|string',
        ]);

        // Untuk sekarang pesan belum disimpan/dikirim ke mana pun.
        // Bisa dikembangkan nanti: simpan ke tabel 'messages', atau kirim email pakai Mail::send().

        return back()->with('status', 'Pesan Anda berhasil dikirim. Tim kami akan segera merespons.');
    }
}