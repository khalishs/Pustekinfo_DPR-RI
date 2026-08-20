@extends('admin.layout')
@section('title', 'Berita')
@section('content')
<div class="page-head">
  <h2>Berita</h2>
  <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Tambah Berita</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Utama</th><th class="text-center">Aktif</th><th>Tanggal</th><th></th></tr></thead>
    <tbody>
    @forelse($newsItems as $news)
      <tr>
        <td>
          @if($news->image)
            <img src="{{ asset($news->image) }}" style="width:60px;height:45px;object-fit:cover;border-radius:6px;">
          @else
            <span style="color:#b7c2c7;font-size:12px;">Tidak ada</span>
          @endif
        </td>
        <td>{{ $news->title }}</td>
        <td><span class="badge cap">{{ $news->category }}</span></td>
        <td>{!! $news->is_featured ? '<span class="badge-success">Ya</span>' : '<span class="badge-muted">-</span>' !!}</td>
        <td class="text-center">
          <form action="{{ route('admin.news.toggle-active', $news) }}" method="POST">
            @csrf @method('PATCH')
            <label class="toggle-switch" title="{{ $news->is_active ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan' }}">
              <input type="checkbox" onchange="this.form.requestSubmit()" {{ $news->is_active ? 'checked' : '' }}>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td>{{ $news->published_at?->format('d M Y') }}</td>
        <td class="row-actions">
          <a href="{{ route('admin.news.edit', $news) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.news.destroy', $news) }}" method="POST" data-confirm="Hapus berita ini?">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7">Belum ada berita.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection