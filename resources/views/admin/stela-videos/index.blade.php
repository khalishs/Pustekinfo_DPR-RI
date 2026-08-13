{{-- resources/views/admin/stela-videos/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Video Sekilas STELA')
@section('content')
<div class="page-head">
  <div>
    <h2>Video Sekilas STELA</h2>
    <small>{{ $items->count() }} / {{ $maxItems }} video terpakai — tampil di section "Sekilas STELA" pada halaman Ajukan Layanan.</small>
  </div>
  @if($items->count() < $maxItems)
    <a href="{{ route('admin.stela-videos.create') }}" class="btn btn-primary">+ Tambah Video</a>
  @endif
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Preview</th><th>Sumber</th><th>Link STELA</th><th></th></tr></thead>
    <tbody>
    @forelse($items as $item)
      <tr>
        <td>
          @if($item->video_type === 'youtube')
            <span style="color:#8a97a0;font-size:12px;">YouTube: {{ \Illuminate\Support\Str::limit($item->youtube_url, 40) }}</span>
          @elseif($item->video)
            <video src="{{ asset($item->video) }}" style="width:120px;height:68px;object-fit:cover;border-radius:8px;background:#000;" muted></video>
          @else
            <span style="color:#b7c2c7;font-size:12px;">Belum ada</span>
          @endif
        </td>
        <td>{{ $item->video_type === 'youtube' ? 'Link YouTube' : 'Upload MP4' }}</td>
        <td>{{ $item->link_url ?: 'https://stela.dpr.go.id (default)' }}</td>
        <td class="row-actions">
          <a href="{{ route('admin.stela-videos.edit', $item) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          <form action="{{ route('admin.stela-videos.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus video ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="4">Belum ada video.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
