@extends('layouts.admin')
@section('title', 'Kelola Infografis')
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
        gap: 1rem;
    }

    .header-left {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .admin-page-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: -0.01em;
    }

    .admin-page-subtitle {
        font-size: 0.825rem;
        color: #6B7280;
        margin: 0;
        font-weight: 500;
    }

    /* Buttons */
    .btn-bhs-primary {
        background: #EAB308;
        color: #0A0A0A;
        font-weight: 800;
        font-size: 0.825rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2);
        white-space: nowrap;
    }

    .btn-bhs-primary:hover {
        background: #CA8A04;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(234, 179, 8, 0.3);
    }

    /* Table Component */
    .table-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #111827;
        color: #FFFFFF;
    }

    th {
        padding: 1rem;
        text-align: left;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid #E5E7EB;
        font-size: 0.875rem;
        vertical-align: middle;
        color: #374151;
    }

    tbody tr:hover {
        background: #FFFBEB;
    }

    .image-cell img {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E5E7EB;
        background: #F3F4F6;
    }

    .value-cell {
        font-weight: 800;
        color: #111827;
        font-size: 1rem;
    }

    .title-cell {
        font-weight: 700;
        color: #111827;
        font-size: 0.9rem;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .badge-active {
        background: #ECFDF5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }

    .badge-inactive {
        background: #F3F4F6;
        color: #6B7280;
        border: 1px solid #E5E7EB;
    }

    /* Action Buttons (teks, tanpa icon) */
    .action-group {
        display: flex;
        gap: 0.4rem;
        justify-content: center;
        align-items: center;
    }

    .action-group form {
        margin: 0;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 34px;
        padding: 0 0.85rem;
        border-radius: 10px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        font-family: inherit;
    }

    .btn-edit { background: #EFF6FF; color: #2563EB; border-color: #BFDBFE; }
    .btn-edit:hover { background: #2563EB; color: #FFFFFF; border-color: #2563EB; }

    .btn-delete { background: #FEF2F2; color: #DC2626; border-color: #FCA5A5; }
    .btn-delete:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    .empty-container {
        text-align: center;
        padding: 4rem 1.5rem;
    }

    .empty-text {
        color: #6B7280;
        font-size: 0.9rem;
        margin: 0 0 1.25rem 0;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, 0.55);
        z-index: 2000;
        overflow-y: auto;
        padding: 1rem;
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E5E7EB;
        padding: 1.75rem;
        max-width: 480px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        margin: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.18);
    }

    .modal-header {
        margin-bottom: 1.25rem;
        padding-bottom: 0.9rem;
        border-bottom: 1px solid #F3F4F6;
        padding-right: 2rem;
    }

    .modal-header h2 {
        font-size: 1.05rem;
        font-weight: 800;
        color: #111827;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin: 0 0 0.25rem 0;
    }

    .modal-header p {
        font-size: 0.8rem;
        color: #6B7280;
        margin: 0;
        font-weight: 500;
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        line-height: 1;
        color: #6B7280;
        cursor: pointer;
        width: 2rem;
        height: 2rem;
        border-radius: 8px;
    }

    .modal-close:hover {
        background: #F3F4F6;
        color: #111827;
    }

    /* Form */
    .form-group {
        margin-bottom: 1.15rem;
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

    .required {
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

    .image-preview {
        margin-bottom: 0.75rem;
    }

    .image-preview img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #E5E7EB;
    }

    .form-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .btn-bhs-save {
        background: #EAB308;
        color: #0A0A0A;
        font-weight: 900;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.85rem 1.25rem;
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
        padding: 0.85rem 1.25rem;
        border-radius: 12px;
        border: 1px solid #D1D5DB;
        cursor: pointer;
        width: 120px;
        transition: all 0.2s ease;
    }

    .btn-bhs-cancel:hover {
        background: #F9FAFB;
        color: #111827;
    }

    @media (max-width: 768px) {
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .btn-bhs-primary {
            width: 100%;
        }
        th, td { padding: 0.75rem; }
        .modal-content { padding: 1.25rem; }
        .form-actions { flex-direction: column; }
        .btn-bhs-cancel { width: 100%; }
    }
</style>

<!-- Header Page -->
<div class="admin-page-header">
    <div class="header-left">
        <h1 class="admin-page-title">Kelola Infografis</h1>
        <p class="admin-page-subtitle">Angka pencapaian yang tampil di section "Momentum Kebersamaan Kita" halaman Profile</p>
    </div>
    <button type="button" class="btn-bhs-primary" onclick="openModal('addModal')">
        Tambah Infografis
    </button>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Value</th>
                    <th>Judul</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 150px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stats as $stat)
                    <tr>
                        <td class="image-cell">
                            <img src="{{ $stat->image ? asset('storage/' . $stat->image) : asset('images/bhs2.jpg') }}" alt="{{ $stat->title }}">
                        </td>
                        <td class="value-cell">{{ $stat->value }}</td>
                        <td class="title-cell">{{ $stat->title }}</td>
                        <td style="font-weight: 700;">{{ $stat->order }}</td>
                        <td>
                            @if($stat->is_active)
                                <span class="badge badge-active">Aktif</span>
                            @else
                                <span class="badge badge-inactive">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <button type="button" onclick="openEditStatModal(this)"
                                    class="btn-action btn-edit"
                                    title="Edit Infografis"
                                    data-stat-id="{{ $stat->id }}"
                                    data-title="{{ $stat->title }}"
                                    data-value="{{ $stat->value }}"
                                    data-order="{{ $stat->order }}"
                                    data-is-active="{{ $stat->is_active }}"
                                    data-image="{{ $stat->image }}">
                                    Edit
                                </button>
                                <form action="{{ route('admin.stats.destroy', $stat) }}" method="POST" onsubmit="return confirm('Yakin hapus infografis ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-container">
                                <p class="empty-text">Belum ada data infografis.</p>
                                <button type="button" class="btn-bhs-primary" onclick="openModal('addModal')">
                                    Tambah Infografis
                                </button>
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
        <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        <div class="modal-header">
            <h2>Tambah Infografis</h2>
            <p>Tambahkan angka pencapaian baru</p>
        </div>
        <form action="{{ route('admin.stats.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="value">Value / Angka <span class="required">*</span></label>
                <input type="text" id="value" name="value" class="input-control" value="{{ old('value') }}" placeholder="Contoh: 3300+" required>
                @error('value')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="title">Judul / Label <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="input-control" value="{{ old('title') }}" placeholder="Contoh: Pemancing" required>
                @error('title')<div class="form-error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="image">Gambar (Opsional)</label>
                <input type="file" id="image" name="image" class="input-control" accept="image/*">
                <div class="form-hint">JPG, PNG, WEBP · Maks 2MB</div>
            </div>
            <div class="form-group">
                <label for="order">Urutan Tampil</label>
                <input type="number" id="order" name="order" class="input-control" value="{{ old('order', 0) }}">
            </div>
            <div class="form-group">
                <div class="checkbox-wrap">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active">Tampilkan infografis ini</label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-bhs-save">Simpan Infografis</button>
                <button type="button" class="btn-bhs-cancel" onclick="closeModal('addModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        <div class="modal-header">
            <h2>Edit Infografis</h2>
            <p>Perbarui angka pencapaian</p>
        </div>
        <form action="" method="POST" id="editForm" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="edit_value">Value / Angka <span class="required">*</span></label>
                <input type="text" id="edit_value" name="value" class="input-control" required>
            </div>
            <div class="form-group">
                <label for="edit_title">Judul / Label <span class="required">*</span></label>
                <input type="text" id="edit_title" name="title" class="input-control" required>
            </div>
            <div class="form-group">
                <label for="edit_image">Gambar</label>
                <div id="edit_image_preview" class="image-preview"></div>
                <input type="file" id="edit_image" name="image" class="input-control" accept="image/*" onchange="previewImageStat()">
                <div class="form-hint">Kosongkan kalau tidak mau ganti gambar</div>
            </div>
            <div class="form-group">
                <label for="edit_order">Urutan Tampil</label>
                <input type="number" id="edit_order" name="order" class="input-control">
            </div>
            <div class="form-group">
                <div class="checkbox-wrap">
                    <input type="checkbox" id="edit_is_active" name="is_active" value="1">
                    <label for="edit_is_active">Tampilkan infografis ini</label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-bhs-save">Simpan Perubahan</button>
                <button type="button" class="btn-bhs-cancel" onclick="closeModal('editModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<div id="stats-page-flags" data-show-add-modal="{{ $errors->any() ? '1' : '0' }}" style="display:none;"></div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    function openEditStatModal(button) {
        const id = button.getAttribute('data-stat-id');
        const image = button.getAttribute('data-image');

        document.getElementById('editForm').action = `/admin/stats/${id}`;
        document.getElementById('edit_value').value = button.getAttribute('data-value');
        document.getElementById('edit_title').value = button.getAttribute('data-title');
        document.getElementById('edit_order').value = button.getAttribute('data-order') || 0;
        document.getElementById('edit_is_active').checked = button.getAttribute('data-is-active') == 1;

        const previewDiv = document.getElementById('edit_image_preview');
        previewDiv.innerHTML = (image && image !== 'null' && image !== '')
            ? `<img src="{{ asset('storage/') }}/${image}" alt="Preview">`
            : '';

        openModal('editModal');
    }
    function previewImageStat() {
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
    document.addEventListener('DOMContentLoaded', function() {
        var flags = document.getElementById('stats-page-flags');
        if (flags && flags.dataset.showAddModal === '1') {
            openModal('addModal');
        }
    });
</script>

@endsection