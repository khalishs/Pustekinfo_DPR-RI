{{-- resources/views/admin/timeline/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Sejarah Instansi')
@section('content')
<div class="page-head">
  <h2>Sejarah Instansi (Timeline)</h2>
  <a href="{{ route('admin.timeline.create') }}" class="btn btn-primary">+ Tambah Poin</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Tahun</th><th>Judul</th><th class="text-center">Urutan</th><th class="text-center">Aktif</th><th></th></tr></thead>
    <tbody>
    @forelse($items as $item)
      <tr>
        <td>{{ $item->year }}</td>
        <td>{{ $item->title }}</td>
        <td class="text-center"><span class="badge-count">{{ $item->sort_order }}</span></td>
        <td class="text-center">
          <form action="{{ route('admin.timeline.toggle-active', $item) }}" method="POST">
            @csrf @method('PATCH')
            <label class="toggle-switch" title="{{ $item->is_active ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan' }}">
              <input type="checkbox" onchange="this.form.submit()" {{ $item->is_active ? 'checked' : '' }}>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="row-actions">
          <a href="{{ route('admin.timeline.edit', $item) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.timeline.duplicate', $item) }}" method="POST">
            @csrf
            <button class="btn-icon btn-icon-copy" title="Salin" aria-label="Salin">
              <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            </button>
          </form>
          <form action="{{ route('admin.timeline.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus poin ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5">Belum ada data sejarah.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection