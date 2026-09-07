@extends('layouts.admin')

@section('title', 'Kelola Akun')

@section('content')

{{-- HEADER CARD BAR --}}
<div style="background: white; border-radius: 16px; border: 1px solid var(--border, #e5e7eb); padding: 1.5rem 2rem; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: -0.5px;">KELOLA AKUN</h1>
        <p style="font-size: 0.85rem; color: #64748b; margin-top: 0.25rem; font-weight: 600;">Akun yang bisa login ke panel admin ini (Admin, Operator, dll)</p>
    </div>
    <a href="{{ route('admin.users.create') }}" style="background: #eab308; color: #0f172a; padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 900; font-size: 0.85rem; text-decoration: none; text-transform: uppercase; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        + TAMBAH AKUN
    </a>
</div>

{{-- TABLE CONTAINER --}}
<div style="background: white; border-radius: 16px; border: 1px solid var(--border, #e5e7eb); overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.02);">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background: #1e293b; color: white;">
            <tr>
                <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; font-weight: 900; letter-spacing: 0.5px;">NAMA</th>
                <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; font-weight: 900; letter-spacing: 0.5px;">EMAIL</th>
                <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; font-weight: 900; letter-spacing: 0.5px;">DIBUAT</th>
                <th style="padding: 1rem 1.5rem; font-size: 0.75rem; text-transform: uppercase; font-weight: 900; letter-spacing: 0.5px; text-align: center; width: 140px;">AKSI</th>
            </tr>
        </thead>
        <tbody style="background: white;">
            @foreach($users as $user)
                <tr style="border-top: 1px solid #f1f5f9;">
                    <td style="padding: 1.2rem 1.5rem; font-weight: 800; color: #0f172a; font-size: 0.95rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span>{{ $user->name }}</span>
                            @if($user->id === auth()->id())
                                <span style="font-size: 0.65rem; background: #d1fae5; color: #047857; padding: 0.2rem 0.6rem; border-radius: 6px; font-weight: 900; text-transform: uppercase;">Kamu</span>
                            @endif
                        </div>
                    </td>
                    <td style="padding: 1.2rem 1.5rem; color: #64748b; font-weight: 600; font-size: 0.9rem;">{{ $user->email }}</td>
                    <td style="padding: 1.2rem 1.5rem; color: #64748b; font-size: 0.85rem; font-weight: 600;">{{ $user->created_at->format('d M Y') }}</td>
                    <td style="padding: 1.2rem 1.5rem; text-align: center;">
                        <div style="display: flex; justify-content: center; align-items: center; gap: 0.5rem;">
                            {{-- TOMBOL EDIT KUNING EMAS --}}
                            <a href="{{ route('admin.users.edit', $user) }}" style="background: #eab308; color: #0f172a; padding: 0.45rem 0.9rem; border-radius: 8px; font-size: 0.75rem; font-weight: 900; text-decoration: none; display: inline-block;">
                                Edit
                            </a>

                            {{-- TOMBOL HAPUS (SVG PASTI NONGL) --}}
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus akun {{ $user->name }}?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" style="background: #fef2f2; border: 1px solid #fecaca; padding: 0.45rem; border-radius: 8px; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;" title="Hapus">
                                        <svg style="width: 16px; height: 16px; fill: #dc2626;" viewBox="0 0 24 24">
                                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection