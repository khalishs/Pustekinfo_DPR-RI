@extends('admin.layout')
@section('title', $item->exists ? 'Edit Foto Galeri' : 'Tambah Foto Galeri')
@section('content')
<div class="card">
  <form action="{{ $item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Judul / Keterangan (opsional)</label>
      <input type="text" name="title" value="{{ old('title', $item->title) }}">
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
      <select name="category" required>
        @foreach(['pelatihan'=>'Pelatihan','kegiatan'=>'Kegiatan','kerjasama'=>'Kerjasama','seremoni'=>'Seremoni'] as $val => $label)
          <option value="{{ $val }}" {{ old('category', $item->category) == $val ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Ukuran kartu</label>
      <select name="size" required>
        <option value="big" {{ old('size', $item->size) == 'big' ? 'selected' : '' }}>Besar (2x2)</option>
        <option value="wide" {{ old('size', $item->size) == 'wide' ? 'selected' : '' }}>Lebar</option>
        <option value="med" {{ old('size', $item->size) == 'med' ? 'selected' : '' }}>Sedang</option>
        <option value="small" {{ old('size', $item->size ?? 'small') == 'small' ? 'selected' : '' }}>Kecil</option>
      </select>
      <small>Idealnya cuma 1 foto "Besar" per halaman.</small>
    </div>

    <div class="form-group">
      <label>Urutan tampil</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection