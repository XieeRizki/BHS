@extends('layouts.app')

@section('title', 'Tentang Kami - Balong Hardi Sumedang')

@section('content')

    @if ($about)
        <section class="py-12 md:py-16 bg-white">
            <div class="container-max">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center">
                    <div>
                        <div class="relative h-96 md:h-[550px] rounded-3xl overflow-hidden shadow-2xl">
                            @if ($about->image)
                                <img src="{{ asset('storage/' . $about->image) }}"
                                     alt="{{ $about->title }}"
                                     class="w-full h-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-30"></div>
                        </div>
                    </div>

                    <div>
                        <x-section-title badge="Tentang Kami" :title="$about->title" align="left" />

                        <div class="text-lg text-gray-600 mb-8 leading-relaxed space-y-4 -mt-12">
                            @foreach (preg_split('/\n\s*\n/', trim($about->description)) as $paragraph)
                                <p>{{ trim($paragraph) }}</p>
                            @endforeach
                        </div>

                        @if ($about->benefits->isNotEmpty())
                            <div class="space-y-4">
                                @foreach ($about->benefits as $benefit)
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-1 shadow-lg">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-secondary text-lg">{{ $benefit->title }}</h4>
                                            @if ($benefit->description)
                                                <p class="text-gray-600 text-sm">{{ $benefit->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="py-16 text-center text-gray-500">Konten belum tersedia.</div>
    @endif

@endsection