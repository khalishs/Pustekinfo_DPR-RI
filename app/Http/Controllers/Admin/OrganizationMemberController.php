<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationMember;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrganizationMemberController extends Controller
{
    const MAX_KEPALA = 1;
    const MAX_BIDANG = 4;

    public function index()
    {
        $members = OrganizationMember::orderBy('sort_order')->get();

        return view('admin.organization-members.index', [
            'members'    => $members,
            'atCapacity' => $this->kepalaCount($members) >= self::MAX_KEPALA && $this->bidangCount($members) >= self::MAX_BIDANG,
        ]);
    }

    public function create()
    {
        if ($this->kepalaCount() >= self::MAX_KEPALA && $this->bidangCount() >= self::MAX_BIDANG) {
            return redirect()->route('admin.organization-members.index')
                ->with('error', 'Struktur organisasi sudah penuh (maksimal 1 Kepala dan 4 Bidang).');
        }

        return view('admin.organization-members.form', [
            'member'      => new OrganizationMember(),
            'kepalaFull'  => $this->kepalaCount() >= self::MAX_KEPALA,
            'bidangFull'  => $this->bidangCount() >= self::MAX_BIDANG,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $this->assertLevelCapacity($data['level']);
        $data['is_active'] = $request->boolean('is_active');
        $data['show_name'] = $request->boolean('show_name');
        $data['show_photo'] = $request->boolean('show_photo');

        if ($request->hasFile('photo')) {
            $data['photo'] = Media::storeUpload($request->file('photo'));
        }

        OrganizationMember::create($data);

        return redirect()->route('admin.organization-members.index')->with('success', 'Anggota organisasi ditambahkan.');
    }

    public function edit(OrganizationMember $organizationMember)
    {
        return view('admin.organization-members.form', [
            'member'     => $organizationMember,
            'kepalaFull' => $this->kepalaCount() >= self::MAX_KEPALA && $organizationMember->level !== 'kepala',
            'bidangFull' => $this->bidangCount() >= self::MAX_BIDANG && $organizationMember->level !== 'bidang',
        ]);
    }

    public function update(Request $request, OrganizationMember $organizationMember)
    {
        $data = $this->validated($request);
        $this->assertLevelCapacity($data['level'], $organizationMember);
        $data['is_active'] = $request->boolean('is_active');
        $data['show_name'] = $request->boolean('show_name');
        $data['show_photo'] = $request->boolean('show_photo');

        if ($request->hasFile('photo')) {
            Media::deleteRef($organizationMember->photo);
            $data['photo'] = Media::storeUpload($request->file('photo'));
        }

        $organizationMember->update($data);

        return redirect()->route('admin.organization-members.index')->with('success', 'Anggota organisasi diperbarui.');
    }

    public function toggleActive(OrganizationMember $organizationMember)
    {
        $newState = ! $organizationMember->is_active;
        $organizationMember->update(['is_active' => $newState]);

        return redirect()->route('admin.organization-members.index')->with(
            'success',
            $newState ? 'Anggota diaktifkan kembali dan akan tampil ke pengguna.' : 'Anggota dinonaktifkan dan tidak akan tampil ke pengguna.'
        );
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
            'name'                => 'nullable|string|max:255',
            'show_name'           => 'sometimes|boolean',
            'position'            => 'required|string|max:255',
            'position_en'         => 'nullable|string|max:255',
            'unit_description'    => 'nullable|string',
            'unit_description_en' => 'nullable|string',
            'level'               => 'required|in:kepala,bidang',
            'sort_order'          => 'required|integer',
            'photo'               => 'nullable|image|min:2048|max:10240',
            'show_photo'          => 'sometimes|boolean',
            'is_active'           => 'sometimes|boolean',
        ]);
    }

    private function kepalaCount(?\Illuminate\Support\Collection $members = null): int
    {
        return $members ? $members->where('level', 'kepala')->count() : OrganizationMember::where('level', 'kepala')->count();
    }

    private function bidangCount(?\Illuminate\Support\Collection $members = null): int
    {
        return $members ? $members->where('level', 'bidang')->count() : OrganizationMember::where('level', 'bidang')->count();
    }

    private function assertLevelCapacity(string $level, ?OrganizationMember $excluding = null): void
    {
        $query = OrganizationMember::where('level', $level);
        if ($excluding && $excluding->exists) {
            $query->where('id', '!=', $excluding->id);
        }

        $max = $level === 'kepala' ? self::MAX_KEPALA : self::MAX_BIDANG;

        if ($query->count() >= $max) {
            $label = $level === 'kepala' ? 'Kepala' : 'Bidang';
            throw ValidationException::withMessages([
                'level' => "Jumlah anggota level {$label} sudah mencapai batas maksimal ({$max}).",
            ]);
        }
    }
}