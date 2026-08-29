@extends('layouts.admin')
@section('title', 'Edit Konten - ' . $post->title)

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

    /* Form Container */
    .bhs-form-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        padding: 1.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
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
        flex: 1;
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
    }
</style>

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit Konten</h1>
        <p class="admin-page-subtitle">Perbarui data: <strong>{{ $post->title }}</strong></p>
    </div>
    <a href="{{ route('admin.informasi.index') }}" class="btn-bhs-cancel">
        Kembali
    </a>
</div>

<div class="bhs-form-card">
    <form action="{{ route('admin.informasi.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf 
        @method('PUT')

        <div class="form-section-title">Informasi Utama</div>

        <div class="grid-2col">
            <div class="form-group">
                <label>Tipe Konten <span class="required">*</span></label>
                <select name="type" class="input-control" required>
                    <option value="berita" {{ $post->type === 'berita' ? 'selected' : '' }}>Berita Kegiatan</option>
                    <option value="artikel" {{ $post->type === 'artikel' ? 'selected' : '' }}>Artikel</option>
                </select>
            </div>

            <div class="form-group">
                <label>Kategori <span class="required">*</span></label>
                <select name="category_id" class="input-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id }}" {{ $post->category_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Judul <span class="required">*</span></label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="input-control" required>
        </div>

        <div class="form-group">
            <label>Gambar Thumbnail (Cover)</label>
            @if($post->cover_image)
                <div style="margin-bottom: 0.75rem;">
                    <img src="{{ asset('storage/'.$post->cover_image) }}" style="width: 120px; height: 90px; object-fit: cover; border-radius: 12px; border: 1px solid #E5E7EB;">
                </div>
            @endif
            <input type="file" name="cover_image" class="input-control" accept="image/*">
            <p class="input-hint">Kosongkan jika tidak ingin mengganti foto cover. Maks. 2MB.</p>
        </div>

        <div class="form-group">
            <label>Kutipan Singkat (Excerpt)</label>
            <textarea name="excerpt" class="input-control" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label>Konten Lengkap <span class="required">*</span></label>
            <textarea name="content" class="input-control" rows="8" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="placement-box">
            <div style="font-weight: 800; font-size: 0.85rem; color: #111827; text-transform: uppercase;">Penempatan Khusus Halaman Informasi</div>
            <p class="input-hint" style="margin-bottom: 0.75rem;">Atur posisi tampil khusus pada halaman informasi.</p>

            <div class="switch-container">
                <input type="checkbox" id="is_spotlight" name="is_spotlight" value="1" {{ old('is_spotlight', $post->is_spotlight) ? 'checked' : '' }}>
                <label for="is_spotlight">Jadikan <b>Spotlight</b> (Sidebar Atas)</label>
            </div>

            <div class="switch-container">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                <label for="is_featured">Jadikan <b>Menarik Tuk Disimak</b> (Sidebar Bawah)</label>
            </div>
        </div>

        <div style="display:flex; gap:0.75rem; margin-top:1.5rem;">
            <button type="submit" class="btn-bhs-save">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.informasi.index') }}" class="btn-bhs-cancel" style="justify-content: center; width: 140px;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection