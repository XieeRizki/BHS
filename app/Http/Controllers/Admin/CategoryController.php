<?php
// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150|unique:t_category,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(Category $kategori)
    {
        if ($kategori->posts()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus, masih dipakai di beberapa konten.');
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}