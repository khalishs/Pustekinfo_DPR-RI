{{-- resources/views/admin/gallery-categories/form.blade.php --}}
@extends('admin.layout')
@section('title', $category->exists ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
<div class="card">
  <form action="{{ $category->exists ? route('admin.gallery-categories.update', $category) : route('admin.gallery-categories.store') }}" method="POST">
    @csrf
    @if($category->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
      @error('name')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Urutan tampil (di filter galeri)</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.gallery-categories.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection