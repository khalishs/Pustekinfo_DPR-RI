{{-- resources/views/admin/core-values/form.blade.php --}}
@extends('admin.layout')
@section('title', $value->exists ? 'Edit Nilai' : 'Tambah Nilai')
@section('content')
<div class="card">
  <form action="{{ $value->exists ? route('admin.core-values.update', $value) : route('admin.core-values.store') }}" method="POST">
    @csrf
    @if($value->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul (contoh: Integritas)</label>
        <input type="text" name="title" value="{{ old('title', $value->title) }}" required>
        @error('title')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label>Judul (EN)</label>
        <input type="text" name="title_en" value="{{ old('title_en', $value->title_en) }}">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Deskripsi</label>
        <textarea name="description" required>{{ old('description', $value->description) }}</textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN)</label>
        <textarea name="description_en">{{ old('description_en', $value->description_en) }}</textarea>
        <small>Opsional — kosongkan untuk memakai deskripsi Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label class="required">Ikon</label>
        <select name="icon" required>
          <option value="integrity" {{ old('icon', $value->icon) == 'integrity' ? 'selected' : '' }}>Bintang (Integritas)</option>
          <option value="innovative" {{ old('icon', $value->icon) == 'innovative' ? 'selected' : '' }}>Lampu (Inovatif)</option>
          <option value="professional" {{ old('icon', $value->icon) == 'professional' ? 'selected' : '' }}>Perisai (Profesional)</option>
          <option value="collaborative" {{ old('icon', $value->icon) == 'collaborative' ? 'selected' : '' }}>Orang (Kolaboratif)</option>
          <option value="service" {{ old('icon', $value->icon) == 'service' ? 'selected' : '' }}>Tangan (Melayani)</option>
          <option value="accountable" {{ old('icon', $value->icon) == 'accountable' ? 'selected' : '' }}>Kunci (Akuntabel)</option>
        </select>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $value->sort_order ?? 0) }}" required>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" {{ old('is_active', $value->exists ? $value->is_active : true) ? 'checked' : '' }}> Status aktif</label>
        @error('is_active')<small class="error">{{ $message }}</small>@enderror
        <small>Nilai nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.core-values.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection