<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Award;
use App\Models\Layanan;
use App\Models\Post;

class LayananController extends Controller
{
    // Fungsi bawaan sebelumnya untuk nampilin semua layanan
    public function index()
    {
        // WARNING: Kalau file view 'pages.layanan' sekarang butuh variabel $layanan,
        // halaman index ini bakal error. Sebaiknya view untuk index dibuat terpisah,
        // misalnya ganti jadi: return view('pages.layanan-index');
        return view('pages.layanan');
    }

    // Fungsi show() yang baru dipindah dan disesuaikan
    public function show(Layanan $layanan)
    {
        abort_unless($layanan->is_active, 404);

        try {
            $awards = Award::active()->ordered()->get();
            if ($awards->isEmpty()) {
                throw new \Exception('No award data');
            }
        } catch (\Throwable $e) {
            $awards = collect([
                ['title' => 'Dedikasi & Partisipasi Pengerahan Massa dalam Gebyar Vaksinasi COVID-19', 'issuer' => 'Kepolisian Resor Sumedang', 'year' => '2022', 'image' => null],
            ]);
        }

        $articles = Post::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(5)
            ->get();

        $contact = (object)['whatsapp' => '62895385703917'];

        // Ubah compact('highlight') jadi compact('layanan')
        return view('pages.layanan', compact('layanan', 'awards', 'articles', 'contact'));
    }
}