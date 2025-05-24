<?php

namespace Database\Seeders;

use App\Models\PenggunaanPestisida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaanPestisidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenggunaanPestisida::create([
            'pestisida_id' => 1,
            'jumlah_penggunaan' => 20,
            'tanggal_penggunaan' => now(),
            'user_id' => 1,
            'keterangan' => 'keterangan',
        ]);
    }
}
