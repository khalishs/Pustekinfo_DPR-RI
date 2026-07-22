{{-- resources/views/admin/vision-mission/edit.blade.php --}}
@extends('admin.layout')
@section('title', 'Visi & Misi')
@section('content')
<div class="card">
  <form action="{{ route('admin.vision-mission.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Teks Visi</label>
      <textarea name="vision_text" style="min-height:100px;" required>{{ old('vision_text', $item->vision_text) }}</textarea>
      @error('vision_text')<small class="error">{{ $message }}</small>@enderror
    </div>

    <div class="form-group">
      <label>Poin-poin Misi</label>
      <textarea name="mission_items" style="min-height:160px;" required>{{ old('mission_items', $item->mission_items) }}</textarea>
      @error('mission_items')<small class="error">{{ $message }}</small>@enderror
      <small>Tulis satu poin misi per baris (tekan Enter untuk poin baru).</small>
    </div>

    <button class="btn btn-primary">Simpan</button>
  </form>
</div>
@endsection