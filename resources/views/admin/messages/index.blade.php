{{-- resources/views/admin/messages/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Pesan Masuk')
@section('content')
<div class="page-head">
  <h2>Pesan Masuk</h2>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Nama</th><th>Email</th><th>Kategori</th><th>Tanggal</th><th class="text-center">Status</th><th></th></tr></thead>
    <tbody>
    @forelse($messages as $message)
      <tr>
        <td>{{ $message->nama }}</td>
        <td>{{ $message->email }}</td>
        <td><span class="badge cap">{{ $message->kategori }}</span></td>
        <td>{{ $message->created_at->format('d M Y H:i') }}</td>
        <td class="text-center">{!! $message->is_read ? '<span class="badge-muted">Dibaca</span>' : '<span class="badge-success">Baru</span>' !!}</td>
        <td class="row-actions">
          <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-outline">Lihat</a>
          <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada pesan masuk.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
