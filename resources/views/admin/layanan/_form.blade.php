@php
    $isEdit = isset($layanan);
    $existingServices = $isEdit ? ($layanan->services ?? []) : [];
    $existingGallery = $isEdit ? ($layanan->gallery ?? []) : [];
    $existingShowcase = $isEdit ? ($layanan->showcase_items ?? []) : [];
@endphp

<style>
    /* ===== Layout tab ===== */
    .layanan-form-shell { display: flex; gap: 1.5rem; align-items: flex-start; }
    .form-tabs-nav {
        display: flex; flex-direction: column; gap: 0.3rem;
        width: 230px; flex-shrink: 0; position: sticky; top: 1.25rem;
        background: white; border: 1px solid var(--border); border-radius: 10px; padding: 0.6rem;
    }
    .tab-btn {
        display: flex; align-items: center; gap: 0.65rem; text-align: left;
        width: 100%; padding: 0.7rem 0.8rem; border: none; background: transparent;
        border-radius: 7px; font-size: 0.85rem; font-weight: 600; color: var(--neutral);
        cursor: pointer; transition: all 0.15s ease;
    }
    .tab-btn i { width: 18px; text-align: center; font-size: 0.9rem; flex-shrink: 0; }
    .tab-btn:hover { background: rgba(249, 115, 22, 0.06); color: var(--secondary); }
    .tab-btn.active { background: rgba(249, 115, 22, 0.1); color: var(--primary); }
    .tab-btn .tab-dot {
        margin-left: auto; width: 7px; height: 7px; border-radius: 50%; background: #D1D5DB; flex-shrink: 0;
    }
    .tab-btn .tab-dot.filled { background: #10B981; }

    .form-tabs-content { flex: 1; min-width: 0; }
    .tab-panel { display: none; }
    .tab-panel.active { display: block; animation: tabFadeIn 0.2s ease; }
    @keyframes tabFadeIn { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 900px) {
        .layanan-form-shell { flex-direction: column; }
        .form-tabs-nav {
            width: 100%; flex-direction: row; overflow-x: auto; position: static;
            gap: 0.4rem;
        }
        .tab-btn { flex-shrink: 0; width: auto; white-space: nowrap; }
        .tab-btn .tab-dot { margin-left: 0.4rem; }
    }

    /* ===== Isi form (sama seperti sebelumnya) ===== */
    .form-section { background: white; border-radius: 10px; border: 1px solid var(--border); padding: 1.75rem; }
    .form-section-desc { font-size: 0.8rem; color: var(--neutral); margin: -0.75rem 0 1.25rem; }
    .form-section h2 { font-size: 1.05rem; font-weight: 700; color: var(--secondary); margin-bottom: 0.4rem; padding-bottom: 0; border-bottom: none; display: flex; align-items: center; gap: 0.5rem; }
    .form-section h2 i { color: var(--primary); font-size: 0.95rem; }
    .form-section-title-row { padding-bottom: 0.9rem; border-bottom: 1px solid var(--border); margin-bottom: 1.25rem; }

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

    /* ===== Card item Showcase (per baris kategori+nama+deskripsi+foto) ===== */
    .showcase-card {
        border: 1px solid var(--border); border-radius: 8px; padding: 1rem; margin-bottom: 0.85rem;
        background: var(--bg-light);
    }
    .showcase-card-header {
        display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.75rem;
        font-size: 0.78rem; font-weight: 700; color: var(--neutral); text-transform: uppercase; letter-spacing: 0.4px;
    }
    .showcase-card-header .showcase-index {
        width: 22px; height: 22px; border-radius: 50%; background: var(--primary); color: white;
        display: flex; align-items: center; justify-content: center; font-size: 0.72rem; flex-shrink: 0;
    }
    .showcase-remove-btn {
        margin-left: auto; background: rgba(239, 68, 68, 0.1); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.2);
        padding: 0.35rem 0.7rem; border-radius: 6px; font-size: 0.72rem; font-weight: 700; cursor: pointer;
        display: inline-flex; align-items: center; gap: 0.3rem; text-transform: none; letter-spacing: normal;
    }
    .showcase-remove-btn:hover { background: rgba(239, 68, 68, 0.15); }
    .showcase-thumb-row { display: flex; gap: 0.75rem; align-items: flex-start; }
    .showcase-thumb-preview {
        width: 56px; height: 56px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border); flex-shrink: 0;
    }

    .btn-submit-row { display: flex; gap: 0.6rem; margin-top: 1.25rem; }
    .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; text-decoration: none; }
    .btn-save { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3); }
    .btn-cancel { background: var(--border); color: var(--secondary); }
    .btn-cancel:hover { background: #D1D5DB; }
</style>

<div class="layanan-form-shell">

    {{-- ===================== NAVIGASI TAB ===================== --}}
    <div class="form-tabs-nav">
        <button type="button" class="tab-btn active" data-tab="dasar">
            <i class="fas fa-info-circle"></i> Info Dasar
            <span class="tab-dot {{ ($isEdit ? $layanan->title : old('title')) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="media">
            <i class="fas fa-photo-video"></i> Gambar & Video
            <span class="tab-dot {{ ($isEdit && ($layanan->image || $layanan->video_url)) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="icon">
            <i class="fas fa-icons"></i> Icon Layanan
            <span class="tab-dot {{ !empty($existingServices) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="showcase">
            <i class="fas fa-utensils"></i> Showcase
            <span class="tab-dot {{ !empty($existingShowcase) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="galeri">
            <i class="fas fa-images"></i> Galeri Foto
            <span class="tab-dot {{ !empty($existingGallery) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="qr">
            <i class="fas fa-qrcode"></i> QR Order Online
            <span class="tab-dot {{ ($isEdit && ($layanan->qr_shopeefood || $layanan->qr_gofood)) ? 'filled' : '' }}"></span>
        </button>
        <button type="button" class="tab-btn" data-tab="cta">
            <i class="fas fa-bullhorn"></i> Call-to-Action
            <span class="tab-dot {{ ($isEdit && $layanan->cta_title) ? 'filled' : '' }}"></span>
        </button>
    </div>

    {{-- ===================== ISI TAB ===================== --}}
    <div class="form-tabs-content">

        {{-- TAB 1: INFO DASAR --}}
        <div class="tab-panel active" data-panel="dasar">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2><i class="fas fa-info-circle"></i> Info Dasar</h2>
                </div>
                <p class="form-section-desc">Judul, deskripsi, dan teks utama yang tampil di card homepage & halaman detail layanan ini.</p>

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
                        <div class="form-hint">Angka lebih kecil tampil lebih dulu</div>
                    </div>
                    <div class="form-group" style="display: flex; align-items: flex-end; padding-bottom: 0.65rem;">
                        <div class="checkbox-wrap">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $layanan->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active">Tampilkan layanan ini</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB 2: GAMBAR & VIDEO --}}
        <div class="tab-panel" data-panel="media">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2><i class="fas fa-photo-video"></i> Gambar & Video</h2>
                </div>
                <p class="form-section-desc">Gambar utama dipakai di hero & section "Tentang". Video (opsional) tampil di section Penghargaan.</p>

                <div class="form-group">
                    <div class="current-image" id="image-preview" style="{{ ($isEdit && $layanan->image) ? '' : 'display:none;' }}">
                        <img id="image-preview-img" src="{{ ($isEdit && $layanan->image) ? asset('storage/' . $layanan->image) : '' }}" alt="Preview gambar utama">
                    </div>
                    <label for="image">{{ $isEdit ? 'Ganti Gambar Utama' : 'Upload Gambar Utama' }}</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <div class="form-hint">JPG/PNG/WEBP, maks 2MB.</div>
                </div>

                <div class="form-group">
                    <label for="video_url">Link Video Promo YouTube (Opsional)</label>
                    <input type="text" id="video_url" name="video_url" value="{{ old('video_url', $layanan->video_url ?? '') }}" placeholder="https://youtube.com/watch?v=...">
                    <div class="form-hint">Muncul di section "Penghargaan" sebagai video yang bisa diputar</div>
                    @error('video_url')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <div class="current-image" id="bg-image-preview" style="{{ ($isEdit && $layanan->bg_image) ? '' : 'display:none;' }}">
                        <img id="bg-image-preview-img" src="{{ ($isEdit && $layanan->bg_image) ? asset('storage/' . $layanan->bg_image) : '' }}" alt="Preview background section video">
                    </div>
                    <label for="bg_image">Foto Background Section Video (Opsional)</label>
                    <input type="file" id="bg_image" name="bg_image" accept="image/*">
                    <div class="form-hint">Kalau kosong, otomatis pakai gambar utama layanan ini sebagai background</div>
                    @error('bg_image')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- TAB 3: ICON LAYANAN --}}
        <div class="tab-panel" data-panel="icon">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2><i class="fas fa-icons"></i> Icon Layanan</h2>
                </div>
                <p class="form-section-desc">Baris icon kecil di bawah judul "LAYANAN {{ strtoupper($layanan->title ?? '...') }}" pada halaman detail. Isi nama tiap icon, foto opsional. Kosongkan baris yang tidak dipakai, isi berurutan dari atas.</p>

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
        </div>

        {{-- TAB 4: SHOWCASE --}}
        <div class="tab-panel" data-panel="showcase">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2><i class="fas fa-utensils"></i> Showcase (Carousel)</h2>
                </div>
                <p class="form-section-desc">Carousel yang nampilin daftar menu/fasilitas/item unggulan layanan ini — misalnya untuk Resto & Cafe: kategori "Makanan"/"Minuman" + nama menunya. Tambah item sesuai kebutuhan, tidak ada batas jumlah.</p>

                <div class="form-row">
                    <div class="form-group">
                        <label for="showcase_title">Judul Section</label>
                        <input type="text" id="showcase_title" name="showcase_title" value="{{ old('showcase_title', $layanan->showcase_title ?? '') }}" placeholder="Contoh: MENU FAVORIT RESTO & CAFE">
                    </div>
                    <div class="form-group">
                        <label for="showcase_subtitle">Subjudul Section</label>
                        <input type="text" id="showcase_subtitle" name="showcase_subtitle" value="{{ old('showcase_subtitle', $layanan->showcase_subtitle ?? '') }}" placeholder="Contoh: CITA RASA KHAS BALONG HARDI">
                    </div>
                </div>

                <div id="showcaseList"></div>

                <button type="button" id="addShowcaseItemBtn" class="btn btn-cancel" style="margin-top: 0.5rem;">
                    <i class="fas fa-plus"></i> Tambah Item
                </button>

                <template id="showcaseItemTemplate">
                    <div class="showcase-card" data-showcase-block>
                        <div class="showcase-card-header">
                            <span class="showcase-index"><i class="fas fa-utensils" style="font-size: 0.65rem;"></i></span>
                            <span class="showcase-label-text">Item</span>
                            <button type="button" class="showcase-remove-btn" title="Hapus item ini">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>

                        <input type="hidden" name="showcase_keys[]" value="__ORIGINAL_INDEX__">

                        <div class="form-row" style="margin-bottom: 0.65rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Kategori</label>
                                <input type="text" name="showcase_categories[]" placeholder="Makanan / Minuman / Kamar" value="__CATEGORY__">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Nama Item</label>
                                <input type="text" name="showcase_names[]" placeholder="Contoh: Nasi Goreng Kampung" value="__NAME__">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0.65rem;">
                            <label>Deskripsi Singkat</label>
                            <textarea name="showcase_descriptions[]" style="min-height: 50px;">__DESCRIPTION__</textarea>
                        </div>

                        <div class="showcase-thumb-row">
                            <img class="showcase-thumb-preview" alt="Foto item" src="__IMAGE_SRC__" style="__IMAGE_DISPLAY__">
                            <div style="flex: 1;">
                                <label>Foto</label>
                                <input type="file" name="showcase_images[]" accept="image/*" data-showcase-preview>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

       {{-- TAB 5: GALERI FOTO (Versi AJAX) --}}
        <div class="tab-panel" data-panel="galeri">
            <div class="form-section" style="margin-bottom: 1.25rem;">
                <div class="form-section-title-row">
                    <h2><i class="fas fa-images"></i> Galeri Foto</h2>
                </div>

                @if(!$isEdit)
                    <p class="form-section-desc" style="margin-bottom: 0;">
                        Simpan layanan ini dulu (klik "Simpan Layanan" di bawah), nanti kelola kategori & upload foto galeri di halaman Edit.
                    </p>
                @else
                    <p class="form-section-desc">Kategori & foto di sini khusus milik layanan <strong>{{ $layanan->title }}</strong> — tidak dipakai bareng layanan lain.</p>

                    {{-- ===== Sub-CRUD: Kategori ===== --}}
                    <div style="margin-bottom: 1.5rem;">
                        <label style="margin-bottom: 0.6rem;">Kategori Galeri</label>

                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.85rem;">
                            @forelse($layanan->kategoris as $kategori)
                                <button type="button" onclick="deleteKategori({{ $kategori->id }}, '{{ addslashes($kategori->name) }}')" style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.7rem; border-radius: 999px; border: 1px solid var(--border); background: white; font-size: 0.8rem; font-weight: 600; color: var(--secondary); cursor: pointer;">
                                    {{ $kategori->name }}
                                    <i class="fas fa-times" style="color: var(--danger); font-size: 0.7rem;"></i>
                                </button>
                            @empty
                                <span style="font-size: 0.82rem; color: var(--neutral); font-style: italic;">Belum ada kategori.</span>
                            @endforelse
                        </div>

                        <div style="display: flex; gap: 0.5rem;">
                            <input type="text" id="new_kategori_name" placeholder="Nama kategori baru, contoh: Interior" style="flex: 1; padding: 0.65rem 0.8rem; border: 1px solid var(--border); border-radius: 6px;">
                            <button type="button" class="btn btn-cancel" onclick="submitKategori()" style="white-space: nowrap;"><i class="fas fa-plus"></i> Tambah</button>
                        </div>
                    </div>

                    {{-- ===== Sub-CRUD: Upload Foto ===== --}}
                    <div style="border-top: 1px solid var(--border); padding-top: 1.25rem;">
                        <label style="margin-bottom: 0.6rem;">Tambah Foto</label>
                        <div class="form-row">
                            <div class="form-group">
                                {{-- Nama id diubah agar tidak bentrok dengan image utama form --}}
                                <input type="file" id="new_gallery_image" accept="image/*" required>
                            </div>
                            <div class="form-group" style="display: flex; gap: 0.5rem;">
                                <select id="new_gallery_category" style="flex: 1; padding: 0.65rem 0.8rem; border: 1px solid var(--border); border-radius: 6px;">
                                    <option value="">Tanpa Kategori</option>
                                    @foreach($layanan->kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-save" onclick="submitGallery()" style="white-space: nowrap;"><i class="fas fa-upload"></i> Upload</button>
                            </div>
                        </div>
                    </div>

                    {{-- ===== List foto yang sudah ada ===== --}}
                    @if($layanan->galleries->isNotEmpty())
                        <div style="border-top: 1px solid var(--border); padding-top: 1.25rem; margin-top: 0.5rem;">
                            <label style="margin-bottom: 0.75rem;">Foto Tersimpan ({{ $layanan->galleries->count() }})</label>
                            <div class="gallery-grid">
                                @foreach($layanan->galleries as $photo)
                                    <div class="gallery-item">
                                        <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->kategori->name ?? 'Galeri' }}">
                                        <button type="button" class="gallery-remove-btn" onclick="deleteGalleryPhoto({{ $photo->id }})" title="Hapus foto ini">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <span style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: rgba(0,0,0,0.65); color: white; font-size: 0.65rem; font-weight: 600; padding: 0.15rem 0.4rem; border-radius: 4px; text-align: center; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            {{ $photo->kategori->name ?? 'Tanpa kategori' }}
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
                    <h2><i class="fas fa-qrcode"></i> QR Code Order Online</h2>
                </div>
                <p class="form-section-desc">Section ini otomatis tersembunyi di halaman detail kalau kedua QR kosong.</p>

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
        </div>

        {{-- TAB 7: CALL-TO-ACTION --}}
        <div class="tab-panel" data-panel="cta">
            <div class="form-section">
                <div class="form-section-title-row">
                    <h2><i class="fas fa-bullhorn"></i> Call-to-Action (Bawah Halaman)</h2>
                </div>
                <p class="form-section-desc">Judul & subjudul ajakan reservasi yang tampil paling bawah halaman detail.</p>

                <div class="form-group">
                    <label for="cta_title">Judul CTA</label>
                    <input type="text" id="cta_title" name="cta_title" value="{{ old('cta_title', $layanan->cta_title ?? '') }}" placeholder="DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA">
                </div>
                <div class="form-group">
                    <label for="cta_subtitle">Subjudul CTA (opsional)</label>
                    <input type="text" id="cta_subtitle" name="cta_subtitle" value="{{ old('cta_subtitle', $layanan->cta_subtitle ?? '') }}">
                </div>
            </div>
        </div>

    </div>
</div>

<div class="btn-submit-row">
    <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Layanan' }}</button>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-cancel"><i class="fas fa-times"></i> Batal</a>
</div>

<script>
    // ---------- Tab switcher ----------
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

    // Buka tab sesuai fragment URL (misal habis redirect dari form Kategori/Galeri)
    if (location.hash) {
        const tabName = location.hash.replace('#', '');
        const targetBtn = document.querySelector(`.tab-btn[data-tab="${tabName}"]`);
        if (targetBtn) targetBtn.click();
    }

    // Kalau ada error validasi, buka otomatis tab pertama yang punya field error (prioritas di atas hash)
    @if($errors->any())
        const firstErrorField = document.querySelector('.form-error')?.closest('.tab-panel');
        if (firstErrorField) {
            const panelName = firstErrorField.dataset.panel;
            document.querySelector(`.tab-btn[data-tab="${panelName}"]`)?.click();
        }
    @endif
})();

    // ---------- Live image preview (main image, bg image, QR codes, service icons, showcase icons, gallery) ----------
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

        // Thumbnail kecil (icon layanan & showcase) — pola sama, dipasangi lewat data-preview-target
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

    // ---------- Showcase: render existing items + tambah/hapus dinamis ----------
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

        // Kalau ada old() input (submit gagal validasi), render ulang dari situ biar isian gak ilang
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

        addBtn.addEventListener('click', () => renderBlock({}));

        renumber();
    })();

    @if($isEdit)
    const formCsrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Tambah Kategori AJAX
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

    // Hapus Kategori AJAX
    function deleteKategori(id, name) {
        if (!confirm(`Hapus kategori '${name}'? Foto terkait akan jadi tanpa kategori.`)) return;

        const formData = new FormData();
        formData.append('_token', formCsrfToken);
        formData.append('_method', 'DELETE');

        fetch(`/admin/layanan/{{ $layanan->id }}/kategori/${id}`, {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.ok ? (window.location.hash = 'galeri', window.location.reload()) : alert('Gagal menghapus kategori.'));
    }

    // Upload Foto AJAX
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

    // Hapus Foto AJAX
    function deleteGalleryPhoto(id) {
        if (!confirm('Hapus foto ini?')) return;

        const formData = new FormData();
        formData.append('_token', formCsrfToken);
        formData.append('_method', 'DELETE');

        fetch(`/admin/layanan/{{ $layanan->id }}/gallery-photo/${id}`, {
            method: 'POST',
            body: formData,
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.ok ? (window.location.hash = 'galeri', window.location.reload()) : alert('Gagal menghapus foto.'));
    }
    @endif

</script>