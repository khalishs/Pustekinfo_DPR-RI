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
          <a href="{{ route('admin.profil-photos.edit', $photo) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.profil-photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
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
