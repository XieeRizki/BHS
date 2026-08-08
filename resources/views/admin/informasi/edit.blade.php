@extends('layouts.admin')
@section('title', 'Edit Konten - ' . $post->title)

@section('content')
<style>
    .admin-header { margin-bottom: 2rem; }
    .admin-header h1 { font-size: 1.75rem; font-weight: 700; color: var(--secondary); margin-bottom: 0.25rem; }
    .admin-header p { font-size: 0.9rem; color: var(--neutral); }

    .form-card { background: white; padding: 2rem; border-radius: 10px; border: 1px solid var(--border); }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; font-weight: 600; color: var(--secondary); margin-bottom: 0.5rem; font-size: 0.95rem; }
    .form-control { width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--border); border-radius: 8px; font-size: 0.95rem; color: var(--secondary); }
    .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1); }

    .switch-container { display: flex; align-items: center; gap: 0.75rem; margin-top: 0.5rem; }
    .switch-container input[type="checkbox"] { width: 1.25rem; height: 1.25rem; accent-color: var(--primary); }

    .btn-submit {
        background-color: var(--primary); color: white; border: none; padding: 0.75rem 1.5rem;
        border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;
    }
    .btn-submit:hover { background-color: #ea580c; }
    .btn-cancel {
        background: var(--border); color: var(--secondary); border: none; padding: 0.75rem 1.5rem;
        border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;
    }
</style>

<div class="admin-header">
    <h1>Edit Konten</h1>
    <p>{{ $post->title }}</p>
</div>

<div class="form-card">
    <form action="{{ route('admin.informasi.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem;">
            <div class="form-group">
                <label class="form-label">Tipe Konten</label>
                <select name="type" class="form-control" required>
                    <option value="berita" {{ $post->type === 'berita' ? 'selected' : '' }}>Berita Kegiatan</option>
                    <option value="artikel" {{ $post->type === 'artikel' ? 'selected' : '' }}>Artikel</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id }}" {{ $post->category_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Judul</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Gambar Thumbnail (Cover)</label>
            @if($post->cover_image)
                <div style="margin-bottom: 0.75rem;">
                    <img src="{{ asset('storage/'.$post->cover_image) }}" style="width: 120px; height: 90px; object-fit: cover; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="cover_image" class="form-control" accept="image/*">
            <p class="text-xs text-gray-500 mt-1.5">Kosongkan kalau tidak mau ganti gambar. Maks 2MB.</p>
        </div>

        <div class="form-group">
            <label class="form-label">Kutipan Singkat (Excerpt)</label>
            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Konten Lengkap</label>
            <textarea name="content" class="form-control" rows="8" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="form-group p-4 bg-gray-50 border border-gray-200 rounded-lg" style="padding:1rem; background:#F9FAFB; border:1px solid var(--border); border-radius:8px;">
            <label class="form-label">Penempatan Khusus di Halaman Informasi</label>
            <div class="switch-container">
                <input type="checkbox" id="is_spotlight" name="is_spotlight" value="1" {{ old('is_spotlight', $post->is_spotlight) ? 'checked' : '' }}>
                <label for="is_spotlight">Jadikan <b>Spotlight</b></label>
            </div>
            <div class="switch-container">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                <label for="is_featured">Jadikan <b>Menarik Tuk Disimak</b></label>
            </div>
        </div>

        <div style="display:flex; gap:0.75rem; margin-top:1.5rem;">
            <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
            <a href="{{ route('admin.informasi.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Batal</a>
        </div>
    </form>
</div>
@endsection