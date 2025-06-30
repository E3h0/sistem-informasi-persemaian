<?php

namespace Database\Seeders;

use App\Models\SatuanAlatKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanAlatKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         SatuanAlatKerja::create([
            'nama_satuan' => 'Unit',
            'user_id' => 1,
            'keterangan' => null
        ]);
    }
}
