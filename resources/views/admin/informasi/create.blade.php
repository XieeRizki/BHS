@extends('layouts.admin')
@section('title', 'Tambah Informasi & Berita')

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

    .admin-page-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        text-transform: uppercase;
    }

    .admin-page-subtitle {
        font-size: 0.825rem;
        color: #6B7280;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    .btn-bhs-cancel {
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
        transition: all 0.2s ease;
    }

    .btn-bhs-cancel:hover {
        background: #F9FAFB;
        color: #111827;
    }

    /* Tab Switcher */
    .tab-nav {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        background: #FFFFFF;
        padding: 0.5rem;
        border-radius: 14px;
        border: 1px solid #E5E7EB;
    }

    .tab-btn {
        flex: 1;
        background: transparent;
        border: none;
        padding: 0.75rem 1.25rem;
        font-size: 0.825rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: #6B7280;
        cursor: pointer;
        border-radius: 10px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .tab-btn.active {
        background: #EAB308;
        color: #0A0A0A;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2);
    }

    /* Form Card Container */
    .bhs-form-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        padding: 1.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        display: none;
    }

    .bhs-form-card.active {
        display: block;
        animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-section-title {
        font-size: 0.95rem;
        font-weight: 800;
        color: #111827;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #F3F4F6;
    }

    /* Form Inputs & Controls */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.8rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 0.4rem;
    }

    .form-group label .required {
        color: #EF4444;
    }

    .input-control {
        width: 100%;
        padding: 0.8rem 1rem;
        background: #FFFFFF;
        border: 1px solid #D1D5DB;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.875rem;
        color: #111827;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .input-control:focus {
        outline: none;
        border-color: #EAB308;
        box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.15);
    }

    textarea.input-control {
        resize: vertical;
    }

    .input-hint {
        font-size: 0.75rem;
        color: #6B7280;
        margin-top: 0.35rem;
    }

    .grid-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    /* Special Placement Box */
    .placement-box {
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-radius: 14px;
        padding: 1.25rem;
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .switch-container {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-top: 0.6rem;
    }

    .switch-container input[type="checkbox"] {
        width: 1.15rem;
        height: 1.15rem;
        accent-color: #EAB308;
        cursor: pointer;
    }

    .switch-container label {
        margin: 0;
        font-size: 0.85rem;
        color: #374151;
        cursor: pointer;
        text-transform: none;
        font-weight: 600;
    }

    /* Buttons */
    .btn-bhs-save {
        background: #EAB308;
        color: #0A0A0A;
        font-weight: 900;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.9rem 1.5rem;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: all 0.2s ease;
        box-shadow: 0 4px 14px rgba(234, 179, 8, 0.25);
    }

    .btn-bhs-save:hover {
        background: #CA8A04;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(234, 179, 8, 0.35);
    }

    @media (max-width: 768px) {
        .grid-2col { grid-template-columns: 1fr; }
        .tab-nav { flex-direction: column; }
    }
</style>

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Tambah Konten Baru</h1>
        <p class="admin-page-subtitle">Pilih jenis berita atau artikel khusus yang ingin ditambahkan</p>
    </div>
    <a href="{{ route('admin.informasi.index') }}" class="btn-bhs-cancel">
        Kembali
    </a>
</div>

<!-- Tabs Swicher -->
<div class="tab-nav">
    <button type="button" class="tab-btn active" onclick="switchTab('berita')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        Form Berita Kegiatan
    </button>
    <button type="button" class="tab-btn" onclick="switchTab('artikel')">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        Form Artikel Spotlight
    </button>
</div>

<!-- FORM 1: BERITA -->
<div id="form-berita" class="bhs-form-card active">
    <div class="form-section-title">Tambah Berita Kegiatan</div>
    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="berita">

        <div class="grid-2col">
            <div class="form-group">
                <label>Judul Berita <span class="required">*</span></label>
                <input type="text" name="title" class="input-control" placeholder="Contoh: Lomba Mancing Mania BHS 2026" required>
            </div>
            
            <div class="form-group">
                <label>Kategori <span class="required">*</span></label>
                <select name="category_id" class="input-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Gambar Thumbnail / Cover</label>
            <input type="file" name="cover_image" class="input-control" accept="image/*">
            <p class="input-hint">* Format: JPG, JPEG, PNG, WEBP. Maksimal ukuran file <strong>2 MB</strong>.</p>
        </div>

        <div class="form-group">
            <label>Kutipan Singkat (Excerpt)</label>
            <textarea name="excerpt" class="input-control" rows="2" placeholder="Teks ringkas yang muncul di kartu berita..."></textarea>
        </div>

        <div class="form-group">
            <label>Konten Lengkap Berita <span class="required">*</span></label>
            <textarea name="content" class="input-control" rows="8" placeholder="Tulis isi berita selengkapnya di sini..." required></textarea>
        </div>

        <div class="placement-box">
            <div style="font-weight: 800; font-size: 0.85rem; color: #111827; text-transform: uppercase;">Penempatan Khusus Halaman Informasi</div>
            <p class="input-hint" style="margin-bottom: 0.75rem;">Pilih jika berita ini ingin disorot pada posisi khusus.</p>

            <div class="switch-container">
                <input type="checkbox" name="is_spotlight" id="spotlightBerita" value="1">
                <label for="spotlightBerita">Jadikan <b>Spotlight</b> (Sidebar Atas)</label>
            </div>
            
            <div class="switch-container">
                <input type="checkbox" name="is_featured" id="featuredBerita" value="1">
                <label for="featuredBerita">Jadikan <b>Menarik Tuk Disimak</b> (Sidebar Bawah)</label>
            </div>
        </div>

        <button type="submit" class="btn-bhs-save">
            Simpan Berita Baru
        </button>
    </form>
</div>

<!-- FORM 2: ARTIKEL -->
<div id="form-artikel" class="bhs-form-card">
    <div class="form-section-title">Tambah Artikel Khusus</div>
    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="artikel">

        <div class="grid-2col">
            <div class="form-group">
                <label>Judul Artikel <span class="required">*</span></label>
                <input type="text" name="title" class="input-control" placeholder="Contoh: 5 Tips Memancing Galatama untuk Pemula" required>
            </div>
            
            <div class="form-group">
                <label>Kategori <span class="required">*</span></label>
                <select name="category_id" class="input-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Gambar Thumbnail / Cover</label>
            <input type="file" name="cover_image" class="input-control" accept="image/*">
            <p class="input-hint">* Format: JPG, JPEG, PNG, WEBP. Maksimal ukuran file <strong>2 MB</strong>.</p>
        </div>

        <div class="form-group">
            <label>Konten Lengkap Artikel <span class="required">*</span></label>
            <textarea name="content" class="input-control" rows="8" placeholder="Tulis isi artikel selengkapnya di sini..." required></textarea>
        </div>

        <div class="placement-box">
            <div style="font-weight: 800; font-size: 0.85rem; color: #111827; text-transform: uppercase;">Penempatan Khusus Halaman Informasi</div>
            <p class="input-hint" style="margin-bottom: 0.75rem;">Pilih jika artikel ini ingin disorot pada posisi khusus.</p>

            <div class="switch-container">
                <input type="checkbox" id="spotlightArtikel" name="is_spotlight" value="1">
                <label for="spotlightArtikel">Jadikan <b>Spotlight</b> (Sidebar Atas)</label>
            </div>
            
            <div class="switch-container">
                <input type="checkbox" id="featuredArtikel" name="is_featured" value="1">
                <label for="featuredArtikel">Jadikan <b>Menarik Tuk Disimak</b> (Sidebar Bawah)</label>
            </div>
        </div>

        <button type="submit" class="btn-bhs-save">
            Simpan Artikel Khusus
        </button>
    </form>
</div>

<script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.bhs-form-card').forEach(card => card.classList.remove('active'));

        if (tabName === 'berita') {
            document.querySelectorAll('.tab-btn')[0].classList.add('active');
            document.getElementById('form-berita').classList.add('active');
        } else if (tabName === 'artikel') {
            document.querySelectorAll('.tab-btn')[1].classList.add('active');
            document.getElementById('form-artikel').classList.add('active');
        }
    }
</script>
@endsection