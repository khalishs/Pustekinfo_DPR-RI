{{-- resources/views/admin/profil-photos/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Foto Profil Singkat')
@section('content')
<div class="page-head">
  <h2>Foto Profil Singkat</h2>
  <a href="{{ route('admin.profil-photos.create') }}" class="btn btn-primary">+ Tambah Foto</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Gambar</th><th class="text-center">Urutan</th><th class="text-center">Status</th><th></th></tr></thead>
    <tbody>
    @forelse($photos as $photo)
      <tr>
        <td><img src="{{ asset('storage/'.$photo->image) }}" style="width:80px;height:80px;object-fit:cover;border-radius:6px;"></td>
        <td class="text-center"><span class="badge-count">{{ $photo->sort_order }}</span></td>
        <td class="text-center">{!! $photo->is_active ? '<span class="badge-success">Aktif</span>' : '<span class="badge-muted">Nonaktif</span>' !!}</td>
        <td class="row-actions">
          <a href="{{ route('admin.profil-photos.edit', $photo) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.profil-photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="4">Belum ada foto.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
