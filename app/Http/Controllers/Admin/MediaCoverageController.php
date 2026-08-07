<?php
// app/Http/Controllers/Admin/MediaCoverageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaCoverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaCoverageController extends Controller
{
    public function index()
    {
        $mediaCoverages = MediaCoverage::ordered()->get();
        return view('admin.media-coverage.index', compact('mediaCoverages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('media-coverage', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        MediaCoverage::create($validated);

        return redirect()->route('admin.media-coverage.index')->with('success', 'Media berhasil ditambahkan.');
    }

    public function update(Request $request, MediaCoverage $mediaCoverage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'order' => 'nullable|integer',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($mediaCoverage->logo) {
                Storage::disk('public')->delete($mediaCoverage->logo);
            }
            $validated['logo'] = $request->file('logo')->store('media-coverage', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $mediaCoverage->update($validated);

        return redirect()->route('admin.media-coverage.index')->with('success', 'Media berhasil diperbarui.');
    }

    public function destroy(MediaCoverage $mediaCoverage)
    {
        if ($mediaCoverage->logo) {
            Storage::disk('public')->delete($mediaCoverage->logo);
        }
        $mediaCoverage->delete();

        return redirect()->route('admin.media-coverage.index')->with('success', 'Media berhasil dihapus.');
    }
}