{{-- resources/views/admin/hero-slides/form.blade.php --}}
@extends('admin.layout')
@section('title', $slide->exists ? 'Edit Slide' : 'Tambah Slide')
@section('content')
<div class="card">
  <form action="{{ $slide->exists ? route('admin.hero-slides.update', $slide) : route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($slide->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Gambar Latar</label>
      @if($slide->image)
        <img src="{{ asset('storage/'.$slide->image) }}" style="width:240px;border-radius:8px;margin-bottom:10px;display:block;">
      @endif
      <input type="file" name="image" accept="image/*" {{ $slide->exists ? '' : 'required' }}>
      @error('image')<small class="error">{{ $message }}</small>@enderror
      @if($slide->exists)<small>Kosongkan jika tidak ingin mengganti gambar.</small>@endif
    </div>

    <div class="form-group">
      <label>Judul (opsional)</label>
      <input type="text" name="title" value="{{ old('title', $slide->title) }}">
      @error('title')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Subjudul (opsional)</label>
      <input type="text" name="subtitle" value="{{ old('subtitle', $slide->subtitle) }}">
      @error('subtitle')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Urutan tampil</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $slide->sort_order ?? 0) }}" required>
      @error('sort_order')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }}> Tampilkan di beranda</label>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection
