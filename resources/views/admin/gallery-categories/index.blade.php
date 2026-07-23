{{-- resources/views/admin/gallery-categories/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Kategori Galeri')
@section('content')
<div class="page-head">
  <h2>Kategori Galeri</h2>
  <a href="{{ route('admin.gallery-categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
</div>
@if(session('error'))
  <div class="flash" style="background:#fdecea;color:#b0413e;">{{ session('error') }}</div>
@endif
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Nama</th><th>Slug</th><th>Jumlah Foto</th><th>Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($categories as $cat)
      <tr>
        <td>{{ $cat->name }}</td>
        <td><span class="badge">{{ $cat->slug }}</span></td>
        <td>{{ $cat->items_count }}</td>
        <td>{{ $cat->sort_order }}</td>
        <td class="row-actions">
          <a href="{{ route('admin.gallery-categories.edit', $cat) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.gallery-categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5">Belum ada kategori.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection