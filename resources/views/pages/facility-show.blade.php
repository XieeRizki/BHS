@extends('layouts.app')

@section('title', $facility->name . ' - Balong Hardi Sumedang')

@section('content')

    <x-detail-page
        :title="$facility->name"
        badge="Fasilitas"
        :image="$facility->image"
        :backUrl="route('home') . '#fasilitas'"
        backLabel="Kembali ke Fasilitas"
    >
        <p class="text-lg text-gray-700 dark:text-gray-300 leading-relaxed">
            {{ $facility->description }}
        </p>

        <div class="mt-10">
            <x-button href="#kontak" variant="primary" icon="whatsapp">
                Tanya / Reservasi Sekarang
            </x-button>
        </div>
    </x-detail-page>

@endsection