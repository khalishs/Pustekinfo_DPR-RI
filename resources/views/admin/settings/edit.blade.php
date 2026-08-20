@extends('admin.layout')
@section('title', 'Pengaturan Kontak')
@section('content')
<div class="card">
  <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Alamat</label>
        <textarea name="address" required>{{ old('address', $setting->address) }}</textarea>
        @error('address')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group form-span-2">
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

    </div>

    <p style="margin-top:4px;color:#7a8a92;font-size:12.5px;">Pengaturan section Lokasi (peta &amp; tampil/sembunyikan) sekarang ada di menu <a href="{{ route('admin.location-settings.edit') }}" style="color:var(--teal);font-weight:700;">Pengaturan Lokasi</a> tersendiri.</p>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
@endsection