@extends('layouts.admin')
@section('title', 'Tambah Layanan')
@section('content')

<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0;">Tambah Layanan</h1>
    <p style="font-size: 0.85rem; color: var(--neutral); margin: 0;">Konten baru untuk section "Unit & Layanan" di homepage</p>
</div>

<form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.layanan._form')
</form>

@endsection