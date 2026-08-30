@extends('layouts.admin')
@section('title', 'Tambah Fasilitas')
@section('content')

<style>
    .form-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin: 0 0 0.3rem 0;
    }

    .form-header p {
        font-size: 0.85rem;
        color: var(--neutral);
        margin: 0 0 1.5rem 0;
    }

    .form-box {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1.5rem;
        max-width: 550px;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    label {
        display: block;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .required {
        color: var(--danger);
        margin-left: 0.2rem;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea {
        width: 100%;
        padding: 0.75rem 0.9rem;
        border: 1px solid var(--border);
        border-radius: 6px;
        font-family: inherit;
        font-size: 0.9rem;
        transition: all 0.15s ease;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="file"]:focus,
    textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }

    textarea {
        resize: vertical;
        min-height: 90px;
    }

    .form-hint {
        font-size: 0.8rem;
        color: var(--neutral);
        margin-top: 0.35rem;
    }

    .form-error {
        font-size: 0.8rem;
        color: var(--danger);
        margin-top: 0.35rem;
    }

    .checkbox-wrap {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    input[type="checkbox"] {
        width: 1.1rem;
        height: 1.1rem;
        cursor: pointer;
        accent-color: var(--primary);
    }

    .checkbox-wrap label {
        margin: 0;
        font-weight: 500;
        cursor: pointer;
    }

    .form-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 2rem;
    }

    .btn {
        flex: 1;
        padding: 0.85rem;
        border: none;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-save {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
    }

    .btn-back {
        background: var(--border);
        color: var(--secondary);
    }

    .btn-back:hover {
        background: #D1D5DB;
    }

    @media (max-width: 768px) {
        .form-box {
            padding: 1.25rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="form-header">
    <h1>Tambah Fasilitas</h1>
    <p>Tambahkan fasilitas baru ke Balong Hardi</p>
</div>

<div class="form-box">
    <form action="{{ route('admin.facility.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">
                Nama Fasilitas
                <span class="required">*</span>
            </label>
            <input
                type="text"
                id="name"
                name="name"
                placeholder="Contoh: Kolam Renang Utama"
                value="{{ old('name') }}"
                required
            >
            @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="description">
                Deskripsi
                <span class="required">*</span>
            </label>
            <textarea
                id="description"
                name="description"
                placeholder="Jelaskan detail fasilitas..."
                required
            >{{ old('description') }}</textarea>
            @error('description')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="image">Gambar Fasilitas</label>
            <input type="file" id="image" name="image" accept="image/*">
            <div class="form-hint">JPG, PNG · Maks 2MB</div>
            @error('image')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="icon">Icon (Emoji)</label>
            <input
                type="text"
                id="icon"
                name="icon"
                placeholder="Contoh: 🏊 🎢 🍽️"
                value="{{ old('icon') }}"
            >
            <div class="form-hint">Copy emoji dan paste di sini</div>
            @error('icon')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="order">Urutan Tampil</label>
            <input type="number" 
            id="order" 
            name="order" 
            min="0" 
            value="{{ old('order', $nextOrder) }}">
            <div class="form-hint">Angka lebih kecil = tampil lebih depan</div>
            @error('order')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <div class="checkbox-wrap">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    {{ old('is_active') ? 'checked' : '' }}
                >
                <label for="is_active">Aktifkan fasilitas ini</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-save">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('admin.facility.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Batal
            </a>
        </div>
    </form>
</div>

@endsection
