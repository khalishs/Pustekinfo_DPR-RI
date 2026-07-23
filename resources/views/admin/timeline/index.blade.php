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
    <thead><tr><th>Tahun</th><th>Judul</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($items as $item)
      <tr>
        <td>{{ $item->year }}</td>
        <td>{{ $item->title }}</td>
        <td class="text-center"><span class="badge-count">{{ $item->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.timeline.edit', $item) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.timeline.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus poin ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="4">Belum ada data sejarah.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection