@extends('layouts.app')

@section('title', 'Home - Balong Hardi Sumedang | Tempat Pemancingan Terbaik')

@section('content')

    {{-- Hero, About, dan Map sudah full komponen, tinggal lempar data dari HomeController --}}
    <x-hero :hero="$hero" />

    {{-- ================= TENTANG BHS ================= --}}
    <div class="relative">
        <x-about :about="$about" />

        {{-- Link "Selengkapnya" ke halaman Profile / Tentang. --}}
        <div class="container-max -mt-6 md:-mt-8 pb-8 text-center md:text-left" data-aos="fade-up">
            <a href="{{ route('profile.about') ?? '#' }}" class="inline-flex items-center gap-2 text-primary font-bold hover:text-primary-dark transition-colors">
                Selengkapnya Tentang BHS
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    {{-- ================= FASILITAS ================= --}}
    @if ($facilities->isNotEmpty())
        <section id="fasilitas" class="pt-12 md:pt-16 pb-12 md:pb-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div data-aos="fade-up">
                <x-section-title
                    badge="Fasilitas Kami"
                    title="Lengkap, Asri & Nyaman"
                    subtitle="Semua yang Anda butuhkan untuk pengalaman memancing yang maksimal"
                />
            </div>

            @php
                $homeFeatured = $facilities->first();
                $homeOthers   = $facilities->skip(1)->take(4);
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- FEATURED (BESAR) --}}
                <a href="{{ route('facility.show', $homeFeatured) }}" class="group relative block lg:col-span-2 h-[320px] md:h-[460px] rounded-2xl overflow-hidden shadow-lg" data-aos="fade-up">
                    @if ($homeFeatured->image)
                        <img src="{{ asset('storage/' . $homeFeatured->image) }}" alt="{{ $homeFeatured->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 text-6xl dark:from-gray-800 dark:to-gray-700">
                            {{ $homeFeatured->icon ?? '🎣' }}
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                        @if ($homeFeatured->icon)
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/15 backdrop-blur text-xl mb-3">{{ $homeFeatured->icon }}</span>
                        @endif
                        <h3 class="text-2xl md:text-3xl font-bold mb-2 group-hover:text-primary-light transition-colors">{{ $homeFeatured->name }}</h3>
                        <p class="text-sm md:text-base text-gray-200 max-w-lg line-clamp-2">{{ $homeFeatured->description }}</p>
                    </div>
                </a>

                {{-- LIST KECIL (4 ITEM) --}}
                <div class="flex flex-col justify-between h-auto lg:h-[460px] gap-4">
                    @foreach ($homeOthers as $facility)
                        <a href="{{ route('facility.show', $facility) }}" class="group flex items-center gap-4 bg-light dark:bg-dark rounded-xl border border-gray-100 dark:border-gray-800 p-4 hover:shadow-lg hover:border-primary/30 transition-all" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="w-16 h-16 md:w-20 md:h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-800">
                                @if ($facility->image)
                                    <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-3xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700">{{ $facility->icon ?? '🎣' }}</div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-semibold text-base text-secondary truncate group-hover:text-primary transition-colors">{{ $facility->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-300 line-clamp-1 mt-0.5">{{ $facility->description }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-primary group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <div data-aos="fade-up" class="mt-8 text-center">
                <a href="{{ route('facilities') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark transition-all duration-300 shadow-md hover:shadow-lg">
                    Fasilitas BHS Lainnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ================= EVENT (BARU) ================= --}}
    @php
        $homeEvents = $homeEvents ?? collect([
            (object) ['title' => 'Galatama Mingguan BHS', 'category' => 'Galatama', 'date' => '2026-08-01', 'description' => 'Keterangan event BHS'],
            (object) ['title' => 'Fishing Community Gathering', 'category' => 'Fishing Community', 'date' => '2026-08-02', 'description' => 'Keterangan event BHS'],
            (object) ['title' => 'Galatama Spesial Akhir Pekan', 'category' => 'Galatama', 'date' => '2026-08-03', 'description' => 'Keterangan event BHS'],
        ]);
    @endphp
    <section id="event" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div data-aos="fade-up">
                <x-section-title
                    badge="Event"
                    title="Agenda & Event BHS"
                    subtitle="Ikuti galatama dan kumpul bareng komunitas mancing di Balong Hardi"
                />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($homeEvents as $event)
                    <div class="card-modern overflow-hidden group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="relative h-40 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 flex items-center justify-center text-4xl">
                            🎣
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-primary font-bold mb-2 uppercase tracking-wider">{{ $event->category }}</p>
                            <h3 class="text-lg font-bold text-secondary mb-1">{{ $event->title }}</h3>
                            <p class="text-xs text-gray-500 font-semibold mb-3">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('l, d/m/Y') }}</p>
                            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $event->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= INFORMASI & BERITA BHS ================= --}}
    @if ($blogPosts->isNotEmpty())
        @php
            $beritaPosts  = $blogPosts->where('category', 'Berita')->take(3);
            $artikelPosts = $blogPosts->where('category', '!=', 'Berita')->take(2);
            if ($beritaPosts->isEmpty() && $artikelPosts->isEmpty()) {
                $beritaPosts = $blogPosts->take(3);
            }
        @endphp

        <section id="informasi" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
            <div class="container-max">
                <div data-aos="fade-up">
                    <x-section-title
                        badge="Informasi"
                        title="Informasi & Berita BHS"
                        subtitle="Kabar terbaru seputar kegiatan dan aktivitas di Balong Hardi Sumedang"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    @foreach ($beritaPosts as $post)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="card-modern overflow-hidden group">
                            <div class="relative h-48 overflow-hidden bg-gray-200 dark:bg-gray-800">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @endif
                            </div>
                            <div class="p-6">
                                <p class="text-xs text-gray-500 dark:text-gray-300 font-semibold mb-2">{{ optional($post->created_at)->translatedFormat('l, d/m/Y') }}</p>
                                <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors duration-300">{{ $post->title }}</h3>
                                @if ($post->excerpt)
                                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">{{ $post->excerpt }}</p>
                                @endif
                                <a href="{{ route('blog.show', $post) }}" class="text-primary font-bold text-sm inline-flex items-center gap-2 mt-4 hover:gap-3 transition-all duration-300">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div data-aos="fade-up" class="text-center">
                    <a href="{{ route('blog.index') }}" class="text-primary font-bold hover:text-primary-dark transition-colors">Lihat Semua Berita &amp; Informasi &rarr;</a>
                </div>
            </div>
        </section>

        {{-- ================= ARTIKEL, TIPS & TRIK BHS ================= --}}
        @if ($artikelPosts->isNotEmpty())
            <section id="artikel" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
                <div class="container-max">
                    <div data-aos="fade-up">
                        <x-section-title
                            badge="Tips & Trik"
                            title="Artikel, Tips & Trik BHS"
                            subtitle="Pelajari tips memancing, teknik, dan cerita menarik dari para penggemar memancing"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($artikelPosts as $post)
                            <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="card-modern overflow-hidden group flex flex-col sm:flex-row">
                                <div class="relative w-full sm:w-40 h-40 flex-shrink-0 overflow-hidden bg-gray-200 dark:bg-gray-800">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @endif
                                </div>
                                <div class="p-6">
                                    <p class="text-xs text-gray-500 dark:text-gray-300 font-semibold mb-2">{{ optional($post->created_at)->translatedFormat('l, d/m/Y') }}</p>
                                    <h3 class="text-lg font-bold text-secondary mb-2 group-hover:text-primary transition-colors duration-300">{{ $post->title }}</h3>
                                    <a href="{{ route('blog.show', $post) }}" class="text-primary font-bold text-sm inline-flex items-center gap-2 hover:gap-3 transition-all duration-300">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif

    {{-- ================= TESTIMONI ================= --}}
    @if (($testimonials ?? collect())->isNotEmpty())
        <section id="testimoni" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
            <div class="container-max">
                <div data-aos="fade-up">
                    <x-section-title badge="Testimoni" title="Pengalaman Pengunjung" subtitle="Dengarkan cerita dari pengunjung setia Balong Hardi" />
                </div>

                <div data-aos="fade-up">
                    <div class="relative">
                        <button id="testiHomePrevBtn" type="button" aria-label="Testimoni sebelumnya" class="group flex items-center justify-center absolute left-1 md:left-0 top-1/2 -translate-y-1/2 md:-translate-x-1/2 z-20 w-9 h-9 md:w-12 md:h-12 rounded-full bg-light dark:bg-dark border border-gray-200 dark:border-gray-700 shadow-lg text-secondary hover:bg-primary hover:text-white hover:border-primary transition-all duration-300">
                            <svg class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="testiHomeNextBtn" type="button" aria-label="Testimoni selanjutnya" class="group flex items-center justify-center absolute right-1 md:right-0 top-1/2 -translate-y-1/2 md:translate-x-1/2 z-20 w-9 h-9 md:w-12 md:h-12 rounded-full bg-light dark:bg-dark border border-gray-200 dark:border-gray-700 shadow-lg text-secondary hover:bg-primary hover:text-white hover:border-primary transition-all-300">
                            <svg class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-8 md:w-16 bg-gradient-to-r from-light to-transparent dark:from-dark z-10"></div>
                        <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-8 md:w-16 bg-gradient-to-l from-light to-transparent dark:from-dark z-10"></div>

                        <div id="testiHomeTrack" class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-2" style="scrollbar-width: none; -ms-overflow-style: none;">
                            @foreach ($testimonials as $testimonial)
                                <div class="testi-home-card snap-center sm:snap-start shrink-0 w-[74%] sm:w-[48%] lg:w-[31.5%] card-modern p-8 flex flex-col">
                                    <div class="flex items-center mb-4 space-x-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.92-.755 1.678-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.56-1.84-.198-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-200 mb-6 leading-relaxed italic flex-1">&ldquo;{{ $testimonial->message }}&rdquo;</p>
                                    <div class="flex items-center space-x-3">
                                        @if ($testimonial->avatar)
                                            <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                                        @endif
                                        <div>
                                            <p class="font-bold text-secondary">{{ $testimonial->name }}</p>
                                            @if ($testimonial->role ?? $testimonial->city ?? null)
                                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $testimonial->role ?? $testimonial->city }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="testiHomeDots" class="flex items-center justify-center gap-2 mt-8"></div>
                </div>
            </div>
        </section>
    @endif

    {{-- ================= LIPUTAN MEDIA (BARU) ================= --}}
    @php
        $mediaLogos = $mediaLogos ?? collect([
            (object) ['name' => 'InfoJabar', 'logo' => null],
            (object) ['name' => 'Tribun Jabar', 'logo' => null],
            (object) ['name' => 'Pikiran Rakyat', 'logo' => null],
        ]);
    @endphp
    <section id="liputan-media" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max text-center">
            <div data-aos="fade-up">
                <h3 class="text-xl md:text-2xl font-bold text-secondary mb-8 max-w-2xl mx-auto">
                    Saatnya Anda &amp; Keluarga Eksplore Sekarang Juga
                </h3>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-16" data-aos="fade-up">
                @foreach ($mediaLogos as $media)
                    <div class="flex items-center justify-center h-12 md:h-14 grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                        @if ($media->logo)
                            <img src="{{ asset('storage/' . $media->logo) }}" alt="{{ $media->name }}" class="h-full w-auto object-contain">
                        @else
                            <span class="font-bold text-lg text-secondary-light">{{ $media->name }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= PAKET LAYANAN PROMO (BARU) ================= --}}
    @php
        $homeServices = $homeServices ?? collect([
            (object) ['name' => 'Wisata Kolam Pemancingan', 'icon' => '🎣'],
            (object) ['name' => 'Villa Kayu', 'icon' => '🏡'],
            (object) ['name' => 'Hotel BHS', 'icon' => '🏨'],
            (object) ['name' => 'Resto & Cafe', 'icon' => '🍽️'],
            (object) ['name' => 'Meeting Room & Convention Hall', 'icon' => '🏛️'],
        ]);
    @endphp
    <section id="paket-layanan" class="py-12 md:py-16 bg-gradient-to-br from-primary to-primary-dark">
        <div class="container-max text-center">
            <div data-aos="fade-up">
                <p class="text-accent font-bold uppercase tracking-wider mb-3">Paket Layanan</p>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 max-w-2xl mx-auto">
                    Dapatkan Paket Diskon Spesial dan Informasinya Sekarang Juga
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-10">
                @foreach ($homeServices as $service)
                    <a href="{{ route('services.index') ?? '#' }}" class="group bg-white/10 backdrop-blur border border-white/20 rounded-xl p-5 hover:bg-white hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <span class="block text-3xl mb-3">{{ $service->icon }}</span>
                        <span class="block text-sm font-bold text-white group-hover:text-primary transition-colors">{{ $service->name }}</span>
                    </a>
                @endforeach
            </div>

            <div data-aos="fade-up" class="mt-10">
                <a href="{{ route('services.index') ?? '#' }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-primary font-bold rounded-lg hover:bg-accent transition-all duration-300 shadow-md hover:shadow-lg">
                    Lihat Semua Paket Layanan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ================= KONTAK (form reservasi + info + map) ================= --}}
    <section id="kontak" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div data-aos="fade-up">
            <x-section-title
                badge="Reservasi Sekarang"
                title="Ajukan Permintaan Reservasi"
                subtitle="Isi form di bawah untuk melakukan reservasi memancing di Balong Hardi Sumedang"
            />
            </div>

            <div data-aos="fade-up" class="bg-light dark:bg-dark rounded-2xl p-5 md:p-8 border border-gray-200 dark:border-gray-800 mb-12">
                <form id="waContactForm" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="waName" required placeholder="Nama Anda" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium bg-white dark:bg-gray-800">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Tanggal Reservasi <span class="text-red-500">*</span></label>
                            <input type="date" id="waDate" required min="{{ now()->format('Y-m-d') }}" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium bg-white dark:bg-gray-800">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Jumlah Orang <span class="text-red-500">*</span></label>
                            <input type="number" id="waGuests" min="1" value="1" required class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium bg-white dark:bg-gray-800">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Jenis Paket <span class="text-red-500">*</span></label>
                            <select id="waPackage" required class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium bg-white dark:bg-gray-800">
                                <option value="">-- Pilih paket --</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->name }} ({{ $package->formatted_price }})">{{ $package->name }} - {{ $package->formatted_price }} /orang</option>
                                @endforeach
                                <option value="Paket Grup">Paket Grup (Custom)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-secondary mb-1">Catatan Tambahan</label>
                        <textarea id="waMessage" rows="2" placeholder="Cth: Sewa alat pancing lengkap, butuh pemandu, dll" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium resize-none bg-white dark:bg-gray-800"></textarea>
                    </div>
                    <div class="flex items-center justify-between gap-4 pt-1">
                        <p class="text-xs text-gray-500 dark:text-gray-300">* Tim kami akan merespons dalam 1x24 jam kerja</p>
                        <button type="submit" class="shrink-0 py-2.5 px-6 bg-gradient-to-r from-primary to-primary-dark text-white font-bold text-sm rounded-lg hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group">
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Reservasi
                        </button>
                    </div>
                </form>
            </div>

            @php
                $infoCardCount = collect([
                    $contact?->phone,
                    $contact?->whatsapp,
                    $contact?->email,
                    $location?->address,
                    $contact?->operational_hours,
                ])->filter()->count();

                $xlColsMap = [1 => 'xl:grid-cols-1', 2 => 'xl:grid-cols-2', 3 => 'xl:grid-cols-3', 4 => 'xl:grid-cols-4', 5 => 'xl:grid-cols-5'];
                $xlCols = $xlColsMap[$infoCardCount] ?? 'xl:grid-cols-5';
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 {{ $xlCols }} gap-6">
                @if ($contact?->phone)
                    <div data-aos="fade-up" data-aos-delay="0" class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0 text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-secondary mb-2">Telepon</p>
                                <p class="text-gray-700 dark:text-gray-200 font-bold">{{ $contact->phone }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($contact?->whatsapp)
                    <div data-aos="fade-up" data-aos-delay="100" class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center flex-shrink-0 text-white">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-secondary mb-2">WhatsApp</p>
                                <a href="https://wa.me/{{ $contact->whatsapp }}" class="text-primary font-bold hover:text-primary-dark transition-colors">+{{ $contact->whatsapp }}</a>
                                <p class="text-xs text-gray-600 dark:text-gray-300 mt-1 font-medium">Respons Cepat 24/7</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($contact?->email)
                    <div data-aos="fade-up" data-aos-delay="150" class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center flex-shrink-0 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-secondary mb-2">Email</p>
                                <a href="mailto:{{ $contact->email }}" class="text-gray-700 dark:text-gray-200 font-bold hover:text-secondary-light transition-colors duration-300 break-all">{{ $contact->email }}</a>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($location?->address)
                    <div data-aos="fade-up" data-aos-delay="200" class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-dark rounded-lg flex items-center justify-center flex-shrink-0 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-secondary mb-2">Lokasi</p>
                                <p class="text-gray-700 dark:text-gray-200 font-medium">{{ $location->address }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($contact?->operational_hours)
                    <div data-aos="fade-up" data-aos-delay="250" class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl p-6 border border-gray-200 dark:border-gray-800">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-accent-dark rounded-lg flex items-center justify-center flex-shrink-0 text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-secondary mb-2">Jam Operasional</p>
                                <p class="text-gray-700 dark:text-gray-200 font-bold">{{ $contact->operational_hours }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div data-aos="fade-up" class="mt-8 rounded-2xl overflow-hidden shadow-lg">
                <x-map :location="$location" />
            </div>
        </div>
    </section>

@endsection


@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ================= FORM RESERVASI =================
        const formReservasi = document.getElementById('waContactForm');

        formReservasi?.addEventListener('submit', function (e) {
            e.preventDefault();

            const name = document.getElementById('waName').value.trim();
            const dateInput = document.getElementById('waDate').value;
            const guests = document.getElementById('waGuests').value;
            const pkg = document.getElementById('waPackage').value;
            const message = document.getElementById('waMessage').value.trim();

            if (!name || !dateInput || !pkg) return;

            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Mengirim...';

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                alert('System Error: CSRF token hilang dari layout.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                return;
            }

            fetch('{{ route('reservation.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    name: name,
                    reservation_date: dateInput,
                    guests: guests,
                    package_name: pkg,
                    message: message,
                }),
            })
            .then(async response => {
                if (response.status === 422) {
                    const data = await response.json();
                    const errorMessages = Object.values(data.errors).flat().join('\n');
                    throw new Error(errorMessages);
                }
                if (!response.ok) throw new Error('Gagal menyimpan reservasi. Server error.');
                return response.json();
            })
            .then(data => {
                form.innerHTML = `
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-secondary mb-2">Reservasi Berhasil Dikirim!</h4>
                        <p class="text-gray-600 text-sm">Terima kasih, <b>${name}</b>. Tim kami akan menghubungi Anda dalam 1x24 jam kerja untuk konfirmasi.</p>
                    </div>
                `;
            })
            .catch(error => {
                alert(error.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            });
        });

    });

    // ================= CAROUSEL TESTIMONI (HOME) =================
    document.addEventListener('DOMContentLoaded', function () {
        const track   = document.getElementById('testiHomeTrack');
        const prevBtn = document.getElementById('testiHomePrevBtn');
        const nextBtn = document.getElementById('testiHomeNextBtn');
        const dotsBox = document.getElementById('testiHomeDots');

        if (!track) return;

        const cards = Array.from(track.querySelectorAll('.testi-home-card'));
        const total = cards.length;
        if (total === 0) return;

        cards.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.classList.add('testi-dot');
            dot.setAttribute('aria-label', 'Ke testimoni ke-' + (i + 1));
            dot.addEventListener('click', () => goToRealIndex(i));
            dotsBox.appendChild(dot);
        });
        const dots = Array.from(dotsBox.children);

        const cloneBefore = cards.map(c => {
            const clone = c.cloneNode(true);
            clone.setAttribute('aria-hidden', 'true');
            clone.querySelectorAll('a, button, input').forEach(el => el.setAttribute('tabindex', '-1'));
            return clone;
        });
        const cloneAfter = cards.map(c => {
            const clone = c.cloneNode(true);
            clone.setAttribute('aria-hidden', 'true');
            clone.querySelectorAll('a, button, input').forEach(el => el.setAttribute('tabindex', '-1'));
            return clone;
        });

        const fragBefore = document.createDocumentFragment();
        cloneBefore.forEach(c => fragBefore.appendChild(c));
        track.insertBefore(fragBefore, cards[0]);

        const fragAfter = document.createDocumentFragment();
        cloneAfter.forEach(c => fragAfter.appendChild(c));
        track.appendChild(fragAfter);

        function getStep() {
            const style = window.getComputedStyle(track);
            const gap = parseFloat(style.columnGap || style.gap || 0);
            return cards[0].offsetWidth + gap;
        }

        function getSetWidth() {
            return getStep() * total;
        }

        function jumpInstant(scrollLeft) {
            track.style.scrollBehavior = 'auto';
            track.scrollLeft = scrollLeft;
            void track.offsetHeight;
            track.style.scrollBehavior = '';
        }

        jumpInstant(getSetWidth());

        function goToRealIndex(index) {
            const step = getStep();
            track.scrollTo({ left: getSetWidth() + step * index, behavior: 'smooth' });
        }

        nextBtn?.addEventListener('click', () => {
            track.scrollBy({ left: getStep(), behavior: 'smooth' });
        });

        prevBtn?.addEventListener('click', () => {
            track.scrollBy({ left: -getStep(), behavior: 'smooth' });
        });

        let scrollEndTimer = null;

        function handleScrollSettled() {
            const step = getStep();
            const setWidth = getSetWidth();
            const relIndex = Math.round((track.scrollLeft - setWidth) / step);

            if (relIndex >= total) {
                jumpInstant(track.scrollLeft - setWidth);
            } else if (relIndex < 0) {
                jumpInstant(track.scrollLeft + setWidth);
            }

            updateDots();
        }

        function updateDots() {
            const step = getStep();
            const setWidth = getSetWidth();
            let relIndex = Math.round((track.scrollLeft - setWidth) / step);
            relIndex = ((relIndex % total) + total) % total;

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === relIndex);
            });
        }

        track.addEventListener('scroll', () => {
            window.requestAnimationFrame(updateDots);
            clearTimeout(scrollEndTimer);
            scrollEndTimer = setTimeout(handleScrollSettled, 120);
        });

        window.addEventListener('resize', () => {
            jumpInstant(getSetWidth());
            updateDots();
        });

        updateDots();
    });
</script>
@endpush


@section('css')
    <style>
        #testiHomeTrack::-webkit-scrollbar { display: none; }

        .testi-dot {
            width: 8px;
            height: 8px;
            border-radius: 9999px;
            background-color: #E7DAC0; /* theme gray-200 (krem) */
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .testi-dot.active {
            width: 24px;
            background-color: #C9952C; /* accent (gold) */
        }
    </style>
@endsection