@php $isEdit = isset($item); @endphp

<style>
    .form-section { background: white; border-radius: 10px; border: 1px solid var(--border); padding: 1.75rem; margin-bottom: 1.25rem; }
    .form-section h2 { font-size: 1.05rem; font-weight: 700; color: var(--secondary); margin-bottom: 1.1rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border); }
    .form-group { margin-bottom: 1.1rem; }
    .form-group:last-child { margin-bottom: 0; }
    label { display: block; font-weight: 700; color: var(--secondary); margin-bottom: 0.4rem; font-size: 0.85rem; }
    .required { color: var(--danger); margin-left: 0.2rem; }
    input[type="text"], input[type="number"], input[type="file"], textarea {
        width: 100%; padding: 0.65rem 0.8rem; border: 1px solid var(--border); border-radius: 6px;
        font-family: inherit; font-size: 0.9rem; box-sizing: border-box;
    }
    textarea { resize: vertical; min-height: 90px; }
    input:focus, textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1); }
    .form-hint { font-size: 0.75rem; color: var(--neutral); margin-top: 0.3rem; }
    .form-error { font-size: 0.75rem; color: var(--danger); margin-top: 0.3rem; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    @media (max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
    .checkbox-wrap { display: flex; align-items: center; gap: 0.5rem; }
    input[type="checkbox"] { width: 1rem; height: 1rem; accent-color: var(--primary); }
    .checkbox-wrap label { margin: 0; font-weight: 500; font-size: 0.9rem; cursor: pointer; }
    .current-file { margin-bottom: 0.75rem; font-size: 0.85rem; }
    .current-file img { width: 120px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border); }
    .current-file a { color: #3B82F6; font-weight: 600; }
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)); gap: 0.6rem; margin-bottom: 1rem; }
    .gallery-grid img { width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 6px; border: 1px solid var(--border); }
    .btn-submit-row { display: flex; gap: 0.6rem; margin-top: 1.25rem; }
    .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; text-decoration: none; }
    .btn-save { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; }
    .btn-cancel { background: var(--border); color: var(--secondary); }
</style>

<div class="form-section">
    <h2>Informasi Utama</h2>

    <div class="form-group">
        <label for="title">Nama Layanan / Paket <span class="required">*</span></label>
        <input type="text" id="title" name="title" value="{{ old('title', $item->title ?? '') }}" required>
        @error('title')<div class="form-error">{{ $message }}</div>@enderror
        @if($isEdit)
            <div class="form-hint">URL: /layanan/{{ $layanan->slug }}/{{ $item->slug }}</div>
        @endif
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="{{ old('price', $item->price ?? '') }}" placeholder="500000">
        </div>
        <div class="form-group">
            <label for="price_unit">Satuan Harga</label>
            <input type="text" id="price_unit" name="price_unit" value="{{ old('price_unit', $item->price_unit ?? '') }}" placeholder="/malam, /porsi, dll">
        </div>
    </div>

    <div class="form-group">
        <label for="description">Deskripsi Utama</label>
        <textarea id="description" name="description" style="min-height:140px;">{{ old('description', $item->description ?? '') }}</textarea>
    </div>
</div>

<div class="form-section">
    <h2>Sub Judul (Opsional)</h2>

    <div class="form-group">
        <label for="sub_title_1">Sub Judul 1</label>
        <input type="text" id="sub_title_1" name="sub_title_1" value="{{ old('sub_title_1', $item->sub_title_1 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="sub_description_1">Deskripsi Sub Judul 1</label>
        <textarea id="sub_description_1" name="sub_description_1">{{ old('sub_description_1', $item->sub_description_1 ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label for="sub_title_2">Sub Judul 2</label>
        <input type="text" id="sub_title_2" name="sub_title_2" value="{{ old('sub_title_2', $item->sub_title_2 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="sub_description_2">Deskripsi Sub Judul 2</label>
        <textarea id="sub_description_2" name="sub_description_2">{{ old('sub_description_2', $item->sub_description_2 ?? '') }}</textarea>
    </div>
</div>

<div class="form-section">
    <h2>File & Link</h2>

    <div class="form-group">
        @if($isEdit && $item->cover)
            <div class="current-file"><img src="{{ asset('storage/'.$item->cover) }}" alt="Cover"></div>
        @endif
        <label for="cover">Cover / Gambar Utama</label>
        <input type="file" id="cover" name="cover" accept="image/*">
    </div>

    <div class="form-group">
        @if($isEdit && $item->pdf)
            <div class="current-file">PDF saat ini: <a href="{{ asset('storage/'.$item->pdf) }}" target="_blank">Lihat PDF</a></div>
        @endif
        <label for="pdf">File PDF (Opsional)</label>
        <input type="file" id="pdf" name="pdf" accept="application/pdf">
        <div class="form-hint">Maks 5MB, tampil sebagai tombol "Download PDF" di halaman detail</div>
    </div>


</div>

<div class="form-section">
    <h2>Galeri</h2>

    @if($isEdit && !empty($item->gallery))
        <div class="gallery-grid">
            @foreach($item->gallery as $img)
                <img src="{{ asset('storage/'.$img) }}" alt="Galeri">
            @endforeach
        </div>
        <div class="form-hint" style="margin-bottom: 0.75rem;">Foto baru akan ditambahkan ke galeri yang sudah ada</div>
    @endif

    <div class="form-group">
        <label for="gallery">Tambah Foto Galeri</label>
        <input type="file" id="gallery" name="gallery[]" accept="image/*" multiple>
    </div>
</div>

<div class="form-section">
    <h2>Pengaturan</h2>

    <div class="form-row">
        <div class="form-group">
            <label for="order">Urutan Tampil</label>
            <input type="number" id="order" name="order" value="{{ old('order', $item->order ?? 0) }}">
        </div>
        <div class="form-group" style="display:flex; align-items:flex-end; padding-bottom:0.65rem;">
            <div class="checkbox-wrap">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active">Tampilkan item ini</label>
            </div>
        </div>
    </div>
</div>

<div class="btn-submit-row">
    <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Item' }}</button>
    <a href="{{ route('admin.layanan-item.index', $layanan) }}" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
</div>
