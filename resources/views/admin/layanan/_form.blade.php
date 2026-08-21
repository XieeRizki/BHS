@php
    $isEdit = isset($layanan);
    $existingServices = $isEdit ? ($layanan->services ?? []) : [];
    $existingGallery = $isEdit ? ($layanan->gallery ?? []) : [];
@endphp

<style>
    .form-section { background: white; border-radius: 10px; border: 1px solid var(--border); padding: 1.75rem; margin-bottom: 1.25rem; }
    .form-section h2 { font-size: 1.05rem; font-weight: 700; color: var(--secondary); margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border); }
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

    .current-image { margin-bottom: 0.75rem; }
    .current-image img { width: 120px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border); }

    .service-row { display: flex; gap: 0.6rem; align-items: center; margin-bottom: 0.6rem; }
    .service-row input[type="text"] { flex: 2; }
    .service-row input[type="file"] { flex: 1.4; font-size: 0.78rem; }
    .service-row .service-thumb { width: 34px; height: 34px; border-radius: 6px; object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; }

    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr)); gap: 0.6rem; margin-bottom: 1rem; }
    .gallery-grid .gallery-item { position: relative; }
    .gallery-grid img { width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 6px; border: 1px solid var(--border); }
    .gallery-remove-btn {
        position: absolute; top: -6px; right: -6px; width: 22px; height: 22px; border-radius: 50%;
        background: var(--danger); color: white; border: 2px solid white; font-size: 0.7rem;
        display: flex; align-items: center; justify-content: center; cursor: pointer;
    }
    .gallery-preview-label { font-size: 0.78rem; font-weight: 700; color: var(--neutral); margin: 0.75rem 0 0.4rem; }

    .btn-submit-row { display: flex; gap: 0.6rem; margin-top: 1rem; }
    .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; text-decoration: none; }
    .btn-save { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3); }
    .btn-cancel { background: var(--border); color: var(--secondary); }
    .btn-cancel:hover { background: #D1D5DB; }
</style>

{{-- ===================== SECTION 1: INFORMASI DASAR ===================== --}}
<div class="form-section">
    <h2>Informasi Dasar</h2>

    <div class="form-group">
        <label for="title">Judul <span class="required">*</span></label>
        <input type="text" id="title" name="title" value="{{ old('title', $layanan->title ?? '') }}" placeholder="Contoh: Tentang Hotel BHS" required>
        @error('title')<div class="form-error">{{ $message }}</div>@enderror
        @if($isEdit)
            <div class="form-hint">URL saat ini: /layanan/{{ $layanan->slug }} (slug tidak berubah otomatis saat judul diedit)</div>
        @else
            <div class="form-hint">URL detail otomatis dibuat dari judul ini (slug)</div>
        @endif
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="hero_subtitle">Subjudul Hero</label>
            <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $layanan->hero_subtitle ?? '') }}" placeholder="Tampil di bawah judul besar & section Selamat Datang">
        </div>
        <div class="form-group">
            <label for="section_subtitle">Subjudul Section Layanan</label>
            <input type="text" id="section_subtitle" name="section_subtitle" value="{{ old('section_subtitle', $layanan->section_subtitle ?? '') }}" placeholder="Contoh: DEDIKASI KEBERADAAN BHS">
        </div>
    </div>

    <div class="form-group">
        <label for="short_description">Deskripsi Singkat (tampil di card homepage)</label>
        <textarea id="short_description" name="short_description" style="min-height: 70px;">{{ old('short_description', $layanan->short_description ?? '') }}</textarea>
        @error('short_description')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
        <label for="content">Isi Lengkap (paragraf section "Tentang" di halaman detail)</label>
        <textarea id="content" name="content" style="min-height: 140px;" placeholder="Pisahkan tiap paragraf dengan baris kosong (Enter 2x).">{{ old('content', $layanan->content ?? '') }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="order">Urutan Tampil</label>
            <input type="number" id="order" name="order" value="{{ old('order', $layanan->order ?? 0) }}">
        </div>
        <div class="form-group" style="display: flex; align-items: flex-end; padding-bottom: 0.65rem;">
            <div class="checkbox-wrap">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
                <label for="is_active">Tampilkan layanan ini</label>
            </div>
        </div>
    </div>
</div>

{{-- ===================== SECTION 2: GAMBAR UTAMA ===================== --}}
<div class="form-section">
    <h2>Gambar Utama</h2>
    <div class="form-group">
        <div class="current-image" id="image-preview" style="{{ ($isEdit && $layanan->image) ? '' : 'display:none;' }}">
            <img id="image-preview-img" src="{{ ($isEdit && $layanan->image) ? asset('storage/' . $layanan->image) : '' }}" alt="Preview gambar utama">
        </div>
        <label for="image">{{ $isEdit ? 'Ganti Gambar' : 'Upload Gambar' }}</label>
        <input type="file" id="image" name="image" accept="image/*">
        <div class="form-hint">Dipakai di hero & section "Tentang". JPG/PNG/WEBP, maks 2MB.</div>
    </div>
</div>

{{-- ===================== SECTION 3: ICON LAYANAN ===================== --}}
<div class="form-section">
    <h2>Icon Layanan</h2>
    <p class="form-hint" style="margin-bottom: 1rem;">Isi nama tiap icon, foto opsional per-icon. Kosongkan baris nama yang tidak dipakai. Isi dari baris paling atas berurutan.</p>

    @for ($i = 0; $i < 5; $i++)
        <div class="service-row">
            <img id="service-thumb-{{ $i }}" class="service-thumb" alt="Icon {{ $i + 1 }}"
                 src="{{ !empty($existingServices[$i]['image']) ? asset('storage/' . $existingServices[$i]['image']) : '' }}"
                 style="{{ !empty($existingServices[$i]['image']) ? '' : 'display:none;' }}">
            <input type="text" name="services_lines[]" value="{{ old('services_lines.' . $i, $existingServices[$i]['name'] ?? '') }}" placeholder="Nama icon {{ $i + 1 }}">
            <input type="file" name="service_images[]" accept="image/*" data-preview-target="service-thumb-{{ $i }}">
        </div>
    @endfor
</div>

{{-- ===================== SECTION 4: GALERI ===================== --}}
<div class="form-section">
    <h2>Galeri Foto</h2>

    @if($isEdit && !empty($existingGallery))
        <div class="gallery-grid" id="existing-gallery">
            @foreach($existingGallery as $index => $img)
                <div class="gallery-item">
                    <img src="{{ asset('storage/' . $img) }}" alt="Galeri {{ $index + 1 }}">
                    <button type="button" class="gallery-remove-btn" onclick="removeGalleryImage({{ $layanan->id }}, {{ $index }}, this)" title="Hapus foto ini">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    <div class="form-group">
        <label for="gallery">Tambah Foto Galeri (bisa pilih beberapa sekaligus)</label>
        <input type="file" id="gallery" name="gallery[]" accept="image/*" multiple>
        <div class="form-hint">Foto baru akan ditambahkan ke galeri yang sudah ada, bukan mengganti semua</div>
    </div>

    <div class="gallery-preview-label" id="gallery-new-preview-label" style="display:none;">Preview foto baru</div>
    <div class="gallery-grid" id="gallery-new-preview"></div>
</div>

{{-- ===================== SECTION 5: QR CODE ORDER ONLINE ===================== --}}
<div class="form-section">
    <h2>QR Code Order Online</h2>
    <p class="form-hint" style="margin-bottom: 1rem;">Section ini otomatis tersembunyi di halaman detail kalau kedua QR kosong.</p>

    <div class="form-row">
        <div class="form-group">
            <div class="current-image" id="qr-shopeefood-preview" style="{{ ($isEdit && $layanan->qr_shopeefood) ? '' : 'display:none;' }}">
                <img id="qr-shopeefood-preview-img" src="{{ ($isEdit && $layanan->qr_shopeefood) ? asset('storage/' . $layanan->qr_shopeefood) : '' }}" alt="QR ShopeeFood">
            </div>
            <label for="qr_shopeefood">QR Code ShopeeFood</label>
            <input type="file" id="qr_shopeefood" name="qr_shopeefood" accept="image/*">
        </div>
        <div class="form-group">
            <div class="current-image" id="qr-gofood-preview" style="{{ ($isEdit && $layanan->qr_gofood) ? '' : 'display:none;' }}">
                <img id="qr-gofood-preview-img" src="{{ ($isEdit && $layanan->qr_gofood) ? asset('storage/' . $layanan->qr_gofood) : '' }}" alt="QR GoFood">
            </div>
            <label for="qr_gofood">QR Code GoFood</label>
            <input type="file" id="qr_gofood" name="qr_gofood" accept="image/*">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="qr_badge_text">Badge Text</label>
            <input type="text" id="qr_badge_text" name="qr_badge_text" value="{{ old('qr_badge_text', $layanan->qr_badge_text ?? '') }}" placeholder="SCAN BARCODE & ORDER">
        </div>
        <div class="form-group">
            <label for="qr_title">Judul Section</label>
            <input type="text" id="qr_title" name="qr_title" value="{{ old('qr_title', $layanan->qr_title ?? '') }}" placeholder="Get 40% extra on first order...">
        </div>
    </div>
</div>

{{-- ===================== SECTION 6: CTA BAWAH ===================== --}}
<div class="form-section">
    <h2>Call-to-Action (Bawah Halaman)</h2>
    <div class="form-group">
        <label for="cta_title">Judul CTA</label>
        <input type="text" id="cta_title" name="cta_title" value="{{ old('cta_title', $layanan->cta_title ?? '') }}" placeholder="DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA">
    </div>
    <div class="form-group">
        <label for="cta_subtitle">Subjudul CTA (opsional)</label>
        <input type="text" id="cta_subtitle" name="cta_subtitle" value="{{ old('cta_subtitle', $layanan->cta_subtitle ?? '') }}">
    </div>
</div>

<div class="btn-submit-row">
    <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Layanan' }}</button>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
</div>

<script>
    // ---------- Live image preview (main image, QR codes, service icons, gallery) ----------
    (function () {
        const readAndRender = (file, onLoad) => {
            const reader = new FileReader();
            reader.onload = e => onLoad(e.target.result);
            reader.readAsDataURL(file);
        };

        const bindSinglePreview = (inputId, imgId, wrapId) => {
            const input = document.getElementById(inputId);
            const img = document.getElementById(imgId);
            const wrap = document.getElementById(wrapId);
            if (!input || !img || !wrap) return;

            input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;
                readAndRender(file, src => {
                    img.src = src;
                    wrap.style.display = '';
                });
            });
        };

        bindSinglePreview('image', 'image-preview-img', 'image-preview');
        bindSinglePreview('qr_shopeefood', 'qr-shopeefood-preview-img', 'qr-shopeefood-preview');
        bindSinglePreview('qr_gofood', 'qr-gofood-preview-img', 'qr-gofood-preview');

        // Service icon thumbnails
        document.querySelectorAll('input[type="file"][data-preview-target]').forEach(input => {
            input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;
                const img = document.getElementById(input.dataset.previewTarget);
                if (!img) return;
                readAndRender(file, src => {
                    img.src = src;
                    img.style.display = '';
                });
            });
        });

        // Gallery multi-preview
        const galleryInput = document.getElementById('gallery');
        const galleryPreview = document.getElementById('gallery-new-preview');
        const galleryPreviewLabel = document.getElementById('gallery-new-preview-label');
        if (galleryInput && galleryPreview) {
            galleryInput.addEventListener('change', () => {
                galleryPreview.innerHTML = '';
                const files = [...galleryInput.files];
                galleryPreviewLabel.style.display = files.length ? '' : 'none';
                files.forEach(file => {
                    readAndRender(file, src => {
                        const item = document.createElement('div');
                        item.className = 'gallery-item';
                        item.innerHTML = `<img src="${src}" alt="Preview foto baru">`;
                        galleryPreview.appendChild(item);
                    });
                });
            });
        }
    })();

    @if($isEdit)
    // ---------- AJAX gallery image delete ----------
    function removeGalleryImage(layananId, index, btnEl) {
        if (!confirm('Hapus foto ini dari galeri?')) return;

        // Gunakan URL statis yang digenerate oleh Blade untuk memastikan rute yang dituju selalu akurat
        const url = `{{ route('admin.layanan.gallery.destroy', ['layanan' => ':layananId', 'index' => ':index']) }}`
                        .replace(':layananId', layananId)
                        .replace(':index', index);

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(res => {
            if (res.ok) {
                // Hapus elemen secara instan dari tampilan tanpa harus refresh
                btnEl.closest('.gallery-item').remove();
            } else {
                return res.json().then(err => { throw new Error(err.message || 'Request failed') });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal menghapus foto: ' + error.message);
        });
    }
    @endif
</script>