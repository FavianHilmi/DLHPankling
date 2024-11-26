<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArsipDataAirInternalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('arsip_data_air_internals')->insert([
            [
                'bulan' => 'Januari',
                'tahun' => '2024',
                'nama_lokasi' => 'Lokasi A',
                'titik_koordinat' => '-6.200000, 106.816666',
                'BOD' => 3.5,
                'COD' => 12.5,
                'TSS' => 30.0,
                'DO' => 7.2,
                'pH' => 7.0,
                'total_coli' => 15.0,
                'fecal_coli' => 5.0,
                'status' => 'Sedang Diajukan',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bulan' => 'Februari',
                'tahun' => '2024',
                'nama_lokasi' => 'Lokasi B',
                'titik_koordinat' => '-7.250445, 112.768845',
                'BOD' => 4.2,
                'COD' => 15.8,
                'TSS' => 45.0,
                'DO' => 6.8,
                'pH' => 7.5,
                'total_coli' => 25.0,
                'fecal_coli' => 10.0,
                'status' => 'Terverifikasi',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bulan' => 'Maret',
                'tahun' => '2024',
                'nama_lokasi' => 'Lokasi C',
                'titik_koordinat' => '-8.583333, 116.116667',
                'BOD' => 2.5,
                'COD' => 10.3,
                'TSS' => 20.0,
                'DO' => 7.5,
                'pH' => 6.8,
                'total_coli' => 10.0,
                'fecal_coli' => 3.0,
                'status' => 'Perlu Revisi',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
