<?php

namespace Database\Seeders;

use App\Models\SatuanPupuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanPupukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SatuanPupuk::create(['nama_satuan' => 'Kilogram (kg)']);
        SatuanPupuk::create(['nama_satuan' => 'Gram (g)']);
        SatuanPupuk::create(['nama_satuan' => 'Liter (l)']);
        SatuanPupuk::create(['nama_satuan' => 'Mililiter (mL)']);
    }
}
