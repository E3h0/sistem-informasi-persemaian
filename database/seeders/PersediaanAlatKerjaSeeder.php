<?php

namespace Database\Seeders;

use App\Models\PersediaanAlatKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersediaanAlatKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersediaanAlatKerja::create([
            'nama_barang' => 'Cangkul',
            'kategori_id' => 1,
            'satuan_id' => 1,
            'jumlah_persediaan' => 10,
            'jumlah_dipakai' => 8,
            'user_id' => 1,
            'keterangan' => 'rusak 2 buah'
        ]);
    }
}
