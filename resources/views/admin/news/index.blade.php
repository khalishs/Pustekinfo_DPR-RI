@extends('admin.layout')
@section('title', 'Berita')
@section('content')
<div class="page-head">
  <h2>Berita</h2>
  <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Tambah Berita</a>
</div>
<div class="card">
  <div class="table-responsive">
  <table>
    <thead><tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Utama</th><th>Tanggal</th><th></th></tr></thead>
    <tbody>
    @forelse($newsItems as $news)
      <tr>
        <td>
          @if($news->image)
            <img src="{{ asset('storage/'.$news->image) }}" style="width:60px;height:45px;object-fit:cover;border-radius:6px;">
          @else
            <span style="color:#b7c2c7;font-size:12px;">Tidak ada</span>
          @endif
        </td>
        <td>{{ $news->title }}</td>
        <td>{{ $news->category }}</td>
        <td>{{ $news->is_featured ? 'Ya' : '-' }}</td>
        <td>{{ $news->published_at?->format('d M Y') }}</td>
        <td class="row-actions">
          <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-outline">Edit</a>
          <form action="{{ route('admin.news.destroy', $news) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="6">Belum ada berita.</td></tr>
    @endforelse
    </tbody>
  </table>
  </div>
</div>
@endsection