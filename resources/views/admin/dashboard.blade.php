@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-header {
        margin-bottom: 2rem;
    }
    .dashboard-header h1 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 0.25rem;
        text-transform: uppercase;
    }
    .dashboard-header p {
        font-size: 0.9rem;
        color: #6B7280;
        margin: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }
    .stat-card {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
    }
    .stat-number {
        font-size: 2.25rem;
        font-weight: 900;
        color: #111827;
        line-height: 1;
    }
    .stat-label {
        font-size: 0.8rem;
        font-weight: 800;
        color: #9CA3AF;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.5rem;
    }

    .quick-access {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
    }
    .quick-access h3 {
        font-size: 1rem;
        font-weight: 800;
        color: #111827;
        margin: 0 0 1rem 0;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .qa-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .qa-btn {
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }
    .qa-primary {
        background: #EAB308;
        color: #0A0A0A;
        border: 1px solid #EAB308;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.25);
    }
    .qa-primary:hover {
        background: #CA8A04;
        border-color: #CA8A04;
        transform: translateY(-2px);
    }
    .qa-outline {
        background: #F9FAFB;
        color: #374151;
        border: 1px solid #D1D5DB;
    }
    .qa-outline:hover {
        background: #F3F4F6;
        border-color: #9CA3AF;
        transform: translateY(-2px);
    }

    .warning-box {
        background: #FEF3C7;
        border: 1px solid #FDE68A;
        border-left: 5px solid #D97706;
        border-radius: 16px;
        padding: 1.5rem;
    }
    .warning-title {
        font-size: 1rem;
        font-weight: 800;
        color: #92400E;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .warning-list {
        margin: 0;
        padding-left: 1.25rem;
        color: #B45309;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .warning-list li {
        margin-bottom: 0.35rem;
    }
    .warning-list a {
        color: #92400E;
        font-weight: 800;
        text-decoration: underline;
    }
</style>

<div class="dashboard-header">
    <h1>Dashboard</h1>
    <p>Selamat datang kembali, Admin!</p>
</div>

{{-- Ringkasan jumlah konten --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $stats['layanan_count'] ?? 0 }}</div>
        <div class="stat-label">Layanan Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['berita_count'] ?? 0 }}</div>
        <div class="stat-label">Berita Publish</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['testimoni_count'] ?? 0 }}</div>
        <div class="stat-label">Testimoni Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $stats['faq_count'] ?? 0 }}</div>
        <div class="stat-label">FAQ</div>
    </div>
</div>

{{-- Shortcut aksi cepat --}}
<div class="quick-access">
    <h3>Akses Cepat</h3>
    <div class="qa-buttons">
        <a href="{{ route('admin.layanan.create') }}" class="qa-btn qa-primary">
            <i class="fas fa-plus"></i> Tambah Layanan
        </a>
        <a href="{{ route('admin.informasi.create') }}" class="qa-btn qa-outline">
            <i class="fas fa-newspaper text-gray-400"></i> Tambah Berita
        </a>
        <a href="{{ route('admin.testimonials.create') }}" class="qa-btn qa-outline">
            <i class="fas fa-comment-dots text-gray-400"></i> Tambah Testimoni
        </a>
        <a href="{{ route('admin.contact.edit') }}" class="qa-btn qa-outline">
            <i class="fas fa-cog text-gray-400"></i> Kelola Info Kontak
        </a>
    </div>
</div>

{{-- Konten bolong (Modul Kosong) --}}
@if(!empty($emptyModules) && $emptyModules->isNotEmpty())
<div class="warning-box">
    <h3 class="warning-title">
        <i class="fas fa-exclamation-triangle"></i> Modul Belum Ada Konten Sama Sekali
    </h3>
    <ul class="warning-list">
        @foreach($emptyModules as $name => $m)
            <li>{{ $name }} — <a href="{{ $m['url'] }}">isi sekarang</a></li>
        @endforeach
    </ul>
</div>
@endif

@endsection