@extends('admin.layout')
@section('title', 'Edit Statistik')
@section('content')
<div class="card">
  <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-grid">
      <div class="form-group">
        <label class="required">Kategori</label>
        <select name="key" required>
          <option value="">— Pilih kategori —</option>
          <option value="apps" {{ old('key', $statistic->key) == 'apps' ? 'selected' : '' }}>Aplikasi Terkelola</option>
          <option value="karyawan" {{ old('key', $statistic->key) == 'karyawan' ? 'selected' : '' }}>Karyawan Pustekinfo</option>
          <option value="pengguna" {{ old('key', $statistic->key) == 'pengguna' ? 'selected' : '' }}>Pengguna Terlayani</option>
          <option value="spbe" {{ old('key', $statistic->key) == 'spbe' ? 'selected' : '' }}>Indeks SPBE</option>
        </select>
        @error('key')<small class="error">{{ $message }}</small>@enderror
        <small>Menentukan ikon yang tampil di beranda. Idealnya cuma 1 data per kategori.</small>
      </div>

      <div class="form-group">
        <label class="required">Label</label>
        <input type="text" name="label" value="{{ old('label', $statistic->label) }}" required>
        @error('label')<small class="error">{{ $message }}</small>@enderror
      </div>
      <div class="form-group">
        <label>Label (EN)</label>
        <input type="text" name="label_en" value="{{ old('label_en', $statistic->label_en) }}">
        <small>Opsional — kosongkan untuk memakai label Bahasa Indonesia di atas.</small>
      </div>
      <div class="form-group">
        <label class="required">Nilai (angka)</label>
        <input type="number" step="0.01" name="value" value="{{ old('value', $statistic->value) }}" required>
      </div>
      <div class="form-group">
        <label>Suffix (contoh: +, K — kosongkan kalau tidak ada)</label>
        <input type="text" name="suffix" value="{{ old('suffix', $statistic->suffix) }}">
      </div>
      <div class="form-group">
        <label class="required">Jumlah angka desimal</label>
        <input type="number" name="decimals" value="{{ old('decimals', $statistic->decimals ?? 0) }}" min="0" max="2" required>
      </div>
      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $statistic->sort_order ?? 0) }}" required>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.statistics.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection