<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\LayananItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananItemController extends Controller
{
    public function index(Layanan $layanan)
    {
        $items = $layanan->items()->ordered()->get();
        return view('admin.layanan-item.index', compact('layanan', 'items'));
    }

    public function create(Layanan $layanan)
    {
        return view('admin.layanan-item.create', compact('layanan'));
    }

    public function store(Request $request, Layanan $layanan)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('layanan-item/cover', 'public');
        }
        if ($request->hasFile('pdf')) {
            $validated['pdf'] = $request->file('pdf')->store('layanan-item/pdf', 'public');
        }
        if ($request->hasFile('gallery')) {
            $validated['gallery'] = collect($request->file('gallery'))
                ->map(fn($f) => $f->store('layanan-item/gallery', 'public'))->values()->toArray();
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $layanan->items()->create($validated);

        return redirect()->route('admin.layanan-item.index', $layanan)->with('success', 'Item berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan, LayananItem $item)
    {
        return view('admin.layanan-item.edit', compact('layanan', 'item'));
    }

    public function update(Request $request, Layanan $layanan, LayananItem $item)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('cover')) {
            if ($item->cover) Storage::disk('public')->delete($item->cover);
            $validated['cover'] = $request->file('cover')->store('layanan-item/cover', 'public');
        }
        if ($request->hasFile('pdf')) {
            if ($item->pdf) Storage::disk('public')->delete($item->pdf);
            $validated['pdf'] = $request->file('pdf')->store('layanan-item/pdf', 'public');
        }
        if ($request->hasFile('gallery')) {
            $new = collect($request->file('gallery'))
                ->map(fn($f) => $f->store('layanan-item/gallery', 'public'))->values()->toArray();
            $validated['gallery'] = array_merge($item->gallery ?? [], $new);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $item->update($validated);

        return redirect()->route('admin.layanan-item.index', $layanan)->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan, LayananItem $item)
    {
        foreach (array_filter([$item->cover, $item->pdf]) as $f) {
            Storage::disk('public')->delete($f);
        }
        foreach ($item->gallery ?? [] as $g) {
            Storage::disk('public')->delete($g);
        }
        $item->delete();

        return redirect()->route('admin.layanan-item.index', $layanan)->with('success', 'Item berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'price_unit' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'sub_title_1' => 'nullable|string|max:255',
            'sub_description_1' => 'nullable|string',
            'sub_title_2' => 'nullable|string|max:255',
            'sub_description_2' => 'nullable|string',
            'order' => 'nullable|integer',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }
}