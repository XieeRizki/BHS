@extends('layouts.admin')

@section('title', 'Kelola Informasi & Berita')

@section('content')
<style>
    /* Styling khusus untuk form Informasi & Berita (mengadopsi styling Dashboard BHS) */
    .admin-header {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .admin-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 0.25rem;
    }
    .admin-header p {
        font-size: 0.9rem;
        color: var(--neutral);
    }
    
    /* Tabs Navigation */
    .tab-nav {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--border);
        padding-bottom: 0.5rem;
    }
    .tab-btn {
        background: transparent;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        color: var(--neutral);
        cursor: pointer;
        border-radius: 8px 8px 0 0;
        transition: all 0.2s ease;
        position: relative;
    }
    .tab-btn:hover {
        color: var(--primary);
        background: rgba(249, 115, 22, 0.05);
    }
    .tab-btn.active {
        color: var(--primary);
    }
    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -0.65rem;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary);
        border-radius: 3px;
    }

    /* Form Card Container */
    .form-card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        border: 1px solid var(--border);
        display: none; /* Disembunyikan secara default, diatur via JS */
        animation: fadeIn 0.3s ease;
    }
    .form-card.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        display: block;
        font-weight: 600;
        color: var(--secondary);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.95rem;
        color: var(--secondary);
        transition: border-color 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }
    
    /* Checkbox/Switch Styling */
    .switch-container {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }
    .switch-container input[type="checkbox"] {
        width: 1.25rem;
        height: 1.25rem;
        accent-color: var(--primary);
    }

    /* Button Styling */
    .btn-submit {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-submit:hover {
        background-color: #ea580c; /* Warna primary lebih gelap */
    }
</style>

<div class="admin-header">
    <div>
        <h1>Kelola Informasi & Berita</h1>
        <p>Tambahkan konten berita harian atau artikel fitur/spotlight BHS.</p>
    </div>
</div>

<!-- Tabs -->
<div class="tab-nav">
    <button class="tab-btn active" onclick="switchTab('berita')">
        <i class="fas fa-newspaper mr-2"></i> Form Berita Kegiatan
    </button>
    <button class="tab-btn" onclick="switchTab('artikel')">
        <i class="fas fa-star mr-2"></i> Form Artikel Spotlight
    </button>
</div>

<!-- FORM 1: BERITA BIASA -->
<div id="form-berita" class="form-card active">
    <h2 class="text-xl font-bold mb-4 text-[var(--secondary)]">Tambah Berita Baru</h2>
    <!-- TODO Backend: Arahkan action ke route store yang sesuai -->
    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="berita">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label class="form-label">Judul Berita</label>
                <input type="text" name="title" class="form-control" placeholder="Contoh: Lomba Mancing Mania BHS 2026" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <!-- Pastikan value untuk opsi default ini kosong -->
                    <option value="">-- Pilih Kategori --</option>
                    
                    <!-- Looping data kategori dari database -->
                    @foreach($categories as $kategori)
                        <!-- YANG PALING PENTING: value-nya harus ID, teks yang tampil bebas -->
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Gambar Thumbnail (Cover)</label>
            <input type="file" name="cover_image" class="form-control" accept="image/*">

            <!-- Teks Pemberitahuan -->
            <p class="text-xs text-gray-500 mt-1.5">
                * Format yang diizinkan: JPG, JPEG, PNG, atau WEBP. Maksimal ukuran file <strong>2 MB</strong>.
            </p>
        </div>

        <div class="form-group">
            <label class="form-label">Kutipan Singkat (Excerpt)</label>
            <textarea name="excerpt" class="form-control" rows="2" placeholder="Teks singkat yang muncul di kartu berita..."></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Konten Lengkap Berita</label>
            <!-- TODO Backend: Pasang WYSIWYG Editor (misal TinyMCE/CKEditor) di sini -->
            <textarea name="content" class="form-control" rows="6" placeholder="Tulis isi berita selengkapnya di sini..." required></textarea>
        </div>


        <div class="mb-4">
            <h4 class="font-bold text-gray-700 mb-2">Penempatan Khusus di Halaman Informasi</h4>
            <p class="text-sm text-gray-500 mb-3">Pilih di mana berita ini akan disorot pada halaman depan.</p>
            
            <div class="flex items-center mb-2">
                <input type="checkbox" name="is_spotlight" id="spotlightBerita" value="1" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500">
                <label for="spotlightBerita" class="ml-2 text-sm font-medium text-gray-900">Jadikan <strong>Spotlight</strong> (Maks 4 artikel di Sidebar Atas)</label>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_featured" id="featuredBerita" value="1" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500">
                <label for="featuredBerita" class="ml-2 text-sm font-medium text-gray-900">Jadikan <strong>Menarik Tuk Disimak</strong> (1 artikel besar di Sidebar Bawah)</label>
            </div>
        </div>

        <button type="submit" class="btn-submit mt-4">
            <i class="fas fa-save"></i> Simpan Berita
        </button>
    </form>
</div>

<!-- FORM 2: ARTIKEL SPOTLIGHT / FEATURED -->
<div id="form-artikel" class="form-card">
    <h2 class="text-xl font-bold mb-4 text-[var(--secondary)]">Tambah Artikel Khusus</h2>
    <!-- TODO Backend: Arahkan action ke route store yang sesuai -->
    <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type" value="artikel">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="title" class="form-control" placeholder="Contoh: 5 Tips Memancing Galatama untuk Pemula" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <!-- Pastikan value untuk opsi default ini kosong -->
                    <option value="">-- Pilih Kategori --</option>
                    
                    <!-- Looping data kategori dari database -->
                    @foreach($categories as $kategori)
                        <!-- YANG PALING PENTING: value-nya harus ID, teks yang tampil bebas -->
                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Gambar Thumbnail (Cover)</label>
            <input type="file" name="cover_image" class="form-control" accept="image/*">

            <!-- Teks Pemberitahuan -->
            <p class="text-xs text-gray-500 mt-1.5">
                * Format yang diizinkan: JPG, JPEG, PNG, atau WEBP. Maksimal ukuran file <strong>2 MB</strong>.
            </p>
        </div>

        <div class="form-group">
            <label class="form-label">Konten Lengkap Artikel</label>
            <!-- TODO Backend: Pasang WYSIWYG Editor di sini -->
            <textarea name="content" class="form-control" rows="8" placeholder="Tulis isi artikel selengkapnya di sini..." required></textarea>
        </div>

        <div class="form-group p-4 bg-gray-50 border border-gray-200 rounded-lg">
            <label class="form-label text-md">Penempatan Khusus di Halaman Informasi</label>
            <p class="text-sm text-gray-500 mb-3">Pilih di mana artikel ini akan disorot pada halaman depan.</p>
            
            <div class="switch-container">
                <input type="checkbox" id="is_spotlight" name="is_spotlight" value="1">
                <label for="is_spotlight" class="font-medium text-[var(--secondary)] cursor-pointer">
                    Jadikan <b>Spotlight</b> (Maks 4 artikel di Sidebar Atas)
                </label>
            </div>
            
            <div class="switch-container mt-2">
                <input type="checkbox" id="is_featured" name="is_featured" value="1">
                <label for="is_featured" class="font-medium text-[var(--secondary)] cursor-pointer">
                    Jadikan <b>Menarik Tuk Disimak</b> (1 artikel besar di Sidebar Bawah)
                </label>
            </div>
        </div>

        <button type="submit" class="btn-submit mt-4">
            <i class="fas fa-star"></i> Simpan Artikel Khusus
        </button>
    </form>
</div>


<script>
    // Fungsi sederhana untuk pindah-pindah tab form
    function switchTab(tabName) {
        // Hilangkan state active dari semua tombol tab
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Sembunyikan semua form
        document.querySelectorAll('.form-card').forEach(card => {
            card.classList.remove('active');
        });

        // Aktifkan tombol dan form yang dipilih
        if (tabName === 'berita') {
            document.querySelectorAll('.tab-btn')[0].classList.add('active');
            document.getElementById('form-berita').classList.add('active');
        } else if (tabName === 'artikel') {
            document.querySelectorAll('.tab-btn')[1].classList.add('active');
            document.getElementById('form-artikel').classList.add('active');
        }
    }
</script>
@endsection
