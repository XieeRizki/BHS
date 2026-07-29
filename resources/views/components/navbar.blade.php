{{--
    Navbar. whatsapp number sekarang diambil dari $contact (Model Contact),
    bukan hardcode "6281234567890" lagi -- jadi kalau admin ganti nomor WA
    di dashboard, navbar otomatis ikut update.

    $contact di-share ke semua view lewat View Composer / App Service Provider,
    jadi gak perlu di-pass manual tiap render komponen ini.

    UPDATE: navbar abu (bg-gray-100), tombol CTA ijo gelap.
--}}
@php
    $contact = $contact ?? \App\Models\Contact::first();
    $waNumber = $contact->whatsapp ?? '6281234567890';
@endphp

<nav class="bg-gray-100 border-b border-gray-200 sticky top-0 z-30">
    <div class="container-max">
        <div class="flex items-center justify-between h-20">
           <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2 md:space-x-3 group">
                
                {{-- BACKGROUND BULAT ELEGAN --}}
                <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-green-700 to-green-900 rounded-full flex items-center justify-center shadow-lg transform group-hover:scale-105 transition-all duration-300 border-2 border-white relative overflow-hidden">
                    
                    {{-- GAMBAR LOGO --}}
                    {{-- Angka scale diturunin jadi 1.6 biar pas di dalem lingkaran --}}
                    <img src="{{ asset('images/logow.png') }}" 
                         alt="Logo Balong Hardi" 
                         class="w-full h-full object-contain drop-shadow-md"
                         style="transform: scale(1.6);"> 
                         
                </div>

                {{-- TEKS DI SAMPING LOGO --}}
                <div class="flex flex-col justify-center">
                    <h1 class="text-xl md:text-2xl font-extrabold text-secondary leading-tight tracking-tight">BALONG HARDI</h1>
                    <p class="text-[10px] md:text-xs text-gray-500 font-inter font-medium tracking-wide">Pemancingan Sumedang</p>
                </div>

            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1 lg:space-x-2">
                @php
                    $navLinks = [
                        'Home' => route('home'),
                        'Tentang' => route('about'),
                        'Fasilitas' => route('facilities'),
                        'Harga' => route('pricing'),
                        'Testimoni' => route('testimonials'),
                        'Blog' => route('blog.index'),
                        'Kontak' => route('contact'),
                    ];
                @endphp
                @foreach ($navLinks as $label => $url)
                    <a href="{{ $url }}" class="px-4 py-2 text-gray-700 hover:text-primary font-medium transition-colors duration-300 rounded-lg hover:bg-gray-200">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <!-- CTA Button Desktop -->
            <div class="hidden md:flex items-center">
                <a href="{{ route('home') }}#kontak"
                   class="inline-flex items-center gap-2 !py-2.5 px-5 rounded-xl font-semibold text-white bg-green-800 hover:bg-green-900 shadow-lg transition-colors duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Reservasi
                </a>
            </div>
            <div class="hidden md:flex items-center">
            <button onclick="toggleTheme()" type="button" class="p-2.5 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" aria-label="Toggle Dark Mode">
                {{-- Icon Matahari (Muncul saat Dark Mode, buat ganti ke Light) --}}
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                {{-- Icon Bulan (Muncul saat Light Mode, buat ganti ke Dark) --}}
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menuBtn" class="md:hidden p-2 rounded-lg hover:bg-gray-200 transition-colors duration-300">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</nav>