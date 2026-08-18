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

        <div class="mt-10">
            <x-button href="#kontak" variant="primary" icon="whatsapp">
                Tanya / Reservasi Sekarang
            </x-button>
        </div>
    </x-detail-page>

@endsection