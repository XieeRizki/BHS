@extends('layouts.admin')
@section('title', 'Tambah Item - ' . $layanan->title)
@section('content')

<style>
    /* Header Page */
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

    .header-left {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .admin-page-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: -0.01em;
    }

    .admin-page-subtitle {
        font-size: 0.825rem;
        color: #6B7280;
        margin: 0;
        font-weight: 500;
    }

    /* Button Back Style (Sama Seperti Index) */
    .btn-bhs-back {
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
        gap: 0.4rem;
        transition: all 0.2s ease;
    }

    .btn-bhs-back:hover {
        background: #F9FAFB;
        color: #111827;
    }

    @media (max-width: 768px) {
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .btn-bhs-back {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Header Page Rapi Bersama Tombol Kembali -->
<div class="admin-page-header">
    <div class="header-left">
        <h1 class="admin-page-title">Tambah Item</h1>
        <p class="admin-page-subtitle">Unit Layanan: <strong>{{ $layanan->title }}</strong></p>
    </div>
    <div>
        <a href="{{ route('admin.layanan-item.index', $layanan) }}" class="btn-bhs-back">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>
</div>

<form action="{{ route('admin.layanan-item.store', $layanan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.layanan-item._form')
</form>

@endsection