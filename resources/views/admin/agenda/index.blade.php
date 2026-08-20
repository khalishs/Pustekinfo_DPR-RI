@extends('admin.layout')
@section('title', 'Agenda Kegiatan')
@section('content')
<div class="page-head">
  <h2>Agenda Kegiatan</h2>
  <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary">+ Tambah Agenda</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Judul</th><th>Tanggal</th><th>Jam</th><th>Lokasi</th><th>Warna</th><th class="text-center">Aktif</th><th></th></tr></thead>
    <tbody>
    @forelse($events as $event)
      <tr>
        <td>{{ $event->title }}</td>
        <td>{{ $event->event_date->format('d M Y') }}</td>
        <td>{{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('H:i') : '-' }}</td>
        <td>{{ $event->location ?? '-' }}</td>
        <td>
          <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:{{ $event->color }};border:1px solid rgba(0,0,0,.1);vertical-align:middle;"></span>
          <span style="font-family:monospace;font-size:12px;color:#7a8a92;">{{ $event->color }}</span>
        </td>
        <td class="text-center">
          <form action="{{ route('admin.agenda.toggle-active', $event) }}" method="POST">
            @csrf @method('PATCH')
            <label class="toggle-switch" title="{{ $event->is_active ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan' }}">
              <input type="checkbox" onchange="this.form.requestSubmit()" {{ $event->is_active ? 'checked' : '' }}>
              <span class="slider"></span>
            </label>
          </form>
        </td>
        <td class="row-actions">
          <a href="{{ route('admin.agenda.edit', $event) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.agenda.duplicate', $event) }}" method="POST">
            @csrf
            <button class="btn-icon btn-icon-copy" title="Salin" aria-label="Salin">
              <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            </button>
          </form>
          <form action="{{ route('admin.agenda.destroy', $event) }}" method="POST" data-confirm="Hapus agenda ini?">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7">Belum ada agenda.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection