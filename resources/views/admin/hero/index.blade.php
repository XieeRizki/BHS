@extends('layouts.admin')

@section('title', 'Kelola Hero Banner')

@section('content')
<style>
    /* Styling Header Halaman */
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
        letter-spacing: -0.01em;
    }

    .admin-page-subtitle {
        font-size: 0.825rem;
        color: #6B7280;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    /* Tombol Aksi */
    .btn-bhs-primary {
        background: #EAB308;
        color: #0A0A0A;
        font-weight: 800;
        font-size: 0.825rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2);
    }

    .btn-bhs-primary:hover {
        background: #CA8A04;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(234, 179, 8, 0.3);
    }

    .btn-bhs-outline {
        background: #FFFFFF;
        color: #374151;
        font-weight: 700;
        font-size: 0.825rem;
        text-transform: uppercase;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        text-decoration: none;
        border: 1px solid #D1D5DB;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-bhs-outline:hover {
        background: #F9FAFB;
        border-color: #9CA3AF;
        color: #111827;
    }

    .btn-bhs-danger {
        background: #FEF2F2;
        color: #DC2626;
        font-weight: 700;
        font-size: 0.825rem;
        text-transform: uppercase;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        border: 1px solid #FCA5A5;
        cursor: pointer;
        width: 100%;
        transition: all 0.2s ease;
    }

    .btn-bhs-danger:hover {
        background: #DC2626;
        color: #FFFFFF;
        border-color: #DC2626;
    }

    /* Container Card Utama */
    .bhs-card {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    /* Layout Content Grid */
    .hero-overview-grid {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 0;
    }

    .hero-media-preview {
        position: relative;
        background: #111827;
        min-height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-media-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slide-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(17, 24, 39, 0.85);
        backdrop-filter: blur(4px);
        color: #EAB308;
        border: 1px solid rgba(234, 179, 8, 0.3);
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .hero-details {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .hero-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #111827;
        margin: 0 0 0.5rem 0;
        line-height: 1.3;
    }

    .hero-subtitle {
        font-size: 0.9rem;
        color: #4B5563;
        line-height: 1.6;
        margin: 0 0 1.5rem 0;
    }

    .meta-pills-wrapper {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .meta-pill {
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        padding: 0.5rem 0.85rem;
        border-radius: 10px;
        font-size: 0.75rem;
        color: #374151;
        font-weight: 600;
    }

    .meta-pill strong {
        color: #111827;
        font-weight: 800;
    }

    /* Info Box Tips */
    .bhs-info-box {
        background: #FFFBEB;
        border: 1px solid #FDE68A;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        margin-top: 1.5rem;
    }

    .bhs-info-title {
        font-size: 0.85rem;
        font-weight: 800;
        color: #92400E;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0 0 0.5rem 0;
    }

    .bhs-info-list {
        margin: 0;
        padding-left: 1.2rem;
        color: #B45309;
        font-size: 0.825rem;
        line-height: 1.6;
    }

    /* Alert Success / Danger */
    .bhs-alert {
        padding: 1rem 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .bhs-alert-success {
        background: #ECFDF5;
        border: 1px solid #A7F3D0;
        color: #065F46;
    }

    .bhs-alert-error {
        background: #FEF2F2;
        border: 1px solid #FCA5A5;
        color: #991B1B;
    }

    /* Responsive Handling */
    @media (max-width: 992px) {
        .hero-overview-grid {
            grid-template-columns: 1fr;
        }

        .hero-media-preview {
            height: 220px;
        }
    }

    @media (max-width: 640px) {
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .admin-page-header .btn-bhs-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Alert Notifications -->
@if (session('success'))
    <div class="bhs-alert bhs-alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bhs-alert bhs-alert-error">
        {{ session('error') }}
    </div>
@endif

<!-- Header Section -->
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Kelola Hero Banner</h1>
        <p class="admin-page-subtitle">Atur judul, deskripsi, tombol CTA, dan gambar slideshow utama website BHS</p>
    </div>
</div>

<!-- Main Content Area -->
@if($hero)
    <div class="bhs-card">
        <div class="hero-overview-grid">
            <!-- Left Column: Image Preview -->
            <div class="hero-media-preview">
                @if($hero->images && $hero->images->count() > 0)
                    <img src="{{ asset('storage/' . $hero->images->first()->image) }}" alt="Slider Banner BHS">
                    <div class="slide-badge">{{ $hero->images->count() }} Slide Foto Aktif</div>
                @elseif($hero->image)
                    <img src="{{ asset('storage/' . $hero->image) }}" alt="Banner Fallback BHS">
                    <div class="slide-badge">1 Gambar Single</div>
                @else
                    <div style="color: #6B7280; font-size: 0.825rem; font-weight: 600;">Belum Ada File Gambar</div>
                @endif
            </div>

            <!-- Right Column: Banner Details -->
            <div class="hero-details">
                <div>
                    <h2 class="hero-title">{{ $hero->title ?? 'Tanpa Judul' }}</h2>
                    <p class="hero-subtitle">{{ $hero->subtitle ?? 'Belum ada subtitle yang ditambahkan.' }}</p>

                    <div class="meta-pills-wrapper">
                        <div class="meta-pill">
                            Button CTA: <strong>{{ $hero->button_text ?: 'Tidak Aktif' }}</strong>
                        </div>
                        <div class="meta-pill">
                            Link CTA: <strong>{{ $hero->button_link ?: '—' }}</strong>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 0.75rem; border-top: 1px solid #F3F4F6; pt-4; margin-top: 1rem; padding-top: 1.25rem;">
                    <a href="{{ route('admin.hero.edit') }}" class="btn-bhs-outline" style="flex: 2; justify-content: center;">
                        Ubah Konten
                    </a>
                    <form action="{{ route('admin.hero.delete') }}" method="POST" style="flex: 1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-bhs-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus seluruh data Hero Banner ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="bhs-card" style="text-align: center; padding: 4rem 1.5rem;">
        <div style="width: 64px; height: 64px; background: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: #D97706; font-weight: 900; font-size: 1.25rem;">
            !
        </div>
        <h3 style="font-size: 1.1rem; font-weight: 800; color: #111827; margin: 0 0 0.5rem 0;">Hero Banner Belum Dibuat</h3>
        <p style="color: #6B7280; font-size: 0.875rem; max-width: 420px; margin: 0 auto 1.5rem auto; line-height: 1.5;">
            Tampilkan sambutan terbaik untuk pengunjung website Balong Hardi Sumedang dengan membuat hero banner.
        </p>
        <a href="{{ route('admin.hero.edit') }}" class="btn-bhs-primary">
            Buat Hero Banner Sekarang
        </a>
    </div>
@endif

<!-- Guide Info Box -->
<div class="bhs-info-box">
    <div class="bhs-info-title">Petunjuk Pengelolaan Hero Banner</div>
    <ul class="bhs-info-list">
        <li>Rekomendasi rasio gambar banner adalah <strong>16:9</strong> atau resolusi minimal <strong>1920x1080px</strong> agar tidak pecah di layar desktop/HP.</li>
        <li>Jika mengunggah lebih dari 1 foto pada galeri slideshow, background landing page akan berganti otomatis secara berkala.</li>
        <li>Teks tombol CTA sebaiknya singkat dan jelas (misal: <em>Reservasi Lapak</em>, <em>Lihat Fasilitas</em>).</li>
    </ul>
</div>
@endsection