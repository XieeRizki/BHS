<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\MediaCoverage;
use App\Models\Award;
use App\Models\Stat;


class ProfileController extends Controller
{
    public function index()
    {
        $profile = (object) [
            'title' => 'Kenapa Balong Hardi Sumedang?',
            'description' => "Balong Hardi Sumedang hadir sebagai destinasi pemancingan dan rekreasi keluarga yang memadukan suasana asri dengan fasilitas lengkap, mulai dari kolam galatama, villa, hingga resto & cafe.\n\nLebih dari sekadar tempat memancing, BHS jadi ruang berkumpulnya komunitas mancing mania dari berbagai daerah untuk merasakan pengalaman event dan galatama yang berkesan.",
            'image' => null,
            'video_url' => null,
            'benefits' => collect(),
        ];

        try {
            $stats = Stat::active()->ordered()->get();

            if ($stats->isEmpty()) {
                throw new \Exception('No stat data');
            }
        } catch (\Throwable $e) {
            $stats = collect([
                ['value' => '3300+', 'label' => 'Pemancing', 'icon' => 'angler'],
                ['value' => '99+',   'label' => 'Event Galatama', 'icon' => 'fish'],
                ['value' => '120+',  'label' => 'Komunitas', 'icon' => 'community'],
                ['value' => '60x20', 'label' => 'Kolam', 'icon' => 'pond'],
                ['value' => '7+',    'label' => 'Tahun', 'icon' => 'badge'],
            ]);
        }

        
        # Penghargaan
        try {
            $awards = Award::active()->ordered()->get();

            if ($awards->isEmpty()) {
                throw new \Exception('No award data');
            }
        } catch (\Throwable $e) {
            $awards = collect([
                ['title' => 'Dedikasi & Partisipasi Pengerahan Massa dalam Gebyar Vaksinasi COVID-19', 'issuer' => 'Kepolisian Resor Sumedang', 'year' => '2022', 'image' => null],
                ['title' => 'Apresiasi Kontribusi Pengembangan Pariwisata Lokal', 'issuer' => 'Dinas Pariwisata Kabupaten Sumedang', 'year' => '2023', 'image' => null],
                ['title' => 'Penghargaan Tempat Wisata Ramah Komunitas', 'issuer' => 'Komunitas Mancing Jawa Barat', 'year' => '2024', 'image' => null],
            ]);
        }
        
        # Liputan Media
        try {
                $mediaLogos = MediaCoverage::active()->ordered()->get();

                if ($mediaLogos->isEmpty()) {
                    throw new \Exception('No media coverage data');
                }
            } catch (\Throwable $e) {
                $mediaLogos = collect([
                    (object)['name' => 'InfoJabar', 'logo' => null, 'url' => 'https://infojabar.id'],
                    (object)['name' => 'Tribun Jabar', 'logo' => null, 'url' => 'https://jabar.tribunnews.com'],
                    (object)['name' => 'Pikiran Rakyat', 'logo' => null, 'url' => 'https://pikiran-rakyat.com'],
                    (object)['name' => 'Trans7', 'logo' => null, 'url' => 'https://www.trans7.co.id'],
                    (object)['name' => 'Metro TV', 'logo' => null, 'url' => 'https://www.metrotvnews.com'],
                ]);
            }



        try {
            $faqs = Faq::active()->ordered()->get();

            if ($faqs->isEmpty()) {
                throw new \Exception('No FAQ data');
            }
        } catch (\Throwable $e) {
            $faqs = collect([
                (object)['question' => 'Layanan apa saja yang ditawarkan BHS?', 'answer' => 'Memulainya sangat mudah! Cukup hubungi kami melalui formulir kontak atau telepon, dan kami akan menjadwalkan konsultasi untuk membahas kebutuhan Anda serta bagaimana kami dapat memberikan pengalaman terbaik.'],
                (object)['question' => 'Bagaimana cara melakukan reservasi di BHS?', 'answer' => 'Reservasi bisa dilakukan langsung lewat tombol Reservasi di website atau menghubungi kami via WhatsApp. Tim kami akan membantu memilih paket dan jadwal yang sesuai.'],
                (object)['question' => 'Apakah tersedia paket untuk rombongan atau komunitas?', 'answer' => 'Tersedia. BHS memiliki paket khusus untuk galatama, fishing community, hingga acara kantor atau keluarga besar dengan fasilitas kolam dan area yang bisa disesuaikan.'],
                (object)['question' => 'Apa saja jam operasional Balong Hardi Sumedang?', 'answer' => 'BHS buka setiap hari, silakan cek jam operasional terbaru di halaman Kontak atau langsung tanyakan ke admin kami via WhatsApp.'],
            ]);
        }

        return view('pages.profile', compact('profile', 'stats', 'awards', 'mediaLogos', 'faqs'));
    }
}