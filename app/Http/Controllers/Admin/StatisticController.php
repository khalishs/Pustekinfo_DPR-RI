<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        return view('admin.statistics.index', [
            'statistics' => Statistic::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.statistics.form', ['statistic' => new Statistic()]);
    }

    public function store(Request $request)
    {
        Statistic::create($this->validated($request));

        return redirect()->route('admin.statistics.index')->with('success', 'Statistik ditambahkan.');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.form', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $statistic->update($this->validated($request));

        return redirect()->route('admin.statistics.index')->with('success', 'Statistik diperbarui.');
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')->with('success', 'Statistik dihapus.');
    }
private function validated(Request $request): array
{
    return $request->validate([
        'key'        => 'required|in:apps,karyawan,pengguna,spbe',
        'label'      => 'required|string|max:255',
        'value'      => 'required|numeric',
        'suffix'     => 'nullable|string|max:10',
        'decimals'   => 'required|integer|min:0|max:2',
        'sort_order' => 'required|integer',
    ]);
}
}