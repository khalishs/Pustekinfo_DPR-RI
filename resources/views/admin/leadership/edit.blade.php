@extends('admin.layout')
@section('title', 'Sambutan Pimpinan')
@section('content')
<div class="card">
  <form action="{{ route('admin.leadership.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Nama Pimpinan</label>
      <input type="text" name="name" value="{{ old('name', $leadership->name) }}" required>
      @error('name')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Jabatan (tampil di foto)</label>
      <input type="text" name="position" value="{{ old('position', $leadership->position ?? 'KEPALA PUSTEKINFO') }}" required>
    </div>

    <div class="form-group">
      <label>Foto Pimpinan</label>
      @if($leadership->photo)
        <img src="{{ asset('storage/'.$leadership->photo) }}" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
      @endif
      <input type="file" name="photo" accept="image/*">
      @error('photo')<small class="error">{{ $message }}</small>@enderror
      <small>Kosongkan jika tidak ingin mengganti foto.</small>
    </div>

    <div class="form-group">
      <label>Judul Sambutan</label>
      <input type="text" name="welcome_title" value="{{ old('welcome_title', $leadership->welcome_title ?? 'Teknologi untuk pelayanan yang lebih baik') }}" required>
    </div>

    <div class="form-group">
      <label>Isi Sambutan</label>
      <textarea name="description" style="min-height:140px;" required>{{ old('description', $leadership->description) }}</textarea>
      @error('description')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Jabatan di Tanda Tangan</label>
      <input type="text" name="signature_role" value="{{ old('signature_role', $leadership->signature_role ?? 'Kepala Pusat Teknologi Informasi') }}" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection