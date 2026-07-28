@extends('layouts.app')

@section('title', 'Kontak - Balong Hardi Sumedang')

@section('content')

    <section id="kontak" class="py-12 md:py-16 bg-light">
        <div class="container-max">
            <x-section-title
                badge="Hubungi Kami"
                title="Siap Membantu Anda"
                subtitle="Hubungi kami untuk reservasi, informasi lebih lanjut, atau pertanyaan seputar Balong Hardi"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16">
                {{-- Form Reservasi: sama persis kayak yang di Home, submit ke DB
                     lewat route('reservation.store') biar ke-track di admin panel --}}
                <div>
                    <form id="waContactForm" class="space-y-4">
                        {{-- Row 1: Nama & Tanggal --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-secondary mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="waName" required placeholder="Nama Anda"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 font-medium">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-secondary mb-2">Tanggal Reservasi <span class="text-red-500">*</span></label>
                                <input type="date" id="waDate" required min="{{ now()->format('Y-m-d') }}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 font-medium">
                            </div>
                        </div>

                        {{-- Row 2: Jumlah Orang & Paket --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-secondary mb-2">Jumlah Orang <span class="text-red-500">*</span></label>
                                <input type="number" id="waGuests" min="1" value="1" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 font-medium">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-secondary mb-2">Jenis Paket <span class="text-red-500">*</span></label>
                                <select id="waPackage" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 font-medium">
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
                            <label class="block text-sm font-bold text-secondary mb-2">Catatan Tambahan</label>
                            <textarea id="waMessage" rows="4" placeholder="Cth: Sewa alat pancing lengkap, butuh pemandu, dll"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 font-medium resize-none"></textarea>
                        </div>

                        <p class="text-xs text-gray-500">* Tim kami akan merespons dalam 1x24 jam kerja</p>

                        <button type="submit"
                                class="w-full py-3.5 px-6 bg-gradient-to-r from-primary to-primary-dark text-white font-bold text-sm rounded-xl hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 group">
                            <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform duration-300"></i>
                            Kirim Reservasi
                        </button>
                    </form>
                </div>

                {{-- Contact Info --}}
                <div class="space-y-4">
                    @if ($contact?->phone)
                        <x-contact-card icon="phone" title="Telepon">
                            <p class="text-gray-600 font-medium">{{ $contact->phone }}</p>
                        </x-contact-card>
                    @endif

                    @if ($contact?->whatsapp)
                        <x-contact-card icon="whatsapp" title="WhatsApp">
                            <a href="https://wa.me/{{ $contact->whatsapp }}" class="text-primary hover:text-primary-dark transition-colors duration-300 font-bold">
                                +{{ $contact->whatsapp }}
                            </a>
                            <p class="text-gray-600 text-sm mt-1 font-medium">Respons cepat 24/7</p>
                        </x-contact-card>
                    @endif

                    @if ($contact?->email)
                        <x-contact-card icon="envelope" title="Email">
                            <a href="mailto:{{ $contact->email }}" class="text-gray-600 hover:text-primary transition-colors duration-300 font-medium break-all">
                                {{ $contact->email }}
                            </a>
                        </x-contact-card>
                    @endif

                    @if ($location?->address)
                        <x-contact-card icon="map-pin" title="Alamat">
                            <p class="text-gray-600 font-medium">{{ $location->address }}</p>
                        </x-contact-card>
                    @endif

                    @if ($contact?->operational_hours)
                        <x-contact-card icon="clock" title="Jam Operasional">
                            <p class="text-gray-600 font-bold">{{ $contact->operational_hours }}</p>
                        </x-contact-card>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="pb-12 md:pb-16 bg-light">
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
        });
    </script>
@endsection