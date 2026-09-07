@extends('layouts.admin')

@section('title', 'Edit Akun - ' . $user->name)

@section('content')

{{-- HEADER CARD BAR --}}
<div style="background: white; border-radius: 16px; border: 1px solid var(--border, #e5e7eb); padding: 1.5rem 2rem; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 900; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: -0.5px;">EDIT AKUN: {{ $user->name }}</h1>
        <p style="font-size: 0.85rem; color: #64748b; margin-top: 0.25rem; font-weight: 600;">Ubah informasi profil atau atur ulang password akun pengguna ini.</p>
    </div>
    <a href="{{ route('admin.users.index') }}" style="background: #f1f5f9; color: #334155; padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 900; font-size: 0.85rem; text-decoration: none; text-transform: uppercase;">
        ← KEMBALI
    </a>
</div>

{{-- FORM CARD CONTAINER (2 KOLOM SIMETRIS) --}}
<div style="background: white; border-radius: 16px; border: 1px solid var(--border, #e5e7eb); padding: 2rem;">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf 
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
            
            {{-- KOLOM KIRI --}}
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                {{-- 1. NAMA LENGKAP --}}
                <div>
                    <label style="display: block; font-weight: 800; margin-bottom: 0.4rem; font-size: 0.75rem; color: #0f172a; text-transform: uppercase;">
                        NAMA LENGKAP <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.9rem; font-weight: 600; color: #0f172a; outline: none; box-sizing: border-box;">
                    @error('name')
                        <div style="color: #ef4444; font-size: 0.78rem; margin-top: 0.35rem; font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 2. EMAIL LOGIN --}}
                <div>
                    <label style="display: block; font-weight: 800; margin-bottom: 0.4rem; font-size: 0.75rem; color: #0f172a; text-transform: uppercase;">
                        EMAIL LOGIN <span style="color: #ef4444;">*</span>
                    </label>
                    
                    @if($user->email === 'admin@balonghardi.com')
                        <input type="email" value="admin@balonghardi.com" disabled style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.9rem; background: #f8fafc; color: #94a3b8; cursor: not-allowed; font-weight: 700; box-sizing: border-box;">
                        <div style="font-size: 0.75rem; color: #d97706; background: #fef3c7; border: 1px solid #fde68a; padding: 0.6rem 0.8rem; border-radius: 8px; margin-top: 0.5rem; font-weight: 700;">
                            <i class="fas fa-lock"></i> Email Admin Utama dikunci permanen agar tidak kehilangan akses.
                        </div>
                    @else
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.9rem; font-weight: 600; color: #0f172a; outline: none; box-sizing: border-box;">
                        @error('email')
                            <div style="color: #ef4444; font-size: 0.78rem; margin-top: 0.35rem; font-weight: 700;">{{ $message }}</div>
                        @enderror
                    @endif
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                {{-- 3. PASSWORD BARU --}}
                <div>
                    <label style="display: block; font-weight: 800; margin-bottom: 0.4rem; font-size: 0.75rem; color: #0f172a; text-transform: uppercase;">
                        PASSWORD BARU
                    </label>
                    <input type="password" name="password" minlength="8" placeholder="••••••••" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.9rem; font-weight: 600; color: #0f172a; outline: none; box-sizing: border-box;">
                    <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.35rem; font-weight: 600;">Kosongkan jika tidak mau mengganti password.</div>
                    @error('password')
                        <div style="color: #ef4444; font-size: 0.78rem; margin-top: 0.35rem; font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 4. KONFIRMASI PASSWORD BARU --}}
                <div>
                    <label style="display: block; font-weight: 800; margin-bottom: 0.4rem; font-size: 0.75rem; color: #0f172a; text-transform: uppercase;">
                        KONFIRMASI PASSWORD BARU
                    </label>
                    <input type="password" name="password_confirmation" minlength="8" placeholder="••••••••" style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.9rem; font-weight: 600; color: #0f172a; outline: none; box-sizing: border-box;">
                </div>
            </div>

        </div>

        {{-- ACTION BUTTONS --}}
        <div style="padding-top: 1.25rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.75rem;">
            <button type="submit" style="background: #eab308; color: #0f172a; padding: 0.75rem 1.75rem; border: none; border-radius: 10px; font-weight: 900; font-size: 0.85rem; cursor: pointer; text-transform: uppercase;">
                SIMPAN PERUBAHAN
            </button>
            <a href="{{ route('admin.users.index') }}" style="color: #64748b; text-decoration: none; font-size: 0.85rem; font-weight: 800; padding: 0.75rem 1rem;">BATAL</a>
        </div>
    </form>
</div>

@endsection