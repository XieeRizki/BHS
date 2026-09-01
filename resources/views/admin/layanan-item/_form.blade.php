@php $isEdit = isset($item); @endphp

<style>
    /* Card Section Form */
    .bhs-form-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
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

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
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
        min-height: 100px;
    }

    .form-hint {
        font-size: 0.75rem;
        color: #6B7280;
        margin-top: 0.35rem;
    }

    .form-error {
        font-size: 0.75rem;
        color: #EF4444;
        margin-top: 0.35rem;
        font-weight: 600;
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

    .current-file {
        margin-bottom: 0.75rem;
        font-size: 0.85rem;
    }

    .current-file img {
        width: 120px;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #E5E7EB;
    }

    .current-file a {
        color: #2563EB;
        font-weight: 700;
        text-decoration: underline;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .gallery-grid img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #E5E7EB;
    }

    /* Actions Bottom */
    .btn-submit-row {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
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

    .btn-bhs-cancel {
        background: #FFFFFF;
        color: #4B5563;
        font-weight: 700;
        font-size: 0.825rem;
        text-transform: uppercase;
        padding: 0.9rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        border: 1px solid #D1D5DB;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 140px;
        transition: all 0.2s ease;
    }

    .btn-bhs-cancel:hover {
        background: #F9FAFB;
        color: #111827;
    }

    @media (max-width: 640px) {
        .grid-2col { grid-template-columns: 1fr; }
    }
</style>

<!-- Informasi Utama -->
<div class="bhs-form-card">
    <div class="form-section-title">Informasi Utama</div>

    <div class="form-group">
        <label for="title">Nama Item / Paket <span class="required">*</span></label>
        <input type="text" id="title" name="title" class="input-control" value="{{ old('title', $item->title ?? '') }}" placeholder="Contoh: Paket Family Villa VIP" required>
        @error('title')<div class="form-error">{{ $message }}</div>@enderror
        @if($isEdit)
            <div class="form-hint">URL Publik: /layanan/{{ $layanan->slug }}/{{ $item->slug }}</div>
        @endif
    </div>

    <div class="grid-2col">
        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" class="input-control" value="{{ old('price', $item->price ?? '') }}" placeholder="500000">
        </div>
        <div class="form-group">
            <label for="price_unit">Satuan Harga</label>
            <input type="text" id="price_unit" name="price_unit" class="input-control" value="{{ old('price_unit', $item->price_unit ?? '') }}" placeholder="Contoh: /malam, /porsi, /pax">
        </div>
    </div>

    <div class="form-group">
        <label for="description">Deskripsi Utama</label>
        <textarea id="description" name="description" class="input-control" style="min-height:130px;" placeholder="Tuliskan deskripsi lengkap mengenai item/paket ini...">{{ old('description', $item->description ?? '') }}</textarea>
    </div>
</div>

<!-- Sub Judul -->
<div class="bhs-form-card">
    <div class="form-section-title">Sub Judul & Rincian Tambahan (Opsional)</div>

    <div class="form-group">
        <label for="sub_title_1">Sub Judul 1</label>
        <input type="text" id="sub_title_1" name="sub_title_1" class="input-control" value="{{ old('sub_title_1', $item->sub_title_1 ?? '') }}" placeholder="Contoh: Fasilitas Termasuk">
    </div>
    <div class="form-group">
        <label for="sub_description_1">Deskripsi Sub Judul 1</label>
        <textarea id="sub_description_1" name="sub_description_1" class="input-control" placeholder="Tulis rincian fasilitas...">{{ old('sub_description_1', $item->sub_description_1 ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label for="sub_title_2">Sub Judul 2</label>
        <input type="text" id="sub_title_2" name="sub_title_2" class="input-control" value="{{ old('sub_title_2', $item->sub_title_2 ?? '') }}" placeholder="Contoh: Syarat & Ketentuan">
    </div>
    <div class="form-group">
        <label for="sub_description_2">Deskripsi Sub Judul 2</label>
        <textarea id="sub_description_2" name="sub_description_2" class="input-control" placeholder="Tulis rincian ketentuan...">{{ old('sub_description_2', $item->sub_description_2 ?? '') }}</textarea>
    </div>
</div>

<!-- File & Link -->
<div class="bhs-form-card">
    <div class="form-section-title">File & Gambar Utama</div>

    <div class="form-group">
        @if($isEdit && $item->cover)
            <div class="current-file">
                <img src="{{ asset('storage/'.$item->cover) }}" alt="Cover">
            </div>
        @endif
        <label for="cover">Cover / Gambar Utama</label>
        <input type="file" id="cover" name="cover" class="input-control" accept="image/*">
        <div class="form-hint">* Format: JPG, PNG, WEBP. Maks 2MB.</div>
    </div>

    <div class="form-group">
        @if($isEdit && $item->pdf)
            <div class="current-file">📄 PDF saat ini: <a href="{{ asset('storage/'.$item->pdf) }}" target="_blank">Lihat File PDF</a></div>
        @endif
        <label for="pdf">File PDF Broshur / Menu (Opsional)</label>
        <input type="file" id="pdf" name="pdf" class="input-control" accept="application/pdf">
        <div class="form-hint">* Maksimal 5MB. Akan tampil sebagai tombol download di detail item.</div>
    </div>
</div>

<!-- Galeri -->
<div class="bhs-form-card">
    <div class="form-section-title">Galeri Foto Item</div>

    @if($isEdit && !empty($item->gallery))
        <div class="gallery-grid">
            @foreach($item->gallery as $img)
                <img src="{{ asset('storage/'.$img) }}" alt="Galeri">
            @endforeach
        </div>
        <div class="form-hint" style="margin-bottom: 0.75rem;">* Foto baru yang diunggah akan menambahkan koleksi galeri saat ini.</div>
    @endif

    <div class="form-group">
        <label for="gallery">Tambah Foto Galeri</label>
        <input type="file" id="gallery" name="gallery[]" class="input-control" accept="image/*" multiple>
        <div class="form-hint">Bisa memilih lebih dari 1 foto sekaligus.</div>
    </div>
</div>

<!-- Pengaturan -->
<div class="bhs-form-card">
    <div class="form-section-title">Pengaturan Publikasi</div>

    <div class="grid-2col">
        <div class="form-group">
            <label for="order">Urutan Tampil</label>
            <input type="number" id="order" name="order" class="input-control" value="{{ old('order', $item->order ?? 0) }}">
        </div>
        <div class="form-group" style="display:flex; align-items:flex-end; padding-bottom:0.4rem;">
            <div class="checkbox-wrap">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active">Tampilkan item ini di halaman publik</label>
            </div>
        </div>
    </div>
</div>

<div class="btn-submit-row">
    <button type="submit" class="btn-bhs-save">
        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Item' }}
    </button>
    <a href="{{ route('admin.layanan-item.index', $layanan) }}" class="btn-bhs-cancel">
        Batal
    </a>
</div>