@extends('admin.layout')
@section('title', $newsItem->exists ? 'Edit Berita' : 'Tambah Berita')
@section('content')
<div class="card">
  <form action="{{ $newsItem->exists ? route('admin.news.update', $newsItem) : route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($newsItem->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Judul</label>
      <input type="text" name="title" value="{{ old('title', $newsItem->title) }}" required>
      @error('title')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Kategori</label>
      <input type="text" name="category" value="{{ old('category', $newsItem->category) }}" placeholder="Pengumuman, Sistem, Pelatihan, dll" required>
    </div>

    <div class="form-group">
      <label>Ringkasan</label>
      <textarea name="excerpt" required>{{ old('excerpt', $newsItem->excerpt) }}</textarea>
    </div>

    <div class="form-group">
      <label>Isi lengkap (opsional)</label>
      <textarea name="content" style="min-height:180px;">{{ old('content', $newsItem->content) }}</textarea>
    </div>

    <div class="form-group">
      <label>Gambar</label>
      @if($newsItem->image)
        <img src="{{ asset('storage/'.$newsItem->image) }}" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
      @endif
      <input type="file" name="image" accept="image/*">
      @error('image')<small class="error">{{ $message }}</small>@enderror
      <small>Kosongkan jika tidak ingin mengganti gambar.</small>
    </div>

    <div class="form-group">
      <label>Penulis</label>
      <input type="text" name="author" value="{{ old('author', $newsItem->author ?? 'Humas Pustekinfo') }}" required>
    </div>

    <div class="form-group">
      <label>Estimasi waktu baca (menit)</label>
      <input type="number" name="reading_minutes" value="{{ old('reading_minutes', $newsItem->reading_minutes ?? 3) }}" min="1" required>
    </div>

    <div class="form-group">
      <label>Tanggal publish</label>
      <input type="datetime-local" name="published_at" value="{{ old('published_at', $newsItem->published_at?->format('Y-m-d\TH:i')) }}">
    </div>

    <div class="form-group">
      <label><input type="checkbox" name="is_featured" value="1" style="width:auto;display:inline-block;" {{ old('is_featured', $newsItem->is_featured) ? 'checked' : '' }}> Jadikan berita utama (featured)</label>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.news.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection