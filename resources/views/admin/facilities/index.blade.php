@extends('layouts.admin')
@section('title', 'Kelola Fasilitas')
@section('content')

<style>
    .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; gap: 1rem; flex-wrap: wrap; }
    .section-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0; }
    .section-header-desc { font-size: 0.85rem; color: var(--neutral); margin: 0; }

    .btn-create {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white; padding: 0.7rem 1.5rem; border: none; border-radius: 8px;
        font-weight: 600; font-size: 0.9rem; cursor: pointer; text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s ease; white-space: nowrap;
    }
    .btn-create:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3); }

    .table-card { background: white; border-radius: 10px; border: 1px solid var(--border); overflow: hidden; }
    .table-responsive { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: linear-gradient(135deg, var(--secondary) 0%, #111827 100%); color: white; }
    th { padding: 0.9rem; text-align: left; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
    td { padding: 0.9rem; border-bottom: 1px solid var(--border); font-size: 0.9rem; vertical-align: middle; }
    tbody tr:hover { background: rgba(249, 115, 22, 0.03); }

    .image-cell img { width: 56px; height: 56px; border-radius: 8px; object-fit: cover; border: 1px solid var(--border); }
    .title-cell { font-weight: 600; color: var(--secondary); }
    .desc-cell { color: var(--neutral); max-width: 300px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }

    .badge { display: inline-block; padding: 0.4rem 0.75rem; border-radius: 5px; font-size: 0.8rem; font-weight: 600; }
    .badge-active { background: rgba(16, 185, 129, 0.15); color: #047857; }
    .badge-inactive { background: rgba(107, 114, 128, 0.15); color: var(--neutral); }

    .action-group { display: flex; gap: 0.5rem; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 0.8rem; border: 1px solid; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer; }
    .btn-edit { background: rgba(59, 130, 246, 0.1); color: #3B82F6; border-color: rgba(59, 130, 246, 0.2); }
    .btn-edit:hover { background: rgba(59, 130, 246, 0.15); }
    .btn-delete { background: rgba(239, 68, 68, 0.1); color: #EF4444; border-color: rgba(239, 68, 68, 0.2); }
    .btn-delete:hover { background: rgba(239, 68, 68, 0.15); }

    .empty-container { text-align: center; padding: 3rem 1.5rem; }
    .empty-icon { font-size: 3rem; color: #D1D5DB; margin-bottom: 1rem; }
    .empty-text { color: var(--neutral); font-size: 0.95rem; margin: 0 0 1.5rem 0; }

    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2000; overflow-y: auto; }
    .modal-overlay.active { display: flex; align-items: center; justify-content: center; }
    .modal-content { background: white; border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; position: relative; margin: auto; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
    .modal-header { margin-bottom: 1.5rem; }
    .modal-header h2 { font-size: 1.25rem; font-weight: 700; color: var(--secondary); margin: 0 0 0.25rem 0; }
    .modal-header p { font-size: 0.85rem; color: var(--neutral); margin: 0; }
    .modal-close { position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; color: var(--neutral); cursor: pointer; width: 2rem; height: 2rem; border-radius: 6px; }
    .modal-close:hover { background: var(--border); color: var(--secondary); }

    .form-group { margin-bottom: 1.1rem; }
    label { display: block; font-weight: 700; color: var(--secondary); margin-bottom: 0.4rem; font-size: 0.85rem; }
    .required { color: var(--danger); margin-left: 0.2rem; }
    input[type="text"], input[type="number"], input[type="file"], textarea {
        width: 100%; padding: 0.65rem 0.8rem; border: 1px solid var(--border); border-radius: 6px;
        font-family: inherit; font-size: 0.9rem; box-sizing: border-box;
    }
    textarea { resize: vertical; min-height: 80px; }
    input:focus, textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1); }
    .form-hint { font-size: 0.75rem; color: var(--neutral); margin-top: 0.3rem; }

    .checkbox-wrap { display: flex; align-items: center; gap: 0.5rem; }
    input[type="checkbox"] { width: 1rem; height: 1rem; accent-color: var(--primary); }
    .checkbox-wrap label { margin: 0; font-weight: 500; font-size: 0.9rem; cursor: pointer; }

    .form-actions { display: flex; gap: 0.6rem; margin-top: 1.5rem; }
    .btn { flex: 1; padding: 0.75rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.4rem; }
    .btn-save { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3); }
    .btn-cancel { background: var(--border); color: var(--secondary); }
    .btn-cancel:hover { background: #D1D5DB; }

    .image-preview { margin-bottom: 1rem; }
    .image-preview img { max-width: 100px; border-radius: 8px; border: 1px solid var(--border); }

    @media (max-width: 768px) {
        .section-header { flex-direction: column; align-items: flex-start; }
        .btn-create { width: 100%; justify-content: center; }
        th, td { padding: 0.7rem; font-size: 0.8rem; }
        .title-cell, .desc-cell { max-width: 140px; }
        .modal-content { padding: 1.5rem; margin: 1rem; }
        .form-actions { flex-direction: column; }
    }
</style>

<div class="section-header">
    <div>
        <h1>Kelola Fasilitas</h1>
        <p class="section-header-desc">Card fasilitas yang tampil di section "Fasilitas Kami" homepage & halaman "Lihat Semua Fasilitas"</p>
    </div>
    <button class="btn-create" onclick="openModal('addModal')">
        <i class="fas fa-plus"></i> Tambah Fasilitas
    </button>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($facilities as $facility)
                    <tr>
                        <td class="image-cell">
                            <img src="{{ $facility->image ? asset('storage/' . $facility->image) : asset('images/bhs2.jpg') }}" alt="{{ $facility->title }}">
                        </td>
                        <td class="title-cell">{{ $facility->title }}</td>
                        <td class="desc-cell">{{ $facility->description }}</td>
                        <td>{{ $facility->order }}</td>
                        <td>
                            <span class="badge {{ $facility->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $facility->is_active ? '✓ Aktif' : '✗ Nonaktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                <button onclick="openEditFacilityModal(this)"
                                    class="btn-icon btn-edit"
                                    data-facility-id="{{ $facility->id }}"
                                    data-title="{{ $facility->title }}"
                                    data-description="{{ $facility->description }}"
                                    data-order="{{ $facility->order }}"
                                    data-is-active="{{ $facility->is_active }}"
                                    data-image="{{ $facility->image }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" onsubmit="return confirm('Yakin hapus fasilitas ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-container">
                                <div class="empty-icon">🏊</div>
                                <p class="empty-text">Belum ada fasilitas</p>
                                <button class="btn-create" onclick="openModal('addModal')"><i class="fas fa-plus"></i> Tambah Fasilitas</button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add -->
<div class="modal-overlay" id="addModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('addModal')">&times;</button>
        <div class="modal-header">
            <h2>🏊 Tambah Fasilitas</h2>
            <p>Tambahkan fasilitas baru</p>
        </div>
        <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Kolam Pemancingan Utama" required>
                @error('title')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Singkat</label>
                <textarea id="description" name="description" placeholder="Contoh: Kolam luas untuk lomba & rekreasi.">{{ old('description') }}</textarea>
                @error('description')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="image">Gambar (Opsional)</label>
                <input type="file" id="image" name="image" accept="image/*">
                <div class="form-hint">JPG, PNG, WEBP · Maks 2MB</div>
            </div>
            <div class="form-group">
                <label for="order">Urutan Tampil</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}">
                <div class="form-hint">Item urutan pertama otomatis jadi foto besar di homepage</div>
            </div>
            <div class="form-group">
                <div class="checkbox-wrap">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active">Tampilkan fasilitas ini</label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-cancel" onclick="closeModal('addModal')"><i class="fas fa-times"></i> Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('editModal')">&times;</button>
        <div class="modal-header">
            <h2>✏️ Edit Fasilitas</h2>
            <p>Perbarui data fasilitas</p>
        </div>
        <form action="" method="POST" id="editForm" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit_title">Judul <span class="required">*</span></label>
                <input type="text" id="edit_title" name="title" required>
            </div>
            <div class="form-group">
                <label for="edit_description">Deskripsi Singkat</label>
                <textarea id="edit_description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="edit_image">Gambar</label>
                <div id="edit_image_preview" class="image-preview"></div>
                <input type="file" id="edit_image" name="image" accept="image/*" onchange="previewImageFacility()">
                <div class="form-hint">Kosongkan kalau tidak mau ganti gambar</div>
            </div>
            <div class="form-group">
                <label for="edit_order">Urutan Tampil</label>
                <input type="number" id="edit_order" name="order">
            </div>
            <div class="form-group">
                <div class="checkbox-wrap">
                    <input type="checkbox" id="edit_is_active" name="is_active" value="1">
                    <label for="edit_is_active">Tampilkan fasilitas ini</label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-save"><i class="fas fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-cancel" onclick="closeModal('editModal')"><i class="fas fa-times"></i> Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    function openEditFacilityModal(button) {
        const id = button.getAttribute('data-facility-id');
        const image = button.getAttribute('data-image');

        document.getElementById('editForm').action = `/admin/facilities/${id}`;
        document.getElementById('edit_title').value = button.getAttribute('data-title');
        document.getElementById('edit_description').value = button.getAttribute('data-description') || '';
        document.getElementById('edit_order').value = button.getAttribute('data-order') || 0;
        document.getElementById('edit_is_active').checked = button.getAttribute('data-is-active') == 1;

        const previewDiv = document.getElementById('edit_image_preview');
        previewDiv.innerHTML = (image && image !== 'null' && image !== '')
            ? `<img src="{{ asset('storage/') }}/${image}" alt="Preview">`
            : '';

        openModal('editModal');
    }
    function previewImageFacility() {
        const file = document.getElementById('edit_image').files[0];
        const preview = document.getElementById('edit_image_preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = e => preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            reader.readAsDataURL(file);
        }
    }
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) { if (e.target === this) closeModal(this.id); });
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') document.querySelectorAll('.modal-overlay.active').forEach(m => closeModal(m.id));
    });
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => openModal('addModal'));
    @endif
</script>

@endsection