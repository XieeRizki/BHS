@extends('layouts.app')

@section('title', 'Informasi & Berita - Balong Hardi Sumedang')

@section('content')

    <section id="informasi" class="pt-6 md:pt-8 pb-12 md:pb-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <x-section-title
                badge="Informasi & Berita"
                title="Informasi Terkini BHS"
                subtitle="Ikuti kabar terbaru seputar kegiatan, promo, dan info penting dari Balong Hardi Sumedang"
            />

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">

                {{-- KONTEN BERITA (Kiri) --}}
                <div class="lg:col-span-2">
                    {{-- TODO backend: ganti @for ini dengan @foreach($berita as $item) dari controller --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @for ($i = 0; $i < 6; $i++)
                            <article class="group bg-white dark:bg-[#212121] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <a href="#" class="block relative h-44 overflow-hidden bg-gray-200 dark:bg-[#161616]">
                                    <img src="{{ asset('images/bhs2.jpg') }}" alt="Berita Kegiatan BHS #{{ $i + 1 }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </a>
                                <div class="p-5">
                                    <span class="text-[11px] font-extrabold text-accent tracking-wider uppercase">Kategori 3</span>
                                    <h3 class="font-extrabold text-secondary dark:text-light mt-1.5 mb-2 leading-snug line-clamp-2">
                                        <a href="#" class="hover:text-accent transition-colors">Berita Kegiatan yang Seru & Heboh BHS #3</a>
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">
                                        In a world full of distractions and growing to-do lists, structuring your tasks using popular prioritization...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-400 dark:text-gray-500 font-semibold pt-3 border-t border-gray-100 dark:border-white/10">
                                        <span>Humas BHS</span>
                                        <span>18/07/2026</span>
                                    </div>
                                </div>
                            </article>
                        @endfor
                    </div>

                    {{-- Pagination --}}
                    {{-- TODO backend: sambungkan ke {{ $berita->links() }} kalau pakai Laravel paginator --}}
                    <div class="flex items-center justify-center gap-2 mt-10">
                        <button type="button" aria-label="Halaman sebelumnya"
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-gray-200 dark:border-gray-700 text-gray-400 hover:text-accent hover:border-accent transition-colors duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <button type="button" class="w-10 h-10 rounded-full bg-accent text-[#0A0A0A] font-extrabold text-sm transition-colors duration-300">1</button>
                        <button type="button" class="w-10 h-10 rounded-full border border-gray-200 dark:border-gray-700 text-secondary dark:text-light font-bold text-sm hover:border-accent hover:text-accent transition-colors duration-300">2</button>

                        <button type="button" aria-label="Halaman berikutnya"
                                class="flex items-center justify-center w-10 h-10 rounded-full border border-gray-200 dark:border-gray-700 text-gray-400 hover:text-accent hover:border-accent transition-colors duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- SIDEBAR (Kanan) --}}
                <div id="informasi-sidebar" class="lg:col-span-1 lg:sticky lg:top-28 lg:self-start space-y-10">

                    {{-- Spotlight --}}
                    <div>
                        <h3 class="text-lg font-extrabold text-secondary dark:text-light uppercase tracking-wide mb-4">Spotlight</h3>
                        <div class="space-y-4">
                            {{-- TODO backend: ganti @for ini dengan @foreach($spotlight as $item) --}}
                            @for ($i = 0; $i < 4; $i++)
                                <a href="#" class="flex items-start gap-3 group">
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[11px] font-extrabold text-accent tracking-wider uppercase">Kategori 3</span>
                                        <h4 class="text-sm font-bold text-secondary dark:text-light leading-snug mt-1 line-clamp-2 group-hover:text-accent transition-colors">
                                            Berita Kegiatan yang Seru & Heboh BHS #3
                                        </h4>
                                        <span class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-1 block">18/07/2026</span>
                                    </div>
                                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200 dark:bg-[#212121] flex-shrink-0">
                                        <img src="{{ asset('images/bhs2.jpg') }}" alt="Spotlight {{ $i + 1 }}" class="w-full h-full object-cover">
                                    </div>
                                </a>
                            @endfor
                        </div>
                    </div>

                    {{-- Kategori Trending Topics --}}
                    <div>
                        <h3 class="text-lg font-extrabold text-secondary dark:text-light uppercase tracking-wide mb-4">Kategori Trending Topics</h3>
                        {{-- TODO backend: ganti @for ini dengan @foreach($kategoriTrending as $kategori) --}}
                        <div class="flex flex-wrap gap-2">
                            @for ($i = 0; $i < 6; $i++)
                                <a href="#" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-xs font-bold text-secondary dark:text-light hover:bg-accent hover:text-[#0A0A0A] hover:border-accent transition-colors duration-300">
                                    Kategori 1
                                </a>
                            @endfor
                        </div>
                    </div>

                    {{-- Menarik Tuk Disimak --}}
                    <div>
                        <h3 class="text-lg font-extrabold text-secondary dark:text-light uppercase tracking-wide mb-4">Menarik Tuk Disimak</h3>
                        {{-- TODO backend: ganti dengan artikel pilihan/featured dari database --}}
                        <a href="#" class="group block relative h-56 rounded-2xl overflow-hidden bg-gray-200 dark:bg-[#212121] shadow-sm hover:shadow-xl transition-all duration-300">
                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Artikel Pilihan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>
                            <span class="absolute bottom-4 left-4 text-white font-extrabold uppercase tracking-wide text-sm">Artikel</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection