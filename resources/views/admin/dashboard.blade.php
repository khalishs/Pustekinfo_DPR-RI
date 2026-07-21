{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layout')
@section('content')
<h1>Dashboard</h1>
<div class="card">
  <p>Selamat datang, {{ auth()->user()->name }}.</p>
</div>
@endsection