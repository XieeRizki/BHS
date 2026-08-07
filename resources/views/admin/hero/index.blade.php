@extends('layouts.admin')

@section('title', 'Kelola Hero Banner')

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: white;
        border-radius: 10px;
        border: 1px solid var(--border);
    }

    .page-header-left h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin: 0;
    }

    .page-header-left p {
        font-size: 0.85rem;
        color: var(--neutral);
        margin: 0.3rem 0 0 0;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        padding: 0.85rem 1.5rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.15s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
    }

    .hero-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .hero-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.15s ease;
    }

    .hero-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }

    .hero-card-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: var(--bg-light);
    }

    .hero-card-image-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .hero-card-content {
        padding: 1.25rem;
    }

    .hero-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--secondary);
        margin: 0 0 0.5rem 0;
        word-break: break-word;
    }

    .hero-card-subtitle {
        font-size: 0.85rem;
        color: var(--neutral);
        margin: 0 0 1rem 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hero-card-meta {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .meta-badge {
        background: rgba(249, 115, 22, 0.1);
        color: var(--primary-dark);
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .hero-card-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .hero-card-actions a,
    .hero-card-actions button {
        flex: 1;
        padding: 0.65rem;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: all 0.15s ease;
    }

    .btn-edit {
        background: rgba(249, 115, 22, 0.15);
        color: var(--primary-dark);
        border: 1px solid rgba(249, 115, 22, 0.3);
    }

    .btn-edit:hover {
        background: rgba(249, 115, 22, 0.25);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.15);
        color: #991b1b;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.25);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        background: white;
        border: 2px dashed var(--border);
        border-radius: 10px;
    }

    .empty-state-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        color: var(--neutral);
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .alert {
        padding: 1rem 1.25rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #047857;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #991b1b;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .hero-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Alert Messages -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-left">
        <h1>Kelola Hero Banner</h1>
        <p>Atur banner utama yang ditampilkan di halaman depan website</p>
    </div>
    <a href="{{ route('admin.hero.edit') }}" class="btn-primary">
        Edit Hero Banner
    </a>
</div>

<!-- Hero Banner Card -->
@if($hero)
    <div class="hero-grid">
        <div class="hero-card">
            @if($hero->image)
                <img src="{{ asset('storage/' . $hero->image) }}" alt="{{ $hero->title }}" class="hero-card-image">
            @else
                <div class="hero-card-image-placeholder">
                    Belum ada gambar
                </div>
            @endif

            <div class="hero-card-content">
                <h3 class="hero-card-title">{{ $hero->title ?? 'Tanpa Judul' }}</h3>
                <p class="hero-card-subtitle">{{ $hero->subtitle ?? 'Belum ada deskripsi' }}</p>

                <div class="hero-card-meta">
                    @if($hero->button_text)
                        <span class="meta-badge">CTA: {{ $hero->button_text }}</span>
                    @endif
                    @if($hero->images && $hero->images->count() > 0)
                        <span class="meta-badge">{{ $hero->images->count() }} Slide</span>
                    @endif
                </div>

                {{-- TODO backend: tabel hero_stats belum ada di database.
                     Aktifkan blok ini kalau migration + model HeroStat sudah dibuat,
                     dan tambahin juga input-nya di form edit.blade.php --}}

                <div class="hero-card-actions">
                    <a href="{{ route('admin.hero.edit') }}" class="btn-edit">Edit</a>
                    <form action="{{ route('admin.hero.delete') }}" method="POST" style="flex: 1; display: flex;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus hero banner ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="empty-state">
        <h3 class="empty-state-title">Belum Ada Hero Banner</h3>
        <p class="empty-state-text">Buat hero banner pertama Anda untuk menampilkan konten utama di halaman depan website.</p>
        <a href="{{ route('admin.hero.edit') }}" class="btn-primary">Buat Hero Banner</a>
    </div>
@endif

<!-- Info Box -->
<div style="margin-top: 2rem; background: rgba(59, 130, 246, 0.05); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 8px; padding: 1.25rem;">
    <h4 style="margin: 0 0 0.75rem 0; color: var(--secondary);">Informasi</h4>
    <ul style="margin: 0; padding-left: 1.5rem; color: var(--neutral); font-size: 0.9rem;">
        <li>Hero banner adalah konten utama yang pertama kali dilihat pengunjung</li>
        <li>Gunakan gambar berkualitas tinggi dengan ukuran minimal 1920x600px</li>
        <li>Upload beberapa foto slideshow agar background berganti otomatis di halaman depan</li>
        <li>Button CTA membantu pengunjung untuk langsung melakukan aksi yang diinginkan</li>
    </ul>
</div>

@endsection