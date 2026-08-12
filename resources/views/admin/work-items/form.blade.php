{{-- resources/views/admin/work-items/form.blade.php --}}
@extends('admin.layout')
@section('title', $item->exists ? 'Edit Card' : 'Tambah Card')
@section('content')
<div class="card">
  <form action="{{ $item->exists ? route('admin.work-items.update', $item) : route('admin.work-items.store') }}" method="POST">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul</label>
        <input type="text" name="title" value="{{ old('title', $item->title) }}" required maxlength="255">
        @error('title')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label>Judul (EN)</label>
        <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}" maxlength="255">
        @error('title_en')<small class="error">{{ $message }}</small>@enderror
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Deskripsi</label>
        <textarea name="description" required maxlength="1000">{{ old('description', $item->description) }}</textarea>
        @error('description')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN)</label>
        <textarea name="description_en" maxlength="1000">{{ old('description_en', $item->description_en) }}</textarea>
        @error('description_en')<small class="error">{{ $message }}</small>@enderror
        <small>Opsional — kosongkan untuk memakai deskripsi Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Ikon</label>
        <select name="icon_key" id="icon_key" required onchange="document.getElementById('icon-preview').innerHTML = document.getElementById('icon_key').selectedOptions[0].dataset.svg;">
          @foreach($icons as $key => $icon)
            <option value="{{ $key }}" data-svg='<svg viewBox="0 0 24 24">{!! $icon['paths'] !!}</svg>' {{ old('icon_key', $item->icon_key ?? 'layers') == $key ? 'selected' : '' }}>{{ $icon['label'] }}</option>
          @endforeach
        </select>
        @error('icon_key')<small class="error">{{ $message }}</small>@enderror
        <div id="icon-preview" style="margin-top:10px;width:32px;height:32px;color:#073D5F;">
          <svg viewBox="0 0 24 24">{!! ($icons[old('icon_key', $item->icon_key ?? 'layers')] ?? $icons['layers'])['paths'] !!}</svg>
        </div>
        <style>#icon-preview svg{width:100%;height:100%;stroke:currentColor;fill:none;stroke-width:1.6;stroke-linecap:round;stroke-linejoin:round;}</style>
      </div>

      <div class="form-group">
        <label class="required">Baris Tampil</label>
        <select name="row_position" required>
          <option value="1" {{ old('row_position', $item->row_position ?? 1) == 1 ? 'selected' : '' }}>Atas</option>
          <option value="2" {{ old('row_position', $item->row_position ?? 1) == 2 ? 'selected' : '' }}>Bawah</option>
        </select>
        @error('row_position')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
        @error('sort_order')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group form-span-2">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}> Tampilkan di beranda</label>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.work-items.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection
