<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\SiteSetting;
use App\Models\PageBanner;
use Illuminate\Http\Request;
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
            'icon'        => $service->icon_image,
        ])->all();

        return view('layanan', [
            'services'   => $services,
            'setting'    => SiteSetting::first() ?? new SiteSetting(),
            'pageBanner' => PageBanner::where('page', 'layanan')->first(),
        ]);
    }

    public function ajukan(Request $request)
    {
        return view('layanan-ajukan', [
            'setting'      => SiteSetting::first() ?? new SiteSetting(),
            'pageBanner'   => PageBanner::where('page', 'layanan')->first(),
            'jenisOptions' => Service::orderBy('sort_order')->pluck('title'),
            'jenisSelected' => $request->query('jenis'),
        ]);
    }

    public function ajukanStore(Request $request)
    {
        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'no_tlpn'       => 'required|string|max:30',
            'instansi'      => 'nullable|string|max:255',
            'jenis_layanan' => 'required|string|max:255',
            'pesan'         => 'required|string',
        ]);

        $data['no_tlpn'] = $this->toWhatsappNumber($data['no_tlpn']) ?? $this->normalizeDigits($data['no_tlpn']);
        $data['kode'] = 'LYN-' . strtoupper(Str::random(8));

        $serviceRequest = ServiceRequest::create($data);

        $setting = SiteSetting::first() ?? new SiteSetting();
        $waNumber = $this->toWhatsappNumber($setting->phone);
        $waMessage = "Halo, saya ingin mengajukan layanan.\n\n"
            . "Kode Pengajuan: {$serviceRequest->kode}\n"
            . "Nama: {$serviceRequest->nama}\n"
            . "Jenis Layanan: {$serviceRequest->jenis_layanan}\n"
            . "Pesan: {$serviceRequest->pesan}";
        $waUrl = $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage) : null;

        return view('layanan-ajukan', [
            'setting'      => $setting,
            'pageBanner'   => PageBanner::where('page', 'layanan')->first(),
            'jenisOptions' => Service::orderBy('sort_order')->pluck('title'),
            'jenisSelected' => null,
            'submitted'    => $serviceRequest,
            'waUrl'        => $waUrl,
        ]);
    }

    public function status()
    {
        return view('layanan-status', [
            'setting'    => SiteSetting::first() ?? new SiteSetting(),
            'pageBanner' => PageBanner::where('page', 'layanan')->first(),
            'results'    => null,
            'searched'   => false,
        ]);
    }

    public function statusCheck(Request $request)
    {
        $data = $request->validate([
            'no_tlpn' => 'required|string|max:30',
        ]);

        $noTlpn = $this->toWhatsappNumber($data['no_tlpn']) ?? $this->normalizeDigits($data['no_tlpn']);

        return view('layanan-status', [
            'setting'    => SiteSetting::first() ?? new SiteSetting(),
            'pageBanner' => PageBanner::where('page', 'layanan')->first(),
            'results'    => ServiceRequest::where('no_tlpn', $noTlpn)->latest()->get(),
            'searched'   => true,
        ]);
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
