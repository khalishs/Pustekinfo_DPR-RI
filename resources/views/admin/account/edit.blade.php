@extends('admin.layout')
@section('title', 'Akun Saya')
@section('content')
<div class="card">
  <div class="form-group">
    <label>Peran</label>
    @if($user->isSuperAdmin())
      <span class="badge-success">Super Admin</span>
    @else
      <span class="badge">User</span>
    @endif
  </div>

  <hr style="border:none;border-top:1px solid var(--line);margin:24px 0;">

  <form action="{{ route('admin.account.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label class="required">Username</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
      @error('name')<small class="error">{{ $message }}</small>@enderror
    </div>

    <small style="display:block;margin:-10px 0 18px;">Password mengikuti akun dan tidak dapat diubah melalui halaman ini.</small>

    <button class="btn btn-primary">Simpan Perubahan</button>
  </form>
</div>
@endsection
