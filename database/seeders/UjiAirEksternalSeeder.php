<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UjiAirEksternalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('uji_air_eksternals')->insert([
                'tanggal' => Carbon::now()->subDays(rand(1, 30)),
                'nama_lokasi' => $faker->streetName,
                'wilayah_lokasi' => $faker->city,
                'titik_koordinat' => $faker->latitude . ', ' . $faker->longitude,
                'pH' => $faker->randomFloat(2, 6.5, 8.5),
                'DO' => $faker->randomFloat(2, 5, 10),
                'BOD' => $faker->randomFloat(2, 1, 5),
                'COD' => $faker->randomFloat(2, 10, 20),
                'TSS' => $faker->randomFloat(2, 10, 30),
                'nitrat' => $faker->randomFloat(2, 0.5, 3),
                'fosfat' => $faker->randomFloat(2, 0.1, 1),
                'fecal_coli' => $faker->numberBetween(0, 100),
                'kelas' => $faker->numberBetween(1, 4),
                'status' => $faker->randomElement(['Sedang Diajukan', 'Terverifikasi', 'Perlu Revisi']),
                'user_id' => $faker->numberBetween(1, 2),  // Sesuaikan dengan user_id yang ada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
