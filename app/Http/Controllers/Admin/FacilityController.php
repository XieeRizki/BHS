<?php
// app/Http/Controllers/Admin/FacilityController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::ordered()->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('facilities', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($facility->image) {
                Storage::disk('public')->delete($facility->image);
            }
            $validated['image'] = $request->file('image')->store('facilities', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->image) {
            Storage::disk('public')->delete($facility->image);
        }
        $facility->delete();

        return redirect()->route('admin.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}