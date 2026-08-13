<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgendaEvent;
use Illuminate\Http\Request;

class AgendaEventController extends Controller
{
    public function index()
    {
        return view('admin.agenda.index', [
            'events' => AgendaEvent::orderBy('event_date', 'desc')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.agenda.form', ['event' => new AgendaEvent()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        AgendaEvent::create($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda ditambahkan.');
    }

    public function edit(AgendaEvent $agendum)
    {
        return view('admin.agenda.form', ['event' => $agendum]);
    }

    public function update(Request $request, AgendaEvent $agendum)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        $agendum->update($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda diperbarui.');
    }

    public function toggleActive(AgendaEvent $agendum)
    {
        $newState = ! $agendum->is_active;
        $agendum->update(['is_active' => $newState]);

        return redirect()->route('admin.agenda.index')->with(
            'success',
            $newState ? 'Agenda diaktifkan kembali dan akan tampil ke pengguna.' : 'Agenda dinonaktifkan dan tidak akan tampil ke pengguna.'
        );
    }

    public function duplicate(AgendaEvent $agendum)
    {
        $copy = $agendum->replicate();
        $copy->title = $agendum->title . ' (Salinan)';
        $copy->is_active = false;
        $copy->save();

        return redirect()->route('admin.agenda.edit', $copy)->with('success', 'Agenda berhasil disalin. Silakan sesuaikan datanya lalu aktifkan.');
    }

    public function destroy(AgendaEvent $agendum)
    {
        $agendum->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'          => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'description_en' => 'nullable|string',
            'event_date'     => 'required|date',
            'event_time'     => 'nullable|date_format:H:i',
            'location'       => 'nullable|string|max:255',
            'color'          => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'is_active'      => 'sometimes|boolean',
        ], [
            'color.regex' => 'Warna harus berupa kode hex yang valid.',
        ]);
    }
}