<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    // Menampilkan halaman form create
    public function create()
    {
        $categories = Category::all();
        return view('admin.informasi.create', compact('categories'));
    }

    // Menyimpan data berita atau artikel baru ke database
    public function store(Request $request)
    {
        // Validasi input, wajib memilih type berita atau artikel
        $request->validate([
            'type'        => 'required|in:berita,artikel',
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:t_category,id', // pastikan merujuk ke tabel t_category
            'content'     => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('posts', 'public');
        }

        Post::create([
            'category_id'  => $request->category_id,
            'type'         => $request->type, // Simpan tipenya (hardcode dari form)
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'cover_image'  => $imagePath,
            'excerpt'      => $request->excerpt ?? Str::limit(strip_tags($request->content), 150),
            'content'      => $request->content,
            'author_name'  => 'Humas BHS',
            'is_spotlight' => $request->has('is_spotlight') ? true : false,
            'is_featured'  => $request->has('is_featured') ? true : false,
            'published_at' => now(), 
        ]);

        return redirect()->route('admin.informasi.create')
            ->with('success', 'Konten berhasil ditambahkan!');
    }
}