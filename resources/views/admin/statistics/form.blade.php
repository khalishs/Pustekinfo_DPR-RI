@extends('admin.layout')
@section('title', $statistic->exists ? 'Edit Statistik' : 'Tambah Statistik')
@section('content')
<div class="card">
  <form action="{{ $statistic->exists ? route('admin.statistics.update', $statistic) : route('admin.statistics.store') }}" method="POST">
    @csrf
    @if($statistic->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group form-span-2">
        <label class="required">Kode SVG ikon</label>
        <textarea name="icon_svg" id="iconSvgInput" rows="3" style="font-family:monospace;font-size:12.5px;" required>{{ old('icon_svg', $statistic->icon_svg) }}</textarea>
        @error('icon_svg')<small class="error">{{ $message }}</small>@enderror
        <small>Isi elemen SVG-nya saja (tanpa tag &lt;svg&gt; pembungkus), contoh: <code>&lt;circle cx="12" cy="12" r="9"/&gt;</code>. Tag yang diizinkan: path, rect, circle, ellipse, line, polygon, polyline, g. Viewbox mengikuti "0 0 24 24".</small>
        <div style="margin-top:10px;width:48px;height:48px;border-radius:12px;background:rgba(20,128,140,.1);display:flex;align-items:center;justify-content:center;">
          <svg id="iconSvgPreview" viewBox="0 0 24 24" style="width:22px;height:22px;stroke:var(--teal);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;">{!! old('icon_svg', $statistic->icon_svg) !!}</svg>
        </div>
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

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" {{ old('is_active', $statistic->exists ? $statistic->is_active : true) ? 'checked' : '' }}> Status aktif</label>
        @error('is_active')<small class="error">{{ $message }}</small>@enderror
        <small>Statistik nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.statistics.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>

<script>
  document.getElementById('iconSvgInput').addEventListener('input', function () {
    document.getElementById('iconSvgPreview').innerHTML = this.value;
  });
</script>
@endsection
