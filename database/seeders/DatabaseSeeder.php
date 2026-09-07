<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun testing
        User::create([
            'name' => 'Sarah',
            'email' => 'nzamaesarah@gmail.com',
            'password' => Hash::make('password123'), // Password akun kamu
        ]);

        // Panggil seeder lapangan
        $this->call([
            CourtSeeder::class,
        ]);
    }
}