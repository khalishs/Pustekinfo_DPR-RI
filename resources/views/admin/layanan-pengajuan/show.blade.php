{{-- resources/views/admin/layanan-pengajuan/show.blade.php --}}
@extends('admin.layout')
@section('title', 'Detail Pengajuan')
@section('content')
<div class="page-head">
  <h2>Pengajuan dari {{ $serviceRequest->nama }}</h2>
</div>
<div class="card">
  <div class="form-grid">
    <div class="form-group">
      <label>Kode Pengajuan</label>
      <p>{{ $serviceRequest->kode }}</p>
    </div>
    <div class="form-group">
      <label>Nama</label>
      <p>{{ $serviceRequest->nama }}</p>
    </div>
    <div class="form-group">
      <label>Email</label>
      <p>{{ $serviceRequest->email }}</p>
    </div>
    <div class="form-group">
      <label>No. Telepon</label>
      <p>{{ $serviceRequest->no_tlpn }}</p>
    </div>
    @if($serviceRequest->instansi)
    <div class="form-group">
      <label>Instansi</label>
      <p>{{ $serviceRequest->instansi }}</p>
    </div>
    @endif
    <div class="form-group">
      <label>Jenis Layanan</label>
      <p>{{ $serviceRequest->jenis_layanan }}</p>
    </div>
    <div class="form-group">
      <label>Tanggal Pengajuan</label>
      <p>{{ $serviceRequest->created_at->format('d M Y H:i') }}</p>
    </div>
    <div class="form-group">
      <label>Status Saat Ini</label>
      <p>@include('admin.layanan-pengajuan._status-badge', ['status' => $serviceRequest->status])</p>
    </div>
    <div class="form-group form-span-2">
      <label>Pesan</label>
      <p style="white-space:pre-line;">{{ $serviceRequest->pesan }}</p>
    </div>
  </div>

  <form action="{{ route('admin.layanan-pengajuan.update', $serviceRequest) }}" method="POST">
    @csrf @method('PUT')

    <div class="form-grid">
      <div class="form-group">
        <label for="status">Perbarui Status</label>
        <select id="status" name="status">
          @foreach(\App\Models\ServiceRequest::STATUSES as $value => $label)
            <option value="{{ $value }}" @selected($serviceRequest->status === $value)>{{ $label }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group form-span-2">
        <label for="catatan_admin">Catatan Admin</label>
        <textarea id="catatan_admin" name="catatan_admin" rows="4" placeholder="Catatan ini akan terlihat oleh pemohon di halaman cek status.">{{ old('catatan_admin', $serviceRequest->catatan_admin) }}</textarea>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Simpan Status</button>
    </div>
  </form>

  <div style="margin-top:20px;">
    <a href="{{ route('admin.layanan-pengajuan.index') }}" class="btn btn-outline">Kembali</a>
    <form action="{{ route('admin.layanan-pengajuan.destroy', $serviceRequest) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus pengajuan ini?')">
      @csrf @method('DELETE')
      <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
        <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
      </button>
    </form>
  </div>
</div>
@endsection
