<?php

namespace Database\Seeders;

use App\Models\KategoriPupuk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPupukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriPupuk::create(['nama_kategori' => 'Organik']);
        KategoriPupuk::create(['nama_kategori' => 'Anorganik']);
    }
}
