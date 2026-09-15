@extends('layouts.app')

@section('title', $post->title . ' - Balong Hardi Sumedang')

@section('content')

{{-- Breadcrumb --}}
<div class="bg-white dark:bg-[#1F160D] border-b border-gray-100 dark:border-white/6 pt-6 pb-4">
    <div class="container-max">
        <nav class="text-xs md:text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-accent transition">Beranda</a>
            <span class="mx-2 text-gray-300 dark:text-gray-600">/</span>
            <a href="{{ route('informasi') }}" class="hover:text-accent transition">Informasi</a>
            <span class="mx-2 text-gray-300 dark:text-gray-600">/</span>
            <span class="text-secondary dark:text-light font-extrabold">{{ strtoupper($post->title) }}</span>
        </nav>
    </div>
</div>

<section class="py-8 md:py-12 bg-light dark:bg-dark transition-colors">
    <div class="container-max">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-12">

            {{-- KONTEN UTAMA --}}
            <div class="lg:col-span-2">

                <div class="flex items-center gap-2 mb-4">
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider
                                 {{ $post->type === 'artikel' ? 'bg-purple-100 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400' : 'bg-blue-100 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400' }}">
                        {{ $post->type }}
                    </span>
                    <span class="text-[11px] font-extrabold text-accent tracking-wider uppercase">
                        {{ $post->category->name ?? 'Uncategorized' }}
                    </span>
                </div>

                <h1 class="text-2xl md:text-4xl font-black text-secondary dark:text-white leading-tight mb-4">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-4 text-xs md:text-sm text-gray-400 dark:text-gray-500 font-semibold mb-6 pb-6 border-b border-gray-100 dark:border-white/10">
                    <span><i class="fas fa-user mr-1.5"></i>{{ $post->author_name }}</span>
                    <span><i class="fas fa-calendar mr-1.5"></i>{{ $post->published_at->translatedFormat('d F Y') }}</span>
                </div>

                <div class="relative rounded-3xl overflow-hidden shadow-xl h-[240px] md:h-[420px] bg-gray-200 dark:bg-[#161616] mb-8">
                    <img src="{{ $post->cover_image ? asset('storage/'.$post->cover_image) : asset('images/bhs2.jpg') }}"
                         alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>

                <!-- Tambahkan class 'break-words' supaya kata yang super panjang otomatis dipotong ke bawah -->
                <div class="text-sm md:text-base text-gray-700 dark:text-gray-300 leading-relaxed space-y-4 break-words">
                    @foreach (preg_split('/\n\s*\n/', trim($post->content)) as $paragraph)
                        <p>{{ trim($paragraph) }}</p>
                    @endforeach
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 dark:border-white/10">
                    <a href="{{ route('informasi') }}" class="inline-flex items-center gap-2 text-sm font-bold text-accent hover:underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke Informasi & Berita
                    </a>
                </div>
            </div>

            {{-- SIDEBAR: Berita/Artikel terkait --}}
            <div class="lg:col-span-1 lg:sticky lg:top-28 lg:self-start">
                <h3 class="text-lg font-extrabold text-secondary dark:text-light uppercase tracking-wide mb-4">
                    {{ $post->type === 'artikel' ? 'Artikel Lainnya' : 'Berita Lainnya' }}
                </h3>
                <div class="space-y-4">
                    @forelse ($relatedPosts as $item)
                        <a href="{{ route('informasi.show', $item->slug) }}" class="flex items-start gap-3 group">
                            <div class="flex-1 min-w-0">
                                <span class="text-[11px] font-extrabold text-accent tracking-wider uppercase">{{ $item->category->name ?? 'Umum' }}</span>
                                <h4 class="text-sm font-bold text-secondary dark:text-light leading-snug mt-1 line-clamp-2 group-hover:text-accent transition-colors">
                                    {{ $item->title }}
                                </h4>
                                <span class="text-xs text-gray-400 dark:text-gray-500 font-medium mt-1 block">
                                    {{ $item->published_at->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-200 dark:bg-[#212121] flex-shrink-0">
                                <img src="{{ $item->cover_image ? asset('storage/'.$item->cover_image) : asset('images/bhs2.jpg') }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500 italic">Belum ada konten lain.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
