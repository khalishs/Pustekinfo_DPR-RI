@extends('admin.layout')
@section('title', 'Sambutan Pimpinan')
@section('content')
<div class="card">
  <form action="{{ route('admin.leadership.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-grid">
      <div class="form-group">
        <label>Nama Pimpinan</label>
        <input type="text" name="name" value="{{ old('name', $leadership->name) }}" placeholder="Nama lengkap beserta gelar">
        @error('name')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group" style="align-self:end;">
        <label><input type="checkbox" name="show_name" value="1" style="width:auto;display:inline-block;" {{ old('show_name', $leadership->show_name ?? false) ? 'checked' : '' }}> Tampilkan nama</label>
        @error('show_name')<small class="error">{{ $message }}</small>@enderror
        <small>Nama cuma muncul di section Sambutan Pimpinan kalau kotak ini dicentang DAN kolom Nama di atas terisi.</small>
      </div>

      <div class="form-group">
        <label class="required">Jabatan (tampil di foto)</label>
        <input type="text" name="position" value="{{ old('position', $leadership->position ?? 'KEPALA PUSTEKINFO') }}" required>
      </div>

      <div class="form-group form-span-2">
        <label>Foto Pimpinan</label>
        @if($leadership->photo)
          <img src="{{ asset($leadership->photo) }}" style="width:160px;border-radius:8px;margin-bottom:10px;display:block;">
        @endif
        <input type="file" name="photo" accept="image/png" data-min-kb="2048" data-max-kb="10240">
        <small>Format PNG, ukuran 2–10 MB.</small>
        @error('photo')<small class="error">{{ $message }}</small>@enderror
        <small>Kosongkan jika tidak ingin mengganti foto.</small>
      </div>

      <div class="form-group">
        <label class="required">Judul Sambutan</label>
        <input type="text" name="welcome_title" value="{{ old('welcome_title', $leadership->welcome_title ?? 'Teknologi untuk pelayanan yang lebih baik') }}" required>
      </div>

      <div class="form-group">
        <label>Judul Sambutan (EN)</label>
        <input type="text" name="welcome_title_en" value="{{ old('welcome_title_en', $leadership->welcome_title_en) }}">
        <small>Opsional — kosongkan untuk memakai judul Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group form-span-2">
        <label class="required">Isi Sambutan</label>
        <textarea name="description" style="min-height:140px;" required>{{ old('description', $leadership->description) }}</textarea>
        @error('description')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group form-span-2">
        <label>Isi Sambutan (EN)</label>
        <textarea name="description_en" style="min-height:140px;">{{ old('description_en', $leadership->description_en) }}</textarea>
        <small>Opsional — kosongkan untuk memakai isi Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label class="required">Jabatan di Tanda Tangan</label>
        <input type="text" name="signature_role" value="{{ old('signature_role', $leadership->signature_role ?? 'Kepala Pusat Teknologi Informasi') }}" required>
      </div>

      <div class="form-group">
        <label>Jabatan di Tanda Tangan (EN)</label>
        <input type="text" name="signature_role_en" value="{{ old('signature_role_en', $leadership->signature_role_en) }}">
        <small>Opsional — kosongkan untuk memakai teks Bahasa Indonesia di atas.</small>
      </div>

      <div class="form-group">
        <label>Pendidikan</label>
        <input type="text" name="education" value="{{ old('education', $leadership->education) }}" placeholder="S2 Teknik Informatika">
      </div>

      <div class="form-group">
        <label>Pendidikan (EN)</label>
        <input type="text" name="education_en" value="{{ old('education_en', $leadership->education_en) }}" placeholder="M.Eng in Informatics">
      </div>

      <div class="form-group">
        <label>Masa Jabatan</label>
        <input type="text" name="term" value="{{ old('term', $leadership->term) }}" placeholder="2023 — sekarang">
      </div>

      <div class="form-group">
        <label>Masa Jabatan (EN)</label>
        <input type="text" name="term_en" value="{{ old('term_en', $leadership->term_en) }}" placeholder="2023 — present">
      </div>

      <div class="form-group">
        <label>Bidang Keahlian</label>
        <input type="text" name="expertise" value="{{ old('expertise', $leadership->expertise) }}" placeholder="Tata kelola TI & keamanan informasi">
      </div>

      <div class="form-group">
        <label>Bidang Keahlian (EN)</label>
        <input type="text" name="expertise_en" value="{{ old('expertise_en', $leadership->expertise_en) }}" placeholder="IT governance & information security">
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $leadership->email) }}" placeholder="kepala@pustekinfo.go.id">
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
@endsection