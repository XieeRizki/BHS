@extends('layouts.admin')
@section('title', 'Info Kontak')
@section('content')

<style>
    .form-section { background: white; border-radius: 10px; border: 1px solid var(--border); padding: 1.75rem; max-width: 560px; }
    .form-group { margin-bottom: 1.1rem; }
    label { display: block; font-weight: 700; color: var(--secondary); margin-bottom: 0.4rem; font-size: 0.85rem; }
    input[type="text"], input[type="email"] {
        width: 100%; padding: 0.65rem 0.8rem; border: 1px solid var(--border); border-radius: 6px;
        font-family: inherit; font-size: 0.9rem; box-sizing: border-box;
    }
    input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1); }
    .form-hint { font-size: 0.75rem; color: var(--neutral); margin-top: 0.3rem; }
    .form-error { font-size: 0.75rem; color: var(--danger); margin-top: 0.3rem; }
    .btn-save {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white;
        padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: 700; font-size: 0.85rem;
        cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; margin-top: 0.5rem;
    }
</style>

<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0;">Info Kontak</h1>
    <p style="font-size: 0.85rem; color: var(--neutral); margin: 0;">Data ini tampil di navbar, footer, halaman Kontak, dan tombol WhatsApp di seluruh website</p>
</div>

<div class="form-section">
    <form action="{{ route('admin.contact.update') }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $contact->phone) }}" placeholder="(022) 1234-567">
            @error('phone')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="whatsapp">Nomor WhatsApp</label>
            <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}" placeholder="628123456789">
            <div class="form-hint">Format internasional tanpa "+" atau "0" di depan, contoh: 628123456789</div>
            @error('whatsapp')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $contact->email) }}" placeholder="info@balonghardi.com">
            @error('email')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="operational_hours">Jam Operasional</label>
            <input type="text" id="operational_hours" name="operational_hours" value="{{ old('operational_hours', $contact->operational_hours) }}" placeholder="Setiap hari, 08:00 - 20:00">
            @error('operational_hours')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label for="facebook">Link/Username Facebook (Opsional)</label>
            <input type="text" id="facebook" name="facebook" value="{{ old('facebook', $contact->facebook) }}" placeholder="https://facebook.com/... atau @username">
        </div>

        <div class="form-group">
            <label for="instagram">Link/Username Instagram (Opsional)</label>
            <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $contact->instagram) }}" placeholder="https://instagram.com/... atau @username">
        </div>

        <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
    </form>
</div>

@endsection