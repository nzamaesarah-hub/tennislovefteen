<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create(Court $court)
    {
        return view('bookings.create', compact('court'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'court_id' => 'required|exists:courts,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration_hours' => 'required|integer|min:1|max:8',
        ]);

        $court = Court::findOrFail($request->court_id);
        $duration = (int) $request->duration_hours;
        $totalPrice = $court->price_per_hour * $duration;

        $startTime = Carbon::createFromFormat('H:i', $request->start_time);
        $endTime = $startTime->copy()->addHours($duration)->format('H:i');

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'court_id' => $court->id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $endTime,
            'total_price' => $totalPrice,
            'status' => 'pending', // Status awal sebelum dibayar
        ]);

        return redirect()->route('booking.checkout', $booking->id)
            ->with('success', 'Pemesanan dibuat. Silakan lakukan pembayaran.');
    }

    public function checkout($id)
    {
        $booking = Booking::with('court')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $banks = [
            ['name' => 'BCA', 'account_number' => '1234567890', 'account_name' => 'Love-15 Tennis Center', 'logo_color' => 'text-blue-600'],
            ['name' => 'Mandiri', 'account_number' => '0987654321', 'account_name' => 'Love-15 Tennis Center', 'logo_color' => 'text-yellow-500'],
            ['name' => 'BRI', 'account_number' => '5678901234', 'account_name' => 'Love-15 Tennis Center', 'logo_color' => 'text-blue-800'],
        ];

        return view('bookings.checkout', compact('booking', 'banks'));
    }

    public function uploadProof(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($booking->proof_of_payment && Storage::disk('public')->exists($booking->proof_of_payment)) {
            Storage::disk('public')->delete($booking->proof_of_payment);
        }

        $path = $request->file('proof_of_payment')->store('payment_proofs', 'public');

        $booking->update([
            'proof_of_payment' => $path,
            'status' => 'waiting_confirmation', // Berubah jadi menunggu verifikasi admin
        ]);

        return redirect()->route('history')
            ->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu konfirmasi admin.');
    }

    public function userBookings()
    {
        $bookings = Booking::with('court')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('bookings'));
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Pemesanan tidak dapat dibatalkan.');
        }

        if ($booking->proof_of_payment && Storage::disk('public')->exists($booking->proof_of_payment)) {
            Storage::disk('public')->delete($booking->proof_of_payment);
        }

        $booking->delete();

        return redirect()->route('history')->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}