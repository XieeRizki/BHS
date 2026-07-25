@extends('layouts.app')

@section('title', 'Harga & Paket - Balong Hardi Sumedang')

@section('content')

    {{-- Page Header --}}
    <section class="py-12 md:py-16 bg-light border-b border-gray-200">
        <div class="container-max">
            <div data-aos="fade-up">
                <x-section-title
                    badge="Paket & Harga"
                    title="Paket Terjangkau"
                    subtitle="Pilih paket yang sesuai dengan kebutuhan dan budget Anda"
                />
            </div>
        </div>
    </section>

    {{-- Harga / Paket --}}
    @if ($packages->isNotEmpty())
        <section class="py-12 md:py-16 bg-white">
            <div class="container-max">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-12">
                    @foreach ($packages as $package)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="card-modern p-8 flex flex-col relative {{ $package->is_popular ? 'ring-2 ring-primary shadow-2xl md:scale-105' : '' }}">
                            @if ($package->is_popular)
                                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-white px-4 py-1.5 rounded-full text-sm font-bold">
                                    Paling Populer
                                </div>
                            @endif

                            <h3 class="text-2xl font-bold text-secondary mb-2 {{ $package->is_popular ? 'mt-2' : '' }}">
                                {{ $package->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-6">{{ $package->time_range }}</p>
                            <p class="text-5xl font-bold text-primary mb-8">
                                {{ $package->formatted_price }} <span class="text-lg text-gray-600">/orang</span>
                            </p>

                            @if ($package->features->isNotEmpty())
                                <ul class="space-y-4 mb-auto">
                                    @foreach ($package->features as $feature)
                                        <li class="flex items-start space-x-3">
                                            <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-gray-600 font-medium">{{ $feature->feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <x-button
                                href="https://wa.me/62895385703917{{ $contact->whatsapp ?? '' }}?text={{ urlencode('Halo, saya mau tanya soal ' . $package->name) }}"
                                variant="{{ $package->is_popular ? 'primary' : 'outline' }}"
                                icon="whatsapp"
                                class="w-full mt-8"
                            >
                                Pesan Sekarang
                            </x-button>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="py-20 bg-white">
            <div class="container-max text-center text-gray-500">
                Belum ada paket harga yang tersedia saat ini.
            </div>
        </section>
    @endif

@endsection