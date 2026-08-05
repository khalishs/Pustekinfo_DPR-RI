<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function settings(): JsonResponse
    {
        return response()->json([
            'data' => SiteSetting::first() ?? new SiteSetting(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'instansi' => 'nullable|string|max:255',
            'kategori' => 'required|string',
            'pesan'    => 'required|string',
        ]);

        $message = ContactMessage::create($data);

        return response()->json([
            'data' => ['id' => $message->id],
            'message' => 'Pesan Anda berhasil dikirim. Tim kami akan segera merespons.',
        ], 201);
    }
}
