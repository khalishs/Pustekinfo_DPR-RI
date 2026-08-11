<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    const MAX_STATS = 5;

    const ALLOWED_SVG_TAGS = ['path', 'rect', 'circle', 'ellipse', 'line', 'polygon', 'polyline', 'g'];

    public function index()
    {
        return view('admin.statistics.index', [
            'statistics' => Statistic::orderBy('sort_order')->get(),
            'maxStats' => self::MAX_STATS,
        ]);
    }

    public function create()
    {
        if (Statistic::count() >= self::MAX_STATS) {
            return redirect()->route('admin.statistics.index')
                ->with('error', 'Maksimal ' . self::MAX_STATS . ' statistik. Hapus salah satu dulu untuk menambah yang baru.');
        }

        return view('admin.statistics.form', ['statistic' => new Statistic()]);
    }

    public function store(Request $request)
    {
        if (Statistic::count() >= self::MAX_STATS) {
            return redirect()->route('admin.statistics.index')
                ->with('error', 'Maksimal ' . self::MAX_STATS . ' statistik. Hapus salah satu dulu untuk menambah yang baru.');
        }

        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        Statistic::create($data);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistik ditambahkan.');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.form', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $statistic->update($data);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistik diperbarui.');
    }

    public function toggleActive(Statistic $statistic)
    {
        $newState = ! $statistic->is_active;
        $statistic->update(['is_active' => $newState]);

        return redirect()->route('admin.statistics.index')->with(
            'success',
            $newState ? 'Statistik diaktifkan kembali dan akan tampil ke pengguna.' : 'Statistik dinonaktifkan dan tidak akan tampil ke pengguna.'
        );
    }

    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->route('admin.statistics.index')->with('success', 'Statistik dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'icon_svg'   => ['required', 'string', 'max:2000', function ($attribute, $value, $fail) {
                preg_match_all('/<\s*\/?\s*([a-zA-Z0-9]+)/', $value, $matches);

                foreach ($matches[1] as $tag) {
                    if (! in_array(strtolower($tag), self::ALLOWED_SVG_TAGS, true)) {
                        $fail('Tag <' . $tag . '> tidak diizinkan. Gunakan hanya: ' . implode(', ', self::ALLOWED_SVG_TAGS) . '.');
                        return;
                    }
                }

                if (preg_match('/\son\w+\s*=/i', $value) || stripos($value, 'javascript:') !== false) {
                    $fail('Kode SVG tidak boleh mengandung atribut event handler atau javascript:.');
                }
            }],
            'label'      => 'required|string|max:255',
            'label_en'   => 'nullable|string|max:255',
            'value'      => 'required|numeric',
            'suffix'     => 'nullable|string|max:10',
            'decimals'   => 'required|integer|min:0|max:2',
            'sort_order' => 'required|integer',
            'is_active'  => 'sometimes|boolean',
        ]);
    }
}
