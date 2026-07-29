@extends('layouts.app')

@section('title', 'Home - Balong Hardi Sumedang | Tempat Pemancingan Terbaik')

@section('content')

    {{-- Hero Section (Statis/Dummy) --}}
    <section class="relative flex items-center min-h-screen -mt-20 overflow-hidden bg-gray-900 z-0" style="min-height: 100vh;">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1920&q=80" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover opacity-80">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/95 via-gray-900/70 to-transparent"></div>
        </div>
        <div class="container-max relative z-10 w-full py-24">
            <div class="max-w-2xl text-center md:text-left text-white">
                <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full mb-6 text-sm font-semibold">Tempat Memancing Terbaik</span>
                <h1 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight">Selamat Datang di Balong Hardi Sumedang</h1>
                <p class="text-lg text-gray-300 mb-8">Nikmati pengalaman memancing dan liburan keluarga yang asri, nyaman, dan menyenangkan di Sumedang.</p>
                <a href="#kontak" class="px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-primary-dark transition-all">Reservasi Sekarang</a>
            </div>
        </div>
    </section>

    {{-- ================= TENTANG BHS ================= --}}
    <section class="py-20 bg-white">
        <div class="container-max grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="h-96 rounded-3xl overflow-hidden shadow-2xl bg-gray-200">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Tentang BHS" class="w-full h-full object-cover">
            </div>
            <div>
                <span class="text-primary font-bold uppercase tracking-wider text-sm">Tentang Kami</span>
                <h2 class="text-3xl font-bold text-secondary mt-2 mb-4">Destinasi Pemancingan & Rekreasi Keluarga</h2>
                <p class="text-gray-600 leading-relaxed mb-6">Balong Hardi Sumedang hadir untuk memberikan fasilitas pemancingan galatama, harian, serta tempat bersantai keluarga yang dilengkapi dengan resto dan penginapan bernuansa alam.</p>
            </div>
        </div>
    </section>

    {{-- ================= FASILITAS ================= --}}
    <section id="fasilitas" class="py-16 bg-light dark:bg-dark">
        <div class="container-max">
            <div class="text-center mb-12">
                <span class="text-primary font-bold uppercase tracking-wider text-sm">Fasilitas Kami</span>
                <h2 class="text-3xl font-bold text-secondary dark:text-white mt-1">Lengkap, Asri & Nyaman</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Fasilitas Utama (Besar) --}}
                <div class="relative lg:col-span-2 h-[400px] rounded-2xl overflow-hidden shadow-lg bg-gray-800 flex items-end p-8">
                    <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1200&q=80" alt="Kolam Pemancingan" class="absolute inset-0 w-full h-full object-cover opacity-70">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="relative z-10 text-white">
                        <span class="text-3xl mb-2 block">🎣</span>
                        <h3 class="text-3xl font-bold mb-2">Kolam Pemancingan Utama</h3>
                        <p class="text-gray-200">Kolam luas dengan ikan pilihan terbaik untuk perlombaan galatama dan harian.</p>
                    </div>
                </div>

                {{-- List Fasilitas Kecil (Dummy 2 Item) --}}
                <div class="flex flex-col justify-between gap-4">
                    <div class="flex items-center gap-4 bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="w-16 h-16 rounded-lg bg-primary/20 flex items-center justify-center text-2xl flex-shrink-0">🏡</div>
                        <div>
                            <h4 class="font-bold text-secondary dark:text-white">Villa Kayu Estetik</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-300">Tempat istirahat nyaman keluarga.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="w-16 h-16 rounded-lg bg-primary/20 flex items-center justify-center text-2xl flex-shrink-0">🍽️</div>
                        <div>
                            <h4 class="font-bold text-secondary dark:text-white">Resto & Cafe</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-300">Menu kuliner khas sunda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= KONTAK / RESERVASI ================= --}}
    <section id="kontak" class="py-16 bg-white dark:bg-gray-900">
        <div class="container-max max-w-3xl text-center">
            <span class="text-primary font-bold uppercase tracking-wider text-sm">Reservasi Sekarang</span>
            <h2 class="text-3xl font-bold text-secondary dark:text-white mt-1 mb-8">Hubungi Kami untuk Info & Pemesanan</h2>
            <div class="bg-light dark:bg-gray-800 p-8 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 mb-6">Silakan hubungi admin kami melalui WhatsApp untuk respon cepat.</p>
                <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-green-600 text-white font-bold rounded-xl shadow-lg hover:bg-green-700 transition-all text-lg">
                    <span>Chat WhatsApp Admin</span>
                </a>
            </div>
        </div>
    </section>

@endsection