<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data booking beserta data user penyewa dan lapangan
        $bookings = Booking::with(['user', 'court'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:confirmed,rejected',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}