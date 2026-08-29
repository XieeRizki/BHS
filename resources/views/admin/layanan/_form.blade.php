@php
    $isEdit = isset($layanan);
    $existingServices = $isEdit ? ($layanan->services ?? []) : [];
    $existingGallery = $isEdit ? ($layanan->gallery ?? []) : [];
    $existingShowcase = $isEdit ? ($layanan->showcase_items ?? []) : [];
@endphp

<style>
    /* ===== Layout Tab Side-by-Side ===== */
    .layanan-form-shell {
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
    }

    .form-tabs-nav {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        width: 240px;
        flex-shrink: 0;
        position: sticky;
        top: 1.25rem;
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 0.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .tab-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-align: left;
        width: 100%;
        padding: 0.75rem 0.85rem;
        border: 1px solid transparent;
        background: transparent;
        border-radius: 12px;
        font-size: 0.825rem;
        font-weight: 700;
        color: #4B5563;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .tab-btn:hover {
        background: #FFFBEB;
        color: #111827;
    }

    .tab-btn.active {
        background: #EAB308;
        color: #0A0A0A;
        font-weight: 800;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2);
    }

    .tab-btn .tab-dot {
        margin-left: auto;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #D1D5DB;
        flex-shrink: 0;
    }

    .tab-btn.active .tab-dot {
        background: #0A0A0A;
    }

    .tab-btn .tab-dot.filled {
        background: #10B981;
    }

    .form-tabs-content {
        flex: 1;
        min-width: 0;
    }

    .tab-panel {
        display: none;
    }

    .tab-panel.active {
        display: block;
        animation: tabFadeIn 0.2s ease;
    }

    @keyframes tabFadeIn {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 900px) {
        .layanan-form-shell {
            flex-direction: column;
        }
        .form-tabs-nav {
            width: 100%;
            flex-direction: row;
            overflow-x: auto;
            position: static;
            gap: 0.5rem;
        }
        .tab-btn {
            flex-shrink: 0;
            width: auto;
            white-space: nowrap;
        }
    }

    /* ===== Form Card & Inputs ===== */
    .form-section {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        padding: 1.75rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .form-section-title-row {
        padding-bottom: 0.85rem;
        border-bottom: 1px solid #F3F4F6;
        margin-bottom: 1.25rem;
    }

    .form-section h2 {
        font-size: 0.95rem;
        font-weight: 800;
        color: #111827;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin: 0;
    }

    .form-section-desc {
        font-size: 0.8rem;
        color: #6B7280;
        margin-top: 0.35rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-group:last-child {
        margin-bottom: 0;
    }

    label {
        display: block;
        font-weight: 700;
        color: #374151;
        margin-bottom: 0.4rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .required {
        color: #EF4444;
        margin-left: 0.2rem;
    }

    input[type="text"], input[type="number"], input[type="file"], textarea, select {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #D1D5DB;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.875rem;
        color: #111827;
        box-sizing: border-box;
        transition: all 0.2s ease;
        background: #FFFFFF;
    }

    textarea {
        resize: vertical;
        min-height: 90px;
    }

    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #EAB308;
        box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.15);
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

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }

    .checkbox-wrap {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    input[type="checkbox"] {
        width: 1.15rem;
        height: 1.15rem;
        accent-color: #EAB308;
        cursor: pointer;
    }

    .checkbox-wrap label {
        margin: 0;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        text-transform: none;
        color: #111827;
    }

    .current-image {
        margin-bottom: 0.75rem;
    }

    .current-image img {
        width: 120px;
        height: 90px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #E5E7EB;
    }

    /* Icon Rows */
    .service-row {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .service-row input[type="text"] {
        flex: 2;
    }

    .service-row input[type="file"] {
        flex: 1.4;
        font-size: 0.8rem;
    }

    .service-row .service-thumb {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E5E7EB;
        flex-shrink: 0;
    }

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .gallery-grid .gallery-item {
        position: relative;
    }

    .gallery-grid img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #E5E7EB;
    }

    .gallery-remove-btn {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #DC2626;
        color: #FFFFFF;
        border: 2px solid #FFFFFF;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    /* Showcase Cards */
    .showcase-card {
        border: 1px solid #E5E7EB;
        border-radius: 14px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        background: #F9FAFB;
    }

    .showcase-card-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1rem;
        font-size: 0.75rem;
        font-weight: 800;
        color: #6B7280;
        text-transform: uppercase;
    }

    .showcase-card-header .showcase-index {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #EAB308;
        color: #0A0A0A;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 900;
        flex-shrink: 0;
    }

    .showcase-remove-btn {
        margin-left: auto;
        background: #FEF2F2;
        color: #DC2626;
        border: 1px solid #FCA5A5;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
    }

    .showcase-thumb-row {
        display: flex;
        gap: 0.85rem;
        align-items: flex-start;
    }

    .showcase-thumb-preview {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E5E7EB;
        flex-shrink: 0;
    }

    /* Submit Row */
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

    .btn-bhs-cancel-form {
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
        transition: all 0.2s ease;
    }

    .btn-bhs-cancel-form:hover {
        background: #F9FAFB;
        color: #111827;
    }
</style>

<div class="layanan-form-shell">

    {{-- NAVIGASI TAB --}}
    <div class="form-tabs-nav">
        <button type="button" class="tab-btn active" data-tab="dasar">
            Info Dasar
            <span class="tab-dot {{ ($isEdit ? $layanan->title : old('title')) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="media">
            Gambar & Video
            <span class="tab-dot {{ ($isEdit && ($layanan->image || $layanan->video_url)) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="icon">
            Icon Layanan
            <span class="tab-dot {{ !empty($existingServices) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="showcase">
            Showcase
            <span class="tab-dot {{ !empty($existingShowcase) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="galeri">
            Galeri Foto
            <span class="tab-dot {{ !empty($existingGallery) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="qr">
            QR Order Online
            <span class="tab-dot {{ ($isEdit && ($layanan->qr_shopeefood || $layanan->qr_gofood)) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="cta">
            Call-to-Action
            <span class="tab-dot {{ ($isEdit && $layanan->cta_title) ? 'filled' : '' }}"></span>
        </button>
    </div>

    {{-- ISI TAB --}}
    <div class="form-tabs-content">

        {{-- TAB 1: INFO DASAR --}}
        <div class="tab-panel active" data-panel="dasar">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2>Info Dasar Layanan</h2>
                    <p class="form-section-desc">Judul, deskripsi, dan teks utama yang tampil di card homepage & halaman detail layanan ini.</p>
                </div>

                <div class="form-group">
                    <label for="title">Judul Layanan <span class="required">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $layanan->title ?? '') }}" placeholder="Contoh: Tentang Hotel BHS" required>
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    @if($isEdit)
                        <div class="form-hint">URL saat ini: /layanan/{{ $layanan->slug }}</div>
                    @else
                        <div class="form-hint">URL detail otomatis dibuat dari judul ini (slug)</div>
                    @endif
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="hero_subtitle">Subjudul Hero</label>
                        <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $layanan->hero_subtitle ?? '') }}" placeholder="Tampil di bawah judul besar">
                    </div>
                    <div class="form-group">
                        <label for="section_subtitle">Subjudul Section</label>
                        <input type="text" id="section_subtitle" name="section_subtitle" value="{{ old('section_subtitle', $layanan->section_subtitle ?? '') }}" placeholder="Contoh: DEDIKASI KEBERADAAN BHS">
                    </div>
                </div>

                <div class="form-group">
                    <label for="short_description">Deskripsi Singkat (Card Homepage)</label>
                    <textarea id="short_description" name="short_description" style="min-height: 70px;">{{ old('short_description', $layanan->short_description ?? '') }}</textarea>
                    @error('short_description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="content">Isi Paragraf Lengkap (Halaman Detail)</label>
                    <textarea id="content" name="content" style="min-height: 140px;" placeholder="Pisahkan tiap paragraf dengan baris kosong (Enter 2x).">{{ old('content', $layanan->content ?? '') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="order">Urutan Tampil</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $layanan->order ?? 0) }}">
                        <div class="form-hint">Angka lebih kecil tampil lebih dulu</div>
                    </div>
                    <div class="form-group" style="display: flex; align-items: flex-end; padding-bottom: 0.65rem;">
                        <div class="checkbox-wrap">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active">Tampilkan Layanan Ini</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 2: GAMBAR & VIDEO --}}
        <div class="tab-panel" data-panel="media">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2>Gambar & Video Media</h2>
                    <p class="form-section-desc">Gambar utama dipakai di hero & section "Tentang". Video (opsional) tampil di section Penghargaan.</p>
                </div>

                <div class="form-group">
                    <div class="current-image" id="image-preview" style="{{ ($isEdit && $layanan->image) ? '' : 'display:none;' }}">
                        <img id="image-preview-img" src="{{ ($isEdit && $layanan->image) ? asset('storage/' . $layanan->image) : '' }}" alt="Preview Gambar Utama">
                    </div>
                    <label for="image">{{ $isEdit ? 'Ganti Gambar Utama' : 'Upload Gambar Utama' }}</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <div class="form-hint">Format JPG/PNG/WEBP, Maks 2MB.</div>
                </div>

                <div class="form-group">
                    <label for="video_url">Link Video Promo YouTube (Opsional)</label>
                    <input type="text" id="video_url" name="video_url" value="{{ old('video_url', $layanan->video_url ?? '') }}" placeholder="https://youtube.com/watch?v=...">
                    @error('video_url')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <div class="current-image" id="bg-image-preview" style="{{ ($isEdit && $layanan->bg_image) ? '' : 'display:none;' }}">
                        <img id="bg-image-preview-img" src="{{ ($isEdit && $layanan->bg_image) ? asset('storage/' . $layanan->bg_image) : '' }}" alt="Preview Background Section Video">
                    </div>
                    <label for="bg_image">Foto Background Section Video (Opsional)</label>
                    <input type="file" id="bg_image" name="bg_image" accept="image/*">
                    <div class="form-hint">Jika kosong, otomatis memakai gambar utama layanan ini.</div>
                    @error('bg_image')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- TAB 3: ICON LAYANAN --}}
        <div class="tab-panel" data-panel="icon">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2>Icon Fasilitas Layanan</h2>
                    <p class="form-section-desc">Baris icon kecil di bawah judul detail layanan. Kosongkan baris yang tidak dipakai.</p>
                </div>

                @for ($i = 0; $i < 5; $i++)
                    <div class="service-row">
                        <img id="service-thumb-{{ $i }}" class="service-thumb" alt="Icon {{ $i + 1 }}"
                             src="{{ !empty($existingServices[$i]['image']) ? asset('storage/' . $existingServices[$i]['image']) : '' }}"
                             style="{{ !empty($existingServices[$i]['image']) ? '' : 'display:none;' }}">
                        <input type="text" name="services_lines[]" value="{{ old('services_lines.' . $i, $existingServices[$i]['name'] ?? '') }}" placeholder="Nama Icon / Fasilitas {{ $i + 1 }}">
                        <input type="file" name="service_images[]" accept="image/*" data-preview-target="service-thumb-{{ $i }}">
                    </div>
                @endfor
            </div>
        </div>

        {{-- TAB 4: SHOWCASE --}}
        <div class="tab-panel" data-panel="showcase">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2>Showcase / Menu Carousel</h2>
                    <p class="form-section-desc">Carousel daftar menu, tipe kamar, atau fasilitas unggulan layanan ini.</p>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="showcase_title">Judul Section Showcase</label>
                        <input type="text" id="showcase_title" name="showcase_title" value="{{ old('showcase_title', $layanan->showcase_title ?? '') }}" placeholder="Contoh: MENU FAVORIT RESTO & CAFE">
                    </div>
                    <div class="form-group">
                        <label for="showcase_subtitle">Subjudul Section Showcase</label>
                        <input type="text" id="showcase_subtitle" name="showcase_subtitle" value="{{ old('showcase_subtitle', $layanan->showcase_subtitle ?? '') }}" placeholder="Contoh: CITA RASA KHAS BALONG HARDI">
                    </div>
                </div>

                <div id="showcaseList"></div>

                <button type="button" id="addShowcaseItemBtn" class="btn-bhs-cancel-form" style="margin-top: 0.5rem; width: 100%;">
                    + Tambah Item Showcase Baru
                </button>

                <template id="showcaseItemTemplate">
                    <div class="showcase-card" data-showcase-block>
                        <div class="showcase-card-header">
                            <span class="showcase-index">#</span>
                            <span class="showcase-label-text">Item</span>
                            <button type="button" class="showcase-remove-btn" title="Hapus Item Ini">
                                Hapus
                            </button>
                        </div>

                        <input type="hidden" name="showcase_keys[]" value="__ORIGINAL_INDEX__">

                        <div class="form-row" style="margin-bottom: 0.75rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Kategori</label>
                                <input type="text" name="showcase_categories[]" placeholder="Makanan / Minuman / Kamar" value="__CATEGORY__">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Nama Item</label>
                                <input type="text" name="showcase_names[]" placeholder="Contoh: Nasi Goreng BHS" value="__NAME__">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0.75rem;">
                            <label>Deskripsi Singkat</label>
                            <textarea name="showcase_descriptions[]" style="min-height: 50px;">__DESCRIPTION__</textarea>
                        </div>

                        <div class="showcase-thumb-row">
                            <img class="showcase-thumb-preview" alt="Foto Item" src="__IMAGE_SRC__" style="__IMAGE_DISPLAY__">
                            <div style="flex: 1;">
                                <label>Foto Item</label>
                                <input type="file" name="showcase_images[]" accept="image/*" data-showcase-preview>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- TAB 5: GALERI FOTO --}}
        <div class="tab-panel" data-panel="galeri">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2>Galeri Foto Layanan</h2>
                </div>

                @if(!$isEdit)
                    <p class="form-section-desc">
                        Simpan layanan ini terlebih dahulu, lalu kelola kategori dan foto galeri pada halaman Edit.
                    </p>
                @else
                    <p class="form-section-desc">Kelola foto galeri khusus untuk layanan <strong>{{ $layanan->title }}</strong>.</p>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="margin-bottom: 0.6rem;">Kategori Galeri Saat Ini</label>

                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.85rem;">
                            @forelse($layanan->kategoris as $kategori)
                                <button type="button" onclick="deleteKategori({{ $kategori->id }}, '{{ addslashes($kategori->name) }}')" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.75rem; border-radius: 999px; border: 1px solid #E5E7EB; background: #FFFFFF; font-size: 0.8rem; font-weight: 700; color: #374151; cursor: pointer;">
                                    {{ $kategori->name }}
                                    <span style="color: #DC2626; font-weight: 900;">✕</span>
                                </button>
                            @empty
                                <span style="font-size: 0.825rem; color: #6B7280; font-style: italic;">Belum ada kategori galeri.</span>
                            @endforelse
                        </div>

                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" id="new_kategori_name" placeholder="Nama Kategori Baru, contoh: Interior" style="flex: 1;">
                            <button type="button" class="btn-bhs-cancel-form" onclick="submitKategori()" style="white-space: nowrap;">+ Tambah Kategori</button>
                        </div>
                    </div>

                    <div style="border-top: 1px solid #F3F4F6; padding-top: 1.25rem;">
                        <label style="margin-bottom: 0.6rem;">Upload Foto Galeri Baru</label>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="file" id="new_gallery_image" accept="image/*">
                            </div>
                            <div class="form-group" style="display: flex; gap: 0.5rem;">
                                <select id="new_gallery_category" style="flex: 1;">
                                    <option value="">Tanpa Kategori</option>
                                    @foreach($layanan->kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn-bhs-save" onclick="submitGallery()" style="white-space: nowrap; padding: 0.8rem 1.25rem;">Upload Foto</button>
                            </div>
                        </div>
                    </div>

                    @if($layanan->galleries->isNotEmpty())
                        <div style="border-top: 1px solid #F3F4F6; padding-top: 1.25rem; margin-top: 0.5rem;">
                            <label style="margin-bottom: 0.75rem;">Foto Galeri Tersimpan ({{ $layanan->galleries->count() }})</label>
                            <div class="gallery-grid">
                                @foreach($layanan->galleries as $photo)
                                    <div class="gallery-item">
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->kategori->name ?? 'Galeri' }}">
                                        <button type="button" class="gallery-remove-btn" onclick="deleteGalleryPhoto({{ $photo->id }})" title="Hapus Foto Ini">
                                            ✕
                                        </button>
                                        <span style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: rgba(0,0,0,0.75); color: #FFFFFF; font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.4rem; border-radius: 4px; text-align: center; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $photo->kategori->name ?? 'Tanpa Kategori' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- TAB 6: QR ORDER ONLINE --}}
        <div class="tab-panel" data-panel="qr">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2>QR Code Order Online</h2>
                    <p class="form-section-desc">Section ini otomatis tersembunyi jika kedua foto QR dikosongkan.</p>
                </div>

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
                        <label for="qr_badge_text">Text Badge</label>
                        <input type="text" id="qr_badge_text" name="qr_badge_text" value="{{ old('qr_badge_text', $layanan->qr_badge_text ?? '') }}" placeholder="SCAN BARCODE & ORDER">
                    </div>
                    <div class="form-group">
                        <label for="qr_title">Judul Section QR</label>
                        <input type="text" id="qr_title" name="qr_title" value="{{ old('qr_title', $layanan->qr_title ?? '') }}" placeholder="Pesan Menu Online Sekarang...">
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 7: CALL-TO-ACTION --}}
        <div class="tab-panel" data-panel="cta">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2>Call-to-Action (Bawah Halaman)</h2>
                    <p class="form-section-desc">Judul & subjudul ajakan reservasi pada bagian paling bawah halaman detail.</p>
                </div>

                <div class="form-group">
                    <label for="cta_title">Judul CTA</label>
                    <input type="text" id="cta_title" name="cta_title" value="{{ old('cta_title', $layanan->cta_title ?? '') }}" placeholder="DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA">
                </div>
                <div class="form-group">
                    <label for="cta_subtitle">Subjudul CTA (Opsional)</label>
                    <input type="text" id="cta_subtitle" name="cta_subtitle" value="{{ old('cta_subtitle', $layanan->cta_subtitle ?? '') }}">
                </div>
            </div>
        </div>

    </div>
</div>

<div class="btn-submit-row">
    <button type="submit" class="btn-bhs-save">
        {{ $isEdit ? 'Simpan Perubahan Layanan' : 'Simpan Layanan Baru' }}
    </button>
    <a href="{{ route('admin.layanan.index') }}" class="btn-bhs-cancel-form">
        Batal
    </a>
</div>

<script>
    // Tab Switcher Logic
    (function () {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const panels = document.querySelectorAll('.tab-panel');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => b.classList.remove('active'));
                panels.forEach(p => p.classList.remove('active'));

                btn.classList.add('active');
                document.querySelector(`.tab-panel[data-panel="${btn.dataset.tab}"]`)?.classList.add('active');
                history.replaceState(null, '', '#' + btn.dataset.tab);
            });
        });

        if (location.hash) {
            const tabName = location.hash.replace('#', '');
            const targetBtn = document.querySelector(`.tab-btn[data-tab="${tabName}"]`);
            if (targetBtn) targetBtn.click();
        }

        @if($errors->any())
            const firstErrorField = document.querySelector('.form-error')?.closest('.tab-panel');
            if (firstErrorField) {
                const panelName = firstErrorField.dataset.panel;
                document.querySelector(`.tab-btn[data-tab="${panelName}"]`)?.click();
            }
        @endif
    })();

    // Image Live Previews
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
        bindSinglePreview('bg_image', 'bg-image-preview-img', 'bg-image-preview');
        bindSinglePreview('qr_shopeefood', 'qr-shopeefood-preview-img', 'qr-shopeefood-preview');
        bindSinglePreview('qr_gofood', 'qr-gofood-preview-img', 'qr-gofood-preview');

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
    })();

    // Dynamic Showcase Items
    (function () {
        const list = document.getElementById('showcaseList');
        const addBtn = document.getElementById('addShowcaseItemBtn');
        const template = document.getElementById('showcaseItemTemplate');
        if (!list || !addBtn || !template) return;

        @php
            $oldShowcaseData = old('showcase_names') ? [
                'categories' => old('showcase_categories', []),
                'names' => old('showcase_names', []),
                'descriptions' => old('showcase_descriptions', []),
                'keys' => old('showcase_keys', []),
            ] : null;
        @endphp

        const existingShowcase = @json($existingShowcase ?? []);
        const oldShowcase = @json($oldShowcaseData);

        function renderBlock({ originalIndex = '', category = '', name = '', description = '', imageSrc = '' }) {
            const html = template.innerHTML
                .replaceAll('__ORIGINAL_INDEX__', originalIndex)
                .replaceAll('__CATEGORY__', escapeHtml(category))
                .replaceAll('__NAME__', escapeHtml(name))
                .replaceAll('__DESCRIPTION__', escapeHtml(description))
                .replaceAll('__IMAGE_SRC__', imageSrc)
                .replaceAll('__IMAGE_DISPLAY__', imageSrc ? '' : 'display:none;');

            const wrapper = document.createElement('div');
            wrapper.innerHTML = html.trim();
            const block = wrapper.firstElementChild;

            block.querySelector('.showcase-remove-btn').addEventListener('click', () => {
                block.remove();
                renumber();
            });

            block.querySelector('[data-showcase-preview]').addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;
                const img = block.querySelector('.showcase-thumb-preview');
                const reader = new FileReader();
                reader.onload = e => { img.src = e.target.result; img.style.display = ''; };
                reader.readAsDataURL(file);
            });

            list.appendChild(block);
        }

        function renumber() {
            list.querySelectorAll('[data-showcase-block]').forEach((block, i) => {
                block.querySelector('.showcase-label-text').textContent = `Item ${i + 1}`;
            });
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        if (oldShowcase) {
            oldShowcase.names.forEach((name, i) => {
                if (!name && !oldShowcase.categories[i] && !oldShowcase.descriptions[i]) return;
                const key = oldShowcase.keys[i] ?? '';
                const existingImg = key !== '' && existingShowcase[key] ? existingShowcase[key].image : null;
                renderBlock({
                    originalIndex: key,
                    category: oldShowcase.categories[i] ?? '',
                    name: name ?? '',
                    description: oldShowcase.descriptions[i] ?? '',
                    imageSrc: existingImg ? `{{ asset('storage') }}/${existingImg}` : '',
                });
            });
        } else if (existingShowcase.length > 0) {
            existingShowcase.forEach((item, i) => {
                renderBlock({
                    originalIndex: i,
                    category: item.category ?? '',
                    name: item.name ?? '',
                    description: item.description ?? '',
                    imageSrc: item.image ? `{{ asset('storage') }}/${item.image}` : '',
                });
            });
        }

        addBtn.addEventListener('click', () => {
            renderBlock({});
            renumber();
        });

        renumber();
    })();

    @if($isEdit)
    const formCsrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function submitKategori() {
        const nameInput = document.getElementById('new_kategori_name');
        if (!nameInput.value.trim()) return alert('Nama kategori tidak boleh kosong!');

        const formData = new FormData();
        formData.append('_token', formCsrfToken);
        formData.append('name', nameInput.value.trim());

        fetch("{{ route('admin.layanan.kategori.store', $layanan) }}", {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.ok ? (window.location.hash = 'galeri', window.location.reload()) : alert('Gagal menyimpan kategori.'));
    }

    function deleteKategori(id, name) {
        if (!confirm(`Hapus kategori '${name}'? Foto terkait akan jadi tanpa kategori.`)) return;

        const formData = new FormData();
        formData.append('_token', formCsrfToken);
        formData.append('_method', 'DELETE');

        fetch(`/admin/layanan/{{ $layanan->slug }}/kategori/${id}`, {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.ok ? (window.location.hash = 'galeri', window.location.reload()) : alert('Gagal menghapus kategori.'));
    }

    function submitGallery() {
        const fileInput = document.getElementById('new_gallery_image');
        const catInput = document.getElementById('new_gallery_category');

        if (fileInput.files.length === 0) return alert('Pilih foto terlebih dahulu!');

        const formData = new FormData();
        formData.append('_token', formCsrfToken);
        formData.append('image', fileInput.files[0]);
        if (catInput.value) formData.append('layanan_kategori_id', catInput.value);

        fetch("{{ route('admin.layanan.gallery.store', $layanan) }}", {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.ok ? (window.location.hash = 'galeri', window.location.reload()) : alert('Gagal mengupload foto.'));
    }

    function deleteGalleryPhoto(id) {
        if (!confirm('Hapus foto ini?')) return;

        const formData = new FormData();
        formData.append('_token', formCsrfToken);
        formData.append('_method', 'DELETE');

        fetch(`/admin/layanan/{{ $layanan->slug }}/gallery-photo/${id}`, {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.ok ? (window.location.hash = 'galeri', window.location.reload()) : alert('Gagal menghapus foto.'));
    }
    @endif
</script>