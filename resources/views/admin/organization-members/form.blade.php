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
        <input type="file" name="photo" accept="image/*" data-min-kb="2048" data-max-kb="10240">
        <small>Kosongkan jika tidak ingin mengganti foto.</small>
      </div>

      <div class="form-group">
        <label class="required">Level</label>
        <select name="level" required>
          <option value="kepala" {{ old('level', $member->level) == 'kepala' ? 'selected' : '' }}>Kepala (baris atas bagan — hanya 1)</option>
          <option value="bidang" {{ old('level', $member->level ?? 'bidang') == 'bidang' ? 'selected' : '' }}>Bidang (baris bawah bagan — bisa banyak)</option>
        </select>
        <small>Bagan organisasi cuma 2 baris: 1 Kepala di atas, dan semua anggota "Bidang" berjajar di bawahnya.</small>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi Unit (khusus level Bidang, opsional)</label>
        <textarea name="unit_description" placeholder="Mengelola jaringan, pusat data, dll.">{{ old('unit_description', $member->unit_description) }}</textarea>
      </div>

      <div class="form-group form-span-2">
        <label>Deskripsi Unit (EN, opsional)</label>
        <textarea name="unit_description_en" placeholder="Manages networking, data center, etc.">{{ old('unit_description_en', $member->unit_description_en) }}</textarea>
      </div>

      <div class="form-group">
        <label class="required">Urutan tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" required>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.organization-members.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection