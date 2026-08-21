@extends('layouts.admin')
@section('title', 'Edit - ' . $layanan->title)
@section('content')

<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0;">Edit Layanan</h1>
    <p style="font-size: 0.85rem; color: var(--neutral); margin: 0;">{{ $layanan->title }}</p>
</div>

<form action="{{ route('admin.layanan.update', $layanan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.layanan._form', ['layanan' => $layanan])
</form>

@endsection