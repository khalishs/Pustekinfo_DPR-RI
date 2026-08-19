{{-- resources/views/admin/organization-members/form.blade.php --}}
@extends('admin.layout')
@section('title', $member->exists ? 'Edit Anggota' : 'Tambah Anggota')
@section('content')
<div class="card">
  <form action="{{ $member->exists ? route('admin.organization-members.update', $member) : route('admin.organization-members.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($member->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group">
        <label>Nama (opsional)</label>
        <input type="text" name="name" value="{{ old('name', $member->name) }}">
        @error('name')<small class="error">{{ $message }}</small>@enderror
        <small>Kosongkan kalau cuma mau tampilkan jabatannya saja.</small>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_name" value="1" style="width:auto;display:inline-block;" {{ old('show_name', $member->exists ? $member->show_name : false) ? 'checked' : '' }}> Tampilkan nama</label>
        @error('show_name')<small class="error">{{ $message }}</small>@enderror
        <small>Nama cuma muncul di bagan kalau kotak ini dicentang DAN kolom Nama di atas terisi.</small>
      </div>

      <div class="form-group">
        <label class="required">Jabatan</label>
        <input type="text" name="position" value="{{ old('position', $member->position) }}" required>
      </div>

      <div class="form-group">
        <label>Jabatan (EN)</label>
        <input type="text" name="position_en" value="{{ old('position_en', $member->position_en) }}">
        <small>Opsional — kosongkan untuk memakai jabatan Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Foto</label>
        @if($member->photo)
          <img src="{{ asset($member->photo) }}" style="width:120px;border-radius:8px;margin-bottom:10px;display:block;">
        @endif
        <input type="file" name="photo" accept="image/png" data-min-kb="2048" data-max-kb="10240">
        <small>Format PNG, ukuran 2–10 MB.</small>
        <small>Kosongkan jika tidak ingin mengganti foto.</small>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_photo" value="1" style="width:auto;display:inline-block;" {{ old('show_photo', $member->exists ? $member->show_photo : false) ? 'checked' : '' }}> Tampilkan foto</label>
        @error('show_photo')<small class="error">{{ $message }}</small>@enderror
        <small>Foto cuma muncul di bagan kalau kotak ini dicentang DAN foto sudah diunggah.</small>
      </div>

      <div class="form-group">
        <label class="required">Level</label>
        <select name="level" required>
          <option value="kepala" {{ old('level', $member->level) == 'kepala' ? 'selected' : '' }} {{ $kepalaFull ? 'disabled' : '' }}>Kepala (baris atas bagan — hanya 1){{ $kepalaFull ? ' — sudah terisi' : '' }}</option>
          <option value="bidang" {{ old('level', $member->level ?? 'bidang') == 'bidang' ? 'selected' : '' }} {{ $bidangFull ? 'disabled' : '' }}>Bidang (baris bawah bagan — maksimal 4){{ $bidangFull ? ' — sudah penuh' : '' }}</option>
        </select>
        @error('level')<small class="error">{{ $message }}</small>@enderror
        <small>Bagan organisasi cuma 2 baris: 1 Kepala di atas, dan maksimal 4 anggota "Bidang" berjajar di bawahnya (total maksimal 5 anggota).</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi Unit (opsional)</label>
        <textarea name="unit_description" placeholder="Mengelola jaringan, pusat data, dll.">{{ old('unit_description', $member->unit_description) }}</textarea>
        <small>Tampil sebagai teks kecil di bawah jabatan pada bagan organisasi, kalau diisi.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi Unit (EN, opsional)</label>
        <textarea name="unit_description_en" placeholder="Manages networking, data center, etc.">{{ old('unit_description_en', $member->unit_description_en) }}</textarea>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" required>
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="is_active" value="1" style="width:auto;display:inline-block;" {{ old('is_active', $member->exists ? $member->is_active : true) ? 'checked' : '' }}> Status aktif</label>
        @error('is_active')<small class="error">{{ $message }}</small>@enderror
        <small>Anggota nonaktif tidak akan tampil di halaman mana pun untuk pengunjung situs.</small>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.organization-members.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection