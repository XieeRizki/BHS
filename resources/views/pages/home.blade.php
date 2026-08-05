@extends('layouts.app')

@section('title', 'Home - Balong Hardi Sumedang | Tempat Pemancingan Terbaik')

@section('content')

    {{-- HERO --}}
    <section id="hero-slider" class="relative flex items-center min-h-screen -mt-20 overflow-hidden bg-gradient-to-br from-primary to-accent text-white" style="min-height:100vh;">

        {{-- Hero Slides (3 foto, auto-geser + bisa diklik lewat tombol di bawah teks) --}}
        <div class="absolute inset-0 z-0">
            {{-- Slide 1 --}}
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out" style="opacity:1;" data-slide-index="0">
                <img src="{{ asset('images/banner1.jpeg') }}"
                     alt="Kolam Pemancingan Balong Hardi Sumedang"
                     class="absolute inset-0 w-full h-full object-cover opacity-70">
            </div>

            {{-- Slide 2 --}}
            {{-- TODO backend: ganti src dengan foto villa/penginapan --}}
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out" style="opacity:0;" data-slide-index="1">
                <img src="{{ asset('images/banner3.jpeg') }}"
                     alt="Villa & Penginapan Balong Hardi Sumedang"
                     class="absolute inset-0 w-full h-full object-cover opacity-70">
            </div>

            {{-- Slide 3 --}}
            {{-- TODO backend: ganti src dengan foto suasana resto/keluarga --}}
            <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out" style="opacity:0;" data-slide-index="2">
                <img src="{{ asset('images/banner2.jpeg') }}"
                     alt="Suasana Resto & Rekreasi Keluarga"
                     class="absolute inset-0 w-full h-full object-cover opacity-70">
            </div>

            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A]/85 via-[#0A0A0A]/60 to-transparent"></div>
        </div>

        <div class="container-max relative z-10 w-full py-24 md:py-32">
            <div class="max-w-3xl text-center md:text-left" data-aos="fade-right" data-aos-duration="1000">
                <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full mb-6 text-sm font-semibold text-accent">Tempat Memancing Premium</span>

                <h1 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight">
                    Selamat Datang di Balong Hardi Sumedang
                </h1>

                <p class="text-lg md:text-xl text-[#EDEDED] mb-8">
                    Nikmati pengalaman memancing & rekreasi keluarga dengan nuansa coklat-keemasan — asri, nyaman, dan penuh layanan.
                </p>

                <div class="flex justify-center md:justify-start gap-4 mb-8">
                    <a href="#kontak" class="inline-flex items-center gap-3 px-7 py-3 rounded-xl bg-accent text-[#0A0A0A] font-bold shadow-lg hover:brightness-95 transition hover:scale-105 duration-300">
                        Reservasi Sekarang
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

    {{-- TENTANG (Light: bg-white | Dark: dark:bg-[#0A0A0A]) --}}
    <section class="py-16 bg-white dark:bg-[#0A0A0A] transition-colors overflow-hidden border-b border-gray-100 dark:border-gray-800/60">
        <div class="container-max grid md:grid-cols-2 gap-12 items-center">
            <div class="rounded-3xl overflow-hidden shadow-xl h-96" data-aos="fade-right" data-aos-duration="800">
                <img src="{{ asset('images/bhs2.jpg') }}"
                     alt="Tentang BHS"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>

            <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <span class="text-accent font-bold uppercase tracking-wider text-sm">Tentang Kami</span>
                <h2 class="text-3xl font-bold text-secondary dark:text-light mt-2 mb-4">Destinasi Pemancingan & Rekreasi Keluarga</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                    Balong Hardi Sumedang hadir memberikan pengalaman memancing premium dengan fasilitas lengkap: kolam galatama, villa kayu, resto & penginapan — dibalut nuansa coklat-keemasan.
                </p>
                <a href="{{ route('about') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-accent text-[#0A0A0A] font-semibold rounded-lg shadow-md hover:bg-accent-dark hover:shadow-lg transition hover:-translate-y-0.5">Lihat Selengkapnya</a>
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
        <div class="container-max">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-accent/10 border border-accent/20 rounded-full text-xs font-extrabold text-accent uppercase tracking-wider mb-2">Kata Mereka</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase">
                    TESTIMONI PENGUNJUNG
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                {{-- Testi Card 1 --}}
                <div class="bg-white dark:bg-[#212121] p-7 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex items-start gap-5 hover:border-accent/40 transition-all duration-300" data-aos="fade-right" data-aos-delay="100">
                    <div class="relative w-16 h-16 rounded-full overflow-hidden shrink-0 border-2 border-accent shadow-md bg-gray-200 dark:bg-gray-800">
                        <img src="{{ asset('images/pfp.jpeg') }}" 
                             alt="Rizki R." 
                             class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex text-amber-400 mb-2">
                            ★★★★★
                        </div>
                        <p class="text-gray-700 dark:text-gray-200 text-sm font-medium leading-relaxed italic mb-4">
                            "Website dan fasilitasnya keren gak ada duanya. Tempat galatama paling mantap di Sumedang. Sukses terus buat BHS!"
                        </p>
                        <h4 class="font-extrabold text-secondary dark:text-light text-base uppercase">RIZKI R.</h4>
                        <p class="text-xs font-semibold text-accent">Ketua HIPMI Sumedang</p>
                    </div>
                </div>

                {{-- Testi Card 2 --}}
                <div class="bg-white dark:bg-[#212121] p-7 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex items-start gap-5 hover:border-accent/40 transition-all duration-300" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative w-16 h-16 rounded-full overflow-hidden shrink-0 border-2 border-accent shadow-md bg-gray-200 dark:bg-gray-800">
                        <img src="{{ asset('images/pfp.jpeg') }}" 
                             alt="Rizki R." 
                             class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex text-amber-400 mb-2">
                            ★★★★★
                        </div>
                        <p class="text-gray-700 dark:text-gray-200 text-sm font-medium leading-relaxed italic mb-4">
                            "Fasilitas bersih, kolam ikan sehat, spot rekreasi keluarga yang lengkap banget. Wajib bawa joran kalau ke sini!"
                        </p>
                        <h4 class="font-extrabold text-secondary dark:text-light text-base uppercase">RIZKI R.</h4>
                        <p class="text-xs font-semibold text-accent">Anggota Komunitas Mancing</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LIPUTAN MEDIA (Light: bg-white | Dark: dark:bg-[#0A0A0A]) --}}
    <section id="liputan-media" class="py-16 bg-white dark:bg-[#0A0A0A] transition-colors overflow-hidden border-b border-gray-100 dark:border-gray-800/60">
        <div class="container-max">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase tracking-wide">
                    LIPUTAN MEDIA
                </h2>
                <p class="text-sm font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300 mt-2">
                    SAATNYA ANDA & KELURGA EKSPLORE SEKARANG JUGA
                </p>
            </div>

            <!-- Carousel Container / Grid Media Logos -->
            <div class="flex items-center gap-3 md:gap-6 w-full" data-aos="zoom-in" data-aos-duration="800">

                <!-- Arrow Left -->
                <button type="button" class="text-gray-400 hover:text-accent transition-colors p-1 shrink-0 hidden sm:block">
                    <svg class="w-7 h-7 md:w-9 md:h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Wrapper 5 Items Media -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-y-8 gap-x-4 w-full place-items-center">

                    {{-- Media 1: Info Jabar --}}
                    <a href="https://infojabar.id" target="_blank" class="group flex flex-col items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 md:w-28 md:h-28 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-gray-50 dark:bg-[#212121] shrink-0 p-1.5 shadow-sm">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Info Jabar" class="w-full h-full object-cover rounded-full">
                        </div>
                        <span class="font-extrabold text-xs md:text-base text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors text-center">
                            INFOJABAR
                        </span>
                    </a>

                    {{-- Media 2: Tribun Jabar --}}
                    <a href="https://jabar.tribunnews.com" target="_blank" class="group flex flex-col items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 md:w-28 md:h-28 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-gray-50 dark:bg-[#212121] shrink-0 p-1.5 shadow-sm">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Tribun Jabar" class="w-full h-full object-cover rounded-full">
                        </div>
                        <span class="font-extrabold text-xs md:text-base text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors text-center">
                            TRIBUN JABAR
                        </span>
                    </a>

                    {{-- Media 3: Pikiran Rakyat --}}
                    <a href="https://pikiran-rakyat.com" target="_blank" class="group flex flex-col items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 md:w-28 md:h-28 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-gray-50 dark:bg-[#212121] shrink-0 p-1.5 shadow-sm">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Pikiran Rakyat" class="w-full h-full object-cover rounded-full">
                        </div>
                        <span class="font-extrabold text-xs md:text-base text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors text-center">
                            PIKIRAN RAKYAT
                        </span>
                    </a>

                    {{-- Media 4: Trans7 --}}
                    <a href="https://www.trans7.co.id" target="_blank" class="group flex flex-col items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 md:w-28 md:h-28 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-gray-50 dark:bg-[#212121] shrink-0 p-1.5 shadow-sm">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="TRANS7" class="w-full h-full object-cover rounded-full">
                        </div>
                        <span class="font-extrabold text-xs md:text-base text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors text-center">
                            TRANS7
                        </span>
                    </a>

                    {{-- Media 5: Metro TV --}}
                    <a href="https://www.metrotvnews.com" target="_blank" class="group flex flex-col items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <div class="w-20 h-20 md:w-28 md:h-28 rounded-full border-2 border-gray-300 dark:border-gray-700 group-hover:border-accent overflow-hidden flex items-center justify-center bg-gray-50 dark:bg-[#212121] shrink-0 p-1.5 shadow-sm">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Metro TV" class="w-full h-full object-cover rounded-full">
                        </div>
                        <span class="font-extrabold text-xs md:text-base text-secondary dark:text-light group-hover:text-accent tracking-wider uppercase transition-colors text-center">
                            METRO TV
                        </span>
                    </a>

                </div>

                <!-- Arrow Right -->
                <button type="button" class="text-gray-400 hover:text-accent transition-colors p-1 shrink-0 hidden sm:block">
                    <svg class="w-7 h-7 md:w-9 md:h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true,
            duration: 700,
            easing: 'ease-out-cubic'
        });
    }

    // Hero Slider: 3 slide otomatis geser + bisa diklik lewat tombol panah
    (function () {
        const heroSection = document.getElementById('hero-slider');
        if (!heroSection) return;

        const slides = heroSection.querySelectorAll('.hero-slide');
        const prevBtn = document.getElementById('hero-prev');
        const nextBtn = document.getElementById('hero-next');
        if (!slides.length) return;

        const AUTOPLAY_DELAY = 5000; // 5 detik
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
});
</script>
@endpush