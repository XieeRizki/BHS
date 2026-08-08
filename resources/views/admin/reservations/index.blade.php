@extends('layouts.admin')
@section('title', 'Kelola Reservasi')
@section('content')

<style>
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .section-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary);
        margin: 0;
    }

    .section-header-desc {
        font-size: 0.85rem;
        color: var(--neutral);
        margin: 0.25rem 0 0;
    }

    .table-card {
        background: white;
        border-radius: 10px;
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .table-responsive { overflow-x: auto; }

    table { width: 100%; border-collapse: collapse; }

    thead {
        background: linear-gradient(135deg, var(--secondary) 0%, #111827 100%);
        color: white;
    }

    th {
        padding: 0.75rem 0.85rem;
        text-align: left;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    td {
        padding: 0.65rem 0.85rem;
        border-bottom: 1px solid var(--border);
        font-size: 0.86rem;
        vertical-align: middle;
        line-height: 1.35;
    }

    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: rgba(249, 115, 22, 0.03); }

    .name-cell { font-weight: 700; color: var(--secondary); margin-bottom: 0.15rem; }

    .contact-line {
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.76rem;
        color: var(--neutral);
        margin-top: 0.1rem;
        text-decoration: none;
    }

    .contact-line i { width: 12px; flex-shrink: 0; }
    .contact-line.wa-link:hover { color: #16A34A; }

    .package-pill {
        display: inline-block;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        background: rgba(17, 24, 39, 0.05);
        color: var(--secondary);
        font-size: 0.78rem;
        font-weight: 600;
    }

    .message-cell { max-width: 260px; color: var(--neutral); white-space: pre-line; }
    .message-empty { color: #D1D5DB; }

    .date-main { font-weight: 600; color: var(--secondary); display: block; font-size: 0.83rem; }
    .date-time { font-size: 0.74rem; color: var(--neutral); display: block; margin-top: 0.05rem; }

    .badge {
        display: inline-block;
        padding: 0.3rem 0.65rem;
        border-radius: 5px;
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: capitalize;
        white-space: nowrap;
    }
    .badge-pending { background: rgba(245, 158, 11, 0.15); color: #92400E; }
    .badge-confirmed { background: rgba(16, 185, 129, 0.15); color: #047857; }
    .badge-cancelled { background: rgba(239, 68, 68, 0.15); color: #7F1D1D; }

    /* ===== Kolom Aksi: rapet, select di atas, tombol aksi bawah ===== */
    .aksi-wrap {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        min-width: 165px;
    }

    .status-form {
        margin: 0;
    }

    .status-select {
        width: 100%;
        padding: 0.45rem 0.6rem;
        border: 1px solid var(--border);
        border-radius: 6px;
        font-size: 0.86rem;
        background: white;
        cursor: pointer;
        -webkit-appearance: none;
        appearance: none;
    }
    .status-select:focus { outline: none; border-color: var(--primary); }

    /* baris bawah tombol: delete di kiri (mengisi), save di kanan (kotak kecil) */
    .aksi-bottom {
        display: flex;
        gap: 0.35rem;
        align-items: center;
    }

    .delete-form { margin: 0; flex: 1; }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
        width: 100%;
        padding: 0.45rem 0.6rem;
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 6px;
        font-size: 0.86rem;
        font-weight: 600;
        cursor: pointer;
        background: rgba(239, 68, 68, 0.08);
        color: #EF4444;
        transition: background 0.15s;
    }
    .btn-icon:hover { background: rgba(239, 68, 68, 0.15); }

    .btn-save-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.25rem;
        height: 2.25rem;
        flex-shrink: 0;
        border: none;
        border-radius: 6px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        font-size: 0.88rem;
        cursor: pointer;
        transition: opacity 0.15s;
    }
    .btn-save-status:hover { opacity: 0.88; }

    .empty-container { text-align: center; padding: 2rem 1.5rem; }
    .empty-icon { font-size: 2.5rem; color: #D1D5DB; margin-bottom: 0.6rem; }
    .empty-text { color: var(--neutral); font-size: 0.9rem; margin: 0; }

    .pagination-wrap {
        padding: 0.75rem;
        text-align: center;
        border-top: 1px solid var(--border);
    }

    @media (max-width: 768px) {
        th, td { padding: 0.55rem 0.65rem; font-size: 0.78rem; }
        .message-cell { max-width: 160px; }
        .aksi-wrap { min-width: 135px; }
        .aksi-bottom { gap: 0.4rem; }
        .btn-save-status { width: 2rem; height: 2rem; }
    }
</style>

<div class="section-header">
    <div>
        <h1>Kelola Reservasi</h1>
        <p class="section-header-desc">Daftar reservasi/pertanyaan yang masuk dari form kontak</p>
    </div>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Pemesan</th>
                    <th>Layanan</th>
                    <th>Catatan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th style="width: 190px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td>
                            <div class="name-cell">{{ $reservation->name }}</div>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $reservation->phone) }}" target="_blank" class="contact-line wa-link">
                                <i class="fas fa-phone"></i> {{ $reservation->phone }}
                            </a>
                            @if($reservation->email)
                                <div class="contact-line">
                                    <i class="fas fa-envelope"></i> {{ $reservation->email }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="package-pill">{{ $reservation->package_name }}</span>
                        </td>
                        <td class="message-cell">
                            @if($reservation->message)
                                {{ $reservation->message }}
                            @else
                                <span class="message-empty">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="date-main">{{ $reservation->created_at->format('d M Y') }}</span>
                            <span class="date-time">{{ $reservation->created_at->format('H:i') }}</span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $reservation->status }}">{{ $reservation->status }}</span>
                        </td>
                        <td>
                            <div class="aksi-wrap">
                                <!-- Form untuk select status saja. Tombol save dipisah di bawah dan menunjuk ke form ini via atribut form -->
                                <form id="status-form-{{ $reservation->id }}" action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST" class="status-form">
                                    @csrf @method('PUT')
                                    <select name="status" class="status-select" aria-label="Pilih status reservasi">
                                        <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>

                                <!-- Baris bawah: delete (mengisi) + save (kecil di kanan) -->
                                <div class="aksi-bottom">
                                    <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="delete-form" onsubmit="return confirm('Yakin hapus reservasi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>

                                    <!-- Tombol ini meng-submit form id="status-form-{{ $reservation->id }}" -->
                                    <button type="submit" form="status-form-{{ $reservation->id }}" class="btn-save-status" title="Simpan status">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-container">
                                <div class="empty-icon">📭</div>
                                <p class="empty-text">Belum ada reservasi masuk</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($reservations->hasPages())
        <div class="pagination-wrap">
            {{ $reservations->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

@endsection