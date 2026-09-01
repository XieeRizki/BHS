@extends('layouts.admin')
@section('title', 'Item - ' . $layanan->title)
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

    .header-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
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

    /* Buttons Style */
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

    /* Table Component */
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

    /* Action Buttons */
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

    .btn-view { background: #F3F4F6; color: #4B5563; border-color: #E5E7EB; }
    .btn-view:hover { background: #111827; color: #FFFFFF; border-color: #111827; }

    .btn-edit { background: #EFF6FF; color: #2563EB; border-color: #BFDBFE; }
    .btn-edit:hover { background: #2563EB; color: #FFFFFF; border-color: #2563EB; }

    .btn-delete { background: #FEF2F2; color: #DC2626; border-color: #FCA5A5; }
    .btn-delete:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    .empty-container {
        text-align: center;
        padding: 4rem 1.5rem;
    }

    @media (max-width: 768px) {
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .header-right {
            width: 100%;
            flex-direction: column;
        }
        .btn-bhs-primary, .btn-bhs-back {
            width: 100%;
            justify-content: center;
        }
        th, td { padding: 0.75rem; }
    }
</style>

<!-- Header Page Rapi Bersama Tombol Kembali -->
<div class="admin-page-header">
    <div class="header-left">
        <h1 class="admin-page-title">Item — {{ $layanan->title }}</h1>
        <p class="admin-page-subtitle">Daftar paket & menu detail milik unit layanan ini</p>
    </div>
    <div class="header-right">
        <a href="{{ route('admin.layanan.index') }}" class="btn-bhs-back">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
        <a href="{{ route('admin.layanan-item.create', $layanan) }}" class="btn-bhs-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Item
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Nama Item</th>
                    <th>Harga</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 130px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td class="image-cell">
                            <img src="{{ $item->cover ? asset('storage/'.$item->cover) : asset('images/bhs2.jpg') }}" alt="{{ $item->title }}">
                        </td>
                        <td class="title-cell">{{ $item->title }}</td>
                        <td style="font-weight: 700; color: #111827;">{{ $item->formatted_price ?? '-' }}</td>
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
                                <a href="{{ route('layanan-item.show', [$layanan, $item]) }}" target="_blank" class="btn-icon btn-view" title="Lihat Detail">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('admin.layanan-item.edit', [$layanan, $item]) }}" class="btn-icon btn-edit" title="Edit Item">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.layanan-item.destroy', [$layanan, $item]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')" style="margin: 0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 6h16z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-container">
                                <p style="color: #6B7280; font-size: 0.9rem; margin-bottom: 1.25rem;">Belum ada item untuk layanan ini.</p>
                                <a href="{{ route('admin.layanan-item.create', $layanan) }}" class="btn-bhs-primary">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                                    Tambah Item Pertama
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