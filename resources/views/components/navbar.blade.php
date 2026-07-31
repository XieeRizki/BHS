@php
    $contact = $contact ?? (object) ['whatsapp' => '62895385703917'];
    $waNumber = $contact->whatsapp ?? '62895385703917';
@endphp

<nav class="bg-light dark:bg-dark border-b border-gray-200 dark:border-white/6 sticky top-0 z-50">
  <div class="container-max">
    <div class="flex items-center justify-between h-20">
      <!-- Logo -->
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img src="{{ asset('images/logow.png') }}" alt="Logo" class="w-14 h-14 md:w-16 md:h-16 object-contain" />
        <div class="hidden sm:flex flex-col leading-tight">
          <span class="text-base font-extrabold text-secondary dark:text-light">BALONG HARDI</span>
          <small class="text-xs text-gray-500 dark:text-gray-400">Pemancingan Sumedang</small>
        </div>
      </a>

      <!-- Desktop menu (click to open submenus) -->
      <div class="hidden lg:flex items-center gap-2">
        <ul class="flex items-center gap-1">
          <li><a href="{{ route('home') }}" class="px-4 py-2 rounded-md text-secondary dark:text-light hover:bg-gray-100 dark:hover:bg-[#2E2216] transition">Beranda</a></li>

          <!-- Dropdown: Profile -->
          <li class="relative">
            <button type="button"
                    class="menu-toggle px-4 py-2 rounded-md inline-flex items-center gap-2 text-secondary dark:text-light focus:outline-none focus:ring-2 focus:ring-accent"
                    aria-expanded="false"
                    aria-controls="menu-profile"
                    data-menu="profile">
              Profile
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div id="menu-profile" class="menu-panel absolute left-0 mt-2 w-64 bg-white dark:bg-[#2B1B0E] border border-gray-100 dark:border-white/6 rounded-lg shadow-lg hidden"
                 role="menu" aria-labelledby="menu-profile">
              <ul class="flex flex-col p-2">
                <li><a href="{{ route('about') }}" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Tentang BHS</a></li>
                <li><a href="{{ route('facilities') }}" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Fasilitas</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Penghargaan</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Publikasi Media</a></li>
                <li><a href="{{ route('testimonials') }}" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Testimoni</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Kenapa Harus ke BHS?</a></li>
              </ul>
            </div>
          </li>

          <!-- Dropdown: Event -->
          <li class="relative">
            <button type="button"
                    class="menu-toggle px-4 py-2 rounded-md inline-flex items-center gap-2 text-secondary dark:text-light focus:outline-none focus:ring-2 focus:ring-accent"
                    aria-expanded="false"
                    aria-controls="menu-event"
                    data-menu="event">
              Event
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div id="menu-event" class="menu-panel absolute left-0 mt-2 w-56 bg-white dark:bg-[#2B1B0E] border border-gray-100 dark:border-white/6 rounded-lg shadow-lg hidden"
                 role="menu" aria-labelledby="menu-event">
              <ul class="flex flex-col p-2">
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Galatama</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Fishing Community</a></li>
              </ul>
            </div>
          </li>

          <!-- Dropdown: Paket Layanan -->
          <li class="relative">
            <button type="button"
                    class="menu-toggle px-4 py-2 rounded-md inline-flex items-center gap-2 text-secondary dark:text-light focus:outline-none focus:ring-2 focus:ring-accent"
                    aria-expanded="false"
                    aria-controls="menu-paket"
                    data-menu="paket">
              Paket Layanan
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div id="menu-paket" class="menu-panel absolute left-0 mt-2 w-72 bg-white dark:bg-[#2B1B0E] border border-gray-100 dark:border-white/6 rounded-lg shadow-lg hidden"
                 role="menu" aria-labelledby="menu-paket">
              <ul class="grid grid-cols-1 p-3 gap-1">
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Wisata Kolam Pemancingan</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Villa Kayu</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Hotel BHS</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Resto & Cafe</a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-50 dark:hover:bg-[#3a2b1d]">Convention Hall</a></li>
              </ul>
            </div>
          </li>

          <li><a href="{{ route('gallery') }}" class="px-4 py-2 rounded-md text-secondary dark:text-light hover:bg-gray-100 dark:hover:bg-[#2E2216] transition">Gallery</a></li>
          <li><a href="{{ route('contact') }}" class="px-4 py-2 rounded-md text-secondary dark:text-light hover:bg-gray-100 dark:hover:bg-[#2E2216] transition">Kontak</a></li>
        </ul>
      </div>

      <!-- Actions -->
      <div class="flex items-center gap-3">
        <div class="hidden lg:flex items-center gap-3">
          <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="inline-flex items-center gap-2 py-2.5 px-5 rounded-xl font-semibold bg-accent text-[#1C140C] shadow hover:bg-accent-dark transition">
            Reservasi
          </a>

          <button onclick="toggleTheme()" type="button" class="p-2.5 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-primary/6 dark:hover:bg-primary/8 transition">
            <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
          </button>
        </div>

        <!-- Mobile menu button -->
        <button id="mobileMenuBtn" class="lg:hidden p-2.5 rounded-lg text-secondary dark:text-light hover:bg-gray-100 dark:hover:bg-[#2E2216] transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggles = document.querySelectorAll('.menu-toggle');

      function closeAllMenus(except = null) {
        document.querySelectorAll('.menu-panel').forEach(panel => {
          if (panel !== except) panel.classList.add('hidden');
        });
        toggles.forEach(btn => btn.setAttribute('aria-expanded','false'));
      }

      toggles.forEach(btn => {
        const menuKey = btn.dataset.menu;
        const panel = document.querySelector(`#menu-${menuKey}`);
        btn.addEventListener('click', function (e) {
          const isHidden = panel.classList.contains('hidden');
          if (isHidden) {
            closeAllMenus(panel);
            panel.classList.remove('hidden');
            btn.setAttribute('aria-expanded','true');
            const first = panel.querySelector('a');
            if (first) first.focus();
          } else {
            panel.classList.add('hidden');
            btn.setAttribute('aria-expanded','false');
          }
          e.stopPropagation();
        });

        document.addEventListener('keydown', function (ev) {
          if (ev.key === 'Escape') {
            panel.classList.add('hidden');
            btn.setAttribute('aria-expanded','false');
          }
        });
      });

      document.addEventListener('click', function (e) {
        const inside = e.target.closest('.menu-panel') || e.target.closest('.menu-toggle');
        if (!inside) closeAllMenus();
      });

      document.getElementById('mobileMenuBtn')?.addEventListener('click', function () {
        window.dispatchEvent(new CustomEvent('toggleMobileMenu'));
      });
    });
  </script>
</nav>