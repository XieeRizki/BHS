@extends('layouts.app')

@section('title', 'Home - Balong Hardi Sumedang | Tempat Pemancingan Terbaik')

@section('content')

    {{-- HERO (statis, dominan coklat-keemasan) --}}
    <section class="relative flex items-center min-h-screen -mt-20 overflow-hidden bg-gradient-to-br from-primary to-accent text-white" style="min-height:100vh;">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/bhs2.jpg') }}"
                 alt="Hero Background"
                 class="absolute inset-0 w-full h-full object-cover opacity-70">
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

                <div class="flex justify-center md:justify-start gap-4">
                    <a href="#kontak" class="inline-flex items-center gap-3 px-7 py-3 rounded-xl bg-accent text-[#0A0A0A] font-bold shadow-lg hover:brightness-95 transition hover:scale-105 duration-300">
                        Reservasi Sekarang
                    </a>
                    <a href="#fasilitas" class="inline-flex items-center gap-3 px-6 py-3 rounded-xl border border-white/20 bg-white/5 text-white hover:bg-white/10 transition hover:scale-105 duration-300">
                        Lihat Fasilitas
                    </a>
                </div>
            </div>
        </div>

        {{-- decorative gold glows --}}
        <div class="absolute -top-32 -right-24 w-96 h-96 rounded-full blur-3xl opacity-30 pointer-events-none" style="background: linear-gradient(135deg, rgba(201,162,39,0.25), rgba(26,26,26,0.15));"></div>
        <div class="absolute -bottom-32 -left-24 w-96 h-96 rounded-full blur-3xl opacity-20 pointer-events-none" style="background: linear-gradient(135deg, rgba(166,132,30,0.18), rgba(10,10,10,0.1));"></div>
    </section>

    {{-- TENTANG --}}
    <section class="py-16 bg-light dark:bg-dark transition-colors overflow-hidden">
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
                <a href="#fasilitas" class="inline-flex items-center gap-2 px-5 py-3 bg-accent text-[#0A0A0A] font-semibold rounded-lg shadow-md hover:bg-accent-dark hover:shadow-lg transition hover:-translate-y-0.5">Lihat Fasilitas</a>
            </div>
        </div>
    </section>

    {{-- FASILITAS --}}
    <section id="fasilitas" class="py-16 bg-light dark:bg-dark transition-colors overflow-hidden">
        <div class="container-max">
            <div class="text-center mb-10" data-aos="fade-up">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Fasilitas Kami</p>
                <h3 class="text-2xl md:text-3xl font-bold text-secondary dark:text-light">Lengkap, Asri & Nyaman</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="relative lg:col-span-2 h-[420px] rounded-2xl overflow-hidden shadow-lg flex items-end p-8 bg-gray-100 dark:bg-[#161616]" data-aos="fade-right" data-aos-duration="800">
                    <img src="{{ asset('images/bhs2.jpg') }}"
                         alt="Kolam Pemancingan" class="absolute inset-0 w-full h-full object-cover opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="relative z-10 text-white">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-lg bg-accent flex items-center justify-center text-[#0A0A0A] flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M2 12s3.5-6 10-6c3.5 0 6.5 1.9 8 3.5.6-1 1.3-1.9 2-2.5-.2 1.6-.2 3.4 0 5 -.7-.6-1.4-1.5-2-2.5-1.5 1.6-4.5 3.5-8 3.5s-8-3-8-3zm10 3c1.5 0 2.7-.9 3.3-2H8.7c.6 1.1 1.8 2 3.3 2zM17 8.5a1 1 0 110 2 1 1 0 010-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold">Kolam Pemancingan Utama</h4>
                                <p class="text-sm text-[#EDEDED]">Kolam luas untuk lomba & rekreasi.</p>
                            </div>
                        </div>
                        <p class="text-gray-200 max-w-xl">Area terawat, bibit ikan pilihan, dan fasilitas pendukung untuk event komunitas & keluarga.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4 lg:h-[420px]">
                    <div class="flex items-stretch bg-white dark:bg-[#161616] rounded-xl overflow-hidden shadow-sm dark:shadow-black/30 hover:shadow-md transition" data-aos="fade-left" data-aos-delay="100">
                        <div class="w-28 sm:w-32 flex-shrink-0">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Villa Kayu Estetik" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center p-4">
                            <h4 class="font-bold text-secondary dark:text-light">Villa Kayu Estetik</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Penginapan nyaman untuk keluarga.</p>
                        </div>
                    </div>

                    <div class="flex items-stretch bg-white dark:bg-[#161616] rounded-xl overflow-hidden shadow-sm dark:shadow-black/30 hover:shadow-md transition" data-aos="fade-left" data-aos-delay="200">
                        <div class="w-28 sm:w-32 flex-shrink-0">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Resto & Cafe" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center p-4">
                            <h4 class="font-bold text-secondary dark:text-light">Resto & Cafe</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Menu lokal & kopi spesial.</p>
                        </div>
                    </div>

                    <div class="flex items-stretch bg-white dark:bg-[#161616] rounded-xl overflow-hidden shadow-sm dark:shadow-black/30 hover:shadow-md transition" data-aos="fade-left" data-aos-delay="300">
                        <div class="w-28 sm:w-32 flex-shrink-0">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Area Parkir Luas" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center p-4">
                            <h4 class="font-bold text-secondary dark:text-light">Area Parkir Luas</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Aman & muat banyak kendaraan.</p>
                        </div>
                    </div>

                    <div class="flex items-stretch bg-white dark:bg-[#161616] rounded-xl overflow-hidden shadow-sm dark:shadow-black/30 hover:shadow-md transition" data-aos="fade-left" data-aos-delay="400">
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

    {{-- EVENT --}}
    <section id="event" class="py-14 bg-light dark:bg-dark transition-colors overflow-hidden">
        <div class="container-max">
            <div class="text-center mb-8" data-aos="fade-up">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Event</p>
                <h3 class="text-2xl font-bold text-secondary dark:text-light">Agenda & Event</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <div class="card-modern overflow-hidden hover:-translate-y-2 transition-transform duration-300" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
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

    {{-- INFORMASI & BERITA BHS --}}
    <section id="informasi" class="py-16 bg-white dark:bg-dark transition-colors border-b border-gray-100 dark:border-gray-800/60 overflow-hidden">
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
                <div class="group bg-light dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
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
                <div class="group bg-light dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
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
                <div class="group bg-light dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
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

    {{-- ARTIKEL, TIPS & TRIK BHS --}}
    <section id="artikel" class="py-16 bg-light dark:bg-dark transition-colors border-b border-gray-200/80 dark:border-gray-800/60 overflow-hidden">
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
                <div class="group bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
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
                <div class="group bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
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
                <div class="group bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
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

    {{-- TESTIMONI --}}
    <section id="testimoni" class="py-16 bg-white dark:bg-dark transition-colors border-b border-gray-100 dark:border-gray-800/60 overflow-hidden">
        <div class="container-max">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-accent/10 border border-accent/20 rounded-full text-xs font-extrabold text-accent uppercase tracking-wider mb-2">Kata Mereka</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase">
                    TESTIMONI PENGUNJUNG
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                {{-- Testi Card 1 --}}
                <div class="bg-light dark:bg-[#161616] p-7 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex items-start gap-5 hover:border-accent/40 transition-all duration-300" data-aos="fade-right" data-aos-delay="100">
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
                <div class="bg-light dark:bg-[#161616] p-7 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex items-start gap-5 hover:border-accent/40 transition-all duration-300" data-aos="fade-left" data-aos-delay="200">
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

    {{-- LIPUTAN MEDIA --}}
    <section id="liputan-media" class="py-16 bg-light dark:bg-dark transition-colors border-b border-gray-200/80 dark:border-gray-800 overflow-hidden">
        <div class="container-max">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="inline-block px-3 py-1 bg-accent/10 border border-accent/20 rounded-full text-xs font-extrabold text-accent uppercase tracking-wider mb-2">Pemberitaan Nasional & Lokal</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-secondary dark:text-light uppercase tracking-wide">
                    LIPUTAN MEDIA
                </h2>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mt-2">
                    Saatnya Anda & Keluarga Eksplore Dan Rasakan Pengalaman Berbeda Sekarang Juga!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Media 1 --}}
                <div class="bg-white dark:bg-[#161616] p-6 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:-translate-y-2 transition-all duration-300" data-aos="zoom-in" data-aos-delay="100">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 text-xs font-extrabold rounded-md uppercase tracking-wider">INFOJABAR</span>
                            <span class="text-xs text-gray-400 font-semibold">Media Partner</span>
                        </div>
                        <h4 class="font-extrabold text-base text-secondary dark:text-light mb-2 leading-snug">
                            "Balong Hardi Sumedang Jadi Ikon Wisata Pemancingan Modern Terbaik di Jawa Barat."
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                            Apresiasi tinggi diberikan atas kelengkapan fasilitas villa, kolam terawat, hingga pelayanan ramah.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <span class="text-xs font-bold text-accent">Sorotan Berita</span>
                        <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                {{-- Media 2 --}}
                <div class="bg-white dark:bg-[#161616] p-6 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:-translate-y-2 transition-all duration-300" data-aos="zoom-in" data-aos-delay="250">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-red-50 dark:bg-red-950/50 text-red-600 dark:text-red-400 text-xs font-extrabold rounded-md uppercase tracking-wider">TRIBUN JABAR</span>
                            <span class="text-xs text-gray-400 font-semibold">Media Partner</span>
                        </div>
                        <h4 class="font-extrabold text-base text-secondary dark:text-light mb-2 leading-snug">
                            "Kemeriahan Event Galatama BHS Tarik Antusias Ratusan Pemancing Seluruh Indonesia."
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                            Kompetisi bergengsi dengan total hadiah menarik yang selalu dinantikan para angler nusantara.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <span class="text-xs font-bold text-accent">Sorotan Berita</span>
                        <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>

                {{-- Media 3 --}}
                <div class="bg-white dark:bg-[#161616] p-6 rounded-2xl border border-gray-200/80 dark:border-gray-800 shadow-sm flex flex-col justify-between hover:-translate-y-2 transition-all duration-300" data-aos="zoom-in" data-aos-delay="400">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 text-xs font-extrabold rounded-md uppercase tracking-wider">PIKIRAN RAKYAT</span>
                            <span class="text-xs text-gray-400 font-semibold">Media Partner</span>
                        </div>
                        <h4 class="font-extrabold text-base text-secondary dark:text-light mb-2 leading-snug">
                            "Destinasi Keluarga Ideal: Kombinasi Kuliner Resto, Penginapan Villa, dan Pemancingan."
                        </h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">
                            BHS terbukti sukses menyatukan hobi memancing dengan kenyamanan rekreasi sanak keluarga.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                        <span class="text-xs font-bold text-accent">Sorotan Berita</span>
                        <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BANNER CTA / DISKON --}}
    <section class="py-14 bg-white dark:bg-dark transition-colors overflow-hidden">
        <div class="container-max">
            <div class="relative overflow-hidden bg-gradient-to-r from-[#0A0A0A] via-secondary to-[#1a1a1a] text-white p-8 md:p-12 rounded-3xl flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl border border-accent/20" data-aos="zoom-in-up" data-aos-duration="800">
                
                {{-- Decorative Glow Overlay --}}
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-accent/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-block text-accent font-extrabold text-xs uppercase tracking-widest mb-2">Penawaran Terbatas</span>
                    <h3 class="text-xl md:text-2xl font-black uppercase tracking-wide leading-snug">
                        DAPATKAN PAKET DISKON SPECIAL DAN INFORMASINYA SEKARANG JUGA
                    </h3>
                    <p class="text-gray-300 text-sm mt-2">Hubungi admin kami lewat WhatsApp untuk informasi ketersediaan lapak galatama, reservasi villa, dan promo paket rombongan.</p>
                </div>

                <a href="https://wa.me/62895385703917" target="_blank" class="relative z-10 inline-flex items-center gap-3 px-8 py-4 bg-accent text-[#0A0A0A] font-extrabold rounded-2xl hover:bg-accent/90 hover:scale-105 active:scale-95 transition-all duration-300 shrink-0 uppercase tracking-wider text-sm shadow-xl">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    <span>KONTAK WA</span>
                </a>
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
});
</script>
@endpush