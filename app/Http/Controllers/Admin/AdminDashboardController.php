<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Court;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $totalEarnings = Booking::where('status', 'confirmed')->sum('total_price');
        $totalUsers    = User::where('is_admin', false)->count();
        $totalCourts   = Court::count();

        $bookings = Booking::with(['user', 'court'])
            ->latest()
            ->paginate(10);

        return view('admin.dashboard', compact(
            'totalBookings', 
            'totalEarnings', 
            'totalUsers', 
            'totalCourts', 
            'bookings'
        ));
    }

    // Fungsi Ubah Status Booking (Approve / Reject) oleh Admin
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,pending',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}