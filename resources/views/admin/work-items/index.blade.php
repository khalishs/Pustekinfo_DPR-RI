{{-- resources/views/admin/work-items/index.blade.php --}}
@extends('admin.layout')
@section('title', 'Apa yang Kami Kerjakan')
@section('content')
<div class="page-head">
  <div>
    <h2>Card "Apa yang Kami Kerjakan"</h2>
    <small>{{ $items->count() }} / {{ $maxItems }} card terpakai</small>
  </div>
  @if($items->count() < $maxItems)
    <a href="{{ route('admin.work-items.create') }}" class="btn btn-primary">+ Tambah Card</a>
  @endif
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Ikon</th><th>Judul</th><th>Deskripsi</th><th class="text-center">Baris</th><th class="text-center">Urutan</th><th class="text-center">Aktif</th><th></th></tr></thead>
    <tbody>
    @forelse($items as $item)
      <tr>
        <td>
          <span style="display:inline-flex;width:32px;height:32px;align-items:center;justify-content:center;border-radius:8px;background:#f1f4f5;color:#073D5F;">
            <span style="width:18px;height:18px;display:block;">{!! $item->iconSvg() !!}</span>
          </span>
        </td>
        <td>{{ $item->title }}</td>
        <td>{{ \Illuminate\Support\Str::limit($item->description, 70) }}</td>
        <td class="text-center"><span class="badge-count">{{ $item->row_position == 1 ? 'Atas' : 'Bawah' }}</span></td>
        <td class="text-center"><span class="badge-count">{{ $item->sort_order }}</span></td>
        <td class="text-center">
          @if($item->is_active)
            <span class="badge-count" style="background:#e3f6ea;color:#1a7a3e;border-color:#1a7a3e;">Aktif</span>
          @else
            <span class="badge-count">Nonaktif</span>
          @endif
        </td>
        <td class="row-actions">
          <a href="{{ route('admin.work-items.edit', $item) }}" class="btn-icon btn-icon-edit" title="Edit" aria-label="Edit">
            <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </a>
          @if($items->count() < $maxItems)
            <form action="{{ route('admin.work-items.duplicate', $item) }}" method="POST">
              @csrf
              <button class="btn-icon btn-icon-copy" title="Salin" aria-label="Salin">
                <svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              </button>
            </form>
          @endif
          <form action="{{ route('admin.work-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus card ini?')">
            @csrf @method('DELETE')
            <button class="btn-icon btn-icon-delete" title="Hapus" aria-label="Hapus">
              <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="7">Belum ada card.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection
