{{-- resources/views/admin/timeline/form.blade.php --}}
@extends('admin.layout')
@section('title', $item->exists ? 'Edit Poin Sejarah' : 'Tambah Poin Sejarah')
@section('content')
<div class="card">
  <form action="{{ $item->exists ? route('admin.timeline.update', $item) : route('admin.timeline.store') }}" method="POST">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Tahun</label>
      <input type="text" name="year" value="{{ old('year', $item->year) }}" placeholder="1985" required>
      @error('year')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Judul</label>
      <input type="text" name="title" value="{{ old('title', $item->title) }}" required>
      @error('title')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea name="description" required>{{ old('description', $item->description) }}</textarea>
    </div>

    <div class="form-group">
      <label>Urutan tampil</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.timeline.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection