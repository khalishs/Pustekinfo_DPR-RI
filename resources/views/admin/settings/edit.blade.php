@extends('admin.layout')
@section('title', 'Pengaturan Footer')
@section('content')
<div class="card">
  <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Alamat</label>
      <textarea name="address" required>{{ old('address', $setting->address) }}</textarea>
      @error('address')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Telepon</label>
      <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" required>
    </div>

    <div class="form-group">
      <label>Email</label>
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

    <button class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection