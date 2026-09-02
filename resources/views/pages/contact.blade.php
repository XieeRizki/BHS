@extends('layouts.app')

@section('title', 'Kontak - Balong Hardi Sumedang')

@section('content')

    <section id="kontak" class="py-12 md:py-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <x-section-title
                badge="Hubungi Kami"
                title="Siap Membantu Anda"
                subtitle="Hubungi kami untuk reservasi, informasi lebih lanjut, atau pertanyaan seputar Balong Hardi"
            />


            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
                {{-- Form Reservasi -- versi formal: Nama, No WA, Email,
                     Pilih Layanan, Catatan. Submit ke DB lewat
                     route('reservation.store') biar ke-track di admin. --}}
                <div>
                    <form id="waContactForm" class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-secondary dark:text-light mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="waName" required placeholder="Nama Anda"
                                   class="w-full px-4 py-3 border-2 border-gray-200 dark:border-white/10 dark:bg-[#161616] dark:text-light dark:placeholder:text-gray-500 rounded-xl focus:outline-none focus:border-primary dark:focus:border-accent focus:ring-2 focus:ring-primary dark:focus:ring-accent focus:ring-opacity-20 transition-all duration-300 font-medium">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-secondary dark:text-light mb-2">No. WhatsApp <span class="text-red-500">*</span></label>
                                <input type="tel" id="waPhone" required placeholder="08xxxxxxxxxx"
                                       class="w-full px-4 py-3 border-2 border-gray-200 dark:border-white/10 dark:bg-[#161616] dark:text-light dark:placeholder:text-gray-500 rounded-xl focus:outline-none focus:border-primary dark:focus:border-accent focus:ring-2 focus:ring-primary dark:focus:ring-accent focus:ring-opacity-20 transition-all duration-300 font-medium">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-secondary dark:text-light mb-2">Email</label>
                                <input type="email" id="waEmail" placeholder="nama@email.com"
                                       class="w-full px-4 py-3 border-2 border-gray-200 dark:border-white/10 dark:bg-[#161616] dark:text-light dark:placeholder:text-gray-500 rounded-xl focus:outline-none focus:border-primary dark:focus:border-accent focus:ring-2 focus:ring-primary dark:focus:ring-accent focus:ring-opacity-20 transition-all duration-300 font-medium">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-secondary dark:text-light mb-2">Pilih Layanan <span class="text-red-500">*</span></label>
                            <select id="waPackage" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 dark:border-white/10 dark:bg-[#161616] dark:text-light rounded-xl focus:outline-none focus:border-primary dark:focus:border-accent focus:ring-2 focus:ring-primary dark:focus:ring-accent focus:ring-opacity-20 transition-all duration-300 font-medium">
                                <option value="">-- Pilih layanan --</option>
                                {{-- TODO backend: idealnya diambil dari @foreach($packages as $package), sementara disamain manual sama menu "Paket Layanan" di navbar --}}
                                <option value="Wisata Kolam Pemancingan">Wisata Kolam Pemancingan</option>
                                <option value="Villa Kayu">Villa Kayu</option>
                                <option value="Hotel BHS">Hotel BHS</option>
                                <option value="Resto & Cafe">Resto & Cafe</option>
                                <option value="Paket Grup">Paket Grup (Custom)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-secondary dark:text-light mb-2">Catatan</label>
                            <textarea id="waMessage" rows="4" placeholder="Tuliskan kebutuhan Anda, misal: jumlah orang, tanggal rencana kunjungan, dll"
                                      class="w-full px-4 py-3 border-2 border-gray-200 dark:border-white/10 dark:bg-[#161616] dark:text-light dark:placeholder:text-gray-500 rounded-xl focus:outline-none focus:border-primary dark:focus:border-accent focus:ring-2 focus:ring-primary dark:focus:ring-accent focus:ring-opacity-20 transition-all duration-300 font-medium resize-none"></textarea>
                        </div>

                        <p class="text-xs text-gray-500 dark:text-gray-400">* Tim kami akan merespons dalam 1x24 jam kerja</p>

                        <button type="submit"
                                class="w-full py-3.5 px-6 bg-gradient-to-r from-primary to-primary-dark text-white font-bold text-sm rounded-xl hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group">
                            <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform duration-300"></i>
                            Kirim Reservasi
                        </button>
                    </form>
                </div>

                {{-- Contact Info --}}
                <div class="space-y-4">
                    @if ($location?->address)
                        <x-contact-card icon="map-pin" title="Alamat">
                            <p class="text-gray-600 dark:text-gray-300 font-medium">{{ $location->address }}</p>
                        </x-contact-card>
                    @endif

                    @if ($contact?->phone || $contact?->whatsapp)
                        <x-contact-card icon="phone" title="Whatsapp">
                            <div class="space-y-3">
                                <div>
                                    <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-0.5">Wisata Kolam Pemancingan</span>
                                    {{-- TODO backend: idealnya pakai field nomor telepon khusus pemancingan, sementara pakai $contact->phone --}}
                                    <a href="tel:{{ $contact->phone }}" class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-accent transition-colors duration-300 font-bold">
                                        {{ $contact->phone }}
                                    </a>
                                </div>

                                <div class="pt-3 border-t border-gray-100 dark:border-white/10">
                                    <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-0.5">Layanan Lainnya ( Wisata Pemancingan, Villa, Hotel, Resto & Cafe )</span>
                                    {{-- TODO backend: idealnya pakai field nomor telepon khusus layanan lainnya, sementara pakai $contact->whatsapp untuk href, teks ditampilkan hardcode format lokal --}}
                                    <a href="https://wa.me/{{ $contact->whatsapp }}" class="text-primary dark:text-accent hover:text-primary-dark dark:hover:text-accent-dark transition-colors duration-300 font-bold">
                                        +{{ substr($contact->whatsapp, 0, 2) }} {{ substr($contact->whatsapp, 2, 3) }}-{{ substr($contact->whatsapp, 5, 4) }}-{{ substr($contact->whatsapp, 9) }}
                                    </a>
                                </div>
                            </div>
                        </x-contact-card>
                    @endif

                    @if ($contact?->email)
                        <x-contact-card icon="envelope" title="Email">
                            <a href="mailto:{{ $contact->email }}" class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-accent transition-colors duration-300 font-medium break-all">
                                {{ $contact->email }}
                            </a>
                        </x-contact-card>
                    @endif

                    @if ($contact?->operational_hours)
                        <x-contact-card icon="clock" title="Jam Operasional">
                            <div class="space-y-2">
                                <div class="flex items-center gap-1.5">
                                    <span id="jamOpStatusDot" class="w-2 h-2 rounded-full bg-gray-400"></span>
                                    <span id="jamOpStatusText" class="text-sm font-extrabold text-gray-400">Memuat...</span>
                                </div>

                                {{-- TODO backend: idealnya jadwal ini dari field terstruktur (hari buka, jam buka-tutup, hari libur), sementara masih hardcode sesuai jadwal saat ini --}}
                                <p class="text-gray-600 dark:text-gray-300 font-bold">
                                    Jumat – Rabu: 12.00 – 00.00
                                </p>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-semibold">
                                    Kamis: Tutup
                                </p>
                            </div>
                        </x-contact-card>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="pb-12 md:pb-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div class="text-center mb-6">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 dark:bg-accent/10 text-primary dark:text-accent text-xs font-bold uppercase tracking-wide mb-2">
                    Lokasi Kami
                </span>
                <h3 class="text-base md:text-lg font-bold text-secondary dark:text-light">
                    Maps Menuju Lokasi
                </h3>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <x-map :location="$location" />
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Status Buka/Tutup Jam Operasional (real-time berdasarkan jam & hari saat ini)
            // TODO backend: hari libur (Kamis) & jam operasional (12.00-00.00) masih hardcode di sini,
            // idealnya ambil dari field terstruktur di database.
            (function () {
                const statusText = document.getElementById('jamOpStatusText');
                const statusDot = document.getElementById('jamOpStatusDot');
                if (!statusText || !statusDot) return;

                const CLOSED_DAY = 4; // getDay(): 0=Minggu, 1=Senin, 2=Selasa, 3=Rabu, 4=Kamis, 5=Jumat, 6=Sabtu
                const OPEN_HOUR = 12;
                const CLOSE_HOUR = 24; // tutup tengah malam (00.00)

                const now = new Date();
                const day = now.getDay();
                const hour = now.getHours();
                const isOpen = day !== CLOSED_DAY && hour >= OPEN_HOUR && hour < CLOSE_HOUR;

                if (isOpen) {
                    statusText.textContent = 'Buka';
                    statusText.classList.remove('text-gray-400', 'text-red-500');
                    statusText.classList.add('text-green-600', 'dark:text-green-400');
                    statusDot.classList.remove('bg-gray-400', 'bg-red-500');
                    statusDot.classList.add('bg-green-500');
                } else {
                    statusText.textContent = 'Tutup';
                    statusText.classList.remove('text-gray-400', 'text-green-600', 'dark:text-green-400');
                    statusText.classList.add('text-red-500');
                    statusDot.classList.remove('bg-gray-400', 'bg-green-500');
                    statusDot.classList.add('bg-red-500');
                }
            })();

            const formReservasi = document.getElementById('waContactForm');

            formReservasi?.addEventListener('submit', function (e) {
                e.preventDefault();

                const name = document.getElementById('waName').value.trim();
                const phone = document.getElementById('waPhone').value.trim();
                const email = document.getElementById('waEmail').value.trim();
                const pkg = document.getElementById('waPackage').value;
                const message = document.getElementById('waMessage').value.trim();

                if (!name || !phone || !pkg) return;

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
                        phone: phone,
                        email: email,
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
                    if (response.status === 419) {
                        // Sesi/CSRF token sudah expired. Beri instruksi jelas ke user,
                        // bukan pesan generic "Server error" biar ga membingungkan.
                        throw new Error('Sesi Anda sudah kedaluwarsa. Silakan refresh halaman ini (F5), lalu isi & kirim ulang formnya.');
                    }
                    if (!response.ok) throw new Error('Gagal menyimpan reservasi. Server error.');
                    return response.json();
                })
                .then(data => {
                    showReservationToast(`Terima kasih, ${name}! Reservasi Anda berhasil dikirim. Tim kami akan menghubungi Anda dalam 1x24 jam kerja.`);
                    form.reset();
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                })
                .catch(error => {
                    alert(error.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                });
            });

            // Toast notifikasi sukses reservasi. Form tetap ada di halaman,
            // cuma di-reset kosong lagi setelah submit berhasil.
            function showReservationToast(message) {
                const existing = document.getElementById('reservationToast');
                existing?.remove();

                const toast = document.createElement('div');
                toast.id = 'reservationToast';
                toast.className = 'fixed bottom-6 right-6 z-50 max-w-sm bg-white dark:bg-[#1c1c1c] border-2 border-green-500 rounded-xl shadow-2xl p-4 flex items-start gap-3 animate-[fadeIn_0.3s_ease-out]';
                toast.innerHTML = `
                    <div class="w-9 h-9 flex-shrink-0 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-secondary dark:text-light mb-0.5">Reservasi Berhasil Dikirim!</p>
                        <p class="text-xs text-gray-600 dark:text-gray-300">${message.replace(/^Terima kasih, .*?! /, '')}</p>
                    </div>
                    <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 flex-shrink-0" onclick="this.closest('#reservationToast').remove()">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                document.body.appendChild(toast);

                setTimeout(() => toast.remove(), 6000);
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection