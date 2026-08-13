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
    <thead><tr><th>Nama</th><th>Slug</th><th class="text-center">Jumlah Foto</th><th class="text-center">Urutan</th><th class="text-center">Aktif</th><th></th></tr></thead>
    <tbody>
    @forelse($categories as $cat)
      <tr>
        <td>{{ $cat->name }}</td>
        <td><span class="badge">{{ $cat->slug }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $cat->items_count }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $cat->sort_order }}</span></td>
        <td class="text-center">
          <form action="{{ route('admin.gallery-categories.toggle-active', $cat) }}" method="POST">
            @csrf @method('PATCH')
            <label class="toggle-switch" title="{{ $cat->is_active ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan' }}">
              <input type="checkbox" onchange="this.form.submit()" {{ $cat->is_active ? 'checked' : '' }}>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="row-actions">
          <a href="{{ route('admin.gallery-categories.edit', $cat) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.gallery-categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada kategori.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection