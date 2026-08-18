{{-- resources/views/admin/stela-videos/form.blade.php --}}
@extends('admin.layout')
@section('title', $item->exists ? 'Edit Video Sekilas STELA' : 'Tambah Video Sekilas STELA')
@section('content')
<div class="card">
  <form action="{{ $item->exists ? route('admin.stela-videos.update', $item) : route('admin.stela-videos.store') }}" method="POST">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label>Link Video</label>
        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:9px;">
          <span class="badge">YouTube</span>
          <span class="badge">Google Drive</span>
          <span class="badge">Terabox</span>
          <span class="badge">Link video lainnya</span>
        </div>
        <input type="url" name="video_url" value="{{ old('video_url', $item->video_url) }}" placeholder="Masukkan link video">
        @error('video_url')<small class="error">{{ $message }}</small>@enderror
        <small>Link YouTube &amp; Google Drive akan tampil langsung terputar di halaman; link lain akan tampil sebagai tombol buka video.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Link Website STELA</label>
        <input type="url" name="link_url" value="{{ old('link_url', $item->link_url) }}" placeholder="https://stela.dpr.go.id">
        @error('link_url')<small class="error">{{ $message }}</small>@enderror
        <small>Kosongkan untuk memakai default: https://stela.dpr.go.id</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.stela-videos.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection
