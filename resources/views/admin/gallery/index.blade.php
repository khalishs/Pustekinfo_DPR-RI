@extends('admin.layout')
@section('title', 'Galeri Kegiatan')
@section('content')
<div class="page-head">
  <h2>Galeri Kegiatan</h2>
  <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Tambah Foto</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Foto</th><th>Judul</th><th>Kategori</th><th>Ukuran</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($items as $item)
      <tr>
        <td><img src="{{ asset('storage/'.$item->image) }}" style="width:70px;height:52px;object-fit:cover;border-radius:6px;"></td>
        <td>{{ $item->title ?? '-' }}</td>
        <td>{{ $item->category->name ?? '-' }}</td>
        <td><span class="badge cap">{{ $item->size }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $item->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada foto galeri.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection