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
        CoreValue::create($this->validated($request));

        return redirect()->route('admin.core-values.index')->with('success', 'Nilai organisasi ditambahkan.');
    }

    public function edit(CoreValue $coreValue)
    {
        return view('admin.core-values.form', ['value' => $coreValue]);
    }

    public function update(Request $request, CoreValue $coreValue)
    {
        $coreValue->update($this->validated($request));

        return redirect()->route('admin.core-values.index')->with('success', 'Nilai organisasi diperbarui.');
    }

    public function destroy(CoreValue $coreValue)
    {
        $coreValue->delete();

        return redirect()->route('admin.core-values.index')->with('success', 'Nilai organisasi dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:100',
            'description' => 'required|string',
            'icon'        => 'required|in:integrity,innovative,professional,collaborative,service,accountable',
            'sort_order'  => 'required|integer',
        ]);
    }
}