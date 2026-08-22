<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan; // <-- Sudah diubah pakai model Layanan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        // Ubah variabel jadi $layanans
        $layanans = Layanan::ordered()->get();
        // Return view ke folder admin.layanan
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'section_subtitle' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_shopeefood' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_gofood' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_badge_text' => 'nullable|string|max:255',
            'qr_title' => 'nullable|string|max:255',
            'cta_title' => 'nullable|string|max:255',
            'cta_subtitle' => 'nullable|string|max:255',
            'services_lines' => 'nullable|array',
            'services_lines.*' => 'nullable|string|max:100',
            'service_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video_url' => 'nullable|url|max:255',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Path penyimpanan gambar diubah ke folder 'layanan' biar rapi
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('layanan', 'public');
        }

        if ($request->hasFile('qr_shopeefood')) {
            $validated['qr_shopeefood'] = $request->file('qr_shopeefood')->store('layanan/qr', 'public');
        }

        if ($request->hasFile('qr_gofood')) {
            $validated['qr_gofood'] = $request->file('qr_gofood')->store('layanan/qr', 'public');
        }

        if ($request->hasFile('gallery')) {
            $validated['gallery'] = collect($request->file('gallery'))
                ->map(fn($file) => $file->store('layanan/gallery', 'public'))
                ->values()->toArray();
        }

        if ($request->hasFile('bg_image')) {
            $validated['bg_image'] = $request->file('bg_image')->store('layanan/bg', 'public');
        }

        if ($request->filled('services_lines')) {
            $validated['services'] = $this->buildServicesData(
                $request->input('services_lines', []),
                $request->file('service_images', []),
                null
            );
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Layanan::create($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    // Parameter diganti jadi Layanan $layanan
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'section_subtitle' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_shopeefood' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_gofood' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_badge_text' => 'nullable|string|max:255',
            'qr_title' => 'nullable|string|max:255',
            'cta_title' => 'nullable|string|max:255',
            'cta_subtitle' => 'nullable|string|max:255',
            'services_lines' => 'nullable|array',
            'services_lines.*' => 'nullable|string|max:100',
            'service_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video_url' => 'nullable|url|max:255',
            'bg_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($layanan->image) {
                Storage::disk('public')->delete($layanan->image);
            }
            $validated['image'] = $request->file('image')->store('layanan', 'public');
        }

        if ($request->hasFile('qr_shopeefood')) {
            if ($layanan->qr_shopeefood) {
                Storage::disk('public')->delete($layanan->qr_shopeefood);
            }
            $validated['qr_shopeefood'] = $request->file('qr_shopeefood')->store('layanan/qr', 'public');
        }

        if ($request->hasFile('qr_gofood')) {
            if ($layanan->qr_gofood) {
                Storage::disk('public')->delete($layanan->qr_gofood);
            }
            $validated['qr_gofood'] = $request->file('qr_gofood')->store('layanan/qr', 'public');
        }

        if ($request->hasFile('gallery')) {
            $newImages = collect($request->file('gallery'))
                ->map(fn($file) => $file->store('layanan/gallery', 'public'))
                ->values()->toArray();
            $validated['gallery'] = array_merge($layanan->gallery ?? [], $newImages);
        }

        if ($request->filled('services_lines')) {
            $validated['services'] = $this->buildServicesData(
                $request->input('services_lines', []),
                $request->file('service_images', []),
                $layanan
            );
        }

        if ($request->hasFile('bg_image')) {
            if ($layanan->bg_image) {
                Storage::disk('public')->delete($layanan->bg_image);
            }
            $validated['bg_image'] = $request->file('bg_image')->store('layanan/bg', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $layanan->update($validated);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->image) {
            Storage::disk('public')->delete($layanan->image);
        }
        if ($layanan->qr_shopeefood) {
            Storage::disk('public')->delete($layanan->qr_shopeefood);
        }
        if ($layanan->qr_gofood) {
            Storage::disk('public')->delete($layanan->qr_gofood);
        }
        foreach ($layanan->gallery ?? [] as $img) {
            Storage::disk('public')->delete($img);
        }
        foreach ($layanan->services ?? [] as $svc) {
            if (!empty($svc['image'])) {
                Storage::disk('public')->delete($svc['image']);
            }
        }
        if ($layanan->bg_image) {
            Storage::disk('public')->delete($layanan->bg_image);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    public function destroyGalleryImage(Layanan $layanan, int $index)
{
    $gallery = $layanan->gallery ?? [];

    if (!array_key_exists($index, $gallery)) {
        return response()->json(['message' => 'Foto tidak ditemukan.'], 404);
    }

    Storage::disk('public')->delete($gallery[$index]);
    unset($gallery[$index]);
    $layanan->update(['gallery' => array_values($gallery)]);

    return response()->json(['message' => 'Foto galeri berhasil dihapus.']);
}

    private function buildServicesData(array $names, array $serviceImages, ?Layanan $layanan): array
    {
        $names = array_values(array_filter(array_map('trim', $names)));

        return collect($names)->map(function ($name, $index) use ($serviceImages, $layanan) {
            $imagePath = null;

            if (isset($serviceImages[$index]) && $serviceImages[$index]->isValid()) {
                $imagePath = $serviceImages[$index]->store('layanan/services', 'public');
            } elseif ($layanan && !empty($layanan->services[$index]['image'] ?? null)) {
                $imagePath = $layanan->services[$index]['image'];
            }

            return ['name' => strtoupper($name), 'image' => $imagePath];
        })->values()->toArray();
    }
}