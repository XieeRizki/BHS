@extends('layouts.app')

@section('title', 'Informasi & Berita - Balong Hardi Sumedang')

@section('content')

{{-- Breadcrumb --}}
<div class="bg-white dark:bg-[#1F160D] border-b border-gray-100 dark:border-white/6">
    <div class="container-max py-4">
        <nav class="text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-accent transition">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-secondary dark:text-light font-semibold">Informasi</span>
        </nav>
    </div>
</div>

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

                    @if($selectedCategory)
                        <div class="flex items-center justify-between mb-6 p-3 bg-white dark:bg-[#212121] border border-gray-200/80 dark:border-gray-800 rounded-xl">
                            <span class="text-sm text-secondary dark:text-light">
                                Menampilkan kategori: <strong>{{ $selectedCategory->name }}</strong>
                            </span>
                            <a href="{{ route('informasi') }}" class="text-xs font-bold text-accent hover:underline">Reset Filter</a>
                        </div>
                    @endif
                    
                    @if($berita->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach ($berita as $item)
                                <article class="group bg-white dark:bg-[#212121] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                    <a href="#" class="block relative h-44 overflow-hidden bg-gray-200 dark:bg-[#161616]">
                                        <!-- Gunakan gambar default jika cover_image kosong -->
                                        @if($item->cover_image)
                                            <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Default Image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @endif
                                    </a>
                                    <div class="p-5">
                                        <span class="text-[11px] font-extrabold text-accent tracking-wider uppercase">{{ $item->category->name ?? 'Uncategorized' }}</span>
                                        <h3 class="font-extrabold text-secondary dark:text-light mt-1.5 mb-2 leading-snug line-clamp-2">
                                            <!-- TODO: Arahkan href ke route detail berita misal route('informasi.show', $item->slug) -->
                                            <a href="#" class="hover:text-accent transition-colors">{{ $item->title }}</a>
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">
                                            {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 100) }}
                                        </p>
                                        <div class="flex items-center justify-between text-xs text-gray-400 dark:text-gray-500 font-semibold pt-3 border-t border-gray-100 dark:border-white/10">
                                            <span>{{ $item->author_name }}</span>
                                            <span>{{ $item->published_at ? $item->published_at->format('d/m/Y') : $item->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-10 flex justify-center">
                            {{ $berita->links('pagination::tailwind') }} 
                        </div>
                    @else
                        <div class="text-center py-10 bg-white dark:bg-[#212121] rounded-2xl border border-gray-200/80 dark:border-gray-800">
                            <i class="fas fa-newspaper text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-500 font-medium">Belum ada berita yang dipublikasikan.</p>
                        </div>
                    @endif

                </div>

                {{-- SIDEBAR (Kanan) --}}
                <div id="informasi-sidebar" class="lg:col-span-1 lg:sticky lg:top-28 lg:self-start space-y-10">

                    {{-- Spotlight --}}
                    <div>
                        <h3 class="text-lg font-extrabold text-secondary dark:text-light uppercase tracking-wide mb-4">Spotlight</h3>
                        <div class="space-y-4">
                            @forelse ($spotlight as $item)
                                <!-- TODO: Arahkan href ke route detail artikel -->
                                <a href="#" class="flex items-start gap-3 group">
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[11px] font-extrabold text-accent tracking-wider uppercase">{{ $item->category->name ?? 'Umum' }}</span>
                                        <h4 class="text-sm font-bold text-secondary dark:text-light leading-snug mt-1 line-clamp-2 group-hover:text-accent transition-colors">
                                            {{ $item->title }}
                                        </h4>
                                        <span class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-1 block">
                                            {{ $item->published_at ? $item->published_at->format('d/m/Y') : $item->created_at->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200 dark:bg-[#212121] flex-shrink-0">
                                        @if($item->cover_image)
                                            <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('images/bhs2.jpg') }}" alt="Default" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                </a>
                            @empty
                                <p class="text-sm text-gray-500 italic">Belum ada spotlight.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Kategori Trending Topics --}}
                    <div>
                        <h3 class="text-lg font-extrabold text-secondary dark:text-light uppercase tracking-wide mb-4">Kategori Trending Topics</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse ($kategoriTrending as $kategori)
                                <a href="{{ route('informasi', ['kategori' => $kategori->slug]) }}"
                                class="px-4 py-2 rounded-lg border text-xs font-bold transition-colors duration-300
                                        {{ $selectedCategory && $selectedCategory->id === $kategori->id
                                            ? 'bg-accent text-[#0A0A0A] border-accent'
                                            : 'border-gray-200 dark:border-gray-700 text-secondary dark:text-light hover:bg-accent hover:text-[#0A0A0A] hover:border-accent' }}">
                                    {{ $kategori->name }}
                                </a>
                            @empty
                                <p class="text-sm text-gray-500 italic">Belum ada kategori trending.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Menarik Tuk Disimak (Featured Article) --}}
                    <div>
                        <h3 class="text-lg font-extrabold text-secondary dark:text-light uppercase tracking-wide mb-4">Menarik Tuk Disimak</h3>
                        @if ($artikelPilihan)
                            <!-- TODO: Arahkan href ke route detail artikel -->
                            <a href="#" class="group block relative h-56 rounded-2xl overflow-hidden bg-gray-200 dark:bg-[#212121] shadow-sm hover:shadow-xl transition-all duration-300">
                                @if($artikelPilihan->cover_image)
                                    <img src="{{ asset('storage/' . $artikelPilihan->cover_image) }}" alt="{{ $artikelPilihan->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <img src="{{ asset('images/bhs2.jpg') }}" alt="Default" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <span class="inline-block bg-accent text-[#0A0A0A] px-2 py-0.5 rounded text-[10px] font-extrabold uppercase tracking-wider mb-2">
                                        {{ $artikelPilihan->category->name ?? 'Artikel' }}
                                    </span>
                                    <h4 class="text-white font-bold text-sm leading-snug line-clamp-2">{{ $artikelPilihan->title }}</h4>
                                </div>
                            </a>
                        @else
                             <p class="text-sm text-gray-500 italic">Belum ada artikel pilihan.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection