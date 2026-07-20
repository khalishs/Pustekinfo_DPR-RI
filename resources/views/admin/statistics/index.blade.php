@extends('admin.layout')
@section('title', 'Statistik')
@section('content')
<div class="page-head">
  <h2>Statistik</h2>
  <a href="{{ route('admin.statistics.create') }}" class="btn btn-primary">+ Tambah</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>Label</th><th>Nilai</th><th>Urutan</th><th></th></tr></thead>
    <tbody>
    @forelse($statistics as $stat)
      <tr>
        <td>{{ $stat->label }}</td>
        <td>{{ rtrim(rtrim(number_format($stat->value, $stat->decimals, ',', '.'), '0'), ',') }}{{ $stat->suffix }}</td>
        <td>{{ $stat->sort_order }}</td>
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
@endsection