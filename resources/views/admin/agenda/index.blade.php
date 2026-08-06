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
    <thead><tr><th>Judul</th><th>Tanggal</th><th>Jam</th><th>Lokasi</th><th>Warna</th><th></th></tr></thead>
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
        <td class="row-actions">
          <a href="{{ route('admin.agenda.edit', $event) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.agenda.destroy', $event) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada agenda.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection