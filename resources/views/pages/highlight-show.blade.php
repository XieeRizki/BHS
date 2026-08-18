@extends('layouts.app')

@section('title', $highlight->title . ' - Balong Hardi Sumedang')

@section('content')

@php
    // ================================================================
    // DUMMY DATA — nanti diganti $highlight->services, ->galleries, ->qrCodes
    // pas Upi udah kelar bikin migration + relasi modelnya.
    // Struktur array ini SENGAJA dibikin mirip nama kolom hasil rencana
    // migration kemarin biar gampang swap ke Eloquent collection.
    // ================================================================

    $services = [
        ['icon_key' => 'coffee',     'label' => 'Sarapan Pagi'],
        ['icon_key' => 'food-box',   'label' => 'Makan Siang'],
        ['icon_key' => 'plate',      'label' => 'Santap Malam'],
        ['icon_key' => 'fork-knife', 'label' => 'Kustom'],
        ['icon_key' => 'cocktail',   'label' => 'Minuman'],
    ];

    $galleries = [
        ['image' => 'images/bhs2.jpg', 'category' => 'tampak_depan'],
        ['image' => 'images/bhs2.jpg', 'category' => 'interior'],
        ['image' => 'images/bhs2.jpg', 'category' => 'interior'],
        ['image' => 'images/bhs2.jpg', 'category' => 'fasilitas'],
        ['image' => 'images/bhs2.jpg', 'category' => 'fasilitas'],
        ['image' => 'images/bhs2.jpg', 'category' => 'tampak_depan'],
    ];

    $qrCodes = [
        ['image' => 'images/bhs2.jpg', 'label' => 'ShopeeFood', 'link' => '#'],
        ['image' => 'images/bhs2.jpg', 'label' => 'GoFood',     'link' => '#'],
    ];

    // Icon set buat section Layanan (inline SVG, konsisten sama pattern admin panel)
    $iconPaths = [
        'coffee'     => '<path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="2" x2="6" y2="4"/><line x1="10" y1="2" x2="10" y2="4"/><line x1="14" y1="2" x2="14" y2="4"/>',
        'food-box'   => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" y1="22" x2="12" y2="12"/>',
        'plate'      => '<path d="M12 2a10 10 0 1 0 10 10c0-1.6-.4-3.1-1-4.4"/><path d="M12 2v10l7-3.5"/>',
        'fork-knife' => '<path d="M3 2v7c0 1.1.9 2 2 2h1a2 2 0 0 0 2-2V2"/><path d="M6 11v11"/><path d="M17 2v20"/><path d="M21 2c-1.1 0-2 .9-2 2v5c0 1.1.9 2 2 2"/>',
        'cocktail'   => '<path d="M8 22h8"/><path d="M12 11v11"/><path d="m19 3-7 8-7-8Z"/>',
    ];
@endphp

    <x-detail-page
        :title="$highlight->title"
        badge="Profil BHS"
        :image="$highlight->image"
        :backUrl="route('home')"
        backLabel="Kembali ke Beranda"
    >
        @if($highlight->content)
            <div class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed space-y-4">
                @foreach (preg_split('/\n\s*\n/', trim($highlight->content)) as $paragraph)
                    <p>{{ trim($paragraph) }}</p>
                @endforeach
            </div>
        @else
            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">{{ $highlight->short_description }}</p>
        @endif
    </x-detail-page>

    {{-- LAYANAN (Icon Row) --}}
    @if(count($services))
    <section class="py-14 bg-light dark:bg-[#161616] transition-colors border-b border-gray-200/80 dark:border-gray-800/80">
        <div class="container-max">
            <div class="text-center mb-10" data-aos="fade-up">
                <span class="text-xs font-bold tracking-widest uppercase text-accent">Layanan {{ $highlight->title }}</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light mt-2">Dedikasi Keberadaan BHS</h2>
            </div>

            <div class="flex flex-wrap items-start justify-center gap-8 md:gap-12">
                @foreach($services as $index => $service)
                    <div class="flex flex-col items-center text-center gap-3 w-20 md:w-24" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-white dark:bg-[#212121] border border-gray-200/80 dark:border-gray-800 flex items-center justify-center text-primary dark:text-accent shadow-sm">
                            <svg class="w-8 h-8 md:w-9 md:h-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                {!! $iconPaths[$service['icon_key']] ?? $iconPaths['plate'] !!}
                            </svg>
                        </div>
                        <span class="text-sm md:text-base font-bold text-secondary dark:text-light">{{ $service['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- GALERI MEDIA (Tab Filter) --}}
    @if(count($galleries))
    <section class="py-16 bg-white dark:bg-[#0A0A0A] transition-colors border-b border-gray-100 dark:border-gray-800/60">
        <div class="container-max">
            <div class="text-center max-w-xl mx-auto mb-8" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase tracking-wide">Galeri Media</h2>
                <p class="text-xs md:text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mt-2">Saatnya Anda &amp; Keluarga Eksplore Sekarang Juga</p>
            </div>

            <div class="flex items-center justify-center gap-2 md:gap-3 mb-8 flex-wrap" id="galeri-tabs">
                <button type="button" class="gallery-tab-btn px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide transition bg-accent text-[#0A0A0A]" data-category="semua">Semua</button>
                <button type="button" class="gallery-tab-btn px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide transition text-gray-500 dark:text-gray-400 hover:text-accent" data-category="tampak_depan">Tampak Depan</button>
                <button type="button" class="gallery-tab-btn px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide transition text-gray-500 dark:text-gray-400 hover:text-accent" data-category="interior">Interior</button>
                <button type="button" class="gallery-tab-btn px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide transition text-gray-500 dark:text-gray-400 hover:text-accent" data-category="fasilitas">Fasilitas</button>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="galeri-grid">
                @foreach($galleries as $index => $item)
                    <div class="gallery-item rounded-2xl overflow-hidden aspect-[4/3] shadow-sm hover:shadow-lg transition-shadow" data-category="{{ $item['category'] }}" data-aos="zoom-in" data-aos-delay="{{ $index * 60 }}">
                        <img src="{{ asset($item['image']) }}" alt="{{ $highlight->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- QR CODE DISKON --}}
    @if(count($qrCodes))
    <section class="py-14 bg-light dark:bg-[#161616] transition-colors">
        <div class="container-max text-center" data-aos="zoom-in">
            <span class="inline-block text-accent font-extrabold text-xs uppercase tracking-widest mb-2">Scan Barcode &amp;</span>
            <h3 class="text-xl md:text-2xl font-black text-secondary dark:text-light uppercase tracking-wide mb-8">
                Dapatkan Promo Spesial untuk {{ $highlight->title }}
            </h3>
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12">
                @foreach($qrCodes as $qr)
                    <a href="{{ $qr['link'] ?? '#' }}" target="_blank" class="flex flex-col items-center gap-3 group">
                        <div class="w-40 h-40 md:w-48 md:h-48 rounded-2xl overflow-hidden border-4 border-accent shadow-lg group-hover:scale-105 transition-transform">
                            <img src="{{ asset($qr['image']) }}" alt="{{ $qr['label'] }}" class="w-full h-full object-cover">
                        </div>
                        <span class="font-bold text-secondary dark:text-light uppercase text-sm tracking-wide">{{ $qr['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ----------------------------------------------------
    // Galeri Media - Tab Filter
    // ----------------------------------------------------
    const tabBtns = document.querySelectorAll('.gallery-tab-btn');
    const items = document.querySelectorAll('.gallery-item');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            tabBtns.forEach(b => {
                b.classList.remove('bg-accent', 'text-[#0A0A0A]');
                b.classList.add('text-gray-500', 'dark:text-gray-400');
            });
            this.classList.add('bg-accent', 'text-[#0A0A0A]');
            this.classList.remove('text-gray-500', 'dark:text-gray-400');

            const category = this.dataset.category;
            items.forEach(item => {
                item.style.display = (category === 'semua' || item.dataset.category === category) ? '' : 'none';
            });
        });
    });
});
</script>
@endpush