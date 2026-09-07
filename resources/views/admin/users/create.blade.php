@extends('layouts.admin')
@section('title', 'Tambah Akun')
@section('content')

<h1 style="font-size:1.5rem; font-weight:700; color:var(--secondary); margin-bottom:1.5rem;">Tambah Akun</h1>

<div style="background:white; border-radius:10px; border:1px solid var(--border); padding:1.75rem; max-width:480px;">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:1.1rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
            @error('name')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom:1.1rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Email (dipakai untuk login)</label>
            <input type="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
            @error('email')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom:1.1rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Password</label>
            <input type="password" name="password" required minlength="8" style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
            <div style="font-size:0.75rem; color:var(--neutral); margin-top:0.3rem;">Minimal 8 karakter</div>
            @error('password')<div style="color:var(--danger); font-size:0.75rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom:1.5rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.4rem; font-size:0.85rem;">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required minlength="8" style="width:100%; padding:0.65rem 0.8rem; border:1px solid var(--border); border-radius:6px;">
        </div>

        <button type="submit" style="background:var(--primary); color:white; padding:0.65rem 1.4rem; border:none; border-radius:6px; font-weight:600; cursor:pointer;">
            <i class="fas fa-save"></i> Simpan Akun
        </button>
        <a href="{{ route('admin.users.index') }}" style="margin-left:0.5rem; color:var(--neutral); text-decoration:none;">Batal</a>
    </form>
</div>

@endsection