@extends('layouts.admin')
@section('title', 'Kelola Informasi & Berita')

@section('content')
<style>
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .section-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0; }
    .section-header-desc { font-size: 0.85rem; color: var(--neutral); margin: 0; }

    .btn-create {
        background: linear-gradient(135deg, var(--primary) 0%, #ea580c 100%);
        color: white;
        padding: 0.7rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3); }

    .table-card { background: white; border-radius: 10px; border: 1px solid var(--border); overflow: hidden; }
    .table-responsive { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: linear-gradient(135deg, var(--secondary) 0%, #111827 100%); color: white; }
    th { padding: 0.9rem; text-align: left; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
    td { padding: 0.9rem; border-bottom: 1px solid var(--border); font-size: 0.9rem; vertical-align: middle; }
    tbody tr:hover { background: rgba(249, 115, 22, 0.03); }

    .post-cell { display: flex; align-items: center; gap: 0.75rem; }
    .post-cell img { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; flex-shrink: 0; }
    .post-title { font-weight: 600; color: var(--secondary); }
    .post-excerpt { font-size: 0.78rem; color: var(--neutral); max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

    .badge { display: inline-block; padding: 0.3rem 0.6rem; border-radius: 5px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; margin-right: 0.3rem; margin-bottom: 0.2rem; }
    .badge-berita { background: rgba(59, 130, 246, 0.12); color: #3B82F6; }
    .badge-artikel { background: rgba(139, 92, 246, 0.12); color: #8B5CF6; }
    .badge-spotlight { background: rgba(245, 158, 11, 0.15); color: #92400E; }
    .badge-featured { background: rgba(16, 185, 129, 0.15); color: #047857; }

    .action-group { display: flex; gap: 0.5rem; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 0.75rem; border: 1px solid; border-radius: 6px; font-size: 0.8rem; cursor: pointer; text-decoration: none; }
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
        .post-excerpt { max-width: 140px; }
    }
</style>

<div class="section-header">
    <div>
        <h1>Kelola Informasi & Berita</h1>
        <p class="section-header-desc">Daftar semua berita & artikel yang sudah ditambahkan</p>
    </div>
    <a href="{{ route('admin.informasi.create') }}" class="btn-create">
        <i class="fas fa-plus"></i> Tambah Konten
    </a>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Konten</th>
                    <th>Kategori</th>
                    <th>Penempatan</th>
                    <th>Tanggal</th>
                    <th style="width: 120px;">Aksi</th>
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
                                    <div class="post-excerpt">{{ $post->excerpt }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $post->category->name ?? '-' }}</td>
                        <td>
                            @if($post->is_spotlight)<span class="badge badge-spotlight">Spotlight</span>@endif
                            @if($post->is_featured)<span class="badge badge-featured">Featured</span>@endif
                            @if(!$post->is_spotlight && !$post->is_featured)<span style="color: var(--neutral); font-size: 0.8rem;">-</span>@endif
                        </td>
                        <td style="font-size: 0.8rem; color: var(--neutral);">
                            {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.informasi.edit', $post) }}" class="btn-icon btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.informasi.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin hapus konten ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" style="border: 1px solid rgba(239,68,68,0.2);"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-container">
                                <div class="empty-icon">📰</div>
                                <p class="empty-text">Belum ada berita atau artikel.</p>
                                <a href="{{ route('admin.informasi.create') }}" class="btn-create"><i class="fas fa-plus"></i> Tambah Konten</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($posts->hasPages())
        <div style="padding: 1rem; text-align: center; border-top: 1px solid var(--border);">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection