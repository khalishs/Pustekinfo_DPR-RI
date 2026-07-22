{{-- resources/views/admin/organization-members/form.blade.php --}}
@extends('admin.layout')
@section('title', $member->exists ? 'Edit Anggota' : 'Tambah Anggota')
@section('content')
<div class="card">
  <form action="{{ $member->exists ? route('admin.organization-members.update', $member) : route('admin.organization-members.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($member->exists) @method('PUT') @endif

    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" value="{{ old('name', $member->name) }}" required>
      @error('name')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Jabatan</label>
      <input type="text" name="position" value="{{ old('position', $member->position) }}" required>
    </div>

    <div class="form-group">
      <label>Foto</label>
      @if($member->photo)
        <img src="{{ asset('storage/'.$member->photo) }}" style="width:120px;border-radius:8px;margin-bottom:10px;display:block;">
      @endif
      <input type="file" name="photo" accept="image/*">
      <small>Kosongkan jika tidak ingin mengganti foto.</small>
    </div>

    <div class="form-group">
      <label>Level</label>
      <select name="level" required>
        <option value="kepala" {{ old('level', $member->level) == 'kepala' ? 'selected' : '' }}>Kepala (puncak bagan — hanya 1)</option>
        <option value="sekretariat" {{ old('level', $member->level) == 'sekretariat' ? 'selected' : '' }}>Sekretariat (baris kedua — hanya 1)</option>
        <option value="bidang" {{ old('level', $member->level ?? 'bidang') == 'bidang' ? 'selected' : '' }}>Bidang (baris bawah — bisa banyak)</option>
      </select>
      <small>Anggota level "Bidang" otomatis muncul juga di Foto Pimpinan dan Uraian Unit Kerja.</small>
    </div>

    <div class="form-group">
      <label>Deskripsi Unit (khusus level Bidang, opsional)</label>
      <textarea name="unit_description" placeholder="Mengelola jaringan, pusat data, dll.">{{ old('unit_description', $member->unit_description) }}</textarea>
    </div>

    <div class="form-group">
      <label>Urutan tampil</label>
      <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.organization-members.index') }}" class="btn btn-outline">Batal</a>
  </form>
</div>
@endsection