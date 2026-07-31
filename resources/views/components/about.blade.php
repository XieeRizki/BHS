{{--
    About section. Nerima $about (with 'benefits' relation, sudah di-load:
    About::with('benefits')->first()).
--}}
@props(['about'])

@if ($about)
    {{-- Tambah overflow-hidden biar animasi dari samping gak bikin layar geser --}}
    <section id="tentang" class="py-20 md:py-32 bg-white dark:bg-dark transition-colors duration-300 overflow-hidden">
        <div class="container-max">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center">
                
                <!-- Image (Animasi masuk dari kiri) -->
                <div class="order-2 md:order-1" data-aos="fade-right" data-aos-duration="1000">
                    <div class="relative h-96 md:h-[550px] rounded-3xl overflow-hidden shadow-2xl">
                        @if (!empty($about->image))
                            <img src="{{ asset('storage/' . $about->image) }}"
                                 alt="{{ $about->title ?? 'Tentang Kami' }}"
                                 class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-30"></div>
                    </div>
                </div>

                <!-- Content (Animasi masuk dari kanan) -->
                <div class="order-1 md:order-2" data-aos="fade-left" data-aos-duration="1000">
                    <x-section-title badge="Tentang Kami" :title="$about->title ?? ''" align="left" />

                    <div class="text-lg text-gray-600 dark:text-gray-300 mb-8 leading-relaxed space-y-4 -mt-12">
                        {!! nl2br(e($about->description ?? '')) !!}
                    </div>

                    @if (isset($about->benefits) && collect($about->benefits)->isNotEmpty())
                        <div class="space-y-4 mb-10">
                            @foreach ($about->benefits as $benefit)
                                {{-- Tiap poin keunggulan muncul naik satu-satu secara berurutan --}}
                                <div class="flex items-start space-x-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-accent flex items-center justify-center mt-1 shadow-lg">
                                        <svg class="w-4 h-4 text-[#0A0A0A]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-secondary dark:text-light text-lg">{{ $benefit->title ?? '' }}</h4>
                                        @if (!empty($benefit->description))
                                            <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $benefit->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                
            </div>
        </div>
    </section>
@endif