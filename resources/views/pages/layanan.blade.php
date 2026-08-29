@extends('layouts.app')

@section('title', 'Layanan ' . $layanan->title . ' - Balong Hardi Sumedang')

@section('content')

@php
    $waNumber = $contact->whatsapp ?? '62895385703917';
@endphp

{{-- BREADCRUMB NAVIGASI --}}
<div class="bg-white dark:bg-[#1F160D] border-b border-gray-100 dark:border-white/6 pt-6 pb-4">
    <div class="container-max">
        <nav class="text-xs md:text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-accent transition">BERANDA</a>
            <span class="mx-2 text-gray-300 dark:text-gray-600">/</span>
            <span class="text-secondary dark:text-light font-extrabold">{{ strtoupper($layanan->title) }}</span>
        </nav>
    </div>
</div>

{{-- 1. HERO TAGLINE HEADER --}}
<section class="py-12 md:py-16 bg-white dark:bg-[#0A0A0A] border-b border-gray-100 dark:border-gray-800/80 transition-colors">
    <div class="container-max">
        <div class="max-w-3xl text-left">
            <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-secondary dark:text-white uppercase tracking-tight leading-tight mb-4">
                {{ $layanan->title }}
            </h1>
            <p class="text-gray-600 dark:text-gray-300 text-sm md:text-lg font-medium uppercase tracking-wider">
                {{ $layanan->hero_subtitle }}
            </p>
        </div>
    </div>
</section>

{{-- 2. CATEGORY FILTER ICONS --}}
<section class="py-12 bg-gray-50 dark:bg-[#141414] border-b border-gray-200/80 dark:border-gray-800 transition-colors">
    <div class="container-max">
        <div class="text-center mb-8">
            <h2 class="text-xl md:text-2xl font-black text-secondary dark:text-white uppercase tracking-wide">
                LAYANAN {{ strtoupper($layanan->title) }}
            </h2>
            <p class="text-xs font-bold text-accent uppercase tracking-widest mt-1">
                {{ $layanan->section_subtitle ?? 'DEDIKASI KEBERADAAN BHS' }}
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 md:gap-6">
            @php
                $services = $layanan->services ?? [
                    ['name' => 'Layanan Unggulan', 'img' => 'images/bhs2.jpg'],
                ];
            @endphp

            @foreach ($services as $svc)
                <button type="button" class="group p-5 rounded-2xl bg-white dark:bg-[#1c1c1c] border border-gray-200 dark:border-gray-800 hover:border-accent dark:hover:border-accent shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center">
                    <div class="w-14 h-14 md:w-16 md:h-16 overflow-hidden mb-3 group-hover:scale-110 transition-transform shrink-0">
                        <img src="{{ !empty($svc['image']) ? asset('storage/'.$svc['image']) : asset('images/bhs2.jpg') }}" alt="{{ $svc['name'] }}" class="w-full h-full object-contain">
                    </div>
                    <span class="text-xs md:text-sm font-extrabold text-secondary dark:text-white uppercase tracking-wider">
                        {{ $svc['name'] }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</section>

{{-- 3. TENTANG UNIT --}}
<section class="py-14 md:py-20 bg-white dark:bg-[#0A0A0A] border-b border-gray-100 dark:border-gray-800/80 transition-colors">
    <div class="container-max">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">
            
            <div class="relative rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-800 shadow-xl bg-gray-100 dark:bg-[#161616] group aspect-[4/3]">
                <img src="{{ $layanan->image ? asset('storage/'.$layanan->image) : asset('images/bhs2.jpg') }}" 
                     alt="{{ $layanan->title }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5">
                    <span class="px-3.5 py-1.5 rounded-lg bg-black/60 backdrop-blur-md border border-white/10 text-xs font-extrabold text-white uppercase tracking-widest">
                        {{ strtoupper($layanan->title) }}
                    </span>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-secondary dark:text-white uppercase tracking-tight mb-2">
                        {{ strtoupper($layanan->title) }}
                    </h2>
                    <p class="text-sm md:text-base font-extrabold text-gray-600 dark:text-gray-300 uppercase tracking-wide leading-relaxed">
                        {{ $layanan->content ?? $layanan->short_description }}
                    </p>
                </div>

                <div class="space-y-3 border-t border-gray-200 dark:border-gray-800 pt-6">
                    <h3 class="text-xl md:text-2xl font-black text-secondary dark:text-white uppercase tracking-wide">
                        SELAMAT DATANG
                    </h3>
                    <p class="text-sm md:text-base font-extrabold text-gray-600 dark:text-gray-300 uppercase tracking-wide leading-relaxed">
                        {{ $layanan->hero_subtitle }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- 4. ARTIKEL TIPS & TRIK BHS --}}
<section class="py-14 md:py-18 bg-gray-50 dark:bg-[#141414] border-b border-gray-200/80 dark:border-gray-800 transition-colors">
    <div class="container-max">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-2xl md:text-3xl font-black text-secondary dark:text-white uppercase tracking-wide">
                {{ $layanan->showcase_title ?? 'ARTIKEL TIPS & TRIK BHS' }}
            </h2>
            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mt-1">
                {{ $layanan->showcase_subtitle ?? 'KETERANGAN AKTIVITAS & KEGIATAN BHS' }}
            </p>
        </div>

        <div class="relative flex items-center gap-2 md:gap-4">
            <button type="button" id="article-prev" class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white dark:bg-[#212121] border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent dark:hover:bg-accent dark:hover:text-[#0A0A0A] shadow-md shrink-0 transition-all z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <div id="article-viewport" class="overflow-hidden w-full py-4">
                <div id="article-track" class="flex gap-6 transition-transform duration-500 ease-out">
                    @forelse ($layanan->showcase_items ?? [] as $item)
                        <div class="article-item w-full md:w-[calc(33.333%-16px)] shrink-0 bg-white dark:bg-[#1c1c1c] border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                            <div>
                                <div class="relative h-48 overflow-hidden bg-gray-200 dark:bg-gray-800">
                                    <img src="{{ !empty($item['image']) ? asset('storage/'.$item['image']) : asset('images/bhs2.jpg') }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @if(!empty($item['category']))
                                        <span class="absolute top-3 left-3 px-3 py-1 bg-accent text-[#0A0A0A] text-[10px] font-black uppercase rounded-md tracking-wider">
                                            {{ $item['category'] }}
                                        </span>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-base md:text-lg font-black text-secondary dark:text-white uppercase tracking-tight mb-2">
                                        {{ $item['name'] }}
                                    </h3>
                                    @if(!empty($item['description']))
                                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                                            {{ $item['description'] }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 italic px-1">Belum ada item ditambahkan.</p>
                    @endforelse
                </div>
            </div>

            <button type="button" id="article-next" class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white dark:bg-[#212121] border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent dark:hover:bg-accent dark:hover:text-[#0A0A0A] shadow-md shrink-0 transition-all z-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</section>

{{-- PENGHARGAAN / VIDEO PROMO --}}
{{-- FE dummy: $layanan->video_url belum ada di DB, jadi fallback ke ID contoh.
     Upi tinggal isi kolom video_url (link YouTube apa aja formatnya) di migrasi/admin,
     regex di bawah otomatis narik video ID-nya, gak perlu ubah HTML.
     Background section pakai $layanan->image (foto layanan), fallback ke images/bhs2.jpg. --}}
@php
    $videoUrl = $layanan->video_url ?? 'https://www.youtube.com/watch?v=TK3PaH0ZAyY';
    preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/|shorts\/))([a-zA-Z0-9_-]{11})/', $videoUrl, $ytMatch);
    $videoId = $ytMatch[1] ?? null;
    $bgImage = $layanan->bg_image
    ? asset('storage/'.$layanan->bg_image)
    : ($layanan->image ? asset('storage/'.$layanan->image) : asset('images/bhs2.jpg'));
@endphp
<section class="relative overflow-hidden bg-cover bg-center bg-no-repeat py-20 md:py-28" style="background-image:url('{{ $bgImage }}');">
    <div class="absolute inset-0 bg-gradient-to-b from-black/85 via-black/70 to-black/85"></div>

    <div class="container-max relative z-10">
        <div class="text-center mb-10 md:mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-accent">Penghargaan</span>
            <h2 class="text-2xl md:text-3xl font-black text-white uppercase tracking-wide mt-2">
                Dedikasi Keberadaan BHS
            </h2>
        </div>

        <div class="max-w-4xl mx-auto">
            <div id="promo-video-wrap"
                 class="relative aspect-video rounded-2xl overflow-hidden border border-white/15 shadow-2xl bg-black/40 group {{ $videoId ? 'cursor-pointer' : '' }}"
                 data-video-id="{{ $videoId }}">

                @if ($videoId)
                    <img src="https://img.youtube.com/vi/{{ $videoId }}/maxresdefault.jpg"
                         alt="{{ $layanan->video_title ?? 'Video Promo ' . $layanan->title }}"
                         loading="lazy"
                         class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-black/30"></div>

                    <button type="button" id="promo-video-play" aria-label="Putar Video Promo" class="absolute inset-0 flex items-center justify-center">
                        <span class="relative flex items-center justify-center w-16 h-16 md:w-20 md:h-20 rounded-full bg-white/90 backdrop-blur-sm shadow-xl group-hover:bg-accent group-hover:scale-110 transition-all duration-300">
                            <span class="absolute inset-0 rounded-full border-2 border-white/60 animate-ping [animation-duration:2.2s]"></span>
                            <svg class="w-6 h-6 md:w-7 md:h-7 text-[#1F160D] translate-x-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                    </button>
                @else
                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-2 text-center px-6">
                        <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.55-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.45.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <p class="text-xs md:text-sm font-bold uppercase tracking-widest text-white/30">Video Segera Hadir</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- 5. GALERI MEDIA --}}
@if($layanan->galleries->isNotEmpty())
<section class="py-14 md:py-20 bg-light dark:bg-dark transition-colors">
    <div class="container-max">
        <div class="text-center mb-10">
            <span class="text-xs font-black text-accent uppercase tracking-widest">Galeri</span>
            <h2 class="text-2xl md:text-3xl font-black text-secondary dark:text-white mt-2">
                GALERI {{ strtoupper($layanan->title) }}
            </h2>
        </div>

        @if($layanan->kategoris->isNotEmpty())
            <div class="flex flex-wrap justify-center gap-2 mb-8" id="galeriFilterBtns">
                <button type="button" class="galeri-filter-btn active px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border border-accent bg-accent text-[#0A0A0A]" data-filter="semua">
                    Semua
                </button>
                @foreach($layanan->kategoris as $kategori)
                    <button type="button" class="galeri-filter-btn px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider border border-gray-300 dark:border-gray-700 text-secondary dark:text-light hover:border-accent transition-colors" data-filter="kategori-{{ $kategori->id }}">
                        {{ $kategori->name }}
                    </button>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6" id="galeriGrid">
            @foreach($layanan->galleries as $photo)
                <div class="galeri-item relative rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 bg-white dark:bg-[#1c1c1c] shadow-sm group aspect-square"
                     data-kategori="{{ $photo->layanan_kategori_id ? 'kategori-' . $photo->layanan_kategori_id : 'tanpa-kategori' }}">
                    <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->kategori->name ?? $layanan->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @if($photo->kategori)
                        <span class="absolute bottom-2 left-2 px-2 py-1 bg-black/60 backdrop-blur text-white text-[10px] font-bold uppercase rounded tracking-wider">
                            {{ $photo->kategori->name }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

@if($layanan->kategoris->isNotEmpty())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterBtns = document.querySelectorAll('.galeri-filter-btn');
        const items = document.querySelectorAll('.galeri-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'border-accent', 'bg-accent', 'text-[#0A0A0A]');
                    b.classList.add('border-gray-300', 'dark:border-gray-700', 'text-secondary', 'dark:text-light');
                });
                btn.classList.add('active', 'border-accent', 'bg-accent', 'text-[#0A0A0A]');
                btn.classList.remove('border-gray-300', 'dark:border-gray-700', 'text-secondary', 'dark:text-light');

                const filter = btn.dataset.filter;
                items.forEach(item => {
                    item.style.display = (filter === 'semua' || item.dataset.kategori === filter) ? '' : 'none';
                });
            });
        });
    });
</script>
@endif
@endif

{{-- SCAN BARCODE & ORDER --}}
<section class="py-14 md:py-20 bg-white dark:bg-[#0A0A0A] border-b border-gray-100 dark:border-gray-800/80 transition-colors">
    <div class="container-max text-center max-w-3xl mx-auto">
        <span class="text-xs font-extrabold text-accent uppercase tracking-widest block mb-2">SCAN BARCODE & ORDER</span>
        <h2 class="text-2xl md:text-4xl font-black text-secondary dark:text-white tracking-tight leading-tight mb-8">
            Get 40% extra on first order through ShopeeFood & GoFood
        </h2>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 md:gap-12">
            @if($layanan->qr_shopeefood)
                <div class="p-3 rounded-3xl border-2 border-emerald-500/40 bg-emerald-50/20 dark:bg-emerald-950/10 shadow-lg">
                    <div class="w-48 h-48 md:w-56 md:h-56 bg-white p-2 rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/'.$layanan->qr_shopeefood) }}" alt="QR Code ShopeeFood" class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>
            @endif

            @if($layanan->qr_gofood)
                <div class="p-3 rounded-3xl border-2 border-amber-500/40 bg-amber-50/20 dark:bg-amber-950/10 shadow-lg">
                    <div class="w-48 h-48 md:w-56 md:h-56 bg-white p-2 rounded-2xl overflow-hidden">
                        <img src="{{ asset('storage/'.$layanan->qr_gofood) }}" alt="QR Code GoFood" class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- PENAWARAN TERBATAS / CTA --}}
<section class="py-14 bg-light dark:bg-[#161616] transition-colors overflow-hidden">
    <div class="container-max">
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-50/80 via-white to-amber-100/50 dark:from-[#1C140C] dark:via-[#121212] dark:to-[#0A0A0A] p-8 md:p-12 rounded-3xl flex flex-col lg:flex-row items-center justify-between gap-8 shadow-xl dark:shadow-2xl border border-accent/40">
            <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-accent/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-xl text-center lg:text-left">
                <h3 class="text-xl md:text-2xl font-black text-secondary dark:text-white uppercase tracking-wide leading-snug">
                    DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA
                </h3>
            </div>

            <div class="relative z-10 flex flex-col sm:flex-row gap-4 w-full lg:w-auto shrink-0 justify-center">
                <a href="https://wa.me/{{ $contact->whatsapp }}?text={{ urlencode('Halo Admin BHS, saya ingin tanya paket diskon special ' . $layanan->title) }}"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-accent text-[#0A0A0A] font-extrabold rounded-2xl hover:bg-yellow-500 hover:scale-105 active:scale-95 transition-all duration-300 uppercase tracking-wider text-xs md:text-sm shadow-xl">
                    <svg class="w-5 h-5 shrink-0 fill-current text-[#0A0A0A]" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>KONTAK WA</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // ----------------------------------------------------
        // Infinite Loop Slider Artikel Tips & Trik
        // ----------------------------------------------------
        (function initArticleInfiniteSlider() {
            const track = document.getElementById('article-track');
            const prevBtn = document.getElementById('article-prev');
            const nextBtn = document.getElementById('article-next');

            if (!track || !prevBtn || !nextBtn) return;

            let items = Array.from(track.querySelectorAll('.article-item'));
            if (items.length === 0) return;

            items.forEach(item => {
                const clone = item.cloneNode(true);
                track.appendChild(clone);
            });

            let isAnimating = false;

            function getShiftWidth() {
                const firstItem = track.querySelector('.article-item');
                if (!firstItem) return 300;
                const style = window.getComputedStyle(track);
                const gap = parseFloat(style.gap) || 24;
                return firstItem.offsetWidth + gap;
            }

            function moveNext() {
                if (isAnimating) return;
                isAnimating = true;

                const shift = getShiftWidth();
                track.style.transition = 'transform 400ms ease-out';
                track.style.transform = `translateX(-${shift}px)`;

                track.addEventListener('transitionend', function handler() {
                    track.removeEventListener('transitionend', handler);
                    track.style.transition = 'none';
                    track.appendChild(track.firstElementChild);
                    track.style.transform = 'translateX(0)';
                    void track.offsetWidth;
                    isAnimating = false;
                });
            }

            function movePrev() {
                if (isAnimating) return;
                isAnimating = true;

                const shift = getShiftWidth();
                track.style.transition = 'none';
                track.insertBefore(track.lastElementChild, track.firstElementChild);
                track.style.transform = `translateX(-${shift}px)`;
                void track.offsetWidth;

                track.style.transition = 'transform 400ms ease-out';
                track.style.transform = 'translateX(0)';

                track.addEventListener('transitionend', function handler() {
                    track.removeEventListener('transitionend', handler);
                    isAnimating = false;
                });
            }

            nextBtn.addEventListener('click', moveNext);
            prevBtn.addEventListener('click', movePrev);
        })();

        // ----------------------------------------------------
        // Video Promo — swap thumbnail jadi iframe YouTube saat diklik
        // ----------------------------------------------------
        (function initPromoVideo() {
            const wrap = document.getElementById('promo-video-wrap');
            const playBtn = document.getElementById('promo-video-play');

            if (!wrap || !playBtn) return;

            const videoId = wrap.getAttribute('data-video-id');
            if (!videoId) return;

            playBtn.addEventListener('click', function () {
                const iframe = document.createElement('iframe');
                iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                iframe.title = 'Video Promo';
                iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
                iframe.allowFullscreen = true;
                iframe.className = 'absolute inset-0 w-full h-full';
                iframe.setAttribute('frameborder', '0');

                wrap.innerHTML = '';
                wrap.appendChild(iframe);
            });
        })();
    });
</script>
@endpush