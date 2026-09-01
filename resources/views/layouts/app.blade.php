<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Balong Hardi Sumedang - Tempat Pemancingan Terbaik dengan Fasilitas Lengkap dan Harga Terjangkau.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Balong Hardi Sumedang - Tempat Pemancingan')</title>

    {{-- Favicon Publik --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logo_bhs.jpg') }}">
    <!-- Anti-flash: set class 'dark' SEBELUM Tailwind CDN & body render -->
    <script>
        (function () {
            const saved = localStorage.getItem('bhs-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = saved ? saved === 'dark' : prefersDark;
            if (isDark) document.documentElement.classList.add('dark');
        })();
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        // Black + White base, gold sebagai aksen tipis
                        primary: '#1A1A1A',
                        'primary-dark': '#000000',
                        'primary-light': '#3D3D3D',
                        accent: '#C9A227',
                        'accent-dark': '#A6841E',
                        secondary: '#141414',
                        'secondary-light': '#2A2A2A',
                        dark: '#0A0A0A',
                        'dark-surface': '#161616',
                        'dark-elevated': '#212121',
                        light: '#FAFAFA',
                        navbar: '#141414',
                        gray: {
                            50: '#FAFAFA',
                            100: '#F0F0F0',
                            200: '#E0E0E0',
                            300: '#C7C7C7',
                            400: '#A0A0A0',
                            500: '#787878',
                            600: '#525252',
                            700: '#3A3A3A',
                            800: '#242424',
                            900: '#141414',
                        }
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 4px 12px rgba(43, 27, 14, 0.08)',
                        'card-hover': '0 8px 24px rgba(43, 27, 14, 0.14)',
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Poppins', sans-serif; }

        /* Light scroll */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F0F0F0; }
        ::-webkit-scrollbar-thumb { background: #1A1A1A; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #000000; }

        /* Dark scroll (netral abu-abu gelap, konsisten sama base hitam-putih) */
        html.dark ::-webkit-scrollbar-track { background: #0A0A0A; }
        html.dark ::-webkit-scrollbar-thumb { background: #3A3A3A; border-radius: 10px; }
        html.dark ::-webkit-scrollbar-thumb:hover { background: #525252; }

        .container-max { max-width: 1280px; margin: 0 auto; padding: 0 1rem; }

        .menu-backdrop {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6);
            z-index: 39;
            animation: fadeIn 0.3s ease-in-out;
        }
        .menu-backdrop.active { display: block; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .mobile-menu {
            position: fixed;
            right: -100%;
            top: 0;
            height: 100vh;
            width: 80%;
            max-width: 300px;
            background: #FAFAFA;
            z-index: 40;
            transition: right 0.3s ease-in-out, transform 0.25s ease-in-out;
            overflow-y: auto;
        }
        /* dark mode: surface layer sedikit lebih terang dari bg, biar "ngambang" di atas bg, hairline emas tipis sebagai satu-satunya aksen warna */
        html.dark .mobile-menu {
            background: #161616;
            color: #FAFAFA;
            border-left: 1px solid rgba(201, 162, 39, 0.10);
        }
        .mobile-menu.active { right: 0; }

        .card-modern {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(43, 27, 14, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: inherit;
        }
        /* dark: surface layer sedikit lebih terang dari bg page, biar berasa "ngambang", hairline emas tipis */
        html.dark .card-modern {
            background: #161616;
            border-color: rgba(201, 162, 39, 0.10);
            color: #FAFAFA;
            box-shadow: 0 8px 30px rgba(0,0,0,0.55);
        }
        .card-modern:hover {
            box-shadow: 0 20px 40px rgba(43, 27, 14, 0.16);
            transform: translateY(-8px);
        }
        html.dark .card-modern:hover {
            box-shadow: 0 20px 40px rgba(0,0,0,0.55);
        }

        .gradient-primary,
        .bg-gradient-primary {
            background: linear-gradient(135deg, #1A1A1A 0%, #C9A227 100%);
        }

        /* DARK MODE SURFACE SYSTEM
           3 layer kegelapan netral (bg hitam -> surface -> elevated), murni grayscale,
           supaya ada depth dan gak keliatan "item polos" nge-blok semua elemen.
           Emas HANYA muncul di aksen (gradient CTA, hairline border, tombol), bukan di surface. */
        html.dark .bg-light { background-color: #0A0A0A !important; }
        html.dark .bg-white { background-color: #161616 !important; color: #FAFAFA !important; }
        html.dark .bg-gray-100 { background-color: #161616 !important; color: #FAFAFA !important; }
        html.dark .bg-gray-200 { background-color: #212121 !important; color: #FAFAFA !important; }
        html.dark .bg-gray-800 { background-color: #161616 !important; color: #FAFAFA !important; }

        /* gradient section (mis. bg-gray-50 to-gray-100) di dark mode jadi gradient surface->elevated netral, bukan solid flat */
        html.dark .bg-gradient-to-br.from-gray-50 {
            background: linear-gradient(135deg, #161616 0%, #212121 100%) !important;
        }

        /* gradient hero/paket (from-primary to-accent) TETAP pakai gradient hitam->emas bahkan di dark mode,
           karena itu section aksen/CTA yang memang harus stand out & kontras, bukan surface netral. */
        html.dark .bg-gradient-to-br.from-primary {
            background: linear-gradient(135deg, #1A1A1A 0%, #C9A227 100%) !important;
        }

        /* Buttons / accent contrast in dark mode */
        html.dark .bg-accent { background-color: #A6841E !important; color: #0A0A0A !important; }

        /* Navbar dark override -> surface layer + hairline emas tipis sebagai satu-satunya sentuhan warna */
        html.dark nav, html.dark .navbar {
            background: #161616 !important;
            border-color: rgba(201, 162, 39, 0.12) !important;
        }
    </style>

    @yield('css')
</head>
<body class="bg-light dark:bg-dark transition-colors duration-300">
    {{-- Safe fallback contact (no DB calls in layout) --}}
    @php
        $contact = $contact ?? (object) [
            'phone' => '(022) 1234-567',
            'whatsapp' => '62895385703917',
            'email' => 'info@balonghardi.test',
            'operational_hours' => '08:00 - 20:00',
        ];
    @endphp

    <x-navbar :contact="$contact" />
    <x-mobile-menu :contact="$contact" />

    <div id="menuBackdrop" class="menu-backdrop"></div>

    <main>
        @yield('content')
    </main>

    <x-footer :contact="$contact" />

    {{-- Floating WhatsApp button (accent gold, text dark for contrast) --}}
    <a
        href="https://wa.me/{{ $contact->whatsapp }}"
        target="_blank"
        class="fixed bottom-5 right-5 md:bottom-6 md:right-6 z-40 inline-flex items-center gap-2 pl-4 pr-5 py-3 rounded-full bg-accent text-[#0A0A0A] font-semibold text-sm shadow-lg hover:bg-accent-dark hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
    >
        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12.004 2c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.464 3.484 1.345 4.997L2 22l5.13-1.345a9.96 9.96 0 0 0 4.874 1.24h.005c5.514 0 9.997-4.483 9.997-9.997 0-2.67-1.04-5.18-2.93-7.07A9.938 9.938 0 0 0 12.004 2zm0 18.164h-.004a8.16 8.16 0 0 1-4.156-1.14l-.298-.177-3.043.798.812-2.968-.194-.305a8.166 8.166 0 0 1-1.253-4.375c0-4.514 3.674-8.188 8.192-8.188 2.187 0 4.243.853 5.79 2.402a8.13 8.13 0 0 1 2.397 5.792c0 4.514-3.674 8.161-8.243 8.161z"/>
        </svg>
        <span>Hubungi Kami</span>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('menuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const menuBackdrop = document.getElementById('menuBackdrop');
            const closeMenuBtn = document.getElementById('closeMenuBtn');

            const openMenu = () => {
                mobileMenu?.classList.add('active');
                menuBackdrop?.classList.add('active');
            };
            const closeMenu = () => {
                mobileMenu?.classList.remove('active');
                menuBackdrop?.classList.remove('active');
            };

            menuBtn?.addEventListener('click', openMenu);
            closeMenuBtn?.addEventListener('click', closeMenu);
            menuBackdrop?.addEventListener('click', closeMenu);
            mobileMenu?.querySelectorAll('a')?.forEach(link => link.addEventListener('click', closeMenu));
        });
    </script>

    <!-- Dark/Light Mode Toggle -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

        window.toggleTheme = function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>

    <!-- AOS JS & Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                once: false,
                mirror: true,
                offset: 50,
                duration: 800,
                easing: 'ease-out-cubic',
            });
        });
    </script>

    @yield('js')
    @stack('js')
</body>
</html>