<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlokPenanaman;

class BlokPenanamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlokPenanaman::create(["nama_blok" => "Blok 1"]);
        BlokPenanaman::create(["nama_blok" => "Blok 2"]);
        BlokPenanaman::create(["nama_blok" => "Blok 3"]);
        BlokPenanaman::create(["nama_blok" => "Blok 4"]);

    }
}
