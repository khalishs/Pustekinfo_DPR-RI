{{-- resources/views/admin/page-banners/edit.blade.php --}}
@extends('admin.layout')
@section('title', 'Banner Halaman '.$label)
@section('content')
<div class="page-head">
  <h2>Banner Halaman {{ $label }}</h2>
</div>
<div class="card">
  <form action="{{ route('admin.page-banners.update', $pageKey) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Gambar Banner Saat Ini</label>
        @if($banner->image)
          <img src="{{ asset($banner->image) }}" style="width:100%;max-width:420px;aspect-ratio:16/6;object-fit:cover;border-radius:8px;margin-bottom:10px;display:block;">
        @else
          <p style="color:#8a97a0;font-size:13px;margin-bottom:10px;">Belum ada banner. Halaman akan memakai latar polos bawaan.</p>
        @endif
        <input type="file" name="image" accept="image/png" data-min-kb="2048" data-max-kb="10240" required>
        <small>Format PNG, ukuran 2–10 MB.</small>
        @error('image')<small class="error">{{ $message }}</small>@enderror
        <small>Disarankan gambar lebar (misal 1600×600px) agar tidak terpotong.</small>
      </div>
    </div>

    <div class="form-actions" style="display:flex;gap:10px;">
      <button class="btn btn-primary">Simpan Banner</button>
      @if($banner->exists && $banner->image)
        <button class="btn btn-outline" type="submit" form="deleteBannerForm">Hapus Banner</button>
      @endif
    </div>
  </form>

  @if($banner->exists && $banner->image)
    <form id="deleteBannerForm" action="{{ route('admin.page-banners.destroy', $pageKey) }}" method="POST" onsubmit="return confirm('Hapus banner halaman {{ $label }}?')">
      @csrf @method('DELETE')
    </form>
  @endif
</div>
@endsection
