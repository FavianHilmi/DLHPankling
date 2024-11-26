<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPassive; // Import your model
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DataPassiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DataPassive::create([
                'pemasangan' => $faker->date(),
                'pelepasan' => $faker->date(),
                'semester' => $faker->randomElement(['1', '2']),
                'kawasan_id' => $faker->numberBetween(1, 7),
                'SO2' => $faker->randomFloat(2, 0, 100), // Random SO2 value
                'NO2' => $faker->randomFloat(2, 0, 100), // Random NO2 value
                'user_id' => $faker->numberBetween(1, 10), // Example user_id range
                'status' => $faker->randomElement(['Sedang Diajukan', 'Terverifikasi', 'Perlu Revisi']),
            ]);
        }
    }
}
