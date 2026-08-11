{{-- resources/views/admin/layanan/stela-video.blade.php --}}
@extends('admin.layout')
@section('title', 'Video Sekilas STELA')
@section('content')
<div class="page-head">
  <h2>Video Sekilas STELA</h2>
  <p style="color:#8a97a0;font-size:13px;margin-top:4px;">Video &amp; link ini tampil di section "Sekilas STELA" pada halaman Ajukan Layanan.</p>
</div>
<div class="card">
  <form action="{{ route('admin.stela-video.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @php $videoType = old('stela_video_type', $setting->stela_video_type ?? 'upload'); @endphp

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Sumber Video</label>
        <div style="display:flex;gap:20px;margin-top:4px;">
          <label style="font-weight:400;"><input type="radio" name="stela_video_type" value="upload" id="typeUpload" style="width:auto;display:inline-block;" {{ $videoType === 'upload' ? 'checked' : '' }}> Upload MP4</label>
          <label style="font-weight:400;"><input type="radio" name="stela_video_type" value="youtube" id="typeYoutube" style="width:auto;display:inline-block;" {{ $videoType === 'youtube' ? 'checked' : '' }}> Link YouTube</label>
        </div>
        @error('stela_video_type')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group form-span-2" id="fieldUpload">
        <label>Video (MP4/WebM/OGG)</label>
        @if($setting->stela_video)
          <video src="{{ asset($setting->stela_video) }}" controls style="width:100%;max-width:420px;border-radius:8px;margin-bottom:10px;display:block;background:#000;"></video>
          <label style="font-weight:400;"><input type="checkbox" name="hapus_stela_video" value="1" style="width:auto;display:inline-block;"> Hapus video saat ini</label>
        @else
          <p style="color:#8a97a0;font-size:13px;margin-bottom:10px;">Belum ada video diunggah.</p>
        @endif
        <input type="file" name="stela_video" accept="video/mp4,video/webm,video/ogg" data-max-kb="51200" data-ext="mp4,webm,ogg">
        @error('stela_video')<small class="error">{{ $message }}</small>@enderror
        <small>Maksimal 50MB.</small>
      </div>

      <div class="form-group form-span-2" id="fieldYoutube">
        <label>Link YouTube</label>
        <input type="url" name="stela_youtube_url" value="{{ old('stela_youtube_url', $setting->stela_youtube_url) }}" placeholder="https://www.youtube.com/watch?v=...">
        @error('stela_youtube_url')<small class="error">{{ $message }}</small>@enderror
        <small>Tempel link video YouTube (watch, youtu.be, atau shorts).</small>
      </div>

      <div class="form-group form-span-2">
        <label>Link Website STELA</label>
        <input type="url" name="stela_url" value="{{ old('stela_url', $setting->stela_url) }}" placeholder="https://stela.dpr.go.id">
        @error('stela_url')<small class="error">{{ $message }}</small>@enderror
        <small>Kosongkan untuk memakai default: https://stela.dpr.go.id</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>

<script>
  (function () {
    const typeUpload = document.getElementById('typeUpload');
    const typeYoutube = document.getElementById('typeYoutube');
    const fieldUpload = document.getElementById('fieldUpload');
    const fieldYoutube = document.getElementById('fieldYoutube');

    function sync() {
      const isYoutube = typeYoutube.checked;
      fieldUpload.style.display = isYoutube ? 'none' : '';
      fieldYoutube.style.display = isYoutube ? '' : 'none';
    }

    typeUpload.addEventListener('change', sync);
    typeYoutube.addEventListener('change', sync);
    sync();
  })();
</script>
@endsection
