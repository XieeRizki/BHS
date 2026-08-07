@extends('layouts.admin')

@section('title', 'Kelola Hero Banner')

@section('content')
<style>
    .form-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0 0 0.3rem 0; }
    .form-header p { font-size: 0.85rem; color: var(--neutral); margin: 0 0 1.5rem 0; }
    .form-box { background: white; border: 1px solid var(--border); border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { margin-bottom: 1.25rem; }
    label { display: block; font-weight: 700; color: var(--secondary); margin-bottom: 0.5rem; font-size: 0.9rem; }
    .required { color: var(--danger); margin-left: 0.2rem; }
    input[type="text"], input[type="file"], textarea { width: 100%; padding: 0.75rem 0.9rem; border: 1px solid var(--border); border-radius: 6px; font-family: inherit; font-size: 0.9rem; }
    textarea { resize: vertical; min-height: 90px; }
    .form-hint { font-size: 0.8rem; color: var(--neutral); margin-top: 0.35rem; }
    .form-error { font-size: 0.8rem; color: var(--danger); margin-top: 0.35rem; }
    .section-divider { margin: 2rem 0; padding: 1.5rem 0 0 0; border-top: 2px solid var(--border); }
    .section-title { font-size: 1.1rem; font-weight: 700; color: var(--secondary); margin-bottom: 1rem; }
    .btn { padding: 0.85rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.9rem; cursor: pointer; text-align: center; transition: all 0.15s ease; width: 100%; }
    .btn-save { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; }
    .grid-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }

    /* Slideshow Grid */
    .slideshow-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
    .slideshow-item { position: relative; border: 1px solid var(--border); border-radius: 8px; overflow: hidden; background: #000; }
    .slideshow-item img { width: 100%; height: 120px; object-fit: cover; display: block; opacity: 0.8; transition: 0.3s; }
    .slideshow-item:hover img { opacity: 0.4; }
    .btn-delete-img { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #dc2626; color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 4px; font-size: 0.8rem; cursor: pointer; opacity: 0; transition: 0.3s; }
    .slideshow-item:hover .btn-delete-img { opacity: 1; }
</style>

<div class="form-header">
    <h1>Kelola Hero Banner</h1>
    <p>Atur banner utama yang ditampilkan di halaman depan website Anda</p>
</div>

@if (session('success'))
    <div style="margin-bottom: 1.5rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 6px; padding: 1rem; color: #047857;">
        {{ session('success') }}
    </div>
@endif

<!-- PREVIEW GAMBAR SLIDESHOW (Dipisah dari form utama agar tombol hapus berfungsi) -->
<div class="form-box">
    <div class="section-title">Gambar Slideshow Saat Ini</div>
    <p class="form-hint" style="margin-bottom: 1rem;">Upload banyak foto pada form di bawah untuk membuat background berganti otomatis.</p>

    @if(isset($hero) && $hero->images && $hero->images->count() > 0)
        <div class="slideshow-grid">
            @foreach($hero->images as $img)
                <div class="slideshow-item">
                    <img src="{{ asset('storage/' . $img->image) }}">
                    <!-- Form Delete Individual -->
                    <form action="{{ route('admin.hero.image.destroy', $img->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-img" onclick="return confirm('Hapus gambar ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 1.5rem; color: var(--neutral); background: rgba(249, 115, 22, 0.05); border: 1px dashed var(--border); border-radius: 8px;">
            Belum ada gambar slideshow.
        </div>
    @endif
</div>

<!-- FORM UTAMA -->
<div class="form-box">
    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="section-title">Informasi Hero Banner</div>

        <div class="form-group">
            <label>Judul Banner <span class="required">*</span></label>
            <input type="text" name="title" value="{{ old('title', $hero->title ?? '') }}" required placeholder="Contoh: Selamat Datang di Balong Hardi">
        </div>

        <div class="form-group">
            <label>Subtitle <span class="required">*</span></label>
            <textarea name="subtitle" required placeholder="Contoh: Pemancingan terlengkap dengan fasilitas modern">{{ old('subtitle', $hero->subtitle ?? '') }}</textarea>
        </div>

        <div class="section-divider">
            <div class="section-title">Upload Gambar</div>

            <div class="grid-2col">
                <div class="form-group">
                    <label>Tambah Gambar Slideshow Baru</label>
                    <input type="file" name="slider_images[]" accept="image/*" multiple>
                    <p class="form-hint">Bisa pilih beberapa foto sekaligus (Max 5MB). Akan ditambahkan ke galeri di atas.</p>
                </div>

                <div class="form-group">
                    <label>Gambar Fallback (Opsional)</label>
                    <input type="file" name="image" accept="image/*">
                    <p class="form-hint">Hanya dipakai jika slider kosong. (Menggantikan gambar fallback yang lama).</p>
                </div>
            </div>
        </div>

        <div class="section-divider">
            <div class="section-title">Call-to-Action Button</div>
            <div class="grid-2col">
                <div class="form-group">
                    <label>Teks Button</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $hero->button_text ?? '') }}" placeholder="Contoh: Pesan Sekarang">
                </div>
                <div class="form-group">
                    <label>Link Button</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $hero->button_link ?? '') }}" placeholder="Contoh: #paket atau https://...">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-save mt-4">
            Simpan & Update Hero Banner
        </button>
    </form>
</div>
@endsection