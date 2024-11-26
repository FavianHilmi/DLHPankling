<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class DataKawasanSeeder extends Seeder
{
    public function run()
    {
        DB::table('data_kawasans')->insert([
            ['kawasan' => 'Perkantoran', 'deskripsi' => 'untuk wilayah Industri'],
            ['kawasan' => 'Pemukiman',  'deskripsi' => 'untuk wilayah Pemukiman'],
            ['kawasan' => 'Transportasi', 'deskripsi' => 'untuk wilayah Industri'],
            ['kawasan' => 'Area Rumah Sakit', 'deskripsi' => 'untuk wilayah Industri'],
            ['kawasan' => 'Industri', 'deskripsi' => 'untuk wilayah Industri'],
            ['kawasan' => 'Mall', 'deskripsi' => 'untuk wilayah Industri'],
            ['kawasan' => 'Pendidikan', 'deskripsi' => 'untuk wilayah Industri']

        ]);
    }
}
