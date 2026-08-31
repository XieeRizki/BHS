@extends('layouts.admin')
@section('title', 'Edit Item - ' . $item->title)
@section('content')

<a href="{{ route('admin.layanan-item.index', $layanan) }}" style="color: var(--neutral); font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1rem;">
    <i class="fas fa-arrow-left"></i> Kembali ke daftar item
</a>

<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0;">Edit Item</h1>
    <p style="font-size: 0.85rem; color: var(--neutral); margin: 0;">{{ $layanan->title }} — {{ $item->title }}</p>
</div>

<form action="{{ route('admin.layanan-item.update', [$layanan, $item]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.layanan-item._form', ['layanan' => $layanan, 'item' => $item])
</form>

@endsection
