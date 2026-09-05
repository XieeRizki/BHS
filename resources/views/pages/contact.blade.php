@extends('layouts.app')

@section('title', 'Kontak - Balong Hardi Sumedang')

@section('content')

    {{-- HERO HEADER --}}
    <section class="relative pt-10 pb-8 md:pt-14 md:pb-10 bg-white dark:bg-[#0A0A0A] border-b border-gray-100 dark:border-gray-800/80 transition-colors">
        <div class="container-max text-center max-w-3xl mx-auto">
            <span class="inline-block px-3.5 py-1.5 rounded-full bg-accent/10 border border-accent/20 text-accent text-xs font-black uppercase tracking-widest mb-3" data-aos="fade-down">
                Layanan Pelanggan
            </span>
            <h1 class="text-3xl md:text-5xl font-black text-secondary dark:text-white uppercase tracking-tight mb-4" data-aos="fade-up">
                Hubungi Balong Hardi
            </h1>
            <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-medium leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                Punya pertanyaan tentang reservasi lapak pemancingan, villa & hotel penginapan, atau fasilitas lainnya? Tim admin kami siap melayani Anda.
            </p>
        </div>
    </section>

    {{-- SECTION UTAMA KONTAK --}}
    <section id="kontak" class="py-12 md:py-16 bg-light dark:bg-[#121212] transition-colors">
        <div class="container-max max-w-6xl">

            {{-- UX FOKUS UTAMA: 2 TOMBOL WHATSAPP ADMIN --}}
            <div class="mb-12" data-aos="zoom-in" data-aos-duration="800">
                <div class="text-center mb-6">
                    <span class="text-xs font-extrabold text-accent uppercase tracking-widest">Respon Cepat via WhatsApp</span>
                    <h2 class="text-xl md:text-2xl font-black text-secondary dark:text-white uppercase">Pilih Layanan WhatsApp</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl mx-auto">
                    
                    {{-- ADMIN 1: PEMANCINGAN --}}
                    @if ($contact?->whatsapp)
                        <a href="https://wa.me/{{ $contact->whatsapp }}?text=Halo%20Admin%20BHS,%20saya%20ingin%20tanya%20info%20dan%20reservasi%20Pemancingan" 
                           target="_blank"
                           class="relative group p-6 rounded-2xl bg-white dark:bg-[#1C1C1C] border-2 border-emerald-500/30 hover:border-emerald-500 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden">
                            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                            
                            <div>
                                {{-- Judul Utama --}}
                                <h3 class="text-lg font-black text-secondary dark:text-white uppercase mb-1">WA Pemancingan BHS</h3>
                                
                                {{-- Badge Kategori Digeser ke Bawah Judul --}}
                                <div class="mb-3">
                                    <span class="inline-block px-3 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-extrabold text-[10px] uppercase tracking-wider rounded-md">
                                        Admin Pemancingan
                                    </span>
                                </div>

                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4 font-medium leading-relaxed">
                                    Informasi ketersediaan lapak, sewa kolam pancing, & tata tertib pemancingan.
                                </p>
                            </div>

                            {{-- Footer Baris Bawah: Logo WA + Nomor Telepon + CTA --}}
                            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    {{-- Logo WA ditaruh sebelum nomor --}}
                                    <div class="w-8 h-8 rounded-lg bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                                    </div>
                                    <span class="text-sm font-black text-emerald-600 dark:text-emerald-400 tracking-wide">
                                        +{{ substr($contact->whatsapp, 0, 2) }} {{ substr($contact->whatsapp, 2, 3) }}-{{ substr($contact->whatsapp, 5, 4) }}-{{ substr($contact->whatsapp, 9) }}
                                    </span>
                                </div>

                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 group-hover:translate-x-1 transition-transform">
                                    Chat WA <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </div>
                        </a>
                    @endif

                    {{-- ADMIN 2: VILLA & HOTEL --}}
                    @if ($contact?->phone)
                        <a href="https://wa.me/{{ $contact->phone }}?text=Halo%20Admin%20BHS,%20saya%20ingin%20tanya%20info%20dan%20reservasi%20Villa/Hotel" 
                           target="_blank"
                           class="relative group p-6 rounded-2xl bg-white dark:bg-[#1C1C1C] border-2 border-amber-500/30 hover:border-amber-500 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden">
                            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>

                            <div>
                                {{-- Judul Utama --}}
                                <h3 class="text-lg font-black text-secondary dark:text-white uppercase mb-1">WA Villa & Hotel</h3>

                                {{-- Badge Kategori Digeser ke Bawah Judul --}}
                                <div class="mb-3">
                                    <span class="inline-block px-3 py-1 bg-amber-500/10 text-amber-600 dark:text-amber-400 font-extrabold text-[10px] uppercase tracking-wider rounded-md">
                                        Admin Penginapan
                                    </span>
                                </div>

                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4 font-medium leading-relaxed">
                                    Booking kamar villa, tipe kamar hotel, ketersediaan unit, & paket rombongan keluarga.
                                </p>
                            </div>

                            {{-- Footer Baris Bawah: Logo WA + Nomor Telepon + CTA --}}
                            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    {{-- Logo WA ditaruh sebelum nomor --}}
                                    <div class="w-8 h-8 rounded-lg bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                                    </div>
                                    <span class="text-sm font-black text-amber-600 dark:text-amber-400 tracking-wide">
                                        +{{ substr($contact->phone, 0, 2) }} {{ substr($contact->phone, 2, 3) }}-{{ substr($contact->phone, 5, 4) }}-{{ substr($contact->phone, 9) }}
                                    </span>
                                </div>

                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 dark:text-amber-400 group-hover:translate-x-1 transition-transform">
                                    Chat WA <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </span>
                            </div>
                        </a>
                    @endif

                </div>
            </div>

            {{-- INFORMASI LAINNYA (GRID CARD) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- ALAMAT UTAMA --}}
                @if ($location?->address)
                    <div class="p-6 rounded-2xl bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-accent/10 text-accent flex items-center justify-center mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <h3 class="font-extrabold text-base text-secondary dark:text-white uppercase mb-2">Alamat Pemancingan</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-300 font-medium leading-relaxed mb-4">
                                {{ $location->address }}
                            </p>
                        </div>
                        <a href="https://maps.google.com/?q={{ urlencode($location->address) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-accent hover:underline">
                            Petunjuk Arah Maps <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                @endif

                {{-- JAM OPERASIONAL REALTIME --}}
                @if ($contact?->operational_hours)
                    <div class="p-6 rounded-2xl bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-accent/10 text-accent flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-gray-800">
                                    <span id="jamOpStatusDot" class="w-2 h-2 rounded-full bg-gray-400 animate-pulse"></span>
                                    <span id="jamOpStatusText" class="text-[11px] font-extrabold uppercase tracking-wide text-gray-500">Memuat...</span>
                                </div>
                            </div>
                            <h3 class="font-extrabold text-base text-secondary dark:text-white uppercase mb-2">Jam Operasional</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-300 font-bold mb-1">
                                {{ $contact->operational_hours }}
                            </p>
                            <p class="text-[11px] text-gray-400 font-medium">Buka setiap hari untuk memancing & rekreasi.</p>
                        </div>
                    </div>
                @endif

                {{-- EMAIL & SOSIAL MEDIA --}}
                <div class="p-6 rounded-2xl bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-accent/10 text-accent flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="font-extrabold text-base text-secondary dark:text-white uppercase mb-2">Email & Media Sosial</h3>
                        
                        @if ($contact?->email)
                            <a href="mailto:{{ $contact->email }}" class="block text-xs font-bold text-gray-700 dark:text-gray-200 hover:text-accent transition-colors mb-4 truncate">
                                {{ $contact->email }}
                            </a>
                        @endif

                        {{-- TOMBOL ICON SVG INSTAGRAM & FACEBOOK --}}
                        <div class="flex items-center gap-2.5 pt-3 border-t border-gray-100 dark:border-gray-800">
                            @if ($contact?->instagram)
                                <a href="{{ $contact->instagram }}" target="_blank" aria-label="Instagram BHS" 
                                   class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gradient-to-r from-pink-500/10 via-purple-500/10 to-amber-500/10 border border-pink-500/20 text-pink-600 dark:text-pink-400 hover:scale-105 transition-all group">
                                    <svg class="w-4 h-4 fill-current group-hover:rotate-6 transition-transform" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                    <span class="text-xs font-bold uppercase tracking-wider">Instagram</span>
                                </a>
                            @endif

                            @if ($contact?->facebook)
                                <a href="{{ $contact->facebook }}" target="_blank" aria-label="Facebook BHS" 
                                   class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 hover:scale-105 transition-all group">
                                    <svg class="w-4 h-4 fill-current group-hover:-rotate-6 transition-transform" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    <span class="text-xs font-bold uppercase tracking-wider">Facebook</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- RAPIH & PRESISI GOOGLE MAPS SECTION --}}
    <section class="pb-16 bg-light dark:bg-[#121212] transition-colors">
        <div class="container-max max-w-6xl">
            <div class="bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-3xl shadow-xl overflow-hidden" data-aos="fade-up">
                
                {{-- MAP HEADER BAR --}}
                <div class="p-5 md:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-gray-100 dark:border-gray-800/80 bg-gray-50/50 dark:bg-[#1A1A1A]/50">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 rounded-full bg-accent"></span>
                            <span class="text-[10px] font-extrabold text-accent uppercase tracking-widest">Navigasi Rute</span>
                        </div>
                        <h3 class="text-base md:text-lg font-black text-secondary dark:text-white uppercase tracking-tight">
                            Google Maps Balong Hardi Sumedang
                        </h3>
                    </div>

                    <a href="https://maps.google.com/?q={{ urlencode($location->address ?? 'Balong Hardi Sumedang') }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-secondary dark:bg-accent text-white dark:text-[#0A0A0A] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md hover:scale-105 active:scale-95 transition-all duration-300">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        <span>Buka Aplikasi Maps</span>
                    </a>
                </div>

                {{-- MAP CONTAINER FRAME --}}
                <div class="relative w-full p-3 bg-white dark:bg-[#161616]">
                    <div class="w-full h-[400px] md:h-[480px] rounded-2xl overflow-hidden bg-gray-100 dark:bg-[#212121]">
                        <x-map :location="$location" />
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Realtime Status Buka/Tutup Jam Operasional
            (function () {
                const statusText = document.getElementById('jamOpStatusText');
                const statusDot = document.getElementById('jamOpStatusDot');
                if (!statusText || !statusDot) return;

                const CLOSED_DAY = 4; // 0=Minggu, 1=Senin, 2=Selasa, 3=Rabu, 4=Kamis, 5=Jumat, 6=Sabtu
                const OPEN_HOUR = 8;
                const CLOSE_HOUR = 20;

                const now = new Date();
                const day = now.getDay();
                const hour = now.getHours();
                const isOpen = day !== CLOSED_DAY && hour >= OPEN_HOUR && hour < CLOSE_HOUR;

                if (isOpen) {
                    statusText.textContent = 'Buka Sekarang';
                    statusText.className = 'text-[11px] font-extrabold uppercase tracking-wide text-emerald-600 dark:text-emerald-400';
                    statusDot.className = 'w-2 h-2 rounded-full bg-emerald-500 animate-pulse';
                } else {
                    statusText.textContent = 'Tutup Hari Ini';
                    statusText.className = 'text-[11px] font-extrabold uppercase tracking-wide text-rose-500';
                    statusDot.className = 'w-2 h-2 rounded-full bg-rose-500';
                }
            })();
        });
    </script>
@endsection