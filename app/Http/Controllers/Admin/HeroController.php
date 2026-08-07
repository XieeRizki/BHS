<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\HeroImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    // Menampilkan halaman preview/index Hero Banner
    public function index()
    {
        $hero = Hero::with('images')->first();

        return view('admin.hero.index', compact('hero'));
    }

    // Menampilkan halaman Edit / Kelola Slider Hero
    public function edit()
    {
        // Ambil data hero pertama (karena ini singleton/cuma 1 hero di web)
        // Load juga relasi gambarnya
        $hero = Hero::with('images')->first();

        return view('admin.hero.edit', compact('hero'));
    }

    // Proses menyimpan atau update teks dan slider hero
    public function update(Request $request)
    {
        $request->validate([
            'title'           => 'nullable|string|max:255',
            'subtitle'        => 'nullable|string',
            'button_text'     => 'nullable|string|max:100',
            'button_link'     => 'nullable|string|max:255',
            // Validasi upload multiple slider (array)
            'slider_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Cek apakah hero sudah ada di database, kalau belum buat baru (firstOrCreate)
        $hero = Hero::first();
        if (!$hero) {
            $hero = Hero::create($request->only('title', 'subtitle', 'button_text', 'button_link'));
        } else {
            $hero->update($request->only('title', 'subtitle', 'button_text', 'button_link'));
        }

        // Proses unggah gambar slider (kalau admin memilih gambar)
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $file) {
                // Simpan ke storage/app/public/hero_sliders
                $path = $file->store('hero_sliders', 'public');

                // Masukkan ke tabel hero_images
                HeroImage::create([
                    'hero_id' => $hero->id,
                    'image'   => $path
                ]);
            }
        }

        return redirect()->route('admin.hero.edit')->with('success', 'Data Hero & Slider berhasil diperbarui!');
    }

    // Menghapus seluruh Hero Banner (dipanggil dari tombol Hapus di index)
    public function destroy()
    {
        $hero = Hero::with('images')->first();

        if (!$hero) {
            return redirect()->route('admin.hero.index')->with('error', 'Belum ada hero banner untuk dihapus.');
        }

        // Hapus semua file gambar slideshow dari storage
        foreach ($hero->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
        }

        // Hapus fallback image kalau ada
        if ($hero->image && Storage::disk('public')->exists($hero->image)) {
            Storage::disk('public')->delete($hero->image);
        }

        // Hapus semua record hero_images, lalu hero-nya sendiri
        $hero->images()->delete();
        $hero->delete();

        return redirect()->route('admin.hero.index')->with('success', 'Hero banner berhasil dihapus!');
    }

    // Menghapus salah satu gambar dari slider (dipanggil dari form edit)
    public function destroyImage($id)
    {
        $heroImage = HeroImage::findOrFail($id);

        // Hapus fisik gambarnya dari folder storage
        if (Storage::disk('public')->exists($heroImage->image)) {
            Storage::disk('public')->delete($heroImage->image);
        }

        // Hapus data dari database
        $heroImage->delete();

        return redirect()->back()->with('success', 'Gambar slider berhasil dihapus!');
    }
}