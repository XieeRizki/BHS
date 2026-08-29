@extends('layouts.admin')

@section('title', 'Form Edit Hero Banner')

@section('content')
<style>
    /* Styling Header */
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

    /* Container Box & Section */
    .bhs-form-card {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 1.75rem;
        margin-bottom: 1.5rem;
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

    /* Inputs & Form Controls */
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
        margin-bottom: 0.5rem;
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
        min-height: 100px;
    }

    .input-hint {
        font-size: 0.75rem;
        color: #6B7280;
        margin-top: 0.4rem;
    }

    .grid-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    /* Upload Drag Drop Area */
    .file-dropzone {
        border: 2px dashed #D1D5DB;
        border-radius: 14px;
        padding: 1.5rem;
        text-align: center;
        background: #F9FAFB;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .file-dropzone:hover {
        border-color: #EAB308;
        background: #FFFBEB;
    }

    .file-dropzone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .dropzone-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #374151;
    }

    .dropzone-sublabel {
        font-size: 0.75rem;
        color: #6B7280;
        margin-top: 0.25rem;
    }

    /* Grid Slideshow Existing */
    .slideshow-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .slideshow-card {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #E5E7EB;
        aspect-ratio: 16/10;
        background: #111827;
    }

    .slideshow-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.2s;
    }

    .slideshow-card:hover img {
        opacity: 0.4;
    }

    .btn-delete-slide {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #DC2626;
        color: #FFFFFF;
        border: none;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        cursor: pointer;
        opacity: 0;
        transition: all 0.2s;
    }

    .slideshow-card:hover .btn-delete-slide {
        opacity: 1;
    }

    /* Action Buttons */
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

    @media (max-width: 768px) {
        .grid-2col {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Header Page -->
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit Hero Banner</h1>
        <p class="admin-page-subtitle">Perbarui konten teks, tombol, dan galeri slide foto halaman depan</p>
    </div>
    <a href="{{ route('admin.hero.index') }}" class="btn-bhs-cancel">
        Kembali
    </a>
</div>

@if (session('success'))
    <div style="margin-bottom: 1.5rem; background: #ECFDF5; border: 1px solid #A7F3D0; border-radius: 12px; padding: 1rem; color: #065F46; font-size: 0.875rem; font-weight: 600;">
        {{ session('success') }}
    </div>
@endif

<!-- SECTION 1: MANAJEMEN FOTO SLIDESHOW SAAT INI -->
<div class="bhs-form-card">
    <div class="form-section-title">Galeri Slideshow Aktif</div>
    
    @if(isset($hero) && $hero->images && $hero->images->count() > 0)
        <p class="input-hint" style="margin-bottom: 1rem;">Arahkan kursor / tekan foto untuk menghapus foto tertentu dari slide.</p>
        <div class="slideshow-gallery">
            @foreach($hero->images as $img)
                <div class="slideshow-card">
                    <img src="{{ asset('storage/' . $img->image) }}" alt="Slide BHS">
                    <form action="{{ route('admin.hero.image.destroy', $img->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-slide" onclick="return confirm('Hapus foto ini dari slideshow?')">
                            Hapus
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 2rem 1rem; color: #6B7280; background: #F9FAFB; border: 1px dashed #D1D5DB; border-radius: 12px; font-size: 0.825rem;">
            Belum ada foto slideshow. Tambahkan foto melalui form di bawah ini.
        </div>
    @endif
</div>

<!-- SECTION 2: FORM INPUT DATA UTAMA -->
<div class="bhs-form-card">
    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-section-title">Informasi Teks Banner</div>

        <div class="form-group">
            <label>Judul Utama <span class="required">*</span></label>
            <input type="text" name="title" class="input-control" value="{{ old('title', $hero->title ?? '') }}" required placeholder="Contoh: Selamat Datang di Balong Hardi Sumedang">
        </div>

        <div class="form-group">
            <label>Subtitle / Deskripsi Singkat <span class="required">*</span></label>
            <textarea name="subtitle" class="input-control" required placeholder="Contoh: Destinasi rekreasi pemancingan keluarga terpadu di Sumedang">{{ old('subtitle', $hero->subtitle ?? '') }}</textarea>
        </div>

        <div class="form-section-title" style="margin-top: 2rem;">Upload Media Baru</div>

        <div class="grid-2col">
            <div class="form-group">
                <label>Tambah Slide Foto Baru (Multi-upload)</label>
                <div class="file-dropzone">
                    <input type="file" name="slider_images[]" accept="image/*" multiple id="sliderImagesInput">
                    <div class="dropzone-label" id="sliderImagesLabel">Pilih atau Drag Foto ke Sini</div>
                    <div class="dropzone-sublabel">Bisa pilih banyak foto sekaligus (Maks. 5MB/foto)</div>
                </div>
            </div>

            <div class="form-group">
                <label>Gambar Fallback Single (Opsional)</label>
                <div class="file-dropzone">
                    <input type="file" name="image" accept="image/*" id="singleImageInput">
                    <div class="dropzone-label" id="singleImageLabel">Pilih Foto Single</div>
                    <div class="dropzone-sublabel">Hanya aktif jika galeri slideshow kosong</div>
                </div>
            </div>
        </div>

        <div class="form-section-title" style="margin-top: 2rem;">Tombol Call-To-Action (CTA)</div>

        <div class="grid-2col">
            <div class="form-group">
                <label>Teks Tombol</label>
                <input type="text" name="button_text" class="input-control" value="{{ old('button_text', $hero->button_text ?? '') }}" placeholder="Contoh: Reservasi Lapak">
            </div>

            <div class="form-group">
                <label>Link Tujuan Tombol</label>
                <input type="text" name="button_link" class="input-control" value="{{ old('button_link', $hero->button_link ?? '') }}" placeholder="Contoh: #reservasi atau https://wa.me/...">
            </div>
        </div>

        <div style="margin-top: 2rem;">
            <button type="submit" class="btn-bhs-save">
                Simpan & Perbarui Banner
            </button>
        </div>
    </form>
</div>

<script>
    // Preview nama file pada dropzone
    document.getElementById('sliderImagesInput')?.addEventListener('change', function(e) {
        const count = e.target.files.length;
        const label = document.getElementById('sliderImagesLabel');
        if (label && count > 0) {
            label.textContent = count + ' Foto Terpilih';
        }
    });

    document.getElementById('singleImageInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const label = document.getElementById('singleImageLabel');
        if (label && file) {
            label.textContent = file.name;
        }
    });
</script>
@endsection