@extends('layouts.app')

@section('title', 'Paket Layanan & Harga - Balong Hardi Sumedang')

@section('content')
<div class="pt-32 pb-16 bg-light dark:bg-dark min-h-screen transition-colors duration-300">
    <div class="container-max">
        
        {{-- Header Section --}}
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-accent/10 text-accent text-sm font-extrabold uppercase tracking-widest mb-4 border border-accent/20">
                Paket Layanan
            </span>
            <h1 class="text-3xl md:text-5xl font-black text-secondary dark:text-light uppercase tracking-tight mb-6">
                Pilihan Paket & Harga
            </h1>
            <p class="text-gray-600 dark:text-gray-400 text-lg">
                Temukan paket layanan terbaik yang sesuai dengan kebutuhan rekreasi, acara keluarga, atau kegiatan komunitas Anda di Balong Hardi Sumedang.
            </p>
        </div>

        {{-- AREA KONTEN (Silakan isi dengan Card Pricing nanti di sini) --}}
        <div id="pricing-content" class="mb-16">
            
            {{-- Placeholder / Blank State (Bisa dihapus kalau datanya sudah ada) --}}
            <div class="bg-white dark:bg-[#161616] border border-gray-200 dark:border-gray-800 rounded-3xl p-12 text-center shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="w-24 h-24 bg-gray-100 dark:bg-[#212121] rounded-full flex items-center justify-center mx-auto mb-6">
                    <!-- Icon Box/Package -->
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-secondary dark:text-light mb-3 uppercase tracking-wide">
                    Konten Paket Layanan Sedang Disiapkan
                </h3>
                <p class="text-gray-500 dark:text-gray-400 max-w-lg mx-auto mb-8 text-sm md:text-base">
                    Area ini sengaja dikosongkan. Nantinya semua informasi mengenai harga tiket, sewa fasilitas, dan promo VIP akan diletakkan di dalam kerangka halaman ini.
                </p>

                <!-- Tombol Aksi Sementara -->
                <div class="flex items-center justify-center gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white/5 border border-gray-300 dark:border-white/20 text-secondary dark:text-white font-bold rounded-xl hover:bg-gray-100 dark:hover:bg-white/10 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

        </div>
        
    </div>
</div>
@endsection

@push('js')
<script>
    // Inisialisasi AOS jika diperlukan khusus di halaman ini
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                once: true,
                duration: 800,
                easing: 'ease-out-cubic'
            });
        }
    });
</script>
@endpush