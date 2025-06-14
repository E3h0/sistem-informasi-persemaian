<?php

namespace Database\Seeders;

use App\Models\Pestisida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PestisidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pestisida::create([
            'nama_pestisida' => 'Mancozeb 80WP',
            'satuan_pestisida_id' => 2,
            'bentuk_pestisida_id' => 1,
            'kategori_pestisida_id' => 2,
            'jumlah_persediaan' => 1000,
            'user_id' => 1,
            'keterangan' => ''
        ]);
    }
}
