@extends('admin.layout')
@section('title', 'Statistik')
@section('content')
<div class="page-head">
  <h2>Statistik</h2>
  @if(!$maxReached)
    <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary">+ Tambah Statistik</a>
  @endif
</div>
@if($maxReached)
  <p style="margin:-8px 0 16px;font-size:12.5px;color:#8a97a0;font-weight:600;">Maksimal 5 data statistik sudah tercapai. Hapus salah satu untuk menambah yang baru.</p>
@endif
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Label</th><th>Nilai</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($statistics as $stat)
      <tr>
        <td class="cap">{{ $stat->label }}</td>
        <td><strong style="color:var(--teal);">{{ rtrim(rtrim(number_format($stat->value, $stat->decimals, ',', '.'), '0'), ',') }}{{ $stat->suffix }}</strong></td>
        <td class="text-center"><span class="badge-count">{{ $stat->sort_order }}</span></td>
        <td class="row-actions">
          <a href="{{ route('admin.statistics.edit', $stat) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.statistics.destroy', $stat) }}" method="POST" onsubmit="return confirm('Hapus statistik ini?')">
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