@extends('admin.layout')
@section('title', $item->exists ? 'Edit Foto Galeri' : 'Tambah Foto Galeri')
@section('content')
<div class="card">
  <form action="{{ $item->exists ? route('admin.gallery.update', $item) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($item->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Judul Kegiatan</label>
        <input type="text" name="title" value="{{ old('title', $item->title) }}" required>
        @error('title')<small class="error">{{ $message }}</small>@enderror
        <small>Foto dengan judul kegiatan yang sama akan dihitung sebagai 1 kegiatan terdokumentasi.</small>
      </div>

      <div class="form-group">
        <label>Judul Kegiatan (EN)</label>
        <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (opsional, tampil kalau dijadikan sorotan)</label>
        <textarea name="description">{{ old('description', $item->description) }}</textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi (EN, opsional)</label>
        <textarea name="description_en">{{ old('description_en', $item->description_en) }}</textarea>
      </div>

      <div class="form-group form-span-2">
        <label class="{{ $item->exists ? '' : 'required' }}">Foto</label>
        @if($item->image)
          <img src="{{ asset($item->image) }}" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
        @endif
        <input type="file" name="image" accept="image/*" data-min-kb="2048" data-max-kb="10240" {{ $item->exists ? '' : 'required' }}>
        @error('image')<small class="error">{{ $message }}</small>@enderror
        @if($item->exists)<small>Kosongkan jika tidak ingin mengganti foto.</small>@endif
      </div>

      <div class="form-group">
        <label class="required">Kategori</label>
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
        <label class="required">Ukuran kartu</label>
        <select name="size" required>
          <option value="big" {{ old('size', $item->size) == 'big' ? 'selected' : '' }}>Besar (2x2)</option>
          <option value="wide" {{ old('size', $item->size) == 'wide' ? 'selected' : '' }}>Lebar</option>
          <option value="med" {{ old('size', $item->size) == 'med' ? 'selected' : '' }}>Sedang</option>
          <option value="small" {{ old('size', $item->size ?? 'small') == 'small' ? 'selected' : '' }}>Kecil</option>
        </select>
        @error('size')<small class="error">{{ $message }}</small>@enderror
        <small>Slot di Home &mdash; Besar: {{ $sizeCounts['big'] ?? 0 }}/{{ $sizeLimits['big'] }}, Sedang: {{ $sizeCounts['med'] ?? 0 }}/{{ $sizeLimits['med'] }}, Lebar: {{ $sizeCounts['wide'] ?? 0 }}/{{ $sizeLimits['wide'] }}, Kecil: {{ $sizeCounts['small'] ?? 0 }}/{{ $sizeLimits['small'] }}.</small>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_featured" value="1" style="width:auto;display:inline-block;" {{ old('is_featured', $item->is_featured) ? 'checked' : '' }}> Jadikan sorotan di halaman galeri</label>
        @error('is_featured')<small class="error">{{ $message }}</small>@enderror
        <small>Cuma satu foto yang bisa jadi sorotan. Kalau sudah ada foto lain yang jadi sorotan, batalkan dulu sorotannya sebelum mencentang ini.</small>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_on_home" value="1" style="width:auto;display:inline-block;" {{ old('show_on_home', $item->show_on_home) ? 'checked' : '' }}> Tampilkan di halaman utama (Home)</label>
        @error('show_on_home')<small class="error">{{ $message }}</small>@enderror
        <small>Slot terpakai: {{ $homeCount }}/{{ $maxHomeItems }}. Maksimal {{ $maxHomeItems }} foto yang bisa tampil di Home.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection