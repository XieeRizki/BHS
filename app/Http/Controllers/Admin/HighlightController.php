<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Highlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HighlightController extends Controller
{
    public function index()
    {
        $highlights = Highlight::ordered()->get();
        return view('admin.highlights.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.highlights.create');
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
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('highlights', 'public');
        }

        if ($request->hasFile('qr_shopeefood')) {
            $validated['qr_shopeefood'] = $request->file('qr_shopeefood')->store('highlights/qr', 'public');
        }

        if ($request->hasFile('qr_gofood')) {
            $validated['qr_gofood'] = $request->file('qr_gofood')->store('highlights/qr', 'public');
        }

        if ($request->hasFile('gallery')) {
            $validated['gallery'] = collect($request->file('gallery'))
                ->map(fn($file) => $file->store('highlights/gallery', 'public'))
                ->values()->toArray();
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

        Highlight::create($validated);

        return redirect()->route('admin.highlights.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function edit(Highlight $highlight)
    {
        return view('admin.highlights.edit', compact('highlight'));
    }

    public function update(Request $request, Highlight $highlight)
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
        ]);

        if ($request->hasFile('image')) {
            if ($highlight->image) {
                Storage::disk('public')->delete($highlight->image);
            }
            $validated['image'] = $request->file('image')->store('highlights', 'public');
        }

        if ($request->hasFile('qr_shopeefood')) {
            if ($highlight->qr_shopeefood) {
                Storage::disk('public')->delete($highlight->qr_shopeefood);
            }
            $validated['qr_shopeefood'] = $request->file('qr_shopeefood')->store('highlights/qr', 'public');
        }

        if ($request->hasFile('qr_gofood')) {
            if ($highlight->qr_gofood) {
                Storage::disk('public')->delete($highlight->qr_gofood);
            }
            $validated['qr_gofood'] = $request->file('qr_gofood')->store('highlights/qr', 'public');
        }

        // Foto galeri baru DITAMBAHIN ke yang lama, bukan replace semua
        if ($request->hasFile('gallery')) {
            $newImages = collect($request->file('gallery'))
                ->map(fn($file) => $file->store('highlights/gallery', 'public'))
                ->values()->toArray();
            $validated['gallery'] = array_merge($highlight->gallery ?? [], $newImages);
        }

        if ($request->filled('services_lines')) {
            $validated['services'] = $this->buildServicesData(
                $request->input('services_lines', []),
                $request->file('service_images', []),
                $highlight
            );
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $highlight->update($validated);

        return redirect()->route('admin.highlights.index')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Highlight $highlight)
    {
        if ($highlight->image) {
            Storage::disk('public')->delete($highlight->image);
        }
        if ($highlight->qr_shopeefood) {
            Storage::disk('public')->delete($highlight->qr_shopeefood);
        }
        if ($highlight->qr_gofood) {
            Storage::disk('public')->delete($highlight->qr_gofood);
        }
        foreach ($highlight->gallery ?? [] as $img) {
            Storage::disk('public')->delete($img);
        }
        foreach ($highlight->services ?? [] as $svc) {
            if (!empty($svc['image'])) {
                Storage::disk('public')->delete($svc['image']);
            }
        }

        $highlight->delete();

        return redirect()->route('admin.highlights.index')->with('success', 'Konten berhasil dihapus.');
    }

    public function destroyGalleryImage(Highlight $highlight, int $index)
    {
        $gallery = $highlight->gallery ?? [];

        if (isset($gallery[$index])) {
            Storage::disk('public')->delete($gallery[$index]);
            unset($gallery[$index]);
            $highlight->update(['gallery' => array_values($gallery)]);
        }

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }

    /**
     * Susun array 'services' (nama + foto per-icon) dari input form.
     * $highlight dipakai buat pertahankan foto lama kalau slot gak di-upload ulang (saat update).
     * Nullable karena saat create belum ada $highlight sama sekali.
     */
    private function buildServicesData(array $names, array $serviceImages, ?Highlight $highlight): array
    {
        $names = array_values(array_filter(array_map('trim', $names)));

        return collect($names)->map(function ($name, $index) use ($serviceImages, $highlight) {
            $imagePath = null;

            if (isset($serviceImages[$index]) && $serviceImages[$index]->isValid()) {
                $imagePath = $serviceImages[$index]->store('highlights/services', 'public');
            } elseif ($highlight && !empty($highlight->services[$index]['image'] ?? null)) {
                $imagePath = $highlight->services[$index]['image'];
            }

            return ['name' => strtoupper($name), 'image' => $imagePath];
        })->values()->toArray();
    }
}