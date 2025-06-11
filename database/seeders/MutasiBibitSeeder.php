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
            "user_id" => 1,
            "gha1" => 32652,
            "gha2" => 78500,
            "gha3" => 100000,
            "gha4" => 76352,
            "aha1" => 96750,
            "aha2" => 130968,
            "aha3" => 56376,
            "aha4" => 31872,
            "oga1" => 0,
            "oga2" => 50000,
            "oga3" => 211220,
            "oga4" => 219192,
            "siap_distribusi" => null,
            "keterangan" => null
        ]);
    }
}
