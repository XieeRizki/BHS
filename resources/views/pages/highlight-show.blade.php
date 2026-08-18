@extends('layouts.app')

@section('title', $highlight->title . ' - Balong Hardi Sumedang')

@section('content')

    <x-detail-page
        :title="$highlight->title"
        badge="Profil BHS"
        :image="$highlight->image"
        :backUrl="route('home')"
        backLabel="Kembali ke Beranda"
    >
        @if($highlight->content)
            <div class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed space-y-4">
                @foreach (preg_split('/\n\s*\n/', trim($highlight->content)) as $paragraph)
                    <p>{{ trim($paragraph) }}</p>
                @endforeach
            </div>
        @else
            <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">{{ $highlight->short_description }}</p>
        @endif

        <div class="mt-10 flex flex-wrap justify-center md:justify-start gap-4" data-aos="fade-up">
    
            <!-- Tombol 1: Primary (Aksen Emas/Kuning BHS) -->
            <!-- Fokus utama buat ngarahin orang lihat harga -->
            <a href="{{ route('pricing') }}" 
            class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-accent text-[#0A0A0A] font-extrabold rounded-xl shadow-[0_0_15px_rgba(201,162,39,0.4)] hover:bg-yellow-500 hover:shadow-[0_0_25px_rgba(201,162,39,0.6)] hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                LIHAT PAKET & HARGA
            </a>

            <!-- Tombol 2: Secondary (Outline Putih atau Elegan) -->
            <!-- Pendukung buat yang mau langsung nanya -->
            <a href="#kontak" 
            class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-white/5 border border-white/20 text-white font-bold rounded-xl backdrop-blur-sm hover:bg-white/10 hover:border-white/40 hover:-translate-y-1 transition-all duration-300">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12.004 2c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 4.997L2 22l5.13-1.345a9.96 9.96 0 0 0 4.874 1.24h.005c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.18-2.93-7.07A9.938 9.938 0 0 0 12.004 2zm0 18.164h-.004a8.16 8.16 0 0 1-4.156-1.14l-.298-.177-3.043.798.812-2.968-.194-.305a8.166 8.166 0 0 1-1.253-4.375c0-4.514 3.674-8.188 8.192-8.188 2.187 0 4.243.853 5.79 2.402a8.13 8.13 0 0 1 2.397 5.792c0 4.514-3.674 8.161-8.243 8.161z"/>
                </svg>
                TANYA / RESERVASI SEKARANG
            </a>
        </div>
    </x-detail-page>

@endsection