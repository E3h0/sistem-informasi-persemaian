<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriBibit;

class KategoriBibitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBibit::create([
            "nama_kategori" => "Kayu-kayuan",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Estetika",
            'user_id' => 1,
            'keterangan' => null
        ]);
        KategoriBibit::create([
            "nama_kategori" => "Hasil Hutan Non Kayu",
            'user_id' => 1,
            'keterangan' => null
        ]);

    }
}
