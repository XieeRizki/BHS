<?php
// app/Http/Controllers/Frontend/ReservationController.php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'package_name' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        $validated['status'] = 'pending';

        Reservation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Reservasi berhasil dikirim.',
        ], 201);
    }
}