@extends('layouts.admin')
@section('title', 'Kelola Informasi & Berita')

@section('content')
<style>
    /* Header Halaman */
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

    .header-actions-group {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Tombol-tombol Utama */
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
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-bhs-outline:hover {
        background: #F9FAFB;
        border-color: #9CA3AF;
        color: #111827;
    }

    /* Tabel Card Container */
    .table-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #111827;
        color: #FFFFFF;
    }

    th {
        padding: 1rem;
        text-align: left;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid #E5E7EB;
        font-size: 0.875rem;
        vertical-align: middle;
        color: #374151;
    }

    tbody tr:hover {
        background: #FFFBEB;
    }

    .post-cell {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .post-cell img {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        object-fit: cover;
        border: 1px solid #E5E7EB;
        flex-shrink: 0;
    }

    .post-title {
        font-weight: 800;
        color: #111827;
        font-size: 0.9rem;
        line-height: 1.3;
    }

    .post-excerpt {
        font-size: 0.775rem;
        color: #6B7280;
        max-width: 280px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-top: 0.2rem;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        font-size: 0.675rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-right: 0.25rem;
        margin-bottom: 0.2rem;
    }

    .badge-berita { background: #EFF6FF; color: #2563EB; border: 1px solid #BFDBFE; }
    .badge-artikel { background: #F3E8FF; color: #7C3AED; border: 1px solid #DDD6FE; }
    .badge-spotlight { background: #FEF3C7; color: #B45309; border: 1px solid #FDE68A; }
    .badge-featured { background: #ECFDF5; color: #065F46; border: 1px solid #A7F3D0; }

    /* Action Icon Buttons */
    .action-group {
        display: flex;
        gap: 0.4rem;
        justify-content: center;
    }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        font-size: 0.8rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .btn-edit { background: #EFF6FF; color: #2563EB; border-color: #BFDBFE; }
    .btn-edit:hover { background: #2563EB; color: #FFFFFF; border-color: #2563EB; }

    .btn-delete { background: #FEF2F2; color: #DC2626; border-color: #FCA5A5; }
    .btn-delete:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    .empty-container {
        text-align: center;
        padding: 4rem 1.5rem;
    }

    /* Modal Component */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, 0.7);
        backdrop-filter: blur(4px);
        z-index: 2000;
        overflow-y: auto;
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 2rem;
        max-width: 480px;
        width: 90%;
        position: relative;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border: 1px solid #E5E7EB;
    }

    .modal-header {
        margin-bottom: 1.25rem;
    }

    .modal-header h2 {
        font-size: 1.15rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        text-transform: uppercase;
    }

    .modal-header p {
        font-size: 0.8rem;
        color: #6B7280;
        margin-top: 0.25rem;
    }

    .modal-close {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        background: #F3F4F6;
        border: none;
        font-size: 1.1rem;
        color: #4B5563;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .modal-close:hover {
        background: #DC2626;
        color: #FFFFFF;
    }

    .modal-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #D1D5DB;
        border-radius: 12px;
        font-size: 0.875rem;
        outline: none;
    }

    .modal-input:focus {
        border-color: #EAB308;
        box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.15);
    }

    @media (max-width: 768px) {
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .header-actions-group {
            width: 100%;
        }
        .header-actions-group .btn-bhs-primary,
        .header-actions-group .btn-bhs-outline {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<!-- Header Page -->
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Kelola Informasi & Berita</h1>
        <p class="admin-page-subtitle">Daftar semua berita kegiatan & artikel fitur BHS yang dipublikasikan</p>
    </div>
    <div class="header-actions-group">
        <a href="{{ route('admin.informasi.create') }}" class="btn-bhs-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Konten
        </a>
        <button type="button" class="btn-bhs-outline" onclick="openModal('categoryModal')">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41L13.42 20.58a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7" stroke-width="2.5" stroke-linecap="round"/></svg>
            Kelola Kategori
        </button>
    </div>
</div>

<!-- Table Container -->
<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Konten Detail</th>
                    <th>Kategori</th>
                    <th>Penempatan khusus</th>
                    <th>Tanggal Rilis</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>
                            <div class="post-cell">
                                <img src="{{ $post->cover_image ? asset('storage/'.$post->cover_image) : asset('images/bhs2.jpg') }}" alt="{{ $post->title }}">
                                <div>
                                    <span class="badge {{ $post->type === 'berita' ? 'badge-berita' : 'badge-artikel' }}">{{ $post->type }}</span>
                                    <div class="post-title">{{ $post->title }}</div>
                                    <div class="post-excerpt">{{ $post->excerpt ?: '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-weight: 700; color: #111827;">{{ $post->category->name ?? '-' }}</td>
                        <td>
                            @if($post->is_spotlight)<span class="badge badge-spotlight">Spotlight</span>@endif
                            @if($post->is_featured)<span class="badge badge-featured">Featured</span>@endif
                            @if(!$post->is_spotlight && !$post->is_featured)<span style="color: #9CA3AF; font-size: 0.8rem;">Biasa</span>@endif
                        </td>
                        <td style="font-size: 0.8rem; color: #6B7280; font-weight: 600;">
                            {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.informasi.edit', $post) }}" class="btn-icon btn-edit" title="Edit Konten">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.informasi.destroy', $post) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten ini?')" style="margin: 0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Hapus Konten">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 6h16z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-container">
                                <p style="color: #6B7280; font-size: 0.9rem; margin-bottom: 1.25rem;">Belum ada berita atau artikel yang ditambahkan.</p>
                                <a href="{{ route('admin.informasi.create') }}" class="btn-bhs-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                                    Tambah Konten Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($posts->hasPages())
        <div style="padding: 1.25rem; border-top: 1px solid #E5E7EB; display: flex; justify-content: center;">
            {{ $posts->links() }}
        </div>
    @endif
</div>

<!-- Modal Kelola Kategori -->
<div class="modal-overlay" id="categoryModal">
    <div class="modal-content">
        <button type="button" class="modal-close" onclick="closeModal('categoryModal')">✕</button>
        <div class="modal-header">
            <h2>Kelola Kategori</h2>
            <p>Tambah atau hapus kategori khusus artikel/berita BHS</p>
        </div>

        <form action="{{ route('admin.kategori.store') }}" method="POST" style="display:flex; gap:0.5rem; margin-bottom:1.5rem;">
            @csrf
            <input type="text" name="name" class="modal-input" placeholder="Nama kategori baru..." required>
            <button type="submit" class="btn-bhs-primary" style="padding: 0.75rem 1rem; border-radius: 12px; white-space: nowrap;">
                + Tambah
            </button>
        </form>

        <div style="max-height: 260px; overflow-y: auto; padding-right: 0.25rem;">
            @forelse($categories as $kategori)
                <div style="display:flex; justify-content:space-between; align-items:center; padding: 0.65rem 0; border-bottom: 1px solid #F3F4F6;">
                    <span style="font-size: 0.875rem; font-weight: 700; color: #111827;">
                        {{ $kategori->name }} 
                        <small style="color: #6B7280; font-weight: 500; margin-left: 0.25rem;">({{ $kategori->posts_count }} konten)</small>
                    </span>
                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')" style="margin:0;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" title="Hapus Kategori">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 6h16z"/></svg>
                        </button>
                    </form>
                </div>
            @empty
                <p style="color: #6B7280; font-size: 0.825rem; font-style: italic; text-align: center; margin-top: 1rem;">Belum ada kategori ditambahkan.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id)?.classList.add('active');
    }
    function closeModal(id) {
        document.getElementById(id)?.classList.remove('active');
    }
</script>
@endsection