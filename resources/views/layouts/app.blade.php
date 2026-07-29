<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Balong Hardi Sumedang - Tempat Pemancingan Terbaik dengan Fasilitas Lengkap dan Harga Terjangkau.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Balong Hardi Sumedang - Tempat Pemancingan')</title>

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
                        // Brown + Gold dominant palette
                        primary: '#8B5E34',
                        'primary-dark': '#5C3B1E',
                        'primary-light': '#A9744A',
                        accent: '#FFD700',
                        'accent-dark': '#D4AF37',
                        secondary: '#2B1B0E',
                        'secondary-light': '#4A3520',
                        dark: '#1C140C',
                        light: '#FAF6EE',
                        navbar: '#6B5A45',
                        gray: {
                            50: '#FAF8F4',
                            100: '#F3EAD8',
                            200: '#E7DAC0',
                            300: '#D8C6A3',
                            400: '#B79E7C',
                            500: '#8F7A5C',
                            600: '#6B5A45',
                            700: '#4A3520',
                            800: '#2E2216',
                            900: '#1C140C',
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
        ::-webkit-scrollbar-track { background: #F3EAD8; }
        ::-webkit-scrollbar-thumb { background: #8B5E34; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #5C3B1E; }

        /* Dark scroll (near-black) */
        html.dark ::-webkit-scrollbar-track { background: #0b0b0b; }
        html.dark ::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        html.dark ::-webkit-scrollbar-thumb:hover { background: #555; }

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
            background: #FAF6EE;
            z-index: 40;
            transition: right 0.3s ease-in-out, transform 0.25s ease-in-out;
            overflow-y: auto;
        }
        /* dark mode: make mobile menu truly dark */
        html.dark .mobile-menu { background: #0b0b0b; color: #E6E6E6; }
        .mobile-menu.active { right: 0; }

        .card-modern {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(43, 27, 14, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: inherit;
        }
        /* dark: near-black for cards (override brown) */
        html.dark .card-modern {
            background: #0b0b0b;
            border-color: rgba(255, 255, 255, 0.04);
            color: #E6E6E6;
            box-shadow: 0 8px 30px rgba(0,0,0,0.6);
        }
        .card-modern:hover {
            box-shadow: 0 20px 40px rgba(43, 27, 14, 0.16);
            transform: translateY(-8px);
        }

        .gradient-primary,
        .bg-gradient-primary {
            background: linear-gradient(135deg, #8B5E34 0%, #FFD700 100%);
        }

        /* QUICK DARK OVERRIDES: force near-black where light classes are used without dark: variant */
        html.dark .bg-light { background-color: #0b0b0b !important; }
        html.dark .bg-white { background-color: #0b0b0b !important; color: #E6E6E6 !important; }
        html.dark .bg-gray-100 { background-color: #0f0f0f !important; color: #E6E6E6 !important; }
        html.dark .bg-gray-200 { background-color: #151314 !important; color: #E6E6E6 !important; }
        html.dark .bg-gray-800 { background-color: #0b0b0b !important; color: #E6E6E6 !important; }

        /* make gradient backgrounds dark in dark mode */
        html.dark .bg-gradient-to-br.from-primary,
        html.dark .bg-gradient-to-br {
            background: #0b0b0b !important;
        }

        /* Buttons / accent contrast in dark mode */
        html.dark .bg-accent { background-color: #D4AF37 !important; color: #1C140C !important; }

        /* Navbar dark override */
        html.dark nav, html.dark .navbar {
            background: #0b0b0b !important;
            border-color: rgba(255,255,255,0.04) !important;
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
        class="fixed bottom-5 right-5 md:bottom-6 md:right-6 z-40 inline-flex items-center gap-2 pl-4 pr-5 py-3 rounded-full bg-accent text-[#1C140C] font-semibold text-sm shadow-lg hover:bg-accent-dark hover:shadow-xl hover:-translate-y-1 transition-all duration-300"
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