@extends('layouts.app')

@section('title', $highlight->title . ' - Balong Hardi Sumedang')

@section('content')

    {{-- HERO BANNER SECTION --}}
    <section class="relative min-h-[45vh] md:min-h-[50vh] flex items-end -mt-20 pt-28 pb-12 overflow-hidden bg-gradient-to-b from-[#0A0A0A] via-[#121212] to-[#0A0A0A] text-white">
        <!-- Background Image & Overlay Gradasi -->
        <div class="absolute inset-0 z-0">
            @if($highlight->image)
                <img src="{{ asset('storage/' . $highlight->image) }}" 
                     alt="{{ $highlight->title }}" 
                     class="w-full h-full object-cover opacity-30 scale-105 transform hover:scale-100 transition-transform duration-1000">
            @else
                <img src="{{ asset('images/bhs2.jpg') }}" 
                     alt="Balong Hardi Sumedang" 
                     class="w-full h-full object-cover opacity-25">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#0A0A0A] via-[#0A0A0A]/70 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0A0A0A] via-transparent to-[#0A0A0A]/80"></div>
        </div>

        <div class="container-max relative z-10 w-full">
            <!-- Breadcrumb / Tombol Kembali -->
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-bold text-gray-200 hover:bg-accent hover:text-[#0A0A0A] hover:border-accent transition-all duration-300 mb-6 group w-fit">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>

            <div class="max-w-3xl" data-aos="fade-up" data-aos-duration="800">
                <span class="inline-block px-3.5 py-1.5 rounded-md bg-accent/20 border border-accent/40 text-accent font-extrabold text-xs uppercase tracking-widest mb-3">
                    Profil & Fasilitas BHS
                </span>
                <h1 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight leading-tight">
                    {{ $highlight->title }}
                </h1>
            </div>
        </div>

        <!-- Glow Accent Elements -->
        <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-accent/15 rounded-full blur-3xl pointer-events-none"></div>
    </section>

    {{-- MAIN CONTENT SECTION --}}
    <section class="py-12 md:py-16 bg-[#0A0A0A] text-gray-300 transition-colors">
        <div class="container-max">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                
                {{-- KOLOM KIRI: Visual Feature & Quick Info Sidebar --}}
                <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-28" data-aos="fade-right" data-aos-duration="800">
                    <!-- Frame Gambar Utama -->
                    <div class="relative rounded-3xl overflow-hidden border border-gray-800 shadow-2xl bg-[#161616] group">
                        @if($highlight->image)
                            <img src="{{ asset('storage/' . $highlight->image) }}" 
                                 alt="{{ $highlight->title }}" 
                                 class="w-full h-64 sm:h-80 md:h-[340px] object-cover group-hover:scale-105 transition-transform duration-700">
                        @else
                            <img src="{{ asset('images/bhs2.jpg') }}" 
                                 alt="Balong Hardi Sumedang" 
                                 class="w-full h-64 sm:h-80 md:h-[340px] object-cover group-hover:scale-105 transition-transform duration-700">
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between">
                            <span class="px-3 py-1 rounded-lg bg-black/60 backdrop-blur-md border border-white/10 text-xs font-bold text-gray-200">
                                Official BHS Facility
                            </span>
                            <span class="text-accent text-xs font-extrabold uppercase tracking-widest flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-accent animate-ping"></span>
                                Premium Comfort
                            </span>
                        </div>
                    </div>

                    <!-- Mini Info Card Penutup Space Kosong -->
                    <div class="p-5 rounded-3xl bg-[#141414] border border-gray-800/80 space-y-4 shadow-xl">
                        <h4 class="text-xs font-extrabold text-accent uppercase tracking-widest border-b border-gray-800 pb-2">
                            Informasi Singkat Area
                        </h4>
                        
                        <div class="space-y-3 text-xs">
                            <div class="flex items-center justify-between text-gray-300">
                                <span class="flex items-center gap-2 text-gray-400">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Lokasi Area
                                </span>
                                <span class="font-bold text-white">Sumedang, Jawa Barat</span>
                            </div>

                            <div class="flex items-center justify-between text-gray-300">
                                <span class="flex items-center gap-2 text-gray-400">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Jam Operasional
                                </span>
                                <span class="font-bold text-white">08:00 - 22:00 WIB</span>
                            </div>

                            <div class="flex items-center justify-between text-gray-300">
                                <span class="flex items-center gap-2 text-gray-400">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    Akses Fasilitas
                                </span>
                                <span class="font-bold text-emerald-400">Terbuka untuk Umum</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: Text Narrative & Details --}}
                <div class="lg:col-span-7 space-y-8" data-aos="fade-left" data-aos-duration="800">
                    
                    <!-- Text Content Header -->
                    <div class="border-b border-gray-800 pb-6">
                        <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-wide mb-3">
                            Pengalaman Terbaik di Balong Hardi
                        </h2>
                        <div class="w-20 h-1 bg-gradient-to-r from-accent to-amber-600 rounded-full"></div>
                    </div>

                    <!-- Paragraf Konten -->
                    <div class="prose prose-invert max-w-none text-gray-300 text-base md:text-lg leading-relaxed space-y-5">
                        @if($highlight->content)
                            @foreach (preg_split('/\n\s*\n/', trim($highlight->content)) as $index => $paragraph)
                                <p>
                                    {{ trim($paragraph) }}
                                </p>
                            @endforeach
                        @else
                            <p class="first-letter:text-4xl first-letter:font-black first-letter:text-accent first-letter:mr-2 first-letter:float-left">
                                {{ $highlight->short_description }}
                            </p>
                        @endif
                    </div>

                    <!-- Quote Block / Highlight Statement -->
                    <div class="p-6 rounded-2xl bg-gradient-to-r from-[#161616] to-[#121212] border-l-4 border-accent border-y border-r border-gray-800 shadow-xl">
                        <p class="text-sm md:text-base italic font-medium text-gray-200">
                            "Nikmati kombinasi tempat rekreasi pemancingan profesional dengan fasilitas penginapan yang nyaman dan tenang untuk seluruh keluarga."
                        </p>
                        <span class="block mt-3 text-xs font-bold text-accent uppercase tracking-wider">— Balong Hardi Sumedang</span>
                    </div>

                    <!-- CTA Box Premium -->
                    <div class="relative overflow-hidden rounded-3xl border border-accent/30 bg-gradient-to-br from-[#181818] via-[#121212] to-[#0A0A0A] p-6 md:p-8 shadow-2xl">
                        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-accent/10 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                            <div>
                                
                                <h3 class="text-xl md:text-2xl font-extrabold text-white">
                                    Tertarik Menikmati BHS?
                                </h3>
                                <p class="text-xs md:text-sm text-gray-400 mt-1">
                                    Cek pilihan layanan kami atau langsung hubungi tim kami untuk reservasi.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto shrink-0">
                                <a href="{{ route('layanan.index') }}"
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-accent text-[#0A0A0A] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-[0_0_20px_rgba(201,162,39,0.3)] hover:bg-yellow-500 hover:scale-105 active:scale-95 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                    LIHAT LAYANAN
                                </a>

                                <a href="https://wa.me/62895385703917?text=Halo%20Admin%20BHS,%20saya%20ingin%20tanya%20info%20tentang%20{{ urlencode($highlight->title) }}"
                                   target="_blank"
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/10 border border-white/20 text-white font-extrabold text-xs uppercase tracking-wider rounded-xl hover:bg-white/20 hover:scale-105 active:scale-95 transition-all duration-300 backdrop-blur-md">
                                    <svg class="w-4 h-4 text-green-400 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.882-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    RESERVASI WA
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection