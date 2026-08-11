{{-- resources/views/admin/organization-members/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Struktur Organisasi')
@section('content')
<div class="page-head">
  <h2>Struktur Organisasi</h2>
  <a href="{{ route('admin.organization-members.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Foto</th><th>Jabatan</th><th>Level</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($members as $m)
      <tr>
        <td>
          @if($m->photo)
            <img src="{{ asset($m->photo) }}" style="width:44px;height:44px;object-fit:cover;border-radius:50%;">
          @else
            <span style="color:#b7c2c7;font-size:12px;">Belum ada</span>
          @endif
        </td>
        <td>{{ $m->position }}</td>
        <td><span class="badge">{{ ['kepala'=>'Kepala','bidang'=>'Bidang'][$m->level] }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $m->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.organization-members.edit', $m) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.organization-members.destroy', $m) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5">Belum ada data struktur organisasi.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection