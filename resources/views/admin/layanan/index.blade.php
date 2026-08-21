@extends('layouts.admin')
@section('title', 'Kelola Layanan')
@section('content')

<style>
    .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap; }
    .section-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0; }
    .section-header-desc { font-size: 0.85rem; color: var(--neutral); margin: 0; }

    .btn-create {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white; padding: 0.7rem 1.5rem; border: none; border-radius: 8px;
        font-weight: 600; font-size: 0.9rem; cursor: pointer; text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s ease; white-space: nowrap;
    }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3); }

    .table-card { background: white; border-radius: 10px; border: 1px solid var(--border); overflow: hidden; }
    .table-responsive { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: linear-gradient(135deg, var(--secondary) 0%, #111827 100%); color: white; }
    th { padding: 0.9rem; text-align: left; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
    td { padding: 0.9rem; border-bottom: 1px solid var(--border); font-size: 0.9rem; vertical-align: middle; }
    tbody tr:hover { background: rgba(249, 115, 22, 0.03); }

    .image-cell img { width: 56px; height: 56px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border); }
    .title-cell { font-weight: 600; color: var(--secondary); }
    .slug-cell { font-size: 0.75rem; color: var(--neutral); font-family: monospace; }
    .desc-cell { color: var(--neutral); max-width: 280px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }

    .badge { display: inline-block; padding: 0.4rem 0.75rem; border-radius: 5px; font-size: 0.8rem; font-weight: 600; }
    .badge-active { background: rgba(16, 185, 129, 0.15); color: #047857; }
    .badge-inactive { background: rgba(107, 114, 128, 0.15); color: var(--neutral); }

    .action-group { display: flex; gap: 0.5rem; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 0.8rem; border: 1px solid; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer; text-decoration: none; }
    .btn-view { background: rgba(107, 114, 128, 0.1); color: var(--neutral); border-color: rgba(107, 114, 128, 0.2); }
    .btn-view:hover { background: rgba(107, 114, 128, 0.15); }
    .btn-edit { background: rgba(59, 130, 246, 0.1); color: #3B82F6; border-color: rgba(59, 130, 246, 0.2); }
    .btn-edit:hover { background: rgba(59, 130, 246, 0.15); }
    .btn-delete { background: rgba(239, 68, 68, 0.1); color: #EF4444; border-color: rgba(239, 68, 68, 0.2); }
    .btn-delete:hover { background: rgba(239, 68, 68, 0.15); }

    .empty-container { text-align: center; padding: 3rem 1.5rem; }
    .empty-icon { font-size: 3rem; color: #D1D5DB; margin-bottom: 1rem; }
    .empty-text { color: var(--neutral); font-size: 0.95rem; margin: 0 0 1.5rem 0; }

    @media (max-width: 768px) {
        .section-header { flex-direction: column; align-items: flex-start; }
        .btn-create { width: 100%; justify-content: center; }
        th, td { padding: 0.7rem; font-size: 0.8rem; }
        .title-cell, .desc-cell { max-width: 140px; }
    }
</style>

<div class="section-header">
    <div>
        <h1>Kelola Layanan</h1>
        <p class="section-header-desc">Konten "Unit & Layanan" (Hotel, Villa, Food & Beverage, dst) yang tampil di homepage</p>
    </div>
    <a href="{{ route('admin.layanan.create') }}" class="btn-create">
        <i class="fas fa-plus"></i> Tambah Layanan
    </a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi Singkat</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 160px; text-align: center;">Aksi</th>
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
                        <td>{{ $item->order }}</td>
                        <td>
                            <span class="badge {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $item->is_active ? '✓ Aktif' : '✗ Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('layanan.show', $item->slug) }}" target="_blank" class="btn-icon btn-view" title="Lihat halaman detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.layanan.edit', $item) }}" class="btn-icon btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus layanan ini? Semua foto terkait (gambar utama, galeri, QR, icon) akan ikut terhapus.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-container">
                                <div class="empty-icon">✨</div>
                                <p class="empty-text">Belum ada layanan</p>
                                <a href="{{ route('admin.layanan.create') }}" class="btn-create"><i class="fas fa-plus"></i> Tambah Layanan</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection