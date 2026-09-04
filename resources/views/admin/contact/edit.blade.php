@extends('layouts.admin')
@section('title', 'Info Kontak - BHS Admin')
@section('content')

<style>
    .contact-card {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
        max-width: 800px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }

    .full-width {
        grid-column: span 2;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 0.8rem;
        font-weight: 800;
        color: #1F2937;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        color: #9CA3AF;
        width: 18px;
        height: 18px;
        pointer-events: none;
        transition: color 0.2s ease;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 1px solid #D1D5DB;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 500;
        color: #111827;
        background-color: #F9FAFB;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #EAB308;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(234, 179, 8, 0.15);
    }

    .form-control:focus + .input-icon,
    .input-wrapper:focus-within .input-icon {
        color: #EAB308;
    }

    .form-hint {
        font-size: 0.725rem;
        font-weight: 500;
        color: #6B7280;
        margin-top: 0.35rem;
    }

    .form-error {
        font-size: 0.725rem;
        font-weight: 700;
        color: #EF4444;
        margin-top: 0.35rem;
    }

    /* Tombol Simpan Emas Polos Khas BHS */
    .btn-submit {
        background-color: #EAB308;
        color: #0A0A0A;
        padding: 0.85rem 1.75rem;
        border: 1px solid #EAB308;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(234, 179, 8, 0.25);
    }

    .btn-submit:hover {
        background-color: #CA8A04;
        border-color: #CA8A04;
        color: #0A0A0A;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(202, 138, 4, 0.35);
    }

    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .full-width {
            grid-column: span 1;
        }
        .contact-card {
            padding: 1.25rem;
        }
    }
</style>

{{-- Header Page --}}
<div style="margin-bottom: 2rem;">
    <span style="font-size: 0.7rem; font-weight: 800; color: var(--accent-bhs); text-transform: uppercase; letter-spacing: 0.15em;">Pengaturan Sistem</span>
    <h1 style="font-size: 1.65rem; font-weight: 800; color: #111827; margin: 0.1rem 0 0.3rem 0; text-transform: uppercase;">Info Kontak BHS</h1>
    <p style="font-size: 0.85rem; font-weight: 500; color: #6B7280; margin: 0;">Kelola informasi kontak publik yang terhubung ke Navbar, Footer, & WhatsApp.</p>
</div>

<div class="contact-card">
    <form action="{{ route('admin.contact.update') }}" method="POST">
        @csrf 
        @method('PUT')

        <div class="form-grid">
            
            {{-- WhatsApp Admin 1 (Field DB tetap 'phone') --}}
            <div class="form-group">
                <label for="phone">No. WhatsApp Admin 1 (Pemancingan)</label>
                <div class="input-wrapper">
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $contact->phone) }}" placeholder="628123456789">
                    {{-- Icon WhatsApp --}}
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <div class="form-hint">Format: 628xxx (Tanpa "+" atau angka "0")</div>
                @error('phone')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            {{-- WhatsApp Admin 2 (Field DB tetap 'whatsapp') --}}
            <div class="form-group">
                <label for="whatsapp">No. WhatsApp Admin 2 (Villa & Resto)</label>
                <div class="input-wrapper">
                    <input type="text" id="whatsapp" name="whatsapp" class="form-control" value="{{ old('whatsapp', $contact->whatsapp) }}" placeholder="628987654321">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <div class="form-hint">Format: 628xxx (Tanpa "+" atau angka "0")</div>
                @error('whatsapp')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email Resmi</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}" placeholder="info@balonghardi.com">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            {{-- Jam Operasional --}}
            <div class="form-group">
                <label for="operational_hours">Jam Operasional</label>
                <div class="input-wrapper">
                    <input type="text" id="operational_hours" name="operational_hours" class="form-control" value="{{ old('operational_hours', $contact->operational_hours) }}" placeholder="Setiap hari, 08:00 - 20:00">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                @error('operational_hours')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            {{-- Facebook --}}
            <div class="form-group">
                <label for="facebook">Facebook (Opsional)</label>
                <div class="input-wrapper">
                    <input type="text" id="facebook" name="facebook" class="form-control" value="{{ old('facebook', $contact->facebook) }}" placeholder="https://facebook.com/balonghardi">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                </div>
            </div>

            {{-- Instagram --}}
            <div class="form-group">
                <label for="instagram">Instagram (Opsional)</label>
                <div class="input-wrapper">
                    <input type="text" id="instagram" name="instagram" class="form-control" value="{{ old('instagram', $contact->instagram) }}" placeholder="https://instagram.com/balonghardi">
                    <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2"/></svg>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="full-width" style="margin-top: 1rem; border-top: 1px solid #F3F4F6; padding-top: 1.25rem;">
                <button type="submit" class="btn-submit">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    <span>Simpan Perubahan</span>
                </button>
            </div>

        </div>
    </form>
</div>

@endsection