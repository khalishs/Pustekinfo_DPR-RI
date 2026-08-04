<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index()
    {
        return view('admin.layanan-pengajuan.index', [
            'requests' => ServiceRequest::latest()->get(),
        ]);
    }

    public function show(ServiceRequest $layananPengajuan)
    {
        return view('admin.layanan-pengajuan.show', [
            'serviceRequest' => $layananPengajuan,
        ]);
    }

    public function update(Request $request, ServiceRequest $layananPengajuan)
    {
        $data = $request->validate([
            'status'        => 'required|in:' . implode(',', array_keys(ServiceRequest::STATUSES)),
            'catatan_admin' => 'nullable|string',
        ]);

        $layananPengajuan->update($data);

        return redirect()->route('admin.layanan-pengajuan.show', $layananPengajuan)
            ->with('success', 'Status pengajuan diperbarui.');
    }

    public function destroy(ServiceRequest $layananPengajuan)
    {
        $layananPengajuan->delete();

        return redirect()->route('admin.layanan-pengajuan.index')->with('success', 'Pengajuan dihapus.');
    }
}
