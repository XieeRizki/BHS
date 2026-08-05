@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 0.25rem;
    }

    .dashboard-header p {
        font-size: 0.9rem;
        color: var(--neutral);
    }

    /* Quick Actions Diperbarui */
    .quick-actions {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        border: 1px solid var(--border);
        margin-bottom: 2rem;
    }

    .quick-actions h2 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--secondary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quick-actions h2 i {
        color: var(--primary);
        font-size: 1.2rem;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 0.75rem;
    }

    .action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: white;
        border: 2px solid var(--border);
        border-radius: 8px;
        text-decoration: none;
        color: var(--secondary);
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .action-btn:hover {
        border-color: var(--primary);
        background: rgba(249, 115, 22, 0.05);
        color: var(--primary);
        transform: translateY(-1px);
    }

    .action-btn i {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--primary);
    }
    
    /* Highlight spesifik untuk tombol Informasi yang baru */
    .action-btn.new-feature {
        border-color: var(--primary);
        background: rgba(249, 115, 22, 0.05);
    }
</style>

<div class="dashboard-header">
    <h1>Dashboard</h1>
    <p>Selamat datang kembali, Admin! Fitur sedang dalam tahap perombakan (V2).</p>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h2>
        <i class="fas fa-rocket"></i>
        Akses Cepat (Fitur Baru)
    </h2>
    <div class="actions-grid">
        <!-- TOMBOL KE HALAMAN INFORMASI BARU -->
        <!-- TODO Backend: Ganti route ini dengan nama route yang benar nanti -->
        <a href="/admin/informasi/create" class="action-btn new-feature">
            <i class="fas fa-newspaper"></i>
            Tambah Informasi & Berita
        </a>
    </div>
</div>

<div class="quick-actions" style="opacity: 0.5;">
    <h2>
        <i class="fas fa-tools"></i>
        Fitur Lama (Sedang Dinonaktifkan)
    </h2>
    <p style="font-size: 0.85rem; color: var(--neutral); margin-bottom: 1rem;">
        Statistik dan tombol aksi cepat untuk fitur lama sengaja disembunyikan sementara selama proses refactoring database.
    </p>
</div>

@endsection