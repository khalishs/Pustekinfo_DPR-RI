@extends('admin.layout')
@section('title', 'Statistik')
@section('content')
<div class="page-head">
  <h2>Statistik <span class="badge-count">{{ $statistics->count() }}/{{ $maxStats }}</span></h2>
  @if($statistics->count() < $maxStats)
    <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary">+ Tambah Statistik</a>
  @endif
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Ikon</th><th>Label</th><th>Nilai</th><th class="text-center">Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($statistics as $stat)
      <tr>
        <td><svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:var(--teal);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;">{!! $stat->icon_svg !!}</svg></td>
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
      <tr><td colspan="5">Belum ada data.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection