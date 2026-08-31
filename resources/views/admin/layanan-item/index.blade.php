@extends('layouts.admin')
@section('title', 'Item - ' . $layanan->title)
@section('content')

<style>
    .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap; }
    .section-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0; }
    .section-header-desc { font-size: 0.85rem; color: var(--neutral); margin: 0; }
    .btn-create {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white; padding: 0.7rem 1.5rem; border: none; border-radius: 8px;
        font-weight: 600; font-size: 0.9rem; cursor: pointer; text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.5rem; white-space: nowrap;
    }
    .btn-back { color: var(--neutral); font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 1rem; }
    .table-card { background: white; border-radius: 10px; border: 1px solid var(--border); overflow: hidden; }
    .table-responsive { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: linear-gradient(135deg, var(--secondary) 0%, #111827 100%); color: white; }
    th { padding: 0.9rem; text-align: left; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; }
    td { padding: 0.9rem; border-bottom: 1px solid var(--border); font-size: 0.9rem; vertical-align: middle; }
    tbody tr:hover { background: rgba(249, 115, 22, 0.03); }
    .image-cell img { width: 52px; height: 52px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border); }
    .title-cell { font-weight: 600; color: var(--secondary); }
    .badge { display: inline-block; padding: 0.4rem 0.75rem; border-radius: 5px; font-size: 0.8rem; font-weight: 600; }
    .badge-active { background: rgba(16, 185, 129, 0.15); color: #047857; }
    .badge-inactive { background: rgba(107, 114, 128, 0.15); color: var(--neutral); }
    .action-group { display: flex; gap: 0.5rem; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 0.8rem; border: 1px solid; border-radius: 6px; font-size: 0.8rem; cursor: pointer; text-decoration: none; }
    .btn-view { background: rgba(107, 114, 128, 0.1); color: var(--neutral); border-color: rgba(107, 114, 128, 0.2); }
    .btn-edit { background: rgba(59, 130, 246, 0.1); color: #3B82F6; border-color: rgba(59, 130, 246, 0.2); }
    .btn-delete { background: rgba(239, 68, 68, 0.1); color: #EF4444; border-color: rgba(239, 68, 68, 0.2); }
    .empty-container { text-align: center; padding: 3rem 1.5rem; }
    .empty-icon { font-size: 3rem; color: #D1D5DB; margin-bottom: 1rem; }
    .empty-text { color: var(--neutral); font-size: 0.95rem; margin: 0 0 1.5rem 0; }
</style>

<a href="{{ route('admin.layanan.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Layanan</a>

<div class="section-header">
    <div>
        <h1>Item - {{ $layanan->title }}</h1>
        <p class="section-header-desc">Daftar paket/menu detail milik layanan ini (tampil bisa diklik di carousel Showcase)</p>
    </div>
    <a href="{{ route('admin.layanan-item.create', $layanan) }}" class="btn-create"><i class="fas fa-plus"></i> Tambah Item</a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 150px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td class="image-cell">
                            <img src="{{ $item->cover ? asset('storage/'.$item->cover) : asset('images/bhs2.jpg') }}" alt="{{ $item->title }}">
                        </td>
                        <td class="title-cell">{{ $item->title }}</td>
                        <td>{{ $item->formatted_price ?? '-' }}</td>
                        <td>{{ $item->order }}</td>
                        <td>
                            <span class="badge {{ $item->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $item->is_active ? '✓ Aktif' : '✗ Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('layanan-item.show', [$layanan, $item]) }}" target="_blank" class="btn-icon btn-view"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.layanan-item.edit', [$layanan, $item]) }}" class="btn-icon btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.layanan-item.destroy', [$layanan, $item]) }}" method="POST" onsubmit="return confirm('Yakin hapus item ini?')">
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
                                <div class="empty-icon">📦</div>
                                <p class="empty-text">Belum ada item untuk layanan ini</p>
                                <a href="{{ route('admin.layanan-item.create', $layanan) }}" class="btn-create"><i class="fas fa-plus"></i> Tambah Item</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
