@extends('layouts.admin')
@section('title', 'Kelola Reservasi')
@section('content')

<style>
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
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
        margin: 0;
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
        padding: 0.9rem;
        text-align: left;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    td {
        padding: 0.9rem;
        border-bottom: 1px solid var(--border);
        font-size: 0.9rem;
        vertical-align: top;
    }

    tbody tr:hover { background: rgba(249, 115, 22, 0.03); }

    .name-cell { font-weight: 600; color: var(--secondary); }
    .sub-cell { font-size: 0.78rem; color: var(--neutral); margin-top: 2px; }
    .message-cell { max-width: 260px; color: var(--neutral); white-space: pre-line; }

    .badge {
        display: inline-block;
        padding: 0.35rem 0.7rem;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: capitalize;
    }
    .badge-pending { background: rgba(245, 158, 11, 0.15); color: #92400E; }
    .badge-confirmed { background: rgba(16, 185, 129, 0.15); color: #047857; }
    .badge-cancelled { background: rgba(239, 68, 68, 0.15); color: #7F1D1D; }

    .status-form { display: flex; gap: 0.4rem; align-items: center; }

    .status-select {
        padding: 0.4rem 0.5rem;
        border: 1px solid var(--border);
        border-radius: 6px;
        font-size: 0.8rem;
        background: white;
    }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.45rem 0.7rem;
        border: 1px solid;
        border-radius: 6px;
        font-size: 0.8rem;
        cursor: pointer;
        background: rgba(239, 68, 68, 0.1);
        color: #EF4444;
        border-color: rgba(239, 68, 68, 0.2);
    }
    .btn-icon:hover { background: rgba(239, 68, 68, 0.15); }

    .btn-save-status {
        padding: 0.4rem 0.7rem;
        border: none;
        border-radius: 6px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        font-size: 0.78rem;
        font-weight: 600;
        cursor: pointer;
    }

    .empty-container { text-align: center; padding: 3rem 1.5rem; }
    .empty-icon { font-size: 3rem; color: #D1D5DB; margin-bottom: 1rem; }
    .empty-text { color: var(--neutral); font-size: 0.95rem; margin: 0; }

    @media (max-width: 768px) {
        th, td { padding: 0.7rem; font-size: 0.8rem; }
        .message-cell { max-width: 160px; }
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
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td>
                            <div class="name-cell">{{ $reservation->name }}</div>
                            <div class="sub-cell">
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $reservation->phone) }}" target="_blank" style="color: inherit;">
                                    <i class="fas fa-phone"></i> {{ $reservation->phone }}
                                </a>
                                @if($reservation->email)
                                    <br><i class="fas fa-envelope"></i> {{ $reservation->email }}
                                @endif
                            </div>
                        </td>
                        <td>{{ $reservation->package_name }}</td>
                        <td class="message-cell">{{ $reservation->message ?: '-' }}</td>
                        <td class="sub-cell">{{ $reservation->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $reservation->status }}">{{ $reservation->status }}</span>
                        </td>
                        <td>
                            <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST" class="status-form">
                                @csrf @method('PUT')
                                <select name="status" class="status-select">
                                    <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <button type="submit" class="btn-save-status"><i class="fas fa-check"></i></button>
                            </form>
                            <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" style="margin-top: 0.4rem;" onsubmit="return confirm('Yakin hapus reservasi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-icon"><i class="fas fa-trash"></i></button>
                            </form>
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
        <div style="padding: 1rem; text-align: center; border-top: 1px solid var(--border);">
            {{ $reservations->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

@endsection