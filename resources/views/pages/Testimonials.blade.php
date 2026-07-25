@extends('layouts.app')

@section('title', 'Testimoni - Balong Hardi Sumedang')

@section('content')

    {{-- Page Header --}}
    <section class="py-12 md:py-16 bg-light border-b border-gray-200">
        <div class="container-max">
            <div data-aos="fade-up">
                <x-section-title
                    badge="Testimoni"
                    title="Pengalaman Pengunjung"
                    subtitle="Dengarkan cerita dari pengunjung setia Balong Hardi"
                />
            </div>
        </div>
    </section>

    {{-- Testimoni --}}
    @if ($testimonials->isNotEmpty())
        <section class="py-12 md:py-16 bg-white">
            <div class="container-max">

                {{-- ================= CAROUSEL WRAPPER ================= --}}
                <div data-aos="fade-up">

                    {{-- Wrapper khusus track: tombol center relatif ke INI aja, bukan ikut ketarik sama dots di bawah --}}
                    <div class="relative">

                        {{-- Tombol Panah Kiri --}}
                        <button
                            id="testiPrevBtn"
                            type="button"
                            aria-label="Testimoni sebelumnya"
                            class="flex items-center justify-center absolute left-1 md:left-0 top-1/2 -translate-y-1/2 md:-translate-x-1/2 z-20 w-9 h-9 md:w-12 md:h-12 rounded-full bg-white border border-gray-200 shadow-lg text-secondary hover:bg-primary hover:text-white hover:border-primary transition-all duration-300"
                        >
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        {{-- Tombol Panah Kanan --}}
                        <button
                            id="testiNextBtn"
                            type="button"
                            aria-label="Testimoni selanjutnya"
                            class="flex items-center justify-center absolute right-1 md:right-0 top-1/2 -translate-y-1/2 md:translate-x-1/2 z-20 w-9 h-9 md:w-12 md:h-12 rounded-full bg-white border border-gray-200 shadow-lg text-secondary hover:bg-primary hover:text-white hover:border-primary transition-all duration-300"
                        >
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        {{-- Fade gradient kiri-kanan biar keliatan ada konten lanjutan (opsional, mempercantik) --}}
                        <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-8 md:w-16 bg-gradient-to-r from-white to-transparent z-10"></div>
                        <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-8 md:w-16 bg-gradient-to-l from-white to-transparent z-10"></div>

                        {{-- Track testimoni: scrollable horizontal, tombol yang menggerakkan --}}
                        <div
                            id="testiTrack"
                            class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-2"
                            style="scrollbar-width: none; -ms-overflow-style: none;"
                        >
                            @foreach ($testimonials as $testimonial)
                                <div
                                    class="testi-card snap-center sm:snap-start shrink-0 w-[74%] sm:w-[48%] lg:w-[31.5%] card-modern p-8 flex flex-col"
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
                    <div id="testiDots" class="flex items-center justify-center gap-2 mt-8"></div>
                </div>

            </div>
        </section>
    @else
        <section class="py-20 bg-white">
            <div class="container-max text-center text-gray-500">
                Belum ada testimoni yang tersedia saat ini.
            </div>
        </section>
    @endif

@endsection

@section('css')
    <style>
        /* Sembunyikan scrollbar bawaan browser (Chrome/Safari/Edge) tapi tetap bisa di-scroll/drag */
        #testiTrack::-webkit-scrollbar { display: none; }

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

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const track   = document.getElementById('testiTrack');
            const prevBtn = document.getElementById('testiPrevBtn');
            const nextBtn = document.getElementById('testiNextBtn');
            const dotsBox = document.getElementById('testiDots');

            if (!track) return;

            // "cards" = kartu ASLI (bukan hasil kloning), dipakai buat dot & hitungan index
            const cards = Array.from(track.querySelectorAll('.testi-card'));
            const total = cards.length;
            if (total === 0) return;

            // ===== Bikin dot indikator sejumlah kartu asli =====
            cards.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.classList.add('testi-dot');
                dot.setAttribute('aria-label', 'Ke testimoni ke-' + (i + 1));
                dot.addEventListener('click', () => goToRealIndex(i));
                dotsBox.appendChild(dot);
            });
            const dots = Array.from(dotsBox.children);

            // ===== Kloning: taro salinan kartu di depan & belakang track asli =====
            // Tujuannya biar pas next/prev kelewat batas, geser-nya tetep satu arah
            // terus (gak pernah "mental" balik), terus diem-diem di-reset ke posisi
            // yang keliatannya identik begitu animasi selesai.
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

            // Lebar 1 "blok" penuh (jarak dari awal blok ke awal blok berikutnya)
            function getStep() {
                const style = window.getComputedStyle(track);
                const gap = parseFloat(style.columnGap || style.gap || 0);
                return cards[0].offsetWidth + gap;
            }

            function getSetWidth() {
                const step = getStep();
                return step * total;
            }

            // Posisi scroll awal: mulai persis di kartu asli pertama (lewatin blok clone-before)
            function jumpInstant(scrollLeft) {
                track.style.scrollBehavior = 'auto';
                track.scrollLeft = scrollLeft;
                // paksa reflow sebelum balikin smooth lagi
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

            // ===== Deteksi kapan scroll berhenti, buat cek apakah udah masuk zona clone =====
            let scrollEndTimer = null;

            function handleScrollSettled() {
                const step = getStep();
                const setWidth = getSetWidth();
                const relIndex = Math.round((track.scrollLeft - setWidth) / step);

                if (relIndex >= total) {
                    // Udah kelewat ke blok clone-after -> lompat diam-diam ke blok asli
                    jumpInstant(track.scrollLeft - setWidth);
                } else if (relIndex < 0) {
                    // Udah kelewat ke blok clone-before -> lompat diam-diam ke blok asli
                    jumpInstant(track.scrollLeft + setWidth);
                }

                updateDots();
            }

            function updateDots() {
                const step = getStep();
                const setWidth = getSetWidth();
                let relIndex = Math.round((track.scrollLeft - setWidth) / step);
                relIndex = ((relIndex % total) + total) % total; // wrap ke rentang 0..total-1

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
                jumpInstant(getSetWidth() + getStep() * (Math.round((track.scrollLeft - getSetWidth()) / getStep())));
                updateDots();
            });

            // Inisialisasi status awal
            updateDots();
        });
    </script>
@endsection