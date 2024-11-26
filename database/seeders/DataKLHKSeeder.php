<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class DataKLHKSeeder extends Seeder
{
    public function run()
    {
        DB::table('data_klhks')->insert([
            ['tanggal' => '2024-10-10', 'SO2' => '12', 'CO2' => '82', 'O3' => '32', 'NO2' => '1,2', 'HC' => '81', 'PM10' => '9,2', 'PM2_5' => '5,5'],
            ['tanggal' => '2024-10-10', 'SO2' => '12', 'CO2' => '82', 'O3' => '32', 'NO2' => '1,2', 'HC' => '81', 'PM10' => '9,2', 'PM2_5' => '5,5'],
            ['tanggal' => '2024-10-10', 'SO2' => '12', 'CO2' => '82', 'O3' => '32', 'NO2' => '1,2', 'HC' => '81', 'PM10' => '9,2', 'PM2_5' => '5,5']
        ]);
    }
}
