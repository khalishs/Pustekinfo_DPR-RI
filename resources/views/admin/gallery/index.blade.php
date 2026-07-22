@extends('admin.layout')
@section('title', 'Galeri Kegiatan')
@section('content')
<div class="page-head">
  <h2>Galeri Kegiatan</h2>
  <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Tambah Foto</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>Foto</th><th>Judul</th><th>Kategori</th><th>Ukuran</th><th>Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($items as $item)
      <tr>
        <td><img src="{{ asset('storage/'.$item->image) }}" style="width:70px;height:52px;object-fit:cover;border-radius:6px;"></td>
        <td>{{ $item->title ?? '-' }}</td>
        <td>{{ $item->category->name ?? '-' }}</td>
        <td style="text-transform:capitalize;">{{ $item->size }}</td>
        <td>{{ $item->sort_order }}</td>
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
@endsection