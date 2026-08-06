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
    <thead><tr><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Level</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($members as $m)
      <tr>
        <td>
          @if($m->photo)
            <img src="{{ asset('storage/'.$m->photo) }}" style="width:44px;height:44px;object-fit:cover;border-radius:50%;">
          @else
            <span style="color:#b7c2c7;font-size:12px;">Belum ada</span>
          @endif
        </td>
        <td>{{ $m->name }}</td>
        <td>{{ $m->position }}</td>
        <td><span class="badge">{{ ['kepala'=>'Kepala','sekretariat'=>'Sekretariat','bidang'=>'Bidang'][$m->level] }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $m->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.organization-members.edit', $m) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.organization-members.destroy', $m) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada data struktur organisasi.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection