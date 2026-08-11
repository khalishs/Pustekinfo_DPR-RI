{{-- resources/views/admin/hero-slides/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Hero Slider')
@section('content')
<div class="page-head">
  <h2>Hero Slider</h2>
  <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary">+ Tambah Slide</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Gambar</th><th>Judul</th><th>Subjudul</th><th class="text-center">Urutan</th><th class="text-center">Status</th><th></th></tr></thead>
    <tbody>
    @forelse($slides as $slide)
      <tr>
        <td><img src="{{ asset($slide->image) }}" style="width:80px;height:45px;object-fit:cover;border-radius:6px;"></td>
        <td>{{ $slide->title ?: '—' }}</td>
        <td>{{ $slide->subtitle ?: '—' }}</td>
        <td class="text-center"><span class="badge-count">{{ $slide->sort_order }}</span></td>
        <td class="text-center">{!! $slide->is_active ? '<span class="badge-success">Aktif</span>' : '<span class="badge-muted">Nonaktif</span>' !!}</td>
        <td class="row-actions">
          <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" onsubmit="return confirm('Hapus slide ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada slide.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
