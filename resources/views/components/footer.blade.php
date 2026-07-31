{{--
    Footer. Dinamis pakai $contact biar nomor telepon/WA/email/sosmed
    gak hardcode. List Fasilitas juga dinamis dari $footerFacilities
    (4 fasilitas terbaru), bukan hardcode manual.

    Color system:
    - Light mode: bg-secondary (hitam pekat #141414) sebagai "anchor" akhir halaman,
      dikasih garis aksen gold di atas biar transisinya berasa disengaja,
      bukan tiba-tiba loncat warna.
    - Dark mode: bg-dark (#0A0A0A) -- SAMA level gelapnya dengan page bg,
      bukan hitam polos terpisah -- jadi footer nyambung natural sama halaman,
      cuma dikasih hairline emas tipis di atas sebagai pemisah.
--}}
@php
    $contact = $contact ?? \App\Models\Contact::first();
    $footerFacilities = $footerFacilities ?? \App\Models\Facility::latest()->take(4)->get();
@endphp

<footer class="relative bg-secondary dark:bg-dark text-light py-12 md:py-16 transition-colors duration-300">
    {{-- Garis aksen gold di atas footer, jadi separator yang "disengaja" bukan tiba-tiba gelap --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-primary"></div>

    <div class="container-max">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 mb-12">
            <!-- Brand -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-primary rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-light">BALONG HARDI</h3>
                        <p class="text-xs text-gray-400 font-inter">Pemancingan Sumedang</p>
                    </div>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Balong Hardi adalah tempat pemancingan terbaik di Sumedang dengan fasilitas lengkap, aman, dan nyaman untuk pengalaman memancing yang tak terlupakan.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-light">Menu Cepat</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Home</a></li>
                    <li><a href="#tentang" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Tentang Kami</a></li>
                    <li><a href="#fasilitas" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Fasilitas</a></li>
                    <li><a href="#harga" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Harga</a></li>
                    <li><a href="#testimoni" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Testimoni</a></li>
                </ul>
            </div>

            <!-- Fasilitas -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-light">Fasilitas Kami</h4>
                <ul class="space-y-3 text-sm">
                    @forelse ($footerFacilities as $facility)
                        <li>
                            <a href="{{ Route::has('facility.show') ? route('facility.show', $facility->slug ?? $facility->id ?? 0) : '#' }}" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">
                                {{ $facility->name ?? '' }}
                            </a>
                        </li>
                    @empty
                        <li class="text-gray-400">Belum ada fasilitas</li>
                    @endforelse
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-light">Kontak</h4>
                <ul class="space-y-3 text-sm">
                    <li class="text-gray-300 font-medium flex items-center gap-2">
                        <span class="text-accent">📞</span> {{ $contact?->phone ?? 'Belum ada nomor telepon' }}
                    </li>

                    @if (!empty($contact->email))
                        <li class="text-gray-300 font-medium flex items-center gap-2">
                            <span class="text-accent">✉️</span> {{ $contact->email }}
                        </li>
                    @endif

                    <li class="text-gray-300 font-medium flex items-center gap-2">
                        <span class="text-accent">📍</span> {{ $contact?->address ?? 'Sumedang, Jawa Barat' }}
                    </li>

                    <li class="text-gray-300 font-medium flex items-center gap-2">
                        <span class="text-accent">⏰</span> {{ $contact?->operational_hours ?? 'Buka 24 Jam' }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-white/10"></div>

        <!-- Bottom Footer -->
        <div class="mt-8 pt-8 grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} Balong Hardi Sumedang. Semua hak dilindungi.
            </p>

            @if (!empty($contact->facebook) || !empty($contact->instagram))
                <div class="flex justify-start md:justify-end space-x-6">
                    @if (!empty($contact->facebook))
                        <a href="{{ str_starts_with($contact->facebook, 'http') ? $contact->facebook : 'https://facebook.com/' . ltrim($contact->facebook, '@') }}"
                           target="_blank" rel="noopener"
                           class="text-gray-300 hover:text-accent transition-colors duration-300"
                           aria-label="Facebook Balong Hardi">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.891h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                            </svg>
                        </a>
                    @endif

                    @if (!empty($contact->instagram))
                        <a href="{{ str_starts_with($contact->instagram, 'http') ? $contact->instagram : 'https://instagram.com/' . ltrim($contact->instagram, '@') }}"
                           target="_blank" rel="noopener"
                           class="text-gray-300 hover:text-accent transition-colors duration-300"
                           aria-label="Instagram Balong Hardi">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.28-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</footer>