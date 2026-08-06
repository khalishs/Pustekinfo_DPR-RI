{{-- resources/views/admin/users/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Manajemen Akun')
@section('content')
<div class="page-head">
  <h2>Manajemen Akun</h2>
  <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah Akun</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Nama</th><th>Role</th><th></th></tr></thead>
    <tbody>
    @forelse($users as $userAccount)
      <tr>
        <td>{{ $userAccount->name }}</td>
        <td>
          @if($userAccount->isSuperAdmin())
            <span class="badge" style="background:rgba(201,163,78,.14);color:var(--gold);border-color:rgba(201,163,78,.25);">Super Admin</span>
          @else
            <span class="badge">User</span>
          @endif
        </td>
        <td class="row-actions">
          <a href="{{ route('admin.users.edit', $userAccount) }}" class="btn btn-outline">Edit</a>
          @if($userAccount->id !== auth()->id())
            <form action="{{ route('admin.users.destroy', $userAccount) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
              @csrf @method('DELETE')
              <button class="btn btn-danger">Hapus</button>
            </form>
          @endif
        </td>
      </tr>
    @empty
      <tr><td colspan="3">Belum ada akun.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
