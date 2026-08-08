<?php
// app/Http/Controllers/Admin/InformasiController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    public function index()
    {
         $posts = Post::with('category')->latest()->paginate(15);
         $categories = Category::withCount('posts')->get();
         return view('admin.informasi.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.informasi.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'        => 'required|in:berita,artikel',
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:t_category,id',
            'content'     => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('posts', 'public');
        }

        Post::create([
            'category_id'  => $request->category_id,
            'type'         => $request->type,
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'cover_image'  => $imagePath,
            'excerpt'      => $request->excerpt ?? Str::limit(strip_tags($request->content), 150),
            'content'      => $request->content,
            'author_name'  => 'Humas BHS',
            'is_spotlight' => $request->boolean('is_spotlight'),
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => now(),
        ]);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Konten berhasil ditambahkan!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.informasi.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'type'        => 'required|in:berita,artikel',
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:t_category,id',
            'content'     => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'category_id'  => $request->category_id,
            'type'         => $request->type,
            'title'        => $request->title,
            'excerpt'      => $request->excerpt ?? Str::limit(strip_tags($request->content), 150),
            'content'      => $request->content,
            'is_spotlight' => $request->boolean('is_spotlight'),
            'is_featured'  => $request->boolean('is_featured'),
        ];

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        $post->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Konten berhasil dihapus.');
    }
}