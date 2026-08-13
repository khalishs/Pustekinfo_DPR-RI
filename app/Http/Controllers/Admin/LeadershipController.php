<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leadership;
use App\Models\Media;
use Illuminate\Http\Request;

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
        'name'              => 'nullable|string|max:255',
        'show_name'         => 'sometimes|boolean',
        'position'          => 'required|string|max:255',
        'welcome_title'     => 'required|string|max:255',
        'welcome_title_en'  => 'nullable|string|max:255',
        'description'       => 'required|string',
        'description_en'    => 'nullable|string',
        'signature_role'    => 'required|string|max:255',
        'signature_role_en' => 'nullable|string|max:255',
        'education'         => 'nullable|string|max:255',
        'education_en'      => 'nullable|string|max:255',
        'term'              => 'nullable|string|max:255',
        'term_en'           => 'nullable|string|max:255',
        'expertise'         => 'nullable|string|max:255',
        'expertise_en'      => 'nullable|string|max:255',
        'email'             => 'nullable|email|max:255',
        'photo'             => 'nullable|image|min:2048|max:10240',
    ]);

    $data['show_name'] = $request->boolean('show_name');

    $leadership = Leadership::first() ?? new Leadership();

    if ($request->hasFile('photo')) {
        Media::deleteRef($leadership->photo);
        $data['photo'] = Media::storeUpload($request->file('photo'));
    }

    $leadership->fill($data)->save();

    return redirect()->route('admin.leadership.edit')->with('success', 'Sambutan pimpinan diperbarui.');
    }
}