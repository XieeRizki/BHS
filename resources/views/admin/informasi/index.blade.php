@extends('layouts.admin')
@section('title', 'Kelola Informasi & Berita')

@section('content')
<style>
    /* Shared layout */
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
    .section-header-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center; }

    /* Button base for header actions (make consistent) */
    .section-header-actions .btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.45rem 0.9rem; /* lebih ringkas */
      height: 40px;            /* konsisten tinggi */
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      text-decoration: none;
      cursor: pointer;
      line-height: 1;
      vertical-align: middle;
    }

    /* Primary */
    .btn-create {
        background-color: var(--secondary);
        color: white;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-create:hover { background-color: #111827; }
    .btn-create svg { width: 14px; height: 14px; flex-shrink: 0; }

    /* Outline / secondary */
    .btn-outline {
        background: white;
        color: var(--secondary);
        padding: 0.45rem 0.9rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    .btn-outline:hover { background-color: #F9FAFB; }
    .btn-outline svg { width: 14px; height: 14px; flex-shrink: 0; }

    /* Other existing styles (kept mostly as original, with minor icon size tweaks) */
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
    .btn-icon svg { width: 15px; height: 15px; flex-shrink: 0; }
    .btn-edit { background: rgba(59, 130, 246, 0.1); color: #3B82F6; border-color: rgba(59, 130, 246, 0.2); }
    .btn-edit:hover { background: rgba(59, 130, 246, 0.15); }
    .btn-delete { background: rgba(239, 68, 68, 0.1); color: #EF4444; border-color: rgba(239, 68, 68, 0.2); }
    .btn-delete:hover { background: rgba(239, 68, 68, 0.15); }

    .empty-container { text-align: center; padding: 3rem 1.5rem; }
    .empty-text { color: var(--neutral); font-size: 0.95rem; margin: 0 0 1.5rem 0; }

    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; overflow-y: auto; }
    .modal-overlay.active { display: flex; align-items: center; justify-content: center; }
    .modal-content { background: white; border-radius: 12px; padding: 2rem; max-width: 460px; width: 90%; max-height: 90vh; overflow-y: auto; position: relative; margin: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
    .modal-header { margin-bottom: 1.5rem; }
    .modal-header h2 { font-size: 1.25rem; font-weight: 700; color: var(--secondary); margin: 0 0 0.25rem 0; }
    .modal-header p { font-size: 0.85rem; color: var(--neutral); margin: 0; }
    .modal-close { position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; color: var(--neutral); cursor: pointer; width: 2rem; height: 2rem; border-radius: 6px; }
    .modal-close:hover { background: var(--border); color: var(--secondary); }
    .btn-save-status svg { width: 15px; height: 15px; }

    @media (max-width: 768px) {
        .section-header { flex-direction: column; align-items: flex-start; }
        .section-header-actions { width: 100%; display:flex; gap:0.75rem; }
        .section-header-actions .btn { width: auto; justify-content: center; }
        /* Jika ingin tombol header full-width di mobile, uncomment baris berikut:
           .section-header-actions .btn { flex: 1; } */
        th, td { padding: 0.7rem; font-size: 0.8rem; }
        .post-excerpt { max-width: 140px; }
    }
</style>

<div class="section-header">
    <div>
        <h1>Kelola Informasi & Berita</h1>
        <p class="section-header-desc">Daftar semua berita & artikel yang sudah ditambahkan</p>
    </div>
    <div class="section-header-actions">
        <a href="{{ route('admin.informasi.create') }}" class="btn btn-create">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Konten
        </a>
        {{-- gunakan kelas .btn-outline agar konsisten dengan .btn-create --}}
        <button class="btn btn-outline" onclick="openModal('categoryModal')" style="text-decoration:none;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41L13.42 20.58a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7" stroke-width="2.5" stroke-linecap="round"/></svg>
            Kelola Kategori
        </button>
    </div>
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
                                <a href="{{ route('admin.informasi.edit', $post) }}" class="btn-icon btn-edit">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('admin.informasi.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin hapus konten ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" style="border: 1px solid rgba(239,68,68,0.2);">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 6h16z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-container">
                                <p class="empty-text">Belum ada berita atau artikel.</p>
                                <a href="{{ route('admin.informasi.create') }}" class="btn btn-create">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                                    Tambah Konten
                                </a>
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

<!-- Modal Kelola Kategori -->
<div class="modal-overlay" id="categoryModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('categoryModal')">&times;</button>
        <div class="modal-header">
            <h2>Kelola Kategori</h2>
            <p>Tambah atau hapus kategori berita/artikel</p>
        </div>

        <form action="{{ route('admin.kategori.store') }}" method="POST" style="display:flex; gap:0.5rem; margin-bottom:1.5rem;">
            @csrf
            <input type="text" name="name" placeholder="Nama kategori baru..." required style="flex:1;">
            <button type="submit" class="btn-save-status" style="padding:0.65rem 1rem;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            </button>
        </form>

        <div style="max-height:250px; overflow-y:auto;">
            @forelse($categories as $kategori)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:0.6rem 0; border-bottom:1px solid var(--border);">
                    <span>{{ $kategori->name }} <small style="color:var(--neutral);">({{ $kategori->posts_count }} konten)</small></span>
                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" style="border:none;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 6h16z"/></svg>
                        </button>
                    </form>
                </div>
            @empty
                <p style="color:var(--neutral); font-size:0.9rem;">Belum ada kategori.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal helper scripts (pastikan ada fungsi openModal/closeModal di layout atau tambahkan) -->
<script>
    function openModal(id) {
        document.getElementById(id)?.classList.add('active');
    }
    function closeModal(id) {
        document.getElementById(id)?.classList.remove('active');
    }
</script>
@endsection