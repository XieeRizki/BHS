@extends('layouts.admin')
@section('title', 'Kelola Layanan')
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

    /* Tombol Utama */
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

    /* Tabel Card Wrapper */
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

    .image-cell img {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E5E7EB;
    }

    .title-cell {
        font-weight: 800;
        color: #111827;
        font-size: 0.9rem;
    }

    .slug-cell {
        font-size: 0.75rem;
        color: #6B7280;
        font-family: monospace;
        margin-top: 0.15rem;
    }

    .desc-cell {
        color: #4B5563;
        max-width: 280px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.5;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .badge-active {
        background: #ECFDF5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }

    .badge-inactive {
        background: #F3F4F6;
        color: #6B7280;
        border: 1px solid #E5E7EB;
    }

    /* Action Group Buttons */
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

    .btn-view {
        background: #F3F4F6;
        color: #4B5563;
        border-color: #E5E7EB;
    }
    .btn-view:hover {
        background: #E5E7EB;
        color: #111827;
    }

    .btn-edit {
        background: #EFF6FF;
        color: #2563EB;
        border-color: #BFDBFE;
    }
    .btn-edit:hover {
        background: #2563EB;
        color: #FFFFFF;
        border-color: #2563EB;
    }

    .btn-delete {
        background: #FEF2F2;
        color: #DC2626;
        border-color: #FCA5A5;
    }
    .btn-delete:hover {
        background: #DC2626;
        color: #FFFFFF;
        border-color: #DC2626;
    }

    .empty-container {
        text-align: center;
        padding: 4rem 1.5rem;
    }

    .empty-icon {
        color: #D1D5DB;
        margin-bottom: 1rem;
        display: flex;
        justify-content: center;
    }

    .empty-text {
        color: #6B7280;
        font-size: 0.95rem;
        margin: 0 0 1.5rem 0;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .btn-bhs-primary {
            width: 100%;
            justify-content: center;
        }
        th, td {
            padding: 0.75rem;
        }
    }
</style>

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Kelola Layanan</h1>
        <p class="admin-page-subtitle">Konten "Unit & Layanan" (Hotel, Villa, Food & Beverage, dst) yang tampil di homepage BHS</p>
    </div>
    <a href="{{ route('admin.layanan.create') }}" class="btn-bhs-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Layanan
    </a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul & URL</th>
                    <th>Deskripsi Singkat</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 140px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $item)
                    <tr>
                        <td class="image-cell">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/bhs2.jpg') }}" alt="{{ $item->title }}">
                        </td>
                        <td>
                            <div class="title-cell">{{ $item->title }}</div>
                            <div class="slug-cell">/layanan/{{ $item->slug }}</div>
                        </td>
                        <td class="desc-cell">{{ $item->short_description }}</td>
                        <td style="font-weight: 700;">{{ $item->order }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="badge badge-active">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Aktif
                                </span>
                            @else
                                <span class="badge badge-inactive">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('layanan.show', $item->slug) }}" target="_blank" class="btn-icon btn-view" title="Lihat Halaman Detail">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.layanan.edit', $item) }}" class="btn-icon btn-edit" title="Edit Layanan">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus layanan ini? Semua foto terkait (gambar utama, galeri, QR, icon) akan ikut terhapus.')" style="margin: 0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6"/>
                                            <path d="M14 11v6"/>
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-container">
                                <div class="empty-icon">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 2l1.9 5.8a2 2 0 0 0 1.3 1.3L21 11l-5.8 1.9a2 2 0 0 0-1.3 1.3L12 20l-1.9-5.8a2 2 0 0 0-1.3-1.3L3 11l5.8-1.9a2 2 0 0 0 1.3-1.3L12 2Z"/>
                                    </svg>
                                </div>
                                <p class="empty-text">Belum Ada Layanan Yang Dibuat</p>
                                <a href="{{ route('admin.layanan.create') }}" class="btn-bhs-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Tambah Layanan Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection