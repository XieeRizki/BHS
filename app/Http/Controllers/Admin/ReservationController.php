<?php
// app/Http/Controllers/Admin/ReservationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->paginate(15);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update(['status' => $request->status]);

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Reservasi berhasil dihapus.');
    }
}