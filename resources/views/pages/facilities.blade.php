@extends('layouts.app')

@section('title', 'Fasilitas - Balong Hardi Sumedang')

@section('content')

    <section class="py-12 md:py-16 bg-light">
        <div class="container-max">
            <x-section-title
                badge="Fasilitas Kami"
                title="Lengkap & Nyaman"
                subtitle="Semua yang Anda butuhkan untuk pengalaman memancing yang maksimal"
            />

            @if ($facilities->isNotEmpty())

                @php
                    $featured = $facilities->first();
                    $others   = $facilities->skip(1)->take(4);
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- ================= FEATURED (BESAR) ================= --}}
                    <a href="{{ route('facility.show', $featured) }}" class="group relative block lg:col-span-2 h-[320px] md:h-[460px] rounded-2xl overflow-hidden shadow-lg" data-aos="fade-up">
                        @if ($featured->image)
                            <img
                                src="{{ asset('storage/' . $featured->image) }}"
                                alt="{{ $featured->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 text-6xl">
                                {{ $featured->icon ?? '🎣' }}
                            </div>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                            @if ($featured->icon)
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/15 backdrop-blur text-xl mb-3">
                                    {{ $featured->icon }}
                                </span>
                            @endif
                            <h3 class="text-2xl md:text-3xl font-bold mb-2 group-hover:text-primary-light transition-colors">
                                {{ $featured->name }}
                            </h3>
                            <p class="text-sm md:text-base text-gray-200 max-w-lg line-clamp-2">
                                {{ $featured->description }}
                            </p>
                        </div>
                    </a>

                    {{-- ================= LIST KECIL (4 ITEM) ================= --}}
                    <div class="flex flex-col justify-between h-auto lg:h-[460px] gap-4">
                        @foreach ($others as $facility)
                            <a href="{{ route('facility.show', $facility) }}" class="group flex items-center gap-4 bg-white rounded-xl border border-gray-100 p-4 hover:shadow-lg hover:border-primary/30 transition-all" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="w-16 h-16 md:w-20 md:h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                                    @if ($facility->image)
                                        <img
                                            src="{{ asset('storage/' . $facility->image) }}"
                                            alt="{{ $facility->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-3xl bg-gradient-to-br from-gray-100 to-gray-200">
                                            {{ $facility->icon ?? '🎣' }}
                                        </div>
                                    @endif
                                </div>

                                <div class="min-w-0 flex-1">
                                    <h4 class="font-semibold text-base text-secondary truncate group-hover:text-primary transition-colors">
                                        {{ $facility->name }}
                                    </h4>
                                    <p class="text-sm text-gray-500 line-clamp-1 mt-0.5">
                                        {{ $facility->description }}
                                    </p>
                                </div>

                                <i class="fas fa-chevron-right text-gray-300 group-hover:text-primary group-hover:translate-x-1 transition-all flex-shrink-0"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- ================= PAGINATION (kalau > 5 fasilitas) ================= --}}
                @if ($facilities->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $facilities->onEachSide(1)->links() }}
                    </div>
                @endif

            @else
                <p class="text-center text-gray-500">Belum ada fasilitas yang ditambahkan.</p>
            @endif
        </div>
    </section>

@endsection