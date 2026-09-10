<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    // Menampilkan detail pengguna
    public function show(User $user)
    {
        $user->load(['bookings' => function ($query) {
            $query->with('court')->orderBy('booking_date', 'desc');
        }]);

        return view('admin.users.show', compact('user'));
    }

    // Menampilkan halaman edit pengguna
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Menyimpan perubahan pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Admin tidak boleh mengubah role akun sendiri (mencegah kehilangan akses admin)
        if ($user->id !== auth()->id()) {
            $user->role = $request->role;
        }

        // Password hanya diubah jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        // Admin tidak boleh menghapus akun admin yang sedang digunakan
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Akun admin yang sedang digunakan tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}