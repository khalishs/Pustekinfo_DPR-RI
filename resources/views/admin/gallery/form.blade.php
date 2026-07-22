@extends('admin.layout')
@section('title', $item->exists ? 'Edit Foto Galeri' : 'Tambah Foto Galeri')
@section('content')
<div class="card">
  <form action="{{ $item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Judul Kegiatan</label>
      <input type="text" name="title" value="{{ old('title', $item->title) }}" required>
      @error('title')<small class="error">{{ $message }}</small>@enderror
      <small>Foto dengan judul kegiatan yang sama akan dihitung sebagai 1 kegiatan terdokumentasi.</small>
    </div>

    <div class="form-group">
      <label>Deskripsi (opsional, tampil kalau dijadikan sorotan)</label>
      <textarea name="description">{{ old('description', $item->description) }}</textarea>
    </div>

    <div class="form-group">
      <label>Foto</label>
      @if($item->image)
        <img src="{{ asset('storage/'.$item->image) }}" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
      @endif
      <input type="file" name="image" accept="image/*" {{ $item->exists ? '' : 'required' }}>
      @error('image')<small class="error">{{ $message }}</small>@enderror
      @if($item->exists)<small>Kosongkan jika tidak ingin mengganti foto.</small>@endif
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <select name="category_id" required>
        <option value="">— Pilih kategori —</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>
      @error('category_id')<small class="error">{{ $message }}</small>@enderror
      <small>Kategori baru bisa ditambah di menu "Kategori Galeri".</small>
    </div>

    <div class="form-group">
      <label>Ukuran kartu</label>
      <select name="size" required>
        <option value="big" {{ old('size', $item->size) == 'big' ? 'selected' : '' }}>Besar (2x2)</option>
        <option value="wide" {{ old('size', $item->size) == 'wide' ? 'selected' : '' }}>Lebar</option>
        <option value="med" {{ old('size', $item->size) == 'med' ? 'selected' : '' }}>Sedang</option>
        <option value="small" {{ old('size', $item->size ?? 'small') == 'small' ? 'selected' : '' }}>Kecil</option>
      </select>
    </div>

    <div class="form-group">
      <label>Urutan tampil</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
    </div>

    <div class="form-group">
      <label><input type="checkbox" name="is_featured" value="1" style="width:auto;display:inline-block;" {{ old('is_featured', $item->is_featured) ? 'checked' : '' }}> Jadikan sorotan di halaman galeri</label>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection