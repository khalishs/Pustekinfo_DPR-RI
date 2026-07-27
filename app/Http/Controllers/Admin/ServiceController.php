<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index', [
            'services' => Service::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.services.form', [
            'service' => new Service(),
        ]);
    }

    public function store(Request $request)
    {
        Service::create($this->validated($request));

        return redirect()->route('admin.services.index')->with('success', 'Layanan ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($this->validated($request));

        return redirect()->route('admin.services.index')->with('success', 'Layanan diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'features'    => 'nullable|string',
            'icon_svg'    => 'required|string',
            'cta_text'    => 'required|string|max:255',
            'sort_order'  => 'required|integer',
        ]);

        $data['features'] = collect(preg_split('/\r\n|\r|\n/', (string) $data['features']))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        return $data;
    }
}
