{{-- resources/views/admin/layanan-pengajuan/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Pengajuan Layanan')
@section('content')
<div class="page-head">
  <h2>Pengajuan Layanan</h2>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Kode</th><th>Nama</th><th>No. Telepon</th><th>Jenis Layanan</th><th>Tanggal</th><th class="text-center">Status</th><th></th></tr></thead>
    <tbody>
    @forelse($requests as $req)
      <tr>
        <td>{{ $req->kode }}</td>
        <td>{{ $req->nama }}</td>
        <td>{{ $req->no_tlpn }}</td>
        <td>{{ $req->jenis_layanan }}</td>
        <td>{{ $req->created_at->format('d M Y H:i') }}</td>
        <td class="text-center">@include('admin.layanan-pengajuan._status-badge', ['status' => $req->status])</td>
        <td class="row-actions">
          <a href="{{ route('admin.layanan-pengajuan.show', $req) }}" class="btn btn-outline">Lihat</a>
          <form action="{{ route('admin.layanan-pengajuan.destroy', $req) }}" method="POST" onsubmit="return confirm('Hapus pengajuan ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7">Belum ada pengajuan layanan.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
