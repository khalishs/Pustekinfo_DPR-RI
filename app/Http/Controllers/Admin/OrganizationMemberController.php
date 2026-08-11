<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use App\Models\Media;
use Illuminate\Http\Request;

class OrganizationMemberController extends Controller
{
    public function index()
    {
        return view('admin.organization-members.index', [
            'members' => OrganizationMember::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.organization-members.form', ['member' => new OrganizationMember()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = Media::storeUpload($request->file('photo'));
        }

        OrganizationMember::create($data);

        return redirect()->route('admin.organization-members.index')->with('success', 'Anggota organisasi ditambahkan.');
    }

    public function edit(OrganizationMember $organizationMember)
    {
        return view('admin.organization-members.form', ['member' => $organizationMember]);
    }

    public function update(Request $request, OrganizationMember $organizationMember)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            Media::deleteRef($organizationMember->photo);
            $data['photo'] = Media::storeUpload($request->file('photo'));
        }

        $organizationMember->update($data);

        return redirect()->route('admin.organization-members.index')->with('success', 'Anggota organisasi diperbarui.');
    }

    public function destroy(OrganizationMember $organizationMember)
    {
        Media::deleteRef($organizationMember->photo);
        $organizationMember->delete();

        return redirect()->route('admin.organization-members.index')->with('success', 'Anggota organisasi dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'position'            => 'required|string|max:255',
            'position_en'         => 'nullable|string|max:255',
            'unit_description'    => 'nullable|string',
            'unit_description_en' => 'nullable|string',
            'level'               => 'required|in:kepala,bidang',
            'sort_order'          => 'required|integer',
            'photo'               => 'nullable|image|min:2048|max:10240',
        ]);
    }
}