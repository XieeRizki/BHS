@extends('layouts.app')

@section('title', 'Blog & Tips - Balong Hardi Sumedang')

@section('content')

    <section class="py-12 md:py-16 bg-white">
        <div class="container-max">
            <x-section-title
                badge="Blog & Tips"
                title="Semua Artikel"
                subtitle="Kumpulan tips memancing, teknik, dan cerita menarik dari Balong Hardi"
            />

            @if ($categories->isNotEmpty())
                <div class="flex flex-wrap justify-center gap-3 mb-12">
                    <a href="{{ route('blog.index') }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold transition-all {{ !request('category') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category]) }}"
                           class="px-5 py-2 rounded-full text-sm font-semibold transition-all {{ request('category') === $category ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            @endif

            @if ($blogPosts->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($blogPosts as $post)
                        <div class="card-modern overflow-hidden group">
                            <div class="relative h-48 overflow-hidden bg-gray-200">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-30"></div>
                            </div>
                            <div class="p-6">
                                @if ($post->category)
                                    <p class="text-sm text-primary font-bold mb-3 uppercase tracking-wider">{{ $post->category }}</p>
                                @endif
                                <h3 class="text-xl font-bold text-secondary mb-3 group-hover:text-primary transition-colors duration-300">
                                    {{ $post->title }}
                                </h3>
                                @if ($post->excerpt)
                                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ $post->excerpt }}</p>
                                @endif
                                <a href="{{ route('blog.show', $post) }}" class="text-primary font-bold flex items-center space-x-2 hover:space-x-3 transition-all duration-300">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $blogPosts->links() }}
                </div>
            @else
                <p class="text-center text-gray-500">Belum ada artikel di kategori ini.</p>
            @endif
        </div>
    </section>

@endsection