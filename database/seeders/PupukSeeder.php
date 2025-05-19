<?php

namespace Database\Seeders;

use App\Models\Pupuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PupukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pupuk::create([
            'nama_pupuk' => 'Urea',
            'satuan_pupuk_id' => 1,
            'bentuk_pupuk_id' => 1,
            'kategori_pupuk_id' => 2,
            'jumlah_persediaan' => 10,
            'jumlah_dipakai' => 5,
            'sisa' => 5,
            'keterangan' => '',
        ]);
    }
}
