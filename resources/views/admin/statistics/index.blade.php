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
    <thead><tr><th>Ikon</th><th>Label</th><th>Nilai</th><th class="text-center">Urutan</th><th class="text-center">Aktif</th><th></th></tr></thead>
    <tbody>
    @forelse($statistics as $stat)
      <tr>
        <td><svg viewBox="0 0 24 24" style="width:24px;height:24px;stroke:var(--teal);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;">{!! $stat->icon_svg !!}</svg></td>
        <td class="cap">{{ $stat->label }}</td>
        <td><strong style="color:var(--teal);">{{ rtrim(rtrim(number_format($stat->value, $stat->decimals, ',', '.'), '0'), ',') }}{{ $stat->suffix }}</strong></td>
        <td class="text-center"><span class="badge-count">{{ $stat->sort_order }}</span></td>
        <td class="text-center">
          <form action="{{ route('admin.statistics.toggle-active', $stat) }}" method="POST">
            @csrf @method('PATCH')
            <label class="toggle-switch" title="{{ $stat->is_active ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan' }}">
              <input type="checkbox" onchange="this.form.requestSubmit()" {{ $stat->is_active ? 'checked' : '' }}>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="row-actions">
          <a href="{{ route('admin.statistics.edit', $stat) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          @if($statistics->count() < $maxStats)
            <form action="{{ route('admin.statistics.duplicate', $stat) }}" method="POST">
              @csrf
              <button class="btn-icon btn-icon-copy" title="Salin" aria-label="Salin">
                <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              </button>
            </form>
          @endif
          <form action="{{ route('admin.statistics.destroy', $stat) }}" method="POST" data-confirm="Hapus statistik ini?">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada data.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection