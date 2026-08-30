<?php
// app/Http/Controllers/Admin/StatController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stat::ordered()->get();
        return view('admin.stats.index', compact('stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('stats', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Stat::create($validated);

        return redirect()->route('admin.stats.index')->with('success', 'Infografis berhasil ditambahkan.');
    }

    public function update(Request $request, Stat $stat)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($stat->image) {
                Storage::disk('public')->delete($stat->image);
            }
            $validated['image'] = $request->file('image')->store('stats', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $stat->update($validated);

        return redirect()->route('admin.stats.index')->with('success', 'Infografis berhasil diperbarui.');
    }

    public function destroy(Stat $stat)
    {
        if ($stat->image) {
            Storage::disk('public')->delete($stat->image);
        }
        $stat->delete();

        return redirect()->route('admin.stats.index')->with('success', 'Infografis berhasil dihapus.');
    }
}