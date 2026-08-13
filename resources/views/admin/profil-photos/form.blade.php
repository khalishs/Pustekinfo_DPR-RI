{{-- resources/views/admin/profil-photos/form.blade.php --}}
@extends('admin.layout')
@section('title', $photo->exists ? 'Edit Foto' : 'Tambah Foto')
@section('content')
<div class="card">
  <form action="{{ $photo->exists ? route('admin.profil-photos.update', $photo) : route('admin.profil-photos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($photo->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="{{ $photo->exists ? '' : 'required' }}">Foto</label>
        @if($photo->image)
          <img src="{{ asset($photo->image) }}" style="width:200px;border-radius:8px;margin-bottom:10px;display:block;">
        @endif
        <input type="file" name="image" accept="image/png" data-min-kb="2048" data-max-kb="10240" {{ $photo->exists ? '' : 'required' }}>
        <small>Format PNG, ukuran 2–10 MB.</small>
        @error('image')<small class="error">{{ $message }}</small>@enderror
        @if($photo->exists)<small>Kosongkan jika tidak ingin mengganti foto.</small>@endif
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $photo->sort_order ?? 0) }}" required>
        @error('sort_order')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" {{ old('is_active', $photo->is_active ?? true) ? 'checked' : '' }}> Tampilkan di beranda</label>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.profil-photos.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection
