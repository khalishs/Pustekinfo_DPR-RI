<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $data = $this->validated($request, true);
        $data['icon_image'] = $request->file('icon_image')->store('layanan', 'public');

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('icon_image')) {
            if ($service->icon_image) {
                Storage::disk('public')->delete($service->icon_image);
            }
            $data['icon_image'] = $request->file('icon_image')->store('layanan', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->icon_image) {
            Storage::disk('public')->delete($service->icon_image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan dihapus.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description'    => 'required|string',
            'description_en' => 'nullable|string',
            'features'       => 'nullable|string',
            'features_en'    => 'nullable|string',
            'icon_image'     => ($imageRequired ? 'required' : 'nullable') . '|image|min:2048|max:10240',
            'cta_text'       => 'required|string|max:255',
            'cta_text_en'    => 'nullable|string|max:255',
            'sort_order'     => 'required|integer',
        ]);

        $data['features'] = collect(preg_split('/\r\n|\r|\n/', (string) $data['features']))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        $featuresEn = collect(preg_split('/\r\n|\r|\n/', (string) $data['features_en']))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
        $data['features_en'] = $featuresEn ?: null;

        return $data;
    }
}
