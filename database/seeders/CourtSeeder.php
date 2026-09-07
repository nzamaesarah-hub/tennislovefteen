<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    public function run(): void
    {
        Court::create([
            'name' => 'Center Court - Royal Blue',
            'type' => 'Outdoor Hardcourt',
            'price_per_hour' => 150000,
            'description' => 'Lapangan utama standar internasional dengan pencahayaan malam yang maksimal.',
            'image' => 'center-court.jpg',
            'status' => 'available',
        ]);

        Court::create([
            'name' => 'Grandstand Court - Ocean',
            'type' => 'Indoor Hardcourt',
            'price_per_hour' => 200000,
            'description' => 'Lapangan indoor ber-AC dengan permukaan premium yang nyaman.',
            'image' => 'grandstand-court.jpg',
            'status' => 'available',
        ]);

        Court::create([
            'name' => 'Practice Court A',
            'type' => 'Outdoor Hardcourt',
            'price_per_hour' => 100000,
            'description' => 'Lapangan latihan yang sangat cocok untuk sesi privat maupun latihan rutin.',
            'image' => 'practice-court.jpg',
            'status' => 'available',
        ]);
    }
}