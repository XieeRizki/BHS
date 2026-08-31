@extends('layouts.app')

@section('title', $item->title . ' - ' . $layanan->title . ' - Balong Hardi Sumedang')

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-white dark:bg-[#1F160D] border-b border-gray-100 dark:border-white/6 pt-6 pb-4">
    <div class="container-max">
        <nav class="text-xs md:text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-accent transition">BERANDA</a>
            <span class="mx-2 text-gray-300 dark:text-gray-600">/</span>
            <span>PAKET LAYANAN</span>
            <span class="mx-2 text-gray-300 dark:text-gray-600">/</span>
            <a href="{{ route('layanan.show', $layanan->slug) }}" class="hover:text-accent transition">{{ strtoupper($layanan->title) }}</a>
            <span class="mx-2 text-gray-300 dark:text-gray-600">/</span>
            <span class="text-secondary dark:text-light font-extrabold">{{ strtoupper($item->title) }}</span>
        </nav>
    </div>
</div>

{{-- COVER --}}
<section class="bg-white dark:bg-[#0A0A0A]">
    <div class="container-max py-6 md:py-8">
        <div class="relative rounded-3xl overflow-hidden shadow-xl h-[280px] md:h-[420px] bg-gray-200 dark:bg-[#161616]">
            <img src="{{ $item->cover ? asset('storage/'.$item->cover) : ($layanan->image ? asset('storage/'.$layanan->image) : asset('images/bhs2.jpg')) }}"
                 alt="{{ $item->title }}" class="w-full h-full object-cover">
        </div>
    </div>
</section>

{{-- KONTEN UTAMA --}}
<section class="py-8 md:py-12 bg-light dark:bg-dark transition-colors">
    <div class="container-max">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">

            {{-- KIRI: Judul, deskripsi, sub judul --}}
            <div class="lg:col-span-2">
                <h1 class="text-2xl md:text-4xl font-black text-secondary dark:text-white uppercase tracking-tight mb-4">
                    {{ $item->title }}
                </h1>

                @if($item->description)
                    <div class="text-sm md:text-base text-gray-600 dark:text-gray-300 leading-relaxed space-y-4 mb-8">
                        @foreach (preg_split('/\n\s*\n/', trim($item->description)) as $paragraph)
                            <p>{{ trim($paragraph) }}</p>
                        @endforeach
                    </div>
                @endif

                @if($item->sub_title_1)
                    <div class="mb-6">
                        <h3 class="text-lg md:text-xl font-black text-secondary dark:text-white uppercase tracking-wide mb-2">
                            {{ $item->sub_title_1 }}
                        </h3>
                        @if($item->sub_description_1)
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ $item->sub_description_1 }}
                            </p>
                        @endif
                    </div>
                @endif

                @if($item->sub_title_2)
                    <div class="mb-6">
                        <h3 class="text-lg md:text-xl font-black text-secondary dark:text-white uppercase tracking-wide mb-2">
                            {{ $item->sub_title_2 }}
                        </h3>
                        @if($item->sub_description_2)
                            <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ $item->sub_description_2 }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- KANAN: Harga, PDF, QR --}}
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-[#1c1c1c] border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow-sm sticky top-24 space-y-6">

                    @if($item->formatted_price)
                        <div>
                            <span class="text-2xl md:text-3xl font-black text-accent">{{ $item->formatted_price }}</span>
                        </div>
                    @endif

                    @if($item->pdf)
                        <a href="{{ asset('storage/'.$item->pdf) }}" target="_blank"
                           class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-secondary dark:bg-white text-white dark:text-secondary font-bold text-sm hover:opacity-90 transition">
                            <i class="fas fa-file-pdf"></i> DOWNLOAD PDF
                        </a>
                    @endif


                    @if($layanan->qr_shopeefood || $layanan->qr_gofood)
                        <div class="border-t border-gray-200 dark:border-gray-800 pt-5">
                            <span class="text-xs font-black text-accent uppercase tracking-widest block mb-1">
                                {{ $layanan->qr_badge_text ?? 'SCAN BARCODE & ORDER' }}
                            </span>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                                {{ $layanan->qr_title ?? 'Get 40% extra on first order through ShopeeFood & GoFood' }}
                            </p>
                            <div class="flex gap-3">
                                @if($layanan->qr_shopeefood)
                                    <div class="flex-1 p-1.5 rounded-xl border-2 border-emerald-500/40 bg-white">
                                        <img src="{{ asset('storage/'.$layanan->qr_shopeefood) }}" alt="QR ShopeeFood" class="w-full aspect-square object-cover rounded-lg">
                                    </div>
                                @endif
                                @if($layanan->qr_gofood)
                                    <div class="flex-1 p-1.5 rounded-xl border-2 border-amber-500/40 bg-white">
                                        <img src="{{ asset('storage/'.$layanan->qr_gofood) }}" alt="QR GoFood" class="w-full aspect-square object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

{{-- GALERI (khusus item ini) --}}
@if(!empty($item->gallery))
<section class="py-12 md:py-16 bg-white dark:bg-[#0A0A0A] transition-colors">
    <div class="container-max">
        <div class="text-center mb-8">
            <span class="text-xs font-black text-accent uppercase tracking-widest">Galeri</span>
            <h2 class="text-xl md:text-2xl font-black text-secondary dark:text-white mt-2">GALERI MEDIA</h2>
            <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mt-1">
                Saatnya Anda & Keluarga Eksplore Sekarang Juga
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
            @foreach($item->gallery as $img)
                <div class="rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 aspect-square">
                    <img src="{{ asset('storage/'.$img) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA BAWAH --}}
<section class="py-8 bg-secondary dark:bg-[#111827]">
    <div class="container-max flex flex-col sm:flex-row items-center justify-between gap-4">
        <h3 class="text-white font-bold text-sm md:text-base text-center sm:text-left">
            {{ $layanan->cta_title ?? 'DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA' }}
        </h3>
        <a href="https://wa.me/{{ $contact->whatsapp }}?text={{ urlencode('Halo Admin BHS, saya ingin tanya tentang ' . $item->title) }}"
           target="_blank"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-accent text-[#0A0A0A] font-bold text-sm hover:bg-accent-dark transition whitespace-nowrap">
            <i class="fab fa-whatsapp"></i> KONTAK WA
        </a>
    </div>
</section>

@endsection