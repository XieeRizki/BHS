<?php
// app/Http/Controllers/Admin/AwardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::ordered()->get();
        return view('admin.awards.index', compact('awards'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('awards', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Award::create($validated);

        return redirect()->route('admin.awards.index')->with('success', 'Penghargaan berhasil ditambahkan.');
    }

    public function update(Request $request, Award $award)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:10',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($award->image) {
                Storage::disk('public')->delete($award->image);
            }
            $validated['image'] = $request->file('image')->store('awards', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $award->update($validated);

        return redirect()->route('admin.awards.index')->with('success', 'Penghargaan berhasil diperbarui.');
    }

    public function destroy(Award $award)
    {
        if ($award->image) {
            Storage::disk('public')->delete($award->image);
        }
        $award->delete();

        return redirect()->route('admin.awards.index')->with('success', 'Penghargaan berhasil dihapus.');
    }
}