{{--
    Footer -- struktur sesuai wireframe:
    [Logo+Brand] [Paket Layanan] [Profil] [Sosial Media + FAQ/Sitemap]
    lalu copyright di bawah.

    Semua query DB dibungkus try-catch -- kalau database lagi dirombak /
    tabel belum ada, otomatis fallback ke data dummy, footer TETAP TAMPIL
    normal, gak nge-crash. Konsisten sama pola di HomeController.
--}}
@php
    try {
        $contact = $contact ?? \App\Models\Contact::first();
    } catch (\Throwable $e) {
        $contact = null;
    }

    $waNumber = $contact->whatsapp ?? '6289538570391';
    $fbUrl = $contact->facebook ?? null;
    $igUrl = $contact->instagram ?? null;
    $emailAddr = $contact->email ?? null;
@endphp

<footer class="relative bg-secondary dark:bg-dark text-light py-12 md:py-16 transition-colors duration-300">
    {{-- Garis aksen gold di atas footer --}}
    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-primary"></div>

    <div class="container-max">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 mb-12">

            <!-- Logo + Brand -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-primary rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-light leading-tight">BALONG HARDI</h3>
                        <p class="text-xs text-gray-400 font-inter">Pemancingan Sumedang</p>
                    </div>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Tempat pemancingan terbaik di Sumedang dengan fasilitas lengkap, aman, dan nyaman.
                </p>
            </div>

            <!-- Paket Layanan -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-light">Paket Layanan</h4>
                {{-- TODO backend: idealnya diambil dari @forelse($footerPackages as $package), sementara disamain manual sama menu "Paket Layanan" di navbar --}}
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('home') }}#harga" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Wisata Kolam Pemancingan</a></li>
                    <li><a href="{{ route('home') }}#harga" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Villa Kayu</a></li>
                    <li><a href="{{ route('home') }}#harga" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Hotel BHS</a></li>
                    <li><a href="{{ route('home') }}#harga" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Resto & Cafe</a></li>
                </ul>
            </div>

            <!-- Profil -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-light">Profil</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ Route::has('about') ? route('about') : route('home') . '#tentang' }}" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Tentang</a></li>
                    <li><a href="{{ Route::has('facilities') ? route('facilities') : route('home') . '#fasilitas' }}" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Fasilitas</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Penghargaan</a></li>
                    <li><a href="{{ Route::has('blog.index') ? route('blog.index') : '#' }}" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Publikasi</a></li>
                    <li><a href="{{ Route::has('contact') ? route('contact') : route('home') . '#kontak' }}" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Kontak Kami</a></li>
                </ul>
            </div>

            <!-- Sosial Media, FAQ & Sitemap -->
            <div>
                <h4 class="text-lg font-bold mb-6 text-light">Sosial Media</h4>
                <div class="flex items-center gap-3 mb-6">
                    {{-- WhatsApp --}}
                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener"
                       class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center transition-colors duration-300"
                       aria-label="WhatsApp Balong Hardi">
                        <svg class="w-4 h-4 text-light" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12.004 2c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 4.997L2 22l5.13-1.345a9.96 9.96 0 0 0 4.874 1.24h.005c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.18-2.93-7.07A9.938 9.938 0 0 0 12.004 2zm0 18.164h-.004a8.16 8.16 0 0 1-4.156-1.14l-.298-.177-3.043.798.812-2.968-.194-.305a8.166 8.166 0 0 1-1.253-4.375c0-4.514 3.674-8.188 8.192-8.188 2.187 0 4.243.853 5.79 2.402a8.13 8.13 0 0 1 2.397 5.792c0 4.514-3.674 8.161-8.243 8.161z"/>
                        </svg>
                    </a>

                    {{-- Facebook --}}
                    <a href="{{ $fbUrl ? (str_starts_with($fbUrl, 'http') ? $fbUrl : 'https://facebook.com/' . ltrim($fbUrl, '@')) : '#' }}"
                       target="_blank" rel="noopener"
                       class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center transition-colors duration-300"
                       aria-label="Facebook Balong Hardi">
                        <svg class="w-4 h-4 text-light" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.891h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                        </svg>
                    </a>

                    {{-- Instagram --}}
                    <a href="{{ $igUrl ? (str_starts_with($igUrl, 'http') ? $igUrl : 'https://instagram.com/' . ltrim($igUrl, '@')) : '#' }}"
                       target="_blank" rel="noopener"
                       class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center transition-colors duration-300"
                       aria-label="Instagram Balong Hardi">
                        <svg class="w-4 h-4 text-light" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.28-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>

                    {{-- Email --}}
                    <a href="{{ $emailAddr ? 'mailto:' . $emailAddr : '#' }}"
                       class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary flex items-center justify-center transition-colors duration-300"
                       aria-label="Email Balong Hardi">
                        <svg class="w-4 h-4 text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </a>
                </div>

                <!-- FAQ & Sitemap Links -->
                <div class="pt-4 border-t border-white/10">
                    <h5 class="text-sm font-bold mb-3 text-light uppercase tracking-wider">Bantuan & Navigasi</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}#informasi" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">FAQ (Pertanyaan Umum)</a></li>
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-accent transition-colors duration-300 font-medium">Sitemap (Peta Situs)</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-white/10"></div>

        <!-- Bottom Footer -->
        <div class="mt-8 pt-6 text-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} Balong Hardi Sumedang. Semua hak dilindungi.
            </p>
        </div>
    </div>
</footer>