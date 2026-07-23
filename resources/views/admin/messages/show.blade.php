{{-- resources/views/admin/messages/show.blade.php --}}
@extends('admin.layout')
@section('title', 'Detail Pesan')
@section('content')
<div class="page-head">
  <h2>Pesan dari {{ $message->nama }}</h2>
</div>
<div class="card">
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
  <div class="form-group" style="max-width:100%;">
    <label>Pesan</label>
    <p style="white-space:pre-line;">{{ $message->pesan }}</p>
  </div>

  <a href="{{ route('admin.messages.index') }}" class="btn btn-outline">Kembali</a>
  <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus pesan ini?')">
    @csrf @method('DELETE')
    <button class="btn btn-danger">Hapus</button>
  </form>
</div>
@endsection
