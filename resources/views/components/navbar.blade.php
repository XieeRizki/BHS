@php
    $waNumber = $contact->whatsapp ?? '62895385703917';

    try {
        $navLayananList = \App\Models\Layanan::active()->ordered()->get();
    } catch (\Throwable $e) {
        $navLayananList = collect();
    }
@endphp

<nav class="bg-white/95 dark:bg-[#0A0A0A]/95 backdrop-blur-md border-b border-gray-200/80 dark:border-gray-800/80 sticky top-0 z-50 transition-colors duration-300">
  <div class="container-max">
    <div class="flex items-center justify-between h-20">
      
      <!-- Logo Bulat Presisi -->
      <a href="{{ route('home') }}" class="flex items-center gap-3 group">
        <img src="{{ asset('images/logo_bhs.jpg') }}" alt="Logo BHS" class="w-12 h-12 md:w-14 md:h-14 rounded-full object-cover border border-amber-500/30 group-hover:scale-105 transition-transform duration-300" />
        <div class="hidden sm:flex flex-col leading-tight">
          <span class="text-base font-black text-secondary dark:text-white uppercase tracking-tight">PEMANCINGAN</span>
          <small class="text-xs font-extrabold text-accent uppercase tracking-widest">Balong Hardi Sumedang</small>
        </div>
      </a>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center gap-1">
        <ul class="flex items-center gap-1">
          <li>
            <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-accent transition duration-200">
              Beranda
            </a>
          </li>

          <!-- Dropdown: Profile -->
          <li class="relative group">
            <a href="{{ route('profile') }}" class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-accent transition duration-200">
              <span>Profile</span>
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
            </a>

            <div class="hidden group-hover:block absolute left-0 top-full w-64 pt-1 z-50">
              <div class="bg-white dark:bg-[#161616] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-2xl py-2" role="menu">
                <ul class="flex flex-col text-xs font-bold uppercase tracking-wider">
                  <li><a href="{{ route('profile') }}#infografis" class="block px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">Infografis</a></li>
                  <li><a href="{{ route('profile') }}#tentang-bhs" class="block px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">Tentang BHS</a></li>
                  <li><a href="{{ route('profile') }}#penghargaan" class="block px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">Penghargaan</a></li>
                  <li><a href="{{ route('profile') }}#liputan-media" class="block px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">Liputan Media</a></li>
                  <li><a href="{{ route('profile') }}#faq" class="block px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">FAQ Pertanyaan</a></li>
                </ul>
              </div>
            </div>
          </li>

          <!-- Dropdown: Paket Layanan -->
          <li class="relative group">
            <span class="px-4 py-2 rounded-xl inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-gray-700 dark:text-gray-200 group-hover:bg-gray-100 dark:group-hover:bg-white/10 group-hover:text-accent transition duration-200 cursor-default select-none">
              <span>Paket Layanan</span>
              <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
            </span>

            @php
                try {
                    $navLayananAll = \App\Models\Layanan::active()->ordered()->get();
                } catch (\Throwable $e) {
                    $navLayananAll = collect();
                }
                $navLayananLimit = 5;
                $navLayananVisible = $navLayananAll->take($navLayananLimit);
                $navLayananHidden = $navLayananAll->slice($navLayananLimit);
            @endphp

            <div class="hidden group-hover:block absolute left-0 top-full w-72 pt-1 z-50">
              <div class="bg-white dark:bg-[#161616] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-2xl py-2 max-h-96 overflow-y-auto" role="menu">
                <ul class="flex flex-col text-xs font-bold uppercase tracking-wider">
                  @forelse ($navLayananVisible as $item)
                      <li>
                          <a href="{{ route('layanan.show', $item->slug) }}" class="block px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">
                              {{ $item->title }}
                          </a>
                      </li>
                  @empty
                      <li><span class="block px-4 py-2.5 text-xs text-gray-400 italic">Belum ada layanan</span></li>
                  @endforelse

                  @if ($navLayananHidden->isNotEmpty())
                      <ul id="layananHiddenList" class="hidden flex-col">
                          @foreach ($navLayananHidden as $item)
                              <li>
                                  <a href="{{ route('layanan.show', $item->slug) }}" class="block px-4 py-2.5 text-gray-700 dark:text-gray-300 hover:bg-amber-50 dark:hover:bg-accent/10 hover:text-accent transition">
                                      {{ $item->title }}
                                  </a>
                              </li>
                          @endforeach
                      </ul>

                      <li class="border-t border-gray-100 dark:border-gray-800 mt-1 pt-1">
                          <button type="button" id="toggleLayananBtn" onclick="toggleLayananList()" class="w-full text-left px-4 py-2.5 font-extrabold text-accent hover:bg-amber-50 dark:hover:bg-accent/10 transition">
                              Lihat Semua Layanan ({{ $navLayananHidden->count() }} lagi)
                          </button>
                      </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>

          <li>
            <a href="{{ route('informasi') }}" class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-accent transition duration-200">
              Informasi
            </a>
          </li>
          <li>
            <a href="{{ route('contact') }}" class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-white/10 hover:text-accent transition duration-200">
              Kontak
            </a>
          </li>
        </ul>
      </div>

      <!-- Actions -->
      <div class="flex items-center gap-3">
        <div class="hidden lg:flex items-center gap-3">
          <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-accent text-[#0A0A0A] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md hover:bg-yellow-500 hover:scale-105 active:scale-95 transition-all">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
            <span>Reservasi</span>
          </a>

          <button onclick="toggleTheme()" type="button" aria-label="Toggle Theme" class="p-2.5 rounded-xl bg-gray-100 dark:bg-white/10 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-white/20 transition">
            <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            <svg class="w-4 h-4 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
          </button>
        </div>

        <button id="mobileMenuBtn" aria-label="Buka Menu Mobile" class="lg:hidden p-2.5 rounded-xl bg-gray-100 dark:bg-white/10 text-secondary dark:text-white hover:bg-gray-200 dark:hover:bg-white/20 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
      </div>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('mobileMenuBtn')?.addEventListener('click', function () {
        window.dispatchEvent(new CustomEvent('toggleMobileMenu'));
      });
    });
  </script>
</nav>