@extends('layouts.app')

@section('title', 'Home - Balong Hardi Sumedang | Tempat Pemancingan Terbaik')

@section('content')

    {{-- HERO (statis, dominan coklat-keemasan) --}}
    <section class="relative flex items-center min-h-screen -mt-20 overflow-hidden bg-gradient-to-br from-primary to-accent text-white" style="min-height:100vh;">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1920&q=80"
                 alt="Hero Background"
                 class="absolute inset-0 w-full h-full object-cover opacity-70">
            <div class="absolute inset-0 bg-gradient-to-r from-[#1C140C]/85 via-[#1C140C]/60 to-transparent"></div>
        </div>

        <div class="container-max relative z-10 w-full py-24 md:py-32">
            <div class="max-w-3xl text-center md:text-left">
                <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full mb-6 text-sm font-semibold text-accent">🎣 Tempat Memancing Premium</span>

                <h1 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight">
                    Selamat Datang di Balong Hardi Sumedang
                </h1>

                <p class="text-lg md:text-xl text-[#F3EAD8] mb-8">
                    Nikmati pengalaman memancing & rekreasi keluarga dengan nuansa coklat-keemasan — asri, nyaman, dan penuh layanan.
                </p>

                <div class="flex justify-center md:justify-start gap-4">
                    <a href="#kontak" class="inline-flex items-center gap-3 px-7 py-3 rounded-xl bg-accent text-[#1C140C] font-bold shadow-lg hover:brightness-95 transition">
                        Reservasi Sekarang
                    </a>
                    <a href="#fasilitas" class="inline-flex items-center gap-3 px-6 py-3 rounded-xl border border-white/20 bg-white/5 text-white hover:bg-white/10 transition">
                        Lihat Fasilitas
                    </a>
                </div>
            </div>
        </div>

        {{-- decorative gold glows --}}
        <div class="absolute -top-32 -right-24 w-96 h-96 rounded-full blur-3xl opacity-30" style="background: linear-gradient(135deg, rgba(255,215,0,0.2), rgba(140,94,52,0.12));"></div>
        <div class="absolute -bottom-32 -left-24 w-96 h-96 rounded-full blur-3xl opacity-20" style="background: linear-gradient(135deg, rgba(212,175,55,0.14), rgba(139,94,52,0.08));"></div>
    </section>

    {{-- TENTANG --}}
    <section class="py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max grid md:grid-cols-2 gap-12 items-center">
            <div class="rounded-3xl overflow-hidden shadow-xl h-96">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80"
                     alt="Tentang BHS"
                     class="w-full h-full object-cover">
            </div>

            <div>
                <span class="text-accent font-bold uppercase tracking-wider text-sm">Tentang Kami</span>
                <h2 class="text-3xl font-bold text-secondary dark:text-light mt-2 mb-4">Destinasi Pemancingan & Rekreasi Keluarga</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                    Balong Hardi Sumedang hadir memberikan pengalaman memancing premium dengan fasilitas lengkap: kolam galatama, villa kayu, resto & penginapan — dibalut nuansa coklat-keemasan.
                </p>
                <a href="#fasilitas" class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-br from-primary to-accent text-[#1C140C] font-semibold rounded-lg shadow-md hover:brightness-95 transition">Lihat Fasilitas</a>
            </div>
        </div>
    </section>

    {{-- FASILITAS --}}
    <section id="fasilitas" class="py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div class="text-center mb-10">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Fasilitas Kami</p>
                <h3 class="text-2xl md:text-3xl font-bold text-secondary dark:text-light">Lengkap, Asri & Nyaman</h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="relative lg:col-span-2 h-[420px] rounded-2xl overflow-hidden shadow-lg flex items-end p-8 bg-gray-100 dark:bg-[#2B1B0E]">
                    <img src="https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1400&q=80"
                         alt="Kolam Pemancingan" class="absolute inset-0 w-full h-full object-cover opacity-80">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                    <div class="relative z-10 text-white">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-lg bg-accent flex items-center justify-center text-[#1C140C] font-bold">🎣</div>
                            <div>
                                <h4 class="text-2xl font-bold">Kolam Pemancingan Utama</h4>
                                <p class="text-sm text-[#F3EAD8]">Kolam luas untuk lomba & rekreasi.</p>
                            </div>
                        </div>
                        <p class="text-gray-200 max-w-xl">Area terawat, bibit ikan pilihan, dan fasilitas pendukung untuk event komunitas & keluarga.</p>
                    </div>
                </div>

                <div class="flex flex-col justify-between gap-4">
                    <div class="flex items-center gap-4 bg-white dark:bg-[#2B1B0E] rounded-xl p-4 border border-gray-100 dark:border-white/6 shadow-sm">
                        <div class="w-16 h-16 rounded-lg bg-primary/20 dark:bg-primary/10 flex items-center justify-center text-2xl flex-shrink-0">🏡</div>
                        <div>
                            <h4 class="font-bold text-secondary dark:text-light">Villa Kayu Estetik</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Penginapan nyaman untuk keluarga.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 bg-white dark:bg-[#2B1B0E] rounded-xl p-4 border border-gray-100 dark:border-white/6 shadow-sm">
                        <div class="w-16 h-16 rounded-lg bg-primary/20 dark:bg-primary/10 flex items-center justify-center text-2xl flex-shrink-0">🍽️</div>
                        <div>
                            <h4 class="font-bold text-secondary dark:text-light">Resto & Cafe</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Menu lokal & kopi spesial.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="#paket-layanan" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-br from-primary to-accent text-[#1C140C] font-bold rounded-lg shadow-md hover:brightness-95 transition">
                    Lihat Paket Layanan
                </a>
            </div>
        </div>
    </section>

    {{-- EVENT --}}
    <section id="event" class="py-14 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div class="text-center mb-8">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Event</p>
                <h3 class="text-2xl font-bold text-secondary dark:text-light">Agenda & Event</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <div class="card-modern overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                        <div class="relative h-40 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-[#3a2b1d] flex items-center justify-center text-4xl">🎣</div>
                        <div class="p-6">
                            <p class="text-sm text-accent font-bold mb-2 uppercase">Galatama</p>
                            <h4 class="text-lg font-bold text-secondary dark:text-light mb-1">Galatama {{ $i+1 }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-300 mb-3">Tanggal contoh</p>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Keterangan singkat event.</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- INFORMASI --}}
    <section id="informasi" class="py-16 bg-white dark:bg-dark transition-colors">
        <div class="container-max">
            <div class="text-center mb-8">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Informasi</p>
                <h3 class="text-2xl font-bold text-secondary dark:text-light">Berita & Artikel</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <div class="card-modern overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                        <div class="relative h-44 overflow-hidden bg-gray-200 dark:bg-[#3a2b1d]">
                            <img src="https://picsum.photos/800/480?random={{ 400 + $i }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <p class="text-xs text-gray-500 dark:text-gray-300 mb-2">Senin, 26/07/2026</p>
                            <h4 class="text-lg font-bold text-secondary dark:text-light mb-2">Judul Berita {{ $i+1 }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Ringkasan singkat tentang berita atau kegiatan.</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- PAKET LAYANAN --}}
    <section id="paket-layanan" class="py-16 bg-gradient-to-br from-primary to-accent text-white">
        <div class="container-max text-center">
            <p class="text-[#1C140C] font-bold uppercase tracking-wider mb-2">Paket Layanan</p>
            <h3 class="text-2xl md:text-3xl font-bold mb-6">Dapatkan Paket Diskon Spesial Sekarang</h3>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach (['🎣','🏡','🏨','🍽️','🏛️'] as $icon)
                    <div class="rounded-xl p-5 bg-white/10 backdrop-blur border border-white/20">
                        <div class="text-3xl">{{ $icon }}</div>
                        <div class="mt-2 font-bold">Paket</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                <a href="#kontak" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-primary font-bold rounded-lg shadow-md hover:bg-accent transition">Hubungi Admin</a>
            </div>
        </div>
    </section>

    {{-- TESTIMONI --}}
    <section id="testimoni" class="py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div class="text-center mb-8">
                <p class="text-accent font-bold uppercase tracking-wider mb-2">Testimoni</p>
                <h3 class="text-2xl font-bold text-secondary dark:text-light">Pengalaman Pengunjung</h3>
            </div>

            <div class="flex gap-6 overflow-x-auto pb-4" id="testiTrack" style="scrollbar-width:none;">
                <div class="card-modern p-6 shrink-0 w-[80%] sm:w-[48%] lg:w-[32%]">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="text-yellow-400">★★★★★</div>
                        <div class="font-bold text-secondary dark:text-light">Andi</div>
                    </div>
                    <p class="text-gray-700 dark:text-gray-200 italic">"Tempatnya asri, pelayanan ramah. Recomended!"</p>
                </div>

                <div class="card-modern p-6 shrink-0 w-[80%] sm:w-[48%] lg:w-[32%]">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="text-yellow-400">★★★★☆</div>
                        <div class="font-bold text-secondary dark:text-light">Budi</div>
                    </div>
                    <p class="text-gray-700 dark:text-gray-200 italic">"Anak-anak senang, fasilitas lengkap."</p>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTAK / RESERVASI (frontend-only simulated) --}}
    <section id="kontak" class="py-16 bg-white dark:bg-dark transition-colors">
        <div class="container-max max-w-3xl mx-auto text-center">
            <span class="text-accent font-bold uppercase tracking-wider text-sm">Reservasi Sekarang</span>
            <h2 class="text-3xl font-bold text-secondary dark:text-light mt-2 mb-6">Hubungi Kami untuk Info & Pemesanan</h2>

            <div class="bg-light dark:bg-[#2B1B0E] p-8 rounded-2xl shadow-md border border-gray-100 dark:border-white/6 mb-6">
                <form id="waContactForm" class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <input type="text" id="waName" placeholder="Nama Lengkap" class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#3a2b1d] text-secondary dark:text-light">
                        <input type="date" id="waDate" class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#3a2b1d] text-secondary dark:text-light">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <input type="number" id="waGuests" min="1" value="1" class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#3a2b1d] text-secondary dark:text-light">
                        <select id="waPackage" class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#3a2b1d] text-secondary dark:text-light">
                            <option value="">-- Pilih paket --</option>
                            <option value="Paket Reguler">Paket Reguler - Rp50.000</option>
                            <option value="Paket VIP">Paket VIP - Rp100.000</option>
                        </select>
                    </div>

                    <textarea id="waMessage" rows="3" placeholder="Catatan tambahan (opsional)" class="w-full px-3 py-2 border rounded-lg bg-white dark:bg-[#3a2b1d] text-secondary dark:text-light"></textarea>

                    <div class="flex items-center justify-between">
                        <p class="text-xs text-gray-500 dark:text-gray-300">* Ini simulasi frontend — data tidak dikirim ke server</p>
                        <button type="submit" class="px-6 py-2.5 bg-accent text-[#1C140C] rounded-lg font-bold">Kirim Reservasi</button>
                    </div>
                </form>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-[#2E2216]">
                    <div class="font-bold text-secondary dark:text-light mb-1">Telepon</div>
                    <div class="text-gray-700 dark:text-gray-200">(022) 1234-567</div>
                </div>
                <div class="p-6 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-[#2E2216]">
                    <div class="font-bold text-secondary dark:text-light mb-1">WhatsApp</div>
                    <div class="text-gray-700 dark:text-gray-200">+62895385703917</div>
                </div>
                <div class="p-6 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-[#2E2216]">
                    <div class="font-bold text-secondary dark:text-light mb-1">Alamat</div>
                    <div class="text-gray-700 dark:text-gray-200">Jl. Contoh No.1, Sumedang</div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Simulasi submit form reservasi (frontend-only)
    const form = document.getElementById('waContactForm');
    form?.addEventListener('submit', function (e) {
        e.preventDefault();
        const name = document.getElementById('waName').value || 'Pengunjung';
        form.innerHTML = `
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-secondary dark:text-light mb-2">Reservasi Diterima!</h4>
                <p class="text-gray-600 dark:text-gray-300">Terima kasih, <b>${name}</b>. Ini simulasi frontend saja — data tidak dikirim ke server.</p>
            </div>
        `;
    });

    if (window.AOS) AOS.init({ once:false, mirror:true, offset:50, duration:700 });
});
</script>
@endpush

@section('css')
<style>
    /* Hide horizontal scrollbar on testi */
    #testiTrack::-webkit-scrollbar { display: none; }
</style>
@endsection