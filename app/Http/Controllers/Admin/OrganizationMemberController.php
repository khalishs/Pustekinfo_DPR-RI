<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $data['photo'] = $request->file('photo')->store('organisasi', 'public');
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
            if ($organizationMember->photo) {
                Storage::disk('public')->delete($organizationMember->photo);
            }
            $data['photo'] = $request->file('photo')->store('organisasi', 'public');
        }

        $organizationMember->update($data);

        return redirect()->route('admin.organization-members.index')->with('success', 'Anggota organisasi diperbarui.');
    }

    public function destroy(OrganizationMember $organizationMember)
    {
        if ($organizationMember->photo) {
            Storage::disk('public')->delete($organizationMember->photo);
        }
        $organizationMember->delete();

        return redirect()->route('admin.organization-members.index')->with('success', 'Anggota organisasi dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name'             => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'unit_description' => 'nullable|string',
            'level'            => 'required|in:kepala,sekretariat,bidang',
            'sort_order'       => 'required|integer',
            'photo'            => 'nullable|image|max:2048',
        ]);
    }
}