@extends('layouts.admin')
@section('title', 'Edit Akun - ' . $user->name)
@section('content')

<h1 style="font-size:1.5rem; font-weight:700; color:var(--secondary); margin-bottom:1.5rem;">Edit Akun: {{ $user->name }}</h1>

<div style="background:white; border-radius:10px; border:1px solid var(--border); padding:1.75rem; max-width:480px;">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')

        <div style="margin-bottom:1.1rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
            @error('name')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom:1.1rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Email (dipakai untuk login)</label>
            
            @if($user->email === 'admin@balonghardi.com')
                {{-- Form disabled untuk Admin Utama --}}
                <input type="email" value="admin@balonghardi.com" disabled style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px; background: #F3F4F6; color: #9CA3AF; cursor: not-allowed;">
                <div style="font-size:0.75rem; color:var(--warning); margin-top:0.3rem; font-weight: 600;">
                    <i class="fas fa-lock"></i> Email Admin Utama dikunci permanen agar tidak kehilangan akses.
                </div>
            @else
                {{-- Form normal untuk Operator --}}
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
                @error('email')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
            @endif
        </div>

        <div style="margin-bottom:1.1rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Password Baru</label>
            <input type="password" name="password" minlength="8" style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
            <div style="font-size:0.75rem; color:var(--neutral); margin-top:0.3rem;">Kosongkan kalau tidak mau ganti password</div>
            @error('password')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom:1.5rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" minlength="8" style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
        </div>

        <button type="submit" style="background:var(--primary); color:white; padding:0.65rem 1.4rem; border:none; border-radius:6px; font-weight:600; cursor:pointer;">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <a href="{{ route('admin.users.index') }}" style="margin-left:0.5rem; color:var(--neutral); text-decoration:none;">Batal</a>
    </form>
</div>

@endsection