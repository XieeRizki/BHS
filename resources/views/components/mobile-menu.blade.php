@php
    $contact = $contact ?? (object) ['whatsapp' => '62895385703917'];
    $waNumber = $contact->whatsapp ?? '62895385703917';

    try {
        $navLayananList = \App\Models\Layanan::active()->ordered()->get();
    } catch (\Throwable $e) {
        $navLayananList = collect();
    }
@endphp

<div id="mobileMenu" class="fixed inset-y-0 right-0 w-[85%] max-w-sm bg-white/95 dark:bg-[#0A0A0A]/95 backdrop-blur-xl shadow-2xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col border-l border-gray-200/80 dark:border-gray-800/80">
  
  <div class="p-5 border-b border-gray-200/80 dark:border-gray-800/80 flex items-center justify-between shrink-0">
    <a href="{{ route('home') }}" class="flex items-center gap-3">
      <img src="{{ asset('images/logow.png') }}" alt="Logo BHS" class="w-10 h-10 object-contain" />
      <div>
        <div class="font-black text-sm text-secondary dark:text-white uppercase tracking-tight">BALONG HARDI</div>
        <div class="text-[10px] font-extrabold text-accent uppercase tracking-widest">Pemancingan Sumedang</div>
      </div>
    </a>
    
    <button id="closeMobileMenu" aria-label="Tutup Menu Mobile" class="p-2 rounded-xl bg-gray-100 dark:bg-white/10 text-gray-600 dark:text-gray-300 hover:bg-red-500/10 hover:text-red-500 transition">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>

  <div class="p-5 overflow-y-auto flex-1 space-y-6">
    
    <div class="flex items-center gap-2">
      <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 py-3 px-4 bg-accent text-[#0A0A0A] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md hover:bg-yellow-500 active:scale-95 transition">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
        <span>Reservasi WA</span>
      </a>

      <button onclick="toggleTheme()" type="button" aria-label="Toggle Mode Theme" class="p-3 bg-gray-100 dark:bg-white/10 text-secondary dark:text-white rounded-xl hover:bg-gray-200 dark:hover:bg-white/20 transition">
        <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
      </button>
    </div>

    <nav class="space-y-1 text-xs font-extrabold uppercase tracking-wider" aria-label="Mobile main menu">
      
      <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-secondary dark:text-white hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">
        Beranda
      </a>

      <!-- Profile Accordion -->
      <div class="border-t border-gray-100 dark:border-gray-800/80 pt-2">
        <div class="flex items-center justify-between">
          <a href="{{ route('profile') }}" class="flex-1 px-4 py-3 rounded-xl text-secondary dark:text-white hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">
            Profile
          </a>
          <button type="button" class="p-3 text-gray-500 dark:text-gray-400 hover:text-accent focus:outline-none" aria-label="Buka submenu Profile" data-collapse="profile">
            <svg class="w-4 h-4 transform transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
          </button>
        </div>
        
        <div class="hidden pl-4 pr-2 space-y-1 mt-1 border-l-2 border-accent/30 ml-4" data-panel="profile">
          <a href="{{ route('profile') }}#infografis" class="block px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:text-accent hover:bg-gray-50 dark:hover:bg-white/5 transition">Infografis</a>
          <a href="{{ route('profile') }}#tentang-bhs" class="block px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:text-accent hover:bg-gray-50 dark:hover:bg-white/5 transition">Tentang BHS</a>
          <a href="{{ route('profile') }}#penghargaan" class="block px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:text-accent hover:bg-gray-50 dark:hover:bg-white/5 transition">Penghargaan</a>
          <a href="{{ route('profile') }}#liputan-media" class="block px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:text-accent hover:bg-gray-50 dark:hover:bg-white/5 transition">Liputan Media</a>
          <a href="{{ route('profile') }}#faq" class="block px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:text-accent hover:bg-gray-50 dark:hover:bg-white/5 transition">FAQ Pertanyaan</a>
        </div>
      </div>

      <!-- Paket Layanan Accordion -->
      <div class="border-t border-gray-100 dark:border-gray-800/80 pt-2">
        <button type="button" class="w-full text-left px-4 py-3 rounded-xl text-secondary dark:text-white hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition flex items-center justify-between" data-collapse="paket">
          <span>Paket Layanan</span>
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 transform transition-transform duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
        </button>
        
        <div class="hidden pl-4 pr-2 space-y-1 mt-1 border-l-2 border-accent/30 ml-4" data-panel="paket">
          @forelse ($navLayananList as $item)
            <a href="{{ route('layanan.show', $item->slug) }}" class="block px-3 py-2.5 rounded-lg text-gray-600 dark:text-gray-400 hover:text-accent hover:bg-gray-50 dark:hover:bg-white/5 transition">{{ $item->title }}</a>
          @empty
            <span class="block px-3 py-2.5 text-xs text-gray-400 italic">Belum ada layanan</span>
          @endforelse
        </div>
      </div>

      <div class="border-t border-gray-100 dark:border-gray-800/80 pt-2 space-y-1">
        <a href="{{ route('informasi') }}" class="block px-4 py-3 rounded-xl text-secondary dark:text-white hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">
          Informasi
        </a>
        <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-secondary dark:text-white hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">
          Kontak Kami
        </a>
      </div>

    </nav>
  </div>

  <div class="p-5 border-t border-gray-200/80 dark:border-gray-800/80 bg-gray-50/50 dark:bg-[#121212]/50 shrink-0">
    <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center justify-between">
      <span>Official Admin BHS:</span>
      <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="text-accent font-black tracking-wider hover:underline">+{{ $waNumber }}</a>
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
      
      const svg = btn.querySelector('svg');
      const isHidden = panel.classList.contains('hidden');
      
      panel.classList.toggle('hidden');
      if (svg) svg.classList.toggle('rotate-180', isHidden);
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