{{-- resources/views/admin/messages/show.blade.php --}}
@extends('admin.layout')
@section('title', 'Detail Pesan')
@section('content')
<div class="page-head">
  <h2>Pesan dari {{ $message->nama }}</h2>
</div>
<div class="card">
  <div class="form-grid">
    <div class="form-group">
      <label>Nama</label>
      <p>{{ $message->nama }}</p>
    </div>
    <div class="form-group">
      <label>Email</label>
      <p>{{ $message->email }}</p>
    </div>
    @if($message->instansi)
    <div class="form-group">
      <label>Instansi</label>
      <p>{{ $message->instansi }}</p>
    </div>
    @endif
    <div class="form-group">
      <label>Kategori</label>
      <p><span class="badge cap">{{ $message->kategori }}</span></p>
    </div>
    <div class="form-group">
      <label>Tanggal Kirim</label>
      <p>{{ $message->created_at->format('d M Y H:i') }}</p>
    </div>
    <div class="form-group form-span-2">
      <label>Pesan</label>
      <p style="white-space:pre-line;">{{ $message->pesan }}</p>
    </div>
  </div>

  <a href="{{ route('admin.messages.index') }}" class="btn btn-outline">Kembali</a>
  <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline-block;" data-confirm="Hapus pesan ini?">
    @csrf @method('DELETE')
    <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
      <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
    </button>
  </form>
</div>
@endsection
