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
        AgendaEvent::create($this->validated($request));

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda ditambahkan.');
    }

    public function edit(AgendaEvent $agendum)
    {
        return view('admin.agenda.form', ['event' => $agendum]);
    }

    public function update(Request $request, AgendaEvent $agendum)
    {
        $agendum->update($this->validated($request));

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda diperbarui.');
    }

    public function destroy(AgendaEvent $agendum)
    {
        $agendum->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|date',
            'event_time'  => 'nullable|date_format:H:i',
            'location'    => 'nullable|string|max:255',
            'color_tag'   => 'required|in:c1,c2,c3',
        ]);
    }
}