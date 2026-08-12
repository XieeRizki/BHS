<?php
// app/Http/Controllers/Frontend/InformasiController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = null;
        if ($request->filled('kategori')) {
            $selectedCategory = Category::where('slug', $request->kategori)->first();
        }

        // Filter tipe: default 'semua', bisa 'berita' atau 'artikel'
        $selectedType = $request->get('type', 'semua');

        $beritaQuery = Post::with('category')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());

        if (in_array($selectedType, ['berita', 'artikel'])) {
            $beritaQuery->where('type', $selectedType);
        }

        if ($selectedCategory) {
            $beritaQuery->where('category_id', $selectedCategory->id);
        }

        $berita = $beritaQuery->latest('published_at')->paginate(6)->withQueryString();

        $spotlight = Post::with('category')
            ->where('is_spotlight', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')->take(4)->get();

        $kategoriTrending = Category::latest()->take(6)->get();

        $artikelPilihan = Post::where('is_featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')->first();

        return view('pages.informasi', compact(
            'berita', 'spotlight', 'kategoriTrending', 'artikelPilihan', 'selectedCategory', 'selectedType'
        ));
    }
}