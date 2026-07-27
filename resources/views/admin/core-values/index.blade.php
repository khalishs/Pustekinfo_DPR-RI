{{-- resources/views/admin/core-values/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Nilai Organisasi')
@section('content')
<div class="page-head">
  <h2>Nilai Organisasi (Core Values)</h2>
  <a href="{{ route('admin.core-values.create') }}" class="btn btn-primary">+ Tambah Nilai</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Judul</th><th>Ikon</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($values as $v)
      <tr>
        <td>{{ $v->title }}</td>
        <td><span class="badge">{{ $v->icon }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $v->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.core-values.edit', $v) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.core-values.destroy', $v) }}" method="POST" onsubmit="return confirm('Hapus nilai ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="4">Belum ada data.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection