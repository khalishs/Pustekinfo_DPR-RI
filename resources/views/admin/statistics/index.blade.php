@extends('admin.layout')
@section('title', 'Statistik')
@section('content')
<div class="page-head">
  <h2>Statistik</h2>
</div>
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