<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\SiteSetting;
use App\Models\StelaVideo;
use App\Models\PageBanner;
use App\Support\NormalizesPhoneNumbers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    use NormalizesPhoneNumbers;

    // Sementara, dipakai kalau nomor WA belum diisi lewat Pengaturan Kontak di admin.
    private const FALLBACK_WA_NUMBER = '08159646281';

    // Form Ajukan Layanan cuma menerima pengajuan untuk jenis ini.
    private const JENIS_LAYANAN_OPTIONS = ['Helpdesk & Aduan'];

    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get()->map(fn (Service $service) => [
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
            'stelaVideo'   => StelaVideo::first(),
            'pageBanner'   => PageBanner::where('page', 'layanan')->first(),
            'jenisOptions' => self::JENIS_LAYANAN_OPTIONS,
            'jenisSelected' => $request->query('jenis'),
        ]);
    }

    public function ajukanStore(Request $request)
    {
        $data = $request->validate([
            'nama'          => ['required', 'string', 'max:255', 'regex:/^[A-Za-z\s]+$/'],
            'email'         => 'required|email|max:255',
            'no_tlpn'       => ['required', 'string', 'max:20', function ($attribute, $value, $fail) {
                $digits = $this->normalizeDigits($value);
                if (! preg_match('/^(62|0)8[0-9]{8,12}$/', $digits)) {
                    $fail('Nomor WhatsApp/Telepon tidak valid. Gunakan format 08xxxxxxxxxx.');
                }
            }],
            'instansi'      => 'nullable|string|max:255',
            'jenis_layanan' => 'required|string|max:255',
            'pesan'         => 'required|string|min:10',
        ], [
            'nama.regex' => 'Nama hanya boleh berisi huruf.',
            'pesan.min'  => 'Mohon jelaskan kebutuhan layanan Anda lebih rinci (minimal 10 karakter).',
        ]);

        $data['no_tlpn'] = $this->toWhatsappNumber($data['no_tlpn']) ?? $this->normalizeDigits($data['no_tlpn']);
        $data['kode'] = 'LYN-' . strtoupper(Str::random(8));

        $serviceRequest = ServiceRequest::create($data);

        $setting = SiteSetting::first() ?? new SiteSetting();
        $waNumber = $this->toWhatsappNumber($setting->phone) ?? $this->toWhatsappNumber(self::FALLBACK_WA_NUMBER);
        $waMessage = $this->buildWaMessage($serviceRequest);
        $waUrl = $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage) : null;

        return view('layanan-ajukan', [
            'setting'      => $setting,
            'stelaVideo'   => StelaVideo::first(),
            'pageBanner'   => PageBanner::where('page', 'layanan')->first(),
            'jenisOptions' => self::JENIS_LAYANAN_OPTIONS,
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

    private function buildWaMessage(ServiceRequest $serviceRequest): string
    {
        $lines = [
            "Halo Admin Pustekinfo DPR RI 👋",
            "",
            "Saya ingin mengajukan layanan dengan detail berikut:",
            "",
            "🎫 *Kode Pengajuan:* {$serviceRequest->kode}",
            "👤 *Nama:* {$serviceRequest->nama}",
            "📧 *Email:* {$serviceRequest->email}",
            "📱 *No. HP/WA:* +{$serviceRequest->no_tlpn}",
        ];

        if (! empty($serviceRequest->instansi)) {
            $lines[] = "🏢 *Unit Kerja/Instansi:* {$serviceRequest->instansi}";
        }

        $lines[] = "🗂️ *Jenis Layanan:* {$serviceRequest->jenis_layanan}";
        $lines[] = "";
        $lines[] = "📝 *Detail Kebutuhan:*";
        $lines[] = $serviceRequest->pesan;
        $lines[] = "";
        $lines[] = "Mohon bantuannya untuk diproses. Terima kasih. 🙏";

        return implode("\n", $lines);
    }

    public function statusCheck(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|string|max:30',
        ]);

        return view('layanan-status', [
            'setting'    => SiteSetting::first() ?? new SiteSetting(),
            'pageBanner' => PageBanner::where('page', 'layanan')->first(),
            'results'    => ServiceRequest::where('kode', strtoupper(trim($data['kode'])))->get(),
            'searched'   => true,
        ]);
    }
}
