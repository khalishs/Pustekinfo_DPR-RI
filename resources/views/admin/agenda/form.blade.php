@extends('admin.layout')
@section('title', $event->exists ? 'Edit Agenda' : 'Tambah Agenda')
@section('content')
<div class="card">
  <form action="{{ $event->exists ? route('admin.agenda.update', $event) : route('admin.agenda.store') }}" method="POST">
    @csrf
    @if($event->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul Kegiatan</label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" required>
        @error('title')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label>Judul Kegiatan (EN)</label>
        <input type="text" name="title_en" value="{{ old('title_en', $event->title_en) }}">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (opsional)</label>
        <textarea name="description">{{ old('description', $event->description) }}</textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN, opsional)</label>
        <textarea name="description_en">{{ old('description_en', $event->description_en) }}</textarea>
      </div>

      <div class="form-group">
        <label class="required">Tanggal</label>
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
        <label class="required">Warna Titik Penanda</label>
        <div style="display:flex;align-items:center;gap:10px;">
          <input type="color" name="color" id="colorInput" value="{{ old('color', $event->color ?? '#14839C') }}" style="width:48px;height:40px;padding:2px;border:1px solid #dfe4e7;border-radius:8px;cursor:pointer;" required>
          <span id="colorHexPreview" style="font-family:monospace;font-size:13px;color:#5b6b73;">{{ old('color', $event->color ?? '#14839C') }}</span>
        </div>
        <small>Warna ini akan tampil sebagai titik penanda pada kalender agenda di halaman publik.</small>
        @error('color')<small class="error">{{ $message }}</small>@enderror
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.agenda.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>

<script>
  document.getElementById('colorInput').addEventListener('input', function () {
    document.getElementById('colorHexPreview').textContent = this.value;
  });
</script>
@endsection