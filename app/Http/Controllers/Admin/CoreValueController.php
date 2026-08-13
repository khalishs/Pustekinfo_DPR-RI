<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use Illuminate\Http\Request;

class CoreValueController extends Controller
{
    public function index()
    {
        return view('admin.core-values.index', [
            'values' => CoreValue::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.core-values.form', ['value' => new CoreValue()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        CoreValue::create($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Nilai organisasi ditambahkan.');
    }

    public function edit(CoreValue $coreValue)
    {
        return view('admin.core-values.form', ['value' => $coreValue]);
    }

    public function update(Request $request, CoreValue $coreValue)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $coreValue->update($data);

        return redirect()->route('admin.core-values.index')->with('success', 'Nilai organisasi diperbarui.');
    }

    public function toggleActive(CoreValue $coreValue)
    {
        $newState = ! $coreValue->is_active;
        $coreValue->update(['is_active' => $newState]);

        return redirect()->route('admin.core-values.index')->with(
            'success',
            $newState ? 'Nilai organisasi diaktifkan kembali dan akan tampil ke pengguna.' : 'Nilai organisasi dinonaktifkan dan tidak akan tampil ke pengguna.'
        );
    }

    public function duplicate(CoreValue $coreValue)
    {
        $copy = $coreValue->replicate();
        $copy->title = $coreValue->title . ' (Salinan)';
        $copy->is_active = false;
        $copy->save();

        return redirect()->route('admin.core-values.edit', $copy)->with('success', 'Nilai organisasi berhasil disalin. Silakan sesuaikan datanya lalu aktifkan.');
    }

    public function destroy(CoreValue $coreValue)
    {
        $coreValue->delete();

        return redirect()->route('admin.core-values.index')->with('success', 'Nilai organisasi dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'          => 'required|string|max:100',
            'title_en'       => 'nullable|string|max:100',
            'description'    => 'required|string',
            'description_en' => 'nullable|string',
            'icon'           => 'required|in:integrity,innovative,professional,collaborative,service,accountable',
            'sort_order'     => 'required|integer',
            'is_active'      => 'sometimes|boolean',
        ]);
    }
}