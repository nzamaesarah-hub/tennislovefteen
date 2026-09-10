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

        // Simpan data booking sementara di session
        session([
            'pending_booking' => [
                'user_id' => Auth::id(),
                'court_id' => $court->id,
                'booking_date' => $request->booking_date,
                'start_time' => $request->start_time,
                'end_time' => $endTime,
                'duration_hours' => $duration,
                'total_price' => $totalPrice,
            ]
        ]);

        return redirect()->route('booking.checkout')
            ->with('success', 'Silakan lakukan pembayaran dan unggah bukti transfer.');
    }

    public function checkout()
    {
        $pendingBooking = session('pending_booking');

        // Jika tidak ada booking sementara
        if (!$pendingBooking) {
            return redirect()->route('dashboard')
                ->with('error', 'Tidak ada pemesanan yang sedang diproses.');
        }

        $court = Court::findOrFail($pendingBooking['court_id']);

        $banks = [
            [
                'name' => 'BCA',
                'account_number' => '1234567890',
                'account_name' => 'Love-15 Tennis Center',
                'logo_color' => 'text-blue-400 bg-blue-950/50 border-blue-800'
            ],
            [
                'name' => 'Mandiri',
                'account_number' => '0987654321',
                'account_name' => 'Love-15 Tennis Center',
                'logo_color' => 'text-yellow-400 bg-yellow-950/50 border-yellow-800'
            ],
            [
                'name' => 'BRI',
                'account_number' => '5678901234',
                'account_name' => 'Love-15 Tennis Center',
                'logo_color' => 'text-sky-400 bg-sky-950/50 border-sky-800'
            ],
        ];

        return view('bookings.checkout', compact(
            'pendingBooking',
            'court',
            'banks'
        ));
    }

    public function uploadProof(Request $request)
    {
        $pendingBooking = session('pending_booking');

        // Pastikan ada booking sementara
        if (!$pendingBooking) {
            return redirect()->route('dashboard')
                ->with('error', 'Data pemesanan tidak ditemukan.');
        }

        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload bukti pembayaran
        $path = $request->file('proof_of_payment')
            ->store('payment_proofs', 'public');

        // BARU SEKARANG booking disimpan ke database
        Booking::create([
            'user_id' => Auth::id(),
            'court_id' => $pendingBooking['court_id'],
            'booking_date' => $pendingBooking['booking_date'],
            'start_time' => $pendingBooking['start_time'],
            'end_time' => $pendingBooking['end_time'],
            'duration_hours' => $pendingBooking['duration_hours'],
            'total_price' => $pendingBooking['total_price'],
            'proof_of_payment' => $path,
            'status' => 'waiting_confirmation',
        ]);

        // Hapus data sementara dari session
        session()->forget('pending_booking');

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
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Pemesanan tidak dapat dibatalkan karena sudah diproses.');
        }

        if ($booking->proof_of_payment &&
            Storage::disk('public')->exists($booking->proof_of_payment)) {

            Storage::disk('public')->delete($booking->proof_of_payment);
        }

        $booking->delete();

        return redirect()->route('history')
            ->with('success', 'Pemesanan berhasil dibatalkan.');
    }
}