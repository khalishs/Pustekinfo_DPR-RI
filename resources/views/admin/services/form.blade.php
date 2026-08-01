{{-- resources/views/admin/services/form.blade.php --}}
@extends('admin.layout')
@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')
@section('content')
<div class="card">
  <form action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" method="POST">
    @csrf
    @if($service->exists) @method('PUT') @endif

    <div class="form-group">
      <label class="required">Judul Layanan</label>
      <input type="text" name="title" value="{{ old('title', $service->title) }}" required>
      @error('title')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Judul Layanan (EN)</label>
      <input type="text" name="title_en" value="{{ old('title_en', $service->title_en) }}">
      @error('title_en')<small class="error">{{ $message }}</small>@enderror
      <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
    </div>

    <div class="form-group">
      <label class="required">Deskripsi</label>
      <textarea name="description" required>{{ old('description', $service->description) }}</textarea>
      @error('description')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Deskripsi (EN)</label>
      <textarea name="description_en">{{ old('description_en', $service->description_en) }}</textarea>
      @error('description_en')<small class="error">{{ $message }}</small>@enderror
      <small>Opsional — kosongkan untuk memakai deskripsi Bahasa Indonesia di atas.</small>
    </div>

    <div class="form-group">
      <label>Daftar Fitur (satu baris = satu fitur)</label>
      <textarea name="features" style="min-height:120px;">{{ old('features', $service->exists ? implode("\n", $service->features) : '') }}</textarea>
      @error('features')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Daftar Fitur (EN, satu baris = satu fitur, urutan harus sama dengan versi Indonesia)</label>
      <textarea name="features_en" style="min-height:120px;">{{ old('features_en', $service->exists && $service->features_en ? implode("\n", $service->features_en) : '') }}</textarea>
      @error('features_en')<small class="error">{{ $message }}</small>@enderror
      <small>Opsional — kosongkan baris yang belum diterjemahkan untuk memakai versi Indonesia.</small>
    </div>

    <div class="form-group">
      <label class="required">Kode SVG Ikon (isi &lt;path&gt;/&lt;line&gt;/&lt;circle&gt; saja, tanpa tag &lt;svg&gt;)</label>
      <textarea name="icon_svg" required>{{ old('icon_svg', $service->icon_svg) }}</textarea>
      @error('icon_svg')<small class="error">{{ $message }}</small>@enderror
      <small>Contoh: &lt;path d="M5 12.55a11 11 0 0 1 14.08 0"/&gt;</small>
    </div>

    <div class="form-group">
      <label class="required">Teks Ajakan (CTA)</label>
      <input type="text" name="cta_text" value="{{ old('cta_text', $service->cta_text) }}" required>
      @error('cta_text')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Teks Ajakan (CTA) (EN)</label>
      <input type="text" name="cta_text_en" value="{{ old('cta_text_en', $service->cta_text_en) }}">
      @error('cta_text_en')<small class="error">{{ $message }}</small>@enderror
      <small>Opsional — kosongkan untuk memakai teks Bahasa Indonesia di atas.</small>
    </div>

    <div class="form-group">
      <label class="required">Urutan tampil</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" required>
      @error('sort_order')<small class="error">{{ $message }}</small>@enderror
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection
