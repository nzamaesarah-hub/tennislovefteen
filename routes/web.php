<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;

// 1. Landing Page Utama / Daftar Lapangan
Route::get('/', [CourtController::class, 'index'])->name('home');

// 2. Area User yang Sudah Login
Route::middleware(['auth'])->group(function () {
    
    // Tab 1: Booking (Daftar Lapangan setelah login)
    Route::get('/dashboard', [CourtController::class, 'index'])->name('dashboard');

    // Tab 2: History (Disinkronkan nama routenya menjadi 'history')
    Route::get('/history', [BookingController::class, 'userBookings'])->name('history');
    
    // Tab 3: Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking & Payment Process
    Route::get('/booking/create/{court}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/checkout/{id}', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::post('/booking/{id}/upload-proof', [BookingController::class, 'uploadProof'])->name('booking.uploadProof');

    // Admin Panel
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::patch('/admin/booking/{id}/status', [AdminDashboardController::class, 'updateStatus'])->name('admin.booking.updateStatus');
});

require __DIR__.'/auth.php';