@extends('admin.layout')
@section('title', $event->exists ? 'Edit Agenda' : 'Tambah Agenda')
@section('content')
<div class="card">
  <form action="{{ $event->exists ? route('admin.agenda.update', $event) : route('admin.agenda.store') }}" method="POST">
    @csrf
    @if($event->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Judul Kegiatan</label>
      <input type="text" name="title" value="{{ old('title', $event->title) }}" required>
      @error('title')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Deskripsi (opsional)</label>
      <textarea name="description">{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="event_date" value="{{ old('event_date', $event->event_date?->format('Y-m-d')) }}" required>
      @error('event_date')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Jam (opsional)</label>
      <input type="time" name="event_time" value="{{ old('event_time', $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('H:i') : '') }}">
    </div>

    <div class="form-group">
      <label>Lokasi (opsional)</label>
      <input type="text" name="location" value="{{ old('location', $event->location) }}">
    </div>

    <div class="form-group">
      <label>Kategori Warna</label>
      <select name="color_tag" required>
        <option value="c1" {{ old('color_tag', $event->color_tag) == 'c1' ? 'selected' : '' }}>Kuning — Tujuan Agenda 1</option>
        <option value="c2" {{ old('color_tag', $event->color_tag) == 'c2' ? 'selected' : '' }}>Merah — Tujuan Agenda 2</option>
        <option value="c3" {{ old('color_tag', $event->color_tag) == 'c3' ? 'selected' : '' }}>Hijau — Tujuan Agenda 3</option>
      </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection