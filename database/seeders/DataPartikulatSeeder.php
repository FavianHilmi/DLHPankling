<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPartikulat; // Import your model
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DataPartikulatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DataPartikulat::create([
                'tahun' => $faker->randomElement(['2020','2021','2022', '2023', '2024']),
                'TPM' => $faker->randomFloat(2, 0, 100),
                'PM10' => $faker->randomFloat(2, 0, 100),
                'PM2_5' => $faker->randomFloat(2, 0, 100),
                'user_id' => $faker->numberBetween(1, 2), // Example user_id range
                'nama_lokasi' => $faker->streetName,
                'titik_koordinat' => $faker->latitude . ', ' . $faker->longitude,
                'status' => $faker->randomElement(['Sedang Diajukan', 'Terverifikasi', 'Perlu Revisi']),
            ]);
        }
    }
}
