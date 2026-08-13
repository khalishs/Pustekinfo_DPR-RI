<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\SiteSetting;
use App\Support\NormalizesPhoneNumbers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    use NormalizesPhoneNumbers;

    // Sementara, dipakai kalau nomor WA belum diisi lewat Pengaturan Kontak di admin.
    private const FALLBACK_WA_NUMBER = '08159646281';

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Service::where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
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

        $serviceRequest = ServiceRequest::create($data)->refresh();

        $setting = SiteSetting::first() ?? new SiteSetting();
        $waNumber = $this->toWhatsappNumber($setting->phone) ?? $this->toWhatsappNumber(self::FALLBACK_WA_NUMBER);
        $waMessage = $this->buildWaMessage($serviceRequest);

        return response()->json([
            'data' => [
                'kode'   => $serviceRequest->kode,
                'status' => $serviceRequest->status,
                'wa_url' => $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage) : null,
            ],
        ], 201);
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

    public function status(Request $request): JsonResponse
    {
        $data = $request->validate([
            'kode' => 'required|string|max:30',
        ]);

        return response()->json([
            'data' => ServiceRequest::where('kode', strtoupper(trim($data['kode'])))
                ->first(['kode', 'nama', 'jenis_layanan', 'status', 'catatan_admin', 'created_at']),
        ]);
    }
}
