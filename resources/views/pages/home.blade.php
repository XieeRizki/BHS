@extends('layouts.app')

@section('title', 'Home - Balong Hardi Sumedang | Tempat Pemancingan Terbaik')

@section('content')

    {{-- HERO --}}
    <section id="hero-slider" class="relative flex items-center min-h-screen -mt-20 overflow-hidden bg-gradient-to-br from-primary to-accent text-white" style="min-height:100vh;">

        {{-- Hero Slides (Dinamis dari Database) --}}
        <div class="absolute inset-0 z-0">
            @if(isset($hero) && $hero->images && $hero->images->count() > 0)
                @foreach($hero->images as $index => $img)
                    <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out" style="opacity:{{ $index === 0 ? '1' : '0' }};" data-slide-index="{{ $index }}">
                        <img src="{{ asset('storage/' . $img->image) }}"
                             alt="{{ $hero->title ?? 'Balong Hardi Sumedang' }}"
                             class="absolute inset-0 w-full h-full object-cover opacity-70">
                    </div>
                @endforeach
            @elseif(isset($hero) && $hero->image)
                {{-- Fallback ke single image (Hero Banner) kalau slider kosong --}}
                <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out" style="opacity:1;" data-slide-index="0">
                    <img src="{{ asset('storage/' . $hero->image) }}"
                         alt="{{ $hero->title ?? 'Balong Hardi Sumedang' }}"
                         class="absolute inset-0 w-full h-full object-cover opacity-70">
                </div>
            @else
                {{-- Default bawaan kalau database kosong --}}
                <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out" style="opacity:1;" data-slide-index="0">
                    <img src="{{ asset('images/banner1.jpeg') }}"
                         alt="Kolam Pemancingan Balong Hardi Sumedang"
                         class="absolute inset-0 w-full h-full object-cover opacity-70">
                </div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/85 via-[#0A0A0A]/60 to-transparent"></div>
        </div>

        <div class="container-max relative z-10 w-full py-24 md:py-32">
            <div class="max-w-3xl text-center md:text-left" data-aos="fade-right" data-aos-duration="1000">
                <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full mb-6 text-sm font-semibold text-accent">Tempat Memancing Premium</span>

                {{-- Judul Dinamis --}}
                <h1 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight">
                    {{ $hero->title ?? 'Selamat Datang di Balong Hardi Sumedang' }}
                </h1>

                {{-- Subtitle Dinamis --}}
                <p class="text-lg md:text-xl text-[#EDEDED] mb-8">
                    {{ $hero->subtitle ?? 'Nikmati pengalaman memancing & rekreasi keluarga dengan nuansa coklat-keemasan — asri, nyaman, dan penuh layanan.' }}
                </p>

                <div class="flex justify-center md:justify-start gap-4 mb-8">
                    {{-- Tombol CTA Dinamis --}}
                    <a href="{{ $hero->button_link ?? '#kontak' }}" class="inline-flex items-center gap-3 px-7 py-3 rounded-xl bg-accent text-[#0A0A0A] font-bold shadow-lg hover:brightness-95 transition hover:scale-105 duration-300">
                        {{ $hero->button_text ?? 'Reservasi Sekarang' }}
                    </a>
                    
                    <a href="#fasilitas" class="inline-flex items-center gap-3 px-6 py-3 rounded-xl border border-white/20 bg-white/5 text-white hover:bg-white/10 transition hover:scale-105 duration-300">
                        Lihat Fasilitas
                    </a>
                </div>

                {{-- Tombol Navigasi Hero (Prev/Next) --}}
                <div class="flex items-center justify-center md:justify-start gap-3">
                    <button type="button" id="hero-prev" aria-label="Slide sebelumnya"
                            class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white hover:bg-accent hover:text-[#0A0A0A] hover:border-accent transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <button type="button" id="hero-next" aria-label="Slide berikutnya"
                            class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white hover:bg-accent hover:text-[#0A0A0A] hover:border-accent transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="absolute -top-32 -right-24 w-96 h-96 rounded-full blur-3xl opacity-30 pointer-events-none" style="background: linear-gradient(135deg, rgba(201,162,39,0.25), rgba(26,26,26,0.15));"></div>
        <div class="absolute -bottom-32 -left-24 w-96 h-96 rounded-full blur-3xl opacity-20 pointer-events-none" style="background: linear-gradient(135deg, rgba(166,132,30,0.18), rgba(10,10,10,0.1));"></div>
    </section>

    {{-- UNIT & LAYANAN (Hotel / Villa / Food & Beverage) --}}
    <section id="unit-layanan" class="py-16 bg-white dark:bg-[#0A0A0A] transition-colors overflow-hidden border-b border-gray-100 dark:border-gray-800/60">
        <div class="container-max">

            <div class="space-y-16">

                @foreach($highlights as $item)
                    <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">

                        {{-- Foto: kiri kalau index genap, kanan kalau ganjil --}}
                        <div class="relative rounded-3xl overflow-hidden shadow-xl h-[320px] md:h-[380px] group {{ $loop->iteration % 2 === 0 ? 'md:order-2' : '' }}"
                             data-aos="{{ $loop->iteration % 2 === 0 ? 'fade-left' : 'fade-right' }}" data-aos-duration="800">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/bhs2.jpg') }}"
                                 alt="{{ $item->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                        </div>

                        {{-- Teks: kanan kalau index genap, kiri kalau ganjil --}}
                        <div class="{{ $loop->iteration % 2 === 0 ? 'md:order-1' : '' }}"
                             data-aos="{{ $loop->iteration % 2 === 0 ? 'fade-right' : 'fade-left' }}" data-aos-duration="800" data-aos-delay="150">
                            <h3 class="text-xl md:text-2xl font-bold text-secondary dark:text-light mb-3">{{ $item->title }}</h3>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                                {{ $item->short_description }}
                            </p>
                            <a href="{{ route('highlight.show', $item->slug) }}" class="inline-flex items-center gap-2 font-bold text-accent hover:text-accent-dark transition group">
                                Selengkapnya
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- FASILITAS (Light: bg-light/bg-white | Dark: dark:bg-[#161616]) --}}
    <section id="fasilitas" class="py-16 bg-light dark:bg-[#161616] transition-colors overflow-hidden border-b border-gray-200/80 dark:border-gray-800/80">
        <div class="container-max">
            <div class="text-center mb-10" data-aos="fade-up">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Fasilitas Kami</p>
                <h3 class="text-2xl md:text-3xl font-bold text-secondary dark:text-light">Lengkap, Asri & Nyaman</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="relative lg:col-span-2 h-[420px] rounded-2xl overflow-hidden shadow-lg flex items-end p-8 bg-gray-100 dark:bg-[#212121]" data-aos="fade-right" data-aos-duration="800">
                    <img src="{{ asset('images/bhs2.jpg') }}"
                         alt="Kolam Pemancingan" class="absolute inset-0 w-full h-full object-cover opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="relative z-10 text-white">
                        <div class="flex items-center gap-3 mb-3">
                            <div>
                                <h4 class="text-2xl font-bold">Kolam Pemancingan Utama</h4>
                                <p class="text-sm text-[#EDEDED]">Kolam luas untuk lomba & rekreasi.</p>
                            </div>
                        </div>
                        <p class="text-gray-200 max-w-xl">Area terawat, bibit ikan pilihan, dan fasilitas pendukung untuk event komunitas & keluarga.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4 lg:h-[420px]">
                    <div class="flex items-stretch bg-white dark:bg-[#212121] border border-gray-200/60 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition" data-aos="fade-left" data-aos-delay="100">
                        <div class="w-28 sm:w-32 flex-shrink-0">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Villa Kayu Estetik" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center p-4">
                            <h4 class="font-bold text-secondary dark:text-light">Villa Kayu Estetik</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Penginapan nyaman untuk keluarga.</p>
                        </div>
                    </div>

                    <div class="flex items-stretch bg-white dark:bg-[#212121] border border-gray-200/60 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition" data-aos="fade-left" data-aos-delay="200">
                        <div class="w-28 sm:w-32 flex-shrink-0">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Resto & Cafe" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center p-4">
                            <h4 class="font-bold text-secondary dark:text-light">Resto & Cafe</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Menu lokal & kopi spesial.</p>
                        </div>
                    </div>

                    <div class="flex items-stretch bg-white dark:bg-[#212121] border border-gray-200/60 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition" data-aos="fade-left" data-aos-delay="300">
                        <div class="w-28 sm:w-32 flex-shrink-0">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Area Parkir Luas" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center p-4">
                            <h4 class="font-bold text-secondary dark:text-light">Area Parkir Luas</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Aman & muat banyak kendaraan.</p>
                        </div>
                    </div>

                    <div class="flex items-stretch bg-white dark:bg-[#212121] border border-gray-200/60 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition" data-aos="fade-left" data-aos-delay="400">
                        <div class="w-28 sm:w-32 flex-shrink-0">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Toilet & Musholla" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center p-4">
                            <h4 class="font-bold text-secondary dark:text-light">Toilet & Musholla</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Bersih dan mudah diakses.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center" data-aos="zoom-in">
                <a href="#paket-layanan" class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-[#0A0A0A] font-bold rounded-lg shadow-md hover:bg-accent-dark hover:shadow-lg transition hover:scale-105 duration-300">
                    Lihat Paket Layanan
                </a>
            </div>
        </div>
    </section>

    {{-- EVENT (Light: bg-white | Dark: dark:bg-[#0A0A0A]) --}}
    <section id="event" class="py-14 bg-white dark:bg-[#0A0A0A] transition-colors overflow-hidden border-b border-gray-100 dark:border-gray-800/60">
        <div class="container-max">
            <div class="text-center mb-8" data-aos="fade-up">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Event</p>
                <h3 class="text-2xl font-bold text-secondary dark:text-light">Agenda & Event</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <div class="bg-light dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
                        <div class="relative h-40 overflow-hidden bg-gray-200 dark:bg-[#212121]">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Galatama {{ $i+1 }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-accent font-bold mb-2 uppercase">Galatama</p>
                            <h4 class="text-lg font-bold text-secondary dark:text-light mb-1">Galatama {{ $i+1 }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-300 mb-3">Tanggal contoh</p>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Keterangan singkat event.</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- INFORMASI & BERITA BHS (Light: bg-light | Dark: dark:bg-[#161616]) --}}
    <section id="informasi" class="py-16 bg-light dark:bg-[#161616] transition-colors overflow-hidden border-b border-gray-200/80 dark:border-gray-800/80">
        <div class="container-max">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-accent/10 border border-accent/20 rounded-full text-xs font-extrabold text-accent uppercase tracking-wider mb-2">Pembaruan Berita</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase tracking-wide">
                    INFORMASI & BERITA BHS
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Ikuti perkembangan terbaru aktivitas, kompetisi, dan kegiatan di Balong Hardi Sumedang.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Berita Card 1 --}}
                <div class="group bg-white dark:bg-[#212121] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/bhs2.jpg') }}" alt="Berita 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-secondary/80 backdrop-blur-md text-white text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-md">Kegiatan</span>
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-bold text-accent tracking-wide uppercase">SENIN, 03/08/2026</span>
                        <h3 class="font-extrabold text-lg text-secondary dark:text-light uppercase mt-1 mb-2 group-hover:text-accent transition-colors">KEGIATAN BHS #1</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">Seputar dokumentasi kegiatan memancing dan agenda rutin komunitas.</p>
                    </div>
                </div>

                {{-- Berita Card 2 --}}
                <div class="group bg-white dark:bg-[#212121] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/bhs2.jpg') }}" alt="Berita 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-secondary/80 backdrop-blur-md text-white text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-md">Event</span>
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-bold text-accent tracking-wide uppercase">MINGGU, 02/08/2026</span>
                        <h3 class="font-extrabold text-lg text-secondary dark:text-light uppercase mt-1 mb-2 group-hover:text-accent transition-colors">EVENT BHS #1</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">Info jadwal babak penyisihan turnamen pemancingan Galatama mingguan.</p>
                    </div>
                </div>

                {{-- Berita Card 3 --}}
                <div class="group bg-white dark:bg-[#212121] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/bhs2.jpg') }}" alt="Berita 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-secondary/80 backdrop-blur-md text-white text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-md">Pengumuman</span>
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-bold text-accent tracking-wide uppercase">SABTU, 01/08/2026</span>
                        <h3 class="font-extrabold text-lg text-secondary dark:text-light uppercase mt-1 mb-2 group-hover:text-accent transition-colors">EVENT BHS #1</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">Pembaruan fasilitas baru dan rilis jadwal pemeliharaan kolam utama.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ARTIKEL, TIPS & TRIK BHS (Light: bg-white | Dark: dark:bg-[#0A0A0A]) --}}
    <section id="artikel" class="py-16 bg-white dark:bg-[#0A0A0A] transition-colors overflow-hidden border-b border-gray-100 dark:border-gray-800/60">
        <div class="container-max">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-accent/10 border border-accent/20 rounded-full text-xs font-extrabold text-accent uppercase tracking-wider mb-2">Edukasi & Edu-Info</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase tracking-wide">
                    ARTIKEL, TIPS & TRIK BHS
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Wawasan dan teknik memancing racikan para juara Galatama BHS.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Artikel Card 1 --}}
                <div class="group bg-light dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/bhs2.jpg') }}" alt="Artikel 1" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-accent uppercase">SENIN, 03/08/2026</span>
                            <span class="text-gray-400">3 Min Read</span>
                        </div>
                        <h3 class="font-extrabold text-lg text-secondary dark:text-light uppercase mb-2 group-hover:text-accent transition-colors">ARTIKEL BHS #1</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">Trik memilih umpan jitu dan memahami karakter arus kolam saat cuaca dingin.</p>
                    </div>
                </div>

                {{-- Artikel Card 2 --}}
                <div class="group bg-light dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/bhs2.jpg') }}" alt="Artikel 2" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-accent uppercase">MINGGU, 02/08/2026</span>
                            <span class="text-gray-400">5 Min Read</span>
                        </div>
                        <h3 class="font-extrabold text-lg text-secondary dark:text-light uppercase mb-2 group-hover:text-accent transition-colors">ARTIKEL BHS #1</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">Persiapan fisik dan pancing yang pas untuk bertanding di ajang Galatama malam hari.</p>
                    </div>
                </div>

                {{-- Artikel Card 3 --}}
                <div class="group bg-light dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/bhs2.jpg') }}" alt="Artikel 3" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-accent uppercase">SABTU, 01/08/2026</span>
                            <span class="text-gray-400">4 Min Read</span>
                        </div>
                        <h3 class="font-extrabold text-lg text-secondary dark:text-light uppercase mb-2 group-hover:text-accent transition-colors">ARTIKEL BHS #1</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">Cara merawat joran dan reel kesayangan agar awet dan performa tetap maksimal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TESTIMONI (Light: bg-light | Dark: dark:bg-[#161616]) --}}
    <section id="testimoni" class="py-16 bg-light dark:bg-[#161616] transition-colors overflow-hidden border-b border-gray-200/80 dark:border-gray-800/80">

        <style>
            /* Animasi Marquee Berjalan Pelan */
            .testi-marquee-wrapper {
                overflow: hidden;
                position: relative;
                width: 100%;
                padding: 1rem 0;
            }
            .testi-marquee-track {
                display: flex;
                width: max-content;
                animation: marquee 40s linear infinite; 
            }
            .testi-marquee-track:hover {
                animation-play-state: paused;
            }
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .testi-card-item {
                width: 350px;
                margin-right: 2rem;
                flex-shrink: 0;
            }
        </style>

        <div class="container-max">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-accent/10 border border-accent/20 rounded-full text-xs font-extrabold text-accent uppercase tracking-wider mb-2">Kata Mereka</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase">
                    TESTIMONI PENGUNJUNG
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @forelse ($testimonials as $testi)
                    <div class="bg-white dark:bg-[#212121] p-7 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex items-start gap-5 hover:border-accent/40 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="relative w-16 h-16 rounded-full overflow-hidden shrink-0 border-2 border-accent shadow-md bg-gray-200 dark:bg-gray-800">
                            @if($testi->avatar)
                                <img src="{{ asset('storage/' . $testi->avatar) }}" alt="{{ $testi->name }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/pfp.jpeg') }}" alt="Default" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <div class="flex text-amber-400 mb-2">
                                {!! str_repeat('&#9733;', $testi->rating) !!}
                                <span class="text-gray-300">{!! str_repeat('&#9733;', 5 - $testi->rating) !!}</span>
                            </div>
                            <p class="text-gray-700 dark:text-gray-200 text-sm font-medium leading-relaxed italic mb-4">
                                "{{ $testi->message }}"
                            </p>
                            <h4 class="font-extrabold text-secondary dark:text-light text-base uppercase">{{ $testi->name }}</h4>
                            
                            @if(isset($testi->role) && $testi->role != '')
                                <p class="text-xs font-semibold text-accent">{{ $testi->role }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-500 py-8">
                        <p>Belum ada testimoni pengunjung.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- LIPUTAN MEDIA (Full Width No Extra Padding) --}}
    <section id="liputan-media" class="py-14 bg-white dark:bg-[#0A0A0A] transition-colors overflow-hidden border-b border-gray-100 dark:border-gray-800/60">
        <div class="container-max">
            <div class="text-center max-w-xl mx-auto mb-10" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase tracking-wide">
                    LIPUTAN MEDIA
                </h2>
                <p class="text-xs md:text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mt-2">
                    SAATNYA ANDA & KELUARGA EKSPLORE SEKARANG JUGA
                </p>
            </div>

            <!-- Carousel Layout Mengisi Seluruh Container -->
            <div class="flex items-center gap-2 md:gap-4 w-full" data-aos="zoom-in" data-aos-duration="800">
                
                <!-- Tombol Panah Kiri -->
                <button type="button" 
                        id="media-prev" 
                        aria-label="Media Sebelumnya"
                        class="flex items-center justify-center w-11 h-11 md:w-12 md:h-12 rounded-full bg-white/90 dark:bg-[#212121]/90 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent dark:hover:bg-accent dark:hover:text-[#0A0A0A] dark:hover:border-accent shadow-md shrink-0 transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none">
                    <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Track Container (Max Width Full) -->
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
                            {{-- Data Default apabila $mediaLogos di Database kosong --}}
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

                <!-- Tombol Panah Kanan -->
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

    {{-- BANNER CTA / DISKON --}}
    <section class="py-14 bg-light dark:bg-[#161616] transition-colors overflow-hidden">
        <div class="container-max">
            <div class="relative overflow-hidden bg-gradient-to-r from-[#0A0A0A] via-secondary to-[#1a1a1a] text-white p-8 md:p-12 rounded-3xl flex flex-col lg:flex-row items-center justify-between gap-8 shadow-2xl border border-accent/20" data-aos="zoom-in-up" data-aos-duration="800">
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-accent/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-xl text-center lg:text-left">
                    <span class="inline-block text-accent font-extrabold text-xs uppercase tracking-widest mb-2">Penawaran Terbatas</span>
                    <h3 class="text-xl md:text-2xl font-black uppercase tracking-wide leading-snug">
                        DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA
                    </h3>
                    <p class="text-gray-300 text-sm mt-2">Hubungi admin kami via WhatsApp untuk informasi ketersediaan lapak galatama, reservasi villa penginapan, dan promo paket rombongan.</p>
                </div>

                <!-- Container 2 Tombol WhatsApp -->
                <div class="relative z-10 flex flex-col sm:flex-row gap-4 w-full lg:w-auto shrink-0 justify-center">
                    {{-- Tombol WA Pemancingan --}}
                    <a href="https://wa.me/62895385703917?text=Halo%20Admin%20BHS,%20saya%20ingin%20tanya%20info%20dan%20reservasi%20Pemancingan" 
                       target="_blank" 
                       class="inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-accent text-[#0A0A0A] font-extrabold rounded-2xl hover:bg-accent/90 hover:scale-105 active:scale-95 transition-all duration-300 uppercase tracking-wider text-xs md:text-sm shadow-xl">
                        <!-- Icon WA Solid -->
                        <svg class="w-5 h-5 shrink-0 fill-current text-[#0A0A0A]" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>WA Pemancingan</span>
                    </a>

                    {{-- Tombol WA Penginapan --}}
                    <a href="https://wa.me/62895385703917?text=Halo%20Admin%20BHS,%20saya%20ingin%20tanya%20info%20dan%20reservasi%20Penginapan%2FVilla" 
                       target="_blank" 
                       class="inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white font-extrabold rounded-2xl hover:bg-white/20 hover:scale-105 active:scale-95 transition-all duration-300 uppercase tracking-wider text-xs md:text-sm shadow-xl">
                        <!-- Icon WA Solid -->
                        <svg class="w-5 h-5 shrink-0 fill-current text-accent" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>WA Penginapan</span>
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
    // AOS Init
    // ----------------------------------------------------
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 700,
            easing: 'ease-out-cubic'
        });
    }

    // ----------------------------------------------------
    // Hero Slider Autoplay Script
    // ----------------------------------------------------
    (function () {
        const heroSection = document.getElementById('hero-slider');
        if (!heroSection) return;

        const slides = heroSection.querySelectorAll('.hero-slide');
        const prevBtn = document.getElementById('hero-prev');
        const nextBtn = document.getElementById('hero-next');
        if (!slides.length) return;

        const AUTOPLAY_DELAY = 5000;
        let currentIndex = 0;
        let autoplayTimer = null;

        function setActiveSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = (i === index) ? '1' : '0';
            });
            currentIndex = index;
        }

        function goToNextSlide() {
            setActiveSlide((currentIndex + 1) % slides.length);
        }

        function goToPrevSlide() {
            setActiveSlide((currentIndex - 1 + slides.length) % slides.length);
        }

        function startAutoplay() {
            autoplayTimer = setInterval(goToNextSlide, AUTOPLAY_DELAY);
        }

        function restartAutoplay() {
            clearInterval(autoplayTimer);
            startAutoplay();
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                goToNextSlide();
                restartAutoplay();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                goToPrevSlide();
                restartAutoplay();
            });
        }

        startAutoplay();
    })();

    // ----------------------------------------------------
    // Infinite Slider Liputan Media Script
    // ----------------------------------------------------
    (function initMediaInfiniteSlider() {
        const track = document.getElementById('media-track');
        const prevBtn = document.getElementById('media-prev');
        const nextBtn = document.getElementById('media-next');

        if (!track || !prevBtn || !nextBtn) return;

        let items = Array.from(track.querySelectorAll('.media-item'));
        if (items.length === 0) return;

        // Duplikasi item agar konten berputar tanpa jeda / tanpa batas
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
                void track.offsetWidth; // force reflow
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
            void track.offsetWidth; // force reflow

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
@endpush