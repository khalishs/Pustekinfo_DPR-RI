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
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'instansi' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'pesan'  => 'required|string',
        ]);

        $message = ContactMessage::create($data);

        $setting = SiteSetting::first() ?? new SiteSetting();
        $waNumber = $this->toWhatsappNumber($setting->phone);
        $waMessage = "Halo, saya mengirim pesan melalui formulir kontak website.\n\n"
            . "Nama: {$message->nama}\n"
            . "Email: {$message->email}\n"
            . "Kategori: {$message->kategori}\n"
            . "Pesan: {$message->pesan}";
        $waUrl = $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage) : null;

        return back()
            ->with('status', 'Pesan Anda berhasil dikirim. Tim kami akan segera merespons.')
            ->with('waUrl', $waUrl);
    }

    private function normalizeDigits(string $value): string
    {
        return preg_replace('/\D+/', '', $value) ?? '';
    }

    private function toWhatsappNumber(?string $phone): ?string
    {
        if (! $phone) {
            return null;
        }

        $digits = $this->normalizeDigits($phone);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return $digits ?: null;
    }
}