@extends('admin.layout')
@section('title', 'Pengaturan Footer')
@section('content')
<div class="card">
  <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label class="required">Alamat</label>
      <textarea name="address" required>{{ old('address', $setting->address) }}</textarea>
      @error('address')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Alamat (EN)</label>
      <textarea name="address_en">{{ old('address_en', $setting->address_en) }}</textarea>
      @error('address_en')<small class="error">{{ $message }}</small>@enderror
      <small>Opsional — kosongkan untuk memakai alamat Bahasa Indonesia di atas.</small>
    </div>

    <div class="form-group">
      <label class="required">Telepon</label>
      <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" required>
    </div>

    <div class="form-group">
      <label class="required">Email</label>
      <input type="email" name="email" value="{{ old('email', $setting->email) }}" required>
    </div>

    <div class="form-group">
      <label>Link Instagram</label>
      <input type="url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" placeholder="https://instagram.com/...">
    </div>

    <div class="form-group">
      <label>Link YouTube</label>
      <input type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}" placeholder="https://youtube.com/...">
    </div>

    <div class="form-group">
      <label>Link X (Twitter)</label>
      <input type="url" name="x_url" value="{{ old('x_url', $setting->x_url) }}" placeholder="https://x.com/...">
    </div>

    <div class="form-group">
      <label>Link Peta (Google Maps Embed)</label>
      <input type="url" name="maps_embed_url" value="{{ old('maps_embed_url', $setting->maps_embed_url) }}" placeholder="https://www.google.com/maps/embed?pb=...">
      <small>Buka Google Maps &rarr; Bagikan &rarr; Sematkan peta &rarr; salin kode iframe &rarr; ambil hanya nilai atribut <code>src="..."</code>-nya, lalu tempel di sini. Kosongkan untuk memakai peta default.</small>
      @error('maps_embed_url')<small class="error">{{ $message }}</small>@enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection