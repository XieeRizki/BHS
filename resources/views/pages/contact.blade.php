@extends('layouts.app')

@section('title', 'Kontak - Balong Hardi Sumedang')

@section('content')

    <section id="kontak" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <x-section-title
                badge="Hubungi Kami"
                title="Siap Membantu Anda"
                subtitle="Hubungi kami untuk reservasi, informasi lebih lanjut, atau pertanyaan seputar Balong Hardi"
            />

            <div class="max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6">

                @if ($location?->address)
                    <x-contact-card icon="map-pin" title="Alamat">
                        <p class="text-gray-600 dark:text-gray-300 font-medium leading-relaxed">{{ $location->address }}</p>
                    </x-contact-card>
                @endif

                @if ($contact?->whatsapp || $contact?->phone)
                    <x-contact-card icon="phone" title="WhatsApp Admin">
                        <div class="space-y-3">
                            @if ($contact?->whatsapp)
                                <a href="https://wa.me/{{ $contact->whatsapp }}" target="_blank"
                                   class="flex items-center justify-between gap-3 px-4 py-3 rounded-xl bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 hover:bg-green-100 dark:hover:bg-green-500/15 transition-colors duration-300 group">
                                    <div>
                                        <span class="block text-[11px] font-bold text-green-700 dark:text-green-400 uppercase tracking-wide">Admin 1</span>
                                        <span class="font-extrabold text-secondary dark:text-light">
                                            +{{ substr($contact->whatsapp, 0, 2) }} {{ substr($contact->whatsapp, 2, 3) }}-{{ substr($contact->whatsapp, 5, 4) }}-{{ substr($contact->whatsapp, 9) }}
                                        </span>
                                    </div>
                                    <i class="fab fa-whatsapp text-2xl text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform"></i>
                                </a>
                            @endif

                            @if ($contact?->phone)
                                <a href="https://wa.me/{{ $contact->phone }}" target="_blank"
                                   class="flex items-center justify-between gap-3 px-4 py-3 rounded-xl bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 hover:bg-green-100 dark:hover:bg-green-500/15 transition-colors duration-300 group">
                                    <div>
                                        <span class="block text-[11px] font-bold text-green-700 dark:text-green-400 uppercase tracking-wide">Admin 2</span>
                                        <span class="font-extrabold text-secondary dark:text-light">
                                            +{{ substr($contact->phone, 0, 2) }} {{ substr($contact->phone, 2, 3) }}-{{ substr($contact->phone, 5, 4) }}-{{ substr($contact->phone, 9) }}
                                        </span>
                                    </div>
                                    <i class="fab fa-whatsapp text-2xl text-green-600 dark:text-green-400 group-hover:scale-110 transition-transform"></i>
                                </a>
                            @endif
                        </div>
                    </x-contact-card>
                @endif

                @if ($contact?->email)
                    <x-contact-card icon="envelope" title="Email">
                        <a href="mailto:{{ $contact->email }}" class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-accent transition-colors duration-300 font-medium break-all">
                            {{ $contact->email }}
                        </a>
                    </x-contact-card>
                @endif

                @if ($contact?->operational_hours)
                    <x-contact-card icon="clock" title="Jam Operasional">
                        <div class="space-y-2">
                            <div class="flex items-center gap-1.5">
                                <span id="jamOpStatusDot" class="w-2 h-2 rounded-full bg-gray-400"></span>
                                <span id="jamOpStatusText" class="text-sm font-extrabold text-gray-400">Memuat...</span>
                            </div>

                            <p class="text-gray-600 dark:text-gray-300 font-bold">
                                {{ $contact->operational_hours }}
                            </p>
                        </div>
                    </x-contact-card>
                @endif

                {{-- Sosial Media --}}
                @if ($contact?->instagram || $contact?->facebook)
                    <x-contact-card icon="share-nodes" title="Sosial Media">
                        <div class="space-y-3">
                            @if ($contact?->instagram)
                                <a href="{{ $contact->instagram }}" target="_blank"
                                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 hover:bg-pink-50 dark:hover:bg-pink-500/10 hover:border-pink-200 dark:hover:border-pink-500/30 transition-all duration-300 group">
                                    <div class="w-8 h-8 rounded-full bg-pink-100 dark:bg-pink-500/20 flex items-center justify-center text-pink-600 dark:text-pink-400 group-hover:scale-110 transition-transform">
                                        <i class="fab fa-instagram text-lg"></i>
                                    </div>
                                    <span class="font-bold text-secondary dark:text-light group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors">Instagram</span>
                                </a>
                            @endif

                            @if ($contact?->facebook)
                                <a href="{{ $contact->facebook }}" target="_blank"
                                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10 hover:bg-blue-50 dark:hover:bg-blue-500/10 hover:border-blue-200 dark:hover:border-blue-500/30 transition-all duration-300 group">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform">
                                        <i class="fab fa-facebook text-lg"></i>
                                    </div>
                                    <span class="font-bold text-secondary dark:text-light group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Facebook</span>
                                </a>
                            @endif
                        </div>
                    </x-contact-card>
                @endif

            </div>

            <div class="max-w-4xl mx-auto mt-8 text-center">
                <a href="https://wa.me/{{ $contact->whatsapp ?? '' }}" target="_blank"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-primary to-primary-dark text-white font-bold text-sm rounded-xl hover:shadow-lg transition-all duration-300">
                    <i class="fab fa-whatsapp text-lg"></i>
                    Chat Sekarang untuk Reservasi
                </a>
            </div>
        </div>
    </section>

    <section class="pb-12 md:pb-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div class="text-center mb-6">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 dark:bg-accent/10 text-primary dark:text-accent text-xs font-bold uppercase tracking-wide mb-2">
                    Lokasi Kami
                </span>
                <h3 class="text-base md:text-lg font-bold text-secondary dark:text-light">
                    Maps Menuju Lokasi
                </h3>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <x-map :location="$location" />
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Status Buka/Tutup Jam Operasional (real-time berdasarkan jam & hari saat ini)
            // TODO backend: hari libur & jam operasional masih hardcode di sini,
            // idealnya ambil dari field terstruktur di database kalau nanti dibutuhkan lebih detail.
            (function () {
                const statusText = document.getElementById('jamOpStatusText');
                const statusDot = document.getElementById('jamOpStatusDot');
                if (!statusText || !statusDot) return;

                const CLOSED_DAY = 4; // getDay(): 0=Minggu, 1=Senin, 2=Selasa, 3=Rabu, 4=Kamis, 5=Jumat, 6=Sabtu
                const OPEN_HOUR = 12;
                const CLOSE_HOUR = 24;

                const now = new Date();
                const day = now.getDay();
                const hour = now.getHours();
                const isOpen = day !== CLOSED_DAY && hour >= OPEN_HOUR && hour < CLOSE_HOUR;

                if (isOpen) {
                    statusText.textContent = 'Buka';
                    statusText.classList.remove('text-gray-400', 'text-red-500');
                    statusText.classList.add('text-green-600', 'dark:text-green-400');
                    statusDot.classList.remove('bg-gray-400', 'bg-red-500');
                    statusDot.classList.add('bg-green-500');
                } else {
                    statusText.textContent = 'Tutup';
                    statusText.classList.remove('text-gray-400', 'text-green-600', 'dark:text-green-400');
                    statusText.classList.add('text-red-500');
                    statusDot.classList.remove('bg-gray-400', 'bg-green-500');
                    statusDot.classList.add('bg-red-500');
                }
            })();
        });
    </script>
@endsection