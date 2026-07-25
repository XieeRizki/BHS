@extends('layouts.app')

@section('title', 'Home - Balong Hardi Sumedang | Tempat Pemancingan Terbaik')

@section('content')

    {{-- Hero, About, dan Map sudah full komponen, tinggal lempar data dari HomeController --}}
    <x-hero :hero="$hero" />
    
    <x-about :about="$about" />
    
    {{-- Fasilitas: 1 featured (besar) + 4 kecil, sama kayak layout di halaman /fasilitas --}}
    @if ($facilities->isNotEmpty())
        <section id="fasilitas" class="pt-12 md:pt-16 pb-12 md:pb-16 bg-light">
        <div class="container-max">
            <div data-aos="fade-up">
                <x-section-title
                    badge="Fasilitas Kami"
                    title="Lengkap & Nyaman"
                    subtitle="Semua yang Anda butuhkan untuk pengalaman memancing yang maksimal"
                />
            </div>

            @php
                $homeFeatured = $facilities->first();
                $homeOthers   = $facilities->skip(1)->take(4);
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ================= FEATURED (BESAR) ================= --}}
                <a href="{{ route('facility.show', $homeFeatured) }}" class="group relative block lg:col-span-2 h-[320px] md:h-[460px] rounded-2xl overflow-hidden shadow-lg" data-aos="fade-up">
                    @if ($homeFeatured->image)
                        <img
                            src="{{ asset('storage/' . $homeFeatured->image) }}"
                            alt="{{ $homeFeatured->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 text-6xl">
                            {{ $homeFeatured->icon ?? '🎣' }}
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8 text-white">
                        @if ($homeFeatured->icon)
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/15 backdrop-blur text-xl mb-3">
                                {{ $homeFeatured->icon }}
                            </span>
                        @endif
                        <h3 class="text-2xl md:text-3xl font-bold mb-2 group-hover:text-primary-light transition-colors">
                            {{ $homeFeatured->name }}
                        </h3>
                        <p class="text-sm md:text-base text-gray-200 max-w-lg line-clamp-2">
                            {{ $homeFeatured->description }}
                        </p>
                    </div>
                </a>

                {{-- ================= LIST KECIL (4 ITEM) ================= --}}
                <div class="flex flex-col justify-between h-auto lg:h-[460px] gap-4">
                    @foreach ($homeOthers as $facility)
                        <a href="{{ route('facility.show', $facility) }}" class="group flex items-center gap-4 bg-white rounded-xl border border-gray-100 p-4 hover:shadow-lg hover:border-primary/30 transition-all" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="w-16 h-16 md:w-20 md:h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                                @if ($facility->image)
                                    <img
                                        src="{{ asset('storage/' . $facility->image) }}"
                                        alt="{{ $facility->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-3xl bg-gradient-to-br from-gray-100 to-gray-200">
                                        {{ $facility->icon ?? '🎣' }}
                                    </div>
                                @endif
                            </div>

                            <div class="min-w-0 flex-1">
                                <h4 class="font-semibold text-base text-secondary truncate group-hover:text-primary transition-colors">
                                    {{ $facility->name }}
                                </h4>
                                <p class="text-sm text-gray-500 line-clamp-1 mt-0.5">
                                    {{ $facility->description }}
                                </p>
                            </div>

                            <i class="fas fa-chevron-right text-gray-300 group-hover:text-primary group-hover:translate-x-1 transition-all flex-shrink-0"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            @if ($facilities->count() > 5)
                <div data-aos="fade-up" class="mt-8 text-center">
                    <a href="{{ route('facilities') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark transition-all duration-300 shadow-md hover:shadow-lg">
                        Lihat Semua Fasilitas
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endif

        </div>
    </section>
    @endif

    {{-- Harga sekarang punya page sendiri: /harga --}}

    {{-- Blog --}}
    @if ($blogPosts->isNotEmpty())
        <section id="blog" class="py-12 md:py-16 bg-white">
            <div class="container-max">
                <div data-aos="fade-up">
                <x-section-title
                    badge="Blog & Tips"
                    title="Tips & Artikel Memancing"
                    subtitle="Pelajari tips memancing, teknik, dan cerita menarik dari para penggemar memancing"
                />
            </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($blogPosts as $post)
                         <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="card-modern overflow-hidden group">
                            <div class="relative h-48 overflow-hidden bg-gray-200">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-30"></div>
                            </div>
                            <div class="p-6">
                                @if ($post->category)
                                    <p class="text-sm text-primary font-bold mb-3 uppercase tracking-wider">{{ $post->category }}</p>
                                @endif
                                <h3 class="text-xl font-bold text-secondary mb-3 group-hover:text-primary transition-colors duration-300">
                                    {{ $post->title }}
                                </h3>
                                @if ($post->excerpt)
                                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">{{ $post->excerpt }}</p>
                                @endif
                                <a href="{{ route('blog.show', $post) }}" class="text-primary font-bold flex items-center space-x-2 hover:space-x-3 transition-all duration-300">
                                    <span>Baca Selengkapnya</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Testimoni: preview 3 testimoni + tombol ke halaman /testimoni --}}
    @if (($testimonials ?? collect())->isNotEmpty())
        <section id="testimoni" class="py-12 md:py-16 bg-light">
            <div class="container-max">
                <div data-aos="fade-up">
                    <x-section-title
                        badge="Testimoni"
                        title="Pengalaman Pengunjung"
                        subtitle="Dengarkan cerita dari pengunjung setia Balong Hardi"
                    />
                </div>

                {{-- ================= CAROUSEL WRAPPER ================= --}}
                <div data-aos="fade-up">

                    {{-- Wrapper khusus track: tombol center relatif ke INI aja, bukan ikut ketarik sama dots di bawah --}}
                    <div class="relative">

                        {{-- Tombol Panah Kiri --}}
                        <button
                            id="testiHomePrevBtn"
                            type="button"
                            aria-label="Testimoni sebelumnya"
                            class="group flex items-center justify-center absolute left-1 md:left-0 top-1/2 -translate-y-1/2 md:-translate-x-1/2 z-20 w-9 h-9 md:w-12 md:h-12 rounded-full bg-white border border-gray-200 shadow-lg text-secondary hover:bg-primary hover:text-white hover:border-primary transition-all duration-300"
                        >
                            <svg class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        {{-- Tombol Panah Kanan --}}
                        <button
                            id="testiHomeNextBtn"
                            type="button"
                            aria-label="Testimoni selanjutnya"
                            class="group flex items-center justify-center absolute right-1 md:right-0 top-1/2 -translate-y-1/2 md:translate-x-1/2 z-20 w-9 h-9 md:w-12 md:h-12 rounded-full bg-white border border-gray-200 shadow-lg text-secondary hover:bg-primary hover:text-white hover:border-primary transition-all-300"
                        >
                            <svg class="w-4 h-4 md:w-5 md:h-5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        {{-- Fade gradient kiri-kanan --}}
                        <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-8 md:w-16 bg-gradient-to-r from-light to-transparent z-10"></div>
                        <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-8 md:w-16 bg-gradient-to-l from-light to-transparent z-10"></div>

                        {{-- Track testimoni --}}
                        <div
                            id="testiHomeTrack"
                            class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-2"
                            style="scrollbar-width: none; -ms-overflow-style: none;"
                        >
                            @foreach ($testimonials as $testimonial)
                                <div
                                    class="testi-home-card snap-center sm:snap-start shrink-0 w-[74%] sm:w-[48%] lg:w-[31.5%] card-modern p-8 flex flex-col"
                                >
                                    <div class="flex items-center mb-4 space-x-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.92-.755 1.678-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.56-1.84-.198-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 mb-6 leading-relaxed italic flex-1">&ldquo;{{ $testimonial->message }}&rdquo;</p>
                                    <div class="flex items-center space-x-3">
                                        @if ($testimonial->avatar)
                                            <img src="{{ asset('storage/' . $testimonial->avatar) }}"
                                                 alt="{{ $testimonial->name }}"
                                                 class="w-12 h-12 rounded-full object-cover">
                                        @endif
                                        <div>
                                            <p class="font-bold text-secondary">{{ $testimonial->name }}</p>
                                            @if ($testimonial->city)
                                                <p class="text-sm text-gray-600">{{ $testimonial->city }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Dot indicator --}}
                    <div id="testiHomeDots" class="flex items-center justify-center gap-2 mt-8"></div>
                </div>
            </div>
        </section>
    @endif

   {{-- Kontak (form reservasi + info + map) --}}
    <section id="kontak" class="py-12 md:py-16 bg-white">
        <div class="container-max">
            <div data-aos="fade-up">
            <x-section-title
                badge="Reservasi Sekarang"
                title="Ajukan Permintaan Reservasi"
                subtitle="Isi form di bawah untuk melakukan reservasi memancing di Balong Hardi Sumedang"
            />
            </div>
 
            {{-- Form Reservasi --}}
            <div data-aos="fade-up" class="bg-light rounded-2xl p-5 md:p-8 border border-gray-200 mb-12">
                <form id="waContactForm" class="space-y-3">
                    {{-- Row 1: Nama & Tanggal --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="waName" required placeholder="Nama Anda"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium">
                        </div>
 
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Tanggal Reservasi <span class="text-red-500">*</span></label>
                            <input type="date" id="waDate" required min="{{ now()->format('Y-m-d') }}"
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium">
                        </div>
                    </div>
 
                    {{-- Row 2: Jumlah Orang & Paket --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Jumlah Orang <span class="text-red-500">*</span></label>
                            <input type="number" id="waGuests" min="1" value="1" required
                                   class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium">
                        </div>
 
                        <div>
                            <label class="block text-xs font-bold text-secondary mb-1">Jenis Paket <span class="text-red-500">*</span></label>
                            <select id="waPackage" required
                                    class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium">
                                <option value="">-- Pilih paket --</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->name }} ({{ $package->formatted_price }})">{{ $package->name }} - {{ $package->formatted_price }} /orang</option>
                                @endforeach
                                <option value="Paket Grup">Paket Grup (Custom)</option>
                            </select>
                        </div>
                    </div>
 
                    {{-- Row 3: Catatan Tambahan --}}
                    <div>
                        <label class="block text-xs font-bold text-secondary mb-1">Catatan Tambahan</label>
                        <textarea id="waMessage" rows="2" placeholder="Cth: Sewa alat pancing lengkap, butuh pemandu, dll"
                                  class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-200 font-medium resize-none"></textarea>
                    </div>
 
                    {{-- Submit Button --}}
                    <div class="flex items-center justify-between gap-4 pt-1">
                        <p class="text-xs text-gray-500">* Tim kami akan merespons dalam 1x24 jam kerja</p>
                        <button type="submit"
                                class="shrink-0 py-2.5 px-6 bg-gradient-to-r from-primary to-primary-dark text-white font-bold text-sm rounded-lg hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group">
                            <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform duration-300"></i>
                            Kirim Reservasi
                        </button>
                    </div>
                </form>
            </div>
 
            {{-- Info Cards Row --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                {{-- Info Card 1: Telepon --}}
                @if ($contact?->phone)
                    <div data-aos="fade-up" data-aos-delay="0" class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-blue-900 mb-2">Telepon</p>
                                <p class="text-gray-700 font-bold">{{ $contact->phone }}</p>
                            </div>
                        </div>
                    </div>
                @endif
 
                {{-- Info Card 2: WhatsApp --}}
                @if ($contact?->whatsapp)
                    <div data-aos="fade-up" data-aos-delay="100" class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fab fa-whatsapp text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-green-900 mb-2">WhatsApp</p>
                                <a href="https://wa.me/{{ $contact->whatsapp }}" class="text-green-700 font-bold hover:text-green-900 transition-colors">
                                    +{{ $contact->whatsapp }}
                                </a>
                                <p class="text-xs text-green-700 mt-1 font-medium">Respons Cepat 24/7</p>
                            </div>
                        </div>
                    </div>
                @endif
 
                {{-- Info Card: Email --}}
                @if ($contact?->email)
                    <div data-aos="fade-up" data-aos-delay="150" class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-purple-900 mb-2">Email</p>
                                <a href="mailto:{{ $contact->email }}" class="text-gray-700 font-bold hover:text-purple-700 transition-colors duration-300 break-all">
                                    {{ $contact->email }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
 
                {{-- Info Card 3: Lokasi --}}
                @if ($location?->address)
                    <div data-aos="fade-up" data-aos-delay="200" class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6 border border-red-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-red-900 mb-2">Lokasi</p>
                                <p class="text-gray-700 font-medium">{{ $location->address }}</p>
                            </div>
                        </div>
                    </div>
                @endif
 
                {{-- Info Card 4: Jam Operasional --}}
                @if ($contact?->operational_hours)
                    <div data-aos="fade-up" data-aos-delay="250" class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border border-yellow-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-white text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-yellow-900 mb-2">Jam Operasional</p>
                                <p class="text-gray-700 font-bold">{{ $contact->operational_hours }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
 
            {{-- Peta lokasi --}}
            <div data-aos="fade-up" class="mt-8 rounded-2xl overflow-hidden shadow-lg">
                <x-map :location="$location" />
            </div>
        </div>
    </section>

@endsection


    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // ================= FORM RESERVASI =================
            const formReservasi = document.getElementById('waContactForm');
            
            formReservasi?.addEventListener('submit', function (e) {
                e.preventDefault(); // Ini yang menahan agar web tidak refresh!
     
                const name = document.getElementById('waName').value.trim();
                const dateInput = document.getElementById('waDate').value;
                const guests = document.getElementById('waGuests').value;
                const pkg = document.getElementById('waPackage').value;
                const message = document.getElementById('waMessage').value.trim();
     
                if (!name || !dateInput || !pkg) return;
     
                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnHtml = submitBtn.innerHTML;
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
     
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    alert('System Error: CSRF token hilang dari layout.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                    return;
                }
     
                fetch('{{ route('reservation.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken.content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        name: name,
                        reservation_date: dateInput,
                        guests: guests,
                        package_name: pkg,
                        message: message,
                    }),
                })
                .then(async response => {
                    if (response.status === 422) {
                        const data = await response.json();
                        const errorMessages = Object.values(data.errors).flat().join('\n');
                        throw new Error(errorMessages);
                    }
                    if (!response.ok) throw new Error('Gagal menyimpan reservasi. Server error.');
                    return response.json();
                })
                .then(data => {
                    form.innerHTML = `
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-secondary mb-2">Reservasi Berhasil Dikirim!</h4>
                            <p class="text-gray-600 text-sm">Terima kasih, <b>${name}</b>. Tim kami akan menghubungi Anda dalam 1x24 jam kerja untuk konfirmasi.</p>
                        </div>
                    `;
                })
                .catch(error => {
                    alert(error.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                });
            });
               
        }); // Penutup DOMContentLoaded
          
     
    
         // ================= CAROUSEL TESTIMONI (HOME) =================
        document.addEventListener('DOMContentLoaded', function () {
            const track   = document.getElementById('testiHomeTrack');
            const prevBtn = document.getElementById('testiHomePrevBtn');
            const nextBtn = document.getElementById('testiHomeNextBtn');
            const dotsBox = document.getElementById('testiHomeDots');

            if (!track) return;

            const cards = Array.from(track.querySelectorAll('.testi-home-card'));
            const total = cards.length;
            if (total === 0) return;

            cards.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.classList.add('testi-dot');
                dot.setAttribute('aria-label', 'Ke testimoni ke-' + (i + 1));
                dot.addEventListener('click', () => goToRealIndex(i));
                dotsBox.appendChild(dot);
            });
            const dots = Array.from(dotsBox.children);

            const cloneBefore = cards.map(c => {
                const clone = c.cloneNode(true);
                clone.setAttribute('aria-hidden', 'true');
                clone.querySelectorAll('a, button, input').forEach(el => el.setAttribute('tabindex', '-1'));
                return clone;
            });
            const cloneAfter = cards.map(c => {
                const clone = c.cloneNode(true);
                clone.setAttribute('aria-hidden', 'true');
                clone.querySelectorAll('a, button, input').forEach(el => el.setAttribute('tabindex', '-1'));
                return clone;
            });

            const fragBefore = document.createDocumentFragment();
            cloneBefore.forEach(c => fragBefore.appendChild(c));
            track.insertBefore(fragBefore, cards[0]);

            const fragAfter = document.createDocumentFragment();
            cloneAfter.forEach(c => fragAfter.appendChild(c));
            track.appendChild(fragAfter);

            function getStep() {
                const style = window.getComputedStyle(track);
                const gap = parseFloat(style.columnGap || style.gap || 0);
                return cards[0].offsetWidth + gap;
            }

            function getSetWidth() {
                return getStep() * total;
            }

            function jumpInstant(scrollLeft) {
                track.style.scrollBehavior = 'auto';
                track.scrollLeft = scrollLeft;
                void track.offsetHeight;
                track.style.scrollBehavior = '';
            }

            jumpInstant(getSetWidth());

            function goToRealIndex(index) {
                const step = getStep();
                track.scrollTo({ left: getSetWidth() + step * index, behavior: 'smooth' });
            }

            nextBtn?.addEventListener('click', () => {
                track.scrollBy({ left: getStep(), behavior: 'smooth' });
            });

            prevBtn?.addEventListener('click', () => {
                track.scrollBy({ left: -getStep(), behavior: 'smooth' });
            });

            let scrollEndTimer = null;

            function handleScrollSettled() {
                const step = getStep();
                const setWidth = getSetWidth();
                const relIndex = Math.round((track.scrollLeft - setWidth) / step);

                if (relIndex >= total) {
                    jumpInstant(track.scrollLeft - setWidth);
                } else if (relIndex < 0) {
                    jumpInstant(track.scrollLeft + setWidth);
                }

                updateDots();
            }

            function updateDots() {
                const step = getStep();
                const setWidth = getSetWidth();
                let relIndex = Math.round((track.scrollLeft - setWidth) / step);
                relIndex = ((relIndex % total) + total) % total;

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === relIndex);
                });
            }

            track.addEventListener('scroll', () => {
                window.requestAnimationFrame(updateDots);
                clearTimeout(scrollEndTimer);
                scrollEndTimer = setTimeout(handleScrollSettled, 120);
            });

            window.addEventListener('resize', () => {
                jumpInstant(getSetWidth());
                updateDots();
            });

            updateDots();
        });

    </script>
    @endpush

       

@section('css')
    <style>
        #testiHomeTrack::-webkit-scrollbar { display: none; }

        .testi-dot {
            width: 8px;
            height: 8px;
            border-radius: 9999px;
            background-color: #E5E7EB;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .testi-dot.active {
            width: 24px;
            background-color: #15803D;
        }
    </style>
@endsection