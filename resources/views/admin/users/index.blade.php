@extends('layouts.admin')
@section('title', 'Kelola Akun')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
    <div>
        <h1 style="font-size:1.5rem; font-weight:700; color:var(--secondary); margin:0;">Kelola Akun</h1>
        <p style="font-size:0.85rem; color:var(--neutral); margin:0;">Akun yang bisa login ke panel admin ini (Admin, Operator, dll)</p>
    </div>
    <a href="{{ route('admin.users.create') }}" style="background:var(--primary); color:white; padding:0.7rem 1.4rem; border-radius:8px; font-weight:700; font-size:0.9rem; text-decoration:none;">
        <i class="fas fa-plus"></i> Tambah Akun
    </a>
</div>

<div style="background:white; border-radius:10px; border:1px solid var(--border); overflow:hidden;">
    <table style="width:100%; border-collapse:collapse;">
        <thead style="background:var(--secondary); color:white;">
            <tr>
                <th style="padding:0.9rem; text-align:left; font-size:0.8rem; text-transform:uppercase;">Nama</th>
                <th style="padding:0.9rem; text-align:left; font-size:0.8rem; text-transform:uppercase;">Email</th>
                <th style="padding:0.9rem; text-align:left; font-size:0.8rem; text-transform:uppercase;">Dibuat</th>
                <th style="padding:0.9rem; text-align:center; font-size:0.8rem; text-transform:uppercase; width:140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr style="border-top:1px solid var(--border);">
                    <td style="padding:0.9rem; font-weight:600;">
                        {{ $user->name }}
                        @if($user->id === auth()->id())
                            <span style="font-size:0.7rem; background:rgba(16,185,129,0.15); color:#047857; padding:0.15rem 0.5rem; border-radius:4px; margin-left:0.4rem;">Kamu</span>
                        @endif
                    </td>
                    <td style="padding:0.9rem; color:var(--neutral);">{{ $user->email }}</td>
                    <td style="padding:0.9rem; color:var(--neutral); font-size:0.85rem;">{{ $user->created_at->format('d M Y') }}</td>
                    <td style="padding:0.9rem; text-align:center;">
                        <a href="{{ route('admin.users.edit', $user) }}" style="color:#3B82F6; margin-right:0.75rem;" title="Edit"><i class="fas fa-edit"></i></a>
                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus akun {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:var(--danger); cursor:pointer;" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection