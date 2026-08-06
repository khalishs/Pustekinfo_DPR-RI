{{-- resources/views/admin/users/form.blade.php --}}
@extends('admin.layout')
@section('title', $userAccount->exists ? 'Edit Akun' : 'Tambah Akun')
@section('content')
<div class="card">
  <form action="{{ $userAccount->exists ? route('admin.users.update', $userAccount) : route('admin.users.store') }}" method="POST">
    @csrf
    @if($userAccount->exists) @method('PUT') @endif

    <div class="form-grid">
      <div class="form-group">
        <label class="required">Nama</label>
        <input type="text" name="name" value="{{ old('name', $userAccount->name) }}" required>
        @error('name')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label class="required">Role</label>
        <select name="role" required>
          @foreach(\App\Models\User::ROLES as $value => $label)
            <option value="{{ $value }}" {{ old('role', $userAccount->role) == $value ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
        </select>
        @error('role')<small class="error">{{ $message }}</small>@enderror
      </div>

      <div class="form-group">
        <label class="{{ $userAccount->exists ? '' : 'required' }}">Password</label>
        <input type="password" name="password" {{ $userAccount->exists ? '' : 'required' }}>
        @error('password')<small class="error">{{ $message }}</small>@enderror
        @if($userAccount->exists)<small>Kosongkan jika tidak ingin mengganti password.</small>@endif
      </div>

      <div class="form-group">
        <label class="{{ $userAccount->exists ? '' : 'required' }}">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" {{ $userAccount->exists ? '' : 'required' }}>
      </div>
    </div>

    <div class="form-actions">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Batal</a>
    </div>
  </form>
</div>
@endsection
