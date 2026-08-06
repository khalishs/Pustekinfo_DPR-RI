<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Models\PageBanner;
use App\Support\NormalizesPhoneNumbers;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    use NormalizesPhoneNumbers;

    // Sementara, dipakai kalau nomor WA belum diisi lewat Pengaturan Kontak di admin.
    private const FALLBACK_WA_NUMBER = '08159646281';

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
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'instansi' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'pesan'  => 'required|string',
        ]);

        $message = ContactMessage::create($data);

        $setting = SiteSetting::first() ?? new SiteSetting();
        $waNumber = $this->toWhatsappNumber($setting->phone) ?? $this->toWhatsappNumber(self::FALLBACK_WA_NUMBER);
        $waMessage = "Halo, ada pesan baru dari website Pustekinfo.\n\n"
            . "Nama: {$message->nama}\n"
            . "Email: {$message->email}\n"
            . "Kategori: {$message->kategori}\n"
            . "Pesan: {$message->pesan}";
        $waUrl = $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage) : null;

        return back()->with('status', 'Pesan Anda berhasil dikirim. Tim kami akan segera merespons.')->with('waUrl', $waUrl);
    }
}