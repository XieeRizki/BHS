@extends('layouts.admin')
@section('title', 'Tambah Item - ' . $layanan->title)
@section('content')

<a href="{{ route('admin.layanan-item.index', $layanan) }}" style="color: var(--neutral); font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1rem;">
    <i class="fas fa-arrow-left"></i> Kembali ke daftar item
</a>

<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0;">Tambah Item</h1>
    <p style="font-size: 0.85rem; color: var(--neutral); margin: 0;">Untuk layanan: {{ $layanan->title }}</p>
</div>

<form action="{{ route('admin.layanan-item.store', $layanan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.layanan-item._form')
</form>

@endsection
