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
        SatuanPupuk::create([
            'nama_satuan' => 'Kilogram (kg)',
            'user_id' => 1,
            'keterangan' => null
        ]);
        SatuanPupuk::create([
            'nama_satuan' => 'Gram (g)',
            'user_id' => 1,
            'keterangan' => null
        ]);
        SatuanPupuk::create([
            'nama_satuan' => 'Liter (l)',
            'user_id' => 1,
            'keterangan' => null
        ]);
        SatuanPupuk::create([
            'nama_satuan' => 'Mililiter (mL)',
            'user_id' => 1,
            'keterangan' => null
        ]);
    }
}
