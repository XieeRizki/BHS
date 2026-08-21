<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\MediaCoverage;
use App\Models\Testimonial;
use App\Models\Layanan;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // HERO & ABOUT (dummy)
        // $hero = (object)[
        //     'title' => 'Selamat Datang di Balong Hardi Sumedang',
        //     'subtitle' => 'Tempat pemancingan asri dengan fasilitas lengkap',
        //     'image' => null,
        //     'stats' => null,
        // ];

        $hero = Hero::with('images')->first();
        $testimonials = Testimonial::where('is_active', true)->latest()->get();

        if (!$hero) {
            $hero = (object)[
                'title' => 'Selamat Datang di Balong Hardi Sumedang',
                'subtitle' => 'Tempat pemancingan asri dengan fasilitas lengkap',
                'image' => null,
                'images' => [],
                'stats' => []
            ];
        }

        $about = (object)[
            'title' => 'Tentang Balong Hardi',
            'description' => 'Balong Hardi Sumedang menyediakan area pemancingan yang asri, fasilitas lengkap, dan pelayanan ramah untuk keluarga dan komunitas memancing.',
            'benefits' => collect([
                'Area luas & terawat',
                'Peralatan sewa lengkap',
                'Restoran & penginapan dekat lokasi',
            ]),
        ];

        // TODO backend: ganti link ini kalau BHS udah punya video profil/promosi sendiri.
        // Sementara pakai video asli BHS yang ada di YouTube biar gak kosong.
        $aboutVideoUrl = 'https://www.youtube.com/watch?v=TK3PaH0ZAyY';

        // FACILITIES
        $facilities = collect([
            (object)['name' => 'Kolam Pemancingan', 'description' => 'Kolam luas dan terawat', 'image' => null, 'icon' => '🎣'],
            (object)['name' => 'Villa Kayu', 'description' => 'Villa nyaman untuk keluarga', 'image' => null, 'icon' => '🏡'],
            (object)['name' => 'Resto & Cafe', 'description' => 'Makanan lezat & kopi', 'image' => null, 'icon' => '🍽️'],
            (object)['name' => 'Meeting Room', 'description' => 'Ruang pertemuan serbaguna', 'image' => null, 'icon' => '🏛️'],
            (object)['name' => 'Hotel BHS', 'description' => 'Penginapan dekat lokasi', 'image' => null, 'icon' => '🏨'],
        ]);

        // PACKAGES (dipakai form reservasi)
        $packages = collect([
            (object)['name' => 'Paket Reguler', 'formatted_price' => 'Rp50.000'],
            (object)['name' => 'Paket VIP', 'formatted_price' => 'Rp100.000'],
        ]);

        // TESTIMONIALS DUMMY
        // $testimonials = collect([
        //     (object)[
        //         'rating' => 5,
        //         'message' => 'Tempatnya asri, pelayanan ramah. Recomended!',
        //         'name' => 'Andi',
        //         'avatar' => null,
        //         'role' => 'Pengunjung',
        //     ],
        //     (object)[
        //         'rating' => 4,
        //         'message' => 'Anak-anak senang, fasilitas lengkap.',
        //         'name' => 'Budi',
        //         'avatar' => null,
        //         'city' => 'Sumedang',
        //     ],
        // ]);

        // BLOG POSTS
        $blogPosts = collect([
            (object)[
                'title' => 'Kegiatan Galatama Terakhir',
                'excerpt' => 'Galatama seru di akhir pekan lalu...',
                'image' => null,
                'created_at' => Carbon::now()->subDays(3),
                'category' => 'Berita',
            ],
            (object)[
                'title' => 'Tips Memancing untuk Pemula',
                'excerpt' => 'Beberapa trik sederhana untuk pemancing baru...',
                'image' => null,
                'created_at' => Carbon::now()->subDays(10),
                'category' => 'Tips',
            ],
            (object)[
                'title' => 'Persiapan Event Galatama',
                'excerpt' => 'Informasi penting untuk peserta...',
                'image' => null,
                'created_at' => Carbon::now()->subDays(20),
                'category' => 'Berita',
            ],
        ]);

        // CONTACT & LOCATION (supaya layout tidak memanggil DB)
        $contact = (object)[
            'phone' => '(022) 1234-567',
            'whatsapp' => '62895385703917',
            'email' => 'info@balonghardi.test',
            'operational_hours' => '08:00 - 20:00',
        ];

        $location = (object)[
            'address' => 'Jl. Contoh No.1, Sumedang',
        ];

        // HOME SERVICES, MEDIA LOGOS, EVENTS (opsional)
        $homeServices = collect([
            (object)['name' => 'Wisata Kolam Pemancingan', 'icon' => '🎣'],
            (object)['name' => 'Villa Kayu', 'icon' => '🏡'],
            (object)['name' => 'Hotel BHS', 'icon' => '🏨'],
            (object)['name' => 'Resto & Cafe', 'icon' => '🍽️'],
            (object)['name' => 'Meeting Room & Convention Hall', 'icon' => '🏛️'],
        ]);

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

        $homeEvents = collect([
            (object)['title' => 'Galatama Mingguan BHS', 'category' => 'Galatama', 'date' => '2026-08-01', 'description' => 'Keterangan event BHS'],
            (object)['title' => 'Fishing Community Gathering', 'category' => 'Fishing Community', 'date' => '2026-08-02', 'description' => 'Keterangan event BHS'],
            (object)['title' => 'Galatama Spesial Akhir Pekan', 'category' => 'Galatama', 'date' => '2026-08-03', 'description' => 'Keterangan event BHS'],
        ]);

        try {
        $layanans = Layanan::active()->ordered()->take(3)->get();

        if ($layanans->isEmpty()) {
            throw new \Exception('No layanan data');
        }
        } catch (\Throwable $e) {
            $layanans = collect([
                (object)['title' => 'Tentang Hotel BHS', 'slug' => '#', 'short_description' => 'Kamar hotel yang bersih dan nyaman dengan nuansa coklat-keemasan khas BHS, cocok untuk istirahat setelah seharian memancing atau berlibur bersama keluarga.', 'image' => null],
                (object)['title' => 'Tentang Villa BHS', 'slug' => '#', 'short_description' => 'Villa kayu dengan suasana asri dan sejuk, dikelilingi pemandangan kolam serta area hijau — pilihan tepat untuk liburan keluarga yang lebih privat dan hangat.', 'image' => null],
                (object)['title' => 'Tentang Food & Beverage BHS', 'slug' => '#', 'short_description' => 'Aneka menu khas rumahan dan olahan ikan segar hasil kolam sendiri, disajikan hangat dengan suasana makan yang nyaman bersama keluarga dan rekan.', 'image' => null],
            ]);
        }

        return view('pages.home', compact(
            'hero',
            'about',
            'aboutVideoUrl',
            'facilities',
            'packages',
            'testimonials',
            'blogPosts',
            'contact',
            'location',
            'homeServices',
            'mediaLogos',
            'homeEvents',
            'layanans'
        ));
    }
}