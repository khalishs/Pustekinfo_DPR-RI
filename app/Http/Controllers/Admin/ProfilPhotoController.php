<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPhotoController extends Controller
{
    public function index()
    {
        return view('admin.profil-photos.index', [
            'photos' => ProfilPhoto::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.profil-photos.form', [
            'photo' => new ProfilPhoto(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $request->file('image')->store('profil', 'public');
        $data['is_active'] = $request->boolean('is_active');

        ProfilPhoto::create($data);

        return redirect()->route('admin.profil-photos.index')->with('success', 'Foto ditambahkan.');
    }

    public function edit(ProfilPhoto $profilPhoto)
    {
        return view('admin.profil-photos.form', ['photo' => $profilPhoto]);
    }

    public function update(Request $request, ProfilPhoto $profilPhoto)
    {
        $data = $this->validated($request, false);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($profilPhoto->image);
            $data['image'] = $request->file('image')->store('profil', 'public');
        }

        $profilPhoto->update($data);

        return redirect()->route('admin.profil-photos.index')->with('success', 'Foto diperbarui.');
    }

    public function destroy(ProfilPhoto $profilPhoto)
    {
        Storage::disk('public')->delete($profilPhoto->image);
        $profilPhoto->delete();

        return redirect()->route('admin.profil-photos.index')->with('success', 'Foto dihapus.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'sort_order' => 'required|integer',
            'image'      => ($imageRequired ? 'required' : 'nullable') . '|image|max:4096',
        ]);
    }
}
