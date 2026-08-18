<?php
// app/Http/Controllers/Admin/HighlightController.php

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('highlights', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Highlight::create($validated);

        return redirect()->route('admin.highlights.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    public function update(Request $request, Highlight $highlight)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($highlight->image) {
                Storage::disk('public')->delete($highlight->image);
            }
            $validated['image'] = $request->file('image')->store('highlights', 'public');
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
        $highlight->delete();

        return redirect()->route('admin.highlights.index')->with('success', 'Konten berhasil dihapus.');
    }
}