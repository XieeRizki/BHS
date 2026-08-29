@extends('layouts.admin')
@section('title', 'Kelola FAQ')
@section('content')

<style>
    /* Header Halaman */
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
        letter-spacing: -0.01em;
    }

    .admin-page-subtitle {
        font-size: 0.825rem;
        color: #6B7280;
        margin-top: 0.25rem;
        font-weight: 500;
    }

    /* Tombol Utama BHS */
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
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2);
    }

    .btn-bhs-primary:hover {
        background: #CA8A04;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(234, 179, 8, 0.3);
    }

    /* Tabel Card Container */
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
        vertical-align: top;
        color: #374151;
    }

    tbody tr:hover {
        background: #FFFBEB;
    }

    .question-cell {
        font-weight: 800;
        color: #111827;
        font-size: 0.9rem;
        max-width: 280px;
    }

    .answer-cell {
        color: #4B5563;
        max-width: 320px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-height: 1.5;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
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

    /* Action Buttons */
    .action-group {
        display: flex;
        gap: 0.4rem;
        justify-content: center;
    }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        font-size: 0.8rem;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .btn-edit { background: #EFF6FF; color: #2563EB; border-color: #BFDBFE; }
    .btn-edit:hover { background: #2563EB; color: #FFFFFF; border-color: #2563EB; }

    .btn-delete { background: #FEF2F2; color: #DC2626; border-color: #FCA5A5; }
    .btn-delete:hover { background: #DC2626; color: #FFFFFF; border-color: #DC2626; }

    .empty-container {
        text-align: center;
        padding: 4rem 1.5rem;
    }

    /* Modal Component Layout */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, 0.7);
        backdrop-filter: blur(4px);
        z-index: 2000;
        padding: 1.5rem 1rem;
        overflow-y: auto;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 1.5rem;
        max-width: 540px;
        width: 100%;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border: 1px solid #E5E7EB;
        margin: auto;
    }

    .modal-header {
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #F3F4F6;
        flex-shrink: 0;
    }

    .modal-header h2 {
        font-size: 1.15rem;
        font-weight: 800;
        color: #111827;
        margin: 0;
        text-transform: uppercase;
    }

    .modal-header p {
        font-size: 0.8rem;
        color: #6B7280;
        margin-top: 0.25rem;
    }

    /* Modal Scrollable Form Body */
    .modal-body {
        overflow-y: auto;
        padding-right: 0.35rem;
        flex: 1;
    }

    .modal-body::-webkit-scrollbar {
        width: 4px;
    }
    .modal-body::-webkit-scrollbar-thumb {
        background: #E5E7EB;
        border-radius: 4px;
    }

    /* Form Items Inside Modal */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        font-size: 0.8rem;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        margin-bottom: 0.35rem;
    }

    .form-group label .required {
        color: #EF4444;
    }

    .input-control {
        width: 100%;
        padding: 0.7rem 0.9rem;
        background: #FFFFFF;
        border: 1px solid #D1D5DB;
        border-radius: 10px;
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

    .modal-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
        padding-top: 0.75rem;
        border-top: 1px solid #F3F4F6;
        flex-shrink: 0;
    }

    .btn-bhs-save-modal {
        background: #EAB308;
        color: #0A0A0A;
        font-weight: 900;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.8rem 1.25rem;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        flex: 1;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.2);
    }

    .btn-bhs-save-modal:hover {
        background: #CA8A04;
    }

    .btn-bhs-cancel-modal {
        background: #FFFFFF;
        color: #4B5563;
        font-weight: 700;
        font-size: 0.825rem;
        text-transform: uppercase;
        padding: 0.8rem 1.25rem;
        border-radius: 10px;
        border: 1px solid #D1D5DB;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-bhs-cancel-modal:hover {
        background: #F9FAFB;
        color: #111827;
    }

    @media (max-width: 768px) {
        .admin-page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .btn-bhs-primary {
            width: 100%;
            justify-content: center;
        }
        th, td { padding: 0.75rem; }
    }
</style>

<!-- Header Page -->
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Kelola FAQ</h1>
        <p class="admin-page-subtitle">Daftar pertanyaan umum & jawaban yang tampil di halaman Profile BHS</p>
    </div>
    <button type="button" class="btn-bhs-primary" onclick="openModal('addModal')">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
        Tambah FAQ
    </button>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                    <tr>
                        <td class="question-cell">{{ $faq->question }}</td>
                        <td class="answer-cell">{{ $faq->answer }}</td>
                        <td style="font-weight: 700; color: #111827;">{{ $faq->order }}</td>
                        <td>
                            @if($faq->is_active)
                                <span class="badge badge-active">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Aktif
                                </span>
                            @else
                                <span class="badge badge-inactive">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="action-group">
                                <button type="button" onclick="openEditFaqModal(this)"
                                    class="btn-icon btn-edit"
                                    title="Edit FAQ"
                                    data-faq-id="{{ $faq->id }}"
                                    data-question="{{ $faq->question }}"
                                    data-answer="{{ $faq->answer }}"
                                    data-order="{{ $faq->order }}"
                                    data-is-active="{{ $faq->is_active }}">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/><path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </button>
                                <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0l-1 14a2 2 0 01-2 2H7a2 2 0 01-2-2L4 6h16z"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-container">
                                <p style="color: #6B7280; font-size: 0.9rem; margin-bottom: 1.25rem;">Belum ada FAQ yang ditambahkan.</p>
                                <button type="button" class="btn-bhs-primary" onclick="openModal('addModal')">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                                    Tambah FAQ Pertama
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add FAQ -->
<div class="modal-overlay" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tambah FAQ</h2>
            <p>Tambahkan pertanyaan & jawaban baru</p>
        </div>
        <form action="{{ route('admin.faq.store') }}" method="POST" style="display:flex; flex-direction:column; flex:1; overflow:hidden;">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="question">Pertanyaan <span class="required">*</span></label>
                    <input type="text" id="question" name="question" class="input-control" value="{{ old('question') }}" placeholder="Contoh: Apakah ada fasilitas pemancingan umum?" required>
                    @error('question')<div style="color:#EF4444; font-size:0.75rem; margin-top:0.3rem; font-weight:600;">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="answer">Jawaban <span class="required">*</span></label>
                    <textarea id="answer" name="answer" class="input-control" placeholder="Tulis jawaban selengkapnya..." required>{{ old('answer') }}</textarea>
                    @error('answer')<div style="color:#EF4444; font-size:0.75rem; margin-top:0.3rem; font-weight:600;">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="order">Urutan Tampil</label>
                    <input type="number" id="order" name="order" class="input-control" value="{{ old('order', 0) }}">
                </div>
                <div class="form-group">
                    <div class="checkbox-wrap">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">Tampilkan FAQ ini</label>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn-bhs-save-modal">Simpan FAQ</button>
                <button type="button" class="btn-bhs-cancel-modal" onclick="closeModal('addModal')">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit FAQ -->
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit FAQ</h2>
            <p>Perbarui rincian pertanyaan & jawaban</p>
        </div>
        <form action="" method="POST" id="editForm" style="display:flex; flex-direction:column; flex:1; overflow:hidden;">
            @csrf 
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit_question">Pertanyaan <span class="required">*</span></label>
                    <input type="text" id="edit_question" name="question" class="input-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_answer">Jawaban <span class="required">*</span></label>
                    <textarea id="edit_answer" name="answer" class="input-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="edit_order">Urutan Tampil</label>
                    <input type="number" id="edit_order" name="order" class="input-control">
                </div>
                <div class="form-group">
                    <div class="checkbox-wrap">
                        <input type="checkbox" id="edit_is_active" name="is_active" value="1">
                        <label for="edit_is_active">Tampilkan FAQ ini</label>
                    </div>
                </div>
            </div>
            <div class="modal-actions">
                <button type="submit" class="btn-bhs-save-modal">Simpan Perubahan</button>
                <button type="button" class="btn-bhs-cancel-modal" onclick="closeModal('editModal')">Batal</button>
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
    function openEditFaqModal(button) {
        const faqId = button.getAttribute('data-faq-id');
        document.getElementById('editForm').action = `/admin/faq/${faqId}`;
        document.getElementById('edit_question').value = button.getAttribute('data-question');
        document.getElementById('edit_answer').value = button.getAttribute('data-answer');
        document.getElementById('edit_order').value = button.getAttribute('data-order') || 0;
        document.getElementById('edit_is_active').checked = button.getAttribute('data-is-active') == 1;
        openModal('editModal');
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