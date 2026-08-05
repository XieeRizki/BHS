<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        // 1. KONTEN BERITA (Kiri) - Filter khusus type 'berita'
        $berita = Post::with('category')
            ->where('type', 'berita')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(6);

        // 2. SPOTLIGHT (Kanan Atas)
        $spotlight = Post::with('category')
            ->where('is_spotlight', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(4)
            ->get();

        // 3. KATEGORI TRENDING TOPICS (Kanan Tengah)
        // Karena views_count dihapus, kita ambil 6 kategori terbaru/teratas
        $kategoriTrending = Category::latest()->take(6)->get();

        // 4. MENARIK TUK DISIMAK (Kanan Bawah) - Filter khusus type 'artikel'
        $artikelPilihan = Post::where('type', 'artikel')
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->first();

        return view('pages.informasi', compact(
            'berita', 
            'spotlight', 
            'kategoriTrending', 
            'artikelPilihan'
        ));
    }
}