@extends('layouts.app')

@section('title', 'Profile - Balong Hardi Sumedang')

@section('content')

@php
    // Fallback dummy data — ganti dengan data dari controller kalau udah connect ke DB
    $profile = $profile ?? (object) [
        'title' => 'Kenapa Balong Hardi Sumedang?',
        'description' => "Balong Hardi Sumedang hadir sebagai destinasi pemancingan dan rekreasi keluarga yang memadukan suasana asri dengan fasilitas lengkap, mulai dari kolam galatama, villa, hingga resto & cafe.\n\nLebih dari sekadar tempat memancing, BHS jadi ruang berkumpulnya komunitas mancing mania dari berbagai daerah untuk merasakan pengalaman event dan galatama yang berkesan.",
        'image' => null,
        'video_url' => null,
        'benefits' => collect(),
    ];

    $stats = $stats ?? [
        ['value' => '3300+', 'label' => 'Pemancing', 'icon' => 'angler'],
        ['value' => '99+',   'label' => 'Event Galatama', 'icon' => 'fish'],
        ['value' => '120+',  'label' => 'Komunitas', 'icon' => 'community'],
        ['value' => '60x20', 'label' => 'Kolam', 'icon' => 'pond'],
        ['value' => '7+',    'label' => 'Tahun', 'icon' => 'badge'],
    ];

    $awards = $awards ?? [
        [
            'title' => 'Dedikasi & Partisipasi Pengerahan Massa dalam Gebyar Vaksinasi COVID-19',
            'issuer' => 'Kepolisian Resor Sumedang',
            'year' => '2022',
            'image' => null,
        ],
        [
            'title' => 'Apresiasi Kontribusi Pengembangan Pariwisata Lokal',
            'issuer' => 'Dinas Pariwisata Kabupaten Sumedang',
            'year' => '2023',
            'image' => null,
        ],
        [
            'title' => 'Penghargaan Tempat Wisata Ramah Komunitas',
            'issuer' => 'Komunitas Mancing Jawa Barat',
            'year' => '2024',
            'image' => null,
        ],
    ];
@endphp

{{-- Breadcrumb --}}
<div class="bg-white dark:bg-[#1F160D] border-b border-gray-100 dark:border-white/6">
    <div class="container-max py-4">
        <nav class="text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-accent transition">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-secondary dark:text-light font-semibold">Profile</span>
        </nav>
    </div>
</div>

{{-- Tagline --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <img src="{{ asset('images/banner1.jpeg') }}" alt="Balong Hardi Sumedang" class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0 bg-black/55"></div>

    <div class="container-max relative z-10 text-center max-w-3xl mx-auto px-4">
        <p class="text-lg md:text-2xl leading-relaxed text-white">
            <span class="font-extrabold">Harmoni Nuansa Balong Hardi Sumedang,</span>
            menghadirkan event tempat galatamanya mancing mania yang berkesan.
        </p>
    </div>
</section>

{{-- Infografis / Stats (DITAMBAHKAN ID: infografis) --}}
<section id="infografis" class="bg-white dark:bg-[#1F160D] py-14 md:py-16 border-y border-gray-100 dark:border-white/6 scroll-mt-24">
    <div class="container-max">
        <div class="text-center mb-10">
            <span class="text-xs font-bold tracking-widest uppercase text-accent">Infografis</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light mt-2">Momentum Kebersamaan Kita</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 md:gap-4">
            @foreach ($stats as $stat)
                <div class="flex flex-col items-center text-center gap-3">
                    <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-accent/10 dark:bg-accent/15 flex items-center justify-center text-primary dark:text-accent">
                        @php
                            $iconFile = match ($stat['icon']) {
                                'angler' => 'cowboy.png',
                                'fish' => 'fishing.png',
                                'community' => 'community.png',
                                'pond' => 'aquaculture.png',
                                'badge' => 'authentic.png',
                                default => 'community.png',
                            };
                        @endphp
                        <img src="{{ asset('images/' . $iconFile) }}" alt="{{ $stat['label'] }}" class="w-11 h-11 md:w-14 md:h-14 object-contain dark:invert dark:brightness-0 dark:contrast-200" />
                    </div>
                    <div>
                        <div class="text-xl md:text-2xl font-extrabold text-secondary dark:text-light">{{ $stat['value'] }}</div>
                        <div class="text-xs md:text-sm text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Tentang BHS --}}
<section id="tentang-bhs" class="bg-light dark:bg-dark py-16 md:py-20 scroll-mt-24">
    <div class="container-max">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            
            <div class="relative rounded-2xl overflow-hidden aspect-video bg-secondary/5 dark:bg-white/5 border border-gray-100 dark:border-white/6 shadow-lg">
                <iframe 
                    class="absolute inset-0 w-full h-full" 
                    src="https://www.youtube.com/embed/SKnz69mMaio" 
                    title="Video POV BHS" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>
            <div>
                <span class="text-xs font-bold tracking-widest uppercase text-accent">Tentang BHS</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light mt-2 mb-4">{{ $profile->title }}</h2>

                <div class="text-secondary/80 dark:text-light/80 leading-relaxed space-y-4 mb-6">
                    @foreach (preg_split('/\n\s*\n/', trim($profile->description)) as $paragraph)
                        <p>{{ trim($paragraph) }}</p>
                    @endforeach
                </div>

                @if ($profile->benefits->isNotEmpty())
                    <div class="space-y-4">
                        @foreach ($profile->benefits as $benefit)
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-1 shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-secondary dark:text-light text-lg">{{ $benefit->title }}</h4>
                                    @if ($benefit->description)
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $benefit->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- Penghargaan (DITAMBAHKAN ID: penghargaan) --}}
<section id="penghargaan" class="bg-white dark:bg-[#1F160D] py-16 md:py-20 border-y border-gray-100 dark:border-white/6 scroll-mt-24">
    <div class="container-max">
        <div class="text-center mb-10">
            <span class="text-xs font-bold tracking-widest uppercase text-accent">Penghargaan</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light mt-2">Dedikasi Keberadaan BHS</h2>
        </div>

        <div class="flex items-center gap-2 md:gap-4 w-full">

            <!-- Tombol Panah Kiri -->
            <button type="button"
                    id="award-prev"
                    aria-label="Penghargaan Sebelumnya"
                    class="flex items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full bg-white dark:bg-[#212121] border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent dark:hover:bg-accent dark:hover:text-[#0A0A0A] dark:hover:border-accent shadow-md shrink-0 transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none">
                <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Viewport -->
            <div id="award-viewport" class="overflow-hidden w-full">
                <div id="award-track" class="flex transition-transform duration-500 ease-out">
                    @foreach ($awards as $award)
                        <div class="award-item w-full shrink-0 px-1">
                            <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-8 md:gap-14 items-center">
                                <div class="aspect-[16/10] rounded-2xl overflow-hidden shadow-lg border border-gray-100 dark:border-white/6 bg-secondary/5 dark:bg-white/5 flex items-center justify-center shrink-0">
                                    @if (!empty($award['image']))
                                        <img src="{{ asset('storage/' . $award['image']) }}" alt="{{ $award['title'] }}" class="w-full h-full object-cover" />
                                    @else
                                        <svg class="w-14 h-14 text-gray-300 dark:text-gray-600" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5h16v14H4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5l16 14M20 5L4 19"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-xs md:text-sm font-bold uppercase tracking-wider text-accent">Sertifikat Penghargaan</span>
                                    <p class="font-bold text-2xl md:text-3xl text-secondary dark:text-light leading-snug mt-2 mb-4">{{ $award['title'] }}</p>
                                    <p class="text-base md:text-lg font-semibold text-secondary dark:text-light">{{ $award['issuer'] }}</p>
                                    <p class="text-base md:text-lg text-gray-400 dark:text-gray-500">Tahun {{ $award['year'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Panah Kanan -->
            <button type="button"
                    id="award-next"
                    aria-label="Penghargaan Berikutnya"
                    class="flex items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full bg-white dark:bg-[#212121] border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent dark:hover:bg-accent dark:hover:text-[#0A0A0A] dark:hover:border-accent shadow-md shrink-0 transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none">
                <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

        <div id="award-dots" class="flex items-center justify-center gap-2 mt-8"></div>
    </div>
</section>

{{-- Liputan Media --}}
<section id="liputan-media" class="py-14 bg-white dark:bg-[#0A0A0A] transition-colors overflow-hidden border-b border-gray-100 dark:border-gray-800/60 scroll-mt-24">
    <div class="container-max">
        <div class="text-center max-w-xl mx-auto mb-10">
            <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase tracking-wide">
                LIPUTAN MEDIA
            </h2>
            <p class="text-xs md:text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mt-2">
                SAATNYA ANDA & KELUARGA EKSPLORE SEKARANG JUGA
            </p>
        </div>

        <div class="flex items-center gap-2 md:gap-4 w-full">

            <button type="button"
                    id="media-prev"
                    aria-label="Media Sebelumnya"
                    class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/90 dark:bg-[#212121]/90 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent dark:hover:bg-accent dark:hover:text-[#0A0A0A] dark:hover:border-accent shadow-md shrink-0 transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none">
                <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <div id="media-viewport" class="overflow-hidden w-full py-4">
                    <div id="media-track" class="flex items-center justify-between gap-6 md:gap-10 transition-transform duration-500 ease-out">
                        @if(isset($mediaLogos) && count($mediaLogos) > 0)
                            @foreach ($mediaLogos as $media)
                                <a href="{{ $media->url ?? '#' }}" 
                                   target="_blank" 
                                   class="media-item group flex items-center gap-3 md:gap-4 shrink-0 hover:scale-105 transition-transform duration-300">
                                    <div class="w-14 h-14 md:w-20 md:h-20 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-white dark:bg-[#161616] p-2 md:p-2.5 shadow-md shrink-0">
                                        <img src="{{ isset($media->logo) ? asset('storage/' . $media->logo) : asset('images/bhs2.jpg') }}"
                                             alt="{{ $media->name ?? 'Media Partner' }}" 
                                             class="w-full h-full object-contain rounded-full"
                                             onerror="this.src='{{ asset('images/bhs2.jpg') }}'">
                                    </div>
                                    <span class="font-black text-sm md:text-lg text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors whitespace-nowrap">
                                        {{ $media->name }}
                                    </span>
                                </a>
                            @endforeach
                        @else
                            <a href="https://infojabar.id" target="_blank" class="media-item group flex items-center gap-3 md:gap-4 shrink-0 hover:scale-105 transition-transform duration-300">
                                <div class="w-14 h-14 md:w-20 md:h-20 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-white dark:bg-[#161616] p-2 md:p-2.5 shadow-md shrink-0">
                                    <img src="https://infojabar.id/wp-content/uploads/2021/03/logo-infojabar.png" alt="Info Jabar" class="w-full h-full object-contain rounded-full" onerror="this.src='{{ asset('images/bhs2.jpg') }}'">
                                </div>
                                <span class="font-black text-sm md:text-lg text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors whitespace-nowrap">INFOJABAR</span>
                            </a>

                            <a href="https://jabar.tribunnews.com" target="_blank" class="media-item group flex items-center gap-3 md:gap-4 shrink-0 hover:scale-105 transition-transform duration-300">
                                <div class="w-14 h-14 md:w-20 md:h-20 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-white dark:bg-[#161616] p-2 md:p-2.5 shadow-md shrink-0">
                                    <img src="https://asset-1.tribunnews.com/img/logo/tribun/tribunjabar.png" alt="Tribun Jabar" class="w-full h-full object-contain rounded-full" onerror="this.src='{{ asset('images/bhs2.jpg') }}'">
                                </div>
                                <span class="font-black text-sm md:text-lg text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors whitespace-nowrap">TRIBUN JABAR</span>
                            </a>

                            <a href="https://pikiran-rakyat.com" target="_blank" class="media-item group flex items-center gap-3 md:gap-4 shrink-0 hover:scale-105 transition-transform duration-300">
                                <div class="w-14 h-14 md:w-20 md:h-20 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-white dark:bg-[#161616] p-2 md:p-2.5 shadow-md shrink-0">
                                    <img src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2020/01/pikiran-rakyat.png" alt="Pikiran Rakyat" class="w-full h-full object-contain rounded-full" onerror="this.src='{{ asset('images/bhs2.jpg') }}'">
                                </div>
                                <span class="font-black text-sm md:text-lg text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors whitespace-nowrap">PIKIRAN RAKYAT</span>
                            </a>

                            <a href="https://www.trans7.co.id" target="_blank" class="media-item group flex items-center gap-3 md:gap-4 shrink-0 hover:scale-105 transition-transform duration-300">
                                <div class="w-14 h-14 md:w-20 md:h-20 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-white dark:bg-[#161616] p-2 md:p-2.5 shadow-md shrink-0">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/e0/TRANS7_logo.svg" alt="TRANS7" class="w-full h-full object-contain rounded-full" onerror="this.src='{{ asset('images/bhs2.jpg') }}'">
                                </div>
                                <span class="font-black text-sm md:text-lg text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors whitespace-nowrap">TRANS7</span>
                            </a>

                            <a href="https://www.metrotvnews.com" target="_blank" class="media-item group flex items-center gap-3 md:gap-4 shrink-0 hover:scale-105 transition-transform duration-300">
                                <div class="w-14 h-14 md:w-20 md:h-20 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-white dark:bg-[#161616] p-2 md:p-2.5 shadow-md shrink-0">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/0e/MetroTV_2010.svg" alt="Metro TV" class="w-full h-full object-contain rounded-full" onerror="this.src='{{ asset('images/bhs2.jpg') }}'">
                                </div>
                                <span class="font-black text-sm md:text-lg text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors whitespace-nowrap">METRO TV</span>
                            </a>
                        @endif
                    </div>
                </div>

            <button type="button"
                    id="media-next"
                    aria-label="Media Berikutnya"
                    class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/90 dark:bg-[#212121]/90 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent dark:hover:bg-accent dark:hover:text-[#0A0A0A] dark:hover:border-accent shadow-md shrink-0 transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none">
                <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

        </div>
    </div>
</section>

{{-- FAQ --}}
<section id="faq" class="bg-white dark:bg-[#1F160D] py-16 md:py-20 border-y border-gray-100 dark:border-white/6 scroll-mt-24">
    <div class="container-max grid md:grid-cols-2 gap-10">
        <div>
            <span class="text-xs font-bold tracking-widest uppercase text-accent">Pertanyaan Umum</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light mt-2 mb-4">Butuh Bantuan? Mulai dari Sini...</h2>
            <p class="text-secondary/80 dark:text-light/80 leading-relaxed mb-6">
                Kami senantiasa selangkah lebih maju dengan memanfaatkan teknologi dan strategi mutakhir untuk menjaga kenyamanan pengunjung.
            </p>
            <a href="https://wa.me/{{ $waNumber ?? '62895385703917' }}" target="_blank" class="inline-flex items-center gap-2 py-3 px-6 rounded-xl font-semibold bg-accent text-[#1C140C] shadow hover:bg-accent-dark transition">
                Reservasi
            </a>
        </div>

        <div class="space-y-3" id="faqAccordion">
            @foreach ($faqs as $index => $faq)
                <div class="border border-gray-100 dark:border-white/6 rounded-xl overflow-hidden">
                    <button type="button"
                            class="faq-toggle w-full flex items-center justify-between gap-4 text-left px-4 py-4 font-semibold text-secondary dark:text-light hover:bg-gray-50 dark:hover:bg-white/5 transition"
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                            data-faq="{{ $index }}">
                        <span>{{ $faq->question }}</span>
                        <svg class="faq-chevron w-4 h-4 shrink-0 transition-transform {{ $index === 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="faq-panel px-4 {{ $index === 0 ? '' : 'hidden' }} pb-4">
                        <p class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">{{ $faq->answer }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BANNER CTA --}}
<section class="py-14 bg-light dark:bg-[#161616] transition-colors overflow-hidden">
    <div class="container-max">
        <div class="relative overflow-hidden bg-gradient-to-r from-[#0A0A0A] via-secondary to-[#1a1a1a] text-white p-8 md:p-12 rounded-3xl flex flex-col lg:flex-row items-center justify-between gap-8 shadow-2xl border border-accent/20">
            <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-accent/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-xl text-center lg:text-left">
                <span class="inline-block text-accent font-extrabold text-xs uppercase tracking-widest mb-2">Penawaran Terbatas</span>
                <h3 class="text-xl md:text-2xl font-black uppercase tracking-wide leading-snug">
                    DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA
                </h3>
                <p class="text-gray-300 text-sm mt-2">Hubungi admin kami via WhatsApp untuk informasi ketersediaan lapak galatama, reservasi villa penginapan, dan promo paket rombongan.</p>
            </div>

            <div class="relative z-10 flex flex-col sm:flex-row gap-4 w-full lg:w-auto shrink-0 justify-center">
                <a href="https://wa.me/{{ $waNumber ?? '62895385703917' }}?text=Halo%20Admin%20BHS,%20saya%20ingin%20tanya%20info%20dan%20reservasi%20Pemancingan"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-accent text-[#0A0A0A] font-extrabold rounded-2xl hover:bg-accent/90 hover:scale-105 active:scale-95 transition-all duration-300 uppercase tracking-wider text-xs md:text-sm shadow-xl">
                    <svg class="w-5 h-5 shrink-0 fill-current text-[#0A0A0A]" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>WA Pemancingan</span>
                </a>

                <a href="https://wa.me/{{ $waNumber ?? '62895385703917' }}?text=Halo%20Admin%20BHS,%20saya%20ingin%20tanya%20info%20dan%20reservasi%20Penginapan%2FVilla"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-extrabold rounded-2xl hover:bg-white/20 hover:scale-105 active:scale-95 transition-all duration-300 uppercase tracking-wider text-xs md:text-sm shadow-xl">
                    <svg class="w-5 h-5 shrink-0 fill-current text-accent" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>WA Penginapan</span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.faq-toggle').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const panel = btn.parentElement.querySelector('.faq-panel');
                const chevron = btn.querySelector('.faq-chevron');
                const isHidden = panel.classList.contains('hidden');

                panel.classList.toggle('hidden');
                chevron.classList.toggle('rotate-180', isHidden);
                btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
            });
        });

        (function initAwardCarousel() {
            const track = document.getElementById('award-track');
            const prevBtn = document.getElementById('award-prev');
            const nextBtn = document.getElementById('award-next');
            const dotsWrap = document.getElementById('award-dots');

            if (!track || !prevBtn || !nextBtn) return;

            const items = Array.from(track.querySelectorAll('.award-item'));
            const total = items.length;
            if (total === 0) return;

            items.forEach(item => {
                const clone = item.cloneNode(true);
                track.appendChild(clone);
            });

            let currentIndex = 0;
            let isAnimating = false;
            let queue = [];

            const dots = [];
            if (dotsWrap && total > 1) {
                items.forEach((_, i) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.setAttribute('aria-label', 'Ke penghargaan ' + (i + 1));
                    dot.className = 'h-2.5 rounded-full transition-all duration-300 ' +
                        (i === 0 ? 'bg-accent w-6' : 'bg-gray-300 dark:bg-gray-600 w-2.5');
                    dot.addEventListener('click', () => jumpTo(i));
                    dotsWrap.appendChild(dot);
                    dots.push(dot);
                });
            }

            function updateDots() {
                dots.forEach((dot, i) => {
                    dot.className = 'h-2.5 rounded-full transition-all duration-300 ' +
                        (i === currentIndex ? 'bg-accent w-6' : 'bg-gray-300 dark:bg-gray-600 w-2.5');
                });
            }

            function processQueue() {
                if (isAnimating || queue.length === 0) return;
                const dir = queue.shift();
                dir === 1 ? stepNext() : stepPrev();
            }

            function stepNext() {
                isAnimating = true;
                track.style.transition = 'transform 500ms ease-out';
                track.style.transform = 'translateX(-100%)';

                track.addEventListener('transitionend', function handler() {
                    track.removeEventListener('transitionend', handler);
                    track.style.transition = 'none';
                    track.appendChild(track.firstElementChild);
                    track.style.transform = 'translateX(0)';
                    void track.offsetWidth;
                    currentIndex = (currentIndex + 1) % total;
                    updateDots();
                    isAnimating = false;
                    processQueue();
                });
            }

            function stepPrev() {
                isAnimating = true;
                track.style.transition = 'none';
                track.insertBefore(track.lastElementChild, track.firstElementChild);
                track.style.transform = 'translateX(-100%)';
                void track.offsetWidth;

                track.style.transition = 'transform 500ms ease-out';
                track.style.transform = 'translateX(0)';

                track.addEventListener('transitionend', function handler() {
                    track.removeEventListener('transitionend', handler);
                    currentIndex = (currentIndex - 1 + total) % total;
                    updateDots();
                    isAnimating = false;
                    processQueue();
                });
            }

            function jumpTo(targetIndex) {
                const forwardSteps = (targetIndex - currentIndex + total) % total;
                const backwardSteps = total - forwardSteps;

                if (forwardSteps === 0) return;

                if (forwardSteps <= backwardSteps) {
                    for (let i = 0; i < forwardSteps; i++) queue.push(1);
                } else {
                    for (let i = 0; i < backwardSteps; i++) queue.push(-1);
                }
                processQueue();
            }

            nextBtn.addEventListener('click', () => { queue.push(1); processQueue(); });
            prevBtn.addEventListener('click', () => { queue.push(-1); processQueue(); });
        })();

        (function initMediaInfiniteSlider() {
            const track = document.getElementById('media-track');
            const prevBtn = document.getElementById('media-prev');
            const nextBtn = document.getElementById('media-next');

            if (!track || !prevBtn || !nextBtn) return;

            let items = Array.from(track.querySelectorAll('.media-item'));
            if (items.length === 0) return;

            items.forEach(item => {
                const clone = item.cloneNode(true);
                track.appendChild(clone);
            });

            let isAnimating = false;

            function getShiftWidth() {
                const firstItem = track.querySelector('.media-item');
                if (!firstItem) return 280;
                const style = window.getComputedStyle(track);
                const gap = parseFloat(style.gap) || 32;
                return firstItem.offsetWidth + gap;
            }

            function moveNext() {
                if (isAnimating) return;
                isAnimating = true;

                const shift = getShiftWidth();
                track.style.transition = 'transform 500ms ease-out';
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

                track.style.transition = 'transform 500ms ease-out';
                track.style.transform = 'translateX(0)';

                track.addEventListener('transitionend', function handler() {
                    track.removeEventListener('transitionend', handler);
                    isAnimating = false;
                });
            }

            nextBtn.addEventListener('click', moveNext);
            prevBtn.addEventListener('click', movePrev);
        })();
    });
</script>

<style>
    #awardsTrack::-webkit-scrollbar {
        display: none;
    }
</style>

@endsection  