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
                {{-- Form ini TIDAK submit ke server. JS di bawah nyusun teks pesan
                     dari input, terus redirect langsung ke wa.me. --}}
                <div>
                    <form id="waContactForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-3">Nama Lengkap</label>
                            <input type="text" id="waName" required placeholder="Masukkan nama Anda"
                                   class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-3">Paket yang Diinginkan</label>
                            <select id="waPackage" class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300">
                                <option value="">Pilih paket...</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->name }}">{{ $package->name }} - {{ $package->formatted_price }}</option>
                                @endforeach
                                <option value="Paket Grup">Paket Grup</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-secondary mb-3">Pesan</label>
                            <textarea id="waMessage" rows="5" placeholder="Tuliskan pesan Anda..."
                                      class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-20 transition-all duration-300 resize-none"></textarea>
                        </div>
                        <x-button type="submit" variant="primary" icon="whatsapp" class="w-full">
                            Kirim via WhatsApp
                        </x-button>
                    </form>
                </div>

                {{-- Contact Info --}}
                <div class="space-y-6">
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

    <x-map :location="$location" />

@endsection

@section('js')
    <script>
        document.getElementById('waContactForm')?.addEventListener('submit', function (e) {
            e.preventDefault();

            const waNumber = '{{ $contact->whatsapp ?? '' }}';
            const name = document.getElementById('waName').value.trim();
            const pkg = document.getElementById('waPackage').value;
            const message = document.getElementById('waMessage').value.trim();

            if (!name) {
                document.getElementById('waName').focus();
                return;
            }

            let text = `Halo, saya ${name}.`;
            if (pkg) text += ` Saya tertarik dengan ${pkg}.`;
            if (message) text += ` ${message}`;

            window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(text)}`, '_blank');
        });
    </script>
@endsection
