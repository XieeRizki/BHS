@php
    $contact = $contact ?? (object) ['whatsapp' => '62895385703917'];
    $waNumber = $contact->whatsapp ?? '62895385703917';
@endphp

<div id="mobileMenu" class="fixed inset-y-0 right-0 w-4/5 max-w-xs bg-light dark:bg-dark shadow-2xl z-50 transform translate-x-full transition-transform">
  <div class="p-4 border-b border-gray-200 dark:border-white/6 flex items-center justify-between">
    <a href="{{ route('home') }}" class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-full" style="background: linear-gradient(135deg,#8B5E34,#FFD700)"></div>
      <div>
        <div class="font-extrabold text-secondary dark:text-light">BALONG HARDI</div>
        <div class="text-xs text-gray-500 dark:text-gray-400">Pemancingan Sumedang</div>
      </div>
    </a>
    <button id="closeMobileMenu" class="p-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2E2216]">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>

  <div class="p-4 overflow-y-auto h-full">
    <div class="mb-4">
      <a href="https://wa.me/{{ $waNumber }}" class="block w-full text-center py-3 rounded-lg bg-accent text-[#1C140C] font-bold">Reservasi via WA</a>
    </div>

    <nav class="space-y-2" aria-label="Mobile main menu">
      <a href="{{ route('home') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d] text-secondary dark:text-light">Beranda</a>

      <div class="border-t border-gray-100 dark:border-white/6 pt-2">
        <button type="button" class="w-full text-left px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d] text-secondary dark:text-light flex items-center justify-between" data-collapse="profile">
          Profile
        </button>
        <div class="hidden pl-4 mt-1" data-panel="profile">
          <a href="{{ route('about') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Tentang BHS</a>
          <a href="{{ route('facilities') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Fasilitas</a>
          <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Publikasi Media</a>
          <a href="{{ route('testimonials') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Testimoni</a>
        </div>
      </div>

      <div class="pt-2 border-t border-gray-100 dark:border-white/6">
        <button type="button" class="w-full text-left px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d] text-secondary dark:text-light flex items-center justify-between" data-collapse="event">
          Event
        </button>
        <div class="hidden pl-4 mt-1" data-panel="event">
          <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Galatama</a>
          <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Fishing Community</a>
        </div>
      </div>

      <div class="pt-2 border-t border-gray-100 dark:border-white/6">
        <button type="button" class="w-full text-left px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d] text-secondary dark:text-light flex items-center justify-between" data-collapse="paket">
          Paket Layanan
        </button>
        <div class="hidden pl-4 mt-1" data-panel="paket">
          @foreach (['Wisata Kolam Pemancingan','Villa Kayu','Hotel BHS','Resto & Cafe','Convention Hall'] as $svc)
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">{{ $svc }}</a>
          @endforeach
        </div>
      </div>

      <div class="pt-2 border-t border-gray-100 dark:border-white/6 space-y-1">
        <a href="{{ route('gallery') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Gallery</a>
        <a href="{{ route('contact') }}" class="block px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-[#3a2b1d]">Kontak Kami</a>
      </div>
    </nav>

    <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
      WA: <a href="https://wa.me/{{ $waNumber }}" class="text-accent font-semibold">{{ $waNumber }}</a>
    </div>
  </div>
</div>

<script>
(function () {
  const mobileMenu = document.getElementById('mobileMenu');
  const open = () => mobileMenu.classList.remove('translate-x-full');
  const close = () => mobileMenu.classList.add('translate-x-full');

  window.addEventListener('toggleMobileMenu', function () {
    if (mobileMenu.classList.contains('translate-x-full')) open(); else close();
  });

  document.getElementById('closeMobileMenu')?.addEventListener('click', close);

  document.querySelectorAll('[data-collapse]').forEach(btn => {
    btn.addEventListener('click', function () {
      const key = btn.getAttribute('data-collapse');
      const panel = mobileMenu.querySelector(`[data-panel="${key}"]`);
      if (!panel) return;
      panel.classList.toggle('hidden');
    });
  });

  document.addEventListener('click', function (e) {
    const isOpen = !mobileMenu.classList.contains('translate-x-full');
    if (!isOpen) return;
    const inside = mobileMenu.contains(e.target) || document.getElementById('mobileMenuBtn')?.contains(e.target);
    if (!inside) close();
  });
})();
</script>

<style>
  #mobileMenu { will-change: transform; }
  .translate-x-full { transform: translateX(100%); }
</style>