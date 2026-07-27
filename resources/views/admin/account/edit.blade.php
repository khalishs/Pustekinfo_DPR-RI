@extends('admin.layout')
@section('title', 'Akun Saya')
@section('content')
<div class="card">
  <form action="{{ route('admin.account.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Username</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
      @error('name')<small class="error">{{ $message }}</small>@enderror
    </div>

    <hr style="border:none;border-top:1px solid var(--line);margin:24px 0;">

    <p style="font-size:13px;font-weight:700;color:var(--navy);margin-bottom:16px;">Ubah Password</p>
    <p style="font-size:12.5px;color:#8a97a0;margin-bottom:18px;margin-top:-10px;">Kosongkan bagian ini jika tidak ingin mengubah password.</p>

    <div class="form-group">
      <label>Password Saat Ini</label>
      <input type="password" name="current_password" autocomplete="current-password">
      @error('current_password')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Password Baru</label>
      <input type="password" name="password" autocomplete="new-password">
      @error('password')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Konfirmasi Password Baru</label>
      <input type="password" name="password_confirmation" autocomplete="new-password">
    </div>

    <button class="btn btn-primary">Simpan Perubahan</button>
  </form>
</div>
@endsection
