<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AreaPenanaman;

class AreaPenanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AreaPenanaman::create(["nama_area" => "GHA"]);
        AreaPenanaman::create(["nama_area" => "AHA"]);
        AreaPenanaman::create(["nama_area" => "OGA"]);
    }
}
