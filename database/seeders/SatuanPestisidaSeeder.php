<?php

namespace Database\Seeders;

use App\Models\SatuanPestisida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanPestisidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SatuanPestisida::create(['nama_satuan' => 'Kilogram (kg)']);
        SatuanPestisida::create(['nama_satuan' => 'Gram (g)']);
        SatuanPestisida::create(['nama_satuan' => 'Liter (l)']);
        SatuanPestisida::create(['nama_satuan' => 'Mililiter (mL)']);
    }
}
