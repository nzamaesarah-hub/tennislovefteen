<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name' => 'Nahza',
            'email' => 'nzamaesarah@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // <-- INI YANG BARU, otomatis jadi admin!
        ]);

        // Panggil seeder lapangan
        $this->call([
            CourtSeeder::class,
        ]);
    }
}