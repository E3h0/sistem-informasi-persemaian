<?php

namespace Database\Seeders;

use App\Models\KategoriPestisida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPestisidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriPestisida::create([
            'nama_kategori' => 'Insektisida',
            'user_id' => 1,
            'keterangan' => null
        ]);

        KategoriPestisida::create([
            'nama_kategori' => 'Fungisida',
            'user_id' => 1,
            'keterangan' => null
        ]);

        KategoriPestisida::create([
            'nama_kategori' => 'Herbisida',
            'user_id' => 1,
            'keterangan' => null
        ]);
    }
}
