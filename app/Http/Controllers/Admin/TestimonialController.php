<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Menampilkan daftar testimoni (jika ada file index)
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.testimonials.create');
    }

    // Menyimpan data testimoni
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'nullable|string|max:255',
            'message'   => 'required|string',
            'rating'    => 'required|integer|min:1|max:5',
            'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('avatar');
        $data['is_active'] = $request->has('is_active');

        // Proses upload foto avatar
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimoni orang penting berhasil ditambahkan!');
    }
}