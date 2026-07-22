<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leadership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadershipController extends Controller
{
    public function edit()
    {
        $leadership = Leadership::first() ?? new Leadership();

        return view('admin.leadership.edit', compact('leadership'));
    }

    public function update(Request $request)
{
    $data = $request->validate([
        'name'           => 'required|string|max:255',
        'position'       => 'required|string|max:255',
        'welcome_title'  => 'required|string|max:255',
        'description'    => 'required|string',
        'signature_role' => 'required|string|max:255',
        'education'      => 'nullable|string|max:255',
        'term'           => 'nullable|string|max:255',
        'expertise'      => 'nullable|string|max:255',
        'email'          => 'nullable|email|max:255',
        'photo'          => 'nullable|image|max:2048',
    ]);

    $leadership = Leadership::first() ?? new Leadership();

    if ($request->hasFile('photo')) {
        if ($leadership->photo) {
            Storage::disk('public')->delete($leadership->photo);
        }
        $data['photo'] = $request->file('photo')->store('sambutan', 'public');
    }

    $leadership->fill($data)->save();

    return redirect()->route('admin.leadership.edit')->with('success', 'Sambutan pimpinan diperbarui.');
    }
}