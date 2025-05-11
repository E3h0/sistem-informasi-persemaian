<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MutasiBibit;

class MutasiBibitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MutasiBibit::create([
            "bibit_id" => 1,
            "area_id" => 1,
            "blok_id" => 1,
            "jumlah_bibit" => 32652,
            "keterangan" => ""
        ]);
        MutasiBibit::create([
            "bibit_id" => 1,
            "area_id" => 1,
            "blok_id" => 2,
            "jumlah_bibit" => 78500,
            "keterangan" => ""
        ]);
        MutasiBibit::create([
            "bibit_id" => 1,
            "area_id" => 1,
            "blok_id" => 3,
            "jumlah_bibit" => 100000,
            "keterangan" => ""
        ]);
        MutasiBibit::create([
            "bibit_id" => 1,
            "area_id" => 1,
            "blok_id" => 4,
            "jumlah_bibit" => 76352,
            "keterangan" => ""
        ]);
    }
}
