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
                                @foreach ($packages as $package)
                                    <option value="{{ $package->name }} ({{ $package->formatted_price }})">{{ $package->name }} - {{ $package->formatted_price }} /orang</option>
                                @endforeach
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

                    @if ($contact?->phone)
                        <x-contact-card icon="phone" title="Telepon">
                            <p class="text-gray-600 dark:text-gray-300 font-medium">{{ $contact->phone }}</p>
                        </x-contact-card>
                    @endif

                    @if ($contact?->whatsapp)
                        <x-contact-card icon="whatsapp" title="WhatsApp">
                            <a href="https://wa.me/{{ $contact->whatsapp }}" class="text-primary dark:text-accent hover:text-primary-dark dark:hover:text-accent-dark transition-colors duration-300 font-bold">
                                +{{ $contact->whatsapp }}
                            </a>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mt-1 font-medium">Respons cepat 24/7</p>
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
                            <p class="text-gray-600 dark:text-gray-300 font-bold">{{ $contact->operational_hours }}</p>
                        </x-contact-card>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="pb-12 md:pb-16 bg-light dark:bg-dark transition-colors">
        <div class="container-max">
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <x-map :location="$location" />
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                    if (!response.ok) throw new Error('Gagal menyimpan reservasi. Server error.');
                    return response.json();
                })
                .then(data => {
                    form.innerHTML = `
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-secondary dark:text-light mb-2">Reservasi Berhasil Dikirim!</h4>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Terima kasih, <b>${name}</b>. Tim kami akan menghubungi Anda dalam 1x24 jam kerja untuk konfirmasi.</p>
                        </div>
                    `;
                })
                .catch(error => {
                    alert(error.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                });
            });
        });
    </script>
@endsection