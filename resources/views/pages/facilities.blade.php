@extends('layouts.app')

@section('title', 'Fasilitas - Balong Hardi Sumedang')

@section('content')

<div class="bg-white dark:bg-[#1F160D] border-b border-gray-100 dark:border-white/6">
    <div class="container-max py-4">
        <nav class="text-sm text-gray-500 dark:text-gray-400" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-accent transition">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-secondary dark:text-light font-semibold">Fasilitas</span>
        </nav>
    </div>
</div>

<section class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
    <div class="container-max">
        <x-section-title
            badge="Fasilitas Kami"
            title="Lengkap, Asri & Nyaman"
            subtitle="Semua fasilitas yang tersedia untuk kenyamanan Anda di Balong Hardi Sumedang"
        />

        @if($facilities->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($facilities as $facility)
                    <div class="bg-white dark:bg-[#161616] border border-gray-200/80 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="h-48 overflow-hidden bg-gray-100 dark:bg-[#212121]">
                            <img src="{{ $facility->image ? asset('storage/' . $facility->image) : asset('images/bhs2.jpg') }}"
                                 alt="{{ $facility->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-5">
                            <h3 class="font-extrabold text-secondary dark:text-light text-lg mb-1.5">
                                {{ $facility->title }}
                            </h3>
                            @if($facility->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                                    {{ $facility->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-gray-400">Belum ada fasilitas yang ditambahkan.</p>
        @endif
    </div>
</section>

@endsection