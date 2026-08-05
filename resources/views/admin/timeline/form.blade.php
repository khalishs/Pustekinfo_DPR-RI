{{-- resources/views/admin/timeline/form.blade.php --}}
@extends('admin.layout')
@section('title', $item->exists ? 'Edit Poin Sejarah' : 'Tambah Poin Sejarah')
@section('content')
<div class="card">
  <form action="{{ $item->exists ? route('admin.timeline.update', $item) : route('admin.timeline.store') }}" method="POST">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Tahun</label>
        <input type="text" name="year" value="{{ old('year', $item->year) }}" placeholder="1985" required>
        @error('year')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label class="required">Judul</label>
        <input type="text" name="title" value="{{ old('title', $item->title) }}" required>
        @error('title')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label>Judul (EN)</label>
        <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Deskripsi</label>
        <textarea name="description" required>{{ old('description', $item->description) }}</textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN)</label>
        <textarea name="description_en">{{ old('description_en', $item->description_en) }}</textarea>
        <small>Opsional — kosongkan untuk memakai deskripsi Bahasa Indonesia di atas.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.timeline.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection