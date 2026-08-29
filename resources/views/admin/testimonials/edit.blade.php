@extends('layouts.admin')
@section('title', 'Edit Testimoni - ' . $testimonial->name)

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
        min-height: 110px;
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

    .checkbox-wrap {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .checkbox-wrap input[type="checkbox"] {
        width: 1.15rem;
        height: 1.15rem;
        accent-color: #EAB308;
        cursor: pointer;
    }

    .checkbox-wrap label {
        margin: 0;
        font-size: 0.85rem;
        color: #111827;
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

    .preview-thumb {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #E5E7EB;
        margin-bottom: 0.75rem;
    }

    @media (max-width: 768px) {
        .grid-2col { grid-template-columns: 1fr; }
    }
</style>

<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Edit Testimoni</h1>
        <p class="admin-page-subtitle">Perbarui data: <strong>{{ $testimonial->name }}</strong></p>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="btn-bhs-cancel">
        Kembali
    </a>
</div>

<div class="bhs-form-card">
    <div class="form-section-title">Informasi Testimoni</div>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid-2col">
            <div class="form-group">
                <label>Nama Pelanggan <span class="required">*</span></label>
                <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="input-control" required>
                @error('name') <p style="color:#EF4444; font-size:0.75rem; margin-top:0.35rem; font-weight:600;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Jabatan / Keterangan (Opsional)</label>
                <input type="text" name="role" value="{{ old('role', $testimonial->role) }}" placeholder="Contoh: Anggota Komunitas Mancing" class="input-control">
                @error('role') <p style="color:#EF4444; font-size:0.75rem; margin-top:0.35rem; font-weight:600;">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Isi Pesan / Testimoni <span class="required">*</span></label>
            <textarea name="message" rows="5" class="input-control" required>{{ old('message', $testimonial->message) }}</textarea>
            @error('message') <p style="color:#EF4444; font-size:0.75rem; margin-top:0.35rem; font-weight:600;">{{ $message }}</p> @enderror
        </div>

        <div class="grid-2col">
            <div class="form-group">
                <label>Rating Bintang <span class="required">*</span></label>
                <select name="rating" class="input-control">
                    <option value="5" {{ old('rating', $testimonial->rating) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang)</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang)</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang)</option>
                    <option value="2" {{ old('rating', $testimonial->rating) == 2 ? 'selected' : '' }}>⭐⭐ (2 Bintang)</option>
                    <option value="1" {{ old('rating', $testimonial->rating) == 1 ? 'selected' : '' }}>⭐ (1 Bintang)</option>
                </select>
                @error('rating') <p style="color:#EF4444; font-size:0.75rem; margin-top:0.35rem; font-weight:600;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label>Foto Profil</label>
                @if($testimonial->avatar)
                    <div>
                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="preview-thumb">
                    </div>
                @endif
                <input type="file" name="avatar" accept="image/*" class="input-control">
                <p class="input-hint">Kosongkan jika tidak ingin mengganti foto. Maks 2MB.</p>
                @error('avatar') <p style="color:#EF4444; font-size:0.75rem; margin-top:0.35rem; font-weight:600;">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-top: 0.5rem; margin-bottom: 1.5rem;">
            <div class="checkbox-wrap">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                <label for="is_active">Tampilkan testimoni ini di halaman publik</label>
            </div>
        </div>

        <div style="display: flex; gap: 0.75rem;">
            <button type="submit" class="btn-bhs-save">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-bhs-cancel" style="justify-content: center; width: 140px;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection