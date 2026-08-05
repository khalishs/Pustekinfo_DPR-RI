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
            'data' => Service::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
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

        $serviceRequest = ServiceRequest::create($data)->refresh();

        $setting = SiteSetting::first() ?? new SiteSetting();
        $waNumber = $this->toWhatsappNumber($setting->phone) ?? $this->toWhatsappNumber(self::FALLBACK_WA_NUMBER);
        $waMessage = "Halo, saya ingin mengajukan layanan.\n\n"
            . "Kode Pengajuan: {$serviceRequest->kode}\n"
            . "Nama: {$serviceRequest->nama}\n"
            . "Jenis Layanan: {$serviceRequest->jenis_layanan}\n"
            . "Pesan: {$serviceRequest->pesan}";

        return response()->json([
            'data' => [
                'kode'   => $serviceRequest->kode,
                'status' => $serviceRequest->status,
                'wa_url' => $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waMessage) : null,
            ],
        ], 201);
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
