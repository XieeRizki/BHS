@extends('layouts.admin')
@section('title', 'Tambah Layanan Baru')
@section('content')

<style>
    .admin-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #FFFFFF;
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .admin-page-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        text-transform: uppercase;
    }

    .admin-page-subtitle {
        font-size: 0.825rem;
        color: #6B7280;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    .btn-bhs-cancel {
        background: #FFFFFF;
        color: #4B5563;
        font-weight: 700;
        font-size: 0.825rem;
        text-transform: uppercase;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        text-decoration: none;
        border: 1px solid #D1D5DB;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
    }

    .btn-bhs-cancel:hover {
        background: #F9FAFB;
        color: #111827;
    }
</style>

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Tambah Layanan Baru</h1>
        <p class="admin-page-subtitle">Buat unit/layanan baru untuk ditampilkan pada section "Unit & Layanan" homepage</p>
    </div>
    <a href="{{ route('admin.layanan.index') }}" class="btn-bhs-cancel">
        Kembali
    </a>
</div>

<form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.layanan._form')
</form>

@endsection