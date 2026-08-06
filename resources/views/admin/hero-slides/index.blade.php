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
        <td><img src="{{ asset('storage/'.$slide->image) }}" style="width:80px;height:45px;object-fit:cover;border-radius:6px;"></td>
        <td>{{ $slide->title ?: '—' }}</td>
        <td>{{ $slide->subtitle ?: '—' }}</td>
        <td class="text-center"><span class="badge-count">{{ $slide->sort_order }}</span></td>
        <td class="text-center">{!! $slide->is_active ? '<span class="badge-success">Aktif</span>' : '<span class="badge-muted">Nonaktif</span>' !!}</td>
        <td class="row-actions">
          <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" onsubmit="return confirm('Hapus slide ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
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
