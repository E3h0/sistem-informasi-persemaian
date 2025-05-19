<?php

namespace Database\Seeders;

use App\Models\KategoriAlatKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriAlatKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriAlatKerja::create(['nama_kategori' => 'Persiapan Lahan']);
        KategoriAlatKerja::create(['nama_kategori' => 'Media Tanam']);
    }
}
