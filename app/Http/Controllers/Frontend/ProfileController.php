<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        // Belum pakai database — semua data di-hardcode dulu di sini.
        // Kalau nanti udah siap, tinggal ganti isi variabel ini jadi query
        // ke model/DB, nama variabelnya biarin sama biar blade gak perlu diubah.

        $profile = (object) [
            'title' => 'Kenapa Balong Hardi Sumedang?',
            'description' => "Balong Hardi Sumedang hadir sebagai destinasi pemancingan dan rekreasi keluarga yang memadukan suasana asri dengan fasilitas lengkap, mulai dari kolam galatama, villa, hingga resto & cafe.\n\nLebih dari sekadar tempat memancing, BHS jadi ruang berkumpulnya komunitas mancing mania dari berbagai daerah untuk merasakan pengalaman event dan galatama yang berkesan.",
            'image' => null,
            'video_url' => null,
            'benefits' => collect(),
        ];

        $stats = [
            ['value' => '3300+', 'label' => 'Pemancing', 'icon' => 'angler'],
            ['value' => '99+',   'label' => 'Event Galatama', 'icon' => 'fish'],
            ['value' => '120+',  'label' => 'Komunitas', 'icon' => 'community'],
            ['value' => '60x20', 'label' => 'Kolam', 'icon' => 'pond'],
            ['value' => '7+',    'label' => 'Tahun', 'icon' => 'badge'],
        ];

        $awards = [
            [
                'title' => 'Dedikasi & Partisipasi Pengerahan Massa dalam Gebyar Vaksinasi COVID-19',
                'issuer' => 'Kepolisian Resor Sumedang',
                'year' => '2022',
                'image' => null,
            ],
            [
                'title' => 'Apresiasi Kontribusi Pengembangan Pariwisata Lokal',
                'issuer' => 'Dinas Pariwisata Kabupaten Sumedang',
                'year' => '2023',
                'image' => null,
            ],
            [
                'title' => 'Penghargaan Tempat Wisata Ramah Komunitas',
                'issuer' => 'Komunitas Mancing Jawa Barat',
                'year' => '2024',
                'image' => null,
            ],
        ];

        $mediaCoverages = [
            ['name' => 'INFOJABAR', 'url' => 'https://infojabar.id', 'logo' => 'https://infojabar.id/wp-content/uploads/2021/03/logo-infojabar.png'],
            ['name' => 'TRIBUN JABAR', 'url' => 'https://jabar.tribunnews.com', 'logo' => 'https://asset-1.tribunnews.com/img/logo/tribun/tribunjabar.png'],
            ['name' => 'PIKIRAN RAKYAT', 'url' => 'https://pikiran-rakyat.com', 'logo' => 'https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2020/01/pikiran-rakyat.png'],
        ];

        $faqs = [
            [
                'q' => 'Layanan apa saja yang ditawarkan BHS?',
                'a' => 'Memulainya sangat mudah! Cukup hubungi kami melalui formulir kontak atau telepon, dan kami akan menjadwalkan konsultasi untuk membahas kebutuhan Anda serta bagaimana kami dapat memberikan pengalaman terbaik.',
            ],
            [
                'q' => 'Bagaimana cara melakukan reservasi di BHS?',
                'a' => 'Reservasi bisa dilakukan langsung lewat tombol Reservasi di website atau menghubungi kami via WhatsApp. Tim kami akan membantu memilih paket dan jadwal yang sesuai.',
            ],
            [
                'q' => 'Apakah tersedia paket untuk rombongan atau komunitas?',
                'a' => 'Tersedia. BHS memiliki paket khusus untuk galatama, fishing community, hingga acara kantor atau keluarga besar dengan fasilitas kolam dan area yang bisa disesuaikan.',
            ],
            [
                'q' => 'Apa saja jam operasional Balong Hardi Sumedang?',
                'a' => 'BHS buka setiap hari, silakan cek jam operasional terbaru di halaman Kontak atau langsung tanyakan ke admin kami via WhatsApp.',
            ],
        ];

        return view('pages.profile', compact('profile', 'stats', 'awards', 'mediaCoverages', 'faqs'));
    }
}