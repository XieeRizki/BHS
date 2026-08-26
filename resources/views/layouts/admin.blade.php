<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Balong Hardi')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #15803D;
            --primary-dark: #166534;
            --secondary: #1F2937;
            --neutral: #6B7280;
            --border: #E5E7EB;
            --bg-light: #F9FAFB;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --accent-bhs: #EAB308;
        }

        html, body {
            height: 100%;
        }

        body {
            background-color: var(--bg-light);
            color: var(--secondary);
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR MENUBAR TANPA IKON (CLEAN & MODERN) ===== */
        .sidebar {
            width: 270px;
            background: #111827;
            color: white;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(234, 179, 8, 0.03);
        }

        .sidebar-brand-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .sidebar-brand-logo {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .sidebar-brand-text h1 {
            font-size: 0.95rem;
            font-weight: 800;
            color: #FFFFFF;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.01em;
            text-transform: uppercase;
        }

        .sidebar-brand-text p {
            font-size: 0.65rem;
            font-weight: 800;
            color: var(--accent-bhs);
            letter-spacing: 0.15em;
            margin: 0;
            text-transform: uppercase;
        }

        .sidebar-close {
            display: none;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #9CA3AF;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.2s;
        }

        .sidebar-close:hover {
            color: white;
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.4);
        }

        .sidebar-menu {
            flex: 1;
            padding: 1rem 0.75rem;
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .menu-category-label {
            font-size: 0.65rem;
            font-weight: 800;
            color: var(--accent-bhs);
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin: 1.25rem 0.75rem 0.4rem;
        }
        .menu-category-label:first-child {
            margin-top: 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: #9CA3AF;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            border-radius: 12px;
            margin-bottom: 0.25rem;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .sidebar-menu a:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.08);
            transform: translateX(4px);
        }

        .sidebar-menu a.active {
            color: #0A0A0A;
            background-color: var(--accent-bhs);
            font-weight: 900;
            box-shadow: 0 4px 14px rgba(234, 179, 8, 0.25);
        }

        .sidebar-logout {
            padding: 1rem 0.75rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: #111827;
        }

        .sidebar-logout button {
            width: 100%;
            padding: 0.75rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #EF4444;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sidebar-logout button:hover {
            background: #EF4444;
            color: white;
        }

        /* ===== MAIN CONTENT AREA ===== */
        .main-content {
            flex: 1;
            margin-left: 270px;
        }

        .content {
            padding: 2rem;
        }

        .content h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .content p {
            margin-bottom: 1rem;
        }

        /* Alert */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            animation: slideDown 0.3s ease;
            border-left: 4px solid;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-left-color: var(--success);
            color: #047857;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-left-color: var(--danger);
            color: #7F1D1D;
        }

        /* Topbar Mobile */
        .admin-topbar {
            display: none;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 998;
            animation: fadeIn 0.25s ease;
        }
        .sidebar-backdrop.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Mobile Drawer Slide In */
        @media (max-width: 768px) {
            .admin-topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: fixed;
                top: 0; left: 0; right: 0;
                height: 64px;
                background: #111827;
                padding: 0 1.25rem;
                z-index: 999;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            .admin-topbar-brand h1 {
                font-size: 0.95rem;
                font-weight: 800;
                color: #FFFFFF;
                text-transform: uppercase;
            }

            .admin-topbar .sidebar-toggle {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: white;
                padding: 0.4rem 0.8rem;
                border-radius: 8px;
                font-size: 0.75rem;
                font-weight: 800;
                text-transform: uppercase;
                cursor: pointer;
            }

            .sidebar {
                position: fixed;
                top: 0;
                right: -100%;
                left: auto;
                height: 100vh;
                width: 85%;
                max-width: 300px;
                box-shadow: -10px 0 30px rgba(0, 0, 0, 0.5);
            }

            .sidebar.active {
                right: 0;
            }

            .sidebar-close {
                display: flex;
            }

            .main-content {
                margin-left: 0;
                margin-top: 64px;
            }

            .content {
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- Topbar Mobile -->
    <div class="admin-topbar">
        <div class="admin-topbar-brand">
            <h1>BHS Admin</h1>
        </div>
        <button class="sidebar-toggle" id="sidebarToggle" aria-label="Buka Menu Mobile">
            Menu
        </button>
    </div>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="admin-container">
        
        <!-- SIDEBAR DRAWER MENU -->
        <div class="sidebar" id="sidebarMenu">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-wrapper">
                    <img src="{{ asset('images/logow.png') }}" alt="BHS Logo" class="sidebar-brand-logo" />
                    <div class="sidebar-brand-text">
                        <h1>BALONG HARDI</h1>
                        <p>ADMIN PANEL</p>
                    </div>
                </a>
                <button class="sidebar-close" id="sidebarClose" aria-label="Tutup Menu Mobile">
                    ✕
                </button>
            </div>

            <nav class="sidebar-menu">
                <div class="menu-category-label">Utama</div>

                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
                    Reservasi
                </a>

                <div class="menu-category-label">Kelola Konten</div>

                <a href="{{ route('admin.hero.edit') }}" class="{{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                    Hero Banner
                </a>

                <a href="{{ route('admin.layanan.index') }}" class="{{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                    Layanan
                </a>

                <a href="{{ route('admin.facility.index') }}" class="{{ request()->routeIs('admin.facility.*') ? 'active' : '' }}">
                    Fasilitas
                </a>

                <a href="{{ route('admin.informasi.index') }}" class="{{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}">
                    Informasi & Berita
                </a>

                <a href="{{ route('admin.blog-posts.index') }}" class="{{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}">
                    Blog
                </a>

                <a href="{{ route('admin.awards.index') }}" class="{{ request()->routeIs('admin.awards.*') ? 'active' : '' }}">
                    Penghargaan
                </a>

                <a href="{{ route('admin.media-coverage.index') }}" class="{{ request()->routeIs('admin.media-coverage.*') ? 'active' : '' }}">
                    Liputan Media
                </a>

                <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    Testimoni
                </a>

                <a href="{{ route('admin.faq.index') }}" class="{{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
                    FAQ
                </a>

                <div class="menu-category-label">Pengaturan</div>

                <a href="{{ route('admin.contact.edit') }}" class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                    Info Kontak
                </a>
            </nav>

            <div class="sidebar-logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- MAIN CONTENT AREA -->
        <div class="main-content">
            <div class="content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0;">
                                @foreach ($errors->all() as $error)
                                    <li style="font-size: 0.9rem;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarMenu = document.getElementById('sidebarMenu');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');

        const openSidebar = () => {
            sidebarMenu.classList.add('active');
            sidebarBackdrop.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        const closeSidebar = () => {
            sidebarMenu.classList.remove('active');
            sidebarBackdrop.classList.remove('active');
            document.body.style.overflow = '';
        };

        sidebarToggle?.addEventListener('click', openSidebar);
        sidebarClose?.addEventListener('click', closeSidebar);
        sidebarBackdrop?.addEventListener('click', closeSidebar);

        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>