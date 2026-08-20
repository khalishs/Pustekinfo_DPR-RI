@extends('admin.layout')
@section('title', 'Galeri Kegiatan')
@section('content')
<div class="page-head">
  <h2>Galeri Kegiatan</h2>
  <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">+ Tambah Foto</a>
</div>
<div class="card">
  <small style="display:block;margin-bottom:14px;">Toggle <strong>Sorotan</strong> untuk memilih foto yang tampil sebagai sorotan di halaman galeri. Hanya bisa satu aktif — mengaktifkan salah satu otomatis menonaktifkan yang lain.</small>
  <div class="table-responsive">
  <table>
    <thead><tr><th>Foto</th><th>Judul</th><th>Kategori</th><th>Ukuran</th><th>Home</th><th class="text-center">Sorotan</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($items as $item)
      <tr>
        <td><img src="{{ asset($item->image) }}" style="width:70px;height:52px;object-fit:cover;border-radius:6px;"></td>
        <td>{{ $item->title ?? '-' }}</td>
        <td>{{ $item->category->name ?? '-' }}</td>
        <td><span class="badge cap">{{ $item->size }}</span></td>
        <td>@if($item->show_on_home)<span class="badge-success">Ya</span>@else<span class="badge-muted">Tidak</span>@endif</td>
        <td class="text-center">
          <form action="{{ route('admin.gallery.toggle-featured', $item) }}" method="POST">
            @csrf @method('PATCH')
            <label class="toggle-switch" title="{{ $item->is_featured ? 'Sorotan aktif — klik untuk nonaktifkan' : 'Jadikan sorotan' }}">
              <input type="checkbox" onchange="this.form.requestSubmit()" {{ $item->is_featured ? 'checked' : '' }}>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="text-center"><span class="badge-count">{{ $item->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.gallery.edit', $item) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" data-confirm="Hapus foto ini?">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="8">Belum ada foto galeri.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection