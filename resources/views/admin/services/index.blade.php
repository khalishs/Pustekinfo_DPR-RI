{{-- resources/views/admin/services/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Layanan')
@section('content')
<div class="page-head">
  <h2>Kartu Layanan</h2>
  <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Tambah Layanan</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Judul</th><th>Ringkasan</th><th class="text-center">Jml. Fitur</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($services as $service)
      <tr>
        <td>{{ $service->title }}</td>
        <td>{{ \Illuminate\Support\Str::limit($service->description, 70) }}</td>
        <td class="text-center"><span class="badge-count">{{ count($service->features) }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $service->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5">Belum ada layanan.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
