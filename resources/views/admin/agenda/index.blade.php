@extends('admin.layout')
@section('title', 'Agenda Kegiatan')
@section('content')
<div class="page-head">
  <h2>Agenda Kegiatan</h2>
  <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary">+ Tambah Agenda</a>
</div>

@php
  $colorMap = ['c1'=>'#e0a340','c2'=>'#b0413e','c3'=>'#1f9d7c','c4'=>'#3d7dd6','c5'=>'#8e5fc9'];
@endphp

<div class="page-head">
  <h2 style="font-size:15px;">Mendatang &amp; Hari Ini</h2>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Judul</th><th>Tanggal</th><th>Jam</th><th>Lokasi</th><th>Warna</th><th></th></tr></thead>
    <tbody>
    @forelse($upcomingEvents as $event)
      <tr>
        <td>{{ $event->title }}</td>
        <td>{{ $event->event_date->format('d M Y') }}</td>
        <td>{{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('H:i') : '-' }}</td>
        <td>{{ $event->location ?? '-' }}</td>
        <td>
          <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:{{ $colorMap[$event->color_tag] ?? '#e0a340' }};"></span>
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
      <tr><td colspan="6">Belum ada agenda mendatang.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>

<div class="page-head" style="margin-top:28px;">
  <h2 style="font-size:15px;">Riwayat</h2>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Judul</th><th>Tanggal</th><th>Jam</th><th>Lokasi</th><th>Warna</th><th></th></tr></thead>
    <tbody>
    @forelse($pastEvents as $event)
      <tr>
        <td>{{ $event->title }}</td>
        <td>{{ $event->event_date->format('d M Y') }}</td>
        <td>{{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('H:i') : '-' }}</td>
        <td>{{ $event->location ?? '-' }}</td>
        <td>
          <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:{{ $colorMap[$event->color_tag] ?? '#e0a340' }};"></span>
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
      <tr><td colspan="6">Belum ada riwayat agenda.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
