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
        SatuanPestisida::create([
            'nama_satuan' => 'Kilogram (kg)',
            'user_id' => 1,
            'keterangan' => null
        ]);
        SatuanPestisida::create([
            'nama_satuan' => 'Gram (g)',
            'user_id' => 1,
            'keterangan' => null
        ]);
        SatuanPestisida::create([
            'nama_satuan' => 'Liter (l)',
            'user_id' => 1,
            'keterangan' => null
        ]);
        SatuanPestisida::create([
            'nama_satuan' => 'Mililiter (mL)',
            'user_id' => 1,
            'keterangan' => null
        ]);
    }
}
