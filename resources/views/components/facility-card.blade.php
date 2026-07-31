{{--
    Satu kartu fasilitas. Dipakai di section Fasilitas dengan @foreach.
    Icon disimpen sebagai string kode ('circle', 'fork-knife', dst) di kolom
    facilities.icon, dipetakan ke SVG lewat @switch di bawah.

    Kalau nanti mau nambah pilihan icon baru, tinggal tambah @case baru --
    gak perlu sentuh tabel/model.
--}}
@props(['facility'])

<div class="card-modern overflow-hidden group">
    <div class="relative h-48 overflow-hidden bg-gray-200">
        @if ($facility->image)
            <img src="{{ asset('storage/' . $facility->image) }}"
                 alt="{{ $facility->name }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-30"></div>
    </div>
    <div class="p-8">
        <div class="w-16 h-16 bg-accent bg-opacity-10 dark:bg-opacity-15 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-accent transition-all duration-300">
            <svg class="w-8 h-8 text-accent-dark dark:text-accent group-hover:text-[#0A0A0A] transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                @switch($facility->icon)
                    @case('fork-knife')
                        <path d="M11 9H9V2H7v7H5V2H3v7c0 2.55 1.92 4.63 4.39 4.94V22h2.42v-8.06C11.05 13.63 13 11.55 13 9v-7h-2v7zm6-7h-2v7h2V2zm0 11h-2v9h2v-9z" />
                        @break
                    @case('lock')
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5s-5 2.24-5 5v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6-2c1.66 0 3 1.34 3 3v2H9V6c0-1.66 1.34-3 3-3z" />
                        @break
                    @case('car')
                        <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H6V4h12v16zm-5.04-6.71l-2.75 3.54-1.3-1.54c-.39-.48-1.02-.48-1.41 0-.39.49-.39 1.28 0 1.77l2 2.34c.39.48 1.02.48 1.41 0l3.83-4.87c.39-.49.39-1.28 0-1.77-.39-.48-1.02-.48-1.41 0z" />
                        @break
                    @case('wifi')
                        <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4c-1.48 0-2.85.43-4.01 1.17l1.46 1.46C10.21 5.23 11.08 5 12 5c3.04 0 5.5 2.46 5.5 5.5v.5H19c1.66 0 3 1.34 3 3 0 1.13-.64 2.11-1.56 2.62l1.45 1.45c.45-.34.85-.75 1.19-1.22.99-1.62 1.63-3.55 1.63-5.65-.02-1.8-.35-3.51-.99-5.11zM19 13h-4V9h-2v4h-4l5 5 5-5z" />
                        @break
                    @case('user-check')
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                        @break
                    @default
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6z" />
                @endswitch
            </svg>
        </div>
        <h3 class="text-xl font-bold text-secondary dark:text-light mb-3">{{ $facility->name }}</h3>
            @if ($facility->description)
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">{{ Str::limit($facility->description, 100) }}</p>
            @endif
            <a href="{{ route('facility.show', $facility) }}" class="text-accent-dark dark:text-accent font-bold text-sm inline-flex items-center gap-1 hover:gap-2 transition-all duration-300">
                Lihat Selengkapnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
    </div>
</div>